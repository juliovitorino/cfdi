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
* UsuarioAutorizadorService - Interfaces dos servicos para Classe de negócio com métodos para apoiar a integridade de informações sobre o usuário autorizador  gerenciado pela plataforma
* Interface de Serviços UsuarioAutorizador - camada responsável pela lógica de negócios de UsuarioAutorizador do sistema. 
* Não é uma camada visível para outros dispositivos, como as camadas de apresentação e aplicação. 
*
* Por exemplo: quando estamos prestes a sacar dinheiro em um caixa eletrônico, 
* a condição primordial para isto acontecer é que exista saldo na sua conta. 
* Ou seja, é a camada que contém a lógica de como o sistema trabalha 
* como o negócio transcorre.
*
* Responsabilidades dessa classe
*
* 1) Abrir um contexto transacional com a fábrica de banco de dados
* 2) Abrir uma comunicação com as classes de negócio (Business classes)
* 3) Receber o retorno e decidir sobre o commit() ou rollback()
*
* Changelog:
*
*
* 
* @autor Julio Cesar Vitorino
* @since 09/09/2019 12:52:36
*
*/

// importar dependências

require_once '../interfaces/AppService.php';

interface UsuarioAutorizadorService extends AppService
{

    public function autalizarStatusUsuarioAutorizador($id, $status);
    public function listarUsuarioAutorizadorPorStatus($status='A', $pag=1, $qtde=0, $coluna=1, $ordem=0);
    public function listarUsuarioAutorizadorPorUsuaIdStatus($usuaid, $status='A', $pag=1, $qtde=0, $coluna=1, $ordem=0);
    public function listarUsuarioAutorizadorPorUsuaIdAutorizadorStatus($usuaid, $status='A', $pag=1, $qtde=0, $coluna=1, $ordem=0); 
    public function listarUsuarioAutorizadorPorUsuaIdAutorizadorCampId($usuaid, $campid, $status='A', $pag=1, $qtde=0, $coluna=1, $ordem=0); 
    public function cancelar($dto);
    public function PesquisarMaxPKAtivoId_UsuarioPorStatus($id_usuario,$status);
    public function habilitarUsuarioAutorizador($dto, $ishabilitar=true);

    public function pesquisarPorId_Usuario($id_usuario);
    public function pesquisarPorId_Autorizador($id_autorizador);
    public function pesquisarPorId_Campanha($id_campanha);
    public function pesquisarPorTipo($tipo);
    public function pesquisarPorPermissao($permissao);
    public function pesquisarPorDatainicio($dataInicio);
    public function pesquisarPorDatatermino($dataTermino);

    public function atualizarId_UsuarioPorPK($id_usuario,$id);
    public function atualizarId_AutorizadorPorPK($id_autorizador,$id);
    public function atualizarId_CampanhaPorPK($id_campanha,$id);
    public function atualizarTipoPorPK($tipo,$id);
    public function atualizarPermissaoPorPK($permissao,$id);
    public function atualizarDatainicioPorPK($dataInicio,$id);
    public function atualizarDataterminoPorPK($dataTermino,$id);

}


?>




