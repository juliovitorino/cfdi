<?php  

// importar dependências
require_once 'PermissaoFactory.php';


/**
 * PermissaoDiariaConcrete - Implementação concreta de PermissaoFactory
 *
 * @author Julio Vitorino
 * @copyright Julio Vitorino
 * @since 20/08/2018
 */
class PermissaoDiariaConcrete extends PermissaoFactory
{
	public function __construct($daofactory)	
	{	
		$this->daofactory = $daofactory;
	}

	// Implementação obrigatória nas fábricas concretas
	public function resolverPermissao($plusdto, $permissaodto)
	{

		// Obtém interface de acesso aos dados históricos 
		$dao = $this->daofactory->getEstatisticaFuncaoDAO($this->daofactory);
		$ano = date('Y');
		$mes = date('m');
		$dia = date('d');
		$n = (integer) $dao->loadSumFuncionalidadeDiaria($permissaodto->funcionalidade, $plusdto->usuarioid, $dia, $mes, $ano);		
		// Atingiu o MÁXIMO PERMITIDO?	
		if ($n >= $permissaodto->qtdepermitida){
			$permissaodto->msgcode = ConstantesMensagem::PERMISSAO_NEGADA_POR_DIA_PERMITIDO_EXCEDIDO;
			$permissaodto->msgcodeString = MensagemCache::getInstance()->getMensagemParametrizada($permissaodto->msgcode,
				[
					ConstantesMensagem::MSGTAG_QTDE_PERMITIDA => $permissaodto->qtdepermitida,
					ConstantesMensagem::MSGTAG_FUNCIONALIDADE => $permissaodto->funcionalidade,
					ConstantesMensagem::MSGTAG_NOME => $plusdto->nome
				]
			);
		} else {
			$permissaodto->msgcode = ConstantesMensagem::PERMISSAO_CONCEDIDA_FACTORY;
			$permissaodto->msgcodeString = MensagemCache::getInstance()->getMensagemParametrizada($permissaodto->msgcode,
				[
					ConstantesMensagem::MSGTAG_PERMISSAO_FACTORY => $permissaodto->periodicidadestr
				]
			);
		}

		return $permissaodto;
	}
	
}

?>