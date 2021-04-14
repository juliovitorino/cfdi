<?php

require_once 'DTOPadrao.php';

/**
 * DTOPadrao - Retorno de mensagens padrão ao invocador
 */
class DTOPadraoEntidade extends DTOPadrao implements JsonSerializable
{
	public $id;
    public $status;
    public $statusdesc;
	public $dataCadastro;
	public $dataAtualizacao;

    public function jsonSerialize()
    {
        return 
        [
            'id'   => $this->id,
			'status' => $this->status,
			'statusdesc' => $this->statusdesc,
			'dataCadastro' => $this->dataCadastro,
			'dataAtualizacao' => $this->dataAtualizacao,
            'msgcode'   => $this->msgcode,
            'msgcodeString' => $this->msgcodeString
        ];
    }	
}

?>