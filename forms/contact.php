<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Definir o e-mail de destino (empresa)
    $para = "yagohrebello@gmail.com"; // Substitua pelo e-mail real

    // Definir o assunto do e-mail
    $assunto = "Novo contato do site: " . $_POST["subject"];

    // Construir o corpo da mensagem
    $mensagem = "Você recebeu uma nova mensagem do formulário de contato:\n\n";
    $mensagem .= "Seu Nome: " . htmlspecialchars($_POST["name"]) . "\n";
    $mensagem .= "Seu Email: " . htmlspecialchars($_POST["email"]) . "\n";
    $mensagem .= "Assunto: " . htmlspecialchars($_POST["subject"]) . "\n";
    $mensagem .= "Mensagem:\n" . htmlspecialchars($_POST["message"]) . "\n";

    // Definir os cabeçalhos do e-mail
    $headers = "From: " . $_POST["email"] . "\r\n";
    $headers .= "Reply-To: " . $_POST["email"] . "\r\n";
    $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

    // Enviar o e-mail
    if (mail($para, $assunto, $mensagem, $headers)) {
        echo "Sua mensagem foi enviada com sucesso!";
    } else {
        echo "Ocorreu um erro ao enviar a mensagem.";
    }
} else {
    echo "Método de requisição inválido.";
}
?>
