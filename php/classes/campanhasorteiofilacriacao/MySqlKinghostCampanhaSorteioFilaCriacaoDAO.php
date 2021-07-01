<?php

/**
* MySqlKinghostCampanhaSorteioFilaCriacaoDAO - Implementação DAO
*
* Classe de com todos os comandos DML e DDL (se necessário) para apoio 
* a classe MySqlKinghostCampanhaSorteioFilaCriacaoDAO
* Não é uma camada visível para outros dispositivos, como as camadas de apresentação e aplicação. 
*
*
* Tabela principal de atuação: CAMPANHA_SORTEIO_FILA_CRIACAO
*
* Changelog:
*
* 
* @author Julio Cesar Vitorino
* @since 23/08/2019 10:06:20
*
*/
require_once 'CampanhaSorteioFilaCriacaoDTO.php';
require_once 'CampanhaSorteioFilaCriacaoDAO.php';
require_once 'DmlSqlCampanhaSorteioFilaCriacao.php';

require_once '../variavel/VariavelCache.php';
require_once '../daofactory/DmlSql.php';
require_once '../mensagem/ConstantesMensagem.php';
require_once '../mensagem/MensagemCache.php';

class MySqlKinghostCampanhaSorteioFilaCriacaoDAO implements CampanhaSorteioFilaCriacaoDAO
{
    private $daofactory;

    function __construct($daofactory)
    {
        $this->daofactory = $daofactory;
    }


/**
* loadMaxId_CasoPK() - Carrega um MaxID (pk) para um ${CAMPO} e status
*
* @param $id_caso
* @param $status
* @return $dto
*/ 

    public function loadMaxId_CasoPK($id_caso,$status)
    {   
        $retorno = 0;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $sql = DmlSqlCampanhaSorteioFilaCriacao::SELECT_MAX_PK . ' WHERE ' 
        . DmlSqlCampanhaSorteioFilaCriacao::CASO_ID . " = $id_caso "
        . " AND " . DmlSqlCampanhaSorteioFilaCriacao::CSFC_IN_STATUS . " = '$status'";

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
* listAll() - Lista todos os registros provenientes de CAMPANHA_SORTEIO_FILA_CRIACAO sem critério de paginação
*
* @return List<CampanhaSorteioFilaCriacaoDTO>[]
*/ 
    public function listAll()   {   }

/**
* update() - atualiza apenas um registro com base no dto CampanhaSorteioFilaCriacaoDTO->id
* @param $daofactory
*
* @return boolean
*/ 
    public function update($dto)
    {   
        $retorno = false;

        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $stmt = $conexao->prepare(DmlSqlCampanhaSorteioFilaCriacao::UPD_PK);
        $stmt->bind_param(DmlSql::INTEGER_TYPE 
                            . DmlSql::STRING_TYPE 
                            . DmlSql::INTEGER_TYPE 
                            ,$dto->id_caso
                            ,$dto->qtLoteTicketCriar
                            ,$dto->id );
        if ($stmt->execute())
        {
            $retorno = true;
        }

        return $retorno;
    }

/**
* delete() - excluir fisicamente um registro com base no dto CampanhaSorteioFilaCriacaoDTO->id
*
* @return boolean
*/ 
    public function delete($dto)
    {   
        $retorno = false;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $stmt = $conexao->prepare(DmlSqlCampanhaSorteioFilaCriacao::DEL_PK);
        $stmt->bind_param(DmlSql::INTEGER_TYPE
                            ,$dto->id);
        if ($stmt->execute())
        {
            $retorno = true;
        }

        return $retorno;
    }


    public function listCampanhaSorteioFilaCriacaoStatus($status)
    {
        $retorno = array();

        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $res = $conexao->query(DmlSqlCampanhaSorteioFilaCriacao::SELECT . 'WHERE `' . DmlSqlCampanhaSorteioFilaCriacao::CSFC_IN_STATUS . "` = '$status'" );
        if ($res){
            while ($row = $res->fetch_assoc()) {
                array_push($retorno, $this->getDTO($row));
            }
        }
        return $retorno;
    }

/**
* countCampanhaSorteioFilaCriacaoPorStatus() - contar a quantidade de registros
* sob o contexto da classe CampanhaSorteioFilaCriacao com base no status específico. 
*
* Atenção em @see $sql na tabela CAMPANHA_SORTEIO_FILA_CRIACAO 
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

    public function countCampanhaSorteioFilaCriacaoPorStatus($status)
    {   
        $retorno = 0;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $res = $conexao->query(DmlSqlCampanhaSorteioFilaCriacao::SQL_COUNT . ' WHERE ' 
        . DmlSqlCampanhaSorteioFilaCriacao::CSFC_IN_STATUS . " = '$status'"
        );
        if ($res){
            $tmp = $res->fetch_assoc();
            $retorno = $tmp['contador'];
        }
        return $retorno;

    }

/**
* listCampanhaSorteioFilaCriacaoPorStatus() - Listar um conjunto de registro previamente paginado
* sob o contexto da classe CampanhaSorteioFilaCriacao com base no status específico.
*
* Atenção em @see $sql na tabela CAMPANHA_SORTEIO_FILA_CRIACAO 
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

    public function listCampanhaSorteioFilaCriacaoPorStatus($status, $pag, $qtde, $coluna, $ordem)
    {
        $sql = DmlSqlCampanhaSorteioFilaCriacao::SELECT 
        . ' WHERE ' . DmlSqlCampanhaSorteioFilaCriacao::CSFC_IN_STATUS . " = '$status'"
        . ' ORDER BY ' . $coluna . ($ordem == 0 ? " ASC": " DESC");
        return $this->listPagina($sql, $pag, $qtde);
    }

/**
* countCampanhaSorteioFilaCriacaoPorUsuaIdStatus() - contar a quantidade de registros
* sob o contexto da classe CampanhaSorteioFilaCriacao com base no usuário específico. Esse usuário
* é o usuário logado na sessão ou no próprio dispositivo móvel e de acordo com a 
* query em @see $sql na tabela CAMPANHA_SORTEIO_FILA_CRIACAO 
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

    public function countCampanhaSorteioFilaCriacaoPorUsuaIdStatus($usuaid, $status)
    {   
        $retorno = 0;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $res = $conexao->query(DmlSqlCampanhaSorteioFilaCriacao::SQL_COUNT . ' WHERE ' 
        . DmlSqlCampanhaSorteioFilaCriacao::USUA_ID . " = $usuaid '"
        . ' AND ' . DmlSqlCampanhaSorteioFilaCriacao::CSFC_IN_STATUS . " = '$status'"
        );
        if ($res){
            $tmp = $res->fetch_assoc();
            $retorno = $tmp['contador'];
        }
        return $retorno;

    }

/**
* listCampanhaSorteioFilaCriacaoPorUsuaIdStatus() - Listar um conjunto de registro previamente paginado
* sob o contexto da classe CampanhaSorteioFilaCriacao com base no usuário específico. Esse usuário
* é o usuário logado na sessão ou no próprio dispositivo móvel e de acordo com a 
* query em @see $sql na tabela CAMPANHA_SORTEIO_FILA_CRIACAO 
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
    public function listCampanhaSorteioFilaCriacaoPorUsuaIdStatus($usuaid, $status, $pag, $qtde, $coluna, $ordem)
    {
        $sql = DmlSqlCampanhaSorteioFilaCriacao::SELECT 
        . ' WHERE ' . DmlSqlCampanhaSorteioFilaCriacao::USUA_ID . " = $usuaid "
        . ' AND ' . DmlSqlCampanhaSorteioFilaCriacao::CSFC_IN_STATUS . " = '$status'"
        . ' ORDER BY ' . $coluna . ($ordem == 0 ? " ASC": " DESC");
        return $this->listPagina($sql, $pag, $qtde);
    }

/**
* listPagina() - Listar um conjunto de registro previamente paginado
* e de acordo com a query em @see $sql na tabela CAMPANHA_SORTEIO_FILA_CRIACAO 
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
* na tabela CAMPANHA_SORTEIO_FILA_CRIACAO usando a Primary Key CSFC_ID
*
* @param $id
* @return CampanhaSorteioFilaCriacaoDTO
*/ 
    public function loadPK($id)
    {   
        $retorno = NULL;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $res = $conexao->query(DmlSqlCampanhaSorteioFilaCriacao::SELECT . ' WHERE ' . DmlSqlCampanhaSorteioFilaCriacao::CSFC_ID . '=' . $id );
        if ($res){
            $retorno = $this->getDTO($res->fetch_assoc());
        }
        return $retorno;
    }

/**
* updateStatus() - atualizar o campo de STATUS utilizando a id como item de busca
* na tabela CAMPANHA_SORTEIO_FILA_CRIACAO usando a Primary Key CSFC_ID
*
* @param $id
* @param $status
*
* @return CampanhaSorteioFilaCriacaoDTO
*/ 
    public function updateStatus($id, $status)
    {   
        $retorno = false;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $stmt = $conexao->prepare(DmlSqlCampanhaSorteioFilaCriacao::UPD_STATUS);
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
* insert() - inserir um registro com base no CampanhaSorteioFilaCriacaoDTO. Alguns atributos dentro do DTO
* serão ignorados caso estejam populados, pois os mesmos possuem constraint de DEFAULT value
* ou campos de AUTO INCREMENTO já previamente definidos no DDL de criação de tabelas do BD.
*
* Atributos da classe CampanhaSorteioFilaCriacaoDTO sumariamente IGNORADOS por este método MESMO que estejam preenchidos:
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
        $stmt = $conexao->prepare(DmlSqlCampanhaSorteioFilaCriacao::INS);
        $stmt->bind_param(DmlSql::INTEGER_TYPE 
                            . DmlSql::STRING_TYPE 
                            ,$dto->id_caso
                            ,$dto->qtLoteTicketCriar
        );
        if ($stmt->execute())
        {
            $retorno = true;
        }

        return $retorno;
    }

    /**
     * getDTO() - Transforma o resultset padrão em CampanhaSorteioFilaCriacaoDTO
    */
    public function getDTO($resultset)
    {
        if($resultset == NULL){
            return NULL;
        }
        //var_dump($resultset); // ótimo pra debugar
        $retorno = new CampanhaSorteioFilaCriacaoDTO();
        $retorno->id = $resultset[DmlSqlCampanhaSorteioFilaCriacao::CSFC_ID] == NULL ? NULL : $resultset[DmlSqlCampanhaSorteioFilaCriacao::CSFC_ID];
        $retorno->id_caso = $resultset[DmlSqlCampanhaSorteioFilaCriacao::CASO_ID] == NULL ? NULL : $resultset[DmlSqlCampanhaSorteioFilaCriacao::CASO_ID];
        $retorno->qtLoteTicketCriar = $resultset[DmlSqlCampanhaSorteioFilaCriacao::CSFC_QT_LOTE] == NULL ? NULL : $resultset[DmlSqlCampanhaSorteioFilaCriacao::CSFC_QT_LOTE];
        $retorno->status = $resultset[DmlSqlCampanhaSorteioFilaCriacao::CSFC_IN_STATUS] == NULL ? NULL : $resultset[DmlSqlCampanhaSorteioFilaCriacao::CSFC_IN_STATUS];
        $retorno->dataCadastro = Util::MySQLDate_to_DMYHMiS($resultset[DmlSqlCampanhaSorteioFilaCriacao::CSFC_DT_CADASTRO]);
        $retorno->dataAtualizacao = Util::MySQLDate_to_DMYHMiS($resultset[DmlSqlCampanhaSorteioFilaCriacao::CSFC_DT_UPDATE]);
        $retorno->statusdesc = VariavelCache::getInstance()->getStatusDesc($retorno->status);
        $retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
        $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);
        
        return $retorno;

    }

    /**
    * updateId_Caso() - implementação da assinatura em CampanhaSorteioFilaCriacaoDAO
    */
    public function updateId_Caso($id, $id_caso)
    {   
        $retorno = false;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $stmt = $conexao->prepare(DmlSqlCampanhaSorteioFilaCriacao::UPD_CAMPANHA_SORTEIO_FILA_CRIACAO_CASO_ID_PK);
        $stmt->bind_param(DmlSql::INTEGER_TYPE 
                            . DmlSql::INTEGER_TYPE
                            ,$id_caso
                            ,$id);
        if ($stmt->execute())
        {
            $retorno = true;
        }

        return $retorno;
    }

    /**
    * updateQtloteticketcriar() - implementação da assinatura em CampanhaSorteioFilaCriacaoDAO
    */
    public function updateQtloteticketcriar($id, $qtLoteTicketCriar)
    {   
        $retorno = false;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $stmt = $conexao->prepare(DmlSqlCampanhaSorteioFilaCriacao::UPD_CAMPANHA_SORTEIO_FILA_CRIACAO_CSFC_QT_LOTE_PK);
        $stmt->bind_param(DmlSql::STRING_TYPE 
                            . DmlSql::STRING_TYPE
                            ,$qtLoteTicketCriar
                            ,$id);
        if ($stmt->execute())
        {
            $retorno = true;
        }

        return $retorno;
    }

    /**
    * loadId_Caso() - implementação da assinatura em CampanhaSorteioFilaCriacaoDAO
    */

    public function loadId_Caso($id_caso)
    {   
        $retorno = NULL;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $res = $conexao->query(DmlSqlCampanhaSorteioFilaCriacao::SELECT . ' WHERE ' . DmlSqlCampanhaSorteioFilaCriacao::CASO_ID . '=' . $id_caso );
        if ($res){
            $retorno = $this->getDTO($res->fetch_assoc());
        }
        return $retorno;
    }

    /**
    * loadQtloteticketcriar() - implementação da assinatura em CampanhaSorteioFilaCriacaoDAO
    */

    public function loadQtloteticketcriar($qtLoteTicketCriar)
    {   
        $retorno = NULL;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $res = $conexao->query(DmlSqlCampanhaSorteioFilaCriacao::SELECT . ' WHERE ' . DmlSqlCampanhaSorteioFilaCriacao::CSFC_QT_LOTE . '=' . $qtLoteTicketCriar );
        if ($res){
            $retorno = $this->getDTO($res->fetch_assoc());
        }
        return $retorno;
    }

    /**
    * loadStatus() - implementação da assinatura em CampanhaSorteioFilaCriacaoDAO
    */

    public function loadStatus($status)
    {   
        $retorno = NULL;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $res = $conexao->query(DmlSqlCampanhaSorteioFilaCriacao::SELECT . ' WHERE ' . DmlSqlCampanhaSorteioFilaCriacao::CSFC_IN_STATUS . '=' . $status );
        if ($res){
            $retorno = $this->getDTO($res->fetch_assoc());
        }
        return $retorno;
    }

    /**
    * loadDatacadastro() - implementação da assinatura em CampanhaSorteioFilaCriacaoDAO
    */

    public function loadDatacadastro($dataCadastro)
    {   
        $retorno = NULL;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $res = $conexao->query(DmlSqlCampanhaSorteioFilaCriacao::SELECT . ' WHERE ' . DmlSqlCampanhaSorteioFilaCriacao::CSFC_DT_CADASTRO . '=' . $dataCadastro );
        if ($res){
            $retorno = $this->getDTO($res->fetch_assoc());
        }
        return $retorno;
    }

    /**
    * loadDataatualizacao() - implementação da assinatura em CampanhaSorteioFilaCriacaoDAO
    */

    public function loadDataatualizacao($dataAtualizacao)
    {   
        $retorno = NULL;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $res = $conexao->query(DmlSqlCampanhaSorteioFilaCriacao::SELECT . ' WHERE ' . DmlSqlCampanhaSorteioFilaCriacao::CSFC_DT_UPDATE . '=' . $dataAtualizacao );
        if ($res){
            $retorno = $this->getDTO($res->fetch_assoc());
        }
        return $retorno;
    }

}
?>
