<?php
// Inclui os arquivos necessários para validar o token
require_once __DIR__ . '/../../config/db/conexao_db.php';
require_once __DIR__ . '/../../src/Models/usuario.php';

// Pega o token da URL
$token = $_GET['token'] ?? '';
$erro_token = '';

// Valida o token
if (empty($token)) {
    $erro_token = 'Token não fornecido.';
} else {
    // Usa a nova função do Model para buscar o usuário
    $usuario = buscarUsuarioPorResetToken($conexao, $token);
    if (!$usuario) {
        $erro_token = 'Token inválido ou expirado. Por favor, solicite um novo link.';
    }
}

$titulo_da_pagina = "Redefinir Senha";
require_once '../../src/Templates/header.php';
?>

<div class="container-form">
    <h1>Crie uma Nova Senha</h1>

    <?php if ($erro_token): ?>
        <p class="mensagem-erro"><?= htmlspecialchars($erro_token) ?></p>
    <?php else: ?>
        
        <div id="message-container">
            <?php if(isset($_GET['status']) && $_GET['status'] === 'erro'): ?>
                <p class="mensagem-erro">As senhas não coincidem ou estão em branco. Tente novamente.</p>
            <?php endif; ?>
        </div>

        <form action="/handlers/redefinir_senha_handler.php" method="POST">
            <input type="hidden" name="token" value="<?= htmlspecialchars($token) ?>">

            <div class="form-group">
                <label for="senha">Nova Senha:</label>
                <input type="password" id="senha" name="senha" required>
            </div>
            <div class="form-group">
                <label for="confirmar_senha">Confirmar Nova Senha:</label>
                <input type="password" id="confirmar_senha" name="confirmar_senha" required>
            </div>
            <button type="submit" class="btn">Salvar Nova Senha</button>
        </form>
        
    <?php endif; ?>
</div>

<?php require_once '../../src/Templates/footer.php'; ?>