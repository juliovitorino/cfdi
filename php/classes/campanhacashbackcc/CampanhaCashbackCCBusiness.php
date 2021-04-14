<?php
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
* CampanhaCashbackCCBusiness - Interface dos métodos de negócio para classe CampanhaCashbackCC
* Camada de negócio CampanhaCashbackCC - camada responsável pela lógica de negócios de CampanhaCashbackCC do sistema. 
* Não é uma camada visível para outros dispositivos, como as camadas de apresentação e aplicação. 
*
*
* Responsabilidades dessa classe
*
* 1) Receber o pedido de uma classe de negócio do sistema
* 2) Produzir a regra de negócio de acordo com cada método
* 3) Acessar o banco de dados através das interfaces DAOs
* 4) Verificar o resultado e retornar um objeto e uma mensagem de alto nível para a camada de serviço
*
* Changelog:
*
* 
* @autor Julio Cesar Vitorino
* @since 26/08/2019 16:09:29
*
*/


// importar dependências
require_once '../interfaces/BusinessObject.php';

interface CampanhaCashbackCCBusiness extends BusinessObject
{
    public function atualizarStatus($daofactory, $id, $status);
    public function listarCampanhaCashbackCCPorStatus($daofactory, $status, $pag, $qtde, $coluna, $ordem);
    public function validarTamanhoCampo($campo, $tamanho, $coment);
    public function listarCampanhaCashbackCCPorUsuaIdStatus($daofactory, $usuaid, $status, $pag, $qtde, $coluna, $ordem);

    public function getSaldoCashbackCC($daofactory, $id_usuario);
    public function getSaldoCashbackCCPeloDono($daofactory, $id_usuario, $id_dono);
    public function registrarSaldoCashbackCC($daofactory,$id_usuario);
    public function listarMovimentoCashbackCC($daofactory, $id_usuario, $id_dono, $numdias=7);
    public function lancarMovimentoCashbackCC($daofactory, $id_usuario, $id_dono, $vllancar, $descricao, $tipolancar='C');
    public function ResgatarTotalCashbackCC($daofactory, $id_usuario, $id_dono, $vllancar, $descricao, $tipolancar='D');
    public function CreditarCashbackCC($daofactory, $id_usuario, $id_dono, $vllancar, $descricao);
    public function TransferirCashbackCC($daofactory, $id_usuario, $id_dono, $vllancar, $descricao);
    public function liquidarCashbackCC($daofactory, $id_usuario, $id_dono, $vllancar, $descricao);
    public function transferirEntreMembroCashbackCC($daofactory, $id_usuario, $id_destino, $id_dono, $vllancar, $descricao);
    
    public function pesquisarPorId_Cashback($daofactory, $id_cashback);
    public function pesquisarPorId_Campanha($daofactory, $id_campanha);
    public function pesquisarPorId_Usuario($daofactory, $id_usuario);
    public function pesquisarPorId_Cfdi($daofactory, $id_cfdi);
    public function pesquisarPorDescricao($daofactory, $descricao);
    public function pesquisarPorVlminimo($daofactory, $vlMinimo);
    public function pesquisarPorPercentual($daofactory, $percentual);
    public function pesquisarPorVlconsumo($daofactory, $vlConsumo);
    public function pesquisarPorVlcalcrecompensa($daofactory, $vlCalcRecompensa);
    public function pesquisarPorTipomovimento($daofactory, $tipoMovimento);
    public function pesquisarPorNfe($daofactory, $nfe);
    public function pesquisarPorNfehash($daofactory, $nfehash);
    

    public function atualizarId_CashbackPorPK($daofactory,$id_cashback,$id);
    public function atualizarId_CampanhaPorPK($daofactory,$id_campanha,$id);
    public function atualizarId_UsuarioPorPK($daofactory,$id_usuario,$id);
    public function atualizarId_CfdiPorPK($daofactory,$id_cfdi,$id);
    public function atualizarDescricaoPorPK($daofactory,$descricao,$id);
    public function atualizarVlminimoPorPK($daofactory,$vlMinimo,$id);
    public function atualizarPercentualPorPK($daofactory,$percentual,$id);
    public function atualizarVlconsumoPorPK($daofactory,$vlConsumo,$id);
    public function atualizarVlcalcrecompensaPorPK($daofactory,$vlCalcRecompensa,$id);
    public function atualizarTipomovimentoPorPK($daofactory,$tipoMovimento,$id);

}

?>
