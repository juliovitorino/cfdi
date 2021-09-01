

<?php
/**
*
* FilaEmailService - Interfaces dos servicos para Classe de negócio com métodos para apoiar a integridade de informações sobre fila de email gerenciado pela plataforma
* Interface de Serviços FilaEmail - camada responsável pela lógica de negócios de FilaEmail do sistema. 
* Não é uma camada visível para outros dispositivos, como as camadas de apresentação e aplicação. 
*
* Por exemplo: quando estamos prestes a sacar dinheiro em um caixa eletrônico, 
* a condição primordial para isto acontecer é que exista saldo na sua conta. 
* Ou seja, é a camada que contém a lógica de como o sistema trabalha 
* como o negócio transcorre.
*
* Responsabilidades dessa classe
*
* 1) Abrir um contexto transacional com a fábrica de banco de dados
* 2) Abrir uma comunicação com as classes de negócio (Business classes)
* 3) Receber o retorno e decidir sobre o commit() ou rollback()
*
* Changelog:
*
*
* 
* @autor Julio Cesar Vitorino
* @since 01/09/2021 15:29:49
*
*/

// importar dependências

require_once '../interfaces/AppService.php';

interface FilaEmailService extends AppService
{

    public function autalizarStatusFilaEmail($id, $status);
    public function listarFilaEmailPorStatus($status='A', $pag=1, $qtde=0, $coluna=1, $ordem=0);
    public function listarFilaEmailPorUsuaIdStatus($usuaid, $status='A', $pag=1, $qtde=0, $coluna=1, $ordem=0);
    public function cancelar($dto);
    public function pesquisarMaxPKAtivoNomefilaPorStatus($nomeFila,$status);

    public function pesquisarPorNomefila($nomeFila);
    public function pesquisarPorEmailde($emailDe);
    public function pesquisarPorEmailpara($emailPara);
    public function pesquisarPorAssunto($assunto);
    public function pesquisarPorPrioridade($prioridade);
    public function pesquisarPorTemplate($template);
    public function pesquisarPorNrmaxtentativas($nrMaxTentativas);
    public function pesquisarPorNrrealtentativas($nrRealTentativas);
    public function pesquisarPorDataprevisaoenvio($dataPrevisaoEnvio);
    public function pesquisarPorDatarealenvio($dataRealEnvio);

    public function atualizarNomefilaPorPK($nomeFila,$id);
    public function atualizarEmaildePorPK($emailDe,$id);
    public function atualizarEmailparaPorPK($emailPara,$id);
    public function atualizarAssuntoPorPK($assunto,$id);
    public function atualizarPrioridadePorPK($prioridade,$id);
    public function atualizarTemplatePorPK($template,$id);
    public function atualizarNrmaxtentativasPorPK($nrMaxTentativas,$id);
    public function atualizarNrrealtentativasPorPK($nrRealTentativas,$id);
    public function atualizarDataprevisaoenvioPorPK($dataPrevisaoEnvio,$id);
    public function atualizarDatarealenvioPorPK($dataRealEnvio,$id);

}


?>

