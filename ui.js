// ui.js

const HOME_URL = 'https://botmillion.github.io/testeaposta/';
const PAYMENT_URL = 'https://checkout.suitpay.app/italo-oliveria/bcbe785c836badbb1c18c24a0c1ac51e';

export const handleError = (elementId, message) => {
    const errorElement = document.getElementById(elementId);
    if (errorElement) {
        errorElement.textContent = message;
        errorElement.style.display = 'block';
    }
};

export const showRegistrationMessage = (registrationDate, trialEndDate) => {
    const startDate = new Date(registrationDate);
    const endDate = new Date(trialEndDate);

    document.getElementById('registrationMessage').style.display = 'block';
    document.getElementById('registrationMessage').innerHTML = `
        <h2>Usuário cadastrado!</h2>
        <p>Para realizar o login, verifique o seu e-mail.</p>
        <p>Este é o seu temporizador do período grátis de 3 dias.</p>
        <p>Ao esgotar, realize o pagamento para continuar utilizando nossos serviços.</p>
        <p>Seu período de teste começa em: ${startDate.toLocaleDateString()} às ${startDate.toLocaleTimeString()}</p>
        <p>Seu período de teste termina em: ${endDate.toLocaleDateString()} às ${endDate.toLocaleTimeString()}</p>
        <button id="closePopupButton">FECHAR</button>
    `;

    document.getElementById('closePopupButton').addEventListener('click', () => {
        window.location.href = HOME_URL; // Redirecionar para o início
    });
};

export const showPaymentPopup = () => {
    document.getElementById('paymentPopup').style.display = 'block';
    document.getElementById('paymentNowButton').addEventListener('click', () => {
        window.location.href = PAYMENT_URL;
    });
};
