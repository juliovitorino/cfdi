<?php

/**
* MySqlKinghostCampanhaCashbackResgatePixDAO - Implementação DAO
*
* Classe de com todos os comandos DML e DDL (se necessário) para apoio 
* a classe MySqlKinghostCampanhaCashbackResgatePixDAO
* Não é uma camada visível para outros dispositivos, como as camadas de apresentação e aplicação. 
*
*
* Tabela principal de atuação: CAMPANHA_CASHBACK_RESGATE_PIX
*
* Changelog:
*
* 
* @author Julio Cesar Vitorino
* @since 23/08/2019 10:06:20
*
*/
require_once 'CampanhaCashbackResgatePixDTO.php';
require_once 'CampanhaCashbackResgatePixDAO.php';
require_once 'DmlSqlCampanhaCashbackResgatePix.php';

require_once '../mensagem/ConstantesMensagem.php';
require_once '../mensagem/MensagemCache.php';
require_once '../variavel/VariavelCache.php';
require_once '../daofactory/DmlSql.php';

class MySqlKinghostCampanhaCashbackResgatePixDAO implements CampanhaCashbackResgatePixDAO
{
    private $daofactory;

    function __construct($daofactory)
    {
        $this->daofactory = $daofactory;
    }


/**
* loadMaxPK() - Carrega um MaxID (pk) para um ${CAMPO} e status
*
* @param $idUsuarioDevedor
* @param $status
* @return $dto
*/ 

    public function loadMaxPK($idUsuarioSolicitante, $idUsuarioDevedor,$status)
    {   
        $retorno = 0;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $sql = DmlSqlCampanhaCashbackResgatePix::SELECT_MAX_PK . ' WHERE ' 
        . DmlSqlCampanhaCashbackResgatePix::USUA_ID . " = $idUsuarioSolicitante "
        . " AND " .  DmlSqlCampanhaCashbackResgatePix::USUA_ID_DEVEDOR . " = $idUsuarioDevedor "
        . " AND " . DmlSqlCampanhaCashbackResgatePix::CCRP_IN_STATUS . " = '$status'";
        $res = $conexao->query($sql);
        if ($res){
            $tmp = $res->fetch_assoc();
            $retorno = $tmp['maxid'] == NULL ? 0 : $tmp['maxid'];
        }
        return $retorno;

    }

/**
* load() - Carrega apenas um registro com base no campo id do DTO = (TIPO_EMPREENDIMENTO::TIEM_ID)
*
* @param $dto
* @return $dto
*/ 
    public function load($dto)  {   }

/**
* listAll() - Lista todos os registros provenientes de CAMPANHA_CASHBACK_RESGATE_PIX sem critério de paginação
*
* @return List<CampanhaCashbackResgatePixDTO>[]
*/ 
    public function listAll()   {   }

/**
* update() - atualiza apenas um registro com base no dto CampanhaCashbackResgatePixDTO->id
* @param $daofactory
*
* @return boolean
*/ 
    public function update($dto)
    {   
        $retorno = false;

        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $stmt = $conexao->prepare(DmlSqlCampanhaCashbackResgatePix::UPD_PK);
        $stmt->bind_param(DmlSql::INTEGER_TYPE 
                            . DmlSql::INTEGER_TYPE 
                            . DmlSql::INTEGER_TYPE 
                            . DmlSql::STRING_TYPE 
                            . DmlSql::STRING_TYPE 
                            . DmlSql::STRING_TYPE 
                            . DmlSql::INTEGER_TYPE 
                            . DmlSql::STRING_TYPE 
                            . DmlSql::STRING_TYPE 
                            . DmlSql::STRING_TYPE 
                            . DmlSql::STRING_TYPE 
                            . DmlSql::STRING_TYPE 
                            . DmlSql::STRING_TYPE 
                            . DmlSql::STRING_TYPE 
                            . DmlSql::STRING_TYPE 
                            . DmlSql::STRING_TYPE 
                            . DmlSql::INTEGER_TYPE 
                            ,$dto->idUsuarioDevedor
                            ,$dto->idUsuarioSolicitante
                            ,$dto->tipoChavePix
                            ,$dto->chavePix
                            ,$dto->valorResgate
                            ,$dto->autenticacaoBco
                            ,$dto->estagioRealTime
                            ,$dto->dtEstagioAnalise
                            ,$dto->txtEstagioAnalise
                            ,$dto->dtEstagioFinanceiro
                            ,$dto->txtEstagioFinanceiro
                            ,$dto->dtEstagioErro
                            ,$dto->txtEstagioErro
                            ,$dto->dtEstagioTranfBco
                            ,$dto->txtEstagioTranfBco
                            ,$dto->txtLivreEstagioRT
                            ,$dto->id );
        if ($stmt->execute())
        {
            $retorno = true;
        }

        return $retorno;
    }

/**
* delete() - excluir fisicamente um registro com base no dto CampanhaCashbackResgatePixDTO->id
*
* @return boolean
*/ 
    public function delete($dto)
    {   
        $retorno = false;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $stmt = $conexao->prepare(DmlSqlCampanhaCashbackResgatePix::DEL_PK);
        $stmt->bind_param(DmlSql::INTEGER_TYPE
                            ,$dto->id);
        if ($stmt->execute())
        {
            $retorno = true;
        }

        return $retorno;
    }


    public function listCampanhaCashbackResgatePixStatus($status)
    {
        $retorno = array();

        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $res = $conexao->query(DmlSqlCampanhaCashbackResgatePix::SELECT . 'WHERE `' . DmlSqlCampanhaCashbackResgatePix::CCRP_IN_STATUS . "` = '$status'" );
        if ($res){
            while ($row = $res->fetch_assoc()) {
                array_push($retorno, $this->getDTO($row));
            }
        }
        return $retorno;
    }

/**
* countCampanhaCashbackResgatePixPorStatus() - contar a quantidade de registros
* sob o contexto da classe CampanhaCashbackResgatePix com base no status específico. 
*
* Atenção em @see $sql na tabela CAMPANHA_CASHBACK_RESGATE_PIX 
*
* @see listPagina()
*
*
* @param $status
* @param $pag
* @param $qtde
* @param $coluna
* @param $ordem
*
* @return PaginacaoDTO
*/ 

    public function countCampanhaCashbackResgatePixPorStatus($status)
    {   
        $retorno = 0;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $res = $conexao->query(DmlSqlCampanhaCashbackResgatePix::SQL_COUNT . ' WHERE ' 
        . DmlSqlCampanhaCashbackResgatePix::CCRP_IN_STATUS . " = '$status'"
        );
        if ($res){
            $tmp = $res->fetch_assoc();
            $retorno = $tmp['contador'];
        }
        return $retorno;

    }

/**
* listCampanhaCashbackResgatePixPorStatus() - Listar um conjunto de registro previamente paginado
* sob o contexto da classe CampanhaCashbackResgatePix com base no status específico.
*
* Atenção em @see $sql na tabela CAMPANHA_CASHBACK_RESGATE_PIX 
*
* @see listPagina()
*
*
* @param $status
* @param $pag
* @param $qtde
* @param $coluna
* @param $ordem
*
* @return PaginacaoDTO
*/ 

    public function listCampanhaCashbackResgatePixPorStatus($status, $pag, $qtde, $coluna, $ordem)
    {
        $sql = DmlSqlCampanhaCashbackResgatePix::SELECT 
        . ' WHERE ' . DmlSqlCampanhaCashbackResgatePix::CCRP_IN_STATUS . " = '$status'"
        . ' ORDER BY ' . $coluna . ($ordem == 0 ? " ASC": " DESC");
        return $this->listPagina($sql, $pag, $qtde);
    }

/**
* countCampanhaCashbackResgatePixPorUsuaIdStatus() - contar a quantidade de registros
* sob o contexto da classe CampanhaCashbackResgatePix com base no usuário específico. Esse usuário
* é o usuário logado na sessão ou no próprio dispositivo móvel e de acordo com a 
* query em @see $sql na tabela CAMPANHA_CASHBACK_RESGATE_PIX 
*
* @see listPagina()
*
* @param $usuaid
* @param $status
* @param $pag
* @param $qtde
* @param $coluna
* @param $ordem
*
* @return PaginacaoDTO
*/ 

    public function countCampanhaCashbackResgatePixPorUsuaIdStatus($usuaid, $status)
    {   
        $retorno = 0;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $res = $conexao->query(DmlSqlCampanhaCashbackResgatePix::SQL_COUNT . ' WHERE ' 
        . DmlSqlCampanhaCashbackResgatePix::USUA_ID . " = $usuaid "
        . ' AND ' . DmlSqlCampanhaCashbackResgatePix::CCRP_IN_STATUS . " = '$status'"
        );
        if ($res){
            $tmp = $res->fetch_assoc();
            $retorno = $tmp['contador'];
        }
        return $retorno;

    }

/**
* listCampanhaCashbackResgatePixPorUsuaIdStatus() - Listar um conjunto de registro previamente paginado
* sob o contexto da classe CampanhaCashbackResgatePix com base no usuário específico. Esse usuário
* é o usuário logado na sessão ou no próprio dispositivo móvel e de acordo com a 
* query em @see $sql na tabela CAMPANHA_CASHBACK_RESGATE_PIX 
*
* @see listPagina()
*
* @param $usuaid
* @param $status
* @param $pag
* @param $qtde
* @param $coluna
* @param $ordem
*
* @return PaginacaoDTO
*/ 
    public function listCampanhaCashbackResgatePixPorUsuaIdStatus($usuaid, $status, $pag, $qtde, $coluna, $ordem)
    {
        $sql = DmlSqlCampanhaCashbackResgatePix::SELECT 
        . ' WHERE ' . DmlSqlCampanhaCashbackResgatePix::USUA_ID . " = $usuaid "
        . ' AND ' . DmlSqlCampanhaCashbackResgatePix::CCRP_IN_STATUS . " = '$status' "
        . ' ORDER BY ' . $coluna . ($ordem == 0 ? " ASC": " DESC");
        return $this->listPagina($sql, $pag, $qtde);
    }



/**
* countCampanhaCashbackResgatePixPorUsuaIdUsuaIdDevedorStatus() - contar a quantidade de registros
* sob o contexto da classe CampanhaCashbackResgatePix com base no usuário específico. Esse usuário
* é o usuário logado na sessão ou no próprio dispositivo móvel e de acordo com a 
* query em @see $sql na tabela CAMPANHA_CASHBACK_RESGATE_PIX 
*
* @see listPagina()
*
* @param $usuaid
* @param $usuaidDevedor
* @param $status
* @param $pag
* @param $qtde
* @param $coluna
* @param $ordem
*
* @return PaginacaoDTO
*/ 

public function countCampanhaCashbackResgatePixPorUsuaIdUsuaIdDevedorStatus($usuaid, $usuaidDevedor, $status)
{   
    $retorno = 0;
    // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
    $conexao = $this->daofactory->getSession();
    $res = $conexao->query(DmlSqlCampanhaCashbackResgatePix::SQL_COUNT . ' WHERE ' 
    . DmlSqlCampanhaCashbackResgatePix::USUA_ID . " = $usuaid "
    . ' AND ' . DmlSqlCampanhaCashbackResgatePix::USUA_ID_DEVEDOR . " = $usuaidDevedor "
    . ' AND ' . DmlSqlCampanhaCashbackResgatePix::CCRP_IN_STATUS . " = '$status'"
    );
    if ($res){
        $tmp = $res->fetch_assoc();
        $retorno = $tmp['contador'];
    }
    return $retorno;

}

/**
* listCampanhaCashbackResgatePixPorUsuaIdUsuaIdDevedorStatus() - Listar um conjunto de registro previamente paginado
* sob o contexto da classe CampanhaCashbackResgatePix com base no usuário específico. Esse usuário
* é o usuário logado na sessão ou no próprio dispositivo móvel e de acordo com a 
* query em @see $sql na tabela CAMPANHA_CASHBACK_RESGATE_PIX 
*
* @see listPagina()
*
* @param $usuaid
* @param $usuaidDevedor
* @param $status
* @param $pag
* @param $qtde
* @param $coluna
* @param $ordem
*
* @return PaginacaoDTO
*/ 
public function listCampanhaCashbackResgatePixPorUsuaIdUsuaIdDevedorStatus($usuaid, $usuaidDevedor, $status, $pag, $qtde, $coluna, $ordem)
{
    $sql = DmlSqlCampanhaCashbackResgatePix::SELECT 
    . ' WHERE ' . DmlSqlCampanhaCashbackResgatePix::USUA_ID . " = $usuaid "
    . ' AND ' . DmlSqlCampanhaCashbackResgatePix::USUA_ID_DEVEDOR . " = $usuaidDevedor "
    . ' AND ' . DmlSqlCampanhaCashbackResgatePix::CCRP_IN_STATUS . " = '$status' "
    . ' ORDER BY ' . $coluna . ($ordem == 0 ? " ASC": " DESC");
    return $this->listPagina($sql, $pag, $qtde);
}

/**
* listPagina() - Listar um conjunto de registro previamente paginado
* e de acordo com a query em @see $sql na tabela CAMPANHA_CASHBACK_RESGATE_PIX 
*
* @param $sql
* @param $pag
* @param $qtde
*
* @return PaginacaoDTO
*/ 
    public function listPagina($sql, $pag, $qtde)
    {
        $retorno = array();
        $final = $pag * $qtde - $qtde;
        $sql = $sql . " LIMIT $final, $qtde" ;

        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $res = $conexao->query($sql );
        if ($res){
            while ($row = $res->fetch_assoc()) {
                array_push($retorno, $this->getDTO($row));
            }
        }
        return $retorno;
    }

/**
* loadPK() - Carrega APENAS um registro usando a id como item de busca
* na tabela CAMPANHA_CASHBACK_RESGATE_PIX usando a Primary Key CCRP_ID
*
* @param $id
* @return CampanhaCashbackResgatePixDTO
*/ 
    public function loadPK($id)
    {   
        $retorno = NULL;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $res = $conexao->query(DmlSqlCampanhaCashbackResgatePix::SELECT . ' WHERE ' . DmlSqlCampanhaCashbackResgatePix::CCRP_ID . '=' . $id );
        if ($res->num_rows > 0){
            $retorno = $this->getDTO($res->fetch_assoc());
        }
        return $retorno;
    }

/**
* updateStatus() - atualizar o campo de STATUS utilizando a id como item de busca
* na tabela CAMPANHA_CASHBACK_RESGATE_PIX usando a Primary Key CCRP_ID
*
* @param $id
* @param $status
*
* @return CampanhaCashbackResgatePixDTO
*/ 
    public function updateStatus($id, $status)
    {   
        $retorno = false;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $stmt = $conexao->prepare(DmlSqlCampanhaCashbackResgatePix::UPD_STATUS);
        $stmt->bind_param(DmlSql::STRING_TYPE 
                            . DmlSql::STRING_TYPE 
                            ,$status
                            ,$id);
        if ($stmt->execute())
        {
            $retorno = true;
        }

        return $retorno;
    }

/**
* insert() - inserir um registro com base no CampanhaCashbackResgatePixDTO. Alguns atributos dentro do DTO
* serão ignorados caso estejam populados, pois os mesmos possuem constraint de DEFAULT value
* ou campos de AUTO INCREMENTO já previamente definidos no DDL de criação de tabelas do BD.
*
* Atributos da classe CampanhaCashbackResgatePixDTO sumariamente IGNORADOS por este método MESMO que estejam preenchidos:
* id
* status
* dataCadastro
* dataAtualizacao
*
* @return boolean
*/ 
    public function insert($dto) 
    {   
        $retorno = false;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $stmt = $conexao->prepare(DmlSqlCampanhaCashbackResgatePix::INS);
        $stmt->bind_param(DmlSql::INTEGER_TYPE 
                            . DmlSql::INTEGER_TYPE 
                            . DmlSql::STRING_TYPE 
                            . DmlSql::STRING_TYPE 
                            . DmlSql::DOUBLE_TYPE 
                            ,$dto->idUsuarioDevedor
                            ,$dto->idUsuarioSolicitante
                            ,$dto->tipoChavePix
                            ,$dto->chavePix
                            ,$dto->valorResgate
        );
        if ($stmt->execute())
        {
            $retorno = true;
        }

        return $retorno;
    }

    /**
     * getDTO() - Transforma o resultset padrão em CampanhaCashbackResgatePixDTO
    */
    public function getDTO($resultset)
    {
        if(is_null($resultset)){
            return NULL;
        }

        //echo var_dump($resultset); // ótimo pra debugar
        $retorno = new CampanhaCashbackResgatePixDTO();
        $retorno->id = $resultset[DmlSqlCampanhaCashbackResgatePix::CCRP_ID] == NULL ? NULL : $resultset[DmlSqlCampanhaCashbackResgatePix::CCRP_ID];
        $retorno->idUsuarioDevedor = $resultset[DmlSqlCampanhaCashbackResgatePix::USUA_ID_DEVEDOR] == NULL ? NULL : $resultset[DmlSqlCampanhaCashbackResgatePix::USUA_ID_DEVEDOR];
        $retorno->idUsuarioSolicitante = $resultset[DmlSqlCampanhaCashbackResgatePix::USUA_ID] == NULL ? NULL : $resultset[DmlSqlCampanhaCashbackResgatePix::USUA_ID];
        $retorno->tipoChavePix = $resultset[DmlSqlCampanhaCashbackResgatePix::CCRP_IN_TIPO_CHAVE_PIX] == NULL ? NULL : $resultset[DmlSqlCampanhaCashbackResgatePix::CCRP_IN_TIPO_CHAVE_PIX];
        $retorno->chavePix = $resultset[DmlSqlCampanhaCashbackResgatePix::CCRP_TX_CHAVE_PIX] == NULL ? NULL : $resultset[DmlSqlCampanhaCashbackResgatePix::CCRP_TX_CHAVE_PIX];
        $retorno->valorResgate = $resultset[DmlSqlCampanhaCashbackResgatePix::CCRP_VL_RESGATE] == NULL ? 0 : floatval($resultset[DmlSqlCampanhaCashbackResgatePix::CCRP_VL_RESGATE]);
        $retorno->valorResgateCurrency = Util::getMoeda($retorno->valorResgate);
        $retorno->autenticacaoBco = $resultset[DmlSqlCampanhaCashbackResgatePix::CCRP_TX_AUTENT_BCO] == NULL ? NULL : $resultset[DmlSqlCampanhaCashbackResgatePix::CCRP_TX_AUTENT_BCO];
        $retorno->estagioRealTime = $resultset[DmlSqlCampanhaCashbackResgatePix::CCRP_IN_ESTAGIO_RT] == NULL ? NULL : $resultset[DmlSqlCampanhaCashbackResgatePix::CCRP_IN_ESTAGIO_RT];
        $retorno->dtEstagioAnalise = $resultset[DmlSqlCampanhaCashbackResgatePix::CCRP_DT_ESTAGIO_ANALISE] == NULL ? NULL : $resultset[DmlSqlCampanhaCashbackResgatePix::CCRP_DT_ESTAGIO_ANALISE];
        $retorno->txtEstagioAnalise = $resultset[DmlSqlCampanhaCashbackResgatePix::CCRP_TX_ESTAGIO_ANALISE] == NULL ? NULL : $resultset[DmlSqlCampanhaCashbackResgatePix::CCRP_TX_ESTAGIO_ANALISE];
        $retorno->dtEstagioFinanceiro = $resultset[DmlSqlCampanhaCashbackResgatePix::CCRP_DT_ESTAGIO_FINANCEIRO] == NULL ? NULL : $resultset[DmlSqlCampanhaCashbackResgatePix::CCRP_DT_ESTAGIO_FINANCEIRO];
        $retorno->txtEstagioFinanceiro = $resultset[DmlSqlCampanhaCashbackResgatePix::CCRP_TX_ESTAGIO_FINANCEIRO] == NULL ? NULL : $resultset[DmlSqlCampanhaCashbackResgatePix::CCRP_TX_ESTAGIO_FINANCEIRO];
        $retorno->dtEstagioErro = $resultset[DmlSqlCampanhaCashbackResgatePix::CCRP_DT_ESTAGIO_ERRO] == NULL ? NULL : $resultset[DmlSqlCampanhaCashbackResgatePix::CCRP_DT_ESTAGIO_ERRO];
        $retorno->txtEstagioErro = $resultset[DmlSqlCampanhaCashbackResgatePix::CCRP_TX_ESTAGIO_ERRO] == NULL ? NULL : $resultset[DmlSqlCampanhaCashbackResgatePix::CCRP_TX_ESTAGIO_ERRO];
        $retorno->dtEstagioTranfBco = $resultset[DmlSqlCampanhaCashbackResgatePix::CCRP_DT_ESTAGIO_TRANSF_BCO] == NULL ? NULL : $resultset[DmlSqlCampanhaCashbackResgatePix::CCRP_DT_ESTAGIO_TRANSF_BCO];
        $retorno->txtEstagioTransfBco = $resultset[DmlSqlCampanhaCashbackResgatePix::CCRP_TX_ESTAGIO_TRANSF_BCO] == NULL ? NULL : $resultset[DmlSqlCampanhaCashbackResgatePix::CCRP_TX_ESTAGIO_TRANSF_BCO];
        $retorno->txtLivreEstagioRT = $resultset[DmlSqlCampanhaCashbackResgatePix::CCRP_TX_LIVRE_ESTAGIO_RT] == NULL ? NULL : $resultset[DmlSqlCampanhaCashbackResgatePix::CCRP_TX_LIVRE_ESTAGIO_RT];
        $retorno->status = $resultset[DmlSqlCampanhaCashbackResgatePix::CCRP_IN_STATUS] == NULL ? NULL : $resultset[DmlSqlCampanhaCashbackResgatePix::CCRP_IN_STATUS];
        $retorno->dataCadastro = Util::MySQLDate_to_DMYHMiS($resultset[DmlSqlCampanhaCashbackResgatePix::CCRP_DT_CADASTRO]);
        $retorno->dataAtualizacao = Util::MySQLDate_to_DMYHMiS($resultset[DmlSqlCampanhaCashbackResgatePix::CCRP_DT_UPDATE]);
        $retorno->statusdesc = VariavelCache::getInstance()->getStatusDesc($retorno->status);
        $retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
        $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);
     
        // Traduz flag da chave pix
        switch ($retorno->tipoChavePix) {
            case CampanhaCashbackResgatePixConstantes::TIPO_CHAVEPIX_CPF :
                $retorno->tipoChavePixDesc = CampanhaCashbackResgatePixConstantes::TIPO_CHAVEPIX_CPF_DESC;
                break;
            
            case CampanhaCashbackResgatePixConstantes::TIPO_CHAVEPIX_CNPJ :
                $retorno->tipoChavePixDesc = CampanhaCashbackResgatePixConstantes::TIPO_CHAVEPIX_CNPJ_DESC;
                break;
            
            case CampanhaCashbackResgatePixConstantes::TIPO_CHAVEPIX_CELULAR :
                $retorno->tipoChavePixDesc = CampanhaCashbackResgatePixConstantes::TIPO_CHAVEPIX_CELULAR_DESC;
                break;
                
            case CampanhaCashbackResgatePixConstantes::TIPO_CHAVEPIX_EMAIL :
                $retorno->tipoChavePixDesc = CampanhaCashbackResgatePixConstantes::TIPO_CHAVEPIX_EMAIL_DESC;
                break;
                        
            case CampanhaCashbackResgatePixConstantes::TIPO_CHAVEPIX_ALEATORIA :
                $retorno->tipoChavePixDesc = CampanhaCashbackResgatePixConstantes::TIPO_CHAVEPIX_ALEATORIA_DESC;
                break;
                
            default:
                $retorno->tipoChavePixDesc = CampanhaCashbackResgatePixConstantes::TIPO_CHAVEPIX_INVALIDA_DESC;
                break;
        }

        // Traduz estagio RT
        switch ($retorno->estagioRealTime) {
            case CampanhaCashbackResgatePixConstantes::ESTAGIO_RT_PENDENTE :
                $retorno->estagioRealTimeDesc = CampanhaCashbackResgatePixConstantes::ESTAGIO_RT_PENDENTE_DESC;
                break;
            
            case CampanhaCashbackResgatePixConstantes::ESTAGIO_RT_ANALISE :
                $retorno->estagioRealTimeDesc = CampanhaCashbackResgatePixConstantes::ESTAGIO_RT_ANALISE_DESC;
                break;
            
            case CampanhaCashbackResgatePixConstantes::ESTAGIO_RT_FINANCEIRO :
                $retorno->estagioRealTimeDesc = CampanhaCashbackResgatePixConstantes::ESTAGIO_RT_FINANCEIRO_DESC;
                break;
                
            case CampanhaCashbackResgatePixConstantes::ESTAGIO_RT_ERRO :
                $retorno->estagioRealTimeDesc = CampanhaCashbackResgatePixConstantes::ESTAGIO_RT_ERRO_DESC;
                break;
                        
            case CampanhaCashbackResgatePixConstantes::ESTAGIO_RT_TRANSFERIDO :
                $retorno->estagioRealTimeDesc = CampanhaCashbackResgatePixConstantes::ESTAGIO_RT_TRANSFERIDO_DESC;
                break;
                
            default:
                $retorno->estagioRealTimeDesc = CampanhaCashbackResgatePixConstantes::ESTAGIO_RT_INVALIDO_DESC;
                break;
        }



        return $retorno;

    }

    /**
    * updateIdUsuarioDevedor() - implementação da assinatura em CampanhaCashbackResgatePixDAO
    */
    public function updateIdUsuarioDevedor($id, $idUsuarioDevedor)
    {   
        $retorno = false;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $stmt = $conexao->prepare(DmlSqlCampanhaCashbackResgatePix::UPD_CAMPANHA_CASHBACK_RESGATE_PIX_USUA_ID_DEVEDOR_PK);
        $stmt->bind_param(DmlSql::INTEGER_TYPE 
                            . DmlSql::INTEGER_TYPE
                            ,$idUsuarioDevedor
                            ,$id);
        if ($stmt->execute())
        {
            $retorno = true;
        }

        return $retorno;
    }

    /**
    * updateIdusuariosolicitante() - implementação da assinatura em CampanhaCashbackResgatePixDAO
    */
    public function updateIdusuariosolicitante($id, $idUsuarioSolicitante)
    {   
        $retorno = false;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $stmt = $conexao->prepare(DmlSqlCampanhaCashbackResgatePix::UPD_CAMPANHA_CASHBACK_RESGATE_PIX_USUA_ID_PK);
        $stmt->bind_param(DmlSql::INTEGER_TYPE 
                            . DmlSql::INTEGER_TYPE
                            ,$idUsuarioSolicitante
                            ,$id);
        if ($stmt->execute())
        {
            $retorno = true;
        }

        return $retorno;
    }

    /**
    * updateTipochavepix() - implementação da assinatura em CampanhaCashbackResgatePixDAO
    */
    public function updateTipochavepix($id, $tipoChavePix)
    {   
        $retorno = false;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $stmt = $conexao->prepare(DmlSqlCampanhaCashbackResgatePix::UPD_CAMPANHA_CASHBACK_RESGATE_PIX_CCRP_IN_TIPO_CHAVE_PIX_PK);
        $stmt->bind_param(DmlSql::INTEGER_TYPE 
                            . DmlSql::INTEGER_TYPE
                            ,$tipoChavePix
                            ,$id);
        if ($stmt->execute())
        {
            $retorno = true;
        }

        return $retorno;
    }

    /**
    * updateChavepix() - implementação da assinatura em CampanhaCashbackResgatePixDAO
    */
    public function updateChavepix($id, $chavePix)
    {   
        $retorno = false;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $stmt = $conexao->prepare(DmlSqlCampanhaCashbackResgatePix::UPD_CAMPANHA_CASHBACK_RESGATE_PIX_CCRP_TX_CHAVE_PIX_PK);
        $stmt->bind_param(DmlSql::STRING_TYPE 
                            . DmlSql::STRING_TYPE
                            ,$chavePix
                            ,$id);
        if ($stmt->execute())
        {
            $retorno = true;
        }

        return $retorno;
    }

    /**
    * updateValorresgate() - implementação da assinatura em CampanhaCashbackResgatePixDAO
    */
    public function updateValorresgate($id, $valorResgate)
    {   
        $retorno = false;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $stmt = $conexao->prepare(DmlSqlCampanhaCashbackResgatePix::UPD_CAMPANHA_CASHBACK_RESGATE_PIX_CCRP_VL_RESGATE_PK);
        $stmt->bind_param(DmlSql::STRING_TYPE 
                            . DmlSql::STRING_TYPE
                            ,$valorResgate
                            ,$id);
        if ($stmt->execute())
        {
            $retorno = true;
        }

        return $retorno;
    }

    /**
    * updateAutenticacaobco() - implementação da assinatura em CampanhaCashbackResgatePixDAO
    */
    public function updateAutenticacaobco($id, $autenticacaoBco)
    {   
        $retorno = false;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $stmt = $conexao->prepare(DmlSqlCampanhaCashbackResgatePix::UPD_CAMPANHA_CASHBACK_RESGATE_PIX_CCRP_TX_AUTENT_BCO_PK);
        $stmt->bind_param(DmlSql::STRING_TYPE 
                            . DmlSql::STRING_TYPE
                            ,$autenticacaoBco
                            ,$id);
        if ($stmt->execute())
        {
            $retorno = true;
        }

        return $retorno;
    }

    /**
    * updateEstagiorealtime() - implementação da assinatura em CampanhaCashbackResgatePixDAO
    */
    public function updateEstagiorealtime($id, $estagioRealTime)
    {   
        $retorno = false;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $stmt = $conexao->prepare(DmlSqlCampanhaCashbackResgatePix::UPD_CAMPANHA_CASHBACK_RESGATE_PIX_CCRP_IN_ESTAGIO_RT_PK);
        $stmt->bind_param(DmlSql::INTEGER_TYPE 
                            . DmlSql::INTEGER_TYPE
                            ,$estagioRealTime
                            ,$id);
        if ($stmt->execute())
        {
            $retorno = true;
        }

        return $retorno;
    }

    /**
    * updateDtestagioanalise() - implementação da assinatura em CampanhaCashbackResgatePixDAO
    */
    public function updateDtestagioanalise($id, $dtEstagioAnalise)
    {   
        $retorno = false;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $stmt = $conexao->prepare(DmlSqlCampanhaCashbackResgatePix::UPD_CAMPANHA_CASHBACK_RESGATE_PIX_CCRP_DT_ESTAGIO_ANALISE_PK);
        $stmt->bind_param(DmlSql::STRING_TYPE 
                            . DmlSql::STRING_TYPE
                            ,$dtEstagioAnalise
                            ,$id);
        if ($stmt->execute())
        {
            $retorno = true;
        }

        return $retorno;
    }

    /**
    * updateDtestagiofinanceiro() - implementação da assinatura em CampanhaCashbackResgatePixDAO
    */
    public function updateDtestagiofinanceiro($id, $dtEstagioFinanceiro)
    {   
        $retorno = false;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $stmt = $conexao->prepare(DmlSqlCampanhaCashbackResgatePix::UPD_CAMPANHA_CASHBACK_RESGATE_PIX_CCRP_DT_ESTAGIO_FINANCEIRO_PK);
        $stmt->bind_param(DmlSql::STRING_TYPE 
                            . DmlSql::STRING_TYPE
                            ,$dtEstagioFinanceiro
                            ,$id);
        if ($stmt->execute())
        {
            $retorno = true;
        }

        return $retorno;
    }

    /**
    * updateDtestagioerro() - implementação da assinatura em CampanhaCashbackResgatePixDAO
    */
    public function updateDtestagioerro($id, $dtEstagioErro)
    {   
        $retorno = false;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $stmt = $conexao->prepare(DmlSqlCampanhaCashbackResgatePix::UPD_CAMPANHA_CASHBACK_RESGATE_PIX_CCRP_DT_ESTAGIO_ERRO_PK);
        $stmt->bind_param(DmlSql::STRING_TYPE 
                            . DmlSql::STRING_TYPE
                            ,$dtEstagioErro
                            ,$id);
        if ($stmt->execute())
        {
            $retorno = true;
        }

        return $retorno;
    }


    /**
    * updateTxtlivreestagiort() - implementação da assinatura em CampanhaCashbackResgatePixDAO
    */
    public function updateTxtlivreestagiort($id, $txtLivreEstagioRT)
    {   
        $retorno = false;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $stmt = $conexao->prepare(DmlSqlCampanhaCashbackResgatePix::UPD_CAMPANHA_CASHBACK_RESGATE_PIX_CCRP_TX_LIVRE_ESTAGIO_RT_PK);
        $stmt->bind_param(DmlSql::STRING_TYPE 
                            . DmlSql::STRING_TYPE
                            ,$txtLivreEstagioRT
                            ,$id);
        if ($stmt->execute())
        {
            $retorno = true;
        }

        return $retorno;
    }


    /**
    * updateDtestagiotranfbco() - implementação da assinatura em CampanhaCashbackResgatePixDAO
    */
    public function updateDtestagiotranfbco($id, $dtEstagioTranfBco)
    {   
        $retorno = false;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $stmt = $conexao->prepare(DmlSqlCampanhaCashbackResgatePix::UPD_CAMPANHA_CASHBACK_RESGATE_PIX_CCRP_DT_ESTAGIO_TRANSF_BCO_PK);
        $stmt->bind_param(DmlSql::STRING_TYPE 
                            . DmlSql::STRING_TYPE
                            ,$dtEstagioTranfBco
                            ,$id);
        if ($stmt->execute())
        {
            $retorno = true;
        }

        return $retorno;
    }


    /**
    * loadIdUsuarioDevedor() - implementação da assinatura em CampanhaCashbackResgatePixDAO
    */

    public function loadIdUsuarioDevedor($idUsuarioDevedor)
    {   
        $retorno = NULL;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $res = $conexao->query(DmlSqlCampanhaCashbackResgatePix::SELECT . ' WHERE ' . DmlSqlCampanhaCashbackResgatePix::USUA_ID_DEVEDOR . '=' . $idUsuarioDevedor );
        if ($res){
            $retorno = $this->getDTO($res->fetch_assoc());
        }
        return $retorno;
    }

    /**
    * loadIdusuariosolicitante() - implementação da assinatura em CampanhaCashbackResgatePixDAO
    */

    public function loadIdusuariosolicitante($idUsuarioSolicitante)
    {   
        $retorno = NULL;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $res = $conexao->query(DmlSqlCampanhaCashbackResgatePix::SELECT . ' WHERE ' . DmlSqlCampanhaCashbackResgatePix::USUA_ID . '=' . $idUsuarioSolicitante );
        if ($res){
            $retorno = $this->getDTO($res->fetch_assoc());
        }
        return $retorno;
    }

    /**
    * loadTipochavepix() - implementação da assinatura em CampanhaCashbackResgatePixDAO
    */

    public function loadTipochavepix($tipoChavePix)
    {   
        $retorno = NULL;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $res = $conexao->query(DmlSqlCampanhaCashbackResgatePix::SELECT . ' WHERE ' . DmlSqlCampanhaCashbackResgatePix::CCRP_IN_TIPO_CHAVE_PIX . '=' . $tipoChavePix );
        if ($res){
            $retorno = $this->getDTO($res->fetch_assoc());
        }
        return $retorno;
    }

    /**
    * loadChavepix() - implementação da assinatura em CampanhaCashbackResgatePixDAO
    */

    public function loadChavepix($chavePix)
    {   
        $retorno = NULL;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $res = $conexao->query(DmlSqlCampanhaCashbackResgatePix::SELECT . ' WHERE ' . DmlSqlCampanhaCashbackResgatePix::CCRP_TX_CHAVE_PIX . '=' . $chavePix );
        if ($res){
            $retorno = $this->getDTO($res->fetch_assoc());
        }
        return $retorno;
    }

    /**
    * loadValorresgate() - implementação da assinatura em CampanhaCashbackResgatePixDAO
    */

    public function loadValorresgate($valorResgate)
    {   
        $retorno = NULL;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $res = $conexao->query(DmlSqlCampanhaCashbackResgatePix::SELECT . ' WHERE ' . DmlSqlCampanhaCashbackResgatePix::CCRP_VL_RESGATE . '=' . $valorResgate );
        if ($res){
            $retorno = $this->getDTO($res->fetch_assoc());
        }
        return $retorno;
    }

    /**
    * loadAutenticacaobco() - implementação da assinatura em CampanhaCashbackResgatePixDAO
    */

    public function loadAutenticacaobco($autenticacaoBco)
    {   
        $retorno = NULL;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $res = $conexao->query(DmlSqlCampanhaCashbackResgatePix::SELECT . ' WHERE ' . DmlSqlCampanhaCashbackResgatePix::CCRP_TX_AUTENT_BCO . '=' . $autenticacaoBco );
        if ($res){
            $retorno = $this->getDTO($res->fetch_assoc());
        }
        return $retorno;
    }

    /**
    * loadEstagiorealtime() - implementação da assinatura em CampanhaCashbackResgatePixDAO
    */

    public function loadEstagiorealtime($estagioRealTime)
    {   
        $retorno = NULL;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $res = $conexao->query(DmlSqlCampanhaCashbackResgatePix::SELECT . ' WHERE ' . DmlSqlCampanhaCashbackResgatePix::CCRP_IN_ESTAGIO_RT . '=' . $estagioRealTime );
        if ($res){
            $retorno = $this->getDTO($res->fetch_assoc());
        }
        return $retorno;
    }

    /**
    * loadDtestagioanalise() - implementação da assinatura em CampanhaCashbackResgatePixDAO
    */

    public function loadDtestagioanalise($dtEstagioAnalise)
    {   
        $retorno = NULL;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $res = $conexao->query(DmlSqlCampanhaCashbackResgatePix::SELECT . ' WHERE ' . DmlSqlCampanhaCashbackResgatePix::CCRP_DT_ESTAGIO_ANALISE . '=' . $dtEstagioAnalise );
        if ($res){
            $retorno = $this->getDTO($res->fetch_assoc());
        }
        return $retorno;
    }

    /**
    * loadDtestagiofinanceiro() - implementação da assinatura em CampanhaCashbackResgatePixDAO
    */

    public function loadDtestagiofinanceiro($dtEstagioFinanceiro)
    {   
        $retorno = NULL;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $res = $conexao->query(DmlSqlCampanhaCashbackResgatePix::SELECT . ' WHERE ' . DmlSqlCampanhaCashbackResgatePix::CCRP_DT_ESTAGIO_FINANCEIRO . '=' . $dtEstagioFinanceiro );
        if ($res){
            $retorno = $this->getDTO($res->fetch_assoc());
        }
        return $retorno;
    }

    /**
    * loadDtestagioerro() - implementação da assinatura em CampanhaCashbackResgatePixDAO
    */

    public function loadDtestagioerro($dtEstagioErro)
    {   
        $retorno = NULL;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $res = $conexao->query(DmlSqlCampanhaCashbackResgatePix::SELECT . ' WHERE ' . DmlSqlCampanhaCashbackResgatePix::CCRP_DT_ESTAGIO_ERRO . '=' . $dtEstagioErro );
        if ($res){
            $retorno = $this->getDTO($res->fetch_assoc());
        }
        return $retorno;
    }

    /**
    * loadDtestagiotranfbco() - implementação da assinatura em CampanhaCashbackResgatePixDAO
    */

    public function loadDtestagiotranfbco($dtEstagioTranfBco)
    {   
        $retorno = NULL;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $res = $conexao->query(DmlSqlCampanhaCashbackResgatePix::SELECT . ' WHERE ' . DmlSqlCampanhaCashbackResgatePix::CCRP_DT_ESTAGIO_TRANSF_BCO . '=' . $dtEstagioTranfBco );
        if ($res){
            $retorno = $this->getDTO($res->fetch_assoc());
        }
        return $retorno;
    }

    /**
    * loadTxtlivreestagiort() - implementação da assinatura em CampanhaCashbackResgatePixDAO
    */

    public function loadTxtlivreestagiort($txtLivreEstagioRT)
    {   
        $retorno = NULL;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $res = $conexao->query(DmlSqlCampanhaCashbackResgatePix::SELECT . ' WHERE ' . DmlSqlCampanhaCashbackResgatePix::CCRP_TX_LIVRE_ESTAGIO_RT . '=' . $txtLivreEstagioRT );
        if ($res){
            $retorno = $this->getDTO($res->fetch_assoc());
        }
        return $retorno;
    }


    /**
    * loadStatus() - implementação da assinatura em CampanhaCashbackResgatePixDAO
    */

    public function loadStatus($status)
    {   
        $retorno = NULL;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $res = $conexao->query(DmlSqlCampanhaCashbackResgatePix::SELECT . ' WHERE ' . DmlSqlCampanhaCashbackResgatePix::CCRP_IN_STATUS . '=' . $status );
        if ($res){
            $retorno = $this->getDTO($res->fetch_assoc());
        }
        return $retorno;
    }

    /**
    * loadDatacadastro() - implementação da assinatura em CampanhaCashbackResgatePixDAO
    */

    public function loadDatacadastro($dataCadastro)
    {   
        $retorno = NULL;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $res = $conexao->query(DmlSqlCampanhaCashbackResgatePix::SELECT . ' WHERE ' . DmlSqlCampanhaCashbackResgatePix::CCRP_DT_CADASTRO . '=' . $dataCadastro );
        if ($res){
            $retorno = $this->getDTO($res->fetch_assoc());
        }
        return $retorno;
    }

    /**
    * loadDataatualizacao() - implementação da assinatura em CampanhaCashbackResgatePixDAO
    */

    public function loadDataatualizacao($dataAtualizacao)
    {   
        $retorno = NULL;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $res = $conexao->query(DmlSqlCampanhaCashbackResgatePix::SELECT . ' WHERE ' . DmlSqlCampanhaCashbackResgatePix::CCRP_DT_UPDATE . '=' . $dataAtualizacao );
        if ($res){
            $retorno = $this->getDTO($res->fetch_assoc());
        }
        return $retorno;
    }

}
?>

