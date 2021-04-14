<?php  

// importar dependências
require_once 'PermissaoFactory.php';
require_once '../debugger/Debugger.php';

/**
 * PermissaoMaximoConcrete - Fabrica de resolução de permissoes com base na funcionalidade e o historico de uso
 *
 * @author Julio Vitorino
 * @copyright Julio Vitorino
 * @since 20/08/2018
 */
class PermissaoMaximoConcrete extends PermissaoFactory
{
	public function __construct($daofactory)	
	{	
		$this->daofactory = $daofactory;
	}

	// Implementação obrigatória nas fábricas concretas
	public function resolverPermissao($plusdto, $permissaodto)
	{
//var_dump($plusdto);
//var_dump($permissaodto);
		// Obtém interface de acesso aos dados históricos 
		$dao = $this->daofactory->getEstatisticaFuncaoDAO($this->daofactory);
		$n = (integer) $dao->loadCountFuncionalidade($permissaodto->funcionalidade, $plusdto->usuarioid);		
//var_dump($n);
		// Atingiu o MÁXIMO PERMITIDO?	
		if ($n >= (double) $permissaodto->qtdepermitida){
			$permissaodto->msgcode = ConstantesMensagem::PERMISSAO_NEGADA_MAX_PERMITIDO_EXCEDIDO;
			$permissaodto->msgcodeString = MensagemCache::getInstance()->getMensagemParametrizada($permissaodto->msgcode,
				[
					ConstantesMensagem::MSGTAG_QTDE_PERMITIDA => $permissaodto->qtdepermitida,
					ConstantesMensagem::MSGTAG_FUNCIONALIDADE => $permissaodto->funcionalidade,
					ConstantesMensagem::MSGTAG_NOME => $plusdto->nome
				]
			);
		} else {
			$permissaodto->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
			$permissaodto->msgcodeString = MensagemCache::getInstance()->getMensagem($permissaodto->msgcode);
		}
//var_dump($permissaodto);
		return $permissaodto;
	}
	
}

?>