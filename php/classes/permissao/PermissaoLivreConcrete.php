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
class PermissaoLivreConcrete extends PermissaoFactory
{
	public function __construct($daofactory)	
	{	
		$this->daofactory = $daofactory;
	}

	// Implementação obrigatória nas fábricas concretas
	public function resolverPermissao($plusdto, $permissaodto)
	{
        $permissaodto->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
        $permissaodto->msgcodeString = MensagemCache::getInstance()->getMensagem($permissaodto->msgcode);
		return $permissaodto;
	}
	
}

?>