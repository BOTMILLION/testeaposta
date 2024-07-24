// Importa os módulos necessários do Firebase
import { initializeApp } from 'https://www.gstatic.com/firebasejs/9.19.1/firebase-app.js';
import { getAuth, createUserWithEmailAndPassword, signInWithEmailAndPassword, sendEmailVerification } from 'https://www.gstatic.com/firebasejs/9.19.1/firebase-auth.js';
import { getFirestore, doc, setDoc, getDoc, updateDoc } from 'https://www.gstatic.com/firebasejs/9.19.1/firebase-firestore.js';

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
    const subscriptionStatus = document.getElementById('subscriptionStatus'); // Elemento para mostrar status da assinatura

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
                    const subscriptionEndDate = userData.subscriptionEndDate ? new Date(userData.subscriptionEndDate) : null;
                    const now = new Date();
                    const trialPeriodDays = 3;
                    const trialEndDate = new Date(trialStartDate);
                    trialEndDate.setDate(trialEndDate.getDate() + trialPeriodDays);

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
                            redirectTimer.textContent = Math.ceil(countdown);
                            if (countdown <= 0) {
                                clearInterval(countdownInterval);
                                window.location.href = 'https://botmillion.github.io/telm/'; // Alterar o link conforme necessário
                            }
                        }, 1000);

                        // Redirecionar após o clique no botão do popup
                        redirectNowButton.addEventListener('click', () => {
                            window.location.href = 'https://botmillion.github.io/telm/'; // Alterar o link conforme necessário
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
                await setDoc(doc(db, 'users', user.uid), {
                    name: name,
                    email: email,
                    trialStartDate: new Date().toISOString(), // Save the current date and time as trial start date
                    subscriptionEndDate: null // Inicialmente, sem assinatura
                });
                document.getElementById('registerError').style.display = 'none';
                registerForm.style.display = 'none';
                // Enviar e-mail de verificação
                await sendEmailVerification(user);
                document.getElementById('registrationMessage').style.display = 'block';
                document.getElementById('registrationMessage').textContent = 'Por favor, verifique seu e-mail.';
            } catch (error) {
                document.getElementById('registerError').style.display = 'block';
                document.getElementById('registerError').textContent = error.message;
            }
        }
    });

    // Função para adicionar 30 dias à assinatura após o pagamento
    async function addSubscriptionDays(userId) {
        const userDoc = doc(db, 'users', userId);
        const userSnapshot = await getDoc(userDoc);

        if (userSnapshot.exists()) {
            const userData = userSnapshot.data();
            const now = new Date();
            const newSubscriptionEndDate = userData.subscriptionEndDate
                ? new Date(userData.subscriptionEndDate)
                : now;
            newSubscriptionEndDate.setDate(newSubscriptionEndDate.getDate() + 30); // Adiciona 30 dias

            await updateDoc(userDoc, {
                subscriptionEndDate: newSubscriptionEndDate.toISOString()
            });
            console.log('Subscription extended by 30 days');
        }
    }
});
