<?php

/**
* MySqlKinghostFilaQRCodePendenteProduzirDAO - Implementação DAO
*
* Classe de com todos os comandos DML e DDL (se necessário) para apoio 
* a classe MySqlKinghostFilaQRCodePendenteProduzirDAO
* Não é uma camada visível para outros dispositivos, como as camadas de apresentação e aplicação. 
*
*
* Tabela principal de atuação: FILA_QRCODES_PNDNT_PRD
*
* Changelog:
*
* 
* @author Julio Cesar Vitorino
* @since 23/08/2019 10:06:20
*
*/
require_once 'FilaQRCodePendenteProduzirDTO.php';
require_once 'FilaQRCodePendenteProduzirDAO.php';
require_once 'DmlSqlFilaQRCodePendenteProduzir.php';

require_once '../variavel/VariavelCache.php';
require_once '../daofactory/DmlSql.php';

class MySqlKinghostFilaQRCodePendenteProduzirDAO implements FilaQRCodePendenteProduzirDAO
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
        $sql = DmlSqlFilaQRCodePendenteProduzir::SELECT_MAX_PK . ' WHERE ' 
        . DmlSqlFilaQRCodePendenteProduzir::CAMP_ID . " = $id_campanha "
        . " AND " . DmlSqlFilaQRCodePendenteProduzir::FQPP_IN_STATUS . " = '$status'";

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
* listAll() - Lista todos os registros provenientes de FILA_QRCODES_PNDNT_PRD sem critério de paginação
*
* @return List<FilaQRCodePendenteProduzirDTO>[]
*/ 
    public function listAll()   {   }

/**
* update() - atualiza apenas um registro com base no dto FilaQRCodePendenteProduzirDTO->id
* @param $daofactory
*
* @return boolean
*/ 
    public function update($dto)
    {   
        $retorno = false;

        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $stmt = $conexao->prepare(DmlSqlFilaQRCodePendenteProduzir::UPD_PK);
        $stmt->bind_param(DmlSql::INTEGER_TYPE 
                            . DmlSql::INTEGER_TYPE 
                            . DmlSql::INTEGER_TYPE 
                            . DmlSql::INTEGER_TYPE 
                            ,$dto->id_campanha
                            ,$dto->id_usuario
                            ,$dto->qtde
                            ,$dto->id );
        if ($stmt->execute())
        {
            $retorno = true;
        }

        return $retorno;
    }

/**
* delete() - excluir fisicamente um registro com base no dto FilaQRCodePendenteProduzirDTO->id
*
* @return boolean
*/ 
    public function delete($dto)
    {   
        $retorno = false;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $stmt = $conexao->prepare(DmlSqlFilaQRCodePendenteProduzir::DEL_PK);
        $stmt->bind_param(DmlSql::INTEGER_TYPE
                            ,$dto->id);
        if ($stmt->execute())
        {
            $retorno = true;
        }

        return $retorno;
    }


    public function listFilaQRCodePendenteProduzirStatus($status)
    {
        $retorno = array();

        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $res = $conexao->query(DmlSqlFilaQRCodePendenteProduzir::SELECT . 'WHERE `' . DmlSqlFilaQRCodePendenteProduzir::FQPP_IN_STATUS . "` = '$status'" );
        if ($res){
            while ($row = $res->fetch_assoc()) {
                array_push($retorno, $this->getDTO($row));
            }
        }
        return $retorno;
    }

/**
* countFilaQRCodePendenteProduzirPorStatus() - contar a quantidade de registros
* sob o contexto da classe FilaQRCodePendenteProduzir com base no status específico. 
*
* Atenção em @see $sql na tabela FILA_QRCODES_PNDNT_PRD 
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

    public function countFilaQRCodePendenteProduzirPorStatus($status)
    {   
        $retorno = 0;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $res = $conexao->query(DmlSqlFilaQRCodePendenteProduzir::SQL_COUNT . ' WHERE ' 
        . DmlSqlFilaQRCodePendenteProduzir::FQPP_IN_STATUS . " = '$status'"
        );
        if ($res){
            $tmp = $res->fetch_assoc();
            $retorno = $tmp['contador'];
        }
        return $retorno;

    }

/**
* listFilaQRCodePendenteProduzirPorStatus() - Listar um conjunto de registro previamente paginado
* sob o contexto da classe FilaQRCodePendenteProduzir com base no status específico.
*
* Atenção em @see $sql na tabela FILA_QRCODES_PNDNT_PRD 
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

    public function listFilaQRCodePendenteProduzirPorStatus($status, $pag, $qtde, $coluna, $ordem)
    {
        $sql = DmlSqlFilaQRCodePendenteProduzir::SELECT 
        . ' WHERE ' . DmlSqlFilaQRCodePendenteProduzir::FQPP_IN_STATUS . " = '$status'"
        . ' ORDER BY ' . $coluna . ($ordem == 0 ? " ASC": " DESC");
        return $this->listPagina($sql, $pag, $qtde);
    }

/**
* countFilaQRCodePendenteProduzirPorUsuaIdStatus() - contar a quantidade de registros
* sob o contexto da classe FilaQRCodePendenteProduzir com base no usuário específico. Esse usuário
* é o usuário logado na sessão ou no próprio dispositivo móvel e de acordo com a 
* query em @see $sql na tabela FILA_QRCODES_PNDNT_PRD 
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

    public function countFilaQRCodePendenteProduzirPorUsuaIdStatus($usuaid, $status)
    {   
        $retorno = 0;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $res = $conexao->query(DmlSqlFilaQRCodePendenteProduzir::SQL_COUNT . ' WHERE ' 
        . DmlSqlFilaQRCodePendenteProduzir::USUA_ID . " = $usuaid "
        . ' AND ' . DmlSqlFilaQRCodePendenteProduzir::FQPP_IN_STATUS . " = '$status'"
        );
        if ($res){
            $tmp = $res->fetch_assoc();
            $retorno = $tmp['contador'];
        }
        return $retorno;

    }

/**
* listFilaQRCodePendenteProduzirPorUsuaIdStatus() - Listar um conjunto de registro previamente paginado
* sob o contexto da classe FilaQRCodePendenteProduzir com base no usuário específico. Esse usuário
* é o usuário logado na sessão ou no próprio dispositivo móvel e de acordo com a 
* query em @see $sql na tabela FILA_QRCODES_PNDNT_PRD 
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
    public function listFilaQRCodePendenteProduzirPorUsuaIdStatus($usuaid, $status, $pag, $qtde, $coluna, $ordem)
    {
        $sql = DmlSqlFilaQRCodePendenteProduzir::SELECT 
        . ' WHERE ' . DmlSqlFilaQRCodePendenteProduzir::USUA_ID . " = $usuaid "
        . ' AND ' . DmlSqlFilaQRCodePendenteProduzir::FQPP_IN_STATUS . " = '$status'"
        . ' ORDER BY ' . $coluna . ($ordem == 0 ? " ASC": " DESC");
        return $this->listPagina($sql, $pag, $qtde);
    }

/**
* listPagina() - Listar um conjunto de registro previamente paginado
* e de acordo com a query em @see $sql na tabela FILA_QRCODES_PNDNT_PRD 
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
* na tabela FILA_QRCODES_PNDNT_PRD usando a Primary Key FQPP_ID
*
* @param $id
* @return FilaQRCodePendenteProduzirDTO
*/ 
    public function loadPK($id)
    {   
        $retorno = NULL;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $res = $conexao->query(DmlSqlFilaQRCodePendenteProduzir::SELECT . ' WHERE ' . DmlSqlFilaQRCodePendenteProduzir::FQPP_ID . '=' . $id );
        if ($res){
            $retorno = $this->getDTO($res->fetch_assoc());
        }
        return $retorno;
    }

/**
* updateStatus() - atualizar o campo de STATUS utilizando a id como item de busca
* na tabela FILA_QRCODES_PNDNT_PRD usando a Primary Key FQPP_ID
*
* @param $id
* @param $status
*
* @return FilaQRCodePendenteProduzirDTO
*/ 
    public function updateStatus($id, $status)
    {   
        $retorno = false;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $stmt = $conexao->prepare(DmlSqlFilaQRCodePendenteProduzir::UPD_STATUS);
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
* insert() - inserir um registro com base no FilaQRCodePendenteProduzirDTO. Alguns atributos dentro do DTO
* serão ignorados caso estejam populados, pois os mesmos possuem constraint de DEFAULT value
* ou campos de AUTO INCREMENTO já previamente definidos no DDL de criação de tabelas do BD.
*
* Atributos da classe FilaQRCodePendenteProduzirDTO sumariamente IGNORADOS por este método MESMO que estejam preenchidos:
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
        $stmt = $conexao->prepare(DmlSqlFilaQRCodePendenteProduzir::INS);
        $stmt->bind_param(DmlSql::INTEGER_TYPE 
                            . DmlSql::INTEGER_TYPE 
                            . DmlSql::INTEGER_TYPE 
                            ,$dto->id_campanha
                            ,$dto->id_usuario
                            ,$dto->qtde
        );
        if ($stmt->execute())
        {
            $retorno = true;
        }

        return $retorno;
    }

    /**
     * getDTO() - Transforma o resultset padrão em FilaQRCodePendenteProduzirDTO
    */
    public function getDTO($resultset)
    {
        //echo var_dump($resultset); // ótimo pra debugar
        $retorno = new FilaQRCodePendenteProduzirDTO();
        $retorno->id = $resultset[DmlSqlFilaQRCodePendenteProduzir::FQPP_ID] == NULL ? NULL : (int) $resultset[DmlSqlFilaQRCodePendenteProduzir::FQPP_ID];
        $retorno->id_campanha = $resultset[DmlSqlFilaQRCodePendenteProduzir::CAMP_ID] == NULL ? NULL : (int)  $resultset[DmlSqlFilaQRCodePendenteProduzir::CAMP_ID];
        $retorno->id_usuario = $resultset[DmlSqlFilaQRCodePendenteProduzir::USUA_ID] == NULL ? NULL :  (int) $resultset[DmlSqlFilaQRCodePendenteProduzir::USUA_ID];
        $retorno->qtde = $resultset[DmlSqlFilaQRCodePendenteProduzir::FQPP_NU_QTDE_QRC] == NULL ? NULL :  (int) $resultset[DmlSqlFilaQRCodePendenteProduzir::FQPP_NU_QTDE_QRC];
        $retorno->status = $resultset[DmlSqlFilaQRCodePendenteProduzir::FQPP_IN_STATUS] == NULL ? NULL : $resultset[DmlSqlFilaQRCodePendenteProduzir::FQPP_IN_STATUS];
        $retorno->dataCadastro = Util::MySQLDate_to_DMYHMiS($resultset[DmlSqlFilaQRCodePendenteProduzir::FQPP_DT_CADASTRO]);
        $retorno->dataAtualizacao = Util::MySQLDate_to_DMYHMiS($resultset[DmlSqlFilaQRCodePendenteProduzir::FQPP_DT_UPDATE]);
        $retorno->statusdesc = VariavelCache::getInstance()->getStatusDesc($retorno->status);
        return $retorno;

    }

    /**
    * updateId_Campanha() - implementação da assinatura em FilaQRCodePendenteProduzirDAO
    */
    public function updateId_Campanha($id, $id_campanha)
    {   
        $retorno = false;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $stmt = $conexao->prepare(DmlSqlFilaQRCodePendenteProduzir::UPD_FILA_QRCODES_PNDNT_PRD_CAMP_ID_PK);
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
    * updateId_Usuario() - implementação da assinatura em FilaQRCodePendenteProduzirDAO
    */
    public function updateId_Usuario($id, $id_usuario)
    {   
        $retorno = false;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $stmt = $conexao->prepare(DmlSqlFilaQRCodePendenteProduzir::UPD_FILA_QRCODES_PNDNT_PRD_USUA_ID_PK);
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
    * updateQtde() - implementação da assinatura em FilaQRCodePendenteProduzirDAO
    */
    public function updateQtde($id, $qtde)
    {   
        $retorno = false;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $stmt = $conexao->prepare(DmlSqlFilaQRCodePendenteProduzir::UPD_FILA_QRCODES_PNDNT_PRD_FQPP_NU_QTDE_QRC_PK);
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
    * loadId_Campanha() - implementação da assinatura em FilaQRCodePendenteProduzirDAO
    */

    public function loadId_Campanha($id_campanha)
    {   
        $retorno = NULL;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $res = $conexao->query(DmlSqlFilaQRCodePendenteProduzir::SELECT . ' WHERE ' . DmlSqlFilaQRCodePendenteProduzir::CAMP_ID . '=' . $id_campanha );
        if ($res){
            $retorno = $this->getDTO($res->fetch_assoc());
        }
        return $retorno;
    }

    /**
    * loadId_Usuario() - implementação da assinatura em FilaQRCodePendenteProduzirDAO
    */

    public function loadId_Usuario($id_usuario)
    {   
        $retorno = NULL;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $res = $conexao->query(DmlSqlFilaQRCodePendenteProduzir::SELECT . ' WHERE ' . DmlSqlFilaQRCodePendenteProduzir::USUA_ID . '=' . $id_usuario );
        if ($res){
            $retorno = $this->getDTO($res->fetch_assoc());
        }
        return $retorno;
    }

    /**
    * loadQtde() - implementação da assinatura em FilaQRCodePendenteProduzirDAO
    */

    public function loadQtde($qtde)
    {   
        $retorno = NULL;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $res = $conexao->query(DmlSqlFilaQRCodePendenteProduzir::SELECT . ' WHERE ' . DmlSqlFilaQRCodePendenteProduzir::FQPP_NU_QTDE_QRC . '=' . $qtde );
        if ($res){
            $retorno = $this->getDTO($res->fetch_assoc());
        }
        return $retorno;
    }


    /**
    * loadStatus() - implementação da assinatura em FilaQRCodePendenteProduzirDAO
    */

    public function loadStatus($status)
    {   
        $retorno = NULL;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $res = $conexao->query(DmlSqlFilaQRCodePendenteProduzir::SELECT . ' WHERE ' . DmlSqlFilaQRCodePendenteProduzir::FQPP_IN_STATUS . '=' . $status );
        if ($res){
            $retorno = $this->getDTO($res->fetch_assoc());
        }
        return $retorno;
    }

    /**
    * loadDatacadastro() - implementação da assinatura em FilaQRCodePendenteProduzirDAO
    */

    public function loadDatacadastro($dataCadastro)
    {   
        $retorno = NULL;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $res = $conexao->query(DmlSqlFilaQRCodePendenteProduzir::SELECT . ' WHERE ' . DmlSqlFilaQRCodePendenteProduzir::FQPP_DT_CADASTRO . '=' . $dataCadastro );
        if ($res){
            $retorno = $this->getDTO($res->fetch_assoc());
        }
        return $retorno;
    }

    /**
    * loadDataatualizacao() - implementação da assinatura em FilaQRCodePendenteProduzirDAO
    */

    public function loadDataatualizacao($dataAtualizacao)
    {   
        $retorno = NULL;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $res = $conexao->query(DmlSqlFilaQRCodePendenteProduzir::SELECT . ' WHERE ' . DmlSqlFilaQRCodePendenteProduzir::FQPP_DT_UPDATE . '=' . $dataAtualizacao );
        if ($res){
            $retorno = $this->getDTO($res->fetch_assoc());
        }
        return $retorno;
    }

}
?>




