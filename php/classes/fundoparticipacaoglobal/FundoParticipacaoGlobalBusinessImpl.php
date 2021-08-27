<?php 

// importar dependencias
require_once 'FundoParticipacaoGlobalBusiness.php';
require_once 'FundoParticipacaoGlobalConstantes.php';
require_once 'FundoParticipacaoGlobalHelper.php';
require_once '../dto/DTOPadrao.php';
require_once '../dto/DTOPaginacao.php';

require_once '../variavel/ConstantesVariavel.php';
require_once '../variavel/VariavelCache.php';
require_once '../usuariosplanos/PlanoUsuarioBusinessImpl.php';
require_once '../campanhacashbackcc/CampanhaCashbackCCBusinessImpl.php';
require_once '../permissao/PermissaoHelper.php';
require_once '../plano/ConstantesPlano.php';
require_once '../usuariocashback/UsuarioCashbackBusinessImpl.php';

/**
*
* FundoParticipacaoGlobalBusinessImpl - Classe de implementação dos métodos de negócio para a interface FundoParticipacaoGlobalBusiness
* Camada de negócio FundoParticipacaoGlobal - camada responsável pela lógica de negócios de FundoParticipacaoGlobal do sistema. 
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
* @since 18/08/2021 12:15:16
*
*/


class FundoParticipacaoGlobalBusinessImpl implements FundoParticipacaoGlobalBusiness
{
    
    function __construct()  {   }

/**
* carregar() - Carrega apenas um registro com base no campo id = (FUNDO_PARTICIPACAO_GLOBAL::FPGL_ID)
* @param $daofactory
* @param $dto
* @return $dto
*/ 
    public function carregar($daofactory, $dto) {   }

/**
* listarTudo() - Lista todos os registros provenientes de FUNDO_PARTICIPACAO_GLOBAL sem critério de paginação
* @param $daofactory
* @return List<FundoParticipacaoGlobalDTO>[]
*/ 
    public function listarTudo($daofactory) {   }

/**
* pesquisarMaxPKAtivoIdusuarioparticipantePorStatus() - Carrega apenas um registro com base no idUsuarioParticipante  e status para buscar a MAIOR PK
* @param $daofactory
* @param $status
* @return FundoParticipacaoGlobalDTO
*/ 
    public function pesquisarMaxPKAtivoIdusuarioparticipantePorStatus($daofactory, $idUsuarioParticipante,$status)
    { 
        $dao = $daofactory->getFundoParticipacaoGlobalDAO($daofactory);
        $maxid = $dao->loadMaxIdusuarioparticipantePK($idUsuarioParticipante,$status);
        return $this->carregarPorID($daofactory, $maxid);
    }

/**
* pesquisarMaxPKAtivoIndicadorSaldoStatus() - Carrega apenas um registro no maior ID do status SALDO a MAIOR PK
* @param $daofactory
* @param $status
* @return FundoParticipacaoGlobalDTO
*/ 
public function pesquisarMaxPKAtivoIndicadorSaldoStatus($daofactory, $idUsuarioDominador)
{ 
    $dao = $daofactory->getFundoParticipacaoGlobalDAO($daofactory);
    $maxid = $dao->loadMaxPKAtivoIndicadorSaldoStatus($idUsuarioDominador, ConstantesVariavel::SALDO, ConstantesVariavel::STATUS_ATIVO);
    return $this->carregarPorID($daofactory, $maxid);
}


/**
* atualizar() - atualiza apenas um registro com base no dto FundoParticipacaoGlobalDTO->id
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


        $dao = $daofactory->getFundoParticipacaoGlobalDAO($daofactory);
        if(!$dao->update($dto)){
           $retorno->msgcode = ConstantesMensagem::ERRO_CRUD_ATUALIZAR_REGISTRO;
           $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);
    
        }
        // retorna situação
        return $retorno;

    }

/**
* deletar() - excluir fisicamente um registro com base no dto FundoParticipacaoGlobalDTO->id
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
        $dao = $daofactory->getFundoParticipacaoGlobalDAO($daofactory);

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
* @return List<FundoParticipacaoGlobalDTO>[]
* @deprecated
*/ 

    public function listarPagina($daofactory, $pag, $qtde)  
    {   
        $dao = $daofactory->getFundoParticipacaoGlobalDAO($daofactory);
        return $dao->listPagina($pag, $qtde);
    }

/**
* carregarPorID() - Carrega APENAS um registro usando a id como item de busca
* na tabela FUNDO_PARTICIPACAO_GLOBAL usando a Primary Key FPGL_ID
*
* @param $daofactory
* @param $id
* @param $qtde
*
* @return FundoParticipacaoGlobalDTO
*/ 
    public function carregarPorID($daofactory, $id)
    { 
        $dao = $daofactory->getFundoParticipacaoGlobalDAO($daofactory);
        return $dao->loadPK($id);
    }

/**
* atualizarStatus() - atualizar o campo de STATUS utilizando a id como item de busca
* na tabela FUNDO_PARTICIPACAO_GLOBAL usando a Primary Key FPGL_ID
*
* @param $daofactory
* @param $id
* @param $status
*
* @return FundoParticipacaoGlobalDTO
*/ 
    public function atualizarStatus($daofactory, $id, $status)
    {
        $dao = $daofactory->getFundoParticipacaoGlobalDAO($daofactory);

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
* inserirCreditoBonificacao() - inserir um registro com base no FundoParticipacaoGlobalDTO. Alguns atributos dentro do DTO
* serão ignorados caso estejam populados.
*
* Atributos da classe FundoParticipacaoGlobalDTO sumariamente IGNORADOS por este método MESMO que estejam preenchidos:
* id
* status
* dataCadastro
* dataAtualizacao
*
* @param $daofactory
*
* @return DTOPadrao
*/ 
public function inserirCreditoBonificacao($daofactory, $dto)
{ 
    $retorno = new DTOPadrao();
    $retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
    $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);

    // Regras de Negócio
    // ...
    
    // Aceita somente valores negativos. Valor de crédito >= 0 , falha.
    if($dto->valorTransacao >= 0)
    {
        $retorno->msgcode = ConstantesMensagem::VALOR_INVALIDO_FUNDO_PARTICIPACAO_GLOBAL;
        $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);
        return $retorno;
    }

    // Saldo insuficiente no fundo, falha.
    $vlrSaldoFpgl = $this->getSaldoFundoParticipacaoGlobal($daofactory) ;
    if( ($vlrSaldoFpgl <= 0) || ($dto->valorTransacao * -1 > $vlrSaldoFpgl))  
    {
        $retorno->msgcode = ConstantesMensagem::SALDO_INSUFICIENTE_FUNDO_PARTICIPACAO_GLOBAL;
        $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);
        return $retorno;
    }
    // Somente usuário do grupo de administradores pode executar essa função (futuro)
    // ...
    
    //--- Tudo ok com regras de negócio. Pode inserir o registro 
    // Prepara registro  de bonificação
    $dto->tipoMovimento = ConstantesVariavel::DEBITO;


    return $this->inserirBonificacao($daofactory, $dto);
}

/**
* listarFundoParticipacaoGlobalCreditoDebitoAcimaPK() - Listar registros de D/C acima de um fpgl_id informado
*
* @param $daofactory
*
* @return DTOPadrao
*/ 
public function listarFundoParticipacaoGlobalCreditoDebitoAcimaPK($daofactory, $fpglid, $status)
{
    $dao = $daofactory->getFundoParticipacaoGlobalDAO($daofactory);
    return $dao->listFundoParticipacaoGlobalCreditoDebitoAcimaPK($fpglid, $status);

}

/**
* getSaldoFundoParticipacaoGlobal() - inserir um registro com base no FundoParticipacaoGlobalDTO. Alguns atributos dentro do DTO
* serão ignorados caso estejam populados.
*
* Atributos da classe FundoParticipacaoGlobalDTO sumariamente IGNORADOS por este método MESMO que estejam preenchidos:
* id
* status
* dataCadastro
* dataAtualizacao
*
* @param $daofactory
*
* @return DTOPadrao
*/ 
public function getSaldoFundoParticipacaoGlobal($daofactory)
{

    // Inicializa calculadora do saldo
    $vlrFpgl = 0;
    $fpglid_inicial = 0;
    
    // Obtem o maior fpgl_id com fpgl_in_tipo = "S" e status "A"
    $fpgldto = $this->pesquisarMaxPKAtivoIndicadorSaldoStatus($daofactory, (int) VariavelCache::getInstance()->getVariavel(ConstantesVariavel::USUA_ID_DOMINADOR_SALDO_FPGL));

    if( ! is_null($fpgldto) )
    {
        $vlrFpgl = $fpgldto->valorTransacao;
        $fpglid_inicial = $fpgldto->id;
    }

    // Obtem todos os registro com fpgl_in_tipo = "C" ou "D" que sejam acima do maior fpgl_id obtido acima
    $lstfpgl = $this->listarFundoParticipacaoGlobalCreditoDebitoAcimaPK($daofactory, $fpglid_inicial, ConstantesVariavel::STATUS_ATIVO);

    // Retornou linhas de credito e/ou debito do FPGL ?
    if(count($lstfpgl) > 0) 
    {
        foreach ($lstfpgl as $key => $fpglitemdto) {
            $vlrFpgl += $fpglitemdto->valorTransacao;
        }
    }

    // calcula o saldo na iteração
    //var_dump("saldo calculado ==>" . $vlrFpgl);
    return $vlrFpgl;
}


/**
* lancarMovimentoFundoParticipacaoGlobal() - inserir uma movimentação conjugada com cashback_cc.
*
* Atributos da classe FundoParticipacaoGlobalDTO sumariamente IGNORADOS por este método MESMO que estejam preenchidos:
* id
* status
* dataCadastro
* dataAtualizacao
*
* @param $daofactory
*
* @return DTOPadrao
*/ 

public function lancarMovimentoFundoParticipacaoGlobal($daofactory, $usuaid_debitar, $usuaid_bonificar, $vlrlancar, $descricao)
{
    //-------------------------------------------------------
    // Verifica a Chave Geral do Fundo de Participação Global
    //-------------------------------------------------------
    if(VariavelCache::getInstance()->getVariavel(ConstantesVariavel::CHAVE_GERAL_FUNDO_PARTICIPACAO_GLOBAL_FPGL) == ConstantesVariavel::ATIVADO)
    {
        $okfpgl = true;

        //------------------------------------------
        // Aplica regras de negócio para FPGL e CACC
        //------------------------------------------

        // Somente planos pagos
        $plusfpglbo = new PlanoUsuarioBusinessImpl();
        if($plusfpglbo->isPlanoGratuito($daofactory, $usuaid_debitar))
        {
            $okfpgl = false;
        }

        //---> colocar verificacao da permissao do plano porque nem todo plano pago permite retiradda do FPGL
        $permdto = PermissaoHelper::verificarPermissao($daofactory, $usuaid_debitar, ConstantesPlano::PERM_ACESSO_FUNDO_PARTICIPACAO_GLOBAL);
        if ($permdto->msgcode != ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO) {
            $okfpgl = false;
        }

        // dono da campanha tem que ter registro na USCA
        $uscafpglbo = new UsuarioCashbackBusinessImpl();
        $uscafpgldto = $uscafpglbo->PesquisarMaxPKAtivoId_UsuarioPorStatus($daofactory, $usuaid_debitar, ConstantesVariavel::STATUS_ATIVO);
        if(is_null($uscafpgldto))
        {
            $okfpgl = false;
        }

        if($okfpgl)
        {
            // Tudo Ok. Pode realizar o pagamento ao cliente que carimbou
            $dtofpgl = new FundoParticipacaoGlobalDTO();

            $dtofpgl->idUsuarioParticipante = $usuaid_debitar;
            $dtofpgl->idUsuarioBonificado = $usuaid_bonificar;
            $dtofpgl->valorTransacao = $vlrlancar * -1;
            $dtofpgl->descricao = $descricao;

            $retfpgl = $this->inserirCreditoBonificacao($daofactory, $dtofpgl);

            // Pode inserir o registro de crédito o cashback_cc?
            if($retfpgl->msgcode == ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO)
            {
                $caccfpglbo = new CampanhaCashbackCCBusinessImpl();
                $retfpgl = $caccfpglbo->lancarMovimentoCashbackCC($daofactory, $usuaid_bonificar, $usuaid_debitar, $vlrlancar, $descricao, ConstantesVariavel::CREDITO);

            }
        }	
    }
}

/**
* inseririnserirCreditoParticipante() - inserir um registro com base no FundoParticipacaoGlobalDTO. Alguns atributos dentro do DTO
* serão ignorados caso estejam populados.
*
* Atributos da classe FundoParticipacaoGlobalDTO sumariamente IGNORADOS por este método MESMO que estejam preenchidos:
* id
* status
* dataCadastro
* dataAtualizacao
*
* @param $daofactory
*
* @return DTOPadrao
*/ 
public function inserirCreditoParticipante($daofactory, $dto)
{ 
    $retorno = new DTOPadrao();
    $retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
    $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);

    // ............................
    // Regras de Negócio
    // ............................
    
    // Valor de crédito <= 0 , falha.
    if($dto->valorTransacao <= 0)
    {
        $retorno->msgcode = ConstantesMensagem::SALDO_INSUFICIENTE_FUNDO_PARTICIPACAO_GLOBAL;
        $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);
        return $retorno;           
    }

    // O usuário participa de um plano gratuito, falha.
    $plusfpgl = new PlanoUsuarioBusinessImpl();
    if($plusfpgl->isPlanoGratuito($daofactory, $dto->idUsuarioParticipante))
    {
        $retorno->msgcode = ConstantesMensagem::PLANO_GRATUITO_NAO_PERMITE_FPGL;
        $retorno->msgcodeString = MensagemCache::getInstance()->getMensagemParametrizada($retorno->msgcode, [
            ConstantesVariavel::P1 => $dto->idUsuarioParticipante,
        ]);
        return $retorno;           
    }

    // Permissao tá OK?
    // Somente usuário do grupo de administradores pode executar essa função (futuro)
    
    // Só pode haver uma plufid por registro de crédito do participante. Falha.
    $fpgldto = $this->pesquisarPorIdusuarioparticipanteIdplanofatura($daofactory, $dto->idUsuarioParticipante, $dto->idPlanoFatura);
    if( ! is_null($fpgldto))
    {
        $retorno->msgcode = ConstantesMensagem::FPFL_JA_EXISTE_PARTICIPANTE_FATURA;
        $retorno->msgcodeString = MensagemCache::getInstance()->getMensagemParametrizada($retorno->msgcode, [
            ConstantesVariavel::P1 => $dto->idUsuarioParticipante,
            ConstantesVariavel::P2 => $dto->idPlanoFatura,
        ]);
        return $retorno;           
    }

    
    //--- Tudo ok com regras de negócio. Pode inserir o registro 
    // Prepara registro  de bonificação
    $dto->tipoMovimento = ConstantesVariavel::CREDITO;


    return $this->inserir($daofactory, $dto);
}

/**
* inserir() - inserir um registro com base no FundoParticipacaoGlobalDTO. Alguns atributos dentro do DTO
* serão ignorados caso estejam populados.
*
* Atributos da classe FundoParticipacaoGlobalDTO sumariamente IGNORADOS por este método MESMO que estejam preenchidos:
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

    // Efetua validações no campo $dto->id com tamanho FundoParticipacaoGlobalConstantes::LEN_ID
    $ok = $this->validarTamanhoCampo($dto->id, FundoParticipacaoGlobalConstantes::LEN_ID, FundoParticipacaoGlobalConstantes::DESC_ID);
    if($ok->msgcode != ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO){
        return $ok;
    }

    // Efetua validações no campo $dto->idUsuarioParticipante com tamanho FundoParticipacaoGlobalConstantes::LEN_IDUSUARIOPARTICIPANTE
    $ok = $this->validarTamanhoCampo($dto->idUsuarioParticipante, FundoParticipacaoGlobalConstantes::LEN_IDUSUARIOPARTICIPANTE, FundoParticipacaoGlobalConstantes::DESC_IDUSUARIOPARTICIPANTE);
    if($ok->msgcode != ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO){
        return $ok;
    }

    // Efetua validações no campo $dto->idUsuarioBonificado com tamanho FundoParticipacaoGlobalConstantes::LEN_IDUSUARIOBONIFICADO
    $ok = $this->validarTamanhoCampo($dto->idUsuarioBonificado, FundoParticipacaoGlobalConstantes::LEN_IDUSUARIOBONIFICADO, FundoParticipacaoGlobalConstantes::DESC_IDUSUARIOBONIFICADO);
    if($ok->msgcode != ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO){
        return $ok;
    }

    // Efetua validações no campo $dto->idPlanoFatura com tamanho FundoParticipacaoGlobalConstantes::LEN_IDPLANOFATURA
    $ok = $this->validarTamanhoCampo($dto->idPlanoFatura, FundoParticipacaoGlobalConstantes::LEN_IDPLANOFATURA, FundoParticipacaoGlobalConstantes::DESC_IDPLANOFATURA);
    if($ok->msgcode != ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO){
        return $ok;
    }

    // Efetua validações no campo $dto->tipoMovimento com tamanho FundoParticipacaoGlobalConstantes::LEN_TIPOMOVIMENTO
    $ok = $this->validarTamanhoCampo($dto->tipoMovimento, FundoParticipacaoGlobalConstantes::LEN_TIPOMOVIMENTO, FundoParticipacaoGlobalConstantes::DESC_TIPOMOVIMENTO);
    if($ok->msgcode != ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO){
        return $ok;
    }

    // Efetua validações no campo $dto->valorTransacao com tamanho FundoParticipacaoGlobalConstantes::LEN_VALORTRANSACAO
    $ok = $this->validarTamanhoCampo($dto->valorTransacao, FundoParticipacaoGlobalConstantes::LEN_VALORTRANSACAO, FundoParticipacaoGlobalConstantes::DESC_VALORTRANSACAO);
    if($ok->msgcode != ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO){
        return $ok;
    }

    // Efetua validações no campo $dto->descricao com tamanho FundoParticipacaoGlobalConstantes::LEN_DESCRICAO
    $ok = $this->validarTamanhoCampo($dto->descricao, FundoParticipacaoGlobalConstantes::LEN_DESCRICAO, FundoParticipacaoGlobalConstantes::DESC_DESCRICAO);
    if($ok->msgcode != ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO){
        return $ok;
    }

    // Efetua validações no campo $dto->status com tamanho FundoParticipacaoGlobalConstantes::LEN_STATUS
    $ok = $this->validarTamanhoCampo($dto->status, FundoParticipacaoGlobalConstantes::LEN_STATUS, FundoParticipacaoGlobalConstantes::DESC_STATUS);
    if($ok->msgcode != ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO){
        return $ok;
    }

    // Efetua validações no campo $dto->dataCadastro com tamanho FundoParticipacaoGlobalConstantes::LEN_DATACADASTRO
    $ok = $this->validarTamanhoCampo($dto->dataCadastro, FundoParticipacaoGlobalConstantes::LEN_DATACADASTRO, FundoParticipacaoGlobalConstantes::DESC_DATACADASTRO);
    if($ok->msgcode != ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO){
        return $ok;
    }

    // Efetua validações no campo $dto->dataAtualizacao com tamanho FundoParticipacaoGlobalConstantes::LEN_DATAATUALIZACAO
    $ok = $this->validarTamanhoCampo($dto->dataAtualizacao, FundoParticipacaoGlobalConstantes::LEN_DATAATUALIZACAO, FundoParticipacaoGlobalConstantes::DESC_DATAATUALIZACAO);
    if($ok->msgcode != ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO){
        return $ok;
    }

    $dto->status = ConstantesVariavel::STATUS_ATIVO;
    $dao = $daofactory->getFundoParticipacaoGlobalDAO($daofactory);

    if (!$dao->insert($dto)) {
        $retorno = new DTOPadrao();
        $retorno->msgcode = ConstantesMensagem::ERRO_CRUD_INSERIR_REGISTRO;
        $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);
        return $retorno;
    }

    return $retorno;
}

/**
* inserirBonificacao() - inserir um registro com base no FundoParticipacaoGlobalDTO. Alguns atributos dentro do DTO
* serão ignorados caso estejam populados.
*
* Atributos da classe FundoParticipacaoGlobalDTO sumariamente IGNORADOS por este método MESMO que estejam preenchidos:
* id
* status
* dataCadastro
* dataAtualizacao
*
* @param $daofactory
*
* @return DTOPadrao
*/ 
public function inserirBonificacao($daofactory, $dto)
{ 
    $retorno = new DTOPadrao();
    $retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
    $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);

    // Efetua validações no campo $dto->id com tamanho FundoParticipacaoGlobalConstantes::LEN_ID
    $ok = $this->validarTamanhoCampo($dto->id, FundoParticipacaoGlobalConstantes::LEN_ID, FundoParticipacaoGlobalConstantes::DESC_ID);
    if($ok->msgcode != ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO){
        return $ok;
    }

    // Efetua validações no campo $dto->idUsuarioParticipante com tamanho FundoParticipacaoGlobalConstantes::LEN_IDUSUARIOPARTICIPANTE
    $ok = $this->validarTamanhoCampo($dto->idUsuarioParticipante, FundoParticipacaoGlobalConstantes::LEN_IDUSUARIOPARTICIPANTE, FundoParticipacaoGlobalConstantes::DESC_IDUSUARIOPARTICIPANTE);
    if($ok->msgcode != ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO){
        return $ok;
    }

    // Efetua validações no campo $dto->idUsuarioBonificado com tamanho FundoParticipacaoGlobalConstantes::LEN_IDUSUARIOBONIFICADO
    $ok = $this->validarTamanhoCampo($dto->idUsuarioBonificado, FundoParticipacaoGlobalConstantes::LEN_IDUSUARIOBONIFICADO, FundoParticipacaoGlobalConstantes::DESC_IDUSUARIOBONIFICADO);
    if($ok->msgcode != ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO){
        return $ok;
    }

    // Efetua validações no campo $dto->idPlanoFatura com tamanho FundoParticipacaoGlobalConstantes::LEN_IDPLANOFATURA
    $ok = $this->validarTamanhoCampo($dto->idPlanoFatura, FundoParticipacaoGlobalConstantes::LEN_IDPLANOFATURA, FundoParticipacaoGlobalConstantes::DESC_IDPLANOFATURA);
    if($ok->msgcode != ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO){
        return $ok;
    }

    // Efetua validações no campo $dto->tipoMovimento com tamanho FundoParticipacaoGlobalConstantes::LEN_TIPOMOVIMENTO
    $ok = $this->validarTamanhoCampo($dto->tipoMovimento, FundoParticipacaoGlobalConstantes::LEN_TIPOMOVIMENTO, FundoParticipacaoGlobalConstantes::DESC_TIPOMOVIMENTO);
    if($ok->msgcode != ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO){
        return $ok;
    }

    // Efetua validações no campo $dto->valorTransacao com tamanho FundoParticipacaoGlobalConstantes::LEN_VALORTRANSACAO
    $ok = $this->validarTamanhoCampo($dto->valorTransacao, FundoParticipacaoGlobalConstantes::LEN_VALORTRANSACAO, FundoParticipacaoGlobalConstantes::DESC_VALORTRANSACAO);
    if($ok->msgcode != ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO){
        return $ok;
    }

    // Efetua validações no campo $dto->descricao com tamanho FundoParticipacaoGlobalConstantes::LEN_DESCRICAO
    $ok = $this->validarTamanhoCampo($dto->descricao, FundoParticipacaoGlobalConstantes::LEN_DESCRICAO, FundoParticipacaoGlobalConstantes::DESC_DESCRICAO);
    if($ok->msgcode != ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO){
        return $ok;
    }

    // Efetua validações no campo $dto->status com tamanho FundoParticipacaoGlobalConstantes::LEN_STATUS
    $ok = $this->validarTamanhoCampo($dto->status, FundoParticipacaoGlobalConstantes::LEN_STATUS, FundoParticipacaoGlobalConstantes::DESC_STATUS);
    if($ok->msgcode != ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO){
        return $ok;
    }

    // Efetua validações no campo $dto->dataCadastro com tamanho FundoParticipacaoGlobalConstantes::LEN_DATACADASTRO
    $ok = $this->validarTamanhoCampo($dto->dataCadastro, FundoParticipacaoGlobalConstantes::LEN_DATACADASTRO, FundoParticipacaoGlobalConstantes::DESC_DATACADASTRO);
    if($ok->msgcode != ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO){
        return $ok;
    }

    // Efetua validações no campo $dto->dataAtualizacao com tamanho FundoParticipacaoGlobalConstantes::LEN_DATAATUALIZACAO
    $ok = $this->validarTamanhoCampo($dto->dataAtualizacao, FundoParticipacaoGlobalConstantes::LEN_DATAATUALIZACAO, FundoParticipacaoGlobalConstantes::DESC_DATAATUALIZACAO);
    if($ok->msgcode != ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO){
        return $ok;
    }

    $dto->status = ConstantesVariavel::STATUS_ATIVO;
    $dao = $daofactory->getFundoParticipacaoGlobalDAO($daofactory);

    if (!$dao->insertBonificacao($dto)) {
        $retorno = new DTOPadrao();
        $retorno->msgcode = ConstantesMensagem::ERRO_CRUD_INSERIR_REGISTRO;
        $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);
        return $retorno;
    }

    return $retorno;
}

/**
*
* listarFundoParticipacaoGlobalPorStatus() - Usado para invocar a interface de acesso aos dados (DAO) FundoParticipacaoGlobalDAO de forma geral
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

    public function listarFundoParticipacaoGlobalPorStatus($daofactory, $status, $pag, $qtde, $coluna, $ordem)
    {   
        $retorno = new DTOPaginacao();
        $retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
        $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);

        $dao = $daofactory->getFundoParticipacaoGlobalDAO($daofactory);
        $retorno->pagina = $pag;
        $retorno->itensPorPagina = ($qtde == 0 
        ? (int) VariavelCache::getInstance()->getVariavel(ConstantesVariavel::MAXIMO_LINHAS_POR_PAGINA_DEFAULT)
        : $qtde);
        $retorno->totalPaginas = ceil($dao->countFundoParticipacaoGlobalPorStatus($status) / $retorno->itensPorPagina);

        if($pag > $retorno->totalPaginas) {
            $retorno->msgcode = ConstantesMensagem::NAO_EXISTEM_MAIS_PAGINAS_APRESENTAR;
            $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);
            return $retorno;
        }
        $retorno->lst = $dao->listFundoParticipacaoGlobalPorStatus($status, $pag, $qtde, $coluna, $ordem);

        return $retorno;
    }






/**
*
* atualizarIdusuarioparticipantePorPK() - Usado para invocar a classe de negócio FundoParticipacaoGlobalBusinessImpl de forma geral
* realizar uma atualização de ID do usuário participante diretamente na tabela FUNDO_PARTICIPACAO_GLOBAL campo USUA_ID
* @param $daofactory
* @param $id
* @param $idUsuarioParticipante
* @return FundoParticipacaoGlobalDTO
*
* 
*/
    public function atualizarIdusuarioparticipantePorPK($daofactory,$idUsuarioParticipante,$id)
    {
        $dao = $daofactory->getFundoParticipacaoGlobalDAO($daofactory);

        // resposta padrão
        $retorno = new DTOPadrao();

        if($dao->updateIdusuarioparticipante($id, $idUsuarioParticipante)){   
            $retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
        }       

        // Obtem o texto da mensagem em razão do código de retorno
        $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);

        return $retorno;
    }

/**
*
* atualizarIdusuariobonificadoPorPK() - Usado para invocar a classe de negócio FundoParticipacaoGlobalBusinessImpl de forma geral
* realizar uma atualização de ID do usuário bonificado diretamente na tabela FUNDO_PARTICIPACAO_GLOBAL campo USUA_ID_BONIFICADO
* @param $daofactory
* @param $id
* @param $idUsuarioBonificado
* @return FundoParticipacaoGlobalDTO
*
* 
*/
    public function atualizarIdusuariobonificadoPorPK($daofactory,$idUsuarioBonificado,$id)
    {
        $dao = $daofactory->getFundoParticipacaoGlobalDAO($daofactory);

        // resposta padrão
        $retorno = new DTOPadrao();

        if($dao->updateIdusuariobonificado($id, $idUsuarioBonificado)){   
            $retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
        }       

        // Obtem o texto da mensagem em razão do código de retorno
        $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);

        return $retorno;
    }

/**
*
* atualizarIdplanofaturaPorPK() - Usado para invocar a classe de negócio FundoParticipacaoGlobalBusinessImpl de forma geral
* realizar uma atualização de ID do plano fatura do usuário diretamente na tabela FUNDO_PARTICIPACAO_GLOBAL campo PLUF_ID
* @param $daofactory
* @param $id
* @param $idPlanoFatura
* @return FundoParticipacaoGlobalDTO
*
* 
*/
    public function atualizarIdplanofaturaPorPK($daofactory,$idPlanoFatura,$id)
    {
        $dao = $daofactory->getFundoParticipacaoGlobalDAO($daofactory);

        // resposta padrão
        $retorno = new DTOPadrao();

        if($dao->updateIdplanofatura($id, $idPlanoFatura)){   
            $retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
        }       

        // Obtem o texto da mensagem em razão do código de retorno
        $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);

        return $retorno;
    }

/**
*
* atualizarTipomovimentoPorPK() - Usado para invocar a classe de negócio FundoParticipacaoGlobalBusinessImpl de forma geral
* realizar uma atualização de Tipo do movimento diretamente na tabela FUNDO_PARTICIPACAO_GLOBAL campo FPGL_IN_TIPO
* @param $daofactory
* @param $id
* @param $tipoMovimento
* @return FundoParticipacaoGlobalDTO
*
* 
*/
    public function atualizarTipomovimentoPorPK($daofactory,$tipoMovimento,$id)
    {
        $dao = $daofactory->getFundoParticipacaoGlobalDAO($daofactory);

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
* atualizarValortransacaoPorPK() - Usado para invocar a classe de negócio FundoParticipacaoGlobalBusinessImpl de forma geral
* realizar uma atualização de Valor do crédito ou débito diretamente na tabela FUNDO_PARTICIPACAO_GLOBAL campo FPGL_VL_TRANSACAO
* @param $daofactory
* @param $id
* @param $valorTransacao
* @return FundoParticipacaoGlobalDTO
*
* 
*/
    public function atualizarValortransacaoPorPK($daofactory,$valorTransacao,$id)
    {
        $dao = $daofactory->getFundoParticipacaoGlobalDAO($daofactory);

        // resposta padrão
        $retorno = new DTOPadrao();

        if($dao->updateValortransacao($id, $valorTransacao)){   
            $retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
        }       

        // Obtem o texto da mensagem em razão do código de retorno
        $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);

        return $retorno;
    }

/**
*
* atualizarDescricaoPorPK() - Usado para invocar a classe de negócio FundoParticipacaoGlobalBusinessImpl de forma geral
* realizar uma atualização de descrição diretamente na tabela FUNDO_PARTICIPACAO_GLOBAL campo FPGL_TX_DESCRICAO
* @param $daofactory
* @param $id
* @param $descricao
* @return FundoParticipacaoGlobalDTO
*
* 
*/
    public function atualizarDescricaoPorPK($daofactory,$descricao,$id)
    {
        $dao = $daofactory->getFundoParticipacaoGlobalDAO($daofactory);

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
* pesquisarPorIdusuarioparticipante() - Usado para invocar a classe de negócio FundoParticipacaoGlobalBusinessImpl de forma geral
* realizar uma busca de ID do usuário participante diretamente na tabela FUNDO_PARTICIPACAO_GLOBAL campo USUA_ID
*
* @param $idUsuarioParticipante
* @return FundoParticipacaoGlobalDTO
*
* 
*/
    public function pesquisarPorIdusuarioparticipante($daofactory,$idUsuarioParticipante)
    { 
        $dao = $daofactory->getFundoParticipacaoGlobalDAO($daofactory);
        return $dao->loadIdusuarioparticipante($idUsuarioParticipante);
    }


/**
*
* pesquisarPorIdusuarioparticipanteIdplanofatura() - Usado para invocar a classe de negócio FundoParticipacaoGlobalBusinessImpl de forma geral
* realizar uma busca de ID do usuário participante diretamente na tabela FUNDO_PARTICIPACAO_GLOBAL campo USUA_ID
*
* @param $idUsuarioParticipante
* @return FundoParticipacaoGlobalDTO
*
* 
*/
    public function pesquisarPorIdusuarioparticipanteIdplanofatura($daofactory, $idUsuarioParticipante, $idPlanoFatura)
    { 
        $dao = $daofactory->getFundoParticipacaoGlobalDAO($daofactory);
        return $dao->loadIdusuarioparticipanteIdplanofatura($idUsuarioParticipante, $idPlanoFatura);
    }

/**
*
* pesquisarPorIdusuariobonificado() - Usado para invocar a classe de negócio FundoParticipacaoGlobalBusinessImpl de forma geral
* realizar uma busca de ID do usuário bonificado diretamente na tabela FUNDO_PARTICIPACAO_GLOBAL campo USUA_ID_BONIFICADO
*
* @param $idUsuarioBonificado
* @return FundoParticipacaoGlobalDTO
*
* 
*/
    public function pesquisarPorIdusuariobonificado($daofactory,$idUsuarioBonificado)

    { 
        $dao = $daofactory->getFundoParticipacaoGlobalDAO($daofactory);
        return $dao->loadIdusuariobonificado($idUsuarioBonificado);
    }

/**
*
* pesquisarPorIdplanofatura() - Usado para invocar a classe de negócio FundoParticipacaoGlobalBusinessImpl de forma geral
* realizar uma busca de ID do plano fatura do usuário diretamente na tabela FUNDO_PARTICIPACAO_GLOBAL campo PLUF_ID
*
* @param $idPlanoFatura
* @return FundoParticipacaoGlobalDTO
*
* 
*/
    public function pesquisarPorIdplanofatura($daofactory,$idPlanoFatura)

    { 
        $dao = $daofactory->getFundoParticipacaoGlobalDAO($daofactory);
        return $dao->loadIdplanofatura($idPlanoFatura);
    }

/**
*
* pesquisarPorTipomovimento() - Usado para invocar a classe de negócio FundoParticipacaoGlobalBusinessImpl de forma geral
* realizar uma busca de Tipo do movimento diretamente na tabela FUNDO_PARTICIPACAO_GLOBAL campo FPGL_IN_TIPO
*
* @param $tipoMovimento
* @return FundoParticipacaoGlobalDTO
*
* 
*/
    public function pesquisarPorTipomovimento($daofactory,$tipoMovimento)

    { 
        $dao = $daofactory->getFundoParticipacaoGlobalDAO($daofactory);
        return $dao->loadTipomovimento($tipoMovimento);
    }

/**
*
* pesquisarPorValortransacao() - Usado para invocar a classe de negócio FundoParticipacaoGlobalBusinessImpl de forma geral
* realizar uma busca de Valor do crédito ou débito diretamente na tabela FUNDO_PARTICIPACAO_GLOBAL campo FPGL_VL_TRANSACAO
*
* @param $valorTransacao
* @return FundoParticipacaoGlobalDTO
*
* 
*/
    public function pesquisarPorValortransacao($daofactory,$valorTransacao)

    { 
        $dao = $daofactory->getFundoParticipacaoGlobalDAO($daofactory);
        return $dao->loadValortransacao($valorTransacao);
    }

/**
*
* pesquisarPorDescricao() - Usado para invocar a classe de negócio FundoParticipacaoGlobalBusinessImpl de forma geral
* realizar uma busca de descrição diretamente na tabela FUNDO_PARTICIPACAO_GLOBAL campo FPGL_TX_DESCRICAO
*
* @param $descricao
* @return FundoParticipacaoGlobalDTO
*
* 
*/
    public function pesquisarPorDescricao($daofactory,$descricao)

    { 
        $dao = $daofactory->getFundoParticipacaoGlobalDAO($daofactory);
        return $dao->loadDescricao($descricao);
    }

/**
*
* listarFundoParticipacaoGlobalUsuaIdPorStatus() - Usado para invocar a interface de acesso aos dados (DAO) FundoParticipacaoGlobalDAO de forma geral
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

    public function listarFundoParticipacaoGlobalPorUsuaIdStatus($daofactory, $usuaid, $status, $pag, $qtde, $coluna, $ordem)
    {   
        $retorno = new DTOPaginacao();
        $retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
        $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);

        $dao = $daofactory->getFundoParticipacaoGlobalDAO($daofactory);
        $retorno->pagina = $pag;
        $retorno->itensPorPagina = ($qtde == 0 
        ? (int) VariavelCache::getInstance()->getVariavel(ConstantesVariavel::MAXIMO_LINHAS_POR_PAGINA_DEFAULT)
        : $qtde);
        $retorno->totalPaginas = ceil($dao->countFundoParticipacaoGlobalPorUsuaIdStatus($usuaid, $status) / $retorno->itensPorPagina);

        if($pag > $retorno->totalPaginas) {
            $retorno->msgcode = ConstantesMensagem::NAO_EXISTEM_MAIS_PAGINAS_APRESENTAR;
            $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);
            return $retorno;
        }
        $retorno->lst = $dao->listFundoParticipacaoGlobalPorUsuaIdStatus($usuaid, $status, $pag, $qtde, $coluna, $ordem);

        return $retorno;
    }

/**
* validarTamanhoCampo()
*
* Validador de tamanho de campos FundoParticipacaoGlobalDTO
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
