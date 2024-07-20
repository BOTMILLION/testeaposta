const express = require('express');
const bodyParser = require('body-parser');
const nodemailer = require('nodemailer');
const { v4: uuidv4 } = require('uuid');
const admin = require('firebase-admin');
const serviceAccount = require('./config/serviceAccountKey.json'); // Substitua pelo caminho correto para o arquivo JSON

admin.initializeApp({
    credential: admin.credential.cert(serviceAccount),
    databaseURL: 'https://robo-7937c.firebaseio.com' // Substitua pela URL do seu banco de dados Firebase
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
            text: `Olá!\n\nPara completar seu cadastro, por favor, clique no link abaixo para verificar seu e-mail:\n\nhttps://verificacaoemail-fe01279c603a.herokuapp.com//verify?token=${verificationToken}\n\nObrigado por se registrar\n\nAtenciosamente,\n\nEquipe Apostador Prime`
        };

        transporter.sendMail(mailOptions, (error, info) => {
            if (error) {
                console.error('Erro ao enviar e-mail:', error);
                return res.status(500).send('Erro ao enviar email.');
            }
            res.status(200).send('Email de verificação enviado.');
        });
    } catch (error) {
        res.status(400).send(error.message);
    }
});

app.get('/verify', async (req, res) => {
    const { token } = req.query;
    try {
        const snapshot = await db.collection('users').where('verificationToken', '==', token).get();
        if (snapshot.empty) {
            return res.status(400).send('Token inválido.');
        }
        const userId = snapshot.docs[0].id;
        await db.collection('users').doc(userId).update({ verified: true });
        res.status(200).sendFile(__dirname + '/confirmation.html');
    } catch (error) {
        res.status(400).send('Erro ao verificar email.');
    }
});

app.listen(3000, () => {
    console.log('Servidor rodando na porta 3000');
});
