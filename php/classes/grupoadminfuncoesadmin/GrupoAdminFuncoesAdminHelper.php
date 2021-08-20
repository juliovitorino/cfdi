<?php 

// importar dependencias
require_once 'GrupoAdminFuncoesAdminBusinessImpl.php';
require_once 'GrupoAdminFuncoesAdminServiceImpl.php';

require_once '../variavel/VariavelCache.php';
require_once '../variavel/ConstantesVariavel.php';
require_once '../mensagem/MensagemCache.php';
require_once '../usuarios/UsuarioHelper.php';

/**
*
* GrupoAdminFuncoesAdminHelper - Classe de implementação dos métodos de adaptação para a classe de negócio GrupoAdminFuncoesAdmin
* Camada de negócio GrupoAdminFuncoesAdmin - camada responsável pela lógica de negócios de GrupoAdminFuncoesAdmin do sistema. 
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
* @since 20/08/2021 18:47:48
* @copyright(c), Julio Vitorino <julio.vitorino@gmail.com>
*/

class GrupoAdminFuncoesAdminHelper
{
    public static function getGrupoAdminFuncoesAdminService($gafa_id) {
        $usbo = new GrupoAdminFuncoesAdminServiceImpl();
        $dto = $usbo->pesquisarPorID($gafa_id);
        return $dto;
    }

    public static function getGrupoAdminFuncoesAdminBusiness($daofactory, $gafa_id) {
        $usbo = new GrupoAdminFuncoesAdminBusinessImpl();
        $dto = $usbo->carregarPorID($daofactory, $gafa_id);
        return $dto;
    }

/**
 * isGrupoAdminFuncoesAdminValido() - Verifica o GrupoAdminFuncoesAdmin é valido com base na PK
 **/    
    public static function isGrupoAdminFuncoesAdminValido($daofactory, $gafa_id) {
        $gafadto = self::getGrupoAdminFuncoesAdminBusiness($daofactory, $gafa_id);
        if($gafadto == NULL || $gafadto->id == NULL) {
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
