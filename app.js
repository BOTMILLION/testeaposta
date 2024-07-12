// Importando Firebase
import { getFirestore, doc, setDoc, getDoc } from "https://www.gstatic.com/firebasejs/9.0.0/firebase-firestore.js";
import { getAuth, createUserWithEmailAndPassword, signInWithEmailAndPassword } from "https://www.gstatic.com/firebasejs/9.0.0/firebase-auth.js";

// Inicializar Firebase
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
    const userEmail = document.getElementById('userEmail').value;
    const userPassword = document.getElementById('userPassword').value;

    if (userEmail && userPassword) {
        localStorage.setItem('userEmail', userEmail);

        // Verifica se o usuário já existe
        try {
            const userCredential = await signInWithEmailAndPassword(auth, userEmail, userPassword);
            const user = userCredential.user;

            // Recupera o nome do usuário do Firestore
            const userDoc = await getDoc(doc(db, 'users', user.uid));
            const userName = userDoc.data().name;
            localStorage.setItem('userName', userName);

            // Atualiza a mensagem de boas-vindas
            document.getElementById('welcome-message').textContent = `Oi, ${userName}, vamos ganhar dinheiro hoje? 🤑`;

            // Começa o temporizador
            startTrialTimer();

            // Exibe os botões
            document.getElementById('buttons').style.display = 'block';
        } catch (error) {
            if (error.code === 'auth/user-not-found') {
                // Se o usuário não existir, tenta registrá-lo
                await registerUser(userEmail, userPassword);
            } else {
                console.error("Erro ao acessar:", error);
                alert("Erro ao acessar: " + error.message);
            }
        }
    } else {
        alert("Por favor, preencha todos os campos.");
    }
});

async function registerUser(email, password) {
    console.log("Tentando registrar o usuário com email:", email);

    // Cria um usuário com email e senha
    try {
        const userCredential = await createUserWithEmailAndPassword(auth, email, password);
        const user = userCredential.user;
        const userName = email.split('@')[0]; // Pega a parte antes do '@' do email como nome de usuário
        const trialEnd = new Date(Date.now() + 7 * 24 * 60 * 60 * 1000); // 1 semana

        // Armazena os dados do usuário no Firestore
        await setDoc(doc(db, 'users', user.uid), {
            email: email,
            name: userName,
            trialEnd: trialEnd
        });

        localStorage.setItem('userName', userName);

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
