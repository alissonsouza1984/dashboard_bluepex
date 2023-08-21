<?php
require_once '../../config/db.php'; // Caminho para o arquivo de configuração do banco de dados

// Exibir erros no navegador (apenas para ambiente de desenvolvimento)
error_reporting(E_ALL);
ini_set('display_errors', '1');

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    try {
        $username = $_POST["username"];
        $password = password_hash($_POST["password"], PASSWORD_DEFAULT); // Hash da senha
        $email = $_POST["email"];

        // Verificar a conexão com o banco de dados
        if (!$pdo) {
            die("Erro na conexão com o banco de dados");
        }

        $sql = "INSERT INTO users (username, password, email) VALUES (:username, :password, :email)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(":username", $username);
        $stmt->bindParam(":password", $password);
        $stmt->bindParam(":email", $email);

        if ($stmt->execute()) {
            header("Location: cadastro_success.php"); // Redirecionar para cadastro_success.php no mesmo diretório
            exit();
        } else {
            header("Location: cadastro.php?error=registration_failed");
            exit();
        }
    } catch (PDOException $e) {
        die("Erro ao cadastrar usuário: " . $e->getMessage());
    }
}
?>
