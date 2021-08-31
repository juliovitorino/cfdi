<?php
/**
*
* ContatoService - Interfaces dos servicos para Classe de negócio com métodos para apoiar a integridade de informações sobre dados de contato postado por usuários externos gerenciado pela plataforma
* Interface de Serviços Contato - camada responsável pela lógica de negócios de Contato do sistema. 
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
* @since 31/08/2021 08:17:22
*
*/

// importar dependências

require_once '../interfaces/AppService.php';

interface ContatoService extends AppService
{

    public function autalizarStatusContato($id, $status);
    public function listarContatoPorStatus($status='A', $pag=1, $qtde=0, $coluna=1, $ordem=0);
    public function listarContatoPorUsuaIdStatus($usuaid, $status='A', $pag=1, $qtde=0, $coluna=1, $ordem=0);
    public function cancelar($dto);
    public function pesquisarMaxPKAtivoNomePorStatus($nome,$status);

    public function pesquisarPorNome($nome);
    public function pesquisarPorEmail($email);
    public function pesquisarPorMensagem($mensagem);

    public function atualizarNomePorPK($nome,$id);
    public function atualizarEmailPorPK($email,$id);
    public function atualizarMensagemPorPK($mensagem,$id);

}


?>
