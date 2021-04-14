<?php

//
// Envio do formulário capturado para o mail server
// Julio Vitorino, 2019
//

    iconv_set_encoding("internal_encoding", "UTF-8");
    $email_to = "contato@junta10.com";
	$email_from = strtolower($_POST['email']);
	$email_subject = "Formulário de Contato: Lista VIP";
	$email_message = "Por favor, colocar o email capturado na lista VIP do Junta10. \r\nEnviado Por ".stripslashes($email_from)."\n\n";
	$email_message .=" em ".date("d/m/Y")." às ".date("H:i")."\n\n";
	//$email_message .= stripslashes($_POST['message']);

	$headers = 'From: '.$email_from."\r\n" .
   'Reply-To: '.$email_from."\r\n" ;

	mail($email_to, utf8_decode($email_subject), utf8_decode($email_message), $headers);
	header("Location: http://www.junta10.com/thankyou.html");
	die();
?>