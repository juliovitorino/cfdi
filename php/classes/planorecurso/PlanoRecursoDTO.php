<?php
// importar dependencias
require_once '../dto/DTOPadraoEntidade.php';
/**
* PlanoRecursoDTO - Data Transfer Object
*
* @author Julio Cesar Vitorino 
* @since 09/09/2021 12:12:30
* @copyright(c), Julio Vitorino <julio.vitorino@gmail.com>
*/
class PlanoRecursoDTO extends DTOPadraoEntidade implements JsonSerializable
{
    public $idplano;
    public $idrecurso;

    public function jsonSerialize()
    {
        return 
        [
            'id' => $this->id,
            'idplano' => $this->idplano,
            'idrecurso' => $this->idrecurso,
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

