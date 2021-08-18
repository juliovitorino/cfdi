<?php
/**
*
* FundoParticipacaoGlobalService - Interfaces dos servicos para Classe de negócio com métodos para apoiar a integridade de informações sobre movimentação do Fundo de Participação Global gerenciado pela plataforma
* Interface de Serviços FundoParticipacaoGlobal - camada responsável pela lógica de negócios de FundoParticipacaoGlobal do sistema. 
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
* @since 18/08/2021 12:15:16
*
*/

// importar dependências

require_once '../interfaces/AppService.php';

interface FundoParticipacaoGlobalService extends AppService
{

    public function autalizarStatusFundoParticipacaoGlobal($id, $status);
    public function listarFundoParticipacaoGlobalPorStatus($status='A', $pag=1, $qtde=0, $coluna=1, $ordem=0);
    public function listarFundoParticipacaoGlobalPorUsuaIdStatus($usuaid, $status='A', $pag=1, $qtde=0, $coluna=1, $ordem=0);
    public function cancelar($dto);
    public function pesquisarMaxPKAtivoIdusuarioparticipantePorStatus($idUsuarioParticipante,$status);

    public function pesquisarPorIdusuarioparticipante($idUsuarioParticipante);
    public function pesquisarPorIdusuariobonificado($idUsuarioBonificado);
    public function pesquisarPorIdplanofatura($idPlanoFatura);
    public function pesquisarPorTipomovimento($tipoMovimento);
    public function pesquisarPorValortransacao($valorTransacao);
    public function pesquisarPorDescricao($descricao);
//    public function pesquisarPorStatus($status);




    public function atualizarIdusuarioparticipantePorPK($idUsuarioParticipante,$id);
    public function atualizarIdusuariobonificadoPorPK($idUsuarioBonificado,$id);
    public function atualizarIdplanofaturaPorPK($idPlanoFatura,$id);
    public function atualizarTipomovimentoPorPK($tipoMovimento,$id);
    public function atualizarValortransacaoPorPK($valorTransacao,$id);
    public function atualizarDescricaoPorPK($descricao,$id);
//    public function atualizarStatusPorPK($status,$id);

}


?>

