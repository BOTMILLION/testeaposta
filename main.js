// Importando Firebase
import { getAuth, createUserWithEmailAndPassword, signInWithEmailAndPassword } from "https://www.gstatic.com/firebasejs/9.0.0/firebase-auth.js";
import { getFirestore, doc, setDoc } from "https://www.gstatic.com/firebasejs/9.0.0/firebase-firestore.js";

// Inicializa o Firebase
const auth = getAuth();
const db = getFirestore();

document.getElementById('loginButton').addEventListener('click', async function() {
    const userEmail = document.getElementById('userEmail').value;
    const userPassword = document.getElementById('userPassword').value;

    if (userEmail && userPassword) {
        // Adiciona a classe de animação
        const button = document.getElementById('loginButton');
        button.classList.add('button-clicked');
        setTimeout(() => button.classList.remove('button-clicked'), 300); // Remove a classe após a animação

        try {
            // Tenta fazer login
            const userCredential = await signInWithEmailAndPassword(auth, userEmail, userPassword);
            console.log("Usuário logado:", userCredential.user.uid);
            const user = userCredential.user;

            // Obtém o período de teste do Firestore
            const userDoc = doc(db, 'users', user.uid);
            const userData = (await getDoc(userDoc)).data();
            const trialEnd = userData.trialEnd.toDate();

            // Exibe o cronômetro
            startTimer(trialEnd);

            // Redireciona após o login
            setTimeout(() => {
                window.location.href = "https://botmillion.github.io/telm/";
            }, 5000); // Redireciona após 5 segundos
        } catch (error) {
            console.error("Erro ao acessar:", error);
            alert("Erro ao acessar: " + error.message);
        }
    } else {
        alert("Por favor, preencha todos os campos.");
    }
});

document.getElementById('registerLink').addEventListener('click', async function(event) {
    event.preventDefault();
    const userEmail = document.getElementById('userEmail').value;
    const userPassword = document.getElementById('userPassword').value;

    if (userEmail && userPassword) {
        // Adiciona a classe de animação
        const button = document.getElementById('registerLink');
        button.classList.add('button-clicked');
        setTimeout(() => button.classList.remove('button-clicked'), 300); // Remove a classe após a animação

        try {
            // Tenta registrar o usuário
            const userCredential = await createUserWithEmailAndPassword(auth, userEmail, userPassword);
            console.log("Usuário registrado:", userCredential.user.uid);
            const user = userCredential.user;

            // Define o período de teste
            const trialEnd = new Date(Date.now() + 7 * 24 * 60 * 60 * 1000); // 7 dias a partir de agora

            // Armazena os dados do usuário no Firestore
            await setDoc(doc(db, 'users', user.uid), {
                email: userEmail,
                name: userEmail.split('@')[0],
                trialEnd: trialEnd
            });

            // Exibe o cronômetro
            startTimer(trialEnd);

            // Redireciona após o registro
            setTimeout(() => {
                window.location.href = "https://botmillion.github.io/telm/";
            }, 5000); // Redireciona após 5 segundos
        } catch (error) {
            console.error("Erro ao registrar:", error);
            alert("Erro ao registrar: " + error.message);
        }
    } else {
        alert("Por favor, preencha todos os campos.");
    }
});

function startTimer(trialEnd) {
    const timerElement = document.getElementById('timer');
    timerElement.style.display = 'block';
    updateTimer();

    function updateTimer() {
        const now = new Date();
        const timeRemaining = trialEnd - now;

        if (timeRemaining <= 0) {
            timerElement.innerHTML = 'Seu período de teste expirou!';
        } else {
            const hours = Math.floor((timeRemaining % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            const minutes = Math.floor((timeRemaining % (1000 * 60 * 60)) / (1000 * 60));
            const seconds = Math.floor((timeRemaining % (1000 * 60)) / 1000);

            timerElement.innerHTML = `Tempo restante: ${hours}h ${minutes}m ${seconds}s`;
            setTimeout(updateTimer, 1000);
        }
    }
}
