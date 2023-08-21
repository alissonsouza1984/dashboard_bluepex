<?php
$host = "localhost"; // Endereço do servidor MySQL (normalmente "localhost")
$dbname = "dashboard_bluepex"; // Nome do banco de dados
$username = "alisson"; // Usuário do MySQL
$password = "pokas"; // Senha do MySQL

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erro ao conectar com o banco de dados: " . $e->getMessage());
}
?>
