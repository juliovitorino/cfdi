<?php

/**
*
* CartaoMoverHistoricoBusiness - Interface dos métodos de negócio para classe CartaoMoverHistorico
* Camada de negócio CartaoMoverHistorico - camada responsável pela lógica de negócios de CartaoMoverHistorico do sistema. 
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
* @since 24/07/2021 10:20:31
*
*/


// importar dependências
require_once '../interfaces/BusinessObject.php';

interface CartaoMoverHistoricoBusiness extends BusinessObject
{
    public function atualizarStatus($daofactory, $id, $status);
    public function listarCartaoMoverHistoricoPorStatus($daofactory, $status, $pag, $qtde, $coluna, $ordem);
    public function validarTamanhoCampo($campo, $tamanho, $coment);
    public function listarCartaoMoverHistoricoPorUsuaIdStatus($daofactory, $usuaid, $status, $pag, $qtde, $coluna, $ordem);
    public function listarCartaoMoverHistoricoPorCartIdStatus($daofactory, $cartid, $status, $pag, $qtde, $coluna, $ordem);


    public function pesquisarMaxPKAtivoIdcartaoPorStatus($daofactory, $idCartao, $status);


    public function pesquisarPorIdcartao($daofactory, $idCartao);
    public function pesquisarPorIdusuariodoador($daofactory, $idUsuarioDoador);
    public function pesquisarPorIdusuarioreceptor($daofactory, $idUsuarioReceptor);

    public function atualizarIdcartaoPorPK($daofactory,$idCartao,$id);
    public function atualizarIdusuariodoadorPorPK($daofactory,$idUsuarioDoador,$id);
    public function atualizarIdusuarioreceptorPorPK($daofactory,$idUsuarioReceptor,$id);

}

?>

