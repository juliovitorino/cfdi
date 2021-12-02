<?php 

// importar dependencias
require_once 'UsuarioCampanhaSorteioBusiness.php';
require_once 'UsuarioCampanhaSorteioConstantes.php';
require_once 'UsuarioCampanhaSorteioHelper.php';
require_once '../dto/DTOPadrao.php';
require_once '../dto/DTOPaginacao.php';

require_once '../variavel/ConstantesVariavel.php';
require_once '../variavel/VariavelCache.php';
require_once '../campanhasorteio/CampanhaSorteioHelper.php';
require_once '../usuarios/UsuarioHelper.php';
require_once '../campanhasorteionumerospermitidos/CampanhaSorteioNumerosPermitidosBusinessImpl.php';
require_once '../usuariocampanhasorteioticket/UsuarioCampanhaSorteioTicketBusinessImpl.php';
require_once '../usuariocampanhasorteioticket/UsuarioCampanhaSorteioTicketDTO.php';
require_once '../campanha/campanhaBusinessImpl.php';
require_once '../campanhasorteio/CampanhaSorteioBusinessImpl.php';

/**
*
* UsuarioCampanhaSorteioBusinessImpl - Classe de implementação dos métodos de negócio para a interface UsuarioCampanhaSorteioBusiness
* Camada de negócio UsuarioCampanhaSorteio - camada responsável pela lógica de negócios de UsuarioCampanhaSorteio do sistema. 
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
* @since 22/06/2021 08:05:45
*
*/

class UsuarioCampanhaSorteioBusinessImpl implements UsuarioCampanhaSorteioBusiness
{
    
    function __construct()  {   }

/**
* carregar() - Carrega apenas um registro com base no campo id = (USUARIO_CAMPANHA_SORTEIO::USCS_ID)
* @param $daofactory
* @param $dto
* @return $dto
*/ 
    public function carregar($daofactory, $dto) {   }

/**
* listarTudo() - Lista todos os registros provenientes de USUARIO_CAMPANHA_SORTEIO sem critério de paginação
* @param $daofactory
* @return List<UsuarioCampanhaSorteioDTO>[]
*/ 
    public function listarTudo($daofactory) {   }

/**
* pesquisarMaxPKAtivoIdusuarioIdcampanhaPorStatus() - Carrega apenas um registro com base no idUsuario  e status para buscar a MAIOR PK
* @param $daofactory
* @param $status
* @return UsuarioCampanhaSorteioDTO
*/ 
public function  pesquisarMaxPKAtivoIdusuarioIdcampanhaPorStatus($daofactory, $idUsuario, $idCampanhaSorteio, $status)
{ 
    $dao = $daofactory->getUsuarioCampanhaSorteioDAO($daofactory);
    $maxid = $dao->loadMaxIdusuarioIdcampanhaPK($idUsuario,$idCampanhaSorteio,$status);
    return $this->carregarPorID($daofactory, $maxid);
}


/**
* pesquisarMaxPKAtivoIdusuarioPorStatus() - Carrega apenas um registro com base no idUsuario  e status para buscar a MAIOR PK
* @param $daofactory
* @param $status
* @return UsuarioCampanhaSorteioDTO
*/ 
    public function pesquisarMaxPKAtivoIdusuarioPorStatus($daofactory, $idUsuario,$status)
    { 
        $dao = $daofactory->getUsuarioCampanhaSorteioDAO($daofactory);
        $maxid = $dao->loadMaxIdusuarioPK($idUsuario,$status);
        return $this->carregarPorID($daofactory, $maxid);
    }

/**
* atualizar() - atualiza apenas um registro com base no dto UsuarioCampanhaSorteioDTO->id
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


        $dao = $daofactory->getUsuarioCampanhaSorteioDAO($daofactory);
        if(!$dao->update($dto)){
           $retorno->msgcode = ConstantesMensagem::ERRO_CRUD_ATUALIZAR_REGISTRO;
           $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);
    
        }
        // retorna situação
        return $retorno;

    }

/**
* deletar() - excluir fisicamente um registro com base no dto UsuarioCampanhaSorteioDTO->id
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
        $dao = $daofactory->getUsuarioCampanhaSorteioDAO($daofactory);

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
* @return List<UsuarioCampanhaSorteioDTO>[]
* @deprecated
*/ 

    public function listarPagina($daofactory, $pag, $qtde)  
    {   
        $dao = $daofactory->getUsuarioCampanhaSorteioDAO($daofactory);
        return $dao->listPagina($pag, $qtde);
    }

/**
* carregarPorID() - Carrega APENAS um registro usando a id como item de busca
* na tabela USUARIO_CAMPANHA_SORTEIO usando a Primary Key USCS_ID
*
* @param $daofactory
* @param $id
* @param $qtde
*
* @return UsuarioCampanhaSorteioDTO
*/ 
    public function carregarPorID($daofactory, $id)
    { 
        $dao = $daofactory->getUsuarioCampanhaSorteioDAO($daofactory);
        $uscsdto = $dao->loadPK($id);
        if(is_null($uscsdto)){
            return NULL;
        }

        // Popular a campanha sorteio
        $casobo = new CampanhaSorteioBusinessImpl();
        $uscsdto->campanhaSorteio = $casobo->carregarPorID($daofactory, $uscsdto->idCampanhaSorteio);

        // Popular a campanha
        $campbo = new CampanhaBusinessImpl();
        $uscsdto->campanha = $campbo->carregarPorID($daofactory, $uscsdto->campanhaSorteio->id_campanha);
        
        // Popular a dados do dono da campanha
        $usuabo = new UsuarioBusinessImpl();
        $uscsdto->usuario = $usuabo->carregarPorID($daofactory, $uscsdto->campanha->id_usuario);
        
        return $uscsdto;

    }

/**
* atualizarStatus() - atualizar o campo de STATUS utilizando a id como item de busca
* na tabela USUARIO_CAMPANHA_SORTEIO usando a Primary Key USCS_ID
*
* @param $daofactory
* @param $id
* @param $status
*
* @return UsuarioCampanhaSorteioDTO
*/ 
    public function atualizarStatus($daofactory, $id, $status)
    {
        $dao = $daofactory->getUsuarioCampanhaSorteioDAO($daofactory);

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
* inserirUsuarioParticipanteCampanhaSorteio() - inserir um registro com base nas regras de negocio
*
* @param $daofactory
* @param $uscsdto
*
* @return DTOPadrao
*/ 
public function inserirUsuarioParticipanteCampanhaSorteio($daofactory, $uscsdto, $ignorarstatus=false)
{ 
    $retorno = new DTOPadrao();
    $retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
    $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);

    // Localiza se a campanha sorteio existe
    $casodto = CampanhaSorteioHelper::getCampanhaSorteioBusiness($daofactory, $uscsdto->idCampanhaSorteio);
    if(is_null($casodto))
    {
        $retorno->msgcode = ConstantesMensagem::CAMPANHA_SORTEIO_INEXISTENTE;
        $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);   
        return $retorno;
    }

    // Localiza se o usuário existe
    $usuadto = UsuarioHelper::getUsuarioBusiness($daofactory, $uscsdto->idUsuario);
    if(is_null($usuadto->id))
    {
        $retorno->msgcode = ConstantesMensagem::USUARIO_NAO_ENCONTRADO;
        $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);   
        return $retorno;
    }
    
    // Se a campanha sorteio não esiver ativa apenas ignora. Não existe inserir.
    if(! $ignorarstatus)
    {
        if($casodto->status != ConstantesVariavel::STATUS_ATIVO) {
            $retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
            $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);
            return $retorno;
        }
    }

    // Verifica se já existe pelo menos registro para esse usuario + campanha sorteio com status ativo 
    // em USUARIO_CAMPANHA_SORTEIO. Se nada for retornado é pra inserir o registro master.
    $uscsdtocheck = $this->pesquisarMaxPKAtivoIdusuarioIdcampanhaPorStatus($daofactory, $usuadto->id,$casodto->id, ConstantesVariavel::STATUS_ATIVO);
    if(is_null($uscsdtocheck)){
        // Inserir o registro validado nas regras de negócio
    
        $dao = $daofactory->getUsuarioCampanhaSorteioDAO($daofactory);
    
        if (!$dao->insert($uscsdto)) {
            $retorno = new DTOPadrao();
            $retorno->msgcode = ConstantesMensagem::ERRO_CRUD_INSERIR_REGISTRO;
            $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);
            return $retorno;
        }
        // Recarrega o registro novo inserido
        $uscsdtocheck = $this->pesquisarMaxPKAtivoIdusuarioIdcampanhaPorStatus($daofactory, $usuadto->id,$casodto->id, ConstantesVariavel::STATUS_ATIVO);

    }

    // Obtem um Ticket Livre desta campanha sorteio, se nada vier apenas ignora a inserção
    // pois o processo de geração de códigos aleatorios ainda não foi rodado.
    $csnpbo = new CampanhaSorteioNumerosPermitidosBusinessImpl();
    $csnpdto = $csnpbo->pesquisarMaxPKAtivoId_CasoPorStatus($daofactory,$casodto->id,ConstantesVariavel::STATUS_ATIVO);
//var_dump($csnpdto);

    if(!is_null($csnpdto))
    {
        $ucstbo = new UsuarioCampanhaSorteioTicketBusinessImpl();
        $ucstdto = new UsuarioCampanhaSorteioTicketDTO();
        $ucstdto->iduscs = (int) $uscsdtocheck->id;
        $ucstdto->ticket = (int) $csnpdto->nrTicketSorteio;
        $ucstdto = $ucstbo->inserir($daofactory, $ucstdto );

        $csnpbo->atualizarStatus($daofactory, $csnpdto->id, ConstantesVariavel::STATUS_FINALIZADO);

    }



    return $retorno;
}




/**
* inserir() - inserir um registro com base no UsuarioCampanhaSorteioDTO. Alguns atributos dentro do DTO
* serão ignorados caso estejam populados.
*
* Atributos da classe UsuarioCampanhaSorteioDTO sumariamente IGNORADOS por este método MESMO que estejam preenchidos:
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

    // Efetua validações no campo $dto->id com tamanho UsuarioCampanhaSorteioConstantes::LEN_ID
    $ok = $this->validarTamanhoCampo($dto->id, UsuarioCampanhaSorteioConstantes::LEN_ID, UsuarioCampanhaSorteioConstantes::DESC_ID);
    if($ok->msgcode != ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO){
        return $ok;
    }

    // Efetua validações no campo $dto->idUsuario com tamanho UsuarioCampanhaSorteioConstantes::LEN_IDUSUARIO
    $ok = $this->validarTamanhoCampo($dto->idUsuario, UsuarioCampanhaSorteioConstantes::LEN_IDUSUARIO, UsuarioCampanhaSorteioConstantes::DESC_IDUSUARIO);
    if($ok->msgcode != ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO){
        return $ok;
    }

    // Efetua validações no campo $dto->idCampanhaSorteio com tamanho UsuarioCampanhaSorteioConstantes::LEN_IDCAMPANHASORTEIO
    $ok = $this->validarTamanhoCampo($dto->idCampanhaSorteio, UsuarioCampanhaSorteioConstantes::LEN_IDCAMPANHASORTEIO, UsuarioCampanhaSorteioConstantes::DESC_IDCAMPANHASORTEIO);
    if($ok->msgcode != ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO){
        return $ok;
    }

    // Efetua validações no campo $dto->status com tamanho UsuarioCampanhaSorteioConstantes::LEN_STATUS
    $ok = $this->validarTamanhoCampo($dto->status, UsuarioCampanhaSorteioConstantes::LEN_STATUS, UsuarioCampanhaSorteioConstantes::DESC_STATUS);
    if($ok->msgcode != ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO){
        return $ok;
    }

    // Efetua validações no campo $dto->dataCadastro com tamanho UsuarioCampanhaSorteioConstantes::LEN_DATACADASTRO
    $ok = $this->validarTamanhoCampo($dto->dataCadastro, UsuarioCampanhaSorteioConstantes::LEN_DATACADASTRO, UsuarioCampanhaSorteioConstantes::DESC_DATACADASTRO);
    if($ok->msgcode != ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO){
        return $ok;
    }

    // Efetua validações no campo $dto->dataAtualizacao com tamanho UsuarioCampanhaSorteioConstantes::LEN_DATAATUALIZACAO
    $ok = $this->validarTamanhoCampo($dto->dataAtualizacao, UsuarioCampanhaSorteioConstantes::LEN_DATAATUALIZACAO, UsuarioCampanhaSorteioConstantes::DESC_DATAATUALIZACAO);
    if($ok->msgcode != ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO){
        return $ok;
    }


    $dto->status = ConstantesVariavel::STATUS_ATIVO;
    $dao = $daofactory->getUsuarioCampanhaSorteioDAO($daofactory);

    if (!$dao->insert($dto)) {
        $retorno = new DTOPadrao();
        $retorno->msgcode = ConstantesMensagem::ERRO_CRUD_INSERIR_REGISTRO;
        $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);
    }

    return $retorno;
}

/**
*
* listarUsuarioCampanhaSorteioPorStatus() - Usado para invocar a interface de acesso aos dados (DAO) UsuarioCampanhaSorteioDAO de forma geral
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

    public function listarUsuarioCampanhaSorteioPorStatus($daofactory, $status, $pag, $qtde, $coluna, $ordem)
    {   
        $retorno = new DTOPaginacao();
        $retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
        $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);

        $dao = $daofactory->getUsuarioCampanhaSorteioDAO($daofactory);
        $retorno->pagina = $pag;
        $retorno->itensPorPagina = ($qtde == 0 
        ? (int) VariavelCache::getInstance()->getVariavel(ConstantesVariavel::MAXIMO_LINHAS_POR_PAGINA_DEFAULT)
        : $qtde);
        $retorno->totalPaginas = ceil($dao->countUsuarioCampanhaSorteioPorStatus($status) / $retorno->itensPorPagina);

        if($pag > $retorno->totalPaginas) {
            $retorno->msgcode = ConstantesMensagem::NAO_EXISTEM_MAIS_PAGINAS_APRESENTAR;
            $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);
            return $retorno;
        }
        $retorno->lst = $dao->listUsuarioCampanhaSorteioPorStatus($status, $pag, $retorno->itensPorPagina, $coluna, $ordem);

        return $retorno;
    }






/**
*
* atualizarIdusuarioPorPK() - Usado para invocar a classe de negócio UsuarioCampanhaSorteioBusinessImpl de forma geral
* realizar uma atualização de ID do usuário diretamente na tabela USUARIO_CAMPANHA_SORTEIO campo USUA_ID
* @param $daofactory
* @param $id
* @param $idUsuario
* @return UsuarioCampanhaSorteioDTO
*
* 
*/
    public function atualizarIdusuarioPorPK($daofactory,$idUsuario,$id)
    {
        $dao = $daofactory->getUsuarioCampanhaSorteioDAO($daofactory);

        // resposta padrão
        $retorno = new DTOPadrao();

        if($dao->updateIdusuario($id, $idUsuario)){   
            $retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
        }       

        // Obtem o texto da mensagem em razão do código de retorno
        $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);

        return $retorno;
    }

/**
*
* atualizarIdcampanhasorteioPorPK() - Usado para invocar a classe de negócio UsuarioCampanhaSorteioBusinessImpl de forma geral
* realizar uma atualização de ID Campanha Sorteio diretamente na tabela USUARIO_CAMPANHA_SORTEIO campo CASO_ID
* @param $daofactory
* @param $id
* @param $idCampanhaSorteio
* @return UsuarioCampanhaSorteioDTO
*
* 
*/
    public function atualizarIdcampanhasorteioPorPK($daofactory,$idCampanhaSorteio,$id)
    {
        $dao = $daofactory->getUsuarioCampanhaSorteioDAO($daofactory);

        // resposta padrão
        $retorno = new DTOPadrao();

        if($dao->updateIdcampanhasorteio($id, $idCampanhaSorteio)){   
            $retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
        }       

        // Obtem o texto da mensagem em razão do código de retorno
        $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);

        return $retorno;
    }


/**
*
* pesquisarPorIdusuario() - Usado para invocar a classe de negócio UsuarioCampanhaSorteioBusinessImpl de forma geral
* realizar uma busca de ID do usuário diretamente na tabela USUARIO_CAMPANHA_SORTEIO campo USUA_ID
*
* @param $idUsuario
* @return UsuarioCampanhaSorteioDTO
*
* 
*/
    public function pesquisarPorIdusuario($daofactory,$idUsuario)
    { 
        $dao = $daofactory->getUsuarioCampanhaSorteioDAO($daofactory);
        return $dao->loadIdusuario($idUsuario);
    }

/**
*
* pesquisarPorIdcampanhasorteio() - Usado para invocar a classe de negócio UsuarioCampanhaSorteioBusinessImpl de forma geral
* realizar uma busca de ID Campanha Sorteio diretamente na tabela USUARIO_CAMPANHA_SORTEIO campo CASO_ID
*
* @param $idCampanhaSorteio
* @return UsuarioCampanhaSorteioDTO
*
* 
*/
    public function pesquisarPorIdcampanhasorteio($daofactory,$idCampanhaSorteio)

    { 
        $dao = $daofactory->getUsuarioCampanhaSorteioDAO($daofactory);
        return $dao->loadIdcampanhasorteio($idCampanhaSorteio);
    }


/**
*
* listarUsuarioCampanhaSorteioUsuaIdPorStatus() - Usado para invocar a interface de acesso aos dados (DAO) UsuarioCampanhaSorteioDAO de forma geral
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

    public function listarUsuarioCampanhaSorteioPorUsuaIdStatus($daofactory, $usuaid, $status, $pag, $qtde, $coluna, $ordem)
    {   
        $retorno = new DTOPaginacao();
        $retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
        $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);

        $dao = $daofactory->getUsuarioCampanhaSorteioDAO($daofactory);
        $retorno->pagina = $pag;
        $retorno->itensPorPagina = ($qtde == 0 
        ? (int) VariavelCache::getInstance()->getVariavel(ConstantesVariavel::MAXIMO_LINHAS_POR_PAGINA_DEFAULT)
        : $qtde);
        $retorno->totalPaginas = ceil($dao->countUsuarioCampanhaSorteioPorUsuaIdStatus($usuaid, $status) / $retorno->itensPorPagina);

        if($pag > $retorno->totalPaginas) {
            $retorno->msgcode = ConstantesMensagem::NAO_EXISTEM_MAIS_PAGINAS_APRESENTAR;
            $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);
            return $retorno;
        }
        $retorno->lst = $dao->listUsuarioCampanhaSorteioPorUsuaIdStatus($usuaid, $status, $pag, $retorno->itensPorPagina, $coluna, $ordem);

        // Recarregar DTO completo campanha Sorteio e Campanha
        if(count($retorno->lst) > 0)
        {
            $novalst = [];
            foreach ($retorno->lst as $key => $dto) {
//echo "<br>********* vou recarregar os elementos **************<br>"    ;            
                $novodto = $this->carregarPorID($daofactory,$dto->id);
//echo "<br>********* vou mostrar o retorno **************<br>"    ;            
                if( ! is_null($novodto))
                {
                    array_push($novalst, $novodto);
                }
            }
            $retorno->lst = $novalst;
        }

        return $retorno;
    }

/**
* validarTamanhoCampo()
*
* Validador de tamanho de campos UsuarioCampanhaSorteioDTO
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
