<?php 

// importar dependencias
require_once 'RegistroIndicacaoBusiness.php';
require_once 'RegistroIndicacaoConstantes.php';
require_once 'RegistroIndicacaoHelper.php';
require_once '../dto/DTOPadrao.php';
require_once '../dto/DTOPaginacao.php';

require_once '../variavel/ConstantesVariavel.php';
require_once '../variavel/VariavelCache.php';
require_once '../usuariocampanhasorteio/UsuarioCampanhaSorteioDTO.php';
require_once '../usuariocampanhasorteio/UsuarioCampanhaSorteioBusinessImpl.php';
require_once '../mensagens/MSGCODE.php';
require_once '../usuarionotificacao/UsuarioNotificacaoHelper.php';
require_once '../usuarios/UsuarioHelper.php';
require_once '../campanhacashback/CampanhaCashbackBusinessImpl.php';
require_once '../campanhacashbackcc/CampanhaCashbackCCBusinessImpl.php';

/**
*
* RegistroIndicacaoBusinessImpl - Classe de implementação dos métodos de negócio para a interface RegistroIndicacaoBusiness
* Camada de negócio RegistroIndicacao - camada responsável pela lógica de negócios de RegistroIndicacao do sistema. 
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
* @since 23/06/2021 14:44:26
*
*/


class RegistroIndicacaoBusinessImpl implements RegistroIndicacaoBusiness
{
    
    function __construct()  {   }

/**
* carregar() - Carrega apenas um registro com base no campo id = (REGISTRO_INDICACAO::REIN_ID)
* @param $daofactory
* @param $dto
* @return $dto
*/ 
    public function carregar($daofactory, $dto) {   }

/**
* listarTudo() - Lista todos os registros provenientes de REGISTRO_INDICACAO sem critério de paginação
* @param $daofactory
* @return List<RegistroIndicacaoDTO>[]
*/ 
    public function listarTudo($daofactory) {   }

/**
* pesquisarMaxPKAtivoIdusuariopromotorPorStatus() - Carrega apenas um registro com base no idUsuarioPromotor  e status para buscar a MAIOR PK
* @param $daofactory
* @param $status
* @return RegistroIndicacaoDTO
*/ 
    public function pesquisarMaxPKAtivoIdusuariopromotorPorStatus($daofactory, $idUsuarioPromotor,$status)
    { 
        $dao = $daofactory->getRegistroIndicacaoDAO($daofactory);
        $maxid = $dao->loadMaxIdusuariopromotorPK($idUsuarioPromotor,$status);
        return $this->carregarPorID($daofactory, $maxid);
    }

/**
* atualizar() - atualiza apenas um registro com base no dto RegistroIndicacaoDTO->id
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


        $dao = $daofactory->getRegistroIndicacaoDAO($daofactory);
        if(!$dao->update($dto)){
           $retorno->msgcode = ConstantesMensagem::ERRO_CRUD_ATUALIZAR_REGISTRO;
           $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);
    
        }
        // retorna situação
        return $retorno;

    }

/**
* deletar() - excluir fisicamente um registro com base no dto RegistroIndicacaoDTO->id
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
        $dao = $daofactory->getRegistroIndicacaoDAO($daofactory);

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
* @return List<RegistroIndicacaoDTO>[]
* @deprecated
*/ 

    public function listarPagina($daofactory, $pag, $qtde)  
    {   
        $dao = $daofactory->getRegistroIndicacaoDAO($daofactory);
        return $dao->listPagina($pag, $qtde);
    }

/**
* carregarPorID() - Carrega APENAS um registro usando a id como item de busca
* na tabela REGISTRO_INDICACAO usando a Primary Key REIN_ID
*
* @param $daofactory
* @param $id
* @param $qtde
*
* @return RegistroIndicacaoDTO
*/ 
    public function carregarPorID($daofactory, $id)
    { 
        $dao = $daofactory->getRegistroIndicacaoDAO($daofactory);
        return $dao->loadPK($id);
    }

/**
* atualizarStatus() - atualizar o campo de STATUS utilizando a id como item de busca
* na tabela REGISTRO_INDICACAO usando a Primary Key REIN_ID
*
* @param $daofactory
* @param $id
* @param $status
*
* @return RegistroIndicacaoDTO
*/ 
    public function atualizarStatus($daofactory, $id, $status)
    {
        $dao = $daofactory->getRegistroIndicacaoDAO($daofactory);

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
* inserirIndicaoUsuarioPorPromotor() - inserir um registro com base em algumas RNs
*
* @param $daofactory
*
* @return DTOPadrao
*/ 
    public function inserirIndicaoUsuarioPorPromotor($daofactory, $dto)
    {
        $retorno = new DTOPadrao();
        $retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
        $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);

        //-----------------------------
        // Validar regras de negócio
        //-----------------------------

        // Não pode haver auto-indicação
        if($dto->idUsuarioPromotor == $dto->idUsuarioIndicado)
        {
            $retorno->msgcode = ConstantesMensagem::REGISTRO_INDICACAO_TENTATIVA_AUTO_INDICACAO;
            $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);
            return $retorno;
        }

        // Pesquisa se o indicado já foi indicado por outra pessoa
        $reinuidto = $this->pesquisarPorIdusuarioindicado($daofactory, $dto->idUsuarioIndicado);
        if(! is_null($reinuidto))
        {
            if($reinuidto->idUsuarioPromotor != $dto->idUsuarioPromotor) 
            {
                $retorno->msgcode = ConstantesMensagem::REGISTRO_INDICACAO_USUARIO_JA_FOI_INDICADO_POR_OUTRA_PESSOA;
                $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);
                return $retorno;
            } else {
                $retorno->msgcode = ConstantesMensagem::REGISTRO_INDICACAO_USUARIO_JA_FOI_INDICADO_POR_VOCE;
                $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);
                return $retorno;
            }
        }

        // Tudo Ok, pode inserir e retornar o resultado
        return $this->inserir($daofactory, $dto);
    }

/**
* inserir() - inserir um registro com base no RegistroIndicacaoDTO. Alguns atributos dentro do DTO
* serão ignorados caso estejam populados.
*
* Atributos da classe RegistroIndicacaoDTO sumariamente IGNORADOS por este método MESMO que estejam preenchidos:
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

    // Efetua validações no campo $dto->id com tamanho RegistroIndicacaoConstantes::LEN_ID
    $ok = $this->validarTamanhoCampo($dto->id, RegistroIndicacaoConstantes::LEN_ID, RegistroIndicacaoConstantes::DESC_ID);
    if($ok->msgcode != ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO){
        return $ok;
    }

    // Efetua validações no campo $dto->idUsuarioPromotor com tamanho RegistroIndicacaoConstantes::LEN_IDUSUARIOPROMOTOR
    $ok = $this->validarTamanhoCampo($dto->idUsuarioPromotor, RegistroIndicacaoConstantes::LEN_IDUSUARIOPROMOTOR, RegistroIndicacaoConstantes::DESC_IDUSUARIOPROMOTOR);
    if($ok->msgcode != ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO){
        return $ok;
    }

    // Efetua validações no campo $dto->idUsuarioIndicado com tamanho RegistroIndicacaoConstantes::LEN_IDUSUARIOINDICADO
    $ok = $this->validarTamanhoCampo($dto->idUsuarioIndicado, RegistroIndicacaoConstantes::LEN_IDUSUARIOINDICADO, RegistroIndicacaoConstantes::DESC_IDUSUARIOINDICADO);
    if($ok->msgcode != ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO){
        return $ok;
    }


    // Efetua validações no campo $dto->status com tamanho RegistroIndicacaoConstantes::LEN_STATUS
    $ok = $this->validarTamanhoCampo($dto->status, RegistroIndicacaoConstantes::LEN_STATUS, RegistroIndicacaoConstantes::DESC_STATUS);
    if($ok->msgcode != ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO){
        return $ok;
    }

    // Efetua validações no campo $dto->dataCadastro com tamanho RegistroIndicacaoConstantes::LEN_DATACADASTRO
    $ok = $this->validarTamanhoCampo($dto->dataCadastro, RegistroIndicacaoConstantes::LEN_DATACADASTRO, RegistroIndicacaoConstantes::DESC_DATACADASTRO);
    if($ok->msgcode != ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO){
        return $ok;
    }

    // Efetua validações no campo $dto->dataAtualizacao com tamanho RegistroIndicacaoConstantes::LEN_DATAATUALIZACAO
    $ok = $this->validarTamanhoCampo($dto->dataAtualizacao, RegistroIndicacaoConstantes::LEN_DATAATUALIZACAO, RegistroIndicacaoConstantes::DESC_DATAATUALIZACAO);
    if($ok->msgcode != ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO){
        return $ok;
    }


    $dto->status = ConstantesVariavel::STATUS_ATIVO;
    $dao = $daofactory->getRegistroIndicacaoDAO($daofactory);

    if (!$dao->insert($dto)) {
        $retorno = new DTOPadrao();
        $retorno->msgcode = ConstantesMensagem::ERRO_CRUD_INSERIR_REGISTRO;
        $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);
        return $retorno;
    }

    //--------------------------------------------------------------------------------------
    // Obtem no variavel qual o codigo da campanha sorteio ativo para indicacao se a chave geral estiver ligada
    //--------------------------------------------------------------------------------------
    if(VariavelCache::getInstance()->getVariavel(ConstantesVariavel::CHAVE_GERAL_INDICACAO_PERMITE_CAMPANHA_SORTEIO) == ConstantesVariavel::ATIVADO )
    {
        // Libera 1 bilhete (ticket) como prêmio para o usuário promotor
        $uscsdto = new UsuarioCampanhaSorteioDTO();

        $uscsdto->idUsuario = $dto->idUsuarioPromotor;
        $uscsdto->idCampanhaSorteio = (int) VariavelCache::getInstance()->getVariavel(ConstantesVariavel::CODIGO_CAMPANHA_SORTEIO_ATIVO_INDICACAO);

        $ucsbo = new UsuarioCampanhaSorteioBusinessImpl();
        $retorno = $ucsbo->inserirUsuarioParticipanteCampanhaSorteio($daofactory, $uscsdto, true);
        if($retorno->msgcode != MSGCODE::MSG_COMANDO_EXECUTADO_COM_SUCESSO) 
        {
            return $retorno;
        }
    }

    //--------------------------------------------------------------------------------------
    // Verifica se a premiação no Campanha Cashback está ativa para recompensa financeira
    //--------------------------------------------------------------------------------------
    if(VariavelCache::getInstance()->getVariavel(ConstantesVariavel::CHAVE_GERAL_CAMPANHA_CASHBACK_ATIVO_INDICACAO) == ConstantesVariavel::ATIVADO )
    {

        $cacaidAtiva = (int) VariavelCache::getInstance()->getVariavel(ConstantesVariavel::CODIGO_CAMPANHA_CASHBACK_ATIVO_INDICACAO);
//        $cacavlAtiva = floatval(VariavelCache::getInstance()->getVariavel(ConstantesVariavel::VALOR_CAMPANHA_CASHBACK_ATIVO_INDICACAO));
        $cacavlAtiva = floatval(Util::getCodigoNumerico(2));
        if($cacaidAtiva > 0 && $cacavlAtiva > 0)
        {

            // Obtem o registro da campanha cashback ativa no variavel
            $cacabo = new CampanhaCashbackBusinessImpl(); 
            $cacadto = $cacabo->carregarPorID($daofactory, $cacaidAtiva);

            // Pesquisa se o indicado já foi indicado por outra pessoa
            $reinuidto = UsuarioHelper::getUsuarioBusinessNoKeys($daofactory, $dto->idUsuarioIndicado);

            // Insere uma linha de registro no cashback conta corrente
            $caccbo = new CampanhaCashbackCCBusinessImpl();
            $caccbo->lancarMovimentoCashbackCC($daofactory, 
                $dto->idUsuarioPromotor,
                $cacadto->id_campanha, 
                $cacavlAtiva , 
                
                MensagemCache::getInstance()->getMensagemParametrizada(ConstantesMensagem::PARABENS_PELA_RECOMPENSA_DE_INDICACAO, [
                    ConstantesVariavel::P1 => $reinuidto->apelido
                ])
            );

        }

        // Libera 1 bilhete (ticket) como prêmio para o usuário promotor
        $uscsdto = new UsuarioCampanhaSorteioDTO();

        $uscsdto->idUsuario = $dto->idUsuarioPromotor;
        $uscsdto->idCampanhaSorteio = (int) VariavelCache::getInstance()->getVariavel(ConstantesVariavel::CODIGO_CAMPANHA_SORTEIO_ATIVO_INDICACAO);

        $ucsbo = new UsuarioCampanhaSorteioBusinessImpl();
        $retorno = $ucsbo->inserirUsuarioParticipanteCampanhaSorteio($daofactory, $uscsdto, true);
        if($retorno->msgcode != MSGCODE::MSG_COMANDO_EXECUTADO_COM_SUCESSO) 
        {
            return $retorno;
        }
    }


    // Inserir notificacao ao admin
    $usuaPromotor = UsuarioHelper::getUsuarioBusinessNoKeys($daofactory, $dto->idUsuarioPromotor);
    $usuaIndicado = UsuarioHelper::getUsuarioBusinessNoKeys($daofactory, $dto->idUsuarioIndicado);
    UsuarioNotificacaoHelper::criarNotificacaoAdmin($daofactory,
        ConstantesMensagem::AVISO_INDICACAO_NOVA_INSTALACAO, 
        [
            ConstantesVariavel::P1 => $usuaPromotor->apelido,
            ConstantesVariavel::P2 => $usuaIndicado->apelido,
        ], 
        "notify-03.png"
    );

    return $retorno;
}

/**
*
* listarRegistroIndicacaoPorStatus() - Usado para invocar a interface de acesso aos dados (DAO) RegistroIndicacaoDAO de forma geral
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

    public function listarRegistroIndicacaoPorStatus($daofactory, $status, $pag, $qtde, $coluna, $ordem)
    {   
        $retorno = new DTOPaginacao();
        $retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
        $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);

        $dao = $daofactory->getRegistroIndicacaoDAO($daofactory);
        $retorno->pagina = $pag;
        $retorno->itensPorPagina = ($qtde == 0 
        ? (int) VariavelCache::getInstance()->getVariavel(ConstantesVariavel::MAXIMO_LINHAS_POR_PAGINA_DEFAULT)
        : $qtde);
        $retorno->totalPaginas = ceil($dao->countRegistroIndicacaoPorStatus($status) / $retorno->itensPorPagina);

        if($pag > $retorno->totalPaginas) {
            $retorno->msgcode = ConstantesMensagem::NAO_EXISTEM_MAIS_PAGINAS_APRESENTAR;
            $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);
            return $retorno;
        }
        $retorno->lst = $dao->listRegistroIndicacaoPorStatus($status, $pag, $qtde, $coluna, $ordem);

        return $retorno;
    }






/**
*
* atualizarIdusuariopromotorPorPK() - Usado para invocar a classe de negócio RegistroIndicacaoBusinessImpl de forma geral
* realizar uma atualização de ID do usuário Promotor diretamente na tabela REGISTRO_INDICACAO campo USUA_ID_PROMOTOR
* @param $daofactory
* @param $id
* @param $idUsuarioPromotor
* @return RegistroIndicacaoDTO
*
* 
*/
    public function atualizarIdusuariopromotorPorPK($daofactory,$idUsuarioPromotor,$id)
    {
        $dao = $daofactory->getRegistroIndicacaoDAO($daofactory);

        // resposta padrão
        $retorno = new DTOPadrao();

        if($dao->updateIdusuariopromotor($id, $idUsuarioPromotor)){   
            $retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
        }       

        // Obtem o texto da mensagem em razão do código de retorno
        $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);

        return $retorno;
    }

/**
*
* atualizarIdusuarioindicadoPorPK() - Usado para invocar a classe de negócio RegistroIndicacaoBusinessImpl de forma geral
* realizar uma atualização de ID do usuário Indicado diretamente na tabela REGISTRO_INDICACAO campo USUA_ID_INDICADO
* @param $daofactory
* @param $id
* @param $idUsuarioIndicado
* @return RegistroIndicacaoDTO
*
* 
*/
    public function atualizarIdusuarioindicadoPorPK($daofactory,$idUsuarioIndicado,$id)
    {
        $dao = $daofactory->getRegistroIndicacaoDAO($daofactory);

        // resposta padrão
        $retorno = new DTOPadrao();

        if($dao->updateIdusuarioindicado($id, $idUsuarioIndicado)){   
            $retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
        }       

        // Obtem o texto da mensagem em razão do código de retorno
        $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);

        return $retorno;
    }


/**
*
* pesquisarPorIdusuariopromotor() - Usado para invocar a classe de negócio RegistroIndicacaoBusinessImpl de forma geral
* realizar uma busca de ID do usuário Promotor diretamente na tabela REGISTRO_INDICACAO campo USUA_ID_PROMOTOR
*
* @param $idUsuarioPromotor
* @return RegistroIndicacaoDTO
*
* 
*/
    public function pesquisarPorIdusuariopromotor($daofactory,$idUsuarioPromotor)
    { 
        $dao = $daofactory->getRegistroIndicacaoDAO($daofactory);
        return $dao->loadIdusuariopromotor($idUsuarioPromotor);
    }

/**
*
* pesquisarPorIdusuarioindicado() - Usado para invocar a classe de negócio RegistroIndicacaoBusinessImpl de forma geral
* realizar uma busca de ID do usuário Indicado diretamente na tabela REGISTRO_INDICACAO campo USUA_ID_INDICADO
*
* @param $idUsuarioIndicado
* @return RegistroIndicacaoDTO
*
* 
*/
    public function pesquisarPorIdusuarioindicado($daofactory,$idUsuarioIndicado)

    { 
        $dao = $daofactory->getRegistroIndicacaoDAO($daofactory);
        return $dao->loadIdusuarioindicado($idUsuarioIndicado);
    }

/**
*
* listarRegistroIndicacaoUsuaIdPorStatus() - Usado para invocar a interface de acesso aos dados (DAO) RegistroIndicacaoDAO de forma geral
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

    public function listarRegistroIndicacaoPorUsuaIdStatus($daofactory, $usuaid, $status, $pag, $qtde, $coluna, $ordem)
    {   
        $retorno = new DTOPaginacao();
        $retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
        $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);

        $dao = $daofactory->getRegistroIndicacaoDAO($daofactory);
        $retorno->pagina = $pag;
        $retorno->itensPorPagina = ($qtde == 0 
        ? (int) VariavelCache::getInstance()->getVariavel(ConstantesVariavel::MAXIMO_LINHAS_POR_PAGINA_DEFAULT)
        : $qtde);
        $retorno->totalPaginas = ceil($dao->countRegistroIndicacaoPorUsuaIdStatus($usuaid, $status) / $retorno->itensPorPagina);

        if($pag > $retorno->totalPaginas) {
            $retorno->msgcode = ConstantesMensagem::NAO_EXISTEM_MAIS_PAGINAS_APRESENTAR;
            $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);
            return $retorno;
        }
        $retorno->lst = $dao->listRegistroIndicacaoPorUsuaIdStatus($usuaid, $status, $pag, $qtde, $coluna, $ordem);

        return $retorno;
    }

/**
* validarTamanhoCampo()
*
* Validador de tamanho de campos RegistroIndicacaoDTO
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
