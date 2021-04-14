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
CÓDIGO SOFREU ALTERAÇÕES PROFUNDAS, NÃO USE O GERADOR
AUTOMÁTICO PARA SUBSTITUIR O CÓDIGO AQUI EXISTENTE.
TODO O SISTEMA PODE ENTRAR EM COLAPSO.
===========================================================
***********************************************************/ 

/**
*
* CampanhaTopDezDAO - Interface dos métodos de acesso aos dados da tabela CAMPANHA_TOPDEZ
* Camada de dados CampanhaTopDez - camada responsável SOMENTE pela acesso aos dados do sistema. 
* Não é uma camada visível para outros dispositivos, como as camadas de apresentação e aplicação. 
*
* Changelog:
* 
* @autor Julio Cesar Vitorino
* @since 19/09/2019 08:36:54
*
*/

interface CampanhaTopDezDAO extends DAO
{
    public function updateStatus($id, $status);
    public function listCampanhaTopDezStatus($status);
    public function countCampanhaTopDezPorStatus($status);
    public function listCampanhaTopDezPorStatus($status, $pag, $qtde, $coluna, $ordem);
    public function countCampanhaTopDezPorUsuaIdStatus($usuaid, $status);
    public function listCampanhaTopDezPorUsuaIdStatus($usuaid, $status, $pag, $qtde, $coluna, $ordem);
    public function loadMaxPKAtivoCampIdUsuaIdPorStatus($usuaid, $camp_id,$status);

    public function loadMaxId_CampanhaPK($id_campanha,$status);
    public function updateIncQtdeParticipacao($id);

    public function loadId_Campanha($id_campanha);
    public function loadId_Usuario($id_usuario);
    public function loadQtde($qtde);
    public function loadStatus($status);
    public function loadDatacadastro($dataCadastro);
    public function loadDataatualizacao($dataAtualizacao);

    public function updateId_Campanha($id, $id_campanha);
    public function updateId_Usuario($id, $id_usuario);
    public function updateQtde($id, $qtde);

}
?>
