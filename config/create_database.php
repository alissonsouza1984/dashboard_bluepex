<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Criar Banco de Dados - Dashboard Linux</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2>Criar Banco de Dados e Tabelas</h2>
        <?php
        $host = 'localhost';
        $dbUser = '';
        $dbPassword = '';
        $dbName = 'dashboard_linux';

        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $dbUser = $_POST["dbUser"];
            $dbPassword = $_POST["dbPassword"];

            try {
                $pdo = new PDO("mysql:host=$host", $dbUser, $dbPassword);
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                $createDatabaseSQL = "CREATE DATABASE IF NOT EXISTS $dbName";
                $pdo->exec($createDatabaseSQL);

                $pdo->exec("USE $dbName");

                $createUsersTableSQL = "CREATE TABLE IF NOT EXISTS users (
                    id INT AUTO_INCREMENT PRIMARY KEY,
                    username VARCHAR(50) NOT NULL,
                    password VARCHAR(255) NOT NULL,
                    email VARCHAR(100) NOT NULL,
                    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
                )";

                $createSessionsTableSQL = "CREATE TABLE IF NOT EXISTS sessions (
                    id INT AUTO_INCREMENT PRIMARY KEY,
                    user_id INT NOT NULL,
                    session_id VARCHAR(255) NOT NULL,
                    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                    FOREIGN KEY (user_id) REFERENCES users(id)
                )";

                $pdo->exec($createUsersTableSQL);
                $pdo->exec($createSessionsTableSQL);

                echo '<div class="alert alert-success" role="alert">Banco de dados e tabelas criados com sucesso!</div>';
            } catch (PDOException $e) {
                echo '<div class="alert alert-danger" role="alert">Erro ao criar o banco de dados: ' . $e->getMessage() . '</div>';
            }
        }
        ?>
        <form action="" method="post">
            <div class="mb-3">
                <label for="dbUser" class="form-label">Nome de Usuário do Banco de Dados</label>
                <input type="text" class="form-control" id="dbUser" name="dbUser" required>
            </div>
            <div class="mb-3">
                <label for="dbPassword" class="form-label">Senha do Banco de Dados</label>
                <input type="password" class="form-control" id="dbPassword" name="dbPassword" required>
            </div>
            <button type="submit" class="btn btn-primary">Criar Banco de Dados</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
