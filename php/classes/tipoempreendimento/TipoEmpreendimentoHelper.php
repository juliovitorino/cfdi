<?php 

// importar dependencias
require_once 'TipoEmpreendimentoBusinessImpl.php';
require_once 'TipoEmpreendimentoServiceImpl.php';

require_once '../variavel/VariavelCache.php';
require_once '../variavel/ConstantesVariavel.php';
require_once '../mensagem/MensagemCache.php';
require_once '../usuarios/UsuarioHelper.php';


/**
*
* TipoEmpreendimentoHelper - Classe de implementação dos métodos de adaptação para a classe de negócio TipoEmpreendimento
* Camada de negócio TipoEmpreendimento - camada responsável pela lógica de negócios de TipoEmpreendimento do sistema. 
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
* @since 06/09/2021 08:28:01
* @copyright(c), Julio Vitorino <julio.vitorino@gmail.com>
*/

class TipoEmpreendimentoHelper
{
    public static function getTipoEmpreendimentoService($tiem_id) {
        $usbo = new TipoEmpreendimentoServiceImpl();
        $dto = $usbo->pesquisarPorID($tiem_id);
        return $dto;
    }

    public static function getTipoEmpreendimentoBusiness($daofactory, $tiem_id) {
        $usbo = new TipoEmpreendimentoBusinessImpl();
        $dto = $usbo->carregarPorID($daofactory, $tiem_id);
        return $dto;
    }

/**
 * isTipoEmpreendimentoValido() - Verifica o TipoEmpreendimento é valido com base na PK
 **/    
    public static function isTipoEmpreendimentoValido($daofactory, $tiem_id) {
        $tiemdto = self::getTipoEmpreendimentoBusiness($daofactory, $tiem_id);
        if($tiemdto == NULL || $tiemdto->id == NULL) {
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
