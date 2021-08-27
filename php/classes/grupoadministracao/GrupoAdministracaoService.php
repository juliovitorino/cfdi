<?php
/**
*
* GrupoAdministracaoService - Interfaces dos servicos para Classe de negócio com métodos para apoiar a integridade de informações sobre controle de grupos de administradores gerenciado pela plataforma
* Interface de Serviços GrupoAdministracao - camada responsável pela lógica de negócios de GrupoAdministracao do sistema. 
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
* @since 20/08/2021 15:41:08
*
*/

// importar dependências

require_once '../interfaces/AppService.php';

interface GrupoAdministracaoService extends AppService
{

    public function autalizarStatusGrupoAdministracao($id, $status);
    public function listarGrupoAdministracaoPorStatus($status='A', $pag=1, $qtde=0, $coluna=1, $ordem=0);
    public function listarGrupoAdministracaoPorUsuaIdStatus($usuaid, $status='A', $pag=1, $qtde=0, $coluna=1, $ordem=0);
    public function cancelar($dto);
    public function pesquisarMaxPKAtivoDescricaoPorStatus($descricao,$status);

    public function pesquisarPorDescricao($descricao);

    public function atualizarDescricaoPorPK($descricao,$id);

}


?>
