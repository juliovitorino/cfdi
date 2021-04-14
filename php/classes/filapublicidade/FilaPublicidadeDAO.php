<?php

require_once '../interfaces/DAO.php';

/**
*
* FilaPublicidadeDAO - Interface dos métodos de acesso aos dados da tabela FILA_PUBLICIDADE
* Camada de dados FilaPublicidade - camada responsável SOMENTE pela acesso aos dados do sistema. 
* Não é uma camada visível para outros dispositivos, como as camadas de apresentação e aplicação. 
*
* Changelog:
* 
* @autor Julio Cesar Vitorino
* @since 19/09/2019 15:31:07
*
*/

interface FilaPublicidadeDAO extends DAO
{
    public function updateStatus($id, $status);
    public function listFilaPublicidadeStatus($status);
    public function countFilaPublicidadePorStatus($status);
    public function listFilaPublicidadePorStatus($status, $pag, $qtde, $coluna, $ordem);
    public function countFilaPublicidadePorUsuaIdStatus($usuaid, $status);
    public function listFilaPublicidadePorUsuaIdStatus($usuaid, $status, $pag, $qtde, $coluna, $ordem);

    public function loadMaxId_Usua_PublicPK($id_usua_public,$status);

    public function loadId_Usua_Public($id_usua_public);
    public function loadId_Usuario($id_usuario);
    public function loadId_Job($id_job);
    public function loadStatus($status);
    public function loadDatacadastro($dataCadastro);
    public function loadDataatualizacao($dataAtualizacao);

    public function updateId_Usua_Public($id, $id_usua_public);
    public function updateId_Usuario($id, $id_usuario);
    public function updateId_Job($id, $id_job);

}
?>
