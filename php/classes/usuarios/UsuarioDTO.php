<?php

require_once '../dto/DTOPadrao.php';

/**
 * UsuarioDTO - Data Transfer Object
 */
class UsuarioDTO extends DTOPadrao implements JsonSerializable
{
	public $id;
    public $iduserfacebook;
	public $email;
	public $pwd;
	public $apelido;
	public $tipoConta;
    public $isGratuito;
    public $codigoAtivacao;
    public $dataAtivacao;
    public $cupom;
    public $urlfoto;
	public $status;
	public $prjativo;
    public $lst_projetos = array();
	public $dataCadastro;
	public $dataAtualizacao;

    public function jsonSerialize()
    {
        return 
        [
            'id'   => $this->id,
            'iduserfacebook'   => $this->iduserfacebook,
            'email' => $this->email,
            'apelido' => $this->apelido,
            'tipoConta' => $this->tipoConta,
            'isGratuito' => $this->isGratuito,
            'codigoAtivacao' => $this->codigoAtivacao,
            'dataAtivacao' => $this->dataAtivacao,
            'cupom' => $this->cupom,
            'urlfoto' => $this->urlfoto,
            'status' => $this->status,
            'statusdesc' => $this->statusdesc,
            'prjativo' => $this->prjativo,
            'lst_projetos' => $this->lst_projetos,
            'dataCadastro' => $this->dataCadastro,
            'dataAtualizacao' => $this->dataAtualizacao,
            'msgcode' => $this->msgcode,
            'msgcodeString' => $this->msgcodeString
        ];
    }	
}

?>