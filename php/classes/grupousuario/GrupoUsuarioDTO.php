<?php
// importar dependencias
require_once '../dto/DTOPadraoEntidade.php';
/**
* GrupoUsuarioDTO - Data Transfer Object
*
* @author Julio Cesar Vitorino 
* @since 22/08/2021 17:02:50
* @copyright(c), Julio Vitorino <julio.vitorino@gmail.com>
*/
class GrupoUsuarioDTO extends DTOPadraoEntidade implements JsonSerializable
{
    public $idgrad;
    public $id_usuario;

    public function jsonSerialize()
    {
        return 
        [
            'id' => $this->id,
            'idgrad' => $this->idgrad,
            'id_usuario' => $this->id_usuario,
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

