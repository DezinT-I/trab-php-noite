<?php
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'bd_livros');

try {
    // Conectar ao MySQL sem selecionar banco
    $pdo = new PDO("mysql:host=" . DB_HOST, DB_USER, DB_PASS);
    
    // Criar banco de dados se não existir
    $sql = "CREATE DATABASE IF NOT EXISTS " . DB_NAME . " CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci";
    $pdo->exec($sql);
    
    // Selecionar o banco
    $pdo->exec("USE " . DB_NAME);
    
    // Criar tabela usuarios
    $sql = "CREATE TABLE IF NOT EXISTS usuarios (
        id INT AUTO_INCREMENT PRIMARY KEY,
        username VARCHAR(50) NOT NULL,
        senha VARCHAR(255) NOT NULL,
        email VARCHAR(100) NOT NULL,
        privilegio TINYINT(1) DEFAULT 0,
        UNIQUE KEY username (username)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci";
    $pdo->exec($sql);
    
    // Criar tabela livros
    $sql = "CREATE TABLE IF NOT EXISTS livros (
        id INT AUTO_INCREMENT PRIMARY KEY,
        titulo VARCHAR(200) NOT NULL,
        autor VARCHAR(100) NOT NULL,
        descricao TEXT NOT NULL,
        ano_publicacao YEAR(4) DEFAULT NULL,
        usuario_id INT NOT NULL,
        FOREIGN KEY (usuario_id) REFERENCES usuarios(id) ON DELETE CASCADE
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci";
    $pdo->exec($sql);
    
    // Verificar se os usuários já existem
    $usuarios = ['rick', 'dezin', 'user'];
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM usuarios WHERE username = ?");
    
    foreach ($usuarios as $usuario) {
        $stmt->execute([$usuario]);
        if ($stmt->fetchColumn() == 0) {
            // Usuário não existe, inserir
            $senha = password_hash('123', PASSWORD_DEFAULT);
            $pdo->prepare("INSERT INTO usuarios (username, senha, email, privilegio) VALUES (?, ?, ?, ?)")
                ->execute([$usuario, $senha, $usuario . '@example.com', $usuario == 'user' ? 0 : 1]);
        }
    }
    
    echo "Banco de dados configurado com sucesso!";
} catch(PDOException $e) {
    die("Erro: " . $e->getMessage());
}
?>
