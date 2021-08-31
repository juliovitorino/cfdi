<?php

/**
*
* ContatoBusiness - Interface dos métodos de negócio para classe Contato
* Camada de negócio Contato - camada responsável pela lógica de negócios de Contato do sistema. 
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
* @since 31/08/2021 08:17:22
*
*/

// importar dependências
require_once '../interfaces/BusinessObject.php';

interface ContatoBusiness extends BusinessObject
{
    public function atualizarStatus($daofactory, $id, $status);
    public function listarContatoPorStatus($daofactory, $status, $pag, $qtde, $coluna, $ordem);
    public function validarTamanhoCampo($campo, $tamanho, $coment);
    public function listarContatoPorUsuaIdStatus($daofactory, $usuaid, $status, $pag, $qtde, $coluna, $ordem);
    public function inserirContato($daofactory, $dto);
    public function pesquisarMaxPKAtivoNomePorStatus($daofactory, $nome, $status);

    public function pesquisarPorNome($daofactory, $nome);
    public function pesquisarPorEmail($daofactory, $email);
    public function pesquisarPorMensagem($daofactory, $mensagem);

    public function atualizarNomePorPK($daofactory,$nome,$id);
    public function atualizarEmailPorPK($daofactory,$email,$id);
    public function atualizarMensagemPorPK($daofactory,$mensagem,$id);

}

?>




