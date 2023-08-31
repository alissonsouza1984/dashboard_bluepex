<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Dashboard Linux</title>
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
                    <h2>Dashboard Linux</h2>
                    <p class="text-muted">Bem-vindo ao Dashboard Linux</p>
                </div>
                <form action="../includes/scripts/login_process.php" method="post">
                    <div class="mb-3">
                        <label for="username" class="form-label">Nome de Usuário</label>
                        <input type="text" class="form-control" id="username" name="username" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Senha</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Entrar</button>
                </form>
                <?php
                if (isset($_GET['error']) && $_GET['error'] === 'invalid_credentials') {
                    echo '<div class="alert alert-danger mt-3">Nome de usuário ou senha inválidos.</div>';
                }
                ?>
                <div class="mt-3 text-center">
                    <a href="cadastro.php">Cadastrar Usuário Novo</a> | <a href="reset_password.php">Esqueceu a Senha</a>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
