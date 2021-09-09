<?php 

// importar dependencias
require_once 'PlanoRecursoBusiness.php';
require_once 'PlanoRecursoConstantes.php';
require_once 'PlanoRecursoHelper.php';
require_once '../dto/DTOPadrao.php';
require_once '../dto/DTOPaginacao.php';

require_once '../variavel/ConstantesVariavel.php';
require_once '../variavel/VariavelCache.php';

/**
*
* PlanoRecursoBusinessImpl - Classe de implementação dos métodos de negócio para a interface PlanoRecursoBusiness
* Camada de negócio PlanoRecurso - camada responsável pela lógica de negócios de PlanoRecurso do sistema. 
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
* @since 09/09/2021 12:12:30
*
*/

class PlanoRecursoBusinessImpl implements PlanoRecursoBusiness
{
    
    function __construct()  {   }

/**
* carregar() - Carrega apenas um registro com base no campo id = (PLANO_RECURSO::PLRE_ID)
* @param $daofactory
* @param $dto
* @return $dto
*/ 
    public function carregar($daofactory, $dto) {   }

/**
* listarTudo() - Lista todos os registros provenientes de PLANO_RECURSO sem critério de paginação
* @param $daofactory
* @return List<PlanoRecursoDTO>[]
*/ 
    public function listarTudo($daofactory) {   }

/**
* pesquisarMaxPKAtivoIdplanoPorStatus() - Carrega apenas um registro com base no idplano  e status para buscar a MAIOR PK
* @param $daofactory
* @param $status
* @return PlanoRecursoDTO
*/ 
    public function pesquisarMaxPKAtivoIdplanoPorStatus($daofactory, $idplano,$status)
    { 
        $dao = $daofactory->getPlanoRecursoDAO($daofactory);
        $maxid = $dao->loadMaxIdplanoPK($idplano,$status);
        return $this->carregarPorID($daofactory, $maxid);
    }

/**
* atualizar() - atualiza apenas um registro com base no dto PlanoRecursoDTO->id
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


        $dao = $daofactory->getPlanoRecursoDAO($daofactory);
        if(!$dao->update($dto)){
           $retorno->msgcode = ConstantesMensagem::ERRO_CRUD_ATUALIZAR_REGISTRO;
           $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);
    
        }
        // retorna situação
        return $retorno;

    }

/**
* deletar() - excluir fisicamente um registro com base no dto PlanoRecursoDTO->id
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
        $dao = $daofactory->getPlanoRecursoDAO($daofactory);

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
* @return List<PlanoRecursoDTO>[]
* @deprecated
*/ 

    public function listarPagina($daofactory, $pag, $qtde)  
    {   
        $dao = $daofactory->getPlanoRecursoDAO($daofactory);
        return $dao->listPagina($pag, $qtde);
    }

/**
* carregarPorID() - Carrega APENAS um registro usando a id como item de busca
* na tabela PLANO_RECURSO usando a Primary Key PLRE_ID
*
* @param $daofactory
* @param $id
* @param $qtde
*
* @return PlanoRecursoDTO
*/ 
    public function carregarPorID($daofactory, $id)
    { 
        $dao = $daofactory->getPlanoRecursoDAO($daofactory);
        return $dao->loadPK($id);
    }

/**
* atualizarStatus() - atualizar o campo de STATUS utilizando a id como item de busca
* na tabela PLANO_RECURSO usando a Primary Key PLRE_ID
*
* @param $daofactory
* @param $id
* @param $status
*
* @return PlanoRecursoDTO
*/ 
    public function atualizarStatus($daofactory, $id, $status)
    {
        $dao = $daofactory->getPlanoRecursoDAO($daofactory);

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
* inserirPlanoRecurso() - inserir um registro com base no PlanoRecursoDTO. Alguns atributos dentro do DTO
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
public function inserirPlanoRecurso($daofactory, $dto)
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
* inserir() - inserir um registro com base no PlanoRecursoDTO. Alguns atributos dentro do DTO
* serão ignorados caso estejam populados.
*
* Atributos da classe PlanoRecursoDTO sumariamente IGNORADOS por este método MESMO que estejam preenchidos:
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

    // Efetua validações no campo $dto->id com tamanho PlanoRecursoConstantes::LEN_ID
    $ok = $this->validarTamanhoCampo($dto->id, PlanoRecursoConstantes::LEN_ID, PlanoRecursoConstantes::DESC_ID);
    if($ok->msgcode != ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO){
        return $ok;
    }

    // Efetua validações no campo $dto->idplano com tamanho PlanoRecursoConstantes::LEN_IDPLANO
    $ok = $this->validarTamanhoCampo($dto->idplano, PlanoRecursoConstantes::LEN_IDPLANO, PlanoRecursoConstantes::DESC_IDPLANO);
    if($ok->msgcode != ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO){
        return $ok;
    }

    // Efetua validações no campo $dto->idrecurso com tamanho PlanoRecursoConstantes::LEN_IDRECURSO
    $ok = $this->validarTamanhoCampo($dto->idrecurso, PlanoRecursoConstantes::LEN_IDRECURSO, PlanoRecursoConstantes::DESC_IDRECURSO);
    if($ok->msgcode != ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO){
        return $ok;
    }

    // Efetua validações no campo $dto->status com tamanho PlanoRecursoConstantes::LEN_STATUS
    $ok = $this->validarTamanhoCampo($dto->status, PlanoRecursoConstantes::LEN_STATUS, PlanoRecursoConstantes::DESC_STATUS);
    if($ok->msgcode != ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO){
        return $ok;
    }

    // Efetua validações no campo $dto->dataCadastro com tamanho PlanoRecursoConstantes::LEN_DATACADASTRO
    $ok = $this->validarTamanhoCampo($dto->dataCadastro, PlanoRecursoConstantes::LEN_DATACADASTRO, PlanoRecursoConstantes::DESC_DATACADASTRO);
    if($ok->msgcode != ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO){
        return $ok;
    }

    // Efetua validações no campo $dto->dataAtualizacao com tamanho PlanoRecursoConstantes::LEN_DATAATUALIZACAO
    $ok = $this->validarTamanhoCampo($dto->dataAtualizacao, PlanoRecursoConstantes::LEN_DATAATUALIZACAO, PlanoRecursoConstantes::DESC_DATAATUALIZACAO);
    if($ok->msgcode != ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO){
        return $ok;
    }


    $dto->status = ConstantesVariavel::STATUS_ATIVO;
    $dao = $daofactory->getPlanoRecursoDAO($daofactory);

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
* listarPlanoRecursoPorStatus() - Usado para invocar a interface de acesso aos dados (DAO) PlanoRecursoDAO de forma geral
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

    public function listarPlanoRecursoPorStatus($daofactory, $status,  $pag=1, $qtde=0, $coluna=1, $ordem=0)
    {   
        $retorno = new DTOPaginacao();
        $retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
        $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);

        $dao = $daofactory->getPlanoRecursoDAO($daofactory);
        $retorno->pagina = $pag;
        $retorno->itensPorPagina = ($qtde == 0 
        ? (int) VariavelCache::getInstance()->getVariavel(ConstantesVariavel::MAXIMO_LINHAS_POR_PAGINA_DEFAULT)
        : $qtde);
        $retorno->totalPaginas = ceil($dao->countPlanoRecursoPorStatus($status) / $retorno->itensPorPagina);

        if($pag > $retorno->totalPaginas) {
            $retorno->msgcode = ConstantesMensagem::NAO_EXISTEM_MAIS_PAGINAS_APRESENTAR;
            $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);
            return $retorno;
        }
        $retorno->lst = $dao->listPlanoRecursoPorStatus($status, $pag, $retorno->itensPorPagina, $coluna, $ordem);

        return $retorno;
    }






/**
*
* atualizarIdplanoPorPK() - Usado para invocar a classe de negócio PlanoRecursoBusinessImpl de forma geral
* realizar uma atualização de ID do plano diretamente na tabela PLANO_RECURSO campo PLAN_ID
* @param $daofactory
* @param $id
* @param $idplano
* @return PlanoRecursoDTO
*
* 
*/
    public function atualizarIdplanoPorPK($daofactory,$idplano,$id)
    {
        $dao = $daofactory->getPlanoRecursoDAO($daofactory);

        // resposta padrão
        $retorno = new DTOPadrao();

        if($dao->updateIdplano($id, $idplano)){   
            $retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
        }       

        // Obtem o texto da mensagem em razão do código de retorno
        $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);

        return $retorno;
    }

/**
*
* atualizarIdrecursoPorPK() - Usado para invocar a classe de negócio PlanoRecursoBusinessImpl de forma geral
* realizar uma atualização de ID recurso diretamente na tabela PLANO_RECURSO campo RECU_ID
* @param $daofactory
* @param $id
* @param $idrecurso
* @return PlanoRecursoDTO
*
* 
*/
    public function atualizarIdrecursoPorPK($daofactory,$idrecurso,$id)
    {
        $dao = $daofactory->getPlanoRecursoDAO($daofactory);

        // resposta padrão
        $retorno = new DTOPadrao();

        if($dao->updateIdrecurso($id, $idrecurso)){   
            $retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
        }       

        // Obtem o texto da mensagem em razão do código de retorno
        $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);

        return $retorno;
    }

/**
*
* pesquisarPorIdplano() - Usado para invocar a classe de negócio PlanoRecursoBusinessImpl de forma geral
* realizar uma busca de ID do plano diretamente na tabela PLANO_RECURSO campo PLAN_ID
*
* @param $idplano
* @return PlanoRecursoDTO
*
* 
*/
    public function pesquisarPorIdplano($daofactory,$idplano)
    { 
        $dao = $daofactory->getPlanoRecursoDAO($daofactory);
        return $dao->loadIdplano($idplano);
    }

/**
*
* pesquisarPorIdrecurso() - Usado para invocar a classe de negócio PlanoRecursoBusinessImpl de forma geral
* realizar uma busca de ID recurso diretamente na tabela PLANO_RECURSO campo RECU_ID
*
* @param $idrecurso
* @return PlanoRecursoDTO
*
* 
*/
    public function pesquisarPorIdrecurso($daofactory,$idrecurso)

    { 
        $dao = $daofactory->getPlanoRecursoDAO($daofactory);
        return $dao->loadIdrecurso($idrecurso);
    }

/**
*
* listarPlanoRecursoUsuaIdPorStatus() - Usado para invocar a interface de acesso aos dados (DAO) PlanoRecursoDAO de forma geral
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

    public function listarPlanoRecursoPorUsuaIdStatus($daofactory, $usuaid, $status,  $pag=1, $qtde=0, $coluna=1, $ordem=0)
    {   
        $retorno = new DTOPaginacao();
        $retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
        $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);

        $dao = $daofactory->getPlanoRecursoDAO($daofactory);
        $retorno->pagina = $pag;
        $retorno->itensPorPagina = ($qtde == 0 
        ? (int) VariavelCache::getInstance()->getVariavel(ConstantesVariavel::MAXIMO_LINHAS_POR_PAGINA_DEFAULT)
        : $qtde);
        $retorno->totalPaginas = ceil($dao->countPlanoRecursoPorUsuaIdStatus($usuaid, $status) / $retorno->itensPorPagina);

        if($pag > $retorno->totalPaginas) {
            $retorno->msgcode = ConstantesMensagem::NAO_EXISTEM_MAIS_PAGINAS_APRESENTAR;
            $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);
            return $retorno;
        }
        $retorno->lst = $dao->listPlanoRecursoPorUsuaIdStatus($usuaid, $status, $pag, $retorno->itensPorPagina, $coluna, $ordem);

        return $retorno;
    }

/**
*
* listarPlanoRecursoPorIdplanoStatus() - Usado para invocar a interface de acesso aos dados (DAO) PlanoRecursoDAO de forma geral
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

    public function listarPlanoRecursoPorIdplanoStatus($daofactory, $idplano, $status,  $pag=1, $qtde=0, $coluna=1, $ordem=0)
    {  
        $retorno = new DTOPaginacao();
        $retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
        $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);

        $dao = $daofactory->getPlanoRecursoDAO($daofactory);
        $retorno->pagina = $pag;
        $retorno->itensPorPagina = ($qtde == 0 
        ? (int) VariavelCache::getInstance()->getVariavel(ConstantesVariavel::MAXIMO_LINHAS_POR_PAGINA_DEFAULT)
        : $qtde);
        $retorno->totalPaginas = ceil($dao->countPlanoRecursoPorIdplanoStatus($idplano, $status) / $retorno->itensPorPagina);

        if($pag > $retorno->totalPaginas) {
            $retorno->msgcode = ConstantesMensagem::NAO_EXISTEM_MAIS_PAGINAS_APRESENTAR;
            $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);
            return $retorno;
        }
        $retorno->lst = $dao->listPlanoRecursoPorIdplanoStatus($idplano, $status, $pag, $retorno->itensPorPagina, $coluna, $ordem);
        return $retorno;
    }

/**
* validarTamanhoCampo()
*
* Validador de tamanho de campos PlanoRecursoDTO
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
