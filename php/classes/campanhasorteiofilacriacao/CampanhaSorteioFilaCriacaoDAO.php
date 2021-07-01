


<?php

require_once '../interfaces/DAO.php';

/**
*
* CampanhaSorteioFilaCriacaoDAO - Interface dos métodos de acesso aos dados da tabela CAMPANHA_SORTEIO_FILA_CRIACAO
* Camada de dados CampanhaSorteioFilaCriacao - camada responsável SOMENTE pela acesso aos dados do sistema. 
* Não é uma camada visível para outros dispositivos, como as camadas de apresentação e aplicação. 
*
* Changelog:
* 
* @autor Julio Cesar Vitorino
* @since 17/06/2021 08:10:22
*
*/

interface CampanhaSorteioFilaCriacaoDAO extends DAO
{
    public function updateStatus($id, $status);
    public function listCampanhaSorteioFilaCriacaoStatus($status);
    public function countCampanhaSorteioFilaCriacaoPorStatus($status);
    public function listCampanhaSorteioFilaCriacaoPorStatus($status, $pag, $qtde, $coluna, $ordem);
    public function countCampanhaSorteioFilaCriacaoPorUsuaIdStatus($usuaid, $status);
    public function listCampanhaSorteioFilaCriacaoPorUsuaIdStatus($usuaid, $status, $pag, $qtde, $coluna, $ordem);

    public function loadMaxId_CasoPK($id_caso,$status);

    public function loadId_Caso($id_caso);
    public function loadQtloteticketcriar($qtLoteTicketCriar);
    public function loadStatus($status);
    public function loadDatacadastro($dataCadastro);
    public function loadDataatualizacao($dataAtualizacao);

    public function updateId_Caso($id, $id_caso);
    public function updateQtloteticketcriar($id, $qtLoteTicketCriar);
    //public function updateStatus($id, $status);

}
?>
