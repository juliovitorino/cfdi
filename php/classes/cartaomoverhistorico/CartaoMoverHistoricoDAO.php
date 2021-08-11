<?php

require_once '../interfaces/DAO.php';

/**
*
* CartaoMoverHistoricoDAO - Interface dos métodos de acesso aos dados da tabela CARTAO_MOVER_HISTORICO
* Camada de dados CartaoMoverHistorico - camada responsável SOMENTE pela acesso aos dados do sistema. 
* Não é uma camada visível para outros dispositivos, como as camadas de apresentação e aplicação. 
*
* Changelog:
* 
* @autor Julio Cesar Vitorino
* @since 24/07/2021 10:20:31
*
*/

interface CartaoMoverHistoricoDAO extends DAO
{
    public function updateStatus($id, $status);
    public function listCartaoMoverHistoricoStatus($status);
    public function countCartaoMoverHistoricoPorStatus($status);
    public function listCartaoMoverHistoricoPorStatus($status, $pag, $qtde, $coluna, $ordem);
    public function countCartaoMoverHistoricoPorUsuaIdStatus($usuaid, $status);
    public function listCartaoMoverHistoricoPorUsuaIdStatus($usuaid, $status, $pag, $qtde, $coluna, $ordem);
    public function countCartaoMoverHistoricoPorCartIdStatus($cartid, $status);
    public function listCartaoMoverHistoricoPorCartIdStatus($cartid, $status, $pag, $qtde, $coluna, $ordem);

    public function loadMaxIdcartaoPK($idCartao,$status);

    public function loadIdcartao($idCartao);
    public function loadIdusuariodoador($idUsuarioDoador);
    public function loadIdusuarioreceptor($idUsuarioReceptor);
    public function loadStatus($status);
    public function loadDatacadastro($dataCadastro);
    public function loadDataatualizacao($dataAtualizacao);

    public function updateIdcartao($id, $idCartao);
    public function updateIdusuariodoador($id, $idUsuarioDoador);
    public function updateIdusuarioreceptor($id, $idUsuarioReceptor);

}
?>
