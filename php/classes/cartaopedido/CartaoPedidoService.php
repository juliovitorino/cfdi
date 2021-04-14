<?php
/**
*
* CartaoPedidoService - Interfaces dos servicos para Classe de negócio com métodos para apoiar a integridade de informações sobre os pedido de acréscimo de cartões gerenciado pela plataforma
* Interface de Serviços CartaoPedido - camada responsável pela lógica de negócios de CartaoPedido do sistema. 
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
* @since 17/09/2019 14:08:07
*
*/

// importar dependências

require_once '../interfaces/AppService.php';

interface CartaoPedidoService extends AppService
{

    public function autalizarStatusCartaoPedido($id, $status);
    public function listarCartaoPedidoPorStatus($status='A', $pag=1, $qtde=0, $coluna=1, $ordem=0);
    public function listarCartaoPedidoPorUsuaIdStatus($usuaid, $status='A', $pag=1, $qtde=0, $coluna=1, $ordem=0);
    public function cancelar($dto);
    public function PesquisarMaxPKAtivoId_CampanhaPorStatus($id_campanha,$status);
    public function cadastrarPedido($idplano, $dto);

    public function pesquisarPorId_Campanha($id_campanha);
    public function pesquisarPorHashtransacao($hashTransacao);
    public function pesquisarPorQtde($qtde);
    public function pesquisarPorSelos($selos);
    public function pesquisarPorVlrpedido($vlrPedido);
    public function pesquisarPorDataautorizacao($dataAutorizacao);
    public function pesquisarPorDatapgto($dataPgto);
    public function pesquisarPorVlrpgto($vlrPgto);
    public function pesquisarPorHashgtway($hashGtway);

    public function atualizarId_CampanhaPorPK($id_campanha,$id);
    public function atualizarHashtransacaoPorPK($hashTransacao,$id);
    public function atualizarQtdePorPK($qtde,$id);
    public function atualizarSelosPorPK($selos,$id);
    public function atualizarVlrpedidoPorPK($vlrPedido,$id);
    public function atualizarDataautorizacaoPorPK($dataAutorizacao,$id);
    public function atualizarDatapgtoPorPK($dataPgto,$id);
    public function atualizarVlrpgtoPorPK($vlrPgto,$id);
    public function atualizarHashgtwayPorPK($hashGtway,$id);

}


?>

