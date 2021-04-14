<?php

/**
* MySqlKinghostFilaPublicidadeDAO - Implementação DAO
*
* Classe de com todos os comandos DML e DDL (se necessário) para apoio 
* a classe MySqlKinghostFilaPublicidadeDAO
* Não é uma camada visível para outros dispositivos, como as camadas de apresentação e aplicação. 
*
*
* Tabela principal de atuação: FILA_PUBLICIDADE
*
* Changelog:
*
* 
* @author Julio Cesar Vitorino
* @since 23/08/2019 10:06:20
*
*/
require_once 'FilaPublicidadeDTO.php';
require_once 'FilaPublicidadeDAO.php';
require_once 'DmlSqlFilaPublicidade.php';

require_once '../variavel/VariavelCache.php';
require_once '../daofactory/DmlSql.php';

class MySqlKinghostFilaPublicidadeDAO implements FilaPublicidadeDAO
{
    private $daofactory;

    function __construct($daofactory)
    {
        $this->daofactory = $daofactory;
    }


/**
* loadMaxId_Usua_PublicPK() - Carrega um MaxID (pk) para um ${CAMPO} e status
*
* @param $id_usua_public
* @param $status
* @return $dto
*/ 

    public function loadMaxId_Usua_PublicPK($id_usua_public,$status)
    {   
        $retorno = 0;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $sql = DmlSqlFilaPublicidade::SELECT_MAX_PK . ' WHERE ' 
        . DmlSqlFilaPublicidade::USPU_ID . " = $id_usua_public "
        . " AND " . DmlSqlFilaPublicidade::FIPU_IN_STATUS . " = '$status'";

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
* listAll() - Lista todos os registros provenientes de FILA_PUBLICIDADE sem critério de paginação
*
* @return List<FilaPublicidadeDTO>[]
*/ 
    public function listAll()   {   }

/**
* update() - atualiza apenas um registro com base no dto FilaPublicidadeDTO->id
* @param $daofactory
*
* @return boolean
*/ 
    public function update($dto)
    {   
        $retorno = false;

        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $stmt = $conexao->prepare(DmlSqlFilaPublicidade::UPD_PK);
        $stmt->bind_param(DmlSql::INTEGER_TYPE 
                            . DmlSql::INTEGER_TYPE 
                            . DmlSql::INTEGER_TYPE 
                            . DmlSql::INTEGER_TYPE 
                            ,$dto->id_usua_public
                            ,$dto->id_usuario
                            ,$dto->id_job
                            ,$dto->id );
        if ($stmt->execute())
        {
            $retorno = true;
        }

        return $retorno;
    }

/**
* delete() - excluir fisicamente um registro com base no dto FilaPublicidadeDTO->id
*
* @return boolean
*/ 
    public function delete($dto)
    {   
        $retorno = false;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $stmt = $conexao->prepare(DmlSqlFilaPublicidade::DEL_PK);
        $stmt->bind_param(DmlSql::INTEGER_TYPE
                            ,$dto->id);
        if ($stmt->execute())
        {
            $retorno = true;
        }

        return $retorno;
    }


    public function listFilaPublicidadeStatus($status)
    {
        $retorno = array();

        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $res = $conexao->query(DmlSqlFilaPublicidade::SELECT . 'WHERE `' . DmlSqlFilaPublicidade::FIPU_IN_STATUS . "` = '$status'" );
        if ($res){
            while ($row = $res->fetch_assoc()) {
                array_push($retorno, $this->getDTO($row));
            }
        }
        return $retorno;
    }

/**
* countFilaPublicidadePorStatus() - contar a quantidade de registros
* sob o contexto da classe FilaPublicidade com base no status específico. 
*
* Atenção em @see $sql na tabela FILA_PUBLICIDADE 
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

    public function countFilaPublicidadePorStatus($status)
    {   
        $retorno = 0;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $res = $conexao->query(DmlSqlFilaPublicidade::SQL_COUNT . ' WHERE ' 
        . DmlSqlFilaPublicidade::FIPU_IN_STATUS . " = '$status'"
        );
        if ($res){
            $tmp = $res->fetch_assoc();
            $retorno = $tmp['contador'];
        }
        return $retorno;

    }

/**
* listFilaPublicidadePorStatus() - Listar um conjunto de registro previamente paginado
* sob o contexto da classe FilaPublicidade com base no status específico.
*
* Atenção em @see $sql na tabela FILA_PUBLICIDADE 
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

    public function listFilaPublicidadePorStatus($status, $pag, $qtde, $coluna, $ordem)
    {
        $sql = DmlSqlFilaPublicidade::SELECT 
        . ' WHERE ' . DmlSqlFilaPublicidade::FIPU_IN_STATUS . " = '$status'"
        . ' ORDER BY ' . $coluna . ($ordem == 0 ? " ASC": " DESC");
        return $this->listPagina($sql, $pag, $qtde);
    }

/**
* countFilaPublicidadePorUsuaIdStatus() - contar a quantidade de registros
* sob o contexto da classe FilaPublicidade com base no usuário específico. Esse usuário
* é o usuário logado na sessão ou no próprio dispositivo móvel e de acordo com a 
* query em @see $sql na tabela FILA_PUBLICIDADE 
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

    public function countFilaPublicidadePorUsuaIdStatus($usuaid, $status)
    {   
        $retorno = 0;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $res = $conexao->query(DmlSqlFilaPublicidade::SQL_COUNT . ' WHERE ' 
        . DmlSqlFilaPublicidade::USUA_ID . " = $usuaid "
        . ' AND ' . DmlSqlFilaPublicidade::FIPU_IN_STATUS . " = '$status'"
        );
        if ($res){
            $tmp = $res->fetch_assoc();
            $retorno = $tmp['contador'];
        }
        return $retorno;

    }

/**
* listFilaPublicidadePorUsuaIdStatus() - Listar um conjunto de registro previamente paginado
* sob o contexto da classe FilaPublicidade com base no usuário específico. Esse usuário
* é o usuário logado na sessão ou no próprio dispositivo móvel e de acordo com a 
* query em @see $sql na tabela FILA_PUBLICIDADE 
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
    public function listFilaPublicidadePorUsuaIdStatus($usuaid, $status, $pag, $qtde, $coluna, $ordem)
    {
        $sql = DmlSqlFilaPublicidade::SELECT 
        . ' WHERE ' . DmlSqlFilaPublicidade::USUA_ID . " = $usuaid "
        . ' AND ' . DmlSqlFilaPublicidade::FIPU_IN_STATUS . " = '$status'"
        . ' ORDER BY ' . $coluna . ($ordem == 0 ? " ASC": " DESC");
        return $this->listPagina($sql, $pag, $qtde);
    }

/**
* listPagina() - Listar um conjunto de registro previamente paginado
* e de acordo com a query em @see $sql na tabela FILA_PUBLICIDADE 
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
* na tabela FILA_PUBLICIDADE usando a Primary Key FIPU_ID
*
* @param $id
* @return FilaPublicidadeDTO
*/ 
    public function loadPK($id)
    {   
        $retorno = NULL;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $res = $conexao->query(DmlSqlFilaPublicidade::SELECT . ' WHERE ' . DmlSqlFilaPublicidade::FIPU_ID . '=' . $id );
        if ($res){
            $retorno = $this->getDTO($res->fetch_assoc());
        }
        return $retorno;
    }

/**
* updateStatus() - atualizar o campo de STATUS utilizando a id como item de busca
* na tabela FILA_PUBLICIDADE usando a Primary Key FIPU_ID
*
* @param $id
* @param $status
*
* @return FilaPublicidadeDTO
*/ 
    public function updateStatus($id, $status)
    {   
        $retorno = false;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $stmt = $conexao->prepare(DmlSqlFilaPublicidade::UPD_STATUS);
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
* insert() - inserir um registro com base no FilaPublicidadeDTO. Alguns atributos dentro do DTO
* serão ignorados caso estejam populados, pois os mesmos possuem constraint de DEFAULT value
* ou campos de AUTO INCREMENTO já previamente definidos no DDL de criação de tabelas do BD.
*
* Atributos da classe FilaPublicidadeDTO sumariamente IGNORADOS por este método MESMO que estejam preenchidos:
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
        $stmt = $conexao->prepare(DmlSqlFilaPublicidade::INS);
        $stmt->bind_param(DmlSql::INTEGER_TYPE 
                            . DmlSql::INTEGER_TYPE 
                            . DmlSql::INTEGER_TYPE 
                            ,$dto->id_usua_public
                            ,$dto->id_usuario
                            ,$dto->id_job
        );
        if ($stmt->execute())
        {
            $retorno = true;
        }

        return $retorno;
    }

    /**
     * getDTO() - Transforma o resultset padrão em FilaPublicidadeDTO
    */
    public function getDTO($resultset)
    {
        //echo var_dump($resultset); // ótimo pra debugar
        $retorno = new FilaPublicidadeDTO();
        $retorno->id = $resultset[DmlSqlFilaPublicidade::FIPU_ID] == NULL ? NULL : (int) $resultset[DmlSqlFilaPublicidade::FIPU_ID];
        $retorno->id_usua_public = $resultset[DmlSqlFilaPublicidade::USPU_ID] == NULL ? NULL : (int) $resultset[DmlSqlFilaPublicidade::USPU_ID];
        $retorno->id_usuario = $resultset[DmlSqlFilaPublicidade::USUA_ID] == NULL ? NULL : (int) $resultset[DmlSqlFilaPublicidade::USUA_ID];
        $retorno->id_job = $resultset[DmlSqlFilaPublicidade::JOBS_ID] == NULL ? NULL : (int) $resultset[DmlSqlFilaPublicidade::JOBS_ID];
        $retorno->status = $resultset[DmlSqlFilaPublicidade::FIPU_IN_STATUS] == NULL ? NULL : $resultset[DmlSqlFilaPublicidade::FIPU_IN_STATUS];
        $retorno->dataCadastro = Util::MySQLDate_to_DMYHMiS($resultset[DmlSqlFilaPublicidade::FIPU_DT_CADASTRO]);
        $retorno->dataAtualizacao = Util::MySQLDate_to_DMYHMiS($resultset[DmlSqlFilaPublicidade::FIPU_DT_UPDATE]);
        $retorno->statusdesc = VariavelCache::getInstance()->getStatusDesc($retorno->status);
        return $retorno;

    }

    /**
    * updateId_Usua_Public() - implementação da assinatura em FilaPublicidadeDAO
    */
    public function updateId_Usua_Public($id, $id_usua_public)
    {   
        $retorno = false;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $stmt = $conexao->prepare(DmlSqlFilaPublicidade::UPD_FILA_PUBLICIDADE_USPU_ID_PK);
        $stmt->bind_param(DmlSql::INTEGER_TYPE 
                            . DmlSql::INTEGER_TYPE
                            ,$id_usua_public
                            ,$id);
        if ($stmt->execute())
        {
            $retorno = true;
        }

        return $retorno;
    }

    /**
    * updateId_Usuario() - implementação da assinatura em FilaPublicidadeDAO
    */
    public function updateId_Usuario($id, $id_usuario)
    {   
        $retorno = false;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $stmt = $conexao->prepare(DmlSqlFilaPublicidade::UPD_FILA_PUBLICIDADE_USUA_ID_PK);
        $stmt->bind_param(DmlSql::INTEGER_TYPE 
                            . DmlSql::INTEGER_TYPE
                            ,$id_usuario
                            ,$id);
        if ($stmt->execute())
        {
            $retorno = true;
        }

        return $retorno;
    }

    /**
    * updateId_Job() - implementação da assinatura em FilaPublicidadeDAO
    */
    public function updateId_Job($id, $id_job)
    {   
        $retorno = false;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $stmt = $conexao->prepare(DmlSqlFilaPublicidade::UPD_FILA_PUBLICIDADE_JOBS_ID_PK);
        $stmt->bind_param(DmlSql::INTEGER_TYPE 
                            . DmlSql::INTEGER_TYPE
                            ,$id_job
                            ,$id);
        if ($stmt->execute())
        {
            $retorno = true;
        }

        return $retorno;
    }

    /**
    * loadId_Usua_Public() - implementação da assinatura em FilaPublicidadeDAO
    */

    public function loadId_Usua_Public($id_usua_public)
    {   
        $retorno = NULL;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $res = $conexao->query(DmlSqlFilaPublicidade::SELECT . ' WHERE ' . DmlSqlFilaPublicidade::USPU_ID . '=' . $id_usua_public );
        if ($res){
            $retorno = $this->getDTO($res->fetch_assoc());
        }
        return $retorno;
    }

    /**
    * loadId_Usuario() - implementação da assinatura em FilaPublicidadeDAO
    */

    public function loadId_Usuario($id_usuario)
    {   
        $retorno = NULL;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $res = $conexao->query(DmlSqlFilaPublicidade::SELECT . ' WHERE ' . DmlSqlFilaPublicidade::USUA_ID . '=' . $id_usuario );
        if ($res){
            $retorno = $this->getDTO($res->fetch_assoc());
        }
        return $retorno;
    }

    /**
    * loadId_Job() - implementação da assinatura em FilaPublicidadeDAO
    */

    public function loadId_Job($id_job)
    {   
        $retorno = NULL;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $res = $conexao->query(DmlSqlFilaPublicidade::SELECT . ' WHERE ' . DmlSqlFilaPublicidade::JOBS_ID . '=' . $id_job );
        if ($res){
            $retorno = $this->getDTO($res->fetch_assoc());
        }
        return $retorno;
    }

    /**
    * loadStatus() - implementação da assinatura em FilaPublicidadeDAO
    */

    public function loadStatus($status)
    {   
        $retorno = NULL;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $res = $conexao->query(DmlSqlFilaPublicidade::SELECT . ' WHERE ' . DmlSqlFilaPublicidade::FIPU_IN_STATUS . '=' . $status );
        if ($res){
            $retorno = $this->getDTO($res->fetch_assoc());
        }
        return $retorno;
    }

    /**
    * loadDatacadastro() - implementação da assinatura em FilaPublicidadeDAO
    */

    public function loadDatacadastro($dataCadastro)
    {   
        $retorno = NULL;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $res = $conexao->query(DmlSqlFilaPublicidade::SELECT . ' WHERE ' . DmlSqlFilaPublicidade::FIPU_DT_CADASTRO . '=' . $dataCadastro );
        if ($res){
            $retorno = $this->getDTO($res->fetch_assoc());
        }
        return $retorno;
    }

    /**
    * loadDataatualizacao() - implementação da assinatura em FilaPublicidadeDAO
    */

    public function loadDataatualizacao($dataAtualizacao)
    {   
        $retorno = NULL;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $res = $conexao->query(DmlSqlFilaPublicidade::SELECT . ' WHERE ' . DmlSqlFilaPublicidade::FIPU_DT_UPDATE . '=' . $dataAtualizacao );
        if ($res){
            $retorno = $this->getDTO($res->fetch_assoc());
        }
        return $retorno;
    }

}
?>
