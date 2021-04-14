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
* CampanhaCashbackCCService - Interfaces dos servicos para Classe de negócio com métodos para apoiar a integridade de informações sobre o conta corrente de cashback do usuário  gerenciado pela plataforma
* Interface de Serviços CampanhaCashbackCC - camada responsável pela lógica de negócios de CampanhaCashbackCC do sistema. 
* Não é uma camada visível para outros dispositivos, como as camadas de apresentação e aplicação. 
*
* Por exemplo: quando estamos prestes a sacar dinheiro em um caixa eletrônico, 
* a condição primordial para isto acontecer é que exista saldo na sua conta. 
* Ou seja, é a camada que contém a lógica de como o sistema trabalha 
* como o negócio transcorre.
*
* Responsabilidades dessa classe
*
* 1) Abrir um contexto transacional com a fábrica de banco de dados
* 2) Abrir uma comunicação com as classes de negócio (Business classes)
* 3) Receber o retorno e decidir sobre o commit() ou rollback()
*
* Changelog:
*
*
* 
* @autor Julio Cesar Vitorino
* @since 26/08/2019 16:09:29
*
*/

// importar dependências

require_once '../interfaces/AppService.php';

interface CampanhaCashbackCCService extends AppService
{

    public function autalizarStatusCampanhaCashbackCC($id, $status);
    public function listarCampanhaCashbackCCPorStatus($status='A', $pag=1, $qtde=0, $coluna=1, $ordem=0);
    public function listarCampanhaCashbackCCPorUsuaIdStatus($usuaid, $status='A', $pag=1, $qtde=0, $coluna=1, $ordem=0);
    //public function listarExtratoCampanhaCashbackCCPorUsuaIdStatus($usuaid, $iddono, $status='A', $pag=1, $qtde=0, $coluna=1, $ordem=0);
    public function cancelar($dto);

    public function getSaldoCashbackCC($id_usuario);
    public function getSaldoCashbackCCPeloDono($id_usuario, $id_dono);
    public function registrarSaldoCashbackCC($id_usuario);
    public function listarMovimentoCashbackCC($id_usuario, $id_dono, $numdias=7);
    public function lancarMovimentoCashbackCC($id_usuario, $id_dono, $vllancar, $descricao, $tipolancar='C');
    public function ResgatarTotalCashbackCC($id_usuario, $id_dono, $vllancar, $descricao, $tipolancar='D');
    public function CreditarCashbackCC($id_usuario, $id_dono, $vllancar, $descricao);
    public function TransferirCashbackCC($id_usuario, $id_dono, $vllancar, $descricao);
    public function liquidarCashbackCC($id_usuario, $id_dono, $vllancar, $descricao);
    public function transferirEntreMembroCashbackCC($id_usuario, $id_destino, $id_dono, $vllancar, $descricao);

    public function pesquisarPorId_Cashback($id_cashback);
    public function pesquisarPorId_Campanha($id_campanha);
    public function pesquisarPorId_Usuario($id_usuario);
    public function pesquisarPorId_Cfdi($id_cfdi);
    public function pesquisarPorDescricao($descricao);
    public function pesquisarPorVlminimo($vlMinimo);
    public function pesquisarPorPercentual($percentual);
    public function pesquisarPorVlconsumo($vlConsumo);
    public function pesquisarPorVlcalcrecompensa($vlCalcRecompensa);
    public function pesquisarPorTipomovimento($tipoMovimento);
    public function pesquisarPorNfe($nfe);
    public function pesquisarPorNfehash($nfehash);

    public function atualizarId_CashbackPorPK($id_cashback,$id);
    public function atualizarId_CampanhaPorPK($id_campanha,$id);
    public function atualizarId_UsuarioPorPK($id_usuario,$id);
    public function atualizarId_CfdiPorPK($id_cfdi,$id);
    public function atualizarDescricaoPorPK($descricao,$id);
    public function atualizarVlminimoPorPK($vlMinimo,$id);
    public function atualizarPercentualPorPK($percentual,$id);
    public function atualizarVlconsumoPorPK($vlConsumo,$id);
    public function atualizarVlcalcrecompensaPorPK($vlCalcRecompensa,$id);
    public function atualizarTipomovimentoPorPK($tipoMovimento,$id);

}


?>
