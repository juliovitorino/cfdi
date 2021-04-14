<?php
// importar dependencias
require_once '../dto/DTOPadraoEntidade.php';

/**
* MkdListaDTO - Data Transfer Object
*
* @author Julio Cesar Vitorino 
* @since 04/11/2019 09:31:13
* @copyright(c), Julio Vitorino <julio.vitorino@gmail.com>
*/
class MkdListaDTO extends DTOPadraoEntidade implements JsonSerializable
{
    public $id;
    public $id_mkd_campanha;
    public $nome;
    public $email;
    public $primeiroNome;
    public $sobrenome;
    public $whatsapp;
    public $hashlead;
    public $status;
    public $dataCadastro;
    public $dataAtualizacao;

    public function jsonSerialize()
    {
        return 
        [
            'id' => $this->id,
            'id_mkd_campanha' => $this->id_mkd_campanha,
            'nome' => $this->nome,
            'email' => $this->email,
            'primeiroNome' => $this->primeiroNome,
            'sobrenome' => $this->sobrenome,
            'whatsapp' => $this->whatsapp,
            'hashlead' => $this->hashlead,
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
