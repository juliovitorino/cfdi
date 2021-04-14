<?php  

// importar dependencias
require_once 'UsuarioDTO.php';
require_once 'UsuarioServiceImpl.php';
require_once '../mensagem/ConstantesMensagem.php';
require_once '../mensagem/MensagemCache.php';


$dtousuario = getUsuarioFacebook();
$usi = new UsuarioServiceImpl();
$ok = $usi->cadastrarNovaContaFacebook($dtousuario);

if ($ok->msgcode == ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO)
{
	echo "Inserido com sucesso";
} else {
	echo "Algum erro acontenceu";
}
var_dump($ok);
exit(0);


function getUsuarioFacebook()
{
	$date = new DateTime();
	$ts = $date->getTimestamp();

	$dto = new UsuarioDTO();
	$dto->iduserfacebook = $ts;
	$dto->email = 'julio.vitorino@gmail.com';
	$dto->pwd = MensagemCache::getInstance()->getMensagem(ConstantesMensagem::AUTENTICACAO_AUTORIZADA_FACEBOOK);
	$dto->apelido = 'Julio ' . $ts . ' Vitorino';
	$dto->tipoConta = 'C';

	return $dto;
}


?>