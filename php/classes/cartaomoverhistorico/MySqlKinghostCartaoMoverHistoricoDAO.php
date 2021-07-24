<?php

/**
* MySqlKinghostCartaoMoverHistoricoDAO - Implementação DAO
*
* Classe de com todos os comandos DML e DDL (se necessário) para apoio 
* a classe MySqlKinghostCartaoMoverHistoricoDAO
* Não é uma camada visível para outros dispositivos, como as camadas de apresentação e aplicação. 
*
*
* Tabela principal de atuação: CARTAO_MOVER_HISTORICO
*
* Changelog:
*
* 
* @author Julio Cesar Vitorino
* @since 23/08/2019 10:06:20
*
*/
require_once 'CartaoMoverHistoricoDTO.php';
require_once 'CartaoMoverHistoricoDAO.php';
require_once 'DmlSqlCartaoMoverHistorico.php';

require_once '../mensagem/ConstantesMensagem.php';
require_once '../mensagem/MensagemCache.php';
require_once '../variavel/VariavelCache.php';
require_once '../daofactory/DmlSql.php';

class MySqlKinghostCartaoMoverHistoricoDAO implements CartaoMoverHistoricoDAO
{
    private $daofactory;

    function __construct($daofactory)
    {
        $this->daofactory = $daofactory;
    }


/**
* loadMaxIdcartaoPK() - Carrega um MaxID (pk) para um ${CAMPO} e status
*
* @param $idCartao
* @param $status
* @return $dto
*/ 

    public function loadMaxIdcartaoPK($idCartao,$status)
    {   
        $retorno = 0;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $sql = DmlSqlCartaoMoverHistorico::SELECT_MAX_PK . ' WHERE ' 
        . DmlSqlCartaoMoverHistorico::CART_ID . " = $idCartao "
        . " AND " . DmlSqlCartaoMoverHistorico::CAMH_IN_STATUS . " = '$status'";

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
* listAll() - Lista todos os registros provenientes de CARTAO_MOVER_HISTORICO sem critério de paginação
*
* @return List<CartaoMoverHistoricoDTO>[]
*/ 
    public function listAll()   {   }

/**
* update() - atualiza apenas um registro com base no dto CartaoMoverHistoricoDTO->id
* @param $daofactory
*
* @return boolean
*/ 
    public function update($dto)
    {   
        $retorno = false;

        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $stmt = $conexao->prepare(DmlSqlCartaoMoverHistorico::UPD_PK);
        $stmt->bind_param(DmlSql::INTEGER_TYPE 
                            . DmlSql::INTEGER_TYPE 
                            . DmlSql::INTEGER_TYPE 
                            . DmlSql::INTEGER_TYPE 
                            ,$dto->idCartao
                            ,$dto->idUsuarioDoador
                            ,$dto->idUsuarioReceptor
                            ,$dto->id );
        if ($stmt->execute())
        {
            $retorno = true;
        }

        return $retorno;
    }

/**
* delete() - excluir fisicamente um registro com base no dto CartaoMoverHistoricoDTO->id
*
* @return boolean
*/ 
    public function delete($dto)
    {   
        $retorno = false;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $stmt = $conexao->prepare(DmlSqlCartaoMoverHistorico::DEL_PK);
        $stmt->bind_param(DmlSql::INTEGER_TYPE
                            ,$dto->id);
        if ($stmt->execute())
        {
            $retorno = true;
        }

        return $retorno;
    }


    public function listCartaoMoverHistoricoStatus($status)
    {
        $retorno = array();

        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $res = $conexao->query(DmlSqlCartaoMoverHistorico::SELECT . 'WHERE `' . DmlSqlCartaoMoverHistorico::CAMH_IN_STATUS . "` = '$status'" );
        if ($res){
            while ($row = $res->fetch_assoc()) {
                array_push($retorno, $this->getDTO($row));
            }
        }
        return $retorno;
    }

/**
* countCartaoMoverHistoricoPorStatus() - contar a quantidade de registros
* sob o contexto da classe CartaoMoverHistorico com base no status específico. 
*
* Atenção em @see $sql na tabela CARTAO_MOVER_HISTORICO 
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

    public function countCartaoMoverHistoricoPorStatus($status)
    {   
        $retorno = 0;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $res = $conexao->query(DmlSqlCartaoMoverHistorico::SQL_COUNT . ' WHERE ' 
        . DmlSqlCartaoMoverHistorico::CAMH_IN_STATUS . " = '$status'"
        );
        if ($res){
            $tmp = $res->fetch_assoc();
            $retorno = $tmp['contador'];
        }
        return $retorno;

    }

/**
* listCartaoMoverHistoricoPorStatus() - Listar um conjunto de registro previamente paginado
* sob o contexto da classe CartaoMoverHistorico com base no status específico.
*
* Atenção em @see $sql na tabela CARTAO_MOVER_HISTORICO 
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

    public function listCartaoMoverHistoricoPorStatus($status, $pag, $qtde, $coluna, $ordem)
    {
        $sql = DmlSqlCartaoMoverHistorico::SELECT 
        . ' WHERE ' . DmlSqlCartaoMoverHistorico::CAMH_IN_STATUS . " = '$status'"
        . ' ORDER BY ' . $coluna . ($ordem == 0 ? " ASC": " DESC");
        return $this->listPagina($sql, $pag, $qtde);
    }

/**
* countCartaoMoverHistoricoPorUsuaIdStatus() - contar a quantidade de registros
* sob o contexto da classe CartaoMoverHistorico com base no usuário específico. Esse usuário
* é o usuário logado na sessão ou no próprio dispositivo móvel e de acordo com a 
* query em @see $sql na tabela CARTAO_MOVER_HISTORICO 
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

    public function countCartaoMoverHistoricoPorUsuaIdStatus($usuaid, $status)
    {   
        $retorno = 0;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $res = $conexao->query(DmlSqlCartaoMoverHistorico::SQL_COUNT . ' WHERE ' 
        . DmlSqlCartaoMoverHistorico::USUA_ID . " = $usuaid "
        . ' AND ' . DmlSqlCartaoMoverHistorico::CAMH_IN_STATUS . " = '$status'"
        );
        if ($res){
            $tmp = $res->fetch_assoc();
            $retorno = $tmp['contador'];
        }
        return $retorno;

    }

/**
* listCartaoMoverHistoricoPorUsuaIdStatus() - Listar um conjunto de registro previamente paginado
* sob o contexto da classe CartaoMoverHistorico com base no usuário específico. Esse usuário
* é o usuário logado na sessão ou no próprio dispositivo móvel e de acordo com a 
* query em @see $sql na tabela CARTAO_MOVER_HISTORICO 
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
    public function listCartaoMoverHistoricoPorUsuaIdStatus($usuaid, $status, $pag, $qtde, $coluna, $ordem)
    {
        $sql = DmlSqlCartaoMoverHistorico::SELECT 
        . ' WHERE ' . DmlSqlCartaoMoverHistorico::USUA_ID . " = $usuaid "
        . ' AND ' . DmlSqlCartaoMoverHistorico::CAMH_IN_STATUS . " = '$status'"
        . ' ORDER BY ' . $coluna . ($ordem == 0 ? " ASC": " DESC");
        return $this->listPagina($sql, $pag, $qtde);
    }

/**
* listPagina() - Listar um conjunto de registro previamente paginado
* e de acordo com a query em @see $sql na tabela CARTAO_MOVER_HISTORICO 
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
* na tabela CARTAO_MOVER_HISTORICO usando a Primary Key CAMH_ID
*
* @param $id
* @return CartaoMoverHistoricoDTO
*/ 
    public function loadPK($id)
    {   
        $retorno = NULL;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $res = $conexao->query(DmlSqlCartaoMoverHistorico::SELECT . ' WHERE ' . DmlSqlCartaoMoverHistorico::CAMH_ID . '=' . $id );
        if ($res->num_rows > 0){
            $retorno = $this->getDTO($res->fetch_assoc());
        }
        return $retorno;
    }

/**
* updateStatus() - atualizar o campo de STATUS utilizando a id como item de busca
* na tabela CARTAO_MOVER_HISTORICO usando a Primary Key CAMH_ID
*
* @param $id
* @param $status
*
* @return CartaoMoverHistoricoDTO
*/ 
    public function updateStatus($id, $status)
    {   
        $retorno = false;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $stmt = $conexao->prepare(DmlSqlCartaoMoverHistorico::UPD_STATUS);
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
* insert() - inserir um registro com base no CartaoMoverHistoricoDTO. Alguns atributos dentro do DTO
* serão ignorados caso estejam populados, pois os mesmos possuem constraint de DEFAULT value
* ou campos de AUTO INCREMENTO já previamente definidos no DDL de criação de tabelas do BD.
*
* Atributos da classe CartaoMoverHistoricoDTO sumariamente IGNORADOS por este método MESMO que estejam preenchidos:
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
        $stmt = $conexao->prepare(DmlSqlCartaoMoverHistorico::INS);
        $stmt->bind_param(DmlSql::INTEGER_TYPE 
                            . DmlSql::INTEGER_TYPE 
                            . DmlSql::INTEGER_TYPE 
                            ,$dto->idCartao
                            ,$dto->idUsuarioDoador
                            ,$dto->idUsuarioReceptor
        );
        if ($stmt->execute())
        {
            $retorno = true;
        }

        return $retorno;
    }

    /**
     * getDTO() - Transforma o resultset padrão em CartaoMoverHistoricoDTO
    */
    public function getDTO($resultset)
    {
        if(is_null($resultset)){
            return NULL;
        }

        //echo var_dump($resultset); // ótimo pra debugar
        $retorno = new CartaoMoverHistoricoDTO();
        $retorno->id = $resultset[DmlSqlCartaoMoverHistorico::CAMH_ID] == NULL ? NULL : $resultset[DmlSqlCartaoMoverHistorico::CAMH_ID];
        $retorno->idCartao = $resultset[DmlSqlCartaoMoverHistorico::CART_ID] == NULL ? NULL : $resultset[DmlSqlCartaoMoverHistorico::CART_ID];
        $retorno->idUsuarioDoador = $resultset[DmlSqlCartaoMoverHistorico::USUA_ID_DE] == NULL ? NULL : $resultset[DmlSqlCartaoMoverHistorico::USUA_ID_DE];
        $retorno->idUsuarioReceptor = $resultset[DmlSqlCartaoMoverHistorico::USUA_ID_PARA] == NULL ? NULL : $resultset[DmlSqlCartaoMoverHistorico::USUA_ID_PARA];
        $retorno->status = $resultset[DmlSqlCartaoMoverHistorico::CAMH_IN_STATUS] == NULL ? NULL : $resultset[DmlSqlCartaoMoverHistorico::CAMH_IN_STATUS];
        $retorno->dataCadastro = Util::MySQLDate_to_DMYHMiS($resultset[DmlSqlCartaoMoverHistorico::CAMH_DT_CADASTRO]);
        $retorno->dataAtualizacao = Util::MySQLDate_to_DMYHMiS($resultset[DmlSqlCartaoMoverHistorico::CAMH_DT_UPDATE]);
        $retorno->statusdesc = VariavelCache::getInstance()->getStatusDesc($retorno->status);
        $retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
        $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);
        return $retorno;

    }

    /**
    * updateIdcartao() - implementação da assinatura em CartaoMoverHistoricoDAO
    */
    public function updateIdcartao($id, $idCartao)
    {   
        $retorno = false;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $stmt = $conexao->prepare(DmlSqlCartaoMoverHistorico::UPD_CARTAO_MOVER_HISTORICO_CART_ID_PK);
        $stmt->bind_param(DmlSql::INTEGER_TYPE 
                            . DmlSql::INTEGER_TYPE
                            ,$idCartao
                            ,$id);
        if ($stmt->execute())
        {
            $retorno = true;
        }

        return $retorno;
    }

    /**
    * updateIdusuariodoador() - implementação da assinatura em CartaoMoverHistoricoDAO
    */
    public function updateIdusuariodoador($id, $idUsuarioDoador)
    {   
        $retorno = false;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $stmt = $conexao->prepare(DmlSqlCartaoMoverHistorico::UPD_CARTAO_MOVER_HISTORICO_USUA_ID_DE_PK);
        $stmt->bind_param(DmlSql::INTEGER_TYPE 
                            . DmlSql::INTEGER_TYPE
                            ,$idUsuarioDoador
                            ,$id);
        if ($stmt->execute())
        {
            $retorno = true;
        }

        return $retorno;
    }

    /**
    * updateIdusuarioreceptor() - implementação da assinatura em CartaoMoverHistoricoDAO
    */
    public function updateIdusuarioreceptor($id, $idUsuarioReceptor)
    {   
        $retorno = false;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $stmt = $conexao->prepare(DmlSqlCartaoMoverHistorico::UPD_CARTAO_MOVER_HISTORICO_USUA_ID_PARA_PK);
        $stmt->bind_param(DmlSql::INTEGER_TYPE 
                            . DmlSql::INTEGER_TYPE
                            ,$idUsuarioReceptor
                            ,$id);
        if ($stmt->execute())
        {
            $retorno = true;
        }

        return $retorno;
    }
    /**
    * loadIdcartao() - implementação da assinatura em CartaoMoverHistoricoDAO
    */

    public function loadIdcartao($idCartao)
    {   
        $retorno = NULL;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $res = $conexao->query(DmlSqlCartaoMoverHistorico::SELECT . ' WHERE ' . DmlSqlCartaoMoverHistorico::CART_ID . '=' . $idCartao );
        if ($res){
            $retorno = $this->getDTO($res->fetch_assoc());
        }
        return $retorno;
    }

    /**
    * loadIdusuariodoador() - implementação da assinatura em CartaoMoverHistoricoDAO
    */

    public function loadIdusuariodoador($idUsuarioDoador)
    {   
        $retorno = NULL;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $res = $conexao->query(DmlSqlCartaoMoverHistorico::SELECT . ' WHERE ' . DmlSqlCartaoMoverHistorico::USUA_ID_DE . '=' . $idUsuarioDoador );
        if ($res){
            $retorno = $this->getDTO($res->fetch_assoc());
        }
        return $retorno;
    }

    /**
    * loadIdusuarioreceptor() - implementação da assinatura em CartaoMoverHistoricoDAO
    */

    public function loadIdusuarioreceptor($idUsuarioReceptor)
    {   
        $retorno = NULL;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $res = $conexao->query(DmlSqlCartaoMoverHistorico::SELECT . ' WHERE ' . DmlSqlCartaoMoverHistorico::USUA_ID_PARA . '=' . $idUsuarioReceptor );
        if ($res){
            $retorno = $this->getDTO($res->fetch_assoc());
        }
        return $retorno;
    }
    /**
    * loadStatus() - implementação da assinatura em CartaoMoverHistoricoDAO
    */

    public function loadStatus($status)
    {   
        $retorno = NULL;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $res = $conexao->query(DmlSqlCartaoMoverHistorico::SELECT . ' WHERE ' . DmlSqlCartaoMoverHistorico::CAMH_IN_STATUS . '=' . $status );
        if ($res){
            $retorno = $this->getDTO($res->fetch_assoc());
        }
        return $retorno;
    }

    /**
    * loadDatacadastro() - implementação da assinatura em CartaoMoverHistoricoDAO
    */

    public function loadDatacadastro($dataCadastro)
    {   
        $retorno = NULL;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $res = $conexao->query(DmlSqlCartaoMoverHistorico::SELECT . ' WHERE ' . DmlSqlCartaoMoverHistorico::CAMH_DT_CADASTRO . '=' . $dataCadastro );
        if ($res){
            $retorno = $this->getDTO($res->fetch_assoc());
        }
        return $retorno;
    }

    /**
    * loadDataatualizacao() - implementação da assinatura em CartaoMoverHistoricoDAO
    */

    public function loadDataatualizacao($dataAtualizacao)
    {   
        $retorno = NULL;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $res = $conexao->query(DmlSqlCartaoMoverHistorico::SELECT . ' WHERE ' . DmlSqlCartaoMoverHistorico::CAMH_DT_UPDATE . '=' . $dataAtualizacao );
        if ($res){
            $retorno = $this->getDTO($res->fetch_assoc());
        }
        return $retorno;
    }

}
?>
