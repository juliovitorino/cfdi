<?php

require_once '../interfaces/DAO.php';

/**
*
* GrupoAdminFuncoesAdminUsuarioDAO - Interface dos métodos de acesso aos dados da tabela SEGLOG_GRUPO_ADM_FUNCAO_ADM_USUARIO
* Camada de dados GrupoAdminFuncoesAdminUsuario - camada responsável SOMENTE pela acesso aos dados do sistema. 
* Não é uma camada visível para outros dispositivos, como as camadas de apresentação e aplicação. 
*
* Changelog:
* 
* @autor Julio Cesar Vitorino
* @since 20/08/2021 19:25:25
*
*/

interface GrupoAdminFuncoesAdminUsuarioDAO extends DAO
{
    public function updateStatus($id, $status);
    public function listGrupoAdminFuncoesAdminUsuarioStatus($status);
    public function countGrupoAdminFuncoesAdminUsuarioPorStatus($status);
    public function listGrupoAdminFuncoesAdminUsuarioPorStatus($status, $pag, $qtde, $coluna, $ordem);
    public function countGrupoAdminFuncoesAdminUsuarioPorUsuaIdStatus($usuaid, $status);
    public function listGrupoAdminFuncoesAdminUsuarioPorUsuaIdStatus($usuaid, $status, $pag, $qtde, $coluna, $ordem);

    public function loadMaxIdgrupoadmfuncoesadmPK($idGrupoAdmFuncoesAdm,$status);

    public function loadIdgrupoadmfuncoesadm($idGrupoAdmFuncoesAdm);
    public function loadId_Usuario($id_usuario);
    public function loadStatus($status);
    public function loadDatacadastro($dataCadastro);
    public function loadDataatualizacao($dataAtualizacao);

    public function updateIdgrupoadmfuncoesadm($id, $idGrupoAdmFuncoesAdm);
    public function updateId_Usuario($id, $id_usuario);

}
?>








































































































































































