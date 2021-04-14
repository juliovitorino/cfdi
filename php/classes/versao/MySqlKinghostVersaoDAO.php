<?php

/**
* MySqlKinghostVersaoDAO - Implementação DAO
*
* Classe de com todos os comandos DML e DDL (se necessário) para apoio 
* a classe MySqlKinghostVersaoDAO
* Não é uma camada visível para outros dispositivos, como as camadas de apresentação e aplicação. 
*
*
* Tabela principal de atuação: VERSAO
*
* Changelog:
*
* 
* @author Julio Cesar Vitorino
* @since 23/08/2019 10:06:20
*
*/
require_once 'VersaoDTO.php';
require_once 'VersaoDAO.php';
require_once 'DmlSqlVersao.php';

require_once '../variavel/VariavelCache.php';
require_once '../daofactory/DmlSql.php';

class MySqlKinghostVersaoDAO implements VersaoDAO
{
    private $daofactory;

    function __construct($daofactory)
    {
        $this->daofactory = $daofactory;
    }

/**
* loadMaxPK() - Carrega um MaxID (pk) para um ${CAMPO} e status
*
* @param $versao
* @return $dto
*/ 

public function loadMaxPK()
{   
    $retorno = 0;
    // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
    $conexao = $this->daofactory->getSession();
    $sql = DmlSqlVersao::SELECT_MAX_PK;
    
    $res = $conexao->query($sql);
    if ($res){
        $tmp = $res->fetch_assoc();
        $retorno = $tmp['maxid'] == NULL ? 0 : $tmp['maxid'];
    }
    return $retorno;

}

/**
* loadMaxSoVersaoPK() - Carrega um MaxID (pk) para um ${CAMPO} e status
*
* @param $versao
* @return $dto
*/ 

public function loadMaxSoVersaoPK($versao)
{   
    $retorno = 0;
    // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
    $conexao = $this->daofactory->getSession();
    $sql = DmlSqlVersao::SELECT_MAX_PK . ' WHERE ' 
    . DmlSqlVersao::VERS_TX_VERSAO . " = '$versao' ";
    
    $res = $conexao->query($sql);
    if ($res){
        $tmp = $res->fetch_assoc();
        $retorno = $tmp['maxid'] == NULL ? 0 : $tmp['maxid'];
    }
    return $retorno;

}



/**
* loadMaxVersaoPK() - Carrega um MaxID (pk) para um ${CAMPO} e status
*
* @param $versao
* @param $status
* @return $dto
*/ 

    public function loadMaxVersaoPK($versao,$status)
    {   
        $retorno = 0;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $sql = DmlSqlVersao::SELECT_MAX_PK . ' WHERE ' 
        . DmlSqlVersao::VERS_TX_VERSAO . " = $versao "
        . " AND " . DmlSqlVersao::VERS_IN_STATUS . " = '$status'";

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
* listAll() - Lista todos os registros provenientes de VERSAO sem critério de paginação
*
* @return List<VersaoDTO>[]
*/ 
    public function listAll()   {   }

/**
* update() - atualiza apenas um registro com base no dto VersaoDTO->id
* @param $daofactory
*
* @return boolean
*/ 
    public function update($dto)
    {   
        $retorno = false;

        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $stmt = $conexao->prepare(DmlSqlVersao::UPD_PK);
        $stmt->bind_param(DmlSql::STRING_TYPE 
                            . DmlSql::INTEGER_TYPE 
                            ,$dto->versao
                            ,$dto->id );
        if ($stmt->execute())
        {
            $retorno = true;
        }

        return $retorno;
    }

/**
* delete() - excluir fisicamente um registro com base no dto VersaoDTO->id
*
* @return boolean
*/ 
    public function delete($dto)
    {   
        $retorno = false;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $stmt = $conexao->prepare(DmlSqlVersao::DEL_PK);
        $stmt->bind_param(DmlSql::INTEGER_TYPE
                            ,$dto->id);
        if ($stmt->execute())
        {
            $retorno = true;
        }

        return $retorno;
    }


    public function listVersaoStatus($status)
    {
        $retorno = array();

        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $res = $conexao->query(DmlSqlVersao::SELECT . 'WHERE `' . DmlSqlVersao::VERS_IN_STATUS . "` = '$status'" );
        if ($res){
            while ($row = $res->fetch_assoc()) {
                array_push($retorno, $this->getDTO($row));
            }
        }
        return $retorno;
    }

/**
* countVersaoPorStatus() - contar a quantidade de registros
* sob o contexto da classe Versao com base no status específico. 
*
* Atenção em @see $sql na tabela VERSAO 
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

    public function countVersaoPorStatus($status)
    {   
        $retorno = 0;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $res = $conexao->query(DmlSqlVersao::SQL_COUNT . ' WHERE ' 
        . DmlSqlVersao::VERS_IN_STATUS . " = '$status'"
        );
        if ($res){
            $tmp = $res->fetch_assoc();
            $retorno = $tmp['contador'];
        }
        return $retorno;

    }

/**
* listVersaoPorStatus() - Listar um conjunto de registro previamente paginado
* sob o contexto da classe Versao com base no status específico.
*
* Atenção em @see $sql na tabela VERSAO 
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

    public function listVersaoPorStatus($status, $pag, $qtde, $coluna, $ordem)
    {
        $sql = DmlSqlVersao::SELECT 
        . ' WHERE ' . DmlSqlVersao::VERS_IN_STATUS . " = '$status'"
        . ' ORDER BY ' . $coluna . ($ordem == 0 ? " ASC": " DESC");
        return $this->listPagina($sql, $pag, $qtde);
    }

/**
* countVersaoPorUsuaIdStatus() - contar a quantidade de registros
* sob o contexto da classe Versao com base no usuário específico. Esse usuário
* é o usuário logado na sessão ou no próprio dispositivo móvel e de acordo com a 
* query em @see $sql na tabela VERSAO 
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

    public function countVersaoPorUsuaIdStatus($usuaid, $status)
    {   
        $retorno = 0;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $res = $conexao->query(DmlSqlVersao::SQL_COUNT . ' WHERE ' 
        . DmlSqlVersao::USUA_ID . " = $usuaid "
        . ' AND ' . DmlSqlVersao::VERS_IN_STATUS . " = '$status'"
        );
        if ($res){
            $tmp = $res->fetch_assoc();
            $retorno = $tmp['contador'];
        }
        return $retorno;

    }

/**
* listVersaoPorUsuaIdStatus() - Listar um conjunto de registro previamente paginado
* sob o contexto da classe Versao com base no usuário específico. Esse usuário
* é o usuário logado na sessão ou no próprio dispositivo móvel e de acordo com a 
* query em @see $sql na tabela VERSAO 
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
    public function listVersaoPorUsuaIdStatus($usuaid, $status, $pag, $qtde, $coluna, $ordem)
    {
        $sql = DmlSqlVersao::SELECT 
        . ' WHERE ' . DmlSqlVersao::USUA_ID . " = $usuaid "
        . ' AND ' . DmlSqlVersao::VERS_IN_STATUS . " = '$status'"
        . ' ORDER BY ' . $coluna . ($ordem == 0 ? " ASC": " DESC");
        return $this->listPagina($sql, $pag, $qtde);
    }

/**
* listPagina() - Listar um conjunto de registro previamente paginado
* e de acordo com a query em @see $sql na tabela VERSAO 
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
* na tabela VERSAO usando a Primary Key VERS_ID
*
* @param $id
* @return VersaoDTO
*/ 
    public function loadPK($id)
    {   
        $retorno = NULL;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $res = $conexao->query(DmlSqlVersao::SELECT . ' WHERE ' . DmlSqlVersao::VERS_ID . '=' . $id );
        if ($res){
            $retorno = $this->getDTO($res->fetch_assoc());
        }
        return $retorno;
    }

/**
* updateStatus() - atualizar o campo de STATUS utilizando a id como item de busca
* na tabela VERSAO usando a Primary Key VERS_ID
*
* @param $id
* @param $status
*
* @return VersaoDTO
*/ 
    public function updateStatus($id, $status)
    {   
        $retorno = false;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $stmt = $conexao->prepare(DmlSqlVersao::UPD_STATUS);
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
* insert() - inserir um registro com base no VersaoDTO. Alguns atributos dentro do DTO
* serão ignorados caso estejam populados, pois os mesmos possuem constraint de DEFAULT value
* ou campos de AUTO INCREMENTO já previamente definidos no DDL de criação de tabelas do BD.
*
* Atributos da classe VersaoDTO sumariamente IGNORADOS por este método MESMO que estejam preenchidos:
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
        $stmt = $conexao->prepare(DmlSqlVersao::INS);
        $stmt->bind_param(DmlSql::STRING_TYPE 
                            ,$dto->versao
        );
        if ($stmt->execute())
        {
            $retorno = true;
        }

        return $retorno;
    }

    /**
     * getDTO() - Transforma o resultset padrão em VersaoDTO
    */
    public function getDTO($resultset)
    {
        //echo var_dump($resultset); // ótimo pra debugar
        $retorno = new VersaoDTO();
        $retorno->id = $resultset[DmlSqlVersao::VERS_ID] == NULL ? NULL : (int) $resultset[DmlSqlVersao::VERS_ID];
        $retorno->versao = $resultset[DmlSqlVersao::VERS_TX_VERSAO] == NULL ? NULL : $resultset[DmlSqlVersao::VERS_TX_VERSAO];
        $retorno->status = $resultset[DmlSqlVersao::VERS_IN_STATUS] == NULL ? NULL : $resultset[DmlSqlVersao::VERS_IN_STATUS];
        $retorno->dataCadastro = Util::MySQLDate_to_DMYHMiS($resultset[DmlSqlVersao::VERS_DT_CADASTRO]);
        $retorno->dataAtualizacao = Util::MySQLDate_to_DMYHMiS($resultset[DmlSqlVersao::VERS_DT_UPDATE]);
        $retorno->statusdesc = VariavelCache::getInstance()->getStatusDesc($retorno->status);
        return $retorno;

    }

    /**
    * updateVersao() - implementação da assinatura em VersaoDAO
    */
    public function updateVersao($id, $versao)
    {   
        $retorno = false;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $stmt = $conexao->prepare(DmlSqlVersao::UPD_VERSAO_VERS_TX_VERSAO_PK);
        $stmt->bind_param(DmlSql::STRING_TYPE 
                            . DmlSql::STRING_TYPE
                            ,$versao
                            ,$id);
        if ($stmt->execute())
        {
            $retorno = true;
        }

        return $retorno;
    }

    /**
    * loadVersao() - implementação da assinatura em VersaoDAO
    */

    public function loadVersao($versao)
    {   
        $retorno = NULL;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $res = $conexao->query(DmlSqlVersao::SELECT . ' WHERE ' . DmlSqlVersao::VERS_TX_VERSAO . '=' . $versao );
        if ($res){
            $retorno = $this->getDTO($res->fetch_assoc());
        }
        return $retorno;
    }


    /**
    * loadStatus() - implementação da assinatura em VersaoDAO
    */

    public function loadStatus($status)
    {   
        $retorno = NULL;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $res = $conexao->query(DmlSqlVersao::SELECT . ' WHERE ' . DmlSqlVersao::VERS_IN_STATUS . '=' . $status );
        if ($res){
            $retorno = $this->getDTO($res->fetch_assoc());
        }
        return $retorno;
    }

    /**
    * loadDatacadastro() - implementação da assinatura em VersaoDAO
    */

    public function loadDatacadastro($dataCadastro)
    {   
        $retorno = NULL;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $res = $conexao->query(DmlSqlVersao::SELECT . ' WHERE ' . DmlSqlVersao::VERS_DT_CADASTRO . '=' . $dataCadastro );
        if ($res){
            $retorno = $this->getDTO($res->fetch_assoc());
        }
        return $retorno;
    }

    /**
    * loadDataatualizacao() - implementação da assinatura em VersaoDAO
    */

    public function loadDataatualizacao($dataAtualizacao)
    {   
        $retorno = NULL;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $res = $conexao->query(DmlSqlVersao::SELECT . ' WHERE ' . DmlSqlVersao::VERS_DT_UPDATE . '=' . $dataAtualizacao );
        if ($res){
            $retorno = $this->getDTO($res->fetch_assoc());
        }
        return $retorno;
    }

}
?>
