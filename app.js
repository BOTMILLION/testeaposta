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
            // Simulação de login
            // Normalmente você enviaria uma solicitação de login aqui
            loginForm.style.display = 'none';
            // Exibir o popup e iniciar o cronômetro
            redirectPopup.style.display = 'block';
            const userName = email.split('@')[0]; // Obtém o nome do usuário a partir do email
            userNameElement.textContent = userName;

            // Inicializa o temporizador do período grátis
            let timer = 30; // Tempo inicial do período grátis em segundos
            const timerInterval = setInterval(() => {
                timer--;
                timerElement.textContent = timer;
                if (timer <= 0) {
                    clearInterval(timerInterval);
                }
            }, 1000);

            // Contagem regressiva para redirecionamento
            let countdown = 3;
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
            // Simulação de cadastro
            // Normalmente você enviaria uma solicitação de cadastro aqui
            registerForm.style.display = 'none';
            // Mensagem de confirmação após o cadastro
            setTimeout(() => {
                alert('Cadastro realizado com sucesso!');
            }, 500);
        }
    });

    // Mostrar o botão de pagamento assim que a página carrega
    paymentButton.style.display = 'block';
    // Reiniciar a animação do botão de pagamento
    paymentButton.classList.remove('pulse-button');
    void paymentButton.offsetWidth; // Forçar reflow
    paymentButton.classList.add('pulse-button');
});
