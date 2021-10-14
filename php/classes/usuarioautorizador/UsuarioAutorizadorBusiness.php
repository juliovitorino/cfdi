<?php
/**********************************************************
===========================================================

 #####  #     #   ###   ######     #    ######   ##### 
#     # #     #    #    #     #   # #   #     # #     #
#       #     #    #    #     #  #   #  #     # #     #
#       #     #    #    #     # #     # #     # #     #
#       #     #    #    #     # ####### #     # #     #
#     # #     #    #    #     # #     # #     # #     #
 #####   #####    ###   ######  #     # ######   #####
 
===========================================================
CÓDIGO SOFREU ALTERAÇÕES PROFUNDAS, NÃO USE O GERADOR
AUTOMÁTICO PARA SUBSTITUIR O CÓDIGO AQUI EXISTENTE.
TODO O SISTEMA PODE ENTRAR EM COLAPSO.
===========================================================
***********************************************************/ 

/**
*
* UsuarioAutorizadorBusiness - Interface dos métodos de negócio para classe UsuarioAutorizador
* Camada de negócio UsuarioAutorizador - camada responsável pela lógica de negócios de UsuarioAutorizador do sistema. 
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
* @since 09/09/2019 12:52:36
*
*/

// importar dependências
require_once '../interfaces/BusinessObject.php';

interface UsuarioAutorizadorBusiness extends BusinessObject
{
    public function atualizarStatus($daofactory, $id, $status);
    public function listarUsuarioAutorizadorPorStatus($daofactory, $status, $pag, $qtde, $coluna, $ordem);
    public function validarTamanhoCampo($campo, $tamanho, $coment);
    public function listarUsuarioAutorizadorPorUsuaIdStatus($daofactory, $usuaid, $status, $pag, $qtde, $coluna, $ordem);
    public function listarUsuarioAutorizadorPorUsuaIdAutorizadorStatus($daofactory, $usuaid, $status, $pag, $qtde, $coluna, $ordem);
    public function listarUsuarioAutorizadorPorUsuaIdAutorizadorCampId($daofactory, $usuaid, $campid, $status, $pag=1, $qtde=50, $coluna=1, $ordem=0);
    public function listarUsuarioCarimbador($daofactory, $usuaid, $status="A", $pag=1, $qtde=50, $coluna=1, $ordem=0);
    public function habilitarUsuarioAutorizador($daofactory, $dto, $ishabilitar);

    public function contarUsuarioAutorizadorIdCampPorStatus($daofactory, $campid, $status);

    public function PesquisarMaxPKAtivoId_UsuarioPorStatus($daofactory, $id_usuario, $status);
    public function PesquisarMaxPKAtivoId_UsuarioAutorizadorPorStatus($daofactory, $id_usuario, $id_campanha, $status);
    public function PesquisarMaxPKAtivoId_UsuarioCarimbadorPorStatus($daofactory, $id_usuario, $id_campanha, $status);

    public function pesquisarPorId_Usuario($daofactory, $id_usuario);
    public function pesquisarPorId_Autorizador($daofactory, $id_autorizador);
    public function pesquisarPorId_Campanha($daofactory, $id_campanha);
    public function pesquisarPorTipo($daofactory, $tipo);
    public function pesquisarPorPermissao($daofactory, $permissao);
    public function pesquisarPorDatainicio($daofactory, $dataInicio);
    public function pesquisarPorDatatermino($daofactory, $dataTermino);

    public function atualizarId_UsuarioPorPK($daofactory,$id_usuario,$id);
    public function atualizarId_AutorizadorPorPK($daofactory,$id_autorizador,$id);
    public function atualizarId_CampanhaPorPK($daofactory,$id_campanha,$id);
    public function atualizarTipoPorPK($daofactory,$tipo,$id);
    public function atualizarPermissaoPorPK($daofactory,$permissao,$id);
    public function atualizarDatainicioPorPK($daofactory,$dataInicio,$id);
    public function atualizarDataterminoPorPK($daofactory,$dataTermino,$id);

}

?>




