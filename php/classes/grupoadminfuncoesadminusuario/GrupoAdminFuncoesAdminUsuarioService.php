<?php
/**
*
* GrupoAdminFuncoesAdminUsuarioService - Interfaces dos servicos para Classe de negócio com métodos para apoiar a integridade de informações sobre controle de grupos de administradores x funções administrativas  x Usuario gerenciado pela plataforma
* Interface de Serviços GrupoAdminFuncoesAdminUsuario - camada responsável pela lógica de negócios de GrupoAdminFuncoesAdminUsuario do sistema. 
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
* @since 20/08/2021 19:25:25
*
*/

// importar dependências

require_once '../interfaces/AppService.php';

interface GrupoAdminFuncoesAdminUsuarioService extends AppService
{

    public function autalizarStatusGrupoAdminFuncoesAdminUsuario($id, $status);
    public function listarGrupoAdminFuncoesAdminUsuarioPorStatus($status='A', $pag=1, $qtde=0, $coluna=1, $ordem=0);
    public function listarGrupoAdminFuncoesAdminUsuarioPorUsuaIdStatus($usuaid, $status='A', $pag=1, $qtde=0, $coluna=1, $ordem=0);
    public function cancelar($dto);
    public function pesquisarMaxPKAtivoIdgrupoadmfuncoesadmPorStatus($idGrupoAdmFuncoesAdm,$status);

    public function pesquisarPorIdgrupoadmfuncoesadm($idGrupoAdmFuncoesAdm);
    public function pesquisarPorId_Usuario($id_usuario);

    public function atualizarIdgrupoadmfuncoesadmPorPK($idGrupoAdmFuncoesAdm,$id);
    public function atualizarId_UsuarioPorPK($id_usuario,$id);

}


?>

