<?php
$titulo_da_pagina = "Recuperar Senha";
require_once '../../src/Templates/header.php';
?>
<div class="container-form">
    <h1>Recuperar Senha</h1>
    <p>Digite seu e-mail e enviaremos um link para você redefinir sua senha.</p>
    
    <div id="message-container">
        <?php if (isset($_GET['status']) && $_GET['status'] == 'sucesso'): ?>
            <p class="mensagem-sucesso">Se o e-mail existir em nosso sistema, um link de recuperação foi enviado.</p>
        <?php endif; ?>
    </div>
    
    <form id="form-esqueci-senha" action="/handlers/esqueci_senha_handler.php" method="POST">
        <div class="form-group">
            <label for="email">E-mail:</label>
            <input type="email" id="email" name="email" required>
        </div>
        <div class="g-recaptcha" data-sitekey="6Lc7RtorAAAAAM71dPj-U3hdeYreD2Y1QnaBBV5G"></div>
        <br>
        <button type="submit" class="btn">Enviar Link</button>
    </form>
</div>
<script src="https://www.google.com/recaptcha/api.js" async defer></script>
<?php require_once '../../src/Templates/footer.php'; ?>