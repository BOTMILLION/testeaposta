<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bem-vindo ao Site</title>
    <link rel="stylesheet" href="styles.css">
    <script type="module" src="app.js" defer></script>
</head>
<body>
    <div id="loginContainer" class="container">
        <h1>Faça Login</h1>
        <input type="email" id="userEmail" placeholder="Seu Email" required>
        <input type="password" id="userPassword" placeholder="Sua Senha" required>
        <div id="error-message" style="display: none;">A senha deve ter pelo menos 6 caracteres.</div>
        <button id="loginButton" class="button">LOGIN</button>
        <button id="paymentButton" onclick="window.location.href='https://checkout.yampi.com/checkout-link-seu-produto'">REALIZAR PAGAMENTO</button>
        <div id="welcome-message"></div>
        <div id="timer" style="display: none;"></div>
        <div id="buttons" style="display: none;">
            <a href="https://botmillion.github.io/testeaposta/" class="button">JOGUE AGORA</a>
        </div>
        <div id="cadastro-link">
            <span>Não tem uma conta? <a href="#" id="registerLink">Cadastre-se</a></span>
        </div>
    </div>

    <div id="registerContainer" class="container" style="display: none;">
        <h1>Cadastro</h1>
        <input type="text" id="userName" placeholder="Seu Nome" required>
        <input type="email" id="userEmail" placeholder="Seu Email" required>
        <input type="password" id="userPassword" placeholder="Sua Senha" required>
        <div id="error-message" style="display: none;">A senha deve ter pelo menos 6 caracteres.</div>
        <button id="registerButton" class="button">CADASTRAR</button>
        <button id="paymentButton" onclick="window.location.href='https://checkout.yampi.com/checkout-link-seu-produto'">REALIZAR PAGAMENTO</button>
        <div id="cadastro-link">
            <span>Já tem uma conta? <a href="#" id="loginLink">Login</a></span>
        </div>
    </div>
</body>
</html>
