<?php

/**
*
* GrupoAdministracaoBusiness - Interface dos métodos de negócio para classe GrupoAdministracao
* Camada de negócio GrupoAdministracao - camada responsável pela lógica de negócios de GrupoAdministracao do sistema. 
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
* @since 20/08/2021 15:48:08
*
*/


// importar dependências
require_once '../interfaces/BusinessObject.php';

interface GrupoAdministracaoBusiness extends BusinessObject
{
    public function atualizarStatus($daofactory, $id, $status);
    public function listarGrupoAdministracaoPorStatus($daofactory, $status, $pag, $qtde, $coluna, $ordem);
    public function validarTamanhoCampo($campo, $tamanho, $coment);
    public function listarGrupoAdministracaoPorUsuaIdStatus($daofactory, $usuaid, $status, $pag, $qtde, $coluna, $ordem);
    public function inserirGrupoAdministracao($daofactory, $dto);
    public function pesquisarMaxPKAtivoDescricaoPorStatus($daofactory, $descricao, $status);


    public function pesquisarPorDescricao($daofactory, $descricao);

    public function atualizarDescricaoPorPK($daofactory,$descricao,$id);

}

?>




