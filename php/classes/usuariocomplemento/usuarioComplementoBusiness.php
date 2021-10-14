<?php

/**
*
* UsuarioComplementoBusiness - Interface dos métodos de negócio para classe UsuarioComplemento
* Camada de negócio UsuarioComplemento - camada responsável pela lógica de negócios de UsuarioComplemento do sistema. 
* Não é uma camada visível para outros dispositivos, como as camadas de apresentação e aplicação. 
*
*
* Responsabilidades dessa classe
*
* 1) Receber o pedido de uma classe de negócio do sistema
* 2) Produzir a regra de negócio de acordo com cada método
* 3) Acessar o banco de dados através das interfaces DAOs
* 4) Verificar o resultado e retornar um objeto e uma mensagem de alto nível para a camada de serviço
*
* Changelog:
*
* 
* @autor Julio Cesar Vitorino
* @since 07/09/2021 10:47:36
*
*/


// importar dependências
require_once '../interfaces/BusinessObject.php';

interface UsuarioComplementoBusiness extends BusinessObject
{
    public function atualizarStatus($daofactory, $id, $status);
    public function listarUsuarioComplementoPorStatus($daofactory, $status,  $pag=1, $qtde=0, $coluna=1, $ordem=0);
    public function validarTamanhoCampo($campo, $tamanho, $coment);
    public function listarUsuarioComplementoPorUsuaIdStatus($daofactory, $usuaid, $status,  $pag=1, $qtde=0, $coluna=1, $ordem=0);
    public function inserirUsuarioComplemento($daofactory, $dto);
    public function pesquisarMaxPKAtivoIdusuarioPorStatus($daofactory, $idUsuario, $status);

    public function pesquisarPorIdusuario($daofactory, $idUsuario);
    public function pesquisarPorDdd($daofactory, $ddd);
    public function pesquisarPorTelefone($daofactory, $telefone);
    public function pesquisarPorNomereceitafederal($daofactory, $nomeReceitaFederal);
    public function pesquisarPorNomeresponsavel($daofactory, $nomeResponsavel);
    public function pesquisarPorUrlsite($daofactory, $urlsite);
    public function pesquisarPorUrlfacebook($daofactory, $urlFacebook);
    public function pesquisarPorUrlinstagram($daofactory, $urlInstagram);
    public function pesquisarPorUrlpinterest($daofactory, $urlPinterest);
    public function pesquisarPorUrlskype($daofactory, $urlSkype);
    public function pesquisarPorUrltwitter($daofactory, $urlTwitter);
    public function pesquisarPorUrlfacetime($daofactory, $urlFacetime);
    public function pesquisarPorUrlresponsavel($daofactory, $urlResponsavel);
    public function pesquisarPorUrlfoto2($daofactory, $urlFoto2);
    public function pesquisarPorUrlfoto3($daofactory, $urlFoto3);
    public function pesquisarPorDesclivre($daofactory, $descLivre);

    public function atualizarIdusuarioPorPK($daofactory,$idUsuario,$id);
    public function atualizarDddPorPK($daofactory,$ddd,$id);
    public function atualizarTelefonePorPK($daofactory,$telefone,$id);
    public function atualizarNomereceitafederalPorPK($daofactory,$nomeReceitaFederal,$id);
    public function atualizarNomeresponsavelPorPK($daofactory,$nomeResponsavel,$id);
    public function atualizarUrlsitePorPK($daofactory,$urlsite,$id);
    public function atualizarUrlfacebookPorPK($daofactory,$urlFacebook,$id);
    public function atualizarUrlinstagramPorPK($daofactory,$urlInstagram,$id);
    public function atualizarUrlpinterestPorPK($daofactory,$urlPinterest,$id);
    public function atualizarUrlskypePorPK($daofactory,$urlSkype,$id);
    public function atualizarUrltwitterPorPK($daofactory,$urlTwitter,$id);
    public function atualizarUrlfacetimePorPK($daofactory,$urlFacetime,$id);
    public function atualizarUrlresponsavelPorPK($daofactory,$urlResponsavel,$id);
    public function atualizarUrlfoto2PorPK($daofactory,$urlFoto2,$id);
    public function atualizarUrlfoto3PorPK($daofactory,$urlFoto3,$id);
    public function atualizarDesclivrePorPK($daofactory,$descLivre,$id);

}

?>




