<?php
/**
*
* SeglogService - Interfaces dos servicos para Classe de negócio com métodos para apoiar a integridade de informações sobre dados da seglog gerenciado pela plataforma
* Interface de Serviços Seglog - camada responsável pela lógica de negócios de Seglog do sistema. 
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
* @since 21/08/2021 12:30:09
*
*/

// importar dependências

require_once '../interfaces/AppService.php';

interface SeglogService extends AppService
{

    public function autalizarStatusSeglog($id, $status);
    public function listarSeglogPorStatus($status='A', $pag=1, $qtde=0, $coluna=1, $ordem=0);
    public function listarSeglogPorUsuaIdStatus($usuaid, $status='A', $pag=1, $qtde=0, $coluna=1, $ordem=0);
    public function cancelar($dto);
    public function pesquisarMaxPKAtivoIdgafaPorStatus($idgafa,$status);

    public function pesquisarPorIdgafa($idgafa);
    public function pesquisarPorId_Usuario($id_usuario);
    public function pesquisarPorFuncao($funcao);
    public function pesquisarPorid_UsuarioFuncao($id_usuario, $funcao);
    public function pesquisarPorIncrudcriar($incrudCriar);
    public function pesquisarPorIncrudrecuperar($incrudRecuperar);
    public function pesquisarPorIncrudatualizar($incrudAtualizar);
    public function pesquisarPorIncrudexcluir($incrudExcluir);

    public function atualizarIdgafaPorPK($idgafa,$id);
    public function atualizarId_UsuarioPorPK($id_usuario,$id);
    public function atualizarFuncaoPorPK($funcao,$id);
    public function atualizarIncrudcriarPorPK($incrudCriar,$id);
    public function atualizarIncrudrecuperarPorPK($incrudRecuperar,$id);
    public function atualizarIncrudatualizarPorPK($incrudAtualizar,$id);
    public function atualizarIncrudexcluirPorPK($incrudExcluir,$id);

}


?>




