<?php

/**
* MySqlKinghostCartaoPedidoDAO - Implementação DAO
*
* Classe de com todos os comandos DML e DDL (se necessário) para apoio 
* a classe MySqlKinghostCartaoPedidoDAO
* Não é uma camada visível para outros dispositivos, como as camadas de apresentação e aplicação. 
*
*
* Tabela principal de atuação: CARTAO_PEDIDO
*
* Changelog:
*
* 
* @author Julio Cesar Vitorino
* @since 23/08/2019 10:06:20
*
*/
require_once 'CartaoPedidoDTO.php';
require_once 'CartaoPedidoDAO.php';
require_once 'DmlSqlCartaoPedido.php';

require_once '../variavel/VariavelCache.php';
require_once '../daofactory/DmlSql.php';
require_once '../mensagem/ConstantesMensagem.php';
require_once '../mensagem/MensagemCache.php';

class MySqlKinghostCartaoPedidoDAO implements CartaoPedidoDAO
{
    private $daofactory;

    function __construct($daofactory)
    {
        $this->daofactory = $daofactory;
    }


/**
* loadMaxId_CampanhaPK() - Carrega um MaxID (pk) para um ${CAMPO} e status
*
* @param $id_campanha
* @param $status
* @return $dto
*/ 

    public function loadMaxId_CampanhaPK($id_campanha,$status)
    {   
        $retorno = 0;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $sql = DmlSqlCartaoPedido::SELECT_MAX_PK . ' WHERE ' 
        . DmlSqlCartaoPedido::CAMP_ID . " = $id_campanha "
        . " AND " . DmlSqlCartaoPedido::CAPE_IN_STATUS . " = '$status'";

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
* listAll() - Lista todos os registros provenientes de CARTAO_PEDIDO sem critério de paginação
*
* @return List<CartaoPedidoDTO>[]
*/ 
    public function listAll()   {   }

/**
* update() - atualiza apenas um registro com base no dto CartaoPedidoDTO->id
* @param $daofactory
*
* @return boolean
*/ 
    public function update($dto)
    {   
        $retorno = false;

        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $stmt = $conexao->prepare(DmlSqlCartaoPedido::UPD_PK);
        $stmt->bind_param(DmlSql::INTEGER_TYPE 
                            . DmlSql::STRING_TYPE 
                            . DmlSql::STRING_TYPE 
                            . DmlSql::INTEGER_TYPE 
                            . DmlSql::INTEGER_TYPE 
                            . DmlSql::DOUBLE_TYPE 
                            . DmlSql::STRING_TYPE 
                            . DmlSql::STRING_TYPE 
                            . DmlSql::DOUBLE_TYPE 
                            . DmlSql::STRING_TYPE 
                            . DmlSql::INTEGER_TYPE 
                            ,$dto->id_campanha
                            ,$dto->descpedido
                            ,$dto->hashTransacao
                            ,$dto->qtde
                            ,$dto->selos
                            ,$dto->vlrPedido
                            ,$dto->dataAutorizacao
                            ,$dto->dataPgto
                            ,$dto->vlrPgto
                            ,$dto->hashGtway
                            ,$dto->id );
        if ($stmt->execute())
        {
            $retorno = true;
        }

        return $retorno;
    }

/**
* delete() - excluir fisicamente um registro com base no dto CartaoPedidoDTO->id
*
* @return boolean
*/ 
    public function delete($dto)
    {   
        $retorno = false;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $stmt = $conexao->prepare(DmlSqlCartaoPedido::DEL_PK);
        $stmt->bind_param(DmlSql::INTEGER_TYPE
                            ,$dto->id);
        if ($stmt->execute())
        {
            $retorno = true;
        }

        return $retorno;
    }


    public function listCartaoPedidoStatus($status)
    {
        $retorno = array();

        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $res = $conexao->query(DmlSqlCartaoPedido::SELECT . 'WHERE `' . DmlSqlCartaoPedido::CAPE_IN_STATUS . "` = '$status'" );
        if ($res){
            while ($row = $res->fetch_assoc()) {
                array_push($retorno, $this->getDTO($row));
            }
        }
        return $retorno;
    }

/**
* countCartaoPedidoPorStatus() - contar a quantidade de registros
* sob o contexto da classe CartaoPedido com base no status específico. 
*
* Atenção em @see $sql na tabela CARTAO_PEDIDO 
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

    public function countCartaoPedidoPorStatus($status)
    {   
        $retorno = 0;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $res = $conexao->query(DmlSqlCartaoPedido::SQL_COUNT . ' WHERE ' 
        . DmlSqlCartaoPedido::CAPE_IN_STATUS . " = '$status'"
        );
        if ($res){
            $tmp = $res->fetch_assoc();
            $retorno = $tmp['contador'];
        }
        return $retorno;

    }

/**
* listCartaoPedidoPorStatus() - Listar um conjunto de registro previamente paginado
* sob o contexto da classe CartaoPedido com base no status específico.
*
* Atenção em @see $sql na tabela CARTAO_PEDIDO 
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

    public function listCartaoPedidoPorStatus($status, $pag, $qtde, $coluna, $ordem)
    {
        $sql = DmlSqlCartaoPedido::SELECT 
        . ' WHERE ' . DmlSqlCartaoPedido::CAPE_IN_STATUS . " = '$status'"
        . ' ORDER BY ' . $coluna . ($ordem == 0 ? " ASC": " DESC");
        return $this->listPagina($sql, $pag, $qtde);
    }

/**
* countCartaoPedidoPorUsuaIdStatus() - contar a quantidade de registros
* sob o contexto da classe CartaoPedido com base no usuário específico. Esse usuário
* é o usuário logado na sessão ou no próprio dispositivo móvel e de acordo com a 
* query em @see $sql na tabela CARTAO_PEDIDO 
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

    public function countCartaoPedidoPorUsuaIdStatus($usuaid, $status)
    {   
        $retorno = 0;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $res = $conexao->query(DmlSqlCartaoPedido::SQL_COUNT . ' WHERE ' 
        . DmlSqlCartaoPedido::USUA_ID . " = $usuaid "
        . ' AND ' . DmlSqlCartaoPedido::CAPE_IN_STATUS . " = '$status'"
        );
        if ($res){
            $tmp = $res->fetch_assoc();
            $retorno = $tmp['contador'];
        }
        return $retorno;

    }

/**
* listCartaoPedidoPorUsuaIdStatus() - Listar um conjunto de registro previamente paginado
* sob o contexto da classe CartaoPedido com base no usuário específico. Esse usuário
* é o usuário logado na sessão ou no próprio dispositivo móvel e de acordo com a 
* query em @see $sql na tabela CARTAO_PEDIDO 
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
    public function listCartaoPedidoPorUsuaIdStatus($usuaid, $status, $pag, $qtde, $coluna, $ordem)
    {
        $sql = DmlSqlCartaoPedido::SELECT 
        . ' WHERE ' . DmlSqlCartaoPedido::USUA_ID . " = $usuaid "
        . ' AND ' . DmlSqlCartaoPedido::CAPE_IN_STATUS . " = '$status'"
        . ' ORDER BY ' . $coluna . ($ordem == 0 ? " ASC": " DESC");
        return $this->listPagina($sql, $pag, $qtde);
    }

/**
* listPagina() - Listar um conjunto de registro previamente paginado
* e de acordo com a query em @see $sql na tabela CARTAO_PEDIDO 
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
* na tabela CARTAO_PEDIDO usando a Primary Key CAPE_ID
*
* @param $id
* @return CartaoPedidoDTO
*/ 
    public function loadPK($id)
    {   
        $retorno = NULL;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $res = $conexao->query(DmlSqlCartaoPedido::SELECT . ' WHERE ' . DmlSqlCartaoPedido::CAPE_ID . '=' . $id );
        if ($res){
            $retorno = $this->getDTO($res->fetch_assoc());
        }
        return $retorno;
    }

/**
* updateStatus() - atualizar o campo de STATUS utilizando a id como item de busca
* na tabela CARTAO_PEDIDO usando a Primary Key CAPE_ID
*
* @param $id
* @param $status
*
* @return CartaoPedidoDTO
*/ 
    public function updateStatus($id, $status)
    {   
        $retorno = false;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $stmt = $conexao->prepare(DmlSqlCartaoPedido::UPD_STATUS);
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
* insert() - inserir um registro com base no CartaoPedidoDTO. Alguns atributos dentro do DTO
* serão ignorados caso estejam populados, pois os mesmos possuem constraint de DEFAULT value
* ou campos de AUTO INCREMENTO já previamente definidos no DDL de criação de tabelas do BD.
*
* Atributos da classe CartaoPedidoDTO sumariamente IGNORADOS por este método MESMO que estejam preenchidos:
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
        $stmt = $conexao->prepare(DmlSqlCartaoPedido::INS);
        $stmt->bind_param(DmlSql::INTEGER_TYPE 
                            . DmlSql::STRING_TYPE 
                            . DmlSql::STRING_TYPE 
                            . DmlSql::INTEGER_TYPE 
                            . DmlSql::INTEGER_TYPE 
                            . DmlSql::DOUBLE_TYPE 
                            ,$dto->id_campanha
                            ,$dto->descpedido
                            ,$dto->hashTransacao
                            ,$dto->qtde
                            ,$dto->selos
                            ,$dto->vlrPedido
        );
        if ($stmt->execute())
        {
            $retorno = true;
        } else {
            //var_dump(mysqli_errno($conexao));
            //var_dump(mysqli_error($conexao));
        }

        return $retorno;
    }

    /**
     * getDTO() - Transforma o resultset padrão em CartaoPedidoDTO
    */
    public function getDTO($resultset)
    {
        //echo var_dump($resultset); // ótimo pra debugar
        $retorno = new CartaoPedidoDTO();
        $retorno->id = $resultset[DmlSqlCartaoPedido::CAPE_ID] == NULL ? NULL : (int) $resultset[DmlSqlCartaoPedido::CAPE_ID];
        $retorno->id_campanha = $resultset[DmlSqlCartaoPedido::CAMP_ID] == NULL ? NULL : (int) $resultset[DmlSqlCartaoPedido::CAMP_ID];
        $retorno->descpedido = $resultset[DmlSqlCartaoPedido::CAPE_TX_PEDIDO] == NULL ? NULL : $resultset[DmlSqlCartaoPedido::CAPE_TX_PEDIDO];
        $retorno->hashTransacao = $resultset[DmlSqlCartaoPedido::CAPE_TX_HASH] == NULL ? NULL : $resultset[DmlSqlCartaoPedido::CAPE_TX_HASH];
        $retorno->qtde = $resultset[DmlSqlCartaoPedido::CAPE_NU_QTDE] == NULL ? NULL : (int) $resultset[DmlSqlCartaoPedido::CAPE_NU_QTDE];
        $retorno->selos = $resultset[DmlSqlCartaoPedido::CAPE_NU_SELOS] == NULL ? NULL : (int) $resultset[DmlSqlCartaoPedido::CAPE_NU_SELOS];
        $retorno->vlrPedido = $resultset[DmlSqlCartaoPedido::CAPE_VL_PEDIDO] == NULL ? NULL : (double) $resultset[DmlSqlCartaoPedido::CAPE_VL_PEDIDO];
        $retorno->vlrPedidoMoeda = $resultset[DmlSqlCartaoPedido::CAPE_VL_PEDIDO] == NULL ? NULL : Util::getMoeda((double) $resultset[DmlSqlCartaoPedido::CAPE_VL_PEDIDO]);
        $retorno->dataAutorizacao = $resultset[DmlSqlCartaoPedido::CAPE_DT_AUTORIZACAO] == NULL ? NULL : Util::MySQLDate_to_DMYHMiS($resultset[DmlSqlCartaoPedido::CAPE_DT_AUTORIZACAO]);
        $retorno->dataPgto = $resultset[DmlSqlCartaoPedido::CAPE_DT_PGTO] == NULL ? NULL : Util::MySQLDate_to_DMYHMiS($resultset[DmlSqlCartaoPedido::CAPE_DT_PGTO]);
        $retorno->vlrPgto = $resultset[DmlSqlCartaoPedido::CAPE_VL_PGTO] == NULL ? NULL : (double) $resultset[DmlSqlCartaoPedido::CAPE_VL_PGTO];
        $retorno->vlrPgtoMoeda = $resultset[DmlSqlCartaoPedido::CAPE_VL_PGTO] == NULL ? NULL : Util::getMoeda( (double) $resultset[DmlSqlCartaoPedido::CAPE_VL_PGTO]);
        $retorno->hashGtway = $resultset[DmlSqlCartaoPedido::CAPE_TX_HASH_GATEWAY] == NULL ? NULL : $resultset[DmlSqlCartaoPedido::CAPE_TX_HASH_GATEWAY];
        $retorno->tipo = $resultset[DmlSqlCartaoPedido::CAPE_IN_TIPO] == NULL ? NULL : $resultset[DmlSqlCartaoPedido::CAPE_IN_TIPO];
        $retorno->status = $resultset[DmlSqlCartaoPedido::CAPE_IN_STATUS] == NULL ? NULL : $resultset[DmlSqlCartaoPedido::CAPE_IN_STATUS];
        $retorno->dataCadastro = Util::MySQLDate_to_DMYHMiS($resultset[DmlSqlCartaoPedido::CAPE_DT_CADASTRO]);
        $retorno->dataAtualizacao = Util::MySQLDate_to_DMYHMiS($resultset[DmlSqlCartaoPedido::CAPE_DT_UPDATE]);
        $retorno->statusdesc = VariavelCache::getInstance()->getStatusDesc($retorno->status);
        $retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
        $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);
        
        return $retorno;

    }

    /**
    * updateId_Campanha() - implementação da assinatura em CartaoPedidoDAO
    */
    public function updateId_Campanha($id, $id_campanha)
    {   
        $retorno = false;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $stmt = $conexao->prepare(DmlSqlCartaoPedido::UPD_CARTAO_PEDIDO_CAMP_ID_PK);
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
    * updateHashtransacao() - implementação da assinatura em CartaoPedidoDAO
    */
    public function updateHashtransacao($id, $hashTransacao)
    {   
        $retorno = false;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $stmt = $conexao->prepare(DmlSqlCartaoPedido::UPD_CARTAO_PEDIDO_CAPE_TX_HASH_PK);
        $stmt->bind_param(DmlSql::STRING_TYPE 
                            . DmlSql::STRING_TYPE
                            ,$hashTransacao
                            ,$id);
        if ($stmt->execute())
        {
            $retorno = true;
        }

        return $retorno;
    }

    /**
    * updateQtde() - implementação da assinatura em CartaoPedidoDAO
    */
    public function updateQtde($id, $qtde)
    {   
        $retorno = false;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $stmt = $conexao->prepare(DmlSqlCartaoPedido::UPD_CARTAO_PEDIDO_CAPE_NU_QTDE_PK);
        $stmt->bind_param(DmlSql::INTEGER_TYPE 
                            . DmlSql::INTEGER_TYPE
                            ,$qtde
                            ,$id);
        if ($stmt->execute())
        {
            $retorno = true;
        }

        return $retorno;
    }

    /**
    * updateSelos() - implementação da assinatura em CartaoPedidoDAO
    */
    public function updateSelos($id, $selos)
    {   
        $retorno = false;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $stmt = $conexao->prepare(DmlSqlCartaoPedido::UPD_CARTAO_PEDIDO_CAPE_NU_SELOS_PK);
        $stmt->bind_param(DmlSql::INTEGER_TYPE 
                            . DmlSql::INTEGER_TYPE
                            ,$selos
                            ,$id);
        if ($stmt->execute())
        {
            $retorno = true;
        }

        return $retorno;
    }

    /**
    * updateVlrpedido() - implementação da assinatura em CartaoPedidoDAO
    */
    public function updateVlrpedido($id, $vlrPedido)
    {   
        $retorno = false;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $stmt = $conexao->prepare(DmlSqlCartaoPedido::UPD_CARTAO_PEDIDO_CAPE_VL_PEDIDO_PK);
        $stmt->bind_param(DmlSql::DOUBLE_TYPE 
                            . DmlSql::DOUBLE_TYPE
                            ,$vlrPedido
                            ,$id);
        if ($stmt->execute())
        {
            $retorno = true;
        }

        return $retorno;
    }

    /**
    * updateDataautorizacao() - implementação da assinatura em CartaoPedidoDAO
    */
    public function updateDataautorizacao($id, $dataAutorizacao)
    {   
        $retorno = false;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $stmt = $conexao->prepare(DmlSqlCartaoPedido::UPD_CARTAO_PEDIDO_CAPE_DT_AUTORIZACAO_PK);
        $stmt->bind_param(DmlSql::STRING_TYPE 
                            . DmlSql::STRING_TYPE
                            ,$dataAutorizacao
                            ,$id);
        if ($stmt->execute())
        {
            $retorno = true;
        }

        return $retorno;
    }

    /**
    * updateDatapgto() - implementação da assinatura em CartaoPedidoDAO
    */
    public function updateDatapgto($id, $dataPgto)
    {   
        $retorno = false;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $stmt = $conexao->prepare(DmlSqlCartaoPedido::UPD_CARTAO_PEDIDO_CAPE_DT_PGTO_PK);
        $stmt->bind_param(DmlSql::STRING_TYPE 
                            . DmlSql::STRING_TYPE
                            ,$dataPgto
                            ,$id);
        if ($stmt->execute())
        {
            $retorno = true;
        }

        return $retorno;
    }

    /**
    * updateVlrpgto() - implementação da assinatura em CartaoPedidoDAO
    */
    public function updateVlrpgto($id, $vlrPgto)
    {   
        $retorno = false;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $stmt = $conexao->prepare(DmlSqlCartaoPedido::UPD_CARTAO_PEDIDO_CAPE_VL_PGTO_PK);
        $stmt->bind_param(DmlSql::DOUBLE_TYPE 
                            . DmlSql::DOUBLE_TYPE
                            ,$vlrPgto
                            ,$id);
        if ($stmt->execute())
        {
            $retorno = true;
        }

        return $retorno;
    }

    /**
    * updateHashgtway() - implementação da assinatura em CartaoPedidoDAO
    */
    public function updateHashgtway($id, $hashGtway)
    {   
        $retorno = false;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $stmt = $conexao->prepare(DmlSqlCartaoPedido::UPD_CARTAO_PEDIDO_CAPE_TX_HASH_GATEWAY_PK);
        $stmt->bind_param(DmlSql::STRING_TYPE 
                            . DmlSql::STRING_TYPE
                            ,$hashGtway
                            ,$id);
        if ($stmt->execute())
        {
            $retorno = true;
        }

        return $retorno;
    }

    /**
    * loadId_Campanha() - implementação da assinatura em CartaoPedidoDAO
    */

    public function loadId_Campanha($id_campanha)
    {   
        $retorno = NULL;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $res = $conexao->query(DmlSqlCartaoPedido::SELECT . ' WHERE ' . DmlSqlCartaoPedido::CAMP_ID . '=' . $id_campanha );
        if ($res){
            $retorno = $this->getDTO($res->fetch_assoc());
        }
        return $retorno;
    }

    /**
    * loadHashtransacao() - implementação da assinatura em CartaoPedidoDAO
    */

    public function loadHashtransacao($hashTransacao)
    {   
        $retorno = NULL;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $res = $conexao->query(DmlSqlCartaoPedido::SELECT . ' WHERE ' . DmlSqlCartaoPedido::CAPE_TX_HASH . '=' . $hashTransacao );
        if ($res){
            $retorno = $this->getDTO($res->fetch_assoc());
        }
        return $retorno;
    }

    /**
    * loadQtde() - implementação da assinatura em CartaoPedidoDAO
    */

    public function loadQtde($qtde)
    {   
        $retorno = NULL;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $res = $conexao->query(DmlSqlCartaoPedido::SELECT . ' WHERE ' . DmlSqlCartaoPedido::CAPE_NU_QTDE . '=' . $qtde );
        if ($res){
            $retorno = $this->getDTO($res->fetch_assoc());
        }
        return $retorno;
    }

    /**
    * loadSelos() - implementação da assinatura em CartaoPedidoDAO
    */

    public function loadSelos($selos)
    {   
        $retorno = NULL;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $res = $conexao->query(DmlSqlCartaoPedido::SELECT . ' WHERE ' . DmlSqlCartaoPedido::CAPE_NU_SELOS . '=' . $selos );
        if ($res){
            $retorno = $this->getDTO($res->fetch_assoc());
        }
        return $retorno;
    }

    /**
    * loadVlrpedido() - implementação da assinatura em CartaoPedidoDAO
    */

    public function loadVlrpedido($vlrPedido)
    {   
        $retorno = NULL;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $res = $conexao->query(DmlSqlCartaoPedido::SELECT . ' WHERE ' . DmlSqlCartaoPedido::CAPE_VL_PEDIDO . '=' . $vlrPedido );
        if ($res){
            $retorno = $this->getDTO($res->fetch_assoc());
        }
        return $retorno;
    }

    /**
    * loadDataautorizacao() - implementação da assinatura em CartaoPedidoDAO
    */

    public function loadDataautorizacao($dataAutorizacao)
    {   
        $retorno = NULL;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $res = $conexao->query(DmlSqlCartaoPedido::SELECT . ' WHERE ' . DmlSqlCartaoPedido::CAPE_DT_AUTORIZACAO . '=' . $dataAutorizacao );
        if ($res){
            $retorno = $this->getDTO($res->fetch_assoc());
        }
        return $retorno;
    }

    /**
    * loadDatapgto() - implementação da assinatura em CartaoPedidoDAO
    */

    public function loadDatapgto($dataPgto)
    {   
        $retorno = NULL;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $res = $conexao->query(DmlSqlCartaoPedido::SELECT . ' WHERE ' . DmlSqlCartaoPedido::CAPE_DT_PGTO . '=' . $dataPgto );
        if ($res){
            $retorno = $this->getDTO($res->fetch_assoc());
        }
        return $retorno;
    }

    /**
    * loadVlrpgto() - implementação da assinatura em CartaoPedidoDAO
    */

    public function loadVlrpgto($vlrPgto)
    {   
        $retorno = NULL;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $res = $conexao->query(DmlSqlCartaoPedido::SELECT . ' WHERE ' . DmlSqlCartaoPedido::CAPE_VL_PGTO . '=' . $vlrPgto );
        if ($res){
            $retorno = $this->getDTO($res->fetch_assoc());
        }
        return $retorno;
    }

    /**
    * loadHashgtway() - implementação da assinatura em CartaoPedidoDAO
    */

    public function loadHashgtway($hashGtway)
    {   
        $retorno = NULL;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $res = $conexao->query(DmlSqlCartaoPedido::SELECT . ' WHERE ' . DmlSqlCartaoPedido::CAPE_TX_HASH_GATEWAY . '=' . $hashGtway );
        if ($res){
            $retorno = $this->getDTO($res->fetch_assoc());
        }
        return $retorno;
    }


    /**
    * loadStatus() - implementação da assinatura em CartaoPedidoDAO
    */

    public function loadStatus($status)
    {   
        $retorno = NULL;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $res = $conexao->query(DmlSqlCartaoPedido::SELECT . ' WHERE ' . DmlSqlCartaoPedido::CAPE_IN_STATUS . '=' . $status );
        if ($res){
            $retorno = $this->getDTO($res->fetch_assoc());
        }
        return $retorno;
    }

    /**
    * loadDatacadastro() - implementação da assinatura em CartaoPedidoDAO
    */

    public function loadDatacadastro($dataCadastro)
    {   
        $retorno = NULL;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $res = $conexao->query(DmlSqlCartaoPedido::SELECT . ' WHERE ' . DmlSqlCartaoPedido::CAPE_DT_CADASTRO . '=' . $dataCadastro );
        if ($res){
            $retorno = $this->getDTO($res->fetch_assoc());
        }
        return $retorno;
    }

    /**
    * loadDataatualizacao() - implementação da assinatura em CartaoPedidoDAO
    */

    public function loadDataatualizacao($dataAtualizacao)
    {   
        $retorno = NULL;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $res = $conexao->query(DmlSqlCartaoPedido::SELECT . ' WHERE ' . DmlSqlCartaoPedido::CAPE_DT_UPDATE . '=' . $dataAtualizacao );
        if ($res){
            $retorno = $this->getDTO($res->fetch_assoc());
        }
        return $retorno;
    }

}
?>

