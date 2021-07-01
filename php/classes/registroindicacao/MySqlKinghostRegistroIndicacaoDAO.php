<?php

/**
* MySqlKinghostRegistroIndicacaoDAO - Implementação DAO
*
* Classe de com todos os comandos DML e DDL (se necessário) para apoio 
* a classe MySqlKinghostRegistroIndicacaoDAO
* Não é uma camada visível para outros dispositivos, como as camadas de apresentação e aplicação. 
*
*
* Tabela principal de atuação: REGISTRO_INDICACAO
*
* Changelog:
*
* 
* @author Julio Cesar Vitorino
* @since 23/08/2019 10:06:20
*
*/
require_once 'RegistroIndicacaoDTO.php';
require_once 'RegistroIndicacaoDAO.php';
require_once 'DmlSqlRegistroIndicacao.php';

require_once '../mensagem/ConstantesMensagem.php';
require_once '../mensagem/MensagemCache.php';
require_once '../variavel/VariavelCache.php';
require_once '../daofactory/DmlSql.php';

class MySqlKinghostRegistroIndicacaoDAO implements RegistroIndicacaoDAO
{
    private $daofactory;

    function __construct($daofactory)
    {
        $this->daofactory = $daofactory;
    }


/**
* loadMaxIdusuariopromotorPK() - Carrega um MaxID (pk) para um ${CAMPO} e status
*
* @param $idUsuarioPromotor
* @param $status
* @return $dto
*/ 

    public function loadMaxIdusuariopromotorPK($idUsuarioPromotor,$status)
    {   
        $retorno = 0;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $sql = DmlSqlRegistroIndicacao::SELECT_MAX_PK . ' WHERE ' 
        . DmlSqlRegistroIndicacao::USUA_ID_PROMOTOR . " = $idUsuarioPromotor "
        . " AND " . DmlSqlRegistroIndicacao::REIN_IN_STATUS . " = '$status'";

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
* listAll() - Lista todos os registros provenientes de REGISTRO_INDICACAO sem critério de paginação
*
* @return List<RegistroIndicacaoDTO>[]
*/ 
    public function listAll()   {   }

/**
* update() - atualiza apenas um registro com base no dto RegistroIndicacaoDTO->id
* @param $daofactory
*
* @return boolean
*/ 
    public function update($dto)
    {   
        $retorno = false;

        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $stmt = $conexao->prepare(DmlSqlRegistroIndicacao::UPD_PK);
        $stmt->bind_param(DmlSql::INTEGER_TYPE 
                            . DmlSql::INTEGER_TYPE 
                            . DmlSql::INTEGER_TYPE 
                            ,$dto->idUsuarioPromotor
                            ,$dto->idUsuarioIndicado
                            ,$dto->id );
        if ($stmt->execute())
        {
            $retorno = true;
        }

        return $retorno;
    }

/**
* delete() - excluir fisicamente um registro com base no dto RegistroIndicacaoDTO->id
*
* @return boolean
*/ 
    public function delete($dto)
    {   
        $retorno = false;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $stmt = $conexao->prepare(DmlSqlRegistroIndicacao::DEL_PK);
        $stmt->bind_param(DmlSql::INTEGER_TYPE
                            ,$dto->id);
        if ($stmt->execute())
        {
            $retorno = true;
        }

        return $retorno;
    }


    public function listRegistroIndicacaoStatus($status)
    {
        $retorno = array();

        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $res = $conexao->query(DmlSqlRegistroIndicacao::SELECT . 'WHERE `' . DmlSqlRegistroIndicacao::REIN_IN_STATUS . "` = '$status'" );
        if ($res){
            while ($row = $res->fetch_assoc()) {
                array_push($retorno, $this->getDTO($row));
            }
        }
        return $retorno;
    }

/**
* countRegistroIndicacaoPorStatus() - contar a quantidade de registros
* sob o contexto da classe RegistroIndicacao com base no status específico. 
*
* Atenção em @see $sql na tabela REGISTRO_INDICACAO 
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

    public function countRegistroIndicacaoPorStatus($status)
    {   
        $retorno = 0;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $res = $conexao->query(DmlSqlRegistroIndicacao::SQL_COUNT . ' WHERE ' 
        . DmlSqlRegistroIndicacao::REIN_IN_STATUS . " = '$status'"
        );
        if ($res){
            $tmp = $res->fetch_assoc();
            $retorno = $tmp['contador'];
        }
        return $retorno;

    }

/**
* listRegistroIndicacaoPorStatus() - Listar um conjunto de registro previamente paginado
* sob o contexto da classe RegistroIndicacao com base no status específico.
*
* Atenção em @see $sql na tabela REGISTRO_INDICACAO 
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

    public function listRegistroIndicacaoPorStatus($status, $pag, $qtde, $coluna, $ordem)
    {
        $sql = DmlSqlRegistroIndicacao::SELECT 
        . ' WHERE ' . DmlSqlRegistroIndicacao::REIN_IN_STATUS . " = '$status'"
        . ' ORDER BY ' . $coluna . ($ordem == 0 ? " ASC": " DESC");
        return $this->listPagina($sql, $pag, $qtde);
    }

/**
* countRegistroIndicacaoPorUsuaIdStatus() - contar a quantidade de registros
* sob o contexto da classe RegistroIndicacao com base no usuário específico. Esse usuário
* é o usuário logado na sessão ou no próprio dispositivo móvel e de acordo com a 
* query em @see $sql na tabela REGISTRO_INDICACAO 
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

    public function countRegistroIndicacaoPorUsuaIdStatus($usuaid, $status)
    {   
        $retorno = 0;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $res = $conexao->query(DmlSqlRegistroIndicacao::SQL_COUNT . ' WHERE ' 
        . DmlSqlRegistroIndicacao::USUA_ID . " = $usuaid '"
        . ' AND ' . DmlSqlRegistroIndicacao::REIN_IN_STATUS . " = '$status'"
        );
        if ($res){
            $tmp = $res->fetch_assoc();
            $retorno = $tmp['contador'];
        }
        return $retorno;

    }

/**
* listRegistroIndicacaoPorUsuaIdStatus() - Listar um conjunto de registro previamente paginado
* sob o contexto da classe RegistroIndicacao com base no usuário específico. Esse usuário
* é o usuário logado na sessão ou no próprio dispositivo móvel e de acordo com a 
* query em @see $sql na tabela REGISTRO_INDICACAO 
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
    public function listRegistroIndicacaoPorUsuaIdStatus($usuaid, $status, $pag, $qtde, $coluna, $ordem)
    {
        $sql = DmlSqlRegistroIndicacao::SELECT 
        . ' WHERE ' . DmlSqlRegistroIndicacao::USUA_ID . " = $usuaid "
        . ' AND ' . DmlSqlRegistroIndicacao::REIN_IN_STATUS . " = '$status'"
        . ' ORDER BY ' . $coluna . ($ordem == 0 ? " ASC": " DESC");
        return $this->listPagina($sql, $pag, $qtde);
    }

/**
* listPagina() - Listar um conjunto de registro previamente paginado
* e de acordo com a query em @see $sql na tabela REGISTRO_INDICACAO 
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
* na tabela REGISTRO_INDICACAO usando a Primary Key REIN_ID
*
* @param $id
* @return RegistroIndicacaoDTO
*/ 
    public function loadPK($id)
    {   
        $retorno = NULL;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $res = $conexao->query(DmlSqlRegistroIndicacao::SELECT . ' WHERE ' . DmlSqlRegistroIndicacao::REIN_ID . '=' . $id );
        if ($res->num_rows > 0){
            $retorno = $this->getDTO($res->fetch_assoc());
        }
        return $retorno;
    }

/**
* updateStatus() - atualizar o campo de STATUS utilizando a id como item de busca
* na tabela REGISTRO_INDICACAO usando a Primary Key REIN_ID
*
* @param $id
* @param $status
*
* @return RegistroIndicacaoDTO
*/ 
    public function updateStatus($id, $status)
    {   
        $retorno = false;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $stmt = $conexao->prepare(DmlSqlRegistroIndicacao::UPD_STATUS);
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
* insert() - inserir um registro com base no RegistroIndicacaoDTO. Alguns atributos dentro do DTO
* serão ignorados caso estejam populados, pois os mesmos possuem constraint de DEFAULT value
* ou campos de AUTO INCREMENTO já previamente definidos no DDL de criação de tabelas do BD.
*
* Atributos da classe RegistroIndicacaoDTO sumariamente IGNORADOS por este método MESMO que estejam preenchidos:
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
        $stmt = $conexao->prepare(DmlSqlRegistroIndicacao::INS);
        $stmt->bind_param(DmlSql::INTEGER_TYPE 
                            . DmlSql::INTEGER_TYPE 
                            ,$dto->idUsuarioPromotor
                            ,$dto->idUsuarioIndicado
        );
        if ($stmt->execute())
        {
            $retorno = true;
        }

        return $retorno;
    }

    /**
     * getDTO() - Transforma o resultset padrão em RegistroIndicacaoDTO
    */
    public function getDTO($resultset)
    {
        if(is_null($resultset)){
            return NULL;
        }

        //echo var_dump($resultset); // ótimo pra debugar
        $retorno = new RegistroIndicacaoDTO();
        $retorno->id = $resultset[DmlSqlRegistroIndicacao::REIN_ID] == NULL ? NULL : $resultset[DmlSqlRegistroIndicacao::REIN_ID];
        $retorno->idUsuarioPromotor = $resultset[DmlSqlRegistroIndicacao::USUA_ID_PROMOTOR] == NULL ? NULL : $resultset[DmlSqlRegistroIndicacao::USUA_ID_PROMOTOR];
        $retorno->idUsuarioIndicado = $resultset[DmlSqlRegistroIndicacao::USUA_ID_INDICADO] == NULL ? NULL : $resultset[DmlSqlRegistroIndicacao::USUA_ID_INDICADO];
        $retorno->status = $resultset[DmlSqlRegistroIndicacao::REIN_IN_STATUS] == NULL ? NULL : $resultset[DmlSqlRegistroIndicacao::REIN_IN_STATUS];
        $retorno->dataCadastro = Util::MySQLDate_to_DMYHMiS($resultset[DmlSqlRegistroIndicacao::REIN_DT_CADASTRO]);
        $retorno->dataAtualizacao = Util::MySQLDate_to_DMYHMiS($resultset[DmlSqlRegistroIndicacao::REIN_DT_UPDATE]);
        $retorno->statusdesc = VariavelCache::getInstance()->getStatusDesc($retorno->status);
        $retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
        $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);
        return $retorno;

    }

    /**
    * updateIdusuariopromotor() - implementação da assinatura em RegistroIndicacaoDAO
    */
    public function updateIdusuariopromotor($id, $idUsuarioPromotor)
    {   
        $retorno = false;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $stmt = $conexao->prepare(DmlSqlRegistroIndicacao::UPD_REGISTRO_INDICACAO_USUA_ID_PROMOTOR_PK);
        $stmt->bind_param(DmlSql::INTEGER_TYPE 
                            . DmlSql::INTEGER_TYPE
                            ,$idUsuarioPromotor
                            ,$id);
        if ($stmt->execute())
        {
            $retorno = true;
        }

        return $retorno;
    }

    /**
    * updateIdusuarioindicado() - implementação da assinatura em RegistroIndicacaoDAO
    */
    public function updateIdusuarioindicado($id, $idUsuarioIndicado)
    {   
        $retorno = false;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $stmt = $conexao->prepare(DmlSqlRegistroIndicacao::UPD_REGISTRO_INDICACAO_USUA_ID_INDICADO_PK);
        $stmt->bind_param(DmlSql::INTEGER_TYPE 
                            . DmlSql::INTEGER_TYPE
                            ,$idUsuarioIndicado
                            ,$id);
        if ($stmt->execute())
        {
            $retorno = true;
        }

        return $retorno;
    }


    /**
    * loadIdusuariopromotor() - implementação da assinatura em RegistroIndicacaoDAO
    */

    public function loadIdusuariopromotor($idUsuarioPromotor)
    {   
        $retorno = NULL;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $res = $conexao->query(DmlSqlRegistroIndicacao::SELECT . ' WHERE ' . DmlSqlRegistroIndicacao::USUA_ID_PROMOTOR . '=' . $idUsuarioPromotor );
        if ($res){
            $retorno = $this->getDTO($res->fetch_assoc());
        }
        return $retorno;
    }

    /**
    * loadIdusuarioindicado() - implementação da assinatura em RegistroIndicacaoDAO
    */

    public function loadIdusuarioindicado($idUsuarioIndicado)
    {   
        $retorno = NULL;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $res = $conexao->query(DmlSqlRegistroIndicacao::SELECT . ' WHERE ' . DmlSqlRegistroIndicacao::USUA_ID_INDICADO . '=' . $idUsuarioIndicado );
        if ($res){
            $retorno = $this->getDTO($res->fetch_assoc());
        }
        return $retorno;
    }

    /**
    * loadStatus() - implementação da assinatura em RegistroIndicacaoDAO
    */

    public function loadStatus($status)
    {   
        $retorno = NULL;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $res = $conexao->query(DmlSqlRegistroIndicacao::SELECT . ' WHERE ' . DmlSqlRegistroIndicacao::REIN_IN_STATUS . '=' . $status );
        if ($res){
            $retorno = $this->getDTO($res->fetch_assoc());
        }
        return $retorno;
    }

    /**
    * loadDatacadastro() - implementação da assinatura em RegistroIndicacaoDAO
    */

    public function loadDatacadastro($dataCadastro)
    {   
        $retorno = NULL;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $res = $conexao->query(DmlSqlRegistroIndicacao::SELECT . ' WHERE ' . DmlSqlRegistroIndicacao::REIN_DT_CADASTRO . '=' . $dataCadastro );
        if ($res){
            $retorno = $this->getDTO($res->fetch_assoc());
        }
        return $retorno;
    }

    /**
    * loadDataatualizacao() - implementação da assinatura em RegistroIndicacaoDAO
    */

    public function loadDataatualizacao($dataAtualizacao)
    {   
        $retorno = NULL;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $res = $conexao->query(DmlSqlRegistroIndicacao::SELECT . ' WHERE ' . DmlSqlRegistroIndicacao::REIN_DT_UPDATE . '=' . $dataAtualizacao );
        if ($res){
            $retorno = $this->getDTO($res->fetch_assoc());
        }
        return $retorno;
    }


}
?>
