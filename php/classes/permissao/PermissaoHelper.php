<?php

require_once 'PermissaoDTO.php';

require_once '../usuariosplanos/PlanoUsuarioBusinessImpl.php';
require_once '../usuariosplanosfatura/PlanoUsuarioFaturaBusinessImpl.php';
require_once '../variavel/ConstantesVariavel.php';
require_once '../variavel/VariavelCache.php';
require_once '../mensagem/MensagemCache.php';
require_once '../mensagem/ConstantesMensagem.php';

/**
*
* PermissaoHelper - A função desta classe é realizar a verificação de de plano, plano x usuario, plano x usuario x fatura
* além de verificar as quantidades e periodicidades
*
* Todos os métodos DEVEM ser declarados como estáticos
*
* Changelog:
* 
* @author Julio Cesar Vitorino 
* @since 28/09/2019 11:34:00
* @copyright(c), Julio Vitorino <julio.vitorino@gmail.com>
*/

class PermissaoHelper {
    /**
     * verificarPermissao - Realiza a verificação de permissao
     * 
     * @param $daofactory
     * @param $usuaid
     * @param $permissao
     */
    public static function verificarPermissao($daofactory, $usuaid, $permissao){

        // -----------------------------------------------------------------------------
        // --- 1o passo = Carregar o plano do usuario mais recente e sua ultima fatura 
        // -----------------------------------------------------------------------------
        $plusbo = new PlanoUsuarioBusinessImpl();
        $plusdto = $plusbo->carregarPlanoUsuarioPorStatus($daofactory, $usuaid, ConstantesVariavel::STATUS_ATIVO);

        if($plusdto == NULL || $plusdto->msgcode == ConstantesMensagem::INFORMACAO_NAO_LOCALIZADA){
            $plusdto->msgcode = ConstantesMensagem::PLANO_USUARIO_INVALIDO;
            $plusdto->msgcodeString = MensagemCache::getInstance()->getMensagem($plusdto->msgcode);
            return $plusdto;
        }

        $plufbo = new PlanoUsuarioFaturaBusinessImpl();
        $plufdto = $plufbo->carregarPlanoUsuarioFaturaMaisRecente($daofactory, $plusdto->id);
        // -----------------------------------------------------------------------------
        // --- 2o passo = verificar se os status dos PLUS e PLUF IN_STATUS = PENDENTE,
        // -----------------------------------------------------------------------------
        switch ($plusdto->status) {
            case ConstantesVariavel::STATUS_BLOQUEADO:
                $plusdto->msgcode = ConstantesMensagem::PLANO_USUARIO_BLOQUEADO;
                $plusdto->msgcodeString = MensagemCache::getInstance()->getMensagem($plusdto->msgcode);
                return $plusdto;
            case ConstantesVariavel::STATUS_PENDENTE:
                $plusdto->msgcode = ConstantesMensagem::PLANO_USUARIO_PENDENTE;
                $plusdto->msgcodeString = MensagemCache::getInstance()->getMensagem($plusdto->msgcode);
                return $plusdto;
        }

        switch ($plufdto->status) {
            case ConstantesVariavel::STATUS_BLOQUEADO:
                $plufdto->msgcode = ConstantesMensagem::PLANO_USUARIO_FATURA_BLOQUEADO;
                $plufdto->msgcodeString = MensagemCache::getInstance()->getMensagem($plufdto->msgcode);
                return $plufdto;
/*                
            case ConstantesVariavel::STATUS_PENDENTE:
                $plufdto->msgcode = ConstantesMensagem::PLANO_USUARIO_FATURA_PENDENTE;
                $plufdto->msgcodeString = MensagemCache::getInstance()->getMensagem($plufdto->msgcode);
                return $plufdto;
*/                
        }

        // Qualquer outro STATUS dos testados acima diferente de ATIVO deve ser recusado
        if($plusdto->status != ConstantesVariavel::STATUS_ATIVO){
            $plusdto->msgcode = ConstantesMensagem::PLANO_USUARIO_STATUS_DESCONHECIDO;
            $plusdto->msgcodeString = MensagemCache::getInstance()->getMensagem($plusdto->msgcode);
            return $plusdto;
        }

        if($plufdto->status != ConstantesVariavel::STATUS_ATIVO && 
            $plufdto->status != ConstantesVariavel::STATUS_LIQUIDADO &&
            $plufdto->status != ConstantesVariavel::STATUS_PENDENTE 
        ){
            $plufdto->msgcode = ConstantesMensagem::PLANO_USUARIO_STATUS_DESCONHECIDO;
            $plufdto->msgcodeString = MensagemCache::getInstance()->getMensagem($plufdto->msgcode);
            return $plufdto;
        }

        // -----------------------------------------------------------------------------
        // --- 3o passo = fatura vencida
        // -----------------------------------------------------------------------------
        $dv = Util::DMYHMiS_to_MySQLDate(preg_replace('/\s+/', '',$plufdto->dataVencimento) . " 00:00:00");

        if($plufdto->status == ConstantesVariavel::STATUS_PENDENTE && 
            $plufdto->valorfatura - $plufdto->valordesconto > 0 &&
            strtotime(Util::getNow()) > strtotime($dv)
        ){
            $plufdto->msgcode = ConstantesMensagem::PLANO_USUARIO_FATURA_SEM_PAGAMENTO;
            $plufdto->msgcodeString = MensagemCache::getInstance()->getMensagem($plufdto->msgcode);
            return $plufdto;
        }

        // -----------------------------------------------------------------------------
        // --- 4o passo = executar a factory correspondente à permissao do PLUS
        // -----------------------------------------------------------------------------

        $permissaoItem = self::getPermissaoItem($plusdto->lstpermissao, ConstantesPlano::lstfuncionalidade[$permissao]);
        if($permissaoItem == NULL) {
            $plufdto->msgcode = ConstantesMensagem::TIPO_PERMISSAO_INVALIDO;
            $plufdto->msgcodeString = MensagemCache::getInstance()->getMensagem($plufdto->msgcode);
            return $plufdto;
        }
//var_dump($permissaoItem);

        $permfactory = PermissaoFactory::getInstance($permissaoItem->periodicidade, $daofactory);
        $permfactdto = $permfactory->resolverPermissao($plusdto, $permissaoItem);
        if($permfactdto->msgcode != ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO){
            return $permfactdto;
        }

        // Retorna resultado da verificação
        return $permfactdto;

    }

    private static function getPermissaoItem($lstpermissao, $permissao){
//var_dump($lstpermissao)        ;
//var_dump($permissao);
        foreach ($lstpermissao as $key => $permdto) {
            if($permdto->funcionalidade == $permissao){
                return $permdto;
            }
        }

        return NULL;

    }



}


 ?>