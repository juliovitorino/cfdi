<?php

require_once '../interfaces/DAO.php';

/**
*
* VersaoDAO - Interface dos métodos de acesso aos dados da tabela VERSAO
* Camada de dados Versao - camada responsável SOMENTE pela acesso aos dados do sistema. 
* Não é uma camada visível para outros dispositivos, como as camadas de apresentação e aplicação. 
*
* Changelog:
* 
* @autor Julio Cesar Vitorino
* @since 06/10/2019 15:59:51
*
*/

interface VersaoDAO extends DAO
{
    public function updateStatus($id, $status);
    public function listVersaoStatus($status);
    public function countVersaoPorStatus($status);
    public function listVersaoPorStatus($status, $pag, $qtde, $coluna, $ordem);
    public function countVersaoPorUsuaIdStatus($usuaid, $status);
    public function listVersaoPorUsuaIdStatus($usuaid, $status, $pag, $qtde, $coluna, $ordem);

    public function loadMaxVersaoPK($versao,$status);
    public function loadMaxSoVersaoPK($versao);
    public function loadMaxPK();

    public function loadVersao($versao);
    public function loadStatus($status);
    public function loadDatacadastro($dataCadastro);
    public function loadDataatualizacao($dataAtualizacao);

    public function updateVersao($id, $versao);

}
?>

