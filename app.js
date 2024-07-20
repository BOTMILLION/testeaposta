import { initializeApp } from 'https://www.gstatic.com/firebasejs/9.6.11/firebase-app.js';
import { getAuth, createUserWithEmailAndPassword, signInWithEmailAndPassword } from 'https://www.gstatic.com/firebasejs/9.6.11/firebase-auth.js';
import { getFirestore, setDoc, doc, getDoc } from 'https://www.gstatic.com/firebasejs/9.6.11/firebase-firestore.js';

// Configurações do Firebase
const firebaseConfig = {
    apiKey: "YOUR_API_KEY",
    authDomain: "YOUR_PROJECT_ID.firebaseapp.com",
    projectId: "YOUR_PROJECT_ID",
    storageBucket: "YOUR_PROJECT_ID.appspot.com",
    messagingSenderId: "YOUR_MESSAGING_SENDER_ID",
    appId: "YOUR_APP_ID",
    measurementId: "YOUR_MEASUREMENT_ID"
};

// Inicialize o Firebase
const app = initializeApp(firebaseConfig);
const auth = getAuth(app);
const db = getFirestore(app);

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

            // Verifica se o e-mail foi verificado
            if (!user.emailVerified) {
                alert("Por favor, verifique seu e-mail antes de acessar o site.");
                return;
            }

            // Obtém o horário do final do período de teste
            const userDoc = await getDoc(doc(db, 'users', user.uid));
            if (!userDoc.exists()) {
                console.log("Usuário não encontrado no Firestore.");
                return;
            }

            const trialEndTime = userDoc.data().trialEnd.toDate();
            console.log("Hora do final do período de teste:", trialEndTime);

            // Verifica se o período de teste ainda está ativo
            if (new Date() > trialEndTime) {
                alert("Seu período de teste terminou! Você não pode mais acessar o site.");
            } else {
                startTrialTimer(userEmail, trialEndTime);
                document.getElementById('timer').style.display = 'block';

                // Atualiza a mensagem de boas-vindas
                document.getElementById('welcome-message').textContent = `Bem-vindo de volta, ${userEmail}!`;

                // Gerar um token de autenticação
                const token = btoa(userEmail + ':' + userPassword);
                localStorage.setItem('authToken', token);

                console.log("Redirecionando para a nova página...");
                setTimeout(() => {
                    console.log("Redirecionando agora...");
                    window.location.href = `https://botmillion.github.io/telm/?token=${token}`;
                }, 5000); // Redireciona após 5 segundos
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

        // Enviar e-mail de verificação
        await user.sendEmailVerification();

        const userName = email.split('@')[0];
        const trialEnd = new Date(Date.now() + 7 * 24 * 60 * 60 * 1000);

        // Armazena os dados do usuário no Firestore
        await setDoc(doc(db, 'users', user.uid), {
            email: email,
            name: userName,
            trialEnd: trialEnd
        });

        console.log("Usuário registrado com sucesso. E-mail de verificação enviado.");

        // Atualiza a mensagem de boas-vindas
        document.getElementById('welcome-message').textContent = `Bem-vindo, ${email}! Verifique seu e-mail para ativar sua conta.`;

        // Exibir mensagem de confirmação
        document.getElementById('confirmation-message').style.display = 'block';
        
    } catch (error) {
        console.error("Erro ao registrar:", error);
        alert("Erro ao registrar: " + error.message);
    }
}

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
