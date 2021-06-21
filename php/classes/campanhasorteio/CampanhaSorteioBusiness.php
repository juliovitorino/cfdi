<?php

/**
*
* CampanhaSorteioBusiness - Interface dos métodos de negócio para classe CampanhaSorteio
* Camada de negócio CampanhaSorteio - camada responsável pela lógica de negócios de CampanhaSorteio do sistema. 
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
* @since 16/06/2021 12:57:19
*
*/


// importar dependências
require_once '../interfaces/BusinessObject.php';

interface CampanhaSorteioBusiness extends BusinessObject
{
    public function ativarCampanhaSorteio($daofactory, $id);
    public function usarCampanhaSorteio($daofactory, $id);
    public function pausarCampanhaSorteio($daofactory, $id);
    public function desativarCampanhaSorteio($daofactory, $id);


    public function atualizarStatus($daofactory, $id, $status);
    public function listarCampanhaSorteioPorStatus($daofactory, $status, $pag, $qtde, $coluna, $ordem);
    public function validarTamanhoCampo($campo, $tamanho, $coment);
    public function listarCampanhaSorteioPorUsuaIdStatus($daofactory, $usuaid, $status, $pag, $qtde, $coluna, $ordem);
    public function listarCampanhaSorteioPorCampIdStatus($daofactory, $campid, $status, $pag, $qtde, $coluna, $ordem);
    public function listarCampanhaSorteioPorCampId($daofactory, $campid, $pag, $qtde, $coluna, $ordem);
    public function criarSorteio($daofactory, $dto);
    public function pesquisarMaxPKAtivoId_CampanhaPorStatus($daofactory, $id_campanha, $status);


    public function pesquisarPorId_Campanha($daofactory, $id_campanha);
    public function pesquisarPorNome($daofactory, $nome);
    public function pesquisarPorUrlregulamento($daofactory, $urlRegulamento);
    public function pesquisarPorPremio($daofactory, $premio);
    public function pesquisarPorDatacomecosorteio($daofactory, $dataComecoSorteio);
    public function pesquisarPorDatafimsorteio($daofactory, $dataFimSorteio);
    public function pesquisarPorMaxtickets($daofactory, $maxTickets);
    //public function pesquisarPorStatus($daofactory, $status);
    public function atualizarId_CampanhaPorPK($daofactory,$id_campanha,$id);
    public function atualizarNomePorPK($daofactory,$nome,$id);
    public function atualizarUrlregulamentoPorPK($daofactory,$urlRegulamento,$id);
    public function atualizarPremioPorPK($daofactory,$premio,$id);
    public function atualizarDatacomecosorteioPorPK($daofactory,$dataComecoSorteio,$id);
    public function atualizarDatafimsorteioPorPK($daofactory,$dataFimSorteio,$id);
    public function atualizarMaxticketsPorPK($daofactory,$maxTickets,$id);
    //public function atualizarStatusPorPK($daofactory,$status,$id);

}

?>




