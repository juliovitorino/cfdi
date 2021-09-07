<?php

require_once '../interfaces/DAO.php';

/**
*
* UsuarioComplementoDAO - Interface dos métodos de acesso aos dados da tabela USUARIO_COMPLEMENTO
* Camada de dados UsuarioComplemento - camada responsável SOMENTE pela acesso aos dados do sistema. 
* Não é uma camada visível para outros dispositivos, como as camadas de apresentação e aplicação. 
*
* Changelog:
* 
* @autor Julio Cesar Vitorino
* @since 07/09/2021 11:00:05
*
*/

interface UsuarioComplementoDAO extends DAO
{
    public function updateStatus($id, $status);
    public function listUsuarioComplementoStatus($status);
    public function countUsuarioComplementoPorStatus($status);
    public function listUsuarioComplementoPorStatus($status, $pag, $qtde, $coluna, $ordem);
    public function countUsuarioComplementoPorUsuaIdStatus($usuaid, $status);
    public function listUsuarioComplementoPorUsuaIdStatus($usuaid, $status, $pag, $qtde, $coluna, $ordem);

    public function loadMaxIdusuarioPK($idUsuario,$status);

    public function loadIdusuario($idUsuario);
    public function loadDdd($ddd);
    public function loadTelefone($telefone);
    public function loadNomereceitafederal($nomeReceitaFederal);
    public function loadNomeresponsavel($nomeResponsavel);
    public function loadUrlsite($urlsite);
    public function loadUrlfacebook($urlFacebook);
    public function loadUrlinstagram($urlInstagram);
    public function loadUrlpinterest($urlPinterest);
    public function loadUrlskype($urlSkype);
    public function loadUrltwitter($urlTwitter);
    public function loadUrlfacetime($urlFacetime);
    public function loadUrlresponsavel($urlResponsavel);
    public function loadUrlfoto2($urlFoto2);
    public function loadUrlfoto3($urlFoto3);
    public function loadDesclivre($descLivre);
    public function loadStatus($status);
    public function loadDatacadastro($dataCadastro);
    public function loadDataatualizacao($dataAtualizacao);

    public function updateIdusuario($id, $idUsuario);
    public function updateDdd($id, $ddd);
    public function updateTelefone($id, $telefone);
    public function updateNomereceitafederal($id, $nomeReceitaFederal);
    public function updateNomeresponsavel($id, $nomeResponsavel);
    public function updateUrlsite($id, $urlsite);
    public function updateUrlfacebook($id, $urlFacebook);
    public function updateUrlinstagram($id, $urlInstagram);
    public function updateUrlpinterest($id, $urlPinterest);
    public function updateUrlskype($id, $urlSkype);
    public function updateUrltwitter($id, $urlTwitter);
    public function updateUrlfacetime($id, $urlFacetime);
    public function updateUrlresponsavel($id, $urlResponsavel);
    public function updateUrlfoto2($id, $urlFoto2);
    public function updateUrlfoto3($id, $urlFoto3);
    public function updateDesclivre($id, $descLivre);

}
?>
