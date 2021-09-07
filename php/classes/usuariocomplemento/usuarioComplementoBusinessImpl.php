<?php 

// importar dependencias
require_once 'UsuarioComplementoBusiness.php';
require_once 'UsuarioComplementoConstantes.php';
require_once 'UsuarioComplementoHelper.php';
require_once '../dto/DTOPadrao.php';
require_once '../dto/DTOPaginacao.php';

require_once '../variavel/ConstantesVariavel.php';
require_once '../variavel/VariavelCache.php';

/**
*
* UsuarioComplementoBusinessImpl - Classe de implementação dos métodos de negócio para a interface UsuarioComplementoBusiness
* Camada de negócio UsuarioComplemento - camada responsável pela lógica de negócios de UsuarioComplemento do sistema. 
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
* @since 07/09/2021 11:00:05
*
*/


class UsuarioComplementoBusinessImpl implements UsuarioComplementoBusiness
{
    
    function __construct()  {   }

/**
* carregar() - Carrega apenas um registro com base no campo id = (USUARIO_COMPLEMENTO::USCO_ID)
* @param $daofactory
* @param $dto
* @return $dto
*/ 
    public function carregar($daofactory, $dto) {   }

/**
* listarTudo() - Lista todos os registros provenientes de USUARIO_COMPLEMENTO sem critério de paginação
* @param $daofactory
* @return List<UsuarioComplementoDTO>[]
*/ 
    public function listarTudo($daofactory) {   }

/**
* pesquisarMaxPKAtivoIdusuarioPorStatus() - Carrega apenas um registro com base no idUsuario  e status para buscar a MAIOR PK
* @param $daofactory
* @param $status
* @return UsuarioComplementoDTO
*/ 
    public function pesquisarMaxPKAtivoIdusuarioPorStatus($daofactory, $idUsuario,$status)
    { 
        $dao = $daofactory->getUsuarioComplementoDAO($daofactory);
        $maxid = $dao->loadMaxIdusuarioPK($idUsuario,$status);
        return $this->carregarPorID($daofactory, $maxid);
    }

/**
* atualizar() - atualiza apenas um registro com base no dto UsuarioComplementoDTO->id
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


        $dao = $daofactory->getUsuarioComplementoDAO($daofactory);
        if(!$dao->update($dto)){
           $retorno->msgcode = ConstantesMensagem::ERRO_CRUD_ATUALIZAR_REGISTRO;
           $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);
    
        }
        // retorna situação
        return $retorno;

    }

/**
* deletar() - excluir fisicamente um registro com base no dto UsuarioComplementoDTO->id
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
        $dao = $daofactory->getUsuarioComplementoDAO($daofactory);

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
* @return List<UsuarioComplementoDTO>[]
* @deprecated
*/ 

    public function listarPagina($daofactory, $pag, $qtde)  
    {   
        $dao = $daofactory->getUsuarioComplementoDAO($daofactory);
        return $dao->listPagina($pag, $qtde);
    }

/**
* carregarPorID() - Carrega APENAS um registro usando a id como item de busca
* na tabela USUARIO_COMPLEMENTO usando a Primary Key USCO_ID
*
* @param $daofactory
* @param $id
* @param $qtde
*
* @return UsuarioComplementoDTO
*/ 
    public function carregarPorID($daofactory, $id)
    { 
        $dao = $daofactory->getUsuarioComplementoDAO($daofactory);
        return $dao->loadPK($id);
    }

/**
* atualizarStatus() - atualizar o campo de STATUS utilizando a id como item de busca
* na tabela USUARIO_COMPLEMENTO usando a Primary Key USCO_ID
*
* @param $daofactory
* @param $id
* @param $status
*
* @return UsuarioComplementoDTO
*/ 
    public function atualizarStatus($daofactory, $id, $status)
    {
        $dao = $daofactory->getUsuarioComplementoDAO($daofactory);

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
* inserirUsuarioComplemento() - inserir um registro com base no UsuarioComplementoDTO. Alguns atributos dentro do DTO
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
public function inserirUsuarioComplemento($daofactory, $dto)
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
* inserir() - inserir um registro com base no UsuarioComplementoDTO. Alguns atributos dentro do DTO
* serão ignorados caso estejam populados.
*
* Atributos da classe UsuarioComplementoDTO sumariamente IGNORADOS por este método MESMO que estejam preenchidos:
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

    // Efetua validações no campo $dto->id com tamanho UsuarioComplementoConstantes::LEN_ID
    $ok = $this->validarTamanhoCampo($dto->id, UsuarioComplementoConstantes::LEN_ID, UsuarioComplementoConstantes::DESC_ID);
    if($ok->msgcode != ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO){
        return $ok;
    }

    // Efetua validações no campo $dto->idUsuario com tamanho UsuarioComplementoConstantes::LEN_IDUSUARIO
    $ok = $this->validarTamanhoCampo($dto->idUsuario, UsuarioComplementoConstantes::LEN_IDUSUARIO, UsuarioComplementoConstantes::DESC_IDUSUARIO);
    if($ok->msgcode != ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO){
        return $ok;
    }

    // Efetua validações no campo $dto->ddd com tamanho UsuarioComplementoConstantes::LEN_DDD
    $ok = $this->validarTamanhoCampo($dto->ddd, UsuarioComplementoConstantes::LEN_DDD, UsuarioComplementoConstantes::DESC_DDD);
    if($ok->msgcode != ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO){
        return $ok;
    }

    // Efetua validações no campo $dto->telefone com tamanho UsuarioComplementoConstantes::LEN_TELEFONE
    $ok = $this->validarTamanhoCampo($dto->telefone, UsuarioComplementoConstantes::LEN_TELEFONE, UsuarioComplementoConstantes::DESC_TELEFONE);
    if($ok->msgcode != ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO){
        return $ok;
    }

    // Efetua validações no campo $dto->nomeReceitaFederal com tamanho UsuarioComplementoConstantes::LEN_NOMERECEITAFEDERAL
    $ok = $this->validarTamanhoCampo($dto->nomeReceitaFederal, UsuarioComplementoConstantes::LEN_NOMERECEITAFEDERAL, UsuarioComplementoConstantes::DESC_NOMERECEITAFEDERAL);
    if($ok->msgcode != ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO){
        return $ok;
    }

    // Efetua validações no campo $dto->nomeResponsavel com tamanho UsuarioComplementoConstantes::LEN_NOMERESPONSAVEL
    $ok = $this->validarTamanhoCampo($dto->nomeResponsavel, UsuarioComplementoConstantes::LEN_NOMERESPONSAVEL, UsuarioComplementoConstantes::DESC_NOMERESPONSAVEL);
    if($ok->msgcode != ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO){
        return $ok;
    }

    // Efetua validações no campo $dto->urlsite com tamanho UsuarioComplementoConstantes::LEN_URLSITE
    $ok = $this->validarTamanhoCampo($dto->urlsite, UsuarioComplementoConstantes::LEN_URLSITE, UsuarioComplementoConstantes::DESC_URLSITE);
    if($ok->msgcode != ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO){
        return $ok;
    }

    // Efetua validações no campo $dto->urlFacebook com tamanho UsuarioComplementoConstantes::LEN_URLFACEBOOK
    $ok = $this->validarTamanhoCampo($dto->urlFacebook, UsuarioComplementoConstantes::LEN_URLFACEBOOK, UsuarioComplementoConstantes::DESC_URLFACEBOOK);
    if($ok->msgcode != ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO){
        return $ok;
    }

    // Efetua validações no campo $dto->urlInstagram com tamanho UsuarioComplementoConstantes::LEN_URLINSTAGRAM
    $ok = $this->validarTamanhoCampo($dto->urlInstagram, UsuarioComplementoConstantes::LEN_URLINSTAGRAM, UsuarioComplementoConstantes::DESC_URLINSTAGRAM);
    if($ok->msgcode != ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO){
        return $ok;
    }

    // Efetua validações no campo $dto->urlPinterest com tamanho UsuarioComplementoConstantes::LEN_URLPINTEREST
    $ok = $this->validarTamanhoCampo($dto->urlPinterest, UsuarioComplementoConstantes::LEN_URLPINTEREST, UsuarioComplementoConstantes::DESC_URLPINTEREST);
    if($ok->msgcode != ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO){
        return $ok;
    }

    // Efetua validações no campo $dto->urlSkype com tamanho UsuarioComplementoConstantes::LEN_URLSKYPE
    $ok = $this->validarTamanhoCampo($dto->urlSkype, UsuarioComplementoConstantes::LEN_URLSKYPE, UsuarioComplementoConstantes::DESC_URLSKYPE);
    if($ok->msgcode != ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO){
        return $ok;
    }

    // Efetua validações no campo $dto->urlTwitter com tamanho UsuarioComplementoConstantes::LEN_URLTWITTER
    $ok = $this->validarTamanhoCampo($dto->urlTwitter, UsuarioComplementoConstantes::LEN_URLTWITTER, UsuarioComplementoConstantes::DESC_URLTWITTER);
    if($ok->msgcode != ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO){
        return $ok;
    }

    // Efetua validações no campo $dto->urlFacetime com tamanho UsuarioComplementoConstantes::LEN_URLFACETIME
    $ok = $this->validarTamanhoCampo($dto->urlFacetime, UsuarioComplementoConstantes::LEN_URLFACETIME, UsuarioComplementoConstantes::DESC_URLFACETIME);
    if($ok->msgcode != ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO){
        return $ok;
    }

    // Efetua validações no campo $dto->urlResponsavel com tamanho UsuarioComplementoConstantes::LEN_URLRESPONSAVEL
    $ok = $this->validarTamanhoCampo($dto->urlResponsavel, UsuarioComplementoConstantes::LEN_URLRESPONSAVEL, UsuarioComplementoConstantes::DESC_URLRESPONSAVEL);
    if($ok->msgcode != ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO){
        return $ok;
    }

    // Efetua validações no campo $dto->urlFoto2 com tamanho UsuarioComplementoConstantes::LEN_URLFOTO2
    $ok = $this->validarTamanhoCampo($dto->urlFoto2, UsuarioComplementoConstantes::LEN_URLFOTO2, UsuarioComplementoConstantes::DESC_URLFOTO2);
    if($ok->msgcode != ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO){
        return $ok;
    }

    // Efetua validações no campo $dto->urlFoto3 com tamanho UsuarioComplementoConstantes::LEN_URLFOTO3
    $ok = $this->validarTamanhoCampo($dto->urlFoto3, UsuarioComplementoConstantes::LEN_URLFOTO3, UsuarioComplementoConstantes::DESC_URLFOTO3);
    if($ok->msgcode != ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO){
        return $ok;
    }

    // Efetua validações no campo $dto->descLivre com tamanho UsuarioComplementoConstantes::LEN_DESCLIVRE
    $ok = $this->validarTamanhoCampo($dto->descLivre, UsuarioComplementoConstantes::LEN_DESCLIVRE, UsuarioComplementoConstantes::DESC_DESCLIVRE);
    if($ok->msgcode != ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO){
        return $ok;
    }

    // Efetua validações no campo $dto->status com tamanho UsuarioComplementoConstantes::LEN_STATUS
    $ok = $this->validarTamanhoCampo($dto->status, UsuarioComplementoConstantes::LEN_STATUS, UsuarioComplementoConstantes::DESC_STATUS);
    if($ok->msgcode != ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO){
        return $ok;
    }

    // Efetua validações no campo $dto->dataCadastro com tamanho UsuarioComplementoConstantes::LEN_DATACADASTRO
    $ok = $this->validarTamanhoCampo($dto->dataCadastro, UsuarioComplementoConstantes::LEN_DATACADASTRO, UsuarioComplementoConstantes::DESC_DATACADASTRO);
    if($ok->msgcode != ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO){
        return $ok;
    }

    // Efetua validações no campo $dto->dataAtualizacao com tamanho UsuarioComplementoConstantes::LEN_DATAATUALIZACAO
    $ok = $this->validarTamanhoCampo($dto->dataAtualizacao, UsuarioComplementoConstantes::LEN_DATAATUALIZACAO, UsuarioComplementoConstantes::DESC_DATAATUALIZACAO);
    if($ok->msgcode != ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO){
        return $ok;
    }


    $dto->status = ConstantesVariavel::STATUS_ATIVO;
    $dao = $daofactory->getUsuarioComplementoDAO($daofactory);

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
* listarUsuarioComplementoPorStatus() - Usado para invocar a interface de acesso aos dados (DAO) UsuarioComplementoDAO de forma geral
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

    public function listarUsuarioComplementoPorStatus($daofactory, $status,  $pag=1, $qtde=0, $coluna=1, $ordem=0)
    {   
        $retorno = new DTOPaginacao();
        $retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
        $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);

        $dao = $daofactory->getUsuarioComplementoDAO($daofactory);
        $retorno->pagina = $pag;
        $retorno->itensPorPagina = ($qtde == 0 
        ? (int) VariavelCache::getInstance()->getVariavel(ConstantesVariavel::MAXIMO_LINHAS_POR_PAGINA_DEFAULT)
        : $qtde);
        $retorno->totalPaginas = ceil($dao->countUsuarioComplementoPorStatus($status) / $retorno->itensPorPagina);

        if($pag > $retorno->totalPaginas) {
            $retorno->msgcode = ConstantesMensagem::NAO_EXISTEM_MAIS_PAGINAS_APRESENTAR;
            $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);
            return $retorno;
        }
        $retorno->lst = $dao->listUsuarioComplementoPorStatus($status, $pag, $qtde, $coluna, $ordem);

        return $retorno;
    }






/**
*
* atualizarIdusuarioPorPK() - Usado para invocar a classe de negócio UsuarioComplementoBusinessImpl de forma geral
* realizar uma atualização de ID do usuário diretamente na tabela USUARIO_COMPLEMENTO campo USUA_ID
* @param $daofactory
* @param $id
* @param $idUsuario
* @return UsuarioComplementoDTO
*
* 
*/
    public function atualizarIdusuarioPorPK($daofactory,$idUsuario,$id)
    {
        $dao = $daofactory->getUsuarioComplementoDAO($daofactory);

        // resposta padrão
        $retorno = new DTOPadrao();

        if($dao->updateIdusuario($id, $idUsuario)){   
            $retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
        }       

        // Obtem o texto da mensagem em razão do código de retorno
        $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);

        return $retorno;
    }

/**
*
* atualizarDddPorPK() - Usado para invocar a classe de negócio UsuarioComplementoBusinessImpl de forma geral
* realizar uma atualização de DDD diretamente na tabela USUARIO_COMPLEMENTO campo USCO_TX_DDD
* @param $daofactory
* @param $id
* @param $ddd
* @return UsuarioComplementoDTO
*
* 
*/
    public function atualizarDddPorPK($daofactory,$ddd,$id)
    {
        $dao = $daofactory->getUsuarioComplementoDAO($daofactory);

        // resposta padrão
        $retorno = new DTOPadrao();

        if($dao->updateDdd($id, $ddd)){   
            $retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
        }       

        // Obtem o texto da mensagem em razão do código de retorno
        $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);

        return $retorno;
    }

/**
*
* atualizarTelefonePorPK() - Usado para invocar a classe de negócio UsuarioComplementoBusinessImpl de forma geral
* realizar uma atualização de Número Celular diretamente na tabela USUARIO_COMPLEMENTO campo USCO_TX_CEL
* @param $daofactory
* @param $id
* @param $telefone
* @return UsuarioComplementoDTO
*
* 
*/
    public function atualizarTelefonePorPK($daofactory,$telefone,$id)
    {
        $dao = $daofactory->getUsuarioComplementoDAO($daofactory);

        // resposta padrão
        $retorno = new DTOPadrao();

        if($dao->updateTelefone($id, $telefone)){   
            $retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
        }       

        // Obtem o texto da mensagem em razão do código de retorno
        $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);

        return $retorno;
    }

/**
*
* atualizarNomereceitafederalPorPK() - Usado para invocar a classe de negócio UsuarioComplementoBusinessImpl de forma geral
* realizar uma atualização de Nome registrado na Receita Federal diretamente na tabela USUARIO_COMPLEMENTO campo USCO_NM_RECEITA_FEDERAL
* @param $daofactory
* @param $id
* @param $nomeReceitaFederal
* @return UsuarioComplementoDTO
*
* 
*/
    public function atualizarNomereceitafederalPorPK($daofactory,$nomeReceitaFederal,$id)
    {
        $dao = $daofactory->getUsuarioComplementoDAO($daofactory);

        // resposta padrão
        $retorno = new DTOPadrao();

        if($dao->updateNomereceitafederal($id, $nomeReceitaFederal)){   
            $retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
        }       

        // Obtem o texto da mensagem em razão do código de retorno
        $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);

        return $retorno;
    }

/**
*
* atualizarNomeresponsavelPorPK() - Usado para invocar a classe de negócio UsuarioComplementoBusinessImpl de forma geral
* realizar uma atualização de Nome do Responsável Principal diretamente na tabela USUARIO_COMPLEMENTO campo USCO_NM_RESPONSAVEL
* @param $daofactory
* @param $id
* @param $nomeResponsavel
* @return UsuarioComplementoDTO
*
* 
*/
    public function atualizarNomeresponsavelPorPK($daofactory,$nomeResponsavel,$id)
    {
        $dao = $daofactory->getUsuarioComplementoDAO($daofactory);

        // resposta padrão
        $retorno = new DTOPadrao();

        if($dao->updateNomeresponsavel($id, $nomeResponsavel)){   
            $retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
        }       

        // Obtem o texto da mensagem em razão do código de retorno
        $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);

        return $retorno;
    }

/**
*
* atualizarUrlsitePorPK() - Usado para invocar a classe de negócio UsuarioComplementoBusinessImpl de forma geral
* realizar uma atualização de URL do Website diretamente na tabela USUARIO_COMPLEMENTO campo USCO_TX_URL_WEBSITE
* @param $daofactory
* @param $id
* @param $urlsite
* @return UsuarioComplementoDTO
*
* 
*/
    public function atualizarUrlsitePorPK($daofactory,$urlsite,$id)
    {
        $dao = $daofactory->getUsuarioComplementoDAO($daofactory);

        // resposta padrão
        $retorno = new DTOPadrao();

        if($dao->updateUrlsite($id, $urlsite)){   
            $retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
        }       

        // Obtem o texto da mensagem em razão do código de retorno
        $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);

        return $retorno;
    }

/**
*
* atualizarUrlfacebookPorPK() - Usado para invocar a classe de negócio UsuarioComplementoBusinessImpl de forma geral
* realizar uma atualização de URL do facebook diretamente na tabela USUARIO_COMPLEMENTO campo USCO_TX_URL_FACEBOOK
* @param $daofactory
* @param $id
* @param $urlFacebook
* @return UsuarioComplementoDTO
*
* 
*/
    public function atualizarUrlfacebookPorPK($daofactory,$urlFacebook,$id)
    {
        $dao = $daofactory->getUsuarioComplementoDAO($daofactory);

        // resposta padrão
        $retorno = new DTOPadrao();

        if($dao->updateUrlfacebook($id, $urlFacebook)){   
            $retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
        }       

        // Obtem o texto da mensagem em razão do código de retorno
        $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);

        return $retorno;
    }

/**
*
* atualizarUrlinstagramPorPK() - Usado para invocar a classe de negócio UsuarioComplementoBusinessImpl de forma geral
* realizar uma atualização de Conta Instagram diretamente na tabela USUARIO_COMPLEMENTO campo USCO_TX_URL_INSTAGRAM
* @param $daofactory
* @param $id
* @param $urlInstagram
* @return UsuarioComplementoDTO
*
* 
*/
    public function atualizarUrlinstagramPorPK($daofactory,$urlInstagram,$id)
    {
        $dao = $daofactory->getUsuarioComplementoDAO($daofactory);

        // resposta padrão
        $retorno = new DTOPadrao();

        if($dao->updateUrlinstagram($id, $urlInstagram)){   
            $retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
        }       

        // Obtem o texto da mensagem em razão do código de retorno
        $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);

        return $retorno;
    }

/**
*
* atualizarUrlpinterestPorPK() - Usado para invocar a classe de negócio UsuarioComplementoBusinessImpl de forma geral
* realizar uma atualização de URL do Pinterest diretamente na tabela USUARIO_COMPLEMENTO campo USCO_TX_URL_PINTEREST
* @param $daofactory
* @param $id
* @param $urlPinterest
* @return UsuarioComplementoDTO
*
* 
*/
    public function atualizarUrlpinterestPorPK($daofactory,$urlPinterest,$id)
    {
        $dao = $daofactory->getUsuarioComplementoDAO($daofactory);

        // resposta padrão
        $retorno = new DTOPadrao();

        if($dao->updateUrlpinterest($id, $urlPinterest)){   
            $retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
        }       

        // Obtem o texto da mensagem em razão do código de retorno
        $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);

        return $retorno;
    }

/**
*
* atualizarUrlskypePorPK() - Usado para invocar a classe de negócio UsuarioComplementoBusinessImpl de forma geral
* realizar uma atualização de Apelido Skype diretamente na tabela USUARIO_COMPLEMENTO campo USCO_TX_URL_SKYPE
* @param $daofactory
* @param $id
* @param $urlSkype
* @return UsuarioComplementoDTO
*
* 
*/
    public function atualizarUrlskypePorPK($daofactory,$urlSkype,$id)
    {
        $dao = $daofactory->getUsuarioComplementoDAO($daofactory);

        // resposta padrão
        $retorno = new DTOPadrao();

        if($dao->updateUrlskype($id, $urlSkype)){   
            $retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
        }       

        // Obtem o texto da mensagem em razão do código de retorno
        $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);

        return $retorno;
    }

/**
*
* atualizarUrltwitterPorPK() - Usado para invocar a classe de negócio UsuarioComplementoBusinessImpl de forma geral
* realizar uma atualização de Conta Twitter diretamente na tabela USUARIO_COMPLEMENTO campo USCO_TX_URL_TWITTER
* @param $daofactory
* @param $id
* @param $urlTwitter
* @return UsuarioComplementoDTO
*
* 
*/
    public function atualizarUrltwitterPorPK($daofactory,$urlTwitter,$id)
    {
        $dao = $daofactory->getUsuarioComplementoDAO($daofactory);

        // resposta padrão
        $retorno = new DTOPadrao();

        if($dao->updateUrltwitter($id, $urlTwitter)){   
            $retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
        }       

        // Obtem o texto da mensagem em razão do código de retorno
        $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);

        return $retorno;
    }

/**
*
* atualizarUrlfacetimePorPK() - Usado para invocar a classe de negócio UsuarioComplementoBusinessImpl de forma geral
* realizar uma atualização de Conta Facetime diretamente na tabela USUARIO_COMPLEMENTO campo USCO_TX_URL_FACETIME
* @param $daofactory
* @param $id
* @param $urlFacetime
* @return UsuarioComplementoDTO
*
* 
*/
    public function atualizarUrlfacetimePorPK($daofactory,$urlFacetime,$id)
    {
        $dao = $daofactory->getUsuarioComplementoDAO($daofactory);

        // resposta padrão
        $retorno = new DTOPadrao();

        if($dao->updateUrlfacetime($id, $urlFacetime)){   
            $retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
        }       

        // Obtem o texto da mensagem em razão do código de retorno
        $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);

        return $retorno;
    }

/**
*
* atualizarUrlresponsavelPorPK() - Usado para invocar a classe de negócio UsuarioComplementoBusinessImpl de forma geral
* realizar uma atualização de URL Foto Responsável diretamente na tabela USUARIO_COMPLEMENTO campo USCO_TX_URL_IMG1
* @param $daofactory
* @param $id
* @param $urlResponsavel
* @return UsuarioComplementoDTO
*
* 
*/
    public function atualizarUrlresponsavelPorPK($daofactory,$urlResponsavel,$id)
    {
        $dao = $daofactory->getUsuarioComplementoDAO($daofactory);

        // resposta padrão
        $retorno = new DTOPadrao();

        if($dao->updateUrlresponsavel($id, $urlResponsavel)){   
            $retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
        }       

        // Obtem o texto da mensagem em razão do código de retorno
        $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);

        return $retorno;
    }

/**
*
* atualizarUrlfoto2PorPK() - Usado para invocar a classe de negócio UsuarioComplementoBusinessImpl de forma geral
* realizar uma atualização de URL Foto 2 diretamente na tabela USUARIO_COMPLEMENTO campo USCO_TX_URL_IMG2
* @param $daofactory
* @param $id
* @param $urlFoto2
* @return UsuarioComplementoDTO
*
* 
*/
    public function atualizarUrlfoto2PorPK($daofactory,$urlFoto2,$id)
    {
        $dao = $daofactory->getUsuarioComplementoDAO($daofactory);

        // resposta padrão
        $retorno = new DTOPadrao();

        if($dao->updateUrlfoto2($id, $urlFoto2)){   
            $retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
        }       

        // Obtem o texto da mensagem em razão do código de retorno
        $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);

        return $retorno;
    }

/**
*
* atualizarUrlfoto3PorPK() - Usado para invocar a classe de negócio UsuarioComplementoBusinessImpl de forma geral
* realizar uma atualização de URL Foto 3 diretamente na tabela USUARIO_COMPLEMENTO campo USCO_TX_URL_IMG3
* @param $daofactory
* @param $id
* @param $urlFoto3
* @return UsuarioComplementoDTO
*
* 
*/
    public function atualizarUrlfoto3PorPK($daofactory,$urlFoto3,$id)
    {
        $dao = $daofactory->getUsuarioComplementoDAO($daofactory);

        // resposta padrão
        $retorno = new DTOPadrao();

        if($dao->updateUrlfoto3($id, $urlFoto3)){   
            $retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
        }       

        // Obtem o texto da mensagem em razão do código de retorno
        $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);

        return $retorno;
    }

/**
*
* atualizarDesclivrePorPK() - Usado para invocar a classe de negócio UsuarioComplementoBusinessImpl de forma geral
* realizar uma atualização de Descrição Livre diretamente na tabela USUARIO_COMPLEMENTO campo USCO_TX_DESC_LIVRE
* @param $daofactory
* @param $id
* @param $descLivre
* @return UsuarioComplementoDTO
*
* 
*/
    public function atualizarDesclivrePorPK($daofactory,$descLivre,$id)
    {
        $dao = $daofactory->getUsuarioComplementoDAO($daofactory);

        // resposta padrão
        $retorno = new DTOPadrao();

        if($dao->updateDesclivre($id, $descLivre)){   
            $retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
        }       

        // Obtem o texto da mensagem em razão do código de retorno
        $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);

        return $retorno;
    }

/**
*
* pesquisarPorIdusuario() - Usado para invocar a classe de negócio UsuarioComplementoBusinessImpl de forma geral
* realizar uma busca de ID do usuário diretamente na tabela USUARIO_COMPLEMENTO campo USUA_ID
*
* @param $idUsuario
* @return UsuarioComplementoDTO
*
* 
*/
    public function pesquisarPorIdusuario($daofactory,$idUsuario)
    { 
        $dao = $daofactory->getUsuarioComplementoDAO($daofactory);
        return $dao->loadIdusuario($idUsuario);
    }

/**
*
* pesquisarPorDdd() - Usado para invocar a classe de negócio UsuarioComplementoBusinessImpl de forma geral
* realizar uma busca de DDD diretamente na tabela USUARIO_COMPLEMENTO campo USCO_TX_DDD
*
* @param $ddd
* @return UsuarioComplementoDTO
*
* 
*/
    public function pesquisarPorDdd($daofactory,$ddd)

    { 
        $dao = $daofactory->getUsuarioComplementoDAO($daofactory);
        return $dao->loadDdd($ddd);
    }

/**
*
* pesquisarPorTelefone() - Usado para invocar a classe de negócio UsuarioComplementoBusinessImpl de forma geral
* realizar uma busca de Número Celular diretamente na tabela USUARIO_COMPLEMENTO campo USCO_TX_CEL
*
* @param $telefone
* @return UsuarioComplementoDTO
*
* 
*/
    public function pesquisarPorTelefone($daofactory,$telefone)

    { 
        $dao = $daofactory->getUsuarioComplementoDAO($daofactory);
        return $dao->loadTelefone($telefone);
    }

/**
*
* pesquisarPorNomereceitafederal() - Usado para invocar a classe de negócio UsuarioComplementoBusinessImpl de forma geral
* realizar uma busca de Nome registrado na Receita Federal diretamente na tabela USUARIO_COMPLEMENTO campo USCO_NM_RECEITA_FEDERAL
*
* @param $nomeReceitaFederal
* @return UsuarioComplementoDTO
*
* 
*/
    public function pesquisarPorNomereceitafederal($daofactory,$nomeReceitaFederal)

    { 
        $dao = $daofactory->getUsuarioComplementoDAO($daofactory);
        return $dao->loadNomereceitafederal($nomeReceitaFederal);
    }

/**
*
* pesquisarPorNomeresponsavel() - Usado para invocar a classe de negócio UsuarioComplementoBusinessImpl de forma geral
* realizar uma busca de Nome do Responsável Principal diretamente na tabela USUARIO_COMPLEMENTO campo USCO_NM_RESPONSAVEL
*
* @param $nomeResponsavel
* @return UsuarioComplementoDTO
*
* 
*/
    public function pesquisarPorNomeresponsavel($daofactory,$nomeResponsavel)

    { 
        $dao = $daofactory->getUsuarioComplementoDAO($daofactory);
        return $dao->loadNomeresponsavel($nomeResponsavel);
    }

/**
*
* pesquisarPorUrlsite() - Usado para invocar a classe de negócio UsuarioComplementoBusinessImpl de forma geral
* realizar uma busca de URL do Website diretamente na tabela USUARIO_COMPLEMENTO campo USCO_TX_URL_WEBSITE
*
* @param $urlsite
* @return UsuarioComplementoDTO
*
* 
*/
    public function pesquisarPorUrlsite($daofactory,$urlsite)

    { 
        $dao = $daofactory->getUsuarioComplementoDAO($daofactory);
        return $dao->loadUrlsite($urlsite);
    }

/**
*
* pesquisarPorUrlfacebook() - Usado para invocar a classe de negócio UsuarioComplementoBusinessImpl de forma geral
* realizar uma busca de URL do facebook diretamente na tabela USUARIO_COMPLEMENTO campo USCO_TX_URL_FACEBOOK
*
* @param $urlFacebook
* @return UsuarioComplementoDTO
*
* 
*/
    public function pesquisarPorUrlfacebook($daofactory,$urlFacebook)

    { 
        $dao = $daofactory->getUsuarioComplementoDAO($daofactory);
        return $dao->loadUrlfacebook($urlFacebook);
    }

/**
*
* pesquisarPorUrlinstagram() - Usado para invocar a classe de negócio UsuarioComplementoBusinessImpl de forma geral
* realizar uma busca de Conta Instagram diretamente na tabela USUARIO_COMPLEMENTO campo USCO_TX_URL_INSTAGRAM
*
* @param $urlInstagram
* @return UsuarioComplementoDTO
*
* 
*/
    public function pesquisarPorUrlinstagram($daofactory,$urlInstagram)

    { 
        $dao = $daofactory->getUsuarioComplementoDAO($daofactory);
        return $dao->loadUrlinstagram($urlInstagram);
    }

/**
*
* pesquisarPorUrlpinterest() - Usado para invocar a classe de negócio UsuarioComplementoBusinessImpl de forma geral
* realizar uma busca de URL do Pinterest diretamente na tabela USUARIO_COMPLEMENTO campo USCO_TX_URL_PINTEREST
*
* @param $urlPinterest
* @return UsuarioComplementoDTO
*
* 
*/
    public function pesquisarPorUrlpinterest($daofactory,$urlPinterest)

    { 
        $dao = $daofactory->getUsuarioComplementoDAO($daofactory);
        return $dao->loadUrlpinterest($urlPinterest);
    }

/**
*
* pesquisarPorUrlskype() - Usado para invocar a classe de negócio UsuarioComplementoBusinessImpl de forma geral
* realizar uma busca de Apelido Skype diretamente na tabela USUARIO_COMPLEMENTO campo USCO_TX_URL_SKYPE
*
* @param $urlSkype
* @return UsuarioComplementoDTO
*
* 
*/
    public function pesquisarPorUrlskype($daofactory,$urlSkype)

    { 
        $dao = $daofactory->getUsuarioComplementoDAO($daofactory);
        return $dao->loadUrlskype($urlSkype);
    }

/**
*
* pesquisarPorUrltwitter() - Usado para invocar a classe de negócio UsuarioComplementoBusinessImpl de forma geral
* realizar uma busca de Conta Twitter diretamente na tabela USUARIO_COMPLEMENTO campo USCO_TX_URL_TWITTER
*
* @param $urlTwitter
* @return UsuarioComplementoDTO
*
* 
*/
    public function pesquisarPorUrltwitter($daofactory,$urlTwitter)

    { 
        $dao = $daofactory->getUsuarioComplementoDAO($daofactory);
        return $dao->loadUrltwitter($urlTwitter);
    }

/**
*
* pesquisarPorUrlfacetime() - Usado para invocar a classe de negócio UsuarioComplementoBusinessImpl de forma geral
* realizar uma busca de Conta Facetime diretamente na tabela USUARIO_COMPLEMENTO campo USCO_TX_URL_FACETIME
*
* @param $urlFacetime
* @return UsuarioComplementoDTO
*
* 
*/
    public function pesquisarPorUrlfacetime($daofactory,$urlFacetime)

    { 
        $dao = $daofactory->getUsuarioComplementoDAO($daofactory);
        return $dao->loadUrlfacetime($urlFacetime);
    }

/**
*
* pesquisarPorUrlresponsavel() - Usado para invocar a classe de negócio UsuarioComplementoBusinessImpl de forma geral
* realizar uma busca de URL Foto Responsável diretamente na tabela USUARIO_COMPLEMENTO campo USCO_TX_URL_IMG1
*
* @param $urlResponsavel
* @return UsuarioComplementoDTO
*
* 
*/
    public function pesquisarPorUrlresponsavel($daofactory,$urlResponsavel)

    { 
        $dao = $daofactory->getUsuarioComplementoDAO($daofactory);
        return $dao->loadUrlresponsavel($urlResponsavel);
    }

/**
*
* pesquisarPorUrlfoto2() - Usado para invocar a classe de negócio UsuarioComplementoBusinessImpl de forma geral
* realizar uma busca de URL Foto 2 diretamente na tabela USUARIO_COMPLEMENTO campo USCO_TX_URL_IMG2
*
* @param $urlFoto2
* @return UsuarioComplementoDTO
*
* 
*/
    public function pesquisarPorUrlfoto2($daofactory,$urlFoto2)

    { 
        $dao = $daofactory->getUsuarioComplementoDAO($daofactory);
        return $dao->loadUrlfoto2($urlFoto2);
    }

/**
*
* pesquisarPorUrlfoto3() - Usado para invocar a classe de negócio UsuarioComplementoBusinessImpl de forma geral
* realizar uma busca de URL Foto 3 diretamente na tabela USUARIO_COMPLEMENTO campo USCO_TX_URL_IMG3
*
* @param $urlFoto3
* @return UsuarioComplementoDTO
*
* 
*/
    public function pesquisarPorUrlfoto3($daofactory,$urlFoto3)

    { 
        $dao = $daofactory->getUsuarioComplementoDAO($daofactory);
        return $dao->loadUrlfoto3($urlFoto3);
    }

/**
*
* pesquisarPorDesclivre() - Usado para invocar a classe de negócio UsuarioComplementoBusinessImpl de forma geral
* realizar uma busca de Descrição Livre diretamente na tabela USUARIO_COMPLEMENTO campo USCO_TX_DESC_LIVRE
*
* @param $descLivre
* @return UsuarioComplementoDTO
*
* 
*/
    public function pesquisarPorDesclivre($daofactory,$descLivre)

    { 
        $dao = $daofactory->getUsuarioComplementoDAO($daofactory);
        return $dao->loadDesclivre($descLivre);
    }


/**
*
* listarUsuarioComplementoUsuaIdPorStatus() - Usado para invocar a interface de acesso aos dados (DAO) UsuarioComplementoDAO de forma geral
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

    public function listarUsuarioComplementoPorUsuaIdStatus($daofactory, $usuaid, $status,  $pag=1, $qtde=0, $coluna=1, $ordem=0)
    {   
        $retorno = new DTOPaginacao();
        $retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
        $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);

        $dao = $daofactory->getUsuarioComplementoDAO($daofactory);
        $retorno->pagina = $pag;
        $retorno->itensPorPagina = ($qtde == 0 
        ? (int) VariavelCache::getInstance()->getVariavel(ConstantesVariavel::MAXIMO_LINHAS_POR_PAGINA_DEFAULT)
        : $qtde);
        $retorno->totalPaginas = ceil($dao->countUsuarioComplementoPorUsuaIdStatus($usuaid, $status) / $retorno->itensPorPagina);

        if($pag > $retorno->totalPaginas) {
            $retorno->msgcode = ConstantesMensagem::NAO_EXISTEM_MAIS_PAGINAS_APRESENTAR;
            $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);
            return $retorno;
        }
        $retorno->lst = $dao->listUsuarioComplementoPorUsuaIdStatus($usuaid, $status, $pag, $qtde, $coluna, $ordem);

        return $retorno;
    }

/**
* validarTamanhoCampo()
*
* Validador de tamanho de campos UsuarioComplementoDTO
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
