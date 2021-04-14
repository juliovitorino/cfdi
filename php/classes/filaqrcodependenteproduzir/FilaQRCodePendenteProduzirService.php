<?php
/**
*
* FilaQRCodePendenteProduzirService - Interfaces dos servicos para Classe de negócio com métodos para apoiar a integridade de informações sobre QRCodes Pendentes de Produzir gerenciado pela plataforma
* Interface de Serviços FilaQRCodePendenteProduzir - camada responsável pela lógica de negócios de FilaQRCodePendenteProduzir do sistema. 
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
* @since 26/10/2019 10:27:47
*
*/

// importar dependências

require_once '../interfaces/AppService.php';

interface FilaQRCodePendenteProduzirService extends AppService
{

    public function autalizarStatusFilaQRCodePendenteProduzir($id, $status);
    public function listarFilaQRCodePendenteProduzirPorStatus($status='A', $pag=1, $qtde=0, $coluna=1, $ordem=0);
    public function listarFilaQRCodePendenteProduzirPorUsuaIdStatus($usuaid, $status='A', $pag=1, $qtde=0, $coluna=1, $ordem=0);
    public function cancelar($dto);
    public function pesquisarMaxPKAtivoId_CampanhaPorStatus($id_campanha,$status);

    public function pesquisarPorId_Campanha($id_campanha);
    public function pesquisarPorId_Usuario($id_usuario);
    public function pesquisarPorQtde($qtde);

    public function atualizarId_CampanhaPorPK($id_campanha,$id);
    public function atualizarId_UsuarioPorPK($id_usuario,$id);
    public function atualizarQtdePorPK($qtde,$id);

}

?>
