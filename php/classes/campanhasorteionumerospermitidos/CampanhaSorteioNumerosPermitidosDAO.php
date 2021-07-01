<?php

require_once '../interfaces/DAO.php';

/**
*
* CampanhaSorteioNumerosPermitidosDAO - Interface dos métodos de acesso aos dados da tabela CAMPANHA_SORTEIO_NUMEROS_PERMITIDOS
* Camada de dados CampanhaSorteioNumerosPermitidos - camada responsável SOMENTE pela acesso aos dados do sistema. 
* Não é uma camada visível para outros dispositivos, como as camadas de apresentação e aplicação. 
*
* Changelog:
* 
* @autor Julio Cesar Vitorino
* @since 17/06/2021 17:44:16
*
*/

interface CampanhaSorteioNumerosPermitidosDAO extends DAO
{
    public function updateStatus($id, $status);
    public function listCampanhaSorteioNumerosPermitidosStatus($status);
    public function countCampanhaSorteioNumerosPermitidosPorStatus($status);
    public function listCampanhaSorteioNumerosPermitidosPorStatus($status, $pag, $qtde, $coluna, $ordem);
    public function countCampanhaSorteioNumerosPermitidosPorUsuaIdStatus($usuaid, $status);
    public function listCampanhaSorteioNumerosPermitidosPorUsuaIdStatus($usuaid, $status, $pag, $qtde, $coluna, $ordem);

    public function loadMaxId_CasoPK($id_caso,$status);

    public function loadId_Caso($id_caso);
    public function loadNrticketsorteio($nrTicketSorteio);
    public function loadStatus($status);
    public function loadDatacadastro($dataCadastro);
    public function loadDataatualizacao($dataAtualizacao);
    public function loadPorCasoIdNrTicketStatus($id_caso, $nrticket, $status);    

    public function updateId_Caso($id, $id_caso);
    public function updateNrticketsorteio($id, $nrTicketSorteio);
    //public function updateStatus($id, $status);

}
?>
