<?php

require_once '../interfaces/DAO.php';

/**
*
* PlanoDAO - Interface dos métodos de acesso aos dados da tabela PLANOS
* Camada de dados Plano - camada responsável SOMENTE pela acesso aos dados do sistema. 
* Não é uma camada visível para outros dispositivos, como as camadas de apresentação e aplicação. 
*
* Changelog:
* 
* @autor Julio Cesar Vitorino
* @since 08/09/2021 14:15:34
*
*/

interface PlanoDAO extends DAO
{
    public function updateStatus($id, $status);
    public function listPlanoStatus($status);
    public function countPlanoPorStatus($status);
    public function listPlanoPorStatus($status, $pag, $qtde, $coluna, $ordem);
    public function countPlanoPorStatusTipo($status, $tipo);
    public function listPlanoPorStatusTipo($status, $tipo, $pag, $qtde, $coluna, $ordem);
    public function countPlanoPorUsuaIdStatus($usuaid, $status);
    public function listPlanoPorUsuaIdStatus($usuaid, $status, $pag, $qtde, $coluna, $ordem);

    public function loadMaxNomePK($nome,$status);

    public function loadNome($nome);
    public function loadPermissao($permissao);
    public function loadValor($valor);
    public function loadTipo($tipo);
    public function loadStatus($status);
    public function loadDatacadastro($dataCadastro);
    public function loadDataatualizacao($dataAtualizacao);

    public function updateNome($id, $nome);
    public function updatePermissao($id, $permissao);
    public function updateValor($id, $valor);
    public function updateTipo($id, $tipo);

}
?>
