<?php

// importar dependencias
require_once '../dto/DTOPadraoEntidade.php';

/**
* TipoEmpreendimentoDTO - Data Transfer Object
*
* @author Julio Cesar Vitorino 
* @since 23/08/2019 07:29:18
* @copyright(c), Julio Vitorino <julio.vitorino@gmail.com>
*/
class TipoEmpreendimentoDTO extends DTOPadraoEntidade implements JsonSerializable
{
    public $id;
    public $descricao;
    public $urlimg;
    public $status;
    public $dataCadastro;
    public $dataAtualizacao;

	public function jsonSerialize()
	{
		return 
		[
			'$id' => $this->$id,
			'$descricao' => $this->$descricao,
			'$urlimg' => $this->$urlimg,
			'$status' => $this->$status,
			'$dataCadastro' => $this->$dataCadastro,
			'$dataAtualizacao' => $this->$dataAtualizacao,
			'statusdesc' => $this->statusdesc,
			'msgcode' => $this->msgcode,
			'msgcodeString' => $this->msgcodeString
		];
	}   


}
?>











