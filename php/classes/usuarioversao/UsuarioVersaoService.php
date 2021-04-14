<?php
/**
*
* UsuarioVersaoService - Interfaces dos servicos para Classe de negócio com métodos 
* para apoiar a integridade de informações sobre a versão do aplicativo no dispositivo do usuário gerenciado pela plataforma.
* Interface de Serviços UsuarioVersao - camada responsável pela lógica de negócios de UsuarioVersao do sistema. 
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
* @since 06/10/2019 16:44:47
*
*/

// importar dependências

require_once '../interfaces/AppService.php';

interface UsuarioVersaoService extends AppService
{

    public function autalizarStatusUsuarioVersao($id, $status);
    public function listarUsuarioVersaoPorStatus($status='A', $pag=1, $qtde=0, $coluna=1, $ordem=0);
    public function listarUsuarioVersaoPorUsuaIdStatus($usuaid, $status='A', $pag=1, $qtde=0, $coluna=1, $ordem=0);
    public function cancelar($dto);
    public function PesquisarMaxPKAtivoId_VersaoPorStatus($id_versao,$status);
    public function verificarVersaoSistema($id_usuario, $versao);

    public function pesquisarPorId_Versao($id_versao);
    public function pesquisarPorId_Usuario($id_usuario);

    public function atualizarId_VersaoPorPK($id_versao,$id);
    public function atualizarId_UsuarioPorPK($id_usuario,$id);

}


?>
