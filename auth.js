// auth.js

import { 
    auth, 
    signInWithEmailAndPassword, 
    createUserWithEmailAndPassword, 
    sendEmailVerification, 
    sendPasswordResetEmail, 
    doc, 
    setDoc, 
    getDoc, 
    Timestamp 
} from './firebase';
import { showRegistrationMessage, showPaymentPopup, handleError } from './ui';
import { startRedirect } from './redirect';

export const loginUser = async (email, password) => {
    if (password.length < 6) {
        handleError('loginError', 'A senha deve ter pelo menos 6 caracteres.');
        return;
    }

    try {
        const userCredential = await signInWithEmailAndPassword(auth, email, password);
        const user = userCredential.user;

        await user.reload();

        if (!user.emailVerified) {
            handleError('loginError', 'Por favor, verifique seu e-mail antes de fazer login.');
            return;
        }

        const userDoc = doc(db, 'users', user.uid);
        const userSnapshot = await getDoc(userDoc);

        if (userSnapshot.exists()) {
            const userData = userSnapshot.data();
            if (checkTrialOrSubscriptionStatus(userData)) {
                startRedirect(userData.subscriptionEnd || userData.trialEnd);
            } else {
                showPaymentPopup();
            }
        } else {
            console.error('Dados do usuário não encontrados.');
        }
    } catch (error) {
        handleError('loginError', error.message);
    }
};

export const registerUser = async (name, email, password) => {
    if (name === '' || email === '' || password === '' || password.length < 6) {
        handleError('registerError', 'Por favor, preencha todos os campos corretamente.');
        return;
    }

    try {
        const userCredential = await createUserWithEmailAndPassword(auth, email, password);
        const user = userCredential.user;
        const registrationDate = new Date();
        const trialEndDate = addDays(registrationDate, 3);

        await setDoc(doc(db, 'users', user.uid), {
            name: name,
            email: email,
            isPaid: false,
            subscriptionEnd: null,
            trialEnd: Timestamp.fromDate(trialEndDate),
            trialStart: Timestamp.fromDate(registrationDate)
        });

        await sendEmailVerification(user);

        showRegistrationMessage(registrationDate, trialEndDate);
    } catch (error) {
        handleError('registerError', error.message);
    }
};

export const resetPassword = async (email) => {
    if (email === '') {
        handleError('resetError', 'O e-mail é obrigatório.');
        return;
    }

    try {
        await sendPasswordResetEmail(auth, email);
        alert('E-mail de recuperação enviado!');
    } catch (error) {
        handleError('resetError', error.message);
    }
};
