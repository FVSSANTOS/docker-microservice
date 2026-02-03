<?php
header('Content-Type: application/json');

$health = [
    'status' => 'healthy',
    'service' => getenv('SERVICE_NAME') ?: 'php-service',
    'timestamp' => date('c'),
    'checks' => []
];

// Verificar conexão com banco de dados
try {
    $db_host = getenv('DB_HOST') ?: 'mysql';
    $db_user = getenv('DB_USER') ?: 'root';
    $db_password = getenv('DB_PASSWORD') ?: 'Senha123';
    $db_name = getenv('DB_NAME') ?: 'meubanco';
    
    $link = new mysqli($db_host, $db_user, $db_password, $db_name);
    
    if ($link->connect_error) {
        throw new Exception("Database connection failed: " . $link->connect_error);
    }
    
    $health['checks']['database'] = 'ok';
    $link->close();
} catch (Exception $e) {
    $health['status'] = 'unhealthy';
    $health['checks']['database'] = 'failed: ' . $e->getMessage();
    http_response_code(503);
}

echo json_encode($health, JSON_PRETTY_PRINT);
?>
