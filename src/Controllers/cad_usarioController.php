<?php 

require_once '../../config/db/conexao_db.php';
require_once __DIR__ . '/../../config/db/conexao_db.php';
require_once __DIR__ . '/../Models/usuario.php';
 
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
  header('Location: /index.php');
  exit;
}

$nome = trim($_POST['nome'] ?? '');
$email = trim($_POST['email'] ?? '');
$senha = $_POST['senha'] ?? '';
$acesso = trim($_POST['acesso'] ?? '');

if (empty($nome) || empty($email) || empty($senha) || empty($acesso)) {
  header('Location: /cadastro_usuario/usuario_cadastrar.php?status=erro_campos');
  exit;
}


$sucesso = cadastrarUsuario($conexao, $nome, $email, $senha, $acesso);

if ($sucesso) {
  header('Location: /index.php?status=cadastrado_sucesso');
  exit;
} else {
  if ($conexao->errno === 1062) {
      header('Location: /cadastro_usuario/usuario_cadastrar.php?status=erro_email');
      exit;
  }
  header('Location: /cadastro_usuario/usuario_cadastrar.php?status=erro_sql');
  exit;
}
?>