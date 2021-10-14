<?php

require_once '../interfaces/DAO.php';

/**
*
* RecursoDAO - Interface dos métodos de acesso aos dados da tabela RECURSO
* Camada de dados Recurso - camada responsável SOMENTE pela acesso aos dados do sistema. 
* Não é uma camada visível para outros dispositivos, como as camadas de apresentação e aplicação. 
*
* Changelog:
* 
* @autor Julio Cesar Vitorino
* @since 09/09/2021 08:00:49
*
*/

interface RecursoDAO extends DAO
{
    public function updateStatus($id, $status);
    public function listRecursoStatus($status);
    public function countRecursoPorStatus($status);
    public function listRecursoPorStatus($status, $pag, $qtde, $coluna, $ordem);
    public function countRecursoPorUsuaIdStatus($usuaid, $status);
    public function listRecursoPorUsuaIdStatus($usuaid, $status, $pag, $qtde, $coluna, $ordem);

    public function loadMaxDescricaoPK($descricao,$status);

    public function loadDescricao($descricao);
    public function loadStatus($status);
    public function loadDatacadastro($dataCadastro);
    public function loadDataatualizacao($dataAtualizacao);

    public function updateDescricao($id, $descricao);

}
?>

