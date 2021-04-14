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
* CampanhaCashbackCCDAO - Interface dos métodos de acesso aos dados da tabela CAMPANHA_CASHBACK_CC
* Camada de dados CampanhaCashbackCC - camada responsável SOMENTE pela acesso aos dados do sistema. 
* Não é uma camada visível para outros dispositivos, como as camadas de apresentação e aplicação. 
*
* Changelog:
* 
* @autor Julio Cesar Vitorino
* @since 26/08/2019 16:09:29
*
*/

interface CampanhaCashbackCCDAO extends DAO
{

    // Customizações
    public function loadId_CashbackSaldoCC($id_usuario, $id_usuario_dono);
    public function listUsuarioDono($id_usuario);
    public function listUsuarioSomenteDono($id_usuario, $id_dono);
    public function listMovimentoCashbackSaldoCC($id_usuario, $id_usuario_dono, $idSaldo);
    public function sumMovimentoCashbackSaldoCC($id_usuario, $id_usuario_dono, $idSaldo);
    public function insertMovimentoCC($movcc);
    public function loadMaxId_CashbackSaldoCCDiasAtras($id_usuario, $id_dono, $numdias);
    public function listMovimentoCashbackCCDesdeIdSaldo($idSaldoUsuarioDonoCC, $id_usuario, $id_dono);


    // Assinaturas geradas pelo gerador
    public function updateStatus($id, $status);
    public function listCampanhaCashbackCCStatus($status);
    public function countCampanhaCashbackCCPorStatus($status);
    public function listCampanhaCashbackCCPorStatus($status, $pag, $qtde, $coluna, $ordem);
    public function countCampanhaCashbackCCPorUsuaIdStatus($usuaid, $status);
    public function listCampanhaCashbackCCPorUsuaIdStatus($usuaid, $status, $pag, $qtde, $coluna, $ordem);

    public function loadId_Cashback($id_cashback);
    public function loadId_Campanha($id_campanha);
    public function loadId_Usuario($id_usuario);
    public function loadId_Cfdi($id_cfdi);
    public function loadDescricao($descricao);
    public function loadVlminimo($vlMinimo);
    public function loadPercentual($percentual);
    public function loadVlconsumo($vlConsumo);
    public function loadVlcalcrecompensa($vlCalcRecompensa);
    public function loadTipomovimento($tipoMovimento);
    public function loadNfe($nfe);
    public function loadNfehash($nfehash);

    public function updateId_Cashback($id, $id_cashback);
    public function updateId_Campanha($id, $id_campanha);
    public function updateId_Usuario($id, $id_usuario);
    public function updateId_Cfdi($id, $id_cfdi);
    public function updateDescricao($id, $descricao);
    public function updateVlminimo($id, $vlMinimo);
    public function updatePercentual($id, $percentual);
    public function updateVlconsumo($id, $vlConsumo);
    public function updateVlcalcrecompensa($id, $vlCalcRecompensa);
    public function updateTipomovimento($id, $tipoMovimento);
}
?>
