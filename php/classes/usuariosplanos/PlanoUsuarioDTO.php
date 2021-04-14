<?php

// importar dependências
require_once '../dto/DTOPadrao.php';

/**
 * PlanoDTO - Data Transfer Object
 */

class PlanoUsuarioDTO extends DTOPadrao implements JsonSerializable
{
	public $id;
	public $idparent;
	public $usuarioid;
	public $planoid;
	public $nome;
	public $permissao;
	public $lstpermissao = [];
	public $valor;
	public $status;
	public $dataCadastro;
	public $dataAtualizacao;

    public function jsonSerialize()
    {
        return 
        [
            'id'   => $this->id,
            'idparent'   => $this->idparent,
            'usuarioid'   => $this->usuarioid,
            'planoid'   => $this->planoid,
            'nome'   => $this->nome,
            'permissao'   => $this->permissao,
            'lstpermissao'   => $this->lstpermissao,
            'valor'   => $this->valor,
            'status'   => $this->status,
            'dataCadastro'   => $this->dataCadastro,
            'dataAtualizacao'   => $this->dataAtualizacao
        ];
    }	

}

?>
