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
* MySqlKinghostUsuarioAutorizadorDAO - Implementação DAO
*
* Classe de com todos os comandos DML e DDL (se necessário) para apoio 
* a classe MySqlKinghostUsuarioAutorizadorDAO
* Não é uma camada visível para outros dispositivos, como as camadas de apresentação e aplicação. 
*
*
* Tabela principal de atuação: USUARIO_AUTORIZADOR
*
* Changelog:
*
* 
* @author Julio Cesar Vitorino
* @since 23/08/2019 10:06:20
*
*/
require_once 'UsuarioAutorizadorDTO.php';
require_once 'UsuarioAutorizadorDAO.php';
require_once 'UsuarioAutorizadorHelper.php';
require_once 'DmlSqlUsuarioAutorizador.php';

require_once '../variavel/VariavelCache.php';
require_once '../daofactory/DmlSql.php';
require_once '../mensagem/ConstantesMensagem.php';
require_once '../mensagem/MensagemCache.php';

class MySqlKinghostUsuarioAutorizadorDAO implements UsuarioAutorizadorDAO
{
    private $daofactory;

    function __construct($daofactory)
    {
        $this->daofactory = $daofactory;
    }

/**
* countUsuarioCarimbador() - contar a quantidade de registros
* sob o contexto da classe UsuarioAutorizador com base no usuário específico. Esse usuário
* é o usuário logado na sessão ou no próprio dispositivo móvel e de acordo com a 
* query em @see $sql na tabela USUARIO_AUTORIZADOR 
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

public function countUsuarioCarimbador($usuaid, $status)
{   
    $retorno = 0;
    // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
    $conexao = $this->daofactory->getSession();
    $sql=DmlSqlUsuarioAutorizador::SQL_COUNT  
    . ' WHERE ' . DmlSqlUsuarioAutorizador::USUA_ID . " = $usuaid "
    . ' AND ' . DmlSqlUsuarioAutorizador::USAU_IN_AUTORIZACAO . " = '00' "
    . ' AND ' . DmlSqlUsuarioAutorizador::USAU_IN_STATUS . " = '$status'";

    $res = $conexao->query($sql);
    if ($res){
        $tmp = $res->fetch_assoc();
        $retorno = $tmp['contador'];
    }
    return $retorno;

}


/**
* countUsuarioAutorizadorPorUsuaIdAutorizadorStatus() - contar a quantidade de registros
* sob o contexto da classe UsuarioAutorizador com base no usuário específico. Esse usuário
* é o usuário logado na sessão ou no próprio dispositivo móvel e de acordo com a 
* query em @see $sql na tabela USUARIO_AUTORIZADOR 
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

    public function countUsuarioAutorizadorPorUsuaIdAutorizadorStatus($usuaid, $status)
    {   
        $retorno = 0;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $sql=DmlSqlUsuarioAutorizador::SQL_COUNT . ' WHERE ' 
        . DmlSqlUsuarioAutorizador::USUA_ID_AUTORIZADOR . " = $usuaid "
        . ' AND ' . DmlSqlUsuarioAutorizador::USAU_IN_STATUS . " IN ($status)";

        $res = $conexao->query($sql);
        if ($res){
            $tmp = $res->fetch_assoc();
            $retorno = $tmp['contador'];
        }
        return $retorno;

    }

/**
* listUsuarioAutorizadorPorUsuaIdAutorizadorStatus() - Listar um conjunto de registro previamente paginado
* sob o contexto da classe UsuarioAutorizador com base no usuário específico. Esse usuário
* é o usuário logado na sessão ou no próprio dispositivo móvel e de acordo com a 
* query em @see $sql na tabela USUARIO_AUTORIZADOR 
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
    public function listUsuarioAutorizadorPorUsuaIdAutorizadorStatus($usuaid, $status, $pag, $qtde, $coluna, $ordem)
    {
        $sql = DmlSqlUsuarioAutorizador::SELECT 
        . ' WHERE ' . DmlSqlUsuarioAutorizador::USUA_ID_AUTORIZADOR . " = $usuaid "
        . ' AND ' . DmlSqlUsuarioAutorizador::USAU_IN_STATUS . " IN ($status) "
        . ' ORDER BY ' . $coluna . ($ordem == 0 ? " ASC": " DESC");

        return $this->listPagina($sql, $pag, $qtde);
    }


/**
* countUsuarioAutorizadorPorUsuaIdAutorizadorCampId() - contar a quantidade de registros
* sob o contexto da classe UsuarioAutorizador com base no usuário específico. Esse usuário
* é o usuário logado na sessão ou no próprio dispositivo móvel e de acordo com a 
* query em @see $sql na tabela USUARIO_AUTORIZADOR 
*
* @see listPagina()
*
* @param $usuaid
* @param $campid
* @param $status
* @param $pag
* @param $qtde
* @param $coluna
* @param $ordem
*
* @return PaginacaoDTO
*/ 

public function countUsuarioAutorizadorPorUsuaIdAutorizadorCampId($usuaid, $campid, $status)
{   
    $retorno = 0;
    // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
    $conexao = $this->daofactory->getSession();
    $sql=DmlSqlUsuarioAutorizador::SQL_COUNT . ' WHERE ' 
    . DmlSqlUsuarioAutorizador::USUA_ID_AUTORIZADOR . " = $usuaid "
    . ' AND ' . DmlSqlUsuarioAutorizador::CAMP_ID . " = $campid "
    . ' AND ' . DmlSqlUsuarioAutorizador::USAU_IN_STATUS . " IN ($status)";

    $res = $conexao->query($sql);
    if ($res){
        $tmp = $res->fetch_assoc();
        $retorno = $tmp['contador'];
    }
    return $retorno;

}

/**
* listUsuarioAutorizadorPorUsuaIdAutorizadorCampId() - Listar um conjunto de registro previamente paginado
* sob o contexto da classe UsuarioAutorizador com base no usuário específico. Esse usuário
* é o usuário logado na sessão ou no próprio dispositivo móvel e de acordo com a 
* query em @see $sql na tabela USUARIO_AUTORIZADOR 
*
* @see listPagina()
*
* @param $usuaid
* @param $campid
* @param $status
* @param $pag
* @param $qtde
* @param $coluna
* @param $ordem
*
* @return PaginacaoDTO
*/ 
public function listUsuarioAutorizadorPorUsuaIdAutorizadorCampId($usuaid, $campid, $status, $pag, $qtde, $coluna, $ordem)
{
    $sql = DmlSqlUsuarioAutorizador::SELECT 
    . ' WHERE ' . DmlSqlUsuarioAutorizador::USUA_ID_AUTORIZADOR . " = $usuaid "
    . ' AND ' . DmlSqlUsuarioAutorizador::CAMP_ID . " = $campid "
    . ' AND ' . DmlSqlUsuarioAutorizador::USAU_IN_STATUS . " IN ($status) "
    . ' ORDER BY ' . $coluna . ($ordem == 0 ? " ASC": " DESC");
    return $this->listPagina($sql, $pag, $qtde);
}


/**
* listUsuarioCarimbador() - Listar um conjunto de registro previamente paginado
* sob o contexto da classe UsuarioAutorizador com base no usuário específico. Esse usuário
* é o usuário logado na sessão ou no próprio dispositivo móvel e de acordo com a 
* query em @see $sql na tabela USUARIO_AUTORIZADOR 
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
public function listUsuarioCarimbador($usuaid, $status, $pag, $qtde, $coluna, $ordem) 
{
    $sql = DmlSqlUsuarioAutorizador::SELECT 
    . ' WHERE ' . DmlSqlUsuarioAutorizador::USUA_ID . " = $usuaid "
    . ' AND ' . DmlSqlUsuarioAutorizador::USAU_IN_AUTORIZACAO . " = '00' "
    . ' AND ' . DmlSqlUsuarioAutorizador::USAU_IN_STATUS . " = '$status' "
    . ' ORDER BY ' . $coluna . ($ordem == 0 ? " ASC": " DESC");

    return $this->listPagina($sql, $pag, $qtde);
}



/**
* loadMaxId_UsuarioCarimbadorPK() - Carrega um MaxID (pk) para um ${CAMPO} e status
*
* @param $id_usuario
* @param $id_campanha
* @param $status
* @return $dto
*/ 
public function  loadMaxId_UsuarioCarimbadorPK($id_usuario,$id_campanha,$status)
{   
    $retorno = 0;
    // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
    $conexao = $this->daofactory->getSession();
    $sql = DmlSqlUsuarioAutorizador::SELECT_MAX_PK 
    . ' WHERE ' . DmlSqlUsuarioAutorizador::USUA_ID . " = $id_usuario "
    . ' AND ' . DmlSqlUsuarioAutorizador::CAMP_ID . " = $id_campanha "
    . ' AND ' . DmlSqlUsuarioAutorizador::USAU_IN_AUTORIZACAO . " = '00' "
    . " AND " . DmlSqlUsuarioAutorizador::USAU_IN_STATUS . " = '$status'";
//var_dump($sql);
    $res = $conexao->query($sql);
    if ($res){
        $tmp = $res->fetch_assoc();
        $retorno = $tmp['maxid'] == NULL ? 0 : $tmp['maxid'];
    }
    return $retorno;

}



/**
* loadMaxId_UsuarioPK() - Carrega um MaxID (pk) para um ${CAMPO} e status
*
* @param $id_usuario
* @param $id_campanha
* @param $status
* @return $dto
*/ 
    public function loadMaxId_UsuarioAutorizadorPK($id_usuario,$id_campanha, $status)
    {   
        $retorno = 0;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $sql = DmlSqlUsuarioAutorizador::SELECT_MAX_PK . ' WHERE ' 
        . DmlSqlUsuarioAutorizador::USUA_ID_AUTORIZADOR . " = $id_usuario "
        . ' AND ' . DmlSqlUsuarioAutorizador::CAMP_ID . " = $id_campanha "
        . " AND " . DmlSqlUsuarioAutorizador::USAU_IN_STATUS . " = '$status'";

        $res = $conexao->query($sql);
        if ($res){
            $tmp = $res->fetch_assoc();
            $retorno = $tmp['maxid'] == NULL ? 0 : $tmp['maxid'];
        }
        return $retorno;

    }


/**
* loadMaxId_UsuarioPK() - Carrega um MaxID (pk) para um ${CAMPO} e status
*
* @param $id_usuario
* @param $status
* @return $dto
*/ 

    public function loadMaxId_UsuarioPK($id_usuario,$status)
    {   
        $retorno = 0;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $sql = DmlSqlUsuarioAutorizador::SELECT_MAX_PK . ' WHERE ' 
        . DmlSqlUsuarioAutorizador::USUA_ID . " = $id_usuario "
        . " AND " . DmlSqlUsuarioAutorizador::USCA_IN_STATUS . " = '$status'";

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
* listAll() - Lista todos os registros provenientes de USUARIO_AUTORIZADOR sem critério de paginação
*
* @return List<UsuarioAutorizadorDTO>[]
*/ 
    public function listAll()   {   }

/**
* update() - atualiza apenas um registro com base no dto UsuarioAutorizadorDTO->id
* @param $daofactory
*
* @return boolean
*/ 
    public function update($dto)
    {   
        $retorno = false;

        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $stmt = $conexao->prepare(DmlSqlUsuarioAutorizador::UPD_PK);
        $stmt->bind_param(DmlSql::STRING_TYPE 
                            . DmlSql::STRING_TYPE 
                            . DmlSql::STRING_TYPE 
                            . DmlSql::STRING_TYPE 
                            . DmlSql::INTEGER_TYPE 
                            ,$dto->tipo
                            ,$dto->permissao
                            ,$dto->dataInicio
                            ,$dto->dataTermino
                            ,$dto->id );
        if ($stmt->execute())
        {
            $retorno = true;
        }

        return $retorno;
    }

/**
* delete() - excluir fisicamente um registro com base no dto UsuarioAutorizadorDTO->id
*
* @return boolean
*/ 
    public function delete($dto)
    {   
        $retorno = false;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $stmt = $conexao->prepare(DmlSqlUsuarioAutorizador::DEL_PK);
        $stmt->bind_param(DmlSql::INTEGER_TYPE
                            ,$dto->id);
        if ($stmt->execute())
        {
            $retorno = true;
        }

        return $retorno;
    }


    public function listUsuarioAutorizadorStatus($status)
    {
        $retorno = array();

        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $res = $conexao->query(DmlSqlUsuarioAutorizador::SELECT . 'WHERE `' . DmlSqlUsuarioAutorizador::USAU_IN_STATUS . "` = '$status'" );
        if ($res){
            while ($row = $res->fetch_assoc()) {
                array_push($retorno, $this->getDTO($row));
            }
        }
        return $retorno;
    }

/**
* countUsuarioAutorizadorPorStatus() - contar a quantidade de registros
* sob o contexto da classe UsuarioAutorizador com base no status específico. 
*
* Atenção em @see $sql na tabela USUARIO_AUTORIZADOR 
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

    public function countUsuarioAutorizadorPorStatus($status)
    {   
        $retorno = 0;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $res = $conexao->query(DmlSqlUsuarioAutorizador::SQL_COUNT . ' WHERE ' 
        . DmlSqlUsuarioAutorizador::USAU_IN_STATUS . " = '$status'"
        );
        if ($res){
            $tmp = $res->fetch_assoc();
            $retorno = $tmp['contador'];
        }
        return $retorno;

    }

/**
* listUsuarioAutorizadorPorStatus() - Listar um conjunto de registro previamente paginado
* sob o contexto da classe UsuarioAutorizador com base no status específico.
*
* Atenção em @see $sql na tabela USUARIO_AUTORIZADOR 
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

    public function listUsuarioAutorizadorPorStatus($status, $pag, $qtde, $coluna, $ordem)
    {
        $sql = DmlSqlUsuarioAutorizador::SELECT 
        . ' WHERE ' . DmlSqlUsuarioAutorizador::USAU_IN_STATUS . " = '$status'"
        . ' ORDER BY ' . $coluna . ($ordem == 0 ? " ASC": " DESC");
        return $this->listPagina($sql, $pag, $qtde);
    }

/**
* countUsuarioAutorizadorPorUsuaIdStatus() - contar a quantidade de registros
* sob o contexto da classe UsuarioAutorizador com base no usuário específico. Esse usuário
* é o usuário logado na sessão ou no próprio dispositivo móvel e de acordo com a 
* query em @see $sql na tabela USUARIO_AUTORIZADOR 
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

    public function countUsuarioAutorizadorPorUsuaIdStatus($usuaid, $status)
    {   
        $retorno = 0;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $res = $conexao->query(DmlSqlUsuarioAutorizador::SQL_COUNT . ' WHERE ' 
        . DmlSqlUsuarioAutorizador::USUA_ID . " = $usuaid "
        . ' AND ' . DmlSqlUsuarioAutorizador::USAU_IN_STATUS . " = '$status'"
        );
        if ($res){
            $tmp = $res->fetch_assoc();
            $retorno = $tmp['contador'];
        }
        return $retorno;

    }

/**
* listUsuarioAutorizadorPorUsuaIdStatus() - Listar um conjunto de registro previamente paginado
* sob o contexto da classe UsuarioAutorizador com base no usuário específico. Esse usuário
* é o usuário logado na sessão ou no próprio dispositivo móvel e de acordo com a 
* query em @see $sql na tabela USUARIO_AUTORIZADOR 
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
    public function listUsuarioAutorizadorPorUsuaIdStatus($usuaid, $status, $pag, $qtde, $coluna, $ordem)
    {
        $sql = DmlSqlUsuarioAutorizador::SELECT 
        . ' WHERE ' . DmlSqlUsuarioAutorizador::USUA_ID . " = $usuaid "
        . ' AND ' . DmlSqlUsuarioAutorizador::USAU_IN_STATUS . " = '$status'"
        . ' ORDER BY ' . $coluna . ($ordem == 0 ? " ASC": " DESC");
        return $this->listPagina($sql, $pag, $qtde);
    }

/**
* listPagina() - Listar um conjunto de registro previamente paginado
* e de acordo com a query em @see $sql na tabela USUARIO_AUTORIZADOR 
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
* na tabela USUARIO_AUTORIZADOR usando a Primary Key USAU_ID
*
* @param $id
* @return UsuarioAutorizadorDTO
*/ 
    public function loadPK($id)
    {   
        $retorno = NULL;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $res = $conexao->query(DmlSqlUsuarioAutorizador::SELECT . ' WHERE ' . DmlSqlUsuarioAutorizador::USAU_ID . '=' . $id );
        if ($res){
            $retorno = $this->getDTO($res->fetch_assoc());
        }
        return $retorno;
    }

/**
* updateStatus() - atualizar o campo de STATUS utilizando a id como item de busca
* na tabela USUARIO_AUTORIZADOR usando a Primary Key USAU_ID
*
* @param $id
* @param $status
*
* @return UsuarioAutorizadorDTO
*/ 
    public function updateStatus($id, $status)
    {   

        $retorno = false;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $stmt = $conexao->prepare(DmlSqlUsuarioAutorizador::UPD_STATUS);
        $stmt->bind_param(DmlSql::STRING_TYPE 
                            . DmlSql::STRING_TYPE 
                            ,$status
                            ,$id);
        if ($stmt->execute())
        {
            $retorno = true;
        } else {
            //echo mysqli_errno($conexao);
            //echo mysqli_error($conexao);
        }

        return $retorno;
    }

/**
* insert() - inserir um registro com base no UsuarioAutorizadorDTO. Alguns atributos dentro do DTO
* serão ignorados caso estejam populados, pois os mesmos possuem constraint de DEFAULT value
* ou campos de AUTO INCREMENTO já previamente definidos no DDL de criação de tabelas do BD.
*
* Atributos da classe UsuarioAutorizadorDTO sumariamente IGNORADOS por este método MESMO que estejam preenchidos:
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
        $stmt = $conexao->prepare(DmlSqlUsuarioAutorizador::INS);
        $stmt->bind_param(DmlSql::INTEGER_TYPE 
                            . DmlSql::INTEGER_TYPE 
                            . DmlSql::INTEGER_TYPE 
                            . DmlSql::STRING_TYPE 
                            . DmlSql::STRING_TYPE 
                            . DmlSql::STRING_TYPE 
                            . DmlSql::STRING_TYPE 
                            ,$dto->id_usuario
                            ,$dto->id_autorizador
                            ,$dto->id_campanha
                            ,$dto->tipo
                            ,$dto->permissao
                            ,$dto->dataInicio
                            ,$dto->dataTermino
        );
        if ($stmt->execute())
        {
            $retorno = true;
        } else {
            //var_dump(mysqli_error($conexao));
            //var_dump(mysqli_errno($conexao));
        }

        return $retorno;
    }

    /**
     * getDTO() - Transforma o resultset padrão em UsuarioAutorizadorDTO
    */
    public function getDTO($resultset)
    {
        //echo var_dump($resultset); // ótimo pra debugar
        $retorno = new UsuarioAutorizadorDTO();
        $retorno->id = $resultset[DmlSqlUsuarioAutorizador::USAU_ID] == NULL ? NULL : (int) $resultset[DmlSqlUsuarioAutorizador::USAU_ID];
        $retorno->id_usuario = $resultset[DmlSqlUsuarioAutorizador::USUA_ID] == NULL ? NULL : (int) $resultset[DmlSqlUsuarioAutorizador::USUA_ID];
        $retorno->id_autorizador = $resultset[DmlSqlUsuarioAutorizador::USUA_ID_AUTORIZADOR] == NULL ? NULL : (int) $resultset[DmlSqlUsuarioAutorizador::USUA_ID_AUTORIZADOR];
        $retorno->id_campanha = $resultset[DmlSqlUsuarioAutorizador::CAMP_ID] == NULL ? NULL : (int) $resultset[DmlSqlUsuarioAutorizador::CAMP_ID];
        $retorno->tipo = $resultset[DmlSqlUsuarioAutorizador::USAU_IN_TIPO] == NULL ? NULL : $resultset[DmlSqlUsuarioAutorizador::USAU_IN_TIPO];
        $retorno->tipostr = UsuarioAutorizadorHelper::getTraducaoTipo($retorno->tipo);
        $retorno->permissao = $resultset[DmlSqlUsuarioAutorizador::USAU_IN_AUTORIZACAO] == NULL ? NULL : $resultset[DmlSqlUsuarioAutorizador::USAU_IN_AUTORIZACAO];
        $retorno->permissaostr = UsuarioAutorizadorHelper::getTraducaoAutorizacao($retorno->permissao);
        $retorno->dataInicio = $resultset[DmlSqlUsuarioAutorizador::USAU_DT_INICIO] == NULL ? NULL : Util::MySQLDate_to_DMYHMiS($resultset[DmlSqlUsuarioAutorizador::USAU_DT_INICIO]);
        $retorno->dataTermino = $resultset[DmlSqlUsuarioAutorizador::USAU_DT_TERMINO] == NULL ? NULL : Util::MySQLDate_to_DMYHMiS($resultset[DmlSqlUsuarioAutorizador::USAU_DT_TERMINO]);
        $retorno->status = $resultset[DmlSqlUsuarioAutorizador::USAU_IN_STATUS] == NULL ? NULL : $resultset[DmlSqlUsuarioAutorizador::USAU_IN_STATUS];
        $retorno->dataCadastro = Util::MySQLDate_to_DMYHMiS($resultset[DmlSqlUsuarioAutorizador::USAU_DT_CADASTRO]);
        $retorno->dataAtualizacao = Util::MySQLDate_to_DMYHMiS($resultset[DmlSqlUsuarioAutorizador::USAU_DT_UPDATE]);
        $retorno->statusdesc = VariavelCache::getInstance()->getStatusDesc($retorno->status);
        $retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
        $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);
        
        return $retorno;

    }

    /**
    * updateId_Usuario() - implementação da assinatura em UsuarioAutorizadorDAO
    */
    public function updateId_Usuario($id, $id_usuario)
    {   
        $retorno = false;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $stmt = $conexao->prepare(DmlSqlUsuarioAutorizador::UPD_USUARIO_AUTORIZADOR_USUA_ID_PK);
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
    * updateId_Autorizador() - implementação da assinatura em UsuarioAutorizadorDAO
    */
    public function updateId_Autorizador($id, $id_autorizador)
    {   
        $retorno = false;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $stmt = $conexao->prepare(DmlSqlUsuarioAutorizador::UPD_USUARIO_AUTORIZADOR_USUA_ID_AUTORIZADOR_PK);
        $stmt->bind_param(DmlSql::INTEGER_TYPE 
                            . DmlSql::INTEGER_TYPE
                            ,$id_autorizador
                            ,$id);
        if ($stmt->execute())
        {
            $retorno = true;
        }

        return $retorno;
    }

    /**
    * updateId_Campanha() - implementação da assinatura em UsuarioAutorizadorDAO
    */
    public function updateId_Campanha($id, $id_campanha)
    {   
        $retorno = false;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $stmt = $conexao->prepare(DmlSqlUsuarioAutorizador::UPD_USUARIO_AUTORIZADOR_CAMP_ID_PK);
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
    * updateTipo() - implementação da assinatura em UsuarioAutorizadorDAO
    */
    public function updateTipo($id, $tipo)
    {   
        $retorno = false;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $stmt = $conexao->prepare(DmlSqlUsuarioAutorizador::UPD_USUARIO_AUTORIZADOR_USAU_IN_TIPO_PK);
        $stmt->bind_param(DmlSql::STRING_TYPE 
                            . DmlSql::STRING_TYPE
                            ,$tipo
                            ,$id);
        if ($stmt->execute())
        {
            $retorno = true;
        }

        return $retorno;
    }

    /**
    * updatePermissao() - implementação da assinatura em UsuarioAutorizadorDAO
    */
    public function updatePermissao($id, $permissao)
    {   
        $retorno = false;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $stmt = $conexao->prepare(DmlSqlUsuarioAutorizador::UPD_USUARIO_AUTORIZADOR_USAU_IN_AUTORIZACAO_PK);
        $stmt->bind_param(DmlSql::STRING_TYPE 
                            . DmlSql::STRING_TYPE
                            ,$permissao
                            ,$id);
        if ($stmt->execute())
        {
            $retorno = true;
        }

        return $retorno;
    }

    /**
    * updateDatainicio() - implementação da assinatura em UsuarioAutorizadorDAO
    */
    public function updateDatainicio($id, $dataInicio)
    {   
        $retorno = false;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $stmt = $conexao->prepare(DmlSqlUsuarioAutorizador::UPD_USUARIO_AUTORIZADOR_USAU_DT_INICIO_PK);
        $stmt->bind_param(DmlSql::STRING_TYPE 
                            . DmlSql::STRING_TYPE
                            ,$dataInicio
                            ,$id);
        if ($stmt->execute())
        {
            $retorno = true;
        }

        return $retorno;
    }

    /**
    * updateDatatermino() - implementação da assinatura em UsuarioAutorizadorDAO
    */
    public function updateDatatermino($id, $dataTermino)
    {   
        $retorno = false;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $stmt = $conexao->prepare(DmlSqlUsuarioAutorizador::UPD_USUARIO_AUTORIZADOR_USAU_DT_TERMINO_PK);
        $stmt->bind_param(DmlSql::STRING_TYPE 
                            . DmlSql::STRING_TYPE
                            ,$dataTermino
                            ,$id);
        if ($stmt->execute())
        {
            $retorno = true;
        }

        return $retorno;
    }

    /**
    * loadId_Usuario() - implementação da assinatura em UsuarioAutorizadorDAO
    */

    public function loadId_Usuario($id_usuario)
    {   
        $retorno = NULL;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $res = $conexao->query(DmlSqlUsuarioAutorizador::SELECT . ' WHERE ' . DmlSqlUsuarioAutorizador::USUA_ID . '=' . $id_usuario );
        if ($res){
            $retorno = $this->getDTO($res->fetch_assoc());
        }
        return $retorno;
    }

    /**
    * loadId_Autorizador() - implementação da assinatura em UsuarioAutorizadorDAO
    */

    public function loadId_Autorizador($id_autorizador)
    {   
        $retorno = NULL;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $res = $conexao->query(DmlSqlUsuarioAutorizador::SELECT . ' WHERE ' . DmlSqlUsuarioAutorizador::USUA_ID_AUTORIZADOR . '=' . $id_autorizador );
        if ($res){
            $retorno = $this->getDTO($res->fetch_assoc());
        }
        return $retorno;
    }

    /**
    * loadId_Campanha() - implementação da assinatura em UsuarioAutorizadorDAO
    */

    public function loadId_Campanha($id_campanha)
    {   
        $retorno = NULL;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $res = $conexao->query(DmlSqlUsuarioAutorizador::SELECT . ' WHERE ' . DmlSqlUsuarioAutorizador::CAMP_ID . '=' . $id_campanha );
        if ($res){
            $retorno = $this->getDTO($res->fetch_assoc());
        }
        return $retorno;
    }

    /**
    * loadTipo() - implementação da assinatura em UsuarioAutorizadorDAO
    */

    public function loadTipo($tipo)
    {   
        $retorno = NULL;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $res = $conexao->query(DmlSqlUsuarioAutorizador::SELECT . ' WHERE ' . DmlSqlUsuarioAutorizador::USAU_IN_TIPO . '=' . $tipo );
        if ($res){
            $retorno = $this->getDTO($res->fetch_assoc());
        }
        return $retorno;
    }

    /**
    * loadPermissao() - implementação da assinatura em UsuarioAutorizadorDAO
    */

    public function loadPermissao($permissao)
    {   
        $retorno = NULL;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $res = $conexao->query(DmlSqlUsuarioAutorizador::SELECT . ' WHERE ' . DmlSqlUsuarioAutorizador::USAU_IN_AUTORIZACAO . '=' . $permissao );
        if ($res){
            $retorno = $this->getDTO($res->fetch_assoc());
        }
        return $retorno;
    }

    /**
    * loadDatainicio() - implementação da assinatura em UsuarioAutorizadorDAO
    */

    public function loadDatainicio($dataInicio)
    {   
        $retorno = NULL;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $res = $conexao->query(DmlSqlUsuarioAutorizador::SELECT . ' WHERE ' . DmlSqlUsuarioAutorizador::USAU_DT_INICIO . '=' . $dataInicio );
        if ($res){
            $retorno = $this->getDTO($res->fetch_assoc());
        }
        return $retorno;
    }

    /**
    * loadDatatermino() - implementação da assinatura em UsuarioAutorizadorDAO
    */

    public function loadDatatermino($dataTermino)
    {   
        $retorno = NULL;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $res = $conexao->query(DmlSqlUsuarioAutorizador::SELECT . ' WHERE ' . DmlSqlUsuarioAutorizador::USAU_DT_TERMINO . '=' . $dataTermino );
        if ($res){
            $retorno = $this->getDTO($res->fetch_assoc());
        }
        return $retorno;
    }

    /**
    * loadStatus() - implementação da assinatura em UsuarioAutorizadorDAO
    */

    public function loadStatus($status)
    {   
        $retorno = NULL;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $res = $conexao->query(DmlSqlUsuarioAutorizador::SELECT . ' WHERE ' . DmlSqlUsuarioAutorizador::USAU_IN_STATUS . '=' . $status );
        if ($res){
            $retorno = $this->getDTO($res->fetch_assoc());
        }
        return $retorno;
    }

    /**
    * loadDatacadastro() - implementação da assinatura em UsuarioAutorizadorDAO
    */

    public function loadDatacadastro($dataCadastro)
    {   
        $retorno = NULL;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $res = $conexao->query(DmlSqlUsuarioAutorizador::SELECT . ' WHERE ' . DmlSqlUsuarioAutorizador::USAU_DT_CADASTRO . '=' . $dataCadastro );
        if ($res){
            $retorno = $this->getDTO($res->fetch_assoc());
        }
        return $retorno;
    }

    /**
    * loadDataatualizacao() - implementação da assinatura em UsuarioAutorizadorDAO
    */

    public function loadDataatualizacao($dataAtualizacao)
    {   
        $retorno = NULL;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $res = $conexao->query(DmlSqlUsuarioAutorizador::SELECT . ' WHERE ' . DmlSqlUsuarioAutorizador::USAU_DT_UPDATE . '=' . $dataAtualizacao );
        if ($res){
            $retorno = $this->getDTO($res->fetch_assoc());
        }
        return $retorno;
    }

}
?>
