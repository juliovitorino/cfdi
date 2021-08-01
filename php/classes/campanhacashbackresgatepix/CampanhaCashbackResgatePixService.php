<?php
/**
*
* CampanhaCashbackResgatePixService - Interfaces dos servicos para Classe de negócio com métodos para apoiar a integridade de informações sobre a movimentação de resgate via PIX gerenciado pela plataforma
* Interface de Serviços CampanhaCashbackResgatePix - camada responsável pela lógica de negócios de CampanhaCashbackResgatePix do sistema. 
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
* @since 26/07/2021 15:11:48
*
*/

// importar dependências

require_once '../interfaces/AppService.php';

interface CampanhaCashbackResgatePixService extends AppService
{

    public function autalizarStatusCampanhaCashbackResgatePix($id, $status);
    public function listarCampanhaCashbackResgatePixPorStatus($status='A', $pag=1, $qtde=0, $coluna=1, $ordem=0);
    public function listarCampanhaCashbackResgatePixPorUsuaIdStatus($usuaid, $status='A', $pag=1, $qtde=0, $coluna=1, $ordem=0);
    public function listarCampanhaCashbackResgatePixPorUsuaIdUsuaIdDevedorStatus($usuaid, $usuaidDevedor, $status='A', $pag=1, $qtde=0, $coluna=1, $ordem=0);
    public function cancelar($dto);
    public function pesquisarMaxPKAtivoIdUsuarioDevedorPorStatus($idUsuarioDevedor,$status);

    public function pesquisarPorIdUsuarioDevedor($idUsuarioDevedor);
    public function pesquisarPorIdusuariosolicitante($idUsuarioSolicitante);
    public function pesquisarPorTipochavepix($tipoChavePix);
    public function pesquisarPorChavepix($chavePix);
    public function pesquisarPorValorresgate($valorResgate);
    public function pesquisarPorAutenticacaobco($autenticacaoBco);
    public function pesquisarPorEstagiorealtime($estagioRealTime);
    public function pesquisarPorDtestagioanalise($dtEstagioAnalise);
    public function pesquisarPorDtestagiofinanceiro($dtEstagioFinanceiro);
    public function pesquisarPorDtestagioerro($dtEstagioErro);
    public function pesquisarPorDtestagiotranfbco($dtEstagioTranfBco);
    public function pesquisarPorTxtlivreestagiort($txtLivreEstagioRT);
    //public function pesquisarPorStatus($status);

    public function atualizarIdUsuarioDevedorPorPK($idUsuarioDevedor,$id);
    public function atualizarIdusuariosolicitantePorPK($idUsuarioSolicitante,$id);
    public function atualizarTipochavepixPorPK($tipoChavePix,$id);
    public function atualizarChavepixPorPK($chavePix,$id);
    public function atualizarValorresgatePorPK($valorResgate,$id);
    public function atualizarAutenticacaobcoPorPK($autenticacaoBco,$id);
    public function atualizarEstagiorealtimePorPK($estagioRealTime,$id);
    public function atualizarDtestagioanalisePorPK($dtEstagioAnalise,$id);
    public function atualizarDtestagiofinanceiroPorPK($dtEstagioFinanceiro,$id);
    public function atualizarDtestagioerroPorPK($dtEstagioErro,$id);
    public function atualizarDtestagiotranfbcoPorPK($dtEstagioTranfBco,$id);
    public function atualizarTxtlivreestagiortPorPK($txtLivreEstagioRT,$id);
    //public function atualizarStatusPorPK($status,$id);

}


?>
