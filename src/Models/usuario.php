<?php 
  function cadastrarUsuario(mysqli $conexao, string $nome, string $email, string $senha, int $acesso): bool
  {
    $hashsenha = password_hash($senha, PASSWORD_ARGON2ID);
    

    $sql = "INSERT INTO usuarios (Nome, Email, Senha, acesso) VALUES (?, ?, ?, ?)";
    
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

  function buscarUsuarioPorEmail(mysqli $conexao, string $email): ?array{

    $sql = "SELECT * FROM usuarios WHERE Email = ? LIMIT 1";
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

?>