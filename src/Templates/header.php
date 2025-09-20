<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $titulo_da_pagina ?? 'Controle de Estoque'; ?></title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;700&display=swap" rel="stylesheet">
    
    <link rel="stylesheet" href="/css/style.css">
</head>
<body>
    
    <aside class="sidebar">
        <h2>ControlSys</h2>
        <nav>
            <ul>
                <li><a href="/dashboard.php">Dashboard</a></li>
                <li><a href="/produtos/listar.php">Lista de Produtos</a></li>
                <li><a href="/produtos/adicionar_produto.php">Adicionar Produto</a></li>
                <li><a href="/produtos/listar.php">Remover Produto</a></li>
                <li><a href="/cadastro_usuario/index.php" class="active">Cadastrar Usuário</a></li>
            </ul>
        </nav>
    </aside>

    <main class="main-content">