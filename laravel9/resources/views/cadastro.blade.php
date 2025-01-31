<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Moodle</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
    <style>
        /* Reseta margens e define o layout básico */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Roboto', sans-serif;
            background-color: #fff;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh; /* Ocupa a tela toda */
            color: #333;
        }

        .login-container {
            background-color: #ffffff;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
            text-align: center;
        }

        .login-container h1 {
            margin-bottom: 20px;
            font-size: 24px;
            color: #333;
        }

        .login-container input {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 16px;
        }

        .login-container button {
            width: 100%;
            padding: 12px;
            border: none;
            border-radius: 5px;
            background-color: #09a7ab;
            color: white;
            font-size: 16px;
            cursor: pointer;
        }

        .login-container button:hover {
            background-color: #077a7a;
        }
    </style>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <div class="login-container">
        <h1>CADASTRO SISTEMA MENSAGEM</h1>
        <form id="loginForm">
            @csrf
            <input type="text" id="username" name="username" placeholder="Usuário" required>
            <input type="password" id="password" name="password" placeholder="Senha" required>
            <button type="submit">Entrar</button>
        </form>
    </div>

    <script>
        $('#loginForm').submit(function(e) {
            e.preventDefault(); // Previne o envio tradicional do formulário

            let username = $('#username').val();
            let password = $('#password').val();

            $.ajax({
                url: "{{ url('api/loginMensagem') }}", // URL da rota API
                method: 'POST',
                data: {
                    _token: "{{ csrf_token() }}",
                    email: username, // Aqui, "email" deve corresponder à entrada esperada pela API
                    password: password
                },
                success: function(response) {
                    alert("Login bem-sucedido! Token: " + response.token);
                },
                error: function(xhr, status, error) {
                    alert("Erro ao tentar fazer login: " + xhr.responseJSON.error);
                }
            });
        });
    </script>
</body>
</html>
