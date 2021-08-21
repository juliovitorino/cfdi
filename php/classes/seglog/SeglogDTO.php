<?php
// importar dependencias
require_once '../dto/DTOPadraoEntidade.php';
/**
* SeglogDTO - Data Transfer Object
*
* @author Julio Cesar Vitorino 
* @since 21/08/2021 12:30:09
* @copyright(c), Julio Vitorino <julio.vitorino@gmail.com>
*/
class SeglogDTO extends DTOPadraoEntidade implements JsonSerializable
{
    public $id;
    public $idgafa;
    public $id_usuario;
    public $funcao;
    public $incrudCriar;
    public $incrudRecuperar;
    public $incrudAtualizar;
    public $incrudExcluir;
    public $status;
    public $dataCadastro;
    public $dataAtualizacao;

    public function jsonSerialize()
    {
        return 
        [
            'id' => $this->id,
            'idgafa' => $this->idgafa,
            'id_usuario' => $this->id_usuario,
            'funcao' => $this->funcao,
            'incrudCriar' => $this->incrudCriar,
            'incrudRecuperar' => $this->incrudRecuperar,
            'incrudAtualizar' => $this->incrudAtualizar,
            'incrudExcluir' => $this->incrudExcluir,
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











