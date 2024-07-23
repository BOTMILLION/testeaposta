document.addEventListener('DOMContentLoaded', () => {
    const loginForm = document.getElementById('loginForm');
    const registerForm = document.getElementById('registerForm');
    const loginLink = document.getElementById('loginLink');
    const registerLink = document.getElementById('registerLink');
    const loginButton = document.getElementById('loginButton');
    const registerButton = document.getElementById('registerButton');
    const paymentButton = document.getElementById('paymentButton');
    const redirectPopup = document.getElementById('redirectPopup');
    const countdownElement = document.getElementById('countdown');
    const redirectButton = document.getElementById('redirectButton');
    const timerElement = document.getElementById('timer');
    const userNameElement = document.getElementById('userName');

    // Configurar Firebase
    import { initializeApp } from "https://www.gstatic.com/firebasejs/9.22.2/firebase-app.js";
    import { getAuth, createUserWithEmailAndPassword, signInWithEmailAndPassword } from "https://www.gstatic.com/firebasejs/9.22.2/firebase-auth.js";

    const firebaseConfig = {
        apiKey: "AIzaSyCKw5ZcJBcTvf1onPtkzgvJqlRAsbUqauk",
        authDomain: "robo-7937c.firebaseapp.com",
        projectId: "robo-7937c",
        storageBucket: "robo-7937c.appspot.com",
        messagingSenderId: "444396924434",
        appId: "1:444396924434:web:46b93323f9c22d90ac32cb",
        measurementId: "G-G4NYL1GXGW"
    };

    const app = initializeApp(firebaseConfig);
    const auth = getAuth(app);

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
            document.getElementById('loginError').style.display = 'block';
        } else {
            document.getElementById('loginError').style.display = 'none';
            signInWithEmailAndPassword(auth, email, password)
                .then((userCredential) => {
                    // Login bem-sucedido
                    const user = userCredential.user;
                    loginForm.style.display = 'none';
                    redirectPopup.style.display = 'block';

                    // Exibir nome do usuário no popup
                    const userName = email.split('@')[0]; // Obtém o nome do usuário a partir do email
                    userNameElement.textContent = userName;

                    // Inicializa o temporizador do período grátis
                    let timer = 30; // Tempo inicial do período grátis em segundos
                    timerElement.textContent = timer; // Exibe o tempo inicial
                    const timerInterval = setInterval(() => {
                        timer--;
                        timerElement.textContent = timer;
                        if (timer <= 0) {
                            clearInterval(timerInterval);
                        }
                    }, 1000);

                    // Contagem regressiva para redirecionamento
                    let countdown = 3;
                    countdownElement.textContent = countdown; // Exibe a contagem inicial
                    const countdownInterval = setInterval(() => {
                        countdown--;
                        countdownElement.textContent = countdown;
                        if (countdown <= 0) {
                            clearInterval(countdownInterval);
                            window.location.href = 'https://vaidebet.com/ptb/games/livecasino/detail/normal/18198/evol_TopCard000000001_BRL'; // Redireciona para o jogo
                        }
                    }, 1000);

                    // Redirecionar após o clique no botão do popup
                    redirectButton.addEventListener('click', () => {
                        window.location.href = 'https://vaidebet.com/ptb/games/livecasino/detail/normal/18198/evol_TopCard000000001_BRL'; // Redireciona para o jogo
                    });
                })
                .catch((error) => {
                    console.error('Erro ao fazer login:', error);
                    alert('Erro ao fazer login: ' + error.message);
                });
        }
    });

    // Manipular o clique no botão de cadastro
    registerButton.addEventListener('click', () => {
        const name = document.getElementById('registerName').value;
        const email = document.getElementById('registerEmail').value;
        const password = document.getElementById('registerPassword').value;
        if (password.length < 6) {
            document.getElementById('registerError').style.display = 'block';
        } else {
            document.getElementById('registerError').style.display = 'none';
            createUserWithEmailAndPassword(auth, email, password)
                .then((userCredential) => {
                    // Cadastro bem-sucedido
                    const user = userCredential.user;
                    alert('Cadastro bem-sucedido. Agora você pode fazer login.');
                    registerForm.style.display = 'none';
                    loginForm.style.display = 'block';
                })
                .catch((error) => {
                    console.error('Erro ao fazer cadastro:', error);
                    alert('Erro ao fazer cadastro: ' + error.message);
                });
        }
    });

    // Mostrar botão de pagamento quando o temporizador expira
    setTimeout(() => {
        paymentButton.style.display = 'block';
    }, 30000); // 30 segundos

    paymentButton.addEventListener('click', () => {
        window.location.href = 'https://checkout.yampi.com.br'; // Link para o checkout do Yampi
    });
});
