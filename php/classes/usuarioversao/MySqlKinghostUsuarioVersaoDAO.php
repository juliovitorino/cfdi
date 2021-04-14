<?php

/**
* MySqlKinghostUsuarioVersaoDAO - Implementação DAO
*
* Classe de com todos os comandos DML e DDL (se necessário) para apoio 
* a classe MySqlKinghostUsuarioVersaoDAO
* Não é uma camada visível para outros dispositivos, como as camadas de apresentação e aplicação. 
*
*
* Tabela principal de atuação: USUARIO_VERSAO
*
* Changelog:
*
* 
* @author Julio Cesar Vitorino
* @since 23/08/2019 10:06:20
*
*/
require_once 'UsuarioVersaoDTO.php';
require_once 'UsuarioVersaoDAO.php';
require_once 'DmlSqlUsuarioVersao.php';

require_once '../variavel/VariavelCache.php';
require_once '../daofactory/DmlSql.php';

class MySqlKinghostUsuarioVersaoDAO implements UsuarioVersaoDAO
{
    private $daofactory;

    function __construct($daofactory)
    {
        $this->daofactory = $daofactory;
    }

/**
* loadMaxPKIdUsuarioIdVersao() - Carrega um MaxID (pk) para um $id_usuario, $id_versao
*
* @param $id_usuario
* @param $id_versao
* @return $dto
*/ 
    public function loadMaxPKIdUsuarioIdVersao($id_usuario, $id_versao)
    {   
        $retorno = 0;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $sql = DmlSqlUsuarioVersao::SELECT_MAX_PK . ' WHERE ' 
        . DmlSqlUsuarioVersao::USUA_ID . " = $id_usuario "
        . " AND " . DmlSqlUsuarioVersao::VERS_ID . " = $id_versao ";

        $res = $conexao->query($sql);
        if ($res){
            $tmp = $res->fetch_assoc();
            $retorno = $tmp['maxid'] == NULL ? 0 : $tmp['maxid'];
        }
        return $retorno;

    }


/**
* loadMaxId_VersaoPK() - Carrega um MaxID (pk) para um ${CAMPO} e status
*
* @param $id_versao
* @param $status
* @return $dto
*/ 

    public function loadMaxId_VersaoPK($id_versao,$status)
    {   
        $retorno = 0;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $sql = DmlSqlUsuarioVersao::SELECT_MAX_PK . ' WHERE ' 
        . DmlSqlUsuarioVersao::VERS_ID . " = $id_versao "
        . " AND " . DmlSqlUsuarioVersao::USVE_IN_STATUS . " = '$status'";

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
* listAll() - Lista todos os registros provenientes de USUARIO_VERSAO sem critério de paginação
*
* @return List<UsuarioVersaoDTO>[]
*/ 
    public function listAll()   {   }

/**
* update() - atualiza apenas um registro com base no dto UsuarioVersaoDTO->id
* @param $daofactory
*
* @return boolean
*/ 
    public function update($dto)
    {   
        $retorno = false;

        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $stmt = $conexao->prepare(DmlSqlUsuarioVersao::UPD_PK);
        $stmt->bind_param(DmlSql::INTEGER_TYPE 
                            . DmlSql::INTEGER_TYPE 
                            . DmlSql::INTEGER_TYPE 
                            ,$dto->id_versao
                            ,$dto->id_usuario
                            ,$dto->id );
        if ($stmt->execute())
        {
            $retorno = true;
        }

        return $retorno;
    }

/**
* delete() - excluir fisicamente um registro com base no dto UsuarioVersaoDTO->id
*
* @return boolean
*/ 
    public function delete($dto)
    {   
        $retorno = false;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $stmt = $conexao->prepare(DmlSqlUsuarioVersao::DEL_PK);
        $stmt->bind_param(DmlSql::INTEGER_TYPE
                            ,$dto->id);
        if ($stmt->execute())
        {
            $retorno = true;
        }

        return $retorno;
    }


    public function listUsuarioVersaoStatus($status)
    {
        $retorno = array();

        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $res = $conexao->query(DmlSqlUsuarioVersao::SELECT . 'WHERE `' . DmlSqlUsuarioVersao::USVE_IN_STATUS . "` = '$status'" );
        if ($res){
            while ($row = $res->fetch_assoc()) {
                array_push($retorno, $this->getDTO($row));
            }
        }
        return $retorno;
    }

/**
* countUsuarioVersaoPorStatus() - contar a quantidade de registros
* sob o contexto da classe UsuarioVersao com base no status específico. 
*
* Atenção em @see $sql na tabela USUARIO_VERSAO 
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

    public function countUsuarioVersaoPorStatus($status)
    {   
        $retorno = 0;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $res = $conexao->query(DmlSqlUsuarioVersao::SQL_COUNT . ' WHERE ' 
        . DmlSqlUsuarioVersao::USVE_IN_STATUS . " = '$status'"
        );
        if ($res){
            $tmp = $res->fetch_assoc();
            $retorno = $tmp['contador'];
        }
        return $retorno;

    }

/**
* listUsuarioVersaoPorStatus() - Listar um conjunto de registro previamente paginado
* sob o contexto da classe UsuarioVersao com base no status específico.
*
* Atenção em @see $sql na tabela USUARIO_VERSAO 
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

    public function listUsuarioVersaoPorStatus($status, $pag, $qtde, $coluna, $ordem)
    {
        $sql = DmlSqlUsuarioVersao::SELECT 
        . ' WHERE ' . DmlSqlUsuarioVersao::USVE_IN_STATUS . " = '$status'"
        . ' ORDER BY ' . $coluna . ($ordem == 0 ? " ASC": " DESC");
        return $this->listPagina($sql, $pag, $qtde);
    }

/**
* countUsuarioVersaoPorUsuaIdStatus() - contar a quantidade de registros
* sob o contexto da classe UsuarioVersao com base no usuário específico. Esse usuário
* é o usuário logado na sessão ou no próprio dispositivo móvel e de acordo com a 
* query em @see $sql na tabela USUARIO_VERSAO 
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

    public function countUsuarioVersaoPorUsuaIdStatus($usuaid, $status)
    {   
        $retorno = 0;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $res = $conexao->query(DmlSqlUsuarioVersao::SQL_COUNT . ' WHERE ' 
        . DmlSqlUsuarioVersao::USUA_ID . " = $usuaid "
        . ' AND ' . DmlSqlUsuarioVersao::USVE_IN_STATUS . " = '$status'"
        );
        if ($res){
            $tmp = $res->fetch_assoc();
            $retorno = $tmp['contador'];
        }
        return $retorno;

    }

/**
* listUsuarioVersaoPorUsuaIdStatus() - Listar um conjunto de registro previamente paginado
* sob o contexto da classe UsuarioVersao com base no usuário específico. Esse usuário
* é o usuário logado na sessão ou no próprio dispositivo móvel e de acordo com a 
* query em @see $sql na tabela USUARIO_VERSAO 
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
    public function listUsuarioVersaoPorUsuaIdStatus($usuaid, $status, $pag, $qtde, $coluna, $ordem)
    {
        $sql = DmlSqlUsuarioVersao::SELECT 
        . ' WHERE ' . DmlSqlUsuarioVersao::USUA_ID . " = $usuaid "
        . ' AND ' . DmlSqlUsuarioVersao::USVE_IN_STATUS . " = '$status'"
        . ' ORDER BY ' . $coluna . ($ordem == 0 ? " ASC": " DESC");
        return $this->listPagina($sql, $pag, $qtde);
    }

/**
* listPagina() - Listar um conjunto de registro previamente paginado
* e de acordo com a query em @see $sql na tabela USUARIO_VERSAO 
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
* na tabela USUARIO_VERSAO usando a Primary Key USVE_ID
*
* @param $id
* @return UsuarioVersaoDTO
*/ 
    public function loadPK($id)
    {   
        $retorno = NULL;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $res = $conexao->query(DmlSqlUsuarioVersao::SELECT . ' WHERE ' . DmlSqlUsuarioVersao::USVE_ID . '=' . $id );
        if ($res){
            $retorno = $this->getDTO($res->fetch_assoc());
        }
        return $retorno;
    }

/**
* updateStatus() - atualizar o campo de STATUS utilizando a id como item de busca
* na tabela USUARIO_VERSAO usando a Primary Key USVE_ID
*
* @param $id
* @param $status
*
* @return UsuarioVersaoDTO
*/ 
    public function updateStatus($id, $status)
    {   
        $retorno = false;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $stmt = $conexao->prepare(DmlSqlUsuarioVersao::UPD_STATUS);
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
* insert() - inserir um registro com base no UsuarioVersaoDTO. Alguns atributos dentro do DTO
* serão ignorados caso estejam populados, pois os mesmos possuem constraint de DEFAULT value
* ou campos de AUTO INCREMENTO já previamente definidos no DDL de criação de tabelas do BD.
*
* Atributos da classe UsuarioVersaoDTO sumariamente IGNORADOS por este método MESMO que estejam preenchidos:
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
        $stmt = $conexao->prepare(DmlSqlUsuarioVersao::INS);
        $stmt->bind_param(DmlSql::INTEGER_TYPE 
                            . DmlSql::INTEGER_TYPE 
                            ,$dto->id_versao
                            ,$dto->id_usuario
        );
        if ($stmt->execute())
        {
            $retorno = true;
        }

        return $retorno;
    }

    /**
     * getDTO() - Transforma o resultset padrão em UsuarioVersaoDTO
    */
    public function getDTO($resultset)
    {
        //echo var_dump($resultset); // ótimo pra debugar
        $retorno = new UsuarioVersaoDTO();
        $retorno->id = $resultset[DmlSqlUsuarioVersao::USVE_ID] == NULL ? NULL : (int) $resultset[DmlSqlUsuarioVersao::USVE_ID];
        $retorno->id_versao = $resultset[DmlSqlUsuarioVersao::VERS_ID] == NULL ? NULL :(int) $resultset[DmlSqlUsuarioVersao::VERS_ID];
        $retorno->id_usuario = $resultset[DmlSqlUsuarioVersao::USUA_ID] == NULL ? NULL :(int) $resultset[DmlSqlUsuarioVersao::USUA_ID];
        $retorno->status = $resultset[DmlSqlUsuarioVersao::USVE_IN_STATUS] == NULL ? NULL : $resultset[DmlSqlUsuarioVersao::USVE_IN_STATUS];
        $retorno->dataCadastro = Util::MySQLDate_to_DMYHMiS($resultset[DmlSqlUsuarioVersao::USVE_DT_CADASTRO]);
        $retorno->dataAtualizacao = Util::MySQLDate_to_DMYHMiS($resultset[DmlSqlUsuarioVersao::USVE_DT_UPDATE]);
        $retorno->statusdesc = VariavelCache::getInstance()->getStatusDesc($retorno->status);
        return $retorno;

    }

    /**
    * updateId_Versao() - implementação da assinatura em UsuarioVersaoDAO
    */
    public function updateId_Versao($id, $id_versao)
    {   
        $retorno = false;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $stmt = $conexao->prepare(DmlSqlUsuarioVersao::UPD_USUARIO_VERSAO_VERS_ID_PK);
        $stmt->bind_param(DmlSql::INTEGER_TYPE 
                            . DmlSql::INTEGER_TYPE
                            ,$id_versao
                            ,$id);
        if ($stmt->execute())
        {
            $retorno = true;
        }

        return $retorno;
    }

    /**
    * updateId_Usuario() - implementação da assinatura em UsuarioVersaoDAO
    */
    public function updateId_Usuario($id, $id_usuario)
    {   
        $retorno = false;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $stmt = $conexao->prepare(DmlSqlUsuarioVersao::UPD_USUARIO_VERSAO_USUA_ID_PK);
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
    * loadId_Versao() - implementação da assinatura em UsuarioVersaoDAO
    */

    public function loadId_Versao($id_versao)
    {   
        $retorno = NULL;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $res = $conexao->query(DmlSqlUsuarioVersao::SELECT . ' WHERE ' . DmlSqlUsuarioVersao::VERS_ID . '=' . $id_versao );
        if ($res){
            $retorno = $this->getDTO($res->fetch_assoc());
        }
        return $retorno;
    }

    /**
    * loadId_Usuario() - implementação da assinatura em UsuarioVersaoDAO
    */

    public function loadId_Usuario($id_usuario)
    {   
        $retorno = NULL;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $res = $conexao->query(DmlSqlUsuarioVersao::SELECT . ' WHERE ' . DmlSqlUsuarioVersao::USUA_ID . '=' . $id_usuario );
        if ($res){
            $retorno = $this->getDTO($res->fetch_assoc());
        }
        return $retorno;
    }

    /**
    * loadStatus() - implementação da assinatura em UsuarioVersaoDAO
    */

    public function loadStatus($status)
    {   
        $retorno = NULL;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $res = $conexao->query(DmlSqlUsuarioVersao::SELECT . ' WHERE ' . DmlSqlUsuarioVersao::USVE_IN_STATUS . '=' . $status );
        if ($res){
            $retorno = $this->getDTO($res->fetch_assoc());
        }
        return $retorno;
    }

    /**
    * loadDatacadastro() - implementação da assinatura em UsuarioVersaoDAO
    */

    public function loadDatacadastro($dataCadastro)
    {   
        $retorno = NULL;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $res = $conexao->query(DmlSqlUsuarioVersao::SELECT . ' WHERE ' . DmlSqlUsuarioVersao::USVE_DT_CADASTRO . '=' . $dataCadastro );
        if ($res){
            $retorno = $this->getDTO($res->fetch_assoc());
        }
        return $retorno;
    }

    /**
    * loadDataatualizacao() - implementação da assinatura em UsuarioVersaoDAO
    */

    public function loadDataatualizacao($dataAtualizacao)
    {   
        $retorno = NULL;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $res = $conexao->query(DmlSqlUsuarioVersao::SELECT . ' WHERE ' . DmlSqlUsuarioVersao::USVE_DT_UPDATE . '=' . $dataAtualizacao );
        if ($res){
            $retorno = $this->getDTO($res->fetch_assoc());
        }
        return $retorno;
    }

}
?>
