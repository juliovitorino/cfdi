<?php

require_once '../interfaces/DAO.php';

/**
*
* FuncoesAdministrativasDAO - Interface dos métodos de acesso aos dados da tabela SEGLOG_FUNCOES_ADMINISTRATIVAS
* Camada de dados FuncoesAdministrativas - camada responsável SOMENTE pela acesso aos dados do sistema. 
* Não é uma camada visível para outros dispositivos, como as camadas de apresentação e aplicação. 
*
* Changelog:
* 
* @autor Julio Cesar Vitorino
* @since 20/08/2021 15:09:15
*
*/

interface FuncoesAdministrativasDAO extends DAO
{
    public function updateStatus($id, $status);
    public function listFuncoesAdministrativasStatus($status);
    public function countFuncoesAdministrativasPorStatus($status);
    public function listFuncoesAdministrativasPorStatus($status, $pag, $qtde, $coluna, $ordem);
    public function countFuncoesAdministrativasPorUsuaIdStatus($usuaid, $status);
    public function listFuncoesAdministrativasPorUsuaIdStatus($usuaid, $status, $pag, $qtde, $coluna, $ordem);

    public function loadMaxDescricaoPK($descricao,$status);

    public function loadDescricao($descricao);
    public function loadStatus($status);
    public function loadDatacadastro($dataCadastro);
    public function loadDataatualizacao($dataAtualizacao);

    public function updateDescricao($id, $descricao);

}
?>
