<?php

/**
*
* UsuarioCampanhaSorteioBusiness - Interface dos métodos de negócio para classe UsuarioCampanhaSorteio
* Camada de negócio UsuarioCampanhaSorteio - camada responsável pela lógica de negócios de UsuarioCampanhaSorteio do sistema. 
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
* @since 22/06/2021 08:05:45
*
*/

// importar dependências
require_once '../interfaces/BusinessObject.php';

interface UsuarioCampanhaSorteioBusiness extends BusinessObject
{
    public function inserirUsuarioParticipanteCampanhaSorteio($daofactory, $uscsdto);
    public function atualizarStatus($daofactory, $id, $status);
    public function listarUsuarioCampanhaSorteioPorStatus($daofactory, $status, $pag, $qtde, $coluna, $ordem);
    public function validarTamanhoCampo($campo, $tamanho, $coment);
    public function listarUsuarioCampanhaSorteioPorUsuaIdStatus($daofactory, $usuaid, $status, $pag, $qtde, $coluna, $ordem);

    public function pesquisarMaxPKAtivoIdusuarioPorStatus($daofactory, $idUsuario, $status);
    public function pesquisarMaxPKAtivoIdusuarioIdcampanhaPorStatus($daofactory, $idUsuario, $idCampanhaSorteio, $status);

    public function pesquisarPorIdusuario($daofactory, $idUsuario);
    public function pesquisarPorIdcampanhasorteio($daofactory, $idCampanhaSorteio);
    //public function pesquisarPorStatus($daofactory, $status);

    public function atualizarIdusuarioPorPK($daofactory,$idUsuario,$id);
    public function atualizarIdcampanhasorteioPorPK($daofactory,$idCampanhaSorteio,$id);
    //public function atualizarStatusPorPK($daofactory,$status,$id);

}

?>

