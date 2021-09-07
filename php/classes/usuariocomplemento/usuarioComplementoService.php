<?php
/**
*
* UsuarioComplementoService - Interfaces dos servicos para Classe de negócio com métodos para apoiar a integridade de informações sobre relação usuario complemento gerenciado pela plataforma
* Interface de Serviços UsuarioComplemento - camada responsável pela lógica de negócios de UsuarioComplemento do sistema. 
* Não é uma camada visível para outros dispositivos, como as camadas de apresentação e aplicação. 
*
* Por exemplo: quando estamos prestes a sacar dinheiro em um caixa eletrônico, 
* a condição primordial para isto acontecer é que exista saldo na sua conta. 
* Ou seja, é a camada que contém a lógica de como o sistema trabalha 
* como o negócio transcorre.
*
* Responsabilidades dessa classe
*
* 1) Abrir um contexto transacional com a fábrica de banco de dados
* 2) Abrir uma comunicação com as classes de negócio (Business classes)
* 3) Receber o retorno e decidir sobre o commit() ou rollback()
*
* Changelog:
*
*
* 
* @autor Julio Cesar Vitorino
* @since 07/09/2021 10:21:34
*
*/

// importar dependências

require_once '../interfaces/AppService.php';

interface UsuarioComplementoService extends AppService
{

    public function autalizarStatusUsuarioComplemento($id, $status);
    public function listarUsuarioComplementoPorStatus($status='A', $pag=1, $qtde=0, $coluna=1, $ordem=0);
    public function listarUsuarioComplementoPorUsuaIdStatus($usuaid, $status='A', $pag=1, $qtde=0, $coluna=1, $ordem=0);
    public function cancelar($dto);
    public function pesquisarMaxPKAtivoIdusuarioPorStatus($idUsuario,$status);

    public function pesquisarPorIdusuario($idUsuario);
    public function pesquisarPorDdd($ddd);
    public function pesquisarPorTelefone($telefone);
    public function pesquisarPorNomereceitafederal($nomeReceitaFederal);
    public function pesquisarPorNomeresponsavel($nomeResponsavel);
    public function pesquisarPorUrlsite($urlsite);
    public function pesquisarPorUrlfacebook($urlFacebook);
    public function pesquisarPorUrlinstagram($urlInstagram);
    public function pesquisarPorUrlpinterest($urlPinterest);
    public function pesquisarPorUrlskype($urlSkype);
    public function pesquisarPorUrltwitter($urlTwitter);
    public function pesquisarPorUrlfacetime($urlFacetime);
    public function pesquisarPorUrlresponsavel($urlResponsavel);
    public function pesquisarPorUrlfoto2($urlFoto2);
    public function pesquisarPorUrlfoto3($urlFoto3);
    public function pesquisarPorDesclivre($descLivre);

    public function atualizarIdusuarioPorPK($idUsuario,$id);
    public function atualizarDddPorPK($ddd,$id);
    public function atualizarTelefonePorPK($telefone,$id);
    public function atualizarNomereceitafederalPorPK($nomeReceitaFederal,$id);
    public function atualizarNomeresponsavelPorPK($nomeResponsavel,$id);
    public function atualizarUrlsitePorPK($urlsite,$id);
    public function atualizarUrlfacebookPorPK($urlFacebook,$id);
    public function atualizarUrlinstagramPorPK($urlInstagram,$id);
    public function atualizarUrlpinterestPorPK($urlPinterest,$id);
    public function atualizarUrlskypePorPK($urlSkype,$id);
    public function atualizarUrltwitterPorPK($urlTwitter,$id);
    public function atualizarUrlfacetimePorPK($urlFacetime,$id);
    public function atualizarUrlresponsavelPorPK($urlResponsavel,$id);
    public function atualizarUrlfoto2PorPK($urlFoto2,$id);
    public function atualizarUrlfoto3PorPK($urlFoto3,$id);
    public function atualizarDesclivrePorPK($descLivre,$id);

}


?>
