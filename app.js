// app.js

import { loginUser, registerUser, resetPassword } from './auth';
import { startRedirect } from './redirect';
import { handleError, showRegistrationMessage, showPaymentPopup } from './ui';

document.addEventListener('DOMContentLoaded', () => {
    // Referências aos elementos do DOM
    const loginForm = document.getElementById('loginForm');
    const registerForm = document.getElementById('registerForm');
    const loginLink = document.getElementById('loginLink');
    const registerLink = document.getElementById('registerLink');
    const loginButton = document.getElementById('loginButton');
    const registerButton = document.getElementById('registerButton');
    const paymentButton = document.getElementById('paymentButton');
    const redirectPopup = document.getElementById('redirectPopup');
    const redirectTimer = document.getElementById('redirectTimer');
    const redirectNowButton = document.getElementById('redirectNowButton');
    const trialStatus = document.getElementById('trialStatus');
    const registrationMessage = document.getElementById('registrationMessage');
    const resetPasswordButton = document.getElementById('resetPasswordButton');
    const resetPasswordPopup = document.getElementById('resetPasswordPopup');
    const resetEmail = document.getElementById('resetEmail');
    const resetError = document.getElementById('resetError');
    const closeResetPopup = document.getElementById('closeResetPopup');
    const subscriptionStatus = document.getElementById('subscriptionStatus');
    const closePopupButton = document.getElementById('closePopupButton');
    const paymentPopup = document.getElementById('paymentPopup');
    const paymentNowButton = document.getElementById('paymentNowButton');
    const logoutButton = document.getElementById('logoutButton');

    // Verificar a existência dos elementos antes de adicionar eventos
    if (
        loginForm && registerForm && loginLink && registerLink && loginButton && registerButton && 
        paymentButton && redirectPopup && redirectTimer && redirectNowButton && trialStatus && 
        registrationMessage && resetPasswordButton && resetPasswordPopup && resetEmail && 
        resetError && closeResetPopup && subscriptionStatus && closePopupButton && 
        paymentPopup && paymentNowButton && logoutButton
    ) {
        registerLink.addEventListener('click', (event) => {
            event.preventDefault();
            loginForm.style.display = 'none';
            registerForm.style.display = 'flex';
        });

        loginLink.addEventListener('click', (event) => {
            event.preventDefault();
            registerForm.style.display = 'none';
            loginForm.style.display = 'flex';
        });

        loginButton.addEventListener('click', async () => {
            const email = document.getElementById('loginEmail').value;
            const password = document.getElementById('loginPassword').value;
            await loginUser(email, password);
        });

        registerButton.addEventListener('click', async () => {
            const name = document.getElementById('registerName').value;
            const email = document.getElementById('registerEmail').value;
            const password = document.getElementById('registerPassword').value;
            await registerUser(name, email, password);
        });

        paymentButton.addEventListener('click', () => {
            showPaymentPopup();
        });

        redirectNowButton.addEventListener('click', () => {
            window.location.href = 'https://botmillion.github.io/telm/';
        });

        resetPasswordButton.addEventListener('click', async () => {
            const email = resetEmail.value;
            await resetPassword(email);
        });

        closeResetPopup.addEventListener('click', () => {
            resetPasswordPopup.style.display = 'none';
        });

        closePopupButton.addEventListener('click', () => {
            registrationMessage.style.display = 'none';
            window.location.href = HOME_URL; // Redirecionar para o início
        });

        logoutButton.addEventListener('click', () => {
            firebase.auth().signOut().then(() => {
                window.location.href = HOME_URL; // Redirecionar para o início
            });
        });

        // Se estiver na tela inicial, mostre a mensagem de registro, se necessário
        if (document.getElementById('registrationMessage')) {
            showRegistrationMessage();
        }
    }
});
