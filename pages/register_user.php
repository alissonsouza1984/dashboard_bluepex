<?php
session_start();
require_once '../config/db.php'; // Caminho para o arquivo de configuração do banco de dados

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = $_POST["username"];
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT); // Hash da senha
    $email = $_POST["email"];

    // Verificar se o nome de usuário já existe
    $checkUsernameSql = "SELECT id FROM users WHERE username = :username";
    $checkUsernameStmt = $pdo->prepare($checkUsernameSql);
    $checkUsernameStmt->bindParam(":username", $username);
    $checkUsernameStmt->execute();

    if ($checkUsernameStmt->rowCount() > 0) {
        $_SESSION['registration_error'] = "O nome de usuário já está em uso.";
        header("Location: dashboard.php");
        exit();
    }

    // Inserir o novo usuário no banco de dados
    $insertSql = "INSERT INTO users (username, password, email) VALUES (:username, :password, :email)";
    $insertStmt = $pdo->prepare($insertSql);
    $insertStmt->bindParam(":username", $username);
    $insertStmt->bindParam(":password", $password);
    $insertStmt->bindParam(":email", $email);

    if ($insertStmt->execute()) {
        $_SESSION['registration_success'] = "Usuário cadastrado com sucesso!";
        header("Location: dashboard.php");
        exit();
    } else {
        $_SESSION['registration_error'] = "Erro ao cadastrar o usuário. Por favor, tente novamente mais tarde.";
        header("Location: dashboard.php");
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Novo Usuário - Dashboard Bluepex</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2>Cadastrar Novo Usuário</h2>
        <?php
        if (isset($_SESSION['registration_error'])) {
            echo '<div class="alert alert-danger" role="alert">' . $_SESSION['registration_error'] . '</div>';
            unset($_SESSION['registration_error']);
        }
        ?>
        <form action="" method="post">
            <div class="mb-3">
                <label for="username" class="form-label">Nome de Usuário</label>
                <input type="text" class="form-control" id="username" name="username" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Senha</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <button type="submit" class="btn btn-primary">Cadastrar</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
