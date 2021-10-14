<?php 

// importar dependencias
require_once 'FilaEmailBusinessImpl.php';
require_once 'FilaEmailServiceImpl.php';

require_once '../variavel/VariavelCache.php';
require_once '../variavel/ConstantesVariavel.php';
require_once '../mensagem/MensagemCache.php';
require_once '../usuarios/UsuarioHelper.php';


/**
*
* FilaEmailHelper - Classe de implementação dos métodos de adaptação para a classe de negócio FilaEmail
* Camada de negócio FilaEmail - camada responsável pela lógica de negócios de FilaEmail do sistema. 
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
* @since 01/09/2021 15:29:49
* @copyright(c), Julio Vitorino <julio.vitorino@gmail.com>
*/

class FilaEmailHelper
{
    public static function getFilaEmailService($fiem_id) {
        $usbo = new FilaEmailServiceImpl();
        $dto = $usbo->pesquisarPorID($fiem_id);
        return $dto;
    }

    public static function getFilaEmailBusiness($daofactory, $fiem_id) {
        $usbo = new FilaEmailBusinessImpl();
        $dto = $usbo->carregarPorID($daofactory, $fiem_id);
        return $dto;
    }

/**
 * isFilaEmailValido() - Verifica o FilaEmail é valido com base na PK
 **/    
    public static function isFilaEmailValido($daofactory, $fiem_id) {
        $fiemdto = self::getFilaEmailBusiness($daofactory, $fiem_id);
        if($fiemdto == NULL || $fiemdto->id == NULL) {
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
