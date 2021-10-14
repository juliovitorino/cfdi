<?php

require_once '../interfaces/DAO.php';

/**
*
* ContatoDAO - Interface dos métodos de acesso aos dados da tabela CONTATO
* Camada de dados Contato - camada responsável SOMENTE pela acesso aos dados do sistema. 
* Não é uma camada visível para outros dispositivos, como as camadas de apresentação e aplicação. 
*
* Changelog:
* 
* @autor Julio Cesar Vitorino
* @since 31/08/2021 08:17:22
*
*/

interface ContatoDAO extends DAO
{
    public function updateStatus($id, $status);
    public function listContatoStatus($status);
    
    //public function listContatoPorOrigemStatus($origem, $status);
    public function countContatoPorOrigemStatus($origem, $status);
    public function listContatoPorOrigemStatus($origem, $status, $pag, $qtde, $coluna, $ordem);

    public function countContatoPorStatus($status);
    public function listContatoPorStatus($status, $pag, $qtde, $coluna, $ordem);

    public function countContatoPorUsuaIdStatus($usuaid, $status);
    public function listContatoPorUsuaIdStatus($usuaid, $status, $pag, $qtde, $coluna, $ordem);

    public function loadMaxNomePK($nome,$status);

    public function loadNome($nome);
    public function loadEmail($email);
    public function loadMensagem($mensagem);
    public function loadStatus($status);
    public function loadDatacadastro($dataCadastro);
    public function loadDataatualizacao($dataAtualizacao);

    public function updateNome($id, $nome);
    public function updateEmail($id, $email);
    public function updateMensagem($id, $mensagem);

}
?>

