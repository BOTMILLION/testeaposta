async function registerUser(email, password) {
    console.log("Tentando registrar o usuário com email:", email);

    // Verifica a força da senha
    if (password.length < 6) {
        document.getElementById('error-message').style.display = 'block'; // Exibe a mensagem de erro
        return;
    } else {
        document.getElementById('error-message').style.display = 'none'; // Oculta a mensagem de erro
    }

    try {
        const userCredential = await createUserWithEmailAndPassword(auth, email, password);
        const user = userCredential.user;
        const userName = email.split('@')[0]; // Pega parte do email antes do @ como nome do usuário
        const trialEnd = new Date(Date.now() + 7 * 24 * 60 * 60 * 1000); // 1 semana

        // Armazena os dados do usuário no Firestore
        await setDoc(doc(db, 'users', user.uid), {
            email: email,
            name: userName,
            trialEnd: trialEnd
        });

        // Armazena o tempo de término do período de teste no localStorage
        localStorage.setItem('trialEndTime_' + email, trialEnd.toISOString());

        document.getElementById('welcome-message').innerText = `Oi, ${userName}!`;
        startTrialTimer(email);
        document.getElementById('timer').style.display = 'block';

    } catch (error) {
        console.error("Erro ao registrar:", error);
        alert("Erro ao registrar: " + error.message);
    }
}
