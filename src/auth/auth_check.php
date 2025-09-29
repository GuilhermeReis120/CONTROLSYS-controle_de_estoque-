<?php
  if (session_status() === PHP_SESSION_NONE) {
      session_start();
  }
  function protegerPagina( int $nivel_requerido = null): void{
       if (!isset($_SESSION['usuario_id'])) {
        header('Location: /index.php?status=erro_nao_logado');
        exit;
  }
  if ($nivel_requerido !== null) {
        if (!isset($_SESSION['usuario_acesso']) || $_SESSION['usuario_acesso'] > $nivel_requerido) {
            header('Location: /dashboard.php?status=acesso_negado');
            exit;
        }
  }
}
?>