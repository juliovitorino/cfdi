<?php
/**
*
* FuncoesAdministrativasService - Interfaces dos servicos para Classe de negócio com métodos para apoiar a integridade de informações sobre controle de funções administrativas gerenciado pela plataforma
* Interface de Serviços FuncoesAdministrativas - camada responsável pela lógica de negócios de FuncoesAdministrativas do sistema. 
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
* @since 20/08/2021 15:09:15
*
*/

// importar dependências

require_once '../interfaces/AppService.php';

interface FuncoesAdministrativasService extends AppService
{

    public function autalizarStatusFuncoesAdministrativas($id, $status);
    public function listarFuncoesAdministrativasPorStatus($status='A', $pag=1, $qtde=0, $coluna=1, $ordem=0);
    public function listarFuncoesAdministrativasPorUsuaIdStatus($usuaid, $status='A', $pag=1, $qtde=0, $coluna=1, $ordem=0);
    public function cancelar($dto);
    public function pesquisarMaxPKAtivoDescricaoPorStatus($descricao,$status);

    public function pesquisarPorDescricao($descricao);

    public function atualizarDescricaoPorPK($descricao,$id);

}

?>
