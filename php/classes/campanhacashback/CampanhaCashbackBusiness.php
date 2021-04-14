<?php

/**
*
* CampanhaCashbackBusiness - Interface dos métodos de negócio para classe CampanhaCashback
* Camada de negócio CampanhaCashback - camada responsável pela lógica de negócios de CampanhaCashback do sistema. 
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
* @since 26/08/2019 15:34:53
*
*/


// importar dependências
require_once '../interfaces/BusinessObject.php';

interface CampanhaCashbackBusiness extends BusinessObject
{
    public function atualizarStatus($daofactory, $id, $status);
    public function listarCampanhaCashbackPorStatus($daofactory, $status, $pag, $qtde, $coluna, $ordem);
    public function validarTamanhoCampo($campo, $tamanho, $coment);
    public function listarCampanhaCashbackPorUsuaIdStatus($daofactory, $usuaid, $status, $pag, $qtde, $coluna, $ordem);
    public function pesquisarPorId_CampanhaStatus($daofactory, $id_campanha, $status);
    public function PesquisarMaxPKAtivoId_UsuarioIdCampanhaPorStatus($daofactory, $id_usuario, $id_campanha, $status);

    public function pesquisarPorId_Campanha($daofactory, $id_campanha);
    public function pesquisarPorTitulo($daofactory, $titulo);
    public function pesquisarPorDescricao($daofactory, $descricao);
    public function pesquisarPorVlminimoresgate($daofactory, $vlMinimoResgate);
    public function pesquisarPorPercentual($daofactory, $percentual);
    public function pesquisarPorDatatermino($daofactory, $dataTermino);
    public function pesquisarPorObs($daofactory, $obs);
    
    public function atualizarId_CampanhaPorPK($daofactory,$id_campanha,$id);
    public function atualizarTituloPorPK($daofactory,$titulo,$id);
    public function atualizarDescricaoPorPK($daofactory,$descricao,$id);
    public function atualizarVlminimoresgatePorPK($daofactory,$vlMinimoResgate,$id);
    public function atualizarPercentualPorPK($daofactory,$percentual,$id);
    public function atualizarDataterminoPorPK($daofactory,$dataTermino,$id);
    public function atualizarObsPorPK($daofactory,$obs,$id);

}

?>
