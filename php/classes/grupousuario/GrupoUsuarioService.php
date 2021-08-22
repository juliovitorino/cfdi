<?php
/**
*
* GrupoUsuarioService - Interfaces dos servicos para Classe de negócio com métodos para apoiar a integridade de informações sobre dados da seglog gerenciado pela plataforma
* Interface de Serviços GrupoUsuario - camada responsável pela lógica de negócios de GrupoUsuario do sistema. 
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
* @since 22/08/2021 17:02:50
*
*/

// importar dependências

require_once '../interfaces/AppService.php';

interface GrupoUsuarioService extends AppService
{

    public function autalizarStatusGrupoUsuario($id, $status);
    public function listarGrupoUsuarioPorStatus($status='A', $pag=1, $qtde=0, $coluna=1, $ordem=0);
    public function listarGrupoUsuarioPorUsuaIdStatus($usuaid, $status='A', $pag=1, $qtde=0, $coluna=1, $ordem=0);
    public function cancelar($dto);
    public function pesquisarMaxPKAtivoIdgradPorStatus($idgrad,$status);

    public function pesquisarPorIdgrad($idgrad);
    public function pesquisarPorId_Usuario($id_usuario);

    public function atualizarIdgradPorPK($idgrad,$id);
    public function atualizarId_UsuarioPorPK($id_usuario,$id);

}


?>




