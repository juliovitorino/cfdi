<?php

/**
*
* CampanhaCashbackResgatePixBusiness - Interface dos métodos de negócio para classe CampanhaCashbackResgatePix
* Camada de negócio CampanhaCashbackResgatePix - camada responsável pela lógica de negócios de CampanhaCashbackResgatePix do sistema. 
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
* @since 26/07/2021 15:11:48
*
*/


// importar dependências
require_once '../interfaces/BusinessObject.php';

interface CampanhaCashbackResgatePixBusiness extends BusinessObject
{
    public function solicitarResgatePIX($daofactory, $dto);
    public function atualizarStatus($daofactory, $id, $status);
    public function listarCampanhaCashbackResgatePixPorStatus($daofactory, $status, $pag, $qtde, $coluna, $ordem);
    public function validarTamanhoCampo($campo, $tamanho, $coment);
    public function listarCampanhaCashbackResgatePixPorUsuaIdStatus($daofactory, $usuaid, $status, $pag, $qtde, $coluna, $ordem);
    public function listarCampanhaCashbackResgatePixPorUsuaIdUsuaIdDevedorStatus($daofactory, $usuaid, $usuaidDevedor, $status, $pag, $qtde, $coluna, $ordem);

    public function pesquisarMaxPKPorStatus($daofactory, $idUsuarioSolicitante, $idUsuarioDevedor, $status);
    public function pesquisarPorIdUsuarioDevedor($daofactory, $idUsuarioDevedor);
    public function pesquisarPorIdusuariosolicitante($daofactory, $idUsuarioSolicitante);
    public function pesquisarPorTipochavepix($daofactory, $tipoChavePix);
    public function pesquisarPorChavepix($daofactory, $chavePix);
    public function pesquisarPorValorresgate($daofactory, $valorResgate);
    public function pesquisarPorAutenticacaobco($daofactory, $autenticacaoBco);
    public function pesquisarPorEstagiorealtime($daofactory, $estagioRealTime);
    public function pesquisarPorDtestagioanalise($daofactory, $dtEstagioAnalise);
    public function pesquisarPorDtestagiofinanceiro($daofactory, $dtEstagioFinanceiro);
    public function pesquisarPorDtestagioerro($daofactory, $dtEstagioErro);
    public function pesquisarPorDtestagiotranfbco($daofactory, $dtEstagioTranfBco);
    public function pesquisarPorTxtlivreestagiort($daofactory, $txtLivreEstagioRT);
    //public function pesquisarPorStatus($daofactory, $status);

    public function atualizarIdUsuarioDevedorPorPK($daofactory,$idUsuarioDevedor,$id);
    public function atualizarIdusuariosolicitantePorPK($daofactory,$idUsuarioSolicitante,$id);
    public function atualizarTipochavepixPorPK($daofactory,$tipoChavePix,$id);
    public function atualizarChavepixPorPK($daofactory,$chavePix,$id);
    public function atualizarValorresgatePorPK($daofactory,$valorResgate,$id);
    public function atualizarAutenticacaobcoPorPK($daofactory,$autenticacaoBco,$id);
    public function atualizarEstagiorealtimePorPK($daofactory,$estagioRealTime,$id);
    public function atualizarDtestagioanalisePorPK($daofactory,$dtEstagioAnalise,$id);
    public function atualizarDtestagiofinanceiroPorPK($daofactory,$dtEstagioFinanceiro,$id);
    public function atualizarDtestagioerroPorPK($daofactory,$dtEstagioErro,$id);
    public function atualizarDtestagiotranfbcoPorPK($daofactory,$dtEstagioTranfBco,$id);
    public function atualizarTxtlivreestagiortPorPK($daofactory,$txtLivreEstagioRT,$id);
    //public function atualizarStatusPorPK($daofactory,$status,$id);

}

?>




