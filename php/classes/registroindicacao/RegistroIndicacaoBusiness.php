<?php

/**
*
* RegistroIndicacaoBusiness - Interface dos métodos de negócio para classe RegistroIndicacao
* Camada de negócio RegistroIndicacao - camada responsável pela lógica de negócios de RegistroIndicacao do sistema. 
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
* @since 23/06/2021 14:44:26
*
*/


// importar dependências
require_once '../interfaces/BusinessObject.php';

interface RegistroIndicacaoBusiness extends BusinessObject
{
    public function inserirIndicaoUsuarioPorPromotor($daofactory, $dto);
    public function atualizarStatus($daofactory, $id, $status);
    public function listarRegistroIndicacaoPorStatus($daofactory, $status, $pag, $qtde, $coluna, $ordem);
    public function validarTamanhoCampo($campo, $tamanho, $coment);
    public function listarRegistroIndicacaoPorUsuaIdStatus($daofactory, $usuaid, $status, $pag, $qtde, $coluna, $ordem);

    public function pesquisarMaxPKAtivoIdusuariopromotorPorStatus($daofactory, $idUsuarioPromotor, $status);

    public function pesquisarPorIdusuariopromotor($daofactory, $idUsuarioPromotor);
    public function pesquisarPorIdusuarioindicado($daofactory, $idUsuarioIndicado);
//    public function pesquisarPorStatus($daofactory, $status);



    public function atualizarIdusuariopromotorPorPK($daofactory,$idUsuarioPromotor,$id);
    public function atualizarIdusuarioindicadoPorPK($daofactory,$idUsuarioIndicado,$id);
//    public function atualizarStatusPorPK($daofactory,$status,$id);

}

?>
