<?php

require_once '../interfaces/DAO.php';
/**********************************************************
===========================================================

 #####  #     #   ###   ######     #    ######   ##### 
#     # #     #    #    #     #   # #   #     # #     #
#       #     #    #    #     #  #   #  #     # #     #
#       #     #    #    #     # #     # #     # #     #
#       #     #    #    #     # ####### #     # #     #
#     # #     #    #    #     # #     # #     # #     #
 #####   #####    ###   ######  #     # ######   #####
 
===========================================================
CÓDIGO SOFREU ALTERAÇÕES DE PROFUNDAS, NÃO USE O GERADOR
AUTOMÁTICO PARA SUBSTITUIR O CÓDIGO AQUI EXISTENTE.
TODO O SISTEMA PODE ENTRAR EM COLAPSO.
===========================================================
***********************************************************/ 

/**
*
* UsuarioAutorizadorDAO - Interface dos métodos de acesso aos dados da tabela USUARIO_AUTORIZADOR
* Camada de dados UsuarioAutorizador - camada responsável SOMENTE pela acesso aos dados do sistema. 
* Não é uma camada visível para outros dispositivos, como as camadas de apresentação e aplicação. 
*
* Changelog:
* 
* @autor Julio Cesar Vitorino
* @since 09/09/2019 12:52:36
*
*/

interface UsuarioAutorizadorDAO extends DAO
{
    public function updateStatus($id, $status);
    public function listUsuarioAutorizadorStatus($status);
    public function countUsuarioAutorizadorPorStatus($status);
    public function listUsuarioAutorizadorPorStatus($status, $pag, $qtde, $coluna, $ordem);
    public function countUsuarioAutorizadorPorUsuaIdStatus($usuaid, $status);
    public function listUsuarioAutorizadorPorUsuaIdStatus($usuaid, $status, $pag, $qtde, $coluna, $ordem);
    public function countUsuarioAutorizadorPorUsuaIdAutorizadorStatus($usuaid, $status);
    public function listUsuarioAutorizadorPorUsuaIdAutorizadorStatus($usuaid, $status, $pag, $qtde, $coluna, $ordem);
    public function countUsuarioAutorizadorPorUsuaIdAutorizadorCampId($usuaid, $campid, $status);
    public function listUsuarioAutorizadorPorUsuaIdAutorizadorCampId($usuaid, $campid, $status, $pag, $qtde, $coluna, $ordem);
    public function listUsuarioCarimbador($usuaid,$status, $pag, $qtde, $coluna, $ordem);
    public function countUsuarioCarimbador($usuaid,$status);



    public function loadMaxId_UsuarioPK($id_usuario,$status);
    public function loadMaxId_UsuarioAutorizadorPK($id_usuario,$id_campanha, $status);
    public function loadMaxId_UsuarioCarimbadorPK($id_usuario,$id_campanha,$status);

    public function loadId_Usuario($id_usuario);
    public function loadId_Autorizador($id_autorizador);
    public function loadId_Campanha($id_campanha);
    public function loadTipo($tipo);
    public function loadPermissao($permissao);
    public function loadDatainicio($dataInicio);
    public function loadDatatermino($dataTermino);
    public function loadStatus($status);
    public function loadDatacadastro($dataCadastro);
    public function loadDataatualizacao($dataAtualizacao);

    public function updateId_Usuario($id, $id_usuario);
    public function updateId_Autorizador($id, $id_autorizador);
    public function updateId_Campanha($id, $id_campanha);
    public function updateTipo($id, $tipo);
    public function updatePermissao($id, $permissao);
    public function updateDatainicio($id, $dataInicio);
    public function updateDatatermino($id, $dataTermino);

}
?>
