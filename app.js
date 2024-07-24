document.addEventListener('DOMContentLoaded', () => {
    // Referência aos elementos do DOM
    const loginForm = document.getElementById('loginForm');
    const registerForm = document.getElementById('registerForm');
    const loginLink = document.getElementById('loginLink');
    const registerLink = document.getElementById('registerLink');
    const loginButton = document.getElementById('loginButton');
    const registerButton = document.getElementById('registerButton');
    const paymentButton = document.getElementById('paymentButton');
    const redirectPopup = document.getElementById('redirectPopup');
    const redirectTimer = document.getElementById('redirectTimer');
    const redirectNowButton = document.getElementById('redirectNowButton');
    const trialStatus = document.getElementById('trialStatus');
    const registrationMessage = document.getElementById('registrationMessage');
    const resetPasswordButton = document.getElementById('resetPasswordButton');
    const resetPasswordPopup = document.getElementById('resetPasswordPopup');
    const resetEmail = document.getElementById('resetEmail');
    const resetError = document.getElementById('resetError');
    const closeResetPopup = document.getElementById('closeResetPopup');
    const subscriptionStatus = document.getElementById('subscriptionStatus');
    const closePopupButton = document.getElementById('closePopup');

    // Mostrar o formulário de cadastro
    registerLink.addEventListener('click', (event) => {
        event.preventDefault();
        loginForm.style.display = 'none';
        registerForm.style.display = 'flex';
    });

    // Mostrar o formulário de login
    loginLink.addEventListener('click', (event) => {
        event.preventDefault();
        registerForm.style.display = 'none';
        loginForm.style.display = 'flex';
    });

    // Manipular o clique no botão de login
    loginButton.addEventListener('click', async () => {
        const email = document.getElementById('loginEmail').value;
        const password = document.getElementById('loginPassword').value;
        if (password.length < 6) {
            mostrarErro('loginError', 'A senha deve ter pelo menos 6 caracteres.');
        } else {
            try {
                const userCredential = await signInWithEmailAndPassword(auth, email, password);
                const user = userCredential.user;
                const userDoc = doc(db, 'users', user.uid);
                const userSnapshot = await getDoc(userDoc);

                if (userSnapshot.exists()) {
                    processarLogin(userSnapshot.data());
                } else {
                    console.error('No user data found');
                }
            } catch (error) {
                mostrarErro('loginError', error.message);
            }
        }
    });

    // Processar dados de login
    const processarLogin = (userData) => {
        const trialStartDate = new Date(userData.trialStartDate);
        const trialEndDate = new Date(userData.trialEndDate);
        const subscriptionEndDate = userData.subscriptionEndDate ? new Date(userData.subscriptionEndDate) : null;
        const now = new Date();

        const isTrialValid = now <= trialEndDate;
        const isSubscriptionValid = subscriptionEndDate && now <= subscriptionEndDate;

        if (isTrialValid) {
            trialStatus.style.display = 'block';
            trialStatus.textContent = `Seu período de teste vai até: ${trialEndDate.toLocaleDateString()}`;
        } else {
            trialStatus.style.display = 'none';
        }

        if (isSubscriptionValid) {
            subscriptionStatus.style.display = 'block';
            subscriptionStatus.textContent = `Sua assinatura é válida até: ${subscriptionEndDate.toLocaleDateString()}`;
        } else {
            subscriptionStatus.style.display = 'none';
        }

        if (isTrialValid || isSubscriptionValid) {
            iniciarRedirecionamento(isTrialValid ? trialEndDate : subscriptionEndDate);
        } else {
            trialStatus.style.display = 'block';
            trialStatus.textContent = 'Seu período de teste expirou. Por favor, faça o pagamento para continuar.';
            paymentButton.style.display = 'block';
            paymentButton.addEventListener('click', () => {
                window.location.href = 'https://yampi.com.br/';
            });
        }
    };

    // Iniciar redirecionamento após login
    const iniciarRedirecionamento = (endDate) => {
        loginForm.style.display = 'none';
        redirectPopup.style.display = 'block';
        let countdown = Math.ceil((endDate - new Date()) / 1000);
        const countdownInterval = setInterval(() => {
            countdown -= 1;
            const hours = Math.floor(countdown / 3600);
            const minutes = Math.floor((countdown % 3600) / 60);
            const seconds = countdown % 60;
            redirectTimer.textContent = `${hours}h ${minutes}m ${seconds}s`;
            if (countdown <= 0) {
                clearInterval(countdownInterval);
                window.location.href = 'https://vaidebet.com/ptb/games/livecasino/detail/normal/18198/evol_TopCard000000001_BRL';
            }
        }, 1000);

        redirectNowButton.addEventListener('click', () => {
            window.location.href = 'https://vaidebet.com/ptb/games/livecasino/detail/normal/18198/evol_TopCard000000001_BRL';
        });
    };

    // Mostrar erro
    const mostrarErro = (elementId, mensagem) => {
        const element = document.getElementById(elementId);
        element.style.display = 'block';
        element.textContent = mensagem;
    };

    // Manipular o clique no botão de cadastro
    registerButton.addEventListener('click', async () => {
        const name = document.getElementById('registerName').value;
        const email = document.getElementById('registerEmail').value;
        const password = document.getElementById('registerPassword').value;
        if (name === '' || email === '' || password === '' || password.length < 6) {
            mostrarErro('registerError', 'Por favor, preencha todos os campos corretamente.');
        } else {
            try {
                const userCredential = await createUserWithEmailAndPassword(auth, email, password);
                const user = userCredential.user;
                const trialStartDate = new Date();
                const trialEndDate = new Date(trialStartDate.getTime() + 3 * 24 * 60 * 60 * 1000);

                await setDoc(doc(db, 'users', user.uid), {
                    name: name,
                    email: email,
                    trialStartDate: trialStartDate.toISOString(),
                    trialEndDate: trialEndDate.toISOString(),
                    subscriptionEndDate: null
                });
                document.getElementById('registerError').style.display = 'none';
                registerForm.style.display = 'none';
                await sendEmailVerification(user);
                mostrarMensagemCadastro(trialStartDate, trialEndDate);
            } catch (error) {
                mostrarErro('registerError', error.message);
            }
        }
    });

    // Mostrar mensagem de cadastro
    const mostrarMensagemCadastro = (trialStartDate, trialEndDate) => {
        registrationMessage.style.display = 'block';
        registrationMessage.innerHTML = `
            Cadastro realizado!<br>
            Para começar, verifique seu e-mail para concluir o processo de login. Você tem um período de teste gratuito de 3 dias, e o temporizador abaixo mostra o tempo restante. Após o período de teste, realize o pagamento de R$20 para continuar acessando nossos serviços.<br><br>
            <button id="startButton">Iniciar</button>
        `;

        document.getElementById('startButton').addEventListener('click', () => {
            window.location.href = 'https://vaidebet.com/ptb/games/livecasino/detail/normal/18198/evol_TopCard000000001_BRL';
        });

        let countdown = Math.ceil((trialEndDate - trialStartDate) / 1000);
        const countdownInterval = setInterval(() => {
            countdown -= 1;
            const hours = Math.floor(countdown / 3600);
            const minutes = Math.floor((countdown % 3600) / 60);
            const seconds = countdown % 60;
            registrationMessage.innerHTML += `<br>${hours}h ${minutes}m ${seconds}s restantes no seu período de teste.`;
            if (countdown <= 0) {
                clearInterval(countdownInterval);
                registrationMessage.innerHTML += '<br>Seu período de teste expirou.';
            }
        }, 1000);
    };

    // Manipular o clique no botão de recuperação de senha
    resetPasswordButton.addEventListener('click', () => {
        resetPasswordPopup.style.display = 'block';
    });

    closeResetPopup.addEventListener('click', () => {
        resetPasswordPopup.style.display = 'none';
    });

    // Manipular recuperação de senha
    document.getElementById('resetPasswordSubmit').addEventListener('click', async () => {
        const email = resetEmail.value;
        try {
            await sendPasswordResetEmail(auth, email);
            resetError.style.display = 'block';
            resetError.textContent = 'E-mail de recuperação enviado com sucesso!';
        } catch (error) {
            resetError.style.display = 'block';
            resetError.textContent = error.message;
        }
    });

    // Fechar popup de redirecionamento
    closePopupButton.addEventListener('click', () => {
        redirectPopup.style.display = 'none';
    });
});
