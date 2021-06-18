<?php

/**
* MySqlKinghostCampanhaSorteioDAO - Implementação DAO
*
* Classe de com todos os comandos DML e DDL (se necessário) para apoio 
* a classe MySqlKinghostCampanhaSorteioDAO
* Não é uma camada visível para outros dispositivos, como as camadas de apresentação e aplicação. 
*
*
* Tabela principal de atuação: CAMPANHA_SORTEIO
*
* Changelog:
*
* 
* @author Julio Cesar Vitorino
* @since 23/08/2019 10:06:20
*
*/
require_once 'CampanhaSorteioDTO.php';
require_once 'CampanhaSorteioDAO.php';
require_once 'DmlSqlCampanhaSorteio.php';

require_once '../variavel/VariavelCache.php';
require_once '../daofactory/DmlSql.php';
require_once '../mensagem/ConstantesMensagem.php';
require_once '../mensagem/MensagemCache.php';

class MySqlKinghostCampanhaSorteioDAO implements CampanhaSorteioDAO
{
    private $daofactory;

    function __construct($daofactory)
    {
        $this->daofactory = $daofactory;
    }


/**
* loadMaxId_CampanhaPK() - Carrega um MaxID (pk) para um ${CAMPO} e status
*
* @param $id_campanha
* @param $status
* @return $dto
*/ 

    public function loadMaxId_CampanhaPK($id_campanha,$status)
    {   
        $retorno = 0;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $sql = DmlSqlCampanhaSorteio::SELECT_MAX_PK . ' WHERE ' 
        . DmlSqlCampanhaSorteio::CAMP_ID . " = $id_campanha "
        . " AND " . DmlSqlCampanhaSorteio::CASO_IN_STATUS . " = '$status'";

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
* listAll() - Lista todos os registros provenientes de CAMPANHA_SORTEIO sem critério de paginação
*
* @return List<CampanhaSorteioDTO>[]
*/ 
    public function listAll()   {   }

/**
* update() - atualiza apenas um registro com base no dto CampanhaSorteioDTO->id
* @param $daofactory
*
* @return boolean
*/ 
    public function update($dto)
    {   
        $retorno = false;

        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $stmt = $conexao->prepare(DmlSqlCampanhaSorteio::UPD_PK);
        $stmt->bind_param(DmlSql::INTEGER_TYPE 
                            . DmlSql::STRING_TYPE 
                            . DmlSql::STRING_TYPE 
                            . DmlSql::STRING_TYPE 
                            . DmlSql::STRING_TYPE 
                            . DmlSql::STRING_TYPE 
                            . DmlSql::STRING_TYPE 
                            . DmlSql::INTEGER_TYPE 
                            ,$dto->id_campanha
                            ,$dto->nome
                            ,$dto->urlRegulamento
                            ,$dto->premio
                            ,$dto->dataComecoSorteio
                            ,$dto->dataFimSorteio
                            ,$dto->maxTickets
                            ,$dto->id );
        if ($stmt->execute())
        {
            $retorno = true;
        }

        return $retorno;
    }

/**
* delete() - excluir fisicamente um registro com base no dto CampanhaSorteioDTO->id
*
* @return boolean
*/ 
    public function delete($dto)
    {   
        $retorno = false;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $stmt = $conexao->prepare(DmlSqlCampanhaSorteio::DEL_PK);
        $stmt->bind_param(DmlSql::INTEGER_TYPE
                            ,$dto->id);
        if ($stmt->execute())
        {
            $retorno = true;
        }

        return $retorno;
    }


    public function listCampanhaSorteioStatus($status)
    {
        $retorno = array();

        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $res = $conexao->query(DmlSqlCampanhaSorteio::SELECT . 'WHERE `' . DmlSqlCampanhaSorteio::CASO_IN_STATUS . "` = '$status'" );
        if ($res){
            while ($row = $res->fetch_assoc()) {
                array_push($retorno, $this->getDTO($row));
            }
        }
        return $retorno;
    }

/**
* countCampanhaSorteioPorStatus() - contar a quantidade de registros
* sob o contexto da classe CampanhaSorteio com base no status específico. 
*
* Atenção em @see $sql na tabela CAMPANHA_SORTEIO 
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

    public function countCampanhaSorteioPorStatus($status)
    {   
        $retorno = 0;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $res = $conexao->query(DmlSqlCampanhaSorteio::SQL_COUNT . ' WHERE ' 
        . DmlSqlCampanhaSorteio::CASO_IN_STATUS . " = '$status'"
        );
        if ($res){
            $tmp = $res->fetch_assoc();
            $retorno = $tmp['contador'];
        }
        return $retorno;

    }

/**
* listCampanhaSorteioPorStatus() - Listar um conjunto de registro previamente paginado
* sob o contexto da classe CampanhaSorteio com base no status específico.
*
* Atenção em @see $sql na tabela CAMPANHA_SORTEIO 
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

    public function listCampanhaSorteioPorStatus($status, $pag, $qtde, $coluna, $ordem)
    {
        $sql = DmlSqlCampanhaSorteio::SELECT 
        . ' WHERE ' . DmlSqlCampanhaSorteio::CASO_IN_STATUS . " = '$status'"
        . ' ORDER BY ' . $coluna . ($ordem == 0 ? " ASC": " DESC");
        return $this->listPagina($sql, $pag, $qtde);
    }

/**
* countCampanhaSorteioPorUsuaIdStatus() - contar a quantidade de registros
* sob o contexto da classe CampanhaSorteio com base no usuário específico. Esse usuário
* é o usuário logado na sessão ou no próprio dispositivo móvel e de acordo com a 
* query em @see $sql na tabela CAMPANHA_SORTEIO 
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

    public function countCampanhaSorteioPorUsuaIdStatus($usuaid, $status)
    {   
        $retorno = 0;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $res = $conexao->query(DmlSqlCampanhaSorteio::SQL_COUNT . ' WHERE ' 
        . DmlSqlCampanhaSorteio::USUA_ID . " = $usuaid '"
        . ' AND ' . DmlSqlCampanhaSorteio::CASO_IN_STATUS . " = '$status'"
        );
        if ($res){
            $tmp = $res->fetch_assoc();
            $retorno = $tmp['contador'];
        }
        return $retorno;

    }

/**
* countCampanhaSorteioPorCampIdStatus() - contar a quantidade de registros
* sob o contexto da classe CampanhaSorteio com base no usuário específico. Esse usuário
* é o usuário logado na sessão ou no próprio dispositivo móvel e de acordo com a 
* query em @see $sql na tabela CAMPANHA_SORTEIO 
*
* @see listPagina()
*
* @param $campid
* @param $status
* @param $pag
* @param $qtde
* @param $coluna
* @param $ordem
*
* @return PaginacaoDTO
*/ 

public function countCampanhaSorteioPorCampIdStatus($campid, $status)
{   
    $retorno = 0;
    // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
    $conexao = $this->daofactory->getSession();
    $sql = DmlSqlCampanhaSorteio::SQL_COUNT . ' WHERE ' 
    . DmlSqlCampanhaSorteio::CAMP_ID . " = $campid "
    . ' AND ' . DmlSqlCampanhaSorteio::CASO_IN_STATUS . " = '$status'";

   
    $res = $conexao->query($sql);
    if ($res){
        $tmp = $res->fetch_assoc();
        $retorno = $tmp['contador'];
    }
    return $retorno;

}


/**
* countCampanhaSorteioPorCampId() - contar a quantidade de registros
* sob o contexto da classe CampanhaSorteio com base no usuário específico. Esse usuário
* é o usuário logado na sessão ou no próprio dispositivo móvel e de acordo com a 
* query em @see $sql na tabela CAMPANHA_SORTEIO 
*
* @see listPagina()
*
* @param $campid
* @param $pag
* @param $qtde
* @param $coluna
* @param $ordem
*
* @return PaginacaoDTO
*/ 

public function countCampanhaSorteioPorCampId($campid)
{   
    $retorno = 0;
    // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
    $conexao = $this->daofactory->getSession();
    $sql = DmlSqlCampanhaSorteio::SQL_COUNT . ' WHERE ' 
    . DmlSqlCampanhaSorteio::CAMP_ID . " = $campid ";

   
    $res = $conexao->query($sql);
    if ($res){
        $tmp = $res->fetch_assoc();
        $retorno = $tmp['contador'];
    }
    return $retorno;

}


/**
* listCampanhaSorteioPorUsuaIdStatus() - Listar um conjunto de registro previamente paginado
* sob o contexto da classe CampanhaSorteio com base no usuário específico. Esse usuário
* é o usuário logado na sessão ou no próprio dispositivo móvel e de acordo com a 
* query em @see $sql na tabela CAMPANHA_SORTEIO 
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
    public function listCampanhaSorteioPorUsuaIdStatus($usuaid, $status, $pag, $qtde, $coluna, $ordem)
    {
        $sql = DmlSqlCampanhaSorteio::SELECT 
        . ' WHERE ' . DmlSqlCampanhaSorteio::USUA_ID . " = $usuaid "
        . ' AND ' . DmlSqlCampanhaSorteio::CASO_IN_STATUS . " = '$status'"
        . ' ORDER BY ' . $coluna . ($ordem == 0 ? " ASC": " DESC");
        return $this->listPagina($sql, $pag, $qtde);
    }

/**
* listCampanhaSorteioPorCampIdStatus() - Listar um conjunto de registro previamente paginado
* sob o contexto da classe CampanhaSorteio com base no usuário específico. Esse usuário
* é o usuário logado na sessão ou no próprio dispositivo móvel e de acordo com a 
* query em @see $sql na tabela CAMPANHA_SORTEIO 
*
* @see listPagina()
*
* @param $campid
* @param $status
* @param $pag
* @param $qtde
* @param $coluna
* @param $ordem
*
* @return PaginacaoDTO
*/ 
public function listCampanhaSorteioPorCampIdStatus($campid, $status, $pag, $qtde, $coluna, $ordem)
{
    $sql = DmlSqlCampanhaSorteio::SELECT 
    . ' WHERE ' . DmlSqlCampanhaSorteio::CAMP_ID . " = $campid "
    . ' AND ' . DmlSqlCampanhaSorteio::CASO_IN_STATUS . " = '$status'"
    . ' ORDER BY ' . $coluna . ($ordem == 0 ? " ASC": " DESC");
    
    return $this->listPagina($sql, $pag, $qtde);
}


/**
* listCampanhaSorteioPorCampId() - Listar um conjunto de registro previamente paginado
* sob o contexto da classe CampanhaSorteio com base no usuário específico. Esse usuário
* é o usuário logado na sessão ou no próprio dispositivo móvel e de acordo com a 
* query em @see $sql na tabela CAMPANHA_SORTEIO 
*
* @see listPagina()
*
* @param $campid
* @param $pag
* @param $qtde
* @param $coluna
* @param $ordem
*
* @return PaginacaoDTO
*/ 
public function listCampanhaSorteioPorCampId($campid, $pag, $qtde, $coluna, $ordem)
{
    $sql = DmlSqlCampanhaSorteio::SELECT 
    . ' WHERE ' . DmlSqlCampanhaSorteio::CAMP_ID . " = $campid "
    . ' ORDER BY ' . $coluna . ($ordem == 0 ? " ASC": " DESC");
   
    return $this->listPagina($sql, $pag, $qtde);
}


/**
* listPagina() - Listar um conjunto de registro previamente paginado
* e de acordo com a query em @see $sql na tabela CAMPANHA_SORTEIO 
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
* na tabela CAMPANHA_SORTEIO usando a Primary Key CASO_ID
*
* @param $id
* @return CampanhaSorteioDTO
*/ 
    public function loadPK($id)
    {   
        $retorno = NULL;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $res = $conexao->query(DmlSqlCampanhaSorteio::SELECT . ' WHERE ' . DmlSqlCampanhaSorteio::CASO_ID . '=' . $id );
        if ($res){
            $retorno = $this->getDTO($res->fetch_assoc());
        }
        return $retorno;
    }

/**
* updateStatus() - atualizar o campo de STATUS utilizando a id como item de busca
* na tabela CAMPANHA_SORTEIO usando a Primary Key CASO_ID
*
* @param $id
* @param $status
*
* @return CampanhaSorteioDTO
*/ 
    public function updateStatus($id, $status)
    {   
        $retorno = false;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $stmt = $conexao->prepare(DmlSqlCampanhaSorteio::UPD_STATUS);
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
* insert() - inserir um registro com base no CampanhaSorteioDTO. Alguns atributos dentro do DTO
* serão ignorados caso estejam populados, pois os mesmos possuem constraint de DEFAULT value
* ou campos de AUTO INCREMENTO já previamente definidos no DDL de criação de tabelas do BD.
*
* Atributos da classe CampanhaSorteioDTO sumariamente IGNORADOS por este método MESMO que estejam preenchidos:
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
        $stmt = $conexao->prepare(DmlSqlCampanhaSorteio::INS);
        $stmt->bind_param(DmlSql::INTEGER_TYPE 
                            . DmlSql::STRING_TYPE 
                            . DmlSql::STRING_TYPE 
                            . DmlSql::STRING_TYPE 
                            . DmlSql::INTEGER_TYPE 
                            ,$dto->id_campanha
                            ,$dto->nome
                            ,$dto->urlRegulamento
                            ,$dto->premio
                            ,$dto->maxTickets
        );
        if ($stmt->execute())
        {
            $retorno = true;
        }

        return $retorno;
    }

    /**
     * getDTO() - Transforma o resultset padrão em CampanhaSorteioDTO
    */
    public function getDTO($resultset)
    {
        if($resultset == NULL){
            return NULL;
        }
        //echo var_dump($resultset); // ótimo pra debugar
        $retorno = new CampanhaSorteioDTO();
        $retorno->id = $resultset[DmlSqlCampanhaSorteio::CASO_ID] == NULL ? NULL : $resultset[DmlSqlCampanhaSorteio::CASO_ID];
        $retorno->id_campanha = $resultset[DmlSqlCampanhaSorteio::CAMP_ID] == NULL ? NULL : $resultset[DmlSqlCampanhaSorteio::CAMP_ID];
        $retorno->nome = $resultset[DmlSqlCampanhaSorteio::CASO_TX_NOME] == NULL ? NULL : $resultset[DmlSqlCampanhaSorteio::CASO_TX_NOME];
        $retorno->urlRegulamento = $resultset[DmlSqlCampanhaSorteio::CASO_TX_URL_REGULAMENTO] == NULL ? NULL : $resultset[DmlSqlCampanhaSorteio::CASO_TX_URL_REGULAMENTO];
        $retorno->premio = $resultset[DmlSqlCampanhaSorteio::CASO_TX_PREMIO] == NULL ? NULL : $resultset[DmlSqlCampanhaSorteio::CASO_TX_PREMIO];
        $retorno->dataComecoSorteio = $resultset[DmlSqlCampanhaSorteio::CASO_DT_INICIO] == NULL ? NULL : $resultset[DmlSqlCampanhaSorteio::CASO_DT_INICIO];
        $retorno->dataFimSorteio = $resultset[DmlSqlCampanhaSorteio::CASO_DT_TERMINO] == NULL ? NULL : $resultset[DmlSqlCampanhaSorteio::CASO_DT_TERMINO];
        $retorno->maxTickets = $resultset[DmlSqlCampanhaSorteio::CASO_NU_MAX_TICKET] == NULL ? NULL : $resultset[DmlSqlCampanhaSorteio::CASO_NU_MAX_TICKET];
        $retorno->status = $resultset[DmlSqlCampanhaSorteio::CASO_IN_STATUS] == NULL ? NULL : $resultset[DmlSqlCampanhaSorteio::CASO_IN_STATUS];
        $retorno->dataCadastro = Util::MySQLDate_to_DMYHMiS($resultset[DmlSqlCampanhaSorteio::CASO_DT_CADASTRO]);
        $retorno->dataAtualizacao = Util::MySQLDate_to_DMYHMiS($resultset[DmlSqlCampanhaSorteio::CASO_DT_UPDATE]);
        $retorno->statusdesc = VariavelCache::getInstance()->getStatusDesc($retorno->status);
        $retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
        $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);
        
        return $retorno;

    }

    /**
    * updateId_Campanha() - implementação da assinatura em CampanhaSorteioDAO
    */
    public function updateId_Campanha($id, $id_campanha)
    {   
        $retorno = false;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $stmt = $conexao->prepare(DmlSqlCampanhaSorteio::UPD_CAMPANHA_SORTEIO_CAMP_ID_PK);
        $stmt->bind_param(DmlSql::INTEGER_TYPE 
                            . DmlSql::INTEGER_TYPE
                            ,$id_campanha
                            ,$id);
        if ($stmt->execute())
        {
            $retorno = true;
        }

        return $retorno;
    }

    /**
    * updateNome() - implementação da assinatura em CampanhaSorteioDAO
    */
    public function updateNome($id, $nome)
    {   
        $retorno = false;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $stmt = $conexao->prepare(DmlSqlCampanhaSorteio::UPD_CAMPANHA_SORTEIO_CASO_TX_NOME_PK);
        $stmt->bind_param(DmlSql::STRING_TYPE 
                            . DmlSql::STRING_TYPE
                            ,$nome
                            ,$id);
        if ($stmt->execute())
        {
            $retorno = true;
        }

        return $retorno;
    }

    /**
    * updateUrlregulamento() - implementação da assinatura em CampanhaSorteioDAO
    */
    public function updateUrlregulamento($id, $urlRegulamento)
    {   
        $retorno = false;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $stmt = $conexao->prepare(DmlSqlCampanhaSorteio::UPD_CAMPANHA_SORTEIO_CASO_TX_URL_REGULAMENTO_PK);
        $stmt->bind_param(DmlSql::STRING_TYPE 
                            . DmlSql::STRING_TYPE
                            ,$urlRegulamento
                            ,$id);
        if ($stmt->execute())
        {
            $retorno = true;
        }

        return $retorno;
    }

    /**
    * updatePremio() - implementação da assinatura em CampanhaSorteioDAO
    */
    public function updatePremio($id, $premio)
    {   
        $retorno = false;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $stmt = $conexao->prepare(DmlSqlCampanhaSorteio::UPD_CAMPANHA_SORTEIO_CASO_TX_PREMIO_PK);
        $stmt->bind_param(DmlSql::STRING_TYPE 
                            . DmlSql::STRING_TYPE
                            ,$premio
                            ,$id);
        if ($stmt->execute())
        {
            $retorno = true;
        }

        return $retorno;
    }

    /**
    * updateDatacomecosorteio() - implementação da assinatura em CampanhaSorteioDAO
    */
    public function updateDatacomecosorteio($id, $dataComecoSorteio)
    {   
        $retorno = false;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $stmt = $conexao->prepare(DmlSqlCampanhaSorteio::UPD_CAMPANHA_SORTEIO_CASO_DT_INICIO_PK);
        $stmt->bind_param(DmlSql::STRING_TYPE 
                            . DmlSql::STRING_TYPE
                            ,$dataComecoSorteio
                            ,$id);
        if ($stmt->execute())
        {
            $retorno = true;
        }

        return $retorno;
    }

    /**
    * updateDatafimsorteio() - implementação da assinatura em CampanhaSorteioDAO
    */
    public function updateDatafimsorteio($id, $dataFimSorteio)
    {   
        $retorno = false;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $stmt = $conexao->prepare(DmlSqlCampanhaSorteio::UPD_CAMPANHA_SORTEIO_CASO_DT_TERMINO_PK);
        $stmt->bind_param(DmlSql::STRING_TYPE 
                            . DmlSql::STRING_TYPE
                            ,$dataFimSorteio
                            ,$id);
        if ($stmt->execute())
        {
            $retorno = true;
        }

        return $retorno;
    }

    /**
    * updateMaxtickets() - implementação da assinatura em CampanhaSorteioDAO
    */
    public function updateMaxtickets($id, $maxTickets)
    {   
        $retorno = false;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $stmt = $conexao->prepare(DmlSqlCampanhaSorteio::UPD_CAMPANHA_SORTEIO_CASO_NU_MAX_TICKET_PK);
        $stmt->bind_param(DmlSql::STRING_TYPE 
                            . DmlSql::STRING_TYPE
                            ,$maxTickets
                            ,$id);
        if ($stmt->execute())
        {
            $retorno = true;
        }

        return $retorno;
    }

    /**
    * loadId_Campanha() - implementação da assinatura em CampanhaSorteioDAO
    */

    public function loadId_Campanha($id_campanha)
    {   
        $retorno = NULL;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $res = $conexao->query(DmlSqlCampanhaSorteio::SELECT . ' WHERE ' . DmlSqlCampanhaSorteio::CAMP_ID . '=' . $id_campanha );
        if ($res){
            $retorno = $this->getDTO($res->fetch_assoc());
        }
        return $retorno;
    }

    /**
    * loadNome() - implementação da assinatura em CampanhaSorteioDAO
    */

    public function loadNome($nome)
    {   
        $retorno = NULL;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $res = $conexao->query(DmlSqlCampanhaSorteio::SELECT . ' WHERE ' . DmlSqlCampanhaSorteio::CASO_TX_NOME . '=' . $nome );
        if ($res){
            $retorno = $this->getDTO($res->fetch_assoc());
        }
        return $retorno;
    }

    /**
    * loadUrlregulamento() - implementação da assinatura em CampanhaSorteioDAO
    */

    public function loadUrlregulamento($urlRegulamento)
    {   
        $retorno = NULL;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $res = $conexao->query(DmlSqlCampanhaSorteio::SELECT . ' WHERE ' . DmlSqlCampanhaSorteio::CASO_TX_URL_REGULAMENTO . '=' . $urlRegulamento );
        if ($res){
            $retorno = $this->getDTO($res->fetch_assoc());
        }
        return $retorno;
    }

    /**
    * loadPremio() - implementação da assinatura em CampanhaSorteioDAO
    */

    public function loadPremio($premio)
    {   
        $retorno = NULL;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $res = $conexao->query(DmlSqlCampanhaSorteio::SELECT . ' WHERE ' . DmlSqlCampanhaSorteio::CASO_TX_PREMIO . '=' . $premio );
        if ($res){
            $retorno = $this->getDTO($res->fetch_assoc());
        }
        return $retorno;
    }

    /**
    * loadDatacomecosorteio() - implementação da assinatura em CampanhaSorteioDAO
    */

    public function loadDatacomecosorteio($dataComecoSorteio)
    {   
        $retorno = NULL;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $res = $conexao->query(DmlSqlCampanhaSorteio::SELECT . ' WHERE ' . DmlSqlCampanhaSorteio::CASO_DT_INICIO . '=' . $dataComecoSorteio );
        if ($res){
            $retorno = $this->getDTO($res->fetch_assoc());
        }
        return $retorno;
    }

    /**
    * loadDatafimsorteio() - implementação da assinatura em CampanhaSorteioDAO
    */

    public function loadDatafimsorteio($dataFimSorteio)
    {   
        $retorno = NULL;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $res = $conexao->query(DmlSqlCampanhaSorteio::SELECT . ' WHERE ' . DmlSqlCampanhaSorteio::CASO_DT_TERMINO . '=' . $dataFimSorteio );
        if ($res){
            $retorno = $this->getDTO($res->fetch_assoc());
        }
        return $retorno;
    }

    /**
    * loadMaxtickets() - implementação da assinatura em CampanhaSorteioDAO
    */

    public function loadMaxtickets($maxTickets)
    {   
        $retorno = NULL;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $res = $conexao->query(DmlSqlCampanhaSorteio::SELECT . ' WHERE ' . DmlSqlCampanhaSorteio::CASO_NU_MAX_TICKET . '=' . $maxTickets );
        if ($res){
            $retorno = $this->getDTO($res->fetch_assoc());
        }
        return $retorno;
    }

    /**
    * loadStatus() - implementação da assinatura em CampanhaSorteioDAO
    */

    public function loadStatus($status)
    {   
        $retorno = NULL;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $res = $conexao->query(DmlSqlCampanhaSorteio::SELECT . ' WHERE ' . DmlSqlCampanhaSorteio::CASO_IN_STATUS . '=' . $status );
        if ($res){
            $retorno = $this->getDTO($res->fetch_assoc());
        }
        return $retorno;
    }

    /**
    * loadDatacadastro() - implementação da assinatura em CampanhaSorteioDAO
    */

    public function loadDatacadastro($dataCadastro)
    {   
        $retorno = NULL;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $res = $conexao->query(DmlSqlCampanhaSorteio::SELECT . ' WHERE ' . DmlSqlCampanhaSorteio::CASO_DT_CADASTRO . '=' . $dataCadastro );
        if ($res){
            $retorno = $this->getDTO($res->fetch_assoc());
        }
        return $retorno;
    }

    /**
    * loadDataatualizacao() - implementação da assinatura em CampanhaSorteioDAO
    */

    public function loadDataatualizacao($dataAtualizacao)
    {   
        $retorno = NULL;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $res = $conexao->query(DmlSqlCampanhaSorteio::SELECT . ' WHERE ' . DmlSqlCampanhaSorteio::CASO_DT_UPDATE . '=' . $dataAtualizacao );
        if ($res){
            $retorno = $this->getDTO($res->fetch_assoc());
        }
        return $retorno;
    }

}
?>




