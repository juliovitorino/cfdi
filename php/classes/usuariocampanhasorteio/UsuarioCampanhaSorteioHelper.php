<?php 

// importar dependencias
require_once 'UsuarioCampanhaSorteioBusinessImpl.php';
require_once 'UsuarioCampanhaSorteioServiceImpl.php';

require_once '../variavel/VariavelCache.php';
require_once '../variavel/ConstantesVariavel.php';
require_once '../mensagem/MensagemCache.php';

/**
*
* UsuarioCampanhaSorteioHelper - Classe de implementação dos métodos de adaptação para a classe de negócio UsuarioCampanhaSorteio
* Camada de negócio UsuarioCampanhaSorteio - camada responsável pela lógica de negócios de UsuarioCampanhaSorteio do sistema. 
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
* @since 22/06/2021 08:05:45
* @copyright(c), Julio Vitorino <julio.vitorino@gmail.com>
*/

class UsuarioCampanhaSorteioHelper
{
    public static function getUsuarioCampanhaSorteioService($uscs_id) {
        $usbo = new UsuarioCampanhaSorteioServiceImpl();
        $dto = $usbo->pesquisarPorID($uscs_id);
        return $dto;
    }

    public static function getUsuarioCampanhaSorteioBusiness($daofactory, $uscs_id) {
        $usbo = new UsuarioCampanhaSorteioBusinessImpl();
        $dto = $usbo->carregarPorID($daofactory, $uscs_id);
        return $dto;
    }

/**
 * isUsuarioCampanhaSorteioValido() - Verifica o UsuarioCampanhaSorteio é valido com base na PK
 **/    
    public static function isUsuarioCampanhaSorteioValido($daofactory, $uscs_id) {
        $uscsdto = self::getUsuarioCampanhaSorteioBusiness($daofactory, $uscs_id);
        if($uscsdto == NULL || $uscsdto->id == NULL) {
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
        self::criarUsuarioNotificacaoPorBusiness($daofactory, $usuaid_admin, $msg, $icone);
    }
    
}

    
}


?>
