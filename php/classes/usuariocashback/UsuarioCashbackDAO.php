<?php

require_once '../interfaces/DAO.php';

/**
*
* UsuarioCashbackDAO - Interface dos métodos de acesso aos dados da tabela USUARIO_CASHBACK
* Camada de dados UsuarioCashback - camada responsável SOMENTE pela acesso aos dados do sistema. 
* Não é uma camada visível para outros dispositivos, como as camadas de apresentação e aplicação. 
*
* Changelog:
* 
* @autor Julio Cesar Vitorino
* @since 06/09/2019 08:43:34
*
*/

interface UsuarioCashbackDAO extends DAO
{
    public function updateStatus($id, $status);
    public function listUsuarioCashbackStatus($status);
    public function countUsuarioCashbackPorStatus($status);
    public function listUsuarioCashbackPorStatus($status, $pag, $qtde, $coluna, $ordem);
    public function countUsuarioCashbackPorUsuaIdStatus($usuaid, $status);
    public function listUsuarioCashbackPorUsuaIdStatus($usuaid, $status, $pag, $qtde, $coluna, $ordem);

    public function loadMaxId_UsuarioPK($id_usuario,$status);

    public function loadId_Usuario($id_usuario);
    public function loadVlminimoresgate($vlMinimoResgate);
    public function loadPercentual($percentual);
    public function loadObs($obs);
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
    public function updateVlminimoresgate($id, $vlMinimoResgate);
    public function updatePercentual($id, $percentual);
    public function updateObs($id, $obs);
    public function updateContadorstar_1($id, $contadorStar_1);
    public function updateContadorstar_2($id, $contadorStar_2);
    public function updateContadorstar_3($id, $contadorStar_3);
    public function updateContadorstar_4($id, $contadorStar_4);
    public function updateContadorstar_5($id, $contadorStar_5);
    public function updateRatingcalculado($id, $ratingCalculado);


}
?>
