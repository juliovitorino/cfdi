<?php

require_once '../interfaces/DAO.php';

/**
*
* UsuarioCampanhaSorteioTicketDAO - Interface dos métodos de acesso aos dados da tabela USUARIO_CAMPANHA_SORTEIO_TICKET
* Camada de dados UsuarioCampanhaSorteioTicket - camada responsável SOMENTE pela acesso aos dados do sistema. 
* Não é uma camada visível para outros dispositivos, como as camadas de apresentação e aplicação. 
*
* Changelog:
* 
* @autor Julio Cesar Vitorino
* @since 22/06/2021 10:37:39
*
*/

interface UsuarioCampanhaSorteioTicketDAO extends DAO
{
    public function updateStatus($id, $status);
    public function listUsuarioCampanhaSorteioTicketStatus($status);
    public function countUsuarioCampanhaSorteioTicketPorStatus($status);
    public function listUsuarioCampanhaSorteioTicketPorStatus($status, $pag, $qtde, $coluna, $ordem);
    public function countUsuarioCampanhaSorteioTicketPorUsuaIdStatus($usuaid, $status);
    public function listUsuarioCampanhaSorteioTicketPorUsuaIdStatus($usuaid, $status, $pag, $qtde, $coluna, $ordem);
    public function countUsuarioCampanhaSorteioTicketPorUscsIdStatus($uscsid, $status);
    public function listUsuarioCampanhaSorteioTicketPorUscsIdStatus($uscsid, $status, $pag, $qtde, $coluna, $ordem);

    public function loadMaxIduscsPK($iduscs,$status);

    public function loadIduscs($iduscs);
    public function loadTicket($ticket);
    public function loadStatus($status);
    public function loadDatacadastro($dataCadastro);
    public function loadDataatualizacao($dataAtualizacao);

    public function updateIduscs($id, $iduscs);
    public function updateTicket($id, $ticket);

}
?>
