<?php

$titulo_da_pagina = "Login";

require_once '../src/Templates/header.php';
?>

<div class="container-form">
    <img style="display: block; max-width: 300px; margin: 0 auto;" src="/imgs/Logo.png" alt="">
    <?php
    if (isset($_GET['status']) && $_GET['status'] == 'erro_login') {
        echo '<p class="mensagem-erro">E-mail ou senha inválidos. Tente novamente.</p>';
    }
    ?>
    <form action="/handlers/login_handler.php" method="POST">
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
        </div>

        <div class="form-group">
            <label for="senha">Senha:</label>
            <input type="password" id="senha" name="senha" required>
        </div>

        <button type="submit" class="btn">Entrar</button>
        <div class="link-rodape">
            <a href="/auth/esqueci_senha.php">Esqueci minha senha</a>
        </div>
    </form>
</div>

<?php
require_once '../src/Templates/footer.php';
?>