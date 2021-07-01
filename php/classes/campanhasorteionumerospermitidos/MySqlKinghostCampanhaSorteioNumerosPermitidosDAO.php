
<?php

/**
* MySqlKinghostCampanhaSorteioNumerosPermitidosDAO - Implementação DAO
*
* Classe de com todos os comandos DML e DDL (se necessário) para apoio 
* a classe MySqlKinghostCampanhaSorteioNumerosPermitidosDAO
* Não é uma camada visível para outros dispositivos, como as camadas de apresentação e aplicação. 
*
*
* Tabela principal de atuação: CAMPANHA_SORTEIO_NUMEROS_PERMITIDOS
*
* Changelog:
*
* 
* @author Julio Cesar Vitorino
* @since 23/08/2019 10:06:20
*
*/
require_once 'CampanhaSorteioNumerosPermitidosDTO.php';
require_once 'CampanhaSorteioNumerosPermitidosDAO.php';
require_once 'DmlSqlCampanhaSorteioNumerosPermitidos.php';

require_once '../variavel/VariavelCache.php';
require_once '../daofactory/DmlSql.php';
require_once '../mensagem/ConstantesMensagem.php';
require_once '../mensagem/MensagemCache.php';

class MySqlKinghostCampanhaSorteioNumerosPermitidosDAO implements CampanhaSorteioNumerosPermitidosDAO
{
    private $daofactory;

    function __construct($daofactory)
    {
        $this->daofactory = $daofactory;
    }


/**
* loadPorCasoIdNrTicketStatus() - Carrega um DTO para os parametros indicados
*
* @param $id_caso
* @param $status
* @return $dto
*/ 

    public function loadPorCasoIdNrTicketStatus($id_caso, $nrticket, $status)   
    {   
        $retorno = NULL;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $sql = DmlSqlCampanhaSorteioNumerosPermitidos::SELECT 
        . ' WHERE ' 
        . DmlSqlCampanhaSorteioNumerosPermitidos::CASO_ID . " = $id_caso AND " 
        . DmlSqlCampanhaSorteioNumerosPermitidos::CSNP_NU_SORTEIO . " = $nrticket AND " 
        . DmlSqlCampanhaSorteioNumerosPermitidos::CSNP_IN_STATUS . " = '$status' ";

        $res = $conexao->query($sql);
        if ($res->num_rows > 0){
            $retorno = $this->getDTO($res->fetch_assoc());
        }
        return $retorno;
    }

/**
* loadMaxId_CasoPK() - Carrega um MaxID (pk) para um ${CAMPO} e status
*
* @param $id_caso
* @param $status
* @return $dto
*/ 

    public function loadMaxId_CasoPK($id_caso,$status)
    {   
        $retorno = 0;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $sql = DmlSqlCampanhaSorteioNumerosPermitidos::SELECT_MAX_PK . ' WHERE ' 
        . DmlSqlCampanhaSorteioNumerosPermitidos::CASO_ID . " = $id_caso "
        . " AND " . DmlSqlCampanhaSorteioNumerosPermitidos::CSNP_IN_STATUS . " = '$status'";

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
* listAll() - Lista todos os registros provenientes de CAMPANHA_SORTEIO_NUMEROS_PERMITIDOS sem critério de paginação
*
* @return List<CampanhaSorteioNumerosPermitidosDTO>[]
*/ 
    public function listAll()   {   }

/**
* update() - atualiza apenas um registro com base no dto CampanhaSorteioNumerosPermitidosDTO->id
* @param $daofactory
*
* @return boolean
*/ 
    public function update($dto)
    {   
        $retorno = false;

        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $stmt = $conexao->prepare(DmlSqlCampanhaSorteioNumerosPermitidos::UPD_PK);
        $stmt->bind_param(DmlSql::INTEGER_TYPE 
                            . DmlSql::INTEGER_TYPE 
                            . DmlSql::INTEGER_TYPE 
                            ,$dto->id_caso
                            ,$dto->nrTicketSorteio
                            ,$dto->id );
        if ($stmt->execute())
        {
            $retorno = true;
        }

        return $retorno;
    }

/**
* delete() - excluir fisicamente um registro com base no dto CampanhaSorteioNumerosPermitidosDTO->id
*
* @return boolean
*/ 
    public function delete($dto)
    {   
        $retorno = false;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $stmt = $conexao->prepare(DmlSqlCampanhaSorteioNumerosPermitidos::DEL_PK);
        $stmt->bind_param(DmlSql::INTEGER_TYPE
                            ,$dto->id);
        if ($stmt->execute())
        {
            $retorno = true;
        }

        return $retorno;
    }


    public function listCampanhaSorteioNumerosPermitidosStatus($status)
    {
        $retorno = array();

        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $res = $conexao->query(DmlSqlCampanhaSorteioNumerosPermitidos::SELECT . 'WHERE `' . DmlSqlCampanhaSorteioNumerosPermitidos::CSNP_IN_STATUS . "` = '$status'" );
        if ($res){
            while ($row = $res->fetch_assoc()) {
                array_push($retorno, $this->getDTO($row));
            }
        }
        return $retorno;
    }

/**
* countCampanhaSorteioNumerosPermitidosPorStatus() - contar a quantidade de registros
* sob o contexto da classe CampanhaSorteioNumerosPermitidos com base no status específico. 
*
* Atenção em @see $sql na tabela CAMPANHA_SORTEIO_NUMEROS_PERMITIDOS 
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

    public function countCampanhaSorteioNumerosPermitidosPorStatus($status)
    {   
        $retorno = 0;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $res = $conexao->query(DmlSqlCampanhaSorteioNumerosPermitidos::SQL_COUNT . ' WHERE ' 
        . DmlSqlCampanhaSorteioNumerosPermitidos::CSNP_IN_STATUS . " = '$status'"
        );
        if ($res){
            $tmp = $res->fetch_assoc();
            $retorno = $tmp['contador'];
        }
        return $retorno;

    }

/**
* listCampanhaSorteioNumerosPermitidosPorStatus() - Listar um conjunto de registro previamente paginado
* sob o contexto da classe CampanhaSorteioNumerosPermitidos com base no status específico.
*
* Atenção em @see $sql na tabela CAMPANHA_SORTEIO_NUMEROS_PERMITIDOS 
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

    public function listCampanhaSorteioNumerosPermitidosPorStatus($status, $pag, $qtde, $coluna, $ordem)
    {
        $sql = DmlSqlCampanhaSorteioNumerosPermitidos::SELECT 
        . ' WHERE ' . DmlSqlCampanhaSorteioNumerosPermitidos::CSNP_IN_STATUS . " = '$status'"
        . ' ORDER BY ' . $coluna . ($ordem == 0 ? " ASC": " DESC");
        return $this->listPagina($sql, $pag, $qtde);
    }

/**
* countCampanhaSorteioNumerosPermitidosPorUsuaIdStatus() - contar a quantidade de registros
* sob o contexto da classe CampanhaSorteioNumerosPermitidos com base no usuário específico. Esse usuário
* é o usuário logado na sessão ou no próprio dispositivo móvel e de acordo com a 
* query em @see $sql na tabela CAMPANHA_SORTEIO_NUMEROS_PERMITIDOS 
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

    public function countCampanhaSorteioNumerosPermitidosPorUsuaIdStatus($usuaid, $status)
    {   
        $retorno = 0;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $res = $conexao->query(DmlSqlCampanhaSorteioNumerosPermitidos::SQL_COUNT . ' WHERE ' 
        . DmlSqlCampanhaSorteioNumerosPermitidos::USUA_ID . " = $usuaid "
        . ' AND ' . DmlSqlCampanhaSorteioNumerosPermitidos::CSNP_IN_STATUS . " = '$status'"
        );
        if ($res){
            $tmp = $res->fetch_assoc();
            $retorno = $tmp['contador'];
        }
        return $retorno;

    }

/**
* listCampanhaSorteioNumerosPermitidosPorUsuaIdStatus() - Listar um conjunto de registro previamente paginado
* sob o contexto da classe CampanhaSorteioNumerosPermitidos com base no usuário específico. Esse usuário
* é o usuário logado na sessão ou no próprio dispositivo móvel e de acordo com a 
* query em @see $sql na tabela CAMPANHA_SORTEIO_NUMEROS_PERMITIDOS 
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
    public function listCampanhaSorteioNumerosPermitidosPorUsuaIdStatus($usuaid, $status, $pag, $qtde, $coluna, $ordem)
    {
        $sql = DmlSqlCampanhaSorteioNumerosPermitidos::SELECT 
        . ' WHERE ' . DmlSqlCampanhaSorteioNumerosPermitidos::USUA_ID . " = $usuaid "
        . ' AND ' . DmlSqlCampanhaSorteioNumerosPermitidos::CSNP_IN_STATUS . " = '$status'"
        . ' ORDER BY ' . $coluna . ($ordem == 0 ? " ASC": " DESC");
        return $this->listPagina($sql, $pag, $qtde);
    }

/**
* listPagina() - Listar um conjunto de registro previamente paginado
* e de acordo com a query em @see $sql na tabela CAMPANHA_SORTEIO_NUMEROS_PERMITIDOS 
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
* na tabela CAMPANHA_SORTEIO_NUMEROS_PERMITIDOS usando a Primary Key CSNP_ID
*
* @param $id
* @return CampanhaSorteioNumerosPermitidosDTO
*/ 
    public function loadPK($id)
    {   
        $retorno = NULL;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $res = $conexao->query(DmlSqlCampanhaSorteioNumerosPermitidos::SELECT . ' WHERE ' . DmlSqlCampanhaSorteioNumerosPermitidos::CSNP_ID . '=' . $id );
        if ($res->num_rows > 0){
            $retorno = $this->getDTO($res->fetch_assoc());
        }
        return $retorno;
    }

/**
* updateStatus() - atualizar o campo de STATUS utilizando a id como item de busca
* na tabela CAMPANHA_SORTEIO_NUMEROS_PERMITIDOS usando a Primary Key CSNP_ID
*
* @param $id
* @param $status
*
* @return CampanhaSorteioNumerosPermitidosDTO
*/ 
    public function updateStatus($id, $status)
    {   
        $retorno = false;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $stmt = $conexao->prepare(DmlSqlCampanhaSorteioNumerosPermitidos::UPD_STATUS);
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
* insert() - inserir um registro com base no CampanhaSorteioNumerosPermitidosDTO. Alguns atributos dentro do DTO
* serão ignorados caso estejam populados, pois os mesmos possuem constraint de DEFAULT value
* ou campos de AUTO INCREMENTO já previamente definidos no DDL de criação de tabelas do BD.
*
* Atributos da classe CampanhaSorteioNumerosPermitidosDTO sumariamente IGNORADOS por este método MESMO que estejam preenchidos:
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
        $stmt = $conexao->prepare(DmlSqlCampanhaSorteioNumerosPermitidos::INS);
        $stmt->bind_param(DmlSql::INTEGER_TYPE 
                            . DmlSql::INTEGER_TYPE 
                            ,$dto->id_caso
                            ,$dto->nrTicketSorteio
        );
        if ($stmt->execute())
        {
            $retorno = true;
        }

        return $retorno;
    }

    /**
     * getDTO() - Transforma o resultset padrão em CampanhaSorteioNumerosPermitidosDTO
    */
    public function getDTO($resultset)
    {
        if($resultset == NULL)
        {
            return NULL;
        }
        //echo var_dump($resultset); // ótimo pra debugar
        $retorno = new CampanhaSorteioNumerosPermitidosDTO();
        $retorno->id = $resultset[DmlSqlCampanhaSorteioNumerosPermitidos::CSNP_ID] == NULL ? NULL : $resultset[DmlSqlCampanhaSorteioNumerosPermitidos::CSNP_ID];
        $retorno->id_caso = $resultset[DmlSqlCampanhaSorteioNumerosPermitidos::CASO_ID] == NULL ? NULL : $resultset[DmlSqlCampanhaSorteioNumerosPermitidos::CASO_ID];
        $retorno->nrTicketSorteio = $resultset[DmlSqlCampanhaSorteioNumerosPermitidos::CSNP_NU_SORTEIO] == NULL ? NULL : $resultset[DmlSqlCampanhaSorteioNumerosPermitidos::CSNP_NU_SORTEIO];
        $retorno->status = $resultset[DmlSqlCampanhaSorteioNumerosPermitidos::CSNP_IN_STATUS] == NULL ? NULL : $resultset[DmlSqlCampanhaSorteioNumerosPermitidos::CSNP_IN_STATUS];
        $retorno->dataCadastro = Util::MySQLDate_to_DMYHMiS($resultset[DmlSqlCampanhaSorteioNumerosPermitidos::CSNP_DT_CADASTRO]);
        $retorno->dataAtualizacao = Util::MySQLDate_to_DMYHMiS($resultset[DmlSqlCampanhaSorteioNumerosPermitidos::CSNP_DT_UPDATE]);
        $retorno->statusdesc = VariavelCache::getInstance()->getStatusDesc($retorno->status);
        $retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
        $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);
        
        return $retorno;

    }

    /**
    * updateId_Caso() - implementação da assinatura em CampanhaSorteioNumerosPermitidosDAO
    */
    public function updateId_Caso($id, $id_caso)
    {   
        $retorno = false;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $stmt = $conexao->prepare(DmlSqlCampanhaSorteioNumerosPermitidos::UPD_CAMPANHA_SORTEIO_NUMEROS_PERMITIDOS_CASO_ID_PK);
        $stmt->bind_param(DmlSql::INTEGER_TYPE 
                            . DmlSql::INTEGER_TYPE
                            ,$id_caso
                            ,$id);
        if ($stmt->execute())
        {
            $retorno = true;
        }

        return $retorno;
    }

    /**
    * updateNrticketsorteio() - implementação da assinatura em CampanhaSorteioNumerosPermitidosDAO
    */
    public function updateNrticketsorteio($id, $nrTicketSorteio)
    {   
        $retorno = false;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $stmt = $conexao->prepare(DmlSqlCampanhaSorteioNumerosPermitidos::UPD_CAMPANHA_SORTEIO_NUMEROS_PERMITIDOS_CSNP_NU_SORTEIO_PK);
        $stmt->bind_param(DmlSql::INTEGER_TYPE 
                            . DmlSql::INTEGER_TYPE
                            ,$nrTicketSorteio
                            ,$id);
        if ($stmt->execute())
        {
            $retorno = true;
        }

        return $retorno;
    }

    /**
    * loadId_Caso() - implementação da assinatura em CampanhaSorteioNumerosPermitidosDAO
    */

    public function loadId_Caso($id_caso)
    {   
        $retorno = NULL;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $res = $conexao->query(DmlSqlCampanhaSorteioNumerosPermitidos::SELECT . ' WHERE ' . DmlSqlCampanhaSorteioNumerosPermitidos::CASO_ID . '=' . $id_caso );
        if ($res){
            $retorno = $this->getDTO($res->fetch_assoc());
        }
        return $retorno;
    }

    /**
    * loadNrticketsorteio() - implementação da assinatura em CampanhaSorteioNumerosPermitidosDAO
    */

    public function loadNrticketsorteio($nrTicketSorteio)
    {   
        $retorno = NULL;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $res = $conexao->query(DmlSqlCampanhaSorteioNumerosPermitidos::SELECT . ' WHERE ' . DmlSqlCampanhaSorteioNumerosPermitidos::CSNP_NU_SORTEIO . '=' . $nrTicketSorteio );
        if ($res){
            $retorno = $this->getDTO($res->fetch_assoc());
        }
        return $retorno;
    }

    /**
    * loadStatus() - implementação da assinatura em CampanhaSorteioNumerosPermitidosDAO
    */

    public function loadStatus($status)
    {   
        $retorno = NULL;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $res = $conexao->query(DmlSqlCampanhaSorteioNumerosPermitidos::SELECT . ' WHERE ' . DmlSqlCampanhaSorteioNumerosPermitidos::CSNP_IN_STATUS . '=' . $status );
        if ($res){
            $retorno = $this->getDTO($res->fetch_assoc());
        }
        return $retorno;
    }

    /**
    * loadDatacadastro() - implementação da assinatura em CampanhaSorteioNumerosPermitidosDAO
    */

    public function loadDatacadastro($dataCadastro)
    {   
        $retorno = NULL;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $res = $conexao->query(DmlSqlCampanhaSorteioNumerosPermitidos::SELECT . ' WHERE ' . DmlSqlCampanhaSorteioNumerosPermitidos::CSNP_DT_CADASTRO . '=' . $dataCadastro );
        if ($res){
            $retorno = $this->getDTO($res->fetch_assoc());
        }
        return $retorno;
    }

    /**
    * loadDataatualizacao() - implementação da assinatura em CampanhaSorteioNumerosPermitidosDAO
    */

    public function loadDataatualizacao($dataAtualizacao)
    {   
        $retorno = NULL;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $res = $conexao->query(DmlSqlCampanhaSorteioNumerosPermitidos::SELECT . ' WHERE ' . DmlSqlCampanhaSorteioNumerosPermitidos::CSNP_DT_UPDATE . '=' . $dataAtualizacao );
        if ($res){
            $retorno = $this->getDTO($res->fetch_assoc());
        }
        return $retorno;
    }

}
?>




