// Importando Firebase
import { getFirestore, doc, setDoc, getDoc } from "https://www.gstatic.com/firebasejs/9.0.0/firebase-firestore.js";
import { getAuth, signInWithEmailAndPassword, createUserWithEmailAndPassword } from "https://www.gstatic.com/firebasejs/9.0.0/firebase-auth.js";

// Inicializar Firebase
const db = getFirestore();
const auth = getAuth();

window.onload = () => {
    const userEmail = localStorage.getItem('userEmail');
    const userName = localStorage.getItem('userName');
    
    if (userEmail && userName) {
        document.getElementById('welcome-message').textContent = `Oi, ${userName}, vamos ganhar dinheiro hoje? 🤑`;
        startTrialTimer();
        document.getElementById('buttons').style.display = 'block';
    } else {
        document.getElementById('submitUserInfo').style.display = 'block';
    }
};

document.getElementById('submitUserInfo').addEventListener('click', async function() {
    const userName = document.getElementById('userName').value;
    const userEmail = document.getElementById('userEmail').value;
    const userPassword = document.getElementById('userPassword').value;

    if (userName && userEmail && userPassword) {
        localStorage.setItem('userName', userName);
        localStorage.setItem('userEmail', userEmail);

        try {
            const userCredential = await signInWithEmailAndPassword(auth, userEmail, userPassword);
            const user = userCredential.user;
            const userDoc = await getDoc(doc(db, 'users', user.uid));

            if (userDoc.exists()) {
                document.getElementById('welcome-message').innerText = `Bem-vindo de volta! Vamos ganhar dinheiro hoje? 🤑`;
                startTrialTimer(userDoc.data().trialEnd);
            } else {
                await registerUser(userEmail, userName);
            }
            document.getElementById('buttons').style.display = 'block';
        } catch (error) {
            console.error("Erro ao acessar:", error);
            alert("Erro ao acessar: " + error.message);
        }
    }
});

async function registerUser(email, userName) {
    console.log("Tentando registrar o usuário:", userName, "com email:", email);
    try {
        const userCredential = await createUserWithEmailAndPassword(auth, email, "senhaSegura"); // Substitua "senhaSegura" por uma senha segura
        const user = userCredential.user;
        const trialEnd = new Date(Date.now() + 7 * 24 * 60 * 60 * 1000); // 1 semana

        await setDoc(doc(db, 'users', user.uid), {
            email: email,
            name: userName,
            trialEnd: trialEnd
        });

        document.getElementById('welcome-message').innerText = `Registro bem-sucedido! Vamos ganhar dinheiro hoje? 🤑`;
        startTrialTimer(trialEnd);
    } catch (error) {
        console.error("Erro ao registrar:", error);
        alert("Erro ao registrar: " + error.message);
    }
}

function startTrialTimer(trialEnd) {
    const timerElement = document.getElementById('timer');
    timerElement.style.display = 'block';
    const interval = setInterval(() => {
        const remainingTime = trialEnd - Date.now();
        if (remainingTime <= 0) {
            clearInterval(interval);
            timerElement.innerText = "Seu período de teste terminou!";
        } else {
            const daysRemaining = Math.ceil(remainingTime / (1000 * 60 * 60 * 24));
            timerElement.innerText = `Tempo restante: ${daysRemaining} dias`;
        }
    }, 1000);
}
