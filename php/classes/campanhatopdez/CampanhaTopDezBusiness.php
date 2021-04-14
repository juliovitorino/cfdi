<?php

/**
*
* CampanhaTopDezBusiness - Interface dos métodos de negócio para classe CampanhaTopDez
* Camada de negócio CampanhaTopDez - camada responsável pela lógica de negócios de CampanhaTopDez do sistema. 
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
* @since 19/09/2019 08:36:54
*
*/


// importar dependências
require_once '../interfaces/BusinessObject.php';

interface CampanhaTopDezBusiness extends BusinessObject
{
    public function atualizarStatus($daofactory, $id, $status);
    public function listarCampanhaTopDezPorStatus($daofactory, $status, $pag, $qtde, $coluna, $ordem);
    public function validarTamanhoCampo($campo, $tamanho, $coment);
    public function listarCampanhaTopDezPorUsuaIdStatus($daofactory, $usuaid, $status, $pag, $qtde, $coluna, $ordem);
    public function incParticipacaoCampanha($daofactory, $usuaid, $camp_id);
    public function PesquisarMaxPKAtivoCampIdUsuaIdPorStatus($daofactory, $usuaid, $camp_id, $status);
    public function PesquisarMaxPKAtivoId_CampanhaPorStatus($daofactory, $id_campanha, $status);

    public function pesquisarPorId_Campanha($daofactory, $id_campanha);
    public function pesquisarPorId_Usuario($daofactory, $id_usuario);
    public function pesquisarPorQtde($daofactory, $qtde);

    public function atualizarId_CampanhaPorPK($daofactory,$id_campanha,$id);
    public function atualizarId_UsuarioPorPK($daofactory,$id_usuario,$id);
    public function atualizarQtdePorPK($daofactory,$qtde,$id);

}

?>
