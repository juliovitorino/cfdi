<?php
// importar dependencias
require_once '../dto/DTOPadraoEntidade.php';
/**
* GrupoAdministracaoDTO - Data Transfer Object
*
* @author Julio Cesar Vitorino 
* @since 20/08/2021 15:41:08
* @copyright(c), Julio Vitorino <julio.vitorino@gmail.com>
*/
class GrupoAdministracaoDTO extends DTOPadraoEntidade implements JsonSerializable
{
    public $descricao;

    public function jsonSerialize()
    {
        return 
        [
            'id' => $this->id,
            'descricao' => $this->descricao,
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
