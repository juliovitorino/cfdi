<?php 

// importar dependencias
require_once 'GrupoAdminFuncoesAdminUsuarioBusinessImpl.php';
require_once 'GrupoAdminFuncoesAdminUsuarioServiceImpl.php';

require_once '../variavel/VariavelCache.php';
require_once '../variavel/ConstantesVariavel.php';
require_once '../mensagem/MensagemCache.php';
require_once '../usuarios/UsuarioHelper.php';


/**
*
* GrupoAdminFuncoesAdminUsuarioHelper - Classe de implementação dos métodos de adaptação para a classe de negócio GrupoAdminFuncoesAdminUsuario
* Camada de negócio GrupoAdminFuncoesAdminUsuario - camada responsável pela lógica de negócios de GrupoAdminFuncoesAdminUsuario do sistema. 
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
* @since 20/08/2021 19:25:25
* @copyright(c), Julio Vitorino <julio.vitorino@gmail.com>
*/

class GrupoAdminFuncoesAdminUsuarioHelper
{
    public static function getGrupoAdminFuncoesAdminUsuarioService($gafau_id) {
        $usbo = new GrupoAdminFuncoesAdminUsuarioServiceImpl();
        $dto = $usbo->pesquisarPorID($gafau_id);
        return $dto;
    }

    public static function getGrupoAdminFuncoesAdminUsuarioBusiness($daofactory, $gafau_id) {
        $usbo = new GrupoAdminFuncoesAdminUsuarioBusinessImpl();
        $dto = $usbo->carregarPorID($daofactory, $gafau_id);
        return $dto;
    }

/**
 * isGrupoAdminFuncoesAdminUsuarioValido() - Verifica o GrupoAdminFuncoesAdminUsuario é valido com base na PK
 **/    
    public static function isGrupoAdminFuncoesAdminUsuarioValido($daofactory, $gafau_id) {
        $gafaudto = self::getGrupoAdminFuncoesAdminUsuarioBusiness($daofactory, $gafau_id);
        if($gafaudto == NULL || $gafaudto->id == NULL) {
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
