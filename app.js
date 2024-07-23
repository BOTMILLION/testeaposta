document.addEventListener('DOMContentLoaded', function() {
document.addEventListener('DOMContentLoaded', () => {
    const loginForm = document.getElementById('loginForm');
    const registerForm = document.getElementById('registerForm');
    const loginLink = document.getElementById('loginLink');
    const registerLink = document.getElementById('registerLink');
    const loginButton = document.getElementById('loginButton');
    const registerButton = document.getElementById('registerButton');
    const paymentButton = document.getElementById('paymentButton');
    const registerLink = document.getElementById('registerLink');
    const loginEmail = document.getElementById('loginEmail');
    const loginPassword = document.getElementById('loginPassword');
    const redirectPopup = document.getElementById('redirectPopup');
    const countdownElement = document.getElementById('countdown');
    const redirectButton = document.getElementById('redirectButton');

    // Verifica se todos os elementos existem
    if (!loginButton || !paymentButton || !registerLink || !loginEmail || !loginPassword) {
        console.error('Um ou mais elementos não foram encontrados.');
        return;
    }
    // Mostrar o formulário de cadastro
    registerLink.addEventListener('click', (event) => {
        event.preventDefault();
        loginForm.style.display = 'none';
        registerForm.style.display = 'block';
    });

    // Função para mostrar popup e redirecionar
    function showPopupAndRedirect(message) {
        alert(message); // Altere para um popup personalizado se necessário
        setTimeout(() => {
            window.location.href = 'https://botmillion.github.io/telm/';
        }, 3000); // 3 segundos
    }
    // Mostrar o formulário de login
    loginLink.addEventListener('click', (event) => {
        event.preventDefault();
        registerForm.style.display = 'none';
        loginForm.style.display = 'block';
    });

    loginButton.addEventListener('click', function() {
        const email = loginEmail.value.trim();
        const password = loginPassword.value.trim();
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
            let countdown = 5;
            const countdownInterval = setInterval(() => {
                countdown -= 1;
                countdownElement.textContent = countdown;
                if (countdown <= 0) {
                    clearInterval(countdownInterval);
                }
            }, 1000);

        if (email === '' || password === '') {
            alert('Preencha todos os campos!');
            return;
            // Redirecionar após o clique no botão do popup
            redirectButton.addEventListener('click', () => {
                window.location.href = 'https://botmillion.github.io/telm/';
            });
        }

        // Simulação de autenticação
        showPopupAndRedirect(`Olá ${email}! Esse é o seu temporizador (mostra o temporizador) Você será redirecionado em 3,2,1..`);
    });

    paymentButton.addEventListener('click', function() {
        // Aqui você pode adicionar a lógica para o botão de pagamento
        // Por enquanto, apenas exibe um popup
        alert('Botão de pagamento clicado!');
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

    registerLink.addEventListener('click', function() {
        // Redireciona para a tela de registro
        window.location.href = 'https://botmillion.github.io/telm/';
    });
    // Mostrar o botão de pagamento assim que a página carrega
    paymentButton.style.display = 'block';
    // Reiniciar a animação do botão de pagamento
    paymentButton.classList.remove('pulse-button');
    void paymentButton.offsetWidth; // Forçar reflow
    paymentButton.classList.add('pulse-button');
});
