<?php
// importar dependencias
require_once '../dto/DTOPadraoEntidade.php';
/**
* UsuarioCampanhaSorteioTicketDTO - Data Transfer Object
*
* @author Julio Cesar Vitorino 
* @since 22/06/2021 10:37:39
* @copyright(c), Julio Vitorino <julio.vitorino@gmail.com>
*/
class UsuarioCampanhaSorteioTicketDTO extends DTOPadraoEntidade implements JsonSerializable
{
    public $id;
    public $iduscs;
    public $ticket;
    public $status;
    public $dataCadastro;
    public $dataAtualizacao;

    public function jsonSerialize()
    {
        return 
        [
            'id' => $this->id,
            'iduscs' => $this->iduscs,
            'ticket' => $this->ticket,
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

