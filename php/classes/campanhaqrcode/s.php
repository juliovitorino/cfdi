<?php
/**
*
* CampanhaQrCodeService - Interfaces dos servicos para Classe de negócio com métodos para apoiar a integridade de informações sobre codigos QRCode gerenciado pela plataforma
* Interface de Serviços CampanhaQrCode - camada responsável pela lógica de negócios de CampanhaQrCode do sistema. 
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
* @since 17/09/2021 11:11:34
*
*/

// importar dependências

require_once '../interfaces/AppService.php';

interface CampanhaQrCodeService extends AppService
{

    public function autalizarStatusCampanhaQrCode($id, $status);
    public function listarCampanhaQrCodePorStatus($status='A', $pag=1, $qtde=0, $coluna=1, $ordem=0);
    public function listarCampanhaQrCodePorUsuaIdStatus($usuaid, $status='A', $pag=1, $qtde=0, $coluna=1, $ordem=0);
    public function cancelar($dto);
    public function pesquisarMaxPKAtivoParentPorStatus($parent,$status);

    public function pesquisarPorParent($parent);
    public function pesquisarPorId_Campanha($id_campanha);
    public function pesquisarPorQrcodecarimbo($qrcodecarimbo);
    public function pesquisarPorOrder($order);
    public function pesquisarPorTicket($ticket);
    public function pesquisarPorIdusuariogerador($idusuarioGerador);

    public function atualizarParentPorPK($parent,$id);
    public function atualizarId_CampanhaPorPK($id_campanha,$id);
    public function atualizarQrcodecarimboPorPK($qrcodecarimbo,$id);
    public function atualizarOrderPorPK($order,$id);
    public function atualizarTicketPorPK($ticket,$id);
    public function atualizarIdusuariogeradorPorPK($idusuarioGerador,$id);

}


?>




