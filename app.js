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
console.log("Inicializando Firebase...");
const app = initializeApp(firebaseConfig);
const db = getFirestore(app);
const auth = getAuth(app);

document.getElementById('loginButton').addEventListener('click', async function() {
    const userEmail = document.getElementById('userEmail').value;
    const userPassword = document.getElementById('userPassword').value;

    console.log("Email:", userEmail);
    console.log("Senha:", userPassword);

    if (userEmail && userPassword) {
        try {
            // Tenta fazer login
            const userCredential = await signInWithEmailAndPassword(auth, userEmail, userPassword);
            const user = userCredential.user;

            console.log("Usuário logado:", user.uid);

            // Obtém o horário do final do período de teste
            const userDoc = await getDoc(doc(db, 'users', user.uid));
            if (!userDoc.exists()) {
                console.log("Usuário não encontrado no Firestore.");
                return;
            }

            const trialEndTime = userDoc.data().trialEnd.toDate();
            console.log("Hora do final do período de teste:", trialEndTime);

            if (new Date() > trialEndTime) {
                alert("Seu período de teste terminou! Você não pode mais acessar o site.");
            } else {
                startTrialTimer(userEmail);
                document.getElementById('timer').style.display = 'block';
            }
        } catch (error) {
            console.error("Erro ao acessar:", error);
            if (error.code === 'auth/user-not-found') {
                await registerUser(userEmail, userPassword);
            } else {
                alert("Erro ao acessar: " + error.message);
            }
        }
    } else {
        alert("Por favor, preencha todos os campos.");
    }
});

document.getElementById('registerLink').addEventListener('click', function() {
    const userEmail = document.getElementById('userEmail').value;
    const userPassword = document.getElementById('userPassword').value;

    if (userEmail && userPassword) {
        registerUser(userEmail, userPassword);
    } else {
        alert("Por favor, preencha todos os campos.");
    }
});

async function registerUser(email, password) {
    console.log("Tentando registrar o usuário com email:", email);

    if (password.length < 6) {
        document.getElementById('error-message').style.display = 'block';
        return;
    } else {
        document.getElementById('error-message').style.display = 'none';
    }

    try {
        const userCredential = await createUserWithEmailAndPassword(auth, email, password);
        const user = userCredential.user;
        const userName = email.split('@')[0];
        const trialEnd = new Date(Date.now() + 7 * 24 * 60 * 60 * 1000);

        // Armazena os dados do usuário no Firestore
        await setDoc(doc(db, 'users', user.uid), {
            email: email,
            name: userName,
            trialEnd: trialEnd
        });

        console.log("Usuário registrado com sucesso.");
        startTrialTimer(email);
        document.getElementById('timer').style.display = 'block';
    } catch (error) {
        console.error("Erro ao registrar:", error);
        alert("Erro ao registrar: " + error.message);
    }
}

function startTrialTimer(email) {
    console.log("Iniciando cronômetro de teste para:", email);
    const trialEndTime = new Date(Date.now() + 7 * 24 * 60 * 60 * 1000).getTime(); // 7 dias
    localStorage.setItem('trialEndTime_' + email, trialEndTime); // Armazena o tempo de término do teste no localStorage

    const timerElement = document.getElementById('timer');

    const interval = setInterval(() => {
        const now = new Date().getTime();
        const remainingTime = trialEndTime - now;

        if (remainingTime <= 0) {
            clearInterval(interval);
            timerElement.textContent = "Seu período de teste terminou!";
            localStorage.removeItem('trialEndTime_' + email);
            alert("Seu período de teste terminou! Você não pode mais acessar o site.");
        } else {
            const days = Math.floor(remainingTime / (1000 * 60 * 60 * 24));
            const hours = Math.floor((remainingTime % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            const minutes = Math.floor((remainingTime % (1000 * 60 * 60)) / (1000 * 60));
            const seconds = Math.floor((remainingTime % (1000 * 60)) / 1000);
            timerElement.textContent = `Tempo restante: ${days}d ${hours}h ${minutes}m ${seconds}s`;
        }
    }, 1000);
}
