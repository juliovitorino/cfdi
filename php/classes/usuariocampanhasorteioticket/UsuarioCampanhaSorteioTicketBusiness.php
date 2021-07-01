<?php

/**
*
* UsuarioCampanhaSorteioTicketBusiness - Interface dos métodos de negócio para classe UsuarioCampanhaSorteioTicket
* Camada de negócio UsuarioCampanhaSorteioTicket - camada responsável pela lógica de negócios de UsuarioCampanhaSorteioTicket do sistema. 
* Não é uma camada visível para outros dispositivos, como as camadas de apresentação e aplicação. 
*
*
* Responsabilidades dessa classe
*
* 1) Receber o pedido de uma classe de negócio do sistema
* 2) Produzir a regra de negócio de acordo com cada método
* 3) Acessar o banco de dados através das interfaces DAOs
* 4) Verificar o resultado e retornar um objeto e uma mensagem de alto nível para a camada de serviço
*
* Changelog:
*
* 
* @autor Julio Cesar Vitorino
* @since 22/06/2021 10:37:39
*
*/


// importar dependências
require_once '../interfaces/BusinessObject.php';

interface UsuarioCampanhaSorteioTicketBusiness extends BusinessObject
{
    public function atualizarStatus($daofactory, $id, $status);
    public function listarUsuarioCampanhaSorteioTicketPorStatus($daofactory, $status, $pag, $qtde, $coluna, $ordem);
    public function validarTamanhoCampo($campo, $tamanho, $coment);
    public function listarUsuarioCampanhaSorteioTicketPorUsuaIdStatus($daofactory, $usuaid, $status, $pag, $qtde, $coluna, $ordem);
    public function listarUsuarioCampanhaSorteioTicketPorUscsIdStatus($daofactory, $uscsid, $status, $pag, $qtde, $coluna, $ordem);

    public function pesquisarMaxPKAtivoIduscsPorStatus($daofactory, $iduscs, $status);

    public function pesquisarPorIduscs($daofactory, $iduscs);
    public function pesquisarPorTicket($daofactory, $ticket);
//    public function pesquisarPorStatus($daofactory, $status);

    public function atualizarIduscsPorPK($daofactory,$iduscs,$id);
    public function atualizarTicketPorPK($daofactory,$ticket,$id);
//    public function atualizarStatusPorPK($daofactory,$status,$id);

}

?>




