<?php

require_once '../interfaces/DAO.php';

/**
*
* SeloCuringaDAO - Interface dos métodos de acesso aos dados da tabela QRCODES_CURINGA
* Camada de dados SeloCuringa - camada responsável SOMENTE pela acesso aos dados do sistema. 
* Não é uma camada visível para outros dispositivos, como as camadas de apresentação e aplicação. 
*
* Changelog:
* 
* @autor Julio Cesar Vitorino
* @since 23/08/2019 11:13:11
*
*/

interface SeloCuringaDAO extends DAO
{
    public function updateStatus($id, $status);
    public function listSeloCuringaStatus($status);
    public function countSeloCuringaPorStatus($status);
    public function listSeloCuringaPorStatus($status, $pag, $qtde, $coluna, $ordem);
}
?>
