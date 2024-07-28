import { 
    auth, 
    db, 
    signInWithEmailAndPassword, 
    createUserWithEmailAndPassword, 
    sendEmailVerification, 
    sendPasswordResetEmail, 
    doc, 
    setDoc, 
    getDoc, 
    Timestamp, 
    updateDoc 
} from './firebase'; // Ajuste o caminho conforme necessário

import { formatDistanceToNow, addDays } from 'date-fns'; // Importando date-fns

const REDIRECT_URL = 'https://botmillion.github.io/telm/';
const PAYMENT_URL = 'https://checkout.suitpay.app/italo-oliveria/bcbe785c836badbb1c18c24a0c1ac51e';
const HOME_URL = 'https://botmillion.github.io/testeaposta/';

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
        
        // Mostrar o formulário de cadastro
        registerLink.addEventListener('click', (event) => {
            event.preventDefault();
            loginForm.style.display = 'none';
            registerForm.style.display = 'flex';
        });

        // Mostrar o formulário de login
        loginLink.addEventListener('click', (event) => {
            event.preventDefault();
            registerForm.style.display = 'none';
            loginForm.style.display = 'flex';
        });

        // Manipular o clique no botão de login
        loginButton.addEventListener('click', async () => {
            const email = document.getElementById('loginEmail').value;
            const password = document.getElementById('loginPassword').value;

            if (password.length < 6) {
                handleError('loginError', 'A senha deve ter pelo menos 6 caracteres.');
            } else {
                try {
                    const userCredential = await signInWithEmailAndPassword(auth, email, password);
                    const user = userCredential.user;

                    // Recarregar o status do usuário
                    await user.reload();

                    if (user.emailVerified) {
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
                    } else {
                        handleError('loginError', 'Por favor, verifique seu e-mail antes de fazer login.');
                    }
                } catch (error) {
                    handleError('loginError', error.message);
                }
            }
        });

        // Manipular o clique no botão de cadastro
        registerButton.addEventListener('click', async () => {
            const name = document.getElementById('registerName').value;
            const email = document.getElementById('registerEmail').value;
            const password = document.getElementById('registerPassword').value;

            if (name === '' || email === '' || password === '' || password.length < 6) {
                handleError('registerError', 'Por favor, preencha todos os campos corretamente.');
            } else {
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

                    // Enviar e-mail de verificação
                    await sendEmailVerification(user);

                    document.getElementById('registerError').style.display = 'none';
                    registerForm.style.display = 'none';
                    showRegistrationMessage(registrationDate, trialEndDate);
                } catch (error) {
                    handleError('registerError', error.message);
                }
            }
        });

        // Mostrar a mensagem de registro
        const showRegistrationMessage = (registrationDate, trialEndDate) => {
            const startDate = new Date(registrationDate);
            const endDate = new Date(trialEndDate);

            registrationMessage.style.display = 'block';
            registrationMessage.innerHTML = `
                <h2>Usuário cadastrado!</h2>
                <p>Para realizar o login, verifique o seu e-mail.</p>
                <p>Este é o seu temporizador do período grátis de 3 dias.</p>
                <p>Ao esgotar, realize o pagamento para continuar utilizando nossos serviços.</p>
                <p>Seu período de teste começa em: ${startDate.toLocaleDateString()} às ${startDate.toLocaleTimeString()}</p>
                <p>Seu período de teste termina em: ${endDate.toLocaleDateString()} às ${endDate.toLocaleTimeString()}</p>
                <button id="closePopupButton">FECHAR</button>
            `;

            document.getElementById('closePopupButton').addEventListener('click', () => {
                window.location.href = HOME_URL; // Redirecionar para o início
            });

            startRedirect(endDate);
        };

        // Redirecionar após o término do período gratuito
        const startRedirect = (endDate) => {
            const now = new Date();
            const timeLeft = endDate - now;

            if (timeLeft <= 0) {
                window.location.href = REDIRECT_URL;
                return;
            }

            const interval = setInterval(() => {
                const now = new Date();
                const timeLeft = endDate - now;

                if (timeLeft <= 0) {
                    clearInterval(interval);
                    window.location.href = REDIRECT_URL;
                } else {
                    const days = Math.floor(timeLeft / (1000 * 60 * 60 * 24));
                    const hours = Math.floor((timeLeft % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                    const minutes = Math.floor((timeLeft % (1000 * 60 * 60)) / (1000 * 60));
                    const seconds = Math.floor((timeLeft % (1000 * 60)) / 1000);
                    
                    redirectTimer.textContent = `${days}d ${hours}h ${minutes}m ${seconds}s`;
                }
            }, 1000);
        };

        // Mostrar o pop-up de pagamento
        const showPaymentPopup = () => {
            paymentPopup.style.display = 'block';
            paymentNowButton.addEventListener('click', () => {
                window.location.href = PAYMENT_URL;
            });
        };

        // Manipular o clique no botão de reset de senha
        resetPasswordButton.addEventListener('click', async () => {
            const email = resetEmail.value;

            if (email === '') {
                handleError('resetError', 'Por favor, insira seu e-mail.');
            } else {
                try {
                    await sendPasswordResetEmail(auth, email);
                    resetError.style.display = 'none';
                    resetPasswordPopup.style.display = 'none';
                    alert('E-mail de recuperação enviado.');
                } catch (error) {
                    handleError('resetError', error.message);
                }
            }
        });

        // Fechar o pop-up de reset de senha
        closeResetPopup.addEventListener('click', () => {
            resetPasswordPopup.style.display = 'none';
        });

        // Adicionar logout
        logoutButton.addEventListener('click', async () => {
            await auth.signOut();
            window.location.href = HOME_URL; // Redirecionar após logout
        });

        // Mostrar status da assinatura
        const checkTrialOrSubscriptionStatus = (userData) => {
            const now = new Date();
            const trialEndDate = userData.trialEnd ? userData.trialEnd.toDate() : null;
            const subscriptionEndDate = userData.subscriptionEnd ? userData.subscriptionEnd.toDate() : null;

            if (subscriptionEndDate && subscriptionEndDate > now) {
                subscriptionStatus.textContent = `Assinatura ativa até ${subscriptionEndDate.toLocaleDateString()}.`;
                return true;
            } else if (trialEndDate && trialEndDate > now) {
                subscriptionStatus.textContent = `Período de teste ativo até ${trialEndDate.toLocaleDateString()}.`;
                return true;
            } else {
                subscriptionStatus.textContent = 'Seu período de teste ou assinatura expirou.';
                return false;
            }
        };

        // Manipulação de erros
        const handleError = (elementId, message) => {
            const element = document.getElementById(elementId);
            if (element) {
                element.style.display = 'block';
                element.textContent = message;
            }
        };
    } else {
        console.error('Alguns elementos DOM estão faltando.');
    }
});
