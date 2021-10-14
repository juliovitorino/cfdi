<?php 

// Importar dependencias
require_once '../PHPMailer-5.2.26/PHPMailerAutoload.php';
require_once '../dto/DTOPadrao.php';
require_once '../mensagem/ConstantesMensagem.php';
require_once '../mensagem/MensagemCache.php';
require_once '../debugger/Debugger.php';
require_once '../variavel/ConstantesVariavel.php';

/**
 * Email - responsavel por enviar emails do canivete - integrada ao PHPMailer
 * @author Julio Vitorino
 * @copyright Julio Vitorino
 * @since 17/08/2018
 */
class Email
{
	public $email;

	function __construct($email)
	{
		$this->email = $email;
	}

	public function enviar()
	{

		//var_dump($this->email);

		$mail = new PHPMailer;
		$v = VariavelCache::getInstance();

		// nivel de debug ativado?
		if ($v->getVariavel(ConstantesVariavel::EMAIL_CHAVE_ATIVACAO_DEBUG) == ConstantesVariavel::ATIVADO)
		{
			$mail->SMTPDebug = 2;                               // Ativa debug em nivel 2
		}

		// nivel de autenticacao segura ativado
		if ($v->getVariavel(ConstantesVariavel::EMAIL_CHAVE_ATIVACAO_AUTENTICACAO) == ConstantesVariavel::ATIVADO)
		{
			$mail->SMTPAuth = true; 	// Ativa autenticacao de SMTP
			$mail->SMTPSecure = 'tls';	// Ativa encriptaeção de TLS ( SSL também aceito)
		}

		// Prepara/cofnigura mailer para usar SMTP
		$mail->isSMTP();                          

		// Especifica o servidor, usuario da conta e senha
		$mail->Host = $v->getVariavel(ConstantesVariavel::EMAIL_SMTP_HOST);
		$mail->Username = $v->getVariavel(ConstantesVariavel::EMAIL_ADMIN_SMTP);
		$mail->Password = $v->getVariavel(ConstantesVariavel::EMAIL_SMTP_PASSWD);

		// Porta de conexão - Verificar com o provedor
		$mail->Port = (integer)  $v->getVariavel(ConstantesVariavel::EMAIL_SMTP_PORT);

		$mail->setFrom(	$v->getVariavel(ConstantesVariavel::EMAIL_CONTATO_PADRAO_SMTP), 
						$v->getVariavel(ConstantesVariavel::EMAIL_NOME_CONTATO_PADRAO_SMTP));

		// Adiciona destinatarios modo de desenvolvimento ou produção
		if ($v->getVariavel(ConstantesVariavel::EMAIL_CHAVE_USUARIO_FAKE) == ConstantesVariavel::ATIVADO)
		{
			$mail->addAddress($v->getVariavel(ConstantesVariavel::EMAIL_VALIDO_FAKE_TESTE), 
								$v->getVariavel(ConstantesVariavel::EMAIL_NOME_VALIDO_FAKE_TESTE));
		} else {
			$mail->addAddress($this->email->emaildto->emaildestinatario, $this->email->emaildto->destinatario);
		}

		//$mail->addAddress('ellen@example.com');               // Name is optional
		//$mail->addReplyTo('info@example.com', 'Information');
		//$mail->addCC('cc@example.com');
		//$mail->addBCC('bcc@example.com');
		//$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
		//$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

		// Configura o format do email em HTML
		$mail->isHTML(true);                  

		// Configura assunto e o conteúdo injetado pelas fabricas de conteudo email                
		$mail->Subject = utf8_decode($this->email->emaildto->assunto);

		// executa a leitura do template e a substituição das tags
		$this->email->execute();
		$mail->Body = $this->email->getConteudo();
		
//		var_dump($this->email->getConteudo());
		//echo $this->email->getConteudo();

		//$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

		Debugger::debug($this->email, VariavelCache::getInstance()->getVariavel(ConstantesVariavel::DEBUGGER_NIVEL_DEBUG));
		Debugger::debug($this->email->getConteudo(), VariavelCache::getInstance()->getVariavel(ConstantesVariavel::DEBUGGER_NIVEL_DEBUG));

		$retorno = new DTOPadrao();

		// Enviar o email dependendo da chave de ativação
		if ($v->getVariavel(ConstantesVariavel::EMAIL_CHAVE_ATIVACAO_LIGADO) == ConstantesVariavel::ATIVADO) {
			if(!$mail->send()) {
			    $retorno->msgcode = ConstantesMensagem::ERRO_AO_ENVIAR_EMAIL;
			    $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode) . ":: Mailer Error = " . $mail->ErrorInfo;
			} else {
			    $retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
			    $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);
			}
		} else {
		    $retorno->msgcode = ConstantesMensagem::EMAIL_CHAVE_ATIVACAO_DESLIGADA;
		    $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);
		}

		//var_dump($retorno);
		return $retorno;
	}



}
?>