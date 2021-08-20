<?php

/**
*
* GrupoAdminFuncoesAdminBusiness - Interface dos métodos de negócio para classe GrupoAdminFuncoesAdmin
* Camada de negócio GrupoAdminFuncoesAdmin - camada responsável pela lógica de negócios de GrupoAdminFuncoesAdmin do sistema. 
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
* @since 20/08/2021 18:54:21
*
*/

// importar dependências
require_once '../interfaces/BusinessObject.php';

interface GrupoAdminFuncoesAdminBusiness extends BusinessObject
{
    public function atualizarStatus($daofactory, $id, $status);
    public function listarGrupoAdminFuncoesAdminPorStatus($daofactory, $status, $pag, $qtde, $coluna, $ordem);
    public function validarTamanhoCampo($campo, $tamanho, $coment);
    public function listarGrupoAdminFuncoesAdminPorUsuaIdStatus($daofactory, $usuaid, $status, $pag, $qtde, $coluna, $ordem);
    public function inserirGrupoAdminFuncoesAdmin($daofactory, $dto);
    public function pesquisarMaxPKAtivoIdgrupoadministracaoPorStatus($daofactory, $idGrupoAdministracao, $status);

    public function pesquisarPorIdgrupoadministracao($daofactory, $idGrupoAdministracao);
    public function pesquisarPorIdfuncoesadministrativas($daofactory, $idFuncoesAdministrativas);
    public function pesquisarPorDescricao($daofactory, $descricao);
    public function pesquisarPorIncrudcriar($daofactory, $incrudCriar);
    public function pesquisarPorIncrudrecuperar($daofactory, $incrudRecuperar);
    public function pesquisarPorIncrudatualizar($daofactory, $incrudAtualizar);
    public function pesquisarPorIncrudexcluir($daofactory, $incrudExcluir);

    public function atualizarIdgrupoadministracaoPorPK($daofactory,$idGrupoAdministracao,$id);
    public function atualizarIdfuncoesadministrativasPorPK($daofactory,$idFuncoesAdministrativas,$id);
    public function atualizarDescricaoPorPK($daofactory,$descricao,$id);
    public function atualizarIncrudcriarPorPK($daofactory,$incrudCriar,$id);
    public function atualizarIncrudrecuperarPorPK($daofactory,$incrudRecuperar,$id);
    public function atualizarIncrudatualizarPorPK($daofactory,$incrudAtualizar,$id);
    public function atualizarIncrudexcluirPorPK($daofactory,$incrudExcluir,$id);

}

?>


