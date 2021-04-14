<?php

require_once '../interfaces/DAO.php';

/**
*
* CampanhaCashbackDAO - Interface dos métodos de acesso aos dados da tabela CAMPANHA_CASHBACK
* Camada de dados CampanhaCashback - camada responsável SOMENTE pela acesso aos dados do sistema. 
* Não é uma camada visível para outros dispositivos, como as camadas de apresentação e aplicação. 
*
* Changelog:
* 
* @autor Julio Cesar Vitorino
* @since 26/08/2019 15:49:37
*
*/

interface CampanhaCashbackDAO extends DAO
{
    public function updateStatus($id, $status);
    public function listCampanhaCashbackStatus($status);
    public function countCampanhaCashbackPorStatus($status);
    public function listCampanhaCashbackPorStatus($status, $pag, $qtde, $coluna, $ordem);
    public function countCampanhaCashbackPorUsuaIdStatus($usuaid, $status);
    public function listCampanhaCashbackPorUsuaIdStatus($usuaid, $status, $pag, $qtde, $coluna, $ordem);
    public function loadId_CampanhaStatus($id_campanha, $status);
    public function loadMaxId_UsuarioIdCampanhaPK($id_usuario, $id_campanha, $status);    
    
    public function loadId_Campanha($id_campanha);
    public function loadPercentual($percentual);
    public function loadDatatermino($dataTermino);
    public function loadObs($obs);
    public function loadStatus($status);
    public function loadDatacadastro($dataCadastro);
    public function loadDataatualizacao($dataAtualizacao);

    public function updateId_Campanha($id, $id_campanha);
    public function updatePercentual($id, $percentual);
    public function updateDatatermino($id, $dataTermino);
    public function updateObs($id, $obs);
}
?>

