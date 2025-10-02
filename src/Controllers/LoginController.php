<?php
session_start();
require_once '../../config/db/conexao_db.php';
// CORRIGIDO: Caminho e nome do arquivo
require_once '../Models/Usuario.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('location: /index.php');
    exit;
}

$email = trim($_POST['email'] ?? '');
$senha_digitada = $_POST['senha'] ?? '';

if (empty($email) || empty($senha_digitada)) {
    header('location: /index.php?status=erro_login');
    exit;
}

// CORRIGIDO: Usando a variável '$conn'
$usuario = buscarUsuarioPorEmail($conn, $email);

// CORRIGIDO: Usando 'senha' minúsculo para consistência
if ($usuario && password_verify($senha_digitada, $usuario['senha'])) {

    // CORRIGIDO: Padronizando para usar as chaves em minúsculo do banco
    $_SESSION['usuario_id'] = $usuario['id'];
    $_SESSION['usuario_nome'] = $usuario['nome'];
    $_SESSION['usuario_email'] = $usuario['email'];
    $_SESSION['usuario_acesso'] = $usuario['nivel_acesso'];

    header('location: /dashboard.php');
    exit;
} else {
    header('location: /index.php?status=erro_login');
    exit;
}
?>