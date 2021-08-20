<?php

require_once '../interfaces/DAO.php';

/**
*
* GrupoAdminFuncoesAdminDAO - Interface dos métodos de acesso aos dados da tabela SEGLOG_GRUPO_ADM_FUNCAO_ADM
* Camada de dados GrupoAdminFuncoesAdmin - camada responsável SOMENTE pela acesso aos dados do sistema. 
* Não é uma camada visível para outros dispositivos, como as camadas de apresentação e aplicação. 
*
* Changelog:
* 
* @autor Julio Cesar Vitorino
* @since 20/08/2021 18:54:21
*
*/

interface GrupoAdminFuncoesAdminDAO extends DAO
{
    public function updateStatus($id, $status);
    public function listGrupoAdminFuncoesAdminStatus($status);
    public function countGrupoAdminFuncoesAdminPorStatus($status);
    public function listGrupoAdminFuncoesAdminPorStatus($status, $pag, $qtde, $coluna, $ordem);
    public function countGrupoAdminFuncoesAdminPorUsuaIdStatus($usuaid, $status);
    public function listGrupoAdminFuncoesAdminPorUsuaIdStatus($usuaid, $status, $pag, $qtde, $coluna, $ordem);

    public function loadMaxIdgrupoadministracaoPK($idGrupoAdministracao,$status);

    public function loadIdgrupoadministracao($idGrupoAdministracao);
    public function loadIdfuncoesadministrativas($idFuncoesAdministrativas);
    public function loadDescricao($descricao);
    public function loadIncrudcriar($incrudCriar);
    public function loadIncrudrecuperar($incrudRecuperar);
    public function loadIncrudatualizar($incrudAtualizar);
    public function loadIncrudexcluir($incrudExcluir);
    public function loadStatus($status);
    public function loadDatacadastro($dataCadastro);
    public function loadDataatualizacao($dataAtualizacao);

    public function updateIdgrupoadministracao($id, $idGrupoAdministracao);
    public function updateIdfuncoesadministrativas($id, $idFuncoesAdministrativas);
    public function updateDescricao($id, $descricao);
    public function updateIncrudcriar($id, $incrudCriar);
    public function updateIncrudrecuperar($id, $incrudRecuperar);
    public function updateIncrudatualizar($id, $incrudAtualizar);
    public function updateIncrudexcluir($id, $incrudExcluir);

}
?>

