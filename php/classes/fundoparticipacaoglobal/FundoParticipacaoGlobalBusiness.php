<?php

/**
*
* FundoParticipacaoGlobalBusiness - Interface dos métodos de negócio para classe FundoParticipacaoGlobal
* Camada de negócio FundoParticipacaoGlobal - camada responsável pela lógica de negócios de FundoParticipacaoGlobal do sistema. 
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
* @since 18/08/2021 12:15:16
*
*/


// importar dependências
require_once '../interfaces/BusinessObject.php';

interface FundoParticipacaoGlobalBusiness extends BusinessObject
{
    public function atualizarStatus($daofactory, $id, $status);
    public function listarFundoParticipacaoGlobalPorStatus($daofactory, $status, $pag, $qtde, $coluna, $ordem);
    public function validarTamanhoCampo($campo, $tamanho, $coment);
    public function listarFundoParticipacaoGlobalPorUsuaIdStatus($daofactory, $usuaid, $status, $pag, $qtde, $coluna, $ordem);

    public function pesquisarMaxPKAtivoIdusuarioparticipantePorStatus($daofactory, $idUsuarioParticipante, $status);

    public function pesquisarPorIdusuarioparticipante($daofactory, $idUsuarioParticipante);
    public function pesquisarPorIdusuariobonificado($daofactory, $idUsuarioBonificado);
    public function pesquisarPorIdplanofatura($daofactory, $idPlanoFatura);
    public function pesquisarPorTipomovimento($daofactory, $tipoMovimento);
    public function pesquisarPorValortransacao($daofactory, $valorTransacao);
    public function pesquisarPorDescricao($daofactory, $descricao);
//    public function pesquisarPorStatus($daofactory, $status);

    public function atualizarIdusuarioparticipantePorPK($daofactory,$idUsuarioParticipante,$id);
    public function atualizarIdusuariobonificadoPorPK($daofactory,$idUsuarioBonificado,$id);
    public function atualizarIdplanofaturaPorPK($daofactory,$idPlanoFatura,$id);
    public function atualizarTipomovimentoPorPK($daofactory,$tipoMovimento,$id);
    public function atualizarValortransacaoPorPK($daofactory,$valorTransacao,$id);
    public function atualizarDescricaoPorPK($daofactory,$descricao,$id);
//    public function atualizarStatusPorPK($daofactory,$status,$id);

}

?>




