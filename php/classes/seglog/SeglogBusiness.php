<?php

/**
*
* SeglogBusiness - Interface dos métodos de negócio para classe Seglog
* Camada de negócio Seglog - camada responsável pela lógica de negócios de Seglog do sistema. 
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
* @since 21/08/2021 12:30:09
*
*/

// importar dependências
require_once '../interfaces/BusinessObject.php';

interface SeglogBusiness extends BusinessObject
{
    public function atualizarStatus($daofactory, $id, $status);
    public function listarSeglogPorStatus($daofactory, $status, $pag, $qtde, $coluna, $ordem);
    public function validarTamanhoCampo($campo, $tamanho, $coment);
    public function listarSeglogPorUsuaIdStatus($daofactory, $usuaid, $status, $pag, $qtde, $coluna, $ordem);
    public function inserirSeglog($daofactory, $dto);
    public function pesquisarMaxPKAtivoIdgafaPorStatus($daofactory, $idgafa, $status);

    public function pesquisarPorIdgafa($daofactory, $idgafa);
    public function pesquisarPorId_Usuario($daofactory, $id_usuario);
    public function pesquisarPorFuncao($daofactory, $funcao);
    public function pesquisarPorid_UsuarioFuncao($daofactory, $id_usuario, $funcao);
    public function pesquisarPorIncrudcriar($daofactory, $incrudCriar);
    public function pesquisarPorIncrudrecuperar($daofactory, $incrudRecuperar);
    public function pesquisarPorIncrudatualizar($daofactory, $incrudAtualizar);
    public function pesquisarPorIncrudexcluir($daofactory, $incrudExcluir);

    public function atualizarIdgafaPorPK($daofactory,$idgafa,$id);
    public function atualizarId_UsuarioPorPK($daofactory,$id_usuario,$id);
    public function atualizarFuncaoPorPK($daofactory,$funcao,$id);
    public function atualizarIncrudcriarPorPK($daofactory,$incrudCriar,$id);
    public function atualizarIncrudrecuperarPorPK($daofactory,$incrudRecuperar,$id);
    public function atualizarIncrudatualizarPorPK($daofactory,$incrudAtualizar,$id);
    public function atualizarIncrudexcluirPorPK($daofactory,$incrudExcluir,$id);

}

?>




