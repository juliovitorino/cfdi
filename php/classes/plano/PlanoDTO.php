<?php

// importar dependências
require_once '../dto/DTOPadraoEntidade.php';

/**
 * PlanoDTO - Data Transfer Object
 */

class PlanoDTO extends DTOPadraoEntidade implements JsonSerializable
{
	public $nome;
	public $permissao;
	public $lstpermissao = [];
	public $valor;
	public $valorMoeda;
	public $tipo;

	function __construct()	{	}

    public function jsonSerialize()
    {
        return 
        [
			'id' => $this->id,
			'nome' => $this->nome,
			'permissao' => $this->permissao,
			'lstpermissao' => $this->lstpermissao,
			'valor' => $this->valor,
			'valorMoeda' => $this->valorMoeda,
			'tipo' => $this->tipo,
			'status' => $this->status,
			'statusdesc' => $this->statusdesc,
			'dataCadastro' => $this->dataCadastro,
			'dataAtualizacao' => $this->dataAtualizacao,
            'msgcode' => $this->msgcode,
            'msgcodeString' => $this->msgcodeString

			
        ];
    }   

}

?>
