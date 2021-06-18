<?php

/**
* MySqlKinghostUsuarioNotificacaoDAO - Implementação DAO
*
* Classe de com todos os comandos DML e DDL (se necessário) para apoio 
* a classe MySqlKinghostUsuarioNotificacaoDAO
* Não é uma camada visível para outros dispositivos, como as camadas de apresentação e aplicação. 
*
*
* Tabela principal de atuação: USUARIO_NOTIFICACAO
*
* Changelog:
*
* 
* @author Julio Cesar Vitorino
* @since 23/08/2019 10:06:20
*
*/
require_once 'UsuarioNotificacaoDTO.php';
require_once 'UsuarioNotificacaoDAO.php';
require_once 'DmlSqlUsuarioNotificacao.php';

require_once '../variavel/VariavelCache.php';
require_once '../daofactory/DmlSql.php';
require_once '../mensagem/ConstantesMensagem.php';
require_once '../mensagem/MensagemCache.php';

class MySqlKinghostUsuarioNotificacaoDAO implements UsuarioNotificacaoDAO
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
* listAll() - Lista todos os registros provenientes de USUARIO_NOTIFICACAO sem critério de paginação
*
* @return List<UsuarioNotificacaoDTO>[]
*/ 
    public function listAll()   {   }

/**
* update() - atualiza apenas um registro com base no dto UsuarioNotificacaoDTO->id
* @param $daofactory
*
* @return boolean
*/ 
    public function update($dto)
    {   
        $retorno = false;
        $jsonenc = json_encode($dto->json);

        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $stmt = $conexao->prepare(DmlSqlUsuarioNotificacao::UPD_PK);
        $stmt->bind_param(DmlSql::INTEGER_TYPE 
                            . DmlSql::STRING_TYPE 
                            . DmlSql::STRING_TYPE 
                            . DmlSql::STRING_TYPE 
                            . DmlSql::STRING_TYPE 
                            . DmlSql::STRING_TYPE 
                            . DmlSql::STRING_TYPE 
                            . DmlSql::STRING_TYPE 
                            . DmlSql::INTEGER_TYPE 
                            ,$dto->id_usuario
                            ,$dto->notificacao
                            ,$dto->icone
                            ,$dto->imagem
                            ,$dto->bkgcor
                            ,$dto->tipo
                            ,$jsonenc
                            ,$dto->dataPrevApagar
                            ,$dto->id );
        if ($stmt->execute())
        {
            $retorno = true;
        }

        return $retorno;
    }

/**
* delete() - excluir fisicamente um registro com base no dto UsuarioNotificacaoDTO->id
*
* @return boolean
*/ 
    public function delete($dto)
    {   
        $retorno = false;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $stmt = $conexao->prepare(DmlSqlUsuarioNotificacao::DEL_PK);
        $stmt->bind_param(DmlSql::INTEGER_TYPE
                            ,$dto->id);
        if ($stmt->execute())
        {
            $retorno = true;
        }

        return $retorno;
    }


    public function listUsuarioNotificacaoStatus($status)
    {
        $retorno = array();

        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $res = $conexao->query(DmlSqlUsuarioNotificacao::SELECT . 'WHERE `' . DmlSqlUsuarioNotificacao::USNO_IN_STATUS . "` = '$status'" );
        if ($res){
            while ($row = $res->fetch_assoc()) {
                array_push($retorno, $this->getDTO($row));
            }
        }
        return $retorno;
    }
/**
* countUsuarioNotificacaoPorStatus() - contar a quantidade de registros
* sob o contexto da classe UsuarioNotificacao com base no status específico. 
*
* Atenção em @see $sql na tabela USUARIO_NOTIFICACAO 
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

    public function countUsuarioNotificacaoPorStatus($status)
    {   
        $retorno = 0;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $res = $conexao->query(DmlSqlUsuarioNotificacao::SQL_COUNT . ' WHERE ' 
        . DmlSqlUsuarioNotificacao::USNO_IN_STATUS . " = '$status'"
        );
        if ($res){
            $tmp = $res->fetch_assoc();
            $retorno = $tmp['contador'];
        }
        return $retorno;

    }
/**
* listUsuarioNotificacaoPorStatus() - Listar um conjunto de registro previamente paginado
* sob o contexto da classe UsuarioNotificacao com base no status específico.
*
* Atenção em @see $sql na tabela USUARIO_NOTIFICACAO 
*
* @see listPagina()
*
* @param $status
* @param $pag
* @param $qtde
* @param $coluna
* @param $ordem
*
* @return PaginacaoDTO
*/ 

    public function listUsuarioNotificacaoPorStatus($status, $pag, $qtde, $coluna, $ordem)
    {
        $sql = DmlSqlUsuarioNotificacao::SELECT 
        . ' WHERE ' . DmlSqlUsuarioNotificacao::USNO_IN_STATUS . " = '$status'"
        . ' ORDER BY ' . $coluna . ($ordem == 0 ? " ASC": " DESC");
        return $this->listPagina($sql, $pag, $qtde);
    }

/**
* countUsuarioNotificacaoPorUsuaIdStatus() - contar a quantidade de registros
* sob o contexto da classe UsuarioNotificacao com base no usuário específico. Esse usuário
* é o usuário logado na sessão ou no próprio dispositivo móvel e de acordo com a 
* query em @see $sql na tabela USUARIO_NOTIFICACAO 
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

    public function countUsuarioNotificacaoPorUsuaIdStatus($usuaid, $status)
    {   
        $retorno = 0;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $res = $conexao->query(DmlSqlUsuarioNotificacao::SQL_COUNT . ' WHERE ' 
        . DmlSqlUsuarioNotificacao::USUA_ID . " = $usuaid "
        . ' AND ' . DmlSqlUsuarioNotificacao::USNO_IN_STATUS . " = '$status'"
        );
        if ($res){
            $tmp = $res->fetch_assoc();
            $retorno = $tmp['contador'];
        }
        return $retorno;

    }
/**
* listUsuarioNotificacaoPorUsuaIdStatus() - Listar um conjunto de registro previamente paginado
* sob o contexto da classe UsuarioNotificacao com base no usuário específico. Esse usuário
* é o usuário logado na sessão ou no próprio dispositivo móvel e de acordo com a 
* query em @see $sql na tabela USUARIO_NOTIFICACAO 
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

    public function listUsuarioNotificacaoPorUsuaIdStatus($usuaid, $status, $pag, $qtde, $coluna, $ordem)
    {
        $sql = DmlSqlUsuarioNotificacao::SELECT 
        . ' WHERE ' . DmlSqlUsuarioNotificacao::USUA_ID . " = $usuaid "
        . ' AND ' . DmlSqlUsuarioNotificacao::USNO_IN_STATUS . " = '$status'"
        . ' ORDER BY ' . $coluna . ($ordem == 0 ? " ASC": " DESC");
        return $this->listPagina($sql, $pag, $qtde);
    }

/**
* listPagina() - Listar um conjunto de registro previamente paginado
* e de acordo com a query em @see $sql na tabela USUARIO_NOTIFICACAO 
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
* na tabela USUARIO_NOTIFICACAO usando a Primary Key USNO_ID
*
* @param $id
* @return UsuarioNotificacaoDTO
*/ 
    public function loadPK($id)
    {   
        $retorno = NULL;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $res = $conexao->query(DmlSqlUsuarioNotificacao::SELECT . ' WHERE ' . DmlSqlUsuarioNotificacao::USNO_ID . '=' . $id );
        if ($res){
            $retorno = $this->getDTO($res->fetch_assoc());
        }
        return $retorno;
    }

/**
* updateStatus() - atualizar o campo de STATUS utilizando a id como item de busca
* na tabela USUARIO_NOTIFICACAO usando a Primary Key USNO_ID
*
* @param $id
* @param $status
*
* @return UsuarioNotificacaoDTO
*/ 
    public function updateStatus($id, $status)
    {   
        $retorno = false;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $stmt = $conexao->prepare(DmlSqlUsuarioNotificacao::UPD_STATUS);
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
* insert() - inserir um registro com base no UsuarioNotificacaoDTO. Alguns atributos dentro do DTO
* serão ignorados caso estejam populados, pois os mesmos possuem constraint de DEFAULT value
* ou campos de AUTO INCREMENTO já previamente definidos no DDL de criação de tabelas do BD.
*
* Atributos da classe UsuarioNotificacaoDTO sumariamente IGNORADOS por este método MESMO que estejam preenchidos:
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
        $jsonenc = json_encode($dto->json);
        
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();

        $stmt = $conexao->prepare(DmlSqlUsuarioNotificacao::INS);
        $stmt->bind_param(DmlSql::INTEGER_TYPE 
                            . DmlSql::STRING_TYPE 
                            . DmlSql::STRING_TYPE 
                            . DmlSql::STRING_TYPE 
                            . DmlSql::STRING_TYPE 
                            ,$dto->id_usuario
                            ,$dto->notificacao
                            ,$dto->tipo
                            ,$dto->icone
                            ,$jsonenc
        );
        if ($stmt->execute())
        {
            $retorno = true;
        }

        return $retorno;
    }

    /**
     * getDTO() - Transforma o resultset padrão em UsuarioNotificacaoDTO
    */
    public function getDTO($resultset)
    {
        //echo var_dump($resultset); // ótimo pra debugar
        $retorno = new UsuarioNotificacaoDTO();
        $retorno->id = $resultset[DmlSqlUsuarioNotificacao::USNO_ID] == NULL ? NULL : $resultset[DmlSqlUsuarioNotificacao::USNO_ID];
        $retorno->id_usuario = $resultset[DmlSqlUsuarioNotificacao::USUA_ID] == NULL ? NULL : $resultset[DmlSqlUsuarioNotificacao::USUA_ID];
        $retorno->notificacao = $resultset[DmlSqlUsuarioNotificacao::USNO_TX_NOTIFICACAO] == NULL ? NULL : $resultset[DmlSqlUsuarioNotificacao::USNO_TX_NOTIFICACAO];
        $retorno->icone = $resultset[DmlSqlUsuarioNotificacao::USNO_TX_ICON] == NULL ? NULL : $resultset[DmlSqlUsuarioNotificacao::USNO_TX_ICON];
        $retorno->imagem = $resultset[DmlSqlUsuarioNotificacao::USNO_TX_IMG] == NULL ? NULL : $resultset[DmlSqlUsuarioNotificacao::USNO_TX_IMG];
        $retorno->bkgcor = $resultset[DmlSqlUsuarioNotificacao::USNO_TX_BGCOLOR] == NULL ? NULL : $resultset[DmlSqlUsuarioNotificacao::USNO_TX_BGCOLOR];
        $retorno->tipo = $resultset[DmlSqlUsuarioNotificacao::USNO_IN_TIPO] == NULL ? NULL : $resultset[DmlSqlUsuarioNotificacao::USNO_IN_TIPO];
        $retorno->dataPrevApagar = $resultset[DmlSqlUsuarioNotificacao::USNO_DT_PREV_APAGAR] == NULL ? NULL : $resultset[DmlSqlUsuarioNotificacao::USNO_DT_PREV_APAGAR];
        $retorno->json = $resultset[DmlSqlUsuarioNotificacao::USNO_TX_JSON] == NULL ? NULL : $resultset[DmlSqlUsuarioNotificacao::USNO_TX_JSON];
        $retorno->status = $resultset[DmlSqlUsuarioNotificacao::USNO_IN_STATUS] == NULL ? NULL : $resultset[DmlSqlUsuarioNotificacao::USNO_IN_STATUS];
        $retorno->dataCadastro = Util::MySQLDate_to_DMYHMiS($resultset[DmlSqlUsuarioNotificacao::USNO_DT_CADASTRO]);
        $retorno->dataAtualizacao = Util::MySQLDate_to_DMYHMiS($resultset[DmlSqlUsuarioNotificacao::USNO_DT_UPDATE]);
        $retorno->statusdesc = VariavelCache::getInstance()->getStatusDesc($retorno->status);
        $retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
        $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);
        
        return $retorno;

    }

}
?>




