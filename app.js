const express = require('express');
const bodyParser = require('body-parser');
const nodemailer = require('nodemailer');
const { v4: uuidv4 } = require('uuid');
const admin = require('firebase-admin');
const path = require('path');
const serviceAccount = require('./config/serviceAccountKey.json');

admin.initializeApp({
    credential: admin.credential.cert(serviceAccount),
    databaseURL: 'https://robo-7937c.firebaseio.com'
});

const db = admin.firestore();
const auth = admin.auth();

const app = express();
app.use(bodyParser.urlencoded({ extended: true }));
app.use(bodyParser.json());

const transporter = nodemailer.createTransport({
    service: 'gmail',
    auth: {
        user: process.env.GMAIL_USER,
        pass: process.env.GMAIL_PASS
    }
});

// Registro de usuário
app.post('/register', async (req, res) => {
    const { email, password } = req.body;

    try {
        const userRecord = await auth.getUserByEmail(email).catch(() => null);

        if (userRecord) {
            return res.status(400).send('E-mail já está em uso.');
        }

        const newUserRecord = await auth.createUser({
            email: email,
            password: password,
        });
        const userId = newUserRecord.uid;

        const verificationToken = uuidv4();
        await db.collection('users').doc(userId).set({
            email: email,
            verificationToken: verificationToken,
            verified: false
        });

        const mailOptions = {
            from: process.env.GMAIL_USER,
            to: email,
            subject: 'Verifique seu endereço de email',
            text: `Olá!\n\nPara completar seu cadastro, por favor, clique no link abaixo para verificar seu e-mail:\n\nhttp://localhost:3000/verify/${verificationToken}\n\nObrigado!`
        };

        await transporter.sendMail(mailOptions);
        res.status(200).send('Cadastro realizado com sucesso! Verifique seu e-mail para confirmar.');
    } catch (error) {
        console.error('Erro ao registrar usuário:', error);
        res.status(500).send('Erro ao registrar usuário. Tente novamente mais tarde.');
    }
});

// Login de usuário
app.post('/login', async (req, res) => {
    const { email, password } = req.body;

    try {
        const userRecord = await auth.getUserByEmail(email);
        const token = await auth.createCustomToken(userRecord.uid);

        // Simulação de autenticação
        // Aqui você deve verificar a senha e o estado de verificação
        const userDoc = await db.collection('users').doc(userRecord.uid).get();
        const userData = userDoc.data();

        if (userData && userData.verified) {
            res.status(200).json({ verified: true, token });
        } else {
            res.status(400).json({ verified: false });
        }
    } catch (error) {
        console.error('Erro ao fazer login:', error);
        res.status(500).send('Erro ao fazer login. Tente novamente mais tarde.');
    }
});

// Verificação de e-mail
app.get('/verify/:token', async (req, res) => {
    const { token } = req.params;

    try {
        const userDoc = await db.collection('users').where('verificationToken', '==', token).get();
        if (!userDoc.empty) {
            const userId = userDoc.docs[0].id;
            await db.collection('users').doc(userId).update({ verified: true });
            res.redirect('/confirmation.html');
        } else {
            res.status(400).send('Token de verificação inválido.');
        }
    } catch (error) {
        console.error('Erro ao verificar e-mail:', error);
        res.status(500).send('Erro ao verificar e-mail. Tente novamente mais tarde.');
    }
});

app.listen(3000, () => {
    console.log('Servidor iniciado na porta 3000');
});
