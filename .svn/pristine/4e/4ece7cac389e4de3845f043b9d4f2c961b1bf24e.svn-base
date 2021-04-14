<?php  

// importar dependencias
require_once '../variavel/VariavelCache.php';
require_once '../variavel/ConstantesVariavel.php';

/**
 * Debugger - Debugador
 */
class Debugger
{
	const INFO = 0;
	const DEBUG = 1;
	const ERROR = 2;
	const FATAL = 3;

	function __construct()	{	}

	/**
	* debug() - Apresenta log de debug
	*/
	public static function debug($value=' ', $nivel)
	{
		// verifica se está ativado para a aplicação
		$status = VariavelCache::getInstance()->getVariavel(ConstantesVariavel::DEBUGGER_CHAVE_ATIVACAO);
		if ($status == ConstantesVariavel::ATIVADO) {

			// Verifica o nível de apresentação do debugger
			$nivelativo = VariavelCache::getInstance()->getVariavel(ConstantesVariavel::DEBUGGER_NIVEL_DEBUG);
			if ($nivel == $nivelativo) {
				var_dump($value);
			}
		}
	}
}
?>