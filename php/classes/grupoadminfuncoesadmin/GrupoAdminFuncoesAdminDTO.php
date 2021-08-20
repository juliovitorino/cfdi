<?php
// importar dependencias
require_once '../dto/DTOPadraoEntidade.php';
/**
* GrupoAdminFuncoesAdminDTO - Data Transfer Object
*
* @author Julio Cesar Vitorino 
* @since 20/08/2021 18:47:48
* @copyright(c), Julio Vitorino <julio.vitorino@gmail.com>
*/
class GrupoAdminFuncoesAdminDTO extends DTOPadraoEntidade implements JsonSerializable
{
    public $idGrupoAdministracao;
    public $idFuncoesAdministrativas;
    public $descricao;
    public $incrudCriar;
    public $incrudRecuperar;
    public $incrudAtualizar;
    public $incrudExcluir;

    public function jsonSerialize()
    {
        return 
        [
            'id' => $this->id,
            'idGrupoAdministracao' => $this->idGrupoAdministracao,
            'idFuncoesAdministrativas' => $this->idFuncoesAdministrativas,
            'descricao' => $this->descricao,
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
