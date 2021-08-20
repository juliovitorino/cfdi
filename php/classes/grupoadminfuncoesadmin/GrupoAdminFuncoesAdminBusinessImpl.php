<?php 

// importar dependencias
require_once 'GrupoAdminFuncoesAdminBusiness.php';
require_once 'GrupoAdminFuncoesAdminConstantes.php';
require_once 'GrupoAdminFuncoesAdminHelper.php';
require_once '../dto/DTOPadrao.php';
require_once '../dto/DTOPaginacao.php';

require_once '../variavel/ConstantesVariavel.php';
require_once '../variavel/VariavelCache.php';

/**
*
* GrupoAdminFuncoesAdminBusinessImpl - Classe de implementação dos métodos de negócio para a interface GrupoAdminFuncoesAdminBusiness
* Camada de negócio GrupoAdminFuncoesAdmin - camada responsável pela lógica de negócios de GrupoAdminFuncoesAdmin do sistema. 
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
* @since 20/08/2021 18:54:21
*
*/


class GrupoAdminFuncoesAdminBusinessImpl implements GrupoAdminFuncoesAdminBusiness
{
    
    function __construct()  {   }

/**
* carregar() - Carrega apenas um registro com base no campo id = (SEGLOG_GRUPO_ADM_FUNCAO_ADM::GAFA_ID)
* @param $daofactory
* @param $dto
* @return $dto
*/ 
    public function carregar($daofactory, $dto) {   }

/**
* listarTudo() - Lista todos os registros provenientes de SEGLOG_GRUPO_ADM_FUNCAO_ADM sem critério de paginação
* @param $daofactory
* @return List<GrupoAdminFuncoesAdminDTO>[]
*/ 
    public function listarTudo($daofactory) {   }

/**
* pesquisarMaxPKAtivoIdgrupoadministracaoPorStatus() - Carrega apenas um registro com base no idGrupoAdministracao  e status para buscar a MAIOR PK
* @param $daofactory
* @param $status
* @return GrupoAdminFuncoesAdminDTO
*/ 
    public function pesquisarMaxPKAtivoIdgrupoadministracaoPorStatus($daofactory, $idGrupoAdministracao,$status)
    { 
        $dao = $daofactory->getGrupoAdminFuncoesAdminDAO($daofactory);
        $maxid = $dao->loadMaxIdgrupoadministracaoPK($idGrupoAdministracao,$status);
        return $this->carregarPorID($daofactory, $maxid);
    }

/**
* atualizar() - atualiza apenas um registro com base no dto GrupoAdminFuncoesAdminDTO->id
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


        $dao = $daofactory->getGrupoAdminFuncoesAdminDAO($daofactory);
        if(!$dao->update($dto)){
           $retorno->msgcode = ConstantesMensagem::ERRO_CRUD_ATUALIZAR_REGISTRO;
           $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);
    
        }
        // retorna situação
        return $retorno;

    }

/**
* deletar() - excluir fisicamente um registro com base no dto GrupoAdminFuncoesAdminDTO->id
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
        $dao = $daofactory->getGrupoAdminFuncoesAdminDAO($daofactory);

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
* @return List<GrupoAdminFuncoesAdminDTO>[]
* @deprecated
*/ 

    public function listarPagina($daofactory, $pag, $qtde)  
    {   
        $dao = $daofactory->getGrupoAdminFuncoesAdminDAO($daofactory);
        return $dao->listPagina($pag, $qtde);
    }

/**
* carregarPorID() - Carrega APENAS um registro usando a id como item de busca
* na tabela SEGLOG_GRUPO_ADM_FUNCAO_ADM usando a Primary Key GAFA_ID
*
* @param $daofactory
* @param $id
* @param $qtde
*
* @return GrupoAdminFuncoesAdminDTO
*/ 
    public function carregarPorID($daofactory, $id)
    { 
        $dao = $daofactory->getGrupoAdminFuncoesAdminDAO($daofactory);
        return $dao->loadPK($id);
    }

/**
* atualizarStatus() - atualizar o campo de STATUS utilizando a id como item de busca
* na tabela SEGLOG_GRUPO_ADM_FUNCAO_ADM usando a Primary Key GAFA_ID
*
* @param $daofactory
* @param $id
* @param $status
*
* @return GrupoAdminFuncoesAdminDTO
*/ 
    public function atualizarStatus($daofactory, $id, $status)
    {
        $dao = $daofactory->getGrupoAdminFuncoesAdminDAO($daofactory);

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
* inserirGrupoAdminFuncoesAdmin() - inserir um registro com base no GrupoAdminFuncoesAdminDTO. Alguns atributos dentro do DTO
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
public function inserirGrupoAdminFuncoesAdmin($daofactory, $dto)
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
* inserir() - inserir um registro com base no GrupoAdminFuncoesAdminDTO. Alguns atributos dentro do DTO
* serão ignorados caso estejam populados.
*
* Atributos da classe GrupoAdminFuncoesAdminDTO sumariamente IGNORADOS por este método MESMO que estejam preenchidos:
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

    // Efetua validações no campo $dto->id com tamanho GrupoAdminFuncoesAdminConstantes::LEN_ID
    $ok = $this->validarTamanhoCampo($dto->id, GrupoAdminFuncoesAdminConstantes::LEN_ID, GrupoAdminFuncoesAdminConstantes::DESC_ID);
    if($ok->msgcode != ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO){
        return $ok;
    }

    // Efetua validações no campo $dto->idGrupoAdministracao com tamanho GrupoAdminFuncoesAdminConstantes::LEN_IDGRUPOADMINISTRACAO
    $ok = $this->validarTamanhoCampo($dto->idGrupoAdministracao, GrupoAdminFuncoesAdminConstantes::LEN_IDGRUPOADMINISTRACAO, GrupoAdminFuncoesAdminConstantes::DESC_IDGRUPOADMINISTRACAO);
    if($ok->msgcode != ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO){
        return $ok;
    }

    // Efetua validações no campo $dto->idFuncoesAdministrativas com tamanho GrupoAdminFuncoesAdminConstantes::LEN_IDFUNCOESADMINISTRATIVAS
    $ok = $this->validarTamanhoCampo($dto->idFuncoesAdministrativas, GrupoAdminFuncoesAdminConstantes::LEN_IDFUNCOESADMINISTRATIVAS, GrupoAdminFuncoesAdminConstantes::DESC_IDFUNCOESADMINISTRATIVAS);
    if($ok->msgcode != ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO){
        return $ok;
    }

    // Efetua validações no campo $dto->descricao com tamanho GrupoAdminFuncoesAdminConstantes::LEN_DESCRICAO
    $ok = $this->validarTamanhoCampo($dto->descricao, GrupoAdminFuncoesAdminConstantes::LEN_DESCRICAO, GrupoAdminFuncoesAdminConstantes::DESC_DESCRICAO);
    if($ok->msgcode != ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO){
        return $ok;
    }

    // Efetua validações no campo $dto->incrudCriar com tamanho GrupoAdminFuncoesAdminConstantes::LEN_INCRUDCRIAR
    $ok = $this->validarTamanhoCampo($dto->incrudCriar, GrupoAdminFuncoesAdminConstantes::LEN_INCRUDCRIAR, GrupoAdminFuncoesAdminConstantes::DESC_INCRUDCRIAR);
    if($ok->msgcode != ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO){
        return $ok;
    }

    // Efetua validações no campo $dto->incrudRecuperar com tamanho GrupoAdminFuncoesAdminConstantes::LEN_INCRUDRECUPERAR
    $ok = $this->validarTamanhoCampo($dto->incrudRecuperar, GrupoAdminFuncoesAdminConstantes::LEN_INCRUDRECUPERAR, GrupoAdminFuncoesAdminConstantes::DESC_INCRUDRECUPERAR);
    if($ok->msgcode != ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO){
        return $ok;
    }

    // Efetua validações no campo $dto->incrudAtualizar com tamanho GrupoAdminFuncoesAdminConstantes::LEN_INCRUDATUALIZAR
    $ok = $this->validarTamanhoCampo($dto->incrudAtualizar, GrupoAdminFuncoesAdminConstantes::LEN_INCRUDATUALIZAR, GrupoAdminFuncoesAdminConstantes::DESC_INCRUDATUALIZAR);
    if($ok->msgcode != ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO){
        return $ok;
    }

    // Efetua validações no campo $dto->incrudExcluir com tamanho GrupoAdminFuncoesAdminConstantes::LEN_INCRUDEXCLUIR
    $ok = $this->validarTamanhoCampo($dto->incrudExcluir, GrupoAdminFuncoesAdminConstantes::LEN_INCRUDEXCLUIR, GrupoAdminFuncoesAdminConstantes::DESC_INCRUDEXCLUIR);
    if($ok->msgcode != ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO){
        return $ok;
    }

    // Efetua validações no campo $dto->status com tamanho GrupoAdminFuncoesAdminConstantes::LEN_STATUS
    $ok = $this->validarTamanhoCampo($dto->status, GrupoAdminFuncoesAdminConstantes::LEN_STATUS, GrupoAdminFuncoesAdminConstantes::DESC_STATUS);
    if($ok->msgcode != ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO){
        return $ok;
    }

    // Efetua validações no campo $dto->dataCadastro com tamanho GrupoAdminFuncoesAdminConstantes::LEN_DATACADASTRO
    $ok = $this->validarTamanhoCampo($dto->dataCadastro, GrupoAdminFuncoesAdminConstantes::LEN_DATACADASTRO, GrupoAdminFuncoesAdminConstantes::DESC_DATACADASTRO);
    if($ok->msgcode != ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO){
        return $ok;
    }

    // Efetua validações no campo $dto->dataAtualizacao com tamanho GrupoAdminFuncoesAdminConstantes::LEN_DATAATUALIZACAO
    $ok = $this->validarTamanhoCampo($dto->dataAtualizacao, GrupoAdminFuncoesAdminConstantes::LEN_DATAATUALIZACAO, GrupoAdminFuncoesAdminConstantes::DESC_DATAATUALIZACAO);
    if($ok->msgcode != ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO){
        return $ok;
    }


    $dto->status = ConstantesVariavel::STATUS_ATIVO;
    $dao = $daofactory->getGrupoAdminFuncoesAdminDAO($daofactory);

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
* listarGrupoAdminFuncoesAdminPorStatus() - Usado para invocar a interface de acesso aos dados (DAO) GrupoAdminFuncoesAdminDAO de forma geral
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

    public function listarGrupoAdminFuncoesAdminPorStatus($daofactory, $status, $pag, $qtde, $coluna, $ordem)
    {   
        $retorno = new DTOPaginacao();
        $retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
        $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);

        $dao = $daofactory->getGrupoAdminFuncoesAdminDAO($daofactory);
        $retorno->pagina = $pag;
        $retorno->itensPorPagina = ($qtde == 0 
        ? (int) VariavelCache::getInstance()->getVariavel(ConstantesVariavel::MAXIMO_LINHAS_POR_PAGINA_DEFAULT)
        : $qtde);
        $retorno->totalPaginas = ceil($dao->countGrupoAdminFuncoesAdminPorStatus($status) / $retorno->itensPorPagina);

        if($pag > $retorno->totalPaginas) {
            $retorno->msgcode = ConstantesMensagem::NAO_EXISTEM_MAIS_PAGINAS_APRESENTAR;
            $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);
            return $retorno;
        }
        $retorno->lst = $dao->listGrupoAdminFuncoesAdminPorStatus($status, $pag, $qtde, $coluna, $ordem);

        return $retorno;
    }






/**
*
* atualizarIdgrupoadministracaoPorPK() - Usado para invocar a classe de negócio GrupoAdminFuncoesAdminBusinessImpl de forma geral
* realizar uma atualização de ID grupo administração diretamente na tabela SEGLOG_GRUPO_ADM_FUNCAO_ADM campo GRAD_ID
* @param $daofactory
* @param $id
* @param $idGrupoAdministracao
* @return GrupoAdminFuncoesAdminDTO
*
* 
*/
    public function atualizarIdgrupoadministracaoPorPK($daofactory,$idGrupoAdministracao,$id)
    {
        $dao = $daofactory->getGrupoAdminFuncoesAdminDAO($daofactory);

        // resposta padrão
        $retorno = new DTOPadrao();

        if($dao->updateIdgrupoadministracao($id, $idGrupoAdministracao)){   
            $retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
        }       

        // Obtem o texto da mensagem em razão do código de retorno
        $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);

        return $retorno;
    }

/**
*
* atualizarIdfuncoesadministrativasPorPK() - Usado para invocar a classe de negócio GrupoAdminFuncoesAdminBusinessImpl de forma geral
* realizar uma atualização de ID funções administrativas diretamente na tabela SEGLOG_GRUPO_ADM_FUNCAO_ADM campo FUAD_ID
* @param $daofactory
* @param $id
* @param $idFuncoesAdministrativas
* @return GrupoAdminFuncoesAdminDTO
*
* 
*/
    public function atualizarIdfuncoesadministrativasPorPK($daofactory,$idFuncoesAdministrativas,$id)
    {
        $dao = $daofactory->getGrupoAdminFuncoesAdminDAO($daofactory);

        // resposta padrão
        $retorno = new DTOPadrao();

        if($dao->updateIdfuncoesadministrativas($id, $idFuncoesAdministrativas)){   
            $retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
        }       

        // Obtem o texto da mensagem em razão do código de retorno
        $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);

        return $retorno;
    }

/**
*
* atualizarDescricaoPorPK() - Usado para invocar a classe de negócio GrupoAdminFuncoesAdminBusinessImpl de forma geral
* realizar uma atualização de Descricao do grupo admin x função admin diretamente na tabela SEGLOG_GRUPO_ADM_FUNCAO_ADM campo GAFA_NM_DESCRICAO
* @param $daofactory
* @param $id
* @param $descricao
* @return GrupoAdminFuncoesAdminDTO
*
* 
*/
    public function atualizarDescricaoPorPK($daofactory,$descricao,$id)
    {
        $dao = $daofactory->getGrupoAdminFuncoesAdminDAO($daofactory);

        // resposta padrão
        $retorno = new DTOPadrao();

        if($dao->updateDescricao($id, $descricao)){   
            $retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
        }       

        // Obtem o texto da mensagem em razão do código de retorno
        $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);

        return $retorno;
    }

/**
*
* atualizarIncrudcriarPorPK() - Usado para invocar a classe de negócio GrupoAdminFuncoesAdminBusinessImpl de forma geral
* realizar uma atualização de Permissão CRUD Criar diretamente na tabela SEGLOG_GRUPO_ADM_FUNCAO_ADM campo GAFA_IN_CRUD_CRIAR
* @param $daofactory
* @param $id
* @param $incrudCriar
* @return GrupoAdminFuncoesAdminDTO
*
* 
*/
    public function atualizarIncrudcriarPorPK($daofactory,$incrudCriar,$id)
    {
        $dao = $daofactory->getGrupoAdminFuncoesAdminDAO($daofactory);

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
* atualizarIncrudrecuperarPorPK() - Usado para invocar a classe de negócio GrupoAdminFuncoesAdminBusinessImpl de forma geral
* realizar uma atualização de Permissão CRUD Recuperar diretamente na tabela SEGLOG_GRUPO_ADM_FUNCAO_ADM campo GAFA_IN_CRUD_RECUPERAR
* @param $daofactory
* @param $id
* @param $incrudRecuperar
* @return GrupoAdminFuncoesAdminDTO
*
* 
*/
    public function atualizarIncrudrecuperarPorPK($daofactory,$incrudRecuperar,$id)
    {
        $dao = $daofactory->getGrupoAdminFuncoesAdminDAO($daofactory);

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
* atualizarIncrudatualizarPorPK() - Usado para invocar a classe de negócio GrupoAdminFuncoesAdminBusinessImpl de forma geral
* realizar uma atualização de Permissão CRUD Atualizar diretamente na tabela SEGLOG_GRUPO_ADM_FUNCAO_ADM campo GAFA_IN_CRUD_ATUALIZAR
* @param $daofactory
* @param $id
* @param $incrudAtualizar
* @return GrupoAdminFuncoesAdminDTO
*
* 
*/
    public function atualizarIncrudatualizarPorPK($daofactory,$incrudAtualizar,$id)
    {
        $dao = $daofactory->getGrupoAdminFuncoesAdminDAO($daofactory);

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
* atualizarIncrudexcluirPorPK() - Usado para invocar a classe de negócio GrupoAdminFuncoesAdminBusinessImpl de forma geral
* realizar uma atualização de Permissão CRUD Excluir diretamente na tabela SEGLOG_GRUPO_ADM_FUNCAO_ADM campo GAFA_IN_CRUD_EXCLUIR
* @param $daofactory
* @param $id
* @param $incrudExcluir
* @return GrupoAdminFuncoesAdminDTO
*
* 
*/
    public function atualizarIncrudexcluirPorPK($daofactory,$incrudExcluir,$id)
    {
        $dao = $daofactory->getGrupoAdminFuncoesAdminDAO($daofactory);

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
* pesquisarPorIdgrupoadministracao() - Usado para invocar a classe de negócio GrupoAdminFuncoesAdminBusinessImpl de forma geral
* realizar uma busca de ID grupo administração diretamente na tabela SEGLOG_GRUPO_ADM_FUNCAO_ADM campo GRAD_ID
*
* @param $idGrupoAdministracao
* @return GrupoAdminFuncoesAdminDTO
*
* 
*/
    public function pesquisarPorIdgrupoadministracao($daofactory,$idGrupoAdministracao)
    { 
        $dao = $daofactory->getGrupoAdminFuncoesAdminDAO($daofactory);
        return $dao->loadIdgrupoadministracao($idGrupoAdministracao);
    }

/**
*
* pesquisarPorIdfuncoesadministrativas() - Usado para invocar a classe de negócio GrupoAdminFuncoesAdminBusinessImpl de forma geral
* realizar uma busca de ID funções administrativas diretamente na tabela SEGLOG_GRUPO_ADM_FUNCAO_ADM campo FUAD_ID
*
* @param $idFuncoesAdministrativas
* @return GrupoAdminFuncoesAdminDTO
*
* 
*/
    public function pesquisarPorIdfuncoesadministrativas($daofactory,$idFuncoesAdministrativas)

    { 
        $dao = $daofactory->getGrupoAdminFuncoesAdminDAO($daofactory);
        return $dao->loadIdfuncoesadministrativas($idFuncoesAdministrativas);
    }

/**
*
* pesquisarPorDescricao() - Usado para invocar a classe de negócio GrupoAdminFuncoesAdminBusinessImpl de forma geral
* realizar uma busca de Descricao do grupo admin x função admin diretamente na tabela SEGLOG_GRUPO_ADM_FUNCAO_ADM campo GAFA_NM_DESCRICAO
*
* @param $descricao
* @return GrupoAdminFuncoesAdminDTO
*
* 
*/
    public function pesquisarPorDescricao($daofactory,$descricao)

    { 
        $dao = $daofactory->getGrupoAdminFuncoesAdminDAO($daofactory);
        return $dao->loadDescricao($descricao);
    }

/**
*
* pesquisarPorIncrudcriar() - Usado para invocar a classe de negócio GrupoAdminFuncoesAdminBusinessImpl de forma geral
* realizar uma busca de Permissão CRUD Criar diretamente na tabela SEGLOG_GRUPO_ADM_FUNCAO_ADM campo GAFA_IN_CRUD_CRIAR
*
* @param $incrudCriar
* @return GrupoAdminFuncoesAdminDTO
*
* 
*/
    public function pesquisarPorIncrudcriar($daofactory,$incrudCriar)

    { 
        $dao = $daofactory->getGrupoAdminFuncoesAdminDAO($daofactory);
        return $dao->loadIncrudcriar($incrudCriar);
    }

/**
*
* pesquisarPorIncrudrecuperar() - Usado para invocar a classe de negócio GrupoAdminFuncoesAdminBusinessImpl de forma geral
* realizar uma busca de Permissão CRUD Recuperar diretamente na tabela SEGLOG_GRUPO_ADM_FUNCAO_ADM campo GAFA_IN_CRUD_RECUPERAR
*
* @param $incrudRecuperar
* @return GrupoAdminFuncoesAdminDTO
*
* 
*/
    public function pesquisarPorIncrudrecuperar($daofactory,$incrudRecuperar)

    { 
        $dao = $daofactory->getGrupoAdminFuncoesAdminDAO($daofactory);
        return $dao->loadIncrudrecuperar($incrudRecuperar);
    }

/**
*
* pesquisarPorIncrudatualizar() - Usado para invocar a classe de negócio GrupoAdminFuncoesAdminBusinessImpl de forma geral
* realizar uma busca de Permissão CRUD Atualizar diretamente na tabela SEGLOG_GRUPO_ADM_FUNCAO_ADM campo GAFA_IN_CRUD_ATUALIZAR
*
* @param $incrudAtualizar
* @return GrupoAdminFuncoesAdminDTO
*
* 
*/
    public function pesquisarPorIncrudatualizar($daofactory,$incrudAtualizar)

    { 
        $dao = $daofactory->getGrupoAdminFuncoesAdminDAO($daofactory);
        return $dao->loadIncrudatualizar($incrudAtualizar);
    }

/**
*
* pesquisarPorIncrudexcluir() - Usado para invocar a classe de negócio GrupoAdminFuncoesAdminBusinessImpl de forma geral
* realizar uma busca de Permissão CRUD Excluir diretamente na tabela SEGLOG_GRUPO_ADM_FUNCAO_ADM campo GAFA_IN_CRUD_EXCLUIR
*
* @param $incrudExcluir
* @return GrupoAdminFuncoesAdminDTO
*
* 
*/
    public function pesquisarPorIncrudexcluir($daofactory,$incrudExcluir)

    { 
        $dao = $daofactory->getGrupoAdminFuncoesAdminDAO($daofactory);
        return $dao->loadIncrudexcluir($incrudExcluir);
    }

/**
*
* listarGrupoAdminFuncoesAdminUsuaIdPorStatus() - Usado para invocar a interface de acesso aos dados (DAO) GrupoAdminFuncoesAdminDAO de forma geral
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

    public function listarGrupoAdminFuncoesAdminPorUsuaIdStatus($daofactory, $usuaid, $status, $pag, $qtde, $coluna, $ordem)
    {   
        $retorno = new DTOPaginacao();
        $retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
        $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);

        $dao = $daofactory->getGrupoAdminFuncoesAdminDAO($daofactory);
        $retorno->pagina = $pag;
        $retorno->itensPorPagina = ($qtde == 0 
        ? (int) VariavelCache::getInstance()->getVariavel(ConstantesVariavel::MAXIMO_LINHAS_POR_PAGINA_DEFAULT)
        : $qtde);
        $retorno->totalPaginas = ceil($dao->countGrupoAdminFuncoesAdminPorUsuaIdStatus($usuaid, $status) / $retorno->itensPorPagina);

        if($pag > $retorno->totalPaginas) {
            $retorno->msgcode = ConstantesMensagem::NAO_EXISTEM_MAIS_PAGINAS_APRESENTAR;
            $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);
            return $retorno;
        }
        $retorno->lst = $dao->listGrupoAdminFuncoesAdminPorUsuaIdStatus($usuaid, $status, $pag, $qtde, $coluna, $ordem);

        return $retorno;
    }

/**
* validarTamanhoCampo()
*
* Validador de tamanho de campos GrupoAdminFuncoesAdminDTO
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
