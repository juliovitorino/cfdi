<?php

/**
*
* CampanhaQrCodeBusiness - Interface dos métodos de negócio para classe CampanhaQrCode
* Camada de negócio CampanhaQrCode - camada responsável pela lógica de negócios de CampanhaQrCode do sistema. 
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
* @since 17/09/2021 11:11:34
*
*/


// importar dependências
require_once '../interfaces/BusinessObject.php';

interface CampanhaQrCodeBusiness extends BusinessObject
{
    public function atualizarStatus($daofactory, $id, $status);
    public function listarCampanhaQrCodePorStatus($daofactory, $status,  $pag=1, $qtde=0, $coluna=1, $ordem=0);
    public function validarTamanhoCampo($campo, $tamanho, $coment);
    public function listarCampanhaQrCodePorUsuaIdStatus($daofactory, $usuaid, $status,  $pag=1, $qtde=0, $coluna=1, $ordem=0);
    public function inserirCampanhaQrCode($daofactory, $dto);
    public function pesquisarMaxPKAtivoParentPorStatus($daofactory, $parent, $status);

    public function contarIdPorStatus($daofactory, $id, $status);
    public function contarParentPorStatus($daofactory, $parent, $status);
    public function contarId_CampanhaPorStatus($daofactory, $id_campanha, $status);
    public function contarQrcodecarimboPorStatus($daofactory, $qrcodecarimbo, $status);
    public function contarOrderPorStatus($daofactory, $order, $status);
    public function contarTicketPorStatus($daofactory, $ticket, $status);
    public function contarIdusuariogeradorPorStatus($daofactory, $idusuarioGerador, $status);

    public function pesquisarPorParent($daofactory, $parent);
    public function pesquisarPorId_Campanha($daofactory, $id_campanha);
    public function pesquisarPorQrcodecarimbo($daofactory, $qrcodecarimbo);
    public function pesquisarPorOrder($daofactory, $order);
    public function pesquisarPorTicket($daofactory, $ticket);
    public function pesquisarPorIdusuariogerador($daofactory, $idusuarioGerador);

    public function atualizarParentPorPK($daofactory,$parent,$id);
    public function atualizarId_CampanhaPorPK($daofactory,$id_campanha,$id);
    public function atualizarQrcodecarimboPorPK($daofactory,$qrcodecarimbo,$id);
    public function atualizarOrderPorPK($daofactory,$order,$id);
    public function atualizarTicketPorPK($daofactory,$ticket,$id);
    public function atualizarIdusuariogeradorPorPK($daofactory,$idusuarioGerador,$id);

}

?>




