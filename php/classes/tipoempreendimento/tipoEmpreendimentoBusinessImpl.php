<?php 

// importar dependencias
require_once 'TipoEmpreendimentoBusiness.php';
require_once 'TipoEmpreendimentoConstantes.php';
require_once 'TipoEmpreendimentoHelper.php';
require_once '../dto/DTOPadrao.php';
require_once '../dto/DTOPaginacao.php';

require_once '../variavel/ConstantesVariavel.php';
require_once '../variavel/VariavelCache.php';

/**
*
* TipoEmpreendimentoBusinessImpl - Classe de implementação dos métodos de negócio para a interface TipoEmpreendimentoBusiness
* Camada de negócio TipoEmpreendimento - camada responsável pela lógica de negócios de TipoEmpreendimento do sistema. 
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
* @since 06/09/2021 08:28:01
*
*/


class TipoEmpreendimentoBusinessImpl implements TipoEmpreendimentoBusiness
{
    
    function __construct()  {   }

/**
* carregar() - Carrega apenas um registro com base no campo id = (TIPO_EMPREENDIMENTO::TIEM_ID)
* @param $daofactory
* @param $dto
* @return $dto
*/ 
    public function carregar($daofactory, $dto) {   }

/**
* listarTudo() - Lista todos os registros provenientes de TIPO_EMPREENDIMENTO sem critério de paginação
* @param $daofactory
* @return List<TipoEmpreendimentoDTO>[]
*/ 
    public function listarTudo($daofactory) {   }

/**
* pesquisarMaxPKAtivoDescricaoPorStatus() - Carrega apenas um registro com base no descricao  e status para buscar a MAIOR PK
* @param $daofactory
* @param $status
* @return TipoEmpreendimentoDTO
*/ 
    public function pesquisarMaxPKAtivoDescricaoPorStatus($daofactory, $descricao,$status)
    { 
        $dao = $daofactory->getTipoEmpreendimentoDAO($daofactory);
        $maxid = $dao->loadMaxDescricaoPK($descricao,$status);
        return $this->carregarPorID($daofactory, $maxid);
    }

/**
* atualizar() - atualiza apenas um registro com base no dto TipoEmpreendimentoDTO->id
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


        $dao = $daofactory->getTipoEmpreendimentoDAO($daofactory);
        if(!$dao->update($dto)){
           $retorno->msgcode = ConstantesMensagem::ERRO_CRUD_ATUALIZAR_REGISTRO;
           $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);
    
        }
        // retorna situação
        return $retorno;

    }

/**
* deletar() - excluir fisicamente um registro com base no dto TipoEmpreendimentoDTO->id
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
        $dao = $daofactory->getTipoEmpreendimentoDAO($daofactory);

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
* @return List<TipoEmpreendimentoDTO>[]
* @deprecated
*/ 

    public function listarPagina($daofactory, $pag, $qtde)  
    {   
        $dao = $daofactory->getTipoEmpreendimentoDAO($daofactory);
        return $dao->listPagina($pag, $qtde);
    }

/**
* carregarPorID() - Carrega APENAS um registro usando a id como item de busca
* na tabela TIPO_EMPREENDIMENTO usando a Primary Key TIEM_ID
*
* @param $daofactory
* @param $id
* @param $qtde
*
* @return TipoEmpreendimentoDTO
*/ 
    public function carregarPorID($daofactory, $id)
    { 
        $dao = $daofactory->getTipoEmpreendimentoDAO($daofactory);
        return $dao->loadPK($id);
    }

/**
* atualizarStatus() - atualizar o campo de STATUS utilizando a id como item de busca
* na tabela TIPO_EMPREENDIMENTO usando a Primary Key TIEM_ID
*
* @param $daofactory
* @param $id
* @param $status
*
* @return TipoEmpreendimentoDTO
*/ 
    public function atualizarStatus($daofactory, $id, $status)
    {
        $dao = $daofactory->getTipoEmpreendimentoDAO($daofactory);

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
* inserirTipoEmpreendimento() - inserir um registro com base no TipoEmpreendimentoDTO. Alguns atributos dentro do DTO
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
public function inserirTipoEmpreendimento($daofactory, $dto)
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
* inserir() - inserir um registro com base no TipoEmpreendimentoDTO. Alguns atributos dentro do DTO
* serão ignorados caso estejam populados.
*
* Atributos da classe TipoEmpreendimentoDTO sumariamente IGNORADOS por este método MESMO que estejam preenchidos:
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

    // Efetua validações no campo $dto->id com tamanho TipoEmpreendimentoConstantes::LEN_ID
    $ok = $this->validarTamanhoCampo($dto->id, TipoEmpreendimentoConstantes::LEN_ID, TipoEmpreendimentoConstantes::DESC_ID);
    if($ok->msgcode != ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO){
        return $ok;
    }

    // Efetua validações no campo $dto->descricao com tamanho TipoEmpreendimentoConstantes::LEN_DESCRICAO
    $ok = $this->validarTamanhoCampo($dto->descricao, TipoEmpreendimentoConstantes::LEN_DESCRICAO, TipoEmpreendimentoConstantes::DESC_DESCRICAO);
    if($ok->msgcode != ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO){
        return $ok;
    }

    // Efetua validações no campo $dto->urlimg com tamanho TipoEmpreendimentoConstantes::LEN_URLIMG
    $ok = $this->validarTamanhoCampo($dto->urlimg, TipoEmpreendimentoConstantes::LEN_URLIMG, TipoEmpreendimentoConstantes::DESC_URLIMG);
    if($ok->msgcode != ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO){
        return $ok;
    }

    // Efetua validações no campo $dto->status com tamanho TipoEmpreendimentoConstantes::LEN_STATUS
    $ok = $this->validarTamanhoCampo($dto->status, TipoEmpreendimentoConstantes::LEN_STATUS, TipoEmpreendimentoConstantes::DESC_STATUS);
    if($ok->msgcode != ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO){
        return $ok;
    }

    // Efetua validações no campo $dto->dataCadastro com tamanho TipoEmpreendimentoConstantes::LEN_DATACADASTRO
    $ok = $this->validarTamanhoCampo($dto->dataCadastro, TipoEmpreendimentoConstantes::LEN_DATACADASTRO, TipoEmpreendimentoConstantes::DESC_DATACADASTRO);
    if($ok->msgcode != ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO){
        return $ok;
    }

    // Efetua validações no campo $dto->dataAtualizacao com tamanho TipoEmpreendimentoConstantes::LEN_DATAATUALIZACAO
    $ok = $this->validarTamanhoCampo($dto->dataAtualizacao, TipoEmpreendimentoConstantes::LEN_DATAATUALIZACAO, TipoEmpreendimentoConstantes::DESC_DATAATUALIZACAO);
    if($ok->msgcode != ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO){
        return $ok;
    }


    $dto->status = ConstantesVariavel::STATUS_ATIVO;
    $dao = $daofactory->getTipoEmpreendimentoDAO($daofactory);

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
* listarTipoEmpreendimentoPorStatus() - Usado para invocar a interface de acesso aos dados (DAO) TipoEmpreendimentoDAO de forma geral
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

    public function listarTipoEmpreendimentoPorStatus($daofactory, $status,  $pag=1, $qtde=0, $coluna=1, $ordem=0)
    {   
        $retorno = new DTOPaginacao();
        $retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
        $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);

        $dao = $daofactory->getTipoEmpreendimentoDAO($daofactory);
        $retorno->pagina = $pag;
        $retorno->itensPorPagina = ($qtde == 0 
        ? (int) VariavelCache::getInstance()->getVariavel(ConstantesVariavel::MAXIMO_LINHAS_POR_PAGINA_DEFAULT)
        : $qtde);
        $retorno->totalPaginas = ceil($dao->countTipoEmpreendimentoPorStatus($status) / $retorno->itensPorPagina);

        if($pag > $retorno->totalPaginas) {
            $retorno->msgcode = ConstantesMensagem::NAO_EXISTEM_MAIS_PAGINAS_APRESENTAR;
            $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);
            return $retorno;
        }
        $retorno->lst = $dao->listTipoEmpreendimentoPorStatus($status, $pag, $retorno->itensPorPagina, $coluna, $ordem);

        return $retorno;
    }






/**
*
* atualizarDescricaoPorPK() - Usado para invocar a classe de negócio TipoEmpreendimentoBusinessImpl de forma geral
* realizar uma atualização de Descrição tipo de empreendimento diretamente na tabela TIPO_EMPREENDIMENTO campo TIEM_TX_DESCRICAO
* @param $daofactory
* @param $id
* @param $descricao
* @return TipoEmpreendimentoDTO
*
* 
*/
    public function atualizarDescricaoPorPK($daofactory,$descricao,$id)
    {
        $dao = $daofactory->getTipoEmpreendimentoDAO($daofactory);

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
* atualizarUrlimgPorPK() - Usado para invocar a classe de negócio TipoEmpreendimentoBusinessImpl de forma geral
* realizar uma atualização de URL da imagem tipo de empreendimento diretamente na tabela TIPO_EMPREENDIMENTO campo TIEM_TX_IMG
* @param $daofactory
* @param $id
* @param $urlimg
* @return TipoEmpreendimentoDTO
*
* 
*/
    public function atualizarUrlimgPorPK($daofactory,$urlimg,$id)
    {
        $dao = $daofactory->getTipoEmpreendimentoDAO($daofactory);

        // resposta padrão
        $retorno = new DTOPadrao();

        if($dao->updateUrlimg($id, $urlimg)){   
            $retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
        }       

        // Obtem o texto da mensagem em razão do código de retorno
        $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);

        return $retorno;
    }

/**
*
* pesquisarPorDescricao() - Usado para invocar a classe de negócio TipoEmpreendimentoBusinessImpl de forma geral
* realizar uma busca de Descrição tipo de empreendimento diretamente na tabela TIPO_EMPREENDIMENTO campo TIEM_TX_DESCRICAO
*
* @param $descricao
* @return TipoEmpreendimentoDTO
*
* 
*/
    public function pesquisarPorDescricao($daofactory,$descricao)
    { 
        $dao = $daofactory->getTipoEmpreendimentoDAO($daofactory);
        return $dao->loadDescricao($descricao);
    }

/**
*
* pesquisarPorUrlimg() - Usado para invocar a classe de negócio TipoEmpreendimentoBusinessImpl de forma geral
* realizar uma busca de URL da imagem tipo de empreendimento diretamente na tabela TIPO_EMPREENDIMENTO campo TIEM_TX_IMG
*
* @param $urlimg
* @return TipoEmpreendimentoDTO
*
* 
*/
    public function pesquisarPorUrlimg($daofactory,$urlimg)

    { 
        $dao = $daofactory->getTipoEmpreendimentoDAO($daofactory);
        return $dao->loadUrlimg($urlimg);
    }

/**
*
* listarTipoEmpreendimentoUsuaIdPorStatus() - Usado para invocar a interface de acesso aos dados (DAO) TipoEmpreendimentoDAO de forma geral
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

    public function listarTipoEmpreendimentoPorUsuaIdStatus($daofactory, $usuaid, $status,  $pag=1, $qtde=0, $coluna=1, $ordem=0)
    {   
        $retorno = new DTOPaginacao();
        $retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
        $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);

        $dao = $daofactory->getTipoEmpreendimentoDAO($daofactory);
        $retorno->pagina = $pag;
        $retorno->itensPorPagina = ($qtde == 0 
        ? (int) VariavelCache::getInstance()->getVariavel(ConstantesVariavel::MAXIMO_LINHAS_POR_PAGINA_DEFAULT)
        : $qtde);
        $retorno->totalPaginas = ceil($dao->countTipoEmpreendimentoPorUsuaIdStatus($usuaid, $status) / $retorno->itensPorPagina);

        if($pag > $retorno->totalPaginas) {
            $retorno->msgcode = ConstantesMensagem::NAO_EXISTEM_MAIS_PAGINAS_APRESENTAR;
            $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);
            return $retorno;
        }
        $retorno->lst = $dao->listTipoEmpreendimentoPorUsuaIdStatus($usuaid, $status, $pag, $retorno->itensPorPagina, $coluna, $ordem);

        return $retorno;
    }

/**
* validarTamanhoCampo()
*
* Validador de tamanho de campos TipoEmpreendimentoDTO
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
