<?php 

// importar dependencias
require_once 'SeglogBusinessImpl.php';
require_once 'SeglogServiceImpl.php';

require_once '../variavel/VariavelCache.php';
require_once '../variavel/ConstantesVariavel.php';
require_once '../mensagem/MensagemCache.php';
require_once '../usuarios/UsuarioHelper.php';


/**
*
* SeglogHelper - Classe de implementação dos métodos de adaptação para a classe de negócio Seglog
* Camada de negócio Seglog - camada responsável pela lógica de negócios de Seglog do sistema. 
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
* @since 21/08/2021 12:30:09
* @copyright(c), Julio Vitorino <julio.vitorino@gmail.com>
*/

class SeglogHelper
{
    public static function getSeglogService($selog_id) {
        $usbo = new SeglogServiceImpl();
        $dto = $usbo->pesquisarPorID($selog_id);
        return $dto;
    }

    public static function getSeglogBusiness($daofactory, $selog_id) {
        $usbo = new SeglogBusinessImpl();
        $dto = $usbo->carregarPorID($daofactory, $selog_id);
        return $dto;
    }

    public static function getSeglogIdUsuarioFuncao($daofactory, $usuaid, $funcao) {
        $usbo = new SeglogBusinessImpl();
        $dto = $usbo->pesquisarPorid_UsuarioFuncao($daofactory, $usuaid, $funcao);
        return $dto;
    }

    public static function isSeglogIdUsuarioFuncaoCriar($daofactory, $usuaid, $funcao) {
        $retorno = false;
        $dto = self::getSeglogIdUsuarioFuncao($daofactory, $usuaid, $funcao);
        if(! is_null($dto))
        {
            $retorno = ($dto->incrudCriar == ConstantesVariavel::SIM);
        }
        return $retorno;
    }

    public static function isSeglogIdUsuarioFuncaoRecuperar($daofactory, $usuaid, $funcao) {
        $retorno = false;
        $dto = self::getSeglogIdUsuarioFuncao($daofactory, $usuaid, $funcao);
        if(! is_null($dto))
        {
            $retorno = ($dto->incrudRecuperar == ConstantesVariavel::SIM);
        }
        return $retorno;
    }

    public static function isSeglogIdUsuarioFuncaoAtualizar($daofactory, $usuaid, $funcao) {
        $retorno = false;
        $dto = self::getSeglogIdUsuarioFuncao($daofactory, $usuaid, $funcao);
        if(! is_null($dto))
        {
            $retorno = ($dto->incrudAtualizar == ConstantesVariavel::SIM);
        }
        return $retorno;
    }

    public static function isSeglogIdUsuarioFuncaoExcluir($daofactory, $usuaid, $funcao) {
        $retorno = false;
        $dto = self::getSeglogIdUsuarioFuncao($daofactory, $usuaid, $funcao);
        if(! is_null($dto))
        {
            $retorno = ($dto->incrudExcluir == ConstantesVariavel::SIM);
        }
        return $retorno;
    }

/**
 * isSeglogValido() - Verifica o Seglog é valido com base na PK
 **/    
    public static function isSeglogValido($daofactory, $selog_id) {
        $seglogdto = self::getSeglogBusiness($daofactory, $selog_id);
        if($seglogdto == NULL || $seglogdto->id == NULL) {
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
