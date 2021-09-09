<?php 

// importar dependencias
require_once 'UsuarioCampanhaSorteioTicketBusiness.php';
require_once 'UsuarioCampanhaSorteioTicketConstantes.php';
require_once 'UsuarioCampanhaSorteioTicketHelper.php';
require_once '../dto/DTOPadrao.php';
require_once '../dto/DTOPaginacao.php';

require_once '../variavel/ConstantesVariavel.php';
require_once '../variavel/VariavelCache.php';

/**
*
* UsuarioCampanhaSorteioTicketBusinessImpl - Classe de implementação dos métodos de negócio para a interface UsuarioCampanhaSorteioTicketBusiness
* Camada de negócio UsuarioCampanhaSorteioTicket - camada responsável pela lógica de negócios de UsuarioCampanhaSorteioTicket do sistema. 
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
* @since 22/06/2021 10:37:39
*
*/


class UsuarioCampanhaSorteioTicketBusinessImpl implements UsuarioCampanhaSorteioTicketBusiness
{
    
    function __construct()  {   }

/**
* carregar() - Carrega apenas um registro com base no campo id = (USUARIO_CAMPANHA_SORTEIO_TICKET::UCST_ID)
* @param $daofactory
* @param $dto
* @return $dto
*/ 
    public function carregar($daofactory, $dto) {   }

/**
* listarTudo() - Lista todos os registros provenientes de USUARIO_CAMPANHA_SORTEIO_TICKET sem critério de paginação
* @param $daofactory
* @return List<UsuarioCampanhaSorteioTicketDTO>[]
*/ 
    public function listarTudo($daofactory) {   }

/**
* pesquisarMaxPKAtivoIduscsPorStatus() - Carrega apenas um registro com base no iduscs  e status para buscar a MAIOR PK
* @param $daofactory
* @param $status
* @return UsuarioCampanhaSorteioTicketDTO
*/ 
    public function pesquisarMaxPKAtivoIduscsPorStatus($daofactory, $iduscs,$status)
    { 
        $dao = $daofactory->getUsuarioCampanhaSorteioTicketDAO($daofactory);
        $maxid = $dao->loadMaxIduscsPK($iduscs,$status);
        return $this->carregarPorID($daofactory, $maxid);
    }

/**
* atualizar() - atualiza apenas um registro com base no dto UsuarioCampanhaSorteioTicketDTO->id
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


        $dao = $daofactory->getUsuarioCampanhaSorteioTicketDAO($daofactory);
        if(!$dao->update($dto)){
           $retorno->msgcode = ConstantesMensagem::ERRO_CRUD_ATUALIZAR_REGISTRO;
           $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);
    
        }
        // retorna situação
        return $retorno;

    }

/**
* deletar() - excluir fisicamente um registro com base no dto UsuarioCampanhaSorteioTicketDTO->id
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
        $dao = $daofactory->getUsuarioCampanhaSorteioTicketDAO($daofactory);

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
* @return List<UsuarioCampanhaSorteioTicketDTO>[]
* @deprecated
*/ 

    public function listarPagina($daofactory, $pag, $qtde)  
    {   
        $dao = $daofactory->getUsuarioCampanhaSorteioTicketDAO($daofactory);
        return $dao->listPagina($pag, $qtde);
    }

/**
* carregarPorID() - Carrega APENAS um registro usando a id como item de busca
* na tabela USUARIO_CAMPANHA_SORTEIO_TICKET usando a Primary Key UCST_ID
*
* @param $daofactory
* @param $id
* @param $qtde
*
* @return UsuarioCampanhaSorteioTicketDTO
*/ 
    public function carregarPorID($daofactory, $id)
    { 
        $dao = $daofactory->getUsuarioCampanhaSorteioTicketDAO($daofactory);
        return $dao->loadPK($id);
    }

/**
* atualizarStatus() - atualizar o campo de STATUS utilizando a id como item de busca
* na tabela USUARIO_CAMPANHA_SORTEIO_TICKET usando a Primary Key UCST_ID
*
* @param $daofactory
* @param $id
* @param $status
*
* @return UsuarioCampanhaSorteioTicketDTO
*/ 
    public function atualizarStatus($daofactory, $id, $status)
    {
        $dao = $daofactory->getUsuarioCampanhaSorteioTicketDAO($daofactory);

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
* inserir() - inserir um registro com base no UsuarioCampanhaSorteioTicketDTO. Alguns atributos dentro do DTO
* serão ignorados caso estejam populados.
*
* Atributos da classe UsuarioCampanhaSorteioTicketDTO sumariamente IGNORADOS por este método MESMO que estejam preenchidos:
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

    // Efetua validações no campo $dto->id com tamanho UsuarioCampanhaSorteioTicketConstantes::LEN_ID
    $ok = $this->validarTamanhoCampo($dto->id, UsuarioCampanhaSorteioTicketConstantes::LEN_ID, UsuarioCampanhaSorteioTicketConstantes::DESC_ID);
    if($ok->msgcode != ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO){
        return $ok;
    }

    // Efetua validações no campo $dto->iduscs com tamanho UsuarioCampanhaSorteioTicketConstantes::LEN_IDUSCS
    $ok = $this->validarTamanhoCampo($dto->iduscs, UsuarioCampanhaSorteioTicketConstantes::LEN_IDUSCS, UsuarioCampanhaSorteioTicketConstantes::DESC_IDUSCS);
    if($ok->msgcode != ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO){
        return $ok;
    }

    // Efetua validações no campo $dto->ticket com tamanho UsuarioCampanhaSorteioTicketConstantes::LEN_TICKET
    $ok = $this->validarTamanhoCampo($dto->ticket, UsuarioCampanhaSorteioTicketConstantes::LEN_TICKET, UsuarioCampanhaSorteioTicketConstantes::DESC_TICKET);
    if($ok->msgcode != ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO){
        return $ok;
    }

    // Efetua validações no campo $dto->status com tamanho UsuarioCampanhaSorteioTicketConstantes::LEN_STATUS
    $ok = $this->validarTamanhoCampo($dto->status, UsuarioCampanhaSorteioTicketConstantes::LEN_STATUS, UsuarioCampanhaSorteioTicketConstantes::DESC_STATUS);
    if($ok->msgcode != ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO){
        return $ok;
    }

    // Efetua validações no campo $dto->dataCadastro com tamanho UsuarioCampanhaSorteioTicketConstantes::LEN_DATACADASTRO
    $ok = $this->validarTamanhoCampo($dto->dataCadastro, UsuarioCampanhaSorteioTicketConstantes::LEN_DATACADASTRO, UsuarioCampanhaSorteioTicketConstantes::DESC_DATACADASTRO);
    if($ok->msgcode != ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO){
        return $ok;
    }

    // Efetua validações no campo $dto->dataAtualizacao com tamanho UsuarioCampanhaSorteioTicketConstantes::LEN_DATAATUALIZACAO
    $ok = $this->validarTamanhoCampo($dto->dataAtualizacao, UsuarioCampanhaSorteioTicketConstantes::LEN_DATAATUALIZACAO, UsuarioCampanhaSorteioTicketConstantes::DESC_DATAATUALIZACAO);
    if($ok->msgcode != ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO){
        return $ok;
    }


    $dto->status = ConstantesVariavel::STATUS_ATIVO;
    $dao = $daofactory->getUsuarioCampanhaSorteioTicketDAO($daofactory);

    if (!$dao->insert($dto)) {
        $retorno = new DTOPadrao();
        $retorno->msgcode = ConstantesMensagem::ERRO_CRUD_INSERIR_REGISTRO;
        $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);
    }

    return $retorno;
}

/**
*
* listarUsuarioCampanhaSorteioTicketPorStatus() - Usado para invocar a interface de acesso aos dados (DAO) UsuarioCampanhaSorteioTicketDAO de forma geral
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

    public function listarUsuarioCampanhaSorteioTicketPorStatus($daofactory, $status, $pag, $qtde, $coluna, $ordem)
    {   
        $retorno = new DTOPaginacao();
        $retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
        $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);

        $dao = $daofactory->getUsuarioCampanhaSorteioTicketDAO($daofactory);
        $retorno->pagina = $pag;
        $retorno->itensPorPagina = ($qtde == 0 
        ? (int) VariavelCache::getInstance()->getVariavel(ConstantesVariavel::MAXIMO_LINHAS_POR_PAGINA_DEFAULT)
        : $qtde);
        $retorno->totalPaginas = ceil($dao->countUsuarioCampanhaSorteioTicketPorStatus($status) / $retorno->itensPorPagina);

        if($pag > $retorno->totalPaginas) {
            $retorno->msgcode = ConstantesMensagem::NAO_EXISTEM_MAIS_PAGINAS_APRESENTAR;
            $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);
            return $retorno;
        }
        $retorno->lst = $dao->listUsuarioCampanhaSorteioTicketPorStatus($status, $pag, $retorno->itensPorPagina, $coluna, $ordem);

        return $retorno;
    }






/**
*
* atualizarIduscsPorPK() - Usado para invocar a classe de negócio UsuarioCampanhaSorteioTicketBusinessImpl de forma geral
* realizar uma atualização de ID Usuario Campanha Sorteio diretamente na tabela USUARIO_CAMPANHA_SORTEIO_TICKET campo USCS_ID
* @param $daofactory
* @param $id
* @param $iduscs
* @return UsuarioCampanhaSorteioTicketDTO
*
* 
*/
    public function atualizarIduscsPorPK($daofactory,$iduscs,$id)
    {
        $dao = $daofactory->getUsuarioCampanhaSorteioTicketDAO($daofactory);

        // resposta padrão
        $retorno = new DTOPadrao();

        if($dao->updateIduscs($id, $iduscs)){   
            $retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
        }       

        // Obtem o texto da mensagem em razão do código de retorno
        $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);

        return $retorno;
    }

/**
*
* atualizarTicketPorPK() - Usado para invocar a classe de negócio UsuarioCampanhaSorteioTicketBusinessImpl de forma geral
* realizar uma atualização de Número do Ticket diretamente na tabela USUARIO_CAMPANHA_SORTEIO_TICKET campo UCST_NU_TICKET
* @param $daofactory
* @param $id
* @param $ticket
* @return UsuarioCampanhaSorteioTicketDTO
*
* 
*/
    public function atualizarTicketPorPK($daofactory,$ticket,$id)
    {
        $dao = $daofactory->getUsuarioCampanhaSorteioTicketDAO($daofactory);

        // resposta padrão
        $retorno = new DTOPadrao();

        if($dao->updateTicket($id, $ticket)){   
            $retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
        }       

        // Obtem o texto da mensagem em razão do código de retorno
        $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);

        return $retorno;
    }


/**
*
* pesquisarPorIduscs() - Usado para invocar a classe de negócio UsuarioCampanhaSorteioTicketBusinessImpl de forma geral
* realizar uma busca de ID Usuario Campanha Sorteio diretamente na tabela USUARIO_CAMPANHA_SORTEIO_TICKET campo USCS_ID
*
* @param $iduscs
* @return UsuarioCampanhaSorteioTicketDTO
*
* 
*/
    public function pesquisarPorIduscs($daofactory,$iduscs)
    { 
        $dao = $daofactory->getUsuarioCampanhaSorteioTicketDAO($daofactory);
        return $dao->loadIduscs($iduscs);
    }

/**
*
* pesquisarPorTicket() - Usado para invocar a classe de negócio UsuarioCampanhaSorteioTicketBusinessImpl de forma geral
* realizar uma busca de Número do Ticket diretamente na tabela USUARIO_CAMPANHA_SORTEIO_TICKET campo UCST_NU_TICKET
*
* @param $ticket
* @return UsuarioCampanhaSorteioTicketDTO
*
* 
*/
    public function pesquisarPorTicket($daofactory,$ticket)

    { 
        $dao = $daofactory->getUsuarioCampanhaSorteioTicketDAO($daofactory);
        return $dao->loadTicket($ticket);
    }

/**
*
* listarUsuarioCampanhaSorteioTicketUsuaIdPorStatus() - Usado para invocar a interface de acesso aos dados (DAO) UsuarioCampanhaSorteioTicketDAO de forma geral
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

    public function listarUsuarioCampanhaSorteioTicketPorUsuaIdStatus($daofactory, $usuaid, $status, $pag, $qtde, $coluna, $ordem)
    {   
        $retorno = new DTOPaginacao();
        $retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
        $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);

        $dao = $daofactory->getUsuarioCampanhaSorteioTicketDAO($daofactory);
        $retorno->pagina = $pag;
        $retorno->itensPorPagina = ($qtde == 0 
        ? (int) VariavelCache::getInstance()->getVariavel(ConstantesVariavel::MAXIMO_LINHAS_POR_PAGINA_DEFAULT)
        : $qtde);
        $retorno->totalPaginas = ceil($dao->countUsuarioCampanhaSorteioTicketPorUsuaIdStatus($usuaid, $status) / $retorno->itensPorPagina);

        if($pag > $retorno->totalPaginas) {
            $retorno->msgcode = ConstantesMensagem::NAO_EXISTEM_MAIS_PAGINAS_APRESENTAR;
            $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);
            return $retorno;
        }
        $retorno->lst = $dao->listUsuarioCampanhaSorteioTicketPorUsuaIdStatus($usuaid, $status, $pag, $retorno->itensPorPagina, $coluna, $ordem);

        return $retorno;
    }

/**
*
* listarUsuarioCampanhaSorteioTicketUsuaIdPorStatus() - Usado para invocar a interface de acesso aos dados (DAO) UsuarioCampanhaSorteioTicketDAO de forma geral
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

public function listarUsuarioCampanhaSorteioTicketPorUscsIdStatus($daofactory, $uscsid, $status, $pag, $qtde, $coluna, $ordem)
{   
    $retorno = new DTOPaginacao();
    $retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
    $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);

    $dao = $daofactory->getUsuarioCampanhaSorteioTicketDAO($daofactory);
    $retorno->pagina = $pag;
    $retorno->itensPorPagina = ($qtde == 0 
    ? (int) VariavelCache::getInstance()->getVariavel(ConstantesVariavel::MAXIMO_LINHAS_POR_PAGINA_DEFAULT)
    : $qtde);
    $retorno->totalPaginas = ceil($dao->countUsuarioCampanhaSorteioTicketPorUscsIdStatus($uscsid, $status) / $retorno->itensPorPagina);

    if($pag > $retorno->totalPaginas) {
        $retorno->msgcode = ConstantesMensagem::NAO_EXISTEM_MAIS_PAGINAS_APRESENTAR;
        $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);
        return $retorno;
    }
    $retorno->lst = $dao->listUsuarioCampanhaSorteioTicketPorUscsIdStatus($uscsid, $status, $pag, $retorno->itensPorPagina, $coluna, $ordem);

    return $retorno;
}


/**
* validarTamanhoCampo()
*
* Validador de tamanho de campos UsuarioCampanhaSorteioTicketDTO
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
