// Importa os módulos necessários do Firebase
import { initializeApp } from 'https://www.gstatic.com/firebasejs/9.19.1/firebase-app.js';
import { getAuth, createUserWithEmailAndPassword, signInWithEmailAndPassword, sendEmailVerification, sendPasswordResetEmail } from 'https://www.gstatic.com/firebasejs/9.19.1/firebase-auth.js';
import { getFirestore, doc, setDoc, getDoc } from 'https://www.gstatic.com/firebasejs/9.19.1/firebase-firestore.js';

// Configuração do Firebase
const firebaseConfig = {
    apiKey: "AIzaSyDQZRg62a84f8KkvfSbH9IkKCsBH-66Tz0",
    authDomain: "projeto-notificacao-968d4.firebaseapp.com",
    projectId: "projeto-notificacao-968d4",
    storageBucket: "projeto-notificacao-968d4.appspot.com",
    messagingSenderId: "236002612799",
    appId: "1:236002612799:web:54719603091421b94aca8a",
    measurementId: "G-KY69HG6ZNZ"
};

// Inicializa o Firebase
const app = initializeApp(firebaseConfig);
const auth = getAuth(app);
const db = getFirestore(app);

document.addEventListener('DOMContentLoaded', () => {
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
    const trialStatus = document.getElementById('trialStatus'); // Elemento para mostrar status do período de teste
    const registrationMessage = document.getElementById('registrationMessage'); // Mensagem de registro
    const resetPasswordButton = document.getElementById('resetPasswordButton');
    const resetPasswordPopup = document.getElementById('resetPasswordPopup');
    const resetEmail = document.getElementById('resetEmail');
    const resetError = document.getElementById('resetError');
    const closeResetPopup = document.getElementById('closeResetPopup');
    const subscriptionStatus = document.getElementById('subscriptionStatus'); // Novo elemento para o status da assinatura

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
            document.getElementById('loginError').style.display = 'block';
            document.getElementById('loginError').textContent = 'A senha deve ter pelo menos 6 caracteres.';
        } else {
            try {
                const userCredential = await signInWithEmailAndPassword(auth, email, password);
                const user = userCredential.user;
                const userDoc = doc(db, 'users', user.uid);
                const userSnapshot = await getDoc(userDoc);

                if (userSnapshot.exists()) {
                    const userData = userSnapshot.data();
                    const trialStartDate = new Date(userData.trialStartDate);
                    const trialEndDate = new Date(userData.trialEndDate);
                    const subscriptionEndDate = userData.subscriptionEndDate ? new Date(userData.subscriptionEndDate) : null;
                    const now = new Date();

                    const isTrialValid = now <= trialEndDate;
                    const isSubscriptionValid = subscriptionEndDate && now <= subscriptionEndDate;

                    // Mostrar status do período de teste
                    if (isTrialValid) {
                        trialStatus.style.display = 'block';
                        trialStatus.textContent = `Seu período de teste vai até: ${trialEndDate.toLocaleDateString()}`;
                    } else {
                        trialStatus.style.display = 'none';
                    }

                    // Mostrar status da assinatura
                    if (isSubscriptionValid) {
                        subscriptionStatus.style.display = 'block';
                        subscriptionStatus.textContent = `Sua assinatura é válida até: ${subscriptionEndDate.toLocaleDateString()}`;
                    } else {
                        subscriptionStatus.style.display = 'none';
                    }

                    if (isTrialValid || isSubscriptionValid) {
                        // Exibir o popup e iniciar o cronômetro se o período de teste estiver válido ou a assinatura estiver ativa
                        loginForm.style.display = 'none';
                        redirectPopup.style.display = 'block';
                        let countdown = Math.ceil((isTrialValid ? trialEndDate - now : subscriptionEndDate - now) / 1000); // Convert milliseconds to seconds
                        const countdownInterval = setInterval(() => {
                            countdown -= 1;
                            const hours = Math.floor(countdown / 3600);
                            const minutes = Math.floor((countdown % 3600) / 60);
                            const seconds = countdown % 60;
                            redirectTimer.textContent = `${hours}h ${minutes}m ${seconds}s`;
                            if (countdown <= 0) {
                                clearInterval(countdownInterval);
                                window.location.href = 'https://vaidebet.com/ptb/games/livecasino/detail/normal/18198/evol_TopCard000000001_BRL'; // Alterar o link conforme necessário
                            }
                        }, 1000);

                        // Redirecionar após o clique no botão do popup
                        redirectNowButton.addEventListener('click', () => {
                            window.location.href = 'https://vaidebet.com/ptb/games/livecasino/detail/normal/18198/evol_TopCard000000001_BRL'; // Alterar o link conforme necessário
                        });
                    } else {
                        // Trial period and subscription both have expired
                        trialStatus.style.display = 'block';
                        trialStatus.textContent = 'Seu período de teste expirou. Por favor, faça o pagamento para continuar.';
                        paymentButton.style.display = 'block';
                        paymentButton.addEventListener('click', () => {
                            window.location.href = 'https://yampi.com.br/'; // Alterar para o link de pagamento
                        });
                    }
                } else {
                    console.error('No user data found');
                }
            } catch (error) {
                document.getElementById('loginError').style.display = 'block';
                document.getElementById('loginError').textContent = error.message;
            }
        }
    });

    // Manipular o clique no botão de cadastro
    registerButton.addEventListener('click', async () => {
        const name = document.getElementById('registerName').value;
        const email = document.getElementById('registerEmail').value;
        const password = document.getElementById('registerPassword').value;
        if (name === '' || email === '' || password === '' || password.length < 6) {
            document.getElementById('registerError').style.display = 'block';
            document.getElementById('registerError').textContent = 'Por favor, preencha todos os campos corretamente.';
        } else {
            try {
                const userCredential = await createUserWithEmailAndPassword(auth, email, password);
                const user = userCredential.user;
                const trialStartDate = new Date();
                const trialEndDate = new Date(trialStartDate.getTime() + 3 * 24 * 60 * 60 * 1000); // Adiciona 3 dias

                await setDoc(doc(db, 'users', user.uid), {
                    name: name,
                    email: email,
                    trialStartDate: trialStartDate.toISOString(), // Save the current date and time as trial start date
                    trialEndDate: trialEndDate.toISOString(), // Save the calculated end date for the trial
                    subscriptionEndDate: null // Inicialmente, sem assinatura
                });
                document.getElementById('registerError').style.display = 'none';
                registerForm.style.display = 'none';
                // Enviar e-mail de verificação
                await sendEmailVerification(user);
                registrationMessage.style.display = 'block';
                registrationMessage.innerHTML = `
                    Cadastro realizado!<br>
                    Para começar, verifique seu e-mail para concluir o processo de login. Você tem um período de teste gratuito de 3 dias, e o temporizador abaixo mostra o tempo restante. Após o período de teste, realize o pagamento de R$20 para continuar acessando nossos serviços.<br><br>
                    <button id="startButton">Iniciar</button>
                `;

                document.getElementById('startButton').addEventListener('click', () => {
                    window.location.href = 'https://vaidebet.com/ptb/games/livecasino/detail/normal/18198/evol_TopCard000000001_BRL'; // Alterar o link conforme necessário
                });

                // Exibir o temporizador de teste
                let countdown = Math.ceil((trialEndDate - trialStartDate) / 1000); // Convert milliseconds to seconds
                const countdownInterval = setInterval(() => {
                    countdown -= 1;
                    const hours = Math.floor(countdown / 3600);
                    const minutes = Math.floor((countdown % 3600) / 60);
                    const seconds = countdown % 60;
                    registrationMessage.innerHTML += `<br>${hours}h ${minutes}m ${seconds}s restantes.`;
                    if (countdown <= 0) {
                        clearInterval(countdownInterval);
                        registrationMessage.innerHTML += '<br>Seu período de teste expirou.';
                    }
                }, 1000);
            } catch (error) {
                document.getElementById('registerError').style.display = 'block';
                document.getElementById('registerError').textContent = error.message;
            }
        }
    });

    // Manipular o clique no botão de recuperação de senha
    resetPasswordButton.addEventListener('click', async () => {
        const email = resetEmail.value;
        if (email === '') {
            resetError.style.display = 'block';
            resetError.textContent = 'Por favor, insira seu e-mail.';
        } else {
            try {
                await sendPasswordResetEmail(auth, email);
                resetError.style.display = 'none';
                resetPasswordPopup.style.display = 'none';
                alert('E-mail de redefinição de senha enviado.');
            } catch (error) {
                resetError.style.display = 'block';
                resetError.textContent = error.message;
            }
        }
    });

    // Fechar o popup de recuperação de senha
    closeResetPopup.addEventListener('click', () => {
        resetPasswordPopup.style.display = 'none';
    });

    // Fechar o popup de redirecionamento e exibir a tela de login novamente
    document.getElementById('closePopup').addEventListener('click', () => {
        redirectPopup.style.display = 'none';
        loginForm.style.display = 'flex'; // Mostrar a tela de login novamente
    });
});
