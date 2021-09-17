


<?php

/**
* MySqlKinghostCampanhaQrCodeDAO - Implementação DAO
*
* Classe de com todos os comandos DML e DDL (se necessário) para apoio 
* a classe MySqlKinghostCampanhaQrCodeDAO
* Não é uma camada visível para outros dispositivos, como as camadas de apresentação e aplicação. 
*
*
* Tabela principal de atuação: CAMPANHA_QRCODES
*
* Changelog:
*
* 
* @author Julio Cesar Vitorino
* @since 23/08/2019 10:06:20
*
*/
require_once 'CampanhaQrCodeDTO.php';
require_once 'CampanhaQrCodeDAO.php';
require_once 'DmlSqlCampanhaQrCode.php';

require_once '../mensagem/ConstantesMensagem.php';
require_once '../mensagem/MensagemCache.php';
require_once '../variavel/VariavelCache.php';
require_once '../daofactory/DmlSql.php';

class MySqlKinghostCampanhaQrCodeDAO implements CampanhaQrCodeDAO
{
    private $daofactory;

    function __construct($daofactory)
    {
        $this->daofactory = $daofactory;
    }


/**
* loadMaxParentPK() - Carrega um MaxID (pk) para um ${CAMPO} e status
*
* @param $parent
* @param $status
* @return $dto
*/ 

    public function loadMaxParentPK($parent,$status)
    {   
        $retorno = 0;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $sql = DmlSqlCampanhaQrCode::SELECT_MAX_PK . ' WHERE ' 
        . DmlSqlCampanhaQrCode::CAQR_ID_PARENT . " = $parent "
        . " AND " . DmlSqlCampanhaQrCode::CAQR_IN_STATUS . " = '$status'";

        $res = $conexao->query($sql);
        if ($res){
            $tmp = $res->fetch_assoc();
            $retorno = $tmp['maxid'] == NULL ? 0 : $tmp['maxid'];
        }
        return $retorno;

    }



/**
* countIdPorStatus() - contar a quantidade de registros
* sob o contexto da classe CampanhaQrCode com base no usuário específico. 
*
* @param $id
* @param $status
*/ 

public function countIdPorStatus($id, $status)
{   
    $retorno = 0;
    // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
    $conexao = $this->daofactory->getSession();
    $sql=DmlSqlCampanhaQrCode::SQL_COUNT  
    . ' WHERE ' . DmlSqlCampanhaQrCode::CAQR_ID . " = $id "
    . ' AND ' . DmlSqlCampanhaQrCode::CAQR_IN_STATUS . " = '$status'";

    $res = $conexao->query($sql);
    if ($res){
        $tmp = $res->fetch_assoc();
        $retorno = $tmp['contador'];
    }
    return $retorno;

}


/**
* countParentPorStatus() - contar a quantidade de registros
* sob o contexto da classe CampanhaQrCode com base no usuário específico. 
*
* @param $parent
* @param $status
*/ 

public function countParentPorStatus($parent, $status)
{   
    $retorno = 0;
    // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
    $conexao = $this->daofactory->getSession();
    $sql=DmlSqlCampanhaQrCode::SQL_COUNT  
    . ' WHERE ' . DmlSqlCampanhaQrCode::CAQR_ID_PARENT . " = $parent "
    . ' AND ' . DmlSqlCampanhaQrCode::CAQR_IN_STATUS . " = '$status'";

    $res = $conexao->query($sql);
    if ($res){
        $tmp = $res->fetch_assoc();
        $retorno = $tmp['contador'];
    }
    return $retorno;

}

/**
* countId_CampanhaPorStatus() - contar a quantidade de registros
* sob o contexto da classe CampanhaQrCode com base no usuário específico. 
*
* @param $id_campanha
* @param $status
*/ 

public function countId_CampanhaPorStatus($id_campanha, $status)
{   
    $retorno = 0;
    // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
    $conexao = $this->daofactory->getSession();
    $sql=DmlSqlCampanhaQrCode::SQL_COUNT  
    . ' WHERE ' . DmlSqlCampanhaQrCode::CAMP_ID . " = $id_campanha "
    . ' AND ' . DmlSqlCampanhaQrCode::CAQR_IN_STATUS . " = '$status'";

    $res = $conexao->query($sql);
    if ($res){
        $tmp = $res->fetch_assoc();
        $retorno = $tmp['contador'];
    }
    return $retorno;

}


/**
* countQrcodecarimboPorStatus() - contar a quantidade de registros
* sob o contexto da classe CampanhaQrCode com base no usuário específico. 
*
* @param $qrcodecarimbo
* @param $status
*/ 

public function countQrcodecarimboPorStatus($qrcodecarimbo, $status)
{   
    $retorno = 0;
    // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
    $conexao = $this->daofactory->getSession();
    $sql=DmlSqlCampanhaQrCode::SQL_COUNT  
    . ' WHERE ' . DmlSqlCampanhaQrCode::CAQR_TX_QRCODE . " = $qrcodecarimbo "
    . ' AND ' . DmlSqlCampanhaQrCode::CAQR_IN_STATUS . " = '$status'";

    $res = $conexao->query($sql);
    if ($res){
        $tmp = $res->fetch_assoc();
        $retorno = $tmp['contador'];
    }
    return $retorno;

}


/**
* countOrderPorStatus() - contar a quantidade de registros
* sob o contexto da classe CampanhaQrCode com base no usuário específico. 
*
* @param $order
* @param $status
*/ 

public function countOrderPorStatus($order, $status)
{   
    $retorno = 0;
    // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
    $conexao = $this->daofactory->getSession();
    $sql=DmlSqlCampanhaQrCode::SQL_COUNT  
    . ' WHERE ' . DmlSqlCampanhaQrCode::CAQR_NU_ORDER . " = $order "
    . ' AND ' . DmlSqlCampanhaQrCode::CAQR_IN_STATUS . " = '$status'";

    $res = $conexao->query($sql);
    if ($res){
        $tmp = $res->fetch_assoc();
        $retorno = $tmp['contador'];
    }
    return $retorno;

}


/**
* countTicketPorStatus() - contar a quantidade de registros
* sob o contexto da classe CampanhaQrCode com base no usuário específico. 
*
* @param $ticket
* @param $status
*/ 

public function countTicketPorStatus($ticket, $status)
{   
    $retorno = 0;
    // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
    $conexao = $this->daofactory->getSession();
    $sql=DmlSqlCampanhaQrCode::SQL_COUNT  
    . ' WHERE ' . DmlSqlCampanhaQrCode::CAQR_TX_TICKET . " = $ticket "
    . ' AND ' . DmlSqlCampanhaQrCode::CAQR_IN_STATUS . " = '$status'";

    $res = $conexao->query($sql);
    if ($res){
        $tmp = $res->fetch_assoc();
        $retorno = $tmp['contador'];
    }
    return $retorno;

}


/**
* countIdusuariogeradorPorStatus() - contar a quantidade de registros
* sob o contexto da classe CampanhaQrCode com base no usuário específico. 
*
* @param $idusuarioGerador
* @param $status
*/ 

public function countIdusuariogeradorPorStatus($idusuarioGerador, $status)
{   
    $retorno = 0;
    // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
    $conexao = $this->daofactory->getSession();
    $sql=DmlSqlCampanhaQrCode::SQL_COUNT  
    . ' WHERE ' . DmlSqlCampanhaQrCode::USUA_ID_GERADOR . " = $idusuarioGerador "
    . ' AND ' . DmlSqlCampanhaQrCode::CAQR_IN_STATUS . " = '$status'";

    $res = $conexao->query($sql);
    if ($res){
        $tmp = $res->fetch_assoc();
        $retorno = $tmp['contador'];
    }
    return $retorno;

}


/**
* load() - Carrega apenas um registro com base no campo id do DTO
*
* @param $dto
* @return $dto
*/ 
    public function load($dto)  {   }

/**
* listAll() - Lista todos os registros provenientes de CAMPANHA_QRCODES sem critério de paginação
*
* @return List<CampanhaQrCodeDTO>[]
*/ 
    public function listAll()   {   }

/**
* update() - atualiza apenas um registro com base no dto CampanhaQrCodeDTO->id
* @param $daofactory
*
* @return boolean
*/ 
    public function update($dto)
    {   
        $retorno = false;

        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $stmt = $conexao->prepare(DmlSqlCampanhaQrCode::UPD_PK);
        $stmt->bind_param(DmlSql::INTEGER_TYPE 
                            . DmlSql::INTEGER_TYPE 
                            . DmlSql::STRING_TYPE 
                            . DmlSql::INTEGER_TYPE 
                            . DmlSql::STRING_TYPE 
                            . DmlSql::INTEGER_TYPE 
                            . DmlSql::INTEGER_TYPE 
                            ,$dto->parent
                            ,$dto->id_campanha
                            ,$dto->qrcodecarimbo
                            ,$dto->order
                            ,$dto->ticket
                            ,$dto->idusuarioGerador
                            ,$dto->id );
        if ($stmt->execute())
        {
            $retorno = true;
        }

        return $retorno;
    }

/**
* delete() - excluir fisicamente um registro com base no dto CampanhaQrCodeDTO->id
*
* @return boolean
*/ 
    public function delete($dto)
    {   
        $retorno = false;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $stmt = $conexao->prepare(DmlSqlCampanhaQrCode::DEL_PK);
        $stmt->bind_param(DmlSql::INTEGER_TYPE
                            ,$dto->id);
        if ($stmt->execute())
        {
            $retorno = true;
        }

        return $retorno;
    }


    public function listCampanhaQrCodeStatus($status)
    {
        $retorno = array();

        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $res = $conexao->query(DmlSqlCampanhaQrCode::SELECT . 'WHERE `' . DmlSqlCampanhaQrCode::CAQR_IN_STATUS . "` = '$status'" );
        if ($res){
            while ($row = $res->fetch_assoc()) {
                array_push($retorno, $this->getDTO($row));
            }
        }
        return $retorno;
    }

/**
* countCampanhaQrCodePorStatus() - contar a quantidade de registros
* sob o contexto da classe CampanhaQrCode com base no status específico. 
*
* Atenção em @see $sql na tabela CAMPANHA_QRCODES 
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

    public function countCampanhaQrCodePorStatus($status)
    {   
        $retorno = 0;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $res = $conexao->query(DmlSqlCampanhaQrCode::SQL_COUNT . ' WHERE ' 
        . DmlSqlCampanhaQrCode::CAQR_IN_STATUS . " = '$status'"
        );
        if ($res){
            $tmp = $res->fetch_assoc();
            $retorno = $tmp['contador'];
        }
        return $retorno;

    }

/**
* listCampanhaQrCodePorStatus() - Listar um conjunto de registro previamente paginado
* sob o contexto da classe CampanhaQrCode com base no status específico.
*
* Atenção em @see $sql na tabela CAMPANHA_QRCODES 
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

    public function listCampanhaQrCodePorStatus($status, $pag, $qtde, $coluna, $ordem)
    {
        $sql = DmlSqlCampanhaQrCode::SELECT 
        . ' WHERE ' . DmlSqlCampanhaQrCode::CAQR_IN_STATUS . " = '$status'"
        . ' ORDER BY ' . $coluna . ($ordem == 0 ? " ASC": " DESC");
        return $this->listPagina($sql, $pag, $qtde);
    }

/**
* countCampanhaQrCodePorUsuaIdStatus() - contar a quantidade de registros
* sob o contexto da classe CampanhaQrCode com base no usuário específico. Esse usuário
* é o usuário logado na sessão ou no próprio dispositivo móvel e de acordo com a 
* query em @see $sql na tabela CAMPANHA_QRCODES 
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

    public function countCampanhaQrCodePorUsuaIdStatus($usuaid, $status)
    {   
        $retorno = 0;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $res = $conexao->query(DmlSqlCampanhaQrCode::SQL_COUNT . ' WHERE ' 
        . DmlSqlCampanhaQrCode::USUA_ID . " = $usuaid "
        . ' AND ' . DmlSqlCampanhaQrCode::CAQR_IN_STATUS . " = '$status'"
        );
        if ($res){
            $tmp = $res->fetch_assoc();
            $retorno = $tmp['contador'];
        }
        return $retorno;

    }

/**
* listCampanhaQrCodePorUsuaIdStatus() - Listar um conjunto de registro previamente paginado
* sob o contexto da classe CampanhaQrCode com base no usuário específico. Esse usuário
* é o usuário logado na sessão ou no próprio dispositivo móvel e de acordo com a 
* query em @see $sql na tabela CAMPANHA_QRCODES 
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
    public function listCampanhaQrCodePorUsuaIdStatus($usuaid, $status, $pag, $qtde, $coluna, $ordem)
    {
        $sql = DmlSqlCampanhaQrCode::SELECT 
        . ' WHERE ' . DmlSqlCampanhaQrCode::USUA_ID . " = $usuaid "
        . ' AND ' . DmlSqlCampanhaQrCode::CAQR_IN_STATUS . " = '$status'"
        . ' ORDER BY ' . $coluna . ($ordem == 0 ? " ASC": " DESC");
        return $this->listPagina($sql, $pag, $qtde);
    }

/**
* listPagina() - Listar um conjunto de registro previamente paginado
* e de acordo com a query em @see $sql na tabela CAMPANHA_QRCODES 
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
* na tabela CAMPANHA_QRCODES usando a Primary Key CAQR_ID
*
* @param $id
* @return CampanhaQrCodeDTO
*/ 
    public function loadPK($id)
    {   
        $retorno = NULL;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $res = $conexao->query(DmlSqlCampanhaQrCode::SELECT . ' WHERE ' . DmlSqlCampanhaQrCode::CAQR_ID . '=' . $id );
        if ($res->num_rows > 0){
            $retorno = $this->getDTO($res->fetch_assoc());
        }
        return $retorno;
    }

/**
* updateStatus() - atualizar o campo de STATUS utilizando a id como item de busca
* na tabela CAMPANHA_QRCODES usando a Primary Key CAQR_ID
*
* @param $id
* @param $status
*
* @return CampanhaQrCodeDTO
*/ 
    public function updateStatus($id, $status)
    {   
        $retorno = false;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $stmt = $conexao->prepare(DmlSqlCampanhaQrCode::UPD_STATUS);
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
* insert() - inserir um registro com base no CampanhaQrCodeDTO. Alguns atributos dentro do DTO
* serão ignorados caso estejam populados, pois os mesmos possuem constraint de DEFAULT value
* ou campos de AUTO INCREMENTO já previamente definidos no DDL de criação de tabelas do BD.
*
* Atributos da classe CampanhaQrCodeDTO sumariamente IGNORADOS por este método MESMO que estejam preenchidos:
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
        $stmt = $conexao->prepare(DmlSqlCampanhaQrCode::INS);
        $stmt->bind_param(DmlSql::INTEGER_TYPE 
                            . DmlSql::INTEGER_TYPE 
                            . DmlSql::STRING_TYPE 
                            . DmlSql::INTEGER_TYPE 
                            . DmlSql::STRING_TYPE 
                            . DmlSql::INTEGER_TYPE 
                            ,$dto->parent
                            ,$dto->id_campanha
                            ,$dto->qrcodecarimbo
                            ,$dto->order
                            ,$dto->ticket
                            ,$dto->idusuarioGerador
        );
        if ($stmt->execute())
        {
            $retorno = true;
        }

        return $retorno;
    }

    /**
     * getDTO() - Transforma o resultset padrão em CampanhaQrCodeDTO
    */
    public function getDTO($resultset)
    {
        if(is_null($resultset)){
            return NULL;
        }

        //echo var_dump($resultset); // ótimo pra debugar
        $retorno = new CampanhaQrCodeDTO();
        $retorno->id = $resultset[DmlSqlCampanhaQrCode::CAQR_ID] == NULL ? NULL : $resultset[DmlSqlCampanhaQrCode::CAQR_ID];
        $retorno->parent = $resultset[DmlSqlCampanhaQrCode::CAQR_ID_PARENT] == NULL ? NULL : $resultset[DmlSqlCampanhaQrCode::CAQR_ID_PARENT];
        $retorno->id_campanha = $resultset[DmlSqlCampanhaQrCode::CAMP_ID] == NULL ? NULL : $resultset[DmlSqlCampanhaQrCode::CAMP_ID];
        $retorno->qrcodecarimbo = $resultset[DmlSqlCampanhaQrCode::CAQR_TX_QRCODE] == NULL ? NULL : $resultset[DmlSqlCampanhaQrCode::CAQR_TX_QRCODE];
        $retorno->order = $resultset[DmlSqlCampanhaQrCode::CAQR_NU_ORDER] == NULL ? NULL : $resultset[DmlSqlCampanhaQrCode::CAQR_NU_ORDER];
        $retorno->ticket = $resultset[DmlSqlCampanhaQrCode::CAQR_TX_TICKET] == NULL ? NULL : $resultset[DmlSqlCampanhaQrCode::CAQR_TX_TICKET];
        $retorno->idusuarioGerador = $resultset[DmlSqlCampanhaQrCode::USUA_ID_GERADOR] == NULL ? NULL : $resultset[DmlSqlCampanhaQrCode::USUA_ID_GERADOR];
        $retorno->status = $resultset[DmlSqlCampanhaQrCode::CAQR_IN_STATUS] == NULL ? NULL : $resultset[DmlSqlCampanhaQrCode::CAQR_IN_STATUS];
        $retorno->dataCadastro = Util::MySQLDate_to_DMYHMiS($resultset[DmlSqlCampanhaQrCode::CAQR_DT_CADASTRO]);
        $retorno->dataAtualizacao = Util::MySQLDate_to_DMYHMiS($resultset[DmlSqlCampanhaQrCode::CAQR_DT_UPDATE]);
        $retorno->statusdesc = VariavelCache::getInstance()->getStatusDesc($retorno->status);
        $retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
        $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);
        return $retorno;

    }

    /**
    * updateParent() - implementação da assinatura em CampanhaQrCodeDAO
    */
    public function updateParent($id, $parent)
    {   
        $retorno = false;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $stmt = $conexao->prepare(DmlSqlCampanhaQrCode::UPD_CAMPANHA_QRCODES_CAQR_ID_PARENT_PK);
        $stmt->bind_param(DmlSql::INTEGER_TYPE 
                            . DmlSql::INTEGER_TYPE
                            ,$parent
                            ,$id);
        if ($stmt->execute())
        {
            $retorno = true;
        }

        return $retorno;
    }

    /**
    * updateId_Campanha() - implementação da assinatura em CampanhaQrCodeDAO
    */
    public function updateId_Campanha($id, $id_campanha)
    {   
        $retorno = false;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $stmt = $conexao->prepare(DmlSqlCampanhaQrCode::UPD_CAMPANHA_QRCODES_CAMP_ID_PK);
        $stmt->bind_param(DmlSql::INTEGER_TYPE 
                            . DmlSql::INTEGER_TYPE
                            ,$id_campanha
                            ,$id);
        if ($stmt->execute())
        {
            $retorno = true;
        }

        return $retorno;
    }

    /**
    * updateQrcodecarimbo() - implementação da assinatura em CampanhaQrCodeDAO
    */
    public function updateQrcodecarimbo($id, $qrcodecarimbo)
    {   
        $retorno = false;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $stmt = $conexao->prepare(DmlSqlCampanhaQrCode::UPD_CAMPANHA_QRCODES_CAQR_TX_QRCODE_PK);
        $stmt->bind_param(DmlSql::STRING_TYPE 
                            . DmlSql::STRING_TYPE
                            ,$qrcodecarimbo
                            ,$id);
        if ($stmt->execute())
        {
            $retorno = true;
        }

        return $retorno;
    }

    /**
    * updateOrder() - implementação da assinatura em CampanhaQrCodeDAO
    */
    public function updateOrder($id, $order)
    {   
        $retorno = false;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $stmt = $conexao->prepare(DmlSqlCampanhaQrCode::UPD_CAMPANHA_QRCODES_CAQR_NU_ORDER_PK);
        $stmt->bind_param(DmlSql::INTEGER_TYPE 
                            . DmlSql::INTEGER_TYPE
                            ,$order
                            ,$id);
        if ($stmt->execute())
        {
            $retorno = true;
        }

        return $retorno;
    }

    /**
    * updateTicket() - implementação da assinatura em CampanhaQrCodeDAO
    */
    public function updateTicket($id, $ticket)
    {   
        $retorno = false;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $stmt = $conexao->prepare(DmlSqlCampanhaQrCode::UPD_CAMPANHA_QRCODES_CAQR_TX_TICKET_PK);
        $stmt->bind_param(DmlSql::STRING_TYPE 
                            . DmlSql::STRING_TYPE
                            ,$ticket
                            ,$id);
        if ($stmt->execute())
        {
            $retorno = true;
        }

        return $retorno;
    }

    /**
    * updateIdusuariogerador() - implementação da assinatura em CampanhaQrCodeDAO
    */
    public function updateIdusuariogerador($id, $idusuarioGerador)
    {   
        $retorno = false;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $stmt = $conexao->prepare(DmlSqlCampanhaQrCode::UPD_CAMPANHA_QRCODES_USUA_ID_GERADOR_PK);
        $stmt->bind_param(DmlSql::INTEGER_TYPE 
                            . DmlSql::INTEGER_TYPE
                            ,$idusuarioGerador
                            ,$id);
        if ($stmt->execute())
        {
            $retorno = true;
        }

        return $retorno;
    }

    /**
    * loadParent() - implementação da assinatura em CampanhaQrCodeDAO
    */

    public function loadParent($parent)
    {   
        $retorno = NULL;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $sql = DmlSqlCampanhaQrCode::SELECT . ' WHERE ' . DmlSqlCampanhaQrCode::CAQR_ID_PARENT . '=' . $parent;
        $res = $conexao->query($sql);
        if ($res){
            $retorno = $this->getDTO($res->fetch_assoc());
        }
        return $retorno;
    }
    /**
    * loadId_Campanha() - implementação da assinatura em CampanhaQrCodeDAO
    */

    public function loadId_Campanha($id_campanha)
    {   
        $retorno = NULL;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $sql = DmlSqlCampanhaQrCode::SELECT . ' WHERE ' . DmlSqlCampanhaQrCode::CAMP_ID . '=' . $id_campanha;
        $res = $conexao->query($sql);
        if ($res){
            $retorno = $this->getDTO($res->fetch_assoc());
        }
        return $retorno;
    }
    /**
    * loadQrcodecarimbo() - implementação da assinatura em CampanhaQrCodeDAO
    */

    public function loadQrcodecarimbo($qrcodecarimbo)
    {   
        $retorno = NULL;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $sql = DmlSqlCampanhaQrCode::SELECT . ' WHERE ' . DmlSqlCampanhaQrCode::CAQR_TX_QRCODE . '=' . $qrcodecarimbo;
        $res = $conexao->query($sql);
        if ($res){
            $retorno = $this->getDTO($res->fetch_assoc());
        }
        return $retorno;
    }
    /**
    * loadOrder() - implementação da assinatura em CampanhaQrCodeDAO
    */

    public function loadOrder($order)
    {   
        $retorno = NULL;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $sql = DmlSqlCampanhaQrCode::SELECT . ' WHERE ' . DmlSqlCampanhaQrCode::CAQR_NU_ORDER . '=' . $order;
        $res = $conexao->query($sql);
        if ($res){
            $retorno = $this->getDTO($res->fetch_assoc());
        }
        return $retorno;
    }
    /**
    * loadTicket() - implementação da assinatura em CampanhaQrCodeDAO
    */

    public function loadTicket($ticket)
    {   
        $retorno = NULL;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $sql = DmlSqlCampanhaQrCode::SELECT . ' WHERE ' . DmlSqlCampanhaQrCode::CAQR_TX_TICKET . '=' . $ticket;
        $res = $conexao->query($sql);
        if ($res){
            $retorno = $this->getDTO($res->fetch_assoc());
        }
        return $retorno;
    }
    /**
    * loadIdusuariogerador() - implementação da assinatura em CampanhaQrCodeDAO
    */

    public function loadIdusuariogerador($idusuarioGerador)
    {   
        $retorno = NULL;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $sql = DmlSqlCampanhaQrCode::SELECT . ' WHERE ' . DmlSqlCampanhaQrCode::USUA_ID_GERADOR . '=' . $idusuarioGerador;
        $res = $conexao->query($sql);
        if ($res){
            $retorno = $this->getDTO($res->fetch_assoc());
        }
        return $retorno;
    }
    /**
    * loadStatus() - implementação da assinatura em CampanhaQrCodeDAO
    */

    public function loadStatus($status)
    {   
        $retorno = NULL;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $res = $conexao->query(DmlSqlCampanhaQrCode::SELECT . ' WHERE ' . DmlSqlCampanhaQrCode::CAQR_IN_STATUS . '=' . $status );
        if ($res){
            $retorno = $this->getDTO($res->fetch_assoc());
        }
        return $retorno;
    }

    /**
    * loadDatacadastro() - implementação da assinatura em CampanhaQrCodeDAO
    */

    public function loadDatacadastro($dataCadastro)
    {   
        $retorno = NULL;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $res = $conexao->query(DmlSqlCampanhaQrCode::SELECT . ' WHERE ' . DmlSqlCampanhaQrCode::CAQR_DT_CADASTRO . '=' . $dataCadastro );
        if ($res){
            $retorno = $this->getDTO($res->fetch_assoc());
        }
        return $retorno;
    }

    /**
    * loadDataatualizacao() - implementação da assinatura em CampanhaQrCodeDAO
    */

    public function loadDataatualizacao($dataAtualizacao)
    {   
        $retorno = NULL;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $res = $conexao->query(DmlSqlCampanhaQrCode::SELECT . ' WHERE ' . DmlSqlCampanhaQrCode::CAQR_DT_UPDATE . '=' . $dataAtualizacao );
        if ($res){
            $retorno = $this->getDTO($res->fetch_assoc());
        }
        return $retorno;
    }

}
?>




