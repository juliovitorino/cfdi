<?php  

// importar dependencias
require_once 'ConstantesAmbiente.php';
require_once '../variavel/ConstantesVariavel.php';
require_once '../variavel/VariavelCache.php';
require_once '../global/GlobalStartup.php';
require_once '../mensagem/ConstantesMensagem.php';

/**
* Ambiente - Retorna definições de ambiente
*
* Changelog:
*
* 
* @autor Julio Cesar Vitorino
* @since 23/08/2015 09:32:03
*
*/

class Ambiente
{
	
	function __construct()	{	}

	public static function getUrlAmbienteAtivo() {

		// retorno padrão
		$url = VariavelCache::getInstance()->getVariavel(ConstantesVariavel::HOME_URL_CANIVETE_DESENV);

		$gs = GlobalStartup::getInstance();
		switch ($gs->ambiente) {
			case ConstantesAmbiente::PRODUCAO:
				$url = VariavelCache::getInstance()->getVariavel(ConstantesVariavel::HOME_URL_CANIVETE_PRODUCAO);
				break;
			
			case ConstantesAmbiente::HOMOLOGACAO:
				$url = VariavelCache::getInstance()->getVariavel(ConstantesVariavel::HOME_URL_CANIVETE_HOMOLOGACAO);
				break;
			
			default:
				$url = VariavelCache::getInstance()->getVariavel(ConstantesVariavel::HOME_URL_CANIVETE_DESENV);
				break;
		}

		return $url;
	}

	public static function trocarUrlAmbienteAtivo($urltag){

		// urltag exemplo = *=url-ambiente-ativo=*/php/classes/gateway/ativarNovaContaController.php?token=*=token=*

		$url = Ambiente::getUrlAmbienteAtivo();
		$urltag = str_replace(ConstantesMensagem::MSGTAG_URL_AMBIENTE_ATIVO, $url,$urltag);
		return $urltag;
	}
}

?>