<?php

require_once '../interfaces/DAO.php';

/**
*
* RegistroIndicacaoDAO - Interface dos métodos de acesso aos dados da tabela REGISTRO_INDICACAO
* Camada de dados RegistroIndicacao - camada responsável SOMENTE pela acesso aos dados do sistema. 
* Não é uma camada visível para outros dispositivos, como as camadas de apresentação e aplicação. 
*
* Changelog:
* 
* @autor Julio Cesar Vitorino
* @since 23/06/2021 14:44:26
*
*/

interface RegistroIndicacaoDAO extends DAO
{
    public function updateStatus($id, $status);
    public function listRegistroIndicacaoStatus($status);
    public function countRegistroIndicacaoPorStatus($status);
    public function listRegistroIndicacaoPorStatus($status, $pag, $qtde, $coluna, $ordem);
    public function countRegistroIndicacaoPorUsuaIdStatus($usuaid, $status);
    public function listRegistroIndicacaoPorUsuaIdStatus($usuaid, $status, $pag, $qtde, $coluna, $ordem);

    public function loadMaxIdusuariopromotorPK($idUsuarioPromotor,$status);

    public function loadIdusuariopromotor($idUsuarioPromotor);
    public function loadIdusuarioindicado($idUsuarioIndicado);
    public function loadStatus($status);
    public function loadDatacadastro($dataCadastro);
    public function loadDataatualizacao($dataAtualizacao);

    public function updateIdusuariopromotor($id, $idUsuarioPromotor);
    public function updateIdusuarioindicado($id, $idUsuarioIndicado);
    //public function updateStatus($id, $status);
}
?>
