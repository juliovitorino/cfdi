<?php

// importar dependencias

require_once '../dto/DTOPadraoEntidade.php';

/**
* Data Transfer Object
*
* @author Julio Vitorino <julio.vitorino@gmail.com>
* @copyright 2019-2019 The JCV Group
*/
class CidadeDTO extends DTOPadraoEntidade implements JsonSerializable
{
    public $id;
    public $cidade;
    public $status;
    public $dataCadastro;
    public $dataAtualizacao;

    public function jsonSerialize()
    {
        return 
        [
            'id' => $this->id,
            'cidade' => $this->cidade,
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











