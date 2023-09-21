<?php
session_start();
require_once '../config/db.php';

// Verificar se o usuário está logado
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// Recuperar dados do usuário
$sql = "SELECT username, is_admin FROM users WHERE id = :user_id";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(":user_id", $user_id);
$stmt->execute();
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$user) {
    die("Usuário não encontrado");
}

$sql = "SELECT id, username, is_admin FROM users";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Linux</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f7f9fc;
        }
        .dashboard-container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            background-color: #fff;
        }
        .dashboard-header {
            text-align: center;
            margin-bottom: 20px;
        }
        .dashboard-logo {
            display: block;
            margin: 0 auto;
            max-width: 100px;
            height: auto;
        }
        .user-list-container {
            text-align: center;
            margin-top: 20px;
        }
        .logout-button {
            margin-top: 20px;
        }

        /* Estilos para a barra de navegação */
        .navbar-custom {
            background-color: #0D6EFD; /* Cor azul do botão Sair */
        }
        .navbar-custom .navbar-nav .nav-link {
            color: #fff; /* Cor do texto na barra de navegação */
            font-weight: bold;
        }
        .navbar-custom .navbar-toggler-icon {
            background-color: #fff; /* Cor do ícone da barra de navegação */
        }
    </style>
</head>
<body>
    <div class="dashboard-container">
        <div class="dashboard-header">
            <img class="dashboard-logo" src="https://icon-library.com/images/linux-server-icon/linux-server-icon-17.jpg" alt="Logo Linux">
            <h2>Dashboard Linux</h2>
            <nav class="navbar navbar-expand navbar-custom mb-3">
                <div class="container-fluid">
                    <a class="navbar-brand"></a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <a class="nav-link" href="dashboard.php">Home</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="dashboard_info.php">Gerenciamento de Usuários</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
        </div>

        <div class="user-list-container">
            <ul class="list-group">
                <?php
                if ($users) {
                    foreach ($users as $otherUser) {
                        echo '<li class="list-group-item d-flex justify-content-between align-items-center">';
                        echo '<span>' . $otherUser['username'] . '</span>';
                        echo '<div>';
                        
                        // Verifica se o usuário logado é administrador
                        if ($user['is_admin'] == 1) {
                            // Se o usuário logado for administrador, exibe os botões Editar e Deletar para todos os usuários
                            echo '<button class="btn btn-sm btn-outline-primary edit-button" data-id="' . $otherUser['id'] . '">Editar</button>';
                            echo '<button class="btn btn-sm btn-outline-danger delete-button" data-id="' . $otherUser['id'] . '">Deletar</button>';
                        } else if ($otherUser['id'] == $user_id) {
                            // Se o usuário logado não for administrador e o usuário atual for ele mesmo, exibe o botão Editar apenas para si próprio
                            echo '<button class="btn btn-sm btn-outline-primary edit-button" data-id="' . $otherUser['id'] . '">Editar</button>';
                        }
                        
                        echo '</div>';
                        echo '</li>';
                    }
                } else {
                    echo '<li class="list-group-item">Nenhum usuário encontrado.</li>';
                }
                ?>
            </ul>
            <div class="mt-3">
                <!-- Apenas usuários administradores podem ver o botão "Cadastrar Novo Usuário" -->
                <?php if ($user['is_admin'] == 1): ?>
                    <a href="register_user.php" class="btn btn-success register-button">Cadastrar Novo Usuário</a>
                <?php endif; ?>
            </div>
        </div>
        <div class="dashboard-logout mt-3">
            <a href="logout.php" class="btn btn-primary logout-button">Sair</a>
            <a href="dashboard.php" class="btn btn-primary logout-button">Voltar</a>
        </div>
    </div>

    <!-- ... (seu código JavaScript) ... -->
</body>
</html>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
        const editButtons = document.querySelectorAll(".edit-button");
        const deleteButtons = document.querySelectorAll(".delete-button");

        editButtons.forEach(button => {
            button.addEventListener("click", function() {
                const userId = this.getAttribute("data-id");
                // Redirecione para a página de edição, passando o ID do usuário
                window.location.href = "edit_user.php?id=" + userId;
            });
        });

        deleteButtons.forEach(button => {
            button.addEventListener("click", function() {
                const userId = this.getAttribute("data-id");
                if (confirm("Tem certeza que deseja deletar este usuário?")) {
                    // Faça uma requisição AJAX para o script de deleção
                    fetch("delete_user.php?id=" + userId, {
                        method: "POST"
                    }).then(response => {
                        // Recarregue a página após a deleção
                        window.location.reload();
                    });
                }
            });
        });
    });
    </script>
</body>
</html>
