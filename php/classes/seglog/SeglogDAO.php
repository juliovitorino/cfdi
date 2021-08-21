<?php

require_once '../interfaces/DAO.php';

/**
*
* SeglogDAO - Interface dos métodos de acesso aos dados da tabela VW_SEGLOG
* Camada de dados Seglog - camada responsável SOMENTE pela acesso aos dados do sistema. 
* Não é uma camada visível para outros dispositivos, como as camadas de apresentação e aplicação. 
*
* Changelog:
* 
* @autor Julio Cesar Vitorino
* @since 21/08/2021 12:30:09
*
*/

interface SeglogDAO extends DAO
{
    public function updateStatus($id, $status);
    public function listSeglogStatus($status);
    public function countSeglogPorStatus($status);
    public function listSeglogPorStatus($status, $pag, $qtde, $coluna, $ordem);
    public function countSeglogPorUsuaIdStatus($usuaid, $status);
    public function listSeglogPorUsuaIdStatus($usuaid, $status, $pag, $qtde, $coluna, $ordem);

    public function loadMaxIdgafaPK($idgafa,$status);

    public function loadIdgafa($idgafa);
    public function loadId_Usuario($id_usuario);
    public function loadFuncao($funcao);
    public function loadId_UsuarioFuncao( $id_usuario,$funcao);
    public function loadIncrudcriar($incrudCriar);
    public function loadIncrudrecuperar($incrudRecuperar);
    public function loadIncrudatualizar($incrudAtualizar);
    public function loadIncrudexcluir($incrudExcluir);
    public function loadStatus($status);
    public function loadDatacadastro($dataCadastro);
    public function loadDataatualizacao($dataAtualizacao);

    public function updateIdgafa($id, $idgafa);
    public function updateId_Usuario($id, $id_usuario);
    public function updateFuncao($id, $funcao);
    public function updateIncrudcriar($id, $incrudCriar);
    public function updateIncrudrecuperar($id, $incrudRecuperar);
    public function updateIncrudatualizar($id, $incrudAtualizar);
    public function updateIncrudexcluir($id, $incrudExcluir);

}
?>

