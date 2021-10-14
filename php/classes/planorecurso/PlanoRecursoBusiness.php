<?php

/**
*
* PlanoRecursoBusiness - Interface dos métodos de negócio para classe PlanoRecurso
* Camada de negócio PlanoRecurso - camada responsável pela lógica de negócios de PlanoRecurso do sistema. 
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
* @since 09/09/2021 12:12:30
*
*/


// importar dependências
require_once '../interfaces/BusinessObject.php';

interface PlanoRecursoBusiness extends BusinessObject
{
    public function atualizarStatus($daofactory, $id, $status);
    public function listarPlanoRecursoPorStatus($daofactory, $status,  $pag=1, $qtde=0, $coluna=1, $ordem=0);
    public function validarTamanhoCampo($campo, $tamanho, $coment);
    public function listarPlanoRecursoPorUsuaIdStatus($daofactory, $usuaid, $status,  $pag=1, $qtde=0, $coluna=1, $ordem=0);
    public function listarPlanoRecursoPorIdplanoStatus($daofactory, $idplano, $status,  $pag=1, $qtde=0, $coluna=1, $ordem=0);
    public function inserirPlanoRecurso($daofactory, $dto);
    public function pesquisarMaxPKAtivoIdplanoPorStatus($daofactory, $idplano, $status);

    public function pesquisarPorIdplano($daofactory, $idplano);
    public function pesquisarPorIdrecurso($daofactory, $idrecurso);

    public function atualizarIdplanoPorPK($daofactory,$idplano,$id);
    public function atualizarIdrecursoPorPK($daofactory,$idrecurso,$id);

}

?>




