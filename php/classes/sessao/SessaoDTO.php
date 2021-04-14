<?php

/**
 * SessaoDTO - Data Transfer Object
 */

// importar dependências
require_once '../dto/DTOPadrao.php';

class SessaoDTO extends DTOPadrao implements JsonSerializable
{
	public $id;
	public $usuario;
	public $usuariodto;
	public $pwd;
    public $tokenid;
    public $keep;
    public $tipousuario;
    public $forcelogin;
    public $urlControlador;
    public $status;
    public $statusdesc;    
	public $dataCadastro;
	public $dataAtualizacao;

	public function jsonSerialize()
    {
        return 
        [
            'tokenid' => $this->tokenid,
            'tipousuario' => $this->tipousuario,
            'urlControlador' => $this->urlControlador,
            'usuariodto' => $this->usuariodto == NULL ? NULL : $this->usuariodto->jsonSerialize(),
            'msgcode' => $this->msgcode,
            'msgcodeString' => $this->msgcodeString
        ];
    }	


}

?>