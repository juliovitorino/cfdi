<?php
/**
*
* PlanoService - Interfaces dos servicos para Classe de negócio com métodos para apoiar a integridade de informações sobre planos gerenciado pela plataforma
* Interface de Serviços Plano - camada responsável pela lógica de negócios de Plano do sistema. 
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
* @since 08/09/2021 14:05:31
*
*/

// importar dependências

require_once '../interfaces/AppService.php';

interface PlanoService extends AppService
{

    public function autalizarStatusPlano($id, $status);
    public function listarPlanoPorStatus($status='A', $pag=1, $qtde=0, $coluna=1, $ordem=0);
    public function listarPlanoPorStatusTipo($status='A', $tipo='PLA', $pag=1, $qtde=0, $coluna=1, $ordem=0);
    public function listarPlanoPorUsuaIdStatus($usuaid, $status='A', $pag=1, $qtde=0, $coluna=1, $ordem=0);
    public function cancelar($dto);
    public function pesquisarMaxPKAtivoNomePorStatus($nome,$status);

    public function pesquisarPorNome($nome);
    public function pesquisarPorPermissao($permissao);
    public function pesquisarPorValor($valor);
    public function pesquisarPorTipo($tipo);

    public function atualizarNomePorPK($nome,$id);
    public function atualizarPermissaoPorPK($permissao,$id);
    public function atualizarValorPorPK($valor,$id);
    public function atualizarTipoPorPK($tipo,$id);

}


?>




