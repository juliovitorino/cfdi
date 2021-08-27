<?php 

// importar dependencias
require_once 'GrupoUsuarioBusinessImpl.php';
require_once 'GrupoUsuarioServiceImpl.php';

require_once '../variavel/VariavelCache.php';
require_once '../variavel/ConstantesVariavel.php';
require_once '../mensagem/MensagemCache.php';
require_once '../usuarios/UsuarioHelper.php';


/**
*
* GrupoUsuarioHelper - Classe de implementação dos métodos de adaptação para a classe de negócio GrupoUsuario
* Camada de negócio GrupoUsuario - camada responsável pela lógica de negócios de GrupoUsuario do sistema. 
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
* @since 22/08/2021 17:02:50
* @copyright(c), Julio Vitorino <julio.vitorino@gmail.com>
*/

class GrupoUsuarioHelper
{
    public static function getGrupoUsuarioService($grus_id) {
        $usbo = new GrupoUsuarioServiceImpl();
        $dto = $usbo->pesquisarPorID($grus_id);
        return $dto;
    }

    public static function getGrupoUsuarioBusiness($daofactory, $grus_id) {
        $usbo = new GrupoUsuarioBusinessImpl();
        $dto = $usbo->carregarPorID($daofactory, $grus_id);
        return $dto;
    }

/**
 * isGrupoUsuarioValido() - Verifica o GrupoUsuario é valido com base na PK
 **/    
    public static function isGrupoUsuarioValido($daofactory, $grus_id) {
        $grusdto = self::getGrupoUsuarioBusiness($daofactory, $grus_id);
        if($grusdto == NULL || $grusdto->id == NULL) {
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

