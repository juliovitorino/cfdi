<?php
// importar dependencias
require_once '../dto/DTOPadraoEntidade.php';

/**
* CampanhaTopDezDTO - Data Transfer Object
*
* @author Julio Cesar Vitorino 
* @since 19/09/2019 08:36:54
* @copyright(c), Julio Vitorino <julio.vitorino@gmail.com>
*/
class CampanhaTopDezDTO extends DTOPadraoEntidade implements JsonSerializable
{
    public $id;
    public $id_campanha;
    public $id_usuario;
    public $qtde;
    public $status;
    public $dataCadastro;
    public $dataAtualizacao;

    public function jsonSerialize()
    {
        return 
        [
            'id' => $this->id,
            'id_campanha' => $this->id_campanha,
            'id_usuario' => $this->id_usuario,
            'qtde' => $this->qtde,
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











