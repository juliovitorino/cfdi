<?php 

// importar dependencias
require_once 'CartaoMoverHistoricoBusiness.php';
require_once 'CartaoMoverHistoricoConstantes.php';
require_once 'CartaoMoverHistoricoHelper.php';
require_once '../dto/DTOPadrao.php';
require_once '../dto/DTOPaginacao.php';

require_once '../variavel/ConstantesVariavel.php';
require_once '../variavel/VariavelCache.php';

/**
*
* CartaoMoverHistoricoBusinessImpl - Classe de implementação dos métodos de negócio para a interface CartaoMoverHistoricoBusiness
* Camada de negócio CartaoMoverHistorico - camada responsável pela lógica de negócios de CartaoMoverHistorico do sistema. 
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
* @since 24/07/2021 10:20:31
*
*/


class CartaoMoverHistoricoBusinessImpl implements CartaoMoverHistoricoBusiness
{
    
    function __construct()  {   }

/**
* carregar() - Carrega apenas um registro com base no campo id = (CARTAO_MOVER_HISTORICO::CAMH_ID)
* @param $daofactory
* @param $dto
* @return $dto
*/ 
    public function carregar($daofactory, $dto) {   }

/**
* listarTudo() - Lista todos os registros provenientes de CARTAO_MOVER_HISTORICO sem critério de paginação
* @param $daofactory
* @return List<CartaoMoverHistoricoDTO>[]
*/ 
    public function listarTudo($daofactory) {   }

/**
* pesquisarMaxPKAtivoIdcartaoPorStatus() - Carrega apenas um registro com base no idCartao  e status para buscar a MAIOR PK
* @param $daofactory
* @param $status
* @return CartaoMoverHistoricoDTO
*/ 
    public function pesquisarMaxPKAtivoIdcartaoPorStatus($daofactory, $idCartao,$status)
    { 
        $dao = $daofactory->getCartaoMoverHistoricoDAO($daofactory);
        $maxid = $dao->loadMaxIdcartaoPK($idCartao,$status);
        return $this->carregarPorID($daofactory, $maxid);
    }

/**
* atualizar() - atualiza apenas um registro com base no dto CartaoMoverHistoricoDTO->id
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


        $dao = $daofactory->getCartaoMoverHistoricoDAO($daofactory);
        if(!$dao->update($dto)){
           $retorno->msgcode = ConstantesMensagem::ERRO_CRUD_ATUALIZAR_REGISTRO;
           $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);
    
        }
        // retorna situação
        return $retorno;

    }

/**
* deletar() - excluir fisicamente um registro com base no dto CartaoMoverHistoricoDTO->id
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
        $dao = $daofactory->getCartaoMoverHistoricoDAO($daofactory);

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
* @return List<CartaoMoverHistoricoDTO>[]
* @deprecated
*/ 

    public function listarPagina($daofactory, $pag, $qtde)  
    {   
        $dao = $daofactory->getCartaoMoverHistoricoDAO($daofactory);
        return $dao->listPagina($pag, $qtde);
    }

/**
* carregarPorID() - Carrega APENAS um registro usando a id como item de busca
* na tabela CARTAO_MOVER_HISTORICO usando a Primary Key CAMH_ID
*
* @param $daofactory
* @param $id
* @param $qtde
*
* @return CartaoMoverHistoricoDTO
*/ 
    public function carregarPorID($daofactory, $id)
    { 
        $dao = $daofactory->getCartaoMoverHistoricoDAO($daofactory);
        return $dao->loadPK($id);
    }

/**
* atualizarStatus() - atualizar o campo de STATUS utilizando a id como item de busca
* na tabela CARTAO_MOVER_HISTORICO usando a Primary Key CAMH_ID
*
* @param $daofactory
* @param $id
* @param $status
*
* @return CartaoMoverHistoricoDTO
*/ 
    public function atualizarStatus($daofactory, $id, $status)
    {
        $dao = $daofactory->getCartaoMoverHistoricoDAO($daofactory);

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
* inserir() - inserir um registro com base no CartaoMoverHistoricoDTO. Alguns atributos dentro do DTO
* serão ignorados caso estejam populados.
*
* Atributos da classe CartaoMoverHistoricoDTO sumariamente IGNORADOS por este método MESMO que estejam preenchidos:
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

    // Efetua validações no campo $dto->id com tamanho CartaoMoverHistoricoConstantes::LEN_ID
    $ok = $this->validarTamanhoCampo($dto->id, CartaoMoverHistoricoConstantes::LEN_ID, CartaoMoverHistoricoConstantes::DESC_ID);
    if($ok->msgcode != ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO){
        return $ok;
    }

    // Efetua validações no campo $dto->idCartao com tamanho CartaoMoverHistoricoConstantes::LEN_IDCARTAO
    $ok = $this->validarTamanhoCampo($dto->idCartao, CartaoMoverHistoricoConstantes::LEN_IDCARTAO, CartaoMoverHistoricoConstantes::DESC_IDCARTAO);
    if($ok->msgcode != ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO){
        return $ok;
    }

    // Efetua validações no campo $dto->idUsuarioDoador com tamanho CartaoMoverHistoricoConstantes::LEN_IDUSUARIODOADOR
    $ok = $this->validarTamanhoCampo($dto->idUsuarioDoador, CartaoMoverHistoricoConstantes::LEN_IDUSUARIODOADOR, CartaoMoverHistoricoConstantes::DESC_IDUSUARIODOADOR);
    if($ok->msgcode != ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO){
        return $ok;
    }

    // Efetua validações no campo $dto->idUsuarioReceptor com tamanho CartaoMoverHistoricoConstantes::LEN_IDUSUARIORECEPTOR
    $ok = $this->validarTamanhoCampo($dto->idUsuarioReceptor, CartaoMoverHistoricoConstantes::LEN_IDUSUARIORECEPTOR, CartaoMoverHistoricoConstantes::DESC_IDUSUARIORECEPTOR);
    if($ok->msgcode != ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO){
        return $ok;
    }

    // Efetua validações no campo $dto->status com tamanho CartaoMoverHistoricoConstantes::LEN_STATUS
    $ok = $this->validarTamanhoCampo($dto->status, CartaoMoverHistoricoConstantes::LEN_STATUS, CartaoMoverHistoricoConstantes::DESC_STATUS);
    if($ok->msgcode != ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO){
        return $ok;
    }

    // Efetua validações no campo $dto->dataCadastro com tamanho CartaoMoverHistoricoConstantes::LEN_DATACADASTRO
    $ok = $this->validarTamanhoCampo($dto->dataCadastro, CartaoMoverHistoricoConstantes::LEN_DATACADASTRO, CartaoMoverHistoricoConstantes::DESC_DATACADASTRO);
    if($ok->msgcode != ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO){
        return $ok;
    }

    // Efetua validações no campo $dto->dataAtualizacao com tamanho CartaoMoverHistoricoConstantes::LEN_DATAATUALIZACAO
    $ok = $this->validarTamanhoCampo($dto->dataAtualizacao, CartaoMoverHistoricoConstantes::LEN_DATAATUALIZACAO, CartaoMoverHistoricoConstantes::DESC_DATAATUALIZACAO);
    if($ok->msgcode != ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO){
        return $ok;
    }


    $dto->status = ConstantesVariavel::STATUS_ATIVO;
    $dao = $daofactory->getCartaoMoverHistoricoDAO($daofactory);

    if (!$dao->insert($dto)) {
        $retorno = new DTOPadrao();
        $retorno->msgcode = ConstantesMensagem::ERRO_CRUD_INSERIR_REGISTRO;
        $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);
    }

    return $retorno;
}

/**
*
* listarCartaoMoverHistoricoPorStatus() - Usado para invocar a interface de acesso aos dados (DAO) CartaoMoverHistoricoDAO de forma geral
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

    public function listarCartaoMoverHistoricoPorStatus($daofactory, $status, $pag, $qtde, $coluna, $ordem)
    {   
        $retorno = new DTOPaginacao();
        $retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
        $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);

        $dao = $daofactory->getCartaoMoverHistoricoDAO($daofactory);
        $retorno->pagina = $pag;
        $retorno->itensPorPagina = ($qtde == 0 
        ? (int) VariavelCache::getInstance()->getVariavel(ConstantesVariavel::MAXIMO_LINHAS_POR_PAGINA_DEFAULT)
        : $qtde);
        $retorno->totalPaginas = ceil($dao->countCartaoMoverHistoricoPorStatus($status) / $retorno->itensPorPagina);

        if($pag > $retorno->totalPaginas) {
            $retorno->msgcode = ConstantesMensagem::NAO_EXISTEM_MAIS_PAGINAS_APRESENTAR;
            $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);
            return $retorno;
        }
        $retorno->lst = $dao->listCartaoMoverHistoricoPorStatus($status, $pag, $qtde, $coluna, $ordem);

        return $retorno;
    }






/**
*
* atualizarIdcartaoPorPK() - Usado para invocar a classe de negócio CartaoMoverHistoricoBusinessImpl de forma geral
* realizar uma atualização de ID do cartão diretamente na tabela CARTAO_MOVER_HISTORICO campo CART_ID
* @param $daofactory
* @param $id
* @param $idCartao
* @return CartaoMoverHistoricoDTO
*
* 
*/
    public function atualizarIdcartaoPorPK($daofactory,$idCartao,$id)
    {
        $dao = $daofactory->getCartaoMoverHistoricoDAO($daofactory);

        // resposta padrão
        $retorno = new DTOPadrao();

        if($dao->updateIdcartao($id, $idCartao)){   
            $retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
        }       

        // Obtem o texto da mensagem em razão do código de retorno
        $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);

        return $retorno;
    }

/**
*
* atualizarIdusuariodoadorPorPK() - Usado para invocar a classe de negócio CartaoMoverHistoricoBusinessImpl de forma geral
* realizar uma atualização de ID do usuário doador diretamente na tabela CARTAO_MOVER_HISTORICO campo USUA_ID_DE
* @param $daofactory
* @param $id
* @param $idUsuarioDoador
* @return CartaoMoverHistoricoDTO
*
* 
*/
    public function atualizarIdusuariodoadorPorPK($daofactory,$idUsuarioDoador,$id)
    {
        $dao = $daofactory->getCartaoMoverHistoricoDAO($daofactory);

        // resposta padrão
        $retorno = new DTOPadrao();

        if($dao->updateIdusuariodoador($id, $idUsuarioDoador)){   
            $retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
        }       

        // Obtem o texto da mensagem em razão do código de retorno
        $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);

        return $retorno;
    }

/**
*
* atualizarIdusuarioreceptorPorPK() - Usado para invocar a classe de negócio CartaoMoverHistoricoBusinessImpl de forma geral
* realizar uma atualização de ID do usuário receptor diretamente na tabela CARTAO_MOVER_HISTORICO campo USUA_ID_PARA
* @param $daofactory
* @param $id
* @param $idUsuarioReceptor
* @return CartaoMoverHistoricoDTO
*
* 
*/
    public function atualizarIdusuarioreceptorPorPK($daofactory,$idUsuarioReceptor,$id)
    {
        $dao = $daofactory->getCartaoMoverHistoricoDAO($daofactory);

        // resposta padrão
        $retorno = new DTOPadrao();

        if($dao->updateIdusuarioreceptor($id, $idUsuarioReceptor)){   
            $retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
        }       

        // Obtem o texto da mensagem em razão do código de retorno
        $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);

        return $retorno;
    }

/**
*
* pesquisarPorIdcartao() - Usado para invocar a classe de negócio CartaoMoverHistoricoBusinessImpl de forma geral
* realizar uma busca de ID do cartão diretamente na tabela CARTAO_MOVER_HISTORICO campo CART_ID
*
* @param $idCartao
* @return CartaoMoverHistoricoDTO
*
* 
*/
    public function pesquisarPorIdcartao($daofactory,$idCartao)
    { 
        $dao = $daofactory->getCartaoMoverHistoricoDAO($daofactory);
        return $dao->loadIdcartao($idCartao);
    }

/**
*
* pesquisarPorIdusuariodoador() - Usado para invocar a classe de negócio CartaoMoverHistoricoBusinessImpl de forma geral
* realizar uma busca de ID do usuário doador diretamente na tabela CARTAO_MOVER_HISTORICO campo USUA_ID_DE
*
* @param $idUsuarioDoador
* @return CartaoMoverHistoricoDTO
*
* 
*/
    public function pesquisarPorIdusuariodoador($daofactory,$idUsuarioDoador)

    { 
        $dao = $daofactory->getCartaoMoverHistoricoDAO($daofactory);
        return $dao->loadIdusuariodoador($idUsuarioDoador);
    }

/**
*
* pesquisarPorIdusuarioreceptor() - Usado para invocar a classe de negócio CartaoMoverHistoricoBusinessImpl de forma geral
* realizar uma busca de ID do usuário receptor diretamente na tabela CARTAO_MOVER_HISTORICO campo USUA_ID_PARA
*
* @param $idUsuarioReceptor
* @return CartaoMoverHistoricoDTO
*
* 
*/
    public function pesquisarPorIdusuarioreceptor($daofactory,$idUsuarioReceptor)

    { 
        $dao = $daofactory->getCartaoMoverHistoricoDAO($daofactory);
        return $dao->loadIdusuarioreceptor($idUsuarioReceptor);
    }

/**
*
* listarCartaoMoverHistoricoUsuaIdPorStatus() - Usado para invocar a interface de acesso aos dados (DAO) CartaoMoverHistoricoDAO de forma geral
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

    public function listarCartaoMoverHistoricoPorUsuaIdStatus($daofactory, $usuaid, $status, $pag, $qtde, $coluna, $ordem)
    {   
        $retorno = new DTOPaginacao();
        $retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
        $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);

        $dao = $daofactory->getCartaoMoverHistoricoDAO($daofactory);
        $retorno->pagina = $pag;
        $retorno->itensPorPagina = ($qtde == 0 
        ? (int) VariavelCache::getInstance()->getVariavel(ConstantesVariavel::MAXIMO_LINHAS_POR_PAGINA_DEFAULT)
        : $qtde);
        $retorno->totalPaginas = ceil($dao->countCartaoMoverHistoricoPorUsuaIdStatus($usuaid, $status) / $retorno->itensPorPagina);

        if($pag > $retorno->totalPaginas) {
            $retorno->msgcode = ConstantesMensagem::NAO_EXISTEM_MAIS_PAGINAS_APRESENTAR;
            $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);
            return $retorno;
        }
        $retorno->lst = $dao->listCartaoMoverHistoricoPorUsuaIdStatus($usuaid, $status, $pag, $qtde, $coluna, $ordem);

        return $retorno;
    }

/**
* validarTamanhoCampo()
*
* Validador de tamanho de campos CartaoMoverHistoricoDTO
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
