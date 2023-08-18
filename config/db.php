<?php
// Configurações do banco de dados
$host = 'localhost';  // Endereço do servidor MySQL
$dbname = 'dashboard_bluepex_db'; // Nome do banco de dados
$username = 'seu_usuario_do_mysql'; // Seu nome de usuário do banco de dados
$password = 'sua_senha_do_mysql'; // Sua senha do banco de dados

try {
    // Cria a conexão PDO
    $db = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die('Erro ao conectar com o banco de dados: ' . $e->getMessage());
}
?>
