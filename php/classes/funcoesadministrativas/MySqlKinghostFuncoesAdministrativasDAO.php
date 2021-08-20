<?php

/**
* MySqlKinghostFuncoesAdministrativasDAO - Implementação DAO
*
* Classe de com todos os comandos DML e DDL (se necessário) para apoio 
* a classe MySqlKinghostFuncoesAdministrativasDAO
* Não é uma camada visível para outros dispositivos, como as camadas de apresentação e aplicação. 
*
*
* Tabela principal de atuação: SEGLOG_FUNCOES_ADMINISTRATIVAS
*
* Changelog:
*
* 
* @author Julio Cesar Vitorino
* @since 23/08/2019 10:06:20
*
*/
require_once 'FuncoesAdministrativasDTO.php';
require_once 'FuncoesAdministrativasDAO.php';
require_once 'DmlSqlFuncoesAdministrativas.php';

require_once '../mensagem/ConstantesMensagem.php';
require_once '../mensagem/MensagemCache.php';
require_once '../variavel/VariavelCache.php';
require_once '../daofactory/DmlSql.php';

class MySqlKinghostFuncoesAdministrativasDAO implements FuncoesAdministrativasDAO
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
        $sql = DmlSqlFuncoesAdministrativas::SELECT_MAX_PK . ' WHERE ' 
        . DmlSqlFuncoesAdministrativas::FUAD_NM_DESCRICAO . " = $descricao "
        . " AND " . DmlSqlFuncoesAdministrativas::FUAD_IN_STATUS . " = '$status'";

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
* listAll() - Lista todos os registros provenientes de SEGLOG_FUNCOES_ADMINISTRATIVAS sem critério de paginação
*
* @return List<FuncoesAdministrativasDTO>[]
*/ 
    public function listAll()   {   }

/**
* update() - atualiza apenas um registro com base no dto FuncoesAdministrativasDTO->id
* @param $daofactory
*
* @return boolean
*/ 
    public function update($dto)
    {   
        $retorno = false;

        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $stmt = $conexao->prepare(DmlSqlFuncoesAdministrativas::UPD_PK);
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
* delete() - excluir fisicamente um registro com base no dto FuncoesAdministrativasDTO->id
*
* @return boolean
*/ 
    public function delete($dto)
    {   
        $retorno = false;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $stmt = $conexao->prepare(DmlSqlFuncoesAdministrativas::DEL_PK);
        $stmt->bind_param(DmlSql::INTEGER_TYPE
                            ,$dto->id);
        if ($stmt->execute())
        {
            $retorno = true;
        }

        return $retorno;
    }


    public function listFuncoesAdministrativasStatus($status)
    {
        $retorno = array();

        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $res = $conexao->query(DmlSqlFuncoesAdministrativas::SELECT . 'WHERE `' . DmlSqlFuncoesAdministrativas::FUAD_IN_STATUS . "` = '$status'" );
        if ($res){
            while ($row = $res->fetch_assoc()) {
                array_push($retorno, $this->getDTO($row));
            }
        }
        return $retorno;
    }

/**
* countFuncoesAdministrativasPorStatus() - contar a quantidade de registros
* sob o contexto da classe FuncoesAdministrativas com base no status específico. 
*
* Atenção em @see $sql na tabela SEGLOG_FUNCOES_ADMINISTRATIVAS 
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

    public function countFuncoesAdministrativasPorStatus($status)
    {   
        $retorno = 0;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $res = $conexao->query(DmlSqlFuncoesAdministrativas::SQL_COUNT . ' WHERE ' 
        . DmlSqlFuncoesAdministrativas::FUAD_IN_STATUS . " = '$status'"
        );
        if ($res){
            $tmp = $res->fetch_assoc();
            $retorno = $tmp['contador'];
        }
        return $retorno;

    }

/**
* listFuncoesAdministrativasPorStatus() - Listar um conjunto de registro previamente paginado
* sob o contexto da classe FuncoesAdministrativas com base no status específico.
*
* Atenção em @see $sql na tabela SEGLOG_FUNCOES_ADMINISTRATIVAS 
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

    public function listFuncoesAdministrativasPorStatus($status, $pag, $qtde, $coluna, $ordem)
    {
        $sql = DmlSqlFuncoesAdministrativas::SELECT 
        . ' WHERE ' . DmlSqlFuncoesAdministrativas::FUAD_IN_STATUS . " = '$status'"
        . ' ORDER BY ' . $coluna . ($ordem == 0 ? " ASC": " DESC");
        return $this->listPagina($sql, $pag, $qtde);
    }

/**
* countFuncoesAdministrativasPorUsuaIdStatus() - contar a quantidade de registros
* sob o contexto da classe FuncoesAdministrativas com base no usuário específico. Esse usuário
* é o usuário logado na sessão ou no próprio dispositivo móvel e de acordo com a 
* query em @see $sql na tabela SEGLOG_FUNCOES_ADMINISTRATIVAS 
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

    public function countFuncoesAdministrativasPorUsuaIdStatus($usuaid, $status)
    {   
        $retorno = 0;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $res = $conexao->query(DmlSqlFuncoesAdministrativas::SQL_COUNT . ' WHERE ' 
        . DmlSqlFuncoesAdministrativas::USUA_ID . " = $usuaid "
        . ' AND ' . DmlSqlFuncoesAdministrativas::FUAD_IN_STATUS . " = '$status'"
        );
        if ($res){
            $tmp = $res->fetch_assoc();
            $retorno = $tmp['contador'];
        }
        return $retorno;

    }

/**
* listFuncoesAdministrativasPorUsuaIdStatus() - Listar um conjunto de registro previamente paginado
* sob o contexto da classe FuncoesAdministrativas com base no usuário específico. Esse usuário
* é o usuário logado na sessão ou no próprio dispositivo móvel e de acordo com a 
* query em @see $sql na tabela SEGLOG_FUNCOES_ADMINISTRATIVAS 
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
    public function listFuncoesAdministrativasPorUsuaIdStatus($usuaid, $status, $pag, $qtde, $coluna, $ordem)
    {
        $sql = DmlSqlFuncoesAdministrativas::SELECT 
        . ' WHERE ' . DmlSqlFuncoesAdministrativas::USUA_ID . " = $usuaid "
        . ' AND ' . DmlSqlFuncoesAdministrativas::FUAD_IN_STATUS . " = '$status'"
        . ' ORDER BY ' . $coluna . ($ordem == 0 ? " ASC": " DESC");
        return $this->listPagina($sql, $pag, $qtde);
    }

/**
* listPagina() - Listar um conjunto de registro previamente paginado
* e de acordo com a query em @see $sql na tabela SEGLOG_FUNCOES_ADMINISTRATIVAS 
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
* na tabela SEGLOG_FUNCOES_ADMINISTRATIVAS usando a Primary Key FUAD_ID
*
* @param $id
* @return FuncoesAdministrativasDTO
*/ 
    public function loadPK($id)
    {   
        $retorno = NULL;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $res = $conexao->query(DmlSqlFuncoesAdministrativas::SELECT . ' WHERE ' . DmlSqlFuncoesAdministrativas::FUAD_ID . '=' . $id );
        if ($res->num_rows > 0){
            $retorno = $this->getDTO($res->fetch_assoc());
        }
        return $retorno;
    }

/**
* updateStatus() - atualizar o campo de STATUS utilizando a id como item de busca
* na tabela SEGLOG_FUNCOES_ADMINISTRATIVAS usando a Primary Key FUAD_ID
*
* @param $id
* @param $status
*
* @return FuncoesAdministrativasDTO
*/ 
    public function updateStatus($id, $status)
    {   
        $retorno = false;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $stmt = $conexao->prepare(DmlSqlFuncoesAdministrativas::UPD_STATUS);
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
* insert() - inserir um registro com base no FuncoesAdministrativasDTO. Alguns atributos dentro do DTO
* serão ignorados caso estejam populados, pois os mesmos possuem constraint de DEFAULT value
* ou campos de AUTO INCREMENTO já previamente definidos no DDL de criação de tabelas do BD.
*
* Atributos da classe FuncoesAdministrativasDTO sumariamente IGNORADOS por este método MESMO que estejam preenchidos:
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
        $stmt = $conexao->prepare(DmlSqlFuncoesAdministrativas::INS);
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
     * getDTO() - Transforma o resultset padrão em FuncoesAdministrativasDTO
    */
    public function getDTO($resultset)
    {
        if(is_null($resultset)){
            return NULL;
        }

        //echo var_dump($resultset); // ótimo pra debugar
        $retorno = new FuncoesAdministrativasDTO();
        $retorno->id = $resultset[DmlSqlFuncoesAdministrativas::FUAD_ID] == NULL ? NULL : $resultset[DmlSqlFuncoesAdministrativas::FUAD_ID];
        $retorno->descricao = $resultset[DmlSqlFuncoesAdministrativas::FUAD_NM_DESCRICAO] == NULL ? NULL : $resultset[DmlSqlFuncoesAdministrativas::FUAD_NM_DESCRICAO];
        $retorno->status = $resultset[DmlSqlFuncoesAdministrativas::FUAD_IN_STATUS] == NULL ? NULL : $resultset[DmlSqlFuncoesAdministrativas::FUAD_IN_STATUS];
        $retorno->dataCadastro = Util::MySQLDate_to_DMYHMiS($resultset[DmlSqlFuncoesAdministrativas::FUAD_DT_CADASTRO]);
        $retorno->dataAtualizacao = Util::MySQLDate_to_DMYHMiS($resultset[DmlSqlFuncoesAdministrativas::FUAD_DT_UPDATE]);
        $retorno->statusdesc = VariavelCache::getInstance()->getStatusDesc($retorno->status);
        $retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
        $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);
        return $retorno;

    }

    /**
    * updateDescricao() - implementação da assinatura em FuncoesAdministrativasDAO
    */
    public function updateDescricao($id, $descricao)
    {   
        $retorno = false;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $stmt = $conexao->prepare(DmlSqlFuncoesAdministrativas::UPD_SEGLOG_FUNCOES_ADMINISTRATIVAS_FUAD_NM_DESCRICAO_PK);
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
    * loadDescricao() - implementação da assinatura em FuncoesAdministrativasDAO
    */

    public function loadDescricao($descricao)
    {   
        $retorno = NULL;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $res = $conexao->query(DmlSqlFuncoesAdministrativas::SELECT . ' WHERE ' . DmlSqlFuncoesAdministrativas::FUAD_NM_DESCRICAO . '=' . $descricao );
        if ($res){
            $retorno = $this->getDTO($res->fetch_assoc());
        }
        return $retorno;
    }

    /**
    * loadStatus() - implementação da assinatura em FuncoesAdministrativasDAO
    */

    public function loadStatus($status)
    {   
        $retorno = NULL;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $res = $conexao->query(DmlSqlFuncoesAdministrativas::SELECT . ' WHERE ' . DmlSqlFuncoesAdministrativas::FUAD_IN_STATUS . '=' . $status );
        if ($res){
            $retorno = $this->getDTO($res->fetch_assoc());
        }
        return $retorno;
    }

    /**
    * loadDatacadastro() - implementação da assinatura em FuncoesAdministrativasDAO
    */

    public function loadDatacadastro($dataCadastro)
    {   
        $retorno = NULL;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $res = $conexao->query(DmlSqlFuncoesAdministrativas::SELECT . ' WHERE ' . DmlSqlFuncoesAdministrativas::FUAD_DT_CADASTRO . '=' . $dataCadastro );
        if ($res){
            $retorno = $this->getDTO($res->fetch_assoc());
        }
        return $retorno;
    }

    /**
    * loadDataatualizacao() - implementação da assinatura em FuncoesAdministrativasDAO
    */

    public function loadDataatualizacao($dataAtualizacao)
    {   
        $retorno = NULL;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $res = $conexao->query(DmlSqlFuncoesAdministrativas::SELECT . ' WHERE ' . DmlSqlFuncoesAdministrativas::FUAD_DT_UPDATE . '=' . $dataAtualizacao );
        if ($res){
            $retorno = $this->getDTO($res->fetch_assoc());
        }
        return $retorno;
    }

}
?>




