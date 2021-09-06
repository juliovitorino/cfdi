<?php

/**
*
* TipoEmpreendimentoBusiness - Interface dos métodos de negócio para classe TipoEmpreendimento
* Camada de negócio TipoEmpreendimento - camada responsável pela lógica de negócios de TipoEmpreendimento do sistema. 
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
* @since 06/09/2021 08:28:01
*
*/


// importar dependências
require_once '../interfaces/BusinessObject.php';

interface TipoEmpreendimentoBusiness extends BusinessObject
{
    public function atualizarStatus($daofactory, $id, $status);
    public function listarTipoEmpreendimentoPorStatus($daofactory, $status,  $pag=1, $qtde=0, $coluna=1, $ordem=0);
    public function validarTamanhoCampo($campo, $tamanho, $coment);
    public function listarTipoEmpreendimentoPorUsuaIdStatus($daofactory, $usuaid, $status,  $pag=1, $qtde=0, $coluna=1, $ordem=0);
    public function inserirTipoEmpreendimento($daofactory, $dto);
    public function pesquisarMaxPKAtivoDescricaoPorStatus($daofactory, $descricao, $status);

    public function pesquisarPorDescricao($daofactory, $descricao);
    public function pesquisarPorUrlimg($daofactory, $urlimg);

    public function atualizarDescricaoPorPK($daofactory,$descricao,$id);
    public function atualizarUrlimgPorPK($daofactory,$urlimg,$id);

}

?>
