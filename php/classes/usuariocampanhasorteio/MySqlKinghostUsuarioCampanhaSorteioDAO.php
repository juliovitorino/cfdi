<?php

/**
* MySqlKinghostUsuarioCampanhaSorteioDAO - Implementação DAO
*
* Classe de com todos os comandos DML e DDL (se necessário) para apoio 
* a classe MySqlKinghostUsuarioCampanhaSorteioDAO
* Não é uma camada visível para outros dispositivos, como as camadas de apresentação e aplicação. 
*
*
* Tabela principal de atuação: USUARIO_CAMPANHA_SORTEIO
*
* Changelog:
*
* 
* @author Julio Cesar Vitorino
* @since 23/08/2019 10:06:20
*
*/
require_once 'UsuarioCampanhaSorteioDTO.php';
require_once 'UsuarioCampanhaSorteioDAO.php';
require_once 'DmlSqlUsuarioCampanhaSorteio.php';

require_once '../mensagem/ConstantesMensagem.php';
require_once '../mensagem/MensagemCache.php';
require_once '../variavel/VariavelCache.php';
require_once '../daofactory/DmlSql.php';

class MySqlKinghostUsuarioCampanhaSorteioDAO implements UsuarioCampanhaSorteioDAO
{
    private $daofactory;

    function __construct($daofactory)
    {
        $this->daofactory = $daofactory;
    }
/**
* loadMaxIdusuarioIdcampanhaPK() - Carrega um MaxID (pk) para um ${CAMPO} e status
*
* @param $idUsuario
* @param $idCampanhaSorteio
* @param $status
* @return $dto
*/ 

    public function loadMaxIdusuarioIdcampanhaPK($idUsuario,$idCampanhaSorteio,$status)
    {   
        $retorno = 0;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $sql = DmlSqlUsuarioCampanhaSorteio::SELECT_MAX_PK . ' WHERE ' 
        . DmlSqlUsuarioCampanhaSorteio::USUA_ID . " = $idUsuario "
        . " AND " . DmlSqlUsuarioCampanhaSorteio::CASO_ID . " = $idCampanhaSorteio "
        . " AND " . DmlSqlUsuarioCampanhaSorteio::USCS_IN_STATUS . " = '$status'";

        $res = $conexao->query($sql);
        if ($res){
            $tmp = $res->fetch_assoc();
            $retorno = $tmp['maxid'] == NULL ? 0 : $tmp['maxid'];
        }
        return $retorno;

    }



/**
* loadMaxIdusuarioPK() - Carrega um MaxID (pk) para um ${CAMPO} e status
*
* @param $idUsuario
* @param $status
* @return $dto
*/ 

    public function loadMaxIdusuarioPK($idUsuario,$status)
    {   
        $retorno = 0;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $sql = DmlSqlUsuarioCampanhaSorteio::SELECT_MAX_PK . ' WHERE ' 
        . DmlSqlUsuarioCampanhaSorteio::USUA_ID . " = $idUsuario "
        . " AND " . DmlSqlUsuarioCampanhaSorteio::USCS_IN_STATUS . " = '$status'";

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
* listAll() - Lista todos os registros provenientes de USUARIO_CAMPANHA_SORTEIO sem critério de paginação
*
* @return List<UsuarioCampanhaSorteioDTO>[]
*/ 
    public function listAll()   {   }

/**
* update() - atualiza apenas um registro com base no dto UsuarioCampanhaSorteioDTO->id
* @param $daofactory
*
* @return boolean
*/ 
    public function update($dto)
    {   
        $retorno = false;

        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $stmt = $conexao->prepare(DmlSqlUsuarioCampanhaSorteio::UPD_PK);
        $stmt->bind_param(DmlSql::INTEGER_TYPE 
                            . DmlSql::INTEGER_TYPE 
                            . DmlSql::INTEGER_TYPE 
                            ,$dto->idUsuario
                            ,$dto->idCampanhaSorteio
                            ,$dto->id );
        if ($stmt->execute())
        {
            $retorno = true;
        }

        return $retorno;
    }

/**
* delete() - excluir fisicamente um registro com base no dto UsuarioCampanhaSorteioDTO->id
*
* @return boolean
*/ 
    public function delete($dto)
    {   
        $retorno = false;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $stmt = $conexao->prepare(DmlSqlUsuarioCampanhaSorteio::DEL_PK);
        $stmt->bind_param(DmlSql::INTEGER_TYPE
                            ,$dto->id);
        if ($stmt->execute())
        {
            $retorno = true;
        }

        return $retorno;
    }


    public function listUsuarioCampanhaSorteioStatus($status)
    {
        $retorno = array();

        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $res = $conexao->query(DmlSqlUsuarioCampanhaSorteio::SELECT . 'WHERE `' . DmlSqlUsuarioCampanhaSorteio::USCS_IN_STATUS . "` = '$status'" );
        if ($res){
            while ($row = $res->fetch_assoc()) {
                array_push($retorno, $this->getDTO($row));
            }
        }
        return $retorno;
    }

/**
* countUsuarioCampanhaSorteioPorStatus() - contar a quantidade de registros
* sob o contexto da classe UsuarioCampanhaSorteio com base no status específico. 
*
* Atenção em @see $sql na tabela USUARIO_CAMPANHA_SORTEIO 
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

    public function countUsuarioCampanhaSorteioPorStatus($status)
    {   
        $retorno = 0;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $res = $conexao->query(DmlSqlUsuarioCampanhaSorteio::SQL_COUNT . ' WHERE ' 
        . DmlSqlUsuarioCampanhaSorteio::USCS_IN_STATUS . " = '$status'"
        );
        if ($res){
            $tmp = $res->fetch_assoc();
            $retorno = $tmp['contador'];
        }
        return $retorno;

    }

/**
* listUsuarioCampanhaSorteioPorStatus() - Listar um conjunto de registro previamente paginado
* sob o contexto da classe UsuarioCampanhaSorteio com base no status específico.
*
* Atenção em @see $sql na tabela USUARIO_CAMPANHA_SORTEIO 
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

    public function listUsuarioCampanhaSorteioPorStatus($status, $pag, $qtde, $coluna, $ordem)
    {
        $sql = DmlSqlUsuarioCampanhaSorteio::SELECT 
        . ' WHERE ' . DmlSqlUsuarioCampanhaSorteio::USCS_IN_STATUS . " = '$status'"
        . ' ORDER BY ' . $coluna . ($ordem == 0 ? " ASC": " DESC");
        return $this->listPagina($sql, $pag, $qtde);
    }

/**
* countUsuarioCampanhaSorteioPorUsuaIdStatus() - contar a quantidade de registros
* sob o contexto da classe UsuarioCampanhaSorteio com base no usuário específico. Esse usuário
* é o usuário logado na sessão ou no próprio dispositivo móvel e de acordo com a 
* query em @see $sql na tabela USUARIO_CAMPANHA_SORTEIO 
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

    public function countUsuarioCampanhaSorteioPorUsuaIdStatus($usuaid, $status)
    {   
        $retorno = 0;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $res = $conexao->query(DmlSqlUsuarioCampanhaSorteio::SQL_COUNT . ' WHERE ' 
        . DmlSqlUsuarioCampanhaSorteio::USUA_ID . " = $usuaid "
        . ' AND ' . DmlSqlUsuarioCampanhaSorteio::USCS_IN_STATUS . " = '$status'"
        );
        if ($res){
            $tmp = $res->fetch_assoc();
            $retorno = $tmp['contador'];
        }
        return $retorno;

    }

/**
* listUsuarioCampanhaSorteioPorUsuaIdStatus() - Listar um conjunto de registro previamente paginado
* sob o contexto da classe UsuarioCampanhaSorteio com base no usuário específico. Esse usuário
* é o usuário logado na sessão ou no próprio dispositivo móvel e de acordo com a 
* query em @see $sql na tabela USUARIO_CAMPANHA_SORTEIO 
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
    public function listUsuarioCampanhaSorteioPorUsuaIdStatus($usuaid, $status, $pag, $qtde, $coluna, $ordem)
    {
        $sql = DmlSqlUsuarioCampanhaSorteio::SELECT 
        . ' WHERE ' . DmlSqlUsuarioCampanhaSorteio::USUA_ID . " = $usuaid "
        . ' AND ' . DmlSqlUsuarioCampanhaSorteio::USCS_IN_STATUS . " = '$status'"
        . ' ORDER BY ' . $coluna . ($ordem == 0 ? " ASC": " DESC");
        return $this->listPagina($sql, $pag, $qtde);
    }

/**
* listPagina() - Listar um conjunto de registro previamente paginado
* e de acordo com a query em @see $sql na tabela USUARIO_CAMPANHA_SORTEIO 
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
* na tabela USUARIO_CAMPANHA_SORTEIO usando a Primary Key USCS_ID
*
* @param $id
* @return UsuarioCampanhaSorteioDTO
*/ 
    public function loadPK($id)
    {   
        $retorno = NULL;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $res = $conexao->query(DmlSqlUsuarioCampanhaSorteio::SELECT . ' WHERE ' . DmlSqlUsuarioCampanhaSorteio::USCS_ID . '=' . $id );
        if ($res->num_rows > 0){
            $retorno = $this->getDTO($res->fetch_assoc());
        }
        return $retorno;
    }

/**
* updateStatus() - atualizar o campo de STATUS utilizando a id como item de busca
* na tabela USUARIO_CAMPANHA_SORTEIO usando a Primary Key USCS_ID
*
* @param $id
* @param $status
*
* @return UsuarioCampanhaSorteioDTO
*/ 
    public function updateStatus($id, $status)
    {   
        $retorno = false;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $stmt = $conexao->prepare(DmlSqlUsuarioCampanhaSorteio::UPD_STATUS);
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
* insert() - inserir um registro com base no UsuarioCampanhaSorteioDTO. Alguns atributos dentro do DTO
* serão ignorados caso estejam populados, pois os mesmos possuem constraint de DEFAULT value
* ou campos de AUTO INCREMENTO já previamente definidos no DDL de criação de tabelas do BD.
*
* Atributos da classe UsuarioCampanhaSorteioDTO sumariamente IGNORADOS por este método MESMO que estejam preenchidos:
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
        $stmt = $conexao->prepare(DmlSqlUsuarioCampanhaSorteio::INS);
        $stmt->bind_param(DmlSql::INTEGER_TYPE 
                            . DmlSql::INTEGER_TYPE 
                            ,$dto->idUsuario
                            ,$dto->idCampanhaSorteio
        );
        if ($stmt->execute())
        {
            $retorno = true;
        }

        return $retorno;
    }

    /**
     * getDTO() - Transforma o resultset padrão em UsuarioCampanhaSorteioDTO
    */
    public function getDTO($resultset)
    {
        if(is_null($resultset)){
            return NULL;
        }

        //echo var_dump($resultset); // ótimo pra debugar
        $retorno = new UsuarioCampanhaSorteioDTO();
        $retorno->id = $resultset[DmlSqlUsuarioCampanhaSorteio::USCS_ID] == NULL ? NULL : $resultset[DmlSqlUsuarioCampanhaSorteio::USCS_ID];
        $retorno->idUsuario = $resultset[DmlSqlUsuarioCampanhaSorteio::USUA_ID] == NULL ? NULL : $resultset[DmlSqlUsuarioCampanhaSorteio::USUA_ID];
        $retorno->idCampanhaSorteio = $resultset[DmlSqlUsuarioCampanhaSorteio::CASO_ID] == NULL ? NULL : $resultset[DmlSqlUsuarioCampanhaSorteio::CASO_ID];
        $retorno->status = $resultset[DmlSqlUsuarioCampanhaSorteio::USCS_IN_STATUS] == NULL ? NULL : $resultset[DmlSqlUsuarioCampanhaSorteio::USCS_IN_STATUS];
        $retorno->dataCadastro = Util::MySQLDate_to_DMYHMiS($resultset[DmlSqlUsuarioCampanhaSorteio::USCS_DT_CADASTRO]);
        $retorno->dataAtualizacao = Util::MySQLDate_to_DMYHMiS($resultset[DmlSqlUsuarioCampanhaSorteio::USCS_DT_UPDATE]);
        $retorno->statusdesc = VariavelCache::getInstance()->getStatusDesc($retorno->status);
        $retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
        $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);
        return $retorno;

    }

    /**
    * updateIdusuario() - implementação da assinatura em UsuarioCampanhaSorteioDAO
    */
    public function updateIdusuario($id, $idUsuario)
    {   
        $retorno = false;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $stmt = $conexao->prepare(DmlSqlUsuarioCampanhaSorteio::UPD_USUARIO_CAMPANHA_SORTEIO_USUA_ID_PK);
        $stmt->bind_param(DmlSql::INTEGER_TYPE 
                            . DmlSql::INTEGER_TYPE
                            ,$idUsuario
                            ,$id);
        if ($stmt->execute())
        {
            $retorno = true;
        }

        return $retorno;
    }

    /**
    * updateIdcampanhasorteio() - implementação da assinatura em UsuarioCampanhaSorteioDAO
    */
    public function updateIdcampanhasorteio($id, $idCampanhaSorteio)
    {   
        $retorno = false;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $stmt = $conexao->prepare(DmlSqlUsuarioCampanhaSorteio::UPD_USUARIO_CAMPANHA_SORTEIO_CASO_ID_PK);
        $stmt->bind_param(DmlSql::INTEGER_TYPE 
                            . DmlSql::INTEGER_TYPE
                            ,$idCampanhaSorteio
                            ,$id);
        if ($stmt->execute())
        {
            $retorno = true;
        }

        return $retorno;
    }


    /**
    * loadIdusuario() - implementação da assinatura em UsuarioCampanhaSorteioDAO
    */

    public function loadIdusuario($idUsuario)
    {   
        $retorno = NULL;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $res = $conexao->query(DmlSqlUsuarioCampanhaSorteio::SELECT . ' WHERE ' . DmlSqlUsuarioCampanhaSorteio::USUA_ID . '=' . $idUsuario );
        if ($res){
            $retorno = $this->getDTO($res->fetch_assoc());
        }
        return $retorno;
    }

    /**
    * loadIdcampanhasorteio() - implementação da assinatura em UsuarioCampanhaSorteioDAO
    */

    public function loadIdcampanhasorteio($idCampanhaSorteio)
    {   
        $retorno = NULL;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $res = $conexao->query(DmlSqlUsuarioCampanhaSorteio::SELECT . ' WHERE ' . DmlSqlUsuarioCampanhaSorteio::CASO_ID . '=' . $idCampanhaSorteio );
        if ($res){
            $retorno = $this->getDTO($res->fetch_assoc());
        }
        return $retorno;
    }


    /**
    * loadStatus() - implementação da assinatura em UsuarioCampanhaSorteioDAO
    */

    public function loadStatus($status)
    {   
        $retorno = NULL;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $res = $conexao->query(DmlSqlUsuarioCampanhaSorteio::SELECT . ' WHERE ' . DmlSqlUsuarioCampanhaSorteio::USCS_IN_STATUS . '=' . $status );
        if ($res){
            $retorno = $this->getDTO($res->fetch_assoc());
        }
        return $retorno;
    }

    /**
    * loadDatacadastro() - implementação da assinatura em UsuarioCampanhaSorteioDAO
    */

    public function loadDatacadastro($dataCadastro)
    {   
        $retorno = NULL;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $res = $conexao->query(DmlSqlUsuarioCampanhaSorteio::SELECT . ' WHERE ' . DmlSqlUsuarioCampanhaSorteio::USCS_DT_CADASTRO . '=' . $dataCadastro );
        if ($res){
            $retorno = $this->getDTO($res->fetch_assoc());
        }
        return $retorno;
    }

    /**
    * loadDataatualizacao() - implementação da assinatura em UsuarioCampanhaSorteioDAO
    */

    public function loadDataatualizacao($dataAtualizacao)
    {   
        $retorno = NULL;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $res = $conexao->query(DmlSqlUsuarioCampanhaSorteio::SELECT . ' WHERE ' . DmlSqlUsuarioCampanhaSorteio::USCS_DT_UPDATE . '=' . $dataAtualizacao );
        if ($res){
            $retorno = $this->getDTO($res->fetch_assoc());
        }
        return $retorno;
    }

}
?>




