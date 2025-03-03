<?php
require("/home2/jenisv13/public_html/PHPMailer-master/src/PHPMailer.php");
require("/home2/jenisv13/public_html/PHPMailer-master/src/SMTP.php");
require("/home2/jenisv13/public_html/PHPMailer-master/src/Exception.php");

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Dados do formulário
    $name = htmlspecialchars($_POST['name']);
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $subject = htmlspecialchars($_POST['subject']);
    $message = nl2br(htmlspecialchars($_POST['message']));

    // Verificando campos obrigatórios
    if (empty($name) || empty($email) || empty($subject) || empty($message)) {
        echo "Erro: Todos os campos são obrigatórios!";
        exit;
    }

    $mail = new PHPMailer(true);

    try {
        // Configuração do SMTP
        $mail->isSMTP();
        $mail->Host = 'smtp.titan.email';
        $mail->SMTPAuth = true;
        $mail->Username = 'administrador@jenisvitta.com';  // E-mail completo
        $mail->Password = 'jenisvitta@2025'; // Senha ou senha de aplicativo se 2FA estiver ativado
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;  // Para a porta 587, use STARTTLS
        $mail->Port = 587; // Ou use 465 para SMTPS (SSL)

        // Destinatário e conteúdo do e-mail
        $mail->setFrom('administrador@jenisvitta.com', 'Jenis Vitta');
        $mail->addAddress('contato@jenisvitta.com');  // Para o e-mail de destino
        $mail->addReplyTo($email, $name);
        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body = "
            <h2>Nova mensagem do formulário de contato</h2>
            <p><strong>Nome:</strong> {$name}</p>
            <p><strong>Email:</strong> {$email}</p>
            <p><strong>Assunto:</strong> {$subject}</p>
            <p><strong>Mensagem:</strong><br>{$message}</p>
        ";

        // Enviar o e-mail
        if ($mail->send()) {
            echo "Sua mensagem foi enviada com sucesso!";
        } else {
            echo "Erro ao enviar: " . $mail->ErrorInfo;
        }
    } catch (Exception $e) {
        echo "Erro ao enviar: {$mail->ErrorInfo}";
    }
}
?>
