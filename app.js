document.addEventListener('DOMContentLoaded', () => {
    // Elementos do formulário de login e registro
    const loginForm = document.getElementById('loginForm');
    const registerForm = document.getElementById('registerForm');
    const registerContainer = document.getElementById('registerContainer');
    const loginContainer = document.querySelector('.wrap-login');
    const registerPopup = document.getElementById('registerPopup');
    const loginPopup = document.getElementById('loginPopup');
    const registerLink = document.getElementById('registerLink');
    const loginLink = document.getElementById('loginLink');
    const loginButton = document.getElementById('loginButton');
    const paymentButton = document.getElementById('paymentButton');
    const togglePassword = document.getElementById('togglePassword');
    const toggleRegisterPassword = document.getElementById('toggleRegisterPassword');
    const registerSubmit = document.getElementById('registerSubmit');
    const registerRedirectButton = document.getElementById('registerRedirectButton');
    const loginRedirectButton = document.getElementById('loginRedirectButton');
    const loginTimer = document.getElementById('loginTimer');
    const loginRedirectCountdown = document.getElementById('loginRedirectCountdown');
    const registerTimer = document.getElementById('registerTimer');
    const registerRedirectCountdown = document.getElementById('registerRedirectCountdown');
    const loginUserName = document.getElementById('loginUserName');
    const registerUserName = document.getElementById('registerUserName');
    let userName = 'Usuário'; // Substitua isso pelo nome real do usuário

    // Alternar visibilidade da senha
    togglePassword.addEventListener('click', () => {
        const passwordInput = document.getElementById('loginPassword');
        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            togglePassword.innerHTML = '<i class="material-icons">visibility_off</i>';
        } else {
            passwordInput.type = 'password';
            togglePassword.innerHTML = '<i class="material-icons">visibility</i>';
        }
    });

    toggleRegisterPassword.addEventListener('click', () => {
        const passwordInput = document.getElementById('registerPassword');
        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            toggleRegisterPassword.innerHTML = '<i class="material-icons">visibility_off</i>';
        } else {
            passwordInput.type = 'password';
            toggleRegisterPassword.innerHTML = '<i class="material-icons">visibility</i>';
        }
    });

    // Alternar entre login e registro
    registerLink.addEventListener('click', () => {
        loginContainer.style.display = 'none';
        registerContainer.style.display = 'block';
    });

    loginLink.addEventListener('click', () => {
        registerContainer.style.display = 'none';
        loginContainer.style.display = 'block';
    });

    // Formulário de login
    loginForm.addEventListener('submit', (event) => {
        event.preventDefault();
        showLoginPopup(userName);
    });

    // Formulário de registro
    registerForm.addEventListener('submit', (event) => {
        event.preventDefault();
        const name = document.getElementById('registerName').value;
        showRegisterPopup(name);
    });

    // Exibir popup de registro
    function showRegisterPopup(userName) {
        document.getElementById('registerUserName').textContent = userName;
        registerPopup.style.display = 'block';

        let timer = 5;
        let countdown = 3;

        const timerInterval = setInterval(() => {
            document.getElementById('registerTimer').textContent = timer;
            timer--;
            if (timer < 0) clearInterval(timerInterval);
        }, 1000);

        const countdownInterval = setInterval(() => {
            document.getElementById('registerRedirectCountdown').textContent = countdown;
            countdown--;
            if (countdown < 0) {
                clearInterval(countdownInterval);
                window.location.href = 'https://botmillion.github.io/telm/';
            }
        }, 1000);
    }

    // Exibir popup de login
    function showLoginPopup(userName) {
        document.getElementById('loginUserName').textContent = userName;
        loginPopup.style.display = 'block';

        let timer = 5;
        let countdown = 3;

        const timerInterval = setInterval(() => {
            document.getElementById('loginTimer').textContent = timer;
            timer--;
            if (timer < 0) clearInterval(timerInterval);
        }, 1000);

        const countdownInterval = setInterval(() => {
            document.getElementById('loginRedirectCountdown').textContent = countdown;
            countdown--;
            if (countdown < 0) {
                clearInterval(countdownInterval);
                window.location.href = 'https://botmillion.github.io/telm/';
            }
        }, 1000);
    }
});
