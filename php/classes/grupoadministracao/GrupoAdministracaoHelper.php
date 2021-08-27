<?php 

// importar dependencias
require_once 'GrupoAdministracaoBusinessImpl.php';
require_once 'GrupoAdministracaoServiceImpl.php';

require_once '../variavel/VariavelCache.php';
require_once '../variavel/ConstantesVariavel.php';
require_once '../mensagem/MensagemCache.php';
require_once '../usuarios/UsuarioHelper.php';


/**
*
* GrupoAdministracaoHelper - Classe de implementação dos métodos de adaptação para a classe de negócio GrupoAdministracao
* Camada de negócio GrupoAdministracao - camada responsável pela lógica de negócios de GrupoAdministracao do sistema. 
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
* @since 20/08/2021 15:41:08
* @copyright(c), Julio Vitorino <julio.vitorino@gmail.com>
*/

class GrupoAdministracaoHelper
{
    public static function getGrupoAdministracaoService($grad_id) {
        $usbo = new GrupoAdministracaoServiceImpl();
        $dto = $usbo->pesquisarPorID($grad_id);
        return $dto;
    }

    public static function getGrupoAdministracaoBusiness($daofactory, $grad_id) {
        $usbo = new GrupoAdministracaoBusinessImpl();
        $dto = $usbo->carregarPorID($daofactory, $grad_id);
        return $dto;
    }

/**
 * isGrupoAdministracaoValido() - Verifica o GrupoAdministracao é valido com base na PK
 **/    
    public static function isGrupoAdministracaoValido($daofactory, $grad_id) {
        $graddto = self::getGrupoAdministracaoBusiness($daofactory, $grad_id);
        if($graddto == NULL || $graddto->id == NULL) {
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
