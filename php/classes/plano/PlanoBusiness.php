<?php

/**
*
* PlanoBusiness - Interface dos métodos de negócio para classe Plano
* Camada de negócio Plano - camada responsável pela lógica de negócios de Plano do sistema. 
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
* @since 08/09/2021 14:15:34
*
*/


// importar dependências
require_once '../interfaces/BusinessObject.php';

interface PlanoBusiness extends BusinessObject
{
    public function getListaPermissao($permstr);

    public function atualizarStatus($daofactory, $id, $status);
    public function listarPlanoPorStatus($daofactory, $status,  $pag=1, $qtde=0, $coluna=1, $ordem=0);
    public function listarPlanoPorStatusTipo($daofactory, $status, $tipo, $pag=1, $qtde=0, $coluna=1, $ordem=0);
    public function validarTamanhoCampo($campo, $tamanho, $coment);
    public function listarPlanoPorUsuaIdStatus($daofactory, $usuaid, $status,  $pag=1, $qtde=0, $coluna=1, $ordem=0);
    public function inserirPlano($daofactory, $dto);
    public function pesquisarMaxPKAtivoNomePorStatus($daofactory, $nome, $status);

    public function pesquisarPorNome($daofactory, $nome);
    public function pesquisarPorPermissao($daofactory, $permissao);
    public function pesquisarPorValor($daofactory, $valor);
    public function pesquisarPorTipo($daofactory, $tipo);

    public function atualizarNomePorPK($daofactory,$nome,$id);
    public function atualizarPermissaoPorPK($daofactory,$permissao,$id);
    public function atualizarValorPorPK($daofactory,$valor,$id);
    public function atualizarTipoPorPK($daofactory,$tipo,$id);

}

?>




