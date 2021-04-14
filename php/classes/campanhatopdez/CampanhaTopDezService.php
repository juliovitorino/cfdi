<?php
/**
*
* CampanhaTopDezService - Interfaces dos servicos para Classe de negócio com métodos para apoiar a integridade de informações sobre usuários top 10 na campanha gerenciado pela plataforma
* Interface de Serviços CampanhaTopDez - camada responsável pela lógica de negócios de CampanhaTopDez do sistema. 
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
* @since 19/09/2019 08:36:54
*
*/

// importar dependências

require_once '../interfaces/AppService.php';

interface CampanhaTopDezService extends AppService
{
    public function autalizarStatusCampanhaTopDez($id, $status);
    public function listarCampanhaTopDezPorStatus($status='A', $pag=1, $qtde=0, $coluna=1, $ordem=0);
    public function listarCampanhaTopDezPorUsuaIdStatus($usuaid, $status='A', $pag=1, $qtde=0, $coluna=1, $ordem=0);
    public function cancelar($dto);
    public function PesquisarMaxPKAtivoId_CampanhaPorStatus($id_campanha,$status);

    public function pesquisarPorId_Campanha($id_campanha);
    public function pesquisarPorId_Usuario($id_usuario);
    public function pesquisarPorQtde($qtde);

    public function atualizarId_CampanhaPorPK($id_campanha,$id);
    public function atualizarId_UsuarioPorPK($id_usuario,$id);
    public function atualizarQtdePorPK($qtde,$id);

}


?>




