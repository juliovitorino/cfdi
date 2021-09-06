<?php

/**
* MySqlKinghostUsuarioTipoEmpreendimentoDAO - Implementação DAO
*
* Classe de com todos os comandos DML e DDL (se necessário) para apoio 
* a classe MySqlKinghostUsuarioTipoEmpreendimentoDAO
* Não é uma camada visível para outros dispositivos, como as camadas de apresentação e aplicação. 
*
*
* Tabela principal de atuação: USUARIO_TIPO_EMPREENDIMENTO
*
* Changelog:
*
* 
* @author Julio Cesar Vitorino
* @since 23/08/2019 10:06:20
*
*/
require_once 'UsuarioTipoEmpreendimentoDTO.php';
require_once 'UsuarioTipoEmpreendimentoDAO.php';
require_once 'DmlSqlUsuarioTipoEmpreendimento.php';

require_once '../mensagem/ConstantesMensagem.php';
require_once '../mensagem/MensagemCache.php';
require_once '../variavel/VariavelCache.php';
require_once '../daofactory/DmlSql.php';

class MySqlKinghostUsuarioTipoEmpreendimentoDAO implements UsuarioTipoEmpreendimentoDAO
{
    private $daofactory;

    function __construct($daofactory)
    {
        $this->daofactory = $daofactory;
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
        $sql = DmlSqlUsuarioTipoEmpreendimento::SELECT_MAX_PK . ' WHERE ' 
        . DmlSqlUsuarioTipoEmpreendimento::USUA_ID . " = $idUsuario "
        . " AND " . DmlSqlUsuarioTipoEmpreendimento::USTE_IN_STATUS . " = '$status'";

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
* listAll() - Lista todos os registros provenientes de USUARIO_TIPO_EMPREENDIMENTO sem critério de paginação
*
* @return List<UsuarioTipoEmpreendimentoDTO>[]
*/ 
    public function listAll()   {   }

/**
* update() - atualiza apenas um registro com base no dto UsuarioTipoEmpreendimentoDTO->id
* @param $daofactory
*
* @return boolean
*/ 
    public function update($dto)
    {   
        $retorno = false;

        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $stmt = $conexao->prepare(DmlSqlUsuarioTipoEmpreendimento::UPD_PK);
        $stmt->bind_param(DmlSql::INTEGER_TYPE 
                            . DmlSql::INTEGER_TYPE 
                            . DmlSql::INTEGER_TYPE 
                            ,$dto->idUsuario
                            ,$dto->idTipoEmpreendimento
                            ,$dto->id );
        if ($stmt->execute())
        {
            $retorno = true;
        }

        return $retorno;
    }

/**
* delete() - excluir fisicamente um registro com base no dto UsuarioTipoEmpreendimentoDTO->id
*
* @return boolean
*/ 
    public function delete($dto)
    {   
        $retorno = false;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $stmt = $conexao->prepare(DmlSqlUsuarioTipoEmpreendimento::DEL_PK);
        $stmt->bind_param(DmlSql::INTEGER_TYPE
                            ,$dto->id);
        if ($stmt->execute())
        {
            $retorno = true;
        }

        return $retorno;
    }


    public function listUsuarioTipoEmpreendimentoStatus($status)
    {
        $retorno = array();

        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $res = $conexao->query(DmlSqlUsuarioTipoEmpreendimento::SELECT . 'WHERE `' . DmlSqlUsuarioTipoEmpreendimento::USTE_IN_STATUS . "` = '$status'" );
        if ($res){
            while ($row = $res->fetch_assoc()) {
                array_push($retorno, $this->getDTO($row));
            }
        }
        return $retorno;
    }

/**
* countUsuarioTipoEmpreendimentoPorStatus() - contar a quantidade de registros
* sob o contexto da classe UsuarioTipoEmpreendimento com base no status específico. 
*
* Atenção em @see $sql na tabela USUARIO_TIPO_EMPREENDIMENTO 
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

    public function countUsuarioTipoEmpreendimentoPorStatus($status)
    {   
        $retorno = 0;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $res = $conexao->query(DmlSqlUsuarioTipoEmpreendimento::SQL_COUNT . ' WHERE ' 
        . DmlSqlUsuarioTipoEmpreendimento::USTE_IN_STATUS . " = '$status'"
        );
        if ($res){
            $tmp = $res->fetch_assoc();
            $retorno = $tmp['contador'];
        }
        return $retorno;

    }

/**
* listUsuarioTipoEmpreendimentoPorStatus() - Listar um conjunto de registro previamente paginado
* sob o contexto da classe UsuarioTipoEmpreendimento com base no status específico.
*
* Atenção em @see $sql na tabela USUARIO_TIPO_EMPREENDIMENTO 
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

    public function listUsuarioTipoEmpreendimentoPorStatus($status, $pag, $qtde, $coluna, $ordem)
    {
        $sql = DmlSqlUsuarioTipoEmpreendimento::SELECT 
        . ' WHERE ' . DmlSqlUsuarioTipoEmpreendimento::USTE_IN_STATUS . " = '$status'"
        . ' ORDER BY ' . $coluna . ($ordem == 0 ? " ASC": " DESC");
        return $this->listPagina($sql, $pag, $qtde);
    }

/**
* countUsuarioTipoEmpreendimentoPorUsuaIdStatus() - contar a quantidade de registros
* sob o contexto da classe UsuarioTipoEmpreendimento com base no usuário específico. Esse usuário
* é o usuário logado na sessão ou no próprio dispositivo móvel e de acordo com a 
* query em @see $sql na tabela USUARIO_TIPO_EMPREENDIMENTO 
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

    public function countUsuarioTipoEmpreendimentoPorUsuaIdStatus($usuaid, $status)
    {   
        $retorno = 0;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $res = $conexao->query(DmlSqlUsuarioTipoEmpreendimento::SQL_COUNT . ' WHERE ' 
        . DmlSqlUsuarioTipoEmpreendimento::USUA_ID . " = $usuaid "
        . ' AND ' . DmlSqlUsuarioTipoEmpreendimento::USTE_IN_STATUS . " = '$status'"
        );
        if ($res){
            $tmp = $res->fetch_assoc();
            $retorno = $tmp['contador'];
        }
        return $retorno;

    }

/**
* listUsuarioTipoEmpreendimentoPorUsuaIdStatus() - Listar um conjunto de registro previamente paginado
* sob o contexto da classe UsuarioTipoEmpreendimento com base no usuário específico. Esse usuário
* é o usuário logado na sessão ou no próprio dispositivo móvel e de acordo com a 
* query em @see $sql na tabela USUARIO_TIPO_EMPREENDIMENTO 
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
    public function listUsuarioTipoEmpreendimentoPorUsuaIdStatus($usuaid, $status, $pag, $qtde, $coluna, $ordem)
    {
        $sql = DmlSqlUsuarioTipoEmpreendimento::SELECT 
        . ' WHERE ' . DmlSqlUsuarioTipoEmpreendimento::USUA_ID . " = $usuaid "
        . ' AND ' . DmlSqlUsuarioTipoEmpreendimento::USTE_IN_STATUS . " = '$status'"
        . ' ORDER BY ' . $coluna . ($ordem == 0 ? " ASC": " DESC");
        return $this->listPagina($sql, $pag, $qtde);
    }

/**
* listPagina() - Listar um conjunto de registro previamente paginado
* e de acordo com a query em @see $sql na tabela USUARIO_TIPO_EMPREENDIMENTO 
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
* na tabela USUARIO_TIPO_EMPREENDIMENTO usando a Primary Key USTE_ID
*
* @param $id
* @return UsuarioTipoEmpreendimentoDTO
*/ 
    public function loadPK($id)
    {   
        $retorno = NULL;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $res = $conexao->query(DmlSqlUsuarioTipoEmpreendimento::SELECT . ' WHERE ' . DmlSqlUsuarioTipoEmpreendimento::USTE_ID . '=' . $id );
        if ($res->num_rows > 0){
            $retorno = $this->getDTO($res->fetch_assoc());
        }
        return $retorno;
    }

/**
* updateStatus() - atualizar o campo de STATUS utilizando a id como item de busca
* na tabela USUARIO_TIPO_EMPREENDIMENTO usando a Primary Key USTE_ID
*
* @param $id
* @param $status
*
* @return UsuarioTipoEmpreendimentoDTO
*/ 
    public function updateStatus($id, $status)
    {   
        $retorno = false;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $stmt = $conexao->prepare(DmlSqlUsuarioTipoEmpreendimento::UPD_STATUS);
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
* insert() - inserir um registro com base no UsuarioTipoEmpreendimentoDTO. Alguns atributos dentro do DTO
* serão ignorados caso estejam populados, pois os mesmos possuem constraint de DEFAULT value
* ou campos de AUTO INCREMENTO já previamente definidos no DDL de criação de tabelas do BD.
*
* Atributos da classe UsuarioTipoEmpreendimentoDTO sumariamente IGNORADOS por este método MESMO que estejam preenchidos:
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
        $stmt = $conexao->prepare(DmlSqlUsuarioTipoEmpreendimento::INS);
        $stmt->bind_param(DmlSql::INTEGER_TYPE 
                            . DmlSql::INTEGER_TYPE 
                            ,$dto->idUsuario
                            ,$dto->idTipoEmpreendimento
        );
        if ($stmt->execute())
        {
            $retorno = true;
        }

        return $retorno;
    }

    /**
     * getDTO() - Transforma o resultset padrão em UsuarioTipoEmpreendimentoDTO
    */
    public function getDTO($resultset)
    {
        if(is_null($resultset)){
            return NULL;
        }

        //echo var_dump($resultset); // ótimo pra debugar
        $retorno = new UsuarioTipoEmpreendimentoDTO();
        $retorno->id = $resultset[DmlSqlUsuarioTipoEmpreendimento::USTE_ID] == NULL ? NULL : $resultset[DmlSqlUsuarioTipoEmpreendimento::USTE_ID];
        $retorno->idUsuario = $resultset[DmlSqlUsuarioTipoEmpreendimento::USUA_ID] == NULL ? NULL : $resultset[DmlSqlUsuarioTipoEmpreendimento::USUA_ID];
        $retorno->idTipoEmpreendimento = $resultset[DmlSqlUsuarioTipoEmpreendimento::TIEM_ID] == NULL ? NULL : $resultset[DmlSqlUsuarioTipoEmpreendimento::TIEM_ID];
        $retorno->status = $resultset[DmlSqlUsuarioTipoEmpreendimento::USTE_IN_STATUS] == NULL ? NULL : $resultset[DmlSqlUsuarioTipoEmpreendimento::USTE_IN_STATUS];
        $retorno->dataCadastro = Util::MySQLDate_to_DMYHMiS($resultset[DmlSqlUsuarioTipoEmpreendimento::USTE_DT_CADASTRO]);
        $retorno->dataAtualizacao = Util::MySQLDate_to_DMYHMiS($resultset[DmlSqlUsuarioTipoEmpreendimento::USTE_DT_UPDATE]);
        $retorno->statusdesc = VariavelCache::getInstance()->getStatusDesc($retorno->status);
        $retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
        $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);
        return $retorno;

    }

    /**
    * updateIdusuario() - implementação da assinatura em UsuarioTipoEmpreendimentoDAO
    */
    public function updateIdusuario($id, $idUsuario)
    {   
        $retorno = false;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $stmt = $conexao->prepare(DmlSqlUsuarioTipoEmpreendimento::UPD_USUARIO_TIPO_EMPREENDIMENTO_USUA_ID_PK);
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
    * updateIdtipoempreendimento() - implementação da assinatura em UsuarioTipoEmpreendimentoDAO
    */
    public function updateIdtipoempreendimento($id, $idTipoEmpreendimento)
    {   
        $retorno = false;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $stmt = $conexao->prepare(DmlSqlUsuarioTipoEmpreendimento::UPD_USUARIO_TIPO_EMPREENDIMENTO_TIEM_ID_PK);
        $stmt->bind_param(DmlSql::INTEGER_TYPE 
                            . DmlSql::INTEGER_TYPE
                            ,$idTipoEmpreendimento
                            ,$id);
        if ($stmt->execute())
        {
            $retorno = true;
        }

        return $retorno;
    }

    /**
    * loadIdusuario() - implementação da assinatura em UsuarioTipoEmpreendimentoDAO
    */

    public function loadIdusuario($idUsuario)
    {   
        $retorno = NULL;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $res = $conexao->query(DmlSqlUsuarioTipoEmpreendimento::SELECT . ' WHERE ' . DmlSqlUsuarioTipoEmpreendimento::USUA_ID . '=' . $idUsuario );
        if ($res){
            $retorno = $this->getDTO($res->fetch_assoc());
        }
        return $retorno;
    }

    /**
    * loadIdtipoempreendimento() - implementação da assinatura em UsuarioTipoEmpreendimentoDAO
    */

    public function loadIdtipoempreendimento($idTipoEmpreendimento)
    {   
        $retorno = NULL;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $res = $conexao->query(DmlSqlUsuarioTipoEmpreendimento::SELECT . ' WHERE ' . DmlSqlUsuarioTipoEmpreendimento::TIEM_ID . '=' . $idTipoEmpreendimento );
        if ($res){
            $retorno = $this->getDTO($res->fetch_assoc());
        }
        return $retorno;
    }

    /**
    * loadStatus() - implementação da assinatura em UsuarioTipoEmpreendimentoDAO
    */

    public function loadStatus($status)
    {   
        $retorno = NULL;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $res = $conexao->query(DmlSqlUsuarioTipoEmpreendimento::SELECT . ' WHERE ' . DmlSqlUsuarioTipoEmpreendimento::USTE_IN_STATUS . '=' . $status );
        if ($res){
            $retorno = $this->getDTO($res->fetch_assoc());
        }
        return $retorno;
    }

    /**
    * loadDatacadastro() - implementação da assinatura em UsuarioTipoEmpreendimentoDAO
    */

    public function loadDatacadastro($dataCadastro)
    {   
        $retorno = NULL;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $res = $conexao->query(DmlSqlUsuarioTipoEmpreendimento::SELECT . ' WHERE ' . DmlSqlUsuarioTipoEmpreendimento::USTE_DT_CADASTRO . '=' . $dataCadastro );
        if ($res){
            $retorno = $this->getDTO($res->fetch_assoc());
        }
        return $retorno;
    }

    /**
    * loadDataatualizacao() - implementação da assinatura em UsuarioTipoEmpreendimentoDAO
    */

    public function loadDataatualizacao($dataAtualizacao)
    {   
        $retorno = NULL;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $res = $conexao->query(DmlSqlUsuarioTipoEmpreendimento::SELECT . ' WHERE ' . DmlSqlUsuarioTipoEmpreendimento::USTE_DT_UPDATE . '=' . $dataAtualizacao );
        if ($res){
            $retorno = $this->getDTO($res->fetch_assoc());
        }
        return $retorno;
    }

}
?>




