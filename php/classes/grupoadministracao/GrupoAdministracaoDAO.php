<?php

require_once '../interfaces/DAO.php';

/**
*
* GrupoAdministracaoDAO - Interface dos métodos de acesso aos dados da tabela SEGLOG_GRUPO_ADMINISTRACAO
* Camada de dados GrupoAdministracao - camada responsável SOMENTE pela acesso aos dados do sistema. 
* Não é uma camada visível para outros dispositivos, como as camadas de apresentação e aplicação. 
*
* Changelog:
* 
* @autor Julio Cesar Vitorino
* @since 20/08/2021 15:50:27
*
*/

interface GrupoAdministracaoDAO extends DAO
{
    public function updateStatus($id, $status);
    public function listGrupoAdministracaoStatus($status);
    public function countGrupoAdministracaoPorStatus($status);
    public function listGrupoAdministracaoPorStatus($status, $pag, $qtde, $coluna, $ordem);
    public function countGrupoAdministracaoPorUsuaIdStatus($usuaid, $status);
    public function listGrupoAdministracaoPorUsuaIdStatus($usuaid, $status, $pag, $qtde, $coluna, $ordem);

    public function loadMaxDescricaoPK($descricao,$status);

    public function loadDescricao($descricao);
    public function loadStatus($status);
    public function loadDatacadastro($dataCadastro);
    public function loadDataatualizacao($dataAtualizacao);

    public function updateDescricao($id, $descricao);
//    public function updateStatus($id, $status);

}
?>
