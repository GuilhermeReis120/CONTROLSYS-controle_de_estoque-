<?php 

function cadastrarUsuario(mysqli $conexao, string $nome, string $email, string $senha, int $acesso): bool
{
    $hashsenha = password_hash($senha, PASSWORD_ARGON2ID);
    
  
    $sql = "INSERT INTO usuarios (nome, email, senha, nivel_acesso) VALUES (?, ?, ?, ?)";
    
    $stmt = $conexao->prepare($sql);
    
    if ($stmt === false) {
      error_log('Erro na preparação do SQL: ' . $conexao->error);
      return false;
    }

    $stmt->bind_param("sssi", $nome, $email, $hashsenha, $acesso);

    try {
        return $stmt->execute(); 
    } catch (mysqli_sql_exception $e) {
        error_log('Erro ao executar o cadastro: ' . $e->getMessage());
        return false;
    }
}


function buscarUsuarioPorEmail(mysqli $conexao, string $email): ?array
{
    $sql = "SELECT * FROM usuarios WHERE email = ? LIMIT 1";
    $stmt = $conexao->prepare($sql);

    if ($stmt === false) {
      error_log('Erro na preparação do SQL: ' . $conexao->error);
      return null;
    }

    $stmt->bind_param("s", $email);
    $stmt->execute();

    $resultado = $stmt->get_result();
    return $resultado->fetch_assoc();
}
function salvarTokenDeReset(mysqli $conexao, int $usuarioId, string $token): bool
{
    // Token expira em 1 hora
    $dataExpiracao = date('Y-m-d H:i:s', time() + 3600); 

    $sql = "UPDATE usuarios SET reset_token = ?, reset_token_expires_at = ? WHERE id = ?";
    $stmt = $conexao->prepare($sql);
    $stmt->bind_param("ssi", $token, $dataExpiracao, $usuarioId);
    
    return $stmt->execute();
}
function atualizarSenha(mysqli $conexao, string $token, string $novaSenha): bool
{
    $novaSenhaHash = password_hash($novaSenha, PASSWORD_ARGON2ID);
    
    $sql = "UPDATE usuarios SET senha = ?, reset_token = NULL, reset_token_expires_at = NULL WHERE reset_token = ?";
    $stmt = $conexao->prepare($sql);
    $stmt->bind_param("ss", $novaSenhaHash, $token);
    
    return $stmt->execute();
}
?>