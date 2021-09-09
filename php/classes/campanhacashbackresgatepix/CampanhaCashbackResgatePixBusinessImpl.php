<?php 

// importar dependencias
require_once 'CampanhaCashbackResgatePixBusiness.php';
require_once 'CampanhaCashbackResgatePixConstantes.php';
require_once 'CampanhaCashbackResgatePixHelper.php';
require_once '../dto/DTOPadrao.php';
require_once '../dto/DTOPaginacao.php';

require_once '../variavel/ConstantesVariavel.php';
require_once '../variavel/VariavelCache.php';
require_once '../usuariocashback/UsuarioCashbackBusinessImpl.php';
require_once '../campanhacashbackcc/CampanhaCashbackCCBusinessImpl.php';
require_once '../campanhacashbackcc/SaldoGeralCashbackCCDTO.php';
require_once '../campanhacashbackcc/SaldoUsuarioDonoCashbackCCDTO.php';

/**
*
* CampanhaCashbackResgatePixBusinessImpl - Classe de implementação dos métodos de negócio para a interface CampanhaCashbackResgatePixBusiness
* Camada de negócio CampanhaCashbackResgatePix - camada responsável pela lógica de negócios de CampanhaCashbackResgatePix do sistema. 
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
*
* 
* @autor Julio Cesar Vitorino
* @since 26/07/2021 15:11:48
*
*/


class CampanhaCashbackResgatePixBusinessImpl implements CampanhaCashbackResgatePixBusiness
{
    
    function __construct()  {   }

/**
* carregar() - Carrega apenas um registro com base no campo id = (CAMPANHA_CASHBACK_RESGATE_PIX::CCRP_ID)
* @param $daofactory
* @param $dto
* @return $dto
*/ 
    public function carregar($daofactory, $dto) {   }

/**
* listarTudo() - Lista todos os registros provenientes de CAMPANHA_CASHBACK_RESGATE_PIX sem critério de paginação
* @param $daofactory
* @return List<CampanhaCashbackResgatePixDTO>[]
*/ 
    public function listarTudo($daofactory) {   }

/**
* pesquisarMaxPKPorStatus() - Carrega apenas um registro com base no idUsuarioDevedor  e status para buscar a MAIOR PK
* @param $daofactory
* @param $status
* @return CampanhaCashbackResgatePixDTO
*/ 
    public function pesquisarMaxPKPorStatus($daofactory, $idUsuarioSolicitante, $idUsuarioDevedor,$status)
    { 
        $dao = $daofactory->getCampanhaCashbackResgatePixDAO($daofactory);
        $maxid = $dao->loadMaxPK($idUsuarioSolicitante, $idUsuarioDevedor,$status);
        return $this->carregarPorID($daofactory, $maxid);
    }

/**
* atualizar() - atualiza apenas um registro com base no dto CampanhaCashbackResgatePixDTO->id
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


        $dao = $daofactory->getCampanhaCashbackResgatePixDAO($daofactory);
        if(!$dao->update($dto)){
           $retorno->msgcode = ConstantesMensagem::ERRO_CRUD_ATUALIZAR_REGISTRO;
           $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);
    
        }
        // retorna situação
        return $retorno;

    }

/**
* deletar() - excluir fisicamente um registro com base no dto CampanhaCashbackResgatePixDTO->id
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
        $dao = $daofactory->getCampanhaCashbackResgatePixDAO($daofactory);

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
* @return List<CampanhaCashbackResgatePixDTO>[]
* @deprecated
*/ 

    public function listarPagina($daofactory, $pag, $qtde)  
    {   
        $dao = $daofactory->getCampanhaCashbackResgatePixDAO($daofactory);
        return $dao->listPagina($pag, $qtde);
    }

/**
* carregarPorID() - Carrega APENAS um registro usando a id como item de busca
* na tabela CAMPANHA_CASHBACK_RESGATE_PIX usando a Primary Key CCRP_ID
*
* @param $daofactory
* @param $id
* @param $qtde
*
* @return CampanhaCashbackResgatePixDTO
*/ 
    public function carregarPorID($daofactory, $id)
    { 
        $dao = $daofactory->getCampanhaCashbackResgatePixDAO($daofactory);
        return $dao->loadPK($id);
    }

/**
* atualizarStatus() - atualizar o campo de STATUS utilizando a id como item de busca
* na tabela CAMPANHA_CASHBACK_RESGATE_PIX usando a Primary Key CCRP_ID
*
* @param $daofactory
* @param $id
* @param $status
*
* @return CampanhaCashbackResgatePixDTO
*/ 
    public function atualizarStatus($daofactory, $id, $status)
    {
        $dao = $daofactory->getCampanhaCashbackResgatePixDAO($daofactory);

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
* removerSolicitacaoPix() - remover um registro com base no CampanhaCashbackResgatePixDTO. Alguns atributos dentro do DTO
* serão ignorados caso estejam populados.
*
* Atributos da classe CampanhaCashbackResgatePixDTO sumariamente IGNORADOS por este método MESMO que estejam preenchidos:
* id
* status
* dataCadastro
* dataAtualizacao
*
* @param $daofactory
*
* @return DTOPadrao
*/ 

public function removerSolicitacaoPix($daofactory, $dto)
{ 
    $retorno = new DTOPadrao();
    $retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
    $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);

    //---------------------------------------------------------------
    // ckecklist de regras de negócio
    //---------------------------------------------------------------
    
    $idPix = $dto->id;
    $dto = $this->carregarPorID($daofactory, $idPix);
    if(is_null($dto))
    {
        $retorno->msgcode = ConstantesMensagem::PIX_SOLICITACAO_INVALIDA;
        $retorno->msgcodeString = MensagemCache::getInstance()->getMensagemParametrizada($retorno->msgcode,[
            ConstantesVariavel::P1 => $idPix,
        ]);
        return $retorno;
    }

    //-- verifica se o tipo da chave pix está dentro dos parametros requiridos, falha.
    if((int) $dto->estagioRealTime > 0 && (int) $dto->estagioRealTime < 3) 
    {
        $retorno->msgcode = ConstantesMensagem::PIX_SOLICITACAO_RESGATE_PIX_EM_ANDAMENTO;
        $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);
        return $retorno;
    }

    if((int) $dto->estagioRealTime >= 3) 
    {
        $retorno->msgcode = ConstantesMensagem::PIX_SOLICITACAO_RESGATE_PIX_CONCLUIDA;
        $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);
        return $retorno;
    }


    //---------------------------------------------------------------
    // Tudo Ok, encaminha para processo de registro
    //---------------------------------------------------------------
    return $this->deletar($daofactory, $dto);
}



/**
* solicitarResgatePIX() - inserir um registro com base no CampanhaCashbackResgatePixDTO. Alguns atributos dentro do DTO
* serão ignorados caso estejam populados.
*
* Atributos da classe CampanhaCashbackResgatePixDTO sumariamente IGNORADOS por este método MESMO que estejam preenchidos:
* id
* status
* dataCadastro
* dataAtualizacao
*
* @param $daofactory
*
* @return DTOPadrao
*/ 

    public function solicitarResgatePIX($daofactory, $dto)
    { 
        $retorno = new DTOPadrao();
        $retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
        $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);

        //---------------------------------------------------------------
        // ckecklist de regras de negócio
        //---------------------------------------------------------------
        
        //-- verifica se o tipo da chave pix está dentro dos parametros requiridos.
        if( $dto->tipoChavePix < 0 || $dto->tipoChavePix > 4) 
        {
            $retorno->msgcode = ConstantesMensagem::PIX_TIPO_DA_INVALIDA;
            $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);
            return $retorno;
        }

        //-- valor do resgate <= 0.00, falha
        if($dto->valorResgate <= 0)
        {
            $retorno->msgcode = ConstantesMensagem::PIX_VALOR_PARA_RESGATE_INVALIDO;
            $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);
            return $retorno;
        }

        //-- se o registro mais recente Resgate PIX estiver nos estágios PENDENTE, EM ANALISE OU FINANCEIRO, falha.
        $maxPixDto = $this->pesquisarMaxPKPorStatus($daofactory, $dto->idUsuarioSolicitante, $dto->idUsuarioDevedor,  ConstantesVariavel::STATUS_ATIVO);
        if( ! is_null($maxPixDto))
        {/*
            $retorno->msgcode = ConstantesMensagem::PIX_MAX_ID_REGISTRO_INVALIDO;
            $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);
            return $retorno;
        } else { */
            $estagiort = (int) $maxPixDto->estagioRealTime;
            switch ($estagiort) {
                case CampanhaCashbackResgatePixConstantes::ESTAGIO_RT_PENDENTE:
                case CampanhaCashbackResgatePixConstantes::ESTAGIO_RT_ANALISE:
                case CampanhaCashbackResgatePixConstantes::ESTAGIO_RT_FINANCEIRO:
                    $retorno->msgcode = ConstantesMensagem::PIX_SOLICITACAO_RESGATE_PIX_EM_ANDAMENTO;
                    $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);
                    return $retorno;
                
                default:
                    # code...
                    break;
            }

        }
        
        //-- se o usuário do DTO retornar NULO, falha.

        //-- se o valor do resgate solicitado for maior que o saldo a receber do devedor, falha.
        $cacaccbo = new CampanhaCashbackCCBusinessImpl();
        $sldGeralDto = new SaldoGeralCashbackCCDTO();
        $sldGeralDto = $cacaccbo->getSaldoCashbackCC($daofactory, $dto->idUsuarioSolicitante);

        if($sldGeralDto->vlsldGeral == 0) 
        {
            $retorno->msgcode = ConstantesMensagem::PIX_SALDO_INSUFICIENTE_PARA_RESGATE;
            $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);
            return $retorno;
        }

        if(count($sldGeralDto->sldUsuarioDono) == 0)
        {
            $retorno->msgcode = ConstantesMensagem::PIX_SALDO_INSUFICIENTE_PARA_RESGATE;
            $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);
            return $retorno;
        }

        // Saldo do Devedor 
        $sldCredito = 0;
        foreach ($sldGeralDto->sldUsuarioDono as $key => $value) 
        { // $value = SaldoUsuarioDonoCashbackCCDTO

            if((int) $value->id_dono == $dto->idUsuarioDevedor ) 
            {
                $sldCredito = $value->vlsld;
            }
        }

        if($sldCredito == 0)
        {
            $retorno->msgcode = ConstantesMensagem::PIX_SALDO_INSUFICIENTE_PARA_RESGATE;
            $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);
            return $retorno;
        }

        if($dto->valorResgate > $sldCredito )
        {
            $retorno->msgcode = ConstantesMensagem::PIX_TENTATIVA_RESGATE_ACIMA_VALOR_PERMITIDO;
            
            $retorno->msgcodeString = MensagemCache::getInstance()->getMensagemParametrizada($retorno->msgcode,[
                ConstantesVariavel::P1 => Util::getMoeda($sldCredito),
            ]);
            return $retorno;
        }


        //-- se o valor do resgate for menor que o mínimo exigido pela maxima USCA_ID, falha.
        $uscabo = new UsuarioCashbackBusinessImpl();
        $uscadto = $uscabo->PesquisarMaxPKAtivoId_UsuarioPorStatus($daofactory, $dto->idUsuarioDevedor, ConstantesVariavel::STATUS_ATIVO);
        if(is_null($uscadto))
        {
            $retorno->msgcode = ConstantesMensagem::PIX_USUARIO_DEVEDOR_SEM_CONFIGURACAO_CASHBACK;
            $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);
            return $retorno;
        }
        
        // Saldo está abaixo do minimo configurado?
        if($sldCredito < $uscadto->vlMinimoResgate)
        {
            $retorno->msgcode = ConstantesMensagem::PIX_VALOR_INFERIOR_AO_CONFIGURADO;
            $retorno->msgcodeString = MensagemCache::getInstance()->getMensagemParametrizada($retorno->msgcode,[
                ConstantesVariavel::P1 => $uscadto->vlMinimoResgateMoeda,
            ]);
            return $retorno;
        }

        // Configuração do usuario cashback permite resgate via pix?
        if($uscadto->permitirResgateViaPix == ConstantesVariavel::NAO)
        {
            $retorno->msgcode = ConstantesMensagem::USUARIO_CASHBACK_NAO_PERMITE_RESGATE_VIA_PIX;
            $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);
            return $retorno;
        }


        //---------------------------------------------------------------
        // Tudo Ok, encaminha para processo de registro
        //---------------------------------------------------------------
        return $this->inserir($daofactory, $dto);
    }
    
/**
* inserir() - inserir um registro com base no CampanhaCashbackResgatePixDTO. Alguns atributos dentro do DTO
* serão ignorados caso estejam populados.
*
* Atributos da classe CampanhaCashbackResgatePixDTO sumariamente IGNORADOS por este método MESMO que estejam preenchidos:
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

    // Efetua validações no campo $dto->id com tamanho CampanhaCashbackResgatePixConstantes::LEN_ID
    $ok = $this->validarTamanhoCampo($dto->id, CampanhaCashbackResgatePixConstantes::LEN_ID, CampanhaCashbackResgatePixConstantes::DESC_ID);
    if($ok->msgcode != ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO){
        return $ok;
    }

    // Efetua validações no campo $dto->idUsuarioSolicitante com tamanho CampanhaCashbackResgatePixConstantes::LEN_IDUSUARIOSOLICITANTE
    $ok = $this->validarTamanhoCampo($dto->idUsuarioSolicitante, CampanhaCashbackResgatePixConstantes::LEN_IDUSUARIOSOLICITANTE, CampanhaCashbackResgatePixConstantes::DESC_IDUSUARIOSOLICITANTE);
    if($ok->msgcode != ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO){
        return $ok;
    }

    // Efetua validações no campo $dto->tipoChavePix com tamanho CampanhaCashbackResgatePixConstantes::LEN_TIPOCHAVEPIX
    $ok = $this->validarTamanhoCampo($dto->tipoChavePix, CampanhaCashbackResgatePixConstantes::LEN_TIPOCHAVEPIX, CampanhaCashbackResgatePixConstantes::DESC_TIPOCHAVEPIX);
    if($ok->msgcode != ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO){
        return $ok;
    }

    // Efetua validações no campo $dto->chavePix com tamanho CampanhaCashbackResgatePixConstantes::LEN_CHAVEPIX
    $ok = $this->validarTamanhoCampo($dto->chavePix, CampanhaCashbackResgatePixConstantes::LEN_CHAVEPIX, CampanhaCashbackResgatePixConstantes::DESC_CHAVEPIX);
    if($ok->msgcode != ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO){
        return $ok;
    }

    // Efetua validações no campo $dto->valorResgate com tamanho CampanhaCashbackResgatePixConstantes::LEN_VALORRESGATE
    $ok = $this->validarTamanhoCampo($dto->valorResgate, CampanhaCashbackResgatePixConstantes::LEN_VALORRESGATE, CampanhaCashbackResgatePixConstantes::DESC_VALORRESGATE);
    if($ok->msgcode != ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO){
        return $ok;
    }

    // Efetua validações no campo $dto->autenticacaoBco com tamanho CampanhaCashbackResgatePixConstantes::LEN_AUTENTICACAOBCO
    $ok = $this->validarTamanhoCampo($dto->autenticacaoBco, CampanhaCashbackResgatePixConstantes::LEN_AUTENTICACAOBCO, CampanhaCashbackResgatePixConstantes::DESC_AUTENTICACAOBCO);
    if($ok->msgcode != ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO){
        return $ok;
    }

    // Efetua validações no campo $dto->estagioRealTime com tamanho CampanhaCashbackResgatePixConstantes::LEN_ESTAGIOREALTIME
    $ok = $this->validarTamanhoCampo($dto->estagioRealTime, CampanhaCashbackResgatePixConstantes::LEN_ESTAGIOREALTIME, CampanhaCashbackResgatePixConstantes::DESC_ESTAGIOREALTIME);
    if($ok->msgcode != ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO){
        return $ok;
    }

    // Efetua validações no campo $dto->dtEstagioAnalise com tamanho CampanhaCashbackResgatePixConstantes::LEN_DTESTAGIOANALISE
    $ok = $this->validarTamanhoCampo($dto->dtEstagioAnalise, CampanhaCashbackResgatePixConstantes::LEN_DTESTAGIOANALISE, CampanhaCashbackResgatePixConstantes::DESC_DTESTAGIOANALISE);
    if($ok->msgcode != ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO){
        return $ok;
    }

    // Efetua validações no campo $dto->dtEstagioFinanceiro com tamanho CampanhaCashbackResgatePixConstantes::LEN_DTESTAGIOFINANCEIRO
    $ok = $this->validarTamanhoCampo($dto->dtEstagioFinanceiro, CampanhaCashbackResgatePixConstantes::LEN_DTESTAGIOFINANCEIRO, CampanhaCashbackResgatePixConstantes::DESC_DTESTAGIOFINANCEIRO);
    if($ok->msgcode != ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO){
        return $ok;
    }

    // Efetua validações no campo $dto->dtEstagioErro com tamanho CampanhaCashbackResgatePixConstantes::LEN_DTESTAGIOERRO
    $ok = $this->validarTamanhoCampo($dto->dtEstagioErro, CampanhaCashbackResgatePixConstantes::LEN_DTESTAGIOERRO, CampanhaCashbackResgatePixConstantes::DESC_DTESTAGIOERRO);
    if($ok->msgcode != ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO){
        return $ok;
    }

    // Efetua validações no campo $dto->dtEstagioTranfBco com tamanho CampanhaCashbackResgatePixConstantes::LEN_DTESTAGIOTRANFBCO
    $ok = $this->validarTamanhoCampo($dto->dtEstagioTranfBco, CampanhaCashbackResgatePixConstantes::LEN_DTESTAGIOTRANFBCO, CampanhaCashbackResgatePixConstantes::DESC_DTESTAGIOTRANFBCO);
    if($ok->msgcode != ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO){
        return $ok;
    }

    // Efetua validações no campo $dto->txtLivreEstagioRT com tamanho CampanhaCashbackResgatePixConstantes::LEN_TXTLIVREESTAGIORT
    $ok = $this->validarTamanhoCampo($dto->txtLivreEstagioRT, CampanhaCashbackResgatePixConstantes::LEN_TXTLIVREESTAGIORT, CampanhaCashbackResgatePixConstantes::DESC_TXTLIVREESTAGIORT);
    if($ok->msgcode != ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO){
        return $ok;
    }

    // Efetua validações no campo $dto->status com tamanho CampanhaCashbackResgatePixConstantes::LEN_STATUS
    $ok = $this->validarTamanhoCampo($dto->status, CampanhaCashbackResgatePixConstantes::LEN_STATUS, CampanhaCashbackResgatePixConstantes::DESC_STATUS);
    if($ok->msgcode != ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO){
        return $ok;
    }

    // Efetua validações no campo $dto->dataCadastro com tamanho CampanhaCashbackResgatePixConstantes::LEN_DATACADASTRO
    $ok = $this->validarTamanhoCampo($dto->dataCadastro, CampanhaCashbackResgatePixConstantes::LEN_DATACADASTRO, CampanhaCashbackResgatePixConstantes::DESC_DATACADASTRO);
    if($ok->msgcode != ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO){
        return $ok;
    }

    // Efetua validações no campo $dto->dataAtualizacao com tamanho CampanhaCashbackResgatePixConstantes::LEN_DATAATUALIZACAO
    $ok = $this->validarTamanhoCampo($dto->dataAtualizacao, CampanhaCashbackResgatePixConstantes::LEN_DATAATUALIZACAO, CampanhaCashbackResgatePixConstantes::DESC_DATAATUALIZACAO);
    if($ok->msgcode != ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO){
        return $ok;
    }


    $dto->status = ConstantesVariavel::STATUS_ATIVO;
    $dao = $daofactory->getCampanhaCashbackResgatePixDAO($daofactory);

    if (!$dao->insert($dto)) {
        $retorno = new DTOPadrao();
        $retorno->msgcode = ConstantesMensagem::ERRO_CRUD_INSERIR_REGISTRO;
        $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);
        return $retorno;
    }

    // avisa ao admin sobre o pedido de resgate
    $msgOrigem = ConstantesMensagem::INICIAR_PROCESSO_RESGATE_PIX;
    CampanhaCashbackResgatePixHelper::criarNotificacaoAdmin($daofactory, $msgOrigem, [
        ConstantesVariavel::P1 => $dto->idUsuarioSolicitante ,
        ConstantesVariavel::P2 => Util::getMoeda($dto->valorResgate) ,
        ConstantesVariavel::P3 => $dto->idUsuarioDevedor ,
    ]);

    return $retorno;
}

/**
*
* listarCampanhaCashbackResgatePixPorStatus() - Usado para invocar a interface de acesso aos dados (DAO) CampanhaCashbackResgatePixDAO de forma geral
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

    public function listarCampanhaCashbackResgatePixPorStatus($daofactory, $status, $pag, $qtde, $coluna, $ordem)
    {   
        $retorno = new DTOPaginacao();
        $retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
        $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);

        $dao = $daofactory->getCampanhaCashbackResgatePixDAO($daofactory);
        $retorno->pagina = $pag;
        $retorno->itensPorPagina = ($qtde == 0 
        ? (int) VariavelCache::getInstance()->getVariavel(ConstantesVariavel::MAXIMO_LINHAS_POR_PAGINA_DEFAULT)
        : $qtde);
        $retorno->totalPaginas = ceil($dao->countCampanhaCashbackResgatePixPorStatus($status) / $retorno->itensPorPagina);

        if($pag > $retorno->totalPaginas) {
            $retorno->msgcode = ConstantesMensagem::NAO_EXISTEM_MAIS_PAGINAS_APRESENTAR;
            $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);
            return $retorno;
        }
        $retorno->lst = $dao->listCampanhaCashbackResgatePixPorStatus($status, $pag, $retorno->itensPorPagina, $coluna, $ordem);

        return $retorno;
    }






/**
*
* atualizarIdUsuarioDevedorPorPK() - Usado para invocar a classe de negócio CampanhaCashbackResgatePixBusinessImpl de forma geral
* realizar uma atualização de ID Campanha x Cashback diretamente na tabela CAMPANHA_CASHBACK_RESGATE_PIX campo CACA_ID
* @param $daofactory
* @param $id
* @param $idUsuarioDevedor
* @return CampanhaCashbackResgatePixDTO
*
* 
*/
    public function atualizarIdUsuarioDevedorPorPK($daofactory,$idUsuarioDevedor,$id)
    {
        $dao = $daofactory->getCampanhaCashbackResgatePixDAO($daofactory);

        // resposta padrão
        $retorno = new DTOPadrao();

        if($dao->updateIdUsuarioDevedor($id, $idUsuarioDevedor)){   
            $retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
        }       

        // Obtem o texto da mensagem em razão do código de retorno
        $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);

        return $retorno;
    }

/**
*
* atualizarIdusuariosolicitantePorPK() - Usado para invocar a classe de negócio CampanhaCashbackResgatePixBusinessImpl de forma geral
* realizar uma atualização de ID do usuário solicitante diretamente na tabela CAMPANHA_CASHBACK_RESGATE_PIX campo USUA_ID
* @param $daofactory
* @param $id
* @param $idUsuarioSolicitante
* @return CampanhaCashbackResgatePixDTO
*
* 
*/
    public function atualizarIdusuariosolicitantePorPK($daofactory,$idUsuarioSolicitante,$id)
    {
        $dao = $daofactory->getCampanhaCashbackResgatePixDAO($daofactory);

        // resposta padrão
        $retorno = new DTOPadrao();

        if($dao->updateIdusuariosolicitante($id, $idUsuarioSolicitante)){   
            $retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
        }       

        // Obtem o texto da mensagem em razão do código de retorno
        $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);

        return $retorno;
    }

/**
*
* atualizarTipochavepixPorPK() - Usado para invocar a classe de negócio CampanhaCashbackResgatePixBusinessImpl de forma geral
* realizar uma atualização de Tipo da Chave PIX diretamente na tabela CAMPANHA_CASHBACK_RESGATE_PIX campo CCRP_IN_TIPO_CHAVE_PIX
* @param $daofactory
* @param $id
* @param $tipoChavePix
* @return CampanhaCashbackResgatePixDTO
*
* 
*/
    public function atualizarTipochavepixPorPK($daofactory,$tipoChavePix,$id)
    {
        $dao = $daofactory->getCampanhaCashbackResgatePixDAO($daofactory);

        // resposta padrão
        $retorno = new DTOPadrao();

        if($dao->updateTipochavepix($id, $tipoChavePix)){   
            $retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
        }       

        // Obtem o texto da mensagem em razão do código de retorno
        $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);

        return $retorno;
    }

/**
*
* atualizarChavepixPorPK() - Usado para invocar a classe de negócio CampanhaCashbackResgatePixBusinessImpl de forma geral
* realizar uma atualização de Chave PIX diretamente na tabela CAMPANHA_CASHBACK_RESGATE_PIX campo CCRP_TX_CHAVE_PIX
* @param $daofactory
* @param $id
* @param $chavePix
* @return CampanhaCashbackResgatePixDTO
*
* 
*/
    public function atualizarChavepixPorPK($daofactory,$chavePix,$id)
    {
        $dao = $daofactory->getCampanhaCashbackResgatePixDAO($daofactory);

        // resposta padrão
        $retorno = new DTOPadrao();

        if($dao->updateChavepix($id, $chavePix)){   
            $retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
        }       

        // Obtem o texto da mensagem em razão do código de retorno
        $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);

        return $retorno;
    }

/**
*
* atualizarValorresgatePorPK() - Usado para invocar a classe de negócio CampanhaCashbackResgatePixBusinessImpl de forma geral
* realizar uma atualização de Valor Pretendido a Resgatar diretamente na tabela CAMPANHA_CASHBACK_RESGATE_PIX campo CCRP_VL_RESGATE
* @param $daofactory
* @param $id
* @param $valorResgate
* @return CampanhaCashbackResgatePixDTO
*
* 
*/
    public function atualizarValorresgatePorPK($daofactory,$valorResgate,$id)
    {
        $dao = $daofactory->getCampanhaCashbackResgatePixDAO($daofactory);

        // resposta padrão
        $retorno = new DTOPadrao();

        if($dao->updateValorresgate($id, $valorResgate)){   
            $retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
        }       

        // Obtem o texto da mensagem em razão do código de retorno
        $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);

        return $retorno;
    }

/**
*
* atualizarAutenticacaobcoPorPK() - Usado para invocar a classe de negócio CampanhaCashbackResgatePixBusinessImpl de forma geral
* realizar uma atualização de Autenticação do Banco diretamente na tabela CAMPANHA_CASHBACK_RESGATE_PIX campo CCRP_TX_AUTENT_BCO
* @param $daofactory
* @param $id
* @param $autenticacaoBco
* @return CampanhaCashbackResgatePixDTO
*
* 
*/
    public function atualizarAutenticacaobcoPorPK($daofactory,$autenticacaoBco,$id)
    {
        $dao = $daofactory->getCampanhaCashbackResgatePixDAO($daofactory);

        // resposta padrão
        $retorno = new DTOPadrao();

        if($dao->updateAutenticacaobco($id, $autenticacaoBco)){   
            $retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
        }       

        // Obtem o texto da mensagem em razão do código de retorno
        $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);

        return $retorno;
    }

/**
*
* atualizarEstagiorealtimePorPK() - Usado para invocar a classe de negócio CampanhaCashbackResgatePixBusinessImpl de forma geral
* realizar uma atualização de Estágio Real Time diretamente na tabela CAMPANHA_CASHBACK_RESGATE_PIX campo CCRP_IN_ESTAGIO_RT
* @param $daofactory
* @param $id
* @param $estagioRealTime
* @return CampanhaCashbackResgatePixDTO
*
* 
*/
    public function atualizarEstagiorealtimePorPK($daofactory,$estagioRealTime,$id)
    {
        $dao = $daofactory->getCampanhaCashbackResgatePixDAO($daofactory);

        // resposta padrão
        $retorno = new DTOPadrao();

        if($dao->updateEstagiorealtime($id, $estagioRealTime)){   
            $retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
        }       

        // Obtem o texto da mensagem em razão do código de retorno
        $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);

        return $retorno;
    }

/**
*
* atualizarDtestagioanalisePorPK() - Usado para invocar a classe de negócio CampanhaCashbackResgatePixBusinessImpl de forma geral
* realizar uma atualização de Data Registro Estágio Análise diretamente na tabela CAMPANHA_CASHBACK_RESGATE_PIX campo CCRP_DT_ESTAGIO_ANALISE
* @param $daofactory
* @param $id
* @param $dtEstagioAnalise
* @return CampanhaCashbackResgatePixDTO
*
* 
*/
    public function atualizarDtestagioanalisePorPK($daofactory,$dtEstagioAnalise,$id)
    {
        $dao = $daofactory->getCampanhaCashbackResgatePixDAO($daofactory);

        // resposta padrão
        $retorno = new DTOPadrao();

        if($dao->updateDtestagioanalise($id, $dtEstagioAnalise)){   
            $retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
        }       

        // Obtem o texto da mensagem em razão do código de retorno
        $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);

        return $retorno;
    }

/**
*
* atualizarDtestagiofinanceiroPorPK() - Usado para invocar a classe de negócio CampanhaCashbackResgatePixBusinessImpl de forma geral
* realizar uma atualização de Data Registro Estágio Financeiro diretamente na tabela CAMPANHA_CASHBACK_RESGATE_PIX campo CCRP_DT_ESTAGIO_FINANCEIRO
* @param $daofactory
* @param $id
* @param $dtEstagioFinanceiro
* @return CampanhaCashbackResgatePixDTO
*
* 
*/
    public function atualizarDtestagiofinanceiroPorPK($daofactory,$dtEstagioFinanceiro,$id)
    {
        $dao = $daofactory->getCampanhaCashbackResgatePixDAO($daofactory);

        // resposta padrão
        $retorno = new DTOPadrao();

        if($dao->updateDtestagiofinanceiro($id, $dtEstagioFinanceiro)){   
            $retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
        }       

        // Obtem o texto da mensagem em razão do código de retorno
        $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);

        return $retorno;
    }

/**
*
* atualizarDtestagioerroPorPK() - Usado para invocar a classe de negócio CampanhaCashbackResgatePixBusinessImpl de forma geral
* realizar uma atualização de Data Registro Estágio Erro diretamente na tabela CAMPANHA_CASHBACK_RESGATE_PIX campo CCRP_DT_ESTAGIO_ERRO
* @param $daofactory
* @param $id
* @param $dtEstagioErro
* @return CampanhaCashbackResgatePixDTO
*
* 
*/
    public function atualizarDtestagioerroPorPK($daofactory,$dtEstagioErro,$id)
    {
        $dao = $daofactory->getCampanhaCashbackResgatePixDAO($daofactory);

        // resposta padrão
        $retorno = new DTOPadrao();

        if($dao->updateDtestagioerro($id, $dtEstagioErro)){   
            $retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
        }       

        // Obtem o texto da mensagem em razão do código de retorno
        $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);

        return $retorno;
    }

/**
*
* atualizarDtestagiotranfbcoPorPK() - Usado para invocar a classe de negócio CampanhaCashbackResgatePixBusinessImpl de forma geral
* realizar uma atualização de Data Registro Estágio Transferido Bco diretamente na tabela CAMPANHA_CASHBACK_RESGATE_PIX campo CCRP_DT_ESTAGIO_TRANSF_BCO
* @param $daofactory
* @param $id
* @param $dtEstagioTranfBco
* @return CampanhaCashbackResgatePixDTO
*
* 
*/
    public function atualizarDtestagiotranfbcoPorPK($daofactory,$dtEstagioTranfBco,$id)
    {
        $dao = $daofactory->getCampanhaCashbackResgatePixDAO($daofactory);

        // resposta padrão
        $retorno = new DTOPadrao();

        if($dao->updateDtestagiotranfbco($id, $dtEstagioTranfBco)){   
            $retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
        }       

        // Obtem o texto da mensagem em razão do código de retorno
        $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);

        return $retorno;
    }

/**
*
* atualizarTxtlivreestagiortPorPK() - Usado para invocar a classe de negócio CampanhaCashbackResgatePixBusinessImpl de forma geral
* realizar uma atualização de Data Registro Estágio Transferido Bco diretamente na tabela CAMPANHA_CASHBACK_RESGATE_PIX campo CCRP_DT_ESTAGIO_TRANSF_BCO
* @param $daofactory
* @param $id
* @param $dtEstagioTranfBco
* @return CampanhaCashbackResgatePixDTO
*
* 
*/
    public function atualizarTxtlivreestagiortPorPK($daofactory,$txtLivreEstagioRT,$id)
    {
        $dao = $daofactory->getCampanhaCashbackResgatePixDAO($daofactory);

        // resposta padrão
        $retorno = new DTOPadrao();

        if($dao->updateTxtlivreestagiort($id, $txtLivreEstagioRT)){   
            $retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
        }       

        // Obtem o texto da mensagem em razão do código de retorno
        $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);

        return $retorno;
    }


/**
*
* pesquisarPorIdUsuarioDevedor() - Usado para invocar a classe de negócio CampanhaCashbackResgatePixBusinessImpl de forma geral
* realizar uma busca de ID Campanha x Cashback diretamente na tabela CAMPANHA_CASHBACK_RESGATE_PIX campo USUA_ID_DEVEDOR
*
* @param $idUsuarioDevedor
* @return CampanhaCashbackResgatePixDTO
*
* 
*/
    public function pesquisarPorIdUsuarioDevedor($daofactory,$idUsuarioDevedor)
    { 
        $dao = $daofactory->getCampanhaCashbackResgatePixDAO($daofactory);
        return $dao->loadIdUsuarioDevedor($idUsuarioDevedor);
    }

/**
*
* pesquisarPorIdusuariosolicitante() - Usado para invocar a classe de negócio CampanhaCashbackResgatePixBusinessImpl de forma geral
* realizar uma busca de ID do usuário solicitante diretamente na tabela CAMPANHA_CASHBACK_RESGATE_PIX campo USUA_ID
*
* @param $idUsuarioSolicitante
* @return CampanhaCashbackResgatePixDTO
*
* 
*/
    public function pesquisarPorIdusuariosolicitante($daofactory,$idUsuarioSolicitante)

    { 
        $dao = $daofactory->getCampanhaCashbackResgatePixDAO($daofactory);
        return $dao->loadIdusuariosolicitante($idUsuarioSolicitante);
    }

/**
*
* pesquisarPorTipochavepix() - Usado para invocar a classe de negócio CampanhaCashbackResgatePixBusinessImpl de forma geral
* realizar uma busca de Tipo da Chave PIX diretamente na tabela CAMPANHA_CASHBACK_RESGATE_PIX campo CCRP_IN_TIPO_CHAVE_PIX
*
* @param $tipoChavePix
* @return CampanhaCashbackResgatePixDTO
*
* 
*/
    public function pesquisarPorTipochavepix($daofactory,$tipoChavePix)

    { 
        $dao = $daofactory->getCampanhaCashbackResgatePixDAO($daofactory);
        return $dao->loadTipochavepix($tipoChavePix);
    }

/**
*
* pesquisarPorChavepix() - Usado para invocar a classe de negócio CampanhaCashbackResgatePixBusinessImpl de forma geral
* realizar uma busca de Chave PIX diretamente na tabela CAMPANHA_CASHBACK_RESGATE_PIX campo CCRP_TX_CHAVE_PIX
*
* @param $chavePix
* @return CampanhaCashbackResgatePixDTO
*
* 
*/
    public function pesquisarPorChavepix($daofactory,$chavePix)

    { 
        $dao = $daofactory->getCampanhaCashbackResgatePixDAO($daofactory);
        return $dao->loadChavepix($chavePix);
    }

/**
*
* pesquisarPorValorresgate() - Usado para invocar a classe de negócio CampanhaCashbackResgatePixBusinessImpl de forma geral
* realizar uma busca de Valor Pretendido a Resgatar diretamente na tabela CAMPANHA_CASHBACK_RESGATE_PIX campo CCRP_VL_RESGATE
*
* @param $valorResgate
* @return CampanhaCashbackResgatePixDTO
*
* 
*/
    public function pesquisarPorValorresgate($daofactory,$valorResgate)

    { 
        $dao = $daofactory->getCampanhaCashbackResgatePixDAO($daofactory);
        return $dao->loadValorresgate($valorResgate);
    }

/**
*
* pesquisarPorAutenticacaobco() - Usado para invocar a classe de negócio CampanhaCashbackResgatePixBusinessImpl de forma geral
* realizar uma busca de Autenticação do Banco diretamente na tabela CAMPANHA_CASHBACK_RESGATE_PIX campo CCRP_TX_AUTENT_BCO
*
* @param $autenticacaoBco
* @return CampanhaCashbackResgatePixDTO
*
* 
*/
    public function pesquisarPorAutenticacaobco($daofactory,$autenticacaoBco)

    { 
        $dao = $daofactory->getCampanhaCashbackResgatePixDAO($daofactory);
        return $dao->loadAutenticacaobco($autenticacaoBco);
    }

/**
*
* pesquisarPorEstagiorealtime() - Usado para invocar a classe de negócio CampanhaCashbackResgatePixBusinessImpl de forma geral
* realizar uma busca de Estágio Real Time diretamente na tabela CAMPANHA_CASHBACK_RESGATE_PIX campo CCRP_IN_ESTAGIO_RT
*
* @param $estagioRealTime
* @return CampanhaCashbackResgatePixDTO
*
* 
*/
    public function pesquisarPorEstagiorealtime($daofactory,$estagioRealTime)

    { 
        $dao = $daofactory->getCampanhaCashbackResgatePixDAO($daofactory);
        return $dao->loadEstagiorealtime($estagioRealTime);
    }

/**
*
* pesquisarPorDtestagioanalise() - Usado para invocar a classe de negócio CampanhaCashbackResgatePixBusinessImpl de forma geral
* realizar uma busca de Data Registro Estágio Análise diretamente na tabela CAMPANHA_CASHBACK_RESGATE_PIX campo CCRP_DT_ESTAGIO_ANALISE
*
* @param $dtEstagioAnalise
* @return CampanhaCashbackResgatePixDTO
*
* 
*/
    public function pesquisarPorDtestagioanalise($daofactory,$dtEstagioAnalise)

    { 
        $dao = $daofactory->getCampanhaCashbackResgatePixDAO($daofactory);
        return $dao->loadDtestagioanalise($dtEstagioAnalise);
    }

/**
*
* pesquisarPorDtestagiofinanceiro() - Usado para invocar a classe de negócio CampanhaCashbackResgatePixBusinessImpl de forma geral
* realizar uma busca de Data Registro Estágio Financeiro diretamente na tabela CAMPANHA_CASHBACK_RESGATE_PIX campo CCRP_DT_ESTAGIO_FINANCEIRO
*
* @param $dtEstagioFinanceiro
* @return CampanhaCashbackResgatePixDTO
*
* 
*/
    public function pesquisarPorDtestagiofinanceiro($daofactory,$dtEstagioFinanceiro)

    { 
        $dao = $daofactory->getCampanhaCashbackResgatePixDAO($daofactory);
        return $dao->loadDtestagiofinanceiro($dtEstagioFinanceiro);
    }

/**
*
* pesquisarPorDtestagioerro() - Usado para invocar a classe de negócio CampanhaCashbackResgatePixBusinessImpl de forma geral
* realizar uma busca de Data Registro Estágio Erro diretamente na tabela CAMPANHA_CASHBACK_RESGATE_PIX campo CCRP_DT_ESTAGIO_ERRO
*
* @param $dtEstagioErro
* @return CampanhaCashbackResgatePixDTO
*
* 
*/
    public function pesquisarPorDtestagioerro($daofactory,$dtEstagioErro)

    { 
        $dao = $daofactory->getCampanhaCashbackResgatePixDAO($daofactory);
        return $dao->loadDtestagioerro($dtEstagioErro);
    }

/**
*
* pesquisarPorDtestagiotranfbco() - Usado para invocar a classe de negócio CampanhaCashbackResgatePixBusinessImpl de forma geral
* realizar uma busca de Data Registro Estágio Transferido Bco diretamente na tabela CAMPANHA_CASHBACK_RESGATE_PIX campo CCRP_DT_ESTAGIO_TRANSF_BCO
*
* @param $dtEstagioTranfBco
* @return CampanhaCashbackResgatePixDTO
*
* 
*/
    public function pesquisarPorDtestagiotranfbco($daofactory,$dtEstagioTranfBco)

    { 
        $dao = $daofactory->getCampanhaCashbackResgatePixDAO($daofactory);
        return $dao->loadDtestagiotranfbco($dtEstagioTranfBco);
    }

/**
*
* pesquisarPorTxtlivreestagiort() - Usado para invocar a classe de negócio CampanhaCashbackResgatePixBusinessImpl de forma geral
* realizar uma busca de Texto Livre do Estagio RT diretamente na tabela CAMPANHA_CASHBACK_RESGATE_PIX campo CCRP_TX_LIVRE_ESTAGIO_RT
*
* @param $txtLivreEstagioRT
* @return CampanhaCashbackResgatePixDTO
*
* 
*/
    public function pesquisarPorTxtlivreestagiort($daofactory,$txtLivreEstagioRT)

    { 
        $dao = $daofactory->getCampanhaCashbackResgatePixDAO($daofactory);
        return $dao->loadTxtlivreestagiort($txtLivreEstagioRT);
    }

/**
*
* listarCampanhaCashbackResgatePixUsuaIdPorStatus() - Usado para invocar a interface de acesso aos dados (DAO) CampanhaCashbackResgatePixDAO de forma geral
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

    public function listarCampanhaCashbackResgatePixPorUsuaIdStatus($daofactory, $usuaid, $status, $pag, $qtde, $coluna, $ordem)
    {   
        $retorno = new DTOPaginacao();
        $retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
        $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);

        $dao = $daofactory->getCampanhaCashbackResgatePixDAO($daofactory);
        $retorno->pagina = $pag;
        $retorno->itensPorPagina = ($qtde == 0 
        ? (int) VariavelCache::getInstance()->getVariavel(ConstantesVariavel::MAXIMO_LINHAS_POR_PAGINA_DEFAULT)
        : $qtde);
        $retorno->totalPaginas = ceil($dao->countCampanhaCashbackResgatePixPorUsuaIdStatus($usuaid, $status) / $retorno->itensPorPagina);

        if($pag > $retorno->totalPaginas) {
            $retorno->msgcode = ConstantesMensagem::NAO_EXISTEM_MAIS_PAGINAS_APRESENTAR;
            $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);
            return $retorno;
        }
        $retorno->lst = $dao->listCampanhaCashbackResgatePixPorUsuaIdStatus($usuaid, $status, $pag, $retorno->itensPorPagina, $coluna, $ordem);

        return $retorno;
    }


/**
*
* listarCampanhaCashbackResgatePixPorUsuaIdUsuaIdDevedorStatus() - Usado para invocar a interface de acesso aos dados (DAO) CampanhaCashbackResgatePixDAO de forma geral
* realizar lista paginada de registros dos registros do usuário logado com uma instância de PaginacaoDTO
*
* @param $daofactory
* @param $usuaid
* @param $usuaidDevedor
* @param $status
* @param $pag
* @param $qtde
* @param $coluna
* @param $ordem
* @return $PaginacaoDTO
*/

    public function listarCampanhaCashbackResgatePixPorUsuaIdUsuaIdDevedorStatus($daofactory, $usuaid, $usuaidDevedor, $status, $pag, $qtde, $coluna, $ordem)
    {   
        $retorno = new DTOPaginacao();
        $retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
        $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);

        $dao = $daofactory->getCampanhaCashbackResgatePixDAO($daofactory);
        $retorno->pagina = $pag;
        $retorno->itensPorPagina = ($qtde == 0 
        ? (int) VariavelCache::getInstance()->getVariavel(ConstantesVariavel::MAXIMO_LINHAS_POR_PAGINA_DEFAULT)
        : $qtde);
        $retorno->totalPaginas = ceil($dao->countCampanhaCashbackResgatePixPorUsuaIdUsuaIdDevedorStatus($usuaid, $usuaidDevedor, $status) / $retorno->itensPorPagina);

        if($pag > $retorno->totalPaginas) {
            $retorno->msgcode = ConstantesMensagem::NAO_EXISTEM_MAIS_PAGINAS_APRESENTAR;
            $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);
            return $retorno;
        }
        $retorno->lst = $dao->listCampanhaCashbackResgatePixPorUsuaIdUsuaIdDevedorStatus($usuaid, $usuaidDevedor, $status, $pag, $retorno->itensPorPagina, $coluna, $ordem);

        return $retorno;
    }


/**
* validarTamanhoCampo()
*
* Validador de tamanho de campos CampanhaCashbackResgatePixDTO
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
