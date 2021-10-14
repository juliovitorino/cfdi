<?php 

// importar dependencias
require_once 'CampanhaTopDezBusiness.php';

require_once '../dto/DTOPadrao.php';
require_once '../dto/DTOPaginacao.php';

require_once '../variavel/ConstantesVariavel.php';
require_once '../variavel/VariavelCache.php';

/**
*
* CampanhaTopDezBusinessImpl - Classe de implementação dos métodos de negócio para a interface CampanhaTopDezBusiness
* Camada de negócio CampanhaTopDez - camada responsável pela lógica de negócios de CampanhaTopDez do sistema. 
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
* @since 19/09/2019 08:36:54
*
*/


class CampanhaTopDezBusinessImpl implements CampanhaTopDezBusiness
{
    
    function __construct()  {   }

/**
* carregar() - Carrega apenas um registro com base no campo id = (CAMPANHA_TOPDEZ::CATO_ID)
* @param $daofactory
* @param $dto
* @return $dto
*/ 
    public function carregar($daofactory, $dto) {   }

/**
* listarTudo() - Lista todos os registros provenientes de CAMPANHA_TOPDEZ sem critério de paginação
* @param $daofactory
* @return List<CampanhaTopDezDTO>[]
*/ 
    public function listarTudo($daofactory) {   }

/**
* incParticipacaoCampanha() - Incrementar a participação do usuário na campanha top dez
* @param $daofactory
* @param $usuaid
* @param $camp_id
* @return $dto
*/ 
    public function incParticipacaoCampanha($daofactory, $usuaid, $camp_id)
    {
        // Busca o registro atual do Top Dez pra realizar a inserção (se precisar) e atualização
        $catodto = $this->PesquisarMaxPKAtivoCampIdUsuaIdPorStatus($daofactory, $usuaid, $camp_id, ConstantesVariavel::STATUS_ATIVO);

        // Se não existir ainda o controlador por campanha, cria um novo
        if($catodto == NULL || $catodto->id == NULL){
            $dtotd = new CampanhaTopDezDTO();
            $dtotd->id_campanha = $camp_id;
            $dtotd->id_usuario = $usuaid;

            // Cadastra o registro populado no DTO e repesquisa
            $retdtotd = $this->inserir($daofactory, $dtotd);
            $catodto = $this->PesquisarMaxPKAtivoCampIdUsuaIdPorStatus($daofactory, $usuaid, $camp_id, ConstantesVariavel::STATUS_ATIVO);
        }

        $dao = $daofactory->getCampanhaTopDezDAO($daofactory);
        return $dao->updateIncQtdeParticipacao($catodto->id);

        
    }

/**
* PesquisarMaxPKAtivoId_CampanhaPorStatus() - Carrega apenas um registro com base no id_campanha  e status para buscar a MAIOR PK
* @param $daofactory
* @param $status
* @return CampanhaTopDezDTO
*/ 
    public function PesquisarMaxPKAtivoId_CampanhaPorStatus($daofactory, $id_campanha,$status)
    { 
        $dao = $daofactory->getCampanhaTopDezDAO($daofactory);
        $maxid = $dao->loadMaxId_CampanhaPK($id_campanha,$status);
        return $this->carregarPorID($daofactory, $maxid);
    }

/**
* PesquisarMaxPKAtivoCampIdUsuaIdPorStatus() - Carrega apenas um registro.
* @param $daofactory
* @param $usuaid
* @param $camp_id
* @return CampanhaTopDezDTO
*/ 
public function PesquisarMaxPKAtivoCampIdUsuaIdPorStatus($daofactory, $usuaid, $camp_id, $status)
{ 
    $dao = $daofactory->getCampanhaTopDezDAO($daofactory);
    $maxid = $dao->loadMaxPKAtivoCampIdUsuaIdPorStatus($usuaid, $camp_id,$status);
    return $this->carregarPorID($daofactory, $maxid);
}


/**
* atualizar() - atualiza apenas um registro com base no dto CampanhaTopDezDTO->id
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


        $dao = $daofactory->getCampanhaTopDezDAO($daofactory);
        if(!$dao->update($dto)){
           $retorno->msgcode = ConstantesMensagem::ERRO_CRUD_ATUALIZAR_REGISTRO;
           $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);
    
        }
        // retorna situação
        return $retorno;

    }

/**
* deletar() - excluir fisicamente um registro com base no dto CampanhaTopDezDTO->id
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
        $dao = $daofactory->getCampanhaTopDezDAO($daofactory);

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
* @return List<CampanhaTopDezDTO>[]
* @deprecated
*/ 

    public function listarPagina($daofactory, $pag, $qtde)  
    {   
        $dao = $daofactory->getCampanhaTopDezDAO($daofactory);
        return $dao->listPagina($pag, $qtde);
    }

/**
* carregarPorID() - Carrega APENAS um registro usando a id como item de busca
* na tabela CAMPANHA_TOPDEZ usando a Primary Key CATO_ID
*
* @param $daofactory
* @param $id
* @param $qtde
*
* @return CampanhaTopDezDTO
*/ 
    public function carregarPorID($daofactory, $id)
    { 
        $dao = $daofactory->getCampanhaTopDezDAO($daofactory);
        return $dao->loadPK($id);
    }

/**
* atualizarStatus() - atualizar o campo de STATUS utilizando a id como item de busca
* na tabela CAMPANHA_TOPDEZ usando a Primary Key CATO_ID
*
* @param $daofactory
* @param $id
* @param $status
*
* @return CampanhaTopDezDTO
*/ 
    public function atualizarStatus($daofactory, $id, $status)
    {
        $dao = $daofactory->getCampanhaTopDezDAO($daofactory);

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
* inserir() - inserir um registro com base no CampanhaTopDezDTO. Alguns atributos dentro do DTO
* serão ignorados caso estejam populados.
*
* Atributos da classe CampanhaTopDezDTO sumariamente IGNORADOS por este método MESMO que estejam preenchidos:
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

    // Efetua validações no campo $dto->id com tamanho 11
    $ok = $this->validarTamanhoCampo($dto->id, 11, 'ID Campanha Top Dez');
    if($ok->msgcode != ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO){
        return $ok;
    }

    // Efetua validações no campo $dto->id_campanha com tamanho 11
    $ok = $this->validarTamanhoCampo($dto->id_campanha, 11, 'ID da campanha');
    if($ok->msgcode != ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO){
        return $ok;
    }

    // Efetua validações no campo $dto->id_usuario com tamanho 11
    $ok = $this->validarTamanhoCampo($dto->id_usuario, 11, 'ID do usuário');
    if($ok->msgcode != ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO){
        return $ok;
    }

    // Efetua validações no campo $dto->qtde com tamanho 6
    $ok = $this->validarTamanhoCampo($dto->qtde, 6, 'Qtde participação');
    if($ok->msgcode != ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO){
        return $ok;
    }


    $dto->status = ConstantesVariavel::STATUS_ATIVO;
    $dao = $daofactory->getCampanhaTopDezDAO($daofactory);

    if (!$dao->insert($dto)) {
        $retorno = new DTOPadrao();
        $retorno->msgcode = ConstantesMensagem::ERRO_CRUD_INSERIR_REGISTRO;
        $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);
    }

    return $retorno;
}

/**
*
* listarCampanhaTopDezPorStatus() - Usado para invocar a interface de acesso aos dados (DAO) CampanhaTopDezDAO de forma geral
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

    public function listarCampanhaTopDezPorStatus($daofactory, $status, $pag, $qtde, $coluna, $ordem)
    {   
        $retorno = new DTOPaginacao();
        $retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
        $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);

        $dao = $daofactory->getCampanhaTopDezDAO($daofactory);
        $retorno->pagina = $pag;
        $retorno->itensPorPagina = ($qtde == 0 
        ? (int) VariavelCache::getInstance()->getVariavel(ConstantesVariavel::MAXIMO_LINHAS_POR_PAGINA_DEFAULT)
        : $qtde);
        $retorno->totalPaginas = ceil($dao->countCampanhaTopDezPorStatus($status) / $retorno->itensPorPagina);

        if($pag > $retorno->totalPaginas) {
            $retorno->msgcode = ConstantesMensagem::NAO_EXISTEM_MAIS_PAGINAS_APRESENTAR;
            $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);
            return $retorno;
        }
        $retorno->lst = $dao->listCampanhaTopDezPorStatus($status, $pag, $retorno->itensPorPagina, $coluna, $ordem);

        return $retorno;
    }

/**
*
* atualizarId_CampanhaPorPK() - Usado para invocar a classe de negócio CampanhaTopDezBusinessImpl de forma geral
* realizar uma atualização de ID da campanha diretamente na tabela CAMPANHA_TOPDEZ campo CAMP_ID
* @param $daofactory
* @param $id
* @param $id_campanha
* @return CampanhaTopDezDTO
*
* 
*/
    public function atualizarId_CampanhaPorPK($daofactory,$id_campanha,$id)
    {
        $dao = $daofactory->getCampanhaTopDezDAO($daofactory);

        // resposta padrão
        $retorno = new DTOPadrao();

        if($dao->updateId_Campanha($id, $id_campanha)){   
            $retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
        }       

        // Obtem o texto da mensagem em razão do código de retorno
        $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);

        return $retorno;
    }

/**
*
* atualizarId_UsuarioPorPK() - Usado para invocar a classe de negócio CampanhaTopDezBusinessImpl de forma geral
* realizar uma atualização de ID do usuário diretamente na tabela CAMPANHA_TOPDEZ campo USUA_ID
* @param $daofactory
* @param $id
* @param $id_usuario
* @return CampanhaTopDezDTO
*
* 
*/
    public function atualizarId_UsuarioPorPK($daofactory,$id_usuario,$id)
    {
        $dao = $daofactory->getCampanhaTopDezDAO($daofactory);

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
* atualizarQtdePorPK() - Usado para invocar a classe de negócio CampanhaTopDezBusinessImpl de forma geral
* realizar uma atualização de Qtde participação diretamente na tabela CAMPANHA_TOPDEZ campo CATO_QT_PARTICIPACAO
* @param $daofactory
* @param $id
* @param $qtde
* @return CampanhaTopDezDTO
*
* 
*/
    public function atualizarQtdePorPK($daofactory,$qtde,$id)
    {
        $dao = $daofactory->getCampanhaTopDezDAO($daofactory);

        // resposta padrão
        $retorno = new DTOPadrao();

        if($dao->updateQtde($id, $qtde)){   
            $retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
        }       

        // Obtem o texto da mensagem em razão do código de retorno
        $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);

        return $retorno;
    }


/**
*
* pesquisarPorId_Campanha() - Usado para invocar a classe de negócio CampanhaTopDezBusinessImpl de forma geral
* realizar uma busca de ID da campanha diretamente na tabela CAMPANHA_TOPDEZ campo CAMP_ID
*
* @param $id_campanha
* @return CampanhaTopDezDTO
*
* 
*/
    public function pesquisarPorId_Campanha($daofactory,$id_campanha)
    { 
        $dao = $daofactory->getCampanhaTopDezDAO($daofactory);
        return $dao->loadId_Campanha($id_campanha);
    }

/**
*
* pesquisarPorId_Usuario() - Usado para invocar a classe de negócio CampanhaTopDezBusinessImpl de forma geral
* realizar uma busca de ID do usuário diretamente na tabela CAMPANHA_TOPDEZ campo USUA_ID
*
* @param $id_usuario
* @return CampanhaTopDezDTO
*
* 
*/
    public function pesquisarPorId_Usuario($daofactory,$id_usuario)

    { 
        $dao = $daofactory->getCampanhaTopDezDAO($daofactory);
        return $dao->loadId_Usuario($id_usuario);
    }

/**
*
* pesquisarPorQtde() - Usado para invocar a classe de negócio CampanhaTopDezBusinessImpl de forma geral
* realizar uma busca de Qtde participação diretamente na tabela CAMPANHA_TOPDEZ campo CATO_QT_PARTICIPACAO
*
* @param $qtde
* @return CampanhaTopDezDTO
*
* 
*/
    public function pesquisarPorQtde($daofactory,$qtde)

    { 
        $dao = $daofactory->getCampanhaTopDezDAO($daofactory);
        return $dao->loadQtde($qtde);
    }

/**
*
* listarCampanhaTopDezUsuaIdPorStatus() - Usado para invocar a interface de acesso aos dados (DAO) CampanhaTopDezDAO de forma geral
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

    public function listarCampanhaTopDezPorUsuaIdStatus($daofactory, $usuaid, $status, $pag, $qtde, $coluna, $ordem)
    {   
        $retorno = new DTOPaginacao();
        $retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
        $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);

        $dao = $daofactory->getCampanhaTopDezDAO($daofactory);
        $retorno->pagina = $pag;
        $retorno->itensPorPagina = ($qtde == 0 
        ? (int) VariavelCache::getInstance()->getVariavel(ConstantesVariavel::MAXIMO_LINHAS_POR_PAGINA_DEFAULT)
        : $qtde);
        $retorno->totalPaginas = ceil($dao->countCampanhaTopDezPorUsuaIdStatus($usuaid, $status) / $retorno->itensPorPagina);

        if($pag > $retorno->totalPaginas) {
            $retorno->msgcode = ConstantesMensagem::NAO_EXISTEM_MAIS_PAGINAS_APRESENTAR;
            $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);
            return $retorno;
        }
        $retorno->lst = $dao->listCampanhaTopDezPorUsuaIdStatus($usuaid, $status, $pag, $retorno->itensPorPagina, $coluna, $ordem);

        return $retorno;
    }

/**
* validarTamanhoCampo()
*
* Validador de tamanho de campos CampanhaTopDezDTO
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
