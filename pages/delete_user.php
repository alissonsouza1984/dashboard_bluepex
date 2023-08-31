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

// Excluir o usuário do banco de dados
$deleteSql = "DELETE FROM users WHERE id = :id";
$deleteStmt = $pdo->prepare($deleteSql);
$deleteStmt->bindParam(":id", $id);
$deleteStmt->execute();

// Verificar se o usuário excluído é o mesmo que está logado
if ($id === $user_id) {
    // O usuário atual foi excluído, redirecionar para a página de login
    session_destroy(); // Encerrar a sessão do usuário
    header("Location: login.php");
    exit();
} else {
    // Redirecionar de volta para a página de dashboard
    header("Location: dashboard_info.php");
    exit();
}
?>


