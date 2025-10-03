<?php

define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'controleestoque');


mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

try {

    $conexao = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

    $conexao->set_charset("utf8mb4");

} catch (mysqli_sql_exception $e) {

    
 
    error_log("Erro de conexão com o banco de dados: " . $e->getMessage());

    die("Ocorreu um problema ao conectar com o servidor. Por favor, tente novamente mais tarde.");
}

?>