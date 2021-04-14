<?php

/**
*
* UsuarioCashbackBusiness - Interface dos métodos de negócio para classe UsuarioCashback
* Camada de negócio UsuarioCashback - camada responsável pela lógica de negócios de UsuarioCashback do sistema. 
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
* @since 06/09/2019 08:43:34
*
*/


// importar dependências
require_once '../interfaces/BusinessObject.php';

interface UsuarioCashbackBusiness extends BusinessObject
{
    public function atualizarStatus($daofactory, $id, $status);
    public function listarUsuarioCashbackPorStatus($daofactory, $status, $pag, $qtde, $coluna, $ordem);
    public function validarTamanhoCampo($campo, $tamanho, $coment);
    public function listarUsuarioCashbackPorUsuaIdStatus($daofactory, $usuaid, $status, $pag, $qtde, $coluna, $ordem);

    public function PesquisarMaxPKAtivoId_UsuarioPorStatus($daofactory, $id_usuario, $status);

    public function pesquisarPorId_Usuario($daofactory, $id_usuario);
    public function pesquisarPorVlminimoresgate($daofactory, $vlMinimoResgate);
    public function pesquisarPorPercentual($daofactory, $percentual);
    public function pesquisarPorObs($daofactory, $obs);
    public function pesquisarPorContadorstar_1($daofactory, $contadorStar_1);
    public function pesquisarPorContadorstar_2($daofactory, $contadorStar_2);
    public function pesquisarPorContadorstar_3($daofactory, $contadorStar_3);
    public function pesquisarPorContadorstar_4($daofactory, $contadorStar_4);
    public function pesquisarPorContadorstar_5($daofactory, $contadorStar_5);
    public function pesquisarPorRatingcalculado($daofactory, $ratingCalculado);

    public function atualizarId_UsuarioPorPK($daofactory,$id_usuario,$id);
    public function atualizarVlminimoresgatePorPK($daofactory,$vlMinimoResgate,$id);
    public function atualizarPercentualPorPK($daofactory,$percentual,$id);
    public function atualizarObsPorPK($daofactory,$obs,$id);
    public function atualizarContadorstar_1PorPK($daofactory,$contadorStar_1,$id);
    public function atualizarContadorstar_2PorPK($daofactory,$contadorStar_2,$id);
    public function atualizarContadorstar_3PorPK($daofactory,$contadorStar_3,$id);
    public function atualizarContadorstar_4PorPK($daofactory,$contadorStar_4,$id);
    public function atualizarContadorstar_5PorPK($daofactory,$contadorStar_5,$id);
    public function atualizarRatingcalculadoPorPK($daofactory,$ratingCalculado,$id);

}

?>




