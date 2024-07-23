// Importando Firebase
import { initializeApp } from "https://www.gstatic.com/firebasejs/9.0.0/firebase-app.js";
import { getFirestore, doc, setDoc, getDoc } from "https://www.gstatic.com/firebasejs/9.0.0/firebase-firestore.js";
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

// Alterna para o formulário de cadastro
function switchToRegister() {
    document.querySelector('#loginForm').style.display = 'none';
    document.querySelector('#registerForm').style.display = 'block';
    document.querySelector('#paymentButton').style.display = 'none';
    document.querySelector('#loginToggleText').style.display = 'none';
    document.querySelector('#registerToggleText').style.display = 'block';
}

// Alterna para o formulário de login
function switchToLogin() {
    document.querySelector('#registerForm').style.display = 'none';
    document.querySelector('#loginForm').style.display = 'block';
    document.querySelector('#paymentButton').style.display = 'block';
    document.querySelector('#registerToggleText').style.display = 'none';
    document.querySelector('#loginToggleText').style.display = 'block';
}

// Atualiza o contador de período gratuito
function updateTrialPeriod(startDate) {
    const trialPeriodDays = 7; // Exemplo de 7 dias de teste gratuito
    const endDate = new Date(startDate);
    endDate.setDate(endDate.getDate() + trialPeriodDays);

    const interval = setInterval(() => {
        const now = new Date();
        const timeLeft = endDate - now;
        if (timeLeft <= 0) {
            clearInterval(interval);
            document.querySelector('#timer').innerHTML = 'Seu período de teste acabou.';
            document.querySelector('#redirectButton').style.display = 'block';
            return;
        }

        const days = Math.floor(timeLeft / (1000 * 60 * 60 * 24));
        const hours = Math.floor((timeLeft % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        const minutes = Math.floor((timeLeft % (1000 * 60 * 60)) / (1000 * 60));
        const seconds = Math.floor((timeLeft % (1000 * 60)) / 1000);

        document.querySelector('#timer').innerHTML = `Tempo restante: ${days}d ${hours}h ${minutes}m ${seconds}s`;
    }, 1000);
}

// Event listeners para alternar entre login e cadastro
document.addEventListener('DOMContentLoaded', function() {
    document.querySelector('#loginLink')?.addEventListener('click', function(e) {
        e.preventDefault();
        switchToLogin();
    });

    document.querySelector('#registerLink')?.addEventListener('click', function(e) {
        e.preventDefault();
        switchToRegister();
    });

    document.querySelector('#loginButton')?.addEventListener('click', async function() {
        const userEmail = document.querySelector('#loginEmail').value;
        const userPassword = document.querySelector('#loginPassword').value;

        if (userPassword.length < 6) {
            document.querySelector('#loginError').style.display = 'block';
            return;
        }

        try {
            const userCredential = await signInWithEmailAndPassword(auth, userEmail, userPassword);
            const userDoc = await getDoc(doc(db, 'users', userEmail));
            const userData = userDoc.data();

            if (userData) {
                const { trialStartDate } = userData;
                if (trialStartDate) {
                    updateTrialPeriod(new Date(trialStartDate));
                }
            }
            document.querySelector('#welcome-message').textContent = 'Bem-vindo(a)!';
            document.querySelector('#timer').style.display = 'block';
            document.querySelector('#buttons').style.display = 'block';
        } catch (error) {
            console.error(error.message);
        }
    });

    document.querySelector('#registerButton')?.addEventListener('click', async function() {
        const userName = document.querySelector('#registerName').value;
        const userEmail = document.querySelector('#registerEmail').value;
        const userPassword = document.querySelector('#registerPassword').value;

        if (userPassword.length < 6) {
            document.querySelector('#registerError').style.display = 'block';
            return;
        }

        try {
            await createUserWithEmailAndPassword(auth, userEmail, userPassword);
            await setDoc(doc(db, 'users', userEmail), { 
                name: userName,
                trialStartDate: new Date().toISOString()
            });

            // Mostrar contador de tempo gratuito antes de redirecionar
            document.querySelector('#timer').style.display = 'block';
            updateTrialPeriod(new Date());

            setTimeout(() => {
                window.location.href = 'https://botmillion.github.io/telm/';
            }, 5000); // Atraso de 5 segundos para mostrar o contador
        } catch (error) {
            console.error(error.message);
        }
    });
});
