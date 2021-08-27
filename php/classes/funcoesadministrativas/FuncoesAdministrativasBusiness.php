<?php

/**
*
* FuncoesAdministrativasBusiness - Interface dos métodos de negócio para classe FuncoesAdministrativas
* Camada de negócio FuncoesAdministrativas - camada responsável pela lógica de negócios de FuncoesAdministrativas do sistema. 
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
* @since 20/08/2021 15:09:15
*
*/


// importar dependências
require_once '../interfaces/BusinessObject.php';

interface FuncoesAdministrativasBusiness extends BusinessObject
{
    public function atualizarStatus($daofactory, $id, $status);
    public function listarFuncoesAdministrativasPorStatus($daofactory, $status, $pag, $qtde, $coluna, $ordem);
    public function validarTamanhoCampo($campo, $tamanho, $coment);
    public function listarFuncoesAdministrativasPorUsuaIdStatus($daofactory, $usuaid, $status, $pag, $qtde, $coluna, $ordem);
    public function inserirFuncoesAdministrativas($daofactory, $dto);
    public function pesquisarMaxPKAtivoDescricaoPorStatus($daofactory, $descricao, $status);

    public function pesquisarPorDescricao($daofactory, $descricao);

    public function atualizarDescricaoPorPK($daofactory,$descricao,$id);
}

?>
