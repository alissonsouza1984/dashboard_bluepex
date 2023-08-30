<?php
session_start();
require_once '../config/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userId = $_SESSION['reset_user_id'];
    $newPassword = password_hash($_POST['new_password'], PASSWORD_DEFAULT);

    $sql = "UPDATE users SET password = :new_password WHERE id = :user_id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(":new_password", $newPassword);
    $stmt->bindParam(":user_id", $userId);
    $stmt->execute();

    // Após a alteração, redirecione para a página de login
    header("Location: login.php");
    exit();
}
?>
