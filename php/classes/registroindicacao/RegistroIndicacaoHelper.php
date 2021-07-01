<?php 

// importar dependencias
require_once 'RegistroIndicacaoBusinessImpl.php';
require_once 'RegistroIndicacaoServiceImpl.php';

require_once '../variavel/VariavelCache.php';
require_once '../variavel/ConstantesVariavel.php';
require_once '../mensagem/MensagemCache.php';

/**
*
* RegistroIndicacaoHelper - Classe de implementação dos métodos de adaptação para a classe de negócio RegistroIndicacao
* Camada de negócio RegistroIndicacao - camada responsável pela lógica de negócios de RegistroIndicacao do sistema. 
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
* @since 23/06/2021 14:44:26
* @copyright(c), Julio Vitorino <julio.vitorino@gmail.com>
*/

class RegistroIndicacaoHelper
{
    public static function getRegistroIndicacaoService($rein_id) {
        $usbo = new RegistroIndicacaoServiceImpl();
        $dto = $usbo->pesquisarPorID($rein_id);
        return $dto;
    }

    public static function getRegistroIndicacaoBusiness($daofactory, $rein_id) {
        $usbo = new RegistroIndicacaoBusinessImpl();
        $dto = $usbo->carregarPorID($daofactory, $rein_id);
        return $dto;
    }

/**
 * isRegistroIndicacaoValido() - Verifica o RegistroIndicacao é valido com base na PK
 **/    
    public static function isRegistroIndicacaoValido($daofactory, $rein_id) {
        $reindto = self::getRegistroIndicacaoBusiness($daofactory, $rein_id);
        if($reindto == NULL || $reindto->id == NULL) {
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
