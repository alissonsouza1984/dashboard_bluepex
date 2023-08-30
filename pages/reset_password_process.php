<?php
session_start();
require_once '../config/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];

    $sql = "SELECT id, username FROM users WHERE email = :email";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(":email", $email);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        // Se o email estiver cadastrado, redirecione para a página de alteração de senha
        $_SESSION['reset_user_id'] = $user['id'];
        header("Location: change_password.php");
        exit();
    } else {
        // Se o email não estiver cadastrado, mostre uma mensagem de erro
        header("Location: reset_password.php?error=email_not_found");
        exit();
    }
}
?>
