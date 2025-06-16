<?php
defined('DB_HOST') or define('DB_HOST', 'localhost');
defined('DB_USER') or define('DB_USER', 'root');
defined('DB_PASS') or define('DB_PASS', '');
defined('DB_NAME') or define('DB_NAME', 'bd_livros');

try {
    $pdo = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASS);
    
    // Nova senha padrão
    $nova_senha = '123';
    $senha_hash = password_hash($nova_senha, PASSWORD_DEFAULT);
    
    // Atualizar senhas dos usuários
    $usuarios = ['rick', 'dezin', 'user'];
    
    foreach ($usuarios as $usuario) {
        $stmt = $pdo->prepare("UPDATE usuarios SET senha = ? WHERE username = ?");
        $stmt->execute([$senha_hash, $usuario]);
    }
    
    echo "Senhas resetadas com sucesso!\n";
    echo "Agora você pode usar:\n";
    echo "Usuário: rick, senha: 123\n";
    echo "Usuário: dezin, senha: 123\n";
    echo "Usuário: user, senha: 123\n";
    
} catch(PDOException $e) {
    die("Erro: " . $e->getMessage());
}
?>
