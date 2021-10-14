<?php

// importar dependências
require_once '../dto/DTOPadraoEntidade.php';

/**
 * PlanoDTO - Data Transfer Object
 */

class PlanoUsuarioDTO extends DTOPadraoEntidade implements JsonSerializable
{
	public $id;
	public $idparent;
	public $usuarioid;
	public $planoid;
	public $nome;
	public $permissao;
	public $lstpermissao = [];
	public $valor;
	public $valorMoeda;
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
            'valorMoeda'   => $this->valorMoeda,
            'status'   => $this->status,
            'statusdesc' => $this->statusdesc,
            'dataCadastro'   => $this->dataCadastro,
            'dataAtualizacao'   => $this->dataAtualizacao
        ];
    }	

}

?>
