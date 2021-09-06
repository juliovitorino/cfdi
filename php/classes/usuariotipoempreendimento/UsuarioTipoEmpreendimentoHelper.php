<?php 

// importar dependencias
require_once 'UsuarioTipoEmpreendimentoBusinessImpl.php';
require_once 'UsuarioTipoEmpreendimentoServiceImpl.php';

require_once '../variavel/VariavelCache.php';
require_once '../variavel/ConstantesVariavel.php';
require_once '../mensagem/MensagemCache.php';
require_once '../usuarios/UsuarioHelper.php';


/**
*
* UsuarioTipoEmpreendimentoHelper - Classe de implementação dos métodos de adaptação para a classe de negócio UsuarioTipoEmpreendimento
* Camada de negócio UsuarioTipoEmpreendimento - camada responsável pela lógica de negócios de UsuarioTipoEmpreendimento do sistema. 
* Não é uma camada visível para outros dispositivos, como as camadas de apresentação e aplicação. 
*
* É uma classe para apoiar, criar ou evitar que na classe de negócio se crie muitos códigos repetidos para obter apenas
* uma informação ou objeto.
*
* Todos os métodos DEVEM ser declarados como estáticos
*
* Changelog:
* 
* @author Julio Cesar Vitorino 
* @since 06/09/2021 09:56:34
* @copyright(c), Julio Vitorino <julio.vitorino@gmail.com>
*/

class UsuarioTipoEmpreendimentoHelper
{
    public static function getUsuarioTipoEmpreendimentoService($uste_id) {
        $usbo = new UsuarioTipoEmpreendimentoServiceImpl();
        $dto = $usbo->pesquisarPorID($uste_id);
        return $dto;
    }

    public static function getUsuarioTipoEmpreendimentoBusiness($daofactory, $uste_id) {
        $usbo = new UsuarioTipoEmpreendimentoBusinessImpl();
        $dto = $usbo->carregarPorID($daofactory, $uste_id);
        return $dto;
    }

/**
 * isUsuarioTipoEmpreendimentoValido() - Verifica o UsuarioTipoEmpreendimento é valido com base na PK
 **/    
    public static function isUsuarioTipoEmpreendimentoValido($daofactory, $uste_id) {
        $ustedto = self::getUsuarioTipoEmpreendimentoBusiness($daofactory, $uste_id);
        if($ustedto == NULL || $ustedto->id == NULL) {
            return true;
        }
        return false;
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
        UsuarioNotificacaoHelper::criarUsuarioNotificacaoPorBusiness($daofactory, $usuaid_admin, $msg, $icone);
    }
    
}

    
}


?>
