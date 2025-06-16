<?php
// Configurações do banco de dados
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'bd_livros');

// Iniciar sessão
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Função para verificar se o usuário está logado
function esta_logado() {
    return isset($_SESSION['usuario_id']);
}

// Função para redirecionar
function redirecionar($url) {
    header("Location: $url");
    exit;
}

// Conexão com o banco de dados
try {
    $pdo = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=utf8mb4", DB_USER, DB_PASS, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8mb4"
    ]);
} catch(PDOException $e) {
    die("Erro na conexão: " . $e->getMessage());
}
?>
