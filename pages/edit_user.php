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
    header("Location: dashboard.php"); // Redirecionar de volta à página de dashboard
    exit();
}

$user_id = $_SESSION['user_id'];
$id = $_GET['id'];

// Verificar se o usuário tem permissão para editar este usuário (você pode adicionar suas próprias verificações aqui)

// Recuperar informações do usuário para pré-preencher o formulário
$sql = "SELECT * FROM users WHERE id = :id";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(":id", $id);
$stmt->execute();
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$user) {
    die("Usuário não encontrado");
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Capturar os campos do formulário de edição
    $newUsername = $_POST["new_username"];

    // Atualizar as informações do usuário no banco de dados
    $updateSql = "UPDATE users SET username = :username WHERE id = :id";
    $updateStmt = $pdo->prepare($updateSql);
    $updateStmt->bindParam(":username", $newUsername);
    $updateStmt->bindParam(":id", $id);
    $updateStmt->execute();

    // Redirecionar para a página de dashboard após a edição
    header("Location: dashboard.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Usuário - Dashboard Bluepex</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h2>Editar Usuário</h2>
        <form action="" method="post">
            <div class="mb-3">
                <label for="new_username" class="form-label">Novo Nome de Usuário</label>
                <input type="text" class="form-control" id="new_username" name="new_username" value="<?php echo $user['username']; ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Salvar Alterações</button>
            <a href="dashboard.php" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
</body>
</html>
