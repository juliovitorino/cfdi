<?php

/**
*
* GrupoUsuarioBusiness - Interface dos métodos de negócio para classe GrupoUsuario
* Camada de negócio GrupoUsuario - camada responsável pela lógica de negócios de GrupoUsuario do sistema. 
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
* @since 22/08/2021 17:02:50
*
*/

// importar dependências
require_once '../interfaces/BusinessObject.php';

interface GrupoUsuarioBusiness extends BusinessObject
{
    public function atualizarStatus($daofactory, $id, $status);
    public function listarGrupoUsuarioPorStatus($daofactory, $status, $pag, $qtde, $coluna, $ordem);
    public function validarTamanhoCampo($campo, $tamanho, $coment);
    public function listarGrupoUsuarioPorUsuaIdStatus($daofactory, $usuaid, $status, $pag, $qtde, $coluna, $ordem);
    public function inserirGrupoUsuario($daofactory, $dto);
    public function pesquisarMaxPKAtivoIdgradPorStatus($daofactory, $idgrad, $status);

    public function pesquisarPorIdgrad($daofactory, $idgrad);
    public function pesquisarPorId_Usuario($daofactory, $id_usuario);

    public function atualizarIdgradPorPK($daofactory,$idgrad,$id);
    public function atualizarId_UsuarioPorPK($daofactory,$id_usuario,$id);

}

?>




