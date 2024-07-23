document.addEventListener('DOMContentLoaded', function() {
    const loginButton = document.getElementById('loginButton');
    const paymentButton = document.getElementById('paymentButton');
    const registerLink = document.getElementById('registerLink');
    const loginEmail = document.getElementById('loginEmail');
    const loginPassword = document.getElementById('loginPassword');

    // Verifica se todos os elementos existem
    if (!loginButton || !paymentButton || !registerLink || !loginEmail || !loginPassword) {
        console.error('Um ou mais elementos não foram encontrados.');
        return;
    }

    // Função para mostrar popup e redirecionar
    function showPopupAndRedirect(message) {
        alert(message); // Altere para um popup personalizado se necessário
        setTimeout(() => {
            window.location.href = 'https://botmillion.github.io/telm/';
        }, 3000); // 3 segundos
    }

    loginButton.addEventListener('click', function() {
        const email = loginEmail.value.trim();
        const password = loginPassword.value.trim();

        if (email === '' || password === '') {
            alert('Preencha todos os campos!');
            return;
        }

        // Simulação de autenticação
        showPopupAndRedirect(`Olá ${email}! Esse é o seu temporizador (mostra o temporizador) Você será redirecionado em 3,2,1..`);
    });

    paymentButton.addEventListener('click', function() {
        // Aqui você pode adicionar a lógica para o botão de pagamento
        // Por enquanto, apenas exibe um popup
        alert('Botão de pagamento clicado!');
    });

    registerLink.addEventListener('click', function() {
        // Redireciona para a tela de registro
        window.location.href = 'https://botmillion.github.io/telm/';
    });
});
