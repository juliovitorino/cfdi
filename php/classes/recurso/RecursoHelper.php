<?php 

// importar dependencias
require_once 'RecursoBusinessImpl.php';
require_once 'RecursoServiceImpl.php';

require_once '../variavel/VariavelCache.php';
require_once '../variavel/ConstantesVariavel.php';
require_once '../mensagem/MensagemCache.php';
require_once '../usuarios/UsuarioHelper.php';


/**
*
* RecursoHelper - Classe de implementação dos métodos de adaptação para a classe de negócio Recurso
* Camada de negócio Recurso - camada responsável pela lógica de negócios de Recurso do sistema. 
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
* @since 09/09/2021 08:00:49
* @copyright(c), Julio Vitorino <julio.vitorino@gmail.com>
*/

class RecursoHelper
{
    public static function getRecursoService($recu_id) {
        $usbo = new RecursoServiceImpl();
        $dto = $usbo->pesquisarPorID($recu_id);
        return $dto;
    }

    public static function getRecursoBusiness($daofactory, $recu_id) {
        $usbo = new RecursoBusinessImpl();
        $dto = $usbo->carregarPorID($daofactory, $recu_id);
        return $dto;
    }

/**
 * isRecursoValido() - Verifica o Recurso é valido com base na PK
 **/    
    public static function isRecursoValido($daofactory, $recu_id) {
        $recudto = self::getRecursoBusiness($daofactory, $recu_id);
        if($recudto == NULL || $recudto->id == NULL) {
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
