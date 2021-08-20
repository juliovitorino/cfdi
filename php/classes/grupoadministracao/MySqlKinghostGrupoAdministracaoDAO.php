<?php

/**
* MySqlKinghostGrupoAdministracaoDAO - Implementação DAO
*
* Classe de com todos os comandos DML e DDL (se necessário) para apoio 
* a classe MySqlKinghostGrupoAdministracaoDAO
* Não é uma camada visível para outros dispositivos, como as camadas de apresentação e aplicação. 
*
*
* Tabela principal de atuação: SEGLOG_GRUPO_ADMINISTRACAO
*
* Changelog:
*
* 
* @author Julio Cesar Vitorino
* @since 23/08/2019 10:06:20
*
*/
require_once 'GrupoAdministracaoDTO.php';
require_once 'GrupoAdministracaoDAO.php';
require_once 'DmlSqlGrupoAdministracao.php';

require_once '../mensagem/ConstantesMensagem.php';
require_once '../mensagem/MensagemCache.php';
require_once '../variavel/VariavelCache.php';
require_once '../daofactory/DmlSql.php';

class MySqlKinghostGrupoAdministracaoDAO implements GrupoAdministracaoDAO
{
    private $daofactory;

    function __construct($daofactory)
    {
        $this->daofactory = $daofactory;
    }


/**
* loadMaxDescricaoPK() - Carrega um MaxID (pk) para um ${CAMPO} e status
*
* @param $descricao
* @param $status
* @return $dto
*/ 

    public function loadMaxDescricaoPK($descricao,$status)
    {   
        $retorno = 0;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $sql = DmlSqlGrupoAdministracao::SELECT_MAX_PK . ' WHERE ' 
        . DmlSqlGrupoAdministracao::GRAD_NM_DESCRICAO . " = $descricao "
        . " AND " . DmlSqlGrupoAdministracao::GRAD_IN_STATUS . " = '$status'";

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
* listAll() - Lista todos os registros provenientes de SEGLOG_GRUPO_ADMINISTRACAO sem critério de paginação
*
* @return List<GrupoAdministracaoDTO>[]
*/ 
    public function listAll()   {   }

/**
* update() - atualiza apenas um registro com base no dto GrupoAdministracaoDTO->id
* @param $daofactory
*
* @return boolean
*/ 
    public function update($dto)
    {   
        $retorno = false;

        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $stmt = $conexao->prepare(DmlSqlGrupoAdministracao::UPD_PK);
        $stmt->bind_param(DmlSql::STRING_TYPE 
                            . DmlSql::INTEGER_TYPE 
                            ,$dto->descricao
                            ,$dto->id );
        if ($stmt->execute())
        {
            $retorno = true;
        }

        return $retorno;
    }

/**
* delete() - excluir fisicamente um registro com base no dto GrupoAdministracaoDTO->id
*
* @return boolean
*/ 
    public function delete($dto)
    {   
        $retorno = false;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $stmt = $conexao->prepare(DmlSqlGrupoAdministracao::DEL_PK);
        $stmt->bind_param(DmlSql::INTEGER_TYPE
                            ,$dto->id);
        if ($stmt->execute())
        {
            $retorno = true;
        }

        return $retorno;
    }


    public function listGrupoAdministracaoStatus($status)
    {
        $retorno = array();

        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $res = $conexao->query(DmlSqlGrupoAdministracao::SELECT . 'WHERE `' . DmlSqlGrupoAdministracao::GRAD_IN_STATUS . "` = '$status'");
        if ($res){
            while ($row = $res->fetch_assoc()) {
                array_push($retorno, $this->getDTO($row));
            }
        }
        return $retorno;
    }

/**
* countGrupoAdministracaoPorStatus() - contar a quantidade de registros
* sob o contexto da classe GrupoAdministracao com base no status específico. 
*
* Atenção em @see $sql na tabela SEGLOG_GRUPO_ADMINISTRACAO 
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

    public function countGrupoAdministracaoPorStatus($status)
    {   
        $retorno = 0;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $res = $conexao->query(DmlSqlGrupoAdministracao::SQL_COUNT . ' WHERE ' 
        . DmlSqlGrupoAdministracao::GRAD_IN_STATUS . " = '$status'"
        );
        if ($res){
            $tmp = $res->fetch_assoc();
            $retorno = $tmp['contador'];
        }
        return $retorno;

    }

/**
* listGrupoAdministracaoPorStatus() - Listar um conjunto de registro previamente paginado
* sob o contexto da classe GrupoAdministracao com base no status específico.
*
* Atenção em @see $sql na tabela SEGLOG_GRUPO_ADMINISTRACAO 
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

    public function listGrupoAdministracaoPorStatus($status, $pag, $qtde, $coluna, $ordem)
    {
        $sql = DmlSqlGrupoAdministracao::SELECT 
        . ' WHERE ' . DmlSqlGrupoAdministracao::GRAD_IN_STATUS . " = '$status'"
        . ' ORDER BY ' . $coluna . ($ordem == 0 ? " ASC": " DESC");
        return $this->listPagina($sql, $pag, $qtde);
    }

/**
* countGrupoAdministracaoPorUsuaIdStatus() - contar a quantidade de registros
* sob o contexto da classe GrupoAdministracao com base no usuário específico. Esse usuário
* é o usuário logado na sessão ou no próprio dispositivo móvel e de acordo com a 
* query em @see $sql na tabela SEGLOG_GRUPO_ADMINISTRACAO 
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

    public function countGrupoAdministracaoPorUsuaIdStatus($usuaid, $status)
    {   
        $retorno = 0;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $res = $conexao->query(DmlSqlGrupoAdministracao::SQL_COUNT . ' WHERE ' 
        . DmlSqlGrupoAdministracao::USUA_ID . " = $usuaid "
        . ' AND ' . DmlSqlGrupoAdministracao::GRAD_IN_STATUS . " = '$status'"
        );
        if ($res){
            $tmp = $res->fetch_assoc();
            $retorno = $tmp['contador'];
        }
        return $retorno;

    }

/**
* listGrupoAdministracaoPorUsuaIdStatus() - Listar um conjunto de registro previamente paginado
* sob o contexto da classe GrupoAdministracao com base no usuário específico. Esse usuário
* é o usuário logado na sessão ou no próprio dispositivo móvel e de acordo com a 
* query em @see $sql na tabela SEGLOG_GRUPO_ADMINISTRACAO 
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
    public function listGrupoAdministracaoPorUsuaIdStatus($usuaid, $status, $pag, $qtde, $coluna, $ordem)
    {
        $sql = DmlSqlGrupoAdministracao::SELECT 
        . ' WHERE ' . DmlSqlGrupoAdministracao::USUA_ID . " = $usuaid "
        . ' AND ' . DmlSqlGrupoAdministracao::GRAD_IN_STATUS . " = '$status'"
        . ' ORDER BY ' . $coluna . ($ordem == 0 ? " ASC": " DESC");
        return $this->listPagina($sql, $pag, $qtde);
    }

/**
* listPagina() - Listar um conjunto de registro previamente paginado
* e de acordo com a query em @see $sql na tabela SEGLOG_GRUPO_ADMINISTRACAO 
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
* na tabela SEGLOG_GRUPO_ADMINISTRACAO usando a Primary Key GRAD_ID
*
* @param $id
* @return GrupoAdministracaoDTO
*/ 
    public function loadPK($id)
    {   
        $retorno = NULL;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $res = $conexao->query(DmlSqlGrupoAdministracao::SELECT . ' WHERE ' . DmlSqlGrupoAdministracao::GRAD_ID . '=' . $id );
        if ($res->num_rows > 0){
            $retorno = $this->getDTO($res->fetch_assoc());
        }
        return $retorno;
    }

/**
* updateStatus() - atualizar o campo de STATUS utilizando a id como item de busca
* na tabela SEGLOG_GRUPO_ADMINISTRACAO usando a Primary Key GRAD_ID
*
* @param $id
* @param $status
*
* @return GrupoAdministracaoDTO
*/ 
    public function updateStatus($id, $status)
    {   
        $retorno = false;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $stmt = $conexao->prepare(DmlSqlGrupoAdministracao::UPD_STATUS);
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
* insert() - inserir um registro com base no GrupoAdministracaoDTO. Alguns atributos dentro do DTO
* serão ignorados caso estejam populados, pois os mesmos possuem constraint de DEFAULT value
* ou campos de AUTO INCREMENTO já previamente definidos no DDL de criação de tabelas do BD.
*
* Atributos da classe GrupoAdministracaoDTO sumariamente IGNORADOS por este método MESMO que estejam preenchidos:
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
        $stmt = $conexao->prepare(DmlSqlGrupoAdministracao::INS);
        $stmt->bind_param(DmlSql::STRING_TYPE 
                            ,$dto->descricao
        );
        if ($stmt->execute())
        {
            $retorno = true;
        }

        return $retorno;
    }

    /**
     * getDTO() - Transforma o resultset padrão em GrupoAdministracaoDTO
    */
    public function getDTO($resultset)
    {
        if(is_null($resultset)){
            return NULL;
        }

        //echo var_dump($resultset); // ótimo pra debugar
        $retorno = new GrupoAdministracaoDTO();
        $retorno->id = $resultset[DmlSqlGrupoAdministracao::GRAD_ID] == NULL ? NULL : $resultset[DmlSqlGrupoAdministracao::GRAD_ID];
        $retorno->descricao = $resultset[DmlSqlGrupoAdministracao::GRAD_NM_DESCRICAO] == NULL ? NULL : $resultset[DmlSqlGrupoAdministracao::GRAD_NM_DESCRICAO];
        $retorno->status = $resultset[DmlSqlGrupoAdministracao::GRAD_IN_STATUS] == NULL ? NULL : $resultset[DmlSqlGrupoAdministracao::GRAD_IN_STATUS];
        $retorno->dataCadastro = Util::MySQLDate_to_DMYHMiS($resultset[DmlSqlGrupoAdministracao::GRAD_DT_CADASTRO]);
        $retorno->dataAtualizacao = Util::MySQLDate_to_DMYHMiS($resultset[DmlSqlGrupoAdministracao::GRAD_DT_UPDATE]);
        $retorno->statusdesc = VariavelCache::getInstance()->getStatusDesc($retorno->status);
        $retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
        $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);
        return $retorno;

    }

    /**
    * updateDescricao() - implementação da assinatura em GrupoAdministracaoDAO
    */
    public function updateDescricao($id, $descricao)
    {   
        $retorno = false;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $stmt = $conexao->prepare(DmlSqlGrupoAdministracao::UPD_SEGLOG_GRUPO_ADMINISTRACAO_GRAD_NM_DESCRICAO_PK);
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
    * loadDescricao() - implementação da assinatura em GrupoAdministracaoDAO
    */

    public function loadDescricao($descricao)
    {   
        $retorno = NULL;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $res = $conexao->query(DmlSqlGrupoAdministracao::SELECT . ' WHERE ' . DmlSqlGrupoAdministracao::GRAD_NM_DESCRICAO . '=' . $descricao );
        if ($res){
            $retorno = $this->getDTO($res->fetch_assoc());
        }
        return $retorno;
    }
    /**
    * loadStatus() - implementação da assinatura em GrupoAdministracaoDAO
    */

    public function loadStatus($status)
    {   
        $retorno = NULL;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $res = $conexao->query(DmlSqlGrupoAdministracao::SELECT . ' WHERE ' . DmlSqlGrupoAdministracao::GRAD_IN_STATUS . '=' . $status );
        if ($res){
            $retorno = $this->getDTO($res->fetch_assoc());
        }
        return $retorno;
    }

    /**
    * loadDatacadastro() - implementação da assinatura em GrupoAdministracaoDAO
    */

    public function loadDatacadastro($dataCadastro)
    {   
        $retorno = NULL;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $res = $conexao->query(DmlSqlGrupoAdministracao::SELECT . ' WHERE ' . DmlSqlGrupoAdministracao::GRAD_DT_CADASTRO . '=' . $dataCadastro );
        if ($res){
            $retorno = $this->getDTO($res->fetch_assoc());
        }
        return $retorno;
    }

    /**
    * loadDataatualizacao() - implementação da assinatura em GrupoAdministracaoDAO
    */

    public function loadDataatualizacao($dataAtualizacao)
    {   
        $retorno = NULL;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $res = $conexao->query(DmlSqlGrupoAdministracao::SELECT . ' WHERE ' . DmlSqlGrupoAdministracao::GRAD_DT_UPDATE . '=' . $dataAtualizacao );
        if ($res){
            $retorno = $this->getDTO($res->fetch_assoc());
        }
        return $retorno;
    }

}
?>

