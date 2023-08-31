<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Redefinir Senha - Dashboard Bluepex</title>
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
        .reset-password-card {
            max-width: 400px;
            width: 100%;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            background-color: #fff;
        }
        .reset-password-logo {
            text-align: center;
            margin-bottom: 20px;
        }
        .reset-password-logo img {
            max-width: 150px;
            height: auto;
        }
        .password-label {
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div class="reset-password-card">
        <div class="reset-password-logo">
            <img src="https://icon-library.com/images/linux-server-icon/linux-server-icon-17.jpg" alt="Logo Bluepex">
            <h2 class="mt-3">Redefinir Senha</h2>
        </div>
        <form action="reset_password_process.php" method="post">
            <div class="mb-3">
                <label for="email" class="form-label">Email Cadastrado</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <button type="submit" class="btn btn-primary w-100">Enviar</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
