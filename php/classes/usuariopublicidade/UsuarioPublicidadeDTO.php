<?php
// importar dependencias
require_once '../dto/DTOPadraoEntidade.php';

/**
* UsuarioPublicidadeDTO - Data Transfer Object
*
* @author Julio Cesar Vitorino 
* @since 20/09/2019 13:57:12
* @copyright(c), Julio Vitorino <julio.vitorino@gmail.com>
*/
class UsuarioPublicidadeDTO extends DTOPadraoEntidade implements JsonSerializable
{
    public $id;
    public $id_usuario;
    public $usuario;
    public $titulo;
    public $descricao;
    public $dataInicio;
    public $dataTermino;
    public $vlNormal;
    public $vlNormalMoeda;
    public $vlPromo;
    public $vlPromoMoeda;
    public $modelo;
    public $observacao;
    public $dataRemover;
    public $url;
    public $status;
    public $dataCadastro;
    public $dataAtualizacao;

    public function jsonSerialize()
    {
        return 
        [
            'id' => $this->id,
            'id_usuario' => $this->id_usuario,
            'usuario' => $this->usuario == NULL ? NULL : $this->usuario,
            'titulo' => $this->titulo,
            'descricao' => $this->descricao,
            'dataInicio' => $this->dataInicio,
            'dataTermino' => $this->dataTermino,
            'vlNormal' => $this->vlNormal,
            'vlNormalMoeda' => $this->vlNormalMoeda,
            'vlPromo' => $this->vlPromo,
            'vlPromoMoeda' => $this->vlPromoMoeda,
            'observacao' => $this->observacao,
            'dataRemover' => $this->dataRemover,
            'url' => $this->url,
            'modelo' => $this->modelo,
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
