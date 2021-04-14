<?php
/**
*
* VersaoService - Interfaces dos servicos para Classe de negócio com métodos para apoiar a integridade de informações sobre publicidades de usuarios gerenciado pela plataforma
* Interface de Serviços Versao - camada responsável pela lógica de negócios de Versao do sistema. 
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
* @since 06/10/2019 15:59:51
*
*/

// importar dependências

require_once '../interfaces/AppService.php';

interface VersaoService extends AppService
{

    public function autalizarStatusVersao($id, $status);
    public function listarVersaoPorStatus($status='A', $pag=1, $qtde=0, $coluna=1, $ordem=0);
    public function listarVersaoPorUsuaIdStatus($usuaid, $status='A', $pag=1, $qtde=0, $coluna=1, $ordem=0);
    public function cancelar($dto);
    public function PesquisarMaxPKAtivoVersaoPorStatus($versao,$status);
    public function PesquisarMaxPKAtivoVersao($versao);

    public function pesquisarPorVersao($versao);
    public function pesquisarPorStatus($status);

    public function atualizarVersaoPorPK($versao,$id);
    public function atualizarStatusPorPK($status,$id);

}


?>
