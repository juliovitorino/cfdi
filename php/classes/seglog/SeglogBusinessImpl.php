<?php 

// importar dependencias
require_once 'SeglogBusiness.php';
require_once 'SeglogConstantes.php';
require_once 'SeglogHelper.php';
require_once '../dto/DTOPadrao.php';
require_once '../dto/DTOPaginacao.php';

require_once '../variavel/ConstantesVariavel.php';
require_once '../variavel/VariavelCache.php';

/**
*
* SeglogBusinessImpl - Classe de implementação dos métodos de negócio para a interface SeglogBusiness
* Camada de negócio Seglog - camada responsável pela lógica de negócios de Seglog do sistema. 
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
* @since 21/08/2021 12:30:09
*
*/


class SeglogBusinessImpl implements SeglogBusiness
{
    
    function __construct()  {   }

/**
* carregar() - Carrega apenas um registro com base no campo id = (VW_SEGLOG::SELOG_ID)
* @param $daofactory
* @param $dto
* @return $dto
*/ 
    public function carregar($daofactory, $dto) {   }

/**
* listarTudo() - Lista todos os registros provenientes de VW_SEGLOG sem critério de paginação
* @param $daofactory
* @return List<SeglogDTO>[]
*/ 
    public function listarTudo($daofactory) {   }

/**
* pesquisarMaxPKAtivoIdgafaPorStatus() - Carrega apenas um registro com base no idgafa  e status para buscar a MAIOR PK
* @param $daofactory
* @param $status
* @return SeglogDTO
*/ 
    public function pesquisarMaxPKAtivoIdgafaPorStatus($daofactory, $idgafa,$status)
    { 
        $dao = $daofactory->getSeglogDAO($daofactory);
        $maxid = $dao->loadMaxIdgafaPK($idgafa,$status);
        return $this->carregarPorID($daofactory, $maxid);
    }

/**
* atualizar() - atualiza apenas um registro com base no dto SeglogDTO->id
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


        $dao = $daofactory->getSeglogDAO($daofactory);
        if(!$dao->update($dto)){
           $retorno->msgcode = ConstantesMensagem::ERRO_CRUD_ATUALIZAR_REGISTRO;
           $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);
    
        }
        // retorna situação
        return $retorno;

    }

/**
* deletar() - excluir fisicamente um registro com base no dto SeglogDTO->id
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
        $dao = $daofactory->getSeglogDAO($daofactory);

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
* @return List<SeglogDTO>[]
* @deprecated
*/ 

    public function listarPagina($daofactory, $pag, $qtde)  
    {   
        $dao = $daofactory->getSeglogDAO($daofactory);
        return $dao->listPagina($pag, $qtde);
    }

/**
* carregarPorID() - Carrega APENAS um registro usando a id como item de busca
* na tabela VW_SEGLOG usando a Primary Key SELOG_ID
*
* @param $daofactory
* @param $id
* @param $qtde
*
* @return SeglogDTO
*/ 
    public function carregarPorID($daofactory, $id)
    { 
        $dao = $daofactory->getSeglogDAO($daofactory);
        return $dao->loadPK($id);
    }

/**
* atualizarStatus() - atualizar o campo de STATUS utilizando a id como item de busca
* na tabela VW_SEGLOG usando a Primary Key SELOG_ID
*
* @param $daofactory
* @param $id
* @param $status
*
* @return SeglogDTO
*/ 
    public function atualizarStatus($daofactory, $id, $status)
    {
        $dao = $daofactory->getSeglogDAO($daofactory);

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
* inserirSeglog() - inserir um registro com base no SeglogDTO. Alguns atributos dentro do DTO
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
public function inserirSeglog($daofactory, $dto)
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
* inserir() - inserir um registro com base no SeglogDTO. Alguns atributos dentro do DTO
* serão ignorados caso estejam populados.
*
* Atributos da classe SeglogDTO sumariamente IGNORADOS por este método MESMO que estejam preenchidos:
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

    // Efetua validações no campo $dto->id com tamanho SeglogConstantes::LEN_ID
    $ok = $this->validarTamanhoCampo($dto->id, SeglogConstantes::LEN_ID, SeglogConstantes::DESC_ID);
    if($ok->msgcode != ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO){
        return $ok;
    }

    // Efetua validações no campo $dto->idgafa com tamanho SeglogConstantes::LEN_IDGAFA
    $ok = $this->validarTamanhoCampo($dto->idgafa, SeglogConstantes::LEN_IDGAFA, SeglogConstantes::DESC_IDGAFA);
    if($ok->msgcode != ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO){
        return $ok;
    }

    // Efetua validações no campo $dto->id_usuario com tamanho SeglogConstantes::LEN_ID_USUARIO
    $ok = $this->validarTamanhoCampo($dto->id_usuario, SeglogConstantes::LEN_ID_USUARIO, SeglogConstantes::DESC_ID_USUARIO);
    if($ok->msgcode != ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO){
        return $ok;
    }

    // Efetua validações no campo $dto->funcao com tamanho SeglogConstantes::LEN_FUNCAO
    $ok = $this->validarTamanhoCampo($dto->funcao, SeglogConstantes::LEN_FUNCAO, SeglogConstantes::DESC_FUNCAO);
    if($ok->msgcode != ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO){
        return $ok;
    }

    // Efetua validações no campo $dto->incrudCriar com tamanho SeglogConstantes::LEN_INCRUDCRIAR
    $ok = $this->validarTamanhoCampo($dto->incrudCriar, SeglogConstantes::LEN_INCRUDCRIAR, SeglogConstantes::DESC_INCRUDCRIAR);
    if($ok->msgcode != ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO){
        return $ok;
    }

    // Efetua validações no campo $dto->incrudRecuperar com tamanho SeglogConstantes::LEN_INCRUDRECUPERAR
    $ok = $this->validarTamanhoCampo($dto->incrudRecuperar, SeglogConstantes::LEN_INCRUDRECUPERAR, SeglogConstantes::DESC_INCRUDRECUPERAR);
    if($ok->msgcode != ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO){
        return $ok;
    }

    // Efetua validações no campo $dto->incrudAtualizar com tamanho SeglogConstantes::LEN_INCRUDATUALIZAR
    $ok = $this->validarTamanhoCampo($dto->incrudAtualizar, SeglogConstantes::LEN_INCRUDATUALIZAR, SeglogConstantes::DESC_INCRUDATUALIZAR);
    if($ok->msgcode != ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO){
        return $ok;
    }

    // Efetua validações no campo $dto->incrudExcluir com tamanho SeglogConstantes::LEN_INCRUDEXCLUIR
    $ok = $this->validarTamanhoCampo($dto->incrudExcluir, SeglogConstantes::LEN_INCRUDEXCLUIR, SeglogConstantes::DESC_INCRUDEXCLUIR);
    if($ok->msgcode != ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO){
        return $ok;
    }
    // Efetua validações no campo $dto->status com tamanho SeglogConstantes::LEN_STATUS
    $ok = $this->validarTamanhoCampo($dto->status, SeglogConstantes::LEN_STATUS, SeglogConstantes::DESC_STATUS);
    if($ok->msgcode != ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO){
        return $ok;
    }

    // Efetua validações no campo $dto->dataCadastro com tamanho SeglogConstantes::LEN_DATACADASTRO
    $ok = $this->validarTamanhoCampo($dto->dataCadastro, SeglogConstantes::LEN_DATACADASTRO, SeglogConstantes::DESC_DATACADASTRO);
    if($ok->msgcode != ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO){
        return $ok;
    }

    // Efetua validações no campo $dto->dataAtualizacao com tamanho SeglogConstantes::LEN_DATAATUALIZACAO
    $ok = $this->validarTamanhoCampo($dto->dataAtualizacao, SeglogConstantes::LEN_DATAATUALIZACAO, SeglogConstantes::DESC_DATAATUALIZACAO);
    if($ok->msgcode != ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO){
        return $ok;
    }


    $dto->status = ConstantesVariavel::STATUS_ATIVO;
    $dao = $daofactory->getSeglogDAO($daofactory);

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
* listarSeglogPorStatus() - Usado para invocar a interface de acesso aos dados (DAO) SeglogDAO de forma geral
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

    public function listarSeglogPorStatus($daofactory, $status, $pag, $qtde, $coluna, $ordem)
    {   
        $retorno = new DTOPaginacao();
        $retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
        $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);

        $dao = $daofactory->getSeglogDAO($daofactory);
        $retorno->pagina = $pag;
        $retorno->itensPorPagina = ($qtde == 0 
        ? (int) VariavelCache::getInstance()->getVariavel(ConstantesVariavel::MAXIMO_LINHAS_POR_PAGINA_DEFAULT)
        : $qtde);
        $retorno->totalPaginas = ceil($dao->countSeglogPorStatus($status) / $retorno->itensPorPagina);

        if($pag > $retorno->totalPaginas) {
            $retorno->msgcode = ConstantesMensagem::NAO_EXISTEM_MAIS_PAGINAS_APRESENTAR;
            $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);
            return $retorno;
        }
        $retorno->lst = $dao->listSeglogPorStatus($status, $pag, $qtde, $coluna, $ordem);

        return $retorno;
    }






/**
*
* atualizarIdgafaPorPK() - Usado para invocar a classe de negócio SeglogBusinessImpl de forma geral
* realizar uma atualização de ID grupo admin x função admin diretamente na tabela VW_SEGLOG campo GAFA_ID
* @param $daofactory
* @param $id
* @param $idgafa
* @return SeglogDTO
*
* 
*/
    public function atualizarIdgafaPorPK($daofactory,$idgafa,$id)
    {
        $dao = $daofactory->getSeglogDAO($daofactory);

        // resposta padrão
        $retorno = new DTOPadrao();

        if($dao->updateIdgafa($id, $idgafa)){   
            $retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
        }       

        // Obtem o texto da mensagem em razão do código de retorno
        $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);

        return $retorno;
    }

/**
*
* atualizarId_UsuarioPorPK() - Usado para invocar a classe de negócio SeglogBusinessImpl de forma geral
* realizar uma atualização de ID do usuario diretamente na tabela VW_SEGLOG campo USUA_ID
* @param $daofactory
* @param $id
* @param $id_usuario
* @return SeglogDTO
*
* 
*/
    public function atualizarId_UsuarioPorPK($daofactory,$id_usuario,$id)
    {
        $dao = $daofactory->getSeglogDAO($daofactory);

        // resposta padrão
        $retorno = new DTOPadrao();

        if($dao->updateId_Usuario($id, $id_usuario)){   
            $retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
        }       

        // Obtem o texto da mensagem em razão do código de retorno
        $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);

        return $retorno;
    }

/**
*
* atualizarFuncaoPorPK() - Usado para invocar a classe de negócio SeglogBusinessImpl de forma geral
* realizar uma atualização de Função diretamente na tabela VW_SEGLOG campo SEGLOG_DESCRICAO
* @param $daofactory
* @param $id
* @param $funcao
* @return SeglogDTO
*
* 
*/
    public function atualizarFuncaoPorPK($daofactory,$funcao,$id)
    {
        $dao = $daofactory->getSeglogDAO($daofactory);

        // resposta padrão
        $retorno = new DTOPadrao();

        if($dao->updateFuncao($id, $funcao)){   
            $retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
        }       

        // Obtem o texto da mensagem em razão do código de retorno
        $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);

        return $retorno;
    }

/**
*
* atualizarIncrudcriarPorPK() - Usado para invocar a classe de negócio SeglogBusinessImpl de forma geral
* realizar uma atualização de Permissão CRUD Criar diretamente na tabela VW_SEGLOG campo SEGLOG_IN_CRUD_CRIAR
* @param $daofactory
* @param $id
* @param $incrudCriar
* @return SeglogDTO
*
* 
*/
    public function atualizarIncrudcriarPorPK($daofactory,$incrudCriar,$id)
    {
        $dao = $daofactory->getSeglogDAO($daofactory);

        // resposta padrão
        $retorno = new DTOPadrao();

        if($dao->updateIncrudcriar($id, $incrudCriar)){   
            $retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
        }       

        // Obtem o texto da mensagem em razão do código de retorno
        $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);

        return $retorno;
    }

/**
*
* atualizarIncrudrecuperarPorPK() - Usado para invocar a classe de negócio SeglogBusinessImpl de forma geral
* realizar uma atualização de Permissão CRUD Recuperar diretamente na tabela VW_SEGLOG campo SEGLOG_IN_CRUD_RECUPERAR
* @param $daofactory
* @param $id
* @param $incrudRecuperar
* @return SeglogDTO
*
* 
*/
    public function atualizarIncrudrecuperarPorPK($daofactory,$incrudRecuperar,$id)
    {
        $dao = $daofactory->getSeglogDAO($daofactory);

        // resposta padrão
        $retorno = new DTOPadrao();

        if($dao->updateIncrudrecuperar($id, $incrudRecuperar)){   
            $retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
        }       

        // Obtem o texto da mensagem em razão do código de retorno
        $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);

        return $retorno;
    }

/**
*
* atualizarIncrudatualizarPorPK() - Usado para invocar a classe de negócio SeglogBusinessImpl de forma geral
* realizar uma atualização de Permissão CRUD Atualizar diretamente na tabela VW_SEGLOG campo SEGLOG_IN_CRUD_ATUALIZAR
* @param $daofactory
* @param $id
* @param $incrudAtualizar
* @return SeglogDTO
*
* 
*/
    public function atualizarIncrudatualizarPorPK($daofactory,$incrudAtualizar,$id)
    {
        $dao = $daofactory->getSeglogDAO($daofactory);

        // resposta padrão
        $retorno = new DTOPadrao();

        if($dao->updateIncrudatualizar($id, $incrudAtualizar)){   
            $retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
        }       

        // Obtem o texto da mensagem em razão do código de retorno
        $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);

        return $retorno;
    }

/**
*
* atualizarIncrudexcluirPorPK() - Usado para invocar a classe de negócio SeglogBusinessImpl de forma geral
* realizar uma atualização de Permissão CRUD Excluir diretamente na tabela VW_SEGLOG campo SEGLOG_IN_CRUD_EXCLUIR
* @param $daofactory
* @param $id
* @param $incrudExcluir
* @return SeglogDTO
*
* 
*/
    public function atualizarIncrudexcluirPorPK($daofactory,$incrudExcluir,$id)
    {
        $dao = $daofactory->getSeglogDAO($daofactory);

        // resposta padrão
        $retorno = new DTOPadrao();

        if($dao->updateIncrudexcluir($id, $incrudExcluir)){   
            $retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
        }       

        // Obtem o texto da mensagem em razão do código de retorno
        $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);

        return $retorno;
    }


/**
*
* pesquisarPorIdgafa() - Usado para invocar a classe de negócio SeglogBusinessImpl de forma geral
* realizar uma busca de ID grupo admin x função admin diretamente na tabela VW_SEGLOG campo GAFA_ID
*
* @param $idgafa
* @return SeglogDTO
*
* 
*/
    public function pesquisarPorIdgafa($daofactory,$idgafa)
    { 
        $dao = $daofactory->getSeglogDAO($daofactory);
        return $dao->loadIdgafa($idgafa);
    }

/**
*
* pesquisarPorId_Usuario() - Usado para invocar a classe de negócio SeglogBusinessImpl de forma geral
* realizar uma busca de ID do usuario diretamente na tabela VW_SEGLOG campo USUA_ID
*
* @param $id_usuario
* @return SeglogDTO
*
* 
*/
    public function pesquisarPorId_Usuario($daofactory,$id_usuario)

    { 
        $dao = $daofactory->getSeglogDAO($daofactory);
        return $dao->loadId_Usuario($id_usuario);
    }

/**
*
* pesquisarPorFuncao() - Usado para invocar a classe de negócio SeglogBusinessImpl de forma geral
* realizar uma busca de Função diretamente na tabela VW_SEGLOG campo SEGLOG_DESCRICAO
*
* @param $funcao
* @return SeglogDTO
*
* 
*/
    public function pesquisarPorFuncao($daofactory,$funcao)

    { 
        $dao = $daofactory->getSeglogDAO($daofactory);
        return $dao->loadFuncao($funcao);
    }

    /**
*
* pesquisarPorid_UsuarioFuncao() - Usado para invocar a classe de negócio SeglogBusinessImpl de forma geral
* realizar uma busca de Função diretamente na tabela VW_SEGLOG campo SEGLOG_DESCRICAO
*
* @param $funcao
* @return SeglogDTO
*
* 
*/
    public function pesquisarPorid_UsuarioFuncao($daofactory, $id_usuario, $funcao)
    { 
        $dao = $daofactory->getSeglogDAO($daofactory);
        return $dao->loadId_UsuarioFuncao( $id_usuario,$funcao);
    }

/**
*
* pesquisarPorIncrudcriar() - Usado para invocar a classe de negócio SeglogBusinessImpl de forma geral
* realizar uma busca de Permissão CRUD Criar diretamente na tabela VW_SEGLOG campo SEGLOG_IN_CRUD_CRIAR
*
* @param $incrudCriar
* @return SeglogDTO
*
* 
*/
    public function pesquisarPorIncrudcriar($daofactory,$incrudCriar)
    { 
        $dao = $daofactory->getSeglogDAO($daofactory);
        return $dao->loadIncrudcriar($incrudCriar);
    }

/**
*
* pesquisarPorIncrudrecuperar() - Usado para invocar a classe de negócio SeglogBusinessImpl de forma geral
* realizar uma busca de Permissão CRUD Recuperar diretamente na tabela VW_SEGLOG campo SEGLOG_IN_CRUD_RECUPERAR
*
* @param $incrudRecuperar
* @return SeglogDTO
*
* 
*/
    public function pesquisarPorIncrudrecuperar($daofactory,$incrudRecuperar)
    { 
        $dao = $daofactory->getSeglogDAO($daofactory);
        return $dao->loadIncrudrecuperar($incrudRecuperar);
    }

/**
*
* pesquisarPorIncrudatualizar() - Usado para invocar a classe de negócio SeglogBusinessImpl de forma geral
* realizar uma busca de Permissão CRUD Atualizar diretamente na tabela VW_SEGLOG campo SEGLOG_IN_CRUD_ATUALIZAR
*
* @param $incrudAtualizar
* @return SeglogDTO
*
* 
*/
    public function pesquisarPorIncrudatualizar($daofactory,$incrudAtualizar)

    { 
        $dao = $daofactory->getSeglogDAO($daofactory);
        return $dao->loadIncrudatualizar($incrudAtualizar);
    }

/**
*
* pesquisarPorIncrudexcluir() - Usado para invocar a classe de negócio SeglogBusinessImpl de forma geral
* realizar uma busca de Permissão CRUD Excluir diretamente na tabela VW_SEGLOG campo SEGLOG_IN_CRUD_EXCLUIR
*
* @param $incrudExcluir
* @return SeglogDTO
*
* 
*/
    public function pesquisarPorIncrudexcluir($daofactory,$incrudExcluir)

    { 
        $dao = $daofactory->getSeglogDAO($daofactory);
        return $dao->loadIncrudexcluir($incrudExcluir);
    }

/**
*
* listarSeglogUsuaIdPorStatus() - Usado para invocar a interface de acesso aos dados (DAO) SeglogDAO de forma geral
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

    public function listarSeglogPorUsuaIdStatus($daofactory, $usuaid, $status, $pag, $qtde, $coluna, $ordem)
    {   
        $retorno = new DTOPaginacao();
        $retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
        $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);

        $dao = $daofactory->getSeglogDAO($daofactory);
        $retorno->pagina = $pag;
        $retorno->itensPorPagina = ($qtde == 0 
        ? (int) VariavelCache::getInstance()->getVariavel(ConstantesVariavel::MAXIMO_LINHAS_POR_PAGINA_DEFAULT)
        : $qtde);
        $retorno->totalPaginas = ceil($dao->countSeglogPorUsuaIdStatus($usuaid, $status) / $retorno->itensPorPagina);

        if($pag > $retorno->totalPaginas) {
            $retorno->msgcode = ConstantesMensagem::NAO_EXISTEM_MAIS_PAGINAS_APRESENTAR;
            $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);
            return $retorno;
        }
        $retorno->lst = $dao->listSeglogPorUsuaIdStatus($usuaid, $status, $pag, $qtde, $coluna, $ordem);

        return $retorno;
    }

/**
* validarTamanhoCampo()
*
* Validador de tamanho de campos SeglogDTO
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
