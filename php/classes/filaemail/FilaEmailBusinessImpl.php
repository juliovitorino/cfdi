<?php 

// importar dependencias
require_once 'FilaEmailBusiness.php';
require_once 'FilaEmailConstantes.php';
require_once 'FilaEmailHelper.php';
require_once '../dto/DTOPadrao.php';
require_once '../dto/DTOPaginacao.php';

require_once '../variavel/ConstantesVariavel.php';
require_once '../variavel/VariavelCache.php';

/**
*
* FilaEmailBusinessImpl - Classe de implementação dos métodos de negócio para a interface FilaEmailBusiness
* Camada de negócio FilaEmail - camada responsável pela lógica de negócios de FilaEmail do sistema. 
* Não é uma camada visível para outros dispositivos, como as camadas de apresentação e aplicação. 
*
*
* Responsabilidades dessa classe
*
* 1) Receber o pedido de uma classe de negócio do sistema
* 2) Produzir a regra de negócio de acordo com cada método
* 3) Acessar o banco de dados através das interfaces DAOs
* 4) Verificar o resultado e retornar um objeto e uma mensagem de alto nível para a camada de serviço
*
* Changelog:
*
* 
* @autor Julio Cesar Vitorino
* @since 01/09/2021 15:29:49
*
*/


class FilaEmailBusinessImpl implements FilaEmailBusiness
{
    
    function __construct()  {   }

/**
* carregar() - Carrega apenas um registro com base no campo id = (FILA_EMAIL::FIEM_ID)
* @param $daofactory
* @param $dto
* @return $dto
*/ 
    public function carregar($daofactory, $dto) {   }

/**
* listarTudo() - Lista todos os registros provenientes de FILA_EMAIL sem critério de paginação
* @param $daofactory
* @return List<FilaEmailDTO>[]
*/ 
    public function listarTudo($daofactory) {   }

/**
* pesquisarMaxPKAtivoNomefilaPorStatus() - Carrega apenas um registro com base no nomeFila  e status para buscar a MAIOR PK
* @param $daofactory
* @param $status
* @return FilaEmailDTO
*/ 
    public function pesquisarMaxPKAtivoNomefilaPorStatus($daofactory, $nomeFila,$status)
    { 
        $dao = $daofactory->getFilaEmailDAO($daofactory);
        $maxid = $dao->loadMaxNomefilaPK($nomeFila,$status);
        return $this->carregarPorID($daofactory, $maxid);
    }

/**
* atualizar() - atualiza apenas um registro com base no dto FilaEmailDTO->id
* @param $daofactory
*
* @return $dto
* @see ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO
* @see ConstantesMensagem::ERRO_CRUD_ATUALIZAR_REGISTRO
*/ 

    public function atualizar($daofactory, $dto)    
    {   
        // retorno default
        $retorno = new DTOPadrao();
        $retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
        $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);


        $dao = $daofactory->getFilaEmailDAO($daofactory);
        if(!$dao->update($dto)){
           $retorno->msgcode = ConstantesMensagem::ERRO_CRUD_ATUALIZAR_REGISTRO;
           $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);
    
        }
        // retorna situação
        return $retorno;

    }

/**
* deletar() - excluir fisicamente um registro com base no dto FilaEmailDTO->id
* @param $daofactory
*
* @return $dto
* @see ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO
* @see ConstantesMensagem::ERRO_CRUD_EXCLUIR_REGISTRO
*/ 
    
    public function deletar($daofactory, $dto)  
    {   
        // retorno default
        $retorno = new DTOPadrao();
        $retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
        $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);
        $dao = $daofactory->getFilaEmailDAO($daofactory);

        if(!$dao->delete($dto)){
           $retorno->msgcode = ConstantesMensagem::ERRO_CRUD_EXCLUIR_REGISTRO;
           $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);
        }

        return $retorno;
    }

/**
* listarPagina() - listar registros de forma paginada
* @param $daofactory
* @param $pag
* @param $qtde
*
* @return List<FilaEmailDTO>[]
* @deprecated
*/ 

    public function listarPagina($daofactory, $pag, $qtde)  
    {   
        $dao = $daofactory->getFilaEmailDAO($daofactory);
        return $dao->listPagina($pag, $qtde);
    }

/**
* carregarPorID() - Carrega APENAS um registro usando a id como item de busca
* na tabela FILA_EMAIL usando a Primary Key FIEM_ID
*
* @param $daofactory
* @param $id
* @param $qtde
*
* @return FilaEmailDTO
*/ 
    public function carregarPorID($daofactory, $id)
    { 
        $dao = $daofactory->getFilaEmailDAO($daofactory);
        return $dao->loadPK($id);
    }

/**
* atualizarStatus() - atualizar o campo de STATUS utilizando a id como item de busca
* na tabela FILA_EMAIL usando a Primary Key FIEM_ID
*
* @param $daofactory
* @param $id
* @param $status
*
* @return FilaEmailDTO
*/ 
    public function atualizarStatus($daofactory, $id, $status)
    {
        $dao = $daofactory->getFilaEmailDAO($daofactory);

        // resposta padrão
        $retorno = new DTOPadrao();

        // obtem o status atual da campanha
        $dto = $this->carregarPorID($daofactory, $id);

            if($dao->updateStatus($id, $status)){   
                $retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
            }       

        // Obtem o texto da mensagem em razão do código de retorno
        $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);

        return $retorno;
    }

/**
* inserirFilaEmail() - inserir um registro com base no FilaEmailDTO. Alguns atributos dentro do DTO
* serão ignorados caso estejam populados.
*
* Atributos da classe FundoParticipacaoGlobalDTO sumariamente IGNORADOS por este método MESMO que estejam preenchidos:
* id
* status
* dataCadastro
* dataAtualizacao
*
* @param $daofactory
*
* @return DTOPadrao
*/ 
public function inserirFilaEmail($daofactory, $dto)
{ 
    $retorno = new DTOPadrao();
    $retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
    $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);

    // Regras de Negócio
    // ...
    

    //--- Tudo ok com regras de negócio. Pode inserir o registro 
    // Prepara registro  de bonificação


    return $this->inserir($daofactory, $dto);
}


/**
* inserir() - inserir um registro com base no FilaEmailDTO. Alguns atributos dentro do DTO
* serão ignorados caso estejam populados.
*
* Atributos da classe FilaEmailDTO sumariamente IGNORADOS por este método MESMO que estejam preenchidos:
* id
* status
* dataCadastro
* dataAtualizacao
*
* @param $daofactory
*
* @return DTOPadrao
*/ 
public function inserir($daofactory, $dto)
{ 
    $retorno = new DTOPadrao();
    $retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
    $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);

    // Efetua validações no campo $dto->id com tamanho FilaEmailConstantes::LEN_ID
    $ok = $this->validarTamanhoCampo($dto->id, FilaEmailConstantes::LEN_ID, FilaEmailConstantes::DESC_ID);
    if($ok->msgcode != ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO){
        return $ok;
    }

    // Efetua validações no campo $dto->nomeFila com tamanho FilaEmailConstantes::LEN_NOMEFILA
    $ok = $this->validarTamanhoCampo($dto->nomeFila, FilaEmailConstantes::LEN_NOMEFILA, FilaEmailConstantes::DESC_NOMEFILA);
    if($ok->msgcode != ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO){
        return $ok;
    }

    // Efetua validações no campo $dto->emailDe com tamanho FilaEmailConstantes::LEN_EMAILDE
    $ok = $this->validarTamanhoCampo($dto->emailDe, FilaEmailConstantes::LEN_EMAILDE, FilaEmailConstantes::DESC_EMAILDE);
    if($ok->msgcode != ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO){
        return $ok;
    }

    // Efetua validações no campo $dto->emailPara com tamanho FilaEmailConstantes::LEN_EMAILPARA
    $ok = $this->validarTamanhoCampo($dto->email->emaildestinatario, FilaEmailConstantes::LEN_EMAILPARA, FilaEmailConstantes::DESC_EMAILPARA);
    if($ok->msgcode != ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO){
        return $ok;
    }

    // Efetua validações no campo $dto->assunto com tamanho FilaEmailConstantes::LEN_ASSUNTO
    $ok = $this->validarTamanhoCampo($dto->email->assunto, FilaEmailConstantes::LEN_ASSUNTO, FilaEmailConstantes::DESC_ASSUNTO);
    if($ok->msgcode != ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO){
        return $ok;
    }

    // Efetua validações no campo $dto->prioridade com tamanho FilaEmailConstantes::LEN_PRIORIDADE
    $ok = $this->validarTamanhoCampo($dto->prioridade, FilaEmailConstantes::LEN_PRIORIDADE, FilaEmailConstantes::DESC_PRIORIDADE);
    if($ok->msgcode != ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO){
        return $ok;
    }

    // Efetua validações no campo $dto->template com tamanho FilaEmailConstantes::LEN_TEMPLATE
    $ok = $this->validarTamanhoCampo($dto->email->template, FilaEmailConstantes::LEN_TEMPLATE, FilaEmailConstantes::DESC_TEMPLATE);
    if($ok->msgcode != ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO){
        return $ok;
    }

    // Efetua validações no campo $dto->nrMaxTentativas com tamanho FilaEmailConstantes::LEN_NRMAXTENTATIVAS
    $ok = $this->validarTamanhoCampo($dto->nrMaxTentativas, FilaEmailConstantes::LEN_NRMAXTENTATIVAS, FilaEmailConstantes::DESC_NRMAXTENTATIVAS);
    if($ok->msgcode != ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO){
        return $ok;
    }

    // Efetua validações no campo $dto->nrRealTentativas com tamanho FilaEmailConstantes::LEN_NRREALTENTATIVAS
    $ok = $this->validarTamanhoCampo($dto->nrRealTentativas, FilaEmailConstantes::LEN_NRREALTENTATIVAS, FilaEmailConstantes::DESC_NRREALTENTATIVAS);
    if($ok->msgcode != ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO){
        return $ok;
    }

    // Efetua validações no campo $dto->dataPrevisaoEnvio com tamanho FilaEmailConstantes::LEN_DATAPREVISAOENVIO
    $ok = $this->validarTamanhoCampo($dto->dataPrevisaoEnvio, FilaEmailConstantes::LEN_DATAPREVISAOENVIO, FilaEmailConstantes::DESC_DATAPREVISAOENVIO);
    if($ok->msgcode != ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO){
        return $ok;
    }

    // Efetua validações no campo $dto->dataRealEnvio com tamanho FilaEmailConstantes::LEN_DATAREALENVIO
    $ok = $this->validarTamanhoCampo($dto->dataRealEnvio, FilaEmailConstantes::LEN_DATAREALENVIO, FilaEmailConstantes::DESC_DATAREALENVIO);
    if($ok->msgcode != ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO){
        return $ok;
    }

    // Efetua validações no campo $dto->status com tamanho FilaEmailConstantes::LEN_STATUS
    $ok = $this->validarTamanhoCampo($dto->status, FilaEmailConstantes::LEN_STATUS, FilaEmailConstantes::DESC_STATUS);
    if($ok->msgcode != ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO){
        return $ok;
    }

    // Efetua validações no campo $dto->dataCadastro com tamanho FilaEmailConstantes::LEN_DATACADASTRO
    $ok = $this->validarTamanhoCampo($dto->dataCadastro, FilaEmailConstantes::LEN_DATACADASTRO, FilaEmailConstantes::DESC_DATACADASTRO);
    if($ok->msgcode != ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO){
        return $ok;
    }

    // Efetua validações no campo $dto->dataAtualizacao com tamanho FilaEmailConstantes::LEN_DATAATUALIZACAO
    $ok = $this->validarTamanhoCampo($dto->dataAtualizacao, FilaEmailConstantes::LEN_DATAATUALIZACAO, FilaEmailConstantes::DESC_DATAATUALIZACAO);
    if($ok->msgcode != ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO){
        return $ok;
    }


    $dto->status = ConstantesVariavel::STATUS_ATIVO;
    $dao = $daofactory->getFilaEmailDAO($daofactory);

    if (!$dao->insert($dto)) {
        $retorno = new DTOPadrao();
        $retorno->msgcode = ConstantesMensagem::ERRO_CRUD_INSERIR_REGISTRO;
        $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);
        return $retorno;
    }

    return $retorno;
}

/**
*
* listarFilaEmailPorStatus() - Usado para invocar a interface de acesso aos dados (DAO) FilaEmailDAO de forma geral
* realizar lista paginada de registros com uma instância de PaginacaoDTO
*
* @param $daofactory
* @param $status
* @param $pag
* @param $qtde
* @param $coluna
* @param $ordem
* @return $PaginacaoDTO
*/

    public function listarFilaEmailPorStatus($daofactory, $status, $pag, $qtde, $coluna, $ordem)
    {   
        $retorno = new DTOPaginacao();
        $retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
        $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);

        $dao = $daofactory->getFilaEmailDAO($daofactory);
        $retorno->pagina = $pag;
        $retorno->itensPorPagina = ($qtde == 0 
        ? (int) VariavelCache::getInstance()->getVariavel(ConstantesVariavel::MAXIMO_LINHAS_POR_PAGINA_DEFAULT)
        : $qtde);
        $retorno->totalPaginas = ceil($dao->countFilaEmailPorStatus($status) / $retorno->itensPorPagina);

        if($pag > $retorno->totalPaginas) {
            $retorno->msgcode = ConstantesMensagem::NAO_EXISTEM_MAIS_PAGINAS_APRESENTAR;
            $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);
            return $retorno;
        }
        $retorno->lst = $dao->listFilaEmailPorStatus($status, $pag, $retorno->itensPorPagina, $coluna, $ordem);

        return $retorno;
    }



/**
*
* listarFilaEmailPorFilaStatus() - Usado para invocar a interface de acesso aos dados (DAO) FilaEmailDAO de forma geral
* realizar lista paginada de registros com uma instância de PaginacaoDTO
*
* @param $daofactory
* @param $status
* @param $pag
* @param $qtde
* @param $coluna
* @param $ordem
* @return $PaginacaoDTO
*/

    public function listarFilaEmailPorFilaStatus($daofactory, $fila, $status, $pag, $qtde, $coluna, $ordem)
    {   
        $retorno = new DTOPaginacao();
        $retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
        $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);

        $dao = $daofactory->getFilaEmailDAO($daofactory);
        $retorno->pagina = $pag;
        $retorno->itensPorPagina = ($qtde == 0 
        ? (int) VariavelCache::getInstance()->getVariavel(ConstantesVariavel::MAXIMO_LINHAS_POR_PAGINA_DEFAULT)
        : $qtde);
        $retorno->totalPaginas = ceil($dao->countFilaEmailPorFilaStatus($fila, $status) / $retorno->itensPorPagina);

        if($pag > $retorno->totalPaginas) {
            $retorno->msgcode = ConstantesMensagem::NAO_EXISTEM_MAIS_PAGINAS_APRESENTAR;
            $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);
            return $retorno;
        }
        $retorno->lst = $dao->listFilaEmailPorFilaStatus($fila, $status, $pag, $retorno->itensPorPagina, $coluna, $ordem);

        return $retorno;
    }






/**
*
* atualizarNomefilaPorPK() - Usado para invocar a classe de negócio FilaEmailBusinessImpl de forma geral
* realizar uma atualização de Nome da fila diretamente na tabela FILA_EMAIL campo FIEM_NM_FILA
* @param $daofactory
* @param $id
* @param $nomeFila
* @return FilaEmailDTO
*
* 
*/
    public function atualizarNomefilaPorPK($daofactory,$nomeFila,$id)
    {
        $dao = $daofactory->getFilaEmailDAO($daofactory);

        // resposta padrão
        $retorno = new DTOPadrao();

        if($dao->updateNomefila($id, $nomeFila)){   
            $retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
        }       

        // Obtem o texto da mensagem em razão do código de retorno
        $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);

        return $retorno;
    }

/**
*
* atualizarEmaildePorPK() - Usado para invocar a classe de negócio FilaEmailBusinessImpl de forma geral
* realizar uma atualização de Email do usuário de diretamente na tabela FILA_EMAIL campo FIEM_TX_EMAIL_DE
* @param $daofactory
* @param $id
* @param $emailDe
* @return FilaEmailDTO
*
* 
*/
    public function atualizarEmaildePorPK($daofactory,$emailDe,$id)
    {
        $dao = $daofactory->getFilaEmailDAO($daofactory);

        // resposta padrão
        $retorno = new DTOPadrao();

        if($dao->updateEmailde($id, $emailDe)){   
            $retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
        }       

        // Obtem o texto da mensagem em razão do código de retorno
        $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);

        return $retorno;
    }

/**
*
* atualizarEmailparaPorPK() - Usado para invocar a classe de negócio FilaEmailBusinessImpl de forma geral
* realizar uma atualização de Email do usuário destino diretamente na tabela FILA_EMAIL campo FIEM_TX_EMAIL_PARA
* @param $daofactory
* @param $id
* @param $emailPara
* @return FilaEmailDTO
*
* 
*/
    public function atualizarEmailparaPorPK($daofactory,$emailPara,$id)
    {
        $dao = $daofactory->getFilaEmailDAO($daofactory);

        // resposta padrão
        $retorno = new DTOPadrao();

        if($dao->updateEmailpara($id, $emailPara)){   
            $retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
        }       

        // Obtem o texto da mensagem em razão do código de retorno
        $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);

        return $retorno;
    }

/**
*
* atualizarAssuntoPorPK() - Usado para invocar a classe de negócio FilaEmailBusinessImpl de forma geral
* realizar uma atualização de Asssunto da mensagem diretamente na tabela FILA_EMAIL campo FIEM_TX_ASSUNTO
* @param $daofactory
* @param $id
* @param $assunto
* @return FilaEmailDTO
*
* 
*/
    public function atualizarAssuntoPorPK($daofactory,$assunto,$id)
    {
        $dao = $daofactory->getFilaEmailDAO($daofactory);

        // resposta padrão
        $retorno = new DTOPadrao();

        if($dao->updateAssunto($id, $assunto)){   
            $retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
        }       

        // Obtem o texto da mensagem em razão do código de retorno
        $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);

        return $retorno;
    }

/**
*
* atualizarPrioridadePorPK() - Usado para invocar a classe de negócio FilaEmailBusinessImpl de forma geral
* realizar uma atualização de Nível de prioridade da mensagem diretamente na tabela FILA_EMAIL campo FIEM_IN_PRIOR
* @param $daofactory
* @param $id
* @param $prioridade
* @return FilaEmailDTO
*
* 
*/
    public function atualizarPrioridadePorPK($daofactory,$prioridade,$id)
    {
        $dao = $daofactory->getFilaEmailDAO($daofactory);

        // resposta padrão
        $retorno = new DTOPadrao();

        if($dao->updatePrioridade($id, $prioridade)){   
            $retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
        }       

        // Obtem o texto da mensagem em razão do código de retorno
        $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);

        return $retorno;
    }

/**
*
* atualizarTemplatePorPK() - Usado para invocar a classe de negócio FilaEmailBusinessImpl de forma geral
* realizar uma atualização de Template associado a essa mensagem diretamente na tabela FILA_EMAIL campo FIEM_TX_TEMPLATE
* @param $daofactory
* @param $id
* @param $template
* @return FilaEmailDTO
*
* 
*/
    public function atualizarTemplatePorPK($daofactory,$template,$id)
    {
        $dao = $daofactory->getFilaEmailDAO($daofactory);

        // resposta padrão
        $retorno = new DTOPadrao();

        if($dao->updateTemplate($id, $template)){   
            $retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
        }       

        // Obtem o texto da mensagem em razão do código de retorno
        $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);

        return $retorno;
    }

/**
*
* atualizarNrmaxtentativasPorPK() - Usado para invocar a classe de negócio FilaEmailBusinessImpl de forma geral
* realizar uma atualização de Numero Max Tentativas diretamente na tabela FILA_EMAIL campo FIEM_NU_MAX_TENTATIVA
* @param $daofactory
* @param $id
* @param $nrMaxTentativas
* @return FilaEmailDTO
*
* 
*/
    public function atualizarNrmaxtentativasPorPK($daofactory,$nrMaxTentativas,$id)
    {
        $dao = $daofactory->getFilaEmailDAO($daofactory);

        // resposta padrão
        $retorno = new DTOPadrao();

        if($dao->updateNrmaxtentativas($id, $nrMaxTentativas)){   
            $retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
        }       

        // Obtem o texto da mensagem em razão do código de retorno
        $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);

        return $retorno;
    }

/**
*
* atualizarNrrealtentativasPorPK() - Usado para invocar a classe de negócio FilaEmailBusinessImpl de forma geral
* realizar uma atualização de Numero Tentativas Realizadas diretamente na tabela FILA_EMAIL campo FIEM_NU_TENTATIVA_REAL
* @param $daofactory
* @param $id
* @param $nrRealTentativas
* @return FilaEmailDTO
*
* 
*/
    public function atualizarNrrealtentativasPorPK($daofactory,$nrRealTentativas,$id)
    {
        $dao = $daofactory->getFilaEmailDAO($daofactory);

        // resposta padrão
        $retorno = new DTOPadrao();

        if($dao->updateNrrealtentativas($id, $nrRealTentativas)){   
            $retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
        }       

        // Obtem o texto da mensagem em razão do código de retorno
        $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);

        return $retorno;
    }

/**
*
* atualizarDataprevisaoenvioPorPK() - Usado para invocar a classe de negócio FilaEmailBusinessImpl de forma geral
* realizar uma atualização de Data prevista envio diretamente na tabela FILA_EMAIL campo FIEM_DT_PREV_ENVIO
* @param $daofactory
* @param $id
* @param $dataPrevisaoEnvio
* @return FilaEmailDTO
*
* 
*/
    public function atualizarDataprevisaoenvioPorPK($daofactory,$dataPrevisaoEnvio,$id)
    {
        $dao = $daofactory->getFilaEmailDAO($daofactory);

        // resposta padrão
        $retorno = new DTOPadrao();

        if($dao->updateDataprevisaoenvio($id, $dataPrevisaoEnvio)){   
            $retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
        }       

        // Obtem o texto da mensagem em razão do código de retorno
        $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);

        return $retorno;
    }

/**
*
* atualizarDatarealenvioPorPK() - Usado para invocar a classe de negócio FilaEmailBusinessImpl de forma geral
* realizar uma atualização de Data envio real diretamente na tabela FILA_EMAIL campo FIEM_DT_REAL_ENVIO
* @param $daofactory
* @param $id
* @param $dataRealEnvio
* @return FilaEmailDTO
*
* 
*/
    public function atualizarDatarealenvioPorPK($daofactory,$dataRealEnvio,$id)
    {
        $dao = $daofactory->getFilaEmailDAO($daofactory);

        // resposta padrão
        $retorno = new DTOPadrao();

        if($dao->updateDatarealenvio($id, $dataRealEnvio)){   
            $retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
        }       

        // Obtem o texto da mensagem em razão do código de retorno
        $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);

        return $retorno;
    }


/**
*
* pesquisarPorNomefila() - Usado para invocar a classe de negócio FilaEmailBusinessImpl de forma geral
* realizar uma busca de Nome da fila diretamente na tabela FILA_EMAIL campo FIEM_NM_FILA
*
* @param $nomeFila
* @return FilaEmailDTO
*
* 
*/
    public function pesquisarPorNomefila($daofactory,$nomeFila)
    { 
        $dao = $daofactory->getFilaEmailDAO($daofactory);
        return $dao->loadNomefila($nomeFila);
    }

/**
*
* pesquisarPorEmailde() - Usado para invocar a classe de negócio FilaEmailBusinessImpl de forma geral
* realizar uma busca de Email do usuário de diretamente na tabela FILA_EMAIL campo FIEM_TX_EMAIL_DE
*
* @param $emailDe
* @return FilaEmailDTO
*
* 
*/
    public function pesquisarPorEmailde($daofactory,$emailDe)

    { 
        $dao = $daofactory->getFilaEmailDAO($daofactory);
        return $dao->loadEmailde($emailDe);
    }

/**
*
* pesquisarPorEmailpara() - Usado para invocar a classe de negócio FilaEmailBusinessImpl de forma geral
* realizar uma busca de Email do usuário destino diretamente na tabela FILA_EMAIL campo FIEM_TX_EMAIL_PARA
*
* @param $emailPara
* @return FilaEmailDTO
*
* 
*/
    public function pesquisarPorEmailpara($daofactory,$emailPara)

    { 
        $dao = $daofactory->getFilaEmailDAO($daofactory);
        return $dao->loadEmailpara($emailPara);
    }

/**
*
* pesquisarPorAssunto() - Usado para invocar a classe de negócio FilaEmailBusinessImpl de forma geral
* realizar uma busca de Asssunto da mensagem diretamente na tabela FILA_EMAIL campo FIEM_TX_ASSUNTO
*
* @param $assunto
* @return FilaEmailDTO
*
* 
*/
    public function pesquisarPorAssunto($daofactory,$assunto)

    { 
        $dao = $daofactory->getFilaEmailDAO($daofactory);
        return $dao->loadAssunto($assunto);
    }

/**
*
* pesquisarPorPrioridade() - Usado para invocar a classe de negócio FilaEmailBusinessImpl de forma geral
* realizar uma busca de Nível de prioridade da mensagem diretamente na tabela FILA_EMAIL campo FIEM_IN_PRIOR
*
* @param $prioridade
* @return FilaEmailDTO
*
* 
*/
    public function pesquisarPorPrioridade($daofactory,$prioridade)

    { 
        $dao = $daofactory->getFilaEmailDAO($daofactory);
        return $dao->loadPrioridade($prioridade);
    }

/**
*
* pesquisarPorTemplate() - Usado para invocar a classe de negócio FilaEmailBusinessImpl de forma geral
* realizar uma busca de Template associado a essa mensagem diretamente na tabela FILA_EMAIL campo FIEM_TX_TEMPLATE
*
* @param $template
* @return FilaEmailDTO
*
* 
*/
    public function pesquisarPorTemplate($daofactory,$template)

    { 
        $dao = $daofactory->getFilaEmailDAO($daofactory);
        return $dao->loadTemplate($template);
    }

/**
*
* pesquisarPorNrmaxtentativas() - Usado para invocar a classe de negócio FilaEmailBusinessImpl de forma geral
* realizar uma busca de Numero Max Tentativas diretamente na tabela FILA_EMAIL campo FIEM_NU_MAX_TENTATIVA
*
* @param $nrMaxTentativas
* @return FilaEmailDTO
*
* 
*/
    public function pesquisarPorNrmaxtentativas($daofactory,$nrMaxTentativas)

    { 
        $dao = $daofactory->getFilaEmailDAO($daofactory);
        return $dao->loadNrmaxtentativas($nrMaxTentativas);
    }

/**
*
* pesquisarPorNrrealtentativas() - Usado para invocar a classe de negócio FilaEmailBusinessImpl de forma geral
* realizar uma busca de Numero Tentativas Realizadas diretamente na tabela FILA_EMAIL campo FIEM_NU_TENTATIVA_REAL
*
* @param $nrRealTentativas
* @return FilaEmailDTO
*
* 
*/
    public function pesquisarPorNrrealtentativas($daofactory,$nrRealTentativas)

    { 
        $dao = $daofactory->getFilaEmailDAO($daofactory);
        return $dao->loadNrrealtentativas($nrRealTentativas);
    }

/**
*
* pesquisarPorDataprevisaoenvio() - Usado para invocar a classe de negócio FilaEmailBusinessImpl de forma geral
* realizar uma busca de Data prevista envio diretamente na tabela FILA_EMAIL campo FIEM_DT_PREV_ENVIO
*
* @param $dataPrevisaoEnvio
* @return FilaEmailDTO
*
* 
*/
    public function pesquisarPorDataprevisaoenvio($daofactory,$dataPrevisaoEnvio)

    { 
        $dao = $daofactory->getFilaEmailDAO($daofactory);
        return $dao->loadDataprevisaoenvio($dataPrevisaoEnvio);
    }

/**
*
* pesquisarPorDatarealenvio() - Usado para invocar a classe de negócio FilaEmailBusinessImpl de forma geral
* realizar uma busca de Data envio real diretamente na tabela FILA_EMAIL campo FIEM_DT_REAL_ENVIO
*
* @param $dataRealEnvio
* @return FilaEmailDTO
*
* 
*/
    public function pesquisarPorDatarealenvio($daofactory,$dataRealEnvio)

    { 
        $dao = $daofactory->getFilaEmailDAO($daofactory);
        return $dao->loadDatarealenvio($dataRealEnvio);
    }

/**
*
* listarFilaEmailUsuaIdPorStatus() - Usado para invocar a interface de acesso aos dados (DAO) FilaEmailDAO de forma geral
* realizar lista paginada de registros dos registros do usuário logado com uma instância de PaginacaoDTO
*
* @param $daofactory
* @param $usuaid
* @param $status
* @param $pag
* @param $qtde
* @param $coluna
* @param $ordem
* @return $PaginacaoDTO
*/

    public function listarFilaEmailPorUsuaIdStatus($daofactory, $usuaid, $status, $pag, $qtde, $coluna, $ordem)
    {   
        $retorno = new DTOPaginacao();
        $retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
        $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);

        $dao = $daofactory->getFilaEmailDAO($daofactory);
        $retorno->pagina = $pag;
        $retorno->itensPorPagina = ($qtde == 0 
        ? (int) VariavelCache::getInstance()->getVariavel(ConstantesVariavel::MAXIMO_LINHAS_POR_PAGINA_DEFAULT)
        : $qtde);
        $retorno->totalPaginas = ceil($dao->countFilaEmailPorUsuaIdStatus($usuaid, $status) / $retorno->itensPorPagina);

        if($pag > $retorno->totalPaginas) {
            $retorno->msgcode = ConstantesMensagem::NAO_EXISTEM_MAIS_PAGINAS_APRESENTAR;
            $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);
            return $retorno;
        }
        $retorno->lst = $dao->listFilaEmailPorUsuaIdStatus($usuaid, $status, $pag, $retorno->itensPorPagina, $coluna, $ordem);

        return $retorno;
    }

/**
* validarTamanhoCampo()
*
* Validador de tamanho de campos FilaEmailDTO
*
* @param $campo
* @param $tamanho
* @param $coment
*
* @return DTOPadrao
*/ 
    public function validarTamanhoCampo($campo, $tamanho, $coment)    
    {
       // retorno default
       $retorno = new DTOPadrao();
       $retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
       $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);
   
       if(strlen($campo) > $tamanho){
          $retorno->msgcode = ConstantesMensagem::TAMANHO_DO_CAMPO_EXCEDE_LIMITE_PERMITIDO;
          $retorno->msgcodeString = MensagemCache::getInstance()->getMensagemParametrizada($retorno->msgcode
          ,[
             ConstantesVariavel::P1 => $coment,
             ConstantesVariavel::P2 => $tamanho,
           ]);
       }
       return $retorno;
   }


}
?>
