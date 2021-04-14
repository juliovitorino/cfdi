<?php
/**
*
* MkdListaService - Interfaces dos servicos para Classe de negócio com métodos para apoiar a integridade de informações sobre Leads gerenciado pela plataforma
* Interface de Serviços MkdLista - camada responsável pela lógica de negócios de MkdLista do sistema. 
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
* @since 04/11/2019 09:31:13
*
*/

// importar dependências

require_once '../interfaces/AppService.php';

interface MkdListaService extends AppService
{

    public function ativarNovoLead($token);
    public function autalizarStatusMkdLista($id, $status);
    public function listarMkdListaPorStatus($status='A', $pag=1, $qtde=0, $coluna=1, $ordem=0);
    public function listarMkdListaPorUsuaIdStatus($usuaid, $status='A', $pag=1, $qtde=0, $coluna=1, $ordem=0);
    public function cancelar($dto);
    public function pesquisarMaxPKAtivoId_Mkd_CampanhaPorStatus($id_mkd_campanha,$status);

    public function pesquisarPorId_Mkd_Campanha($id_mkd_campanha);
    public function pesquisarPorNome($nome);
    public function pesquisarPorEmail($email);
    public function pesquisarPorPrimeironome($primeiroNome);
    public function pesquisarPorSobrenome($sobrenome);
    public function pesquisarPorWhatsapp($whatsapp);
    public function pesquisarPorHashlead($hashlead);

    public function atualizarId_Mkd_CampanhaPorPK($id_mkd_campanha,$id);
    public function atualizarNomePorPK($nome,$id);
    public function atualizarEmailPorPK($email,$id);
    public function atualizarPrimeironomePorPK($primeiroNome,$id);
    public function atualizarSobrenomePorPK($sobrenome,$id);
    public function atualizarWhatsappPorPK($whatsapp,$id);
    public function atualizarHashleadPorPK($hashlead,$id);

}

?>
