<?php

/**
* MySqlKinghostUsuarioPublicidadeDAO - Implementação DAO
*
* Classe de com todos os comandos DML e DDL (se necessário) para apoio 
* a classe MySqlKinghostUsuarioPublicidadeDAO
* Não é uma camada visível para outros dispositivos, como as camadas de apresentação e aplicação. 
*
*
* Tabela principal de atuação: USUARIO_PUBLICIDADE
*
* Changelog:
*
* 
* @author Julio Cesar Vitorino
* @since 23/08/2019 10:06:20
*
*/
require_once 'UsuarioPublicidadeDTO.php';
require_once 'UsuarioPublicidadeDAO.php';
require_once 'DmlSqlUsuarioPublicidade.php';

require_once '../variavel/VariavelCache.php';
require_once '../daofactory/DmlSql.php';

class MySqlKinghostUsuarioPublicidadeDAO implements UsuarioPublicidadeDAO
{
    private $daofactory;

    function __construct($daofactory)
    {
        $this->daofactory = $daofactory;
    }
/**
*
* updateImagem() - Atualizar as informações da URL da imagem da campanha de publicidade
* após o upload realizado.
*
* @param uspu_id
* @param nomearquivo
* @return UsuarioPublicidadeDTO
*
*/
    public function updateImagem($uspu_id, $nomearquivo)
	{	
		$retorno = false;
		// prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
		$conexao = $this->daofactory->getSession();
		$stmt = $conexao->prepare(DmlSqlUsuarioPublicidade::UPD_USUARIO_PUBLICIDADE_USPU_TX_URL_PK);
		$stmt->bind_param(DmlSql::STRING_TYPE 
							. DmlSql::INTEGER_TYPE 
							,$nomearquivo
							,$uspu_id);
		if ($stmt->execute())
		{
			$retorno = true;
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
        $sql = DmlSqlUsuarioPublicidade::SELECT_MAX_PK . ' WHERE ' 
        . DmlSqlUsuarioPublicidade::USUA_ID . " = $id_usuario "
        . " AND " . DmlSqlUsuarioPublicidade::USPU_IN_STATUS . " = '$status'";

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
* listAll() - Lista todos os registros provenientes de USUARIO_PUBLICIDADE sem critério de paginação
*
* @return List<UsuarioPublicidadeDTO>[]
*/ 
    public function listAll()   {   }

/**
* update() - atualiza apenas um registro com base no dto UsuarioPublicidadeDTO->id
* @param $daofactory
*
* @return boolean
*/ 
    public function update($dto)
    {   
        $retorno = false;

        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $stmt = $conexao->prepare(DmlSqlUsuarioPublicidade::UPD_PK);
        $stmt->bind_param(DmlSql::INTEGER_TYPE 
                            . DmlSql::STRING_TYPE 
                            . DmlSql::STRING_TYPE 
                            . DmlSql::STRING_TYPE 
                            . DmlSql::STRING_TYPE 
                            . DmlSql::DOUBLE_TYPE 
                            . DmlSql::DOUBLE_TYPE 
                            . DmlSql::STRING_TYPE 
                            . DmlSql::INTEGER_TYPE 
                            ,$dto->id_usuario
                            ,$dto->titulo
                            ,$dto->descricao
                            ,$dto->dataInicio
                            ,$dto->dataTermino
                            ,$dto->vlNormal
                            ,$dto->vlPromo
                            ,$dto->observacao
                            ,$dto->id );
        if ($stmt->execute())
        {
            $retorno = true;
        }

        return $retorno;
    }

/**
* delete() - excluir fisicamente um registro com base no dto UsuarioPublicidadeDTO->id
*
* @return boolean
*/ 
    public function delete($dto)
    {   
        $retorno = false;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $stmt = $conexao->prepare(DmlSqlUsuarioPublicidade::DEL_PK);
        $stmt->bind_param(DmlSql::INTEGER_TYPE
                            ,$dto->id);
        if ($stmt->execute())
        {
            $retorno = true;
        }

        return $retorno;
    }


    public function listUsuarioPublicidadeStatus($status)
    {
        $retorno = array();

        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $res = $conexao->query(DmlSqlUsuarioPublicidade::SELECT . 'WHERE `' . DmlSqlUsuarioPublicidade::USPU_IN_STATUS . "` = '$status'" );
        if ($res){
            while ($row = $res->fetch_assoc()) {
                array_push($retorno, $this->getDTO($row));
            }
        }
        return $retorno;
    }

/**
* countUsuarioPublicidadePorStatus() - contar a quantidade de registros
* sob o contexto da classe UsuarioPublicidade com base no status específico. 
*
* Atenção em @see $sql na tabela USUARIO_PUBLICIDADE 
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

    public function countUsuarioPublicidadePorStatus($status)
    {   
        $retorno = 0;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $res = $conexao->query(DmlSqlUsuarioPublicidade::SQL_COUNT . ' WHERE ' 
        . DmlSqlUsuarioPublicidade::USPU_IN_STATUS . " = '$status'"
        );
        if ($res){
            $tmp = $res->fetch_assoc();
            $retorno = $tmp['contador'];
        }
        return $retorno;

    }

/**
* listUsuarioPublicidadePorStatus() - Listar um conjunto de registro previamente paginado
* sob o contexto da classe UsuarioPublicidade com base no status específico.
*
* Atenção em @see $sql na tabela USUARIO_PUBLICIDADE 
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

    public function listUsuarioPublicidadePorStatus($status, $pag, $qtde, $coluna, $ordem)
    {
        $sql = DmlSqlUsuarioPublicidade::SELECT 
        . ' WHERE ' . DmlSqlUsuarioPublicidade::USPU_IN_STATUS . " = '$status'"
        . ' ORDER BY ' . $coluna . ($ordem == 0 ? " ASC": " DESC");
        return $this->listPagina($sql, $pag, $qtde);
    }

/**
* countUsuarioPublicidadePorUsuaIdStatus() - contar a quantidade de registros
* sob o contexto da classe UsuarioPublicidade com base no usuário específico. Esse usuário
* é o usuário logado na sessão ou no próprio dispositivo móvel e de acordo com a 
* query em @see $sql na tabela USUARIO_PUBLICIDADE 
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

    public function countUsuarioPublicidadePorUsuaIdStatus($usuaid, $status)
    {   
        $retorno = 0;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $sql=DmlSqlUsuarioPublicidade::SQL_COUNT . ' WHERE ' 
        . DmlSqlUsuarioPublicidade::USUA_ID . " = $usuaid "
        . ' AND ' . DmlSqlUsuarioPublicidade::USPU_IN_STATUS . " IN $status ";

        $res = $conexao->query($sql);
//var_dump($sql);        
        if ($res){
            $tmp = $res->fetch_assoc();
            $retorno = $tmp['contador'];
        }
        return $retorno;

    }

/**
* listUsuarioPublicidadePorUsuaIdStatus() - Listar um conjunto de registro previamente paginado
* sob o contexto da classe UsuarioPublicidade com base no usuário específico. Esse usuário
* é o usuário logado na sessão ou no próprio dispositivo móvel e de acordo com a 
* query em @see $sql na tabela USUARIO_PUBLICIDADE 
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
    public function listUsuarioPublicidadePorUsuaIdStatus($usuaid, $status, $pag, $qtde, $coluna, $ordem)
    {
        $sql = DmlSqlUsuarioPublicidade::SELECT 
        . ' WHERE ' . DmlSqlUsuarioPublicidade::USUA_ID . " = $usuaid "
        . ' AND ' . DmlSqlUsuarioPublicidade::USPU_IN_STATUS . " IN $status "
        . ' ORDER BY ' . $coluna . ($ordem == 0 ? " ASC": " DESC");
//var_dump($sql);        
        return $this->listPagina($sql, $pag, $qtde);
    }
/**
* countUsuarioPublicidadeProx24h() - contar a quantidade de registros
* sob o contexto da classe UsuarioPublicidade com base no usuário específico. Esse usuário
* é o usuário logado na sessão ou no próprio dispositivo móvel e de acordo com a 
* query em @see $sql na tabela USUARIO_PUBLICIDADE 
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

public function countUsuarioPublicidadeProx24h($usuaid, $status)
{   
    $retorno = 0;
    // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
    $conexao = $this->daofactory->getSession();
    $sql = DmlSqlUsuarioPublicidade::SQL_COUNT . ' WHERE ' 
    . " ((CURRENT_TIMESTAMP >= USPU_DT_INICIO AND CURRENT_TIMESTAMP <= USPU_DT_TERMINO) "
    . " OR " . DmlSqlUsuarioPublicidade::USPU_DT_TERMINO . " BETWEEN CURRENT_TIMESTAMP and DATE_ADD(CURRENT_TIMESTAMP, INTERVAL 1 DAY)) "
    . ' AND ' . DmlSqlUsuarioPublicidade::USPU_IN_STATUS . " = '$status'";

    $res = $conexao->query($sql);
    //var_dump($sql);

    if ($res){
        $tmp = $res->fetch_assoc();
        $retorno = $tmp['contador'];
    }
    return $retorno;

}

/**
* listUsuarioPublicidadeProx24h() - Listar um conjunto de registro previamente paginado
* sob o contexto da classe UsuarioPublicidade com base no usuário específico. Esse usuário
* é o usuário logado na sessão ou no próprio dispositivo móvel e de acordo com a 
* query em @see $sql na tabela USUARIO_PUBLICIDADE 
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
public function listUsuarioPublicidadeProx24h($usuaid, $status, $pag, $qtde, $coluna, $ordem)
{
    $sql = DmlSqlUsuarioPublicidade::SELECT 
    . " WHERE ((CURRENT_TIMESTAMP >= USPU_DT_INICIO AND CURRENT_TIMESTAMP <= USPU_DT_TERMINO) "
    . " OR " . DmlSqlUsuarioPublicidade::USPU_DT_TERMINO . " BETWEEN CURRENT_TIMESTAMP and DATE_ADD(CURRENT_TIMESTAMP, INTERVAL 1 DAY)) "
    . ' AND ' . DmlSqlUsuarioPublicidade::USPU_IN_STATUS . " = '$status'"
    . ' ORDER BY ' . $coluna . ($ordem == 0 ? " ASC": " DESC");
//var_dump($sql);
    return $this->listPagina($sql, $pag, $qtde);
}


/**
* listPagina() - Listar um conjunto de registro previamente paginado
* e de acordo com a query em @see $sql na tabela USUARIO_PUBLICIDADE 
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
* na tabela USUARIO_PUBLICIDADE usando a Primary Key USPU_ID
*
* @param $id
* @return UsuarioPublicidadeDTO
*/ 
    public function loadPK($id)
    {   
        $retorno = NULL;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $res = $conexao->query(DmlSqlUsuarioPublicidade::SELECT . ' WHERE ' . DmlSqlUsuarioPublicidade::USPU_ID . '=' . $id );
        if ($res){
            $retorno = $this->getDTO($res->fetch_assoc());
        }
        return $retorno;
    }

/**
* updateStatus() - atualizar o campo de STATUS utilizando a id como item de busca
* na tabela USUARIO_PUBLICIDADE usando a Primary Key USPU_ID
*
* @param $id
* @param $status
*
* @return UsuarioPublicidadeDTO
*/ 
    public function updateStatus($id, $status)
    {   
        $retorno = false;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $stmt = $conexao->prepare(DmlSqlUsuarioPublicidade::UPD_STATUS);
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
* insert() - inserir um registro com base no UsuarioPublicidadeDTO. Alguns atributos dentro do DTO
* serão ignorados caso estejam populados, pois os mesmos possuem constraint de DEFAULT value
* ou campos de AUTO INCREMENTO já previamente definidos no DDL de criação de tabelas do BD.
*
* Atributos da classe UsuarioPublicidadeDTO sumariamente IGNORADOS por este método MESMO que estejam preenchidos:
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
        $stmt = $conexao->prepare(DmlSqlUsuarioPublicidade::INS);
        $stmt->bind_param(DmlSql::INTEGER_TYPE 
                            . DmlSql::STRING_TYPE 
                            . DmlSql::STRING_TYPE 
                            . DmlSql::STRING_TYPE 
                            . DmlSql::STRING_TYPE 
                            . DmlSql::DOUBLE_TYPE 
                            . DmlSql::DOUBLE_TYPE 
                            . DmlSql::STRING_TYPE 
                            ,$dto->id_usuario
                            ,$dto->titulo
                            ,$dto->descricao
                            ,$dto->dataInicio
                            ,$dto->dataTermino
                            ,$dto->vlNormal
                            ,$dto->vlPromo
                            ,$dto->observacao
        );
        if ($stmt->execute())
        {
            $retorno = true;
        }

        return $retorno;
    }

    /**
     * getDTO() - Transforma o resultset padrão em UsuarioPublicidadeDTO
    */
    public function getDTO($resultset)
    {
        //echo var_dump($resultset); // ótimo pra debugar
        $retorno = new UsuarioPublicidadeDTO();
        $retorno->id = $resultset[DmlSqlUsuarioPublicidade::USPU_ID] == NULL ? NULL : (int) $resultset[DmlSqlUsuarioPublicidade::USPU_ID];
        $retorno->id_usuario = $resultset[DmlSqlUsuarioPublicidade::USUA_ID] == NULL ? NULL : (int) $resultset[DmlSqlUsuarioPublicidade::USUA_ID];
        $retorno->titulo = $resultset[DmlSqlUsuarioPublicidade::USPU_TX_TITULO] == NULL ? NULL : $resultset[DmlSqlUsuarioPublicidade::USPU_TX_TITULO];
        $retorno->descricao = $resultset[DmlSqlUsuarioPublicidade::USPU_TX_DESCRICAO] == NULL ? NULL : $resultset[DmlSqlUsuarioPublicidade::USPU_TX_DESCRICAO];
        $retorno->dataInicio = $resultset[DmlSqlUsuarioPublicidade::USPU_DT_INICIO] == NULL ? NULL :  Util::MySQLDate_to_DMYHMiS($resultset[DmlSqlUsuarioPublicidade::USPU_DT_INICIO]);
        $retorno->dataTermino = $resultset[DmlSqlUsuarioPublicidade::USPU_DT_TERMINO] == NULL ? NULL : Util::MySQLDate_to_DMYHMiS($resultset[DmlSqlUsuarioPublicidade::USPU_DT_TERMINO]);
        $retorno->vlNormal = $resultset[DmlSqlUsuarioPublicidade::USPU_VL_NORMAL] == NULL ? NULL : (double) $resultset[DmlSqlUsuarioPublicidade::USPU_VL_NORMAL];
        $retorno->vlNormalMoeda = $resultset[DmlSqlUsuarioPublicidade::USPU_VL_NORMAL] == NULL ? NULL : Util::getMoeda((double) $resultset[DmlSqlUsuarioPublicidade::USPU_VL_NORMAL]);
        $retorno->vlPromo = $resultset[DmlSqlUsuarioPublicidade::USPU_VL_PROMO] == NULL ? NULL : (double) $resultset[DmlSqlUsuarioPublicidade::USPU_VL_PROMO];
        $retorno->vlPromoMoeda = $resultset[DmlSqlUsuarioPublicidade::USPU_VL_PROMO] == NULL ? NULL : Util::getMoeda((double) $resultset[DmlSqlUsuarioPublicidade::USPU_VL_PROMO]);
        $retorno->observacao = $resultset[DmlSqlUsuarioPublicidade::USPU_TX_OBS] == NULL ? NULL : $resultset[DmlSqlUsuarioPublicidade::USPU_TX_OBS];
        $retorno->url = $resultset[DmlSqlUsuarioPublicidade::USPU_TX_OBS] == NULL ? NULL : $resultset[DmlSqlUsuarioPublicidade::USPU_TX_URL];
        $retorno->modelo = $resultset[DmlSqlUsuarioPublicidade::USPU_IN_MODELO] == NULL ? NULL : $resultset[DmlSqlUsuarioPublicidade::USPU_IN_MODELO];
        $retorno->dataRemover = $resultset[DmlSqlUsuarioPublicidade::USPU_DT_APAGAR] == NULL ? NULL : Util::MySQLDate_to_DMYHMiS($resultset[DmlSqlUsuarioPublicidade::USPU_DT_APAGAR]);
        $retorno->status = $resultset[DmlSqlUsuarioPublicidade::USPU_IN_STATUS] == NULL ? NULL : $resultset[DmlSqlUsuarioPublicidade::USPU_IN_STATUS];
        $retorno->dataCadastro = Util::MySQLDate_to_DMYHMiS($resultset[DmlSqlUsuarioPublicidade::USPU_DT_CADASTRO]);
        $retorno->dataAtualizacao = Util::MySQLDate_to_DMYHMiS($resultset[DmlSqlUsuarioPublicidade::USPU_DT_UPDATE]);
        $retorno->statusdesc = VariavelCache::getInstance()->getStatusDesc($retorno->status);
        return $retorno;

    }

    /**
    * updateId_Usuario() - implementação da assinatura em UsuarioPublicidadeDAO
    */
    public function updateId_Usuario($id, $id_usuario)
    {   
        $retorno = false;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $stmt = $conexao->prepare(DmlSqlUsuarioPublicidade::UPD_USUARIO_PUBLICIDADE_USUA_ID_PK);
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
    * updateTitulo() - implementação da assinatura em UsuarioPublicidadeDAO
    */
    public function updateTitulo($id, $titulo)
    {   
        $retorno = false;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $stmt = $conexao->prepare(DmlSqlUsuarioPublicidade::UPD_USUARIO_PUBLICIDADE_USPU_TX_TITULO_PK);
        $stmt->bind_param(DmlSql::STRING_TYPE 
                            . DmlSql::STRING_TYPE
                            ,$titulo
                            ,$id);
        if ($stmt->execute())
        {
            $retorno = true;
        }

        return $retorno;
    }

    /**
    * updateDescricao() - implementação da assinatura em UsuarioPublicidadeDAO
    */
    public function updateDescricao($id, $descricao)
    {   
        $retorno = false;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $stmt = $conexao->prepare(DmlSqlUsuarioPublicidade::UPD_USUARIO_PUBLICIDADE_USPU_TX_DESCRICAO_PK);
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
    * updateDatainicio() - implementação da assinatura em UsuarioPublicidadeDAO
    */
    public function updateDatainicio($id, $dataInicio)
    {   
        $retorno = false;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $stmt = $conexao->prepare(DmlSqlUsuarioPublicidade::UPD_USUARIO_PUBLICIDADE_USPU_DT_INICIO_PK);
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
    * updateDatatermino() - implementação da assinatura em UsuarioPublicidadeDAO
    */
    public function updateDatatermino($id, $dataTermino)
    {   
        $retorno = false;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $stmt = $conexao->prepare(DmlSqlUsuarioPublicidade::UPD_USUARIO_PUBLICIDADE_USPU_DT_TERMINO_PK);
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
    * updateVlnormal() - implementação da assinatura em UsuarioPublicidadeDAO
    */
    public function updateVlnormal($id, $vlNormal)
    {   
        $retorno = false;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $stmt = $conexao->prepare(DmlSqlUsuarioPublicidade::UPD_USUARIO_PUBLICIDADE_USPU_VL_NORMAL_PK);
        $stmt->bind_param(DmlSql::DOUBLE_TYPE 
                            . DmlSql::DOUBLE_TYPE
                            ,$vlNormal
                            ,$id);
        if ($stmt->execute())
        {
            $retorno = true;
        }

        return $retorno;
    }

    /**
    * updateVlpromo() - implementação da assinatura em UsuarioPublicidadeDAO
    */
    public function updateVlpromo($id, $vlPromo)
    {   
        $retorno = false;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $stmt = $conexao->prepare(DmlSqlUsuarioPublicidade::UPD_USUARIO_PUBLICIDADE_USPU_VL_PROMO_PK);
        $stmt->bind_param(DmlSql::DOUBLE_TYPE 
                            . DmlSql::DOUBLE_TYPE
                            ,$vlPromo
                            ,$id);
        if ($stmt->execute())
        {
            $retorno = true;
        }

        return $retorno;
    }

    /**
    * updateObservacao() - implementação da assinatura em UsuarioPublicidadeDAO
    */
    public function updateObservacao($id, $observacao)
    {   
        $retorno = false;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $stmt = $conexao->prepare(DmlSqlUsuarioPublicidade::UPD_USUARIO_PUBLICIDADE_USPU_TX_OBS_PK);
        $stmt->bind_param(DmlSql::STRING_TYPE 
                            . DmlSql::STRING_TYPE
                            ,$observacao
                            ,$id);
        if ($stmt->execute())
        {
            $retorno = true;
        }

        return $retorno;
    }

    /**
    * updateDataremover() - implementação da assinatura em UsuarioPublicidadeDAO
    */
    public function updateDataremover($id, $dataRemover)
    {   
        $retorno = false;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $stmt = $conexao->prepare(DmlSqlUsuarioPublicidade::UPD_USUARIO_PUBLICIDADE_USPU_DT_APAGAR_PK);
        $stmt->bind_param(DmlSql::STRING_TYPE 
                            . DmlSql::STRING_TYPE
                            ,$dataRemover
                            ,$id);
        if ($stmt->execute())
        {
            $retorno = true;
        }

        return $retorno;
    }

    /**
    * loadId_Usuario() - implementação da assinatura em UsuarioPublicidadeDAO
    */

    public function loadId_Usuario($id_usuario)
    {   
        $retorno = NULL;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $res = $conexao->query(DmlSqlUsuarioPublicidade::SELECT . ' WHERE ' . DmlSqlUsuarioPublicidade::USUA_ID . '=' . $id_usuario );
        if ($res){
            $retorno = $this->getDTO($res->fetch_assoc());
        }
        return $retorno;
    }

    /**
    * loadTitulo() - implementação da assinatura em UsuarioPublicidadeDAO
    */

    public function loadTitulo($titulo)
    {   
        $retorno = NULL;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $res = $conexao->query(DmlSqlUsuarioPublicidade::SELECT . ' WHERE ' . DmlSqlUsuarioPublicidade::USPU_TX_TITULO . '=' . $titulo );
        if ($res){
            $retorno = $this->getDTO($res->fetch_assoc());
        }
        return $retorno;
    }

    /**
    * loadDescricao() - implementação da assinatura em UsuarioPublicidadeDAO
    */

    public function loadDescricao($descricao)
    {   
        $retorno = NULL;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $res = $conexao->query(DmlSqlUsuarioPublicidade::SELECT . ' WHERE ' . DmlSqlUsuarioPublicidade::USPU_TX_DESCRICAO . '=' . $descricao );
        if ($res){
            $retorno = $this->getDTO($res->fetch_assoc());
        }
        return $retorno;
    }

    /**
    * loadDatainicio() - implementação da assinatura em UsuarioPublicidadeDAO
    */

    public function loadDatainicio($dataInicio)
    {   
        $retorno = NULL;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $res = $conexao->query(DmlSqlUsuarioPublicidade::SELECT . ' WHERE ' . DmlSqlUsuarioPublicidade::USPU_DT_INICIO . '=' . $dataInicio );
        if ($res){
            $retorno = $this->getDTO($res->fetch_assoc());
        }
        return $retorno;
    }

    /**
    * loadDatatermino() - implementação da assinatura em UsuarioPublicidadeDAO
    */

    public function loadDatatermino($dataTermino)
    {   
        $retorno = NULL;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $res = $conexao->query(DmlSqlUsuarioPublicidade::SELECT . ' WHERE ' . DmlSqlUsuarioPublicidade::USPU_DT_TERMINO . '=' . $dataTermino );
        if ($res){
            $retorno = $this->getDTO($res->fetch_assoc());
        }
        return $retorno;
    }

    /**
    * loadVlnormal() - implementação da assinatura em UsuarioPublicidadeDAO
    */

    public function loadVlnormal($vlNormal)
    {   
        $retorno = NULL;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $res = $conexao->query(DmlSqlUsuarioPublicidade::SELECT . ' WHERE ' . DmlSqlUsuarioPublicidade::USPU_VL_NORMAL . '=' . $vlNormal );
        if ($res){
            $retorno = $this->getDTO($res->fetch_assoc());
        }
        return $retorno;
    }

    /**
    * loadVlpromo() - implementação da assinatura em UsuarioPublicidadeDAO
    */

    public function loadVlpromo($vlPromo)
    {   
        $retorno = NULL;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $res = $conexao->query(DmlSqlUsuarioPublicidade::SELECT . ' WHERE ' . DmlSqlUsuarioPublicidade::USPU_VL_PROMO . '=' . $vlPromo );
        if ($res){
            $retorno = $this->getDTO($res->fetch_assoc());
        }
        return $retorno;
    }

    /**
    * loadObservacao() - implementação da assinatura em UsuarioPublicidadeDAO
    */

    public function loadObservacao($observacao)
    {   
        $retorno = NULL;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $res = $conexao->query(DmlSqlUsuarioPublicidade::SELECT . ' WHERE ' . DmlSqlUsuarioPublicidade::USPU_TX_OBS . '=' . $observacao );
        if ($res){
            $retorno = $this->getDTO($res->fetch_assoc());
        }
        return $retorno;
    }

    /**
    * loadDataremover() - implementação da assinatura em UsuarioPublicidadeDAO
    */

    public function loadDataremover($dataRemover)
    {   
        $retorno = NULL;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $res = $conexao->query(DmlSqlUsuarioPublicidade::SELECT . ' WHERE ' . DmlSqlUsuarioPublicidade::USPU_DT_APAGAR . '=' . $dataRemover );
        if ($res){
            $retorno = $this->getDTO($res->fetch_assoc());
        }
        return $retorno;
    }

    /**
    * loadStatus() - implementação da assinatura em UsuarioPublicidadeDAO
    */

    public function loadStatus($status)
    {   
        $retorno = NULL;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $res = $conexao->query(DmlSqlUsuarioPublicidade::SELECT . ' WHERE ' . DmlSqlUsuarioPublicidade::USPU_IN_STATUS . '=' . $status );
        if ($res){
            $retorno = $this->getDTO($res->fetch_assoc());
        }
        return $retorno;
    }

    /**
    * loadDatacadastro() - implementação da assinatura em UsuarioPublicidadeDAO
    */

    public function loadDatacadastro($dataCadastro)
    {   
        $retorno = NULL;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $res = $conexao->query(DmlSqlUsuarioPublicidade::SELECT . ' WHERE ' . DmlSqlUsuarioPublicidade::USPU_DT_CADASTRO . '=' . $dataCadastro );
        if ($res){
            $retorno = $this->getDTO($res->fetch_assoc());
        }
        return $retorno;
    }

    /**
    * loadDataatualizacao() - implementação da assinatura em UsuarioPublicidadeDAO
    */

    public function loadDataatualizacao($dataAtualizacao)
    {   
        $retorno = NULL;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $res = $conexao->query(DmlSqlUsuarioPublicidade::SELECT . ' WHERE ' . DmlSqlUsuarioPublicidade::USPU_DT_UPDATE . '=' . $dataAtualizacao );
        if ($res){
            $retorno = $this->getDTO($res->fetch_assoc());
        }
        return $retorno;
    }

}
?>
