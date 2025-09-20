<?php 

  require_once '../../config/db/conexao_db.php';
  var_dump(file_exists(__DIR__ . '/../Models/usuario.php'));
  require_once __DIR__ . '../../Models/usuario.php';
  
  if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ../../public/index.php');
    exit;
  }
  //COLETA E LIMPEZA DOS DADOS
  $nome = trim($_POST['nome'] ?? '');
  $email = trim($_POST['email'] ?? '');
  $senha = $_POST['senha'] ?? '';
  $acesso = trim($_POST['acesso'] ?? '');

  // 2. VALIDAÇÃO
  if (empty($nome) || empty($email) || empty($senha) || empty($acesso)) {
    header('Location: ../../public/cadastro_usuario/index.php?status=erro_campos');
    exit;
  }

  $sucesso = cadastrarUsuario($conexao, $nome, $email, $senha, $acesso);

    if ($sucesso) {
    header('Location: ../../');
    exit;
    }else {
    if ($conexao->errno === 1062) {
        header('Location: ../../cadastro_usuario/index.php?status=erro_email');
        exit;
    }
    header('Location: ../../cadastro_usuario/index.php?status=erro_sql');
    exit;
}
?>