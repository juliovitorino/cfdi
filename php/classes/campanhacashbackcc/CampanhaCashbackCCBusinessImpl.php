<?php 

// importar dependencias
require_once 'CampanhaCashbackCCBusiness.php';
require_once 'SaldoGeralCashbackCCDTO.php';
require_once 'SaldoUsuarioDonoCashbackCCDTO.php';

require_once '../usuarios/UsuarioBusinessImpl.php';
require_once '../usuarios/UsuarioHelper.php';
require_once '../usuariocashback/UsuarioCashbackBusinessImpl.php';
require_once '../usuarionotificacao/UsuarioNotificacaoHelper.php';

require_once '../dto/DTOPadrao.php';
require_once '../dto/DTOPaginacao.php';
require_once '../util/util.php';

require_once '../variavel/ConstantesVariavel.php';
require_once '../variavel/VariavelCache.php';
/**********************************************************
===========================================================

 #####  #     #   ###   ######     #    ######   ##### 
#     # #     #    #    #     #   # #   #     # #     #
#       #     #    #    #     #  #   #  #     # #     #
#       #     #    #    #     # #     # #     # #     #
#       #     #    #    #     # ####### #     # #     #
#     # #     #    #    #     # #     # #     # #     #
 #####   #####    ###   ######  #     # ######   #####
 
===========================================================
CÓDIGO SOFREU ALTERAÇÕES DE PROFUNDAS, NÃO USE O GERADOR
AUTOMÁTICO PARA SUBSTITUIR O CÓDIGO AQUI EXISTENTE.
TODO O SISTEMA PODE ENTRAR EM COLAPSO.
===========================================================
***********************************************************/ 

/**
*
* CampanhaCashbackCCBusinessImpl - Classe de implementação dos métodos de negócio para a interface CampanhaCashbackCCBusiness
* Camada de negócio CampanhaCashbackCC - camada responsável pela lógica de negócios de CampanhaCashbackCC do sistema. 
* Não é uma camada visível para outros dispositivos, como as camadas de apresentação e aplicação. 
*
*
* Responsabilidades dessa classe
*
* 1) Receber o pedido de uma classe de negócio do sistema
* 2) Produzir a regra de negócio de acordo com cada método
* 3) Acessar o banco de dados através das interfaces DAOs
* 4) Verificar o resultado e retornar um objeto e uma mensagem de alto nível para a camada de serviço
*
* Changelog:
* 01/09/2019 - Saldo de cashback
* 
* @autor Julio Cesar Vitorino
* @since 26/08/2019 16:09:29
*
*/


class CampanhaCashbackCCBusinessImpl implements CampanhaCashbackCCBusiness
{
    function __construct()  {   }

/**
*
* TransferirCashbackCC() - Transfere valor da conta corrente de cashback origem (cliente) e lanca na destino (dono)
*
* @param $daofactory
* @param $id_usuario
* @param $id_destino
* @param $id_dono
* @param $vllancar
* @param $descricao
* @return SaldoGeralCashbackCCDTO
*/

public function transferirEntreMembroCashbackCC($daofactory, $id_usuario, $id_destino, $id_dono, $vllancar, $descricao)
{
    // Verifica se tem saldo para devolver
    $retorno = $this->getSaldoCashbackCCPeloDono($daofactory, $id_usuario, $id_dono);
    $retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
    $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);

    // Verifica se configuração do USCA permite transferencia entre membros
    $uscabo = new UsuarioCashbackBusinessImpl();
    $uscadto = $uscabo->PesquisarMaxPKAtivoId_UsuarioPorStatus($daofactory, $id_dono, ConstantesVariavel::STATUS_ATIVO);
    if($uscadto->permitirTransferenciaMembrosJ10 == ConstantesVariavel::NAO)
    {
        $retorno->msgcode = ConstantesMensagem::USUARIO_CASHBACK_NAO_PERMITE_TRANSFERIR_ENTRE_MEMBRO;
        $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);
        return $retorno;
    }

    // Verifica se o usuário destino é o mesmo id_dono
    if($id_destino == $id_dono)
    {
        $retorno->msgcode = ConstantesMensagem::USUARIO_TRANSFERENCIA_DONO_DO_CASHBACK;
        $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);
        return $retorno;
    }

    // se o valor a resgatar for superior ao saldo em conta - emite erro e termina o processo
    if($vllancar > $retorno->vlsldGeral ) {
        $retorno->msgcode = ConstantesMensagem::SALDO_INSUFICIENTE_RESGATE;
        $retorno->msgcodeString = MensagemCache::getInstance()->getMensagemParametrizada($retorno->msgcode,[
            ConstantesVariavel::P1 => $retorno->vlsldGeralMoeda
        ]);
        return $retorno;
    }

    // Obtem as identidades dos usuarios envolvidos
    $usuaDono = UsuarioHelper::getUsuarioBusinessNoKeys($daofactory, $id_dono);
    $usuaResgate = UsuarioHelper::getUsuarioBusinessNoKeys($daofactory, $id_usuario);
    $usuaDestino = UsuarioHelper::getUsuarioBusinessNoKeys($daofactory, $id_destino);

    // Se usuário origem e destino forem diferentes de usuários comuns, a operação será negada
    if($usuaDestino->tipoConta != ConstantesVariavel::CONTA_USUARIO_COMUM || $usuaResgate->tipoConta != ConstantesVariavel::CONTA_USUARIO_COMUM){
        $retorno->msgcode = ConstantesMensagem::PERMITIDO_SO_USUARIO_COMUM;
        $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);
        return $retorno;

    }

    $autenticacao = sha1(Util::getCodigo(2048));
    $vllancarMoeda = Util::getMoeda($vllancar);
    $descricao .= ". Tranferência de $usuaResgate->apelido em favor de $usuaDestino->apelido para usar no estabelecimento $usuaDono->apelido. Valor de $vllancarMoeda. ID Autenticação => $autenticacao" ;

    // Efetua o resgate total
    $retorno = $this->lancarMovimentoCashbackCC($daofactory, $id_usuario, $id_dono, $vllancar, $descricao, ConstantesVariavel::DEBITO);
    $retorno = $this->lancarMovimentoCashbackCC($daofactory, $id_destino, $id_dono, $vllancar, $descricao, ConstantesVariavel::CREDITO);

    // Resgate ok, envia notificação para ambas as partes
    if($retorno->msgcode == ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO){
        // Notifica o dono
        UsuarioNotificacaoHelper::criarUsuarioNotificacaoPorBusiness($daofactory
        , $id_destino
        , $descricao
        , $icone="money.png");

        // Notifica o resgatante
        UsuarioNotificacaoHelper::criarUsuarioNotificacaoPorBusiness($daofactory
        , $id_usuario
        , $descricao
        , $icone="money.png");

    }
    return $retorno;

}


/**
*
* TransferirCashbackCC() - Transfere valor da conta corrente de cashback origem (cliente) e lanca na destino (dono)
*
* @param $daofactory
* @param $id_usuario
* @param $id_dono
* @param $vllancar
* @param $descricao
* @return SaldoGeralCashbackCCDTO
*/

public function TransferirCashbackCC($daofactory, $id_usuario, $id_dono, $vllancar, $descricao)
{

    // Verifica se tem saldo para devolver
    $retorno = $this->getSaldoCashbackCCPeloDono($daofactory, $id_usuario, $id_dono);
    $retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
    $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);

    // se o valor a resgatar for superior ao saldo em conta - emite erro e termina o processo
    if($vllancar > $retorno->vlsldGeral ) {
        $retorno->msgcode = ConstantesMensagem::SALDO_INSUFICIENTE_RESGATE;
        $retorno->msgcodeString = MensagemCache::getInstance()->getMensagemParametrizada($retorno->msgcode,[
            ConstantesVariavel::P1 => $retorno->vlsldGeralMoeda
        ]);
        return $retorno;
    }

    // Obtem as identidades dos usuarios envolvidos
    $usuaDono = UsuarioHelper::getUsuarioBusinessNoKeys($daofactory, $id_dono);
    $usuaResgate = UsuarioHelper::getUsuarioBusinessNoKeys($daofactory, $id_usuario);

    $autenticacao = sha1(Util::getCodigo(2048));
    $vllancarMoeda = Util::getMoeda($vllancar);
    $descricao .= ". Tranferência de $usuaResgate->apelido em favor de $usuaDono->apelido. Valor de $vllancarMoeda. ID Autenticação => $autenticacao" ;

    // Efetua o resgate total
    $retorno = $this->lancarMovimentoCashbackCC($daofactory, $id_usuario, $id_dono, $vllancar, $descricao, ConstantesVariavel::DEBITO);
    $retorno = $this->lancarMovimentoCashbackCC($daofactory, $id_dono, $id_usuario, $vllancar, $descricao, ConstantesVariavel::CREDITO);

    // Resgate ok, envia notificação para ambas as partes
    if($retorno->msgcode == ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO){
        // Notifica o dono
        UsuarioNotificacaoHelper::criarUsuarioNotificacaoPorBusiness($daofactory
        , $id_dono
        , $descricao
        , $icone="money.png");

        // Notifica o resgatante
        UsuarioNotificacaoHelper::criarUsuarioNotificacaoPorBusiness($daofactory
        , $id_usuario
        , $descricao
        , $icone="money.png");

    }
    return $retorno;

}


/**
*
* liquidarCashbackCC() - Liquidar do Cashback e Lança um registro na movimentação do CashbackCC
*
* @param $daofactory
* @param $id_usuario
* @param $id_dono
* @param $vllancar
* @return CampanhaCashbackCCDTO
*/

public function liquidarCashbackCC($daofactory, $id_usuario, $id_dono, $vllancar, $descricao)
{

    // Verifica se tem saldo para devolver
    $retorno = $this->getSaldoCashbackCCPeloDono($daofactory, $id_usuario, $id_dono);
    $retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
    $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);

    // Obtem as identidades dos usuarios envolvidos
    $usuaDono = UsuarioHelper::getUsuarioBusinessNoKeys($daofactory, $id_dono);
    $usuaResgate = UsuarioHelper::getUsuarioBusinessNoKeys($daofactory, $id_usuario);

    $autenticacao = sha1(Util::getCodigo(2048));
    if($descricao == NULL || $descricao == ''){
        $descricao = "liquidação de conta $usuaResgate->apelido :: autenticação => $autenticacao" ;
    } else {
        $descricao .=  " - liquidação de conta $usuaResgate->apelido :: autenticação => $autenticacao"  ;
    }

    // Efetua o resgate total
    $retorno = $this->lancarMovimentoCashbackCC($daofactory, $id_dono, $id_usuario, $vllancar, $descricao, ConstantesVariavel::DEBITO);

    // Resgate ok, envia notificação para ambas as partes
    if($retorno->msgcode == ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO){

        
        // Notifica o dono
        UsuarioNotificacaoHelper::criarUsuarioNotificacaoPorBusiness($daofactory
        ,$id_dono
        , MensagemCache::getInstance()->getMensagemParametrizada( ConstantesMensagem::NOTIFICACAO_LIQUIDACAO_DONO, [
            ConstantesVariavel::P1 => $usuaDono->apelido,
            ConstantesVariavel::P2 => $retorno->vlCalcRecompensaMoeda,
            ConstantesVariavel::P3 => $usuaResgate->apelido,
            ]) 
        , $icone="money.png");
        
/*
        // Notifica o resgatante
        UsuarioNotificacaoHelper::criarUsuarioNotificacaoPorBusiness($daofactory
        ,$id_usuario
        , MensagemCache::getInstance()->getMensagemParametrizada( ConstantesMensagem::NOTIFICACAO_DEBITO_CLIENTE, [
            ConstantesVariavel::P1 => $usuaResgate->apelido,
            ConstantesVariavel::P2 => $retorno->vlCalcRecompensaMoeda,
            ConstantesVariavel::P3 => $usuaDono->apelido,
        ]) 
        , $icone="money.png");
*/
    }
    return $retorno;

}


/**
*
* CreditarCashbackCC() - Resgate Total do Cashback e Lança um registro na movimentação do CashbackCC
*
* @param $daofactory
* @param $id_usuario
* @param $id_dono
* @param $vllancar
* @return CampanhaCashbackCCDTO
*/

public function CreditarCashbackCC($daofactory, $id_usuario, $id_dono, $vllancar, $descricao)
{

    // Verifica se tem saldo para devolver
    $retorno = $this->getSaldoCashbackCCPeloDono($daofactory, $id_usuario, $id_dono);
    $retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
    $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);

    $autenticacao = sha1(Util::getCodigo(2048));
    if($descricao == NULL || $descricao == ''){
        $descricao = "Credito autenticação => $autenticacao" ;
    } else {
        $descricao .=  " - autenticação => $autenticacao"  ;
    }

    // Efetua o resgate total
    $retorno = $this->lancarMovimentoCashbackCC($daofactory, $id_usuario, $id_dono, $vllancar, $descricao, ConstantesVariavel::CREDITO);

    // Resgate ok, envia notificação para ambas as partes
    if($retorno->msgcode == ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO){

        // Obtem as identidades dos usuarios envolvidos
        $usuaDono = UsuarioHelper::getUsuarioBusinessNoKeys($daofactory, $id_dono);
        $usuaResgate = UsuarioHelper::getUsuarioBusinessNoKeys($daofactory, $id_usuario);

        // Notifica o dono
        UsuarioNotificacaoHelper::criarUsuarioNotificacaoPorBusiness($daofactory
        ,$id_dono
        , MensagemCache::getInstance()->getMensagemParametrizada( ConstantesMensagem::NOTIFICACAO_CREDITO_DONO, [
            ConstantesVariavel::P1 => $usuaDono->apelido,
            ConstantesVariavel::P2 => $retorno->vlCalcRecompensaMoeda,
            ConstantesVariavel::P3 => $usuaResgate->apelido,
        ]) 
        , $icone="money.png");

        // Notifica o resgatante
        UsuarioNotificacaoHelper::criarUsuarioNotificacaoPorBusiness($daofactory
        ,$id_usuario
        , MensagemCache::getInstance()->getMensagemParametrizada( ConstantesMensagem::NOTIFICACAO_CREDITO_CLIENTE, [
            ConstantesVariavel::P1 => $usuaResgate->apelido,
            ConstantesVariavel::P2 => $retorno->vlCalcRecompensaMoeda,
            ConstantesVariavel::P3 => $usuaDono->apelido,
        ]) 
        , $icone="money.png");

    }
    return $retorno;

}

/**
*
* ResgatarTotalCashbackCC() - Resgate Total do Cashback e Lança um registro na movimentação do CashbackCC
*
* @param $daofactory
* @param $id_usuario
* @param $id_dono
* @param $vllancar
* @param $tipolancar
* @param $numdias
* @return CampanhaCashbackCCDTO
*/

    public function ResgatarTotalCashbackCC($daofactory, $id_usuario, $id_dono, $vllancar, $descricao, $tipolancar='D')
    {
    
        // Verifica se tem saldo para devolver
        $retorno = $this->getSaldoCashbackCCPeloDono($daofactory, $id_usuario, $id_dono);
        $retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
        $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);

        // se o valor a resgatar for superior ao saldo em conta - emite erro e termina o processo
        if($vllancar > $retorno->vlsldGeral ) {
            $retorno->msgcode = ConstantesMensagem::SALDO_INSUFICIENTE_RESGATE;
            $retorno->msgcodeString = MensagemCache::getInstance()->getMensagemParametrizada($retorno->msgcode,[
                ConstantesVariavel::P1 => $retorno->vlsldGeralMoeda
            ]);
            return $retorno;
        }

        // Efetua o resgate total
        $retorno = $this->lancarMovimentoCashbackCC($daofactory, $id_usuario, $id_dono, $vllancar, $descricao, $tipolancar);

        // Resgate ok, envia notificação para ambas as partes
        if($retorno->msgcode == ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO){

            // Obtem as identidades dos usuarios envolvidos
            $usuaDono = UsuarioHelper::getUsuarioBusinessNoKeys($daofactory, $id_dono);
            $usuaResgate = UsuarioHelper::getUsuarioBusinessNoKeys($daofactory, $id_usuario);

            // Notifica o dono
            UsuarioNotificacaoHelper::criarUsuarioNotificacaoPorBusiness($daofactory
            ,$id_dono
            , MensagemCache::getInstance()->getMensagemParametrizada( ConstantesMensagem::NOTIFICACAO_RESGATE_TOTAL_DONO, [
                ConstantesVariavel::P1 => $usuaDono->apelido,
                ConstantesVariavel::P2 => $retorno->vlCalcRecompensaMoeda,
                ConstantesVariavel::P3 => $usuaResgate->apelido,
            ]) 
            , $icone="money.png");

            // Notifica o resgatante
            UsuarioNotificacaoHelper::criarUsuarioNotificacaoPorBusiness($daofactory
            ,$id_usuario
            , MensagemCache::getInstance()->getMensagemParametrizada( ConstantesMensagem::NOTIFICACAO_RESGATE_TOTAL_RESGATANTE, [
                ConstantesVariavel::P1 => $usuaResgate->apelido,
                ConstantesVariavel::P2 => $retorno->vlCalcRecompensaMoeda,
                ConstantesVariavel::P3 => $usuaDono->apelido,
            ]) 
            , $icone="money.png");

        }
        return $retorno;

    }

/**
*
* lancarMovimentoCashbackCC() - Lança um registro na movimentação do CashbackCC
*
* @param $daofactory
* @param $id_usuario
* @param $id_dono
* @param $vllancar
* @param $tipolancar
* @param $numdias
* @return CampanhaCashbackCCDTO
*/
    public function lancarMovimentoCashbackCC($daofactory, $id_usuario, $id_dono, $vllancar, $descricao, $tipolancar='C')
    { 
        $retorno = new CampanhaCashbackCCDTO();
        $retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
        $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);

        $vllancar = $tipolancar == ConstantesVariavel::CREDITO ? $vllancar : $vllancar * -1;

        $dao = $daofactory->getCampanhaCashbackCCDAO($daofactory);
        
        $retorno->id_usuario = $id_usuario;
        $retorno->descricao = $descricao;
        $retorno->tipoMovimento = $tipolancar;
        $retorno->status = ConstantesVariavel::STATUS_ATIVO;
        
        $retorno->id_dono = $id_dono;
        $retorno->vlConsumo = 0;
        $retorno->vlCalcRecompensa = $vllancar;
        $retorno->vlCalcRecompensaMoeda = Util::getMoeda($retorno->vlCalcRecompensa);

        $dao = $daofactory->getCampanhaCashbackCCDAO($daofactory);
        if(! $dao->insertMovimentoCC($retorno)){
            $retorno->msgcode = ConstantesMensagem::ERRO_INSERIR_REGISTRO_DE_SALDO;
            $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);
        }

        return $retorno;
    }


/**
*
* listarMovimentoCashbackCC() - Listar a movimentação do CC de cashback do usuário
* no nível de detalhe
*
* @param $id_usuario
* @param $numdias
* @return CampanhaCashbackCCDTO[]
*/
    public function listarMovimentoCashbackCC($daofactory, $id_usuario, $id_dono, $numdias=7)
    {
        // retorno default
        $retorno = new SaldoGeralCashbackCCDTO();
        $retorno->id_usuario = $id_usuario;
        $retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
        $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);
        
        // Popula dados do usuário no saldo geral
        //$retorno->usuario = UsuarioHelper::getUsuarioBusinessNoKeys($daofactory, $id_usuario);

        // Obtém uma interface de acesso aos dados da Campanha Cashback Conta Corrente
        $dao = $daofactory->getCampanhaCashbackCCDAO($daofactory);

        // Obtem o  ID mais antrecente do saldo da cashback CC do usuário e dono (se tiver)
        // recupera o movimento de saldo gerado pelo ID
        $idSaldoUsuarioDonoCC = $dao->loadMaxId_CashbackSaldoCCDiasAtras($id_usuario, $id_dono, $numdias);
   
        // Encontrou saldo anterior?
        if($idSaldoUsuarioDonoCC == 0){
            $retorno->vlGeralConsumo = 0.00;
            $retorno->vlsldGeral = 0.00;
        } else {
            // Carrega os dados do saldo
            $dto = $this->carregarPorID($daofactory, $idSaldoUsuarioDonoCC);
            $retorno->vlGeralConsumo = $dto->vlConsumo;
            $retorno->vlsldGeral = $dto->vlCalcRecompensa;
        }
        $retorno->sldUsuarioDono = $dao->listMovimentoCashbackCCDesdeIdSaldo($idSaldoUsuarioDonoCC, $id_usuario, $id_dono);

        // retorna situação
        return $retorno;


    }

/**
*
* registrarSaldoCashbackCC() - Registra o saldo calculado por @see getSaldoCashbackCC()
* e grava no registro na tabela de conta corrente de cashback do usuario
*
* @param $daofactory
* @param $id_usuario
* @return SaldoGeralCashbackCCDTO
*/
    public function registrarSaldoCashbackCC($daofactory,$id_usuario )
    {
        $movcc = new CampanhaCashbackCCDTO();
        $movcc->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
        $movcc->msgcodeString = MensagemCache::getInstance()->getMensagem($movcc->msgcode);

        // retorna um SaldoGeralCashbackCCDTO
        $dtosaldo = $this->getSaldoCashbackCC($daofactory, $id_usuario);

        if($dtosaldo != NULL && count($dtosaldo->sldUsuarioDono) > 0){

            $movcc->id_usuario = $id_usuario;
            $movcc->descricao = "Saldo";
            $movcc->tipoMovimento = ConstantesVariavel::SALDO;
            
            foreach ($dtosaldo->sldUsuarioDono as $key => $sudccdto) {
                $movcc->id_dono = $sudccdto->id_dono;
                $movcc->vlConsumo = $sudccdto->vlconsumo;
                $movcc->vlCalcRecompensa = $sudccdto->vlsld;

                $dao = $daofactory->getCampanhaCashbackCCDAO($daofactory);
                if(! $dao->insertMovimentoCC($movcc)){
                    $movcc->msgcode = ConstantesMensagem::ERRO_INSERIR_REGISTRO_DE_SALDO;
                    $movcc->msgcodeString = MensagemCache::getInstance()->getMensagem($movcc->msgcode);
                }
            }


        }


        return $movcc;
        
    }

    
/**
* getSaldoCashbackCCPeloDono() - Obtem o saldo das contas de cashback do usuario e totaliza em um único
* objeto
*
* @param $daofactory
* @param $id_usuario
* @param $id_dono
* @return $SaldoGeralCashbackCCDTO
*/ 
public function getSaldoCashbackCCPeloDono($daofactory, $id_usuario, $id_dono)
{
    // retorno default
    $retorno = new SaldoGeralCashbackCCDTO();
    $retorno->id_usuario = $id_usuario;
    $retorno->vlGeralConsumo = 0.00;
    $retorno->vlsldGeral = 0.00;
    $retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
    $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);

    // Popula dados do usuário no saldo geral
    $retorno->usuario = UsuarioHelper::getUsuarioBusinessNoKeys($daofactory, $id_usuario);

    // Obtém uma interface de acesso aos dados da Campanha Cashback Conta Corrente
    $dao = $daofactory->getCampanhaCashbackCCDAO($daofactory);

    // Busca o registro do $id_usuario para popular DTO

    // Busca a lista DISTINTA de conta corrente item do $id_usuario
    $lstIdDonos = $dao->listUsuarioSomenteDono($id_usuario, $id_dono);

    // O usuário tem movimento na conta corrente?
    if($lstIdDonos != NULL && count($lstIdDonos) > 0){

        // Percorre todos os elementos (IdDonos)
        foreach ($lstIdDonos as $key => $value) {
            $id_usuario_dono = $value;

            // Obtem o maior ID do saldo da cashback CC do usuário e dono (se tiver)
            // recupera o movimento de saldo gerado pelo ID
            $idSaldoDonoCC = $dao->loadId_CashbackSaldoCC($id_usuario, $id_usuario_dono);

            // Inicializa saldo quebrado por usuario dono cashback e consumo
            $sudcashccdto = new SaldoUsuarioDonoCashbackCCDTO();
            $sudcashccdto->id_usuario = $id_usuario;
            $sudcashccdto->id_dono = $id_usuario_dono;
            //$sudcashccdto->dono = $usbo->carregarPorID($daofactory, $id_usuario_dono);
            $sudcashccdto->dono = UsuarioHelper::getUsuarioBusinessNoKeys($daofactory, $id_usuario_dono);

            // Existe um saldo calculado ?
            if($idSaldoDonoCC == NULL){
                $idSaldoDonoCC = 0;
                $sudcashccdto->id = $idSaldoDonoCC;
                $sudcashccdto->vlconsumo = 0;
                $sudcashccdto->vlsld = 0;
                $sudcashccdto->vlconsumoMoeda = Util::getMoeda($sudcashccdto->vlconsumo);
                $sudcashccdto->vlsldMoeda = Util::getMoeda($sudcashccdto->vlsld);
            } else {
                $cashccitem = $this->carregarPorID($daofactory, $idSaldoDonoCC);

                // Acumula saldo geral cashback e consumo
                $retorno->vlGeralConsumo += $cashccitem->vlConsumo;
                $retorno->vlsldGeral += $cashccitem->vlCalcRecompensa;
                $retorno->vlGeralConsumoMoeda = Util::getMoeda($retorno->vlGeralConsumo);
                $retorno->vlsldGeralMoeda = Util::getMoeda($retorno->vlsldGeral);
            
                $sudcashccdto->id = $idSaldoDonoCC;
                $sudcashccdto->vlconsumo = $cashccitem->vlConsumo;
                $sudcashccdto->vlsld = $cashccitem->vlCalcRecompensa;
                $sudcashccdto->vlconsumoMoeda = Util::getMoeda($sudcashccdto->vlconsumo);
                $sudcashccdto->vlsldMoeda = Util::getMoeda($sudcashccdto->vlsld);
            }

            // Busca toda a movimentação de Cashback CC a partir do saldo
            $movcc = $dao->sumMovimentoCashbackSaldoCC($id_usuario, $id_usuario_dono, $idSaldoDonoCC);

            // Array com somatorios do consumo e da recompensa
            if(count($movcc) == 2) {
                $retorno->vlGeralConsumo += $movcc[0];
                $retorno->vlsldGeral += $movcc[1];
                $retorno->vlGeralConsumoMoeda = Util::getMoeda($retorno->vlGeralConsumo);
                $retorno->vlsldGeralMoeda = Util::getMoeda($retorno->vlsldGeral);

                $sudcashccdto->vlconsumo += $movcc[0];
                $sudcashccdto->vlsld += $movcc[1];
                $sudcashccdto->vlconsumoMoeda = Util::getMoeda($sudcashccdto->vlconsumo);
                $sudcashccdto->vlsldMoeda = Util::getMoeda($sudcashccdto->vlsld);
            }

            // Tem saldo?
            if ($sudcashccdto->vlsld > 0){
                $retorno->sldUsuarioDono[] = $sudcashccdto;
            }
        }
    }

    // retorna situação
    return $retorno;


}

/**
* getSaldoCashbackCC() - Obtem o saldo das contas de cashback do usuario e totaliza em um único
* objeto
*
* @param $daofactory
* @param $id_usuario
* @return $SaldoGeralCashbackCCDTO
*/ 
    public function getSaldoCashbackCC($daofactory, $id_usuario)
    {
        // retorno default
        $retorno = new SaldoGeralCashbackCCDTO();
        $retorno->id_usuario = $id_usuario;
        $retorno->vlGeralConsumo = 0.00;
        $retorno->vlsldGeral = 0.00;
        $retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
        $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);

        // Popula dados do usuário no saldo geral
        $retorno->usuario = UsuarioHelper::getUsuarioBusinessNoKeys($daofactory, $id_usuario);

        // Obtém uma interface de acesso aos dados da Campanha Cashback Conta Corrente
        $dao = $daofactory->getCampanhaCashbackCCDAO($daofactory);

        // Busca o registro do $id_usuario para popular DTO

        // Busca a lista DISTINTA de conta corrente item do $id_usuario
        $lstIdDonos = $dao->listUsuarioDono($id_usuario);

        // O usuário tem movimento na conta corrente?
        if($lstIdDonos != NULL && count($lstIdDonos) > 0){

            // Percorre todos os elementos (IdDonos)
            foreach ($lstIdDonos as $key => $value) {
                $id_usuario_dono = $value;

                // Obtem o maior ID do saldo da cashback CC do usuário e dono (se tiver)
                // recupera o movimento de saldo gerado pelo ID
                $idSaldoDonoCC = $dao->loadId_CashbackSaldoCC($id_usuario, $id_usuario_dono);

                // Inicializa saldo quebrado por usuario dono cashback e consumo
                $sudcashccdto = new SaldoUsuarioDonoCashbackCCDTO();
                $sudcashccdto->id_usuario = $id_usuario;
                $sudcashccdto->id_dono = $id_usuario_dono;
                //$sudcashccdto->dono = $usbo->carregarPorID($daofactory, $id_usuario_dono);
                $sudcashccdto->dono = UsuarioHelper::getUsuarioBusinessNoKeys($daofactory, $id_usuario_dono);

                $uscabo = new UsuarioCashbackBusinessImpl();
                $sudcashccdto->usca = $uscabo->PesquisarMaxPKAtivoId_UsuarioPorStatus($daofactory, $id_usuario_dono, ConstantesVariavel::STATUS_ATIVO);

                // Existe um saldo calculado ?
                if($idSaldoDonoCC == NULL){
                    $idSaldoDonoCC = 0;
                    $sudcashccdto->id = $idSaldoDonoCC;
                    $sudcashccdto->vlconsumo = 0;
                    $sudcashccdto->vlsld = 0;
                    $sudcashccdto->vlconsumoMoeda = Util::getMoeda($sudcashccdto->vlconsumo);
                    $sudcashccdto->vlsldMoeda = Util::getMoeda($sudcashccdto->vlsld);
                } else {
                    $cashccitem = $this->carregarPorID($daofactory, $idSaldoDonoCC);
    
                    // Acumula saldo geral cashback e consumo
                    $retorno->vlGeralConsumo += $cashccitem->vlConsumo;
                    $retorno->vlsldGeral += $cashccitem->vlCalcRecompensa;
                    $retorno->vlGeralConsumoMoeda = Util::getMoeda($retorno->vlGeralConsumo);
                    $retorno->vlsldGeralMoeda = Util::getMoeda($retorno->vlsldGeral);
                
                    $sudcashccdto->id = $idSaldoDonoCC;
                    $sudcashccdto->vlconsumo = $cashccitem->vlConsumo;
                    $sudcashccdto->vlsld = $cashccitem->vlCalcRecompensa;
                    $sudcashccdto->vlconsumoMoeda = Util::getMoeda($sudcashccdto->vlconsumo);
                    $sudcashccdto->vlsldMoeda = Util::getMoeda($sudcashccdto->vlsld);
                }

                // Busca toda a movimentação de Cashback CC a partir do saldo
                $movcc = $dao->sumMovimentoCashbackSaldoCC($id_usuario, $id_usuario_dono, $idSaldoDonoCC);

                // Array com somatorios do consumo e da recompensa
                if(count($movcc) == 2) {
                    $retorno->vlGeralConsumo += $movcc[0];
                    $retorno->vlsldGeral += $movcc[1];
                    $retorno->vlGeralConsumoMoeda = Util::getMoeda($retorno->vlGeralConsumo);
                    $retorno->vlsldGeralMoeda = Util::getMoeda($retorno->vlsldGeral);

                    $sudcashccdto->vlconsumo += $movcc[0];
                    $sudcashccdto->vlsld += $movcc[1];
                    $sudcashccdto->vlconsumoMoeda = Util::getMoeda($sudcashccdto->vlconsumo);
                    $sudcashccdto->vlsldMoeda = Util::getMoeda($sudcashccdto->vlsld);
                }

                // tem saldo no cashback do cliente?
                if ($sudcashccdto->vlsld > 0){
                    $retorno->sldUsuarioDono[] = $sudcashccdto;
                }
            }
        }

        // retorna situação
        return $retorno;


    }

/**
* carregar() - Carrega apenas um registro com base no campo id = (CAMPANHA_CASHBACK_CC::CACC_ID)
* @param $daofactory
* @param $dto
* @return $dto
*/ 
    public function carregar($daofactory, $dto) {   }

/**
* listarTudo() - Lista todos os registros provenientes de CAMPANHA_CASHBACK_CC sem critério de paginação
* @param $daofactory
* @return List<CampanhaCashbackCCDTO>[]
*/ 
    public function listarTudo($daofactory) {   }

/**
* atualizar() - atualiza apenas um registro com base no dto CampanhaCashbackCCDTO->id
* @param $daofactory
*
* @return $dto
* @see ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO
* @see ConstantesMensagem::ERRO_CRUD_ATUALIZAR_REGISTRO
*/ 

    public function atualizar($daofactory, $dto)    
    {   
        // retorno default
        $retorno = new DTOPadrao();
        $retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
        $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);


        $dao = $daofactory->getCampanhaCashbackCCDAO($daofactory);
        if(!$dao->update($dto)){
           $retorno->msgcode = ConstantesMensagem::ERRO_CRUD_ATUALIZAR_REGISTRO;
           $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);
    
        }
        // retorna situação
        return $retorno;

    }

/**
* deletar() - excluir fisicamente um registro com base no dto CampanhaCashbackCCDTO->id
* @param $daofactory
*
* @return $dto
* @see ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO
* @see ConstantesMensagem::ERRO_CRUD_EXCLUIR_REGISTRO
*/ 
    
    public function deletar($daofactory, $dto)  
    {   
        // retorno default
        $retorno = new DTOPadrao();
        $retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
        $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);
        $dao = $daofactory->getCampanhaCashbackCCDAO($daofactory);

        if(!$dao->delete($dto)){
           $retorno->msgcode = ConstantesMensagem::ERRO_CRUD_EXCLUIR_REGISTRO;
           $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);
        }

        return $retorno;
    }

/**
* listarPagina() - listar registros de forma paginada
* @param $daofactory
* @param $pag
* @param $qtde
*
* @return List<CampanhaCashbackCCDTO>[]
* @deprecated
*/ 

    public function listarPagina($daofactory, $pag, $qtde)  
    {   
        $dao = $daofactory->getCampanhaCashbackCCDAO($daofactory);
        return $dao->listPagina($pag, $qtde);
    }

/**
* carregarPorID() - Carrega APENAS um registro usando a id como item de busca
* na tabela CAMPANHA_CASHBACK_CC usando a Primary Key CACC_ID
*
* @param $daofactory
* @param $id
* @param $qtde
*
* @return CampanhaCashbackCCDTO
*/ 
    public function carregarPorID($daofactory, $id)
    { 
        $dao = $daofactory->getCampanhaCashbackCCDAO($daofactory);
        return $dao->loadPK($id);
    }

/**
* atualizarStatus() - atualizar o campo de STATUS utilizando a id como item de busca
* na tabela CAMPANHA_CASHBACK_CC usando a Primary Key CACC_ID
*
* @param $daofactory
* @param $id
* @param $status
*
* @return CampanhaCashbackCCDTO
*/ 
    public function atualizarStatus($daofactory, $id, $status)
    {
        $dao = $daofactory->getCampanhaCashbackCCDAO($daofactory);

        // resposta padrão
        $retorno = new DTOPadrao();

        // obtem o status atual da campanha
        $dto = $this->carregarPorID($daofactory, $id);

            if($dao->updateStatus($id, $status)){   
                $retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
            }       

        // Obtem o texto da mensagem em razão do código de retorno
        $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);

        return $retorno;
    }

/**
* inserir() - inserir um registro com base no CampanhaCashbackCCDTO. Alguns atributos dentro do DTO
* serão ignorados caso estejam populados.
*
* Atributos da classe CampanhaCashbackCCDTO sumariamente IGNORADOS por este método MESMO que estejam preenchidos:
* id
* status
* dataCadastro
* dataAtualizacao
*
* @param $daofactory
*
* @return DTOPadrao
*/ 
public function inserir($daofactory, $dto)
{ 
    $retorno = new DTOPadrao();
    $retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
    $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);

    // Efetua validações no campo $dto->id com tamanho 11
    $ok = $this->validarTamanhoCampo($dto->id, 11, 'ID da Conta Corrente Cashback');
    if($ok->msgcode != ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO){
        return $ok;
    }

    // Efetua validações no campo $dto->id_cashback com tamanho 11
    $ok = $this->validarTamanhoCampo($dto->id_cashback, 11, 'ID da campanha x cashback');
    if($ok->msgcode != ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO){
        return $ok;
    }

    // Efetua validações no campo $dto->id_campanha com tamanho 11
    $ok = $this->validarTamanhoCampo($dto->id_campanha, 11, 'ID da campanha');
    if($ok->msgcode != ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO){
        return $ok;
    }

    // Efetua validações no campo $dto->id_usuario com tamanho 11
    $ok = $this->validarTamanhoCampo($dto->id_usuario, 11, 'ID do usuário');
    if($ok->msgcode != ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO){
        return $ok;
    }

    // Efetua validações no campo $dto->id_cfdi com tamanho 11
    $ok = $this->validarTamanhoCampo($dto->id_cfdi, 11, 'ID do carimbo efetuado no cartão');
    if($ok->msgcode != ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO){
        return $ok;
    }

    // Efetua validações no campo $dto->descricao com tamanho 500
    $ok = $this->validarTamanhoCampo($dto->descricao, 500, 'Cópia da descrição');
    if($ok->msgcode != ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO){
        return $ok;
    }

    // Efetua validações no campo $dto->vlMinimo com tamanho 10
    $ok = $this->validarTamanhoCampo($dto->vlMinimo, 10, 'Valor para permitir cashback');
    if($ok->msgcode != ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO){
        return $ok;
    }

    // Efetua validações no campo $dto->percentual com tamanho 4
    $ok = $this->validarTamanhoCampo($dto->percentual, 4, 'Cópia do perc. cashback');
    if($ok->msgcode != ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO){
        return $ok;
    }

    // Efetua validações no campo $dto->vlConsumo com tamanho 10
    $ok = $this->validarTamanhoCampo($dto->vlConsumo, 10, 'Valor do consumo');
    if($ok->msgcode != ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO){
        return $ok;
    }

    // Efetua validações no campo $dto->vlCalcRecompensa com tamanho 10
    $ok = $this->validarTamanhoCampo($dto->vlCalcRecompensa, 10, 'Valor da recompensa');
    if($ok->msgcode != ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO){
        return $ok;
    }

    // Efetua validações no campo $dto->tipoMovimento com tamanho 1
    $ok = $this->validarTamanhoCampo($dto->tipoMovimento, 1, 'Tipo do movimento');
    if($ok->msgcode != ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO){
        return $ok;
    }

    // Efetua validações no campo $dto->nfe com tamanho 2000
    $ok = $this->validarTamanhoCampo($dto->nfe, 2000, 'NF Eletrônica');
    if($ok->msgcode != ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO){
        return $ok;
    }

    // Efetua validações no campo $dto->nfehash com tamanho 2000
    $ok = $this->validarTamanhoCampo($dto->nfehash, 2000, 'Hash NFE');
    if($ok->msgcode != ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO){
        return $ok;
    }

    $dto->status = ConstantesVariavel::STATUS_ATIVO;
    $dao = $daofactory->getCampanhaCashbackCCDAO($daofactory);
    if (!$dao->insert($dto)) {
        $retorno = new DTOPadrao();
        $retorno->msgcode = ConstantesMensagem::ERRO_CRUD_INSERIR_REGISTRO;
        $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);
    }

    return $retorno;
}

/**
*
* listarCampanhaCashbackCCPorStatus() - Usado para invocar a interface de acesso aos dados (DAO) CampanhaCashbackCCDAO de forma geral
* realizar lista paginada de registros com uma instância de PaginacaoDTO
*
* @param $daofactory
* @param $status
* @param $pag
* @param $qtde
* @param $coluna
* @param $ordem
* @return $PaginacaoDTO
*/

    public function listarCampanhaCashbackCCPorStatus($daofactory, $status, $pag, $qtde, $coluna, $ordem)
    {   
        $retorno = new DTOPaginacao();
        $retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
        $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);

        $dao = $daofactory->getCampanhaCashbackCCDAO($daofactory);
        $retorno->pagina = $pag;
        $retorno->itensPorPagina = ($qtde == 0 
        ? (int) VariavelCache::getInstance()->getVariavel(ConstantesVariavel::MAXIMO_LINHAS_POR_PAGINA_DEFAULT)
        : $qtde);
        $retorno->totalPaginas = ceil($dao->countCampanhaCashbackCCPorStatus($status) / $retorno->itensPorPagina);

        if($pag > $retorno->totalPaginas) {
            $retorno->msgcode = ConstantesMensagem::NAO_EXISTEM_MAIS_PAGINAS_APRESENTAR;
            $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);
            return $retorno;
        }
        $retorno->lst = $dao->listCampanhaCashbackCCPorStatus($status, $pag, $qtde, $coluna, $ordem);

        return $retorno;
    }






/**
*
* atualizarId_CashbackPorPK() - Usado para invocar a classe de negócio CampanhaCashbackCCBusinessImpl de forma geral
* realizar uma atualização de ID da campanha x cashback diretamente na tabela CAMPANHA_CASHBACK_CC campo CACA_ID
* @param $daofactory
* @param $id
* @param $id_cashback
* @return CampanhaCashbackCCDTO
*
* 
*/
    public function atualizarId_CashbackPorPK($daofactory,$id_cashback,$id)
    {
        $dao = $daofactory->getCampanhaCashbackCCDAO($daofactory);

        // resposta padrão
        $retorno = new DTOPadrao();

        if($dao->updateId_Cashback($id, $id_cashback)){   
            $retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
        }       

        // Obtem o texto da mensagem em razão do código de retorno
        $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);

        return $retorno;
    }

/**
*
* atualizarId_CampanhaPorPK() - Usado para invocar a classe de negócio CampanhaCashbackCCBusinessImpl de forma geral
* realizar uma atualização de ID da campanha diretamente na tabela CAMPANHA_CASHBACK_CC campo CAMP_ID
* @param $daofactory
* @param $id
* @param $id_campanha
* @return CampanhaCashbackCCDTO
*
* 
*/
    public function atualizarId_CampanhaPorPK($daofactory,$id_campanha,$id)
    {
        $dao = $daofactory->getCampanhaCashbackCCDAO($daofactory);

        // resposta padrão
        $retorno = new DTOPadrao();

        if($dao->updateId_Campanha($id, $id_campanha)){   
            $retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
        }       

        // Obtem o texto da mensagem em razão do código de retorno
        $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);

        return $retorno;
    }

/**
*
* atualizarId_UsuarioPorPK() - Usado para invocar a classe de negócio CampanhaCashbackCCBusinessImpl de forma geral
* realizar uma atualização de ID do usuário diretamente na tabela CAMPANHA_CASHBACK_CC campo USUA_ID
* @param $daofactory
* @param $id
* @param $id_usuario
* @return CampanhaCashbackCCDTO
*
* 
*/
    public function atualizarId_UsuarioPorPK($daofactory,$id_usuario,$id)
    {
        $dao = $daofactory->getCampanhaCashbackCCDAO($daofactory);

        // resposta padrão
        $retorno = new DTOPadrao();

        if($dao->updateId_Usuario($id, $id_usuario)){   
            $retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
        }       

        // Obtem o texto da mensagem em razão do código de retorno
        $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);

        return $retorno;
    }

/**
*
* atualizarId_CfdiPorPK() - Usado para invocar a classe de negócio CampanhaCashbackCCBusinessImpl de forma geral
* realizar uma atualização de ID do carimbo efetuado no cartão diretamente na tabela CAMPANHA_CASHBACK_CC campo CFDI_ID
* @param $daofactory
* @param $id
* @param $id_cfdi
* @return CampanhaCashbackCCDTO
*
* 
*/
    public function atualizarId_CfdiPorPK($daofactory,$id_cfdi,$id)
    {
        $dao = $daofactory->getCampanhaCashbackCCDAO($daofactory);

        // resposta padrão
        $retorno = new DTOPadrao();

        if($dao->updateId_Cfdi($id, $id_cfdi)){   
            $retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
        }       

        // Obtem o texto da mensagem em razão do código de retorno
        $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);

        return $retorno;
    }

/**
*
* atualizarDescricaoPorPK() - Usado para invocar a classe de negócio CampanhaCashbackCCBusinessImpl de forma geral
* realizar uma atualização de Cópia da descrição diretamente na tabela CAMPANHA_CASHBACK_CC campo CACC_TX_DESCRICAO
* @param $daofactory
* @param $id
* @param $descricao
* @return CampanhaCashbackCCDTO
*
* 
*/
    public function atualizarDescricaoPorPK($daofactory,$descricao,$id)
    {
        $dao = $daofactory->getCampanhaCashbackCCDAO($daofactory);

        // resposta padrão
        $retorno = new DTOPadrao();

        if($dao->updateDescricao($id, $descricao)){   
            $retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
        }       

        // Obtem o texto da mensagem em razão do código de retorno
        $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);

        return $retorno;
    }

/**
*
* atualizarVlminimoPorPK() - Usado para invocar a classe de negócio CampanhaCashbackCCBusinessImpl de forma geral
* realizar uma atualização de Valor para permitir cashback diretamente na tabela CAMPANHA_CASHBACK_CC campo CACC_VL_MIN
* @param $daofactory
* @param $id
* @param $vlMinimo
* @return CampanhaCashbackCCDTO
*
* 
*/
    public function atualizarVlminimoPorPK($daofactory,$vlMinimo,$id)
    {
        $dao = $daofactory->getCampanhaCashbackCCDAO($daofactory);

        // resposta padrão
        $retorno = new DTOPadrao();

        if($dao->updateVlminimo($id, $vlMinimo)){   
            $retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
        }       

        // Obtem o texto da mensagem em razão do código de retorno
        $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);

        return $retorno;
    }

/**
*
* atualizarPercentualPorPK() - Usado para invocar a classe de negócio CampanhaCashbackCCBusinessImpl de forma geral
* realizar uma atualização de Cópia do perc. cashback diretamente na tabela CAMPANHA_CASHBACK_CC campo CACC_VL_PERC_CASHBACK
* @param $daofactory
* @param $id
* @param $percentual
* @return CampanhaCashbackCCDTO
*
* 
*/
    public function atualizarPercentualPorPK($daofactory,$percentual,$id)
    {
        $dao = $daofactory->getCampanhaCashbackCCDAO($daofactory);

        // resposta padrão
        $retorno = new DTOPadrao();

        if($dao->updatePercentual($id, $percentual)){   
            $retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
        }       

        // Obtem o texto da mensagem em razão do código de retorno
        $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);

        return $retorno;
    }

/**
*
* atualizarVlconsumoPorPK() - Usado para invocar a classe de negócio CampanhaCashbackCCBusinessImpl de forma geral
* realizar uma atualização de Valor do consumo diretamente na tabela CAMPANHA_CASHBACK_CC campo CACC_VL_CONSUMO
* @param $daofactory
* @param $id
* @param $vlConsumo
* @return CampanhaCashbackCCDTO
*
* 
*/
    public function atualizarVlconsumoPorPK($daofactory,$vlConsumo,$id)
    {
        $dao = $daofactory->getCampanhaCashbackCCDAO($daofactory);

        // resposta padrão
        $retorno = new DTOPadrao();

        if($dao->updateVlconsumo($id, $vlConsumo)){   
            $retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
        }       

        // Obtem o texto da mensagem em razão do código de retorno
        $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);

        return $retorno;
    }

/**
*
* atualizarVlcalcrecompensaPorPK() - Usado para invocar a classe de negócio CampanhaCashbackCCBusinessImpl de forma geral
* realizar uma atualização de Valor da recompensa diretamente na tabela CAMPANHA_CASHBACK_CC campo CACC_VL_RECOMPENSA
* @param $daofactory
* @param $id
* @param $vlCalcRecompensa
* @return CampanhaCashbackCCDTO
*
* 
*/
    public function atualizarVlcalcrecompensaPorPK($daofactory,$vlCalcRecompensa,$id)
    {
        $dao = $daofactory->getCampanhaCashbackCCDAO($daofactory);

        // resposta padrão
        $retorno = new DTOPadrao();

        if($dao->updateVlcalcrecompensa($id, $vlCalcRecompensa)){   
            $retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
        }       

        // Obtem o texto da mensagem em razão do código de retorno
        $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);

        return $retorno;
    }

/**
*
* atualizarTipomovimentoPorPK() - Usado para invocar a classe de negócio CampanhaCashbackCCBusinessImpl de forma geral
* realizar uma atualização de Tipo do movimento diretamente na tabela CAMPANHA_CASHBACK_CC campo CACC_IN_TIPO
* @param $daofactory
* @param $id
* @param $tipoMovimento
* @return CampanhaCashbackCCDTO
*
* 
*/
    public function atualizarTipomovimentoPorPK($daofactory,$tipoMovimento,$id)
    {
        $dao = $daofactory->getCampanhaCashbackCCDAO($daofactory);

        // resposta padrão
        $retorno = new DTOPadrao();

        if($dao->updateTipomovimento($id, $tipoMovimento)){   
            $retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
        }       

        // Obtem o texto da mensagem em razão do código de retorno
        $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);

        return $retorno;
    }

/**
*
* atualizarNfePorPK() - Usado para invocar a classe de negócio CampanhaCashbackCCBusinessImpl de forma geral
* realizar uma atualização de NF Eletrônica diretamente na tabela CAMPANHA_CASHBACK_CC campo CACC_TX_NFE
* @param $daofactory
* @param $id
* @param $nfe
* @return CampanhaCashbackCCDTO
*
* 
*/
    public function atualizarNfePorPK($daofactory,$nfe,$id)
    {
        $dao = $daofactory->getCampanhaCashbackCCDAO($daofactory);

        // resposta padrão
        $retorno = new DTOPadrao();

        if($dao->updateNfe($id, $nfe)){   
            $retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
        }       

        // Obtem o texto da mensagem em razão do código de retorno
        $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);

        return $retorno;
    }

/**
*
* pesquisarPorId_Cashback() - Usado para invocar a classe de negócio CampanhaCashbackCCBusinessImpl de forma geral
* realizar uma busca de ID da campanha x cashback diretamente na tabela CAMPANHA_CASHBACK_CC campo CACA_ID
*
* @param $id_cashback
* @return CampanhaCashbackCCDTO
*
* 
*/
    public function pesquisarPorId_Cashback($daofactory,$id_cashback)
    { 
        $dao = $daofactory->getCampanhaCashbackCCDAO($daofactory);
        return $dao->loadId_Cashback($id_cashback);
    }

/**
*
* pesquisarPorId_Campanha() - Usado para invocar a classe de negócio CampanhaCashbackCCBusinessImpl de forma geral
* realizar uma busca de ID da campanha diretamente na tabela CAMPANHA_CASHBACK_CC campo CAMP_ID
*
* @param $id_campanha
* @return CampanhaCashbackCCDTO
*
* 
*/
    public function pesquisarPorId_Campanha($daofactory,$id_campanha)

    { 
        $dao = $daofactory->getCampanhaCashbackCCDAO($daofactory);
        return $dao->loadId_Campanha($id_campanha);
    }

/**
*
* pesquisarPorId_Usuario() - Usado para invocar a classe de negócio CampanhaCashbackCCBusinessImpl de forma geral
* realizar uma busca de ID do usuário diretamente na tabela CAMPANHA_CASHBACK_CC campo USUA_ID
*
* @param $id_usuario
* @return CampanhaCashbackCCDTO
*
* 
*/
    public function pesquisarPorId_Usuario($daofactory,$id_usuario)

    { 
        $dao = $daofactory->getCampanhaCashbackCCDAO($daofactory);
        return $dao->loadId_Usuario($id_usuario);
    }

/**
*
* pesquisarPorId_Cfdi() - Usado para invocar a classe de negócio CampanhaCashbackCCBusinessImpl de forma geral
* realizar uma busca de ID do carimbo efetuado no cartão diretamente na tabela CAMPANHA_CASHBACK_CC campo CFDI_ID
*
* @param $id_cfdi
* @return CampanhaCashbackCCDTO
*
* 
*/
    public function pesquisarPorId_Cfdi($daofactory,$id_cfdi)

    { 
        $dao = $daofactory->getCampanhaCashbackCCDAO($daofactory);
        return $dao->loadId_Cfdi($id_cfdi);
    }

/**
*
* pesquisarPorDescricao() - Usado para invocar a classe de negócio CampanhaCashbackCCBusinessImpl de forma geral
* realizar uma busca de Cópia da descrição diretamente na tabela CAMPANHA_CASHBACK_CC campo CACC_TX_DESCRICAO
*
* @param $descricao
* @return CampanhaCashbackCCDTO
*
* 
*/
    public function pesquisarPorDescricao($daofactory,$descricao)

    { 
        $dao = $daofactory->getCampanhaCashbackCCDAO($daofactory);
        return $dao->loadDescricao($descricao);
    }

/**
*
* pesquisarPorVlminimo() - Usado para invocar a classe de negócio CampanhaCashbackCCBusinessImpl de forma geral
* realizar uma busca de Valor para permitir cashback diretamente na tabela CAMPANHA_CASHBACK_CC campo CACC_VL_MIN
*
* @param $vlMinimo
* @return CampanhaCashbackCCDTO
*
* 
*/
    public function pesquisarPorVlminimo($daofactory,$vlMinimo)

    { 
        $dao = $daofactory->getCampanhaCashbackCCDAO($daofactory);
        return $dao->loadVlminimo($vlMinimo);
    }

/**
*
* pesquisarPorPercentual() - Usado para invocar a classe de negócio CampanhaCashbackCCBusinessImpl de forma geral
* realizar uma busca de Cópia do perc. cashback diretamente na tabela CAMPANHA_CASHBACK_CC campo CACC_VL_PERC_CASHBACK
*
* @param $percentual
* @return CampanhaCashbackCCDTO
*
* 
*/
    public function pesquisarPorPercentual($daofactory,$percentual)

    { 
        $dao = $daofactory->getCampanhaCashbackCCDAO($daofactory);
        return $dao->loadPercentual($percentual);
    }

/**
*
* pesquisarPorVlconsumo() - Usado para invocar a classe de negócio CampanhaCashbackCCBusinessImpl de forma geral
* realizar uma busca de Valor do consumo diretamente na tabela CAMPANHA_CASHBACK_CC campo CACC_VL_CONSUMO
*
* @param $vlConsumo
* @return CampanhaCashbackCCDTO
*
* 
*/
    public function pesquisarPorVlconsumo($daofactory,$vlConsumo)

    { 
        $dao = $daofactory->getCampanhaCashbackCCDAO($daofactory);
        return $dao->loadVlconsumo($vlConsumo);
    }

/**
*
* pesquisarPorVlcalcrecompensa() - Usado para invocar a classe de negócio CampanhaCashbackCCBusinessImpl de forma geral
* realizar uma busca de Valor da recompensa diretamente na tabela CAMPANHA_CASHBACK_CC campo CACC_VL_RECOMPENSA
*
* @param $vlCalcRecompensa
* @return CampanhaCashbackCCDTO
*
* 
*/
    public function pesquisarPorVlcalcrecompensa($daofactory,$vlCalcRecompensa)

    { 
        $dao = $daofactory->getCampanhaCashbackCCDAO($daofactory);
        return $dao->loadVlcalcrecompensa($vlCalcRecompensa);
    }

/**
*
* pesquisarPorTipomovimento() - Usado para invocar a classe de negócio CampanhaCashbackCCBusinessImpl de forma geral
* realizar uma busca de Tipo do movimento diretamente na tabela CAMPANHA_CASHBACK_CC campo CACC_IN_TIPO
*
* @param $tipoMovimento
* @return CampanhaCashbackCCDTO
*
* 
*/
    public function pesquisarPorTipomovimento($daofactory,$tipoMovimento)

    { 
        $dao = $daofactory->getCampanhaCashbackCCDAO($daofactory);
        return $dao->loadTipomovimento($tipoMovimento);
    }

/**
*
* pesquisarPorNfe() - Usado para invocar a classe de negócio CampanhaCashbackCCBusinessImpl de forma geral
* realizar uma busca de NF Eletrônica diretamente na tabela CAMPANHA_CASHBACK_CC campo CACC_TX_NFE
*
* @param $nfe
* @return CampanhaCashbackCCDTO
*
* 
*/
    public function pesquisarPorNfe($daofactory,$nfe)

    { 
        $dao = $daofactory->getCampanhaCashbackCCDAO($daofactory);
        return $dao->loadNfe($nfe);
    }

/**
*
* pesquisarPorNfehash() - Usado para invocar a classe de negócio CampanhaCashbackCCBusinessImpl de forma geral
* realizar uma busca de Hash NFE diretamente na tabela CAMPANHA_CASHBACK_CC campo CACC_TX_NFE_HASH
*
* @param $nfehash
* @return CampanhaCashbackCCDTO
*
* 
*/
    public function pesquisarPorNfehash($daofactory,$nfehash)

    { 
        $dao = $daofactory->getCampanhaCashbackCCDAO($daofactory);
        return $dao->loadNfehash($nfehash);
    }


/**
*
* listarCampanhaCashbackCCUsuaIdPorStatus() - Usado para invocar a interface de acesso aos dados (DAO) CampanhaCashbackCCDAO de forma geral
* realizar lista paginada de registros dos registros do usuário logado com uma instância de PaginacaoDTO
*
* @param $daofactory
* @param $usuaid
* @param $status
* @param $pag
* @param $qtde
* @param $coluna
* @param $ordem
* @return $PaginacaoDTO
*/

    public function listarCampanhaCashbackCCPorUsuaIdStatus($daofactory, $usuaid, $status, $pag, $qtde, $coluna, $ordem)
    {   
        $retorno = new DTOPaginacao();
        $retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
        $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);

        $dao = $daofactory->getCampanhaCashbackCCDAO($daofactory);
        $retorno->pagina = $pag;
        $retorno->itensPorPagina = ($qtde == 0 
        ? (int) VariavelCache::getInstance()->getVariavel(ConstantesVariavel::MAXIMO_LINHAS_POR_PAGINA_DEFAULT)
        : $qtde);
        $retorno->totalPaginas = ceil($dao->countCampanhaCashbackCCPorUsuaIdStatus($usuaid, $status) / $retorno->itensPorPagina);

        if($pag > $retorno->totalPaginas) {
            $retorno->msgcode = ConstantesMensagem::NAO_EXISTEM_MAIS_PAGINAS_APRESENTAR;
            $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);
            return $retorno;
        }
        $retorno->lst = $dao->listCampanhaCashbackCCPorUsuaIdStatus($usuaid, $status, $pag, $qtde, $coluna, $ordem);

        return $retorno;
    }


/**
* validarTamanhoCampo()
*
* Validador de tamanho de campos CampanhaCashbackCCDTO
*
* @param $campo
* @param $tamanho
* @param $coment
*
* @return DTOPadrao
*/ 
    public function validarTamanhoCampo($campo, $tamanho, $coment)    
    {
       // retorno default
       $retorno = new DTOPadrao();
       $retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
       $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);
   
       if(strlen($campo) > $tamanho){
          $retorno->msgcode = ConstantesMensagem::TAMANHO_DO_CAMPO_EXCEDE_LIMITE_PERMITIDO;
          $retorno->msgcodeString = MensagemCache::getInstance()->getMensagemParametrizada($retorno->msgcode
          ,[
             ConstantesVariavel::P1 => $coment,
             ConstantesVariavel::P2 => $tamanho,
           ]);
       }
       return $retorno;
   }


}
?>
