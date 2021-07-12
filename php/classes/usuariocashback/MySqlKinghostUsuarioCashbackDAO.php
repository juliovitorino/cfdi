<?php

/**
* MySqlKinghostUsuarioCashbackDAO - Implementação DAO
*
* Classe de com todos os comandos DML e DDL (se necessário) para apoio 
* a classe MySqlKinghostUsuarioCashbackDAO
* Não é uma camada visível para outros dispositivos, como as camadas de apresentação e aplicação. 
*
*
* Tabela principal de atuação: USUARIO_CASHBACK
*
* Changelog:
*
* 
* @author Julio Cesar Vitorino
* @since 23/08/2019 10:06:20
*
*/
require_once 'UsuarioCashbackDTO.php';
require_once 'UsuarioCashbackDAO.php';
require_once 'DmlSqlUsuarioCashback.php';

require_once '../variavel/VariavelCache.php';
require_once '../daofactory/DmlSql.php';
require_once '../mensagem/ConstantesMensagem.php';
require_once '../mensagem/MensagemCache.php';

class MySqlKinghostUsuarioCashbackDAO implements UsuarioCashbackDAO
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
        $sql = DmlSqlUsuarioCashback::SELECT_MAX_PK . ' WHERE ' 
        . DmlSqlUsuarioCashback::USUA_ID . " = $id_usuario "
        . " AND " . DmlSqlUsuarioCashback::USCA_IN_STATUS . " = '$status'";

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
* listAll() - Lista todos os registros provenientes de USUARIO_CASHBACK sem critério de paginação
*
* @return List<UsuarioCashbackDTO>[]
*/ 
    public function listAll()   {   }

/**
* update() - atualiza apenas um registro com base no dto UsuarioCashbackDTO->id
* @param $daofactory
*
* @return boolean
*/ 
    public function update($dto)
    {   
        $retorno = false;

        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $stmt = $conexao->prepare(DmlSqlUsuarioCashback::UPD_PK);
        $stmt->bind_param(DmlSql::INTEGER_TYPE 
                            . DmlSql::DOUBLE_TYPE 
                            . DmlSql::DOUBLE_TYPE 
                            . DmlSql::STRING_TYPE 
                            . DmlSql::INTEGER_TYPE 
                            . DmlSql::INTEGER_TYPE 
                            . DmlSql::INTEGER_TYPE 
                            . DmlSql::INTEGER_TYPE 
                            . DmlSql::INTEGER_TYPE 
                            . DmlSql::DOUBLE_TYPE 
                            . DmlSql::INTEGER_TYPE 
                            ,$dto->id_usuario
                            ,$dto->vlMinimoResgate
                            ,$dto->percentual
                            ,$dto->obs
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
* delete() - excluir fisicamente um registro com base no dto UsuarioCashbackDTO->id
*
* @return boolean
*/ 
    public function delete($dto)
    {   
        $retorno = false;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $stmt = $conexao->prepare(DmlSqlUsuarioCashback::DEL_PK);
        $stmt->bind_param(DmlSql::INTEGER_TYPE
                            ,$dto->id);
        if ($stmt->execute())
        {
            $retorno = true;
        }

        return $retorno;
    }


    public function listUsuarioCashbackStatus($status)
    {
        $retorno = array();

        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $res = $conexao->query(DmlSqlUsuarioCashback::SELECT . 'WHERE `' . DmlSqlUsuarioCashback::USCA_IN_STATUS . "` = '$status'" );
        if ($res){
            while ($row = $res->fetch_assoc()) {
                array_push($retorno, $this->getDTO($row));
            }
        }
        return $retorno;
    }

/**
* countUsuarioCashbackPorStatus() - contar a quantidade de registros
* sob o contexto da classe UsuarioCashback com base no status específico. 
*
* Atenção em @see $sql na tabela USUARIO_CASHBACK 
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

    public function countUsuarioCashbackPorStatus($status)
    {   
        $retorno = 0;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $res = $conexao->query(DmlSqlUsuarioCashback::SQL_COUNT . ' WHERE ' 
        . DmlSqlUsuarioCashback::USCA_IN_STATUS . " = '$status'"
        );
        if ($res){
            $tmp = $res->fetch_assoc();
            $retorno = $tmp['contador'];
        }
        return $retorno;

    }

/**
* listUsuarioCashbackPorStatus() - Listar um conjunto de registro previamente paginado
* sob o contexto da classe UsuarioCashback com base no status específico.
*
* Atenção em @see $sql na tabela USUARIO_CASHBACK 
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

    public function listUsuarioCashbackPorStatus($status, $pag, $qtde, $coluna, $ordem)
    {
        $sql = DmlSqlUsuarioCashback::SELECT 
        . ' WHERE ' . DmlSqlUsuarioCashback::USCA_IN_STATUS . " = '$status'"
        . ' ORDER BY ' . $coluna . ($ordem == 0 ? " ASC": " DESC");
        return $this->listPagina($sql, $pag, $qtde);
    }

/**
* countUsuarioCashbackPorUsuaIdStatus() - contar a quantidade de registros
* sob o contexto da classe UsuarioCashback com base no usuário específico. Esse usuário
* é o usuário logado na sessão ou no próprio dispositivo móvel e de acordo com a 
* query em @see $sql na tabela USUARIO_CASHBACK 
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

    public function countUsuarioCashbackPorUsuaIdStatus($usuaid, $status)
    {   
        $retorno = 0;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $res = $conexao->query(DmlSqlUsuarioCashback::SQL_COUNT . ' WHERE ' 
        . DmlSqlUsuarioCashback::USUA_ID . " = $usuaid "
        . ' AND ' . DmlSqlUsuarioCashback::USCA_IN_STATUS . " = '$status'"
        );

        if ($res){
            $tmp = $res->fetch_assoc();
            $retorno = $tmp['contador'];
        }
        return $retorno;

    }

/**
* listUsuarioCashbackPorUsuaIdStatus() - Listar um conjunto de registro previamente paginado
* sob o contexto da classe UsuarioCashback com base no usuário específico. Esse usuário
* é o usuário logado na sessão ou no próprio dispositivo móvel e de acordo com a 
* query em @see $sql na tabela USUARIO_CASHBACK 
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
    public function listUsuarioCashbackPorUsuaIdStatus($usuaid, $status, $pag, $qtde, $coluna, $ordem)
    {
        $sql = DmlSqlUsuarioCashback::SELECT 
        . ' WHERE ' . DmlSqlUsuarioCashback::USUA_ID . " = $usuaid "
        . ' AND ' . DmlSqlUsuarioCashback::USCA_IN_STATUS . " = '$status'"
        . ' ORDER BY ' . $coluna . ($ordem == 0 ? " ASC": " DESC");
        return $this->listPagina($sql, $pag, $qtde);
    }

/**
* listPagina() - Listar um conjunto de registro previamente paginado
* e de acordo com a query em @see $sql na tabela USUARIO_CASHBACK 
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
//var_dump($sql);
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
* na tabela USUARIO_CASHBACK usando a Primary Key USCA_ID
*
* @param $id
* @return UsuarioCashbackDTO
*/ 
    public function loadPK($id)
    {   
        $retorno = NULL;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $res = $conexao->query(DmlSqlUsuarioCashback::SELECT . ' WHERE ' . DmlSqlUsuarioCashback::USCA_ID . '=' . $id );
        if ($res){
            $retorno = $this->getDTO($res->fetch_assoc());
        }
        return $retorno;
    }

/**
* updateStatus() - atualizar o campo de STATUS utilizando a id como item de busca
* na tabela USUARIO_CASHBACK usando a Primary Key USCA_ID
*
* @param $id
* @param $status
*
* @return UsuarioCashbackDTO
*/ 
    public function updateStatus($id, $status)
    {   
        $retorno = false;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $stmt = $conexao->prepare(DmlSqlUsuarioCashback::UPD_STATUS);
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
* insert() - inserir um registro com base no UsuarioCashbackDTO. Alguns atributos dentro do DTO
* serão ignorados caso estejam populados, pois os mesmos possuem constraint de DEFAULT value
* ou campos de AUTO INCREMENTO já previamente definidos no DDL de criação de tabelas do BD.
*
* Atributos da classe UsuarioCashbackDTO sumariamente IGNORADOS por este método MESMO que estejam preenchidos:
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
        $stmt = $conexao->prepare(DmlSqlUsuarioCashback::INS);
        $stmt->bind_param(DmlSql::INTEGER_TYPE 
                            . DmlSql::DOUBLE_TYPE 
                            . DmlSql::DOUBLE_TYPE 
                            . DmlSql::STRING_TYPE 
                            ,$dto->id_usuario
                            ,$dto->vlMinimoResgate
                            ,$dto->percentual
                            ,$dto->obs

        );
        if ($stmt->execute())
        {
            $retorno = true;
        }

        return $retorno;
    }

    /**
     * getDTO() - Transforma o resultset padrão em UsuarioCashbackDTO
    */
    public function getDTO($resultset)
    {
        //echo var_dump($resultset); // ótimo pra debugar
        if(is_null($resultset)) {
            return NULL;
        }
            
        $retorno = new UsuarioCashbackDTO();
        $retorno->id = $resultset[DmlSqlUsuarioCashback::USCA_ID] == NULL ? NULL : (int) $resultset[DmlSqlUsuarioCashback::USCA_ID];
        $retorno->id_usuario = $resultset[DmlSqlUsuarioCashback::USUA_ID] == NULL ? NULL : (int) $resultset[DmlSqlUsuarioCashback::USUA_ID];
        $retorno->vlMinimoResgate = $resultset[DmlSqlUsuarioCashback::USCA_VL_RESGATE] == NULL ? NULL : (double) $resultset[DmlSqlUsuarioCashback::USCA_VL_RESGATE];
        $retorno->percentual = $resultset[DmlSqlUsuarioCashback::USCA_VL_PERC_CASHBACK] == NULL ? NULL : (double) $resultset[DmlSqlUsuarioCashback::USCA_VL_PERC_CASHBACK];
        $retorno->vlMinimoResgateMoeda = $resultset[DmlSqlUsuarioCashback::USCA_VL_RESGATE] == NULL ? Util::getMoeda(0.00) : Util::getMoeda((double) $resultset[DmlSqlUsuarioCashback::USCA_VL_RESGATE]);
        $retorno->percentualFmt = $resultset[DmlSqlUsuarioCashback::USCA_VL_PERC_CASHBACK] == NULL ? Util::getFmtNum(0.00,2) : Util::getFmtNum((double) $resultset[DmlSqlUsuarioCashback::USCA_VL_PERC_CASHBACK],2);
        $retorno->obs = $resultset[DmlSqlUsuarioCashback::USCA_TX_OBS] == NULL ? NULL : $resultset[DmlSqlUsuarioCashback::USCA_TX_OBS];
        $retorno->contadorStar_1 = $resultset[DmlSqlUsuarioCashback::USCA_NU_CONT_STAR_1] == NULL ? NULL : $resultset[DmlSqlUsuarioCashback::USCA_NU_CONT_STAR_1];
        $retorno->contadorStar_2 = $resultset[DmlSqlUsuarioCashback::USCA_NU_CONT_STAR_2] == NULL ? NULL : $resultset[DmlSqlUsuarioCashback::USCA_NU_CONT_STAR_2];
        $retorno->contadorStar_3 = $resultset[DmlSqlUsuarioCashback::USCA_NU_CONT_STAR_3] == NULL ? NULL : $resultset[DmlSqlUsuarioCashback::USCA_NU_CONT_STAR_3];
        $retorno->contadorStar_4 = $resultset[DmlSqlUsuarioCashback::USCA_NU_CONT_STAR_4] == NULL ? NULL : $resultset[DmlSqlUsuarioCashback::USCA_NU_CONT_STAR_4];
        $retorno->contadorStar_5 = $resultset[DmlSqlUsuarioCashback::USCA_NU_CONT_STAR_5] == NULL ? NULL : $resultset[DmlSqlUsuarioCashback::USCA_NU_CONT_STAR_5];
        $retorno->ratingCalculado = $resultset[DmlSqlUsuarioCashback::USCA_NU_RATING] == NULL ? NULL : $resultset[DmlSqlUsuarioCashback::USCA_NU_RATING];
        $retorno->status = $resultset[DmlSqlUsuarioCashback::USCA_IN_STATUS] == NULL ? NULL : $resultset[DmlSqlUsuarioCashback::USCA_IN_STATUS];
        $retorno->dataCadastro = Util::MySQLDate_to_DMYHMiS($resultset[DmlSqlUsuarioCashback::USCA_DT_CADASTRO]);
        $retorno->dataAtualizacao = Util::MySQLDate_to_DMYHMiS($resultset[DmlSqlUsuarioCashback::USCA_DT_UPDATE]);
        $retorno->statusdesc = VariavelCache::getInstance()->getStatusDesc($retorno->status);
        $retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
        $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);
        
        return $retorno;

    }

    /**
    * updateId_Usuario() - implementação da assinatura em UsuarioCashbackDAO
    */
    public function updateId_Usuario($id, $id_usuario)
    {   
        $retorno = false;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $stmt = $conexao->prepare(DmlSqlUsuarioCashback::UPD_USUARIO_CASHBACK_USUA_ID_PK);
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
    * updateVlminimoresgate() - implementação da assinatura em UsuarioCashbackDAO
    */
    public function updateVlminimoresgate($id, $vlMinimoResgate)
    {   
        $retorno = false;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $stmt = $conexao->prepare(DmlSqlUsuarioCashback::UPD_USUARIO_CASHBACK_USCA_VL_RESGATE_PK);
        $stmt->bind_param(DmlSql::DOUBLE_TYPE 
                            . DmlSql::DOUBLE_TYPE
                            ,$vlMinimoResgate
                            ,$id);
        if ($stmt->execute())
        {
            $retorno = true;
        }

        return $retorno;
    }

    /**
    * updatePercentual() - implementação da assinatura em UsuarioCashbackDAO
    */
    public function updatePercentual($id, $percentual)
    {   
        $retorno = false;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $stmt = $conexao->prepare(DmlSqlUsuarioCashback::UPD_USUARIO_CASHBACK_USCA_VL_PERC_CASHBACK_PK);
        $stmt->bind_param(DmlSql::DOUBLE_TYPE 
                            . DmlSql::DOUBLE_TYPE
                            ,$percentual
                            ,$id);
        if ($stmt->execute())
        {
            $retorno = true;
        }

        return $retorno;
    }

    /**
    * updateObs() - implementação da assinatura em UsuarioCashbackDAO
    */
    public function updateObs($id, $obs)
    {   
        $retorno = false;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $stmt = $conexao->prepare(DmlSqlUsuarioCashback::UPD_USUARIO_CASHBACK_USCA_TX_OBS_PK);
        $stmt->bind_param(DmlSql::STRING_TYPE 
                            . DmlSql::STRING_TYPE
                            ,$obs
                            ,$id);
        if ($stmt->execute())
        {
            $retorno = true;
        }

        return $retorno;
    }

    /**
    * updateContadorstar_1() - implementação da assinatura em UsuarioCashbackDAO
    */
    public function updateContadorstar_1($id, $contadorStar_1)
    {   
        $retorno = false;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $stmt = $conexao->prepare(DmlSqlUsuarioCashback::UPD_USUARIO_CASHBACK_USCA_NU_CONT_STAR_1_PK);
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
    * updateContadorstar_2() - implementação da assinatura em UsuarioCashbackDAO
    */
    public function updateContadorstar_2($id, $contadorStar_2)
    {   
        $retorno = false;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $stmt = $conexao->prepare(DmlSqlUsuarioCashback::UPD_USUARIO_CASHBACK_USCA_NU_CONT_STAR_2_PK);
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
    * updateContadorstar_3() - implementação da assinatura em UsuarioCashbackDAO
    */
    public function updateContadorstar_3($id, $contadorStar_3)
    {   
        $retorno = false;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $stmt = $conexao->prepare(DmlSqlUsuarioCashback::UPD_USUARIO_CASHBACK_USCA_NU_CONT_STAR_3_PK);
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
    * updateContadorstar_4() - implementação da assinatura em UsuarioCashbackDAO
    */
    public function updateContadorstar_4($id, $contadorStar_4)
    {   
        $retorno = false;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $stmt = $conexao->prepare(DmlSqlUsuarioCashback::UPD_USUARIO_CASHBACK_USCA_NU_CONT_STAR_4_PK);
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
    * updateContadorstar_5() - implementação da assinatura em UsuarioCashbackDAO
    */
    public function updateContadorstar_5($id, $contadorStar_5)
    {   
        $retorno = false;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $stmt = $conexao->prepare(DmlSqlUsuarioCashback::UPD_USUARIO_CASHBACK_USCA_NU_CONT_STAR_5_PK);
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
    * updateRatingcalculado() - implementação da assinatura em UsuarioCashbackDAO
    */
    public function updateRatingcalculado($id, $ratingCalculado)
    {   
        $retorno = false;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $stmt = $conexao->prepare(DmlSqlUsuarioCashback::UPD_USUARIO_CASHBACK_USCA_NU_RATING_PK);
        $stmt->bind_param(DmlSql::DOUBLE_TYPE 
                            . DmlSql::DOUBLE_TYPE
                            ,$ratingCalculado
                            ,$id);
        if ($stmt->execute())
        {
            $retorno = true;
        }

        return $retorno;
    }


    /**
    * loadId_Usuario() - implementação da assinatura em UsuarioCashbackDAO
    */

    public function loadId_Usuario($id_usuario)
    {   
        $retorno = NULL;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $res = $conexao->query(DmlSqlUsuarioCashback::SELECT . ' WHERE ' . DmlSqlUsuarioCashback::USUA_ID . '=' . $id_usuario );
        if ($res){
            $retorno = $this->getDTO($res->fetch_assoc());
        }
        return $retorno;
    }

    /**
    * loadVlminimoresgate() - implementação da assinatura em UsuarioCashbackDAO
    */

    public function loadVlminimoresgate($vlMinimoResgate)
    {   
        $retorno = NULL;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $res = $conexao->query(DmlSqlUsuarioCashback::SELECT . ' WHERE ' . DmlSqlUsuarioCashback::USCA_VL_RESGATE . '=' . $vlMinimoResgate );
        if ($res){
            $retorno = $this->getDTO($res->fetch_assoc());
        }
        return $retorno;
    }

    /**
    * loadPercentual() - implementação da assinatura em UsuarioCashbackDAO
    */

    public function loadPercentual($percentual)
    {   
        $retorno = NULL;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $res = $conexao->query(DmlSqlUsuarioCashback::SELECT . ' WHERE ' . DmlSqlUsuarioCashback::USCA_VL_PERC_CASHBACK . '=' . $percentual );
        if ($res){
            $retorno = $this->getDTO($res->fetch_assoc());
        }
        return $retorno;
    }

    /**
    * loadObs() - implementação da assinatura em UsuarioCashbackDAO
    */

    public function loadObs($obs)
    {   
        $retorno = NULL;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $res = $conexao->query(DmlSqlUsuarioCashback::SELECT . ' WHERE ' . DmlSqlUsuarioCashback::USCA_TX_OBS . '=' . $obs );
        if ($res){
            $retorno = $this->getDTO($res->fetch_assoc());
        }
        return $retorno;
    }

    /**
    * loadContadorstar_1() - implementação da assinatura em UsuarioCashbackDAO
    */

    public function loadContadorstar_1($contadorStar_1)
    {   
        $retorno = NULL;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $res = $conexao->query(DmlSqlUsuarioCashback::SELECT . ' WHERE ' . DmlSqlUsuarioCashback::USCA_NU_CONT_STAR_1 . '=' . $contadorStar_1 );
        if ($res){
            $retorno = $this->getDTO($res->fetch_assoc());
        }
        return $retorno;
    }

    /**
    * loadContadorstar_2() - implementação da assinatura em UsuarioCashbackDAO
    */

    public function loadContadorstar_2($contadorStar_2)
    {   
        $retorno = NULL;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $res = $conexao->query(DmlSqlUsuarioCashback::SELECT . ' WHERE ' . DmlSqlUsuarioCashback::USCA_NU_CONT_STAR_2 . '=' . $contadorStar_2 );
        if ($res){
            $retorno = $this->getDTO($res->fetch_assoc());
        }
        return $retorno;
    }

    /**
    * loadContadorstar_3() - implementação da assinatura em UsuarioCashbackDAO
    */

    public function loadContadorstar_3($contadorStar_3)
    {   
        $retorno = NULL;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $res = $conexao->query(DmlSqlUsuarioCashback::SELECT . ' WHERE ' . DmlSqlUsuarioCashback::USCA_NU_CONT_STAR_3 . '=' . $contadorStar_3 );
        if ($res){
            $retorno = $this->getDTO($res->fetch_assoc());
        }
        return $retorno;
    }

    /**
    * loadContadorstar_4() - implementação da assinatura em UsuarioCashbackDAO
    */

    public function loadContadorstar_4($contadorStar_4)
    {   
        $retorno = NULL;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $res = $conexao->query(DmlSqlUsuarioCashback::SELECT . ' WHERE ' . DmlSqlUsuarioCashback::USCA_NU_CONT_STAR_4 . '=' . $contadorStar_4 );
        if ($res){
            $retorno = $this->getDTO($res->fetch_assoc());
        }
        return $retorno;
    }

    /**
    * loadContadorstar_5() - implementação da assinatura em UsuarioCashbackDAO
    */

    public function loadContadorstar_5($contadorStar_5)
    {   
        $retorno = NULL;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $res = $conexao->query(DmlSqlUsuarioCashback::SELECT . ' WHERE ' . DmlSqlUsuarioCashback::USCA_NU_CONT_STAR_5 . '=' . $contadorStar_5 );
        if ($res){
            $retorno = $this->getDTO($res->fetch_assoc());
        }
        return $retorno;
    }

    /**
    * loadRatingcalculado() - implementação da assinatura em UsuarioCashbackDAO
    */

    public function loadRatingcalculado($ratingCalculado)
    {   
        $retorno = NULL;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $res = $conexao->query(DmlSqlUsuarioCashback::SELECT . ' WHERE ' . DmlSqlUsuarioCashback::USCA_NU_RATING . '=' . $ratingCalculado );
        if ($res){
            $retorno = $this->getDTO($res->fetch_assoc());
        }
        return $retorno;
    }

    /**
    * loadStatus() - implementação da assinatura em UsuarioCashbackDAO
    */

    public function loadStatus($status)
    {   
        $retorno = NULL;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $res = $conexao->query(DmlSqlUsuarioCashback::SELECT . ' WHERE ' . DmlSqlUsuarioCashback::USCA_IN_STATUS . '=' . $status );
        if ($res){
            $retorno = $this->getDTO($res->fetch_assoc());
        }
        return $retorno;
    }

    /**
    * loadDatacadastro() - implementação da assinatura em UsuarioCashbackDAO
    */

    public function loadDatacadastro($dataCadastro)
    {   
        $retorno = NULL;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $res = $conexao->query(DmlSqlUsuarioCashback::SELECT . ' WHERE ' . DmlSqlUsuarioCashback::USCA_DT_CADASTRO . '=' . $dataCadastro );
        if ($res){
            $retorno = $this->getDTO($res->fetch_assoc());
        }
        return $retorno;
    }

    /**
    * loadDataatualizacao() - implementação da assinatura em UsuarioCashbackDAO
    */

    public function loadDataatualizacao($dataAtualizacao)
    {   
        $retorno = NULL;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $res = $conexao->query(DmlSqlUsuarioCashback::SELECT . ' WHERE ' . DmlSqlUsuarioCashback::USCA_DT_UPDATE . '=' . $dataAtualizacao );
        if ($res){
            $retorno = $this->getDTO($res->fetch_assoc());
        }
        return $retorno;
    }

}
?>




