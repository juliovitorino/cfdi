<?php

require_once '../interfaces/DAO.php';

/**
*
* UsuarioCampanhaSorteioDAO - Interface dos métodos de acesso aos dados da tabela USUARIO_CAMPANHA_SORTEIO
* Camada de dados UsuarioCampanhaSorteio - camada responsável SOMENTE pela acesso aos dados do sistema. 
* Não é uma camada visível para outros dispositivos, como as camadas de apresentação e aplicação. 
*
* Changelog:
* 
* @autor Julio Cesar Vitorino
* @since 22/06/2021 08:05:45
*
*/

interface UsuarioCampanhaSorteioDAO extends DAO
{
    public function updateStatus($id, $status);
    public function listUsuarioCampanhaSorteioStatus($status);
    public function countUsuarioCampanhaSorteioPorStatus($status);
    public function listUsuarioCampanhaSorteioPorStatus($status, $pag, $qtde, $coluna, $ordem);
    public function countUsuarioCampanhaSorteioPorUsuaIdStatus($usuaid, $status);
    public function listUsuarioCampanhaSorteioPorUsuaIdStatus($usuaid, $status, $pag, $qtde, $coluna, $ordem);

    public function loadMaxIdusuarioPK($idUsuario,$status);
    public function loadMaxIdusuarioIdcampanhaPK($idUsuario,$idCampanhaSorteio,$status);

    public function loadIdusuario($idUsuario);
    public function loadIdcampanhasorteio($idCampanhaSorteio);
    public function loadStatus($status);
    public function loadDatacadastro($dataCadastro);
    public function loadDataatualizacao($dataAtualizacao);

    public function updateIdusuario($id, $idUsuario);
    public function updateIdcampanhasorteio($id, $idCampanhaSorteio);
    //public function updateStatus($id, $status);

}
?>
