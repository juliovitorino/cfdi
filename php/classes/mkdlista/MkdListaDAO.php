<?php

require_once '../interfaces/DAO.php';

/**
*
* MkdListaDAO - Interface dos métodos de acesso aos dados da tabela MKD_EMAIL_LISTA
* Camada de dados MkdLista - camada responsável SOMENTE pela acesso aos dados do sistema. 
* Não é uma camada visível para outros dispositivos, como as camadas de apresentação e aplicação. 
*
* Changelog:
* 
* @autor Julio Cesar Vitorino
* @since 04/11/2019 09:31:13
*
*/

interface MkdListaDAO extends DAO
{
    public function updateStatus($id, $status);
    public function listMkdListaStatus($status);
    public function countMkdListaPorStatus($status);
    public function listMkdListaPorStatus($status, $pag, $qtde, $coluna, $ordem);
    public function countMkdListaPorUsuaIdStatus($usuaid, $status);
    public function listMkdListaPorUsuaIdStatus($usuaid, $status, $pag, $qtde, $coluna, $ordem);

    public function loadMaxId_Mkd_CampanhaPK($id_mkd_campanha,$status);

    public function loadId_Mkd_Campanha($id_mkd_campanha);
    public function loadNome($nome);
    public function loadEmail($email);
    public function loadPrimeironome($primeiroNome);
    public function loadSobrenome($sobrenome);
    public function loadWhatsapp($whatsapp);
    public function loadHashlead($hashlead);
    public function loadStatus($status);
    public function loadDatacadastro($dataCadastro);
    public function loadDataatualizacao($dataAtualizacao);

    public function updateId_Mkd_Campanha($id, $id_mkd_campanha);
    public function updateNome($id, $nome);
    public function updateEmail($id, $email);
    public function updatePrimeironome($id, $primeiroNome);
    public function updateSobrenome($id, $sobrenome);
    public function updateWhatsapp($id, $whatsapp);
    public function updateHashlead($id, $hashlead);

}
?>

