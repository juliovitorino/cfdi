<?php

/**
* MySqlKinghostUsuarioComplementoDAO - Implementação DAO
*
* Classe de com todos os comandos DML e DDL (se necessário) para apoio 
* a classe MySqlKinghostUsuarioComplementoDAO
* Não é uma camada visível para outros dispositivos, como as camadas de apresentação e aplicação. 
*
*
* Tabela principal de atuação: USUARIO_COMPLEMENTO
*
* Changelog:
*
* 
* @author Julio Cesar Vitorino
* @since 23/08/2019 10:06:20
*
*/
require_once 'UsuarioComplementoDTO.php';
require_once 'UsuarioComplementoDAO.php';
require_once 'DmlSqlUsuarioComplemento.php';

require_once '../mensagem/ConstantesMensagem.php';
require_once '../mensagem/MensagemCache.php';
require_once '../variavel/VariavelCache.php';
require_once '../daofactory/DmlSql.php';

class MySqlKinghostUsuarioComplementoDAO implements UsuarioComplementoDAO
{
    private $daofactory;

    function __construct($daofactory)
    {
        $this->daofactory = $daofactory;
    }


/**
* loadMaxIdusuarioPK() - Carrega um MaxID (pk) para um ${CAMPO} e status
*
* @param $idUsuario
* @param $status
* @return $dto
*/ 

    public function loadMaxIdusuarioPK($idUsuario,$status)
    {   
        $retorno = 0;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $sql = DmlSqlUsuarioComplemento::SELECT_MAX_PK . ' WHERE ' 
        . DmlSqlUsuarioComplemento::USUA_ID . " = $idUsuario "
        . " AND " . DmlSqlUsuarioComplemento::USCO_IN_STATUS . " = '$status'";

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
* listAll() - Lista todos os registros provenientes de USUARIO_COMPLEMENTO sem critério de paginação
*
* @return List<UsuarioComplementoDTO>[]
*/ 
    public function listAll()   {   }

/**
* update() - atualiza apenas um registro com base no dto UsuarioComplementoDTO->id
* @param $daofactory
*
* @return boolean
*/ 
    public function update($dto)
    {   
        $retorno = false;

        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $stmt = $conexao->prepare(DmlSqlUsuarioComplemento::UPD_PK);
        $stmt->bind_param(DmlSql::INTEGER_TYPE 
                            . DmlSql::STRING_TYPE 
                            . DmlSql::STRING_TYPE 
                            . DmlSql::STRING_TYPE 
                            . DmlSql::STRING_TYPE 
                            . DmlSql::STRING_TYPE 
                            . DmlSql::STRING_TYPE 
                            . DmlSql::STRING_TYPE 
                            . DmlSql::STRING_TYPE 
                            . DmlSql::STRING_TYPE 
                            . DmlSql::STRING_TYPE 
                            . DmlSql::STRING_TYPE 
                            . DmlSql::STRING_TYPE 
                            . DmlSql::STRING_TYPE 
                            . DmlSql::STRING_TYPE 
                            . DmlSql::STRING_TYPE 
                            . DmlSql::INTEGER_TYPE 
                            ,$dto->idUsuario
                            ,$dto->ddd
                            ,$dto->telefone
                            ,$dto->nomeReceitaFederal
                            ,$dto->nomeResponsavel
                            ,$dto->urlsite
                            ,$dto->urlFacebook
                            ,$dto->urlInstagram
                            ,$dto->urlPinterest
                            ,$dto->urlSkype
                            ,$dto->urlTwitter
                            ,$dto->urlFacetime
                            ,$dto->urlResponsavel
                            ,$dto->urlFoto2
                            ,$dto->urlFoto3
                            ,$dto->descLivre
                            ,$dto->id );
        if ($stmt->execute())
        {
            $retorno = true;
        }

        return $retorno;
    }

/**
* delete() - excluir fisicamente um registro com base no dto UsuarioComplementoDTO->id
*
* @return boolean
*/ 
    public function delete($dto)
    {   
        $retorno = false;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $stmt = $conexao->prepare(DmlSqlUsuarioComplemento::DEL_PK);
        $stmt->bind_param(DmlSql::INTEGER_TYPE
                            ,$dto->id);
        if ($stmt->execute())
        {
            $retorno = true;
        }

        return $retorno;
    }


    public function listUsuarioComplementoStatus($status)
    {
        $retorno = array();

        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $res = $conexao->query(DmlSqlUsuarioComplemento::SELECT . 'WHERE `' . DmlSqlUsuarioComplemento::USCO_IN_STATUS . "` = '$status'" );
        if ($res){
            while ($row = $res->fetch_assoc()) {
                array_push($retorno, $this->getDTO($row));
            }
        }
        return $retorno;
    }

/**
* countUsuarioComplementoPorStatus() - contar a quantidade de registros
* sob o contexto da classe UsuarioComplemento com base no status específico. 
*
* Atenção em @see $sql na tabela USUARIO_COMPLEMENTO 
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

    public function countUsuarioComplementoPorStatus($status)
    {   
        $retorno = 0;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $res = $conexao->query(DmlSqlUsuarioComplemento::SQL_COUNT . ' WHERE ' 
        . DmlSqlUsuarioComplemento::USCO_IN_STATUS . " = '$status'"
        );
        if ($res){
            $tmp = $res->fetch_assoc();
            $retorno = $tmp['contador'];
        }
        return $retorno;

    }

/**
* listUsuarioComplementoPorStatus() - Listar um conjunto de registro previamente paginado
* sob o contexto da classe UsuarioComplemento com base no status específico.
*
* Atenção em @see $sql na tabela USUARIO_COMPLEMENTO 
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

    public function listUsuarioComplementoPorStatus($status, $pag, $qtde, $coluna, $ordem)
    {
        $sql = DmlSqlUsuarioComplemento::SELECT 
        . ' WHERE ' . DmlSqlUsuarioComplemento::USCO_IN_STATUS . " = '$status'"
        . ' ORDER BY ' . $coluna . ($ordem == 0 ? " ASC": " DESC");
        return $this->listPagina($sql, $pag, $qtde);
    }

/**
* countUsuarioComplementoPorUsuaIdStatus() - contar a quantidade de registros
* sob o contexto da classe UsuarioComplemento com base no usuário específico. Esse usuário
* é o usuário logado na sessão ou no próprio dispositivo móvel e de acordo com a 
* query em @see $sql na tabela USUARIO_COMPLEMENTO 
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

    public function countUsuarioComplementoPorUsuaIdStatus($usuaid, $status)
    {   
        $retorno = 0;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $res = $conexao->query(DmlSqlUsuarioComplemento::SQL_COUNT . ' WHERE ' 
        . DmlSqlUsuarioComplemento::USUA_ID . " = $usuaid "
        . ' AND ' . DmlSqlUsuarioComplemento::USCO_IN_STATUS . " = '$status'"
        );
        if ($res){
            $tmp = $res->fetch_assoc();
            $retorno = $tmp['contador'];
        }
        return $retorno;

    }

/**
* listUsuarioComplementoPorUsuaIdStatus() - Listar um conjunto de registro previamente paginado
* sob o contexto da classe UsuarioComplemento com base no usuário específico. Esse usuário
* é o usuário logado na sessão ou no próprio dispositivo móvel e de acordo com a 
* query em @see $sql na tabela USUARIO_COMPLEMENTO 
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
    public function listUsuarioComplementoPorUsuaIdStatus($usuaid, $status, $pag, $qtde, $coluna, $ordem)
    {
        $sql = DmlSqlUsuarioComplemento::SELECT 
        . ' WHERE ' . DmlSqlUsuarioComplemento::USUA_ID . " = $usuaid "
        . ' AND ' . DmlSqlUsuarioComplemento::USCO_IN_STATUS . " = '$status'"
        . ' ORDER BY ' . $coluna . ($ordem == 0 ? " ASC": " DESC");
        return $this->listPagina($sql, $pag, $qtde);
    }

/**
* listPagina() - Listar um conjunto de registro previamente paginado
* e de acordo com a query em @see $sql na tabela USUARIO_COMPLEMENTO 
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
* na tabela USUARIO_COMPLEMENTO usando a Primary Key USCO_ID
*
* @param $id
* @return UsuarioComplementoDTO
*/ 
    public function loadPK($id)
    {   
        $retorno = NULL;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $res = $conexao->query(DmlSqlUsuarioComplemento::SELECT . ' WHERE ' . DmlSqlUsuarioComplemento::USCO_ID . '=' . $id );
        if ($res->num_rows > 0){
            $retorno = $this->getDTO($res->fetch_assoc());
        }
        return $retorno;
    }

/**
* updateStatus() - atualizar o campo de STATUS utilizando a id como item de busca
* na tabela USUARIO_COMPLEMENTO usando a Primary Key USCO_ID
*
* @param $id
* @param $status
*
* @return UsuarioComplementoDTO
*/ 
    public function updateStatus($id, $status)
    {   
        $retorno = false;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $stmt = $conexao->prepare(DmlSqlUsuarioComplemento::UPD_STATUS);
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
* insert() - inserir um registro com base no UsuarioComplementoDTO. Alguns atributos dentro do DTO
* serão ignorados caso estejam populados, pois os mesmos possuem constraint de DEFAULT value
* ou campos de AUTO INCREMENTO já previamente definidos no DDL de criação de tabelas do BD.
*
* Atributos da classe UsuarioComplementoDTO sumariamente IGNORADOS por este método MESMO que estejam preenchidos:
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
        $stmt = $conexao->prepare(DmlSqlUsuarioComplemento::INS);
        $stmt->bind_param(DmlSql::INTEGER_TYPE 
                            ,$dto->idUsuario
        );
        if ($stmt->execute())
        {
            $retorno = true;
        }

        return $retorno;
    }

    /**
     * getDTO() - Transforma o resultset padrão em UsuarioComplementoDTO
    */
    public function getDTO($resultset)
    {
        if(is_null($resultset)){
            return NULL;
        }

        //echo var_dump($resultset); // ótimo pra debugar
        $retorno = new UsuarioComplementoDTO();
        $retorno->id = $resultset[DmlSqlUsuarioComplemento::USCO_ID] == NULL ? NULL : $resultset[DmlSqlUsuarioComplemento::USCO_ID];
        $retorno->idUsuario = $resultset[DmlSqlUsuarioComplemento::USUA_ID] == NULL ? NULL : $resultset[DmlSqlUsuarioComplemento::USUA_ID];
        $retorno->ddd = $resultset[DmlSqlUsuarioComplemento::USCO_TX_DDD] == NULL ? NULL : $resultset[DmlSqlUsuarioComplemento::USCO_TX_DDD];
        $retorno->telefone = $resultset[DmlSqlUsuarioComplemento::USCO_TX_CEL] == NULL ? NULL : $resultset[DmlSqlUsuarioComplemento::USCO_TX_CEL];
        $retorno->nomeReceitaFederal = $resultset[DmlSqlUsuarioComplemento::USCO_NM_RECEITA_FEDERAL] == NULL ? NULL : $resultset[DmlSqlUsuarioComplemento::USCO_NM_RECEITA_FEDERAL];
        $retorno->nomeResponsavel = $resultset[DmlSqlUsuarioComplemento::USCO_NM_RESPONSAVEL] == NULL ? NULL : $resultset[DmlSqlUsuarioComplemento::USCO_NM_RESPONSAVEL];
        $retorno->urlsite = $resultset[DmlSqlUsuarioComplemento::USCO_TX_URL_WEBSITE] == NULL ? NULL : $resultset[DmlSqlUsuarioComplemento::USCO_TX_URL_WEBSITE];
        $retorno->urlFacebook = $resultset[DmlSqlUsuarioComplemento::USCO_TX_URL_FACEBOOK] == NULL ? NULL : $resultset[DmlSqlUsuarioComplemento::USCO_TX_URL_FACEBOOK];
        $retorno->urlInstagram = $resultset[DmlSqlUsuarioComplemento::USCO_TX_URL_INSTAGRAM] == NULL ? NULL : $resultset[DmlSqlUsuarioComplemento::USCO_TX_URL_INSTAGRAM];
        $retorno->urlPinterest = $resultset[DmlSqlUsuarioComplemento::USCO_TX_URL_PINTEREST] == NULL ? NULL : $resultset[DmlSqlUsuarioComplemento::USCO_TX_URL_PINTEREST];
        $retorno->urlSkype = $resultset[DmlSqlUsuarioComplemento::USCO_TX_URL_SKYPE] == NULL ? NULL : $resultset[DmlSqlUsuarioComplemento::USCO_TX_URL_SKYPE];
        $retorno->urlTwitter = $resultset[DmlSqlUsuarioComplemento::USCO_TX_URL_TWITTER] == NULL ? NULL : $resultset[DmlSqlUsuarioComplemento::USCO_TX_URL_TWITTER];
        $retorno->urlFacetime = $resultset[DmlSqlUsuarioComplemento::USCO_TX_URL_FACETIME] == NULL ? NULL : $resultset[DmlSqlUsuarioComplemento::USCO_TX_URL_FACETIME];
        $retorno->urlResponsavel = $resultset[DmlSqlUsuarioComplemento::USCO_TX_URL_IMG1] == NULL ? NULL : $resultset[DmlSqlUsuarioComplemento::USCO_TX_URL_IMG1];
        $retorno->urlFoto2 = $resultset[DmlSqlUsuarioComplemento::USCO_TX_URL_IMG2] == NULL ? NULL : $resultset[DmlSqlUsuarioComplemento::USCO_TX_URL_IMG2];
        $retorno->urlFoto3 = $resultset[DmlSqlUsuarioComplemento::USCO_TX_URL_IMG3] == NULL ? NULL : $resultset[DmlSqlUsuarioComplemento::USCO_TX_URL_IMG3];
        $retorno->descLivre = $resultset[DmlSqlUsuarioComplemento::USCO_TX_DESC_LIVRE] == NULL ? NULL : $resultset[DmlSqlUsuarioComplemento::USCO_TX_DESC_LIVRE];
        $retorno->status = $resultset[DmlSqlUsuarioComplemento::USCO_IN_STATUS] == NULL ? NULL : $resultset[DmlSqlUsuarioComplemento::USCO_IN_STATUS];
        $retorno->dataCadastro = Util::MySQLDate_to_DMYHMiS($resultset[DmlSqlUsuarioComplemento::USCO_DT_CADASTRO]);
        $retorno->dataAtualizacao = Util::MySQLDate_to_DMYHMiS($resultset[DmlSqlUsuarioComplemento::USCO_DT_UPDATE]);
        $retorno->statusdesc = VariavelCache::getInstance()->getStatusDesc($retorno->status);
        $retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
        $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);
        return $retorno;

    }

    /**
    * updateIdusuario() - implementação da assinatura em UsuarioComplementoDAO
    */
    public function updateIdusuario($id, $idUsuario)
    {   
        $retorno = false;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $stmt = $conexao->prepare(DmlSqlUsuarioComplemento::UPD_USUARIO_COMPLEMENTO_USUA_ID_PK);
        $stmt->bind_param(DmlSql::INTEGER_TYPE 
                            . DmlSql::INTEGER_TYPE
                            ,$idUsuario
                            ,$id);
        if ($stmt->execute())
        {
            $retorno = true;
        }

        return $retorno;
    }

    /**
    * updateDdd() - implementação da assinatura em UsuarioComplementoDAO
    */
    public function updateDdd($id, $ddd)
    {   
        $retorno = false;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $stmt = $conexao->prepare(DmlSqlUsuarioComplemento::UPD_USUARIO_COMPLEMENTO_USCO_TX_DDD_PK);
        $stmt->bind_param(DmlSql::STRING_TYPE 
                            . DmlSql::STRING_TYPE
                            ,$ddd
                            ,$id);
        if ($stmt->execute())
        {
            $retorno = true;
        }

        return $retorno;
    }

    /**
    * updateTelefone() - implementação da assinatura em UsuarioComplementoDAO
    */
    public function updateTelefone($id, $telefone)
    {   
        $retorno = false;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $stmt = $conexao->prepare(DmlSqlUsuarioComplemento::UPD_USUARIO_COMPLEMENTO_USCO_TX_CEL_PK);
        $stmt->bind_param(DmlSql::STRING_TYPE 
                            . DmlSql::STRING_TYPE
                            ,$telefone
                            ,$id);
        if ($stmt->execute())
        {
            $retorno = true;
        }

        return $retorno;
    }

    /**
    * updateNomereceitafederal() - implementação da assinatura em UsuarioComplementoDAO
    */
    public function updateNomereceitafederal($id, $nomeReceitaFederal)
    {   
        $retorno = false;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $stmt = $conexao->prepare(DmlSqlUsuarioComplemento::UPD_USUARIO_COMPLEMENTO_USCO_NM_RECEITA_FEDERAL_PK);
        $stmt->bind_param(DmlSql::STRING_TYPE 
                            . DmlSql::STRING_TYPE
                            ,$nomeReceitaFederal
                            ,$id);
        if ($stmt->execute())
        {
            $retorno = true;
        }

        return $retorno;
    }

    /**
    * updateNomeresponsavel() - implementação da assinatura em UsuarioComplementoDAO
    */
    public function updateNomeresponsavel($id, $nomeResponsavel)
    {   
        $retorno = false;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $stmt = $conexao->prepare(DmlSqlUsuarioComplemento::UPD_USUARIO_COMPLEMENTO_USCO_NM_RESPONSAVEL_PK);
        $stmt->bind_param(DmlSql::STRING_TYPE 
                            . DmlSql::STRING_TYPE
                            ,$nomeResponsavel
                            ,$id);
        if ($stmt->execute())
        {
            $retorno = true;
        }

        return $retorno;
    }

    /**
    * updateUrlsite() - implementação da assinatura em UsuarioComplementoDAO
    */
    public function updateUrlsite($id, $urlsite)
    {   
        $retorno = false;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $stmt = $conexao->prepare(DmlSqlUsuarioComplemento::UPD_USUARIO_COMPLEMENTO_USCO_TX_URL_WEBSITE_PK);
        $stmt->bind_param(DmlSql::STRING_TYPE 
                            . DmlSql::STRING_TYPE
                            ,$urlsite
                            ,$id);
        if ($stmt->execute())
        {
            $retorno = true;
        }

        return $retorno;
    }

    /**
    * updateUrlfacebook() - implementação da assinatura em UsuarioComplementoDAO
    */
    public function updateUrlfacebook($id, $urlFacebook)
    {   
        $retorno = false;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $stmt = $conexao->prepare(DmlSqlUsuarioComplemento::UPD_USUARIO_COMPLEMENTO_USCO_TX_URL_FACEBOOK_PK);
        $stmt->bind_param(DmlSql::STRING_TYPE 
                            . DmlSql::STRING_TYPE
                            ,$urlFacebook
                            ,$id);
        if ($stmt->execute())
        {
            $retorno = true;
        }

        return $retorno;
    }

    /**
    * updateUrlinstagram() - implementação da assinatura em UsuarioComplementoDAO
    */
    public function updateUrlinstagram($id, $urlInstagram)
    {   
        $retorno = false;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $stmt = $conexao->prepare(DmlSqlUsuarioComplemento::UPD_USUARIO_COMPLEMENTO_USCO_TX_URL_INSTAGRAM_PK);
        $stmt->bind_param(DmlSql::STRING_TYPE 
                            . DmlSql::STRING_TYPE
                            ,$urlInstagram
                            ,$id);
        if ($stmt->execute())
        {
            $retorno = true;
        }

        return $retorno;
    }

    /**
    * updateUrlpinterest() - implementação da assinatura em UsuarioComplementoDAO
    */
    public function updateUrlpinterest($id, $urlPinterest)
    {   
        $retorno = false;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $stmt = $conexao->prepare(DmlSqlUsuarioComplemento::UPD_USUARIO_COMPLEMENTO_USCO_TX_URL_PINTEREST_PK);
        $stmt->bind_param(DmlSql::STRING_TYPE 
                            . DmlSql::STRING_TYPE
                            ,$urlPinterest
                            ,$id);
        if ($stmt->execute())
        {
            $retorno = true;
        }

        return $retorno;
    }

    /**
    * updateUrlskype() - implementação da assinatura em UsuarioComplementoDAO
    */
    public function updateUrlskype($id, $urlSkype)
    {   
        $retorno = false;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $stmt = $conexao->prepare(DmlSqlUsuarioComplemento::UPD_USUARIO_COMPLEMENTO_USCO_TX_URL_SKYPE_PK);
        $stmt->bind_param(DmlSql::STRING_TYPE 
                            . DmlSql::STRING_TYPE
                            ,$urlSkype
                            ,$id);
        if ($stmt->execute())
        {
            $retorno = true;
        }

        return $retorno;
    }

    /**
    * updateUrltwitter() - implementação da assinatura em UsuarioComplementoDAO
    */
    public function updateUrltwitter($id, $urlTwitter)
    {   
        $retorno = false;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $stmt = $conexao->prepare(DmlSqlUsuarioComplemento::UPD_USUARIO_COMPLEMENTO_USCO_TX_URL_TWITTER_PK);
        $stmt->bind_param(DmlSql::STRING_TYPE 
                            . DmlSql::STRING_TYPE
                            ,$urlTwitter
                            ,$id);
        if ($stmt->execute())
        {
            $retorno = true;
        }

        return $retorno;
    }

    /**
    * updateUrlfacetime() - implementação da assinatura em UsuarioComplementoDAO
    */
    public function updateUrlfacetime($id, $urlFacetime)
    {   
        $retorno = false;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $stmt = $conexao->prepare(DmlSqlUsuarioComplemento::UPD_USUARIO_COMPLEMENTO_USCO_TX_URL_FACETIME_PK);
        $stmt->bind_param(DmlSql::STRING_TYPE 
                            . DmlSql::STRING_TYPE
                            ,$urlFacetime
                            ,$id);
        if ($stmt->execute())
        {
            $retorno = true;
        }

        return $retorno;
    }

    /**
    * updateUrlresponsavel() - implementação da assinatura em UsuarioComplementoDAO
    */
    public function updateUrlresponsavel($id, $urlResponsavel)
    {   
        $retorno = false;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $stmt = $conexao->prepare(DmlSqlUsuarioComplemento::UPD_USUARIO_COMPLEMENTO_USCO_TX_URL_IMG1_PK);
        $stmt->bind_param(DmlSql::STRING_TYPE 
                            . DmlSql::STRING_TYPE
                            ,$urlResponsavel
                            ,$id);
        if ($stmt->execute())
        {
            $retorno = true;
        }

        return $retorno;
    }

    /**
    * updateUrlfoto2() - implementação da assinatura em UsuarioComplementoDAO
    */
    public function updateUrlfoto2($id, $urlFoto2)
    {   
        $retorno = false;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $stmt = $conexao->prepare(DmlSqlUsuarioComplemento::UPD_USUARIO_COMPLEMENTO_USCO_TX_URL_IMG2_PK);
        $stmt->bind_param(DmlSql::STRING_TYPE 
                            . DmlSql::STRING_TYPE
                            ,$urlFoto2
                            ,$id);
        if ($stmt->execute())
        {
            $retorno = true;
        }

        return $retorno;
    }

    /**
    * updateUrlfoto3() - implementação da assinatura em UsuarioComplementoDAO
    */
    public function updateUrlfoto3($id, $urlFoto3)
    {   
        $retorno = false;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $stmt = $conexao->prepare(DmlSqlUsuarioComplemento::UPD_USUARIO_COMPLEMENTO_USCO_TX_URL_IMG3_PK);
        $stmt->bind_param(DmlSql::STRING_TYPE 
                            . DmlSql::STRING_TYPE
                            ,$urlFoto3
                            ,$id);
        if ($stmt->execute())
        {
            $retorno = true;
        }

        return $retorno;
    }

    /**
    * updateDesclivre() - implementação da assinatura em UsuarioComplementoDAO
    */
    public function updateDesclivre($id, $descLivre)
    {   
        $retorno = false;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $stmt = $conexao->prepare(DmlSqlUsuarioComplemento::UPD_USUARIO_COMPLEMENTO_USCO_TX_DESC_LIVRE_PK);
        $stmt->bind_param(DmlSql::STRING_TYPE 
                            . DmlSql::STRING_TYPE
                            ,$descLivre
                            ,$id);
        if ($stmt->execute())
        {
            $retorno = true;
        }

        return $retorno;
    }

    /**
    * loadIdusuario() - implementação da assinatura em UsuarioComplementoDAO
    */

    public function loadIdusuario($idUsuario)
    {   
        $retorno = NULL;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $sql = DmlSqlUsuarioComplemento::SELECT . ' WHERE ' . DmlSqlUsuarioComplemento::USUA_ID . '=' . $idUsuario;
        $res = $conexao->query($sql);
        if ($res){
            $retorno = $this->getDTO($res->fetch_assoc());
        }
        return $retorno;
    }
    /**
    * loadDdd() - implementação da assinatura em UsuarioComplementoDAO
    */

    public function loadDdd($ddd)
    {   
        $retorno = NULL;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $sql = DmlSqlUsuarioComplemento::SELECT . ' WHERE ' . DmlSqlUsuarioComplemento::USCO_TX_DDD . '=' . $ddd;
        $res = $conexao->query($sql);
        if ($res){
            $retorno = $this->getDTO($res->fetch_assoc());
        }
        return $retorno;
    }
    /**
    * loadTelefone() - implementação da assinatura em UsuarioComplementoDAO
    */

    public function loadTelefone($telefone)
    {   
        $retorno = NULL;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $sql = DmlSqlUsuarioComplemento::SELECT . ' WHERE ' . DmlSqlUsuarioComplemento::USCO_TX_CEL . '=' . $telefone;
        $res = $conexao->query($sql);
        if ($res){
            $retorno = $this->getDTO($res->fetch_assoc());
        }
        return $retorno;
    }
    /**
    * loadNomereceitafederal() - implementação da assinatura em UsuarioComplementoDAO
    */

    public function loadNomereceitafederal($nomeReceitaFederal)
    {   
        $retorno = NULL;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $sql = DmlSqlUsuarioComplemento::SELECT . ' WHERE ' . DmlSqlUsuarioComplemento::USCO_NM_RECEITA_FEDERAL . '=' . $nomeReceitaFederal;
        $res = $conexao->query($sql);
        if ($res){
            $retorno = $this->getDTO($res->fetch_assoc());
        }
        return $retorno;
    }
    /**
    * loadNomeresponsavel() - implementação da assinatura em UsuarioComplementoDAO
    */

    public function loadNomeresponsavel($nomeResponsavel)
    {   
        $retorno = NULL;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $sql = DmlSqlUsuarioComplemento::SELECT . ' WHERE ' . DmlSqlUsuarioComplemento::USCO_NM_RESPONSAVEL . '=' . $nomeResponsavel;
        $res = $conexao->query($sql);
        if ($res){
            $retorno = $this->getDTO($res->fetch_assoc());
        }
        return $retorno;
    }
    /**
    * loadUrlsite() - implementação da assinatura em UsuarioComplementoDAO
    */

    public function loadUrlsite($urlsite)
    {   
        $retorno = NULL;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $sql = DmlSqlUsuarioComplemento::SELECT . ' WHERE ' . DmlSqlUsuarioComplemento::USCO_TX_URL_WEBSITE . '=' . $urlsite;
        $res = $conexao->query($sql);
        if ($res){
            $retorno = $this->getDTO($res->fetch_assoc());
        }
        return $retorno;
    }
    /**
    * loadUrlfacebook() - implementação da assinatura em UsuarioComplementoDAO
    */

    public function loadUrlfacebook($urlFacebook)
    {   
        $retorno = NULL;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $sql = DmlSqlUsuarioComplemento::SELECT . ' WHERE ' . DmlSqlUsuarioComplemento::USCO_TX_URL_FACEBOOK . '=' . $urlFacebook;
        $res = $conexao->query($sql);
        if ($res){
            $retorno = $this->getDTO($res->fetch_assoc());
        }
        return $retorno;
    }
    /**
    * loadUrlinstagram() - implementação da assinatura em UsuarioComplementoDAO
    */

    public function loadUrlinstagram($urlInstagram)
    {   
        $retorno = NULL;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $sql = DmlSqlUsuarioComplemento::SELECT . ' WHERE ' . DmlSqlUsuarioComplemento::USCO_TX_URL_INSTAGRAM . '=' . $urlInstagram;
        $res = $conexao->query($sql);
        if ($res){
            $retorno = $this->getDTO($res->fetch_assoc());
        }
        return $retorno;
    }
    /**
    * loadUrlpinterest() - implementação da assinatura em UsuarioComplementoDAO
    */

    public function loadUrlpinterest($urlPinterest)
    {   
        $retorno = NULL;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $sql = DmlSqlUsuarioComplemento::SELECT . ' WHERE ' . DmlSqlUsuarioComplemento::USCO_TX_URL_PINTEREST . '=' . $urlPinterest;
        $res = $conexao->query($sql);
        if ($res){
            $retorno = $this->getDTO($res->fetch_assoc());
        }
        return $retorno;
    }
    /**
    * loadUrlskype() - implementação da assinatura em UsuarioComplementoDAO
    */

    public function loadUrlskype($urlSkype)
    {   
        $retorno = NULL;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $sql = DmlSqlUsuarioComplemento::SELECT . ' WHERE ' . DmlSqlUsuarioComplemento::USCO_TX_URL_SKYPE . '=' . $urlSkype;
        $res = $conexao->query($sql);
        if ($res){
            $retorno = $this->getDTO($res->fetch_assoc());
        }
        return $retorno;
    }
    /**
    * loadUrltwitter() - implementação da assinatura em UsuarioComplementoDAO
    */

    public function loadUrltwitter($urlTwitter)
    {   
        $retorno = NULL;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $sql = DmlSqlUsuarioComplemento::SELECT . ' WHERE ' . DmlSqlUsuarioComplemento::USCO_TX_URL_TWITTER . '=' . $urlTwitter;
        $res = $conexao->query($sql);
        if ($res){
            $retorno = $this->getDTO($res->fetch_assoc());
        }
        return $retorno;
    }
    /**
    * loadUrlfacetime() - implementação da assinatura em UsuarioComplementoDAO
    */

    public function loadUrlfacetime($urlFacetime)
    {   
        $retorno = NULL;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $sql = DmlSqlUsuarioComplemento::SELECT . ' WHERE ' . DmlSqlUsuarioComplemento::USCO_TX_URL_FACETIME . '=' . $urlFacetime;
        $res = $conexao->query($sql);
        if ($res){
            $retorno = $this->getDTO($res->fetch_assoc());
        }
        return $retorno;
    }
    /**
    * loadUrlresponsavel() - implementação da assinatura em UsuarioComplementoDAO
    */

    public function loadUrlresponsavel($urlResponsavel)
    {   
        $retorno = NULL;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $sql = DmlSqlUsuarioComplemento::SELECT . ' WHERE ' . DmlSqlUsuarioComplemento::USCO_TX_URL_IMG1 . '=' . $urlResponsavel;
        $res = $conexao->query($sql);
        if ($res){
            $retorno = $this->getDTO($res->fetch_assoc());
        }
        return $retorno;
    }
    /**
    * loadUrlfoto2() - implementação da assinatura em UsuarioComplementoDAO
    */

    public function loadUrlfoto2($urlFoto2)
    {   
        $retorno = NULL;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $sql = DmlSqlUsuarioComplemento::SELECT . ' WHERE ' . DmlSqlUsuarioComplemento::USCO_TX_URL_IMG2 . '=' . $urlFoto2;
        $res = $conexao->query($sql);
        if ($res){
            $retorno = $this->getDTO($res->fetch_assoc());
        }
        return $retorno;
    }
    /**
    * loadUrlfoto3() - implementação da assinatura em UsuarioComplementoDAO
    */

    public function loadUrlfoto3($urlFoto3)
    {   
        $retorno = NULL;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $sql = DmlSqlUsuarioComplemento::SELECT . ' WHERE ' . DmlSqlUsuarioComplemento::USCO_TX_URL_IMG3 . '=' . $urlFoto3;
        $res = $conexao->query($sql);
        if ($res){
            $retorno = $this->getDTO($res->fetch_assoc());
        }
        return $retorno;
    }

    /**
    * loadDesclivre() - implementação da assinatura em UsuarioComplementoDAO
    */

    public function loadDesclivre($descLivre)
    {   
        $retorno = NULL;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $sql = DmlSqlUsuarioComplemento::SELECT . ' WHERE ' . DmlSqlUsuarioComplemento::USCO_TX_DESC_LIVRE . '=' . $descLivre;
        $res = $conexao->query($sql);
        if ($res){
            $retorno = $this->getDTO($res->fetch_assoc());
        }
        return $retorno;
    }
    /**
    * loadStatus() - implementação da assinatura em UsuarioComplementoDAO
    */

    public function loadStatus($status)
    {   
        $retorno = NULL;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $res = $conexao->query(DmlSqlUsuarioComplemento::SELECT . ' WHERE ' . DmlSqlUsuarioComplemento::USCO_IN_STATUS . '=' . $status );
        if ($res){
            $retorno = $this->getDTO($res->fetch_assoc());
        }
        return $retorno;
    }

    /**
    * loadDatacadastro() - implementação da assinatura em UsuarioComplementoDAO
    */

    public function loadDatacadastro($dataCadastro)
    {   
        $retorno = NULL;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $res = $conexao->query(DmlSqlUsuarioComplemento::SELECT . ' WHERE ' . DmlSqlUsuarioComplemento::USCO_DT_CADASTRO . '=' . $dataCadastro );
        if ($res){
            $retorno = $this->getDTO($res->fetch_assoc());
        }
        return $retorno;
    }

    /**
    * loadDataatualizacao() - implementação da assinatura em UsuarioComplementoDAO
    */

    public function loadDataatualizacao($dataAtualizacao)
    {   
        $retorno = NULL;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $res = $conexao->query(DmlSqlUsuarioComplemento::SELECT . ' WHERE ' . DmlSqlUsuarioComplemento::USCO_DT_UPDATE . '=' . $dataAtualizacao );
        if ($res){
            $retorno = $this->getDTO($res->fetch_assoc());
        }
        return $retorno;
    }

}
?>

