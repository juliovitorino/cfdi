<?php
// importar dependencias
require_once '../dto/DTOPadraoEntidade.php';
/**
* CampanhaSorteioFilaCriacaoDTO - Data Transfer Object
*
* @author Julio Cesar Vitorino 
* @since 17/06/2021 08:04:03
* @copyright(c), Julio Vitorino <julio.vitorino@gmail.com>
*/
class CampanhaSorteioFilaCriacaoDTO extends DTOPadraoEntidade implements JsonSerializable
{
    public $id;
    public $id_caso;
    public $qtLoteTicketCriar;
    public $status;
    public $dataCadastro;
    public $dataAtualizacao;

    public function jsonSerialize()
    {
        return 
        [
            'id' => $this->id,
            'id_caso' => $this->id_caso,
            'qtLoteTicketCriar' => $this->qtLoteTicketCriar,
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











