<?php

/**
*
* RecursoBusiness - Interface dos métodos de negócio para classe Recurso
* Camada de negócio Recurso - camada responsável pela lógica de negócios de Recurso do sistema. 
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
* @since 09/09/2021 08:00:49
*
*/


// importar dependências
require_once '../interfaces/BusinessObject.php';

interface RecursoBusiness extends BusinessObject
{
    public function atualizarStatus($daofactory, $id, $status);
    public function listarRecursoPorStatus($daofactory, $status,  $pag=1, $qtde=0, $coluna=1, $ordem=0);
    public function validarTamanhoCampo($campo, $tamanho, $coment);
    public function listarRecursoPorUsuaIdStatus($daofactory, $usuaid, $status,  $pag=1, $qtde=0, $coluna=1, $ordem=0);
    public function inserirRecurso($daofactory, $dto);
    public function pesquisarMaxPKAtivoDescricaoPorStatus($daofactory, $descricao, $status);

    public function pesquisarPorDescricao($daofactory, $descricao);

    public function atualizarDescricaoPorPK($daofactory,$descricao,$id);

}

?>




