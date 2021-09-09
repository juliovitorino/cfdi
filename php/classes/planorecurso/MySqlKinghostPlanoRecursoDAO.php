<?php

/**
* MySqlKinghostPlanoRecursoDAO - Implementação DAO
*
* Classe de com todos os comandos DML e DDL (se necessário) para apoio 
* a classe MySqlKinghostPlanoRecursoDAO
* Não é uma camada visível para outros dispositivos, como as camadas de apresentação e aplicação. 
*
*
* Tabela principal de atuação: PLANO_RECURSO
*
* Changelog:
*
* 
* @author Julio Cesar Vitorino
* @since 23/08/2019 10:06:20
*
*/
require_once 'PlanoRecursoDTO.php';
require_once 'PlanoRecursoDAO.php';
require_once 'DmlSqlPlanoRecurso.php';

require_once '../mensagem/ConstantesMensagem.php';
require_once '../mensagem/MensagemCache.php';
require_once '../variavel/VariavelCache.php';
require_once '../daofactory/DmlSql.php';

class MySqlKinghostPlanoRecursoDAO implements PlanoRecursoDAO
{
    private $daofactory;

    function __construct($daofactory)
    {
        $this->daofactory = $daofactory;
    }


/**
* loadMaxIdplanoPK() - Carrega um MaxID (pk) para um ${CAMPO} e status
*
* @param $idplano
* @param $status
* @return $dto
*/ 

    public function loadMaxIdplanoPK($idplano,$status)
    {   
        $retorno = 0;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $sql = DmlSqlPlanoRecurso::SELECT_MAX_PK . ' WHERE ' 
        . DmlSqlPlanoRecurso::PLAN_ID . " = $idplano "
        . " AND " . DmlSqlPlanoRecurso::PLRE_IN_STATUS . " = '$status'";

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
* listAll() - Lista todos os registros provenientes de PLANO_RECURSO sem critério de paginação
*
* @return List<PlanoRecursoDTO>[]
*/ 
    public function listAll()   {   }

/**
* update() - atualiza apenas um registro com base no dto PlanoRecursoDTO->id
* @param $daofactory
*
* @return boolean
*/ 
    public function update($dto)
    {   
        $retorno = false;

        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $stmt = $conexao->prepare(DmlSqlPlanoRecurso::UPD_PK);
        $stmt->bind_param(DmlSql::INTEGER_TYPE 
                            . DmlSql::INTEGER_TYPE 
                            . DmlSql::INTEGER_TYPE 
                            ,$dto->idplano
                            ,$dto->idrecurso
                            ,$dto->id );
        if ($stmt->execute())
        {
            $retorno = true;
        }

        return $retorno;
    }

/**
* delete() - excluir fisicamente um registro com base no dto PlanoRecursoDTO->id
*
* @return boolean
*/ 
    public function delete($dto)
    {   
        $retorno = false;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $stmt = $conexao->prepare(DmlSqlPlanoRecurso::DEL_PK);
        $stmt->bind_param(DmlSql::INTEGER_TYPE
                            ,$dto->id);
        if ($stmt->execute())
        {
            $retorno = true;
        }

        return $retorno;
    }


    public function listPlanoRecursoStatus($status)
    {
        $retorno = array();

        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $res = $conexao->query(DmlSqlPlanoRecurso::SELECT . 'WHERE `' . DmlSqlPlanoRecurso::PLRE_IN_STATUS . "` = '$status'" );
        if ($res){
            while ($row = $res->fetch_assoc()) {
                array_push($retorno, $this->getDTO($row));
            }
        }
        return $retorno;
    }

/**
* countPlanoRecursoPorStatus() - contar a quantidade de registros
* sob o contexto da classe PlanoRecurso com base no status específico. 
*
* Atenção em @see $sql na tabela PLANO_RECURSO 
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

    public function countPlanoRecursoPorStatus($status)
    {   
        $retorno = 0;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $res = $conexao->query(DmlSqlPlanoRecurso::SQL_COUNT . ' WHERE ' 
        . DmlSqlPlanoRecurso::PLRE_IN_STATUS . " = '$status'"
        );
        if ($res){
            $tmp = $res->fetch_assoc();
            $retorno = $tmp['contador'];
        }
        return $retorno;

    }

/**
* listPlanoRecursoPorStatus() - Listar um conjunto de registro previamente paginado
* sob o contexto da classe PlanoRecurso com base no status específico.
*
* Atenção em @see $sql na tabela PLANO_RECURSO 
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

    public function listPlanoRecursoPorStatus($status, $pag, $qtde, $coluna, $ordem)
    {
        $sql = DmlSqlPlanoRecurso::SELECT 
        . ' WHERE ' . DmlSqlPlanoRecurso::PLRE_IN_STATUS . " = '$status'"
        . ' ORDER BY ' . $coluna . ($ordem == 0 ? " ASC": " DESC");
        return $this->listPagina($sql, $pag, $qtde);
    }

/**
* countPlanoRecursoPorUsuaIdStatus() - contar a quantidade de registros
* sob o contexto da classe PlanoRecurso com base no usuário específico. Esse usuário
* é o usuário logado na sessão ou no próprio dispositivo móvel e de acordo com a 
* query em @see $sql na tabela PLANO_RECURSO 
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

    public function countPlanoRecursoPorUsuaIdStatus($usuaid, $status)
    {   
        $retorno = 0;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $res = $conexao->query(DmlSqlPlanoRecurso::SQL_COUNT . ' WHERE ' 
        . DmlSqlPlanoRecurso::USUA_ID . " = $usuaid "
        . ' AND ' . DmlSqlPlanoRecurso::PLRE_IN_STATUS . " = '$status'"
        );
        if ($res){
            $tmp = $res->fetch_assoc();
            $retorno = $tmp['contador'];
        }
        return $retorno;

    }

/**
* listPlanoRecursoPorUsuaIdStatus() - Listar um conjunto de registro previamente paginado
* sob o contexto da classe PlanoRecurso com base no usuário específico. Esse usuário
* é o usuário logado na sessão ou no próprio dispositivo móvel e de acordo com a 
* query em @see $sql na tabela PLANO_RECURSO 
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
    public function listPlanoRecursoPorUsuaIdStatus($usuaid, $status, $pag, $qtde, $coluna, $ordem)
    {
        $sql = DmlSqlPlanoRecurso::SELECT 
        . ' WHERE ' . DmlSqlPlanoRecurso::USUA_ID . " = $usuaid "
        . ' AND ' . DmlSqlPlanoRecurso::PLRE_IN_STATUS . " = '$status'"
        . ' ORDER BY ' . $coluna . ($ordem == 0 ? " ASC": " DESC");
        return $this->listPagina($sql, $pag, $qtde);
    }


/**
* countPlanoRecursoPorIdplanoStatus() - contar a quantidade de registros
* sob o contexto da classe PlanoRecurso com base no usuário específico. Esse usuário
* é o usuário logado na sessão ou no próprio dispositivo móvel e de acordo com a 
* query em @see $sql na tabela PLANO_RECURSO 
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

    public function countPlanoRecursoPorIdplanoStatus($idplano, $status)
    {   
        $retorno = 0;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $sql = DmlSqlPlanoRecurso::SQL_COUNT . ' WHERE ' 
        . DmlSqlPlanoRecurso::PLAN_ID . " = $idplano "
        . ' AND ' . DmlSqlPlanoRecurso::PLRE_IN_STATUS . " = '$status'";
        //var_dump($sql);
        $res = $conexao->query($sql);
        if ($res){
            $tmp = $res->fetch_assoc();
            $retorno = $tmp['contador'];
        }
        return $retorno;

    }

/**
* listPlanoRecursoPorUsuaIdStatus() - Listar um conjunto de registro previamente paginado
* sob o contexto da classe PlanoRecurso com base no usuário específico. Esse usuário
* é o usuário logado na sessão ou no próprio dispositivo móvel e de acordo com a 
* query em @see $sql na tabela PLANO_RECURSO 
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
    public function listPlanoRecursoPorIdplanoStatus($idplano, $status, $pag, $qtde, $coluna, $ordem)
    {
        $sql = DmlSqlPlanoRecurso::SELECT 
        . ' WHERE ' . DmlSqlPlanoRecurso::PLAN_ID . " = $idplano "
        . ' AND ' . DmlSqlPlanoRecurso::PLRE_IN_STATUS . " = '$status'"
        . ' ORDER BY ' . $coluna . ($ordem == 0 ? " ASC": " DESC");
        return $this->listPagina($sql, $pag, $qtde);
    }

/**
* listPagina() - Listar um conjunto de registro previamente paginado
* e de acordo com a query em @see $sql na tabela PLANO_RECURSO 
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
* na tabela PLANO_RECURSO usando a Primary Key PLRE_ID
*
* @param $id
* @return PlanoRecursoDTO
*/ 
    public function loadPK($id)
    {   
        $retorno = NULL;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $res = $conexao->query(DmlSqlPlanoRecurso::SELECT . ' WHERE ' . DmlSqlPlanoRecurso::PLRE_ID . '=' . $id );
        if ($res->num_rows > 0){
            $retorno = $this->getDTO($res->fetch_assoc());
        }
        return $retorno;
    }

/**
* updateStatus() - atualizar o campo de STATUS utilizando a id como item de busca
* na tabela PLANO_RECURSO usando a Primary Key PLRE_ID
*
* @param $id
* @param $status
*
* @return PlanoRecursoDTO
*/ 
    public function updateStatus($id, $status)
    {   
        $retorno = false;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $stmt = $conexao->prepare(DmlSqlPlanoRecurso::UPD_STATUS);
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
* insert() - inserir um registro com base no PlanoRecursoDTO. Alguns atributos dentro do DTO
* serão ignorados caso estejam populados, pois os mesmos possuem constraint de DEFAULT value
* ou campos de AUTO INCREMENTO já previamente definidos no DDL de criação de tabelas do BD.
*
* Atributos da classe PlanoRecursoDTO sumariamente IGNORADOS por este método MESMO que estejam preenchidos:
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
        $stmt = $conexao->prepare(DmlSqlPlanoRecurso::INS);
        $stmt->bind_param(DmlSql::INTEGER_TYPE 
                            . DmlSql::INTEGER_TYPE 
                            ,$dto->idplano
                            ,$dto->idrecurso
        );
        if ($stmt->execute())
        {
            $retorno = true;
        }

        return $retorno;
    }

    /**
     * getDTO() - Transforma o resultset padrão em PlanoRecursoDTO
    */
    public function getDTO($resultset)
    {
        if(is_null($resultset)){
            return NULL;
        }

        //echo var_dump($resultset); // ótimo pra debugar
        $retorno = new PlanoRecursoDTO();
        $retorno->id = $resultset[DmlSqlPlanoRecurso::PLRE_ID] == NULL ? NULL : $resultset[DmlSqlPlanoRecurso::PLRE_ID];
        $retorno->idplano = $resultset[DmlSqlPlanoRecurso::PLAN_ID] == NULL ? NULL : $resultset[DmlSqlPlanoRecurso::PLAN_ID];
        $retorno->idrecurso = $resultset[DmlSqlPlanoRecurso::RECU_ID] == NULL ? NULL : $resultset[DmlSqlPlanoRecurso::RECU_ID];
        $retorno->status = $resultset[DmlSqlPlanoRecurso::PLRE_IN_STATUS] == NULL ? NULL : $resultset[DmlSqlPlanoRecurso::PLRE_IN_STATUS];
        $retorno->dataCadastro = Util::MySQLDate_to_DMYHMiS($resultset[DmlSqlPlanoRecurso::PLRE_DT_CADASTRO]);
        $retorno->dataAtualizacao = Util::MySQLDate_to_DMYHMiS($resultset[DmlSqlPlanoRecurso::PLRE_DT_UPDATE]);
        $retorno->statusdesc = VariavelCache::getInstance()->getStatusDesc($retorno->status);
        $retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
        $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);
        return $retorno;

    }

    /**
    * updateIdplano() - implementação da assinatura em PlanoRecursoDAO
    */
    public function updateIdplano($id, $idplano)
    {   
        $retorno = false;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $stmt = $conexao->prepare(DmlSqlPlanoRecurso::UPD_PLANO_RECURSO_PLAN_ID_PK);
        $stmt->bind_param(DmlSql::INTEGER_TYPE 
                            . DmlSql::INTEGER_TYPE
                            ,$idplano
                            ,$id);
        if ($stmt->execute())
        {
            $retorno = true;
        }

        return $retorno;
    }

    /**
    * updateIdrecurso() - implementação da assinatura em PlanoRecursoDAO
    */
    public function updateIdrecurso($id, $idrecurso)
    {   
        $retorno = false;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $stmt = $conexao->prepare(DmlSqlPlanoRecurso::UPD_PLANO_RECURSO_RECU_ID_PK);
        $stmt->bind_param(DmlSql::INTEGER_TYPE 
                            . DmlSql::INTEGER_TYPE
                            ,$idrecurso
                            ,$id);
        if ($stmt->execute())
        {
            $retorno = true;
        }

        return $retorno;
    }

    /**
    * loadIdplano() - implementação da assinatura em PlanoRecursoDAO
    */

    public function loadIdplano($idplano)
    {   
        $retorno = NULL;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $sql = DmlSqlPlanoRecurso::SELECT . ' WHERE ' . DmlSqlPlanoRecurso::PLAN_ID . '=' . $idplano;
        $res = $conexao->query($sql);
        if ($res){
            $retorno = $this->getDTO($res->fetch_assoc());
        }
        return $retorno;
    }
    /**
    * loadIdrecurso() - implementação da assinatura em PlanoRecursoDAO
    */

    public function loadIdrecurso($idrecurso)
    {   
        $retorno = NULL;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $sql = DmlSqlPlanoRecurso::SELECT . ' WHERE ' . DmlSqlPlanoRecurso::RECU_ID . '=' . $idrecurso;
        $res = $conexao->query($sql);
        if ($res){
            $retorno = $this->getDTO($res->fetch_assoc());
        }
        return $retorno;
    }
    /**
    * loadStatus() - implementação da assinatura em PlanoRecursoDAO
    */

    public function loadStatus($status)
    {   
        $retorno = NULL;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $res = $conexao->query(DmlSqlPlanoRecurso::SELECT . ' WHERE ' . DmlSqlPlanoRecurso::PLRE_IN_STATUS . '=' . $status );
        if ($res){
            $retorno = $this->getDTO($res->fetch_assoc());
        }
        return $retorno;
    }

    /**
    * loadDatacadastro() - implementação da assinatura em PlanoRecursoDAO
    */

    public function loadDatacadastro($dataCadastro)
    {   
        $retorno = NULL;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $res = $conexao->query(DmlSqlPlanoRecurso::SELECT . ' WHERE ' . DmlSqlPlanoRecurso::PLRE_DT_CADASTRO . '=' . $dataCadastro );
        if ($res){
            $retorno = $this->getDTO($res->fetch_assoc());
        }
        return $retorno;
    }

    /**
    * loadDataatualizacao() - implementação da assinatura em PlanoRecursoDAO
    */

    public function loadDataatualizacao($dataAtualizacao)
    {   
        $retorno = NULL;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $res = $conexao->query(DmlSqlPlanoRecurso::SELECT . ' WHERE ' . DmlSqlPlanoRecurso::PLRE_DT_UPDATE . '=' . $dataAtualizacao );
        if ($res){
            $retorno = $this->getDTO($res->fetch_assoc());
        }
        return $retorno;
    }

}
?>


