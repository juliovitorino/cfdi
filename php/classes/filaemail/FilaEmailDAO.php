<?php

require_once '../interfaces/DAO.php';

/**
*
* FilaEmailDAO - Interface dos métodos de acesso aos dados da tabela FILA_EMAIL
* Camada de dados FilaEmail - camada responsável SOMENTE pela acesso aos dados do sistema. 
* Não é uma camada visível para outros dispositivos, como as camadas de apresentação e aplicação. 
*
* Changelog:
* 
* @autor Julio Cesar Vitorino
* @since 01/09/2021 15:29:49
*
*/

interface FilaEmailDAO extends DAO
{
    public function updateStatus($id, $status);
    public function listFilaEmailStatus($status);
    public function countFilaEmailPorStatus($status);
    public function listFilaEmailPorStatus($status, $pag, $qtde, $coluna, $ordem);
    public function countFilaEmailPorUsuaIdStatus($usuaid, $status);
    public function listFilaEmailPorUsuaIdStatus($usuaid, $status, $pag, $qtde, $coluna, $ordem);

    public function loadMaxNomefilaPK($nomeFila,$status);

    public function loadNomefila($nomeFila);
    public function loadEmailde($emailDe);
    public function loadEmailpara($emailPara);
    public function loadAssunto($assunto);
    public function loadPrioridade($prioridade);
    public function loadTemplate($template);
    public function loadNrmaxtentativas($nrMaxTentativas);
    public function loadNrrealtentativas($nrRealTentativas);
    public function loadDataprevisaoenvio($dataPrevisaoEnvio);
    public function loadDatarealenvio($dataRealEnvio);
    public function loadStatus($status);
    public function loadDatacadastro($dataCadastro);
    public function loadDataatualizacao($dataAtualizacao);

    public function updateNomefila($id, $nomeFila);
    public function updateEmailde($id, $emailDe);
    public function updateEmailpara($id, $emailPara);
    public function updateAssunto($id, $assunto);
    public function updatePrioridade($id, $prioridade);
    public function updateTemplate($id, $template);
    public function updateNrmaxtentativas($id, $nrMaxTentativas);
    public function updateNrrealtentativas($id, $nrRealTentativas);
    public function updateDataprevisaoenvio($id, $dataPrevisaoEnvio);
    public function updateDatarealenvio($id, $dataRealEnvio);

}
?>

