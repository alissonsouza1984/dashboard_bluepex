<?php
require_once '../config/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Encripta a senha

    // Verifica se é o primeiro usuário
    $stmt = $db->prepare("SELECT COUNT(*) FROM users");
    $stmt->execute();
    $userCount = $stmt->fetchColumn();

    if ($userCount === 0) {
        $nivelAcesso = 'admin'; // Nível de acesso especial para o primeiro usuário
    } else {
        $nivelAcesso = 'usuario'; // Nível de acesso padrão para os demais usuários
    }

    // Insere os dados na tabela 'users'
    $query = "INSERT INTO users (username, email, password, nivel_acesso) VALUES (?, ?, ?, ?)";
    $stmt = $db->prepare($query);

    if ($stmt->execute([$username, $email, $password, $nivelAcesso])) {
        // Redireciona para a página de login após o cadastro
        header('Location: login.php');
        exit;
    } else {
        echo "Erro ao cadastrar usuário.";
    }
}
?>
