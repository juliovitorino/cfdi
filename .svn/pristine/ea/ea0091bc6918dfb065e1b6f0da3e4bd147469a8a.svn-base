<?php 

require_once 'EmailDTO.php';
require_once 'Email.php';
require_once 'EmailTemplateHub.php';
require_once 'EmailSolucionador.php';

require_once '../variavel/ConstantesVariavel.php';
require_once '../variavel/VariavelCache.php';

require_once '../tags/TagHub.php';

// Token de teste a ser enviado no email
$token = '4e0t6oLKfWP54x2WJsI]byMwtYdbevQ32Tt4nTW4Y5(!kfLg0#VyYC(H0xUPxNT7sUTNSpzi(zczcVBSLpT1xSIg(!kIq0As3ByuJj6(0n!]_mO1@k4mj0AO6aL1O';

$url = VariavelCache::getInstance()->getVariavel(ConstantesVariavel::LINK_ATIVACAO_NOVO_CLIENTE);
$url = str_replace(TagHub::TAG_TOKEN, $token,$url);

// timestamp de teste
$date = new DateTime();
$ts = $date->getTimestamp();

// prepara parametrizacao
$email = new EmailDTO();
$email->destinario = "Julio Vitorino";
$email->emaildestinatario = "julio.vitorino@gmail.com";
$email->assunto = "assunto teste " . $ts;
//$email->template = 'C:/Users/Julio/Programas/wamp64/www/gc/emails/ativar-nova-conta.html';
$email->template = getcwd() . VariavelCache::getInstance()->getVariavel(ConstantesVariavel::PATH_RELATIVO_TEMPLATES_EMAIL) 
					. EmailTemplateHub::NOVA_CONTA_CANIVETE;
$email->lsttags = [	
						TagHub::NOME_NOVO_CLIENTE => $email->destinario,
						TagHub::LINK_ATIVACAO_NOVO_CLIENTE => $url
					];
var_dump($email);

$es = new EmailSolucionador($email);
$es->execute();
echo $es->getConteudo();

// Envia o email com o email já solucionado em suas tags
$e = new Email($es);
$e->enviar();

 ?>