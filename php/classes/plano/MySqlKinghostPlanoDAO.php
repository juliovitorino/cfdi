<?php

/**
* MySqlKinghostPlanoDAO - Implementação DAO
*
* Classe de com todos os comandos DML e DDL (se necessário) para apoio 
* a classe MySqlKinghostPlanoDAO
* Não é uma camada visível para outros dispositivos, como as camadas de apresentação e aplicação. 
*
*
* Tabela principal de atuação: PLANOS
*
* Changelog:
*
* 
* @author Julio Cesar Vitorino
* @since 23/08/2019 10:06:20
*
*/
require_once 'PlanoDTO.php';
require_once 'PlanoDAO.php';
require_once 'DmlSqlPlano.php';

require_once '../mensagem/ConstantesMensagem.php';
require_once '../mensagem/MensagemCache.php';
require_once '../variavel/VariavelCache.php';
require_once '../daofactory/DmlSql.php';

class MySqlKinghostPlanoDAO implements PlanoDAO
{
    private $daofactory;

    function __construct($daofactory)
    {
        $this->daofactory = $daofactory;
    }


/**
* loadMaxNomePK() - Carrega um MaxID (pk) para um ${CAMPO} e status
*
* @param $nome
* @param $status
* @return $dto
*/ 

    public function loadMaxNomePK($nome,$status)
    {   
        $retorno = 0;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $sql = DmlSqlPlano::SELECT_MAX_PK . ' WHERE ' 
        . DmlSqlPlano::PLAN_NM_PLANO . " = $nome "
        . " AND " . DmlSqlPlano::PLAN_IN_STATUS . " = '$status'";

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

	public function load($dto) 
	{
		$retorno = NULL;
		// prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
		$conexao = $this->daofactory->getSession();
		$res = $conexao->query(DmlSqlPlano::SELECT . ' WHERE ' . DmlSqlPlano::PLAN_ID . '=' . $dto->id );
		if ($res){
			$retorno = $this->getDTO($res->fetch_assoc());
		}
		return $retorno;
	}

/**
* listAll() - Lista todos os registros provenientes de PLANOS sem critério de paginação
*
* @return List<PlanoDTO>[]
*/ 
    public function listAll()   {   }

/**
* update() - atualiza apenas um registro com base no dto PlanoDTO->id
* @param $daofactory
*
* @return boolean
*/ 
    public function update($dto)
    {   
        $retorno = false;

        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $stmt = $conexao->prepare(DmlSqlPlano::UPD_PK);
        $stmt->bind_param(DmlSql::STRING_TYPE 
                            . DmlSql::STRING_TYPE 
                            . DmlSql::DOUBLE_TYPE 
                            . DmlSql::STRING_TYPE 
                            . DmlSql::INTEGER_TYPE 
                            ,$dto->nome
                            ,$dto->permissao
                            ,$dto->valor
                            ,$dto->tipo
                            ,$dto->id );
        if ($stmt->execute())
        {
            $retorno = true;
        }

        return $retorno;
    }

/**
* delete() - excluir fisicamente um registro com base no dto PlanoDTO->id
*
* @return boolean
*/ 
    public function delete($dto)
    {   
        $retorno = false;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $stmt = $conexao->prepare(DmlSqlPlano::DEL_PK);
        $stmt->bind_param(DmlSql::INTEGER_TYPE
                            ,$dto->id);
        if ($stmt->execute())
        {
            $retorno = true;
        }

        return $retorno;
    }


    public function listPlanoStatus($status)
    {
        $retorno = array();

        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $res = $conexao->query(DmlSqlPlano::SELECT . 'WHERE `' . DmlSqlPlano::PLAN_IN_STATUS . "` = '$status'" );
        if ($res){
            while ($row = $res->fetch_assoc()) {
                array_push($retorno, $this->getDTO($row));
            }
        }
        return $retorno;
    }

/**
* countPlanoPorStatus() - contar a quantidade de registros
* sob o contexto da classe Plano com base no status específico. 
*
* Atenção em @see $sql na tabela PLANOS 
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

    public function countPlanoPorStatus($status)
    {   
        $retorno = 0;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $res = $conexao->query(DmlSqlPlano::SQL_COUNT . ' WHERE ' 
        . DmlSqlPlano::PLAN_IN_STATUS . " = '$status'"
        );
        if ($res){
            $tmp = $res->fetch_assoc();
            $retorno = $tmp['contador'];
        }
        return $retorno;

    }

/**
* listPlanoPorStatus() - Listar um conjunto de registro previamente paginado
* sob o contexto da classe Plano com base no status específico.
*
* Atenção em @see $sql na tabela PLANOS 
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

    public function listPlanoPorStatus($status, $pag, $qtde, $coluna, $ordem)
    {
        $sql = DmlSqlPlano::SELECT 
        . ' WHERE ' . DmlSqlPlano::PLAN_IN_STATUS . " = '$status'"
        . ' ORDER BY ' . $coluna . ($ordem == 0 ? " ASC": " DESC");
        return $this->listPagina($sql, $pag, $qtde);
    }

/**
* countPlanoPorStatusTipo() - contar a quantidade de registros
* sob o contexto da classe Plano com base no status específico. 
*
* Atenção em @see $sql na tabela PLANOS 
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

    public function countPlanoPorStatusTipo($status, $tipo)
    {   
        $retorno = 0;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $sql = DmlSqlPlano::SQL_COUNT 
        . ' WHERE ' . DmlSqlPlano::PLAN_IN_TIPO . " = '$tipo'"
        . ' AND '   . DmlSqlPlano::PLAN_IN_STATUS . " = '$status'";
        $res = $conexao->query($sql);
        if ($res){
            $tmp = $res->fetch_assoc();
            $retorno = $tmp['contador'];
        }
        return $retorno;

    }

/**
* listPlanoPorStatusTipo() - Listar um conjunto de registro previamente paginado
* sob o contexto da classe Plano com base no status específico.
*
* Atenção em @see $sql na tabela PLANOS 
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

    public function listPlanoPorStatusTipo($status, $tipo, $pag, $qtde, $coluna, $ordem)
    {
        $sql = DmlSqlPlano::SELECT 
        . ' WHERE ' . DmlSqlPlano::PLAN_IN_TIPO . " = '$tipo'"
        . ' AND  '  . DmlSqlPlano::PLAN_IN_STATUS . " = '$status'"
        . ' ORDER BY ' . $coluna . ($ordem == 0 ? " ASC": " DESC");
        return $this->listPagina($sql, $pag, $qtde);
    }

/**
* countPlanoPorUsuaIdStatus() - contar a quantidade de registros
* sob o contexto da classe Plano com base no usuário específico. Esse usuário
* é o usuário logado na sessão ou no próprio dispositivo móvel e de acordo com a 
* query em @see $sql na tabela PLANOS 
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

    public function countPlanoPorUsuaIdStatus($usuaid, $status)
    {   
        $retorno = 0;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $res = $conexao->query(DmlSqlPlano::SQL_COUNT . ' WHERE ' 
        . DmlSqlPlano::USUA_ID . " = $usuaid "
        . ' AND ' . DmlSqlPlano::PLAN_IN_STATUS . " = '$status'"
        );
        if ($res){
            $tmp = $res->fetch_assoc();
            $retorno = $tmp['contador'];
        }
        return $retorno;

    }

/**
* listPlanoPorUsuaIdStatus() - Listar um conjunto de registro previamente paginado
* sob o contexto da classe Plano com base no usuário específico. Esse usuário
* é o usuário logado na sessão ou no próprio dispositivo móvel e de acordo com a 
* query em @see $sql na tabela PLANOS 
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
    public function listPlanoPorUsuaIdStatus($usuaid, $status, $pag, $qtde, $coluna, $ordem)
    {
        $sql = DmlSqlPlano::SELECT 
        . ' WHERE ' . DmlSqlPlano::USUA_ID . " = $usuaid "
        . ' AND ' . DmlSqlPlano::PLAN_IN_STATUS . " = '$status'"
        . ' ORDER BY ' . $coluna . ($ordem == 0 ? " ASC": " DESC");
        return $this->listPagina($sql, $pag, $qtde);
    }

/**
* listPagina() - Listar um conjunto de registro previamente paginado
* e de acordo com a query em @see $sql na tabela PLANOS 
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
* na tabela PLANOS usando a Primary Key PLAN_ID
*
* @param $id
* @return PlanoDTO
*/ 
    public function loadPK($id)
    {   
        $retorno = NULL;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $res = $conexao->query(DmlSqlPlano::SELECT . ' WHERE ' . DmlSqlPlano::PLAN_ID . '=' . $id );
        if ($res->num_rows > 0){
            $retorno = $this->getDTO($res->fetch_assoc());
        }
        return $retorno;
    }

/**
* updateStatus() - atualizar o campo de STATUS utilizando a id como item de busca
* na tabela PLANOS usando a Primary Key PLAN_ID
*
* @param $id
* @param $status
*
* @return PlanoDTO
*/ 
    public function updateStatus($id, $status)
    {   
        $retorno = false;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $stmt = $conexao->prepare(DmlSqlPlano::UPD_STATUS);
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
* insert() - inserir um registro com base no PlanoDTO. Alguns atributos dentro do DTO
* serão ignorados caso estejam populados, pois os mesmos possuem constraint de DEFAULT value
* ou campos de AUTO INCREMENTO já previamente definidos no DDL de criação de tabelas do BD.
*
* Atributos da classe PlanoDTO sumariamente IGNORADOS por este método MESMO que estejam preenchidos:
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
        $stmt = $conexao->prepare(DmlSqlPlano::INS);
        $stmt->bind_param(DmlSql::STRING_TYPE 
                            . DmlSql::STRING_TYPE 
                            . DmlSql::DOUBLE_TYPE 
                            . DmlSql::STRING_TYPE 
                            ,$dto->nome
                            ,$dto->permissao
                            ,$dto->valor
                            ,$dto->tipo
        );
        if ($stmt->execute())
        {
            $retorno = true;
        }

        return $retorno;
    }

    /**
     * getDTO() - Transforma o resultset padrão em PlanoDTO
    */
    public function getDTO($resultset)
    {
        if(is_null($resultset)){
            return NULL;
        }

        //echo var_dump($resultset); // ótimo pra debugar
        $retorno = new PlanoDTO();
        $retorno->id = $resultset[DmlSqlPlano::PLAN_ID] == NULL ? NULL : $resultset[DmlSqlPlano::PLAN_ID];
        $retorno->nome = $resultset[DmlSqlPlano::PLAN_NM_PLANO] == NULL ? NULL : $resultset[DmlSqlPlano::PLAN_NM_PLANO];
        $retorno->permissao = $resultset[DmlSqlPlano::PLAN_TX_PERMISSAO] == NULL ? NULL : $resultset[DmlSqlPlano::PLAN_TX_PERMISSAO];
        $retorno->valor = $resultset[DmlSqlPlano::PLAN_VL_PLANO] == NULL ? NULL : $resultset[DmlSqlPlano::PLAN_VL_PLANO];
        $retorno->valorMoeda = $resultset[DmlSqlPlano::PLAN_VL_PLANO] == NULL ? Util::getMoeda(0.00) : Util::getMoeda((double) $resultset[DmlSqlPlano::PLAN_VL_PLANO]);
        $retorno->tipo = $resultset[DmlSqlPlano::PLAN_IN_TIPO] == NULL ? NULL : $resultset[DmlSqlPlano::PLAN_IN_TIPO];
        $retorno->status = $resultset[DmlSqlPlano::PLAN_IN_STATUS] == NULL ? NULL : $resultset[DmlSqlPlano::PLAN_IN_STATUS];
        $retorno->dataCadastro = Util::MySQLDate_to_DMYHMiS($resultset[DmlSqlPlano::PLAN_DT_CADASTRO]);
        $retorno->dataAtualizacao = Util::MySQLDate_to_DMYHMiS($resultset[DmlSqlPlano::PLAN_DT_UPDATE]);
        $retorno->statusdesc = VariavelCache::getInstance()->getStatusDesc($retorno->status);
        $retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
        $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);
        return $retorno;

    }

    /**
    * updateNome() - implementação da assinatura em PlanoDAO
    */
    public function updateNome($id, $nome)
    {   
        $retorno = false;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $stmt = $conexao->prepare(DmlSqlPlano::UPD_PLANOS_PLAN_NM_PLANO_PK);
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
    * updatePermissao() - implementação da assinatura em PlanoDAO
    */
    public function updatePermissao($id, $permissao)
    {   
        $retorno = false;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $stmt = $conexao->prepare(DmlSqlPlano::UPD_PLANOS_PLAN_TX_PERMISSAO_PK);
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
    * updateValor() - implementação da assinatura em PlanoDAO
    */
    public function updateValor($id, $valor)
    {   
        $retorno = false;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $stmt = $conexao->prepare(DmlSqlPlano::UPD_PLANOS_PLAN_VL_PLANO_PK);
        $stmt->bind_param(DmlSql::DOUBLE_TYPE 
                            . DmlSql::DOUBLE_TYPE
                            ,$valor
                            ,$id);
        if ($stmt->execute())
        {
            $retorno = true;
        }

        return $retorno;
    }

    /**
    * updateTipo() - implementação da assinatura em PlanoDAO
    */
    public function updateTipo($id, $tipo)
    {   
        $retorno = false;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $stmt = $conexao->prepare(DmlSqlPlano::UPD_PLANOS_PLAN_IN_TIPO_PK);
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
    * loadNome() - implementação da assinatura em PlanoDAO
    */

    public function loadNome($nome)
    {   
        $retorno = NULL;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $sql = DmlSqlPlano::SELECT . ' WHERE ' . DmlSqlPlano::PLAN_NM_PLANO . '=' . $nome;
        $res = $conexao->query($sql);
        if ($res){
            $retorno = $this->getDTO($res->fetch_assoc());
        }
        return $retorno;
    }
    /**
    * loadPermissao() - implementação da assinatura em PlanoDAO
    */

    public function loadPermissao($permissao)
    {   
        $retorno = NULL;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $sql = DmlSqlPlano::SELECT . ' WHERE ' . DmlSqlPlano::PLAN_TX_PERMISSAO . '=' . $permissao;
        $res = $conexao->query($sql);
        if ($res){
            $retorno = $this->getDTO($res->fetch_assoc());
        }
        return $retorno;
    }
    /**
    * loadValor() - implementação da assinatura em PlanoDAO
    */

    public function loadValor($valor)
    {   
        $retorno = NULL;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $sql = DmlSqlPlano::SELECT . ' WHERE ' . DmlSqlPlano::PLAN_VL_PLANO . '=' . $valor;
        $res = $conexao->query($sql);
        if ($res){
            $retorno = $this->getDTO($res->fetch_assoc());
        }
        return $retorno;
    }
    /**
    * loadTipo() - implementação da assinatura em PlanoDAO
    */

    public function loadTipo($tipo)
    {   
        $retorno = NULL;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $sql = DmlSqlPlano::SELECT . ' WHERE ' . DmlSqlPlano::PLAN_IN_TIPO . '=' . $tipo;
        $res = $conexao->query($sql);
        if ($res){
            $retorno = $this->getDTO($res->fetch_assoc());
        }
        return $retorno;
    }

    /**
    * loadStatus() - implementação da assinatura em PlanoDAO
    */

    public function loadStatus($status)
    {   
        $retorno = NULL;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $res = $conexao->query(DmlSqlPlano::SELECT . ' WHERE ' . DmlSqlPlano::PLAN_IN_STATUS . '=' . $status );
        if ($res){
            $retorno = $this->getDTO($res->fetch_assoc());
        }
        return $retorno;
    }

    /**
    * loadDatacadastro() - implementação da assinatura em PlanoDAO
    */

    public function loadDatacadastro($dataCadastro)
    {   
        $retorno = NULL;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $res = $conexao->query(DmlSqlPlano::SELECT . ' WHERE ' . DmlSqlPlano::PLAN_DT_CADASTRO . '=' . $dataCadastro );
        if ($res){
            $retorno = $this->getDTO($res->fetch_assoc());
        }
        return $retorno;
    }

    /**
    * loadDataatualizacao() - implementação da assinatura em PlanoDAO
    */

    public function loadDataatualizacao($dataAtualizacao)
    {   
        $retorno = NULL;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $res = $conexao->query(DmlSqlPlano::SELECT . ' WHERE ' . DmlSqlPlano::PLAN_DT_UPDATE . '=' . $dataAtualizacao );
        if ($res){
            $retorno = $this->getDTO($res->fetch_assoc());
        }
        return $retorno;
    }

}
?>
