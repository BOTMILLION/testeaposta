import { 
    auth, 
    db, 
    signInWithEmailAndPassword, 
    createUserWithEmailAndPassword, 
    sendEmailVerification, 
    sendPasswordResetEmail, 
    doc, 
    setDoc, 
    getDoc, 
    Timestamp 
} from './firebase'; // Ajuste o caminho conforme necessário

document.addEventListener('DOMContentLoaded', () => {
    // Referências aos elementos do DOM
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
    const closePopupButton = document.getElementById('closePopupButton');
    const paymentPopup = document.getElementById('paymentPopup');
    const paymentNowButton = document.getElementById('paymentNowButton');

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

                // Recarregar o status do usuário
                await user.reload();

                if (user.emailVerified) {
                    const userDoc = doc(db, 'users', user.uid);
                    const userSnapshot = await getDoc(userDoc);

                    if (userSnapshot.exists()) {
                        const userData = userSnapshot.data();
                        if (verificarStatusDeTesteOuPagamento(userData)) {
                            iniciarRedirecionamento(userData.subscriptionEndDate || userData.trialEndDate);
                        } else {
                            mostrarPopupPagamento();
                        }
                    } else {
                        console.error('Dados do usuário não encontrados.');
                    }
                } else {
                    mostrarErro('loginError', 'Por favor, verifique seu e-mail antes de fazer login.');
                }
            } catch (error) {
                mostrarErro('loginError', error.message);
            }
        }
    });

    // Verificar status de teste ou pagamento
    const verificarStatusDeTesteOuPagamento = (userData) => {
        const now = new Date();
        const trialEndDate = new Date(userData.trialEndDate);
        const subscriptionEndDate = userData.subscriptionEndDate ? new Date(userData.subscriptionEndDate) : null;

        const isTrialValid = now <= trialEndDate;
        const isSubscriptionValid = subscriptionEndDate && now <= subscriptionEndDate;

        if (isTrialValid || isSubscriptionValid) {
            return true;
        } else {
            return false;
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
                window.location.href = 'https://botmillion.github.io/telm/';
            }
        }, 1000);

        redirectNowButton.addEventListener('click', () => {
            window.location.href = 'https://botmillion.github.io/telm/';
        });
    };

    // Mostrar popup de pagamento
    const mostrarPopupPagamento = () => {
        paymentPopup.style.display = 'block';
        paymentNowButton.addEventListener('click', () => {
            window.location.href = 'https://yampi.com.br/';
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
                    trialStartDate: Timestamp.fromDate(trialStartDate),
                    trialEndDate: Timestamp.fromDate(trialEndDate),
                    subscriptionEndDate: null,
                    expirationDate: null,
                    paymentStatus: 'unpaid' // Define status de pagamento como não pago
                });

                // Enviar e-mail de verificação
                await sendEmailVerification(user);

                document.getElementById('registerError').style.display = 'none';
                registerForm.style.display = 'none';
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
            <h2>Usuário cadastrado!</h2>
            <p>Para realizar o login, verifique o seu e-mail.</p>
            <p>Este é o seu temporizador do período grátis de 3 dias.</p>
            <p>Ao esgotar, realize o pagamento para continuar utilizando nossos serviços.</p>
            <p>Seu período de teste termina em: ${trialEndDate.toLocaleDateString()} às ${trialEndDate.toLocaleTimeString()}</p>
            <button id="closePopupButton">FECHAR</button>
        `;

        document.getElementById('closePopupButton').addEventListener('click', () => {
            registrationMessage.style.display = 'none';
        });

        let countdown = Math.ceil((trialEndDate - new Date()) / 1000);
        const countdownInterval = setInterval(() => {
            countdown -= 1;
            const hours = Math.floor(countdown / 3600);
            const minutes = Math.floor((countdown % 3600) / 60);
            const seconds = countdown % 60;
            registrationMessage.innerHTML = `
                <h2>Usuário cadastrado!</h2>
                <p>Para realizar o login, verifique o seu e-mail.</p>
                <p>Este é o seu temporizador do período grátis de 3 dias.</p>
                <p>Ao esgotar, realize o pagamento para continuar utilizando nossos serviços.</p>
                <p>Seu período de teste termina em: ${trialEndDate.toLocaleDateString()} às ${trialEndDate.toLocaleTimeString()}</p>
                <p>Tempo restante: ${hours}h ${minutes}m ${seconds}s</p>
                <button id="closePopupButton">FECHAR</button>
            `;

            if (countdown <= 0) {
                clearInterval(countdownInterval);
            }
        }, 1000);
    };

    // Manipular o clique no botão de redefinir senha
    resetPasswordButton.addEventListener('click', async () => {
        const email = resetEmail.value;

        if (email === '') {
            resetError.textContent = 'Por favor, insira um e-mail.';
        } else {
            try {
                await sendPasswordResetEmail(auth, email);
                resetError.textContent = '';
                alert('Um e-mail de redefinição de senha foi enviado.');
                resetPasswordPopup.style.display = 'none';
            } catch (error) {
                resetError.textContent = error.message;
            }
        }
    });

    // Fechar popup de redefinição de senha
    closeResetPopup.addEventListener('click', () => {
        resetPasswordPopup.style.display = 'none';
    });
});
