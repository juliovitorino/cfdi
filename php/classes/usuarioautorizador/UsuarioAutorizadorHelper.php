<?php 

/**
*
* UsuarioAutorizadorHelper - Classe de implementação dos métodos de adaptação para a classe de negócio UsuarioAutorizador
* Camada de negócio UsuarioAutorizador - camada responsável pela lógica de negócios de UsuarioAutorizador do sistema. 
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
* @since 09/09/2019 12:52:36
* @copyright(c), Julio Vitorino <julio.vitorino@gmail.com>
*/

class UsuarioAutorizadorHelper
{
    const TIPO_AUTORIZACAO_CARIMBADOR = "00";
    const TIPO_AUTORIZACAO_DESCONHECIDA = "Autorização não conhecida";

    const QUALIFICACAO_TEMPORARIA = "T";
    const QUALIFICACAO_PERMANENTE = "P";
    const QUALIFICACAO_DESCONHECIDA = "Qualificação não conhecida";

    public static function getTraducaoTipo($tipo){
        $lstTipo = [
            self::QUALIFICACAO_TEMPORARIA => "Temporário",
            self::QUALIFICACAO_PERMANENTE => "Permanente",
        ];

        $retorno = self::QUALIFICACAO_DESCONHECIDA;
        foreach ($lstTipo as $key => $value) {
            if($key == $tipo){
                $retorno = $value;
            }
        }

        return $retorno;
    }

    
    public static function getTraducaoAutorizacao($tipo){
        $lstTradrucaoAutorizacao = [
            self::TIPO_AUTORIZACAO_CARIMBADOR => "Carimbador",
        ];

        $retorno = self::TIPO_AUTORIZACAO_DESCONHECIDA;
        foreach ($lstTradrucaoAutorizacao as $key => $value) {
            if($key == $tipo){
                $retorno = $value;
            }
        }

        return $retorno;
    }

    public static function getUsuarioAutorizadorService($USAU_ID) {
        $usbo = new UsuarioAutorizadorServiceImpl();
        $dto = $usbo->pesquisarPorID($USAU_ID);
        return $dto;
    }

    public static function getUsuarioAutorizadorBusiness($daofactory, $USAU_ID) {
        $usbo = new UsuarioAutorizadorBusinessImpl();
        $dto = $usbo->carregarPorID($daofactory, $USAU_ID);
        return $dto;
    }
    
    public static function getUsuarioAutorizadorBusinessNoKeys($daofactory, $USAU_ID) {
        $usbo = new UsuarioAutorizadorBusinessImpl();
        $dto = $usbo->carregarPorID($daofactory, $USAU_ID);
        $dto->codigoAtivacao = null;
        $dto->pwd = null;
        return $dto;
    }
    
}


?>
