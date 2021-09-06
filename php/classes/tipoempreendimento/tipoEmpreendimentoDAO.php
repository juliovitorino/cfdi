<?php

require_once '../interfaces/DAO.php';

/**
*
* TipoEmpreendimentoDAO - Interface dos métodos de acesso aos dados da tabela TIPO_EMPREENDIMENTO
* Camada de dados TipoEmpreendimento - camada responsável SOMENTE pela acesso aos dados do sistema. 
* Não é uma camada visível para outros dispositivos, como as camadas de apresentação e aplicação. 
*
* Changelog:
* 
* @autor Julio Cesar Vitorino
* @since 06/09/2021 08:28:01
*
*/

interface TipoEmpreendimentoDAO extends DAO
{
    public function updateStatus($id, $status);
    public function listTipoEmpreendimentoStatus($status);
    public function countTipoEmpreendimentoPorStatus($status);
    public function listTipoEmpreendimentoPorStatus($status, $pag, $qtde, $coluna, $ordem);
    public function countTipoEmpreendimentoPorUsuaIdStatus($usuaid, $status);
    public function listTipoEmpreendimentoPorUsuaIdStatus($usuaid, $status, $pag, $qtde, $coluna, $ordem);

    public function loadMaxDescricaoPK($descricao,$status);

    public function loadDescricao($descricao);
    public function loadUrlimg($urlimg);
    public function loadStatus($status);
    public function loadDatacadastro($dataCadastro);
    public function loadDataatualizacao($dataAtualizacao);

    public function updateDescricao($id, $descricao);
    public function updateUrlimg($id, $urlimg);

}
?>
