<?php
// importar dependencias
require_once '../dto/DTOPadraoEntidade.php';
/**
* CartaoMoverHistoricoDTO - Data Transfer Object
*
* @author Julio Cesar Vitorino 
* @since 24/07/2021 10:20:31
* @copyright(c), Julio Vitorino <julio.vitorino@gmail.com>
*/
class CartaoMoverHistoricoDTO extends DTOPadraoEntidade implements JsonSerializable
{
    public $idCartao;
    public $idUsuarioDoador;
    public $idUsuarioReceptor;

    public function jsonSerialize()
    {
        return 
        [
            'id' => $this->id,
            'idCartao' => $this->idCartao,
            'idUsuarioDoador' => $this->idUsuarioDoador,
            'idUsuarioReceptor' => $this->idUsuarioReceptor,
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
