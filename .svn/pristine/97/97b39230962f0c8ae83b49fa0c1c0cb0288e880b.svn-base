<?php  

require_once 'ConstantesLoadTable.php';
require_once 'LoadTableUsuarioBacklinkNoFollowConcrete.php';

/**
 * LoadTableDTO - Transferência de dados do front end para decisões no backend
 *
 * @author Julio Vitorino
 * @copyright Julio Vitorino
 * @since 03/09/2018
 */
abstract class LoadTableFactory
{
	protected $loadtabledto;
	protected $usuariodto;
	protected $sessaodto;

	// Obrigatoria a implementação nas fabricas
	public abstract function getStringJSON();
	
	function __construct()	{	}

	public static function getInstance($usuariodto, $sessaodto, $loadtabledto)
	{
		// Decide qual fábrica usar
		switch ($loadtabledto->target) {
			case ConstantesLoadTable::TARGET_BACKLINK_NOFOLLOW:
				return new LoadTableUsuarioBacklinkNoFollowConcrete($usuariodto, $sessaodto, $loadtabledto);
	
			default:
				# code...
				break;
		}
	}
}

?>

