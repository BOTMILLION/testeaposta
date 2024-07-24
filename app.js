// Importar as funções necessárias do SDK do Firebase
import { initializeApp } from 'firebase/app';
import { getAuth, signInWithEmailAndPassword, createUserWithEmailAndPassword, sendEmailVerification } from 'firebase/auth';
import { getFirestore, doc, setDoc } from 'firebase/firestore';

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

// Inicializar o Firebase
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
    const registrationMessage = document.getElementById('registrationMessage');
    const loginErrorMessage = document.getElementById('loginError');

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
            loginErrorMessage.style.display = 'block';
            loginErrorMessage.textContent = 'A senha deve ter pelo menos 6 caracteres.';
        } else {
            try {
                const userCredential = await signInWithEmailAndPassword(auth, email, password);
                const user = userCredential.user;

                // Verificar se o e-mail do usuário foi verificado
                if (user.emailVerified) {
                    const userDoc = doc(db, 'users', user.uid);
                    const userSnapshot = await getDoc(userDoc);

                    if (userSnapshot.exists()) {
                        const userData = userSnapshot.data();
                        const trialStartDate = new Date(userData.trialStartDate);
                        const now = new Date();
                        const trialPeriodDays = 3;
                        const trialEndDate = new Date(trialStartDate);
                        trialEndDate.setDate(trialEndDate.getDate() + trialPeriodDays);

                        if (now <= trialEndDate) {
                            // User is within the trial period
                            loginForm.style.display = 'none';
                            // Exibir o popup e iniciar o cronômetro
                            redirectPopup.style.display = 'block';
                            let countdown = 5;
                            const countdownInterval = setInterval(() => {
                                countdown -= 1;
                                redirectTimer.textContent = countdown;
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
                            // Trial period has expired
                            alert('Seu período de teste expirou. Por favor, faça o pagamento para continuar.');
                            window.location.href = 'payment.html'; // Redirecionar para a página de pagamento
                        }
                    } else {
                        console.error('No user data found');
                    }
                } else {
                    // Email not verified
                    loginErrorMessage.style.display = 'block';
                    loginErrorMessage.textContent = 'Por favor, verifique seu email antes de fazer login.';
                }
            } catch (error) {
                loginErrorMessage.style.display = 'block';
                loginErrorMessage.textContent = error.message;
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
            document.getElementById('registerError').textContent = 'Todos os campos são obrigatórios e a senha deve ter pelo menos 6 caracteres.';
        } else {
            try {
                const userCredential = await createUserWithEmailAndPassword(auth, email, password);
                const user = userCredential.user;
                await setDoc(doc(db, 'users', user.uid), {
                    name: name,
                    email: email,
                    trialStartDate: new Date().toISOString()
                });

                // Enviar e-mail de verificação
                await sendEmailVerification(user);

                // Exibir mensagem de sucesso e instruções
                registrationMessage.style.display = 'block';
                registrationMessage.textContent = 'Cadastro realizado com sucesso! Verifique seu e-mail para confirmar o registro.';
                registrationMessage.style.color = 'green'; // Ajuste a cor da mensagem se necessário

            } catch (error) {
                registrationMessage.style.display = 'block';
                registrationMessage.textContent = error.message;
                registrationMessage.style.color = 'red'; // Ajuste a cor da mensagem se necessário
            }
        }
    });

    // Mostrar o botão de pagamento assim que a página carrega
    paymentButton.style.display = 'block';
    // Reiniciar a animação do botão de pagamento
    paymentButton.classList.remove('pulse-button');
    void paymentButton.offsetWidth; // Forçar reflow
    paymentButton.classList.add('pulse-button');
});
