<?php 

// importar dependencias
require_once 'CampanhaSorteioBusiness.php';
require_once 'CampanhaSorteioConstantes.php';
require_once 'CampanhaSorteioHelper.php';

require_once '../dto/DTOPadrao.php';
require_once '../dto/DTOPaginacao.php';

require_once '../variavel/ConstantesVariavel.php';
require_once '../variavel/VariavelCache.php';
require_once '../campanhasorteiofilacriacao/CampanhaSorteioFilaCriacaoBusinessImpl.php';
require_once '../campanha/campanhaBusinessImpl.php';
require_once '../usuarionotificacao/UsuarioNotificacaoHelper.php';

/**
*
* CampanhaSorteioBusinessImpl - Classe de implementação dos métodos de negócio para a interface CampanhaSorteioBusiness
* Camada de negócio CampanhaSorteio - camada responsável pela lógica de negócios de CampanhaSorteio do sistema. 
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
* @since 16/06/2021 12:57:19
*
*/


class CampanhaSorteioBusinessImpl implements CampanhaSorteioBusiness
{
     
    function __construct(){}

/**
* carregar() - Carrega apenas um registro com base no campo id = (CAMPANHA_SORTEIO::CASO_ID)
* @param $daofactory
* @param $dto
* @return $dto
*/ 
     public function carregar($daofactory, $dto){}

/**
* listarTudo() - Lista todos os registros provenientes de CAMPANHA_SORTEIO sem critério de paginação
* @param $daofactory
* @return List<CampanhaSorteioDTO>[]
*/ 
     public function listarTudo($daofactory){}

/**
* pesquisarMaxPKAtivoId_CampanhaPorStatus() - Carrega apenas um registro com base no id_campanha  e status para buscar a MAIOR PK
* @param $daofactory
* @param $status
* @return CampanhaSorteioDTO
*/ 
    public function pesquisarMaxPKAtivoId_CampanhaPorStatus($daofactory, $id_campanha,$status)
    { 
        $dao = $daofactory->getCampanhaSorteioDAO($daofactory);
        $maxid = $dao->loadMaxId_CampanhaPK($id_campanha,$status);
        return $this->carregarPorID($daofactory, $maxid);
    }

/**
* atualizar() - atualiza apenas um registro com base no dto CampanhaSorteioDTO->id
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


          $dao = $daofactory->getCampanhaSorteioDAO($daofactory);
          if(!$dao->update($dto)){
            $retorno->msgcode = ConstantesMensagem::ERRO_CRUD_ATUALIZAR_REGISTRO;
            $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);
     
          }
          // retorna situação
          return $retorno;

     }


/**
 * ativarCampanhaSorteio() - Ativa uma campanha em status PENDENTE para status TRABALHANDO
 * 
 * @param $daofactory
 * @param $dto 
*/
public function ativarCampanhaSorteio($daofactory, $id)
{
    //var_dump("bo::ativarCampanhaSorteio($id)");

    // retorno default
    $retorno = new DTOPadrao();
    $retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
    $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);

    // Localiza a CASO pelo id
    $casodto = CampanhaSorteioHelper::getCampanhaSorteioBusiness($daofactory, $id);
//var_dump($casodto);    
    if (is_null($casodto))
    {
        $retorno->msgcode = ConstantesMensagem::CAMPANHA_SORTEIO_INEXISTENTE;
        $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);
        return $retorno;
    }

    // Verifica o status da CASO
    if($casodto->status == ConstantesVariavel::STATUS_TRABALHANDO) 
    {
        $retorno->msgcode = ConstantesMensagem::CAMPANHA_SORTEIO_AGUARDANDO_VERIFICACAO;
        $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);
        return $retorno;
    }

    if($casodto->status == ConstantesVariavel::STATUS_INATIVO) 
    {
        $retorno->msgcode = ConstantesMensagem::CAMPANHA_SORTEIO_JA_ESTA_INATIVADA;
        $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);
        return $retorno;
    }

    // Status precisa ser verfificado
    if($casodto->status != ConstantesVariavel::STATUS_PENDENTE) 
    {
        // Envia uma notificação ao ADMIN
        UsuarioNotificacaoHelper::criarNotificacaoAdmin(
            $daofactory
            , ConstantesMensagem::CAMPANHA_SORTEIO_PRECISA_VERFICACAO_ADMIN
            , [
                ConstantesVariavel::P1 => $casodto->id,
                ConstantesVariavel::P2 => $casodto->nome, 
                ConstantesVariavel::P3 => $casodto->statusdesc,
            ]
            ,  "notify-03.png"
        );

        $retorno->msgcode = ConstantesMensagem::CAMPANHA_SORTEIO_STATUS_PRECISA_SER_VERIFICADO;
        $retorno->msgcodeString = MensagemCache::getInstance()->getMensagemParametrizada($retorno->msgcode, [
            ConstantesVariavel::P1 => $casodto->status,
        ]);
        return $retorno;
    }
    

     $dao = $daofactory->getCampanhaSorteioDAO($daofactory);
     if(!$dao->updateStatus($id, ConstantesVariavel::STATUS_TRABALHANDO)){
       $retorno->msgcode = ConstantesMensagem::ERRO_CRUD_ATUALIZAR_REGISTRO;
       $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);

     }
     // retorna situação
     return $retorno;

}



/**
 * usarCampanhaSorteio() - Usar uma campanha em status D = Pronto pra usar para status ATIVO
 * 
 * @param $daofactory
 * @param $dto 
*/
public function usarCampanhaSorteio($daofactory, $id)
{
    //var_dump("bo::ativarCampanhaSorteio($id)");

    // retorno default
    $retorno = new DTOPadrao();
    $retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
    $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);

    // Localiza a CASO pelo id
    $casodto = CampanhaSorteioHelper::getCampanhaSorteioBusiness($daofactory, $id);
//var_dump($casodto);    
    if (is_null($casodto))
    {
        $retorno->msgcode = ConstantesMensagem::CAMPANHA_SORTEIO_INEXISTENTE;
        $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);
        return $retorno;
    }

    // Verifica o status da CASO
    if($casodto->status == ConstantesVariavel::STATUS_ATIVO) 
    {
        $retorno->msgcode = ConstantesMensagem::CAMPANHA_SORTEIO_JA_ESTA_ATIVADA;
        $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);
        return $retorno;
    }

    if($casodto->status == ConstantesVariavel::STATUS_INATIVO) 
    {
        $retorno->msgcode = ConstantesMensagem::CAMPANHA_SORTEIO_JA_ESTA_INATIVADA;
        $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);
        return $retorno;
    }

    // Verificar se já existe uma campanha sorteio ativa
    $dao = $daofactory->getCampanhaSorteioDAO($daofactory);
    if($dao->countCampanhaSorteioPorCampIdStatus($casodto->id_campanha, ConstantesVariavel::STATUS_ATIVO) > 0){
        $retorno->msgcode = ConstantesMensagem::CAMPANHA_SORTEIO_NAO_PERMITIDO_ATIVAR_PARALELO;
        $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);
        return $retorno;
    }

    // Status precisa ser verfificado
    if($casodto->status != ConstantesVariavel::STATUS_PRONTO_USAR) 
    {
        // Envia uma notificação ao ADMIN
        UsuarioNotificacaoHelper::criarNotificacaoAdmin(
            $daofactory
            , ConstantesMensagem::CAMPANHA_SORTEIO_PRECISA_VERFICACAO_ADMIN
            , [
                ConstantesVariavel::P1 => $casodto->id,
                ConstantesVariavel::P2 => $casodto->nome, 
                ConstantesVariavel::P3 => $casodto->statusdesc,
            ]
            ,  "notify-03.png"
        );

        $retorno->msgcode = ConstantesMensagem::CAMPANHA_SORTEIO_STATUS_PRECISA_SER_VERIFICADO;
        $retorno->msgcodeString = MensagemCache::getInstance()->getMensagemParametrizada($retorno->msgcode, [
            ConstantesVariavel::P1 => $casodto->status,
        ]);
        return $retorno;
    }


     $dao = $daofactory->getCampanhaSorteioDAO($daofactory);
     if(!$dao->updateStatus($id, ConstantesVariavel::STATUS_ATIVO)){
       $retorno->msgcode = ConstantesMensagem::ERRO_CRUD_ATUALIZAR_REGISTRO;
       $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);

     }
     // retorna situação
     return $retorno;

}


/**
 * pausarCampanhaSorteio() - pausar uma campanha em status A = Ativo para trocar para  status D = Pronto pra usar
 * 
 * @param $daofactory
 * @param $dto 
*/
public function pausarCampanhaSorteio($daofactory, $id)
{
    //var_dump("bo::ativarCampanhaSorteio($id)");

    // retorno default
    $retorno = new DTOPadrao();
    $retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
    $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);

    // Localiza a CASO pelo id
    $casodto = CampanhaSorteioHelper::getCampanhaSorteioBusiness($daofactory, $id);
//var_dump($casodto);    
    if (is_null($casodto))
    {
        $retorno->msgcode = ConstantesMensagem::CAMPANHA_SORTEIO_INEXISTENTE;
        $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);
        return $retorno;
    }

    // Verificar se já existe uma campanha sorteio ativa
    $dao = $daofactory->getCampanhaSorteioDAO($daofactory);
    if($dao->countCampanhaSorteioPorCampIdStatus($casodto->id_campanha, ConstantesVariavel::STATUS_ATIVO) == 0){
        $retorno->msgcode = ConstantesMensagem::CAMPANHA_SORTEIO_NAO_EXISTE_PARA_PAUSAR;
        $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);
        return $retorno;
    }

    if($casodto->status == ConstantesVariavel::STATUS_INATIVO) 
    {
        $retorno->msgcode = ConstantesMensagem::CAMPANHA_SORTEIO_JA_ESTA_INATIVADA;
        $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);
        return $retorno;
    }

    // Verifica o status da CASO
    if($casodto->status == ConstantesVariavel::STATUS_PRONTO_USAR) 
    {
        $retorno->msgcode = ConstantesMensagem::CAMPANHA_SORTEIO_ESTA_PRONTA_PRA_USAR;
        $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);
        return $retorno;
    }

    // Status precisa ser verfificado
    if($casodto->status != ConstantesVariavel::STATUS_ATIVO) 
    {
        // Envia uma notificação ao ADMIN
        UsuarioNotificacaoHelper::criarNotificacaoAdmin(
            $daofactory
            , ConstantesMensagem::CAMPANHA_SORTEIO_PRECISA_VERFICACAO_ADMIN
            , [
                ConstantesVariavel::P1 => $casodto->id,
                ConstantesVariavel::P2 => $casodto->nome, 
                ConstantesVariavel::P3 => $casodto->statusdesc,
            ]
            ,  "notify-03.png"
        );

        $retorno->msgcode = ConstantesMensagem::CAMPANHA_SORTEIO_STATUS_PRECISA_SER_VERIFICADO;
        $retorno->msgcodeString = MensagemCache::getInstance()->getMensagemParametrizada($retorno->msgcode, [
            ConstantesVariavel::P1 => $casodto->status,
        ]);
        return $retorno;
    }


     $dao = $daofactory->getCampanhaSorteioDAO($daofactory);
     if(!$dao->updateStatus($id, ConstantesVariavel::STATUS_PRONTO_USAR)){
       $retorno->msgcode = ConstantesMensagem::ERRO_CRUD_ATUALIZAR_REGISTRO;
       $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);

     }
     // retorna situação
     return $retorno;

}


/**
 * desativarCampanhaSorteio() - desativar uma campanha sorteio é torna-la INATIVA mudando o status para I. Uma vez realizada
 * essa operação ela não poderá mais set desfeita.
 * 
 * @param $daofactory
 * @param $dto 
*/
public function desativarCampanhaSorteio($daofactory, $id)
{
    //var_dump("bo::ativarCampanhaSorteio($id)");

    // retorno default
    $retorno = new DTOPadrao();
    $retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
    $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);

    // Localiza a CASO pelo id
    $casodto = CampanhaSorteioHelper::getCampanhaSorteioBusiness($daofactory, $id);
//var_dump($casodto);    
    if (is_null($casodto))
    {
        $retorno->msgcode = ConstantesMensagem::CAMPANHA_SORTEIO_INEXISTENTE;
        $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);
        return $retorno;
    }

    // Verifica o status da CASO
    if($casodto->status == ConstantesVariavel::STATUS_INATIVO) 
    {
        $retorno->msgcode = ConstantesMensagem::CAMPANHA_SORTEIO_JA_ESTA_INATIVADA;
        $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);
        return $retorno;
    }

    // Status precisa ser verfificado
    if($casodto->status != ConstantesVariavel::STATUS_ATIVO) 
    {
        // Envia uma notificação ao ADMIN
        UsuarioNotificacaoHelper::criarNotificacaoAdmin(
            $daofactory
            , ConstantesMensagem::CAMPANHA_SORTEIO_PRECISA_VERFICACAO_ADMIN
            , [
                ConstantesVariavel::P1 => $casodto->id,
                ConstantesVariavel::P2 => $casodto->nome, 
                ConstantesVariavel::P3 => $casodto->statusdesc,
            ]
            ,  "notify-03.png"
        );

        $retorno->msgcode = ConstantesMensagem::CAMPANHA_SORTEIO_STATUS_PRECISA_SER_VERIFICADO;
        $retorno->msgcodeString = MensagemCache::getInstance()->getMensagemParametrizada($retorno->msgcode, [
            ConstantesVariavel::P1 => $casodto->status,
        ]);
        return $retorno;
    }


     $dao = $daofactory->getCampanhaSorteioDAO($daofactory);
     if(!$dao->updateStatus($id, ConstantesVariavel::STATUS_INATIVO)){
       $retorno->msgcode = ConstantesMensagem::ERRO_CRUD_ATUALIZAR_REGISTRO;
       $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);

     }
     // retorna situação
     return $retorno;

}




/**
 * criarSorteio() - Cria todo o processo inicial do sorteio para uma campanha
 * 
 * @param $daofactory
 * @param $dto 
*/
     public function criarSorteio($daofactory, $dto)
     {
         // retorno default
         $retorno = new DTOPadrao();
         $retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
         $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);

         // verificações outras regras gerais de negócio
        $campbo = new CampanhaBusinessImpl();
        $campdto = $campbo->carregarPorID($daofactory, $dto->id_campanha);

        if( $campdto == NULL) {
            $retorno->msgcode = ConstantesMensagem::CAMPANHA_INEXISTENTE;
            $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);
            return $retorno;
        }

        //--------------------------
        // Verificação de permissão
        //--------------------------

        // ... não permitir planos gratuitos
        $sbi = new PlanoUsuarioBusinessImpl();
        $plusid = $sbi->carregarPlanoUsuarioPorStatus($daofactory, $campdto->id_usuario, ConstantesVariavel::STATUS_ATIVO);
        $plusdto = $sbi->carregarPorID($daofactory, $plusid->id);
//echo "<br>==========<br>";        
//echo json_encode($plusdto);
//echo "<br>==========<br>";        
        if($plusdto->planoid == VariavelCache::getInstance()->getVariavel(ConstantesVariavel::PLANO_GRATUITO_CODIGO) ){
            $dtocheck = new DTOPadrao();
            $dtocheck->msgcode = ConstantesMensagem::PLANO_GRATUITO_NAO_PERMITE_SORTEIO;
            $dtocheck->msgcodeString = MensagemCache::getInstance()->getMensagem($dtocheck->msgcode);
            return $dtocheck;
        }

		// -----------------------------------------------------------------------------
		// Verifica permissao PERM_ADICIONAR_SORTEIO_CAMPANHA de acordo com 
		// plano do usuário registrado mais recente e ATIVO
		// -----------------------------------------------------------------------------
		$permdto = PermissaoHelper::verificarPermissao($daofactory,$campdto->id_usuario, ConstantesPlano::PERM_ADICIONAR_SORTEIO_CAMPANHA);
		if ($permdto->msgcode != ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO) {
			return $permdto;	
		}
//echo "<br>==========<br>";        
//var_dump($permdto);
//echo "<br>==========<br>";        
        
        // Incluir na base de sorteio da campanha
        $retorno = $this->inserir($daofactory, $dto);

        // Incluir na fila de criação de número pra não cair por timeout no provedor
        if($retorno->msgcode == ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO)
        {
            // repopula o registro de campanha sorteio mais recente inserido
            $csdto = $this->pesquisarMaxPKAtivoId_CampanhaPorStatus($daofactory, $dto->id_campanha, ConstantesVariavel::STATUS_PENDENTE);

            // preenche a fila
            $fatorDivisaoLotes = (int) VariavelCache::getInstance()->getVariavel(ConstantesVariavel::FATOR_DIVISAO_TICKETS_EM_LOTES);
            $contador = $dto->maxTickets;
            $csfcbo = new CampanhaSorteioFilaCriacaoBusinessImpl();

            while ($contador >= $fatorDivisaoLotes) {

                // Popula DTO e envia para gravação
                $csfcdto = new CampanhaSorteioFilaCriacaoDTO();
                $csfcdto->id_caso = $csdto->id;
                $csfcdto->qtLoteTicketCriar = $fatorDivisaoLotes;

                $csfcbo->inserir($daofactory, $csfcdto);

                // Recalibra contador
                $contador -= $fatorDivisaoLotes;

            }

            // Grava o restante que sobrou caso o recalibramento seja inferior ao fator de divisão
            if( $contador > 0)
            {
                // Popula DTO e envia para gravação
                $csfcdto = new CampanhaSorteioFilaCriacaoDTO();
                $csfcdto->id_caso = $csdto->id;
                $csfcdto->qtLoteTicketCriar = $contador;
                $csfcbo->inserir($daofactory, $csfcdto);

            }
/*
            // Envia uma notificação ao ADMIN se chave estiver ligada
            if (VariavelCache::getInstance()->getVariavel(ConstantesVariavel::CHAVE_NOTIFICACAO_ADMIN_NOVO_USUARIO) == ConstantesVariavel::ATIVADO){
                $usuaid_admin = (int) VariavelCache::getInstance()->getVariavel(ConstantesVariavel::NOTIFICACAO_ADMIN_USUA_ID);
                $msg =  MensagemCache::getInstance()->getMensagemParametrizada(ConstantesMensagem::NOTIFICACAO_NOVO_CAMPANHA_SORTEIO, [
                    ConstantesVariavel::P1 => $campdto->id,
                    ConstantesVariavel::P2 => $campdto->nome, 
                    ConstantesVariavel::P3 => $csdto->id,
                    ConstantesVariavel::P4 => $csdto->nome,
                    ConstantesVariavel::P5 => $csdto->statusdesc,
                ]);

                UsuarioNotificacaoHelper::criarUsuarioNotificacaoPorBusiness($daofactory, $usuaid_admin, $msg, "notify-03.png");
            }
*/
            UsuarioNotificacaoHelper::criarNotificacaoAdmin(
              $daofactory
            , ConstantesMensagem::NOTIFICACAO_NOVO_CAMPANHA_SORTEIO
            , [
                ConstantesVariavel::P1 => $campdto->id,
                ConstantesVariavel::P2 => $campdto->nome, 
                ConstantesVariavel::P3 => $csdto->id,
                ConstantesVariavel::P4 => $csdto->nome,
                ConstantesVariavel::P5 => $csdto->statusdesc,
            ]
            , "notify-03.png");

        }

         return $retorno;

     }

/**
* deletar() - excluir fisicamente um registro com base no dto CampanhaSorteioDTO->id
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
          $dao = $daofactory->getCampanhaSorteioDAO($daofactory);

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
* @return List<CampanhaSorteioDTO>[]
* @deprecated
*/ 

     public function listarPagina($daofactory, $pag, $qtde)
     {
        $dao = $daofactory->getCampanhaSorteioDAO($daofactory);
        return $dao->listPagina($pag, $qtde);
     }

/**
* carregarPorID() - Carrega APENAS um registro usando a id como item de busca
* na tabela CAMPANHA_SORTEIO usando a Primary Key CASO_ID
*
* @param $daofactory
* @param $id
* @param $qtde
*
* @return CampanhaSorteioDTO
*/ 
     public function carregarPorID($daofactory, $id)
     { 
          $dao = $daofactory->getCampanhaSorteioDAO($daofactory);
          return $dao->loadPK($id);
     }

/**
* atualizarStatus() - atualizar o campo de STATUS utilizando a id como item de busca
* na tabela CAMPANHA_SORTEIO usando a Primary Key CASO_ID
*
* @param $daofactory
* @param $id
* @param $status
*
* @return CampanhaSorteioDTO
*/ 
     public function atualizarStatus($daofactory, $id, $status)
     {
          $dao = $daofactory->getCampanhaSorteioDAO($daofactory);

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
* inserir() - inserir um registro com base no CampanhaSorteioDTO. Alguns atributos dentro do DTO
* serão ignorados caso estejam populados.
*
* Atributos da classe CampanhaSorteioDTO sumariamente IGNORADOS por este método MESMO que estejam preenchidos:
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

    // Efetua validações no campo $dto->id com tamanho CampanhaSorteioConstantes::LEN_ID
    $ok = $this->validarTamanhoCampo($dto->id, CampanhaSorteioConstantes::LEN_ID, CampanhaSorteioConstantes::DESC_ID);
    if($ok->msgcode != ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO){
        return $ok;
    }

    // Efetua validações no campo $dto->id_campanha com tamanho CampanhaSorteioConstantes::LEN_ID_CAMPANHA
    $ok = $this->validarTamanhoCampo($dto->id_campanha, CampanhaSorteioConstantes::LEN_ID_CAMPANHA, CampanhaSorteioConstantes::DESC_ID_CAMPANHA);
    if($ok->msgcode != ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO){
        return $ok;
    }

    // Efetua validações no campo $dto->nome com tamanho CampanhaSorteioConstantes::LEN_NOME
    $ok = $this->validarTamanhoCampo($dto->nome, CampanhaSorteioConstantes::LEN_NOME, CampanhaSorteioConstantes::DESC_NOME);
    if($ok->msgcode != ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO){
        return $ok;
    }

    // Efetua validações no campo $dto->urlRegulamento com tamanho CampanhaSorteioConstantes::LEN_URLREGULAMENTO
    $ok = $this->validarTamanhoCampo($dto->urlRegulamento, CampanhaSorteioConstantes::LEN_URLREGULAMENTO, CampanhaSorteioConstantes::DESC_URLREGULAMENTO);
    if($ok->msgcode != ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO){
        return $ok;
    }

    // Efetua validações no campo $dto->premio com tamanho CampanhaSorteioConstantes::LEN_PREMIO
    $ok = $this->validarTamanhoCampo($dto->premio, CampanhaSorteioConstantes::LEN_PREMIO, CampanhaSorteioConstantes::DESC_PREMIO);
    if($ok->msgcode != ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO){
        return $ok;
    }

    // Efetua validações no campo $dto->dataComecoSorteio com tamanho CampanhaSorteioConstantes::LEN_DATACOMECOSORTEIO
    $ok = $this->validarTamanhoCampo($dto->dataComecoSorteio, CampanhaSorteioConstantes::LEN_DATACOMECOSORTEIO, CampanhaSorteioConstantes::DESC_DATACOMECOSORTEIO);
    if($ok->msgcode != ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO){
        return $ok;
    }

    // Efetua validações no campo $dto->dataFimSorteio com tamanho CampanhaSorteioConstantes::LEN_DATAFIMSORTEIO
    $ok = $this->validarTamanhoCampo($dto->dataFimSorteio, CampanhaSorteioConstantes::LEN_DATAFIMSORTEIO, CampanhaSorteioConstantes::DESC_DATAFIMSORTEIO);
    if($ok->msgcode != ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO){
        return $ok;
    }

    // Efetua validações no campo $dto->maxTickets com tamanho CampanhaSorteioConstantes::LEN_MAXTICKETS
    $ok = $this->validarTamanhoCampo($dto->maxTickets, CampanhaSorteioConstantes::LEN_MAXTICKETS, CampanhaSorteioConstantes::DESC_MAXTICKETS);
    if($ok->msgcode != ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO){
        return $ok;
    }

    // Efetua validações no campo $dto->status com tamanho CampanhaSorteioConstantes::LEN_STATUS
    $ok = $this->validarTamanhoCampo($dto->status, CampanhaSorteioConstantes::LEN_STATUS, CampanhaSorteioConstantes::DESC_STATUS);
    if($ok->msgcode != ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO){
        return $ok;
    }

    // Efetua validações no campo $dto->dataCadastro com tamanho CampanhaSorteioConstantes::LEN_DATACADASTRO
    $ok = $this->validarTamanhoCampo($dto->dataCadastro, CampanhaSorteioConstantes::LEN_DATACADASTRO, CampanhaSorteioConstantes::DESC_DATACADASTRO);
    if($ok->msgcode != ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO){
        return $ok;
    }

    // Efetua validações no campo $dto->dataAtualizacao com tamanho CampanhaSorteioConstantes::LEN_DATAATUALIZACAO
    $ok = $this->validarTamanhoCampo($dto->dataAtualizacao, CampanhaSorteioConstantes::LEN_DATAATUALIZACAO, CampanhaSorteioConstantes::DESC_DATAATUALIZACAO);
    if($ok->msgcode != ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO){
        return $ok;
    }


    $dto->status = ConstantesVariavel::STATUS_ATIVO;
    $dao = $daofactory->getCampanhaSorteioDAO($daofactory);

    if (!$dao->insert($dto)) {
        $retorno = new DTOPadrao();
        $retorno->msgcode = ConstantesMensagem::ERRO_CRUD_INSERIR_REGISTRO;
        $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);
    }

    return $retorno;
}

/**
*
* listarCampanhaSorteioPorStatus() - Usado para invocar a interface de acesso aos dados (DAO) CampanhaSorteioDAO de forma geral
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

    public function listarCampanhaSorteioPorStatus($daofactory, $status, $pag, $qtde, $coluna, $ordem)
    {
        $retorno = new DTOPaginacao();
        $retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
        $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);

        $dao = $daofactory->getCampanhaSorteioDAO($daofactory);
          $retorno->pagina = $pag;
        $retorno->itensPorPagina = ($qtde == 0 
        ? (int) VariavelCache::getInstance()->getVariavel(ConstantesVariavel::MAXIMO_LINHAS_POR_PAGINA_DEFAULT)
        : $qtde);
          $retorno->totalPaginas = ceil($dao->countCampanhaSorteioPorStatus($status) / $retorno->itensPorPagina);

          if($pag > $retorno->totalPaginas) {
               $retorno->msgcode = ConstantesMensagem::NAO_EXISTEM_MAIS_PAGINAS_APRESENTAR;
               $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);
               return $retorno;
        }
        $retorno->lst = $dao->listCampanhaSorteioPorStatus($status, $pag, $qtde, $coluna, $ordem);

          return $retorno;
     }






/**
*
* atualizarId_CampanhaPorPK() - Usado para invocar a classe de negócio CampanhaSorteioBusinessImpl de forma geral
* realizar uma atualização de ID da campanha diretamente na tabela CAMPANHA_SORTEIO campo CAMP_ID
* @param $daofactory
* @param $id
* @param $id_campanha
* @return CampanhaSorteioDTO
*
* 
*/
    public function atualizarId_CampanhaPorPK($daofactory,$id_campanha,$id)
    {
        $dao = $daofactory->getCampanhaSorteioDAO($daofactory);

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
* atualizarNomePorPK() - Usado para invocar a classe de negócio CampanhaSorteioBusinessImpl de forma geral
* realizar uma atualização de Nome do sorteio diretamente na tabela CAMPANHA_SORTEIO campo CASO_TX_NOME
* @param $daofactory
* @param $id
* @param $nome
* @return CampanhaSorteioDTO
*
* 
*/
    public function atualizarNomePorPK($daofactory,$nome,$id)
    {
        $dao = $daofactory->getCampanhaSorteioDAO($daofactory);

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
* atualizarUrlregulamentoPorPK() - Usado para invocar a classe de negócio CampanhaSorteioBusinessImpl de forma geral
* realizar uma atualização de URL regulamento do sorteio diretamente na tabela CAMPANHA_SORTEIO campo CASO_TX_URL_REGULAMENTO
* @param $daofactory
* @param $id
* @param $urlRegulamento
* @return CampanhaSorteioDTO
*
* 
*/
    public function atualizarUrlregulamentoPorPK($daofactory,$urlRegulamento,$id)
    {
        $dao = $daofactory->getCampanhaSorteioDAO($daofactory);

        // resposta padrão
        $retorno = new DTOPadrao();

        if($dao->updateUrlregulamento($id, $urlRegulamento)){   
            $retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
        }       

        // Obtem o texto da mensagem em razão do código de retorno
        $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);

        return $retorno;
    }

/**
*
* atualizarPremioPorPK() - Usado para invocar a classe de negócio CampanhaSorteioBusinessImpl de forma geral
* realizar uma atualização de Prêmio do sorteio diretamente na tabela CAMPANHA_SORTEIO campo CASO_TX_PREMIO
* @param $daofactory
* @param $id
* @param $premio
* @return CampanhaSorteioDTO
*
* 
*/
    public function atualizarPremioPorPK($daofactory,$premio,$id)
    {
        $dao = $daofactory->getCampanhaSorteioDAO($daofactory);

        // resposta padrão
        $retorno = new DTOPadrao();

        if($dao->updatePremio($id, $premio)){   
            $retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
        }       

        // Obtem o texto da mensagem em razão do código de retorno
        $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);

        return $retorno;
    }

/**
*
* atualizarDatacomecosorteioPorPK() - Usado para invocar a classe de negócio CampanhaSorteioBusinessImpl de forma geral
* realizar uma atualização de Data de início diretamente na tabela CAMPANHA_SORTEIO campo CASO_DT_INICIO
* @param $daofactory
* @param $id
* @param $dataComecoSorteio
* @return CampanhaSorteioDTO
*
* 
*/
    public function atualizarDatacomecosorteioPorPK($daofactory,$dataComecoSorteio,$id)
    {
        $dao = $daofactory->getCampanhaSorteioDAO($daofactory);

        // resposta padrão
        $retorno = new DTOPadrao();

        if($dao->updateDatacomecosorteio($id, $dataComecoSorteio)){   
            $retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
        }       

        // Obtem o texto da mensagem em razão do código de retorno
        $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);

        return $retorno;
    }

/**
*
* atualizarDatafimsorteioPorPK() - Usado para invocar a classe de negócio CampanhaSorteioBusinessImpl de forma geral
* realizar uma atualização de Data de término diretamente na tabela CAMPANHA_SORTEIO campo CASO_DT_TERMINO
* @param $daofactory
* @param $id
* @param $dataFimSorteio
* @return CampanhaSorteioDTO
*
* 
*/
    public function atualizarDatafimsorteioPorPK($daofactory,$dataFimSorteio,$id)
    {
        $dao = $daofactory->getCampanhaSorteioDAO($daofactory);

        // resposta padrão
        $retorno = new DTOPadrao();

        if($dao->updateDatafimsorteio($id, $dataFimSorteio)){   
            $retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
        }       

        // Obtem o texto da mensagem em razão do código de retorno
        $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);

        return $retorno;
    }

/**
*
* atualizarMaxticketsPorPK() - Usado para invocar a classe de negócio CampanhaSorteioBusinessImpl de forma geral
* realizar uma atualização de Máximo de tickets diretamente na tabela CAMPANHA_SORTEIO campo CASO_NU_MAX_TICKET
* @param $daofactory
* @param $id
* @param $maxTickets
* @return CampanhaSorteioDTO
*
* 
*/
    public function atualizarMaxticketsPorPK($daofactory,$maxTickets,$id)
    {
        $dao = $daofactory->getCampanhaSorteioDAO($daofactory);

        // resposta padrão
        $retorno = new DTOPadrao();

        if($dao->updateMaxtickets($id, $maxTickets)){   
            $retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
        }       

        // Obtem o texto da mensagem em razão do código de retorno
        $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);

        return $retorno;
    }


/**
*
* pesquisarPorId_Campanha() - Usado para invocar a classe de negócio CampanhaSorteioBusinessImpl de forma geral
* realizar uma busca de ID da campanha diretamente na tabela CAMPANHA_SORTEIO campo CAMP_ID
*
* @param $id_campanha
* @return CampanhaSorteioDTO
*
* 
*/
    public function pesquisarPorId_Campanha($daofactory,$id_campanha)
    { 
        $dao = $daofactory->getCampanhaSorteioDAO($daofactory);
        return $dao->loadId_Campanha($id_campanha);
    }

/**
*
* pesquisarPorNome() - Usado para invocar a classe de negócio CampanhaSorteioBusinessImpl de forma geral
* realizar uma busca de Nome do sorteio diretamente na tabela CAMPANHA_SORTEIO campo CASO_TX_NOME
*
* @param $nome
* @return CampanhaSorteioDTO
*
* 
*/
    public function pesquisarPorNome($daofactory,$nome)

    { 
        $dao = $daofactory->getCampanhaSorteioDAO($daofactory);
        return $dao->loadNome($nome);
    }

/**
*
* pesquisarPorUrlregulamento() - Usado para invocar a classe de negócio CampanhaSorteioBusinessImpl de forma geral
* realizar uma busca de URL regulamento do sorteio diretamente na tabela CAMPANHA_SORTEIO campo CASO_TX_URL_REGULAMENTO
*
* @param $urlRegulamento
* @return CampanhaSorteioDTO
*
* 
*/
    public function pesquisarPorUrlregulamento($daofactory,$urlRegulamento)

    { 
        $dao = $daofactory->getCampanhaSorteioDAO($daofactory);
        return $dao->loadUrlregulamento($urlRegulamento);
    }

/**
*
* pesquisarPorPremio() - Usado para invocar a classe de negócio CampanhaSorteioBusinessImpl de forma geral
* realizar uma busca de Prêmio do sorteio diretamente na tabela CAMPANHA_SORTEIO campo CASO_TX_PREMIO
*
* @param $premio
* @return CampanhaSorteioDTO
*
* 
*/
    public function pesquisarPorPremio($daofactory,$premio)

    { 
        $dao = $daofactory->getCampanhaSorteioDAO($daofactory);
        return $dao->loadPremio($premio);
    }

/**
*
* pesquisarPorDatacomecosorteio() - Usado para invocar a classe de negócio CampanhaSorteioBusinessImpl de forma geral
* realizar uma busca de Data de início diretamente na tabela CAMPANHA_SORTEIO campo CASO_DT_INICIO
*
* @param $dataComecoSorteio
* @return CampanhaSorteioDTO
*
* 
*/
    public function pesquisarPorDatacomecosorteio($daofactory,$dataComecoSorteio)

    { 
        $dao = $daofactory->getCampanhaSorteioDAO($daofactory);
        return $dao->loadDatacomecosorteio($dataComecoSorteio);
    }

/**
*
* pesquisarPorDatafimsorteio() - Usado para invocar a classe de negócio CampanhaSorteioBusinessImpl de forma geral
* realizar uma busca de Data de término diretamente na tabela CAMPANHA_SORTEIO campo CASO_DT_TERMINO
*
* @param $dataFimSorteio
* @return CampanhaSorteioDTO
*
* 
*/
    public function pesquisarPorDatafimsorteio($daofactory,$dataFimSorteio)

    { 
        $dao = $daofactory->getCampanhaSorteioDAO($daofactory);
        return $dao->loadDatafimsorteio($dataFimSorteio);
    }

/**
*
* pesquisarPorMaxtickets() - Usado para invocar a classe de negócio CampanhaSorteioBusinessImpl de forma geral
* realizar uma busca de Máximo de tickets diretamente na tabela CAMPANHA_SORTEIO campo CASO_NU_MAX_TICKET
*
* @param $maxTickets
* @return CampanhaSorteioDTO
*
* 
*/
    public function pesquisarPorMaxtickets($daofactory,$maxTickets)

    { 
        $dao = $daofactory->getCampanhaSorteioDAO($daofactory);
        return $dao->loadMaxtickets($maxTickets);
    }


/**
*
* listarCampanhaSorteioUsuaIdPorStatus() - Usado para invocar a interface de acesso aos dados (DAO) CampanhaSorteioDAO de forma geral
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

    public function listarCampanhaSorteioPorUsuaIdStatus($daofactory, $usuaid, $status, $pag, $qtde, $coluna, $ordem)
    {
        $retorno = new DTOPaginacao();
        $retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
        $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);

        $dao = $daofactory->getCampanhaSorteioDAO($daofactory);
          $retorno->pagina = $pag;
        $retorno->itensPorPagina = ($qtde == 0 
        ? (int) VariavelCache::getInstance()->getVariavel(ConstantesVariavel::MAXIMO_LINHAS_POR_PAGINA_DEFAULT)
        : $qtde);
          $retorno->totalPaginas = ceil($dao->countCampanhaSorteioPorUsuaIdStatus($usuaid, $status) / $retorno->itensPorPagina);

          if($pag > $retorno->totalPaginas) {
               $retorno->msgcode = ConstantesMensagem::NAO_EXISTEM_MAIS_PAGINAS_APRESENTAR;
               $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);
               return $retorno;
        }
        $retorno->lst = $dao->listCampanhaSorteioPorUsuaIdStatus($usuaid, $status, $pag, $qtde, $coluna, $ordem);

          return $retorno;
     }

/**
*
* listarCampanhaSorteioCampIdPorStatus() - Usado para invocar a interface de acesso aos dados (DAO) CampanhaSorteioDAO de forma geral
* realizar lista paginada de registros dos registros do usuário logado com uma instância de PaginacaoDTO
*
* @param $daofactory
* @param $campid
* @param $status
* @param $pag
* @param $qtde
* @param $coluna
* @param $ordem
* @return $PaginacaoDTO
*/

public function listarCampanhaSorteioPorCampIdStatus($daofactory, $campid, $status, $pag, $qtde, $coluna, $ordem)
{
    $retorno = new DTOPaginacao();
    $retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
    $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);

    $dao = $daofactory->getCampanhaSorteioDAO($daofactory);
    $retorno->pagina = $pag;
    $retorno->itensPorPagina = ($qtde == 0 
    ? (int) VariavelCache::getInstance()->getVariavel(ConstantesVariavel::MAXIMO_LINHAS_POR_PAGINA_DEFAULT)
    : $qtde);
      $retorno->totalPaginas = ceil($dao->countCampanhaSorteioPorCampIdStatus($campid, $status) / $retorno->itensPorPagina);

      if($pag > $retorno->totalPaginas) {
           $retorno->msgcode = ConstantesMensagem::NAO_EXISTEM_MAIS_PAGINAS_APRESENTAR;
           $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);
           return $retorno;
    }
    $retorno->lst = $dao->listCampanhaSorteioPorCampIdStatus($campid, $status, $pag, $qtde, $coluna, $ordem);

      return $retorno;
 }


/**
*
* listarCampanhaSorteioPorCampId() - Usado para invocar a interface de acesso aos dados (DAO) CampanhaSorteioDAO de forma geral
* realizar lista paginada de registros dos registros do usuário logado com uma instância de PaginacaoDTO
*
* @param $daofactory
* @param $campid
* @param $pag
* @param $qtde
* @param $coluna
* @param $ordem
* @return $PaginacaoDTO
*/

public function listarCampanhaSorteioPorCampId($daofactory, $campid, $pag, $qtde, $coluna, $ordem)
{
    $retorno = new DTOPaginacao();
    $retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
    $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);

    $dao = $daofactory->getCampanhaSorteioDAO($daofactory);
    $retorno->pagina = $pag;
    $retorno->itensPorPagina = ($qtde == 0 
    ? (int) VariavelCache::getInstance()->getVariavel(ConstantesVariavel::MAXIMO_LINHAS_POR_PAGINA_DEFAULT)
    : $qtde);
      $retorno->totalPaginas = ceil($dao->countCampanhaSorteioPorCampId($campid) / $retorno->itensPorPagina);

      if($pag > $retorno->totalPaginas) {
           $retorno->msgcode = ConstantesMensagem::NAO_EXISTEM_MAIS_PAGINAS_APRESENTAR;
           $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);
           return $retorno;
    }
    $retorno->lst = $dao->listCampanhaSorteioPorCampId($campid, $pag, $qtde, $coluna, $ordem);

      return $retorno;
 }


/**
* validarTamanhoCampo()
*
* Validador de tamanho de campos CampanhaSorteioDTO
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
