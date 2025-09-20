<?php 
// conectando com DB

define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'controleestoque');

$conexao = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

// verificando a conexão
if ($conexao->connect_error) {
    die("Conexão falhou: " . $conexao->connect_error);
}

$conexao->set_charset("utf8");

?>
