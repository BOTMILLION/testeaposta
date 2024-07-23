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
            // Aqui você pode adicionar a lógica de login e autenticação
            loginForm.style.display = 'none';
            redirectPopup.style.display = 'block';

            // Iniciar o temporizador do popup
            let timeLeft = 5;
            const countdown = setInterval(() => {
                countdownElement.textContent = timeLeft;
                timeLeft--;
                if (timeLeft < 0) {
                    clearInterval(countdown);
                    redirectButton.click();
                }
            }, 1000);
        }
    });

    // Manipular o clique no botão de cadastro
    registerButton.addEventListener('click', () => {
        const password = document.getElementById('registerPassword').value;
        if (password.length < 6) {
            document.getElementById('registerError').style.display = 'block';
        } else {
            document.getElementById('registerError').style.display = 'none';
            // Aqui você pode adicionar a lógica de cadastro
            registerForm.style.display = 'none';
            confirmationMessage.style.display = 'block';

            // Redirecionar após alguns segundos
            setTimeout(() => {
                window.location.href = 'https://botmillion.github.io/telm/';
            }, 3000);
        }
    });

    // Mostrar o botão de pagamento após alguns segundos
    setTimeout(() => {
        paymentButton.style.display = 'block';
    }, 10000); // Exibe após 10 segundos
});
