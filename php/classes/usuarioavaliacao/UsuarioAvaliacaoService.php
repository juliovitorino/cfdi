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
* UsuarioAvaliacaoService - Interfaces dos servicos para Classe de negócio com métodos para apoiar a integridade de informações sobre as avaliações gerais do usuário gerenciado pela plataforma
* Interface de Serviços UsuarioAvaliacao - camada responsável pela lógica de negócios de UsuarioAvaliacao do sistema. 
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
* @since 17/09/2019 09:22:19
*
*/

// importar dependências

require_once '../interfaces/AppService.php';

interface UsuarioAvaliacaoService extends AppService
{

    public function autalizarStatusUsuarioAvaliacao($id, $status);
    public function listarUsuarioAvaliacaoPorStatus($status='A', $pag=1, $qtde=0, $coluna=1, $ordem=0);
    public function listarUsuarioAvaliacaoPorUsuaIdStatus($usuaid, $status='A', $pag=1, $qtde=0, $coluna=1, $ordem=0);
    public function cancelar($dto);
    public function PesquisarMaxPKAtivoId_UsuarioPorStatus($id_usuario,$status);
	public function realizarUsuarioAvaliacao($id_usuario, $rating);

    public function pesquisarPorId_Usuario($id_usuario);
    public function pesquisarPorContadorstar_1($contadorStar_1);
    public function pesquisarPorContadorstar_2($contadorStar_2);
    public function pesquisarPorContadorstar_3($contadorStar_3);
    public function pesquisarPorContadorstar_4($contadorStar_4);
    public function pesquisarPorContadorstar_5($contadorStar_5);
    public function pesquisarPorRatingcalculado($ratingCalculado);

    public function atualizarId_UsuarioPorPK($id_usuario,$id);
    public function atualizarContadorstar_1PorPK($contadorStar_1,$id);
    public function atualizarContadorstar_2PorPK($contadorStar_2,$id);
    public function atualizarContadorstar_3PorPK($contadorStar_3,$id);
    public function atualizarContadorstar_4PorPK($contadorStar_4,$id);
    public function atualizarContadorstar_5PorPK($contadorStar_5,$id);
    public function atualizarRatingcalculadoPorPK($ratingCalculado,$id);
}


?>




