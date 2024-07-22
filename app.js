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
    document.getElementById('loginContainer').style.display = 'none';
    document.getElementById('registerContainer').style.display = 'block';
}

function switchToLogin() {
    document.getElementById('loginContainer').style.display = 'block';
    document.getElementById('registerContainer').style.display = 'none';
}

document.getElementById('loginButton').addEventListener('click', async function() {
    const userEmail = document.getElementById('userEmail').value;
    const userPassword = document.getElementById('userPassword').value;

    if (userEmail && userPassword) {
        try {
            // Tenta fazer login
            const userCredential = await signInWithEmailAndPassword(auth, userEmail, userPassword);
            const user = userCredential.user;

            // Redireciona após o login
            setTimeout(() => {
                window.location.href = "https://botmillion.github.io/telm/";
            }, 5000); // Redireciona após 5 segundos
        } catch (error) {
            console.error("Erro ao acessar:", error);
            alert("Erro ao acessar: " + error.message);
            if (error.code === 'auth/user-not-found') {
                switchToRegister();
            }
        }
    } else {
        alert("Por favor, preencha todos os campos.");
    }
});

document.getElementById('registerLink').addEventListener('click', function() {
    switchToRegister();
});

document.getElementById('registerButton').addEventListener('click', async function() {
    const userName = document.getElementById('userName').value;
    const userEmail = document.getElementById('userEmail').value;
    const userPassword = document.getElementById('userPassword').value;

    if (userEmail && userPassword) {
        if (userPassword.length < 6) {
            document.getElementById('error-message').style.display = 'block';
            return;
        } else {
            document.getElementById('error-message').style.display = 'none';
        }

        try {
            const userCredential = await createUserWithEmailAndPassword(auth, userEmail, userPassword);
            const user = userCredential.user;
            const trialEnd = new Date(Date.now() + 7 * 24 * 60 * 60 * 1000);

            // Armazena os dados do usuário no Firestore
            await setDoc(doc(db, 'users', user.uid), {
                email: userEmail,
                name: userName,
                trialEnd: trialEnd
            });

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

// Adiciona evento para voltar para o login a partir do registro
document.getElementById('loginLink').addEventListener('click', function() {
    switchToLogin();
});
