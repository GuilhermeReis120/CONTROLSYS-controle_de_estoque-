<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$bodyClass = isset($_SESSION['usuario_id']) ? 'app-layout' : 'login-layout';
$currentPage = $_SERVER['REQUEST_URI'];
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $titulo_da_pagina ?? 'ControlSys'; ?></title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;700&display=swap" rel="stylesheet">
    
    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="/css/style_sidebar.css">
    <link rel="stylesheet" href="/css/style_forms.css">

    </head>
<body class="<?= $bodyClass ?>">
    
    <?php if (isset($_SESSION['usuario_id'])): ?>
        <aside class="sidebar">
            <img style="display: block; max-width: 200px; margin-bottom: 20px;" src="/imgs/Logo_letrado.png" alt="">
            <nav>
                <ul>
                    <li>
                        <a href="/dashboard.php" class="<?= ($currentPage == '/dashboard.php') ? 'active' : '' ?>">
                            Dashboard
                        </a>
                    </li>
                    <li>
                        <a href="/produtos/listar.php" class="<?= (strpos($currentPage, '/produtos/') !== false) ? 'active' : '' ?>">
                            Produtos
                        </a>
                    </li>
                    <?php if (isset($_SESSION['usuario_acesso']) && $_SESSION['usuario_acesso'] == 1): ?>
                        <li>
                            <a href="/cadastro_usuario/usuario_cadastrar.php" class="<?= ($currentPage == '/cadastro_usuario/usuario_cadastrar.php') ? 'active' : '' ?>">
                                Cadastrar Usuário
                            </a>
                        </li>
                    <?php endif; ?>
                    <li><a href="/logout.php">Sair</a></li>
                </ul>
            </nav>
        </aside>
    <?php endif; ?>
    
    <main class="main-content">