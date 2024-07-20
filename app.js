// Configuração do Firebase
import firebase from 'https://www.gstatic.com/firebasejs/9.6.7/firebase-app.js';
import 'https://www.gstatic.com/firebasejs/9.6.7/firebase-auth.js';
import 'https://www.gstatic.com/firebasejs/9.6.7/firebase-firestore.js';

// Sua configuração do Firebase
const firebaseConfig = {
    apiKey: "AIzaSyCKw5ZcJBcTvf1onPtkzgvJqlRAsbUqauk",
    authDomain: "robo-7937c.firebaseapp.com",
    projectId: "robo-7937c",
    storageBucket: "robo-7937c.appspot.com",
    messagingSenderId: "444396924434",
    appId: "1:444396924434:web:46b93323f9c22d90ac32cb",
    measurementId: "G-G4NYL1GXGW"
};

// Inicialize o Firebase
firebase.initializeApp(firebaseConfig);
const auth = firebase.auth();
const firestore = firebase.firestore();

document.getElementById('loginButton').addEventListener('click', async () => {
    const email = document.getElementById('userEmail').value;
    const password = document.getElementById('userPassword').value;

    try {
        await auth.signInWithEmailAndPassword(email, password);
        alert('Login bem-sucedido!');
        window.location.href = "https://afternoon-shelf-67854-a24479d38529.herokuapp.com"; // Redirecionar após login
    } catch (error) {
        alert("Erro ao fazer login: " + error.message);
    }
});

document.getElementById('registerLink').addEventListener('click', async () => {
    const email = document.getElementById('userEmail').value;
    const password = document.getElementById('userPassword').value;

    if (password.length < 6) {
        document.getElementById('error-message').style.display = 'block';
        return;
    }

    try {
        const userCredential = await auth.createUserWithEmailAndPassword(email, password);
        const user = userCredential.user;

        // Enviar e-mail de verificação
        await user.sendEmailVerification();
        console.log("Usuário registrado com sucesso. E-mail de verificação enviado.");

        // Atualiza a mensagem de boas-vindas
        document.getElementById('welcome-message').textContent = `Bem-vindo, ${email}! Verifique seu e-mail para ativar sua conta.`;

        // Exibir mensagem de confirmação
        document.getElementById('confirmation-message').style.display = 'block';
    } catch (error) {
        console.error("Erro ao registrar:", error);
        alert("Erro ao registrar: " + error.message);
    }
});

function startTrialTimer(userEmail, trialEndTime) {
    const timerElement = document.getElementById('timer');
    const updateTimer = () => {
        const now = new Date();
        const timeLeft = trialEndTime - now;
        
        if (timeLeft <= 0) {
            timerElement.textContent = "Seu período de teste expirou.";
            clearInterval(intervalId);
        } else {
            const days = Math.floor(timeLeft / (1000 * 60 * 60 * 24));
            const hours = Math.floor((timeLeft % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            const minutes = Math.floor((timeLeft % (1000 * 60 * 60)) / (1000 * 60));
            const seconds = Math.floor((timeLeft % (1000 * 60)) / 1000);
            
            timerElement.textContent = `Tempo restante: ${days}d ${hours}h ${minutes}m ${seconds}s`;
        }
    };
    
    updateTimer(); // Atualiza imediatamente
    const intervalId = setInterval(updateTimer, 1000); // Atualiza a cada segundo
}
