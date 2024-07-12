function createMoneyTrail(e) {
    const moneyIcon = document.createElement('img');
    moneyIcon.src = 'https://image.shutterstock.com/image-vector/dollar-symbol-vector-260nw-751574925.jpg'; // Substitua pela URL de uma imagem de ícone de dinheiro
    moneyIcon.className = 'money-icon';
    document.body.appendChild(moneyIcon);

    moneyIcon.style.left = `${e.clientX}px`;
    moneyIcon.style.top = `${e.clientY}px`;

    setTimeout(() => {
        moneyIcon.remove();
    }, 1000);
}

function playNow() {
    const userId = localStorage.getItem('userId');
    if (userId) {
        window.location.href = "https://vaidebet.com/ptb/games/livecasino/detail/normal/18198/evol_TopCard000000001_BRL";
    } else {
        alert("Por favor, cadastre-se ou faça login primeiro.");
    }
}

function redirectToLogin() {
    const loginUrl = "https://vaidebet.com/ptb/bet/main";
    const redirectUrl = window.location.href;
    window.location.href = `${loginUrl}?redirect=${encodeURIComponent(redirectUrl)}`;
}

function startTrialTimer() {
    const userId = localStorage.getItem('userId');
    if (!userId) return;

    const endTime = new Date(localStorage.getItem(`trialEndTime_${userId}`));
    const timerElement = document.getElementById('timer');

    function updateTimer() {
        const now = new Date();
        const timeLeft = endTime - now;

        if (timeLeft > 0) {
            const days = Math.floor(timeLeft / (1000 * 60 * 60 * 24));
            const hours = Math.floor((timeLeft % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            const minutes = Math.floor((timeLeft % (1000 * 60 * 60)) / (1000 * 60));
            const seconds = Math.floor((timeLeft % (1000 * 60)) / 1000);
            timerElement.textContent = `Tempo restante: ${days}d ${hours}h ${minutes}m ${seconds}s`;
        } else {
            timerElement.textContent = 'Seu período de teste terminou. Por favor, faça o pagamento para continuar usando.';
            clearInterval(timerInterval);
        }
    }

    updateTimer();
    const timerInterval = setInterval(updateTimer, 1000);
}

window.onload = () => {
    // Simulando a lógica de login e armazenamento de ID do usuário
    const urlParams = new URLSearchParams(window.location.search);
    const userId = urlParams.get('userId');
    const userName = urlParams.get('userName');

    if (userId) {
        localStorage.setItem('userId', userId);
        localStorage.setItem('userName', userName);
        const trialDuration = 7 * 24 * 60 * 60 * 1000; // 1 semana em milissegundos
        const trialEndTime = new Date().getTime() + trialDuration;
        localStorage.setItem(`trialEndTime_${userId}`, new Date(trialEndTime).toISOString());
    }

    const storedUserId = localStorage.getItem('userId');
    const storedUserName = localStorage.getItem('userName');

    if (storedUserId && storedUserName) {
        document.getElementById('welcome-message').textContent = `Oi, ${storedUserName}, vamos ganhar dinheiro hoje? 🤑`;
    }

    startTrialTimer();
}
