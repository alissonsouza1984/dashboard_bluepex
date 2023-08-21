<?php
session_start();
require_once '../../config/db.php'; // Caminho para o arquivo de configuração do banco de dados

// Exibir erros no navegador (apenas para ambiente de desenvolvimento)
error_reporting(E_ALL);
ini_set('display_errors', '1');

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    $sql = "SELECT id, username, password FROM users WHERE username = :username";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(":username", $username);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['password'])) {
        // Iniciar sessão e armazenar ID do usuário na variável de sessão
        $_SESSION['user_id'] = $user['id'];

        // Redirecionar para a página da dashboard
        header("Location: ../../pages/dashboard.php");
        exit();
    } else {
        header("Location: ../../pages/login.php?error=login_failed");
        exit();
    }
}
?>
