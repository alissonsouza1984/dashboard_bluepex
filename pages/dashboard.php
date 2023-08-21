<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Dashboard Bluepex</title>
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
            max-width: 100px;
            height: auto;
        }
        .dashboard-welcome {
            font-size: 18px;
            margin-bottom: 10px;
        }
        .dashboard-info {
            font-size: 14px;
            margin-bottom: 20px;
        }
        .dashboard-logout {
            text-align: center;
            margin-top: 20px;
        }
        .dashboard-table {
            width: 100%;
        }
        .dashboard-table th,
        .dashboard-table td {
            padding: 4px;
            text-align: left;
            vertical-align: top;
            border-top: 1px solid #dee2e6;
        }
        .dashboard-table th {
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="dashboard-container">
        <div class="dashboard-header">
            <img class="dashboard-logo" src="https://suite.bluepex.com.br/public/images/logo-responsive.png" alt="Logo Bluepex">
            <h2>Dashboard Bluepex</h2>
        </div>
        <?php
        session_start();
        require_once '../config/db.php'; // Caminho para o arquivo de configuração do banco de dados

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

        // Obter informações do sistema operacional
        $os_info = shell_exec('uname -a');
        $os_parts = explode(" ", $os_info);
        $os_distribution = shell_exec('lsb_release -d -s');
        $os_version = $os_parts[2];
        $os_architecture = strpos($os_info, "x86_64") !== false ? "64 bits" : "32 bits";

        // Obter status da CPU
        $cpu_usage = shell_exec("top -b -n 1 | grep 'Cpu(s)' | awk '{print $2 + $4}'");
        $cpu_usage = trim($cpu_usage); // Remover espaços em branco

        // Obter status da memória utilizada
        $memory_usage = shell_exec("free -m | grep Mem | awk '{print $3/$2 * 100.0}'");
        $memory_usage = trim($memory_usage); // Remover espaços em branco

        // Obter status de uso dos discos
        $disk_usage = shell_exec("df -h | grep '/dev/sd' | awk '{print $5}'");
        $disk_usage = explode("\n", trim($disk_usage));

        ?>
        <div class="dashboard-welcome">Bem-vindo, <?php echo $user['username']; ?>!</div>
        <div class="dashboard-info">
            <table class="dashboard-table">
                <tr>
                    <th colspan="2" style="text-align: center;">Informações do SO</th>
                </tr>
                <tr>
                    <td><strong>Distribuição:</strong></td>
                    <td><?php echo $os_distribution; ?></td>
                </tr>
                <tr>
                    <td><strong>Versão:</strong></td>
                    <td><?php echo $os_version; ?></td>
                </tr>
                <tr>
                    <td><strong>Arquitetura:</strong></td>
                    <td><?php echo $os_architecture; ?></td>
                </tr>
            </table>
            <table class="dashboard-table">
                <tr>
                    
                </tr>
                <tr>
                    <td><strong>Utilização da CPU:</strong></td>
                    <td id="cpuUsage">Aguarde...</td>
                </tr>
                <tr>
                    <td><strong>Utilização da Memória:</strong></td>
                    <td id="memoryUsage">Aguarde...</td>
                </tr>
                <tr>
                    <td><strong>Uso dos Discos:</strong></td>
                    <td id="diskUsage">Aguarde...</td>
                </tr>
            </table>
        </div>
        <div class="dashboard-logout">
            <a href="logout.php" class="btn btn-primary">Sair</a>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Função para atualizar a utilização da CPU, memória e discos a cada 5 segundos
        function updateResourceUsage(endpoint, targetId) {
            fetch(endpoint)
                .then(response => response.text())
                .then(data => {
                    document.getElementById(targetId).textContent = data;
                })
                .catch(error => {
                    console.error('Erro ao obter informações:', error);
                });
        }

        function updateAllUsage() {
            updateResourceUsage('../includes/scripts/cpu_usage.php', 'cpuUsage');
            updateResourceUsage('../includes/scripts/memory_usage.php', 'memoryUsage');
            updateResourceUsage('../includes/scripts/disk_usage.php', 'diskUsage');
        }

        // Inicializa a atualização de recursos
        updateAllUsage();
        setInterval(updateAllUsage, 500); // Atualiza a cada 5 segundos
    </script>
</body>
</html>
