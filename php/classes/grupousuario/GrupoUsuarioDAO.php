<?php

require_once '../interfaces/DAO.php';

/**
*
* GrupoUsuarioDAO - Interface dos métodos de acesso aos dados da tabela SEGLOG_GRUPO_USUARIO
* Camada de dados GrupoUsuario - camada responsável SOMENTE pela acesso aos dados do sistema. 
* Não é uma camada visível para outros dispositivos, como as camadas de apresentação e aplicação. 
*
* Changelog:
* 
* @autor Julio Cesar Vitorino
* @since 22/08/2021 17:02:50
*
*/

interface GrupoUsuarioDAO extends DAO
{
    public function updateStatus($id, $status);
    public function listGrupoUsuarioStatus($status);
    public function countGrupoUsuarioPorStatus($status);
    public function listGrupoUsuarioPorStatus($status, $pag, $qtde, $coluna, $ordem);
    public function countGrupoUsuarioPorUsuaIdStatus($usuaid, $status);
    public function listGrupoUsuarioPorUsuaIdStatus($usuaid, $status, $pag, $qtde, $coluna, $ordem);

    public function loadMaxIdgradPK($idgrad,$status);

    public function loadIdgrad($idgrad);
    public function loadId_Usuario($id_usuario);
    public function loadStatus($status);
    public function loadDatacadastro($dataCadastro);
    public function loadDataatualizacao($dataAtualizacao);

    public function updateIdgrad($id, $idgrad);
    public function updateId_Usuario($id, $id_usuario);

}
?>
