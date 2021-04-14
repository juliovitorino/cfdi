<?php

// importar dependências
require_once '../dto/DTOPadrao.php';

/**
 * PlanoDTO - Data Transfer Object
 */

class PlanoDTO extends DTOPadrao implements JsonSerializable
{
	public $id;
	public $nome;
	public $permissao;
	public $lstpermissao = [];
	public $valor;
	public $valorMoeda;
	public $status;
	public $tipo;
	public $dataCadastro;
	public $dataAtualizacao;

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
			'dataCadastro' => $this->dataCadastro,
			'dataAtualizacao' => $this->dataAtualizacao,
            'msgcode' => $this->msgcode,
            'msgcodeString' => $this->msgcodeString

			
        ];
    }   

}

?>
