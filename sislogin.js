// Inicializa o Firestore
const db = firebase.firestore(); 

// Função para registrar um novo usuário
function registerUser(email, password) {
    firebase.auth().createUserWithEmailAndPassword(email, password)
    .then(async (userCredential) => {
        const user = userCredential.user;
        const trialEnd = new Date(Date.now() + 7 * 24 * 60 * 60 * 1000); // 1 semana

        // Armazena os dados do usuário no Firestore
        await db.collection('users').doc(user.uid).set({
            email: user.email,
            trialEnd: trialEnd
        });

        alert("Usuário registrado com sucesso!");
    })
    .catch((error) => {
        console.error("Erro ao registrar: ", error);
    });
}

// Função para logar um usuário
function loginUser(email, password) {
    firebase.auth().signInWithEmailAndPassword(email, password)
    .then(async (userCredential) => {
        const user = userCredential.user;

        // Recupera os dados do usuário do Firestore
        const userDoc = await db.collection('users').doc(user.uid).get();

        if (userDoc.exists) {
            const trialEnd = userDoc.data().trialEnd.toDate(); // Converte para objeto Date
            const remainingTime = trialEnd - Date.now(); // Calcula o tempo restante

            if (remainingTime > 0) {
                const daysRemaining = Math.ceil(remainingTime / (1000 * 60 * 60 * 24)); // Converte para dias
                alert(`Login realizado com sucesso! Tempo restante: ${daysRemaining} dias`);
            } else {
                alert("Seu período de teste terminou! Por favor, efetue o pagamento para continuar.");
            }
        }
    })
    .catch((error) => {
        console.error("Erro ao logar: ", error);
    });
}
