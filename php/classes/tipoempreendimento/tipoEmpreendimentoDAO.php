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
* @since 23/08/2019 09:14:23
*
*/

interface TipoEmpreendimentoDAO extends DAO
{
    public function updateStatus($id, $status);
    public function listTipoEmpreendimentoStatus($status);
    public function countTipoEmpreendimentoPorStatus($status);
    public function listTipoEmpreendimentoPorStatus($status, $pag, $qtde, $coluna, $ordem);

}
?>
