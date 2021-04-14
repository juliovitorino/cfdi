<?php

/**
* MySqlKinghostCampanhaCashbackDAO - Implementação DAO
*
* Classe de com todos os comandos DML e DDL (se necessário) para apoio 
* a classe MySqlKinghostCampanhaCashbackDAO
* Não é uma camada visível para outros dispositivos, como as camadas de apresentação e aplicação. 
*
*
* Tabela principal de atuação: CAMPANHA_CASHBACK
*
* Changelog:
*
* 
* @author Julio Cesar Vitorino
* @since 23/08/2019 10:06:20
*
*/
require_once 'CampanhaCashbackDTO.php';
require_once 'CampanhaCashbackDAO.php';
require_once 'DmlSqlCampanhaCashback.php';

require_once '../variavel/VariavelCache.php';
require_once '../daofactory/DmlSql.php';

class MySqlKinghostCampanhaCashbackDAO implements CampanhaCashbackDAO
{
    private $daofactory;

    function __construct($daofactory)
    {
        $this->daofactory = $daofactory;
    }


/**
 * loadMaxId_UsuarioIdCampanhaPK() - Carrega um MaxID (pk) para um ${CAMPO} e status
 *
 * @param $id_usuario
 * @param $id_campanha
 * @param $status
 * @return $dto
 */ 
    public function loadMaxId_UsuarioIdCampanhaPK($id_usuario, $id_campanha, $status)
    {   
        $retorno = 0;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $sql = DmlSqlCampanhaCashback::SELECT_MAX_PK . ' WHERE ' 
        . DmlSqlCampanhaCashback::USUA_ID . " = $id_usuario "
        . " AND " . DmlSqlCampanhaCashback::CAMP_ID . " = $id_campanha "
        . " AND " . DmlSqlCampanhaCashback::CACA_IN_STATUS . " = '$status'";

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
* listAll() - Lista todos os registros provenientes de CAMPANHA_CASHBACK sem critério de paginação
*
* @return List<CampanhaCashbackDTO>[]
*/ 
    public function listAll()   {   }

/**
* update() - atualiza apenas um registro com base no dto CampanhaCashbackDTO->id
* @param $daofactory
*
* @return boolean
*/ 
    public function update($dto)
    {   
        $retorno = false;

        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $stmt = $conexao->prepare(DmlSqlCampanhaCashback::UPD_PK);
        $stmt->bind_param(DmlSql::INTEGER_TYPE 
                            . DmlSql::INTEGER_TYPE 
                            . DmlSql::INTEGER_TYPE 
                            . DmlSql::DOUBLE_TYPE 
                            . DmlSql::STRING_TYPE 
                            . DmlSql::STRING_TYPE 
                            . DmlSql::INTEGER_TYPE 
                            ,$dto->id_campanha
                            ,$dto->id_usca
                            ,$dto->id_usuario
                            ,$dto->percentual
                            ,$dto->dataTermino
                            ,$dto->obs
                            ,$dto->id );
        if ($stmt->execute())
        {
            $retorno = true;
        }

        return $retorno;
    }

/**
* delete() - excluir fisicamente um registro com base no dto CampanhaCashbackDTO->id
*
* @return boolean
*/ 
    public function delete($dto)
    {   
        $retorno = false;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $stmt = $conexao->prepare(DmlSqlCampanhaCashback::DEL_PK);
        $stmt->bind_param(DmlSql::INTEGER_TYPE
                            ,$dto->id);
        if ($stmt->execute())
        {
            $retorno = true;
        }

        return $retorno;
    }


    public function listCampanhaCashbackStatus($status)
    {
        $retorno = array();

        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $res = $conexao->query(DmlSqlCampanhaCashback::SELECT . 'WHERE `' . DmlSqlCampanhaCashback::CACA_IN_STATUS . "` = '$status'" );
        if ($res){
            while ($row = $res->fetch_assoc()) {
                array_push($retorno, $this->getDTO($row));
            }
        }
        return $retorno;
    }

/**
* countCampanhaCashbackPorStatus() - contar a quantidade de registros
* sob o contexto da classe CampanhaCashback com base no status específico. 
*
* Atenção em @see $sql na tabela CAMPANHA_CASHBACK 
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

    public function countCampanhaCashbackPorStatus($status)
    {   
        $retorno = 0;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $res = $conexao->query(DmlSqlCampanhaCashback::SQL_COUNT . ' WHERE ' 
        . DmlSqlCampanhaCashback::CACA_IN_STATUS . " = '$status'"
        );
        if ($res){
            $tmp = $res->fetch_assoc();
            $retorno = $tmp['contador'];
        }
        return $retorno;

    }

/**
* listCampanhaCashbackPorStatus() - Listar um conjunto de registro previamente paginado
* sob o contexto da classe CampanhaCashback com base no status específico.
*
* Atenção em @see $sql na tabela CAMPANHA_CASHBACK 
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

    public function listCampanhaCashbackPorStatus($status, $pag, $qtde, $coluna, $ordem)
    {
        $sql = DmlSqlCampanhaCashback::SELECT 
        . ' WHERE ' . DmlSqlCampanhaCashback::CACA_IN_STATUS . "  = '$status'"
        . ' ORDER BY ' . $coluna . ($ordem == 0 ? " ASC": " DESC");
        return $this->listPagina($sql, $pag, $qtde);
    }

/**
* countCampanhaCashbackPorUsuaIdStatus() - contar a quantidade de registros
* sob o contexto da classe CampanhaCashback com base no usuário específico. Esse usuário
* é o usuário logado na sessão ou no próprio dispositivo móvel e de acordo com a 
* query em @see $sql na tabela CAMPANHA_CASHBACK 
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

    public function countCampanhaCashbackPorUsuaIdStatus($usuaid, $status)
    {   
        $retorno = 0;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $res = $conexao->query(DmlSqlCampanhaCashback::SQL_COUNT . ' WHERE ' 
        . DmlSqlCampanhaCashback::USUA_ID . " = $usuaid "
        . ' AND ' . DmlSqlCampanhaCashback::CACA_IN_STATUS . " = '$status'"
        );
        if ($res){
            $tmp = $res->fetch_assoc();
            $retorno = $tmp['contador'];
        }
        return $retorno;

    }

/**
* listCampanhaCashbackPorUsuaIdStatus() - Listar um conjunto de registro previamente paginado
* sob o contexto da classe CampanhaCashback com base no usuário específico. Esse usuário
* é o usuário logado na sessão ou no próprio dispositivo móvel e de acordo com a 
* query em @see $sql na tabela CAMPANHA_CASHBACK 
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
    public function listCampanhaCashbackPorUsuaIdStatus($usuaid, $status, $pag, $qtde, $coluna, $ordem)
    {
        $sql = DmlSqlCampanhaCashback::SELECT 
        . ' WHERE ' . DmlSqlCampanhaCashback::USUA_ID . " = $usuaid "
        . ' AND ' . DmlSqlCampanhaCashback::CACA_IN_STATUS . " = '$status'"
        . ' ORDER BY ' . $coluna . ($ordem == 0 ? " ASC": " DESC");
        return $this->listPagina($sql, $pag, $qtde);
    }

/**
* listPagina() - Listar um conjunto de registro previamente paginado
* e de acordo com a query em @see $sql na tabela CAMPANHA_CASHBACK 
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
* na tabela CAMPANHA_CASHBACK usando a Primary Key CACA_ID
*
* @param $id
* @return CampanhaCashbackDTO
*/ 
    public function loadPK($id)
    {   
        $retorno = NULL;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $res = $conexao->query(DmlSqlCampanhaCashback::SELECT . ' WHERE ' . DmlSqlCampanhaCashback::CACA_ID . '=' . $id );
        if ($res){
            $retorno = $this->getDTO($res->fetch_assoc());
        }
        return $retorno;
    }

/**
* updateStatus() - atualizar o campo de STATUS utilizando a id como item de busca
* na tabela CAMPANHA_CASHBACK usando a Primary Key CACA_ID
*
* @param $id
* @param $status
*
* @return CampanhaCashbackDTO
*/ 
    public function updateStatus($id, $status)
    {   
        $retorno = false;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $stmt = $conexao->prepare(DmlSqlCampanhaCashback::UPD_STATUS);
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
* insert() - inserir um registro com base no CampanhaCashbackDTO. Alguns atributos dentro do DTO
* serão ignorados caso estejam populados, pois os mesmos possuem constraint de DEFAULT value
* ou campos de AUTO INCREMENTO já previamente definidos no DDL de criação de tabelas do BD.
*
* Atributos da classe CampanhaCashbackDTO sumariamente IGNORADOS por este método MESMO que estejam preenchidos:
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
        $stmt = $conexao->prepare(DmlSqlCampanhaCashback::INS);
        $stmt->bind_param(DmlSql::INTEGER_TYPE 
                            . DmlSql::INTEGER_TYPE
                            . DmlSql::INTEGER_TYPE
                            . DmlSql::DOUBLE_TYPE 
                            . DmlSql::STRING_TYPE 
                            . DmlSql::STRING_TYPE 
                            ,$dto->id_campanha
                            ,$dto->id_usca
                            ,$dto->id_usuario
                            ,$dto->percentual
                            ,$dto->dataTermino
                            ,$dto->obs
        );
        if ($stmt->execute())
        {
            $retorno = true;
        }

        return $retorno;
    }

    /**
     * getDTO() - Transforma o resultset padrão em CampanhaCashbackDTO
    */
    public function getDTO($resultset)
    {
        //echo var_dump($resultset); // ótimo pra debugar
        $retorno = new CampanhaCashbackDTO();
        $retorno->id = $resultset[DmlSqlCampanhaCashback::CACA_ID] == NULL ? NULL : (int) $resultset[DmlSqlCampanhaCashback::CACA_ID];
        $retorno->id_campanha = $resultset[DmlSqlCampanhaCashback::CAMP_ID] == NULL ? NULL : (int) $resultset[DmlSqlCampanhaCashback::CAMP_ID];
        $retorno->id_usca = $resultset[DmlSqlCampanhaCashback::CAMP_ID] == NULL ? NULL : (int) $resultset[DmlSqlCampanhaCashback::USCA_ID];
        $retorno->id_usuario = $resultset[DmlSqlCampanhaCashback::USUA_ID] == NULL ? NULL : (int) $resultset[DmlSqlCampanhaCashback::USUA_ID];
        $retorno->percentual = $resultset[DmlSqlCampanhaCashback::CACA_VL_PERC_CASHBACK] == NULL ? NULL : (double) $resultset[DmlSqlCampanhaCashback::CACA_VL_PERC_CASHBACK];
        $retorno->percentualFmt = $resultset[DmlSqlCampanhaCashback::CACA_VL_PERC_CASHBACK] == NULL ? NULL : Util::getFmtNum((double) $resultset[DmlSqlCampanhaCashback::CACA_VL_PERC_CASHBACK]);
        $retorno->dataTermino = $resultset[DmlSqlCampanhaCashback::CACA_DT_TERMINO] == NULL ? NULL : Util::MySQLDate_to_DMYHMiS($resultset[DmlSqlCampanhaCashback::CACA_DT_TERMINO]);
        $retorno->obs = $resultset[DmlSqlCampanhaCashback::CACA_TX_OBS] == NULL ? NULL : $resultset[DmlSqlCampanhaCashback::CACA_TX_OBS];
        $retorno->status = $resultset[DmlSqlCampanhaCashback::CACA_IN_STATUS] == NULL ? NULL : $resultset[DmlSqlCampanhaCashback::CACA_IN_STATUS];
        $retorno->dataCadastro = Util::MySQLDate_to_DMYHMiS($resultset[DmlSqlCampanhaCashback::CACA_DT_CADASTRO]);
        $retorno->dataAtualizacao = Util::MySQLDate_to_DMYHMiS($resultset[DmlSqlCampanhaCashback::CACA_DT_UPDATE]);
        $retorno->statusdesc = VariavelCache::getInstance()->getStatusDesc($retorno->status);
        return $retorno;

    }

    /**
    * updateId_Campanha() - implementação da assinatura em CampanhaCashbackDAO
    */
    public function updateId_Campanha($id, $id_campanha)
    {   
        $retorno = false;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $stmt = $conexao->prepare(DmlSqlCampanhaCashback::UPD_CAMPANHA_CASHBACK_CAMP_ID_PK);
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
    * updatePercentual() - implementação da assinatura em CampanhaCashbackDAO
    */
    public function updatePercentual($id, $percentual)
    {   
        $retorno = false;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $stmt = $conexao->prepare(DmlSqlCampanhaCashback::UPD_CAMPANHA_CASHBACK_CACA_VL_PERC_CASHBACK_PK);
        $stmt->bind_param(DmlSql::DOUBLE_TYPE 
                            . DmlSql::DOUBLE_TYPE
                            ,$percentual
                            ,$id);
        if ($stmt->execute())
        {
            $retorno = true;
        }

        return $retorno;
    }

    /**
    * updateDatatermino() - implementação da assinatura em CampanhaCashbackDAO
    */
    public function updateDatatermino($id, $dataTermino)
    {   
        $retorno = false;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $stmt = $conexao->prepare(DmlSqlCampanhaCashback::UPD_CAMPANHA_CASHBACK_CACA_DT_TERMINO_PK);
        $stmt->bind_param(DmlSql::STRING_TYPE 
                            . DmlSql::STRING_TYPE
                            ,$dataTermino
                            ,$id);
        if ($stmt->execute())
        {
            $retorno = true;
        }

        return $retorno;
    }

    /**
    * updateObs() - implementação da assinatura em CampanhaCashbackDAO
    */
    public function updateObs($id, $obs)
    {   
        $retorno = false;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $stmt = $conexao->prepare(DmlSqlCampanhaCashback::UPD_CAMPANHA_CASHBACK_CACA_TX_OBS_PK);
        $stmt->bind_param(DmlSql::STRING_TYPE 
                            . DmlSql::STRING_TYPE
                            ,$obs
                            ,$id);
        if ($stmt->execute())
        {
            $retorno = true;
        }

        return $retorno;
    }

    /**
    * loadId_CampanhaStatus() - implementação da assinatura em CampanhaCashbackDAO
    */

    public function loadId_CampanhaStatus($id_campanha, $status)
    {   
        $retorno = NULL;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $res = $conexao->query(DmlSqlCampanhaCashback::SELECT 
        . ' WHERE ' . DmlSqlCampanhaCashback::CAMP_ID . '=' . $id_campanha 
        . ' AND ' . DmlSqlCampanhaCashback::CACA_IN_STATUS . " = '$status' " );

        if ($res){
            $retorno = $this->getDTO($res->fetch_assoc());
        }
        return $retorno;
    }

    /**
    * loadId_Campanha() - implementação da assinatura em CampanhaCashbackDAO
    */

    public function loadId_Campanha($id_campanha)
    {   
        $retorno = NULL;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        //var_dump(DmlSqlCampanhaCashback::SELECT . ' WHERE ' . DmlSqlCampanhaCashback::CAMP_ID . '=' . $id_campanha        );
        $res = $conexao->query(DmlSqlCampanhaCashback::SELECT . ' WHERE ' . DmlSqlCampanhaCashback::CAMP_ID . '=' . $id_campanha );
        if ($res){
            $retorno = $this->getDTO($res->fetch_assoc());
        }
        return $retorno;
    }



    /**
    * loadPercentual() - implementação da assinatura em CampanhaCashbackDAO
    */

    public function loadPercentual($percentual)
    {   
        $retorno = NULL;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $res = $conexao->query(DmlSqlCampanhaCashback::SELECT . ' WHERE ' . DmlSqlCampanhaCashback::CACA_VL_PERC_CASHBACK . '=' . $percentual );
        if ($res){
            $retorno = $this->getDTO($res->fetch_assoc());
        }
        return $retorno;
    }

    /**
    * loadDatatermino() - implementação da assinatura em CampanhaCashbackDAO
    */

    public function loadDatatermino($dataTermino)
    {   
        $retorno = NULL;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $res = $conexao->query(DmlSqlCampanhaCashback::SELECT . ' WHERE ' . DmlSqlCampanhaCashback::CACA_DT_TERMINO . '=' . $dataTermino );
        if ($res){
            $retorno = $this->getDTO($res->fetch_assoc());
        }
        return $retorno;
    }

    /**
    * loadObs() - implementação da assinatura em CampanhaCashbackDAO
    */

    public function loadObs($obs)
    {   
        $retorno = NULL;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $res = $conexao->query(DmlSqlCampanhaCashback::SELECT . ' WHERE ' . DmlSqlCampanhaCashback::CACA_TX_OBS . '=' . $obs );
        if ($res){
            $retorno = $this->getDTO($res->fetch_assoc());
        }
        return $retorno;
    }

/**
* loadStatus() - implementação da assinatura em CampanhaCashbackDAO
*/

    public function loadStatus($status)
    {   
        $retorno = NULL;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $res = $conexao->query(DmlSqlCampanhaCashback::SELECT . ' WHERE ' . DmlSqlCampanhaCashback::CACA_IN_STATUS . '=' . $status );
        if ($res){
            $retorno = $this->getDTO($res->fetch_assoc());
        }
        return $retorno;
    }

/**
 * loadDatacadastro() - implementação da assinatura em CampanhaCashbackDAO
*/

    public function loadDatacadastro($dataCadastro)
    {   
        $retorno = NULL;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $res = $conexao->query(DmlSqlCampanhaCashback::SELECT . ' WHERE ' . DmlSqlCampanhaCashback::CACA_DT_CADASTRO . '=' . $dataCadastro );
        if ($res){
            $retorno = $this->getDTO($res->fetch_assoc());
        }
        return $retorno;
    }

/**
 * loadDataatualizacao() - implementação da assinatura em CampanhaCashbackDAO
*/

    public function loadDataatualizacao($dataAtualizacao)
    {   
        $retorno = NULL;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $res = $conexao->query(DmlSqlCampanhaCashback::SELECT . ' WHERE ' . DmlSqlCampanhaCashback::CACA_DT_UPDATE . '=' . $dataAtualizacao );
        if ($res){
            $retorno = $this->getDTO($res->fetch_assoc());
        }
        return $retorno;
    }


}
?>




