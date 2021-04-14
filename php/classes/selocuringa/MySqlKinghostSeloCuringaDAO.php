<?php

/**
* MySqlKinghostSeloCuringaDAO - Implementação DAO
*
* Classe de com todos os comandos DML e DDL (se necessário) para apoio 
* a classe MySqlKinghostSeloCuringaDAO
* Não é uma camada visível para outros dispositivos, como as camadas de apresentação e aplicação. 
*
*
* Tabela principal de atuação: QRCODES_CURINGA
*
* Changelog:
*
* 
* @author Julio Cesar Vitorino
* @since 23/08/2019 10:06:20
*
*/
require_once 'seloCuringaDTO.php';
require_once 'seloCuringaDAO.php';
require_once 'DmlSqlSeloCuringa.php';

require_once '../variavel/VariavelCache.php';
require_once '../daofactory/DmlSql.php';

class MySqlKinghostSeloCuringaDAO implements SeloCuringaDAO
{
    private $daofactory;

    function __construct($daofactory)
    {
        $this->daofactory = $daofactory;
    }

/**
* load() - Carrega apenas um registro com base no campo id do DTO = (TIPO_EMPREENDIMENTO::TIEM_ID)
*
* @param $dto
* @return $dto
*/ 
    public function load($dto)  {   }

/**
* listAll() - Lista todos os registros provenientes de QRCODES_CURINGA sem critério de paginação
*
* @return List<SeloCuringaDTO>[]
*/     
    public function listAll()   {   }

/**
* update() - atualiza apenas um registro com base no dto SeloCuringaDTO->id
* @param $daofactory
*
* @return boolean
*/ 
    public function update($dto)
    {   
        $retorno = false;

        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $stmt = $conexao->prepare(DmlSqlSeloCuringa::UPD_PK);
        $stmt->bind_param(DmlSql::INTEGER_TYPE 
                            . DmlSql::INTEGER_TYPE 
                            . DmlSql::INTEGER_TYPE 
                            . DmlSql::INTEGER_TYPE 
                            . DmlSql::STRING_TYPE 
                            . DmlSql::INTEGER_TYPE 
                            ,$dto->id_usuario
                            ,$dto->id_campanha
                            ,$dto->id_cartao
                            ,$dto->id_autorizador
                            ,$dto->qrcode
                            ,$dto->id );
        if ($stmt->execute())
        {
            $retorno = true;
        }

        return $retorno;
    }
/**
* delete() - excluir fisicamente um registro com base no dto SeloCuringaDTO->id
*
* @return boolean
*/ 
    public function delete($dto)
    {   
        $retorno = false;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $stmt = $conexao->prepare(DmlSqlSeloCuringa::DEL_PK);
        $stmt->bind_param(DmlSql::INTEGER_TYPE
                            ,$dto->id);
        if ($stmt->execute())
        {
            $retorno = true;
        }

        return $retorno;
    }


    public function listSeloCuringaStatus($status)
    {
        $retorno = array();

        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $res = $conexao->query(DmlSqlSeloCuringa::SELECT . 'WHERE `' . DmlSqlSeloCuringa::QRCU_IN_STATUS . "` = '$status'" );
        if ($res){
            while ($row = $res->fetch_assoc()) {
                array_push($retorno, $this->getDTO($row));
            }
        }
        return $retorno;
    }

    public function countSeloCuringaPorStatus($status)
    {   
        $retorno = 0;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $res = $conexao->query(DmlSqlSeloCuringa::SQL_COUNT . ' WHERE ' 
        . DmlSqlSeloCuringa::QRCU_IN_STATUS . " = '$status'"
        );
        if ($res){
            $tmp = $res->fetch_assoc();
            $retorno = $tmp['contador'];
        }
        return $retorno;

    }

    public function listSeloCuringaPorStatus($status, $pag, $qtde, $coluna, $ordem)
    {
        $sql = DmlSqlSeloCuringa::SELECT 
        . ' WHERE ' . DmlSqlSeloCuringa::QRCU_IN_STATUS . " = '$status'"
        . ' ORDER BY ' . $coluna . ($ordem == 0 ? " ASC": " DESC");
        return $this->listPagina($sql, $pag, $qtde);
    }


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
* na tabela QRCODES_CURINGA usando a Primary Key QRCU_ID
*
* @param $id
* @return SeloCuringaDTO
*/ 

    public function loadPK($id)
    {   
        $retorno = NULL;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $res = $conexao->query(DmlSqlSeloCuringa::SELECT . ' WHERE ' . DmlSqlSeloCuringa::QRCU_ID . '=' . $id );
        if ($res){
            $retorno = $this->getDTO($res->fetch_assoc());
        }
        return $retorno;
    }

/**
* updateStatus() - atualizar o campo de STATUS utilizando a id como item de busca
* na tabela QRCODES_CURINGA usando a Primary Key QRCU_ID
*
* @param $id
* @param $status
*
* @return SeloCuringaDTO
*/ 

    public function updateStatus($id, $status)
    {   
        $retorno = false;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $stmt = $conexao->prepare(DmlSqlSeloCuringa::UPD_STATUS);
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
* insert() - inserir um registro com base no SeloCuringaDTO. Alguns atributos dentro do DTO
* serão ignorados caso estejam populados, pois os mesmos possuem constraint de DEFAULT value
* ou campos de AUTO INCREMENTO já previamente definidos no DDL de criação de tabelas do BD.
*
* Atributos da classe SeloCuringaDTO sumariamente IGNORADOS por este método MESMO que estejam preenchidos:
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
        $stmt = $conexao->prepare(DmlSqlSeloCuringa::INS);
        $stmt->bind_param(DmlSql::INTEGER_TYPE 
                            . DmlSql::INTEGER_TYPE 
                            . DmlSql::INTEGER_TYPE 
                            . DmlSql::INTEGER_TYPE 
                            . DmlSql::STRING_TYPE 
                            ,$dto->id_usuario
                            ,$dto->id_campanha
                            ,$dto->id_cartao
                            ,$dto->id_autorizador
                            ,$dto->qrcode
        );
        if ($stmt->execute())
        {
            $retorno = true;
        }

        return $retorno;
    }

    /**
     * getDTO() - Transforma o resultset padrão em SeloCuringaDTO
    */
    public function getDTO($resultset)
    {
        //echo var_dump($resultset); // ótimo pra debugar
        $retorno = new SeloCuringaDTO();
        $retorno->id = (int) $resultset[DmlSqlSeloCuringa::QRCU_ID];
        $retorno->id_usuario = (int) $resultset[DmlSqlSeloCuringa::USUA_ID];
        $retorno->id_campanha = (int) $resultset[DmlSqlSeloCuringa::CAMP_ID];
        $retorno->id_cartao = (int) $resultset[DmlSqlSeloCuringa::CART_ID];
        $retorno->id_autorizador = (int) $resultset[DmlSqlSeloCuringa::USUA_AUTORIZACAO_ID];
        $retorno->qrcode = $resultset[DmlSqlSeloCuringa::QRCU_TX_QRCODE];
        $retorno->status = $resultset[DmlSqlSeloCuringa::QRCU_IN_STATUS];
        $retorno->dataCadastro = Util::MySQLDate_to_DMYHMiS($resultset[DmlSqlSeloCuringa::QRCU_DT_CADASTRO]);
        $retorno->dataAtualizacao = Util::MySQLDate_to_DMYHMiS($resultset[DmlSqlSeloCuringa::QRCU_DT_UPDATE]);
        $retorno->statusdesc = VariavelCache::getInstance()->getStatusDesc($retorno->status);
        return $retorno;

    }

}
?>
