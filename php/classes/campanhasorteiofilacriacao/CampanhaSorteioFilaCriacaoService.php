<?php
/**
*
* CampanhaSorteioFilaCriacaoService - Interfaces dos servicos para Classe de negócio com métodos para apoiar a integridade de informações sobre Leads gerenciado pela plataforma
* Interface de Serviços CampanhaSorteioFilaCriacao - camada responsável pela lógica de negócios de CampanhaSorteioFilaCriacao do sistema. 
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
* @since 17/06/2021 08:10:22
*
*/

// importar dependências

require_once '../interfaces/AppService.php';

interface CampanhaSorteioFilaCriacaoService extends AppService
{

    public function autalizarStatusCampanhaSorteioFilaCriacao($id, $status);
    public function listarCampanhaSorteioFilaCriacaoPorStatus($status='A', $pag=1, $qtde=0, $coluna=1, $ordem=0);
    public function listarCampanhaSorteioFilaCriacaoPorUsuaIdStatus($usuaid, $status='A', $pag=1, $qtde=0, $coluna=1, $ordem=0);
    public function cancelar($dto);
    public function pesquisarMaxPKAtivoId_CasoPorStatus($id_caso,$status);

    public function pesquisarPorId_Caso($id_caso);
    public function pesquisarPorQtloteticketcriar($qtLoteTicketCriar);
    //public function pesquisarPorStatus($status);

    public function atualizarId_CasoPorPK($id_caso,$id);
    public function atualizarQtloteticketcriarPorPK($qtLoteTicketCriar,$id);
    //public function atualizarStatusPorPK($status,$id);

}


?>
