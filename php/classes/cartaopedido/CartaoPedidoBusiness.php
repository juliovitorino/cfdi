<?php

/**
*
* CartaoPedidoBusiness - Interface dos métodos de negócio para classe CartaoPedido
* Camada de negócio CartaoPedido - camada responsável pela lógica de negócios de CartaoPedido do sistema. 
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
* @since 17/09/2019 14:08:07
*
*/


// importar dependências
require_once '../interfaces/BusinessObject.php';

interface CartaoPedidoBusiness extends BusinessObject
{
    public function atualizarStatus($daofactory, $id, $status);
    public function listarCartaoPedidoPorStatus($daofactory, $status, $pag, $qtde, $coluna, $ordem);
    public function validarTamanhoCampo($campo, $tamanho, $coment);
    public function listarCartaoPedidoPorUsuaIdStatus($daofactory, $usuaid, $status, $pag, $qtde, $coluna, $ordem);
    public function cadastrarPedido($daofactory, $idplano, $id_campanha);

    public function PesquisarMaxPKAtivoId_CampanhaPorStatus($daofactory, $id_campanha, $status);

    public function pesquisarPorId_Campanha($daofactory, $id_campanha);
    public function pesquisarPorHashtransacao($daofactory, $hashTransacao);
    public function pesquisarPorQtde($daofactory, $qtde);
    public function pesquisarPorSelos($daofactory, $selos);
    public function pesquisarPorVlrpedido($daofactory, $vlrPedido);
    public function pesquisarPorDataautorizacao($daofactory, $dataAutorizacao);
    public function pesquisarPorDatapgto($daofactory, $dataPgto);
    public function pesquisarPorVlrpgto($daofactory, $vlrPgto);
    public function pesquisarPorHashgtway($daofactory, $hashGtway);

    public function atualizarId_CampanhaPorPK($daofactory,$id_campanha,$id);
    public function atualizarHashtransacaoPorPK($daofactory,$hashTransacao,$id);
    public function atualizarQtdePorPK($daofactory,$qtde,$id);
    public function atualizarSelosPorPK($daofactory,$selos,$id);
    public function atualizarVlrpedidoPorPK($daofactory,$vlrPedido,$id);
    public function atualizarDataautorizacaoPorPK($daofactory,$dataAutorizacao,$id);
    public function atualizarDatapgtoPorPK($daofactory,$dataPgto,$id);
    public function atualizarVlrpgtoPorPK($daofactory,$vlrPgto,$id);
    public function atualizarHashgtwayPorPK($daofactory,$hashGtway,$id);

}

?>
