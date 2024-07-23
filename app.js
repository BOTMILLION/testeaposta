// Importar os módulos do Firebase
import { initializeApp } from 'https://www.gstatic.com/firebasejs/9.18.0/firebase-app.js';
import { getAuth, signInWithEmailAndPassword, createUserWithEmailAndPassword } from 'https://www.gstatic.com/firebasejs/9.18.0/firebase-auth.js';
import { getFirestore } from 'https://www.gstatic.com/firebasejs/9.18.0/firebase-firestore.js';

// Configuração do Firebase
const firebaseConfig = {
            apiKey: "AIzaSyAtaTalveibqyUVnO33QhHz-sGYzO4PkWk",
            authDomain: "robo3-686ff.firebaseapp.com",
            projectId: "robo3-686ff",
            storageBucket: "robo3-686ff.appspot.com",
            messagingSenderId: "1035908255814",
            appId: "1:1035908255814:web:4a5fc9c91325aa6fe33a47"
};

// Inicializa o Firebase
const app = initializeApp(firebaseConfig);
const auth = getAuth(app);
const firestore = getFirestore(app);

// Função para lidar com o login
document.addEventListener('DOMContentLoaded', () => {
    const loginForm = document.getElementById('loginForm');
    const registerForm = document.getElementById('registerForm');
    const loginLink = document.getElementById('loginLink');
    const registerLink = document.getElementById('registerLink');
    const loginButton = document.getElementById('loginButton');
    const registerButton = document.getElementById('registerButton');
    const paymentButton = document.getElementById('paymentButton');
    const redirectPopup = document.getElementById('redirectPopup');
    const countdownElement = document.getElementById('countdown');
    const redirectButton = document.getElementById('redirectButton');

    // Mostrar o formulário de cadastro
    registerLink.addEventListener('click', (event) => {
        event.preventDefault();
        loginForm.style.display = 'none';
        registerForm.style.display = 'block';
    });

    // Mostrar o formulário de login
    loginLink.addEventListener('click', (event) => {
        event.preventDefault();
        registerForm.style.display = 'none';
        loginForm.style.display = 'block';
    });

    // Manipular o clique no botão de login
    loginButton.addEventListener('click', () => {
        const email = document.getElementById('loginEmail').value;
        const password = document.getElementById('loginPassword').value;
        if (password.length < 6) {
            document.getElementById('loginError').style.display = 'block';
        } else {
            document.getElementById('loginError').style.display = 'none';
            // Função de login
            signInWithEmailAndPassword(auth, email, password)
                .then(() => {
                    loginForm.style.display = 'none';
                    // Exibir o popup e iniciar o cronômetro
                    redirectPopup.style.display = 'block';
                    let countdown = 5;
                    const countdownInterval = setInterval(() => {
                        countdown -= 1;
                        countdownElement.textContent = countdown;
                        if (countdown <= 0) {
                            clearInterval(countdownInterval);
                        }
                    }, 1000);

                    // Redirecionar após o clique no botão do popup
                    redirectButton.addEventListener('click', () => {
                        window.location.href = 'https://botmillion.github.io/telm/';
                    });
                })
                .catch((error) => {
                    console.error('Erro de login', error);
                });
        }
    });

    // Manipular o clique no botão de cadastro
    registerButton.addEventListener('click', () => {
        const name = document.getElementById('registerName').value;
        const email = document.getElementById('registerEmail').value;
        const password = document.getElementById('registerPassword').value;
        if (password.length < 6) {
            document.getElementById('registerError').style.display = 'block';
        } else {
            document.getElementById('registerError').style.display = 'none';
            // Função de registro
            createUserWithEmailAndPassword(auth, email, password)
                .then(() => {
                    registerForm.style.display = 'none';
                    // Mensagem de confirmação após o cadastro
                    setTimeout(() => {
                        alert('Cadastro realizado com sucesso!');
                    }, 500);
                })
                .catch((error) => {
                    console.error('Erro de cadastro', error);
                });
        }
    });

    // Mostrar o botão de pagamento assim que a página carrega
    paymentButton.style.display = 'block';
    // Reiniciar a animação do botão de pagamento
    paymentButton.classList.remove('pulse-button');
    void paymentButton.offsetWidth; // Forçar reflow
    paymentButton.classList.add('pulse-button');
});
