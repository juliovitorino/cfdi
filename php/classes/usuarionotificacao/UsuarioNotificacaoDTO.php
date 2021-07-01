<?php

// importar dependencias
require_once '../dto/DTOPadraoEntidade.php';

/**
* UsuarioNotificacaoDTO - Data Transfer Object
*
* @author Julio Cesar Vitorino 
* @since 25/08/2019 16:16:12
* @copyright(c), Julio Vitorino <julio.vitorino@gmail.com>
*/
class UsuarioNotificacaoDTO extends DTOPadraoEntidade implements JsonSerializable
{
    //public $id;
    public $id_usuario;
    public $notificacao;
    public $icone;
    public $imagem;
    public $bkgcor;
    public $tipo;
    public $dataPrevApagar;
    public $json;
    //public $status;
    //public $dataCadastro;
    //public $dataAtualizacao;

    public function jsonSerialize()
    {
        return 
        [
            'id' => $this->id,
            'id_usuario' => $this->id_usuario,
            'notificacao' => $this->notificacao,
            'icone' => $this->icone,
            'imagem' => $this->imagem,
            'bkgcor' => $this->bkgcor,
            'tipo' => $this->tipo,
            'dataPrevApagar' => $this->dataPrevApagar,
            'json' => $this->json,
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
