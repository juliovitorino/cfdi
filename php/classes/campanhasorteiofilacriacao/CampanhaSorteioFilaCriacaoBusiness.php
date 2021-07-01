<?php

/**
*
* CampanhaSorteioFilaCriacaoBusiness - Interface dos métodos de negócio para classe CampanhaSorteioFilaCriacao
* Camada de negócio CampanhaSorteioFilaCriacao - camada responsável pela lógica de negócios de CampanhaSorteioFilaCriacao do sistema. 
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
* @since 17/06/2021 08:10:22
*
*/


// importar dependências
require_once '../interfaces/BusinessObject.php';

interface CampanhaSorteioFilaCriacaoBusiness extends BusinessObject
{
    public function atualizarStatus($daofactory, $id, $status);
    public function listarCampanhaSorteioFilaCriacaoPorStatus($daofactory, $status, $pag, $qtde, $coluna, $ordem);
    public function validarTamanhoCampo($campo, $tamanho, $coment);
    public function listarCampanhaSorteioFilaCriacaoPorUsuaIdStatus($daofactory, $usuaid, $status, $pag, $qtde, $coluna, $ordem);

    public function pesquisarMaxPKAtivoId_CasoPorStatus($daofactory, $id_caso, $status);

    public function pesquisarPorId_Caso($daofactory, $id_caso);
    public function pesquisarPorQtloteticketcriar($daofactory, $qtLoteTicketCriar);
    //public function pesquisarPorStatus($daofactory, $status);

    public function atualizarId_CasoPorPK($daofactory,$id_caso,$id);
    public function atualizarQtloteticketcriarPorPK($daofactory,$qtLoteTicketCriar,$id);
    //public function atualizarStatusPorPK($daofactory,$status,$id);

}

?>
