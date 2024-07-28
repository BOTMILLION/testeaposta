// redirect.js

const REDIRECT_URL = 'https://botmillion.github.io/telm/';
const HOME_URL = 'https://botmillion.github.io/testeaposta/';

export const startRedirect = (endDate) => {
    const now = new Date();
    const timeLeft = endDate - now;

    if (timeLeft <= 0) {
        window.location.href = REDIRECT_URL;
        return;
    }

    const interval = setInterval(() => {
        const now = new Date();
        const timeLeft = endDate - now;

        if (timeLeft <= 0) {
            clearInterval(interval);
            window.location.href = REDIRECT_URL;
        } else {
            const days = Math.floor(timeLeft / (1000 * 60 * 60 * 24));
            const hours = Math.floor((timeLeft % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            const minutes = Math.floor((timeLeft % (1000 * 60 * 60)) / (1000 * 60));
            const seconds = Math.floor((timeLeft % (1000 * 60)) / 1000);
            
            document.getElementById('redirectTimer').textContent = `${days}d ${hours}h ${minutes}m ${seconds}s`;
        }
    }, 1000);
};
