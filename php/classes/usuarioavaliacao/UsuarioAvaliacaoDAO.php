<?php

require_once '../interfaces/DAO.php';

/**
*
* UsuarioAvaliacaoDAO - Interface dos métodos de acesso aos dados da tabela USUARIO_AVALIACAO
* Camada de dados UsuarioAvaliacao - camada responsável SOMENTE pela acesso aos dados do sistema. 
* Não é uma camada visível para outros dispositivos, como as camadas de apresentação e aplicação. 
*
* Changelog:
* 
* @autor Julio Cesar Vitorino
* @since 17/09/2019 09:22:19
*
*/

interface UsuarioAvaliacaoDAO extends DAO
{
    public function updateStatus($id, $status);
    public function listUsuarioAvaliacaoStatus($status);
    public function countUsuarioAvaliacaoPorStatus($status);
    public function listUsuarioAvaliacaoPorStatus($status, $pag, $qtde, $coluna, $ordem);
    public function countUsuarioAvaliacaoPorUsuaIdStatus($usuaid, $status);
    public function listUsuarioAvaliacaoPorUsuaIdStatus($usuaid, $status, $pag, $qtde, $coluna, $ordem);
    public function incUsuarioAvaliacao($usuaid, $rating);

    public function loadMaxId_UsuarioPK($id_usuario,$status);

    public function loadId_Usuario($id_usuario);
    public function loadContadorstar_1($contadorStar_1);
    public function loadContadorstar_2($contadorStar_2);
    public function loadContadorstar_3($contadorStar_3);
    public function loadContadorstar_4($contadorStar_4);
    public function loadContadorstar_5($contadorStar_5);
    public function loadRatingcalculado($ratingCalculado);
    public function loadStatus($status);
    public function loadDatacadastro($dataCadastro);
    public function loadDataatualizacao($dataAtualizacao);

    public function updateId_Usuario($id, $id_usuario);
    public function updateContadorstar_1($id, $contadorStar_1);
    public function updateContadorstar_2($id, $contadorStar_2);
    public function updateContadorstar_3($id, $contadorStar_3);
    public function updateContadorstar_4($id, $contadorStar_4);
    public function updateContadorstar_5($id, $contadorStar_5);
    public function updateRatingcalculado($id, $ratingCalculado);

}
?>
