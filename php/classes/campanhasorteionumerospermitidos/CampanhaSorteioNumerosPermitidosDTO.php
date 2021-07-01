<?php
// importar dependencias
require_once '../dto/DTOPadraoEntidade.php';
/**
* CampanhaSorteioNumerosPermitidosDTO - Data Transfer Object
*
* @author Julio Cesar Vitorino 
* @since 17/06/2021 17:44:16
* @copyright(c), Julio Vitorino <julio.vitorino@gmail.com>
*/
class CampanhaSorteioNumerosPermitidosDTO extends DTOPadraoEntidade implements JsonSerializable
{
    public $id;
    public $id_caso;
    public $nrTicketSorteio;
    public $status;
    public $dataCadastro;
    public $dataAtualizacao;

    public function jsonSerialize()
    {
        return 
        [
            'id' => $this->id,
            'id_caso' => $this->id_caso,
            'nrTicketSorteio' => $this->nrTicketSorteio,
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
