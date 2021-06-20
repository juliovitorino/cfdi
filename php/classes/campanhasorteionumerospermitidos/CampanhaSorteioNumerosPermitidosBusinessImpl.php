<?php 

// importar dependencias
require_once 'CampanhaSorteioNumerosPermitidosBusiness.php';
require_once 'CampanhaSorteioNumerosPermitidosConstantes.php';
require_once '../dto/DTOPadrao.php';
require_once '../dto/DTOPaginacao.php';

require_once '../variavel/ConstantesVariavel.php';
require_once '../variavel/VariavelCache.php';
require_once '../campanhasorteio/CampanhaSorteioHelper.php';
require_once '../campanha/CampanhaHelper.php';

/**
*
* CampanhaSorteioNumerosPermitidosBusinessImpl - Classe de implementação dos métodos de negócio para a interface CampanhaSorteioNumerosPermitidosBusiness
* Camada de negócio CampanhaSorteioNumerosPermitidos - camada responsável pela lógica de negócios de CampanhaSorteioNumerosPermitidos do sistema. 
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
* @since 17/06/2021 17:44:16
*
*/


class CampanhaSorteioNumerosPermitidosBusinessImpl implements CampanhaSorteioNumerosPermitidosBusiness
{
    
    function __construct()  {   }

/**
* carregar() - Carrega apenas um registro com base no campo id = (CAMPANHA_SORTEIO_NUMEROS_PERMITIDOS::CSNP_ID)
* @param $daofactory
* @param $dto
* @return $dto
*/ 
    public function carregar($daofactory, $dto) {   }

/**
* listarTudo() - Lista todos os registros provenientes de CAMPANHA_SORTEIO_NUMEROS_PERMITIDOS sem critério de paginação
* @param $daofactory
* @return List<CampanhaSorteioNumerosPermitidosDTO>[]
*/ 
    public function listarTudo($daofactory) {   }

/**
* pesquisarMaxPKAtivoId_CasoPorStatus() - Carrega apenas um registro com base no id_caso  e status para buscar a MAIOR PK
* @param $daofactory
* @param $status
* @return CampanhaSorteioNumerosPermitidosDTO
*/ 
    public function pesquisarMaxPKAtivoId_CasoPorStatus($daofactory, $id_caso,$status)
    { 
        $dao = $daofactory->getCampanhaSorteioNumerosPermitidosDAO($daofactory);
        $maxid = $dao->loadMaxId_CasoPK($id_caso,$status);
        return $this->carregarPorID($daofactory, $maxid);
    }

/**
* atualizar() - atualiza apenas um registro com base no dto CampanhaSorteioNumerosPermitidosDTO->id
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


        $dao = $daofactory->getCampanhaSorteioNumerosPermitidosDAO($daofactory);
        if(!$dao->update($dto)){
           $retorno->msgcode = ConstantesMensagem::ERRO_CRUD_ATUALIZAR_REGISTRO;
           $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);
    
        }
        // retorna situação
        return $retorno;

    }

/**
* deletar() - excluir fisicamente um registro com base no dto CampanhaSorteioNumerosPermitidosDTO->id
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
        $dao = $daofactory->getCampanhaSorteioNumerosPermitidosDAO($daofactory);

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
* @return List<CampanhaSorteioNumerosPermitidosDTO>[]
* @deprecated
*/ 

    public function listarPagina($daofactory, $pag, $qtde)  
    {   
        $dao = $daofactory->getCampanhaSorteioNumerosPermitidosDAO($daofactory);
        return $dao->listPagina($pag, $qtde);
    }

/**
* carregarPorID() - Carrega APENAS um registro usando a id como item de busca
* na tabela CAMPANHA_SORTEIO_NUMEROS_PERMITIDOS usando a Primary Key CSNP_ID
*
* @param $daofactory
* @param $id
* @param $qtde
*
* @return CampanhaSorteioNumerosPermitidosDTO
*/ 
    public function carregarPorID($daofactory, $id)
    { 
        $dao = $daofactory->getCampanhaSorteioNumerosPermitidosDAO($daofactory);
        return $dao->loadPK($id);
    }

/**
* atualizarStatus() - atualizar o campo de STATUS utilizando a id como item de busca
* na tabela CAMPANHA_SORTEIO_NUMEROS_PERMITIDOS usando a Primary Key CSNP_ID
*
* @param $daofactory
* @param $id
* @param $status
*
* @return CampanhaSorteioNumerosPermitidosDTO
*/ 
    public function atualizarStatus($daofactory, $id, $status)
    {
        $dao = $daofactory->getCampanhaSorteioNumerosPermitidosDAO($daofactory);

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
 *  atualizarStatus()
 *  @param $daofactory
 *  @param $id
 *  @param $status
 * 
 */
public function criarNumerosTicketSorteioAleatorios($daofactory, $dto)
{
    $retorno = new DTOPadrao();
    $retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
    $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);

    //-------------------------------
    // validações de regra de negocio
    //-------------------------------

    // Obtem dados da CASO e CAMP
    $casodto = CampanhaSorteioHelper::getCampanhaSorteioBusiness($daofactory, $dto->id_caso);

    if(is_null($casodto)){
        $retorno->msgcode = ConstantesMensagem::CAMPANHA_SORTEIO_INEXISTENTE;
        $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);
        return $retorno;    
    }

    if($casodto->status == ConstantesVariavel::STATUS_PENDENTE) {
        $retorno->msgcode = ConstantesMensagem::CAMPANHA_SORTEIO_PRECISA_SER_ATIVADA;
        $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);
        return $retorno;    
    }

    if($casodto->status == ConstantesVariavel::STATUS_PRONTO_USAR) {
        $retorno->msgcode = ConstantesMensagem::CAMPANHA_SORTEIO_ESTA_PRONTA_PRA_USAR;
        $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);
        return $retorno;    
    }

    if($casodto->status == ConstantesVariavel::STATUS_FINALIZADO) {
        $retorno->msgcode = ConstantesMensagem::CAMPANHA_SORTEIO_ESTA_FINALIZADA;
        $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);
        return $retorno;    
    }

    if($casodto->status != ConstantesVariavel::STATUS_TRABALHANDO) {
        $retorno->msgcode = ConstantesMensagem::CAMPANHA_PRECISA_ESTAR_COM_STATUS_TRABALHANDO;
        $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);
        return $retorno;    
    }

    // Busca o item mais recente da fila CSFC para inserir na CSNP
    $csfcbo = new CampanhaSorteioFilaCriacaoBusinessImpl();
    $csfcdto = $csfcbo->pesquisarMaxPKAtivoId_CasoPorStatus($daofactory, $casodto->id, ConstantesVariavel::STATUS_PENDENTE);

    if(! is_null($csfcdto))
    {

        $csnpbo = new CampanhaSorteioNumerosPermitidosBusinessImpl();

        for($i = 0; $i < $csfcdto->qtLoteTicketCriar; $i++)
        {
            // Antes de inserir verifica se o número é REPETIDO na CSNP
            $isRepetido = true;
            do {
                $nrTicketSorteio = (int) Util::getCodigoNumerico(5);
                $dtocheck = $this->pesquisarPorCasoIdNrTicketStatus($daofactory, $casodto->id, $nrTicketSorteio, ConstantesVariavel::STATUS_ATIVO);
                if(is_null($dtocheck)) {
                    $isRepetido = false;
                }
            } while($isRepetido);


            $dtoins = new CampanhaSorteioNumerosPermitidosDTO();
            $dtoins->id_caso = $casodto->id;
            $dtoins->nrTicketSorteio = $nrTicketSorteio;
    //var_dump($dtoins);        
            $dtoins = $this->inserir($daofactory, $dtoins );
        }
    
        // Muda status da Fila para Concluido/Finalizado 
        $csfcbo->atualizarStatus($daofactory, $csfcdto->id, ConstantesVariavel::STATUS_FINALIZADO );


        // Envia uma notificação ao ADMIN se chave estiver ligada
        if (VariavelCache::getInstance()->getVariavel(ConstantesVariavel::CHAVE_NOTIFICACAO_ADMIN_NOVO_USUARIO) == ConstantesVariavel::ATIVADO){
            $usuaid_admin = (int) VariavelCache::getInstance()->getVariavel(ConstantesVariavel::NOTIFICACAO_ADMIN_USUA_ID);
            $msg =  MensagemCache::getInstance()->getMensagemParametrizada(ConstantesMensagem::GERACAO_NUMEROS_TICKETS_SORTEIO, [
                ConstantesVariavel::P1 => $casodto->id,
                ConstantesVariavel::P2 => $casodto->nome,
                ConstantesVariavel::P3 => $casodto->statusdesc,
                ConstantesVariavel::P4 => $csfcdto->qtLoteTicketCriar,
            ]);

            UsuarioNotificacaoHelper::criarUsuarioNotificacaoPorBusiness($daofactory, $usuaid_admin, $msg, "notify-03.png");
        }

    } else {

        // Muda status da campanha sorteio para Concluido/Finalizado 
        $casobo = new CampanhaSorteioBusinessImpl();
        $casobo->atualizarStatus($daofactory, $casodto->id, ConstantesVariavel::STATUS_PRONTO_USAR );

        $retorno->msgcode = ConstantesMensagem::NAO_EXISTEM_MAIS_TICKETS_PARA_GERAR;
        $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);

        // Envia uma notificação ao ADMIN se chave estiver ligada
        if (VariavelCache::getInstance()->getVariavel(ConstantesVariavel::CHAVE_NOTIFICACAO_ADMIN_NOVO_USUARIO) == ConstantesVariavel::ATIVADO){
            $usuaid_admin = (int) VariavelCache::getInstance()->getVariavel(ConstantesVariavel::NOTIFICACAO_ADMIN_USUA_ID);
            $msg =  MensagemCache::getInstance()->getMensagemParametrizada(ConstantesMensagem::GERACAO_NUMEROS_TICKETS_SORTEIO_FINALIZADA, [
                ConstantesVariavel::P1 => $casodto->id,
                ConstantesVariavel::P2 => $casodto->nome,
                ConstantesVariavel::P3 => $casodto->statusdesc,
                ConstantesVariavel::P4 => $casodto->maxTickets,
            ]);

            UsuarioNotificacaoHelper::criarUsuarioNotificacaoPorBusiness($daofactory, $usuaid_admin, $msg, "notify-03.png");
        }

    }
    
    return $retorno;

}
/**
* inserir() - inserir um registro com base no CampanhaSorteioNumerosPermitidosDTO. Alguns atributos dentro do DTO
* serão ignorados caso estejam populados.
*
* Atributos da classe CampanhaSorteioNumerosPermitidosDTO sumariamente IGNORADOS por este método MESMO que estejam preenchidos:
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

    // Efetua validações no campo $dto->id com tamanho CampanhaSorteioNumerosPermitidosConstantes::LEN_ID
    $ok = $this->validarTamanhoCampo($dto->id, CampanhaSorteioNumerosPermitidosConstantes::LEN_ID, CampanhaSorteioNumerosPermitidosConstantes::DESC_ID);
    if($ok->msgcode != ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO){
        return $ok;
    }

    // Efetua validações no campo $dto->id_caso com tamanho CampanhaSorteioNumerosPermitidosConstantes::LEN_ID_CASO
    $ok = $this->validarTamanhoCampo($dto->id_caso, CampanhaSorteioNumerosPermitidosConstantes::LEN_ID_CASO, CampanhaSorteioNumerosPermitidosConstantes::DESC_ID_CASO);
    if($ok->msgcode != ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO){
        return $ok;
    }

    // Efetua validações no campo $dto->nrTicketSorteio com tamanho CampanhaSorteioNumerosPermitidosConstantes::LEN_NRTICKETSORTEIO
    $ok = $this->validarTamanhoCampo($dto->nrTicketSorteio, CampanhaSorteioNumerosPermitidosConstantes::LEN_NRTICKETSORTEIO, CampanhaSorteioNumerosPermitidosConstantes::DESC_NRTICKETSORTEIO);
    if($ok->msgcode != ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO){
        return $ok;
    }


    // Efetua validações no campo $dto->status com tamanho CampanhaSorteioNumerosPermitidosConstantes::LEN_STATUS
    $ok = $this->validarTamanhoCampo($dto->status, CampanhaSorteioNumerosPermitidosConstantes::LEN_STATUS, CampanhaSorteioNumerosPermitidosConstantes::DESC_STATUS);
    if($ok->msgcode != ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO){
        return $ok;
    }

    // Efetua validações no campo $dto->dataCadastro com tamanho CampanhaSorteioNumerosPermitidosConstantes::LEN_DATACADASTRO
    $ok = $this->validarTamanhoCampo($dto->dataCadastro, CampanhaSorteioNumerosPermitidosConstantes::LEN_DATACADASTRO, CampanhaSorteioNumerosPermitidosConstantes::DESC_DATACADASTRO);
    if($ok->msgcode != ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO){
        return $ok;
    }

    // Efetua validações no campo $dto->dataAtualizacao com tamanho CampanhaSorteioNumerosPermitidosConstantes::LEN_DATAATUALIZACAO
    $ok = $this->validarTamanhoCampo($dto->dataAtualizacao, CampanhaSorteioNumerosPermitidosConstantes::LEN_DATAATUALIZACAO, CampanhaSorteioNumerosPermitidosConstantes::DESC_DATAATUALIZACAO);
    if($ok->msgcode != ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO){
        return $ok;
    }


    $dto->status = ConstantesVariavel::STATUS_ATIVO;
    $dao = $daofactory->getCampanhaSorteioNumerosPermitidosDAO($daofactory);

    if (!$dao->insert($dto)) {
        $retorno = new DTOPadrao();
        $retorno->msgcode = ConstantesMensagem::ERRO_CRUD_INSERIR_REGISTRO;
        $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);
    }

    return $retorno;
}

/**
*
* listarCampanhaSorteioNumerosPermitidosPorStatus() - Usado para invocar a interface de acesso aos dados (DAO) CampanhaSorteioNumerosPermitidosDAO de forma geral
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

    public function listarCampanhaSorteioNumerosPermitidosPorStatus($daofactory, $status, $pag, $qtde, $coluna, $ordem)
    {   
        $retorno = new DTOPaginacao();
        $retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
        $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);

        $dao = $daofactory->getCampanhaSorteioNumerosPermitidosDAO($daofactory);
        $retorno->pagina = $pag;
        $retorno->itensPorPagina = ($qtde == 0 
        ? (int) VariavelCache::getInstance()->getVariavel(ConstantesVariavel::MAXIMO_LINHAS_POR_PAGINA_DEFAULT)
        : $qtde);
        $retorno->totalPaginas = ceil($dao->countCampanhaSorteioNumerosPermitidosPorStatus($status) / $retorno->itensPorPagina);

        if($pag > $retorno->totalPaginas) {
            $retorno->msgcode = ConstantesMensagem::NAO_EXISTEM_MAIS_PAGINAS_APRESENTAR;
            $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);
            return $retorno;
        }
        $retorno->lst = $dao->listCampanhaSorteioNumerosPermitidosPorStatus($status, $pag, $qtde, $coluna, $ordem);

        return $retorno;
    }






/**
*
* atualizarId_CasoPorPK() - Usado para invocar a classe de negócio CampanhaSorteioNumerosPermitidosBusinessImpl de forma geral
* realizar uma atualização de ID da campanha sorteio diretamente na tabela CAMPANHA_SORTEIO_NUMEROS_PERMITIDOS campo CASO_ID
* @param $daofactory
* @param $id
* @param $id_caso
* @return CampanhaSorteioNumerosPermitidosDTO
*
* 
*/
    public function atualizarId_CasoPorPK($daofactory,$id_caso,$id)
    {
        $dao = $daofactory->getCampanhaSorteioNumerosPermitidosDAO($daofactory);

        // resposta padrão
        $retorno = new DTOPadrao();

        if($dao->updateId_Caso($id, $id_caso)){   
            $retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
        }       

        // Obtem o texto da mensagem em razão do código de retorno
        $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);

        return $retorno;
    }

/**
*
* atualizarNrticketsorteioPorPK() - Usado para invocar a classe de negócio CampanhaSorteioNumerosPermitidosBusinessImpl de forma geral
* realizar uma atualização de Número ticket de sorteio diretamente na tabela CAMPANHA_SORTEIO_NUMEROS_PERMITIDOS campo CSNP_NU_SORTEIO
* @param $daofactory
* @param $id
* @param $nrTicketSorteio
* @return CampanhaSorteioNumerosPermitidosDTO
*
* 
*/
    public function atualizarNrticketsorteioPorPK($daofactory,$nrTicketSorteio,$id)
    {
        $dao = $daofactory->getCampanhaSorteioNumerosPermitidosDAO($daofactory);

        // resposta padrão
        $retorno = new DTOPadrao();

        if($dao->updateNrticketsorteio($id, $nrTicketSorteio)){   
            $retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
        }       

        // Obtem o texto da mensagem em razão do código de retorno
        $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);

        return $retorno;
    }
/**
*
* pesquisarPorCasoIdNrTicketStatus() - Usado para invocar a classe de negócio CampanhaSorteioNumerosPermitidosBusinessImpl de forma geral
* realizar uma busca de ID da campanha sorteio diretamente na tabela CAMPANHA_SORTEIO_NUMEROS_PERMITIDOS campo CASO_ID
*
* @param $daofactory
* @param $id_caso
* @param $nrticket
* @param $status
* @return CampanhaSorteioNumerosPermitidosDTO
*
* 
*/

    public function pesquisarPorCasoIdNrTicketStatus($daofactory, $id_caso, $nrticket, $status)
    { 
        $dao = $daofactory->getCampanhaSorteioNumerosPermitidosDAO($daofactory);
        return $dao->loadPorCasoIdNrTicketStatus($id_caso, $nrticket, $status);
    }


/**
*
* pesquisarPorId_Caso() - Usado para invocar a classe de negócio CampanhaSorteioNumerosPermitidosBusinessImpl de forma geral
* realizar uma busca de ID da campanha sorteio diretamente na tabela CAMPANHA_SORTEIO_NUMEROS_PERMITIDOS campo CASO_ID
*
* @param $id_caso
* @return CampanhaSorteioNumerosPermitidosDTO
*
* 
*/
    public function pesquisarPorId_Caso($daofactory,$id_caso)
    { 
        $dao = $daofactory->getCampanhaSorteioNumerosPermitidosDAO($daofactory);
        return $dao->loadId_Caso($id_caso);
    }

/**
*
* pesquisarPorNrticketsorteio() - Usado para invocar a classe de negócio CampanhaSorteioNumerosPermitidosBusinessImpl de forma geral
* realizar uma busca de Número ticket de sorteio diretamente na tabela CAMPANHA_SORTEIO_NUMEROS_PERMITIDOS campo CSNP_NU_SORTEIO
*
* @param $nrTicketSorteio
* @return CampanhaSorteioNumerosPermitidosDTO
*
* 
*/
    public function pesquisarPorNrticketsorteio($daofactory,$nrTicketSorteio)

    { 
        $dao = $daofactory->getCampanhaSorteioNumerosPermitidosDAO($daofactory);
        return $dao->loadNrticketsorteio($nrTicketSorteio);
    }


/**
*
* listarCampanhaSorteioNumerosPermitidosUsuaIdPorStatus() - Usado para invocar a interface de acesso aos dados (DAO) CampanhaSorteioNumerosPermitidosDAO de forma geral
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

    public function listarCampanhaSorteioNumerosPermitidosPorUsuaIdStatus($daofactory, $usuaid, $status, $pag, $qtde, $coluna, $ordem)
    {   
        $retorno = new DTOPaginacao();
        $retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
        $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);

        $dao = $daofactory->getCampanhaSorteioNumerosPermitidosDAO($daofactory);
        $retorno->pagina = $pag;
        $retorno->itensPorPagina = ($qtde == 0 
        ? (int) VariavelCache::getInstance()->getVariavel(ConstantesVariavel::MAXIMO_LINHAS_POR_PAGINA_DEFAULT)
        : $qtde);
        $retorno->totalPaginas = ceil($dao->countCampanhaSorteioNumerosPermitidosPorUsuaIdStatus($usuaid, $status) / $retorno->itensPorPagina);

        if($pag > $retorno->totalPaginas) {
            $retorno->msgcode = ConstantesMensagem::NAO_EXISTEM_MAIS_PAGINAS_APRESENTAR;
            $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);
            return $retorno;
        }
        $retorno->lst = $dao->listCampanhaSorteioNumerosPermitidosPorUsuaIdStatus($usuaid, $status, $pag, $qtde, $coluna, $ordem);

        return $retorno;
    }

/**
* validarTamanhoCampo()
*
* Validador de tamanho de campos CampanhaSorteioNumerosPermitidosDTO
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
