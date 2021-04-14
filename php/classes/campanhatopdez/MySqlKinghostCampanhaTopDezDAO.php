<?php
/**********************************************************
===========================================================

 #####  #     #   ###   ######     #    ######   ##### 
#     # #     #    #    #     #   # #   #     # #     #
#       #     #    #    #     #  #   #  #     # #     #
#       #     #    #    #     # #     # #     # #     #
#       #     #    #    #     # ####### #     # #     #
#     # #     #    #    #     # #     # #     # #     #
 #####   #####    ###   ######  #     # ######   #####
 
===========================================================
CÓDIGO SOFREU ALTERAÇÕES PROFUNDAS, NÃO USE O GERADOR
AUTOMÁTICO PARA SUBSTITUIR O CÓDIGO AQUI EXISTENTE.
TODO O SISTEMA PODE ENTRAR EM COLAPSO.
===========================================================
***********************************************************/ 

/**
* MySqlKinghostCampanhaTopDezDAO - Implementação DAO
*
* Classe de com todos os comandos DML e DDL (se necessário) para apoio 
* a classe MySqlKinghostCampanhaTopDezDAO
* Não é uma camada visível para outros dispositivos, como as camadas de apresentação e aplicação. 
*
*
* Tabela principal de atuação: CAMPANHA_TOPDEZ
*
* Changelog:
*
* 
* @author Julio Cesar Vitorino
* @since 23/08/2019 10:06:20
*
*/
require_once 'CampanhaTopDezDTO.php';
require_once 'CampanhaTopDezDAO.php';
require_once 'DmlSqlCampanhaTopDez.php';

require_once '../variavel/VariavelCache.php';
require_once '../daofactory/DmlSql.php';

class MySqlKinghostCampanhaTopDezDAO implements CampanhaTopDezDAO
{
    private $daofactory;

    function __construct($daofactory)
    {
        $this->daofactory = $daofactory;
    }

/**
* loadMaxPKAtivoCampIdUsuaIdPorStatus() - Carrega um MaxID (pk) para um ${CAMPO} e status
*
* @param $id_campanha
* @param $usuaid
* @param $camp_id
* @param $status
* @return $dto
*/ 

public function loadMaxPKAtivoCampIdUsuaIdPorStatus($usuaid, $camp_id,$status)
{   
    $retorno = 0;
    // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
    $conexao = $this->daofactory->getSession();
    $sql = DmlSqlCampanhaTopDez::SELECT_MAX_PK . ' WHERE ' 
    . DmlSqlCampanhaTopDez::CAMP_ID . " = $camp_id "
    . " AND " . DmlSqlCampanhaTopDez::USUA_ID . " = $usuaid "
    . " AND " . DmlSqlCampanhaTopDez::CATO_IN_STATUS . " = '$status'";

    $res = $conexao->query($sql);
    if ($res){
        $tmp = $res->fetch_assoc();
        $retorno = $tmp['maxid'] == NULL ? 0 : $tmp['maxid'];
    }
    return $retorno;

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
        $sql = DmlSqlCampanhaTopDez::SELECT_MAX_PK . ' WHERE ' 
        . DmlSqlCampanhaTopDez::CAMP_ID . " = $id_campanha "
        . " AND " . DmlSqlCampanhaTopDez::CATO_IN_STATUS . " = '$status'";

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
* listAll() - Lista todos os registros provenientes de CAMPANHA_TOPDEZ sem critério de paginação
*
* @return List<CampanhaTopDezDTO>[]
*/ 
    public function listAll()   {   }

/**
* update() - atualiza apenas um registro com base no dto CampanhaTopDezDTO->id
* @param $daofactory
*
* @return boolean
*/ 
    public function update($dto)
    {   
        $retorno = false;

        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $stmt = $conexao->prepare(DmlSqlCampanhaTopDez::UPD_PK);
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
* delete() - excluir fisicamente um registro com base no dto CampanhaTopDezDTO->id
*
* @return boolean
*/ 
    public function delete($dto)
    {   
        $retorno = false;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $stmt = $conexao->prepare(DmlSqlCampanhaTopDez::DEL_PK);
        $stmt->bind_param(DmlSql::INTEGER_TYPE
                            ,$dto->id);
        if ($stmt->execute())
        {
            $retorno = true;
        }

        return $retorno;
    }


    public function listCampanhaTopDezStatus($status)
    {
        $retorno = array();

        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $res = $conexao->query(DmlSqlCampanhaTopDez::SELECT . 'WHERE `' . DmlSqlCampanhaTopDez::CATO_IN_STATUS . "` = '$status'" );
        if ($res){
            while ($row = $res->fetch_assoc()) {
                array_push($retorno, $this->getDTO($row));
            }
        }
        return $retorno;
    }

/**
* countCampanhaTopDezPorStatus() - contar a quantidade de registros
* sob o contexto da classe CampanhaTopDez com base no status específico. 
*
* Atenção em @see $sql na tabela CAMPANHA_TOPDEZ 
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

    public function countCampanhaTopDezPorStatus($status)
    {   
        $retorno = 0;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $res = $conexao->query(DmlSqlCampanhaTopDez::SQL_COUNT . ' WHERE ' 
        . DmlSqlCampanhaTopDez::CATO_IN_STATUS . " = '$status'"
        );
        if ($res){
            $tmp = $res->fetch_assoc();
            $retorno = $tmp['contador'];
        }
        return $retorno;

    }

/**
* listCampanhaTopDezPorStatus() - Listar um conjunto de registro previamente paginado
* sob o contexto da classe CampanhaTopDez com base no status específico.
*
* Atenção em @see $sql na tabela CAMPANHA_TOPDEZ 
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

    public function listCampanhaTopDezPorStatus($status, $pag, $qtde, $coluna, $ordem)
    {
        $sql = DmlSqlCampanhaTopDez::SELECT 
        . ' WHERE ' . DmlSqlCampanhaTopDez::CATO_IN_STATUS . " = '$status'"
        . ' ORDER BY ' . $coluna . ($ordem == 0 ? " ASC": " DESC");
        return $this->listPagina($sql, $pag, $qtde);
    }

/**
* countCampanhaTopDezPorUsuaIdStatus() - contar a quantidade de registros
* sob o contexto da classe CampanhaTopDez com base no usuário específico. Esse usuário
* é o usuário logado na sessão ou no próprio dispositivo móvel e de acordo com a 
* query em @see $sql na tabela CAMPANHA_TOPDEZ 
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

    public function countCampanhaTopDezPorUsuaIdStatus($usuaid, $status)
    {   
        $retorno = 0;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $res = $conexao->query(DmlSqlCampanhaTopDez::SQL_COUNT . ' WHERE ' 
        . DmlSqlCampanhaTopDez::USUA_ID . " = $usuaid "
        . ' AND ' . DmlSqlCampanhaTopDez::CATO_IN_STATUS . " = '$status'"
        );
        if ($res){
            $tmp = $res->fetch_assoc();
            $retorno = $tmp['contador'];
        }
        return $retorno;

    }

/**
* listCampanhaTopDezPorUsuaIdStatus() - Listar um conjunto de registro previamente paginado
* sob o contexto da classe CampanhaTopDez com base no usuário específico. Esse usuário
* é o usuário logado na sessão ou no próprio dispositivo móvel e de acordo com a 
* query em @see $sql na tabela CAMPANHA_TOPDEZ 
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
    public function listCampanhaTopDezPorUsuaIdStatus($usuaid, $status, $pag, $qtde, $coluna, $ordem)
    {
        $sql = DmlSqlCampanhaTopDez::SELECT 
        . ' WHERE ' . DmlSqlCampanhaTopDez::USUA_ID . " = $usuaid "
        . ' AND ' . DmlSqlCampanhaTopDez::CATO_IN_STATUS . " = '$status'"
        . ' ORDER BY ' . $coluna . ($ordem == 0 ? " ASC": " DESC");
        return $this->listPagina($sql, $pag, $qtde);
    }

/**
* listPagina() - Listar um conjunto de registro previamente paginado
* e de acordo com a query em @see $sql na tabela CAMPANHA_TOPDEZ 
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
* na tabela CAMPANHA_TOPDEZ usando a Primary Key CATO_ID
*
* @param $id
* @return CampanhaTopDezDTO
*/ 
    public function loadPK($id)
    {   
        $retorno = NULL;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $res = $conexao->query(DmlSqlCampanhaTopDez::SELECT . ' WHERE ' . DmlSqlCampanhaTopDez::CATO_ID . '=' . $id );
        if ($res){
            $retorno = $this->getDTO($res->fetch_assoc());
        }
        return $retorno;
    }

/**
* updateIncQtdeParticipacao() - atualizar o campo de incremento utilizando a id como item de busca
* na tabela CAMPANHA_TOPDEZ usando a Primary Key CATO_ID
*
* @param $id
* @return CampanhaTopDezDTO
*/ 
public function updateIncQtdeParticipacao($id)
{   
    $retorno = false;
    // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
    $conexao = $this->daofactory->getSession();
    $stmt = $conexao->prepare(DmlSqlCampanhaTopDez::UPD_INC_CATO_QT_PARTICIPACAO);
    $stmt->bind_param(DmlSql::INTEGER_TYPE 
                        ,$id);
    if ($stmt->execute())
    {
        $retorno = true;
    }

    return $retorno;
}

/**
* updateStatus() - atualizar o campo de STATUS utilizando a id como item de busca
* na tabela CAMPANHA_TOPDEZ usando a Primary Key CATO_ID
*
* @param $id
* @param $status
*
* @return CampanhaTopDezDTO
*/ 
    public function updateStatus($id, $status)
    {   
        $retorno = false;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $stmt = $conexao->prepare(DmlSqlCampanhaTopDez::UPD_STATUS);
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
* insert() - inserir um registro com base no CampanhaTopDezDTO. Alguns atributos dentro do DTO
* serão ignorados caso estejam populados, pois os mesmos possuem constraint de DEFAULT value
* ou campos de AUTO INCREMENTO já previamente definidos no DDL de criação de tabelas do BD.
*
* Atributos da classe CampanhaTopDezDTO sumariamente IGNORADOS por este método MESMO que estejam preenchidos:
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
        $stmt = $conexao->prepare(DmlSqlCampanhaTopDez::INS);
        $stmt->bind_param(DmlSql::INTEGER_TYPE 
                            . DmlSql::INTEGER_TYPE 
                            ,$dto->id_campanha
                            ,$dto->id_usuario
        );
        if ($stmt->execute())
        {
            $retorno = true;
        }

        return $retorno;
    }

    /**
     * getDTO() - Transforma o resultset padrão em CampanhaTopDezDTO
    */
    public function getDTO($resultset)
    {
        //echo var_dump($resultset); // ótimo pra debugar
        $retorno = new CampanhaTopDezDTO();
        $retorno->id = $resultset[DmlSqlCampanhaTopDez::CATO_ID] == NULL ? NULL : (int) $resultset[DmlSqlCampanhaTopDez::CATO_ID];
        $retorno->id_campanha = $resultset[DmlSqlCampanhaTopDez::CAMP_ID] == NULL ? NULL : (int) $resultset[DmlSqlCampanhaTopDez::CAMP_ID];
        $retorno->id_usuario = $resultset[DmlSqlCampanhaTopDez::USUA_ID] == NULL ? NULL : (int) $resultset[DmlSqlCampanhaTopDez::USUA_ID];
        $retorno->qtde = $resultset[DmlSqlCampanhaTopDez::CATO_QT_PARTICIPACAO] == NULL ? NULL : (int) $resultset[DmlSqlCampanhaTopDez::CATO_QT_PARTICIPACAO];
        $retorno->status = $resultset[DmlSqlCampanhaTopDez::CATO_IN_STATUS] == NULL ? NULL : $resultset[DmlSqlCampanhaTopDez::CATO_IN_STATUS];
        $retorno->dataCadastro = Util::MySQLDate_to_DMYHMiS($resultset[DmlSqlCampanhaTopDez::CATO_DT_CADASTRO]);
        $retorno->dataAtualizacao = Util::MySQLDate_to_DMYHMiS($resultset[DmlSqlCampanhaTopDez::CATO_DT_UPDATE]);
        $retorno->statusdesc = VariavelCache::getInstance()->getStatusDesc($retorno->status);
        return $retorno;

    }

    /**
    * updateId_Campanha() - implementação da assinatura em CampanhaTopDezDAO
    */
    public function updateId_Campanha($id, $id_campanha)
    {   
        $retorno = false;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $stmt = $conexao->prepare(DmlSqlCampanhaTopDez::UPD_CAMPANHA_TOPDEZ_CAMP_ID_PK);
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
    * updateId_Usuario() - implementação da assinatura em CampanhaTopDezDAO
    */
    public function updateId_Usuario($id, $id_usuario)
    {   
        $retorno = false;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $stmt = $conexao->prepare(DmlSqlCampanhaTopDez::UPD_CAMPANHA_TOPDEZ_USUA_ID_PK);
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
    * updateQtde() - implementação da assinatura em CampanhaTopDezDAO
    */
    public function updateQtde($id, $qtde)
    {   
        $retorno = false;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $stmt = $conexao->prepare(DmlSqlCampanhaTopDez::UPD_CAMPANHA_TOPDEZ_CATO_QT_PARTICIPACAO_PK);
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
    * loadId_Campanha() - implementação da assinatura em CampanhaTopDezDAO
    */

    public function loadId_Campanha($id_campanha)
    {   
        $retorno = NULL;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $res = $conexao->query(DmlSqlCampanhaTopDez::SELECT . ' WHERE ' . DmlSqlCampanhaTopDez::CAMP_ID . '=' . $id_campanha );
        if ($res){
            $retorno = $this->getDTO($res->fetch_assoc());
        }
        return $retorno;
    }

    /**
    * loadId_Usuario() - implementação da assinatura em CampanhaTopDezDAO
    */

    public function loadId_Usuario($id_usuario)
    {   
        $retorno = NULL;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $res = $conexao->query(DmlSqlCampanhaTopDez::SELECT . ' WHERE ' . DmlSqlCampanhaTopDez::USUA_ID . '=' . $id_usuario );
        if ($res){
            $retorno = $this->getDTO($res->fetch_assoc());
        }
        return $retorno;
    }

    /**
    * loadQtde() - implementação da assinatura em CampanhaTopDezDAO
    */

    public function loadQtde($qtde)
    {   
        $retorno = NULL;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $res = $conexao->query(DmlSqlCampanhaTopDez::SELECT . ' WHERE ' . DmlSqlCampanhaTopDez::CATO_QT_PARTICIPACAO . '=' . $qtde );
        if ($res){
            $retorno = $this->getDTO($res->fetch_assoc());
        }
        return $retorno;
    }


    /**
    * loadStatus() - implementação da assinatura em CampanhaTopDezDAO
    */

    public function loadStatus($status)
    {   
        $retorno = NULL;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $res = $conexao->query(DmlSqlCampanhaTopDez::SELECT . ' WHERE ' . DmlSqlCampanhaTopDez::CATO_IN_STATUS . '=' . $status );
        if ($res){
            $retorno = $this->getDTO($res->fetch_assoc());
        }
        return $retorno;
    }

    /**
    * loadDatacadastro() - implementação da assinatura em CampanhaTopDezDAO
    */

    public function loadDatacadastro($dataCadastro)
    {   
        $retorno = NULL;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $res = $conexao->query(DmlSqlCampanhaTopDez::SELECT . ' WHERE ' . DmlSqlCampanhaTopDez::CATO_DT_CADASTRO . '=' . $dataCadastro );
        if ($res){
            $retorno = $this->getDTO($res->fetch_assoc());
        }
        return $retorno;
    }

    /**
    * loadDataatualizacao() - implementação da assinatura em CampanhaTopDezDAO
    */

    public function loadDataatualizacao($dataAtualizacao)
    {   
        $retorno = NULL;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $res = $conexao->query(DmlSqlCampanhaTopDez::SELECT . ' WHERE ' . DmlSqlCampanhaTopDez::CATO_DT_UPDATE . '=' . $dataAtualizacao );
        if ($res){
            $retorno = $this->getDTO($res->fetch_assoc());
        }
        return $retorno;
    }

}
?>
