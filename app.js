<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bem-vindo ao Site</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/material-design-iconic-font/2.2.0/css/material-design-iconic-font.min.css">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background: url('https://i.imgur.com/Rv500de.jpg') no-repeat center center fixed;
            background-size: cover;
        }
        .wrap-login {
            width: 390px;
            height: 70vh;
            background: rgba(255, 255, 255, 0.9);
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            position: relative;
            text-align: center;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }
        .logo {
            width: 150px;
            margin-bottom: 20px;
        }
        .welcome-text {
            font-size: 30px;
            font-family: 'Poppins', sans-serif;
            font-weight: bold;
            color: #c8102e;
            width: 280px;
            height: 62px;
            line-height: 62px;
            text-align: center;
            margin-bottom: 20px;
        }
        .form-login {
            width: 280px;
            height: 540px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            position: relative;
        }
        .line {
            position: relative;
            width: 100%;
            margin: 20px 0;
        }
        .line input {
            border: none;
            border-bottom: 1px solid #c8102e;
            width: 100%;
            padding: 10px 0;
            font-size: 16px;
            outline: none;
            background: transparent;
            color: #333;
        }
        .line label {
            position: absolute;
            top: 0;
            left: 0;
            font-size: 14px;
            color: #c8102e;
            transition: 0.3s;
        }
        .line input:focus + label,
        .line input:not(:placeholder-shown) + label {
            top: -20px;
            left: 0;
            font-size: 12px;
        }
        .custom-button {
            background: linear-gradient(45deg, #c8102e, #a3141e);
            border: none;
            color: white;
            padding: 15px 30px;
            font-size: 16px;
            border-radius: 50px;
            cursor: pointer;
            overflow: hidden;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            transition: transform 0.3s ease, box-shadow 0.3s ease, background 0.3s ease;
            margin: 10px 0;
            width: 100%;
            position: relative;
        }
        .custom-button:before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.1), rgba(0, 0, 0, 0.1));
            opacity: 0;
            transition: opacity 0.3s ease;
            z-index: 1;
        }
        .custom-button:hover:before {
            opacity: 0.3;
        }
        .custom-button:active {
            transform: scale(0.95);
        }
        .pulse-button {
            animation: pulse 1.5s infinite;
        }
        @keyframes pulse {
            0% {
                transform: scale(1);
                opacity: 0.7;
            }
            50% {
                transform: scale(1.05);
                opacity: 1;
            }
            100% {
                transform: scale(1);
                opacity: 0.7;
            }
        }
        .info-text {
            font-size: 14px;
            color: #666;
            text-align: center;
            margin-top: 20px;
        }
        .info-text a {
            color: #c8102e;
            text-decoration: none;
        }
        .info-text a:hover {
            text-decoration: underline;
        }
        .popup {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            padding: 20px;
            text-align: center;
            z-index: 1000;
        }
        .popup h2 {
            margin: 0;
            color: #c8102e;
        }
        .popup p {
            font-size: 18px;
        }
        .popup .timer {
            font-size: 24px;
            font-weight: bold;
            color: #c8102e;
        }
        .popup .button {
            background: linear-gradient(45deg, #c8102e, #a3141e);
            border: none;
            color: white;
            padding: 10px 20px;
            font-size: 16px;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 20px;
        }
        .popup .button:hover {
            background: linear-gradient(45deg, #a3141e, #c8102e);
        }
        .line .zmdi-eye, .line .zmdi-eye-off {
            font-size: 18px;
            position: absolute;
            right: 10px;
            top: 10px;
            cursor: pointer;
        }
        @media (max-width: 600px) {
            .wrap-login {
                width: 95%;
                height: 70vh;
                padding: 10px;
            }
            .form-login {
                width: 100%;
                height: auto;
            }
            .custom-button {
                padding: 10px 20px;
                font-size: 14px;
            }
            .welcome-text {
                font-size: 24px;
            }
        }
    </style>
    <!-- Adicione o SDK do Firebase -->
    <script defer src="https://www.gstatic.com/firebasejs/9.6.10/firebase-app.js"></script>
    <script defer src="https://www.gstatic.com/firebasejs/9.6.10/firebase-auth.js"></script>
    <script defer src="https://www.gstatic.com/firebasejs/9.6.10/firebase-firestore.js"></script>
</head>
<body>
    <div class="wrap-login">
        <img src="https://i.imgur.com/zWOAVrg.png" alt="Logo" class="logo">
        <div class="welcome-text">Bem Vindo</div>
        <!-- Formulário de Login -->
        <div class="form-login" id="loginForm">
            <div class="line">
                <input type="email" id="loginEmail" placeholder=" " required>
                <label for="loginEmail">Seu Email</label>
            </div>
            <div class="line">
                <input type="password" id="loginPassword" placeholder=" " required>
                <label for="loginPassword">Sua Senha</label>
                <i class="zmdi zmdi-eye" id="togglePassword"></i>
            </div>
            <div id="loginError" style="color: red; display: none;">Por favor, preencha todos os campos corretamente.</div>
            <button class="custom-button" id="loginButton">LOGIN</button>
            <button class="custom-button pulse-button" id="paymentButton">REALIZAR PAGAMENTO</button>
            <div class="info-text">
                Não tem uma conta? <a href="#" id="registerLink">Cadastre-se</a>
            </div>
        </div>

        <!-- Formulário de Cadastro -->
        <div class="form-login" id="registerForm" style="display: none;">
            <div class="line">
                <input type="text" id="registerName" placeholder=" " required>
                <label for="registerName">Seu Nome</label>
            </div>
            <div class="line">
                <input type="email" id="registerEmail" placeholder=" " required>
                <label for="registerEmail">Seu Email</label>
            </div>
            <div class="line">
                <input type="password" id="registerPassword" placeholder=" " required>
                <label for="registerPassword">Sua Senha</label>
                <i class="zmdi zmdi-eye" id="toggleRegisterPassword"></i>
            </div>
            <div id="registerError" style="color: red; display: none;">Por favor, preencha todos os campos corretamente.</div>
            <button class="custom-button" id="registerButton">CADASTRAR</button>
            <div class="info-text">
                Já tem uma conta? <a href="#" id="loginLink">Faça login</a>
            </div>
        </div>

        <!-- Popup -->
        <div class="popup" id="popup">
            <h2>Seu Tempo Está Acabando</h2>
            <p>Você tem mais:</p>
            <p class="timer" id="timer">00:00</p>
            <button class="button" id="popupButton">OK</button>
        </div>
    </div>

    <!-- Scripts -->
    <script>
        // Configuração do Firebase
        const firebaseConfig = {
            apiKey: "AIzaSyCKw5ZcJBcTvf1onPtkzgvJqlRAsbUqauk",
            authDomain: "robo-7937c.firebaseapp.com",
            projectId: "robo-7937c",
            storageBucket: "robo-7937c.appspot.com",
            messagingSenderId: "444396924434",
            appId: "1:444396924434:web:46b93323f9c22d90ac32cb",
            measurementId: "G-G4NYL1GXGW"
        };

        // Inicialize o Firebase
        firebase.initializeApp(firebaseConfig);

        // Referências para autenticação e banco de dados
        const auth = firebase.auth();
        const firestore = firebase.firestore();

        // Função de login
        document.getElementById('loginButton').addEventListener('click', () => {
            const email = document.getElementById('loginEmail').value;
            const password = document.getElementById('loginPassword').value;

            if (email && password) {
                auth.signInWithEmailAndPassword(email, password)
                    .then((userCredential) => {
                        const user = userCredential.user;
                        // Redirecione para o conteúdo protegido ou para a página de destino
                        window.location.href = 'https://vaidebet.com/ptb/games/livecasino/detail/normal/18198/evol_TopCard000000001_BRL';
                    })
                    .catch((error) => {
                        console.error('Erro ao fazer login:', error.message);
                        document.getElementById('loginError').style.display = 'block';
                    });
            } else {
                document.getElementById('loginError').style.display = 'block';
            }
        });

        // Função de cadastro
        document.getElementById('registerButton').addEventListener('click', () => {
            const name = document.getElementById('registerName').value;
            const email = document.getElementById('registerEmail').value;
            const password = document.getElementById('registerPassword').value;

            if (name && email && password.length >= 6) {
                auth.createUserWithEmailAndPassword(email, password)
                    .then((userCredential) => {
                        const user = userCredential.user;
                        // Salve o nome do usuário no Firestore
                        firestore.collection('users').doc(user.uid).set({
                            name: name,
                            email: email
                        })
                        .then(() => {
                            console.log('Usuário registrado com sucesso!');
                            document.getElementById('registerForm').style.display = 'none';
                            document.getElementById('loginForm').style.display = 'block';
                        })
                        .catch((error) => {
                            console.error('Erro ao salvar o usuário:', error.message);
                        });
                    })
                    .catch((error) => {
                        console.error('Erro ao criar conta:', error.message);
                        document.getElementById('registerError').style.display = 'block';
                    });
            } else {
                document.getElementById('registerError').style.display = 'block';
            }
        });

        // Mostrar/ocultar senha
        document.getElementById('togglePassword').addEventListener('click', () => {
            const passwordInput = document.getElementById('loginPassword');
            const type = passwordInput.type === 'password' ? 'text' : 'password';
            passwordInput.type = type;
        });

        document.getElementById('toggleRegisterPassword').addEventListener('click', () => {
            const passwordInput = document.getElementById('registerPassword');
            const type = passwordInput.type === 'password' ? 'text' : 'password';
            passwordInput.type = type;
        });

        // Alternar entre login e cadastro
        document.getElementById('registerLink').addEventListener('click', () => {
            document.getElementById('loginForm').style.display = 'none';
            document.getElementById('registerForm').style.display = 'block';
        });

        document.getElementById('loginLink').addEventListener('click', () => {
            document.getElementById('registerForm').style.display = 'none';
            document.getElementById('loginForm').style.display = 'block';
        });

        // Botão de pagamento
        document.getElementById('paymentButton').addEventListener('click', () => {
            window.location.href = 'https://seusite.yampi.com.br';
        });

        // Popup de tempo restante
        const popup = document.getElementById('popup');
        const timerElement = document.getElementById('timer');
        let timeLeft = 300; // Tempo em segundos

        function updateTimer() {
            const minutes = Math.floor(timeLeft / 60);
            const seconds = timeLeft % 60;
            timerElement.textContent = `${minutes}:${seconds < 10 ? '0' : ''}${seconds}`;
            if (timeLeft > 0) {
                timeLeft--;
                setTimeout(updateTimer, 1000);
            } else {
                popup.style.display = 'block';
            }
        }

        document.getElementById('popupButton').addEventListener('click', () => {
            popup.style.display = 'none';
        });

        updateTimer();
    </script>
</body>
</html>
