<?php 

// importar dependencias
require_once 'ContatoBusiness.php';
require_once 'ContatoConstantes.php';
require_once 'ContatoHelper.php';
require_once '../dto/DTOPadrao.php';
require_once '../dto/DTOPaginacao.php';

require_once '../variavel/ConstantesVariavel.php';
require_once '../variavel/VariavelCache.php';

/**
*
* ContatoBusinessImpl - Classe de implementação dos métodos de negócio para a interface ContatoBusiness
* Camada de negócio Contato - camada responsável pela lógica de negócios de Contato do sistema. 
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
* @since 31/08/2021 08:17:22
*
*/


class ContatoBusinessImpl implements ContatoBusiness
{
    
    function __construct()  {   }

/**
* carregar() - Carrega apenas um registro com base no campo id = (CONTATO::CONT_ID)
* @param $daofactory
* @param $dto
* @return $dto
*/ 
    public function carregar($daofactory, $dto) {   }

/**
* listarTudo() - Lista todos os registros provenientes de CONTATO sem critério de paginação
* @param $daofactory
* @return List<ContatoDTO>[]
*/ 
    public function listarTudo($daofactory) {   }

/**
* pesquisarMaxPKAtivoNomePorStatus() - Carrega apenas um registro com base no nome  e status para buscar a MAIOR PK
* @param $daofactory
* @param $status
* @return ContatoDTO
*/ 
    public function pesquisarMaxPKAtivoNomePorStatus($daofactory, $nome,$status)
    { 
        $dao = $daofactory->getContatoDAO($daofactory);
        $maxid = $dao->loadMaxNomePK($nome,$status);
        return $this->carregarPorID($daofactory, $maxid);
    }

/**
* atualizar() - atualiza apenas um registro com base no dto ContatoDTO->id
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


        $dao = $daofactory->getContatoDAO($daofactory);
        if(!$dao->update($dto)){
           $retorno->msgcode = ConstantesMensagem::ERRO_CRUD_ATUALIZAR_REGISTRO;
           $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);
    
        }
        // retorna situação
        return $retorno;

    }

/**
* deletar() - excluir fisicamente um registro com base no dto ContatoDTO->id
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
        $dao = $daofactory->getContatoDAO($daofactory);

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
* @return List<ContatoDTO>[]
* @deprecated
*/ 

    public function listarPagina($daofactory, $pag, $qtde)  
    {   
        $dao = $daofactory->getContatoDAO($daofactory);
        return $dao->listPagina($pag, $qtde);
    }

/**
* carregarPorID() - Carrega APENAS um registro usando a id como item de busca
* na tabela CONTATO usando a Primary Key CONT_ID
*
* @param $daofactory
* @param $id
* @param $qtde
*
* @return ContatoDTO
*/ 
    public function carregarPorID($daofactory, $id)
    { 
        $dao = $daofactory->getContatoDAO($daofactory);
        return $dao->loadPK($id);
    }

/**
* atualizarStatus() - atualizar o campo de STATUS utilizando a id como item de busca
* na tabela CONTATO usando a Primary Key CONT_ID
*
* @param $daofactory
* @param $id
* @param $status
*
* @return ContatoDTO
*/ 
    public function atualizarStatus($daofactory, $id, $status)
    {
        $dao = $daofactory->getContatoDAO($daofactory);

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
* inserirContato() - inserir um registro com base no ContatoDTO. Alguns atributos dentro do DTO
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
public function inserirContato($daofactory, $dto)
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
* inserir() - inserir um registro com base no ContatoDTO. Alguns atributos dentro do DTO
* serão ignorados caso estejam populados.
*
* Atributos da classe ContatoDTO sumariamente IGNORADOS por este método MESMO que estejam preenchidos:
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

    // Efetua validações no campo $dto->id com tamanho ContatoConstantes::LEN_ID
    $ok = $this->validarTamanhoCampo($dto->id, ContatoConstantes::LEN_ID, ContatoConstantes::DESC_ID);
    if($ok->msgcode != ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO){
        return $ok;
    }

    // Efetua validações no campo $dto->nome com tamanho ContatoConstantes::LEN_NOME
    $ok = $this->validarTamanhoCampo($dto->nome, ContatoConstantes::LEN_NOME, ContatoConstantes::DESC_NOME);
    if($ok->msgcode != ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO){
        return $ok;
    }

    // Efetua validações no campo $dto->email com tamanho ContatoConstantes::LEN_EMAIL
    $ok = $this->validarTamanhoCampo($dto->email, ContatoConstantes::LEN_EMAIL, ContatoConstantes::DESC_EMAIL);
    if($ok->msgcode != ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO){
        return $ok;
    }

    // Efetua validações no campo $dto->mensagem com tamanho ContatoConstantes::LEN_MENSAGEM
    $ok = $this->validarTamanhoCampo($dto->mensagem, ContatoConstantes::LEN_MENSAGEM, ContatoConstantes::DESC_MENSAGEM);
    if($ok->msgcode != ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO){
        return $ok;
    }


    // Efetua validações no campo $dto->status com tamanho ContatoConstantes::LEN_STATUS
    $ok = $this->validarTamanhoCampo($dto->status, ContatoConstantes::LEN_STATUS, ContatoConstantes::DESC_STATUS);
    if($ok->msgcode != ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO){
        return $ok;
    }

    // Efetua validações no campo $dto->dataCadastro com tamanho ContatoConstantes::LEN_DATACADASTRO
    $ok = $this->validarTamanhoCampo($dto->dataCadastro, ContatoConstantes::LEN_DATACADASTRO, ContatoConstantes::DESC_DATACADASTRO);
    if($ok->msgcode != ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO){
        return $ok;
    }

    // Efetua validações no campo $dto->dataAtualizacao com tamanho ContatoConstantes::LEN_DATAATUALIZACAO
    $ok = $this->validarTamanhoCampo($dto->dataAtualizacao, ContatoConstantes::LEN_DATAATUALIZACAO, ContatoConstantes::DESC_DATAATUALIZACAO);
    if($ok->msgcode != ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO){
        return $ok;
    }


    $dto->status = ConstantesVariavel::STATUS_ATIVO;
    $dao = $daofactory->getContatoDAO($daofactory);

    if (!$dao->insert($dto)) {
        $retorno = new DTOPadrao();
        $retorno->msgcode = ConstantesMensagem::ERRO_CRUD_INSERIR_REGISTRO;
        $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);
        return $retorno;
    }

    // Envia notificação ao Admin
    ContatoHelper::criarNotificacaoAdmin($daofactory
        , ConstantesMensagem::NOTIFICACAO_CONTATO_USUARIO
        , [
            ConstantesVariavel::P1 => $dto->nome,
            ConstantesVariavel::P2 => $dto->email,
            ConstantesVariavel::P3 => $dto->origem,
        ]
        , "money.png");

    return $retorno;
}

/**
*
* listarContatoPorStatus() - Usado para invocar a interface de acesso aos dados (DAO) ContatoDAO de forma geral
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

    public function listarContatoPorStatus($daofactory, $status, $pag, $qtde, $coluna, $ordem)
    {   
        $retorno = new DTOPaginacao();
        $retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
        $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);

        $dao = $daofactory->getContatoDAO($daofactory);
        $retorno->pagina = $pag;
        $retorno->itensPorPagina = ($qtde == 0 
        ? (int) VariavelCache::getInstance()->getVariavel(ConstantesVariavel::MAXIMO_LINHAS_POR_PAGINA_DEFAULT)
        : $qtde);
        $retorno->totalPaginas = ceil($dao->countContatoPorStatus($status) / $retorno->itensPorPagina);

        if($pag > $retorno->totalPaginas) {
            $retorno->msgcode = ConstantesMensagem::NAO_EXISTEM_MAIS_PAGINAS_APRESENTAR;
            $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);
            return $retorno;
        }
        $retorno->lst = $dao->listContatoPorStatus($status, $pag, $qtde, $coluna, $ordem);

        return $retorno;
    }






/**
*
* atualizarNomePorPK() - Usado para invocar a classe de negócio ContatoBusinessImpl de forma geral
* realizar uma atualização de Nome do usuário diretamente na tabela CONTATO campo CONT_NM_NOME
* @param $daofactory
* @param $id
* @param $nome
* @return ContatoDTO
*
* 
*/
    public function atualizarNomePorPK($daofactory,$nome,$id)
    {
        $dao = $daofactory->getContatoDAO($daofactory);

        // resposta padrão
        $retorno = new DTOPadrao();

        if($dao->updateNome($id, $nome)){   
            $retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
        }       

        // Obtem o texto da mensagem em razão do código de retorno
        $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);

        return $retorno;
    }

/**
*
* atualizarEmailPorPK() - Usado para invocar a classe de negócio ContatoBusinessImpl de forma geral
* realizar uma atualização de Email do usuário diretamente na tabela CONTATO campo CONT_TX_EMAIL
* @param $daofactory
* @param $id
* @param $email
* @return ContatoDTO
*
* 
*/
    public function atualizarEmailPorPK($daofactory,$email,$id)
    {
        $dao = $daofactory->getContatoDAO($daofactory);

        // resposta padrão
        $retorno = new DTOPadrao();

        if($dao->updateEmail($id, $email)){   
            $retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
        }       

        // Obtem o texto da mensagem em razão do código de retorno
        $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);

        return $retorno;
    }

/**
*
* atualizarMensagemPorPK() - Usado para invocar a classe de negócio ContatoBusinessImpl de forma geral
* realizar uma atualização de Mensagem postada pelo usuário diretamente na tabela CONTATO campo CONT_TX_MENSAGEM
* @param $daofactory
* @param $id
* @param $mensagem
* @return ContatoDTO
*
* 
*/
    public function atualizarMensagemPorPK($daofactory,$mensagem,$id)
    {
        $dao = $daofactory->getContatoDAO($daofactory);

        // resposta padrão
        $retorno = new DTOPadrao();

        if($dao->updateMensagem($id, $mensagem)){   
            $retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
        }       

        // Obtem o texto da mensagem em razão do código de retorno
        $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);

        return $retorno;
    }

/**
*
* pesquisarPorNome() - Usado para invocar a classe de negócio ContatoBusinessImpl de forma geral
* realizar uma busca de Nome do usuário diretamente na tabela CONTATO campo CONT_NM_NOME
*
* @param $nome
* @return ContatoDTO
*
* 
*/
    public function pesquisarPorNome($daofactory,$nome)
    { 
        $dao = $daofactory->getContatoDAO($daofactory);
        return $dao->loadNome($nome);
    }

/**
*
* pesquisarPorEmail() - Usado para invocar a classe de negócio ContatoBusinessImpl de forma geral
* realizar uma busca de Email do usuário diretamente na tabela CONTATO campo CONT_TX_EMAIL
*
* @param $email
* @return ContatoDTO
*
* 
*/
    public function pesquisarPorEmail($daofactory,$email)

    { 
        $dao = $daofactory->getContatoDAO($daofactory);
        return $dao->loadEmail($email);
    }

/**
*
* pesquisarPorMensagem() - Usado para invocar a classe de negócio ContatoBusinessImpl de forma geral
* realizar uma busca de Mensagem postada pelo usuário diretamente na tabela CONTATO campo CONT_TX_MENSAGEM
*
* @param $mensagem
* @return ContatoDTO
*
* 
*/
    public function pesquisarPorMensagem($daofactory,$mensagem)

    { 
        $dao = $daofactory->getContatoDAO($daofactory);
        return $dao->loadMensagem($mensagem);
    }
/**
*
* listarContatoUsuaIdPorStatus() - Usado para invocar a interface de acesso aos dados (DAO) ContatoDAO de forma geral
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

    public function listarContatoPorUsuaIdStatus($daofactory, $usuaid, $status, $pag, $qtde, $coluna, $ordem)
    {   
        $retorno = new DTOPaginacao();
        $retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
        $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);

        $dao = $daofactory->getContatoDAO($daofactory);
        $retorno->pagina = $pag;
        $retorno->itensPorPagina = ($qtde == 0 
        ? (int) VariavelCache::getInstance()->getVariavel(ConstantesVariavel::MAXIMO_LINHAS_POR_PAGINA_DEFAULT)
        : $qtde);
        $retorno->totalPaginas = ceil($dao->countContatoPorUsuaIdStatus($usuaid, $status) / $retorno->itensPorPagina);

        if($pag > $retorno->totalPaginas) {
            $retorno->msgcode = ConstantesMensagem::NAO_EXISTEM_MAIS_PAGINAS_APRESENTAR;
            $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);
            return $retorno;
        }
        $retorno->lst = $dao->listContatoPorUsuaIdStatus($usuaid, $status, $pag, $qtde, $coluna, $ordem);

        return $retorno;
    }

/**
* validarTamanhoCampo()
*
* Validador de tamanho de campos ContatoDTO
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
