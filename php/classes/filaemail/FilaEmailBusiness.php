<?php

/**
*
* FilaEmailBusiness - Interface dos métodos de negócio para classe FilaEmail
* Camada de negócio FilaEmail - camada responsável pela lógica de negócios de FilaEmail do sistema. 
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
* @since 01/09/2021 15:29:49
*
*/


// importar dependências
require_once '../interfaces/BusinessObject.php';

interface FilaEmailBusiness extends BusinessObject
{
    public function atualizarStatus($daofactory, $id, $status);
    public function listarFilaEmailPorStatus($daofactory, $status, $pag, $qtde, $coluna, $ordem);
    public function validarTamanhoCampo($campo, $tamanho, $coment);
    public function listarFilaEmailPorUsuaIdStatus($daofactory, $usuaid, $status, $pag, $qtde, $coluna, $ordem);
    public function inserirFilaEmail($daofactory, $dto);
    public function pesquisarMaxPKAtivoNomefilaPorStatus($daofactory, $nomeFila, $status);

    public function pesquisarPorNomefila($daofactory, $nomeFila);
    public function pesquisarPorEmailde($daofactory, $emailDe);
    public function pesquisarPorEmailpara($daofactory, $emailPara);
    public function pesquisarPorAssunto($daofactory, $assunto);
    public function pesquisarPorPrioridade($daofactory, $prioridade);
    public function pesquisarPorTemplate($daofactory, $template);
    public function pesquisarPorNrmaxtentativas($daofactory, $nrMaxTentativas);
    public function pesquisarPorNrrealtentativas($daofactory, $nrRealTentativas);
    public function pesquisarPorDataprevisaoenvio($daofactory, $dataPrevisaoEnvio);
    public function pesquisarPorDatarealenvio($daofactory, $dataRealEnvio);

    public function atualizarNomefilaPorPK($daofactory,$nomeFila,$id);
    public function atualizarEmaildePorPK($daofactory,$emailDe,$id);
    public function atualizarEmailparaPorPK($daofactory,$emailPara,$id);
    public function atualizarAssuntoPorPK($daofactory,$assunto,$id);
    public function atualizarPrioridadePorPK($daofactory,$prioridade,$id);
    public function atualizarTemplatePorPK($daofactory,$template,$id);
    public function atualizarNrmaxtentativasPorPK($daofactory,$nrMaxTentativas,$id);
    public function atualizarNrrealtentativasPorPK($daofactory,$nrRealTentativas,$id);
    public function atualizarDataprevisaoenvioPorPK($daofactory,$dataPrevisaoEnvio,$id);
    public function atualizarDatarealenvioPorPK($daofactory,$dataRealEnvio,$id);

}

?>




