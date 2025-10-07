<?php
$titulo_da_pagina = "Recuperar Senha";

// 1. Inclui o header, que já carrega todo o layout, fontes e CSS.
// Ele também aplicará a classe 'login-layout' ao body para centralizar o conteúdo.
require_once '../../src/Templates/header.php';
?>

<div class="container-form">
    <h1>Recuperar Senha</h1>
    <p style="text-align: center; margin-bottom: 20px;">Digite seu e-mail e enviaremos um link para você redefinir sua senha.</p>
    
    <div id="message-container">
        <?php if (isset($_GET['status']) && $_GET['status'] == 'sucesso'): ?>
            <p class="mensagem-sucesso">Se o e-mail existir em nosso sistema, um link de recuperação foi enviado.</p>
        <?php endif; ?>
    </div>
    
    <form id="form-esqueci-senha" action="/handlers/esqueci_senha_handler.php" method="POST">
        <input type="hidden" name="action" value="request_reset">
        
        <div class="form-group">
            <label for="email">E-mail:</label>
            <input type="email" id="email" name="email" required>
        </div>
        
        <input type="hidden" name="g-recaptcha-response" id="recaptchaResponse">

        <button type="submit" class="btn">Enviar Link</button>
    </form>
    <div class="link-rodape" style="text-align: center; margin-top: 20px;">
        <a href="/index.php" style="color: #555; text-decoration: none;">Voltar para o Login</a>
    </div>
</div>

<script src="https://www.google.com/recaptcha/api.js?render=6Lc7RtorAAAAAM71dPj-U3hdeYreD2Y1QnaBBV5G"></script>
<script>
  document.getElementById('form-esqueci-senha').addEventListener('submit', function(event) {
    event.preventDefault();
    grecaptcha.ready(function() {
      // A chave de site é usada aqui novamente
      grecaptcha.execute('6Lc7RtorAAAAAM71dPj-U3hdeYreD2Y1QnaBBV5G', {action: 'submit'}).then(function(token) {
        document.getElementById('recaptchaResponse').value = token;
        event.target.submit();
      });
    });
  });
</script>

<?php
// 6. Inclui o footer para fechar a página corretamente
require_once '../../src/Templates/footer.php';
?>