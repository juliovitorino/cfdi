<?php
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
* UsuarioPublicidadeBusiness - Interface dos métodos de negócio para classe UsuarioPublicidade
* Camada de negócio UsuarioPublicidade - camada responsável pela lógica de negócios de UsuarioPublicidade do sistema. 
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
* 23/09/2019 - Inclusão do método atualizarImagem()
* 
* @autor Julio Cesar Vitorino
* @since 20/09/2019 13:57:12
*
*/


// importar dependências
require_once '../interfaces/BusinessObject.php';

interface UsuarioPublicidadeBusiness extends BusinessObject
{
    public function atualizarStatus($daofactory, $id, $status);
    public function listarUsuarioPublicidadePorStatus($daofactory, $status, $pag, $qtde, $coluna, $ordem);
    public function validarTamanhoCampo($campo, $tamanho, $coment);
    public function listarUsuarioPublicidadePorUsuaIdStatus($daofactory, $usuaid, $status, $pag, $qtde, $coluna, $ordem);
    public function listarUsuarioPublicidadeProx24h($daofactory, $usuaid, $status, $pag, $qtde, $coluna, $ordem);
    public function atualizarImagem($daofactory, $uspu_id, $nomearquivo);

    public function PesquisarMaxPKAtivoId_UsuarioPorStatus($daofactory, $id_usuario, $status);

    public function pesquisarPorId_Usuario($daofactory, $id_usuario);
    public function pesquisarPorTitulo($daofactory, $titulo);
    public function pesquisarPorDescricao($daofactory, $descricao);
    public function pesquisarPorDatainicio($daofactory, $dataInicio);
    public function pesquisarPorDatatermino($daofactory, $dataTermino);
    public function pesquisarPorVlnormal($daofactory, $vlNormal);
    public function pesquisarPorVlpromo($daofactory, $vlPromo);
    public function pesquisarPorObservacao($daofactory, $observacao);
    public function pesquisarPorDataremover($daofactory, $dataRemover);

    public function atualizarId_UsuarioPorPK($daofactory,$id_usuario,$id);
    public function atualizarTituloPorPK($daofactory,$titulo,$id);
    public function atualizarDescricaoPorPK($daofactory,$descricao,$id);
    public function atualizarDatainicioPorPK($daofactory,$dataInicio,$id);
    public function atualizarDataterminoPorPK($daofactory,$dataTermino,$id);
    public function atualizarVlnormalPorPK($daofactory,$vlNormal,$id);
    public function atualizarVlpromoPorPK($daofactory,$vlPromo,$id);
    public function atualizarObservacaoPorPK($daofactory,$observacao,$id);
    public function atualizarDataremoverPorPK($daofactory,$dataRemover,$id);

}

?>
