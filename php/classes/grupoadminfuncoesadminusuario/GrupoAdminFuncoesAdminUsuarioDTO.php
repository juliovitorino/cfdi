<?php
// importar dependencias
require_once '../dto/DTOPadraoEntidade.php';
/**
* GrupoAdminFuncoesAdminUsuarioDTO - Data Transfer Object
*
* @author Julio Cesar Vitorino 
* @since 20/08/2021 19:25:25
* @copyright(c), Julio Vitorino <julio.vitorino@gmail.com>
*/
class GrupoAdminFuncoesAdminUsuarioDTO extends DTOPadraoEntidade implements JsonSerializable
{
    public $id;
    public $idGrupoAdmFuncoesAdm;
    public $id_usuario;
    public $status;
    public $dataCadastro;
    public $dataAtualizacao;

    public function jsonSerialize()
    {
        return 
        [
            'id' => $this->id,
            'idGrupoAdmFuncoesAdm' => $this->idGrupoAdmFuncoesAdm,
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

