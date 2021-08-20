<?php

/**
* MySqlKinghostGrupoAdminFuncoesAdminUsuarioDAO - Implementação DAO
*
* Classe de com todos os comandos DML e DDL (se necessário) para apoio 
* a classe MySqlKinghostGrupoAdminFuncoesAdminUsuarioDAO
* Não é uma camada visível para outros dispositivos, como as camadas de apresentação e aplicação. 
*
*
* Tabela principal de atuação: SEGLOG_GRUPO_ADM_FUNCAO_ADM_USUARIO
*
* Changelog:
*
* 
* @author Julio Cesar Vitorino
* @since 23/08/2019 10:06:20
*
*/
require_once 'GrupoAdminFuncoesAdminUsuarioDTO.php';
require_once 'GrupoAdminFuncoesAdminUsuarioDAO.php';
require_once 'DmlSqlGrupoAdminFuncoesAdminUsuario.php';

require_once '../mensagem/ConstantesMensagem.php';
require_once '../mensagem/MensagemCache.php';
require_once '../variavel/VariavelCache.php';
require_once '../daofactory/DmlSql.php';

class MySqlKinghostGrupoAdminFuncoesAdminUsuarioDAO implements GrupoAdminFuncoesAdminUsuarioDAO
{
    private $daofactory;

    function __construct($daofactory)
    {
        $this->daofactory = $daofactory;
    }


/**
* loadMaxIdgrupoadmfuncoesadmPK() - Carrega um MaxID (pk) para um ${CAMPO} e status
*
* @param $idGrupoAdmFuncoesAdm
* @param $status
* @return $dto
*/ 

    public function loadMaxIdgrupoadmfuncoesadmPK($idGrupoAdmFuncoesAdm,$status)
    {   
        $retorno = 0;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $sql = DmlSqlGrupoAdminFuncoesAdminUsuario::SELECT_MAX_PK . ' WHERE ' 
        . DmlSqlGrupoAdminFuncoesAdminUsuario::GAFA_ID . " = $idGrupoAdmFuncoesAdm "
        . " AND " . DmlSqlGrupoAdminFuncoesAdminUsuario::GAFAU_IN_STATUS . " = '$status'";

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
* listAll() - Lista todos os registros provenientes de SEGLOG_GRUPO_ADM_FUNCAO_ADM_USUARIO sem critério de paginação
*
* @return List<GrupoAdminFuncoesAdminUsuarioDTO>[]
*/ 
    public function listAll()   {   }

/**
* update() - atualiza apenas um registro com base no dto GrupoAdminFuncoesAdminUsuarioDTO->id
* @param $daofactory
*
* @return boolean
*/ 
    public function update($dto)
    {   
        $retorno = false;

        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $stmt = $conexao->prepare(DmlSqlGrupoAdminFuncoesAdminUsuario::UPD_PK);
        $stmt->bind_param(DmlSql::INTEGER_TYPE 
                            . DmlSql::INTEGER_TYPE 
                            . DmlSql::INTEGER_TYPE 
                            ,$dto->idGrupoAdmFuncoesAdm
                            ,$dto->id_usuario
                            ,$dto->id );
        if ($stmt->execute())
        {
            $retorno = true;
        }

        return $retorno;
    }

/**
* delete() - excluir fisicamente um registro com base no dto GrupoAdminFuncoesAdminUsuarioDTO->id
*
* @return boolean
*/ 
    public function delete($dto)
    {   
        $retorno = false;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $stmt = $conexao->prepare(DmlSqlGrupoAdminFuncoesAdminUsuario::DEL_PK);
        $stmt->bind_param(DmlSql::INTEGER_TYPE
                            ,$dto->id);
        if ($stmt->execute())
        {
            $retorno = true;
        }

        return $retorno;
    }


    public function listGrupoAdminFuncoesAdminUsuarioStatus($status)
    {
        $retorno = array();

        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $res = $conexao->query(DmlSqlGrupoAdminFuncoesAdminUsuario::SELECT . 'WHERE `' . DmlSqlGrupoAdminFuncoesAdminUsuario::GAFAU_IN_STATUS . "` = '$status'" );
        if ($res){
            while ($row = $res->fetch_assoc()) {
                array_push($retorno, $this->getDTO($row));
            }
        }
        return $retorno;
    }

/**
* countGrupoAdminFuncoesAdminUsuarioPorStatus() - contar a quantidade de registros
* sob o contexto da classe GrupoAdminFuncoesAdminUsuario com base no status específico. 
*
* Atenção em @see $sql na tabela SEGLOG_GRUPO_ADM_FUNCAO_ADM_USUARIO 
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

    public function countGrupoAdminFuncoesAdminUsuarioPorStatus($status)
    {   
        $retorno = 0;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $res = $conexao->query(DmlSqlGrupoAdminFuncoesAdminUsuario::SQL_COUNT . ' WHERE ' 
        . DmlSqlGrupoAdminFuncoesAdminUsuario::GAFAU_IN_STATUS . " = '$status'"
        );
        if ($res){
            $tmp = $res->fetch_assoc();
            $retorno = $tmp['contador'];
        }
        return $retorno;

    }

/**
* listGrupoAdminFuncoesAdminUsuarioPorStatus() - Listar um conjunto de registro previamente paginado
* sob o contexto da classe GrupoAdminFuncoesAdminUsuario com base no status específico.
*
* Atenção em @see $sql na tabela SEGLOG_GRUPO_ADM_FUNCAO_ADM_USUARIO 
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

    public function listGrupoAdminFuncoesAdminUsuarioPorStatus($status, $pag, $qtde, $coluna, $ordem)
    {
        $sql = DmlSqlGrupoAdminFuncoesAdminUsuario::SELECT 
        . ' WHERE ' . DmlSqlGrupoAdminFuncoesAdminUsuario::GAFAU_IN_STATUS . " = '$status'"
        . ' ORDER BY ' . $coluna . ($ordem == 0 ? " ASC": " DESC");
        return $this->listPagina($sql, $pag, $qtde);
    }

/**
* countGrupoAdminFuncoesAdminUsuarioPorUsuaIdStatus() - contar a quantidade de registros
* sob o contexto da classe GrupoAdminFuncoesAdminUsuario com base no usuário específico. Esse usuário
* é o usuário logado na sessão ou no próprio dispositivo móvel e de acordo com a 
* query em @see $sql na tabela SEGLOG_GRUPO_ADM_FUNCAO_ADM_USUARIO 
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

    public function countGrupoAdminFuncoesAdminUsuarioPorUsuaIdStatus($usuaid, $status)
    {   
        $retorno = 0;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $res = $conexao->query(DmlSqlGrupoAdminFuncoesAdminUsuario::SQL_COUNT . ' WHERE ' 
        . DmlSqlGrupoAdminFuncoesAdminUsuario::USUA_ID . " = $usuaid "
        . ' AND ' . DmlSqlGrupoAdminFuncoesAdminUsuario::GAFAU_IN_STATUS . " = '$status'"
        );
        if ($res){
            $tmp = $res->fetch_assoc();
            $retorno = $tmp['contador'];
        }
        return $retorno;

    }

/**
* listGrupoAdminFuncoesAdminUsuarioPorUsuaIdStatus() - Listar um conjunto de registro previamente paginado
* sob o contexto da classe GrupoAdminFuncoesAdminUsuario com base no usuário específico. Esse usuário
* é o usuário logado na sessão ou no próprio dispositivo móvel e de acordo com a 
* query em @see $sql na tabela SEGLOG_GRUPO_ADM_FUNCAO_ADM_USUARIO 
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
    public function listGrupoAdminFuncoesAdminUsuarioPorUsuaIdStatus($usuaid, $status, $pag, $qtde, $coluna, $ordem)
    {
        $sql = DmlSqlGrupoAdminFuncoesAdminUsuario::SELECT 
        . ' WHERE ' . DmlSqlGrupoAdminFuncoesAdminUsuario::USUA_ID . " = $usuaid "
        . ' AND ' . DmlSqlGrupoAdminFuncoesAdminUsuario::GAFAU_IN_STATUS . " = '$status'"
        . ' ORDER BY ' . $coluna . ($ordem == 0 ? " ASC": " DESC");
        return $this->listPagina($sql, $pag, $qtde);
    }

/**
* listPagina() - Listar um conjunto de registro previamente paginado
* e de acordo com a query em @see $sql na tabela SEGLOG_GRUPO_ADM_FUNCAO_ADM_USUARIO 
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
* na tabela SEGLOG_GRUPO_ADM_FUNCAO_ADM_USUARIO usando a Primary Key GAFAU_ID
*
* @param $id
* @return GrupoAdminFuncoesAdminUsuarioDTO
*/ 
    public function loadPK($id)
    {   
        $retorno = NULL;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $res = $conexao->query(DmlSqlGrupoAdminFuncoesAdminUsuario::SELECT . ' WHERE ' . DmlSqlGrupoAdminFuncoesAdminUsuario::GAFAU_ID . '=' . $id );
        if ($res->num_rows > 0){
            $retorno = $this->getDTO($res->fetch_assoc());
        }
        return $retorno;
    }

/**
* updateStatus() - atualizar o campo de STATUS utilizando a id como item de busca
* na tabela SEGLOG_GRUPO_ADM_FUNCAO_ADM_USUARIO usando a Primary Key GAFAU_ID
*
* @param $id
* @param $status
*
* @return GrupoAdminFuncoesAdminUsuarioDTO
*/ 
    public function updateStatus($id, $status)
    {   
        $retorno = false;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $stmt = $conexao->prepare(DmlSqlGrupoAdminFuncoesAdminUsuario::UPD_STATUS);
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
* insert() - inserir um registro com base no GrupoAdminFuncoesAdminUsuarioDTO. Alguns atributos dentro do DTO
* serão ignorados caso estejam populados, pois os mesmos possuem constraint de DEFAULT value
* ou campos de AUTO INCREMENTO já previamente definidos no DDL de criação de tabelas do BD.
*
* Atributos da classe GrupoAdminFuncoesAdminUsuarioDTO sumariamente IGNORADOS por este método MESMO que estejam preenchidos:
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
        $stmt = $conexao->prepare(DmlSqlGrupoAdminFuncoesAdminUsuario::INS);
        $stmt->bind_param(DmlSql::INTEGER_TYPE 
                            . DmlSql::INTEGER_TYPE 
                            ,$dto->idGrupoAdmFuncoesAdm
                            ,$dto->id_usuario
        );
        if ($stmt->execute())
        {
            $retorno = true;
        }

        return $retorno;
    }

    /**
     * getDTO() - Transforma o resultset padrão em GrupoAdminFuncoesAdminUsuarioDTO
    */
    public function getDTO($resultset)
    {
        if(is_null($resultset)){
            return NULL;
        }

        //echo var_dump($resultset); // ótimo pra debugar
        $retorno = new GrupoAdminFuncoesAdminUsuarioDTO();
        $retorno->id = $resultset[DmlSqlGrupoAdminFuncoesAdminUsuario::GAFAU_ID] == NULL ? NULL : $resultset[DmlSqlGrupoAdminFuncoesAdminUsuario::GAFAU_ID];
        $retorno->idGrupoAdmFuncoesAdm = $resultset[DmlSqlGrupoAdminFuncoesAdminUsuario::GAFA_ID] == NULL ? NULL : $resultset[DmlSqlGrupoAdminFuncoesAdminUsuario::GAFA_ID];
        $retorno->id_usuario = $resultset[DmlSqlGrupoAdminFuncoesAdminUsuario::USUA_ID] == NULL ? NULL : $resultset[DmlSqlGrupoAdminFuncoesAdminUsuario::USUA_ID];
        $retorno->status = $resultset[DmlSqlGrupoAdminFuncoesAdminUsuario::GAFAU_IN_STATUS] == NULL ? NULL : $resultset[DmlSqlGrupoAdminFuncoesAdminUsuario::GAFAU_IN_STATUS];
        $retorno->dataCadastro = Util::MySQLDate_to_DMYHMiS($resultset[DmlSqlGrupoAdminFuncoesAdminUsuario::GAFAU_DT_CADASTRO]);
        $retorno->dataAtualizacao = Util::MySQLDate_to_DMYHMiS($resultset[DmlSqlGrupoAdminFuncoesAdminUsuario::GAFAU_DT_UPDATE]);
        $retorno->statusdesc = VariavelCache::getInstance()->getStatusDesc($retorno->status);
        $retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
        $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);
        return $retorno;

    }

    /**
    * updateIdgrupoadmfuncoesadm() - implementação da assinatura em GrupoAdminFuncoesAdminUsuarioDAO
    */
    public function updateIdgrupoadmfuncoesadm($id, $idGrupoAdmFuncoesAdm)
    {   
        $retorno = false;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $stmt = $conexao->prepare(DmlSqlGrupoAdminFuncoesAdminUsuario::UPD_SEGLOG_GRUPO_ADM_FUNCAO_ADM_USUARIO_GAFA_ID_PK);
        $stmt->bind_param(DmlSql::INTEGER_TYPE 
                            . DmlSql::INTEGER_TYPE
                            ,$idGrupoAdmFuncoesAdm
                            ,$id);
        if ($stmt->execute())
        {
            $retorno = true;
        }

        return $retorno;
    }

    /**
    * updateId_Usuario() - implementação da assinatura em GrupoAdminFuncoesAdminUsuarioDAO
    */
    public function updateId_Usuario($id, $id_usuario)
    {   
        $retorno = false;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $stmt = $conexao->prepare(DmlSqlGrupoAdminFuncoesAdminUsuario::UPD_SEGLOG_GRUPO_ADM_FUNCAO_ADM_USUARIO_USUA_ID_PK);
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
    * loadIdgrupoadmfuncoesadm() - implementação da assinatura em GrupoAdminFuncoesAdminUsuarioDAO
    */

    public function loadIdgrupoadmfuncoesadm($idGrupoAdmFuncoesAdm)
    {   
        $retorno = NULL;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $res = $conexao->query(DmlSqlGrupoAdminFuncoesAdminUsuario::SELECT . ' WHERE ' . DmlSqlGrupoAdminFuncoesAdminUsuario::GAFA_ID . '=' . $idGrupoAdmFuncoesAdm );
        if ($res){
            $retorno = $this->getDTO($res->fetch_assoc());
        }
        return $retorno;
    }

    /**
    * loadId_Usuario() - implementação da assinatura em GrupoAdminFuncoesAdminUsuarioDAO
    */

    public function loadId_Usuario($id_usuario)
    {   
        $retorno = NULL;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $res = $conexao->query(DmlSqlGrupoAdminFuncoesAdminUsuario::SELECT . ' WHERE ' . DmlSqlGrupoAdminFuncoesAdminUsuario::USUA_ID . '=' . $id_usuario );
        if ($res){
            $retorno = $this->getDTO($res->fetch_assoc());
        }
        return $retorno;
    }

    /**
    * loadStatus() - implementação da assinatura em GrupoAdminFuncoesAdminUsuarioDAO
    */

    public function loadStatus($status)
    {   
        $retorno = NULL;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $res = $conexao->query(DmlSqlGrupoAdminFuncoesAdminUsuario::SELECT . ' WHERE ' . DmlSqlGrupoAdminFuncoesAdminUsuario::GAFAU_IN_STATUS . '=' . $status );
        if ($res){
            $retorno = $this->getDTO($res->fetch_assoc());
        }
        return $retorno;
    }

    /**
    * loadDatacadastro() - implementação da assinatura em GrupoAdminFuncoesAdminUsuarioDAO
    */

    public function loadDatacadastro($dataCadastro)
    {   
        $retorno = NULL;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $res = $conexao->query(DmlSqlGrupoAdminFuncoesAdminUsuario::SELECT . ' WHERE ' . DmlSqlGrupoAdminFuncoesAdminUsuario::GAFAU_DT_CADASTRO . '=' . $dataCadastro );
        if ($res){
            $retorno = $this->getDTO($res->fetch_assoc());
        }
        return $retorno;
    }

    /**
    * loadDataatualizacao() - implementação da assinatura em GrupoAdminFuncoesAdminUsuarioDAO
    */

    public function loadDataatualizacao($dataAtualizacao)
    {   
        $retorno = NULL;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $res = $conexao->query(DmlSqlGrupoAdminFuncoesAdminUsuario::SELECT . ' WHERE ' . DmlSqlGrupoAdminFuncoesAdminUsuario::GAFAU_DT_UPDATE . '=' . $dataAtualizacao );
        if ($res){
            $retorno = $this->getDTO($res->fetch_assoc());
        }
        return $retorno;
    }

}
?>




