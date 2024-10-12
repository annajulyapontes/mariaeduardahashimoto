<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = strip_tags(trim($_POST["nome"]));
    $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
    $telefone = strip_tags(trim($_POST["telefone"]));
    $mensagem = trim($_POST["mensagem"]);

    if (empty($nome) || empty($email) || empty($telefone) || empty($mensagem) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header("Location: index.html?error=missingfields");
        exit;
    }

    $to = "annajulyapontes88@gmail.com";

    $subject = "Novo contato: $nome";

    $email_content = "Nome: $nome\n";
    $email_content .= "Email: $email\n";
    $email_content .= "Telefone: $telefone\n\n";
    $email_content .= "Mensagem:\n$mensagem\n";

    $email_headers = "From: $nome <$email>";

    if (mail($to, $subject, $email_content, $email_headers)) {
 
        header("Location: index.html?success=true");
    } else {
 
        header("Location: index.html?error=sendfailed");
    }
}
?>