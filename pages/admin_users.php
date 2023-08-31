<?php
session_start();
require_once '../config/db.php';

// Verificar se o usuário está logado
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Recuperar dados do usuário logado
$user_id = $_SESSION['user_id'];
$sql = "SELECT username FROM users WHERE id = :user_id";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(":user_id", $user_id);
$stmt->execute();
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$user) {
    die("Usuário não encontrado");
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administração de Usuários - Dashboard Bluepex</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h2>Administração de Usuários</h2>
        <p>Bem-vindo, <?php echo $user['username']; ?>!</p>

        <!-- Aqui você pode adicionar formulários e tabelas para manipular os usuários -->
        <!-- Exemplo: Formulário para adicionar um novo usuário -->
        <form action="add_user.php" method="post">
            <div class="mb-3">
                <label for="new_username">Novo Usuário:</label>
                <input type="text" class="form-control" id="new_username" name="new_username" required>
            </div>
            <div class="mb-3">
                <label for="new_password">Nova Senha:</label>
                <input type="password" class="form-control" id="new_password" name="new_password" required>
            </div>
            <button type="submit" class="btn btn-primary">Adicionar Usuário</button>
        </form>

        <!-- Aqui você pode listar os usuários existentes e fornecer opções para editar/excluir -->
        <!-- Exemplo: Lista de usuários -->
        <table class="table">
            <thead>
                <tr>
                    <th>Usuário</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <!-- Aqui você pode adicionar os registros de usuários e os botões de ação -->
            </tbody>
        </table>

        <a href="dashboard.php" class="btn btn-secondary">Voltar para a Dashboard</a>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
