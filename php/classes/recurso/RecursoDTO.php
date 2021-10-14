<?php
// importar dependencias
require_once '../dto/DTOPadraoEntidade.php';
/**
* RecursoDTO - Data Transfer Object
*
* @author Julio Cesar Vitorino 
* @since 09/09/2021 08:00:49
* @copyright(c), Julio Vitorino <julio.vitorino@gmail.com>
*/
class RecursoDTO extends DTOPadraoEntidade implements JsonSerializable
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

