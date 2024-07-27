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
const PAYMENT_URL = 'https://yampi.com.br/';
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
    if (loginForm && registerForm && loginLink && registerLink && loginButton && registerButton && paymentButton && redirectPopup && redirectTimer && redirectNowButton && trialStatus && registrationMessage && resetPasswordButton && resetPasswordPopup && resetEmail && resetError && closeResetPopup && subscriptionStatus && closePopupButton && paymentPopup && paymentNowButton) {
        
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
                                startRedirect(userData.subscriptionEndDate || userData.trialEndDate);
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

        // Verificar status de teste ou pagamento
        const checkTrialOrSubscriptionStatus = (userData) => {
            const now = new Date();
            const trialEndDate = userData.trialEndDate ? new Date(userData.trialEndDate.toDate()) : null;
            const subscriptionEndDate = userData.subscriptionEndDate ? new Date(userData.subscriptionEndDate.toDate()) : null;

            const isTrialValid = trialEndDate && now <= trialEndDate;
            const isSubscriptionValid = subscriptionEndDate && now <= subscriptionEndDate;

            return isTrialValid || isSubscriptionValid;
        };

        // Iniciar redirecionamento após login
        const startRedirect = (endDate) => {
            loginForm.style.display = 'none';
            redirectPopup.style.display = 'block';

            const updateTimer = () => {
                const distance = formatDistanceToNow(new Date(endDate), { addSuffix: true });
                redirectTimer.textContent = distance;
            };

            const countdownInterval = setInterval(() => {
                updateTimer();
                if (new Date() >= endDate) {
                    clearInterval(countdownInterval);
                    window.location.href = REDIRECT_URL;
                }
            }, 1000);

            redirectNowButton.addEventListener('click', () => {
                window.location.href = REDIRECT_URL;
            });
        };

        // Mostrar popup de pagamento
        const showPaymentPopup = () => {
            paymentPopup.style.display = 'block';
            paymentNowButton.addEventListener('click', () => {
                window.location.href = PAYMENT_URL;
            });
        };

        // Mostrar erro
        const handleError = (elementId, message) => {
            const element = document.getElementById(elementId);
            if (element) {
                element.style.display = 'block';
                element.textContent = message;
            }
        };

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
                    const trialStartDate = new Date();
                    const trialEndDate = addDays(trialStartDate, 3);

                    await setDoc(doc(db, 'users', user.uid), {
                        name: name,
                        email: email,
                        trialStartDate: Timestamp.fromDate(trialStartDate),
                        trialEndDate: Timestamp.fromDate(trialEndDate),
                        subscriptionEndDate: null,
                        paymentStatus: 'unpaid' // Define status de pagamento como não pago
                    });

                    // Enviar e-mail de verificação
                    await sendEmailVerification(user);

                    document.getElementById('registerError').style.display = 'none';
                    registerForm.style.display = 'none';
                    showRegistrationMessage(trialStartDate, trialEndDate);
                } catch (error) {
                    handleError('registerError', error.message);
                }
            }
        });

        // Mostrar mensagem de cadastro
        const showRegistrationMessage = (trialStartDate, trialEndDate) => {
            registrationMessage.style.display = 'block';
            registrationMessage.innerHTML = `
                <h2>Usuário cadastrado!</h2>
                <p>Para realizar o login, verifique o seu e-mail.</p>
                <p>Este é o seu temporizador do período grátis de 3 dias.</p>
                <p>Ao esgotar, realize o pagamento para continuar utilizando nossos serviços.</p>
                <p>Seu período de teste termina em: ${trialEndDate.toLocaleDateString()} às ${trialEndDate.toLocaleTimeString()}</p>
                <button id="closePopupButton">FECHAR</button>
            `;

            document.getElementById('closePopupButton').addEventListener('click', () => {
                window.location.href = HOME_URL;
            });

            startRedirect(trialEndDate);
        };

        // Manipular o clique no botão de redefinir senha
        const isValidEmail = (email) => /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email);

        resetPasswordButton.addEventListener('click', async () => {
            const email = resetEmail.value;

            if (!isValidEmail(email)) {
                resetError.textContent = 'Por favor, insira um e-mail válido.';
            } else {
                try {
                    await sendPasswordResetEmail(auth, email);
                    resetError.textContent = '';
                    resetPasswordPopup.style.display = 'none';
                    alert('Enviamos um e-mail para redefinir a senha.');
                } catch (error) {
                    resetError.textContent = error.message;
                }
            }
        });

        // Fechar popup de redefinição de senha
        closeResetPopup.addEventListener('click', () => {
            resetPasswordPopup.style.display = 'none';
        });

        // Manipular o clique no botão de logout
        logoutButton.addEventListener('click', () => {
            auth.signOut().then(() => {
                window.location.href = HOME_URL;
            }).catch((error) => {
                console.error('Erro ao fazer logout:', error.message);
            });
        });

        // Manipular a visualização do status de assinatura
        subscriptionStatus.addEventListener('click', async () => {
            try {
                const user = auth.currentUser;
                if (user) {
                    const userDoc = doc(db, 'users', user.uid);
                    const userSnapshot = await getDoc(userDoc);
                    
                    if (userSnapshot.exists()) {
                        const userData = userSnapshot.data();
                        const now = new Date();
                        const subscriptionEndDate = userData.subscriptionEndDate ? new Date(userData.subscriptionEndDate.toDate()) : null;

                        if (subscriptionEndDate && now <= subscriptionEndDate) {
                            subscriptionStatus.textContent = 'Assinatura ativa até ' + subscriptionEndDate.toLocaleDateString();
                        } else {
                            subscriptionStatus.textContent = 'Assinatura expirada ou não ativa';
                        }
                    } else {
                        console.error('Dados do usuário não encontrados.');
                    }
                } else {
                    console.error('Nenhum usuário logado.');
                }
            } catch (error) {
                console.error('Erro ao buscar status de assinatura:', error.message);
            }
        });

        // Exibir popup de pagamento
        paymentButton.addEventListener('click', () => {
            paymentPopup.style.display = 'block';
        });

        // Fechar popup de pagamento
        closePopupButton.addEventListener('click', () => {
            paymentPopup.style.display = 'none';
        });
    }
});
