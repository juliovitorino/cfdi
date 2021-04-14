<?php

require_once '../interfaces/DAO.php';

/**
*
* UsuarioNotificacaoDAO - Interface dos métodos de acesso aos dados da tabela USUARIO_NOTIFICACAO
* Camada de dados UsuarioNotificacao - camada responsável SOMENTE pela acesso aos dados do sistema. 
* Não é uma camada visível para outros dispositivos, como as camadas de apresentação e aplicação. 
*
* Changelog:
* 
* @autor Julio Cesar Vitorino
* @since 25/08/2019 16:16:12
*
*/

interface UsuarioNotificacaoDAO extends DAO
{
    public function updateStatus($id, $status);
    public function listUsuarioNotificacaoStatus($status);
    public function countUsuarioNotificacaoPorStatus($status);
    public function listUsuarioNotificacaoPorStatus($status, $pag, $qtde, $coluna, $ordem);
    public function countUsuarioNotificacaoPorUsuaIdStatus($usuaid, $status);
    public function listUsuarioNotificacaoPorUsuaIdStatus($usuaid, $status, $pag, $qtde, $coluna, $ordem);
}
?>
