<?php

/**
*
* UsuarioVersaoBusiness - Interface dos métodos de negócio para classe UsuarioVersao
* Camada de negócio UsuarioVersao - camada responsável pela lógica de negócios de UsuarioVersao do sistema. 
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
* @since 06/10/2019 16:44:47
*
*/


// importar dependências
require_once '../interfaces/BusinessObject.php';

interface UsuarioVersaoBusiness extends BusinessObject
{
    public function atualizarStatus($daofactory, $id, $status);
    public function listarUsuarioVersaoPorStatus($daofactory, $status, $pag, $qtde, $coluna, $ordem);
    public function validarTamanhoCampo($campo, $tamanho, $coment);
    public function listarUsuarioVersaoPorUsuaIdStatus($daofactory, $usuaid, $status, $pag, $qtde, $coluna, $ordem);
    public function verificarVersaoSistema($daofactory, $id_usuario, $versao);
    public function PesquisarMaxPKIdUsuarioIdVersao($daofactory, $id_usuario, $id_versao);

    public function PesquisarMaxPKAtivoId_VersaoPorStatus($daofactory, $id_versao, $status);

    public function pesquisarPorId_Versao($daofactory, $id_versao);
    public function pesquisarPorId_Usuario($daofactory, $id_usuario);

    public function atualizarId_VersaoPorPK($daofactory,$id_versao,$id);
    public function atualizarId_UsuarioPorPK($daofactory,$id_usuario,$id);

}

?>
