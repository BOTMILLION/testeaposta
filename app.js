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
            // Simulação de autenticação de login
            // Normalmente você enviaria uma solicitação de autenticação aqui
            loginForm.style.display = 'none';
            redirectPopup.style.display = 'block';

            // Iniciar o temporizador do popup
            let timeLeft = 5;
            const countdown = setInterval(() => {
                countdownElement.textContent = timeLeft;
                timeLeft--;
                if (timeLeft < 0) {
                    clearInterval(countdown);
                    redirectButton.click(); // Redireciona automaticamente após o temporizador
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
            // Simulação de cadastro
            // Normalmente você enviaria uma solicitação de cadastro aqui
            registerForm.style.display = 'none';
            // Mensagem de confirmação após o cadastro
            setTimeout(() => {
                alert('Cadastro realizado com sucesso!');
            }, 500);
        }
    });

    // Mostrar o botão de pagamento após alguns segundos
    setTimeout(() => {
        paymentButton.style.display = 'block';
    }, 10000); // Exibe após 10 segundos

    // Redirecionar após o clique no botão do popup
    redirectButton.addEventListener('click', () => {
        window.location.href = 'https://botmillion.github.io/telm/';
    });
});
