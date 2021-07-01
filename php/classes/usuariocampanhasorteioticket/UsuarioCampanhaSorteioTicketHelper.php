<?php 

// importar dependencias
require_once 'UsuarioCampanhaSorteioTicketBusinessImpl.php';
require_once 'UsuarioCampanhaSorteioTicketServiceImpl.php';

require_once '../variavel/VariavelCache.php';
require_once '../variavel/ConstantesVariavel.php';
require_once '../mensagem/MensagemCache.php';

/**
*
* UsuarioCampanhaSorteioTicketHelper - Classe de implementação dos métodos de adaptação para a classe de negócio UsuarioCampanhaSorteioTicket
* Camada de negócio UsuarioCampanhaSorteioTicket - camada responsável pela lógica de negócios de UsuarioCampanhaSorteioTicket do sistema. 
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
* @since 22/06/2021 10:37:39
* @copyright(c), Julio Vitorino <julio.vitorino@gmail.com>
*/

class UsuarioCampanhaSorteioTicketHelper
{
    public static function getUsuarioCampanhaSorteioTicketService($ucst_id) {
        $usbo = new UsuarioCampanhaSorteioTicketServiceImpl();
        $dto = $usbo->pesquisarPorID($ucst_id);
        return $dto;
    }

    public static function getUsuarioCampanhaSorteioTicketBusiness($daofactory, $ucst_id) {
        $usbo = new UsuarioCampanhaSorteioTicketBusinessImpl();
        $dto = $usbo->carregarPorID($daofactory, $ucst_id);
        return $dto;
    }

/**
 * isUsuarioCampanhaSorteioTicketValido() - Verifica o UsuarioCampanhaSorteioTicket é valido com base na PK
 **/    
    public static function isUsuarioCampanhaSorteioTicketValido($daofactory, $ucst_id) {
        $ucstdto = self::getUsuarioCampanhaSorteioTicketBusiness($daofactory, $ucst_id);
        if($ucstdto == NULL || $ucstdto->id == NULL) {
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
