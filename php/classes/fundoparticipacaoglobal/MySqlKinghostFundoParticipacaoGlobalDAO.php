<?php

/**
* MySqlKinghostFundoParticipacaoGlobalDAO - Implementação DAO
*
* Classe de com todos os comandos DML e DDL (se necessário) para apoio 
* a classe MySqlKinghostFundoParticipacaoGlobalDAO
* Não é uma camada visível para outros dispositivos, como as camadas de apresentação e aplicação. 
*
*
* Tabela principal de atuação: FUNDO_PARTICIPACAO_GLOBAL
*
* Changelog:
*
* 
* @author Julio Cesar Vitorino
* @since 23/08/2019 10:06:20
*
*/
require_once 'FundoParticipacaoGlobalDTO.php';
require_once 'FundoParticipacaoGlobalDAO.php';
require_once 'DmlSqlFundoParticipacaoGlobal.php';

require_once '../mensagem/ConstantesMensagem.php';
require_once '../mensagem/MensagemCache.php';
require_once '../variavel/VariavelCache.php';
require_once '../daofactory/DmlSql.php';

class MySqlKinghostFundoParticipacaoGlobalDAO implements FundoParticipacaoGlobalDAO
{
    private $daofactory;

    function __construct($daofactory)
    {
        $this->daofactory = $daofactory;
    }


/**
* loadMaxIdusuarioparticipantePK() - Carrega um MaxID (pk) para um ${CAMPO} e status
*
* @param $idUsuarioParticipante
* @param $status
* @return $dto
*/ 

    public function loadMaxIdusuarioparticipantePK($idUsuarioParticipante,$status)
    {   
        $retorno = 0;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $sql = DmlSqlFundoParticipacaoGlobal::SELECT_MAX_PK . ' WHERE ' 
        . DmlSqlFundoParticipacaoGlobal::USUA_ID . " = $idUsuarioParticipante "
        . " AND " . DmlSqlFundoParticipacaoGlobal::FPGL_IN_STATUS . " = '$status'";

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
* listAll() - Lista todos os registros provenientes de FUNDO_PARTICIPACAO_GLOBAL sem critério de paginação
*
* @return List<FundoParticipacaoGlobalDTO>[]
*/ 
    public function listAll()   {   }

/**
* update() - atualiza apenas um registro com base no dto FundoParticipacaoGlobalDTO->id
* @param $daofactory
*
* @return boolean
*/ 
    public function update($dto)
    {   
        $retorno = false;

        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $stmt = $conexao->prepare(DmlSqlFundoParticipacaoGlobal::UPD_PK);
        $stmt->bind_param(DmlSql::INTEGER_TYPE 
                            . DmlSql::INTEGER_TYPE 
                            . DmlSql::INTEGER_TYPE 
                            . DmlSql::STRING_TYPE 
                            . DmlSql::STRING_TYPE 
                            . DmlSql::STRING_TYPE 
                            . DmlSql::INTEGER_TYPE 
                            ,$dto->idUsuarioParticipante
                            ,$dto->idUsuarioBonificado
                            ,$dto->idPlanoFatura
                            ,$dto->tipoMovimento
                            ,$dto->valorTransacao
                            ,$dto->descricao
                            ,$dto->id );
        if ($stmt->execute())
        {
            $retorno = true;
        }

        return $retorno;
    }

/**
* delete() - excluir fisicamente um registro com base no dto FundoParticipacaoGlobalDTO->id
*
* @return boolean
*/ 
    public function delete($dto)
    {   
        $retorno = false;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $stmt = $conexao->prepare(DmlSqlFundoParticipacaoGlobal::DEL_PK);
        $stmt->bind_param(DmlSql::INTEGER_TYPE
                            ,$dto->id);
        if ($stmt->execute())
        {
            $retorno = true;
        }

        return $retorno;
    }


    public function listFundoParticipacaoGlobalStatus($status)
    {
        $retorno = array();

        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $res = $conexao->query(DmlSqlFundoParticipacaoGlobal::SELECT . 'WHERE `' . DmlSqlFundoParticipacaoGlobal::FPGL_IN_STATUS . "` = '$status'" );
        if ($res){
            while ($row = $res->fetch_assoc()) {
                array_push($retorno, $this->getDTO($row));
            }
        }
        return $retorno;
    }

/**
* countFundoParticipacaoGlobalPorStatus() - contar a quantidade de registros
* sob o contexto da classe FundoParticipacaoGlobal com base no status específico. 
*
* Atenção em @see $sql na tabela FUNDO_PARTICIPACAO_GLOBAL 
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

    public function countFundoParticipacaoGlobalPorStatus($status)
    {   
        $retorno = 0;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $res = $conexao->query(DmlSqlFundoParticipacaoGlobal::SQL_COUNT . ' WHERE ' 
        . DmlSqlFundoParticipacaoGlobal::FPGL_IN_STATUS . " = '$status'"
        );
        if ($res){
            $tmp = $res->fetch_assoc();
            $retorno = $tmp['contador'];
        }
        return $retorno;

    }

/**
* listFundoParticipacaoGlobalPorStatus() - Listar um conjunto de registro previamente paginado
* sob o contexto da classe FundoParticipacaoGlobal com base no status específico.
*
* Atenção em @see $sql na tabela FUNDO_PARTICIPACAO_GLOBAL 
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

    public function listFundoParticipacaoGlobalPorStatus($status, $pag, $qtde, $coluna, $ordem)
    {
        $sql = DmlSqlFundoParticipacaoGlobal::SELECT 
        . ' WHERE ' . DmlSqlFundoParticipacaoGlobal::FPGL_IN_STATUS . " = '$status'"
        . ' ORDER BY ' . $coluna . ($ordem == 0 ? " ASC": " DESC");
        return $this->listPagina($sql, $pag, $qtde);
    }

/**
* countFundoParticipacaoGlobalPorUsuaIdStatus() - contar a quantidade de registros
* sob o contexto da classe FundoParticipacaoGlobal com base no usuário específico. Esse usuário
* é o usuário logado na sessão ou no próprio dispositivo móvel e de acordo com a 
* query em @see $sql na tabela FUNDO_PARTICIPACAO_GLOBAL 
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

    public function countFundoParticipacaoGlobalPorUsuaIdStatus($usuaid, $status)
    {   
        $retorno = 0;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $res = $conexao->query(DmlSqlFundoParticipacaoGlobal::SQL_COUNT . ' WHERE ' 
        . DmlSqlFundoParticipacaoGlobal::USUA_ID . " = $usuaid "
        . ' AND ' . DmlSqlFundoParticipacaoGlobal::FPGL_IN_STATUS . " = '$status'"
        );
        if ($res){
            $tmp = $res->fetch_assoc();
            $retorno = $tmp['contador'];
        }
        return $retorno;

    }

/**
* listFundoParticipacaoGlobalPorUsuaIdStatus() - Listar um conjunto de registro previamente paginado
* sob o contexto da classe FundoParticipacaoGlobal com base no usuário específico. Esse usuário
* é o usuário logado na sessão ou no próprio dispositivo móvel e de acordo com a 
* query em @see $sql na tabela FUNDO_PARTICIPACAO_GLOBAL 
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
    public function listFundoParticipacaoGlobalPorUsuaIdStatus($usuaid, $status, $pag, $qtde, $coluna, $ordem)
    {
        $sql = DmlSqlFundoParticipacaoGlobal::SELECT 
        . ' WHERE ' . DmlSqlFundoParticipacaoGlobal::USUA_ID . " = $usuaid "
        . ' AND ' . DmlSqlFundoParticipacaoGlobal::FPGL_IN_STATUS . " = '$status'"
        . ' ORDER BY ' . $coluna . ($ordem == 0 ? " ASC": " DESC");
        return $this->listPagina($sql, $pag, $qtde);
    }

/**
* listPagina() - Listar um conjunto de registro previamente paginado
* e de acordo com a query em @see $sql na tabela FUNDO_PARTICIPACAO_GLOBAL 
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
* na tabela FUNDO_PARTICIPACAO_GLOBAL usando a Primary Key FPGL_ID
*
* @param $id
* @return FundoParticipacaoGlobalDTO
*/ 
    public function loadPK($id)
    {   
        $retorno = NULL;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $res = $conexao->query(DmlSqlFundoParticipacaoGlobal::SELECT . ' WHERE ' . DmlSqlFundoParticipacaoGlobal::FPGL_ID . '=' . $id );
        if ($res->num_rows > 0){
            $retorno = $this->getDTO($res->fetch_assoc());
        }
        return $retorno;
    }

/**
* updateStatus() - atualizar o campo de STATUS utilizando a id como item de busca
* na tabela FUNDO_PARTICIPACAO_GLOBAL usando a Primary Key FPGL_ID
*
* @param $id
* @param $status
*
* @return FundoParticipacaoGlobalDTO
*/ 
    public function updateStatus($id, $status)
    {   
        $retorno = false;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $stmt = $conexao->prepare(DmlSqlFundoParticipacaoGlobal::UPD_STATUS);
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
* insert() - inserir um registro com base no FundoParticipacaoGlobalDTO. Alguns atributos dentro do DTO
* serão ignorados caso estejam populados, pois os mesmos possuem constraint de DEFAULT value
* ou campos de AUTO INCREMENTO já previamente definidos no DDL de criação de tabelas do BD.
*
* Atributos da classe FundoParticipacaoGlobalDTO sumariamente IGNORADOS por este método MESMO que estejam preenchidos:
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
        $stmt = $conexao->prepare(DmlSqlFundoParticipacaoGlobal::INS);
        $stmt->bind_param(DmlSql::INTEGER_TYPE 
                            . DmlSql::INTEGER_TYPE 
                            . DmlSql::STRING_TYPE 
                            . DmlSql::DOUBLE_TYPE 
                            . DmlSql::STRING_TYPE 
                            ,$dto->idUsuarioParticipante
                            ,$dto->idPlanoFatura
                            ,$dto->tipoMovimento
                            ,$dto->valorTransacao
                            ,$dto->descricao
        );
        if ($stmt->execute())
        {
            $retorno = true;
        }

        return $retorno;
    }


/**
* insertBonificacao() - inserir um registro com base no FundoParticipacaoGlobalDTO. Alguns atributos dentro do DTO
* serão ignorados caso estejam populados, pois os mesmos possuem constraint de DEFAULT value
* ou campos de AUTO INCREMENTO já previamente definidos no DDL de criação de tabelas do BD.
*
* Atributos da classe FundoParticipacaoGlobalDTO sumariamente IGNORADOS por este método MESMO que estejam preenchidos:
* id
* status
* dataCadastro
* dataAtualizacao
*
* @return boolean
*/ 
    public function insertBonificacao($dto) 
    {   
        $retorno = false;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $stmt = $conexao->prepare(DmlSqlFundoParticipacaoGlobal::INS_BONIFICADO);
        $stmt->bind_param(DmlSql::INTEGER_TYPE 
                            . DmlSql::INTEGER_TYPE 
                            . DmlSql::STRING_TYPE 
                            . DmlSql::DOUBLE_TYPE 
                            . DmlSql::STRING_TYPE 
                            ,$dto->idUsuarioParticipante
                            ,$dto->idUsuariobonificado
                            ,$dto->tipoMovimento
                            ,$dto->valorTransacao
                            ,$dto->descricao
        );
        if ($stmt->execute())
        {
            $retorno = true;
        }

        return $retorno;
    }

    /**
     * getDTO() - Transforma o resultset padrão em FundoParticipacaoGlobalDTO
    */
    public function getDTO($resultset)
    {
        if(is_null($resultset)){
            return NULL;
        }

        //echo var_dump($resultset); // ótimo pra debugar
        $retorno = new FundoParticipacaoGlobalDTO();
        $retorno->id = $resultset[DmlSqlFundoParticipacaoGlobal::FPGL_ID] == NULL ? NULL : $resultset[DmlSqlFundoParticipacaoGlobal::FPGL_ID];
        $retorno->idUsuarioParticipante = $resultset[DmlSqlFundoParticipacaoGlobal::USUA_ID] == NULL ? NULL : $resultset[DmlSqlFundoParticipacaoGlobal::USUA_ID];
        $retorno->idUsuarioBonificado = $resultset[DmlSqlFundoParticipacaoGlobal::USUA_ID_BONIFICADO] == NULL ? NULL : $resultset[DmlSqlFundoParticipacaoGlobal::USUA_ID_BONIFICADO];
        $retorno->idPlanoFatura = $resultset[DmlSqlFundoParticipacaoGlobal::PLUF_ID] == NULL ? NULL : $resultset[DmlSqlFundoParticipacaoGlobal::PLUF_ID];
        $retorno->tipoMovimento = $resultset[DmlSqlFundoParticipacaoGlobal::FPGL_IN_TIPO] == NULL ? NULL : $resultset[DmlSqlFundoParticipacaoGlobal::FPGL_IN_TIPO];
        $retorno->valorTransacao = $resultset[DmlSqlFundoParticipacaoGlobal::FPGL_VL_TRANSACAO] == NULL ? NULL : $resultset[DmlSqlFundoParticipacaoGlobal::FPGL_VL_TRANSACAO];
        $retorno->descricao = $resultset[DmlSqlFundoParticipacaoGlobal::FPGL_TX_DESCRICAO] == NULL ? NULL : $resultset[DmlSqlFundoParticipacaoGlobal::FPGL_TX_DESCRICAO];
        $retorno->status = $resultset[DmlSqlFundoParticipacaoGlobal::FPGL_IN_STATUS] == NULL ? NULL : $resultset[DmlSqlFundoParticipacaoGlobal::FPGL_IN_STATUS];
        $retorno->dataCadastro = Util::MySQLDate_to_DMYHMiS($resultset[DmlSqlFundoParticipacaoGlobal::FPGL_DT_CADASTRO]);
        $retorno->dataAtualizacao = Util::MySQLDate_to_DMYHMiS($resultset[DmlSqlFundoParticipacaoGlobal::FPGL_DT_UPDATE]);
        $retorno->statusdesc = VariavelCache::getInstance()->getStatusDesc($retorno->status);
        $retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
        $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);
        return $retorno;

    }

    /**
    * updateIdusuarioparticipante() - implementação da assinatura em FundoParticipacaoGlobalDAO
    */
    public function updateIdusuarioparticipante($id, $idUsuarioParticipante)
    {   
        $retorno = false;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $stmt = $conexao->prepare(DmlSqlFundoParticipacaoGlobal::UPD_FUNDO_PARTICIPACAO_GLOBAL_USUA_ID_PK);
        $stmt->bind_param(DmlSql::INTEGER_TYPE 
                            . DmlSql::INTEGER_TYPE
                            ,$idUsuarioParticipante
                            ,$id);
        if ($stmt->execute())
        {
            $retorno = true;
        }

        return $retorno;
    }

    /**
    * updateIdusuariobonificado() - implementação da assinatura em FundoParticipacaoGlobalDAO
    */
    public function updateIdusuariobonificado($id, $idUsuarioBonificado)
    {   
        $retorno = false;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $stmt = $conexao->prepare(DmlSqlFundoParticipacaoGlobal::UPD_FUNDO_PARTICIPACAO_GLOBAL_USUA_ID_BONIFICADO_PK);
        $stmt->bind_param(DmlSql::INTEGER_TYPE 
                            . DmlSql::INTEGER_TYPE
                            ,$idUsuarioBonificado
                            ,$id);
        if ($stmt->execute())
        {
            $retorno = true;
        }

        return $retorno;
    }

    /**
    * updateIdplanofatura() - implementação da assinatura em FundoParticipacaoGlobalDAO
    */
    public function updateIdplanofatura($id, $idPlanoFatura)
    {   
        $retorno = false;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $stmt = $conexao->prepare(DmlSqlFundoParticipacaoGlobal::UPD_FUNDO_PARTICIPACAO_GLOBAL_PLUF_ID_PK);
        $stmt->bind_param(DmlSql::INTEGER_TYPE 
                            . DmlSql::INTEGER_TYPE
                            ,$idPlanoFatura
                            ,$id);
        if ($stmt->execute())
        {
            $retorno = true;
        }

        return $retorno;
    }

    /**
    * updateTipomovimento() - implementação da assinatura em FundoParticipacaoGlobalDAO
    */
    public function updateTipomovimento($id, $tipoMovimento)
    {   
        $retorno = false;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $stmt = $conexao->prepare(DmlSqlFundoParticipacaoGlobal::UPD_FUNDO_PARTICIPACAO_GLOBAL_FPGL_IN_TIPO_PK);
        $stmt->bind_param(DmlSql::STRING_TYPE 
                            . DmlSql::STRING_TYPE
                            ,$tipoMovimento
                            ,$id);
        if ($stmt->execute())
        {
            $retorno = true;
        }

        return $retorno;
    }

    /**
    * updateValortransacao() - implementação da assinatura em FundoParticipacaoGlobalDAO
    */
    public function updateValortransacao($id, $valorTransacao)
    {   
        $retorno = false;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $stmt = $conexao->prepare(DmlSqlFundoParticipacaoGlobal::UPD_FUNDO_PARTICIPACAO_GLOBAL_FPGL_VL_TRANSACAO_PK);
        $stmt->bind_param(DmlSql::STRING_TYPE 
                            . DmlSql::STRING_TYPE
                            ,$valorTransacao
                            ,$id);
        if ($stmt->execute())
        {
            $retorno = true;
        }

        return $retorno;
    }

    /**
    * updateDescricao() - implementação da assinatura em FundoParticipacaoGlobalDAO
    */
    public function updateDescricao($id, $descricao)
    {   
        $retorno = false;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $stmt = $conexao->prepare(DmlSqlFundoParticipacaoGlobal::UPD_FUNDO_PARTICIPACAO_GLOBAL_FPGL_TX_DESCRICAO_PK);
        $stmt->bind_param(DmlSql::STRING_TYPE 
                            . DmlSql::STRING_TYPE
                            ,$descricao
                            ,$id);
        if ($stmt->execute())
        {
            $retorno = true;
        }

        return $retorno;
    }

    /**
    * loadIdusuarioparticipante() - implementação da assinatura em FundoParticipacaoGlobalDAO
    */

    public function loadIdusuarioparticipante($idUsuarioParticipante)
    {   
        $retorno = NULL;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $res = $conexao->query(DmlSqlFundoParticipacaoGlobal::SELECT . ' WHERE ' . DmlSqlFundoParticipacaoGlobal::USUA_ID . '=' . $idUsuarioParticipante );
        if ($res){
            $retorno = $this->getDTO($res->fetch_assoc());
        }
        return $retorno;
    }

    /**
    * loadIdusuariobonificado() - implementação da assinatura em FundoParticipacaoGlobalDAO
    */

    public function loadIdusuariobonificado($idUsuarioBonificado)
    {   
        $retorno = NULL;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $res = $conexao->query(DmlSqlFundoParticipacaoGlobal::SELECT . ' WHERE ' . DmlSqlFundoParticipacaoGlobal::USUA_ID_BONIFICADO . '=' . $idUsuarioBonificado );
        if ($res){
            $retorno = $this->getDTO($res->fetch_assoc());
        }
        return $retorno;
    }

    /**
    * loadIdplanofatura() - implementação da assinatura em FundoParticipacaoGlobalDAO
    */

    public function loadIdplanofatura($idPlanoFatura)
    {   
        $retorno = NULL;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $res = $conexao->query(DmlSqlFundoParticipacaoGlobal::SELECT . ' WHERE ' . DmlSqlFundoParticipacaoGlobal::PLUF_ID . '=' . $idPlanoFatura );
        if ($res){
            $retorno = $this->getDTO($res->fetch_assoc());
        }
        return $retorno;
    }

    /**
    * loadTipomovimento() - implementação da assinatura em FundoParticipacaoGlobalDAO
    */

    public function loadTipomovimento($tipoMovimento)
    {   
        $retorno = NULL;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $res = $conexao->query(DmlSqlFundoParticipacaoGlobal::SELECT . ' WHERE ' . DmlSqlFundoParticipacaoGlobal::FPGL_IN_TIPO . '=' . $tipoMovimento );
        if ($res){
            $retorno = $this->getDTO($res->fetch_assoc());
        }
        return $retorno;
    }

    /**
    * loadValortransacao() - implementação da assinatura em FundoParticipacaoGlobalDAO
    */

    public function loadValortransacao($valorTransacao)
    {   
        $retorno = NULL;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $res = $conexao->query(DmlSqlFundoParticipacaoGlobal::SELECT . ' WHERE ' . DmlSqlFundoParticipacaoGlobal::FPGL_VL_TRANSACAO . '=' . $valorTransacao );
        if ($res){
            $retorno = $this->getDTO($res->fetch_assoc());
        }
        return $retorno;
    }

    /**
    * loadDescricao() - implementação da assinatura em FundoParticipacaoGlobalDAO
    */

    public function loadDescricao($descricao)
    {   
        $retorno = NULL;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $res = $conexao->query(DmlSqlFundoParticipacaoGlobal::SELECT . ' WHERE ' . DmlSqlFundoParticipacaoGlobal::FPGL_TX_DESCRICAO . '=' . $descricao );
        if ($res){
            $retorno = $this->getDTO($res->fetch_assoc());
        }
        return $retorno;
    }

    /**
    * loadStatus() - implementação da assinatura em FundoParticipacaoGlobalDAO
    */

    public function loadStatus($status)
    {   
        $retorno = NULL;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $res = $conexao->query(DmlSqlFundoParticipacaoGlobal::SELECT . ' WHERE ' . DmlSqlFundoParticipacaoGlobal::FPGL_IN_STATUS . '=' . $status );
        if ($res){
            $retorno = $this->getDTO($res->fetch_assoc());
        }
        return $retorno;
    }

    /**
    * loadDatacadastro() - implementação da assinatura em FundoParticipacaoGlobalDAO
    */

    public function loadDatacadastro($dataCadastro)
    {   
        $retorno = NULL;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $res = $conexao->query(DmlSqlFundoParticipacaoGlobal::SELECT . ' WHERE ' . DmlSqlFundoParticipacaoGlobal::FPGL_DT_CADASTRO . '=' . $dataCadastro );
        if ($res){
            $retorno = $this->getDTO($res->fetch_assoc());
        }
        return $retorno;
    }

    /**
    * loadDataatualizacao() - implementação da assinatura em FundoParticipacaoGlobalDAO
    */

    public function loadDataatualizacao($dataAtualizacao)
    {   
        $retorno = NULL;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $res = $conexao->query(DmlSqlFundoParticipacaoGlobal::SELECT . ' WHERE ' . DmlSqlFundoParticipacaoGlobal::FPGL_DT_UPDATE . '=' . $dataAtualizacao );
        if ($res){
            $retorno = $this->getDTO($res->fetch_assoc());
        }
        return $retorno;
    }

}
?>

