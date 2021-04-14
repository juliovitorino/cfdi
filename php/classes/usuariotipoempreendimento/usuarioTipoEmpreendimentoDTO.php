<?php		
// importar dependencias		
require_once '../dto/DTOPadraoEntidade.php';		

/**		
* Data Transfer Object		
*		
* @author Julio Vitorino <julio.vitorino@gmail.com>		
* @copyright 2019-2019 The JCV Group		
*/	
	
class UsuarioTipoEmpreendimentoDTO extends DTOPadraoEntidade implements JsonSerializable		
{		
	public $id;	
	public $id_usuario;	
	public $id_tipoempreendimento;	

    public function jsonSerialize()	
	{	
		return 
		[
		'id' => $this->id,
		'id_usuario' => $this->id_usuario,
		'id_tipoempreendimento' => $this->id_tipoempreendimento,
		'msgcode' => $this->msgcode,
		'msgcodeString' => $this->msgcodeString
		];
		}
}
?>		
