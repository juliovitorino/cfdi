<?php

require_once '../interfaces/DAO.php';

/**
*
* CampanhaCashbackResgatePixDAO - Interface dos métodos de acesso aos dados da tabela CAMPANHA_CASHBACK_RESGATE_PIX
* Camada de dados CampanhaCashbackResgatePix - camada responsável SOMENTE pela acesso aos dados do sistema. 
* Não é uma camada visível para outros dispositivos, como as camadas de apresentação e aplicação. 
*
* Changelog:
* 
* @autor Julio Cesar Vitorino
* @since 26/07/2021 15:11:48
*
*/

interface CampanhaCashbackResgatePixDAO extends DAO
{
    public function updateStatus($id, $status);
    public function listCampanhaCashbackResgatePixStatus($status);
    public function countCampanhaCashbackResgatePixPorStatus($status);
    public function listCampanhaCashbackResgatePixPorStatus($status, $pag, $qtde, $coluna, $ordem);
    public function countCampanhaCashbackResgatePixPorUsuaIdStatus($usuaid, $status);
    public function listCampanhaCashbackResgatePixPorUsuaIdStatus($usuaid, $status, $pag, $qtde, $coluna, $ordem);
    public function countCampanhaCashbackResgatePixPorUsuaIdUsuaIdDevedorStatus($usuaid, $usuaidDevedor, $status);
    public function listCampanhaCashbackResgatePixPorUsuaIdUsuaIdDevedorStatus($usuaid, $usuaidDevedor, $status, $pag, $qtde, $coluna, $ordem);

    public function loadMaxIdUsuarioDevedorPK($idUsuarioDevedor,$status);

    public function loadIdUsuarioDevedor($idUsuarioDevedor);
    public function loadIdusuariosolicitante($idUsuarioSolicitante);
    public function loadTipochavepix($tipoChavePix);
    public function loadChavepix($chavePix);
    public function loadValorresgate($valorResgate);
    public function loadAutenticacaobco($autenticacaoBco);
    public function loadEstagiorealtime($estagioRealTime);
    public function loadDtestagioanalise($dtEstagioAnalise);
    public function loadDtestagiofinanceiro($dtEstagioFinanceiro);
    public function loadDtestagioerro($dtEstagioErro);
    public function loadDtestagiotranfbco($dtEstagioTranfBco);
    public function loadTxtlivreestagiort($txtLivreEstagioRT);
    public function loadStatus($status);
    public function loadDatacadastro($dataCadastro);
    public function loadDataatualizacao($dataAtualizacao);

    public function updateIdUsuarioDevedor($id, $idUsuarioDevedor);
    public function updateIdusuariosolicitante($id, $idUsuarioSolicitante);
    public function updateTipochavepix($id, $tipoChavePix);
    public function updateChavepix($id, $chavePix);
    public function updateValorresgate($id, $valorResgate);
    public function updateAutenticacaobco($id, $autenticacaoBco);
    public function updateEstagiorealtime($id, $estagioRealTime);
    public function updateDtestagioanalise($id, $dtEstagioAnalise);
    public function updateDtestagiofinanceiro($id, $dtEstagioFinanceiro);
    public function updateDtestagioerro($id, $dtEstagioErro);
    public function updateDtestagiotranfbco($id, $dtEstagioTranfBco);
    public function updateTxtlivreestagiort($id, $txtLivreEstagioRT);

}
?>
