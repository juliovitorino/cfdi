<?php

/**
* MySqlKinghostSeglogDAO - Implementação DAO
*
* Classe de com todos os comandos DML e DDL (se necessário) para apoio 
* a classe MySqlKinghostSeglogDAO
* Não é uma camada visível para outros dispositivos, como as camadas de apresentação e aplicação. 
*
*
* Tabela principal de atuação: VW_SEGLOG
*
* Changelog:
*
* 
* @author Julio Cesar Vitorino
* @since 23/08/2019 10:06:20
*
*/
require_once 'SeglogDTO.php';
require_once 'SeglogDAO.php';
require_once 'DmlSqlSeglog.php';

require_once '../mensagem/ConstantesMensagem.php';
require_once '../mensagem/MensagemCache.php';
require_once '../variavel/VariavelCache.php';
require_once '../daofactory/DmlSql.php';

class MySqlKinghostSeglogDAO implements SeglogDAO
{
    private $daofactory;

    function __construct($daofactory)
    {
        $this->daofactory = $daofactory;
    }


/**
* loadMaxIdgafaPK() - Carrega um MaxID (pk) para um ${CAMPO} e status
*
* @param $idgafa
* @param $status
* @return $dto
*/ 

    public function loadMaxIdgafaPK($idgafa,$status)
    {   
        $retorno = 0;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $sql = DmlSqlSeglog::SELECT_MAX_PK . ' WHERE ' 
        . DmlSqlSeglog::GAFA_ID . " = $idgafa "
        . " AND " . DmlSqlSeglog::SEGLOG_IN_STATUS . " = '$status'";

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
* listAll() - Lista todos os registros provenientes de VW_SEGLOG sem critério de paginação
*
* @return List<SeglogDTO>[]
*/ 
    public function listAll()   {   }

/**
* update() - atualiza apenas um registro com base no dto SeglogDTO->id
* @param $daofactory
*
* @return boolean
*/ 
    public function update($dto)
    {   
        $retorno = false;

        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $stmt = $conexao->prepare(DmlSqlSeglog::UPD_PK);
        $stmt->bind_param(DmlSql::INTEGER_TYPE 
                            . DmlSql::INTEGER_TYPE 
                            . DmlSql::STRING_TYPE 
                            . DmlSql::STRING_TYPE 
                            . DmlSql::STRING_TYPE 
                            . DmlSql::STRING_TYPE 
                            . DmlSql::STRING_TYPE 
                            . DmlSql::INTEGER_TYPE 
                            ,$dto->idgafa
                            ,$dto->id_usuario
                            ,$dto->funcao
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
* delete() - excluir fisicamente um registro com base no dto SeglogDTO->id
*
* @return boolean
*/ 
    public function delete($dto)
    {   
        $retorno = false;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $stmt = $conexao->prepare(DmlSqlSeglog::DEL_PK);
        $stmt->bind_param(DmlSql::INTEGER_TYPE
                            ,$dto->id);
        if ($stmt->execute())
        {
            $retorno = true;
        }

        return $retorno;
    }


    public function listSeglogStatus($status)
    {
        $retorno = array();

        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $res = $conexao->query(DmlSqlSeglog::SELECT . 'WHERE `' . DmlSqlSeglog::SEGLOG_IN_STATUS . "` = '$status'" );
        if ($res){
            while ($row = $res->fetch_assoc()) {
                array_push($retorno, $this->getDTO($row));
            }
        }
        return $retorno;
    }

/**
* countSeglogPorStatus() - contar a quantidade de registros
* sob o contexto da classe Seglog com base no status específico. 
*
* Atenção em @see $sql na tabela VW_SEGLOG 
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

    public function countSeglogPorStatus($status)
    {   
        $retorno = 0;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $res = $conexao->query(DmlSqlSeglog::SQL_COUNT . ' WHERE ' 
        . DmlSqlSeglog::SEGLOG_IN_STATUS . " = '$status'"
        );
        if ($res){
            $tmp = $res->fetch_assoc();
            $retorno = $tmp['contador'];
        }
        return $retorno;

    }

/**
* listSeglogPorStatus() - Listar um conjunto de registro previamente paginado
* sob o contexto da classe Seglog com base no status específico.
*
* Atenção em @see $sql na tabela VW_SEGLOG 
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

    public function listSeglogPorStatus($status, $pag, $qtde, $coluna, $ordem)
    {
        $sql = DmlSqlSeglog::SELECT 
        . ' WHERE ' . DmlSqlSeglog::SEGLOG_IN_STATUS . " = '$status'"
        . ' ORDER BY ' . $coluna . ($ordem == 0 ? " ASC": " DESC");
        return $this->listPagina($sql, $pag, $qtde);
    }

/**
* countSeglogPorUsuaIdStatus() - contar a quantidade de registros
* sob o contexto da classe Seglog com base no usuário específico. Esse usuário
* é o usuário logado na sessão ou no próprio dispositivo móvel e de acordo com a 
* query em @see $sql na tabela VW_SEGLOG 
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

    public function countSeglogPorUsuaIdStatus($usuaid, $status)
    {   
        $retorno = 0;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $sql = DmlSqlSeglog::SQL_COUNT . ' WHERE ' 
        . DmlSqlSeglog::USUA_ID . " = $usuaid "
        . ' AND ' . DmlSqlSeglog::SEGLOG_IN_STATUS . " = '$status'";
        $res = $conexao->query($sql);
        if ($res){
            $tmp = $res->fetch_assoc();
            $retorno = $tmp['contador'];
        }
        return $retorno;

    }

/**
* listSeglogPorUsuaIdStatus() - Listar um conjunto de registro previamente paginado
* sob o contexto da classe Seglog com base no usuário específico. Esse usuário
* é o usuário logado na sessão ou no próprio dispositivo móvel e de acordo com a 
* query em @see $sql na tabela VW_SEGLOG 
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
    public function listSeglogPorUsuaIdStatus($usuaid, $status, $pag, $qtde, $coluna, $ordem)
    {
        $sql = DmlSqlSeglog::SELECT 
        . ' WHERE ' . DmlSqlSeglog::USUA_ID . " = $usuaid "
        . ' AND ' . DmlSqlSeglog::SEGLOG_IN_STATUS . " = '$status'"
        . ' ORDER BY ' . $coluna . ($ordem == 0 ? " ASC": " DESC");
        return $this->listPagina($sql, $pag, $qtde);
    }

/**
* listPagina() - Listar um conjunto de registro previamente paginado
* e de acordo com a query em @see $sql na tabela VW_SEGLOG 
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
* na tabela VW_SEGLOG usando a Primary Key SELOG_ID
*
* @param $id
* @return SeglogDTO
*/ 
    public function loadPK($id)
    {   
        $retorno = NULL;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $res = $conexao->query(DmlSqlSeglog::SELECT . ' WHERE ' . DmlSqlSeglog::SELOG_ID . '=' . $id );
        if ($res->num_rows > 0){
            $retorno = $this->getDTO($res->fetch_assoc());
        }
        return $retorno;
    }

/**
* updateStatus() - atualizar o campo de STATUS utilizando a id como item de busca
* na tabela VW_SEGLOG usando a Primary Key SELOG_ID
*
* @param $id
* @param $status
*
* @return SeglogDTO
*/ 
    public function updateStatus($id, $status)
    {   
        $retorno = false;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $stmt = $conexao->prepare(DmlSqlSeglog::UPD_STATUS);
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
* insert() - inserir um registro com base no SeglogDTO. Alguns atributos dentro do DTO
* serão ignorados caso estejam populados, pois os mesmos possuem constraint de DEFAULT value
* ou campos de AUTO INCREMENTO já previamente definidos no DDL de criação de tabelas do BD.
*
* Atributos da classe SeglogDTO sumariamente IGNORADOS por este método MESMO que estejam preenchidos:
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
        $stmt = $conexao->prepare(DmlSqlSeglog::INS);
        $stmt->bind_param(DmlSql::INTEGER_TYPE 
                            . DmlSql::INTEGER_TYPE 
                            . DmlSql::STRING_TYPE 
                            . DmlSql::STRING_TYPE 
                            . DmlSql::STRING_TYPE 
                            . DmlSql::STRING_TYPE 
                            . DmlSql::STRING_TYPE 
                            ,$dto->idgafa
                            ,$dto->id_usuario
                            ,$dto->funcao
                            ,$dto->incrudCriar
                            ,$dto->incrudRecuperar
                            ,$dto->incrudAtualizar
                            ,$dto->incrudExcluir
        );
        if ($stmt->execute())
        {
            $retorno = true;
        }

        return $retorno;
    }

    /**
     * getDTO() - Transforma o resultset padrão em SeglogDTO
    */
    public function getDTO($resultset)
    {
        if(is_null($resultset)){
            return NULL;
        }

        //echo var_dump($resultset); // ótimo pra debugar
        $retorno = new SeglogDTO();
        $retorno->id = $resultset[DmlSqlSeglog::SELOG_ID] == NULL ? NULL : $resultset[DmlSqlSeglog::SELOG_ID];
        $retorno->id_usuario = $resultset[DmlSqlSeglog::USUA_ID] == NULL ? NULL : $resultset[DmlSqlSeglog::USUA_ID];
        $retorno->funcao = $resultset[DmlSqlSeglog::SEGLOG_DESCRICAO] == NULL ? NULL : $resultset[DmlSqlSeglog::SEGLOG_DESCRICAO];
        $retorno->incrudCriar = $resultset[DmlSqlSeglog::SEGLOG_IN_CRUD_CRIAR] == NULL ? NULL : $resultset[DmlSqlSeglog::SEGLOG_IN_CRUD_CRIAR];
        $retorno->incrudRecuperar = $resultset[DmlSqlSeglog::SEGLOG_IN_CRUD_RECUPERAR] == NULL ? NULL : $resultset[DmlSqlSeglog::SEGLOG_IN_CRUD_RECUPERAR];
        $retorno->incrudAtualizar = $resultset[DmlSqlSeglog::SEGLOG_IN_CRUD_ATUALIZAR] == NULL ? NULL : $resultset[DmlSqlSeglog::SEGLOG_IN_CRUD_ATUALIZAR];
        $retorno->incrudExcluir = $resultset[DmlSqlSeglog::SEGLOG_IN_CRUD_EXCLUIR] == NULL ? NULL : $resultset[DmlSqlSeglog::SEGLOG_IN_CRUD_EXCLUIR];
        $retorno->status = $resultset[DmlSqlSeglog::SEGLOG_IN_STATUS] == NULL ? NULL : $resultset[DmlSqlSeglog::SEGLOG_IN_STATUS];
        $retorno->dataCadastro = Util::MySQLDate_to_DMYHMiS($resultset[DmlSqlSeglog::SEGLOG_DT_CADASTRO]);
        $retorno->dataAtualizacao = Util::MySQLDate_to_DMYHMiS($resultset[DmlSqlSeglog::SEGLOG_DT_UPDATE]);
        $retorno->statusdesc = VariavelCache::getInstance()->getStatusDesc($retorno->status);
        $retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
        $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);
        return $retorno;

    }

    /**
    * updateIdgafa() - implementação da assinatura em SeglogDAO
    */
    public function updateIdgafa($id, $idgafa)
    {   
        $retorno = false;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $stmt = $conexao->prepare(DmlSqlSeglog::UPD_VW_SEGLOG_GAFA_ID_PK);
        $stmt->bind_param(DmlSql::INTEGER_TYPE 
                            . DmlSql::INTEGER_TYPE
                            ,$idgafa
                            ,$id);
        if ($stmt->execute())
        {
            $retorno = true;
        }

        return $retorno;
    }

    /**
    * updateId_Usuario() - implementação da assinatura em SeglogDAO
    */
    public function updateId_Usuario($id, $id_usuario)
    {   
        $retorno = false;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $stmt = $conexao->prepare(DmlSqlSeglog::UPD_VW_SEGLOG_USUA_ID_PK);
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
    * updateFuncao() - implementação da assinatura em SeglogDAO
    */
    public function updateFuncao($id, $funcao)
    {   
        $retorno = false;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $stmt = $conexao->prepare(DmlSqlSeglog::UPD_VW_SEGLOG_SEGLOG_DESCRICAO_PK);
        $stmt->bind_param(DmlSql::STRING_TYPE 
                            . DmlSql::STRING_TYPE
                            ,$funcao
                            ,$id);
        if ($stmt->execute())
        {
            $retorno = true;
        }

        return $retorno;
    }

    /**
    * updateIncrudcriar() - implementação da assinatura em SeglogDAO
    */
    public function updateIncrudcriar($id, $incrudCriar)
    {   
        $retorno = false;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $stmt = $conexao->prepare(DmlSqlSeglog::UPD_VW_SEGLOG_SEGLOG_IN_CRUD_CRIAR_PK);
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
    * updateIncrudrecuperar() - implementação da assinatura em SeglogDAO
    */
    public function updateIncrudrecuperar($id, $incrudRecuperar)
    {   
        $retorno = false;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $stmt = $conexao->prepare(DmlSqlSeglog::UPD_VW_SEGLOG_SEGLOG_IN_CRUD_RECUPERAR_PK);
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
    * updateIncrudatualizar() - implementação da assinatura em SeglogDAO
    */
    public function updateIncrudatualizar($id, $incrudAtualizar)
    {   
        $retorno = false;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $stmt = $conexao->prepare(DmlSqlSeglog::UPD_VW_SEGLOG_SEGLOG_IN_CRUD_ATUALIZAR_PK);
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
    * updateIncrudexcluir() - implementação da assinatura em SeglogDAO
    */
    public function updateIncrudexcluir($id, $incrudExcluir)
    {   
        $retorno = false;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $stmt = $conexao->prepare(DmlSqlSeglog::UPD_VW_SEGLOG_SEGLOG_IN_CRUD_EXCLUIR_PK);
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
    * loadIdgafa() - implementação da assinatura em SeglogDAO
    */

    public function loadIdgafa($idgafa)
    {   
        $retorno = NULL;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $res = $conexao->query(DmlSqlSeglog::SELECT . ' WHERE ' . DmlSqlSeglog::GAFA_ID . '=' . $idgafa );
        if ($res){
            $retorno = $this->getDTO($res->fetch_assoc());
        }
        return $retorno;
    }

    /**
    * loadId_Usuario() - implementação da assinatura em SeglogDAO
    */

    public function loadId_Usuario($id_usuario)
    {   
        $retorno = NULL;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $res = $conexao->query(DmlSqlSeglog::SELECT . ' WHERE ' . DmlSqlSeglog::USUA_ID . '=' . $id_usuario );
        if ($res){
            $retorno = $this->getDTO($res->fetch_assoc());
        }
        return $retorno;
    }

    /**
    * loadFuncao() - implementação da assinatura em SeglogDAO
    */

    public function loadFuncao($funcao)
    {   
        $retorno = NULL;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $res = $conexao->query(DmlSqlSeglog::SELECT . ' WHERE ' . DmlSqlSeglog::SEGLOG_DESCRICAO . '=' . $funcao );
        if ($res){
            $retorno = $this->getDTO($res->fetch_assoc());
        }
        return $retorno;
    }


    /**
    * loadId_UsuarioFuncao() - implementação da assinatura em SeglogDAO
    */

    public function loadId_UsuarioFuncao( $id_usuario,$funcao)
    {   
        $retorno = NULL;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $res = $conexao->query(DmlSqlSeglog::SELECT . ' WHERE ' 
        . DmlSqlSeglog::USUA_ID . " = $id_usuario "
        . " AND " . DmlSqlSeglog::SEGLOG_DESCRICAO . " = '$funcao'" );
        if ($res){
            $retorno = $this->getDTO($res->fetch_assoc());
        }
        return $retorno;
    }

    /**
    * loadIncrudcriar() - implementação da assinatura em SeglogDAO
    */

    public function loadIncrudcriar($incrudCriar)
    {   
        $retorno = NULL;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $res = $conexao->query(DmlSqlSeglog::SELECT . ' WHERE ' . DmlSqlSeglog::SEGLOG_IN_CRUD_CRIAR . '=' . $incrudCriar );
        if ($res){
            $retorno = $this->getDTO($res->fetch_assoc());
        }
        return $retorno;
    }

    /**
    * loadIncrudrecuperar() - implementação da assinatura em SeglogDAO
    */

    public function loadIncrudrecuperar($incrudRecuperar)
    {   
        $retorno = NULL;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $res = $conexao->query(DmlSqlSeglog::SELECT . ' WHERE ' . DmlSqlSeglog::SEGLOG_IN_CRUD_RECUPERAR . '=' . $incrudRecuperar );
        if ($res){
            $retorno = $this->getDTO($res->fetch_assoc());
        }
        return $retorno;
    }

    /**
    * loadIncrudatualizar() - implementação da assinatura em SeglogDAO
    */

    public function loadIncrudatualizar($incrudAtualizar)
    {   
        $retorno = NULL;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $res = $conexao->query(DmlSqlSeglog::SELECT . ' WHERE ' . DmlSqlSeglog::SEGLOG_IN_CRUD_ATUALIZAR . '=' . $incrudAtualizar );
        if ($res){
            $retorno = $this->getDTO($res->fetch_assoc());
        }
        return $retorno;
    }

    /**
    * loadIncrudexcluir() - implementação da assinatura em SeglogDAO
    */

    public function loadIncrudexcluir($incrudExcluir)
    {   
        $retorno = NULL;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $res = $conexao->query(DmlSqlSeglog::SELECT . ' WHERE ' . DmlSqlSeglog::SEGLOG_IN_CRUD_EXCLUIR . '=' . $incrudExcluir );
        if ($res){
            $retorno = $this->getDTO($res->fetch_assoc());
        }
        return $retorno;
    }

    /**
    * loadStatus() - implementação da assinatura em SeglogDAO
    */

    public function loadStatus($status)
    {   
        $retorno = NULL;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $res = $conexao->query(DmlSqlSeglog::SELECT . ' WHERE ' . DmlSqlSeglog::SEGLOG_IN_STATUS . '=' . $status );
        if ($res){
            $retorno = $this->getDTO($res->fetch_assoc());
        }
        return $retorno;
    }

    /**
    * loadDatacadastro() - implementação da assinatura em SeglogDAO
    */

    public function loadDatacadastro($dataCadastro)
    {   
        $retorno = NULL;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $res = $conexao->query(DmlSqlSeglog::SELECT . ' WHERE ' . DmlSqlSeglog::SEGLOG_DT_CADASTRO . '=' . $dataCadastro );
        if ($res){
            $retorno = $this->getDTO($res->fetch_assoc());
        }
        return $retorno;
    }

    /**
    * loadDataatualizacao() - implementação da assinatura em SeglogDAO
    */

    public function loadDataatualizacao($dataAtualizacao)
    {   
        $retorno = NULL;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $res = $conexao->query(DmlSqlSeglog::SELECT . ' WHERE ' . DmlSqlSeglog::SEGLOG_DT_UPDATE . '=' . $dataAtualizacao );
        if ($res){
            $retorno = $this->getDTO($res->fetch_assoc());
        }
        return $retorno;
    }

}
?>




