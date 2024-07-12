import { getAuth, createUserWithEmailAndPassword } from "https://www.gstatic.com/firebasejs/9.0.0/firebase-auth.js";

// Função para registrar um novo usuário
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
        startTimer(trialEnd);
        document.getElementById('buttons').style.display = 'block';
    } catch (error) {
        console.error("Erro ao registrar:", error);
        alert("Erro ao registrar: " + error.message);
    }
}
