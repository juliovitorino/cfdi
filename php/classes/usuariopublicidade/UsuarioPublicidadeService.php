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
* UsuarioPublicidadeService - Interfaces dos servicos para Classe de negócio com métodos para apoiar a integridade de informações sobre publicidades de usuarios gerenciado pela plataforma
* Interface de Serviços UsuarioPublicidade - camada responsável pela lógica de negócios de UsuarioPublicidade do sistema. 
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
* @since 20/09/2019 13:57:12
*
*/

// importar dependências

require_once '../interfaces/AppService.php';

interface UsuarioPublicidadeService extends AppService
{

    public function autalizarStatusUsuarioPublicidade($id, $status);
    public function listarUsuarioPublicidadePorStatus($status='A', $pag=1, $qtde=0, $coluna=1, $ordem=0);
    public function listarUsuarioPublicidadePorUsuaIdStatus($usuaid, $status='A', $pag=1, $qtde=0, $coluna=1, $ordem=0);
    public function listarUsuarioPublicidadeProx24h($usuaid, $status='A', $pag=1, $qtde=0, $coluna=1, $ordem=0);
    public function cancelar($dto);
    public function PesquisarMaxPKAtivoId_UsuarioPorStatus($id_usuario,$status);
    public function atualizarImagem($uspu_id, $nomearquivo);

    public function pesquisarPorId_Usuario($id_usuario);
    public function pesquisarPorTitulo($titulo);
    public function pesquisarPorDescricao($descricao);
    public function pesquisarPorDatainicio($dataInicio);
    public function pesquisarPorDatatermino($dataTermino);
    public function pesquisarPorVlnormal($vlNormal);
    public function pesquisarPorVlpromo($vlPromo);
    public function pesquisarPorObservacao($observacao);
    public function pesquisarPorDataremover($dataRemover);

    public function atualizarId_UsuarioPorPK($id_usuario,$id);
    public function atualizarTituloPorPK($titulo,$id);
    public function atualizarDescricaoPorPK($descricao,$id);
    public function atualizarDatainicioPorPK($dataInicio,$id);
    public function atualizarDataterminoPorPK($dataTermino,$id);
    public function atualizarVlnormalPorPK($vlNormal,$id);
    public function atualizarVlpromoPorPK($vlPromo,$id);
    public function atualizarObservacaoPorPK($observacao,$id);
    public function atualizarDataremoverPorPK($dataRemover,$id);

}


?>




