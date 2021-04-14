<?php

/**
*
* FilaQRCodePendenteProduzirBusiness - Interface dos métodos de negócio para classe FilaQRCodePendenteProduzir
* Camada de negócio FilaQRCodePendenteProduzir - camada responsável pela lógica de negócios de FilaQRCodePendenteProduzir do sistema. 
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
* @since 26/10/2019 10:27:47
*
*/


// importar dependências
require_once '../interfaces/BusinessObject.php';

interface FilaQRCodePendenteProduzirBusiness extends BusinessObject
{
    public function atualizarStatus($daofactory, $id, $status);
    public function listarFilaQRCodePendenteProduzirPorStatus($daofactory, $status, $pag, $qtde, $coluna, $ordem);
    public function validarTamanhoCampo($campo, $tamanho, $coment);
    public function listarFilaQRCodePendenteProduzirPorUsuaIdStatus($daofactory, $usuaid, $status, $pag, $qtde, $coluna, $ordem);

    public function pesquisarMaxPKAtivoId_CampanhaPorStatus($daofactory, $id_campanha, $status);


    public function pesquisarPorId_Campanha($daofactory, $id_campanha);
    public function pesquisarPorId_Usuario($daofactory, $id_usuario);
    public function pesquisarPorQtde($daofactory, $qtde);

    public function atualizarId_CampanhaPorPK($daofactory,$id_campanha,$id);
    public function atualizarId_UsuarioPorPK($daofactory,$id_usuario,$id);
    public function atualizarQtdePorPK($daofactory,$qtde,$id);

}

?>
