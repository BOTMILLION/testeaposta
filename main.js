document.addEventListener('DOMContentLoaded', () => {
    const loginButton = document.getElementById('loginButton');
    const registerLink = document.getElementById('registerLink');
    const errorMessage = document.getElementById('error-message');

    loginButton.addEventListener('click', () => {
        const email = document.getElementById('userEmail').value;
        const password = document.getElementById('userPassword').value;

        if (password.length < 6) {
            errorMessage.style.display = 'block';
        } else {
            errorMessage.style.display = 'none';
            // Adicione a lógica de login aqui
        }
    });

    registerLink.addEventListener('click', (event) => {
        event.preventDefault();
        const email = document.getElementById('userEmail').value;
        const password = document.getElementById('userPassword').value;

        if (password.length < 6) {
            errorMessage.style.display = 'block';
        } else {
            errorMessage.style.display = 'none';
            // Adicione a lógica de registro aqui
        }
    });
});


        try {
            const response = await fetch('/login', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({ email, password })
            });

            if (response.ok) {
                // Sucesso no login
                const result = await response.json();
                if (result.verified) {
                    // Redireciona após a verificação do email
                    window.location.href = 'https://botmillion.github.io/telm/';
                } else {
                    // Caso não esteja verificado
                    errorMessage.textContent = 'Email não verificado. Verifique seu e-mail.';
                    errorMessage.style.display = 'block';
                }
            } else {
                // Falha no login
                errorMessage.textContent = 'E-mail ou senha incorretos.';
                errorMessage.style.display = 'block';
            }
        } catch (error) {
            console.error('Erro ao fazer login:', error);
        }
    });

    // Lógica para o link de cadastro
    registerLink.addEventListener('click', () => {
        // Substitua pela URL de cadastro, se aplicável
        window.location.href = 'https://verificacaoemail-cc8a32ff048a.herokuapp.com/register';
    });
});
