<?php 

require_once '../../config/db/conexao_db.php';
// CORRIGIDO: Caminho simplificado e nome do arquivo com 'U' maiúsculo
require_once '../Models/Usuario.php'; 
 
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
  header('Location: /index.php');
  exit;
}

// COLETA E LIMPEZA DOS DADOS
$nome = trim($_POST['nome'] ?? '');
$email = trim($_POST['email'] ?? '');
$senha = $_POST['senha'] ?? '';
$acesso = trim($_POST['acesso'] ?? '');

// VALIDAÇÃO
if (empty($nome) || empty($email) || empty($senha) || empty($acesso)) {
  // CORRIGIDO: Usando caminho a partir da raiz do site para mais segurança
  header('Location: /cadastro_usuario/usuario_cadastrar.php?status=erro_campos');
  exit;
}

// CORRIGIDO: Usando a variável '$conn'
$sucesso = cadastrarUsuario($conn, $nome, $email, $senha, $acesso);

if ($sucesso) {
  // Redireciona para a página de login com sucesso
  header('Location: /index.php?status=cadastrado_sucesso');
  exit;
} else {
  // CORRIGIDO: Usando a variável '$conn'
  if ($conn->errno === 1062) {
      header('Location: /cadastro_usuario/usuario_cadastrar.php?status=erro_email');
      exit;
  }
  header('Location: /cadastro_usuario/usuario_cadastrar.php?status=erro_sql');
  exit;
}
?>