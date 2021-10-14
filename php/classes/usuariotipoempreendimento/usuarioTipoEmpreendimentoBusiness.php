<?php

/**
*
* UsuarioTipoEmpreendimentoBusiness - Interface dos métodos de negócio para classe UsuarioTipoEmpreendimento
* Camada de negócio UsuarioTipoEmpreendimento - camada responsável pela lógica de negócios de UsuarioTipoEmpreendimento do sistema. 
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
* @since 06/09/2021 09:56:34
*
*/


// importar dependências
require_once '../interfaces/BusinessObject.php';

interface UsuarioTipoEmpreendimentoBusiness extends BusinessObject
{
    public function atualizarStatus($daofactory, $id, $status);
    public function listarUsuarioTipoEmpreendimentoPorStatus($daofactory, $status,  $pag=1, $qtde=0, $coluna=1, $ordem=0);
    public function validarTamanhoCampo($campo, $tamanho, $coment);
    public function listarUsuarioTipoEmpreendimentoPorUsuaIdStatus($daofactory, $usuaid, $status,  $pag=1, $qtde=0, $coluna=1, $ordem=0);
    public function inserirUsuarioTipoEmpreendimento($daofactory, $dto);
    public function pesquisarMaxPKAtivoIdusuarioPorStatus($daofactory, $idUsuario, $status);

    public function pesquisarPorIdusuario($daofactory, $idUsuario);
    public function pesquisarPorIdtipoempreendimento($daofactory, $idTipoEmpreendimento);

    public function atualizarIdusuarioPorPK($daofactory,$idUsuario,$id);
    public function atualizarIdtipoempreendimentoPorPK($daofactory,$idTipoEmpreendimento,$id);

}

?>
