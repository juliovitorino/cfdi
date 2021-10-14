<?php

require_once '../interfaces/DAO.php';

/**
*
* UsuarioTipoEmpreendimentoDAO - Interface dos métodos de acesso aos dados da tabela USUARIO_TIPO_EMPREENDIMENTO
* Camada de dados UsuarioTipoEmpreendimento - camada responsável SOMENTE pela acesso aos dados do sistema. 
* Não é uma camada visível para outros dispositivos, como as camadas de apresentação e aplicação. 
*
* Changelog:
* 
* @autor Julio Cesar Vitorino
* @since 06/09/2021 09:56:34
*
*/

interface UsuarioTipoEmpreendimentoDAO extends DAO
{
    public function updateStatus($id, $status);
    public function listUsuarioTipoEmpreendimentoStatus($status);
    public function countUsuarioTipoEmpreendimentoPorStatus($status);
    public function listUsuarioTipoEmpreendimentoPorStatus($status, $pag, $qtde, $coluna, $ordem);
    public function countUsuarioTipoEmpreendimentoPorUsuaIdStatus($usuaid, $status);
    public function listUsuarioTipoEmpreendimentoPorUsuaIdStatus($usuaid, $status, $pag, $qtde, $coluna, $ordem);

    public function loadMaxIdusuarioPK($idUsuario,$status);

    public function loadIdusuario($idUsuario);
    public function loadIdtipoempreendimento($idTipoEmpreendimento);
    public function loadStatus($status);
    public function loadDatacadastro($dataCadastro);
    public function loadDataatualizacao($dataAtualizacao);

    public function updateIdusuario($id, $idUsuario);
    public function updateIdtipoempreendimento($id, $idTipoEmpreendimento);

}
?>
