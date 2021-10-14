<?php

require_once '../interfaces/DAO.php';

/**
*
* PlanoRecursoDAO - Interface dos métodos de acesso aos dados da tabela PLANO_RECURSO
* Camada de dados PlanoRecurso - camada responsável SOMENTE pela acesso aos dados do sistema. 
* Não é uma camada visível para outros dispositivos, como as camadas de apresentação e aplicação. 
*
* Changelog:
* 
* @autor Julio Cesar Vitorino
* @since 09/09/2021 12:12:30
*
*/

interface PlanoRecursoDAO extends DAO
{
    public function updateStatus($id, $status);
    public function listPlanoRecursoStatus($status);
    public function countPlanoRecursoPorStatus($status);
    public function listPlanoRecursoPorStatus($status, $pag, $qtde, $coluna, $ordem);
    public function countPlanoRecursoPorUsuaIdStatus($usuaid, $status);
    public function listPlanoRecursoPorUsuaIdStatus($usuaid, $status, $pag, $qtde, $coluna, $ordem);
    public function countPlanoRecursoPorIdplanoStatus($idplano, $status);
    public function listPlanoRecursoPorIdplanoStatus($idplano, $status, $pag, $qtde, $coluna, $ordem);

    public function loadMaxIdplanoPK($idplano,$status);

    public function loadIdplano($idplano);
    public function loadIdrecurso($idrecurso);
    public function loadStatus($status);
    public function loadDatacadastro($dataCadastro);
    public function loadDataatualizacao($dataAtualizacao);

    public function updateIdplano($id, $idplano);
    public function updateIdrecurso($id, $idrecurso);

}
?>








































































































































































