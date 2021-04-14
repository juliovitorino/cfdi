<?php 

// importar dependencias
require_once 'CampanhaCashbackBusiness.php';
require_once '../campanha/CampanhaHelper.php';

require_once '../dto/DTOPadrao.php';
require_once '../dto/DTOPaginacao.php';

require_once '../variavel/ConstantesVariavel.php';
require_once '../variavel/VariavelCache.php';
require_once '../variavel/VariavelHelper.php';
require_once '../usuariocashback/UsuarioCashbackBusinessImpl.php';
require_once '../usuarios/UsuarioHelper.php';

/**
*
* CampanhaCashbackBusinessImpl - Classe de implementação dos métodos de negócio para a interface CampanhaCashbackBusiness
* Camada de negócio CampanhaCashback - camada responsável pela lógica de negócios de CampanhaCashback do sistema. 
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
* @since 26/08/2019 15:47:55
*
*/


class CampanhaCashbackBusinessImpl implements CampanhaCashbackBusiness
{
    
    function __construct()  {   }
/**
* PesquisarMaxPKAtivoId_UsuarioIdCampanhaPorStatus() - Carrega apenas um registro com base no id_usuario, id_campanha e status para buscar a MAIOR PK
* @param $daofactory
* @param $id_usuario
* @param $id_campanha
* @param $status
* @return CampanhaCashbackDTO
*/ 
    public function PesquisarMaxPKAtivoId_UsuarioIdCampanhaPorStatus($daofactory, $id_usuario, $id_campanha, $status)
    { 
        $dao = $daofactory->getCampanhaCashbackDAO($daofactory);
        $maxid = $dao->loadMaxId_UsuarioIdCampanhaPK($id_usuario, $id_campanha, $status);
        return $this->carregarPorID($daofactory, $maxid);
    }


/**
* carregar() - Carrega apenas um registro com base no campo id = (CAMPANHA_CASHBACK::CACA_ID)
* @param $daofactory
* @param $dto
* @return $dto
*/ 
    public function carregar($daofactory, $dto) {   }

/**
* listarTudo() - Lista todos os registros provenientes de CAMPANHA_CASHBACK sem critério de paginação
* @param $daofactory
* @return List<CampanhaCashbackDTO>[]
*/ 
    public function listarTudo($daofactory) {   }

/**
* atualizar() - atualiza apenas um registro com base no dto CampanhaCashbackDTO->id
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


        $dao = $daofactory->getCampanhaCashbackDAO($daofactory);
        if(!$dao->update($dto)){
           $retorno->msgcode = ConstantesMensagem::ERRO_CRUD_ATUALIZAR_REGISTRO;
           $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);
    
        }
        // retorna situação
        return $retorno;

    }

/**
* deletar() - excluir fisicamente um registro com base no dto CampanhaCashbackDTO->id
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
        $dao = $daofactory->getCampanhaCashbackDAO($daofactory);

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
* @return List<CampanhaCashbackDTO>[]
* @deprecated
*/ 

    public function listarPagina($daofactory, $pag, $qtde)  
    {   
        $dao = $daofactory->getCampanhaCashbackDAO($daofactory);
        return $dao->listPagina($pag, $qtde);
    }

/**
* carregarPorID() - Carrega APENAS um registro usando a id como item de busca
* na tabela CAMPANHA_CASHBACK usando a Primary Key CACA_ID
*
* @param $daofactory
* @param $id
* @param $qtde
*
* @return CampanhaCashbackDTO
*/ 
    public function carregarPorID($daofactory, $id)
    { 
        $dao = $daofactory->getCampanhaCashbackDAO($daofactory);
        return $dao->loadPK($id);
    }

/**
* atualizarStatus() - atualizar o campo de STATUS utilizando a id como item de busca
* na tabela CAMPANHA_CASHBACK usando a Primary Key CACA_ID
*
* @param $daofactory
* @param $id
* @param $status
*
* @return CampanhaCashbackDTO
*/ 
    public function atualizarStatus($daofactory, $id, $status)
    {
        $dao = $daofactory->getCampanhaCashbackDAO($daofactory);

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
* inserir() - inserir um registro com base no CampanhaCashbackDTO. Alguns atributos dentro do DTO
* serão ignorados caso estejam populados.
*
* Atributos da classe CampanhaCashbackDTO sumariamente IGNORADOS por este método MESMO que estejam preenchidos:
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
    $ok = $this->validarTamanhoCampo($dto->id, 11, 'ID Campanha x Cashback');
    if($ok->msgcode != ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO){
        return $ok;
    }

    // Efetua validações no campo $dto->id_campanha com tamanho 11
    $ok = $this->validarTamanhoCampo($dto->id_campanha, 11, 'ID da campanha');
    if($ok->msgcode != ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO){
        return $ok;
    }

    // Efetua validações no campo $dto->percentual com tamanho 4
    $ok = $this->validarTamanhoCampo($dto->percentual, 4, 'Percentual');
    if($ok->msgcode != ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO){
        return $ok;
    }

    // Efetua validações no campo $dto->dataTermino com tamanho 19
    $ok = $this->validarTamanhoCampo($dto->dataTermino, 19, 'Data de término');
    if($ok->msgcode != ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO){
        return $ok;
    }

    // Efetua validações no campo $dto->obs com tamanho 2000
    $ok = $this->validarTamanhoCampo($dto->obs, 2000, 'Observação');
    if($ok->msgcode != ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO){
        return $ok;
    }

    // Se valor do Ticket Médio estiver zerado, o programa de cashback para essa casmpanha
    // não poderá ser incluido
    $campdto = CampanhaHelper::getCampanhaBusinessDTO($daofactory, $dto->id_campanha);

    if($campdto == NULL || $campdto->id == 0){
        $retorno = new DTOPadrao();
        $retorno->msgcode = ConstantesMensagem::CAMPANHA_INEXISTENTE;
        $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);
        return $retorno;

    } else if( $campdto->status == ConstantesVariavel::STATUS_FILA) {
        $retorno = new DTOPadrao();
        $retorno->msgcode = ConstantesMensagem::CAMPANHA_NA_FILA_PARA_CRIACAO_CARIMBOS;
        $retorno->msgcodeString = MensagemCache::getInstance()->getMensagemParametrizada($retorno->msgcode, [
            ConstantesVariavel::P1 => $campdto->nome,
        ]);
        return $retorno;

    } else if( $campdto->valorTicketMedioCarimbo == 0) {
        $retorno = new DTOPadrao();
        $retorno->msgcode = ConstantesMensagem::VALOR_TICKET_MEDIO_CAMPANHA_ZERADO;
        $retorno->msgcodeString = MensagemCache::getInstance()->getMensagemParametrizada($retorno->msgcode, [
            ConstantesVariavel::P1 => $campdto->nome,
        ]);
        return $retorno;

    } 

    // Verifica se o usuário solicitante é um usuário parceiro
    if(! UsuarioHelper::isUsuarioParceiro($daofactory, $dto->id_usuario)){
        $retorno = new DTOPadrao();
        $retorno->msgcode = ConstantesMensagem::PERMITIDO_SO_USUARIO_PARCEIRO;
        $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);
        return $retorno;
    }

    // Verifica se o usuário solicitante é o dono da campanha
    if($dto->id_usuario != $campdto->id_usuario){
        $donodto = UsuarioHelper::getUsuarioBusinessNoKeys($dto->id_usuario);
        $retorno = new DTOPadrao();
        $retorno->msgcode = ConstantesMensagem::AUTORIZACAO_NEGADA;
        $retorno->msgcodeString = MensagemCache::getInstance()->getMensagemParametrizada($retorno->msgcode,[
            ConstantesVariavel::P1 => $donodto->apelido,
            ConstantesVariavel::P2 => "Gerenciar Cashback",            
        ]);
        return $retorno;
    }

    // Verifica se o usuario (dono) tem cashback ativo na 
    $usuacashbo = new UsuarioCashbackBusinessImpl();
    $dtousuacash = $usuacashbo->PesquisarMaxPKAtivoId_UsuarioPorStatus($daofactory, $campdto->id_usuario, ConstantesVariavel::STATUS_ATIVO);

    if($dtousuacash->id == null){
        // retro alimenta USUARIO_CASHBACK
        $uscadto = new UsuarioCashbackDTO();

        $uscadto->id_usuario = $campdto->id_usuario;
        $uscadto->vlMinimoResgate = 0;
        $uscadto->percentual = 0;
        $uscadto->obs = '<Digite a observação desejada>';
        
        $uscabo = new UsuarioCashbackBusinessImpl();
        $uscabo->inserir($daofactory, $uscadto);
        $dtousuacash = $usuacashbo->PesquisarMaxPKAtivoId_UsuarioPorStatus($daofactory, $campdto->id_usuario, ConstantesVariavel::STATUS_ATIVO);

    }

    // Coloca os valores padrões da campanha dentro do Cashback da campanha
    $dto->id_usca = $dtousuacash->id;
    $dto->id_campanha = $campdto->id;
    $dto->id_usuario = $campdto->id_usuario;
    $dto->percentual = $dto->percentual == 0 ? $dtousuacash->percentual : $dto->percentual;    

    $dto->status = ConstantesVariavel::STATUS_ATIVO;
    $dao = $daofactory->getCampanhaCashbackDAO($daofactory);

    // cancela a anterior se existir
    $cacatmp = $this->PesquisarMaxPKAtivoId_UsuarioIdCampanhaPorStatus($daofactory, $campdto->id_usuario, $campdto->id, ConstantesVariavel::STATUS_ATIVO);

    if($cacatmp->id != NULL){
        $this->atualizarStatus($daofactory, $cacatmp->id,ConstantesVariavel::STATUS_INATIVO);
    }

    if (!$dao->insert($dto)) {
        $retorno = new DTOPadrao();
        $retorno->msgcode = ConstantesMensagem::ERRO_CRUD_INSERIR_REGISTRO;
        $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);
    } else {
        $campdao = $daofactory->getCampanhaDAO($daofactory);
        if(!$campdao->updatePermissaoCashbackPorPK($campdto->id,ConstantesVariavel::SIM)) {
            $retorno = new DTOPadrao();
            $retorno->msgcode = ConstantesMensagem::ERRO_CRUD_ATUALIZAR_REGISTRO;
            $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);
        }
    }

    return $retorno;
}

/**
*
* listarCampanhaCashbackPorStatus() - Usado para invocar a interface de acesso aos dados (DAO) CampanhaCashbackDAO de forma geral
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

    public function listarCampanhaCashbackPorStatus($daofactory, $status, $pag, $qtde, $coluna, $ordem)
    {   
        $retorno = new DTOPaginacao();
        $retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
        $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);

        $dao = $daofactory->getCampanhaCashbackDAO($daofactory);
        $retorno->pagina = $pag;
        $retorno->itensPorPagina = ($qtde == 0 
        ? (int) VariavelCache::getInstance()->getVariavel(ConstantesVariavel::MAXIMO_LINHAS_POR_PAGINA_DEFAULT)
        : $qtde);
        $retorno->totalPaginas = ceil($dao->countCampanhaCashbackPorStatus($status) / $retorno->itensPorPagina);

        if($pag > $retorno->totalPaginas) {
            $retorno->msgcode = ConstantesMensagem::NAO_EXISTEM_MAIS_PAGINAS_APRESENTAR;
            $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);
            return $retorno;
        }
        $retorno->lst = $dao->listCampanhaCashbackPorStatus($status, $pag, $qtde, $coluna, $ordem);

        return $retorno;
    }

/**
*
* atualizarId_CampanhaPorPK() - Usado para invocar a classe de negócio CampanhaCashbackBusinessImpl de forma geral
* realizar uma atualização de ID da campanha diretamente na tabela CAMPANHA_CASHBACK campo CAMP_ID
* @param $daofactory
* @param $id
* @param $id_campanha
* @return CampanhaCashbackDTO
*
* 
*/
    public function atualizarId_CampanhaPorPK($daofactory,$id_campanha,$id)
    {
        $dao = $daofactory->getCampanhaCashbackDAO($daofactory);

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
* atualizarTituloPorPK() - Usado para invocar a classe de negócio CampanhaCashbackBusinessImpl de forma geral
* realizar uma atualização de Titulo diretamente na tabela CAMPANHA_CASHBACK campo CACA_TX_TITULO
* @param $daofactory
* @param $id
* @param $titulo
* @return CampanhaCashbackDTO
*
* 
*/
    public function atualizarTituloPorPK($daofactory,$titulo,$id)
    {
        $dao = $daofactory->getCampanhaCashbackDAO($daofactory);

        // resposta padrão
        $retorno = new DTOPadrao();

        if($dao->updateTitulo($id, $titulo)){   
            $retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
        }       

        // Obtem o texto da mensagem em razão do código de retorno
        $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);

        return $retorno;
    }

/**
*
* atualizarDescricaoPorPK() - Usado para invocar a classe de negócio CampanhaCashbackBusinessImpl de forma geral
* realizar uma atualização de Descrição diretamente na tabela CAMPANHA_CASHBACK campo CACA_TX_DESCRICAO
* @param $daofactory
* @param $id
* @param $descricao
* @return CampanhaCashbackDTO
*
* 
*/
    public function atualizarDescricaoPorPK($daofactory,$descricao,$id)
    {
        $dao = $daofactory->getCampanhaCashbackDAO($daofactory);

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
* atualizarVlminimoresgatePorPK() - Usado para invocar a classe de negócio CampanhaCashbackBusinessImpl de forma geral
* realizar uma atualização de Resgatar a partir de diretamente na tabela CAMPANHA_CASHBACK campo CACA_VL_RESGATE
* @param $daofactory
* @param $id
* @param $vlMinimoResgate
* @return CampanhaCashbackDTO
*
* 
*/
    public function atualizarVlminimoresgatePorPK($daofactory,$vlMinimoResgate,$id)
    {
        $dao = $daofactory->getCampanhaCashbackDAO($daofactory);

        // resposta padrão
        $retorno = new DTOPadrao();

        if($dao->updateVlminimoresgate($id, $vlMinimoResgate)){   
            $retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
        }       

        // Obtem o texto da mensagem em razão do código de retorno
        $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);

        return $retorno;
    }

/**
*
* atualizarPercentualPorPK() - Usado para invocar a classe de negócio CampanhaCashbackBusinessImpl de forma geral
* realizar uma atualização de Percentual diretamente na tabela CAMPANHA_CASHBACK campo CACA_VL_PERC_CASHBACK
* @param $daofactory
* @param $id
* @param $percentual
* @return CampanhaCashbackDTO
*
* 
*/
    public function atualizarPercentualPorPK($daofactory,$percentual,$id)
    {
        $dao = $daofactory->getCampanhaCashbackDAO($daofactory);

        // resposta padrão
        $retorno = new DTOPadrao();

        if($dao->updatePercentual($id, $percentual)){   
            $retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
        }       

        // Obtem o texto da mensagem em razão do código de retorno
        $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);

        return $retorno;
    }

/**
*
* atualizarDataterminoPorPK() - Usado para invocar a classe de negócio CampanhaCashbackBusinessImpl de forma geral
* realizar uma atualização de Data de término diretamente na tabela CAMPANHA_CASHBACK campo CACA_DT_TERMINO
* @param $daofactory
* @param $id
* @param $dataTermino
* @return CampanhaCashbackDTO
*
* 
*/
    public function atualizarDataterminoPorPK($daofactory,$dataTermino,$id)
    {
        $dao = $daofactory->getCampanhaCashbackDAO($daofactory);

        // resposta padrão
        $retorno = new DTOPadrao();

        if($dao->updateDatatermino($id, $dataTermino)){   
            $retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
        }       

        // Obtem o texto da mensagem em razão do código de retorno
        $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);

        return $retorno;
    }

/**
*
* atualizarObsPorPK() - Usado para invocar a classe de negócio CampanhaCashbackBusinessImpl de forma geral
* realizar uma atualização de Observação diretamente na tabela CAMPANHA_CASHBACK campo CACA_TX_OBS
* @param $daofactory
* @param $id
* @param $obs
* @return CampanhaCashbackDTO
*
* 
*/
    public function atualizarObsPorPK($daofactory,$obs,$id)
    {
        $dao = $daofactory->getCampanhaCashbackDAO($daofactory);

        // resposta padrão
        $retorno = new DTOPadrao();

        if($dao->updateObs($id, $obs)){   
            $retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
        }       

        // Obtem o texto da mensagem em razão do código de retorno
        $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);

        return $retorno;
    }

/**
*
* pesquisarPorId_CampanhaStatus() - Usado para invocar a classe de negócio CampanhaCashbackBusinessImpl de forma geral
* realizar uma busca de ID da campanha e o status
*
* @param $id_campanha
* @param $status
* @return CampanhaCashbackDTO
*
* 
*/

    public function pesquisarPorId_CampanhaStatus($daofactory, $id_campanha, $status)
    { 
        $dao = $daofactory->getCampanhaCashbackDAO($daofactory);
        return $dao->loadId_CampanhaStatus($id_campanha, $status);
    }


/**
*
* pesquisarPorId_Campanha() - Usado para invocar a classe de negócio CampanhaCashbackBusinessImpl de forma geral
* realizar uma busca de ID da campanha diretamente na tabela CAMPANHA_CASHBACK campo CAMP_ID
*
* @param $id_campanha
* @return CampanhaCashbackDTO
*
* 
*/
    public function pesquisarPorId_Campanha($daofactory,$id_campanha)
    { 
        $dao = $daofactory->getCampanhaCashbackDAO($daofactory);
        return $dao->loadId_Campanha($id_campanha);
    }

/**
*
* pesquisarPorTitulo() - Usado para invocar a classe de negócio CampanhaCashbackBusinessImpl de forma geral
* realizar uma busca de Titulo diretamente na tabela CAMPANHA_CASHBACK campo CACA_TX_TITULO
*
* @param $titulo
* @return CampanhaCashbackDTO
*
* 
*/
    public function pesquisarPorTitulo($daofactory,$titulo)

    { 
        $dao = $daofactory->getCampanhaCashbackDAO($daofactory);
        return $dao->loadTitulo($titulo);
    }

/**
*
* pesquisarPorDescricao() - Usado para invocar a classe de negócio CampanhaCashbackBusinessImpl de forma geral
* realizar uma busca de Descrição diretamente na tabela CAMPANHA_CASHBACK campo CACA_TX_DESCRICAO
*
* @param $descricao
* @return CampanhaCashbackDTO
*
* 
*/
    public function pesquisarPorDescricao($daofactory,$descricao)

    { 
        $dao = $daofactory->getCampanhaCashbackDAO($daofactory);
        return $dao->loadDescricao($descricao);
    }


/**
*
* pesquisarPorVlminimoresgate() - Usado para invocar a classe de negócio CampanhaCashbackBusinessImpl de forma geral
* realizar uma busca de Resgatar a partir de diretamente na tabela CAMPANHA_CASHBACK campo CACA_VL_RESGATE
*
* @param $vlMinimoResgate
* @return CampanhaCashbackDTO
*
* 
*/
    public function pesquisarPorVlminimoresgate($daofactory,$vlMinimoResgate)

    { 
        $dao = $daofactory->getCampanhaCashbackDAO($daofactory);
        return $dao->loadVlminimoresgate($vlMinimoResgate);
    }

/**
*
* pesquisarPorPercentual() - Usado para invocar a classe de negócio CampanhaCashbackBusinessImpl de forma geral
* realizar uma busca de Percentual diretamente na tabela CAMPANHA_CASHBACK campo CACA_VL_PERC_CASHBACK
*
* @param $percentual
* @return CampanhaCashbackDTO
*
* 
*/
    public function pesquisarPorPercentual($daofactory,$percentual)

    { 
        $dao = $daofactory->getCampanhaCashbackDAO($daofactory);
        return $dao->loadPercentual($percentual);
    }

/**
*
* pesquisarPorDatatermino() - Usado para invocar a classe de negócio CampanhaCashbackBusinessImpl de forma geral
* realizar uma busca de Data de término diretamente na tabela CAMPANHA_CASHBACK campo CACA_DT_TERMINO
*
* @param $dataTermino
* @return CampanhaCashbackDTO
*
* 
*/
    public function pesquisarPorDatatermino($daofactory,$dataTermino)

    { 
        $dao = $daofactory->getCampanhaCashbackDAO($daofactory);
        return $dao->loadDatatermino($dataTermino);
    }

/**
*
* pesquisarPorObs() - Usado para invocar a classe de negócio CampanhaCashbackBusinessImpl de forma geral
* realizar uma busca de Observação diretamente na tabela CAMPANHA_CASHBACK campo CACA_TX_OBS
*
* @param $obs
* @return CampanhaCashbackDTO
*
* 
*/
    public function pesquisarPorObs($daofactory,$obs)

    { 
        $dao = $daofactory->getCampanhaCashbackDAO($daofactory);
        return $dao->loadObs($obs);
    }


/**
*
* listarCampanhaCashbackUsuaIdPorStatus() - Usado para invocar a interface de acesso aos dados (DAO) CampanhaCashbackDAO de forma geral
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

    public function listarCampanhaCashbackPorUsuaIdStatus($daofactory, $usuaid, $status, $pag, $qtde, $coluna, $ordem)
    {   
        $retorno = new DTOPaginacao();
        $retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
        $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);

        $dao = $daofactory->getCampanhaCashbackDAO($daofactory);
        $retorno->pagina = $pag;
        $retorno->itensPorPagina = ($qtde == 0 
        ? (int) VariavelCache::getInstance()->getVariavel(ConstantesVariavel::MAXIMO_LINHAS_POR_PAGINA_DEFAULT)
        : $qtde);
        $retorno->totalPaginas = ceil($dao->countCampanhaCashbackPorUsuaIdStatus($usuaid, $status) / $retorno->itensPorPagina);

        if($pag > $retorno->totalPaginas) {
            $retorno->msgcode = ConstantesMensagem::NAO_EXISTEM_MAIS_PAGINAS_APRESENTAR;
            $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);
            return $retorno;
        }
        $retorno->lst = $dao->listCampanhaCashbackPorUsuaIdStatus($usuaid, $status, $pag, $qtde, $coluna, $ordem);

        return $retorno;
    }

/**
* validarTamanhoCampo()
*
* Validador de tamanho de campos CampanhaCashbackDTO
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

