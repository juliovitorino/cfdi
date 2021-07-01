<?php

require_once '../interfaces/DAO.php';

/**
*
* CampanhaSorteioDAO - Interface dos métodos de acesso aos dados da tabela CAMPANHA_SORTEIO
* Camada de dados CampanhaSorteio - camada responsável SOMENTE pela acesso aos dados do sistema. 
* Não é uma camada visível para outros dispositivos, como as camadas de apresentação e aplicação. 
*
* Changelog:
* 
* @autor Julio Cesar Vitorino
* @since 16/06/2021 12:57:19
*
*/

interface CampanhaSorteioDAO extends DAO
{
    public function updateStatus($id, $status);
    public function listCampanhaSorteioStatus($status);
    public function countCampanhaSorteioPorStatus($status);
    public function listCampanhaSorteioPorStatus($status, $pag, $qtde, $coluna, $ordem);
    public function countCampanhaSorteioPorUsuaIdStatus($usuaid, $status);
    public function countCampanhaSorteioPorCampIdStatus($campid, $status);
    public function countCampanhaSorteioPorCampId($campid);
    public function listCampanhaSorteioPorUsuaIdStatus($usuaid, $status, $pag, $qtde, $coluna, $ordem);
    public function listCampanhaSorteioPorCampIdStatus($campid, $status, $pag, $qtde, $coluna, $ordem);
    public function listCampanhaSorteioPorCampId($campid, $pag, $qtde, $coluna, $ordem);

    public function loadMaxId_CampanhaPK($id_campanha,$status);

    public function loadId_Campanha($id_campanha);
    public function loadNome($nome);
    public function loadUrlregulamento($urlRegulamento);
    public function loadPremio($premio);
    public function loadDatacomecosorteio($dataComecoSorteio);
    public function loadDatafimsorteio($dataFimSorteio);
    public function loadMaxtickets($maxTickets);
    public function loadStatus($status);
    public function loadDatacadastro($dataCadastro);
    public function loadDataatualizacao($dataAtualizacao);

    public function updateId_Campanha($id, $id_campanha);
    public function updateNome($id, $nome);
    public function updateUrlregulamento($id, $urlRegulamento);
    public function updatePremio($id, $premio);
    public function updateDatacomecosorteio($id, $dataComecoSorteio);
    public function updateDatafimsorteio($id, $dataFimSorteio);
    public function updateMaxtickets($id, $maxTickets);
    //public function updateStatus($id, $status);
}
?>
