<?php

/**
*
* VersaoBusiness - Interface dos métodos de negócio para classe Versao
* Camada de negócio Versao - camada responsável pela lógica de negócios de Versao do sistema. 
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
* @since 06/10/2019 15:59:51
*
*/


// importar dependências
require_once '../interfaces/BusinessObject.php';

interface VersaoBusiness extends BusinessObject
{
    public function atualizarStatus($daofactory, $id, $status);
    public function listarVersaoPorStatus($daofactory, $status, $pag, $qtde, $coluna, $ordem);
    public function validarTamanhoCampo($campo, $tamanho, $coment);
    public function listarVersaoPorUsuaIdStatus($daofactory, $usuaid, $status, $pag, $qtde, $coluna, $ordem);
    public function PesquisarMaxPKAtivoVersaoPorStatus($daofactory, $versao, $status);
    public function PesquisarMaxPKAtivoVersao($daofactory, $versao);
    public function PesquisarMaxPK($daofactory);
    public function pesquisarPorVersao($daofactory, $versao);
    public function atualizarVersaoPorPK($daofactory,$versao,$id);

}

?>
