<?php
/**
*
* CampanhaSorteioNumerosPermitidosService - Interfaces dos servicos para Classe de negócio com métodos para apoiar a integridade de informações sobre numeros de sorteios permitidos gerenciado pela plataforma
* Interface de Serviços CampanhaSorteioNumerosPermitidos - camada responsável pela lógica de negócios de CampanhaSorteioNumerosPermitidos do sistema. 
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
* @since 17/06/2021 17:44:16
*
*/

// importar dependências

require_once '../interfaces/AppService.php';

interface CampanhaSorteioNumerosPermitidosService extends AppService
{

    public function autalizarStatusCampanhaSorteioNumerosPermitidos($id, $status);
    public function listarCampanhaSorteioNumerosPermitidosPorStatus($status='A', $pag=1, $qtde=0, $coluna=1, $ordem=0);
    public function listarCampanhaSorteioNumerosPermitidosPorUsuaIdStatus($usuaid, $status='A', $pag=1, $qtde=0, $coluna=1, $ordem=0);
    public function cancelar($dto);
    public function pesquisarMaxPKAtivoId_CasoPorStatus($id_caso,$status);

    public function pesquisarPorId_Caso($id_caso);
    public function pesquisarPorNrticketsorteio($nrTicketSorteio);
    //public function pesquisarPorStatus($status);

    public function atualizarId_CasoPorPK($id_caso,$id);
    public function atualizarNrticketsorteioPorPK($nrTicketSorteio,$id);
    //public function atualizarStatusPorPK($status,$id);

}


?>
