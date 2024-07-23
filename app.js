document.addEventListener('DOMContentLoaded', () => {
    const loginForm = document.getElementById('loginForm');
    const registerForm = document.getElementById('registerForm');
    const loginLink = document.getElementById('loginLink');
    const registerLink = document.getElementById('registerLink');
    const loginButton = document.getElementById('loginButton');
    const registerButton = document.getElementById('registerButton');
    const paymentButton = document.getElementById('paymentButton');
    const redirectPopup = document.getElementById('loginPopup');
    const countdownElement = document.getElementById('trialTimer');
    const redirectButton = document.getElementById('redirectButton');
    const loginError = document.getElementById('loginError');
    const registerError = document.getElementById('registerError');

    // Configuração do Firebase
    const firebaseConfig = {
            apiKey: "AIzaSyAtaTalveibqyUVnO33QhHz-sGYzO4PkWk",
            authDomain: "robo3-686ff.firebaseapp.com",
            projectId: "robo3-686ff",
            storageBucket: "robo3-686ff.appspot.com",
            messagingSenderId: "1035908255814",
            appId: "1:1035908255814:web:4a5fc9c91325aa6fe33a47"
    };
    firebase.initializeApp(firebaseConfig);
    const auth = firebase.auth();

    // Mostrar o formulário de cadastro
    registerLink.addEventListener('click', (event) => {
        event.preventDefault();
        loginForm.style.display = 'none';
        registerForm.style.display = 'block';
    });

    // Mostrar o formulário de login
    loginLink.addEventListener('click', (event) => {
        event.preventDefault();
        registerForm.style.display = 'none';
        loginForm.style.display = 'block';
    });

    // Manipular o clique no botão de login
    loginButton.addEventListener('click', () => {
        const email = document.getElementById('loginEmail').value;
        const password = document.getElementById('loginPassword').value;

        if (password.length < 6) {
            loginError.style.display = 'block';
        } else {
            loginError.style.display = 'none';
            auth.signInWithEmailAndPassword(email, password)
                .then(() => {
                    loginForm.style.display = 'none';
                    redirectPopup.style.display = 'block';
                    let countdown = 5;
                    const countdownInterval = setInterval(() => {
                        countdown -= 1;
                        countdownElement.textContent = countdown;
                        if (countdown <= 0) {
                            clearInterval(countdownInterval);
                            redirectToGame();
                        }
                    }, 1000);
                })
                .catch(() => {
                    loginError.style.display = 'block';
                });
        }
    });

    // Manipular o clique no botão de cadastro
    registerButton.addEventListener('click', () => {
        const email = document.getElementById('registerEmail').value;
        const password = document.getElementById('registerPassword').value;

        if (password.length < 6) {
            registerError.textContent = 'A senha deve ter pelo menos 6 caracteres.';
            registerError.style.display = 'block';
        } else {
            registerError.style.display = 'none';
            auth.createUserWithEmailAndPassword(email, password)
                .then(() => {
                    registerForm.style.display = 'none';
                    loginForm.style.display = 'block';
                })
                .catch(() => {
                    registerError.style.display = 'block';
                });
        }
    });

    // Redirecionar após o clique no botão do popup
    redirectButton.addEventListener('click', () => {
        redirectToGame();
    });

    // Função para redirecionar ao jogo
    function redirectToGame() {
        window.location.href = 'https://botmillion.github.io/telm/';
    }

    // Mostrar o botão de pagamento assim que a página carrega
    paymentButton.style.display = 'block';
    // Reiniciar a animação do botão de pagamento
    paymentButton.classList.remove('pulse-button');
    void paymentButton.offsetWidth; // Forçar reflow
    paymentButton.classList.add('pulse-button');

    // Exemplo de configuração do temporizador do período de teste
    function startTrialTimer() {
        const trialDuration = 60 * 60 * 1000; // 1 hora em milissegundos
        const endTime = Date.now() + trialDuration;
        setInterval(() => {
            const remaining = endTime - Date.now();
            if (remaining <= 0) {
                countdownElement.textContent = '00:00:00';
                return;
            }
            const hours = String(Math.floor(remaining / (1000 * 60 * 60))).padStart(2, '0');
            const minutes = String(Math.floor((remaining % (1000 * 60 * 60)) / (1000 * 60))).padStart(2, '0');
            const seconds = String(Math.floor((remaining % (1000 * 60)) / 1000)).padStart(2, '0');
            countdownElement.textContent = `${hours}:${minutes}:${seconds}`;
        }, 1000);
    }

    startTrialTimer();
});
