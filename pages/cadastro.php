<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro - Dashboard Bluepex</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
           .login-container {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }
        .login-logo {
            text-align: center;
            margin-bottom: 20px;
        }
        .login-logo img {
            max-width: 228px; /* Largura da imagem */
            height: auto;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="card">
            <div class="card-body">
                <div class="login-logo">
                    <img src="https://icon-library.com/images/linux-server-icon/linux-server-icon-17.jpg" alt="Logo Linux">
                    <h2>Cadastro de Usuários </h2>
                    <p class="text-muted">Faça seu cadastro abaixo para acessar a dashboard</p>
                </div>
                    <div class="card-body">
                        <form action="../includes/scripts/cadastro_process.php" method="post">
                            <div class="mb-3">
                                <label for="username" class="form-label">Nome de Usuário</label>
                                <input placeholder="digite seu usuário" type="text" class="form-control" id="username" name="username" required>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Senha</label>
                                <input placeholder="digite sua senha" type="password" class="form-control" id="password" name="password" required>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input placeholder="digite um e-mail valido" type="email" class="form-control" id="email" name="email" required>
                            </div>
                            <button type="submit" class="btn btn-primary w-100">Cadastrar</button>
                        </form>
                        <div class="mt-3 text-center">
                            <a href="login.php">Voltar para Login</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
