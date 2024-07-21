// Importando Firebase
import { getAuth, createUserWithEmailAndPassword, signInWithEmailAndPassword } from "https://www.gstatic.com/firebasejs/9.0.0/firebase-auth.js";

// Inicializa o Firebase
const auth = getAuth();

document.getElementById('loginButton').addEventListener('click', async function() {
    const userEmail = document.getElementById('userEmail').value;
    const userPassword = document.getElementById('userPassword').value;

    if (userEmail && userPassword) {
        try {
            // Tenta fazer login
            const userCredential = await signInWithEmailAndPassword(auth, userEmail, userPassword);
            console.log("Usuário logado:", userCredential.user.uid);

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
        try {
            // Tenta registrar o usuário
            const userCredential = await createUserWithEmailAndPassword(auth, userEmail, userPassword);
            console.log("Usuário registrado:", userCredential.user.uid);

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
