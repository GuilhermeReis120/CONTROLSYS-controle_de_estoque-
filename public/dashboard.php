<?php
require_once '../src/auth/auth_check.php';
protegerPagina();

$titulo_da_pagina = "Dashboard";
require_once '../src/Templates/header.php';
?>

<div class="content-box">
  <h1>Página Protegida</h1>
  <p>Bem-vindo à tela de Dashboard, <?= htmlspecialchars($_SESSION['usuario_nome']); ?>!</p>
</div>

<?php
require_once '../src/Templates/footer.php';
?>