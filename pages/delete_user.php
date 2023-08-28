<?php
session_start();
require_once '../config/db.php';

// Verificar se o usuário está logado
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Verificar se o ID do usuário está presente na URL
if (!isset($_GET['id']) || empty($_GET['id'])) {
    header("Location: dashboard_info.php"); // Redirecionar de volta à página de dashboard
    exit();
}

$user_id = $_SESSION['user_id'];
$id = $_GET['id'];

// Verificar se o usuário tem permissão para excluir este usuário (você pode adicionar suas próprias verificações aqui)

// Exibir mensagem de confirmação antes de excluir
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['confirm_delete'])) {
    // Excluir o usuário do banco de dados
    $deleteSql = "DELETE FROM users WHERE id = :id";
    $deleteStmt = $pdo->prepare($deleteSql);
    $deleteStmt->bindParam(":id", $id);
    $deleteStmt->execute();

    // Redirecionar para a página de dashboard após a exclusão
    header("Location: dashboard_info.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmar Exclusão - Dashboard Bluepex</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2>Confirmar Exclusão</h2>
        <p>Você está prestes a excluir um usuário. Esta ação não pode ser desfeita. Deseja realmente prosseguir?</p>
        <form method="post">
            <button type="submit" name="confirm_delete" class="btn btn-danger">Confirmar Exclusão</button>
            <a href="dashboard_info.php" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
