<?php

/**
* MySqlKinghostFilaEmailDAO - Implementação DAO
*
* Classe de com todos os comandos DML e DDL (se necessário) para apoio 
* a classe MySqlKinghostFilaEmailDAO
* Não é uma camada visível para outros dispositivos, como as camadas de apresentação e aplicação. 
*
*
* Tabela principal de atuação: FILA_EMAIL
*
* Changelog:
*
* 
* @author Julio Cesar Vitorino
* @since 23/08/2019 10:06:20
*
*/
require_once 'FilaEmailDTO.php';
require_once 'FilaEmailDAO.php';
require_once 'DmlSqlFilaEmail.php';

require_once '../mensagem/ConstantesMensagem.php';
require_once '../mensagem/MensagemCache.php';
require_once '../variavel/VariavelCache.php';
require_once '../daofactory/DmlSql.php';
require_once '../email/EmailDTO.php';

class MySqlKinghostFilaEmailDAO implements FilaEmailDAO
{
    private $daofactory;

    function __construct($daofactory)
    {
        $this->daofactory = $daofactory;
    }


/**
* loadMaxNomefilaPK() - Carrega um MaxID (pk) para um ${CAMPO} e status
*
* @param $nomeFila
* @param $status
* @return $dto
*/ 

    public function loadMaxNomefilaPK($nomeFila,$status)
    {   
        $retorno = 0;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $sql = DmlSqlFilaEmail::SELECT_MAX_PK . ' WHERE ' 
        . DmlSqlFilaEmail::FIEM_NM_FILA . " = $nomeFila "
        . " AND " . DmlSqlFilaEmail::FIEM_IN_STATUS . " = '$status'";

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
* listAll() - Lista todos os registros provenientes de FILA_EMAIL sem critério de paginação
*
* @return List<FilaEmailDTO>[]
*/ 
    public function listAll()   {   }

/**
* update() - atualiza apenas um registro com base no dto FilaEmailDTO->id
* @param $daofactory
*
* @return boolean
*/ 
    public function update($dto)
    {   
        $retorno = false;

        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $stmt = $conexao->prepare(DmlSqlFilaEmail::UPD_PK);
        $stmt->bind_param(DmlSql::STRING_TYPE 
                            . DmlSql::STRING_TYPE 
                            . DmlSql::STRING_TYPE 
                            . DmlSql::STRING_TYPE 
                            . DmlSql::STRING_TYPE 
                            . DmlSql::STRING_TYPE 
                            . DmlSql::INTEGER_TYPE 
                            . DmlSql::INTEGER_TYPE 
                            . DmlSql::STRING_TYPE 
                            . DmlSql::STRING_TYPE 
                            . DmlSql::INTEGER_TYPE 
                            ,$dto->nomeFila
                            ,$dto->emailDe
                            ,$dto->emailPara
                            ,$dto->assunto
                            ,$dto->prioridade
                            ,$dto->template
                            ,$dto->nrMaxTentativas
                            ,$dto->nrRealTentativas
                            ,$dto->dataPrevisaoEnvio
                            ,$dto->dataRealEnvio
                            ,$dto->id );
        if ($stmt->execute())
        {
            $retorno = true;
        }

        return $retorno;
    }

/**
* delete() - excluir fisicamente um registro com base no dto FilaEmailDTO->id
*
* @return boolean
*/ 
    public function delete($dto)
    {   
        $retorno = false;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $stmt = $conexao->prepare(DmlSqlFilaEmail::DEL_PK);
        $stmt->bind_param(DmlSql::INTEGER_TYPE
                            ,$dto->id);
        if ($stmt->execute())
        {
            $retorno = true;
        }

        return $retorno;
    }


    public function listFilaEmailStatus($status)
    {
        $retorno = array();

        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $res = $conexao->query(DmlSqlFilaEmail::SELECT . 'WHERE `' . DmlSqlFilaEmail::FIEM_IN_STATUS . "` = '$status'" );
        if ($res){
            while ($row = $res->fetch_assoc()) {
                array_push($retorno, $this->getDTO($row));
            }
        }
        return $retorno;
    }

/**
* countFilaEmailPorStatus() - contar a quantidade de registros
* sob o contexto da classe FilaEmail com base no status específico. 
*
* Atenção em @see $sql na tabela FILA_EMAIL 
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

    public function countFilaEmailPorStatus($status)
    {   
        $retorno = 0;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $res = $conexao->query(DmlSqlFilaEmail::SQL_COUNT . ' WHERE ' 
        . DmlSqlFilaEmail::FIEM_IN_STATUS . " = '$status'"
        );
        if ($res){
            $tmp = $res->fetch_assoc();
            $retorno = $tmp['contador'];
        }
        return $retorno;

    }

/**
* listFilaEmailPorStatus() - Listar um conjunto de registro previamente paginado
* sob o contexto da classe FilaEmail com base no status específico.
*
* Atenção em @see $sql na tabela FILA_EMAIL 
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

    public function listFilaEmailPorStatus($status, $pag, $qtde, $coluna, $ordem)
    {
        $sql = DmlSqlFilaEmail::SELECT 
        . ' WHERE ' . DmlSqlFilaEmail::FIEM_IN_STATUS . " = '$status'"
        . ' ORDER BY ' . $coluna . ($ordem == 0 ? " ASC": " DESC");
        return $this->listPagina($sql, $pag, $qtde);
    }

/**
* countFilaEmailPorUsuaIdStatus() - contar a quantidade de registros
* sob o contexto da classe FilaEmail com base no usuário específico. Esse usuário
* é o usuário logado na sessão ou no próprio dispositivo móvel e de acordo com a 
* query em @see $sql na tabela FILA_EMAIL 
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

    public function countFilaEmailPorUsuaIdStatus($usuaid, $status)
    {   
        $retorno = 0;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $res = $conexao->query(DmlSqlFilaEmail::SQL_COUNT . ' WHERE ' 
        . DmlSqlFilaEmail::USUA_ID . " = $usuaid "
        . ' AND ' . DmlSqlFilaEmail::FIEM_IN_STATUS . " = '$status'"
        );
        if ($res){
            $tmp = $res->fetch_assoc();
            $retorno = $tmp['contador'];
        }
        return $retorno;

    }

/**
* listFilaEmailPorUsuaIdStatus() - Listar um conjunto de registro previamente paginado
* sob o contexto da classe FilaEmail com base no usuário específico. Esse usuário
* é o usuário logado na sessão ou no próprio dispositivo móvel e de acordo com a 
* query em @see $sql na tabela FILA_EMAIL 
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
    public function listFilaEmailPorUsuaIdStatus($usuaid, $status, $pag, $qtde, $coluna, $ordem)
    {
        $sql = DmlSqlFilaEmail::SELECT 
        . ' WHERE ' . DmlSqlFilaEmail::USUA_ID . " = $usuaid "
        . ' AND ' . DmlSqlFilaEmail::FIEM_IN_STATUS . " = '$status'"
        . ' ORDER BY ' . $coluna . ($ordem == 0 ? " ASC": " DESC");
        return $this->listPagina($sql, $pag, $qtde);
    }

/**
* listPagina() - Listar um conjunto de registro previamente paginado
* e de acordo com a query em @see $sql na tabela FILA_EMAIL 
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
* na tabela FILA_EMAIL usando a Primary Key FIEM_ID
*
* @param $id
* @return FilaEmailDTO
*/ 
    public function loadPK($id)
    {   
        $retorno = NULL;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $res = $conexao->query(DmlSqlFilaEmail::SELECT . ' WHERE ' . DmlSqlFilaEmail::FIEM_ID . '=' . $id );
        if ($res->num_rows > 0){
            $retorno = $this->getDTO($res->fetch_assoc());
        }
        return $retorno;
    }

/**
* updateStatus() - atualizar o campo de STATUS utilizando a id como item de busca
* na tabela FILA_EMAIL usando a Primary Key FIEM_ID
*
* @param $id
* @param $status
*
* @return FilaEmailDTO
*/ 
    public function updateStatus($id, $status)
    {   
        $retorno = false;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $stmt = $conexao->prepare(DmlSqlFilaEmail::UPD_STATUS);
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
* insert() - inserir um registro com base no FilaEmailDTO. Alguns atributos dentro do DTO
* serão ignorados caso estejam populados, pois os mesmos possuem constraint de DEFAULT value
* ou campos de AUTO INCREMENTO já previamente definidos no DDL de criação de tabelas do BD.
*
* Atributos da classe FilaEmailDTO sumariamente IGNORADOS por este método MESMO que estejam preenchidos:
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
        $stmt = $conexao->prepare(DmlSqlFilaEmail::INS);
        $stmt->bind_param(DmlSql::STRING_TYPE 
                            . DmlSql::STRING_TYPE 
                            . DmlSql::STRING_TYPE 
                            . DmlSql::STRING_TYPE 
                            . DmlSql::STRING_TYPE 
                            . DmlSql::STRING_TYPE 
                            . DmlSql::INTEGER_TYPE 
                            . DmlSql::STRING_TYPE 
                            ,$dto->nomeFila
                            ,$dto->emailDe
                            ,$dto->email->emaildestinatario
                            ,$dto->email->assunto
                            ,$dto->prioridade
                            ,$dto->email->template
                            ,$dto->nrMaxTentativas
                            ,$dto->dataPrevisaoEnvio
        );
        if ($stmt->execute())
        {
            $retorno = true;
        }

        return $retorno;
    }

    /**
     * getDTO() - Transforma o resultset padrão em FilaEmailDTO
    */
    public function getDTO($resultset)
    {
        if(is_null($resultset)){
            return NULL;
        }

        //echo var_dump($resultset); // ótimo pra debugar
        $retorno = new FilaEmailDTO();
        $retorno->email = new EmailDTO(); 
        $retorno->id = $resultset[DmlSqlFilaEmail::FIEM_ID] == NULL ? NULL : $resultset[DmlSqlFilaEmail::FIEM_ID];
        $retorno->nomeFila = $resultset[DmlSqlFilaEmail::FIEM_NM_FILA] == NULL ? NULL : $resultset[DmlSqlFilaEmail::FIEM_NM_FILA];
        $retorno->emailDe = $resultset[DmlSqlFilaEmail::FIEM_TX_EMAIL_DE] == NULL ? NULL : $resultset[DmlSqlFilaEmail::FIEM_TX_EMAIL_DE];
        $retorno->email->emaildestinatario = $resultset[DmlSqlFilaEmail::FIEM_TX_EMAIL_PARA] == NULL ? NULL : $resultset[DmlSqlFilaEmail::FIEM_TX_EMAIL_PARA];
        $retorno->email->assunto = $resultset[DmlSqlFilaEmail::FIEM_TX_ASSUNTO] == NULL ? NULL : $resultset[DmlSqlFilaEmail::FIEM_TX_ASSUNTO];
        $retorno->prioridade = $resultset[DmlSqlFilaEmail::FIEM_IN_PRIOR] == NULL ? NULL : $resultset[DmlSqlFilaEmail::FIEM_IN_PRIOR];
        $retorno->email->template = $resultset[DmlSqlFilaEmail::FIEM_TX_TEMPLATE] == NULL ? NULL : $resultset[DmlSqlFilaEmail::FIEM_TX_TEMPLATE];
        $retorno->nrMaxTentativas = $resultset[DmlSqlFilaEmail::FIEM_NU_MAX_TENTATIVA] == NULL ? NULL : $resultset[DmlSqlFilaEmail::FIEM_NU_MAX_TENTATIVA];
        $retorno->nrRealTentativas = $resultset[DmlSqlFilaEmail::FIEM_NU_TENTATIVA_REAL] == NULL ? NULL : $resultset[DmlSqlFilaEmail::FIEM_NU_TENTATIVA_REAL];
        $retorno->dataPrevisaoEnvio = $resultset[DmlSqlFilaEmail::FIEM_DT_PREV_ENVIO] == NULL ? NULL : $resultset[DmlSqlFilaEmail::FIEM_DT_PREV_ENVIO];
        $retorno->dataRealEnvio = $resultset[DmlSqlFilaEmail::FIEM_DT_REAL_ENVIO] == NULL ? NULL : $resultset[DmlSqlFilaEmail::FIEM_DT_REAL_ENVIO];
        $retorno->status = $resultset[DmlSqlFilaEmail::FIEM_IN_STATUS] == NULL ? NULL : $resultset[DmlSqlFilaEmail::FIEM_IN_STATUS];
        $retorno->dataCadastro = Util::MySQLDate_to_DMYHMiS($resultset[DmlSqlFilaEmail::FIEM_DT_CADASTRO]);
        $retorno->dataAtualizacao = Util::MySQLDate_to_DMYHMiS($resultset[DmlSqlFilaEmail::FIEM_DT_UPDATE]);
        $retorno->statusdesc = VariavelCache::getInstance()->getStatusDesc($retorno->status);
        $retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
        $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);
        return $retorno;

    }

    /**
    * updateNomefila() - implementação da assinatura em FilaEmailDAO
    */
    public function updateNomefila($id, $nomeFila)
    {   
        $retorno = false;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $stmt = $conexao->prepare(DmlSqlFilaEmail::UPD_FILA_EMAIL_FIEM_NM_FILA_PK);
        $stmt->bind_param(DmlSql::STRING_TYPE 
                            . DmlSql::STRING_TYPE
                            ,$nomeFila
                            ,$id);
        if ($stmt->execute())
        {
            $retorno = true;
        }

        return $retorno;
    }

    /**
    * updateEmailde() - implementação da assinatura em FilaEmailDAO
    */
    public function updateEmailde($id, $emailDe)
    {   
        $retorno = false;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $stmt = $conexao->prepare(DmlSqlFilaEmail::UPD_FILA_EMAIL_FIEM_TX_EMAIL_DE_PK);
        $stmt->bind_param(DmlSql::STRING_TYPE 
                            . DmlSql::STRING_TYPE
                            ,$emailDe
                            ,$id);
        if ($stmt->execute())
        {
            $retorno = true;
        }

        return $retorno;
    }

    /**
    * updateEmailpara() - implementação da assinatura em FilaEmailDAO
    */
    public function updateEmailpara($id, $emailPara)
    {   
        $retorno = false;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $stmt = $conexao->prepare(DmlSqlFilaEmail::UPD_FILA_EMAIL_FIEM_TX_EMAIL_PARA_PK);
        $stmt->bind_param(DmlSql::STRING_TYPE 
                            . DmlSql::STRING_TYPE
                            ,$emailPara
                            ,$id);
        if ($stmt->execute())
        {
            $retorno = true;
        }

        return $retorno;
    }

    /**
    * updateAssunto() - implementação da assinatura em FilaEmailDAO
    */
    public function updateAssunto($id, $assunto)
    {   
        $retorno = false;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $stmt = $conexao->prepare(DmlSqlFilaEmail::UPD_FILA_EMAIL_FIEM_TX_ASSUNTO_PK);
        $stmt->bind_param(DmlSql::STRING_TYPE 
                            . DmlSql::STRING_TYPE
                            ,$assunto
                            ,$id);
        if ($stmt->execute())
        {
            $retorno = true;
        }

        return $retorno;
    }

    /**
    * updatePrioridade() - implementação da assinatura em FilaEmailDAO
    */
    public function updatePrioridade($id, $prioridade)
    {   
        $retorno = false;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $stmt = $conexao->prepare(DmlSqlFilaEmail::UPD_FILA_EMAIL_FIEM_IN_PRIOR_PK);
        $stmt->bind_param(DmlSql::STRING_TYPE 
                            . DmlSql::STRING_TYPE
                            ,$prioridade
                            ,$id);
        if ($stmt->execute())
        {
            $retorno = true;
        }

        return $retorno;
    }

    /**
    * updateTemplate() - implementação da assinatura em FilaEmailDAO
    */
    public function updateTemplate($id, $template)
    {   
        $retorno = false;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $stmt = $conexao->prepare(DmlSqlFilaEmail::UPD_FILA_EMAIL_FIEM_TX_TEMPLATE_PK);
        $stmt->bind_param(DmlSql::STRING_TYPE 
                            . DmlSql::STRING_TYPE
                            ,$template
                            ,$id);
        if ($stmt->execute())
        {
            $retorno = true;
        }

        return $retorno;
    }

    /**
    * updateNrmaxtentativas() - implementação da assinatura em FilaEmailDAO
    */
    public function updateNrmaxtentativas($id, $nrMaxTentativas)
    {   
        $retorno = false;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $stmt = $conexao->prepare(DmlSqlFilaEmail::UPD_FILA_EMAIL_FIEM_NU_MAX_TENTATIVA_PK);
        $stmt->bind_param(DmlSql::INTEGER_TYPE 
                            . DmlSql::INTEGER_TYPE
                            ,$nrMaxTentativas
                            ,$id);
        if ($stmt->execute())
        {
            $retorno = true;
        }

        return $retorno;
    }

    /**
    * updateNrrealtentativas() - implementação da assinatura em FilaEmailDAO
    */
    public function updateNrrealtentativas($id, $nrRealTentativas)
    {   
        $retorno = false;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $stmt = $conexao->prepare(DmlSqlFilaEmail::UPD_FILA_EMAIL_FIEM_NU_TENTATIVA_REAL_PK);
        $stmt->bind_param(DmlSql::INTEGER_TYPE 
                            . DmlSql::INTEGER_TYPE
                            ,$nrRealTentativas
                            ,$id);
        if ($stmt->execute())
        {
            $retorno = true;
        }

        return $retorno;
    }

    /**
    * updateDataprevisaoenvio() - implementação da assinatura em FilaEmailDAO
    */
    public function updateDataprevisaoenvio($id, $dataPrevisaoEnvio)
    {   
        $retorno = false;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $stmt = $conexao->prepare(DmlSqlFilaEmail::UPD_FILA_EMAIL_FIEM_DT_PREV_ENVIO_PK);
        $stmt->bind_param(DmlSql::STRING_TYPE 
                            . DmlSql::STRING_TYPE
                            ,$dataPrevisaoEnvio
                            ,$id);
        if ($stmt->execute())
        {
            $retorno = true;
        }

        return $retorno;
    }

    /**
    * updateDatarealenvio() - implementação da assinatura em FilaEmailDAO
    */
    public function updateDatarealenvio($id, $dataRealEnvio)
    {   
        $retorno = false;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $stmt = $conexao->prepare(DmlSqlFilaEmail::UPD_FILA_EMAIL_FIEM_DT_REAL_ENVIO_PK);
        $stmt->bind_param(DmlSql::STRING_TYPE 
                            . DmlSql::STRING_TYPE
                            ,$dataRealEnvio
                            ,$id);
        if ($stmt->execute())
        {
            $retorno = true;
        }

        return $retorno;
    }


    /**
    * loadNomefila() - implementação da assinatura em FilaEmailDAO
    */

    public function loadNomefila($nomeFila)
    {   
        $retorno = NULL;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $res = $conexao->query(DmlSqlFilaEmail::SELECT . ' WHERE ' . DmlSqlFilaEmail::FIEM_NM_FILA . '=' . $nomeFila );
        if ($res){
            $retorno = $this->getDTO($res->fetch_assoc());
        }
        return $retorno;
    }

    /**
    * loadEmailde() - implementação da assinatura em FilaEmailDAO
    */

    public function loadEmailde($emailDe)
    {   
        $retorno = NULL;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $res = $conexao->query(DmlSqlFilaEmail::SELECT . ' WHERE ' . DmlSqlFilaEmail::FIEM_TX_EMAIL_DE . '=' . $emailDe );
        if ($res){
            $retorno = $this->getDTO($res->fetch_assoc());
        }
        return $retorno;
    }

    /**
    * loadEmailpara() - implementação da assinatura em FilaEmailDAO
    */

    public function loadEmailpara($emailPara)
    {   
        $retorno = NULL;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $res = $conexao->query(DmlSqlFilaEmail::SELECT . ' WHERE ' . DmlSqlFilaEmail::FIEM_TX_EMAIL_PARA . '=' . $emailPara );
        if ($res){
            $retorno = $this->getDTO($res->fetch_assoc());
        }
        return $retorno;
    }

    /**
    * loadAssunto() - implementação da assinatura em FilaEmailDAO
    */

    public function loadAssunto($assunto)
    {   
        $retorno = NULL;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $res = $conexao->query(DmlSqlFilaEmail::SELECT . ' WHERE ' . DmlSqlFilaEmail::FIEM_TX_ASSUNTO . '=' . $assunto );
        if ($res){
            $retorno = $this->getDTO($res->fetch_assoc());
        }
        return $retorno;
    }

    /**
    * loadPrioridade() - implementação da assinatura em FilaEmailDAO
    */

    public function loadPrioridade($prioridade)
    {   
        $retorno = NULL;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $res = $conexao->query(DmlSqlFilaEmail::SELECT . ' WHERE ' . DmlSqlFilaEmail::FIEM_IN_PRIOR . '=' . $prioridade );
        if ($res){
            $retorno = $this->getDTO($res->fetch_assoc());
        }
        return $retorno;
    }

    /**
    * loadTemplate() - implementação da assinatura em FilaEmailDAO
    */

    public function loadTemplate($template)
    {   
        $retorno = NULL;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $res = $conexao->query(DmlSqlFilaEmail::SELECT . ' WHERE ' . DmlSqlFilaEmail::FIEM_TX_TEMPLATE . '=' . $template );
        if ($res){
            $retorno = $this->getDTO($res->fetch_assoc());
        }
        return $retorno;
    }

    /**
    * loadNrmaxtentativas() - implementação da assinatura em FilaEmailDAO
    */

    public function loadNrmaxtentativas($nrMaxTentativas)
    {   
        $retorno = NULL;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $res = $conexao->query(DmlSqlFilaEmail::SELECT . ' WHERE ' . DmlSqlFilaEmail::FIEM_NU_MAX_TENTATIVA . '=' . $nrMaxTentativas );
        if ($res){
            $retorno = $this->getDTO($res->fetch_assoc());
        }
        return $retorno;
    }

    /**
    * loadNrrealtentativas() - implementação da assinatura em FilaEmailDAO
    */

    public function loadNrrealtentativas($nrRealTentativas)
    {   
        $retorno = NULL;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $res = $conexao->query(DmlSqlFilaEmail::SELECT . ' WHERE ' . DmlSqlFilaEmail::FIEM_NU_TENTATIVA_REAL . '=' . $nrRealTentativas );
        if ($res){
            $retorno = $this->getDTO($res->fetch_assoc());
        }
        return $retorno;
    }

    /**
    * loadDataprevisaoenvio() - implementação da assinatura em FilaEmailDAO
    */

    public function loadDataprevisaoenvio($dataPrevisaoEnvio)
    {   
        $retorno = NULL;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $res = $conexao->query(DmlSqlFilaEmail::SELECT . ' WHERE ' . DmlSqlFilaEmail::FIEM_DT_PREV_ENVIO . '=' . $dataPrevisaoEnvio );
        if ($res){
            $retorno = $this->getDTO($res->fetch_assoc());
        }
        return $retorno;
    }

    /**
    * loadDatarealenvio() - implementação da assinatura em FilaEmailDAO
    */

    public function loadDatarealenvio($dataRealEnvio)
    {   
        $retorno = NULL;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $res = $conexao->query(DmlSqlFilaEmail::SELECT . ' WHERE ' . DmlSqlFilaEmail::FIEM_DT_REAL_ENVIO . '=' . $dataRealEnvio );
        if ($res){
            $retorno = $this->getDTO($res->fetch_assoc());
        }
        return $retorno;
    }

    /**
    * loadStatus() - implementação da assinatura em FilaEmailDAO
    */

    public function loadStatus($status)
    {   
        $retorno = NULL;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $res = $conexao->query(DmlSqlFilaEmail::SELECT . ' WHERE ' . DmlSqlFilaEmail::FIEM_IN_STATUS . '=' . $status );
        if ($res){
            $retorno = $this->getDTO($res->fetch_assoc());
        }
        return $retorno;
    }

    /**
    * loadDatacadastro() - implementação da assinatura em FilaEmailDAO
    */

    public function loadDatacadastro($dataCadastro)
    {   
        $retorno = NULL;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $res = $conexao->query(DmlSqlFilaEmail::SELECT . ' WHERE ' . DmlSqlFilaEmail::FIEM_DT_CADASTRO . '=' . $dataCadastro );
        if ($res){
            $retorno = $this->getDTO($res->fetch_assoc());
        }
        return $retorno;
    }

    /**
    * loadDataatualizacao() - implementação da assinatura em FilaEmailDAO
    */

    public function loadDataatualizacao($dataAtualizacao)
    {   
        $retorno = NULL;
        // prepara sessão, query, troca de valores, acoplagem do resultado e o fetch
        $conexao = $this->daofactory->getSession();
        $res = $conexao->query(DmlSqlFilaEmail::SELECT . ' WHERE ' . DmlSqlFilaEmail::FIEM_DT_UPDATE . '=' . $dataAtualizacao );
        if ($res){
            $retorno = $this->getDTO($res->fetch_assoc());
        }
        return $retorno;
    }

}
?>

