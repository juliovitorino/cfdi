<?php
// importar dependencias
require_once '../dto/DTOPadraoEntidade.php';
/**
* ContatoDTO - Data Transfer Object
*
* @author Julio Cesar Vitorino 
* @since 31/08/2021 08:17:22
* @copyright(c), Julio Vitorino <julio.vitorino@gmail.com>
*/
class ContatoDTO extends DTOPadraoEntidade implements JsonSerializable
{
    public $nome;
    public $email;
    public $origem;
    public $mensagem;

    public function jsonSerialize()
    {
        return 
        [
            'id' => $this->id,
            'nome' => $this->nome,
            'email' => $this->email,
            'origem' => $this->origem,
            'mensagem' => $this->mensagem,
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

