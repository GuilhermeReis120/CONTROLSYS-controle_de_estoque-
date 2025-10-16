<?php
require_once '../../vendor/autoload.php';
require_once '../../config/db/conexao_db.php';
require_once __DIR__ . '/../Models/usuario.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$action = $_POST['action'] ?? '';


if ($action === 'request_reset') {
    $recaptchaSecret = '6Lc7RtorAAAAAE0P_TEJ2MDkNf6JuWZDr8l5hUJu';
    // ... (Sua lógica de verificação do reCAPTCHA, que está correta) ...
    $recaptchaResponse = $_POST['g-recaptcha-response'] ?? '';
    if (empty($recaptchaResponse)) {
        header('Location: /auth/esqueci_senha.php?status=recaptcha_vazio');
        exit;
    }
    $url = 'https://www.google.com/recaptcha/api/siteverify';
    $data = [
        'secret'   => $recaptchaSecret,
        'response' => $recaptchaResponse
    ];
    $options = [
        'http' => [
            'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
            'method'  => 'POST',
            'content' => http_build_query($data)
        ]
    ];
    $context  = stream_context_create($options);
    $verify = file_get_contents($url, false, $context);
    $captcha_success = json_decode($verify);

    if ($captcha_success->success == false || (isset($captcha_success->score) && $captcha_success->score < 0.5)) {
        header('Location: /auth/esqueci_senha.php?status=recaptcha_falhou');
        exit;
    }
    
    $email = trim($_POST['email'] ?? '');
    $usuario = buscarUsuarioPorEmail($conexao, $email);

    if ($usuario) {
        $token = bin2hex(random_bytes(32));
        if (salvarTokenDeReset($conexao, $usuario['id'], $token)) {
            $link = "http://localhost:8080/auth/redefinir_senha.php?token=" . $token;
            $mail = new PHPMailer(true);
            try {
                
                // --- AJUSTE 1: ATIVANDO O MODO DETETIVE ---
                $mail->SMTPDebug = 2; // Nível 2 mostra a conversa completa com o servidor
                // --- FIM DO AJUSTE 1 ---
                
                $mail->isSMTP();
                $mail->Host       = 'smtp.gmail.com';
                $mail->SMTPAuth   = true;
                $mail->Username   = 'gs9411517@gmail.com'; 
                $mail->Password   = 'qqoljaszghfdussc';     
                $mail->SMTPSecure = 'tls';
                $mail->Port       = 587;
                $mail->SMTPOptions = [
                  'ssl' => [
                    'verify_peer' => false,
                    'verify_peer_name' => false,
                    'allow_self_signed' => true,
                  ],
                ];
                $mail->setFrom('gs9411517@gmail.com', 'ControlSys');
                $mail->addAddress($usuario['Email'], $usuario['Nome']);
                $mail->isHTML(true);
                $mail->Subject = 'Redefinicao de Senha - ControlSys';
                $mail->Body    = "Olá, {$usuario['Nome']}.<br><br>Clique no link para redefinir sua senha: <a href='{$link}'>Redefinir Senha</a>. O link expira em 1 hora.";
                $mail->send();
                
            } catch (Exception $e) {
                // Mesmo com o debug, mantemos o log de erro
                error_log("PHPMailer Error: {$mail->ErrorInfo}");
                // Para garantir que você veja o erro, podemos exibi-lo aqui temporariamente
                die("Erro ao enviar e-mail: " . $mail->ErrorInfo);
            }
        }
    }

    // --- AJUSTE 2: COMENTE O REDIRECIONAMENTO ---
    // header('Location: /auth/esqueci_senha.php?status=sucesso');
    // exit;
    // --- FIM DO AJUSTE 2 ---
}


if ($action === 'update_password') {
    $token = $_POST['token'] ?? '';
    $senha = $_POST['senha'] ?? '';
    $confirmar_senha = $_POST['confirmar_senha'] ?? '';

    // Valida se os campos não estão vazios e se as senhas coincidem
    if (empty($token) || empty($senha) || $senha !== $confirmar_senha) {
        header('Location: /auth/redefinir_senha.php?token=' . urlencode($token) . '&status=erro');
        exit;
    }
    
    // Chama a função 'atualizarSenha' do Model
    if (atualizarSenha($conexao, $token, $senha)) {
        // Se a atualização foi bem-sucedida, redireciona para o login com mensagem de sucesso
        header('Location: /index.php?status=senha_redefinida');
        exit;
    } else {
        // Se a atualização falhou por algum motivo
        header('Location: /auth/redefinir_senha.php?token=' . urlencode($token) . '&status=erro_sql');
        exit;
    }
}