// Função para buscar mensagens do Telegram e exibi-las
async function fetchTelegramMessages() {
    try {
        const response = await fetch('/get-telegram-messages');
        if (response.ok) {
            const data = await response.json();
            const messageElement = document.getElementById('telegram-messages');
            messageElement.style.display = 'block';
            messageElement.textContent = data.message;
        } else {
            console.error('Erro ao buscar mensagens do Telegram:', response.statusText);
        }
    } catch (error) {
        console.error('Erro ao buscar mensagens do Telegram:', error);
    }
}

// Atualiza mensagens do Telegram a cada 5 segundos
setInterval(fetchTelegramMessages, 5000);

// Busca a primeira mensagem ao carregar a página
fetchTelegramMessages();
