<?php
/**
*
* CampanhaSorteioService - Interfaces dos servicos para Classe de negócio com métodos para apoiar a integridade de informações sobre sorteios em campanhas gerenciado pela plataforma
* Interface de Serviços CampanhaSorteio - camada responsável pela lógica de negócios de CampanhaSorteio do sistema. 
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
* @since 16/06/2021 12:57:19
*
*/

// importar dependências

require_once '../interfaces/AppService.php';

interface CampanhaSorteioService extends AppService
{

    public function autalizarStatusCampanhaSorteio($id, $status);
    public function listarCampanhaSorteioPorStatus($status='A', $pag=1, $qtde=0, $coluna=1, $ordem=0);
    public function listarCampanhaSorteioPorUsuaIdStatus($usuaid, $status='A', $pag=1, $qtde=0, $coluna=1, $ordem=0);
    public function cancelar($dto);

    public function pesquisarMaxPKAtivoId_CampanhaPorStatus($id_campanha,$status);
    public function pesquisarPorId_Campanha($id_campanha);
    public function pesquisarPorNome($nome);
    public function pesquisarPorUrlregulamento($urlRegulamento);
    public function pesquisarPorPremio($premio);
    public function pesquisarPorDatacomecosorteio($dataComecoSorteio);
    public function pesquisarPorDatafimsorteio($dataFimSorteio);
    public function pesquisarPorMaxtickets($maxTickets);
    //public function pesquisarPorStatus($status);

    public function atualizarId_CampanhaPorPK($id_campanha,$id);
    public function atualizarNomePorPK($nome,$id);
    public function atualizarUrlregulamentoPorPK($urlRegulamento,$id);
    public function atualizarPremioPorPK($premio,$id);
    public function atualizarDatacomecosorteioPorPK($dataComecoSorteio,$id);
    public function atualizarDatafimsorteioPorPK($dataFimSorteio,$id);
    public function atualizarMaxticketsPorPK($maxTickets,$id);
    //public function atualizarStatusPorPK($status,$id);

}

?>

