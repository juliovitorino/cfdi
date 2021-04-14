<?php

require_once '../interfaces/DAO.php';

/**
*
* UsuarioVersaoDAO - Interface dos métodos de acesso aos dados da tabela USUARIO_VERSAO
* Camada de dados UsuarioVersao - camada responsável SOMENTE pela acesso aos dados do sistema. 
* Não é uma camada visível para outros dispositivos, como as camadas de apresentação e aplicação. 
*
* Changelog:
* 
* @autor Julio Cesar Vitorino
* @since 06/10/2019 16:44:47
*
*/

interface UsuarioVersaoDAO extends DAO
{
    public function updateStatus($id, $status);
    public function listUsuarioVersaoStatus($status);
    public function countUsuarioVersaoPorStatus($status);
    public function listUsuarioVersaoPorStatus($status, $pag, $qtde, $coluna, $ordem);
    public function countUsuarioVersaoPorUsuaIdStatus($usuaid, $status);
    public function listUsuarioVersaoPorUsuaIdStatus($usuaid, $status, $pag, $qtde, $coluna, $ordem);

    public function loadMaxId_VersaoPK($id_versao,$status);
    public function loadMaxPKIdUsuarioIdVersao($id_usuario, $id_versao);

    public function loadId_Versao($id_versao);
    public function loadId_Usuario($id_usuario);
    public function loadStatus($status);
    public function loadDatacadastro($dataCadastro);
    public function loadDataatualizacao($dataAtualizacao);

    public function updateId_Versao($id, $id_versao);
    public function updateId_Usuario($id, $id_usuario);

}
?>
