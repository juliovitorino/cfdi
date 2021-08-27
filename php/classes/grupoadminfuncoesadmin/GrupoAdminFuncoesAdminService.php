<?php
/**
*
* GrupoAdminFuncoesAdminService - Interfaces dos servicos para Classe de negócio com métodos para apoiar a integridade de informações sobre controle de grupos de administradores e funções administrativas gerenciado pela plataforma
* Interface de Serviços GrupoAdminFuncoesAdmin - camada responsável pela lógica de negócios de GrupoAdminFuncoesAdmin do sistema. 
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
* @since 20/08/2021 18:47:48
*
*/

// importar dependências

require_once '../interfaces/AppService.php';

interface GrupoAdminFuncoesAdminService extends AppService
{

    public function autalizarStatusGrupoAdminFuncoesAdmin($id, $status);
    public function listarGrupoAdminFuncoesAdminPorStatus($status='A', $pag=1, $qtde=0, $coluna=1, $ordem=0);
    public function listarGrupoAdminFuncoesAdminPorUsuaIdStatus($usuaid, $status='A', $pag=1, $qtde=0, $coluna=1, $ordem=0);
    public function cancelar($dto);
    public function pesquisarMaxPKAtivoIdgrupoadministracaoPorStatus($idGrupoAdministracao,$status);

    public function pesquisarPorIdgrupoadministracao($idGrupoAdministracao);
    public function pesquisarPorIdfuncoesadministrativas($idFuncoesAdministrativas);
    public function pesquisarPorDescricao($descricao);
    public function pesquisarPorIncrudcriar($incrudCriar);
    public function pesquisarPorIncrudrecuperar($incrudRecuperar);
    public function pesquisarPorIncrudatualizar($incrudAtualizar);
    public function pesquisarPorIncrudexcluir($incrudExcluir);
    //public function pesquisarPorStatus($status);

    public function atualizarIdgrupoadministracaoPorPK($idGrupoAdministracao,$id);
    public function atualizarIdfuncoesadministrativasPorPK($idFuncoesAdministrativas,$id);
    public function atualizarDescricaoPorPK($descricao,$id);
    public function atualizarIncrudcriarPorPK($incrudCriar,$id);
    public function atualizarIncrudrecuperarPorPK($incrudRecuperar,$id);
    public function atualizarIncrudatualizarPorPK($incrudAtualizar,$id);
    public function atualizarIncrudexcluirPorPK($incrudExcluir,$id);

}

?>
