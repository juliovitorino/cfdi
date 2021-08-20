<?php 

// importar dependencias
require_once 'FuncoesAdministrativasBusinessImpl.php';
require_once 'FuncoesAdministrativasServiceImpl.php';

require_once '../variavel/VariavelCache.php';
require_once '../variavel/ConstantesVariavel.php';
require_once '../mensagem/MensagemCache.php';
require_once '../usuarios/UsuarioHelper.php';


/**
*
* FuncoesAdministrativasHelper - Classe de implementação dos métodos de adaptação para a classe de negócio FuncoesAdministrativas
* Camada de negócio FuncoesAdministrativas - camada responsável pela lógica de negócios de FuncoesAdministrativas do sistema. 
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
* @since 20/08/2021 15:09:15
* @copyright(c), Julio Vitorino <julio.vitorino@gmail.com>
*/

class FuncoesAdministrativasHelper
{
    public static function getFuncoesAdministrativasService($fuad_id) {
        $usbo = new FuncoesAdministrativasServiceImpl();
        $dto = $usbo->pesquisarPorID($fuad_id);
        return $dto;
    }

    public static function getFuncoesAdministrativasBusiness($daofactory, $fuad_id) {
        $usbo = new FuncoesAdministrativasBusinessImpl();
        $dto = $usbo->carregarPorID($daofactory, $fuad_id);
        return $dto;
    }

/**
 * isFuncoesAdministrativasValido() - Verifica o FuncoesAdministrativas é valido com base na PK
 **/    
    public static function isFuncoesAdministrativasValido($daofactory, $fuad_id) {
        $fuaddto = self::getFuncoesAdministrativasBusiness($daofactory, $fuad_id);
        if($fuaddto == NULL || $fuaddto->id == NULL) {
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

