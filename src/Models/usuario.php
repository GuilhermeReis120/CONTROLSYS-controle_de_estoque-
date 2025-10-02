<?php 
  function cadastrarUsuario(mysqli $conn, string $nome, string $email, string $senha, int $acesso): bool
  {
    $hashsenha = password_hash($senha, PASSWORD_ARGON2ID);
    
    // CORRIGIDO: Padronizado para todos os nomes de coluna em minúsculo
    $sql = "INSERT INTO usuarios (nome, email, senha, nivel_acesso) VALUES (?, ?, ?, ?)";
    
    $stmt = $conn->prepare($sql);
      
    if ($stmt === false) {
      error_log('Erro na preparação do SQL: ' . $conn->error);
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

  function buscarUsuarioPorEmail(mysqli $conn, string $email): ?array{

    // CORRIGIDO: Padronizado para 'email' minúsculo
    $sql = "SELECT * FROM usuarios WHERE email = ? LIMIT 1";
    $stmt = $conn->prepare($sql);

    if ($stmt === false) {
      error_log('Erro na preparação do SQL: ' . $conn->error);
      return null;
    }

    $stmt->bind_param("s", $email);
    $stmt->execute();

    $resultado = $stmt->get_result();
    return $resultado->fetch_assoc();
  }
?>