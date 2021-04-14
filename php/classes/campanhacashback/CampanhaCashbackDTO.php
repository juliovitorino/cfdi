<?php

// importar dependencias
require_once '../dto/DTOPadraoEntidade.php';

/**
* CampanhaCashbackDTO - Data Transfer Object
*
* @author Julio Cesar Vitorino 
* @since 26/08/2019 15:30:22
* @copyright(c), Julio Vitorino <julio.vitorino@gmail.com>
*/
class CampanhaCashbackDTO extends DTOPadraoEntidade implements JsonSerializable
{
    public $id;
    public $id_usca;
    public $id_campanha;
    public $id_usuario;
    public $percentual;
    public $percentualFmt;
    public $dataTermino;
    public $obs;
    public $status;
    public $dataCadastro;
    public $dataAtualizacao;

    public function jsonSerialize()
    {
        return 
        [
            'id' => $this->id,
            'id_usca' => $this->id_usca,
            'id_campanha' => $this->id_campanha,
            'id_usuario' => $this->id_usuario,
            'percentual' => $this->percentual,
            'percentualFmt' => $this->percentualFmt,
            'dataTermino' => $this->dataTermino,
            'obs' => $this->obs,
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
