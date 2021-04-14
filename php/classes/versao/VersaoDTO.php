<?php
// importar dependencias
require_once '../dto/DTOPadraoEntidade.php';

/**
* VersaoDTO - Data Transfer Object
*
* @author Julio Cesar Vitorino 
* @since 06/10/2019 15:59:51
* @copyright(c), Julio Vitorino <julio.vitorino@gmail.com>
*/
class VersaoDTO extends DTOPadraoEntidade implements JsonSerializable
{
    public $id;
    public $versao;
    public $status;
    public $dataCadastro;
    public $dataAtualizacao;

    public function jsonSerialize()
    {
        return 
        [
            'id' => $this->id,
            'versao' => $this->versao,
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
