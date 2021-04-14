<?php  

require_once '../usuariobacklink/UsuarioBacklinkServiceImpl.php';

/**
 * LoadTableUsuarioBacklinkNoFollowConcrete - Concrete para retonar o JSON para popular tabela de backlinks
 *
 * @author Julio Vitorino
 * @copyright Julio Vitorino
 * @since 03/09/2018
 */
class LoadTableUsuarioBacklinkNoFollowConcrete
{

	function __construct($usuariodto, $sessaodto, $loadtabledto)	
	{	
		$this->loadtabledto = $loadtabledto;
		$this->usuariodto = $usuariodto;
		$this->sessaodto = $sessaodto;
	}

	/**
	 * getStringJSON - Obtem um objeto JSON para entrega o javascript
	 */
	public function getStringJSON()
	{
		$ubsi = new UsuarioBacklinkServiceImpl();
		$lstbkl = $ubsi->listarTudoPorUsuarioID($this->usuariodto->id);
		return json_encode($lstbkl, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
	}
	

}

?>

