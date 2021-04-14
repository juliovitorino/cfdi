<?php

/**
*
* FilaPublicidadeBusiness - Interface dos métodos de negócio para classe FilaPublicidade
* Camada de negócio FilaPublicidade - camada responsável pela lógica de negócios de FilaPublicidade do sistema. 
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
* @since 19/09/2019 15:17:09
*
*/


// importar dependências
require_once '../interfaces/BusinessObject.php';

interface FilaPublicidadeBusiness extends BusinessObject
{
    public function atualizarStatus($daofactory, $id, $status);
    public function listarFilaPublicidadePorStatus($daofactory, $status, $pag, $qtde, $coluna, $ordem);
    public function validarTamanhoCampo($campo, $tamanho, $coment);
    public function listarFilaPublicidadePorUsuaIdStatus($daofactory, $usuaid, $status, $pag, $qtde, $coluna, $ordem);

    public function PesquisarMaxPKAtivoId_Usua_PublicPorStatus($daofactory, $id_usua_public, $status);


    public function pesquisarPorId_Usua_Public($daofactory, $id_usua_public);
    public function pesquisarPorId_Usuario($daofactory, $id_usuario);
    public function pesquisarPorId_Job($daofactory, $id_job);
    public function pesquisarPorStatus($daofactory, $status);

    public function atualizarId_Usua_PublicPorPK($daofactory,$id_usua_public,$id);
    public function atualizarId_UsuarioPorPK($daofactory,$id_usuario,$id);
    public function atualizarId_JobPorPK($daofactory,$id_job,$id);
    public function atualizarStatusPorPK($daofactory,$status,$id);

}

?>
