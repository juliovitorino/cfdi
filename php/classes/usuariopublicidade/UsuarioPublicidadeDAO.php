<?php

require_once '../interfaces/DAO.php';
/**********************************************************
===========================================================

 #####  #     #   ###   ######     #    ######   ##### 
#     # #     #    #    #     #   # #   #     # #     #
#       #     #    #    #     #  #   #  #     # #     #
#       #     #    #    #     # #     # #     # #     #
#       #     #    #    #     # ####### #     # #     #
#     # #     #    #    #     # #     # #     # #     #
 #####   #####    ###   ######  #     # ######   #####
 
===========================================================
CÓDIGO SOFREU ALTERAÇÕES PROFUNDAS, NÃO USE O GERADOR
AUTOMÁTICO PARA SUBSTITUIR O CÓDIGO AQUI EXISTENTE.
TODO O SISTEMA PODE ENTRAR EM COLAPSO.
===========================================================
***********************************************************/ 

/**
*
* UsuarioPublicidadeDAO - Interface dos métodos de acesso aos dados da tabela USUARIO_PUBLICIDADE
* Camada de dados UsuarioPublicidade - camada responsável SOMENTE pela acesso aos dados do sistema. 
* Não é uma camada visível para outros dispositivos, como as camadas de apresentação e aplicação. 
*
* Changelog:
* 
* @autor Julio Cesar Vitorino
* @since 20/09/2019 13:57:12
*
*/

interface UsuarioPublicidadeDAO extends DAO
{
    public function updateStatus($id, $status);
    public function listUsuarioPublicidadeStatus($status);
    public function countUsuarioPublicidadePorStatus($status);
    public function listUsuarioPublicidadePorStatus($status, $pag, $qtde, $coluna, $ordem);
    public function countUsuarioPublicidadePorUsuaIdStatus($usuaid, $status);
    public function listUsuarioPublicidadePorUsuaIdStatus($usuaid, $status, $pag, $qtde, $coluna, $ordem);
    public function countUsuarioPublicidadeProx24h($usuaid, $status);
    public function listUsuarioPublicidadeProx24h($usuaid, $status, $pag, $qtde, $coluna, $ordem);

    public function updateImagem($uspu_id, $nomearquivo);

    public function loadMaxId_UsuarioPK($id_usuario,$status);

    public function loadId_Usuario($id_usuario);
    public function loadTitulo($titulo);
    public function loadDescricao($descricao);
    public function loadDatainicio($dataInicio);
    public function loadDatatermino($dataTermino);
    public function loadVlnormal($vlNormal);
    public function loadVlpromo($vlPromo);
    public function loadObservacao($observacao);
    public function loadDataremover($dataRemover);
    public function loadStatus($status);
    public function loadDatacadastro($dataCadastro);
    public function loadDataatualizacao($dataAtualizacao);

    public function updateId_Usuario($id, $id_usuario);
    public function updateTitulo($id, $titulo);
    public function updateDescricao($id, $descricao);
    public function updateDatainicio($id, $dataInicio);
    public function updateDatatermino($id, $dataTermino);
    public function updateVlnormal($id, $vlNormal);
    public function updateVlpromo($id, $vlPromo);
    public function updateObservacao($id, $observacao);
    public function updateDataremover($id, $dataRemover);

}
?>

