<?php
  session_start();
  require_once '../../config/db/conexao_db.php';
  require_once '../../src/Models/usuario.php';

  if($_SERVER['REQUEST_METHOD'] !== 'POST'){
     header('location: ../../index.php');
     exit;
  }

  $email = trim($_POST['email'] ?? '');
  $senha_digitada = $_POST['senha'] ?? '';

  if(empty($email) || empty($senha_digitada)){
      header('location: /index.php?status=erro_login');
      exit;
  }
  $usuario = buscarUsuarioPorEmail($conexao, $email);

  if($usuario && password_verify($senha_digitada, $usuario['Senha'])){

      $_SESSION['usuario_id'] = $usuario['id'];
      $_SESSION['usuario_nome'] = $usuario['Nome'];
      $_SESSION['usuario_email'] = $usuario['Email'];
      $_SESSION['usuario_acesso'] = $usuario['acesso'];

      header('location: /dashboard.php');
      exit;
  } else {
      header('location: /index.php?status=erro_login');
      exit;
  }

?>