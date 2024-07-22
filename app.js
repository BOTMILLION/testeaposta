// Importando Firebase
import { initializeApp } from "https://www.gstatic.com/firebasejs/9.0.0/firebase-app.js";
import { getFirestore, doc, setDoc } from "https://www.gstatic.com/firebasejs/9.0.0/firebase-firestore.js";
import { getAuth, createUserWithEmailAndPassword, signInWithEmailAndPassword } from "https://www.gstatic.com/firebasejs/9.0.0/firebase-auth.js";

// Configuração do Firebase
const firebaseConfig = {
    apiKey: "AIzaSyCKw5ZcJBcTvf1onPtkzgvJqlRAsbUqauk",
    authDomain: "robo-7937c.firebaseapp.com",
    projectId: "robo-7937c",
    storageBucket: "robo-7937c.appspot.com",
    messagingSenderId: "444396924434",
    appId: "1:444396924434:web:46b93323f9c22d90ac32cb"
};

// Inicializa o Firebase
const app = initializeApp(firebaseConfig);
const db = getFirestore(app);
const auth = getAuth(app);

// Alterna entre login e registro
function switchToRegister() {
    document.querySelector('.container').innerHTML = `
        <h1>Cadastro</h1>
        <input type="text" id="userName" placeholder="Seu Nome" required>
        <input type="email" id="userEmail" placeholder="Seu Email" required>
        <input type="password" id="userPassword" placeholder="Sua Senha" required>
        <div id="error-message" style="display: none;">A senha deve ter pelo menos 6 caracteres.</div>
        <button class="custom-button" id="registerButton">CADASTRAR</button>
        <span class="info-text">Já tem uma conta? <a href="#" id="loginLink">Login</a></span>
    `;
}

function switchToLogin() {
    document.querySelector('.container').innerHTML = `
        <h1>Faça Login</h1>
        <input type="email" id="userEmail" placeholder="Seu Email" required>
        <input type="password" id="userPassword" placeholder="Sua Senha" required>
        <div id="error-message" style="display: none;">A senha deve ter pelo menos 6 caracteres.</div>
        <button class="custom-button" id="loginButton">LOGIN</button>
        <span class="info-text">Não tem uma conta? <a href="#" id="registerLink">Cadastre-se</a></span>
        <button class="custom-button pulse-button" id="paymentButton" onclick="window.location.href='https://checkout.yampi.com/checkout-link-seu-produto'">Realizar Pagamento</button>
    `;
}

document.addEventListener('DOMContentLoaded', function() {
    document.querySelector('#loginLink')?.addEventListener('click', function() {
        switchToRegister();
    });

    document.querySelector('#registerLink')?.addEventListener('click', function() {
        switchToLogin();
    });

    document.querySelector('#loginButton')?.addEventListener('click', async function() {
        const userEmail = document.querySelector('#userEmail').value;
        const userPassword = document.querySelector('#userPassword').value;

        if (userPassword.length < 6) {
            document.querySelector('#error-message').style.display = 'block';
            return;
        }

        try {
            await signInWithEmailAndPassword(auth, userEmail, userPassword);
            document.querySelector('#welcome-message').textContent = 'Bem-vindo(a)!';
            document.querySelector('#timer').style.display = 'block';
            document.querySelector('#buttons').style.display = 'block';
        } catch (error) {
            console.error(error.message);
        }
    });

    document.querySelector('#registerButton')?.addEventListener('click', async function() {
        const userName = document.querySelector('#userName').value;
        const userEmail = document.querySelector('#userEmail').value;
        const userPassword = document.querySelector('#userPassword').value;

        if (userPassword.length < 6) {
            document.querySelector('#error-message').style.display = 'block';
            return;
        }

        try {
            await createUserWithEmailAndPassword(auth, userEmail, userPassword);
            await setDoc(doc(db, 'users', userEmail), { name: userName });
            switchToLogin();
        } catch (error) {
            console.error(error.message);
        }
    });
});
