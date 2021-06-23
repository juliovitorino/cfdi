<?php

/**
* MySqlKinghostUsuarioCampanhaSorteioTicketDAO - Implementação DAO
*
* Classe de com todos os comandos DML e DDL (se necessário) para apoio 
* a classe MySqlKinghostUsuarioCampanhaSorteioTicketDAO
* Não é uma camada visível para outros dispositivos, como as camadas de apresentação e aplicação. 
*
*
* Tabela principal de atuação: USUARIO_CAMPANHA_SORTEIO_TICKET
*
* Changelog:
*
* 
* @author Julio Cesar Vitorino
* @since 23/08/2019 10:06:20
*
*/
require_once 'UsuarioCampanhaSorteioTicketDTO.php';
require_once 'UsuarioCampanhaSorteioTicketDAO.php';
require_once 'DmlSqlUsuarioCampanhaSorteioTicket.php';

require_once '../mensagem/ConstantesMensagem.php';
require_once '../mensagem/MensagemCache.php';
require_once '../variavel/VariavelCache.php';
require_once '../daofactory/DmlSql.php';

class MySqlKinghostUsuarioCampanhaSorteioTicketDAO implements UsuarioCampanhaSorteioTicketDAO
{
    private $daofactory;

    function __construct($daofactory)
    {
        $this->daofactory = $daofactory;
    }


/**
* loadMaxIduscsPK() - Carrega um MaxID (pk) para um ${CAMPO} e status
*
* @param $iduscs
* @param $status
* @return $dto
*/ 

    public function loadMaxIduscsPK($iduscs,$status)
    {   
        $retorno = 0;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $sql = DmlSqlUsuarioCampanhaSorteioTicket::SELECT_MAX_PK . ' WHERE ' 
        . DmlSqlUsuarioCampanhaSorteioTicket::USCS_ID . " = $iduscs "
        . " AND " . DmlSqlUsuarioCampanhaSorteioTicket::UCST_IN_STATUS . " = '$status'";

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
* listAll() - Lista todos os registros provenientes de USUARIO_CAMPANHA_SORTEIO_TICKET sem critério de paginação
*
* @return List<UsuarioCampanhaSorteioTicketDTO>[]
*/ 
    public function listAll()   {   }

/**
* update() - atualiza apenas um registro com base no dto UsuarioCampanhaSorteioTicketDTO->id
* @param $daofactory
*
* @return boolean
*/ 
    public function update($dto)
    {   
        $retorno = false;

        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $stmt = $conexao->prepare(DmlSqlUsuarioCampanhaSorteioTicket::UPD_PK);
        $stmt->bind_param(DmlSql::INTEGER_TYPE 
                            . DmlSql::INTEGER_TYPE 
                            . DmlSql::INTEGER_TYPE 
                            ,$dto->iduscs
                            ,$dto->ticket
                            ,$dto->id );
        if ($stmt->execute())
        {
            $retorno = true;
        }

        return $retorno;
    }

/**
* delete() - excluir fisicamente um registro com base no dto UsuarioCampanhaSorteioTicketDTO->id
*
* @return boolean
*/ 
    public function delete($dto)
    {   
        $retorno = false;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $stmt = $conexao->prepare(DmlSqlUsuarioCampanhaSorteioTicket::DEL_PK);
        $stmt->bind_param(DmlSql::INTEGER_TYPE
                            ,$dto->id);
        if ($stmt->execute())
        {
            $retorno = true;
        }

        return $retorno;
    }


    public function listUsuarioCampanhaSorteioTicketStatus($status)
    {
        $retorno = array();

        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $res = $conexao->query(DmlSqlUsuarioCampanhaSorteioTicket::SELECT . 'WHERE `' . DmlSqlUsuarioCampanhaSorteioTicket::UCST_IN_STATUS . "` = '$status'" );
        if ($res){
            while ($row = $res->fetch_assoc()) {
                array_push($retorno, $this->getDTO($row));
            }
        }
        return $retorno;
    }

/**
* countUsuarioCampanhaSorteioTicketPorStatus() - contar a quantidade de registros
* sob o contexto da classe UsuarioCampanhaSorteioTicket com base no status específico. 
*
* Atenção em @see $sql na tabela USUARIO_CAMPANHA_SORTEIO_TICKET 
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

    public function countUsuarioCampanhaSorteioTicketPorStatus($status)
    {   
        $retorno = 0;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $res = $conexao->query(DmlSqlUsuarioCampanhaSorteioTicket::SQL_COUNT . ' WHERE ' 
        . DmlSqlUsuarioCampanhaSorteioTicket::UCST_IN_STATUS . " = '$status'"
        );
        if ($res){
            $tmp = $res->fetch_assoc();
            $retorno = $tmp['contador'];
        }
        return $retorno;

    }

/**
* listUsuarioCampanhaSorteioTicketPorStatus() - Listar um conjunto de registro previamente paginado
* sob o contexto da classe UsuarioCampanhaSorteioTicket com base no status específico.
*
* Atenção em @see $sql na tabela USUARIO_CAMPANHA_SORTEIO_TICKET 
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

    public function listUsuarioCampanhaSorteioTicketPorStatus($status, $pag, $qtde, $coluna, $ordem)
    {
        $sql = DmlSqlUsuarioCampanhaSorteioTicket::SELECT 
        . ' WHERE ' . DmlSqlUsuarioCampanhaSorteioTicket::UCST_IN_STATUS . " = '$status'"
        . ' ORDER BY ' . $coluna . ($ordem == 0 ? " ASC": " DESC");
        return $this->listPagina($sql, $pag, $qtde);
    }

/**
* countUsuarioCampanhaSorteioTicketPorUsuaIdStatus() - contar a quantidade de registros
* sob o contexto da classe UsuarioCampanhaSorteioTicket com base no usuário específico. Esse usuário
* é o usuário logado na sessão ou no próprio dispositivo móvel e de acordo com a 
* query em @see $sql na tabela USUARIO_CAMPANHA_SORTEIO_TICKET 
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

    public function countUsuarioCampanhaSorteioTicketPorUsuaIdStatus($usuaid, $status)
    {   
        $retorno = 0;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $res = $conexao->query(DmlSqlUsuarioCampanhaSorteioTicket::SQL_COUNT . ' WHERE ' 
        . DmlSqlUsuarioCampanhaSorteioTicket::USUA_ID . " = $usuaid "
        . ' AND ' . DmlSqlUsuarioCampanhaSorteioTicket::UCST_IN_STATUS . " = '$status'"
        );
        if ($res){
            $tmp = $res->fetch_assoc();
            $retorno = $tmp['contador'];
        }
        return $retorno;

    }

/**
* listUsuarioCampanhaSorteioTicketPorUsuaIdStatus() - Listar um conjunto de registro previamente paginado
* sob o contexto da classe UsuarioCampanhaSorteioTicket com base no usuário específico. Esse usuário
* é o usuário logado na sessão ou no próprio dispositivo móvel e de acordo com a 
* query em @see $sql na tabela USUARIO_CAMPANHA_SORTEIO_TICKET 
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
    public function listUsuarioCampanhaSorteioTicketPorUsuaIdStatus($usuaid, $status, $pag, $qtde, $coluna, $ordem)
    {
        $sql = DmlSqlUsuarioCampanhaSorteioTicket::SELECT 
        . ' WHERE ' . DmlSqlUsuarioCampanhaSorteioTicket::USUA_ID . " = $usuaid "
        . ' AND ' . DmlSqlUsuarioCampanhaSorteioTicket::UCST_IN_STATUS . " = '$status'"
        . ' ORDER BY ' . $coluna . ($ordem == 0 ? " ASC": " DESC");
        return $this->listPagina($sql, $pag, $qtde);
    }



/**
* countUsuarioCampanhaSorteioTicketPorUscsIdStatus() - contar a quantidade de registros
* sob o contexto da classe UsuarioCampanhaSorteioTicket com base no usuário específico. Esse usuário
* é o usuário logado na sessão ou no próprio dispositivo móvel e de acordo com a 
* query em @see $sql na tabela USUARIO_CAMPANHA_SORTEIO_TICKET 
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

public function countUsuarioCampanhaSorteioTicketPorUscsIdStatus($uscsid, $status)
{   
    $retorno = 0;
    // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
    $conexao = $this->daofactory->getSession();
    $res = $conexao->query(DmlSqlUsuarioCampanhaSorteioTicket::SQL_COUNT . ' WHERE ' 
    . DmlSqlUsuarioCampanhaSorteioTicket::USCS_ID . " = $uscsid "
    . ' AND ' . DmlSqlUsuarioCampanhaSorteioTicket::UCST_IN_STATUS . " = '$status'"
    );
    if ($res){
        $tmp = $res->fetch_assoc();
        $retorno = $tmp['contador'];
    }
    return $retorno;

}

/**
* listUsuarioCampanhaSorteioTicketPorUscsIdStatus() - Listar um conjunto de registro previamente paginado
* sob o contexto da classe UsuarioCampanhaSorteioTicket com base no usuário específico. Esse usuário
* é o usuário logado na sessão ou no próprio dispositivo móvel e de acordo com a 
* query em @see $sql na tabela USUARIO_CAMPANHA_SORTEIO_TICKET 
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
public function listUsuarioCampanhaSorteioTicketPorUscsIdStatus($uscsid, $status, $pag, $qtde, $coluna, $ordem)
{
    $sql = DmlSqlUsuarioCampanhaSorteioTicket::SELECT 
    . ' WHERE ' . DmlSqlUsuarioCampanhaSorteioTicket::USCS_ID . " = $uscsid "
    . ' AND ' . DmlSqlUsuarioCampanhaSorteioTicket::UCST_IN_STATUS . " = '$status'"
    . ' ORDER BY ' . $coluna . ($ordem == 0 ? " ASC": " DESC");
    return $this->listPagina($sql, $pag, $qtde);
}

/**
* listPagina() - Listar um conjunto de registro previamente paginado
* e de acordo com a query em @see $sql na tabela USUARIO_CAMPANHA_SORTEIO_TICKET 
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
* na tabela USUARIO_CAMPANHA_SORTEIO_TICKET usando a Primary Key UCST_ID
*
* @param $id
* @return UsuarioCampanhaSorteioTicketDTO
*/ 
    public function loadPK($id)
    {   
        $retorno = NULL;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $res = $conexao->query(DmlSqlUsuarioCampanhaSorteioTicket::SELECT . ' WHERE ' . DmlSqlUsuarioCampanhaSorteioTicket::UCST_ID . '=' . $id );
        if ($res->num_rows > 0){
            $retorno = $this->getDTO($res->fetch_assoc());
        }
        return $retorno;
    }

/**
* updateStatus() - atualizar o campo de STATUS utilizando a id como item de busca
* na tabela USUARIO_CAMPANHA_SORTEIO_TICKET usando a Primary Key UCST_ID
*
* @param $id
* @param $status
*
* @return UsuarioCampanhaSorteioTicketDTO
*/ 
    public function updateStatus($id, $status)
    {   
        $retorno = false;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $stmt = $conexao->prepare(DmlSqlUsuarioCampanhaSorteioTicket::UPD_STATUS);
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
* insert() - inserir um registro com base no UsuarioCampanhaSorteioTicketDTO. Alguns atributos dentro do DTO
* serão ignorados caso estejam populados, pois os mesmos possuem constraint de DEFAULT value
* ou campos de AUTO INCREMENTO já previamente definidos no DDL de criação de tabelas do BD.
*
* Atributos da classe UsuarioCampanhaSorteioTicketDTO sumariamente IGNORADOS por este método MESMO que estejam preenchidos:
* id
* status
* dataCadastro
* dataAtualizacao
*
* @return boolean
*/ 
    public function insert($dto) 
    {   
//var_dump($dto);        
        $retorno = false;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $sql = DmlSqlUsuarioCampanhaSorteioTicket::INS;
//var_dump($sql);        
        $stmt = $conexao->prepare($sql);

        $stmt->bind_param(DmlSql::INTEGER_TYPE 
                            . DmlSql::INTEGER_TYPE 
                            ,$dto->iduscs
                            ,$dto->ticket
        );
        if ($stmt->execute())
        {
            $retorno = true;
        }

        return $retorno;
    }

    /**
     * getDTO() - Transforma o resultset padrão em UsuarioCampanhaSorteioTicketDTO
    */
    public function getDTO($resultset)
    {
        if(is_null($resultset)){
            return NULL;
        }

        //echo var_dump($resultset); // ótimo pra debugar
        $retorno = new UsuarioCampanhaSorteioTicketDTO();
        $retorno->id = $resultset[DmlSqlUsuarioCampanhaSorteioTicket::UCST_ID] == NULL ? NULL : $resultset[DmlSqlUsuarioCampanhaSorteioTicket::UCST_ID];
        $retorno->iduscs = $resultset[DmlSqlUsuarioCampanhaSorteioTicket::USCS_ID] == NULL ? NULL : $resultset[DmlSqlUsuarioCampanhaSorteioTicket::USCS_ID];
        $retorno->ticket = $resultset[DmlSqlUsuarioCampanhaSorteioTicket::UCST_NU_TICKET] == NULL ? NULL : $resultset[DmlSqlUsuarioCampanhaSorteioTicket::UCST_NU_TICKET];
        $retorno->status = $resultset[DmlSqlUsuarioCampanhaSorteioTicket::UCST_IN_STATUS] == NULL ? NULL : $resultset[DmlSqlUsuarioCampanhaSorteioTicket::UCST_IN_STATUS];
        $retorno->dataCadastro = Util::MySQLDate_to_DMYHMiS($resultset[DmlSqlUsuarioCampanhaSorteioTicket::UCST_DT_CADASTRO]);
        $retorno->dataAtualizacao = Util::MySQLDate_to_DMYHMiS($resultset[DmlSqlUsuarioCampanhaSorteioTicket::UCST_DT_UPDATE]);
        $retorno->statusdesc = VariavelCache::getInstance()->getStatusDesc($retorno->status);
        $retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
        $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);
        return $retorno;

    }

    /**
    * updateIduscs() - implementação da assinatura em UsuarioCampanhaSorteioTicketDAO
    */
    public function updateIduscs($id, $iduscs)
    {   
        $retorno = false;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $stmt = $conexao->prepare(DmlSqlUsuarioCampanhaSorteioTicket::UPD_USUARIO_CAMPANHA_SORTEIO_TICKET_USCS_ID_PK);
        $stmt->bind_param(DmlSql::INTEGER_TYPE 
                            . DmlSql::INTEGER_TYPE
                            ,$iduscs
                            ,$id);
        if ($stmt->execute())
        {
            $retorno = true;
        }

        return $retorno;
    }

    /**
    * updateTicket() - implementação da assinatura em UsuarioCampanhaSorteioTicketDAO
    */
    public function updateTicket($id, $ticket)
    {   
        $retorno = false;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $stmt = $conexao->prepare(DmlSqlUsuarioCampanhaSorteioTicket::UPD_USUARIO_CAMPANHA_SORTEIO_TICKET_UCST_NU_TICKET_PK);
        $stmt->bind_param(DmlSql::INTEGER_TYPE 
                            . DmlSql::INTEGER_TYPE
                            ,$ticket
                            ,$id);
        if ($stmt->execute())
        {
            $retorno = true;
        }

        return $retorno;
    }

    /**
    * loadIduscs() - implementação da assinatura em UsuarioCampanhaSorteioTicketDAO
    */

    public function loadIduscs($iduscs)
    {   
        $retorno = NULL;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $res = $conexao->query(DmlSqlUsuarioCampanhaSorteioTicket::SELECT . ' WHERE ' . DmlSqlUsuarioCampanhaSorteioTicket::USCS_ID . '=' . $iduscs );
        if ($res){
            $retorno = $this->getDTO($res->fetch_assoc());
        }
        return $retorno;
    }

    /**
    * loadTicket() - implementação da assinatura em UsuarioCampanhaSorteioTicketDAO
    */

    public function loadTicket($ticket)
    {   
        $retorno = NULL;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $res = $conexao->query(DmlSqlUsuarioCampanhaSorteioTicket::SELECT . ' WHERE ' . DmlSqlUsuarioCampanhaSorteioTicket::UCST_NU_TICKET . '=' . $ticket );
        if ($res){
            $retorno = $this->getDTO($res->fetch_assoc());
        }
        return $retorno;
    }

    /**
    * loadStatus() - implementação da assinatura em UsuarioCampanhaSorteioTicketDAO
    */

    public function loadStatus($status)
    {   
        $retorno = NULL;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $res = $conexao->query(DmlSqlUsuarioCampanhaSorteioTicket::SELECT . ' WHERE ' . DmlSqlUsuarioCampanhaSorteioTicket::UCST_IN_STATUS . '=' . $status );
        if ($res){
            $retorno = $this->getDTO($res->fetch_assoc());
        }
        return $retorno;
    }

    /**
    * loadDatacadastro() - implementação da assinatura em UsuarioCampanhaSorteioTicketDAO
    */

    public function loadDatacadastro($dataCadastro)
    {   
        $retorno = NULL;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $res = $conexao->query(DmlSqlUsuarioCampanhaSorteioTicket::SELECT . ' WHERE ' . DmlSqlUsuarioCampanhaSorteioTicket::UCST_DT_CADASTRO . '=' . $dataCadastro );
        if ($res){
            $retorno = $this->getDTO($res->fetch_assoc());
        }
        return $retorno;
    }

    /**
    * loadDataatualizacao() - implementação da assinatura em UsuarioCampanhaSorteioTicketDAO
    */

    public function loadDataatualizacao($dataAtualizacao)
    {   
        $retorno = NULL;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $res = $conexao->query(DmlSqlUsuarioCampanhaSorteioTicket::SELECT . ' WHERE ' . DmlSqlUsuarioCampanhaSorteioTicket::UCST_DT_UPDATE . '=' . $dataAtualizacao );
        if ($res){
            $retorno = $this->getDTO($res->fetch_assoc());
        }
        return $retorno;
    }
}
?>

