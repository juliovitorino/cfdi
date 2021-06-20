<?php

require_once 'UsuarioNotificacaoServiceImpl.php';
require_once 'UsuarioNotificacaoBusinessImpl.php';
require_once 'UsuarioNotificacaoDTO.php';

require_once '../variavel/VariavelCache.php';
require_once '../variavel/ConstantesVariavel.php';
require_once '../mensagem/MensagemCache.php';


/**
*
* UsuarioNotificacaoHelperHelper - Helper para ServiceImpl e BusinessImpl
* Helper responsável pela implementação de chamadas estáticas de UsuarioNotificacao 
* de serviço e negócio do sistema. 
* Não é uma camada visível para outros dispositivos, como as camadas de apresentação e aplicação. 
*
* Changelog:
* 
* @autor Julio Cesar Vitorino
* @since 29/08/2019
*
*/

class UsuarioNotificacaoHelper{

/**
*
* criarUsuarioNotificacaoPorService - Obtém uma instância populada de um UsuarioNotificacaoHelperDTO
*
* @param $idusuario
* @param $tipo
* @param $notificacao
* @param $icone
* @param $json
*
*/
    public static function criarUsuarioNotificacaoPorService($idusuario, $notificacao, $icone="geral.png", $tipo="00",$json="{}"){
        $usnobo = new UsuarioNotificacaoServiceImpl();
        $usnodto = new UsuarioNotificacaoDTO();
        $usnodto->id_usuario = $idusuario;
        $usnodto->icone = $icone;
        $usnodto->tipo = $tipo;
        $usnodto->notificacao = $notificacao;
        $usnodto->json = $json;
        //var_dump($usnodto);
        return $usnobo->cadastrar($usnodto);

    }

/**
*
* criarUsuarioNotificacaoPorBusiness - Obtém uma instância populada de um UsuarioNotificacaoHelperDTO
*
* ATENÇÃO: Este método deve ser invocado dentro de um bloco try/catch já aberto no Service
*
* @param $idusuario
* @param $tipo
* @param $notificacao
* @param $icone
* @param $json
*
*/
public static function criarUsuarioNotificacaoPorBusiness($daofactory, $idusuario, $notificacao, $icone="geral.png", $tipo="00",$json="{}"){
    $usnobo = new UsuarioNotificacaoBusinessImpl();
    $usnodto = new UsuarioNotificacaoDTO();
    $usnodto->id_usuario = $idusuario;
    $usnodto->icone = $icone;
    $usnodto->tipo = $tipo;
    $usnodto->notificacao = $notificacao;
    $usnodto->json = $json;
    return $usnobo->inserir($daofactory, $usnodto);

}

/**
*
* criarNotificacaoAdmin - Ajuda para publicar uma notificação ao usuário Admin
*
* @param $daofactory
* @param $msgOrigem
* @param $parametros
* @param $icone
*
*/

public static function criarNotificacaoAdmin($daofactory, $msgOrigem, $parametros, $icone)
{
    // Envia uma notificação ao ADMIN se chave estiver ligada
    if (VariavelCache::getInstance()->getVariavel(ConstantesVariavel::CHAVE_NOTIFICACAO_ADMIN_NOVO_USUARIO) == ConstantesVariavel::ATIVADO){
        $usuaid_admin = (int) VariavelCache::getInstance()->getVariavel(ConstantesVariavel::NOTIFICACAO_ADMIN_USUA_ID);
        $msg =  MensagemCache::getInstance()->getMensagemParametrizada($msgOrigem,$parametros);
        self::criarUsuarioNotificacaoPorBusiness($daofactory, $usuaid_admin, $msg, $icone);
    }
    
}


} 

?>