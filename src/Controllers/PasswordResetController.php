<?php
require_once '../../vendor/autoload.php';
require_once '../../config/db/conexao_db.php';
require_once '../Models/usuario.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$action = $_POST['action'] ?? '';


if ($action === 'request_reset') {
    $recaptchaSecret = '6Lc7RtorAAAAAE0P_TEJ2MDkNf6JuWZDr8l5hUJu';
  
    
    $email = trim($_POST['email'] ?? '');
    $usuario = buscarUsuarioPorEmail($conexao, $email);

    if ($usuario) {
        $token = bin2hex(random_bytes(32));
        if (salvarTokenDeReset($conexao, $usuario['id'], $token)) {
            $link = "http://controle-estoque.local/auth/redefinir_senha.php?token=" . $token;
            $mail = new PHPMailer(true);
            try {
                
                $mail->isSMTP();
                $mail->Host       = 'smtp.gmail.com';
                $mail->SMTPAuth   = true;
                $mail->Username   = 'seu-email@gmail.com'; 
                $mail->Password   = 'sua-senha-de-app';    
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
                $mail->Port       = 465;
                $mail->setFrom('seu-email@gmail.com', 'ControlSys');
                $mail->addAddress($usuario['email'], $usuario['nome']);
                $mail->isHTML(true);
                $mail->Subject = 'Redefinicao de Senha - ControlSys';
                $mail->Body    = "Olá, {$usuario['nome']}.<br><br>Clique no link para redefinir sua senha: <a href='{$link}'>Redefinir Senha</a>. O link expira em 1 hora.";
                $mail->send();
            } catch (Exception $e) {
                error_log("PHPMailer Error: {$mail->ErrorInfo}");
            }
        }
    }
    header('Location: /auth/esqueci_senha.php?status=sucesso');
    exit;
}

// --- AÇÃO 2: ATUALIZAR A SENHA ---
if ($action === 'update_password') {
    $token = $_POST['token'] ?? '';
    $senha = $_POST['senha'] ?? '';
    $confirmar_senha = $_POST['confirmar_senha'] ?? '';

    if (empty($token) || empty($senha) || $senha !== $confirmar_senha) {
        header('Location: /auth/redefinir_senha.php?token=' . urlencode($token) . '&status=erro');
        exit;
    }
    
    if (atualizarSenha($conexao, $token, $senha)) {
        header('Location: /index.php?status=senha_redefinida');
        exit;
    } else {
        header('Location: /auth/redefinir_senha.php?token=' . urlencode($token) . '&status=erro_sql');
        exit;
    }
}