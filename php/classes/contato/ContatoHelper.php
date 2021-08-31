<?php 

// importar dependencias
require_once 'ContatoBusinessImpl.php';
require_once 'ContatoServiceImpl.php';

require_once '../variavel/VariavelCache.php';
require_once '../variavel/ConstantesVariavel.php';
require_once '../mensagem/MensagemCache.php';
require_once '../usuarios/UsuarioHelper.php';

/**
*
* ContatoHelper - Classe de implementação dos métodos de adaptação para a classe de negócio Contato
* Camada de negócio Contato - camada responsável pela lógica de negócios de Contato do sistema. 
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
* @since 31/08/2021 08:17:22
* @copyright(c), Julio Vitorino <julio.vitorino@gmail.com>
*/

class ContatoHelper
{
    public static function getContatoService($cont_id) {
        $usbo = new ContatoServiceImpl();
        $dto = $usbo->pesquisarPorID($cont_id);
        return $dto;
    }

    public static function getContatoBusiness($daofactory, $cont_id) {
        $usbo = new ContatoBusinessImpl();
        $dto = $usbo->carregarPorID($daofactory, $cont_id);
        return $dto;
    }

/**
 * isContatoValido() - Verifica o Contato é valido com base na PK
 **/    
    public static function isContatoValido($daofactory, $cont_id) {
        $contdto = self::getContatoBusiness($daofactory, $cont_id);
        if($contdto == NULL || $contdto->id == NULL) {
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

