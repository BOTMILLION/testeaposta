// Importando Firebase
import { getFirestore, doc, setDoc } from "https://www.gstatic.com/firebasejs/9.0.0/firebase-firestore.js";
import { getAuth, createUserWithEmailAndPassword } from "https://www.gstatic.com/firebasejs/9.0.0/firebase-auth.js";

const db = getFirestore();
const auth = getAuth();

window.onload = () => {
    // Solicita o email e o nome de usuário ao carregar a página
    const userEmail = localStorage.getItem('userEmail');
    const userName = localStorage.getItem('userName');
    
    if (userEmail && userName) {
        // Se já estiver logado, inicia o temporizador
        document.getElementById('welcome-message').textContent = `Oi, ${userName}, vamos ganhar dinheiro hoje? 🤑`;
        startTrialTimer();
        document.getElementById('buttons').style.display = 'block';
    } else {
        // Caso contrário, mostra os campos de entrada
        document.getElementById('submitUserInfo').style.display = 'block';
    }
};

document.getElementById('submitUserInfo').addEventListener('click', async function() {
    const userName = document.getElementById('userName').value;
    const userEmail = document.getElementById('userEmail').value;
    
    if (userName && userEmail) {
        localStorage.setItem('userName', userName);
        localStorage.setItem('userEmail', userEmail);

        // Verifica se o tempo de teste já foi definido
        if (!localStorage.getItem('trialEndTime_' + userEmail)) {
            // Define o tempo de teste (1 semana)
            const trialDuration = 7 * 24 * 60 * 60 * 1000; // 1 semana em milissegundos
            const trialEndTime = new Date().getTime() + trialDuration;
            localStorage.setItem('trialEndTime_' + userEmail, new Date(trialEndTime).toISOString());
        }

        // Chama a função de registro
        await registerUser(userEmail, userName);
    }
});

async function registerUser(email, userName) {
    console.log("Tentando registrar o usuário:", userName, "com email:", email);

    // Cria um usuário com email e senha
    try {
        const userCredential = await createUserWithEmailAndPassword(auth, email, "senhaSegura"); // Substitua "senhaSegura" por uma senha gerada ou por um valor que você escolher
        const user = userCredential.user;
        const trialEnd = new Date(Date.now() + 7 * 24 * 60 * 60 * 1000); // 1 semana

        // Armazena os dados do usuário no Firestore
        await setDoc(doc(db, 'users', user.uid), {
            email: email,
            name: userName,
            trialEnd: trialEnd
        });

        document.getElementById('welcome-message').innerText = `Oi, ${userName}! Vamos ganhar dinheiro hoje? 🤑`;
        startTrialTimer();
        document.getElementById('buttons').style.display = 'block';
    } catch (error) {
        console.error("Erro ao registrar:", error);
        alert("Erro ao registrar: " + error.message);
    }
}

function startTrialTimer() {
    const userEmail = localStorage.getItem('userEmail');
    const trialEndTime = new Date(localStorage.getItem('trialEndTime_' + userEmail)).getTime();

    const timerElement = document.getElementById('timer');
    timerElement.style.display = 'block';

    const interval = setInterval(() => {
        const now = new Date().getTime();
        const remainingTime = trialEndTime - now;

        if (remainingTime <= 0) {
            clearInterval(interval);
            timerElement.textContent = "Seu período de teste terminou!";
            localStorage.removeItem('trialEndTime_' + userEmail); // Remove o tempo de teste após o término
        } else {
            const days = Math.floor(remainingTime / (1000 * 60 * 60 * 24));
            const hours = Math.floor((remainingTime % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            const minutes = Math.floor((remainingTime % (1000 * 60 * 60)) / (1000 * 60));
            const seconds = Math.floor((remainingTime % (1000 * 60)) / 1000);
            timerElement.textContent = `Tempo restante: ${days}d ${hours}h ${minutes}m ${seconds}s`;
        }
    }, 1000);
}
