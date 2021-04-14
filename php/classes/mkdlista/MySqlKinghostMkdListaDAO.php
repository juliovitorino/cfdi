<?php

/**
* MySqlKinghostMkdListaDAO - Implementação DAO
*
* Classe de com todos os comandos DML e DDL (se necessário) para apoio 
* a classe MySqlKinghostMkdListaDAO
* Não é uma camada visível para outros dispositivos, como as camadas de apresentação e aplicação. 
*
*
* Tabela principal de atuação: MKD_EMAIL_LISTA
*
* Changelog:
*
* 
* @author Julio Cesar Vitorino
* @since 23/08/2019 10:06:20
*
*/
require_once 'MkdListaDTO.php';
require_once 'MkdListaDAO.php';
require_once 'DmlSqlMkdLista.php';

require_once '../variavel/VariavelCache.php';
require_once '../daofactory/DmlSql.php';

class MySqlKinghostMkdListaDAO implements MkdListaDAO
{
    private $daofactory;

    function __construct($daofactory)
    {
        $this->daofactory = $daofactory;
    }


/**
* loadMaxId_Mkd_CampanhaPK() - Carrega um MaxID (pk) para um ${CAMPO} e status
*
* @param $id_mkd_campanha
* @param $status
* @return $dto
*/ 

    public function loadMaxId_Mkd_CampanhaPK($id_mkd_campanha,$status)
    {   
        $retorno = 0;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $sql = DmlSqlMkdLista::SELECT_MAX_PK . ' WHERE ' 
        . DmlSqlMkdLista::MKCE_ID . " = $id_mkd_campanha "
        . " AND " . DmlSqlMkdLista::MKEL_IN_STATUS . " = '$status'";

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
* listAll() - Lista todos os registros provenientes de MKD_EMAIL_LISTA sem critério de paginação
*
* @return List<MkdListaDTO>[]
*/ 
    public function listAll()   {   }

/**
* update() - atualiza apenas um registro com base no dto MkdListaDTO->id
* @param $daofactory
*
* @return boolean
*/ 
    public function update($dto)
    {   
        $retorno = false;

        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $stmt = $conexao->prepare(DmlSqlMkdLista::UPD_PK);
        $stmt->bind_param(DmlSql::INTEGER_TYPE 
                            . DmlSql::STRING_TYPE 
                            . DmlSql::STRING_TYPE 
                            . DmlSql::STRING_TYPE 
                            . DmlSql::STRING_TYPE 
                            . DmlSql::STRING_TYPE 
                            . DmlSql::STRING_TYPE 
                            . DmlSql::INTEGER_TYPE 
                            ,$dto->id_mkd_campanha
                            ,$dto->nome
                            ,$dto->email
                            ,$dto->primeiroNome
                            ,$dto->sobrenome
                            ,$dto->whatsapp
                            ,$dto->hashlead
                            ,$dto->id );
        if ($stmt->execute())
        {
            $retorno = true;
        }

        return $retorno;
    }

/**
* delete() - excluir fisicamente um registro com base no dto MkdListaDTO->id
*
* @return boolean
*/ 
    public function delete($dto)
    {   
        $retorno = false;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $stmt = $conexao->prepare(DmlSqlMkdLista::DEL_PK);
        $stmt->bind_param(DmlSql::INTEGER_TYPE
                            ,$dto->id);
        if ($stmt->execute())
        {
            $retorno = true;
        }

        return $retorno;
    }


    public function listMkdListaStatus($status)
    {
        $retorno = array();

        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $res = $conexao->query(DmlSqlMkdLista::SELECT . 'WHERE `' . DmlSqlMkdLista::MKEL_IN_STATUS . "` = '$status'" );
        if ($res){
            while ($row = $res->fetch_assoc()) {
                array_push($retorno, $this->getDTO($row));
            }
        }
        return $retorno;
    }

/**
* countMkdListaPorStatus() - contar a quantidade de registros
* sob o contexto da classe MkdLista com base no status específico. 
*
* Atenção em @see $sql na tabela MKD_EMAIL_LISTA 
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

    public function countMkdListaPorStatus($status)
    {   
        $retorno = 0;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $res = $conexao->query(DmlSqlMkdLista::SQL_COUNT . ' WHERE ' 
        . DmlSqlMkdLista::MKEL_IN_STATUS . " = '$status'"
        );
        if ($res){
            $tmp = $res->fetch_assoc();
            $retorno = $tmp['contador'];
        }
        return $retorno;

    }

/**
* listMkdListaPorStatus() - Listar um conjunto de registro previamente paginado
* sob o contexto da classe MkdLista com base no status específico.
*
* Atenção em @see $sql na tabela MKD_EMAIL_LISTA 
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

    public function listMkdListaPorStatus($status, $pag, $qtde, $coluna, $ordem)
    {
        $sql = DmlSqlMkdLista::SELECT 
        . ' WHERE ' . DmlSqlMkdLista::MKEL_IN_STATUS . " = '$status'"
        . ' ORDER BY ' . $coluna . ($ordem == 0 ? " ASC": " DESC");
        return $this->listPagina($sql, $pag, $qtde);
    }

/**
* countMkdListaPorUsuaIdStatus() - contar a quantidade de registros
* sob o contexto da classe MkdLista com base no usuário específico. Esse usuário
* é o usuário logado na sessão ou no próprio dispositivo móvel e de acordo com a 
* query em @see $sql na tabela MKD_EMAIL_LISTA 
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

    public function countMkdListaPorUsuaIdStatus($usuaid, $status)
    {   
        $retorno = 0;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $res = $conexao->query(DmlSqlMkdLista::SQL_COUNT . ' WHERE ' 
        . DmlSqlMkdLista::USUA_ID . " = $usuaid "
        . ' AND ' . DmlSqlMkdLista::MKEL_IN_STATUS . " = '$status'"
        );
        if ($res){
            $tmp = $res->fetch_assoc();
            $retorno = $tmp['contador'];
        }
        return $retorno;

    }

/**
* listMkdListaPorUsuaIdStatus() - Listar um conjunto de registro previamente paginado
* sob o contexto da classe MkdLista com base no usuário específico. Esse usuário
* é o usuário logado na sessão ou no próprio dispositivo móvel e de acordo com a 
* query em @see $sql na tabela MKD_EMAIL_LISTA 
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
    public function listMkdListaPorUsuaIdStatus($usuaid, $status, $pag, $qtde, $coluna, $ordem)
    {
        $sql = DmlSqlMkdLista::SELECT 
        . ' WHERE ' . DmlSqlMkdLista::USUA_ID . " = $usuaid "
        . ' AND ' . DmlSqlMkdLista::MKEL_IN_STATUS . " = '$status'"
        . ' ORDER BY ' . $coluna . ($ordem == 0 ? " ASC": " DESC");
        return $this->listPagina($sql, $pag, $qtde);
    }

/**
* listPagina() - Listar um conjunto de registro previamente paginado
* e de acordo com a query em @see $sql na tabela MKD_EMAIL_LISTA 
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
* na tabela MKD_EMAIL_LISTA usando a Primary Key MKEL_ID
*
* @param $id
* @return MkdListaDTO
*/ 
    public function loadPK($id)
    {   
        $retorno = NULL;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $res = $conexao->query(DmlSqlMkdLista::SELECT . ' WHERE ' . DmlSqlMkdLista::MKEL_ID . '=' . $id );
        if ($res){
            $retorno = $this->getDTO($res->fetch_assoc());
        }
        return $retorno;
    }

/**
* updateStatus() - atualizar o campo de STATUS utilizando a id como item de busca
* na tabela MKD_EMAIL_LISTA usando a Primary Key MKEL_ID
*
* @param $id
* @param $status
*
* @return MkdListaDTO
*/ 
    public function updateStatus($id, $status)
    {   
        $retorno = false;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $stmt = $conexao->prepare(DmlSqlMkdLista::UPD_STATUS);
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
* insert() - inserir um registro com base no MkdListaDTO. Alguns atributos dentro do DTO
* serão ignorados caso estejam populados, pois os mesmos possuem constraint de DEFAULT value
* ou campos de AUTO INCREMENTO já previamente definidos no DDL de criação de tabelas do BD.
*
* Atributos da classe MkdListaDTO sumariamente IGNORADOS por este método MESMO que estejam preenchidos:
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
        $stmt = $conexao->prepare(DmlSqlMkdLista::INS);
        $stmt->bind_param(DmlSql::INTEGER_TYPE 
                            . DmlSql::STRING_TYPE 
                            . DmlSql::STRING_TYPE 
                            . DmlSql::STRING_TYPE 
                            ,$dto->id_mkd_campanha
                            ,$dto->nome
                            ,$dto->email
                            ,$dto->hashlead
        );
        if ($stmt->execute())
        {
            $retorno = true;
        }

        return $retorno;
    }

    /**
     * getDTO() - Transforma o resultset padrão em MkdListaDTO
    */
    public function getDTO($resultset)
    {
        //echo var_dump($resultset); // ótimo pra debugar
        $retorno = new MkdListaDTO();
        $retorno->id = $resultset[DmlSqlMkdLista::MKEL_ID] == NULL ? NULL : (int) $resultset[DmlSqlMkdLista::MKEL_ID];
        $retorno->id_mkd_campanha = $resultset[DmlSqlMkdLista::MKCE_ID] == NULL ? NULL : (int) $resultset[DmlSqlMkdLista::MKCE_ID];
        $retorno->nome = $resultset[DmlSqlMkdLista::MKEL_TX_NOME] == NULL ? NULL : $resultset[DmlSqlMkdLista::MKEL_TX_NOME];
        $retorno->email = $resultset[DmlSqlMkdLista::MKEL_TX_EMAIL] == NULL ? NULL : $resultset[DmlSqlMkdLista::MKEL_TX_EMAIL];
        $retorno->primeiroNome = $resultset[DmlSqlMkdLista::MKEL_TX_PRIM_NOME] == NULL ? NULL : $resultset[DmlSqlMkdLista::MKEL_TX_PRIM_NOME];
        $retorno->sobrenome = $resultset[DmlSqlMkdLista::MKEL_TX_SOBRENOME] == NULL ? NULL : $resultset[DmlSqlMkdLista::MKEL_TX_SOBRENOME];
        $retorno->whatsapp = $resultset[DmlSqlMkdLista::MKEL_TX_WHATSAPP] == NULL ? NULL : $resultset[DmlSqlMkdLista::MKEL_TX_WHATSAPP];
        $retorno->hashlead = $resultset[DmlSqlMkdLista::MKEL_TX_HASH] == NULL ? NULL : $resultset[DmlSqlMkdLista::MKEL_TX_HASH];
        $retorno->status = $resultset[DmlSqlMkdLista::MKEL_IN_STATUS] == NULL ? NULL : $resultset[DmlSqlMkdLista::MKEL_IN_STATUS];
        $retorno->dataCadastro = Util::MySQLDate_to_DMYHMiS($resultset[DmlSqlMkdLista::MKEL_DT_CADASTRO]);
        $retorno->dataAtualizacao = Util::MySQLDate_to_DMYHMiS($resultset[DmlSqlMkdLista::MKEL_DT_UPDATE]);
        $retorno->statusdesc = VariavelCache::getInstance()->getStatusDesc($retorno->status);
        return $retorno;

    }

    /**
    * updateId_Mkd_Campanha() - implementação da assinatura em MkdListaDAO
    */
    public function updateId_Mkd_Campanha($id, $id_mkd_campanha)
    {   
        $retorno = false;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $stmt = $conexao->prepare(DmlSqlMkdLista::UPD_MKD_EMAIL_LISTA_MKCE_ID_PK);
        $stmt->bind_param(DmlSql::INTEGER_TYPE 
                            . DmlSql::INTEGER_TYPE
                            ,$id_mkd_campanha
                            ,$id);
        if ($stmt->execute())
        {
            $retorno = true;
        }

        return $retorno;
    }

    /**
    * updateNome() - implementação da assinatura em MkdListaDAO
    */
    public function updateNome($id, $nome)
    {   
        $retorno = false;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $stmt = $conexao->prepare(DmlSqlMkdLista::UPD_MKD_EMAIL_LISTA_MKEL_TX_NOME_PK);
        $stmt->bind_param(DmlSql::STRING_TYPE 
                            . DmlSql::STRING_TYPE
                            ,$nome
                            ,$id);
        if ($stmt->execute())
        {
            $retorno = true;
        }

        return $retorno;
    }

    /**
    * updateEmail() - implementação da assinatura em MkdListaDAO
    */
    public function updateEmail($id, $email)
    {   
        $retorno = false;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $stmt = $conexao->prepare(DmlSqlMkdLista::UPD_MKD_EMAIL_LISTA_MKEL_TX_EMAIL_PK);
        $stmt->bind_param(DmlSql::STRING_TYPE 
                            . DmlSql::STRING_TYPE
                            ,$email
                            ,$id);
        if ($stmt->execute())
        {
            $retorno = true;
        }

        return $retorno;
    }

    /**
    * updatePrimeironome() - implementação da assinatura em MkdListaDAO
    */
    public function updatePrimeironome($id, $primeiroNome)
    {   
        $retorno = false;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $stmt = $conexao->prepare(DmlSqlMkdLista::UPD_MKD_EMAIL_LISTA_MKEL_TX_PRIM_NOME_PK);
        $stmt->bind_param(DmlSql::STRING_TYPE 
                            . DmlSql::STRING_TYPE
                            ,$primeiroNome
                            ,$id);
        if ($stmt->execute())
        {
            $retorno = true;
        }

        return $retorno;
    }

    /**
    * updateSobrenome() - implementação da assinatura em MkdListaDAO
    */
    public function updateSobrenome($id, $sobrenome)
    {   
        $retorno = false;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $stmt = $conexao->prepare(DmlSqlMkdLista::UPD_MKD_EMAIL_LISTA_MKEL_TX_SOBRENOME_PK);
        $stmt->bind_param(DmlSql::STRING_TYPE 
                            . DmlSql::STRING_TYPE
                            ,$sobrenome
                            ,$id);
        if ($stmt->execute())
        {
            $retorno = true;
        }

        return $retorno;
    }

    /**
    * updateWhatsapp() - implementação da assinatura em MkdListaDAO
    */
    public function updateWhatsapp($id, $whatsapp)
    {   
        $retorno = false;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $stmt = $conexao->prepare(DmlSqlMkdLista::UPD_MKD_EMAIL_LISTA_MKEL_TX_WHATSAPP_PK);
        $stmt->bind_param(DmlSql::STRING_TYPE 
                            . DmlSql::STRING_TYPE
                            ,$whatsapp
                            ,$id);
        if ($stmt->execute())
        {
            $retorno = true;
        }

        return $retorno;
    }

    /**
    * updateHashlead() - implementação da assinatura em MkdListaDAO
    */
    public function updateHashlead($id, $hashlead)
    {   
        $retorno = false;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $stmt = $conexao->prepare(DmlSqlMkdLista::UPD_MKD_EMAIL_LISTA_MKEL_TX_HASH_PK);
        $stmt->bind_param(DmlSql::STRING_TYPE 
                            . DmlSql::STRING_TYPE
                            ,$hashlead
                            ,$id);
        if ($stmt->execute())
        {
            $retorno = true;
        }

        return $retorno;
    }

    /**
    * loadId_Mkd_Campanha() - implementação da assinatura em MkdListaDAO
    */

    public function loadId_Mkd_Campanha($id_mkd_campanha)
    {   
        $retorno = NULL;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $res = $conexao->query(DmlSqlMkdLista::SELECT . ' WHERE ' . DmlSqlMkdLista::MKCE_ID . '=' . $id_mkd_campanha );
        if ($res){
            $retorno = $this->getDTO($res->fetch_assoc());
        }
        return $retorno;
    }

    /**
    * loadNome() - implementação da assinatura em MkdListaDAO
    */

    public function loadNome($nome)
    {   
        $retorno = NULL;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $res = $conexao->query(DmlSqlMkdLista::SELECT . ' WHERE ' . DmlSqlMkdLista::MKEL_TX_NOME . '=' . $nome );
        if ($res){
            $retorno = $this->getDTO($res->fetch_assoc());
        }
        return $retorno;
    }

    /**
    * loadEmail() - implementação da assinatura em MkdListaDAO
    */

    public function loadEmail($email)
    {   
        $retorno = NULL;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $res = $conexao->query(DmlSqlMkdLista::SELECT . ' WHERE ' . DmlSqlMkdLista::MKEL_TX_EMAIL . '=' . $email );
        if ($res){
            $retorno = $this->getDTO($res->fetch_assoc());
        }
        return $retorno;
    }

    /**
    * loadPrimeironome() - implementação da assinatura em MkdListaDAO
    */

    public function loadPrimeironome($primeiroNome)
    {   
        $retorno = NULL;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $res = $conexao->query(DmlSqlMkdLista::SELECT . ' WHERE ' . DmlSqlMkdLista::MKEL_TX_PRIM_NOME . '=' . $primeiroNome );
        if ($res){
            $retorno = $this->getDTO($res->fetch_assoc());
        }
        return $retorno;
    }

    /**
    * loadSobrenome() - implementação da assinatura em MkdListaDAO
    */

    public function loadSobrenome($sobrenome)
    {   
        $retorno = NULL;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $res = $conexao->query(DmlSqlMkdLista::SELECT . ' WHERE ' . DmlSqlMkdLista::MKEL_TX_SOBRENOME . '=' . $sobrenome );
        if ($res){
            $retorno = $this->getDTO($res->fetch_assoc());
        }
        return $retorno;
    }

    /**
    * loadWhatsapp() - implementação da assinatura em MkdListaDAO
    */

    public function loadWhatsapp($whatsapp)
    {   
        $retorno = NULL;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $res = $conexao->query(DmlSqlMkdLista::SELECT . ' WHERE ' . DmlSqlMkdLista::MKEL_TX_WHATSAPP . '=' . $whatsapp );
        if ($res){
            $retorno = $this->getDTO($res->fetch_assoc());
        }
        return $retorno;
    }

    /**
    * loadHashlead() - implementação da assinatura em MkdListaDAO
    */

    public function loadHashlead($hashlead)
    {   
        $retorno = NULL;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $res = $conexao->query(DmlSqlMkdLista::SELECT . ' WHERE ' . DmlSqlMkdLista::MKEL_TX_HASH . "='$hashlead'" );
        if ($res){
            $retorno = $this->getDTO($res->fetch_assoc());
        }
        return $retorno;
    }


    /**
    * loadStatus() - implementação da assinatura em MkdListaDAO
    */

    public function loadStatus($status)
    {   
        $retorno = NULL;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $res = $conexao->query(DmlSqlMkdLista::SELECT . ' WHERE ' . DmlSqlMkdLista::MKEL_IN_STATUS . '=' . $status );
        if ($res){
            $retorno = $this->getDTO($res->fetch_assoc());
        }
        return $retorno;
    }

    /**
    * loadDatacadastro() - implementação da assinatura em MkdListaDAO
    */

    public function loadDatacadastro($dataCadastro)
    {   
        $retorno = NULL;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $res = $conexao->query(DmlSqlMkdLista::SELECT . ' WHERE ' . DmlSqlMkdLista::MKEL_DT_CADASTRO . '=' . $dataCadastro );
        if ($res){
            $retorno = $this->getDTO($res->fetch_assoc());
        }
        return $retorno;
    }

    /**
    * loadDataatualizacao() - implementação da assinatura em MkdListaDAO
    */

    public function loadDataatualizacao($dataAtualizacao)
    {   
        $retorno = NULL;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $res = $conexao->query(DmlSqlMkdLista::SELECT . ' WHERE ' . DmlSqlMkdLista::MKEL_DT_UPDATE . '=' . $dataAtualizacao );
        if ($res){
            $retorno = $this->getDTO($res->fetch_assoc());
        }
        return $retorno;
    }

}
?>
