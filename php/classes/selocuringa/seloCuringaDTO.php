<?php
// importar dependencias
require_once '../dto/DTOPadraoEntidade.php';
/**
* SeloCuringaDTO - Data Transfer Object
*
* @author Julio Cesar Vitorino 
* @since 23/08/2019 11:13:11
* @copyright(c), Julio Vitorino <julio.vitorino@gmail.com>
*/
class SeloCuringaDTO extends DTOPadraoEntidade implements JsonSerializable
{
    public $id;
    public $id_usuario;
    public $id_campanha;
    public $id_cartao;
    public $id_autorizador;
    public $qrcode;
    public $status;
    public $dataCadastro;
    public $dataAtualizacao;

    public function jsonSerialize()
    {
        return 
        [
            'id' => $this->id,
            'id_usuario' => $this->id_usuario,
            'id_campanha' => $this->id_campanha,
            'id_cartao' => $this->id_cartao,
            'id_autorizador' => $this->id_autorizador,
            'qrcode' => $this->qrcode,
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
