<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alterar Senha - Dashboard Bluepex</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f7f9fc;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .change-password-card {
            max-width: 400px;
            width: 100%;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            background-color: #fff;
        }
        .change-password-logo {
            text-align: center;
            margin-bottom: 20px;
        }
        .change-password-logo img {
            max-width: 150px;
            height: auto;
        }
        .password-label {
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div class="change-password-card">
        <div class="change-password-logo">
            <img src="https://suite.bluepex.com.br/public/images/logo-responsive.png" alt="Logo Bluepex">
            <h2 class="mt-3">Alterar Senha</h2>
        </div>
        <?php
            if (isset($_GET['success']) && $_GET['success'] === 'true') {
                echo '<div class="alert alert-success" role="alert">Senha alterada com sucesso!</div>';
            }
        ?>
        <form action="change_password_process.php" method="post">
            <div class="mb-3">
                <label for="new_password" class="form-label password-label">Nova Senha</label>
                <input type="password" class="form-control" id="new_password" name="new_password" required>
            </div>
            <div class="mb-3">
                <label for="confirm_password" class="form-label password-label">Confirmar Nova Senha</label>
                <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
            </div>
            <button type="submit" class="btn btn-primary w-100">Alterar Senha</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
