<?php
// importar dependencias

require_once '../dto/DTOPadraoEntidade.php';

/**
* UsuarioAvaliacaoDTO - Data Transfer Object
*
* @author Julio Cesar Vitorino 
* @since 17/09/2019 09:16:28
* @copyright(c), Julio Vitorino <julio.vitorino@gmail.com>
*/
class UsuarioAvaliacaoDTO extends DTOPadraoEntidade implements JsonSerializable
{
    public $id;
    public $id_usuario;
    public $contadorStar_1;
    public $contadorStar_2;
    public $contadorStar_3;
    public $contadorStar_4;
    public $contadorStar_5;
    public $ratingCalculado;
    public $status;
    public $dataCadastro;
    public $dataAtualizacao;

    public function jsonSerialize()
    {
        return 
        [
            'id' => $this->id,
            'id_usuario' => $this->id_usuario,
            'contadorStar_1' => $this->contadorStar_1,
            'contadorStar_2' => $this->contadorStar_2,
            'contadorStar_3' => $this->contadorStar_3,
            'contadorStar_4' => $this->contadorStar_4,
            'contadorStar_5' => $this->contadorStar_5,
            'ratingCalculado' => $this->ratingCalculado,
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











