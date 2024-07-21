document.addEventListener('DOMContentLoaded', () => {
    const loginButton = document.getElementById('loginButton');
    const registerLink = document.getElementById('registerLink');
    const errorMessage = document.getElementById('error-message');

    loginButton.addEventListener('click', async () => {
        const email = document.getElementById('userEmail').value;
        const password = document.getElementById('userPassword').value;

        if (password.length < 6) {
            errorMessage.textContent = 'A senha deve ter pelo menos 6 caracteres.';
            errorMessage.style.display = 'block';
        } else {
            errorMessage.style.display = 'none';
            try {
                const response = await fetch('/login', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({ email, password })
                });

                if (response.ok) {
                    const result = await response.json();
                    if (result.verified) {
                        window.location.href = 'https://botmillion.github.io/telm/';
                    } else {
                        errorMessage.textContent = 'Email não verificado. Verifique seu e-mail.';
                        errorMessage.style.display = 'block';
                    }
                } else {
                    errorMessage.textContent = 'E-mail ou senha incorretos.';
                    errorMessage.style.display = 'block';
                }
            } catch (error) {
                console.error('Erro ao fazer login:', error);
                errorMessage.textContent = 'Erro ao fazer login. Tente novamente mais tarde.';
                errorMessage.style.display = 'block';
            }
        }
    });

    registerLink.addEventListener('click', async (event) => {
        event.preventDefault();
        const email = document.getElementById('userEmail').value;
        const password = document.getElementById('userPassword').value;

        if (password.length < 6) {
            errorMessage.textContent = 'A senha deve ter pelo menos 6 caracteres.';
            errorMessage.style.display = 'block';
        } else {
            errorMessage.style.display = 'none';
            try {
                const response = await fetch('/register', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({ email, password })
                });

                if (response.ok) {
                    alert('Cadastro realizado com sucesso! Verifique seu e-mail para confirmar.');
                } else {
                    const errorText = await response.text();
                    errorMessage.textContent = errorText;
                    errorMessage.style.display = 'block';
                }
            } catch (error) {
                console.error('Erro ao fazer registro:', error);
                errorMessage.textContent = 'Erro ao fazer registro. Tente novamente mais tarde.';
                errorMessage.style.display = 'block';
            }
        }
    });
});
