<?php

/**
* MySqlKinghostUsuarioAvaliacaoDAO - Implementação DAO
*
* Classe de com todos os comandos DML e DDL (se necessário) para apoio 
* a classe MySqlKinghostUsuarioAvaliacaoDAO
* Não é uma camada visível para outros dispositivos, como as camadas de apresentação e aplicação. 
*
*
* Tabela principal de atuação: USUARIO_AVALIACAO
*
* Changelog:
*
* 
* @author Julio Cesar Vitorino
* @since 23/08/2019 10:06:20
*
*/
require_once 'UsuarioAvaliacaoDTO.php';
require_once 'UsuarioAvaliacaoDAO.php';
require_once 'DmlSqlUsuarioAvaliacao.php';

require_once '../variavel/VariavelCache.php';
require_once '../daofactory/DmlSql.php';

class MySqlKinghostUsuarioAvaliacaoDAO implements UsuarioAvaliacaoDAO
{
    private $daofactory;

    function __construct($daofactory)
    {
        $this->daofactory = $daofactory;
    }


/**
* loadMaxId_UsuarioPK() - Carrega um MaxID (pk) para um ${CAMPO} e status
*
* @param $id_usuario
* @param $status
* @return $dto
*/ 

    public function loadMaxId_UsuarioPK($id_usuario,$status)
    {   
        $retorno = 0;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $sql = DmlSqlUsuarioAvaliacao::SELECT_MAX_PK . ' WHERE ' 
        . DmlSqlUsuarioAvaliacao::USUA_ID . " = $id_usuario "
        . " AND " . DmlSqlUsuarioAvaliacao::USAV_IN_STATUS . " = '$status'";

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
* listAll() - Lista todos os registros provenientes de USUARIO_AVALIACAO sem critério de paginação
*
* @return List<UsuarioAvaliacaoDTO>[]
*/ 
    public function listAll()   {   }

/**
* update() - atualiza apenas um registro com base no dto UsuarioAvaliacaoDTO->id
* @param $daofactory
*
* @return boolean
*/ 
    public function update($dto)
    {   
        $retorno = false;

        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $stmt = $conexao->prepare(DmlSqlUsuarioAvaliacao::UPD_PK);
        $stmt->bind_param(DmlSql::INTEGER_TYPE 
                            . DmlSql::INTEGER_TYPE 
                            . DmlSql::INTEGER_TYPE 
                            . DmlSql::INTEGER_TYPE 
                            . DmlSql::INTEGER_TYPE 
                            . DmlSql::INTEGER_TYPE 
                            . DmlSql::INTEGER_TYPE 
                            . DmlSql::INTEGER_TYPE 
                            ,$dto->id_usuario
                            ,$dto->contadorStar_1
                            ,$dto->contadorStar_2
                            ,$dto->contadorStar_3
                            ,$dto->contadorStar_4
                            ,$dto->contadorStar_5
                            ,$dto->ratingCalculado
                            ,$dto->id );
        if ($stmt->execute())
        {
            $retorno = true;
        }

        return $retorno;
    }

/**
* delete() - excluir fisicamente um registro com base no dto UsuarioAvaliacaoDTO->id
*
* @return boolean
*/ 
    public function delete($dto)
    {   
        $retorno = false;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $stmt = $conexao->prepare(DmlSqlUsuarioAvaliacao::DEL_PK);
        $stmt->bind_param(DmlSql::INTEGER_TYPE
                            ,$dto->id);
        if ($stmt->execute())
        {
            $retorno = true;
        }

        return $retorno;
    }


    public function listUsuarioAvaliacaoStatus($status)
    {
        $retorno = array();

        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $res = $conexao->query(DmlSqlUsuarioAvaliacao::SELECT . 'WHERE `' . DmlSqlUsuarioAvaliacao::USAV_IN_STATUS . "` = '$status'" );
        if ($res){
            while ($row = $res->fetch_assoc()) {
                array_push($retorno, $this->getDTO($row));
            }
        }
        return $retorno;
    }

/**
* countUsuarioAvaliacaoPorStatus() - contar a quantidade de registros
* sob o contexto da classe UsuarioAvaliacao com base no status específico. 
*
* Atenção em @see $sql na tabela USUARIO_AVALIACAO 
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

    public function countUsuarioAvaliacaoPorStatus($status)
    {   
        $retorno = 0;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $res = $conexao->query(DmlSqlUsuarioAvaliacao::SQL_COUNT . ' WHERE ' 
        . DmlSqlUsuarioAvaliacao::USAV_IN_STATUS . " = '$status'"
        );
        if ($res){
            $tmp = $res->fetch_assoc();
            $retorno = $tmp['contador'];
        }
        return $retorno;

    }

/**
* listUsuarioAvaliacaoPorStatus() - Listar um conjunto de registro previamente paginado
* sob o contexto da classe UsuarioAvaliacao com base no status específico.
*
* Atenção em @see $sql na tabela USUARIO_AVALIACAO 
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

    public function listUsuarioAvaliacaoPorStatus($status, $pag, $qtde, $coluna, $ordem)
    {
        $sql = DmlSqlUsuarioAvaliacao::SELECT 
        . ' WHERE ' . DmlSqlUsuarioAvaliacao::USAV_IN_STATUS . " = '$status'"
        . ' ORDER BY ' . $coluna . ($ordem == 0 ? " ASC": " DESC");
        return $this->listPagina($sql, $pag, $qtde);
    }

/**
* countUsuarioAvaliacaoPorUsuaIdStatus() - contar a quantidade de registros
* sob o contexto da classe UsuarioAvaliacao com base no usuário específico. Esse usuário
* é o usuário logado na sessão ou no próprio dispositivo móvel e de acordo com a 
* query em @see $sql na tabela USUARIO_AVALIACAO 
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

    public function countUsuarioAvaliacaoPorUsuaIdStatus($usuaid, $status)
    {   
        $retorno = 0;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $res = $conexao->query(DmlSqlUsuarioAvaliacao::SQL_COUNT . ' WHERE ' 
        . DmlSqlUsuarioAvaliacao::USUA_ID . " = $usuaid "
        . ' AND ' . DmlSqlUsuarioAvaliacao::USAV_IN_STATUS . " = '$status'"
        );
        if ($res){
            $tmp = $res->fetch_assoc();
            $retorno = $tmp['contador'];
        }
        return $retorno;

    }

/**
* listUsuarioAvaliacaoPorUsuaIdStatus() - Listar um conjunto de registro previamente paginado
* sob o contexto da classe UsuarioAvaliacao com base no usuário específico. Esse usuário
* é o usuário logado na sessão ou no próprio dispositivo móvel e de acordo com a 
* query em @see $sql na tabela USUARIO_AVALIACAO 
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
    public function listUsuarioAvaliacaoPorUsuaIdStatus($usuaid, $status, $pag, $qtde, $coluna, $ordem)
    {
        $sql = DmlSqlUsuarioAvaliacao::SELECT 
        . ' WHERE ' . DmlSqlUsuarioAvaliacao::USUA_ID . " = $usuaid "
        . ' AND ' . DmlSqlUsuarioAvaliacao::USAV_IN_STATUS . " = '$status'"
        . ' ORDER BY ' . $coluna . ($ordem == 0 ? " ASC": " DESC");
        return $this->listPagina($sql, $pag, $qtde);
    }

/**
* listPagina() - Listar um conjunto de registro previamente paginado
* e de acordo com a query em @see $sql na tabela USUARIO_AVALIACAO 
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
* na tabela USUARIO_AVALIACAO usando a Primary Key USAV_ID
*
* @param $id
* @return UsuarioAvaliacaoDTO
*/ 
    public function loadPK($id)
    {   
        $retorno = NULL;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $res = $conexao->query(DmlSqlUsuarioAvaliacao::SELECT . ' WHERE ' . DmlSqlUsuarioAvaliacao::USAV_ID . '=' . $id );
        if ($res){
            $retorno = $this->getDTO($res->fetch_assoc());
        }
        return $retorno;
    }

/**
* updateStatus() - atualizar o campo de STATUS utilizando a id como item de busca
* na tabela USUARIO_AVALIACAO usando a Primary Key USAV_ID
*
* @param $id
* @param $status
*
* @return UsuarioAvaliacaoDTO
*/ 
    public function updateStatus($id, $status)
    {   
        $retorno = false;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $stmt = $conexao->prepare(DmlSqlUsuarioAvaliacao::UPD_STATUS);
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
* insert() - inserir um registro com base no UsuarioAvaliacaoDTO. Alguns atributos dentro do DTO
* serão ignorados caso estejam populados, pois os mesmos possuem constraint de DEFAULT value
* ou campos de AUTO INCREMENTO já previamente definidos no DDL de criação de tabelas do BD.
*
* Atributos da classe UsuarioAvaliacaoDTO sumariamente IGNORADOS por este método MESMO que estejam preenchidos:
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
        $stmt = $conexao->prepare(DmlSqlUsuarioAvaliacao::INS);
        $stmt->bind_param(DmlSql::INTEGER_TYPE 
                            ,$dto->id_usuario
        );
        if ($stmt->execute())
        {
            $retorno = true;
        }

        return $retorno;
    }

    /**
     * getDTO() - Transforma o resultset padrão em UsuarioAvaliacaoDTO
    */
    public function getDTO($resultset)
    {
        //echo var_dump($resultset); // ótimo pra debugar
        $retorno = new UsuarioAvaliacaoDTO();
        $retorno->id = $resultset[DmlSqlUsuarioAvaliacao::USAV_ID] == NULL ? NULL : (int) $resultset[DmlSqlUsuarioAvaliacao::USAV_ID];
        $retorno->id_usuario = $resultset[DmlSqlUsuarioAvaliacao::USUA_ID] == NULL ? NULL : (int) $resultset[DmlSqlUsuarioAvaliacao::USUA_ID];
        $retorno->contadorStar_1 = $resultset[DmlSqlUsuarioAvaliacao::USAV_NU_CONT_STAR_1] == NULL ? NULL : (int) $resultset[DmlSqlUsuarioAvaliacao::USAV_NU_CONT_STAR_1];
        $retorno->contadorStar_2 = $resultset[DmlSqlUsuarioAvaliacao::USAV_NU_CONT_STAR_2] == NULL ? NULL : (int) $resultset[DmlSqlUsuarioAvaliacao::USAV_NU_CONT_STAR_2];
        $retorno->contadorStar_3 = $resultset[DmlSqlUsuarioAvaliacao::USAV_NU_CONT_STAR_3] == NULL ? NULL : (int) $resultset[DmlSqlUsuarioAvaliacao::USAV_NU_CONT_STAR_3];
        $retorno->contadorStar_4 = $resultset[DmlSqlUsuarioAvaliacao::USAV_NU_CONT_STAR_4] == NULL ? NULL : (int) $resultset[DmlSqlUsuarioAvaliacao::USAV_NU_CONT_STAR_4];
        $retorno->contadorStar_5 = $resultset[DmlSqlUsuarioAvaliacao::USAV_NU_CONT_STAR_5] == NULL ? NULL : (int) $resultset[DmlSqlUsuarioAvaliacao::USAV_NU_CONT_STAR_5];
        $retorno->ratingCalculado = $resultset[DmlSqlUsuarioAvaliacao::USAV_NU_RATING] == NULL ? NULL : (double) $resultset[DmlSqlUsuarioAvaliacao::USAV_NU_RATING];
        $retorno->status = $resultset[DmlSqlUsuarioAvaliacao::USAV_IN_STATUS] == NULL ? NULL : $resultset[DmlSqlUsuarioAvaliacao::USAV_IN_STATUS];
        $retorno->dataCadastro = Util::MySQLDate_to_DMYHMiS($resultset[DmlSqlUsuarioAvaliacao::USAV_DT_CADASTRO]);
        $retorno->dataAtualizacao = Util::MySQLDate_to_DMYHMiS($resultset[DmlSqlUsuarioAvaliacao::USAV_DT_UPDATE]);
        $retorno->statusdesc = VariavelCache::getInstance()->getStatusDesc($retorno->status);
        return $retorno;

    }
    
    /**
    * incUsuarioAvaliacao() - implementação da assinatura em UsuarioAvaliacaoDAO
    *
    * @param $usuaid
    * @param $rating
    */
    public function incUsuarioAvaliacao($usuaid, $rating)
    {   
        $retorno = false;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch

        $sql = "";
        switch ($rating) {
            case 1:
                $sql = DmlSqlUsuarioAvaliacao::UPD_USAV_NU_CONT_STAR_1;
                break;
            case 2:
                $sql = DmlSqlUsuarioAvaliacao::UPD_USAV_NU_CONT_STAR_2;
                break;
            case 3:
                $sql = DmlSqlUsuarioAvaliacao::UPD_USAV_NU_CONT_STAR_3;
                break;
            case 4:
                $sql = DmlSqlUsuarioAvaliacao::UPD_USAV_NU_CONT_STAR_4;
                break;
            case 5:
                $sql = DmlSqlUsuarioAvaliacao::UPD_USAV_NU_CONT_STAR_5;
                break;
        }

        $conexao = $this->daofactory->getSession();
        $stmt = $conexao->prepare($sql);
        $stmt->bind_param(DmlSql::INTEGER_TYPE 
                            ,$usuaid);
        if ($stmt->execute())
        {
            $retorno = true;
        }

        return $retorno;
    }


    /**
    * updateId_Usuario() - implementação da assinatura em UsuarioAvaliacaoDAO
    */
    public function updateId_Usuario($id, $id_usuario)
    {   
        $retorno = false;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $stmt = $conexao->prepare(DmlSqlUsuarioAvaliacao::UPD_USUARIO_AVALIACAO_USUA_ID_PK);
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
    * updateContadorstar_1() - implementação da assinatura em UsuarioAvaliacaoDAO
    */
    public function updateContadorstar_1($id, $contadorStar_1)
    {   
        $retorno = false;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $stmt = $conexao->prepare(DmlSqlUsuarioAvaliacao::UPD_USUARIO_AVALIACAO_USAV_NU_CONT_STAR_1_PK);
        $stmt->bind_param(DmlSql::INTEGER_TYPE 
                            . DmlSql::INTEGER_TYPE
                            ,$contadorStar_1
                            ,$id);
        if ($stmt->execute())
        {
            $retorno = true;
        }

        return $retorno;
    }

    /**
    * updateContadorstar_2() - implementação da assinatura em UsuarioAvaliacaoDAO
    */
    public function updateContadorstar_2($id, $contadorStar_2)
    {   
        $retorno = false;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $stmt = $conexao->prepare(DmlSqlUsuarioAvaliacao::UPD_USUARIO_AVALIACAO_USAV_NU_CONT_STAR_2_PK);
        $stmt->bind_param(DmlSql::INTEGER_TYPE 
                            . DmlSql::INTEGER_TYPE
                            ,$contadorStar_2
                            ,$id);
        if ($stmt->execute())
        {
            $retorno = true;
        }

        return $retorno;
    }

    /**
    * updateContadorstar_3() - implementação da assinatura em UsuarioAvaliacaoDAO
    */
    public function updateContadorstar_3($id, $contadorStar_3)
    {   
        $retorno = false;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $stmt = $conexao->prepare(DmlSqlUsuarioAvaliacao::UPD_USUARIO_AVALIACAO_USAV_NU_CONT_STAR_3_PK);
        $stmt->bind_param(DmlSql::INTEGER_TYPE 
                            . DmlSql::INTEGER_TYPE
                            ,$contadorStar_3
                            ,$id);
        if ($stmt->execute())
        {
            $retorno = true;
        }

        return $retorno;
    }

    /**
    * updateContadorstar_4() - implementação da assinatura em UsuarioAvaliacaoDAO
    */
    public function updateContadorstar_4($id, $contadorStar_4)
    {   
        $retorno = false;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $stmt = $conexao->prepare(DmlSqlUsuarioAvaliacao::UPD_USUARIO_AVALIACAO_USAV_NU_CONT_STAR_4_PK);
        $stmt->bind_param(DmlSql::INTEGER_TYPE 
                            . DmlSql::INTEGER_TYPE
                            ,$contadorStar_4
                            ,$id);
        if ($stmt->execute())
        {
            $retorno = true;
        }

        return $retorno;
    }

    /**
    * updateContadorstar_5() - implementação da assinatura em UsuarioAvaliacaoDAO
    */
    public function updateContadorstar_5($id, $contadorStar_5)
    {   
        $retorno = false;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $stmt = $conexao->prepare(DmlSqlUsuarioAvaliacao::UPD_USUARIO_AVALIACAO_USAV_NU_CONT_STAR_5_PK);
        $stmt->bind_param(DmlSql::INTEGER_TYPE 
                            . DmlSql::INTEGER_TYPE
                            ,$contadorStar_5
                            ,$id);
        if ($stmt->execute())
        {
            $retorno = true;
        }

        return $retorno;
    }

    /**
    * updateRatingcalculado() - implementação da assinatura em UsuarioAvaliacaoDAO
    */
    public function updateRatingcalculado($id, $ratingCalculado)
    {   
        $retorno = false;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $stmt = $conexao->prepare(DmlSqlUsuarioAvaliacao::UPD_USUARIO_AVALIACAO_USAV_NU_RATING_PK);
        $stmt->bind_param(DmlSql::DOUBLE_TYPE 
                            . DmlSql::INTEGER_TYPE
                            ,$ratingCalculado
                            ,$id);
        if ($stmt->execute())
        {
            $retorno = true;
        }

        return $retorno;
    }

    /**
    * loadId_Usuario() - implementação da assinatura em UsuarioAvaliacaoDAO
    */

    public function loadId_Usuario($id_usuario)
    {   
        $retorno = NULL;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $res = $conexao->query(DmlSqlUsuarioAvaliacao::SELECT . ' WHERE ' . DmlSqlUsuarioAvaliacao::USUA_ID . '=' . $id_usuario );
        if ($res){
            $retorno = $this->getDTO($res->fetch_assoc());
        }
        return $retorno;
    }

    /**
    * loadContadorstar_1() - implementação da assinatura em UsuarioAvaliacaoDAO
    */

    public function loadContadorstar_1($contadorStar_1)
    {   
        $retorno = NULL;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $res = $conexao->query(DmlSqlUsuarioAvaliacao::SELECT . ' WHERE ' . DmlSqlUsuarioAvaliacao::USAV_NU_CONT_STAR_1 . '=' . $contadorStar_1 );
        if ($res){
            $retorno = $this->getDTO($res->fetch_assoc());
        }
        return $retorno;
    }

    /**
    * loadContadorstar_2() - implementação da assinatura em UsuarioAvaliacaoDAO
    */

    public function loadContadorstar_2($contadorStar_2)
    {   
        $retorno = NULL;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $res = $conexao->query(DmlSqlUsuarioAvaliacao::SELECT . ' WHERE ' . DmlSqlUsuarioAvaliacao::USAV_NU_CONT_STAR_2 . '=' . $contadorStar_2 );
        if ($res){
            $retorno = $this->getDTO($res->fetch_assoc());
        }
        return $retorno;
    }

    /**
    * loadContadorstar_3() - implementação da assinatura em UsuarioAvaliacaoDAO
    */

    public function loadContadorstar_3($contadorStar_3)
    {   
        $retorno = NULL;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $res = $conexao->query(DmlSqlUsuarioAvaliacao::SELECT . ' WHERE ' . DmlSqlUsuarioAvaliacao::USAV_NU_CONT_STAR_3 . '=' . $contadorStar_3 );
        if ($res){
            $retorno = $this->getDTO($res->fetch_assoc());
        }
        return $retorno;
    }

    /**
    * loadContadorstar_4() - implementação da assinatura em UsuarioAvaliacaoDAO
    */

    public function loadContadorstar_4($contadorStar_4)
    {   
        $retorno = NULL;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $res = $conexao->query(DmlSqlUsuarioAvaliacao::SELECT . ' WHERE ' . DmlSqlUsuarioAvaliacao::USAV_NU_CONT_STAR_4 . '=' . $contadorStar_4 );
        if ($res){
            $retorno = $this->getDTO($res->fetch_assoc());
        }
        return $retorno;
    }

    /**
    * loadContadorstar_5() - implementação da assinatura em UsuarioAvaliacaoDAO
    */

    public function loadContadorstar_5($contadorStar_5)
    {   
        $retorno = NULL;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $res = $conexao->query(DmlSqlUsuarioAvaliacao::SELECT . ' WHERE ' . DmlSqlUsuarioAvaliacao::USAV_NU_CONT_STAR_5 . '=' . $contadorStar_5 );
        if ($res){
            $retorno = $this->getDTO($res->fetch_assoc());
        }
        return $retorno;
    }

    /**
    * loadRatingcalculado() - implementação da assinatura em UsuarioAvaliacaoDAO
    */

    public function loadRatingcalculado($ratingCalculado)
    {   
        $retorno = NULL;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $res = $conexao->query(DmlSqlUsuarioAvaliacao::SELECT . ' WHERE ' . DmlSqlUsuarioAvaliacao::USAV_NU_RATING . '=' . $ratingCalculado );
        if ($res){
            $retorno = $this->getDTO($res->fetch_assoc());
        }
        return $retorno;
    }


    /**
    * loadStatus() - implementação da assinatura em UsuarioAvaliacaoDAO
    */

    public function loadStatus($status)
    {   
        $retorno = NULL;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $res = $conexao->query(DmlSqlUsuarioAvaliacao::SELECT . ' WHERE ' . DmlSqlUsuarioAvaliacao::USAV_IN_STATUS . '=' . $status );
        if ($res){
            $retorno = $this->getDTO($res->fetch_assoc());
        }
        return $retorno;
    }

    /**
    * loadDatacadastro() - implementação da assinatura em UsuarioAvaliacaoDAO
    */

    public function loadDatacadastro($dataCadastro)
    {   
        $retorno = NULL;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $res = $conexao->query(DmlSqlUsuarioAvaliacao::SELECT . ' WHERE ' . DmlSqlUsuarioAvaliacao::USAV_DT_CADASTRO . '=' . $dataCadastro );
        if ($res){
            $retorno = $this->getDTO($res->fetch_assoc());
        }
        return $retorno;
    }

    /**
    * loadDataatualizacao() - implementação da assinatura em UsuarioAvaliacaoDAO
    */

    public function loadDataatualizacao($dataAtualizacao)
    {   
        $retorno = NULL;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $res = $conexao->query(DmlSqlUsuarioAvaliacao::SELECT . ' WHERE ' . DmlSqlUsuarioAvaliacao::USAV_DT_UPDATE . '=' . $dataAtualizacao );
        if ($res){
            $retorno = $this->getDTO($res->fetch_assoc());
        }
        return $retorno;
    }

}
?>




