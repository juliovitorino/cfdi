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
CÓDIGO SOFREU ALTERAÇÕES DE PROFUNDAS, NÃO USE O GERADOR
AUTOMÁTICO PARA SUBSTITUIR O CÓDIGO AQUI EXISTENTE.
TODO O SISTEMA PODE ENTRAR EM COLAPSO.
===========================================================
***********************************************************/ 

/**
* MySqlKinghostCampanhaCashbackCCDAO - Implementação DAO
*
* Classe de com todos os comandos DML e DDL (se necessário) para apoio 
* a classe MySqlKinghostCampanhaCashbackCCDAO
* Não é uma camada visível para outros dispositivos, como as camadas de apresentação e aplicação. 
*
*
* Tabela principal de atuação: CAMPANHA_CASHBACK_CC
*
* Changelog:
*
* 
* @author Julio Cesar Vitorino
* @since 23/08/2019 10:06:20
*
*/
require_once 'CampanhaCashbackCCDTO.php';
require_once 'CampanhaCashbackCCDAO.php';
require_once 'DmlSqlCampanhaCashbackCC.php';

require_once '../variavel/VariavelCache.php';
require_once '../daofactory/DmlSql.php';
require_once '../mensagem/ConstantesMensagem.php';
require_once '../mensagem/MensagemCache.php';

class MySqlKinghostCampanhaCashbackCCDAO implements CampanhaCashbackCCDAO
{
    private $daofactory;

    function __construct($daofactory)
    {
        $this->daofactory = $daofactory;
    }
/**
* listMovimentoCashbackCCDesdeIdSaldo() - Lista a movimentação do cashback desde o 
* id do saldo informado ou desde o começo se idSaldoUsuarioDonoCC igual a zero.
*
* @param $idSaldoUsuarioDonoCC
* @return CampanhaCashBackCCDTO[]
*/ 
    public function listMovimentoCashbackCCDesdeIdSaldo($idSaldoUsuarioDonoCC, $id_usuario, $id_dono)
    {
        $sql = DmlSqlCampanhaCashbackCC::SELECT 
        . ' WHERE ' . DmlSqlCampanhaCashbackCC::CACC_ID . "  >= $idSaldoUsuarioDonoCC "
        . ' AND ' . DmlSqlCampanhaCashbackCC::USUA_ID . "  = $id_usuario "
        . ' AND ' . DmlSqlCampanhaCashbackCC::USUA_ID_DONO . "  = $id_dono "
        . ' AND ' . DmlSqlCampanhaCashbackCC::CACC_IN_STATUS . "  = 'A'"
        . ' AND ' . DmlSqlCampanhaCashbackCC::CACC_IN_TIPO . " IN('C','D', 'S')"
        . ' ORDER BY ' . DmlSqlCampanhaCashbackCC::CACC_ID . " ASC";
        return $this->listPagina($sql, 1, 1000);
    }

/**
* loadMaxId_CashbackSaldoCCDiasAtras() - Retorna o MAX() do ID
* a partir do id_usuario e id_dono e um número de dias atras
*
* @param $id_usuario
* @param $id_dono
* @param $numdias
* @return int
*/ 
    public function loadMaxId_CashbackSaldoCCDiasAtras($id_usuario, $id_dono, $numdias)
    {    
        $idsaldo = 0;
        $sql =  DmlSqlCampanhaCashbackCC::SQL_MAX 
        . ' WHERE ' . DmlSqlCampanhaCashbackCC::USUA_ID . "= $id_usuario "
        . ' AND ' . DmlSqlCampanhaCashbackCC::USUA_ID_DONO . "= $id_dono "
        . ' AND ' . DmlSqlCampanhaCashbackCC::CACC_IN_TIPO . "= 'S' "
        . ' AND ' . DmlSqlCampanhaCashbackCC::CACC_DT_CADASTRO . " BETWEEN date_sub(CURRENT_TIMESTAMP, INTERVAL $numdias DAY) AND CURRENT_TIMESTAMP";
//var_dump($sql);
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $res = $conexao->query($sql );
        if ($res){
            $row = $res->fetch_assoc();
            $idsaldo = $row['maxid'];
        }
        return $idsaldo == NULL ? 0: $idsaldo;

    }

/**
* listMovimentoCashbackSaldoCC() - Retorna a lista de movimentação da Cashback CC 
* a partir do ID do último saldo calculado para os parametros informados.
*
* @param $id_usuario
* @param $id_usuario_dono
* @param $idSaldo
* @return CampanhaCashbackCCDTO[]
*/ 
    public function sumMovimentoCashbackSaldoCC($id_usuario, $id_usuario_dono, $idSaldo)
    {
        $retorno = array();
        $sql = "SELECT SUM(`CACC_VL_CONSUMO`) as SUM_CONSUMO, SUM(`CACC_VL_RECOMPENSA`) as SUM_RECOMPENSA"
        . " FROM " . DmlSqlCampanhaCashbackCC::TABELA
        . " WHERE " . DmlSqlCampanhaCashbackCC::USUA_ID . " = $id_usuario "
        . " AND " . DmlSqlCampanhaCashbackCC::USUA_ID_DONO . " = $id_usuario_dono "
        . " AND " . DmlSqlCampanhaCashbackCC::CACC_IN_TIPO . " IN ('C','D') "
        . " AND " . DmlSqlCampanhaCashbackCC::CACC_ID . " > $idSaldo "
        . " GROUP BY " . DmlSqlCampanhaCashbackCC::USUA_ID . ", "
        . DmlSqlCampanhaCashbackCC::USUA_ID_DONO;

        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $res = $conexao->query($sql );
        if ($res){
            $row = $res->fetch_assoc();
            array_push($retorno, $row['SUM_CONSUMO']);
            array_push($retorno, $row['SUM_RECOMPENSA']);
        }
        return $retorno;
    }

/**
* listMovimentoCashbackSaldoCC() - Retorna a lista de movimentação da Cashback CC 
* a partir do ID do último saldo calculado para os parametros informados.
*
* @param $id_usuario
* @param $id_usuario_dono
* @param $idSaldo
* @return CampanhaCashbackCCDTO[]
*/ 
    public function listMovimentoCashbackSaldoCC($id_usuario, $id_usuario_dono, $idSaldo)
    {
        $retorno = array();
        $sql = DmlSqlCampanhaCashbackCC::SELECT
        . " WHERE " . DmlSqlCampanhaCashbackCC::USUA_ID . " = $id_usuario "
        . " AND " . DmlSqlCampanhaCashbackCC::USUA_ID_DONO . " = $id_usuario_dono "
        . " AND " . DmlSqlCampanhaCashbackCC::CACC_IN_TIPO . " IN ('C','D') "
        . " AND " . DmlSqlCampanhaCashbackCC::CACC_ID . " > $idSaldo "
        . " ORDER BY " . DmlSqlCampanhaCashbackCC::CACC_ID . " DESC ";
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
* listUsuarioDono() - Retorna uma lista DISTINTA de usuários donos para um determinado usuário final
*
* @param $id_usuario
* @return $lst[]
*/ 
    public function listUsuarioSomenteDono($id_usuario, $id_dono)
    {
        $lst = array();
        $sql = 'SELECT DISTINCT ' . DmlSqlCampanhaCashbackCC::USUA_ID_DONO 
        . ' FROM ' . DmlSqlCampanhaCashbackCC::TABELA
        . ' WHERE ' . DmlSqlCampanhaCashbackCC::USUA_ID . "= $id_usuario "
        . ' AND ' . DmlSqlCampanhaCashbackCC::USUA_ID_DONO . " = $id_dono ";
    //var_dump($id_usuario);

        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $res = $conexao->query($sql );
        if ($res){
            while ($row = $res->fetch_assoc()) {
                $lst[] = $row[DmlSqlCampanhaCashbackCC::USUA_ID_DONO];
            }
        }
        return $lst;

    }


/**
* listUsuarioDono() - Retorna uma lista DISTINTA de usuários donos para um determinado usuário final
*
* @param $id_usuario
* @return $lst[]
*/ 
    public function listUsuarioDono($id_usuario)
    {
        $lst = array();
        $sql = 'SELECT DISTINCT ' . DmlSqlCampanhaCashbackCC::USUA_ID_DONO 
        . ' FROM ' . DmlSqlCampanhaCashbackCC::TABELA
        . ' WHERE ' . DmlSqlCampanhaCashbackCC::USUA_ID . "= $id_usuario "
        . ' AND ' . DmlSqlCampanhaCashbackCC::USUA_ID_DONO . " IS NOT NULL ";
//var_dump($id_usuario);

        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $res = $conexao->query($sql );
        if ($res){
            while ($row = $res->fetch_assoc()) {
                $lst[] = $row[DmlSqlCampanhaCashbackCC::USUA_ID_DONO];
            }
        }
        return $lst;

    }

/**
* loadId_CashbackSaldoCC() - Localiza o saldo mais recente do cashback (Só pode retonar o MAX())
*
* @param $id_usuario
* @param $id_usuario_dono
* @return $dto
*/ 
    public function loadId_CashbackSaldoCC($id_usuario, $id_usuario_dono)    
    {    
        $idsaldo = 0;
        $sql = 'SELECT MAX(' . DmlSqlCampanhaCashbackCC::CACC_ID . ') AS MaiorId ' 
        . ' FROM ' . DmlSqlCampanhaCashbackCC::TABELA
        . ' WHERE ' . DmlSqlCampanhaCashbackCC::USUA_ID . "= $id_usuario "
        . ' AND ' . DmlSqlCampanhaCashbackCC::USUA_ID_DONO . "= $id_usuario_dono "
        . ' AND ' . DmlSqlCampanhaCashbackCC::CACC_IN_TIPO . "= 'S' ";

        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $res = $conexao->query($sql );
        if ($res){
            $row = $res->fetch_assoc();
            $idsaldo = $row['MaiorId'];
        }
        return $idsaldo;

    }

/**
* load() - Carrega apenas um registro com base no campo id do DTO = (TIPO_EMPREENDIMENTO::TIEM_ID)
*
* @param $dto
* @return $dto
*/ 
    public function load($dto)  {   }

/**
* listAll() - Lista todos os registros provenientes de CAMPANHA_CASHBACK_CC sem critério de paginação
*
* @return List<CampanhaCashbackCCDTO>[]
*/ 
    public function listAll()   {   }
    
/**
* update() - atualiza apenas um registro com base no dto CampanhaCashbackCCDTO->id
* @param $daofactory
*
* @return boolean
*/ 
    public function update($dto)
    {   
        $retorno = false;

        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $stmt = $conexao->prepare(DmlSqlCampanhaCashbackCC::UPD_PK);
        $stmt->bind_param(DmlSql::INTEGER_TYPE 
                            . DmlSql::INTEGER_TYPE 
                            . DmlSql::INTEGER_TYPE 
                            . DmlSql::INTEGER_TYPE 
                            . DmlSql::INTEGER_TYPE 
                            . DmlSql::STRING_TYPE 
                            . DmlSql::DOUBLE_TYPE 
                            . DmlSql::DOUBLE_TYPE 
                            . DmlSql::DOUBLE_TYPE 
                            . DmlSql::DOUBLE_TYPE 
                            . DmlSql::STRING_TYPE 
                            . DmlSql::STRING_TYPE 
                            . DmlSql::STRING_TYPE 
                            . DmlSql::INTEGER_TYPE 
                            ,$dto->id_cashback
                            ,$dto->id_campanha
                            ,$dto->id_usuario
                            ,$dto->id_dono
                            ,$dto->id_cfdi
                            ,$dto->descricao
                            ,$dto->vlMinimo
                            ,$dto->percentual
                            ,$dto->vlConsumo
                            ,$dto->vlCalcRecompensa
                            ,$dto->tipoMovimento
                            ,$dto->nfe
                            ,$dto->nfehash
                            ,$dto->id );
        if ($stmt->execute())
        {
            $retorno = true;
        }

        return $retorno;
    }

/**
* delete() - excluir fisicamente um registro com base no dto CampanhaCashbackCCDTO->id
*
* @return boolean
*/ 
    public function delete($dto)
    {   
        $retorno = false;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $stmt = $conexao->prepare(DmlSqlCampanhaCashbackCC::DEL_PK);
        $stmt->bind_param(DmlSql::INTEGER_TYPE
                            ,$dto->id);
        if ($stmt->execute())
        {
            $retorno = true;
        }

        return $retorno;
    }


    public function listCampanhaCashbackCCStatus($status)
    {
        $retorno = array();

        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $res = $conexao->query(DmlSqlCampanhaCashbackCC::SELECT . 'WHERE `' . DmlSqlCampanhaCashbackCC::CACC_IN_STATUS . "` = '$status'" );
        if ($res){
            while ($row = $res->fetch_assoc()) {
                array_push($retorno, $this->getDTO($row));
            }
        }
        return $retorno;
    }

/**
* countCampanhaCashbackCCPorStatus() - contar a quantidade de registros
* sob o contexto da classe CampanhaCashbackCC com base no status específico. 
*
* Atenção em @see $sql na tabela CAMPANHA_CASHBACK_CC 
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

    public function countCampanhaCashbackCCPorStatus($status)
    {   
        $retorno = 0;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $res = $conexao->query(DmlSqlCampanhaCashbackCC::SQL_COUNT . ' WHERE ' 
        . DmlSqlCampanhaCashbackCC::CACC_IN_STATUS . " = '$status'"
        );
        if ($res){
            $tmp = $res->fetch_assoc();
            $retorno = $tmp['contador'];
        }
        return $retorno;

    }

/**
* listCampanhaCashbackCCPorStatus() - Listar um conjunto de registro previamente paginado
* sob o contexto da classe CampanhaCashbackCC com base no status específico.
*
* Atenção em @see $sql na tabela CAMPANHA_CASHBACK_CC 
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

    public function listCampanhaCashbackCCPorStatus($status, $pag, $qtde, $coluna, $ordem)
    {
        $sql = DmlSqlCampanhaCashbackCC::SELECT 
        . ' WHERE ' . DmlSqlCampanhaCashbackCC::CACC_IN_STATUS . "  = '$status'"
        . ' ORDER BY ' . $coluna . ($ordem == 0 ? " ASC": " DESC");
        return $this->listPagina($sql, $pag, $qtde);
    }

/**
* countCampanhaCashbackCCPorUsuaIdStatus() - contar a quantidade de registros
* sob o contexto da classe CampanhaCashbackCC com base no usuário específico. Esse usuário
* é o usuário logado na sessão ou no próprio dispositivo móvel e de acordo com a 
* query em @see $sql na tabela CAMPANHA_CASHBACK_CC 
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

    public function countCampanhaCashbackCCPorUsuaIdStatus($usuaid, $status)
    {   
        $retorno = 0;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $res = $conexao->query(DmlSqlCampanhaCashbackCC::SQL_COUNT . ' WHERE ' 
        . DmlSqlCampanhaCashbackCC::USUA_ID . " = $usuaid "
        . ' AND ' . DmlSqlCampanhaCashbackCC::CACC_IN_STATUS . " = '$status'"
        );
        if ($res){
            $tmp = $res->fetch_assoc();
            $retorno = $tmp['contador'];
        }
        return $retorno;

    }

/**
* listCampanhaCashbackCCPorUsuaIdStatus() - Listar um conjunto de registro previamente paginado
* sob o contexto da classe CampanhaCashbackCC com base no usuário específico. Esse usuário
* é o usuário logado na sessão ou no próprio dispositivo móvel e de acordo com a 
* query em @see $sql na tabela CAMPANHA_CASHBACK_CC 
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
    public function listCampanhaCashbackCCPorUsuaIdStatus($usuaid, $status, $pag, $qtde, $coluna, $ordem)
    {
        $sql = DmlSqlCampanhaCashbackCC::SELECT 
        . ' WHERE ' . DmlSqlCampanhaCashbackCC::USUA_ID . " = $usuaid "
        . ' AND ' . DmlSqlCampanhaCashbackCC::CACC_IN_STATUS . " = '$status'"
        . ' ORDER BY ' . $coluna . ($ordem == 0 ? " ASC": " DESC");
        return $this->listPagina($sql, $pag, $qtde);
    }

/**
* listPagina() - Listar um conjunto de registro previamente paginado
* e de acordo com a query em @see $sql na tabela CAMPANHA_CASHBACK_CC 
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
* na tabela CAMPANHA_CASHBACK_CC usando a Primary Key CACC_ID
*
* @param $id
* @return CampanhaCashbackCCDTO
*/ 
    public function loadPK($id)
    {   
        $retorno = NULL;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $res = $conexao->query(DmlSqlCampanhaCashbackCC::SELECT . ' WHERE ' . DmlSqlCampanhaCashbackCC::CACC_ID . '=' . $id );
        if ($res){
            $retorno = $this->getDTO($res->fetch_assoc());
        }
        return $retorno;
    }

/**
* updateStatus() - atualizar o campo de STATUS utilizando a id como item de busca
* na tabela CAMPANHA_CASHBACK_CC usando a Primary Key CACC_ID
*
* @param $id
* @param $status
*
* @return CampanhaCashbackCCDTO
*/ 
    public function updateStatus($id, $status)
    {   
        $retorno = false;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $stmt = $conexao->prepare(DmlSqlCampanhaCashbackCC::UPD_STATUS);
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
* insertMovimentoCC() - inserir um registro customizado com base no CampanhaCashbackCCDTO. Alguns atributos dentro do DTO
* serão ignorados caso estejam populados, pois os mesmos possuem constraint de DEFAULT value
* ou campos de AUTO INCREMENTO já previamente definidos no DDL de criação de tabelas do BD.
*
* @param $movcc - CampanhaCashbackCCDTO
* @return boolean
*/ 
public function insertMovimentoCC($movcc)
{   
    $retorno = false;
    // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
    $conexao = $this->daofactory->getSession();
    $stmt = $conexao->prepare(DmlSqlCampanhaCashbackCC::INS_MOVCC);
    $stmt->bind_param(DmlSql::INTEGER_TYPE 
                        . DmlSql::INTEGER_TYPE
                        . DmlSql::STRING_TYPE 
                        . DmlSql::DOUBLE_TYPE 
                        . DmlSql::DOUBLE_TYPE 
                        . DmlSql::STRING_TYPE 
                        ,$movcc->id_usuario
                        ,$movcc->id_dono
                        ,$movcc->descricao
                        ,$movcc->vlConsumo
                        ,$movcc->vlCalcRecompensa
                        ,$movcc->tipoMovimento
    );
    if ($stmt->execute())
    {
        $retorno = true;
    } else {
        //var_dump(mysqli_error($conexao));
    }

    return $retorno;
}

/**
* insert() - inserir um registro com base no CampanhaCashbackCCDTO. Alguns atributos dentro do DTO
* serão ignorados caso estejam populados, pois os mesmos possuem constraint de DEFAULT value
* ou campos de AUTO INCREMENTO já previamente definidos no DDL de criação de tabelas do BD.
*
* Atributos da classe CampanhaCashbackCCDTO sumariamente IGNORADOS por este método MESMO que estejam preenchidos:
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
        $stmt = $conexao->prepare(DmlSqlCampanhaCashbackCC::INS);
        $stmt->bind_param(DmlSql::INTEGER_TYPE 
                            . DmlSql::INTEGER_TYPE 
                            . DmlSql::INTEGER_TYPE 
                            . DmlSql::INTEGER_TYPE 
                            . DmlSql::INTEGER_TYPE 
                            . DmlSql::STRING_TYPE 
//                            . DmlSql::DOUBLE_TYPE 
                            . DmlSql::DOUBLE_TYPE 
                            . DmlSql::DOUBLE_TYPE 
                            . DmlSql::DOUBLE_TYPE 
                            . DmlSql::STRING_TYPE 
                            . DmlSql::STRING_TYPE 
                            . DmlSql::STRING_TYPE 
                            ,$dto->id_cashback
                            ,$dto->id_campanha
                            ,$dto->id_usuario
                            ,$dto->id_dono
                            ,$dto->id_cfdi
                            ,$dto->descricao
//                            ,$dto->vlMinimo
                            ,$dto->percentual
                            ,$dto->vlConsumo
                            ,$dto->vlCalcRecompensa
                            ,$dto->tipoMovimento
                            ,$dto->nfe
                            ,$dto->nfehash
        );
        if ($stmt->execute())
        {
            $retorno = true;
        }

        return $retorno;
    }

    /**
     * getDTO() - Transforma o resultset padrão em CampanhaCashbackCCDTO
    */
    public function getDTO($resultset)
    {
        //echo var_dump($resultset); // ótimo pra debugar
        $retorno = new CampanhaCashbackCCDTO();
        $retorno->id = $resultset[DmlSqlCampanhaCashbackCC::CACC_ID] == NULL ? NULL : (int) $resultset[DmlSqlCampanhaCashbackCC::CACC_ID];
        $retorno->id_cashback = $resultset[DmlSqlCampanhaCashbackCC::CACA_ID] == NULL ? NULL : (int) $resultset[DmlSqlCampanhaCashbackCC::CACA_ID];
        $retorno->id_campanha = $resultset[DmlSqlCampanhaCashbackCC::CAMP_ID] == NULL ? NULL : (int) $resultset[DmlSqlCampanhaCashbackCC::CAMP_ID];
        $retorno->id_usuario = $resultset[DmlSqlCampanhaCashbackCC::USUA_ID] == NULL ? NULL : (int) $resultset[DmlSqlCampanhaCashbackCC::USUA_ID];
        $retorno->id_dono = $resultset[DmlSqlCampanhaCashbackCC::USUA_ID] == NULL ? NULL : (int) $resultset[DmlSqlCampanhaCashbackCC::USUA_ID_DONO];
        $retorno->id_cfdi = $resultset[DmlSqlCampanhaCashbackCC::CFDI_ID] == NULL ? NULL : (int) $resultset[DmlSqlCampanhaCashbackCC::CFDI_ID];
        $retorno->descricao = $resultset[DmlSqlCampanhaCashbackCC::CACC_TX_DESCRICAO] == NULL ? NULL : $resultset[DmlSqlCampanhaCashbackCC::CACC_TX_DESCRICAO];
        //$retorno->vlMinimo = $resultset[DmlSqlCampanhaCashbackCC::CACC_VL_MIN] == NULL ? NULL : (double) $resultset[DmlSqlCampanhaCashbackCC::CACC_VL_MIN];
        $retorno->percentual = $resultset[DmlSqlCampanhaCashbackCC::CACC_VL_PERC_CASHBACK] == NULL ? NULL : (double) $resultset[DmlSqlCampanhaCashbackCC::CACC_VL_PERC_CASHBACK];
        $retorno->vlConsumo = $resultset[DmlSqlCampanhaCashbackCC::CACC_VL_CONSUMO] == NULL ? NULL : (double) $resultset[DmlSqlCampanhaCashbackCC::CACC_VL_CONSUMO];
        $retorno->vlCalcRecompensa = $resultset[DmlSqlCampanhaCashbackCC::CACC_VL_RECOMPENSA] == NULL ? NULL : (double) $resultset[DmlSqlCampanhaCashbackCC::CACC_VL_RECOMPENSA];
        //$retorno->vlMinimoMoeda = $resultset[DmlSqlCampanhaCashbackCC::CACC_VL_MIN] == NULL ? NULL : Util::getMoeda((double) $resultset[DmlSqlCampanhaCashbackCC::CACC_VL_MIN]);
        $retorno->percentualFmt = $resultset[DmlSqlCampanhaCashbackCC::CACC_VL_PERC_CASHBACK] == NULL ? NULL : Util::getFmtNum((double) $resultset[DmlSqlCampanhaCashbackCC::CACC_VL_PERC_CASHBACK]);
        $retorno->vlConsumoMoeda = $resultset[DmlSqlCampanhaCashbackCC::CACC_VL_CONSUMO] == NULL ? NULL : Util::getMoeda((double) $resultset[DmlSqlCampanhaCashbackCC::CACC_VL_CONSUMO]);
        $retorno->vlCalcRecompensaMoeda = $resultset[DmlSqlCampanhaCashbackCC::CACC_VL_RECOMPENSA] == NULL ? NULL : Util::getMoeda((double) $resultset[DmlSqlCampanhaCashbackCC::CACC_VL_RECOMPENSA]);
        $retorno->tipoMovimento = $resultset[DmlSqlCampanhaCashbackCC::CACC_IN_TIPO] == NULL ? NULL : $resultset[DmlSqlCampanhaCashbackCC::CACC_IN_TIPO];
        $retorno->nfe = $resultset[DmlSqlCampanhaCashbackCC::CACC_TX_NFE] == NULL ? NULL : $resultset[DmlSqlCampanhaCashbackCC::CACC_TX_NFE];
        $retorno->nfehash = $resultset[DmlSqlCampanhaCashbackCC::CACC_TX_NFE_HASH] == NULL ? NULL : $resultset[DmlSqlCampanhaCashbackCC::CACC_TX_NFE_HASH];
        $retorno->status = $resultset[DmlSqlCampanhaCashbackCC::CACC_IN_STATUS] == NULL ? NULL : $resultset[DmlSqlCampanhaCashbackCC::CACC_IN_STATUS];
        $retorno->dataCadastro = Util::MySQLDate_to_DMYHMiS($resultset[DmlSqlCampanhaCashbackCC::CACC_DT_CADASTRO]);
        $retorno->dataAtualizacao = Util::MySQLDate_to_DMYHMiS($resultset[DmlSqlCampanhaCashbackCC::CACC_DT_UPDATE]);
        $retorno->statusdesc = VariavelCache::getInstance()->getStatusDesc($retorno->status);
        $retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
        $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);
        
        return $retorno;

    }

    /**
    * updateId_Cashback() - implementação da assinatura em CampanhaCashbackCCDAO
    */
    public function updateId_Cashback($id, $id_cashback)
    {   
        $retorno = false;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $stmt = $conexao->prepare(DmlSqlCampanhaCashbackCC::UPD_CAMPANHA_CASHBACK_CC_CACA_ID_PK);
        $stmt->bind_param(DmlSql::INTEGER_TYPE 
                            . DmlSql::INTEGER_TYPE
                            ,$id_cashback
                            ,$id);
        if ($stmt->execute())
        {
            $retorno = true;
        }

        return $retorno;
    }

    /**
    * updateId_Campanha() - implementação da assinatura em CampanhaCashbackCCDAO
    */
    public function updateId_Campanha($id, $id_campanha)
    {   
        $retorno = false;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $stmt = $conexao->prepare(DmlSqlCampanhaCashbackCC::UPD_CAMPANHA_CASHBACK_CC_CAMP_ID_PK);
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
    * updateId_Usuario() - implementação da assinatura em CampanhaCashbackCCDAO
    */
    public function updateId_Usuario($id, $id_usuario)
    {   
        $retorno = false;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $stmt = $conexao->prepare(DmlSqlCampanhaCashbackCC::UPD_CAMPANHA_CASHBACK_CC_USUA_ID_PK);
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
    * updateId_Cfdi() - implementação da assinatura em CampanhaCashbackCCDAO
    */
    public function updateId_Cfdi($id, $id_cfdi)
    {   
        $retorno = false;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $stmt = $conexao->prepare(DmlSqlCampanhaCashbackCC::UPD_CAMPANHA_CASHBACK_CC_CFDI_ID_PK);
        $stmt->bind_param(DmlSql::INTEGER_TYPE 
                            . DmlSql::INTEGER_TYPE
                            ,$id_cfdi
                            ,$id);
        if ($stmt->execute())
        {
            $retorno = true;
        }

        return $retorno;
    }

    /**
    * updateDescricao() - implementação da assinatura em CampanhaCashbackCCDAO
    */
    public function updateDescricao($id, $descricao)
    {   
        $retorno = false;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $stmt = $conexao->prepare(DmlSqlCampanhaCashbackCC::UPD_CAMPANHA_CASHBACK_CC_CACC_TX_DESCRICAO_PK);
        $stmt->bind_param(DmlSql::STRING_TYPE 
                            . DmlSql::STRING_TYPE
                            ,$descricao
                            ,$id);
        if ($stmt->execute())
        {
            $retorno = true;
        }

        return $retorno;
    }

    /**
    * updateVlminimo() - implementação da assinatura em CampanhaCashbackCCDAO
    */
    public function updateVlminimo($id, $vlMinimo)
    {   
        $retorno = false;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $stmt = $conexao->prepare(DmlSqlCampanhaCashbackCC::UPD_CAMPANHA_CASHBACK_CC_CACC_VL_MIN_PK);
        $stmt->bind_param(DmlSql::DOUBLE_TYPE 
                            . DmlSql::DOUBLE_TYPE
                            ,$vlMinimo
                            ,$id);
        if ($stmt->execute())
        {
            $retorno = true;
        }

        return $retorno;
    }

    /**
    * updatePercentual() - implementação da assinatura em CampanhaCashbackCCDAO
    */
    public function updatePercentual($id, $percentual)
    {   
        $retorno = false;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $stmt = $conexao->prepare(DmlSqlCampanhaCashbackCC::UPD_CAMPANHA_CASHBACK_CC_CACC_VL_PERC_CASHBACK_PK);
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
    * updateVlconsumo() - implementação da assinatura em CampanhaCashbackCCDAO
    */
    public function updateVlconsumo($id, $vlConsumo)
    {   
        $retorno = false;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $stmt = $conexao->prepare(DmlSqlCampanhaCashbackCC::UPD_CAMPANHA_CASHBACK_CC_CACC_VL_CONSUMO_PK);
        $stmt->bind_param(DmlSql::DOUBLE_TYPE 
                            . DmlSql::DOUBLE_TYPE
                            ,$vlConsumo
                            ,$id);
        if ($stmt->execute())
        {
            $retorno = true;
        }

        return $retorno;
    }

    /**
    * updateVlcalcrecompensa() - implementação da assinatura em CampanhaCashbackCCDAO
    */
    public function updateVlcalcrecompensa($id, $vlCalcRecompensa)
    {   
        $retorno = false;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $stmt = $conexao->prepare(DmlSqlCampanhaCashbackCC::UPD_CAMPANHA_CASHBACK_CC_CACC_VL_RECOMPENSA_PK);
        $stmt->bind_param(DmlSql::DOUBLE_TYPE 
                            . DmlSql::DOUBLE_TYPE
                            ,$vlCalcRecompensa
                            ,$id);
        if ($stmt->execute())
        {
            $retorno = true;
        }

        return $retorno;
    }

    /**
    * updateTipomovimento() - implementação da assinatura em CampanhaCashbackCCDAO
    */
    public function updateTipomovimento($id, $tipoMovimento)
    {   
        $retorno = false;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $stmt = $conexao->prepare(DmlSqlCampanhaCashbackCC::UPD_CAMPANHA_CASHBACK_CC_CACC_IN_TIPO_PK);
        $stmt->bind_param(DmlSql::STRING_TYPE 
                            . DmlSql::STRING_TYPE
                            ,$tipoMovimento
                            ,$id);
        if ($stmt->execute())
        {
            $retorno = true;
        }

        return $retorno;
    }


    /**
    * loadId_Cashback() - implementação da assinatura em CampanhaCashbackCCDAO
    */

    public function loadId_Cashback($id_cashback)
    {   
        $retorno = NULL;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $res = $conexao->query(DmlSqlCampanhaCashbackCC::SELECT . ' WHERE ' . DmlSqlCampanhaCashbackCC::CACA_ID . '=' . $id_cashback );
        if ($res){
            $retorno = $this->getDTO($res->fetch_assoc());
        }
        return $retorno;
    }

    /**
    * loadId_Campanha() - implementação da assinatura em CampanhaCashbackCCDAO
    */

    public function loadId_Campanha($id_campanha)
    {   
        $retorno = NULL;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $res = $conexao->query(DmlSqlCampanhaCashbackCC::SELECT . ' WHERE ' . DmlSqlCampanhaCashbackCC::CAMP_ID . '=' . $id_campanha );
        if ($res){
            $retorno = $this->getDTO($res->fetch_assoc());
        }
        return $retorno;
    }

    /**
    * loadId_Usuario() - implementação da assinatura em CampanhaCashbackCCDAO
    */

    public function loadId_Usuario($id_usuario)
    {   
        $retorno = NULL;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $res = $conexao->query(DmlSqlCampanhaCashbackCC::SELECT . ' WHERE ' . DmlSqlCampanhaCashbackCC::USUA_ID . '=' . $id_usuario );
        if ($res){
            $retorno = $this->getDTO($res->fetch_assoc());
        }
        return $retorno;
    }

    /**
    * loadId_Cfdi() - implementação da assinatura em CampanhaCashbackCCDAO
    */

    public function loadId_Cfdi($id_cfdi)
    {   
        $retorno = NULL;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $res = $conexao->query(DmlSqlCampanhaCashbackCC::SELECT . ' WHERE ' . DmlSqlCampanhaCashbackCC::CFDI_ID . '=' . $id_cfdi );
        if ($res){
            $retorno = $this->getDTO($res->fetch_assoc());
        }
        return $retorno;
    }

    /**
    * loadDescricao() - implementação da assinatura em CampanhaCashbackCCDAO
    */

    public function loadDescricao($descricao)
    {   
        $retorno = NULL;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $res = $conexao->query(DmlSqlCampanhaCashbackCC::SELECT . ' WHERE ' . DmlSqlCampanhaCashbackCC::CACC_TX_DESCRICAO . '=' . $descricao );
        if ($res){
            $retorno = $this->getDTO($res->fetch_assoc());
        }
        return $retorno;
    }

    /**
    * loadVlminimo() - implementação da assinatura em CampanhaCashbackCCDAO
    */

    public function loadVlminimo($vlMinimo)
    {   
        $retorno = NULL;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $res = $conexao->query(DmlSqlCampanhaCashbackCC::SELECT . ' WHERE ' . DmlSqlCampanhaCashbackCC::CACC_VL_MIN . '=' . $vlMinimo );
        if ($res){
            $retorno = $this->getDTO($res->fetch_assoc());
        }
        return $retorno;
    }

    /**
    * loadPercentual() - implementação da assinatura em CampanhaCashbackCCDAO
    */

    public function loadPercentual($percentual)
    {   
        $retorno = NULL;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $res = $conexao->query(DmlSqlCampanhaCashbackCC::SELECT . ' WHERE ' . DmlSqlCampanhaCashbackCC::CACC_VL_PERC_CASHBACK . '=' . $percentual );
        if ($res){
            $retorno = $this->getDTO($res->fetch_assoc());
        }
        return $retorno;
    }

    /**
    * loadVlconsumo() - implementação da assinatura em CampanhaCashbackCCDAO
    */

    public function loadVlconsumo($vlConsumo)
    {   
        $retorno = NULL;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $res = $conexao->query(DmlSqlCampanhaCashbackCC::SELECT . ' WHERE ' . DmlSqlCampanhaCashbackCC::CACC_VL_CONSUMO . '=' . $vlConsumo );
        if ($res){
            $retorno = $this->getDTO($res->fetch_assoc());
        }
        return $retorno;
    }

    /**
    * loadVlcalcrecompensa() - implementação da assinatura em CampanhaCashbackCCDAO
    */

    public function loadVlcalcrecompensa($vlCalcRecompensa)
    {   
        $retorno = NULL;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $res = $conexao->query(DmlSqlCampanhaCashbackCC::SELECT . ' WHERE ' . DmlSqlCampanhaCashbackCC::CACC_VL_RECOMPENSA . '=' . $vlCalcRecompensa );
        if ($res){
            $retorno = $this->getDTO($res->fetch_assoc());
        }
        return $retorno;
    }

    /**
    * loadTipomovimento() - implementação da assinatura em CampanhaCashbackCCDAO
    */

    public function loadTipomovimento($tipoMovimento)
    {   
        $retorno = NULL;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $res = $conexao->query(DmlSqlCampanhaCashbackCC::SELECT . ' WHERE ' . DmlSqlCampanhaCashbackCC::CACC_IN_TIPO . '=' . $tipoMovimento );
        if ($res){
            $retorno = $this->getDTO($res->fetch_assoc());
        }
        return $retorno;
    }

    /**
    * loadNfe() - implementação da assinatura em CampanhaCashbackCCDAO
    */

    public function loadNfe($nfe)
    {   
        $retorno = NULL;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $res = $conexao->query(DmlSqlCampanhaCashbackCC::SELECT . ' WHERE ' . DmlSqlCampanhaCashbackCC::CACC_TX_NFE . '=' . $nfe );
        if ($res){
            $retorno = $this->getDTO($res->fetch_assoc());
        }
        return $retorno;
    }

    /**
    * loadNfehash() - implementação da assinatura em CampanhaCashbackCCDAO
    */

    public function loadNfehash($nfehash)
    {   
        $retorno = NULL;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $res = $conexao->query(DmlSqlCampanhaCashbackCC::SELECT . ' WHERE ' . DmlSqlCampanhaCashbackCC::CACC_TX_NFE_HASH . '=' . $nfehash );
        if ($res){
            $retorno = $this->getDTO($res->fetch_assoc());
        }
        return $retorno;
    }


}
?>
