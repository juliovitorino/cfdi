<?php
/**
*
* CartaoMoverHistoricoService - Interfaces dos servicos para Classe de negócio com métodos para apoiar a integridade de informações sobre a movimentação de cartão entre dois usuarios gerenciado pela plataforma
* Interface de Serviços CartaoMoverHistorico - camada responsável pela lógica de negócios de CartaoMoverHistorico do sistema. 
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
* @since 24/07/2021 10:20:31
*
*/

// importar dependências

require_once '../interfaces/AppService.php';

interface CartaoMoverHistoricoService extends AppService
{

    public function autalizarStatusCartaoMoverHistorico($id, $status);
    public function listarCartaoMoverHistoricoPorStatus($status='A', $pag=1, $qtde=0, $coluna=1, $ordem=0);
    public function listarCartaoMoverHistoricoPorUsuaIdStatus($usuaid, $status='A', $pag=1, $qtde=0, $coluna=1, $ordem=0);
    public function cancelar($dto);
    public function pesquisarMaxPKAtivoIdcartaoPorStatus($idCartao,$status);

    public function pesquisarPorIdcartao($idCartao);
    public function pesquisarPorIdusuariodoador($idUsuarioDoador);
    public function pesquisarPorIdusuarioreceptor($idUsuarioReceptor);

    public function atualizarIdcartaoPorPK($idCartao,$id);
    public function atualizarIdusuariodoadorPorPK($idUsuarioDoador,$id);
    public function atualizarIdusuarioreceptorPorPK($idUsuarioReceptor,$id);

}

?>
