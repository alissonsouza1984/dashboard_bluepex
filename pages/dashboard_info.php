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
                session_start();
                require_once '../config/db.php';

                // Verificar se o usuário está logado
                if (!isset($_SESSION['user_id'])) {
                    header("Location: login.php");
                    exit();
                }

                $user_id = $_SESSION['user_id'];

                // Recuperar dados do usuário
                $sql = "SELECT username FROM users WHERE id = :user_id";
                $stmt = $pdo->prepare($sql);
                $stmt->bindParam(":user_id", $user_id);
                $stmt->execute();
                $user = $stmt->fetch(PDO::FETCH_ASSOC);

                if (!$user) {
                    die("Usuário não encontrado");
                }

                $sql = "SELECT id, username FROM users";
                $stmt = $pdo->prepare($sql);
                $stmt->execute();
                $users = $stmt->fetchAll(PDO::FETCH_ASSOC);

                if ($users) {
                    foreach ($users as $user) {
                       echo '<li class="list-group-item d-flex justify-content-between align-items-center">';
                       echo '<span>' . $user['username'] . '</span>';
                       echo '<div>';
                       echo '<button class="btn btn-sm btn-outline-primary edit-button" data-id="' . $user['id'] . '">Editar</button>';
                       echo '<button class="btn btn-sm btn-outline-danger delete-button" data-id="' . $user['id'] . '">Deletar</button>';
                       echo '</div>';
                       echo '</li>';
                    }
                } else {
                    echo '<li class="list-group-item">Nenhum usuário encontrado.</li>';
                }
                ?>
            </ul>
            <div class="mt-3">
                <a href="register_user.php" class="btn btn-success register-button">Cadastrar Novo Usuário</a>
            </div>
        </div>
        <div class="dashboard-logout mt-3">
            <a href="logout.php" class="btn btn-primary logout-button">Sair</a>
            <a href="dashboard.php" class="btn btn-primary logout-button">Voltar</a>
        </div>
    </div>

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
<script>

