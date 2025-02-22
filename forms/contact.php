<?php
// Verifica se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Dados do formulário
    $name = $_POST['name'];
    $email = $_POST['email'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];

    // Email do destinatário
    $receiving_email_address = 'yagohrebello@gmail.com';

    // Cabeçalhos do email
    $headers = "From: $name <$email>" . "\r\n" .
               "Reply-To: $email" . "\r\n" .
               "X-Mailer: PHP/" . phpversion();

    // Corpo do email formatado
    $email_content = "Nome: $name\n";
    $email_content .= "Email: $email\n";
    $email_content .= "Assunto: $subject\n";
    $email_content .= "Mensagem:\n$message\n";

    // Envia o email
    if (mail($receiving_email_address, $subject, $email_content, $headers)) {
        echo 'Sua mensagem foi enviada. Obrigado!';
    } else {
        echo 'Falha ao enviar a mensagem. Tente novamente mais tarde.';
    }
} else {
    echo 'Método de requisição inválido.';
}
?>