<?php

/**
* MySqlKinghostGrupoAdminFuncoesAdminDAO - Implementação DAO
*
* Classe de com todos os comandos DML e DDL (se necessário) para apoio 
* a classe MySqlKinghostGrupoAdminFuncoesAdminDAO
* Não é uma camada visível para outros dispositivos, como as camadas de apresentação e aplicação. 
*
*
* Tabela principal de atuação: SEGLOG_GRUPO_ADM_FUNCAO_ADM
*
* Changelog:
*
* 
* @author Julio Cesar Vitorino
* @since 23/08/2019 10:06:20
*
*/
require_once 'GrupoAdminFuncoesAdminDTO.php';
require_once 'GrupoAdminFuncoesAdminDAO.php';
require_once 'DmlSqlGrupoAdminFuncoesAdmin.php';

require_once '../mensagem/ConstantesMensagem.php';
require_once '../mensagem/MensagemCache.php';
require_once '../variavel/VariavelCache.php';
require_once '../daofactory/DmlSql.php';

class MySqlKinghostGrupoAdminFuncoesAdminDAO implements GrupoAdminFuncoesAdminDAO
{
    private $daofactory;

    function __construct($daofactory)
    {
        $this->daofactory = $daofactory;
    }


/**
* loadMaxIdgrupoadministracaoPK() - Carrega um MaxID (pk) para um ${CAMPO} e status
*
* @param $idGrupoAdministracao
* @param $status
* @return $dto
*/ 

    public function loadMaxIdgrupoadministracaoPK($idGrupoAdministracao,$status)
    {   
        $retorno = 0;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $sql = DmlSqlGrupoAdminFuncoesAdmin::SELECT_MAX_PK . ' WHERE ' 
        . DmlSqlGrupoAdminFuncoesAdmin::GRAD_ID . " = $idGrupoAdministracao "
        . " AND " . DmlSqlGrupoAdminFuncoesAdmin::GAFA_IN_STATUS . " = '$status'";

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
* listAll() - Lista todos os registros provenientes de SEGLOG_GRUPO_ADM_FUNCAO_ADM sem critério de paginação
*
* @return List<GrupoAdminFuncoesAdminDTO>[]
*/ 
    public function listAll()   {   }

/**
* update() - atualiza apenas um registro com base no dto GrupoAdminFuncoesAdminDTO->id
* @param $daofactory
*
* @return boolean
*/ 
    public function update($dto)
    {   
        $retorno = false;

        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $stmt = $conexao->prepare(DmlSqlGrupoAdminFuncoesAdmin::UPD_PK);
        $stmt->bind_param(DmlSql::INTEGER_TYPE 
                            . DmlSql::INTEGER_TYPE 
                            . DmlSql::STRING_TYPE 
                            . DmlSql::STRING_TYPE 
                            . DmlSql::STRING_TYPE 
                            . DmlSql::STRING_TYPE 
                            . DmlSql::STRING_TYPE 
                            . DmlSql::INTEGER_TYPE 
                            ,$dto->idGrupoAdministracao
                            ,$dto->idFuncoesAdministrativas
                            ,$dto->descricao
                            ,$dto->incrudCriar
                            ,$dto->incrudRecuperar
                            ,$dto->incrudAtualizar
                            ,$dto->incrudExcluir
                            ,$dto->id );
        if ($stmt->execute())
        {
            $retorno = true;
        }

        return $retorno;
    }

/**
* delete() - excluir fisicamente um registro com base no dto GrupoAdminFuncoesAdminDTO->id
*
* @return boolean
*/ 
    public function delete($dto)
    {   
        $retorno = false;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $stmt = $conexao->prepare(DmlSqlGrupoAdminFuncoesAdmin::DEL_PK);
        $stmt->bind_param(DmlSql::INTEGER_TYPE
                            ,$dto->id);
        if ($stmt->execute())
        {
            $retorno = true;
        }

        return $retorno;
    }


    public function listGrupoAdminFuncoesAdminStatus($status)
    {
        $retorno = array();

        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $res = $conexao->query(DmlSqlGrupoAdminFuncoesAdmin::SELECT . 'WHERE `' . DmlSqlGrupoAdminFuncoesAdmin::GAFA_IN_STATUS . "` = '$status'" );
        if ($res){
            while ($row = $res->fetch_assoc()) {
                array_push($retorno, $this->getDTO($row));
            }
        }
        return $retorno;
    }

/**
* countGrupoAdminFuncoesAdminPorStatus() - contar a quantidade de registros
* sob o contexto da classe GrupoAdminFuncoesAdmin com base no status específico. 
*
* Atenção em @see $sql na tabela SEGLOG_GRUPO_ADM_FUNCAO_ADM 
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

    public function countGrupoAdminFuncoesAdminPorStatus($status)
    {   
        $retorno = 0;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $res = $conexao->query(DmlSqlGrupoAdminFuncoesAdmin::SQL_COUNT . ' WHERE ' 
        . DmlSqlGrupoAdminFuncoesAdmin::GAFA_IN_STATUS . " = '$status'"
        );
        if ($res){
            $tmp = $res->fetch_assoc();
            $retorno = $tmp['contador'];
        }
        return $retorno;

    }

/**
* listGrupoAdminFuncoesAdminPorStatus() - Listar um conjunto de registro previamente paginado
* sob o contexto da classe GrupoAdminFuncoesAdmin com base no status específico.
*
* Atenção em @see $sql na tabela SEGLOG_GRUPO_ADM_FUNCAO_ADM 
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

    public function listGrupoAdminFuncoesAdminPorStatus($status, $pag, $qtde, $coluna, $ordem)
    {
        $sql = DmlSqlGrupoAdminFuncoesAdmin::SELECT 
        . ' WHERE ' . DmlSqlGrupoAdminFuncoesAdmin::GAFA_IN_STATUS . " = '$status'"
        . ' ORDER BY ' . $coluna . ($ordem == 0 ? " ASC": " DESC");
        return $this->listPagina($sql, $pag, $qtde);
    }

/**
* countGrupoAdminFuncoesAdminPorUsuaIdStatus() - contar a quantidade de registros
* sob o contexto da classe GrupoAdminFuncoesAdmin com base no usuário específico. Esse usuário
* é o usuário logado na sessão ou no próprio dispositivo móvel e de acordo com a 
* query em @see $sql na tabela SEGLOG_GRUPO_ADM_FUNCAO_ADM 
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

    public function countGrupoAdminFuncoesAdminPorUsuaIdStatus($usuaid, $status)
    {   
        $retorno = 0;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $res = $conexao->query(DmlSqlGrupoAdminFuncoesAdmin::SQL_COUNT . ' WHERE ' 
        . DmlSqlGrupoAdminFuncoesAdmin::USUA_ID . " = $usuaid "
        . ' AND ' . DmlSqlGrupoAdminFuncoesAdmin::GAFA_IN_STATUS . " = '$status'"
        );
        if ($res){
            $tmp = $res->fetch_assoc();
            $retorno = $tmp['contador'];
        }
        return $retorno;

    }

/**
* listGrupoAdminFuncoesAdminPorUsuaIdStatus() - Listar um conjunto de registro previamente paginado
* sob o contexto da classe GrupoAdminFuncoesAdmin com base no usuário específico. Esse usuário
* é o usuário logado na sessão ou no próprio dispositivo móvel e de acordo com a 
* query em @see $sql na tabela SEGLOG_GRUPO_ADM_FUNCAO_ADM 
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
    public function listGrupoAdminFuncoesAdminPorUsuaIdStatus($usuaid, $status, $pag, $qtde, $coluna, $ordem)
    {
        $sql = DmlSqlGrupoAdminFuncoesAdmin::SELECT 
        . ' WHERE ' . DmlSqlGrupoAdminFuncoesAdmin::USUA_ID . " = $usuaid "
        . ' AND ' . DmlSqlGrupoAdminFuncoesAdmin::GAFA_IN_STATUS . " = '$status'"
        . ' ORDER BY ' . $coluna . ($ordem == 0 ? " ASC": " DESC");
        return $this->listPagina($sql, $pag, $qtde);
    }

/**
* listPagina() - Listar um conjunto de registro previamente paginado
* e de acordo com a query em @see $sql na tabela SEGLOG_GRUPO_ADM_FUNCAO_ADM 
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
* na tabela SEGLOG_GRUPO_ADM_FUNCAO_ADM usando a Primary Key GAFA_ID
*
* @param $id
* @return GrupoAdminFuncoesAdminDTO
*/ 
    public function loadPK($id)
    {   
        $retorno = NULL;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $res = $conexao->query(DmlSqlGrupoAdminFuncoesAdmin::SELECT . ' WHERE ' . DmlSqlGrupoAdminFuncoesAdmin::GAFA_ID . '=' . $id );
        if ($res->num_rows > 0){
            $retorno = $this->getDTO($res->fetch_assoc());
        }
        return $retorno;
    }

/**
* updateStatus() - atualizar o campo de STATUS utilizando a id como item de busca
* na tabela SEGLOG_GRUPO_ADM_FUNCAO_ADM usando a Primary Key GAFA_ID
*
* @param $id
* @param $status
*
* @return GrupoAdminFuncoesAdminDTO
*/ 
    public function updateStatus($id, $status)
    {   
        $retorno = false;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $stmt = $conexao->prepare(DmlSqlGrupoAdminFuncoesAdmin::UPD_STATUS);
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
* insert() - inserir um registro com base no GrupoAdminFuncoesAdminDTO. Alguns atributos dentro do DTO
* serão ignorados caso estejam populados, pois os mesmos possuem constraint de DEFAULT value
* ou campos de AUTO INCREMENTO já previamente definidos no DDL de criação de tabelas do BD.
*
* Atributos da classe GrupoAdminFuncoesAdminDTO sumariamente IGNORADOS por este método MESMO que estejam preenchidos:
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
        $stmt = $conexao->prepare(DmlSqlGrupoAdminFuncoesAdmin::INS);
        $stmt->bind_param(DmlSql::INTEGER_TYPE 
                            . DmlSql::INTEGER_TYPE 
                            . DmlSql::STRING_TYPE 
                            ,$dto->idGrupoAdministracao
                            ,$dto->idFuncoesAdministrativas
                            ,$dto->descricao
        );
        if ($stmt->execute())
        {
            $retorno = true;
        }

        return $retorno;
    }

    /**
     * getDTO() - Transforma o resultset padrão em GrupoAdminFuncoesAdminDTO
    */
    public function getDTO($resultset)
    {
        if(is_null($resultset)){
            return NULL;
        }

        //echo var_dump($resultset); // ótimo pra debugar
        $retorno = new GrupoAdminFuncoesAdminDTO();
        $retorno->id = $resultset[DmlSqlGrupoAdminFuncoesAdmin::GAFA_ID] == NULL ? NULL : $resultset[DmlSqlGrupoAdminFuncoesAdmin::GAFA_ID];
        $retorno->idGrupoAdministracao = $resultset[DmlSqlGrupoAdminFuncoesAdmin::GRAD_ID] == NULL ? NULL : $resultset[DmlSqlGrupoAdminFuncoesAdmin::GRAD_ID];
        $retorno->idFuncoesAdministrativas = $resultset[DmlSqlGrupoAdminFuncoesAdmin::FUAD_ID] == NULL ? NULL : $resultset[DmlSqlGrupoAdminFuncoesAdmin::FUAD_ID];
        $retorno->descricao = $resultset[DmlSqlGrupoAdminFuncoesAdmin::GAFA_NM_DESCRICAO] == NULL ? NULL : $resultset[DmlSqlGrupoAdminFuncoesAdmin::GAFA_NM_DESCRICAO];
        $retorno->incrudCriar = $resultset[DmlSqlGrupoAdminFuncoesAdmin::GAFA_IN_CRUD_CRIAR] == NULL ? NULL : $resultset[DmlSqlGrupoAdminFuncoesAdmin::GAFA_IN_CRUD_CRIAR];
        $retorno->incrudRecuperar = $resultset[DmlSqlGrupoAdminFuncoesAdmin::GAFA_IN_CRUD_RECUPERAR] == NULL ? NULL : $resultset[DmlSqlGrupoAdminFuncoesAdmin::GAFA_IN_CRUD_RECUPERAR];
        $retorno->incrudAtualizar = $resultset[DmlSqlGrupoAdminFuncoesAdmin::GAFA_IN_CRUD_ATUALIZAR] == NULL ? NULL : $resultset[DmlSqlGrupoAdminFuncoesAdmin::GAFA_IN_CRUD_ATUALIZAR];
        $retorno->incrudExcluir = $resultset[DmlSqlGrupoAdminFuncoesAdmin::GAFA_IN_CRUD_EXCLUIR] == NULL ? NULL : $resultset[DmlSqlGrupoAdminFuncoesAdmin::GAFA_IN_CRUD_EXCLUIR];
        $retorno->status = $resultset[DmlSqlGrupoAdminFuncoesAdmin::GAFA_IN_STATUS] == NULL ? NULL : $resultset[DmlSqlGrupoAdminFuncoesAdmin::GAFA_IN_STATUS];
        $retorno->dataCadastro = Util::MySQLDate_to_DMYHMiS($resultset[DmlSqlGrupoAdminFuncoesAdmin::GAFA_DT_CADASTRO]);
        $retorno->dataAtualizacao = Util::MySQLDate_to_DMYHMiS($resultset[DmlSqlGrupoAdminFuncoesAdmin::GAFA_DT_UPDATE]);
        $retorno->statusdesc = VariavelCache::getInstance()->getStatusDesc($retorno->status);
        $retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
        $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);
        return $retorno;

    }

    /**
    * updateIdgrupoadministracao() - implementação da assinatura em GrupoAdminFuncoesAdminDAO
    */
    public function updateIdgrupoadministracao($id, $idGrupoAdministracao)
    {   
        $retorno = false;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $stmt = $conexao->prepare(DmlSqlGrupoAdminFuncoesAdmin::UPD_SEGLOG_GRUPO_ADM_FUNCAO_ADM_GRAD_ID_PK);
        $stmt->bind_param(DmlSql::INTEGER_TYPE 
                            . DmlSql::INTEGER_TYPE
                            ,$idGrupoAdministracao
                            ,$id);
        if ($stmt->execute())
        {
            $retorno = true;
        }

        return $retorno;
    }

    /**
    * updateIdfuncoesadministrativas() - implementação da assinatura em GrupoAdminFuncoesAdminDAO
    */
    public function updateIdfuncoesadministrativas($id, $idFuncoesAdministrativas)
    {   
        $retorno = false;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $stmt = $conexao->prepare(DmlSqlGrupoAdminFuncoesAdmin::UPD_SEGLOG_GRUPO_ADM_FUNCAO_ADM_FUAD_ID_PK);
        $stmt->bind_param(DmlSql::INTEGER_TYPE 
                            . DmlSql::INTEGER_TYPE
                            ,$idFuncoesAdministrativas
                            ,$id);
        if ($stmt->execute())
        {
            $retorno = true;
        }

        return $retorno;
    }

    /**
    * updateDescricao() - implementação da assinatura em GrupoAdminFuncoesAdminDAO
    */
    public function updateDescricao($id, $descricao)
    {   
        $retorno = false;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $stmt = $conexao->prepare(DmlSqlGrupoAdminFuncoesAdmin::UPD_SEGLOG_GRUPO_ADM_FUNCAO_ADM_GAFA_NM_DESCRICAO_PK);
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
    * updateIncrudcriar() - implementação da assinatura em GrupoAdminFuncoesAdminDAO
    */
    public function updateIncrudcriar($id, $incrudCriar)
    {   
        $retorno = false;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $stmt = $conexao->prepare(DmlSqlGrupoAdminFuncoesAdmin::UPD_SEGLOG_GRUPO_ADM_FUNCAO_ADM_GAFA_IN_CRUD_CRIAR_PK);
        $stmt->bind_param(DmlSql::STRING_TYPE 
                            . DmlSql::STRING_TYPE
                            ,$incrudCriar
                            ,$id);
        if ($stmt->execute())
        {
            $retorno = true;
        }

        return $retorno;
    }

    /**
    * updateIncrudrecuperar() - implementação da assinatura em GrupoAdminFuncoesAdminDAO
    */
    public function updateIncrudrecuperar($id, $incrudRecuperar)
    {   
        $retorno = false;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $stmt = $conexao->prepare(DmlSqlGrupoAdminFuncoesAdmin::UPD_SEGLOG_GRUPO_ADM_FUNCAO_ADM_GAFA_IN_CRUD_RECUPERAR_PK);
        $stmt->bind_param(DmlSql::STRING_TYPE 
                            . DmlSql::STRING_TYPE
                            ,$incrudRecuperar
                            ,$id);
        if ($stmt->execute())
        {
            $retorno = true;
        }

        return $retorno;
    }

    /**
    * updateIncrudatualizar() - implementação da assinatura em GrupoAdminFuncoesAdminDAO
    */
    public function updateIncrudatualizar($id, $incrudAtualizar)
    {   
        $retorno = false;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $stmt = $conexao->prepare(DmlSqlGrupoAdminFuncoesAdmin::UPD_SEGLOG_GRUPO_ADM_FUNCAO_ADM_GAFA_IN_CRUD_ATUALIZAR_PK);
        $stmt->bind_param(DmlSql::STRING_TYPE 
                            . DmlSql::STRING_TYPE
                            ,$incrudAtualizar
                            ,$id);
        if ($stmt->execute())
        {
            $retorno = true;
        }

        return $retorno;
    }

    /**
    * updateIncrudexcluir() - implementação da assinatura em GrupoAdminFuncoesAdminDAO
    */
    public function updateIncrudexcluir($id, $incrudExcluir)
    {   
        $retorno = false;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $stmt = $conexao->prepare(DmlSqlGrupoAdminFuncoesAdmin::UPD_SEGLOG_GRUPO_ADM_FUNCAO_ADM_GAFA_IN_CRUD_EXCLUIR_PK);
        $stmt->bind_param(DmlSql::STRING_TYPE 
                            . DmlSql::STRING_TYPE
                            ,$incrudExcluir
                            ,$id);
        if ($stmt->execute())
        {
            $retorno = true;
        }

        return $retorno;
    }

    /**
    * loadIdgrupoadministracao() - implementação da assinatura em GrupoAdminFuncoesAdminDAO
    */

    public function loadIdgrupoadministracao($idGrupoAdministracao)
    {   
        $retorno = NULL;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $res = $conexao->query(DmlSqlGrupoAdminFuncoesAdmin::SELECT . ' WHERE ' . DmlSqlGrupoAdminFuncoesAdmin::GRAD_ID . '=' . $idGrupoAdministracao );
        if ($res){
            $retorno = $this->getDTO($res->fetch_assoc());
        }
        return $retorno;
    }

    /**
    * loadIdfuncoesadministrativas() - implementação da assinatura em GrupoAdminFuncoesAdminDAO
    */

    public function loadIdfuncoesadministrativas($idFuncoesAdministrativas)
    {   
        $retorno = NULL;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $res = $conexao->query(DmlSqlGrupoAdminFuncoesAdmin::SELECT . ' WHERE ' . DmlSqlGrupoAdminFuncoesAdmin::FUAD_ID . '=' . $idFuncoesAdministrativas );
        if ($res){
            $retorno = $this->getDTO($res->fetch_assoc());
        }
        return $retorno;
    }

    /**
    * loadDescricao() - implementação da assinatura em GrupoAdminFuncoesAdminDAO
    */

    public function loadDescricao($descricao)
    {   
        $retorno = NULL;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $res = $conexao->query(DmlSqlGrupoAdminFuncoesAdmin::SELECT . ' WHERE ' . DmlSqlGrupoAdminFuncoesAdmin::GAFA_NM_DESCRICAO . '=' . $descricao );
        if ($res){
            $retorno = $this->getDTO($res->fetch_assoc());
        }
        return $retorno;
    }

    /**
    * loadIncrudcriar() - implementação da assinatura em GrupoAdminFuncoesAdminDAO
    */

    public function loadIncrudcriar($incrudCriar)
    {   
        $retorno = NULL;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $res = $conexao->query(DmlSqlGrupoAdminFuncoesAdmin::SELECT . ' WHERE ' . DmlSqlGrupoAdminFuncoesAdmin::GAFA_IN_CRUD_CRIAR . '=' . $incrudCriar );
        if ($res){
            $retorno = $this->getDTO($res->fetch_assoc());
        }
        return $retorno;
    }

    /**
    * loadIncrudrecuperar() - implementação da assinatura em GrupoAdminFuncoesAdminDAO
    */

    public function loadIncrudrecuperar($incrudRecuperar)
    {   
        $retorno = NULL;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $res = $conexao->query(DmlSqlGrupoAdminFuncoesAdmin::SELECT . ' WHERE ' . DmlSqlGrupoAdminFuncoesAdmin::GAFA_IN_CRUD_RECUPERAR . '=' . $incrudRecuperar );
        if ($res){
            $retorno = $this->getDTO($res->fetch_assoc());
        }
        return $retorno;
    }

    /**
    * loadIncrudatualizar() - implementação da assinatura em GrupoAdminFuncoesAdminDAO
    */

    public function loadIncrudatualizar($incrudAtualizar)
    {   
        $retorno = NULL;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $res = $conexao->query(DmlSqlGrupoAdminFuncoesAdmin::SELECT . ' WHERE ' . DmlSqlGrupoAdminFuncoesAdmin::GAFA_IN_CRUD_ATUALIZAR . '=' . $incrudAtualizar );
        if ($res){
            $retorno = $this->getDTO($res->fetch_assoc());
        }
        return $retorno;
    }

    /**
    * loadIncrudexcluir() - implementação da assinatura em GrupoAdminFuncoesAdminDAO
    */

    public function loadIncrudexcluir($incrudExcluir)
    {   
        $retorno = NULL;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $res = $conexao->query(DmlSqlGrupoAdminFuncoesAdmin::SELECT . ' WHERE ' . DmlSqlGrupoAdminFuncoesAdmin::GAFA_IN_CRUD_EXCLUIR . '=' . $incrudExcluir );
        if ($res){
            $retorno = $this->getDTO($res->fetch_assoc());
        }
        return $retorno;
    }

    /**
    * loadStatus() - implementação da assinatura em GrupoAdminFuncoesAdminDAO
    */

    public function loadStatus($status)
    {   
        $retorno = NULL;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $res = $conexao->query(DmlSqlGrupoAdminFuncoesAdmin::SELECT . ' WHERE ' . DmlSqlGrupoAdminFuncoesAdmin::GAFA_IN_STATUS . '=' . $status );
        if ($res){
            $retorno = $this->getDTO($res->fetch_assoc());
        }
        return $retorno;
    }

    /**
    * loadDatacadastro() - implementação da assinatura em GrupoAdminFuncoesAdminDAO
    */

    public function loadDatacadastro($dataCadastro)
    {   
        $retorno = NULL;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $res = $conexao->query(DmlSqlGrupoAdminFuncoesAdmin::SELECT . ' WHERE ' . DmlSqlGrupoAdminFuncoesAdmin::GAFA_DT_CADASTRO . '=' . $dataCadastro );
        if ($res){
            $retorno = $this->getDTO($res->fetch_assoc());
        }
        return $retorno;
    }

    /**
    * loadDataatualizacao() - implementação da assinatura em GrupoAdminFuncoesAdminDAO
    */

    public function loadDataatualizacao($dataAtualizacao)
    {   
        $retorno = NULL;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $res = $conexao->query(DmlSqlGrupoAdminFuncoesAdmin::SELECT . ' WHERE ' . DmlSqlGrupoAdminFuncoesAdmin::GAFA_DT_UPDATE . '=' . $dataAtualizacao );
        if ($res){
            $retorno = $this->getDTO($res->fetch_assoc());
        }
        return $retorno;
    }

}
?>




