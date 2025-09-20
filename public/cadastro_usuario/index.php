<?php
$titulo_da_pagina = "Cadastro de Usuário";

$mensagem = '';
$classe_css = '';

if (isset($_GET['status'])) {
    $status = $_GET['status'];
    $classe_css = 'mensagem-erro'; // Define um padrão de classe para erros

    switch ($status) {
        case 'erro_campos':
            $mensagem = 'Por favor, preencha todos los campos obligatorios.';
            break;
        case 'erro_email':
            $mensagem = 'Este e-mail já está em uso. Por favor, utilize outro.';
            break;
        case 'erro_sql':
            $mensagem = 'Ocorreu um erro ao processar sua solicitação. Verifiquei se todos os dados estão corretos e tente novamente.';
            break;
    }
}

require_once '../../src/Templates/header.php';

?>

<div class="container-form">
    <h1>Crie sua Conta</h1>

    <?php
    
    if (!empty($mensagem)):
    ?>
        <div class='<?= htmlspecialchars($classe_css, ENT_QUOTES, 'UTF-8'); ?>'>
            <?= htmlspecialchars($mensagem, ENT_QUOTES, 'UTF-8'); ?>
        </div>
    <?php
    endif;
    ?>
  
    <form action="/handlers/usuario_cad_handler.php" method="POST">
        <div class="form-group">
            <label for="nome">Nome:</label>
            <input type="text" id="nome" name="nome" required>
        </div>

        <div class="form-group">
            <label for="email">E-mail:</label>
            <input type="email" id="email" name="email" required>
        </div>

        <div class="form-group">
            <label for="senha">Senha:</label>
            <input type="password" id="senha" name="senha" required>
        </div>

        <div class="form-group">
            <label for="acesso">Nível de Acesso:</label>
            <select id="acesso" name="acesso" required>
                <option value="" selected disabled>Selecione uma opção</option>
                <option value="1">Nível 1 - Administrador</option>
                <option value="2">Nível 2 - Usuário Padrão</option>
            </select>
        </div>

        <button type="submit" class="btn">Cadastrar</button>
    </form>
</div>

<?php

require_once '../../src/Templates/footer.php';
?>