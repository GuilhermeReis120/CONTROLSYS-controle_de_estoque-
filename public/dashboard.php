<?php
require_once '../src/auth/auth_check.php';
require_once '../src/Templates/header.php';

protegerPagina();
?>
<div style="margin: 0 auto; text-align: center; background: gray; padding: 20px; border-radius: 8px; color: white; width: 50%;">
  <h1>Página Protegida</h1>
  <h2>Bem-vindo a tela de Dashboard</h2>
</div>

<?php
require_once '../src/Templates/footer.php';
?>