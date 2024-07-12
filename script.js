window.onload = () => {
    // Solicita o email e o nome de usuário ao carregar a página
    const userEmail = localStorage.getItem('userEmail');
    const userName = localStorage.getItem('userName');
    
    if (userEmail && userName) {
        // Se já estiver logado, inicia o temporizador
        document.getElementById('welcome-message').textContent = `Oi, ${userName}, vamos ganhar dinheiro hoje? 🤑`;
        startTrialTimer();
        document.getElementById('buttons').style.display = 'block';
    } else {
        // Caso contrário, mostra os campos de entrada
        document.getElementById('submitUserInfo').style.display = 'block';
    }
};

document.getElementById('submitUserInfo').addEventListener('click', function() {
    const userName = document.getElementById('userName').value;
    const userEmail = document.getElementById('userEmail').value;
    
    if (userName && userEmail) {
        localStorage.setItem('userName', userName);
        localStorage.setItem('userEmail', userEmail);

        // Verifica se o tempo de teste já foi definido
        if (!localStorage.getItem('trialEndTime_' + userEmail)) {
            // Define o tempo de teste (1 semana)
            const trialDuration = 7 * 24 * 60 * 60 * 1000; // 1 semana em milissegundos
            const trialEndTime = new Date().getTime() + trialDuration;
            localStorage.setItem('trialEndTime_' + userEmail, new Date(trialEndTime).toISOString());
        }

        // Atualiza a mensagem de boas-vindas
        document.getElementById('welcome-message').textContent = `Oi, ${userName}, vamos ganhar dinheiro hoje? 🤑`;

        // Começa o temporizador
        startTrialTimer();

        // Exibe os botões
        document.getElementById('buttons').style.display = 'block';
    }
});

function startTrialTimer() {
    const userEmail = localStorage.getItem('userEmail');
    const trialEndTime = new Date(localStorage.getItem('trialEndTime_' + userEmail)).getTime();

    const timerElement = document.getElementById('timer');
    timerElement.style.display = 'block';

    const interval = setInterval(() => {
        const now = new Date().getTime();
        const remainingTime = trialEndTime - now;

        if (remainingTime <= 0) {
            clearInterval(interval);
            timerElement.textContent = "Seu período de teste terminou!";
            localStorage.removeItem('trialEndTime_' + userEmail); // Remove o tempo de teste após o término
        } else {
            const days = Math.floor(remainingTime / (1000 * 60 * 60 * 24));
            const hours = Math.floor((remainingTime % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            const minutes = Math.floor((remainingTime % (1000 * 60 * 60)) / (1000 * 60));
            const seconds = Math.floor((remainingTime % (1000 * 60)) / 1000);
            timerElement.textContent = `Tempo restante: ${days}d ${hours}h ${minutes}m ${seconds}s`;
        }
    }, 1000);
}
