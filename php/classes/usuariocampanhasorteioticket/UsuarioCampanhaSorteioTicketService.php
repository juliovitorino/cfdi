<?php
/**
*
* UsuarioCampanhaSorteioTicketService - Interfaces dos servicos para Classe de negócio com métodos para apoiar a integridade de informações sobre tickets de usuários em campanhas sorteio gerenciado pela plataforma
* Interface de Serviços UsuarioCampanhaSorteioTicket - camada responsável pela lógica de negócios de UsuarioCampanhaSorteioTicket do sistema. 
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
* @since 22/06/2021 10:37:39
*
*/

// importar dependências

require_once '../interfaces/AppService.php';

interface UsuarioCampanhaSorteioTicketService extends AppService
{

    public function autalizarStatusUsuarioCampanhaSorteioTicket($id, $status);
    public function listarUsuarioCampanhaSorteioTicketPorStatus($status='A', $pag=1, $qtde=0, $coluna=1, $ordem=0);
    public function listarUsuarioCampanhaSorteioTicketPorUsuaIdStatus($usuaid, $status='A', $pag=1, $qtde=0, $coluna=1, $ordem=0);
    public function cancelar($dto);
    public function pesquisarMaxPKAtivoIduscsPorStatus($iduscs,$status);

    public function pesquisarPorIduscs($iduscs);
    public function pesquisarPorTicket($ticket);
    //public function pesquisarPorStatus($status);

    public function atualizarIduscsPorPK($iduscs,$id);
    public function atualizarTicketPorPK($ticket,$id);
    //public function atualizarStatusPorPK($status,$id);

}


?>
