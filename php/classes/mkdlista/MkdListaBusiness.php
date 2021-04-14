<?php

/**
*
* MkdListaBusiness - Interface dos métodos de negócio para classe MkdLista
* Camada de negócio MkdLista - camada responsável pela lógica de negócios de MkdLista do sistema. 
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
* @since 04/11/2019 09:31:13
*
*/


// importar dependências
require_once '../interfaces/BusinessObject.php';

interface MkdListaBusiness extends BusinessObject
{
    public function ativarNovoLead($daofactory, $token);
    public function atualizarStatus($daofactory, $id, $status);
    public function listarMkdListaPorStatus($daofactory, $status, $pag, $qtde, $coluna, $ordem);
    public function validarTamanhoCampo($campo, $tamanho, $coment);
    public function listarMkdListaPorUsuaIdStatus($daofactory, $usuaid, $status, $pag, $qtde, $coluna, $ordem);

    public function pesquisarMaxPKAtivoId_Mkd_CampanhaPorStatus($daofactory, $id_mkd_campanha, $status);

    public function pesquisarPorId_Mkd_Campanha($daofactory, $id_mkd_campanha);
    public function pesquisarPorNome($daofactory, $nome);
    public function pesquisarPorEmail($daofactory, $email);
    public function pesquisarPorPrimeironome($daofactory, $primeiroNome);
    public function pesquisarPorSobrenome($daofactory, $sobrenome);
    public function pesquisarPorWhatsapp($daofactory, $whatsapp);
    public function pesquisarPorHashlead($daofactory, $hashlead);

    public function atualizarId_Mkd_CampanhaPorPK($daofactory,$id_mkd_campanha,$id);
    public function atualizarNomePorPK($daofactory,$nome,$id);
    public function atualizarEmailPorPK($daofactory,$email,$id);
    public function atualizarPrimeironomePorPK($daofactory,$primeiroNome,$id);
    public function atualizarSobrenomePorPK($daofactory,$sobrenome,$id);
    public function atualizarWhatsappPorPK($daofactory,$whatsapp,$id);
    public function atualizarHashleadPorPK($daofactory,$hashlead,$id);

}

?>




