<?php
ini_set("display_errors", 1);
header('Content-Type: text/html; charset=utf-8');

// Usar variáveis de ambiente para configuração
$servername = getenv('DB_HOST') ?: 'mysql';
$username = getenv('DB_USER') ?: 'root';
$password = getenv('DB_PASSWORD') ?: 'Senha123';
$database = getenv('DB_NAME') ?: 'meubanco';
$service_name = getenv('SERVICE_NAME') ?: 'php-service';

?>
<html>
<head>
    <title>Microserviço PHP - <?php echo htmlspecialchars($service_name); ?></title>
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 800px;
            margin: 50px auto;
            padding: 20px;
            background-color: #f5f5f5;
        }
        .container {
            background: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .info {
            background: #e8f4f8;
            padding: 15px;
            border-radius: 5px;
            margin: 10px 0;
        }
        .success {
            color: #28a745;
            font-weight: bold;
        }
        .error {
            color: #dc3545;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Microserviço PHP</h1>
        
        <div class="info">
            <strong>Serviço:</strong> <?php echo htmlspecialchars($service_name); ?><br>
            <strong>Versão PHP:</strong> <?php echo phpversion(); ?><br>
            <strong>Hostname:</strong> <?php echo gethostname(); ?><br>
            <strong>Timestamp:</strong> <?php echo date('Y-m-d H:i:s'); ?>
        </div>

        <?php
        // Criar conexão
        $link = new mysqli($servername, $username, $password, $database);

        // Verificar conexão
        if (mysqli_connect_errno()) {
            echo '<div class="error">Erro de conexão: ' . mysqli_connect_error() . '</div>';
            exit();
        }

        // Gerar dados aleatórios
        $valor_rand1 = rand(1, 999);
        $valor_rand2 = strtoupper(substr(bin2hex(random_bytes(4)), 1));
        $host_name = gethostname();

        // Preparar query com prepared statement para segurança
        $stmt = $link->prepare("INSERT INTO dados (AlunoID, Nome, Sobrenome, Endereco, Cidade, Host) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("isssss", $valor_rand1, $valor_rand2, $valor_rand2, $valor_rand2, $valor_rand2, $host_name);

        if ($stmt->execute()) {
            echo '<div class="success">✓ Novo registro criado com sucesso!</div>';
            echo '<div class="info">';
            echo '<strong>ID:</strong> ' . $valor_rand1 . '<br>';
            echo '<strong>Nome:</strong> ' . htmlspecialchars($valor_rand2) . '<br>';
            echo '<strong>Host:</strong> ' . htmlspecialchars($host_name) . '<br>';
            echo '</div>';
        } else {
            echo '<div class="error">Erro: ' . $stmt->error . '</div>';
        }

        $stmt->close();
        $link->close();
        ?>
    </div>
</body>
</html>
