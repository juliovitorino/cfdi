<?php
// importar dependencias
require_once '../dto/DTOPadraoEntidade.php';
/**
* UsuarioTipoEmpreendimentoDTO - Data Transfer Object
*
* @author Julio Cesar Vitorino 
* @since 06/09/2021 09:56:34
* @copyright(c), Julio Vitorino <julio.vitorino@gmail.com>
*/
class UsuarioTipoEmpreendimentoDTO extends DTOPadraoEntidade implements JsonSerializable
{
    public $idUsuario;
    public $idTipoEmpreendimento;

	public function jsonSerialize()
	{
		return 
		[
			'id' => $this->id,
			'idUsuario' => $this->idUsuario,
			'idTipoEmpreendimento' => $this->idTipoEmpreendimento,
			'status' => $this->status,
			'dataCadastro' => $this->dataCadastro,
			'dataAtualizacao' => $this->dataAtualizacao,
			'statusdesc' => $this->statusdesc,
			'msgcode' => $this->msgcode,
			'msgcodeString' => $this->msgcodeString
		];
	}   


}
?>
