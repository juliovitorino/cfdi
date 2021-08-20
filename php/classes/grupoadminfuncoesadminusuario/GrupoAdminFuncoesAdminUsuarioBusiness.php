<?php

/**
*
* GrupoAdminFuncoesAdminUsuarioBusiness - Interface dos métodos de negócio para classe GrupoAdminFuncoesAdminUsuario
* Camada de negócio GrupoAdminFuncoesAdminUsuario - camada responsável pela lógica de negócios de GrupoAdminFuncoesAdminUsuario do sistema. 
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
* @since 20/08/2021 19:25:25
*
*/


// importar dependências
require_once '../interfaces/BusinessObject.php';

interface GrupoAdminFuncoesAdminUsuarioBusiness extends BusinessObject
{
    public function atualizarStatus($daofactory, $id, $status);
    public function listarGrupoAdminFuncoesAdminUsuarioPorStatus($daofactory, $status, $pag, $qtde, $coluna, $ordem);
    public function validarTamanhoCampo($campo, $tamanho, $coment);
    public function listarGrupoAdminFuncoesAdminUsuarioPorUsuaIdStatus($daofactory, $usuaid, $status, $pag, $qtde, $coluna, $ordem);
    public function inserirGrupoAdminFuncoesAdminUsuario($daofactory, $dto);
    public function pesquisarMaxPKAtivoIdgrupoadmfuncoesadmPorStatus($daofactory, $idGrupoAdmFuncoesAdm, $status);


    public function pesquisarPorIdgrupoadmfuncoesadm($daofactory, $idGrupoAdmFuncoesAdm);
    public function pesquisarPorId_Usuario($daofactory, $id_usuario);

    public function atualizarIdgrupoadmfuncoesadmPorPK($daofactory,$idGrupoAdmFuncoesAdm,$id);
    public function atualizarId_UsuarioPorPK($daofactory,$id_usuario,$id);
}

?>




