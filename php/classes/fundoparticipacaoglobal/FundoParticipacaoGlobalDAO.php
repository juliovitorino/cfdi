<?php

require_once '../interfaces/DAO.php';

/**
*
* FundoParticipacaoGlobalDAO - Interface dos métodos de acesso aos dados da tabela FUNDO_PARTICIPACAO_GLOBAL
* Camada de dados FundoParticipacaoGlobal - camada responsável SOMENTE pela acesso aos dados do sistema. 
* Não é uma camada visível para outros dispositivos, como as camadas de apresentação e aplicação. 
*
* Changelog:
* 
* @autor Julio Cesar Vitorino
* @since 18/08/2021 12:15:16
*
*/

interface FundoParticipacaoGlobalDAO extends DAO
{
    public function insertBonificacao($dto);
    public function updateStatus($id, $status);
    public function listFundoParticipacaoGlobalStatus($status);
    public function countFundoParticipacaoGlobalPorStatus($status);
    public function listFundoParticipacaoGlobalPorStatus($status, $pag, $qtde, $coluna, $ordem);
    public function countFundoParticipacaoGlobalPorUsuaIdStatus($usuaid, $status);
    public function listFundoParticipacaoGlobalPorUsuaIdStatus($usuaid, $status, $pag, $qtde, $coluna, $ordem);

    public function loadMaxIdusuarioparticipantePK($idUsuarioParticipante,$status);

    public function loadIdusuarioparticipante($idUsuarioParticipante);
    public function loadIdusuariobonificado($idUsuarioBonificado);
    public function loadIdplanofatura($idPlanoFatura);
    public function loadTipomovimento($tipoMovimento);
    public function loadValortransacao($valorTransacao);
    public function loadDescricao($descricao);
    public function loadStatus($status);
    public function loadDatacadastro($dataCadastro);
    public function loadDataatualizacao($dataAtualizacao);

    public function updateIdusuarioparticipante($id, $idUsuarioParticipante);
    public function updateIdusuariobonificado($id, $idUsuarioBonificado);
    public function updateIdplanofatura($id, $idPlanoFatura);
    public function updateTipomovimento($id, $tipoMovimento);
    public function updateValortransacao($id, $valorTransacao);
    public function updateDescricao($id, $descricao);

}
?>

