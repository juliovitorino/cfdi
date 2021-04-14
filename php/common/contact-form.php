<?php
    iconv_set_encoding("internal_encoding", "UTF-8");
    $email_to = "contato@junta10.com";
	$email_from = $_POST['email'];
	$name_from = $_POST['name'];
	$msg_from = $_POST['message'];
	$email_subject = "Formulário de Contato: Analisar Pedido";
    $email_message = "Prezado(a) Julio Vitorino,";
    $email_message .= "\r\nAs seguintes informações foram preenchidas no formulário de contato da página principal do site Junta10.";
    $email_message .= "\r\n";
    $email_message .= "\r\nMensagem digitada:";
    $email_message .= "\r\n$msg_from";
    $email_message .= "\r\n";
    $email_message .= "\r\nEnviado por ".stripslashes($email_from)."\n\n";
	$email_message .=" em ".date("d/m/Y")." as ".date("H:i")."\n\n";
	//$email_message .= stripslashes($_POST['message']);

	$headers = 'From: '.$email_from."\r\n" .
   'Reply-To: '.$email_from."\r\n" ;

    mail($email_to, utf8_decode($email_subject), utf8_decode($email_message), $headers);
    echo "Email enviado com sucesso";
	//header("Location: http://www.junta10.com/thankyou.html");
	//die();
?>
