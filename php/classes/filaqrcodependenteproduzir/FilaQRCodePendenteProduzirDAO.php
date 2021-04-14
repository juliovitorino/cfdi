<?php

require_once '../interfaces/DAO.php';

/**
*
* FilaQRCodePendenteProduzirDAO - Interface dos métodos de acesso aos dados da tabela FILA_QRCODES_PNDNT_PRD
* Camada de dados FilaQRCodePendenteProduzir - camada responsável SOMENTE pela acesso aos dados do sistema. 
* Não é uma camada visível para outros dispositivos, como as camadas de apresentação e aplicação. 
*
* Changelog:
* 
* @autor Julio Cesar Vitorino
* @since 26/10/2019 10:27:47
*
*/

interface FilaQRCodePendenteProduzirDAO extends DAO
{
    public function updateStatus($id, $status);
    public function listFilaQRCodePendenteProduzirStatus($status);
    public function countFilaQRCodePendenteProduzirPorStatus($status);
    public function listFilaQRCodePendenteProduzirPorStatus($status, $pag, $qtde, $coluna, $ordem);
    public function countFilaQRCodePendenteProduzirPorUsuaIdStatus($usuaid, $status);
    public function listFilaQRCodePendenteProduzirPorUsuaIdStatus($usuaid, $status, $pag, $qtde, $coluna, $ordem);

    public function loadMaxId_CampanhaPK($id_campanha,$status);

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
