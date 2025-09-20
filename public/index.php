<?php
// Define o título da página
$titulo_da_pagina = "Login";

// Inclui o cabeçalho, que já tem nosso layout e CSS
require_once '../src/Templates/header.php';
?>

<div class="container-form">
    <h1>Acessar ControlSys</h1>

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
    </form>
</div>

<?php
require_once '../src/Templates/footer.php';
?>