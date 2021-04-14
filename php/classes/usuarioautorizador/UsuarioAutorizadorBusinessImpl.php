<?php 

// importar dependencias
require_once 'UsuarioAutorizadorBusiness.php';

require_once '../dto/DTOPadrao.php';
require_once '../dto/DTOPaginacao.php';

require_once '../variavel/ConstantesVariavel.php';
require_once '../variavel/VariavelCache.php';
require_once '../usuarios/UsuarioHelper.php';
require_once '../campanha/campanhaBusinessImpl.php';
require_once '../campanha/CampanhaHelper.php';

require_once '../usuarios/UsuarioHelper.php';

/**********************************************************
===========================================================

 #####  #     #   ###   ######     #    ######   ##### 
#     # #     #    #    #     #   # #   #     # #     #
#       #     #    #    #     #  #   #  #     # #     #
#       #     #    #    #     # #     # #     # #     #
#       #     #    #    #     # ####### #     # #     #
#     # #     #    #    #     # #     # #     # #     #
 #####   #####    ###   ######  #     # ######   #####
 
===========================================================
CÓDIGO SOFREU ALTERAÇÕES DE PROFUNDAS, NÃO USE O GERADOR
AUTOMÁTICO PARA SUBSTITUIR O CÓDIGO AQUI EXISTENTE.
TODO O SISTEMA PODE ENTRAR EM COLAPSO.
===========================================================
***********************************************************/ 

/**
*
* UsuarioAutorizadorBusinessImpl - Classe de implementação dos métodos de negócio para a interface UsuarioAutorizadorBusiness
* Camada de negócio UsuarioAutorizador - camada responsável pela lógica de negócios de UsuarioAutorizador do sistema. 
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
* @author Julio Cesar Vitorino
* @since 09/09/2019 12:52:36
*
*/

class UsuarioAutorizadorBusinessImpl implements UsuarioAutorizadorBusiness
{
    
    function __construct()  {   }

/**
* carregar() - Carrega apenas um registro com base no campo id = (USUARIO_AUTORIZADOR::USAU_ID)
* @param $daofactory
* @param $dto
* @return $dto
*/ 
    public function carregar($daofactory, $dto) {   }

/**
* listarTudo() - Lista todos os registros provenientes de USUARIO_AUTORIZADOR sem critério de paginação
* @param $daofactory
* @return List<UsuarioAutorizadorDTO>[]
*/ 
    public function listarTudo($daofactory) {   }

/**
*
* habilitarUsuarioAutorizador() - Habilitar um usuário já previamente criado para executar algumas
* atividades determinadas pelo dono da campanha
*
* @param $daofactory
* @param UsuarioAutorizadorDTO
* @param $ishabilitar
* @return UsuarioAutorizadorDTO
*
*/

public function habilitarUsuarioAutorizador($daofactory, $dto, $ishabilitar)
{
    // retorno padrão
    $dto->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
    $dto->msgcodeString = MensagemCache::getInstance()->getMensagem($dto->msgcode);

    // Verificar regras de negócio
    $usaudto = UsuarioAutorizadorHelper::getUsuarioAutorizadorBusiness($daofactory, $dto->id);
    if($usaudto == NULL || $usaudto->id == NULL){
        $dto->msgcode = ConstantesMensagem::INFORMACAO_NAO_LOCALIZADA;
        $dto->msgcodeString = MensagemCache::getInstance()->getMensagem($dto->msgcode);
        return $dto;
    }
    
    // É o dono da campanha que emitiu a requisição?
    $campdto = CampanhaHelper::getCampanhaBusiness($daofactory, $dto->id_campanha);
    if($dto->id_autorizador != $campdto->id_usuario){
        $dto->msgcode = ConstantesMensagem::NAO_FOI_POSSIVEL_HABILITAR_USUARIO_AUTORIZADOR;
        $dto->msgcodeString = MensagemCache::getInstance()->getMensagem($dto->msgcode);
        return $dto;
    }

    // Já está ativado?
    if($usaudto->status == ConstantesVariavel::STATUS_ATIVO && $ishabilitar){
        $dto->msgcode = ConstantesMensagem::AUTORIZACAO_ESTA_ATIVA;
        $dto->msgcodeString = MensagemCache::getInstance()->getMensagem($dto->msgcode);
        return $dto;
    }


    // Realiza o comando de habilitação no banco de dados
    $dao = $daofactory->getUsuarioAutorizadorDAO($daofactory);
    if(!$dao->updateStatus($dto->id, $ishabilitar ? ConstantesVariavel::STATUS_ATIVO : ConstantesVariavel::STATUS_INATIVO)){
        $dto->msgcode = ConstantesMensagem::NAO_FOI_POSSIVEL_HABILITAR_USUARIO_AUTORIZADOR;
        $dto->msgcodeString = MensagemCache::getInstance()->getMensagem($dto->msgcode);
        return $dto;
    }



    return $dto;

}


/**
* PesquisarMaxPKAtivoId_UsuarioCarimbadorPorStatus() - Carrega apenas um registro com base no id_usuario  e status para buscar a MAIOR PK
* @param $daofactory
* @param $id_usuario
* @param $id_campanha
* @param $status
* @return UsuarioAutorizadorDTO
*/ 
public function PesquisarMaxPKAtivoId_UsuarioCarimbadorPorStatus($daofactory, $id_usuario, $id_campanha, $status)
{ 
    $dao = $daofactory->getUsuarioAutorizadorDAO($daofactory);
    $maxid = $dao->loadMaxId_UsuarioCarimbadorPK($id_usuario,$id_campanha,$status);
    return $this->carregarPorID($daofactory, $maxid); 
}


/**
* PesquisarMaxPKAtivoId_UsuarioPorStatus() - Carrega apenas um registro com base no id_usuario  e status para buscar a MAIOR PK
* @param $daofactory
* @param $id_usuario
* @param $id_campanha
* @param $status
* @return UsuarioAutorizadorDTO
*/ 
    public function PesquisarMaxPKAtivoId_UsuarioAutorizadorPorStatus($daofactory, $id_usuario, $id_campanha, $status)
    { 
        $dao = $daofactory->getUsuarioAutorizadorDAO($daofactory);
        $maxid = $dao->loadMaxId_UsuarioAutorizadorPK($id_usuario,$id_campanha,$status);
        return $this->carregarPorID($daofactory, $maxid);
    }


/**
* PesquisarMaxPKAtivoId_UsuarioPorStatus() - Carrega apenas um registro com base no id_usuario  e status para buscar a MAIOR PK
* @param $daofactory
* @param $status
* @return UsuarioAutorizadorDTO
*/ 
    public function PesquisarMaxPKAtivoId_UsuarioPorStatus($daofactory, $id_usuario,$status)
    { 
        $dao = $daofactory->getUsuarioAutorizadorDAO($daofactory);
        $maxid = $dao->loadMaxId_UsuarioPK($id_usuario,$status);
        return $this->carregarPorID($daofactory, $maxid);
    }

/**
* atualizar() - atualiza apenas um registro com base no dto UsuarioAutorizadorDTO->id
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

        // verificar regras de negócio
        if(UsuarioAutorizadorHelper::getTraducaoTipo($dto->tipo) == UsuarioAutorizadorHelper::QUALIFICACAO_DESCONHECIDA ){
            $retorno->msgcode = ConstantesMensagem::TIPO_AUTORIZACAO_INVALIDO;
            $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);
            return $retorno;
        }

        if(UsuarioAutorizadorHelper::getTraducaoAutorizacao($dto->permissao) == UsuarioAutorizadorHelper::TIPO_AUTORIZACAO_DESCONHECIDA ){
            $retorno->msgcode = ConstantesMensagem::TIPO_PERMISSAO_INVALIDO;
            $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);
            return $retorno;
        }

        if(! UsuarioHelper::isUsuarioParceiro($daofactory, $dto->id_autorizador)) {
            $retorno->msgcode = ConstantesMensagem::PERMITIDO_SO_USUARIO_PARCEIRO;
            $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);
            return $retorno;
         }

        // executa a operação
        $dao = $daofactory->getUsuarioAutorizadorDAO($daofactory);
        if(!$dao->update($dto)){
           $retorno->msgcode = ConstantesMensagem::ERRO_CRUD_ATUALIZAR_REGISTRO;
           $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);
           return $retorno;
        }


        // retorna situação
        return $retorno;

    }

/**
* deletar() - excluir fisicamente um registro com base no dto UsuarioAutorizadorDTO->id
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
        $dao = $daofactory->getUsuarioAutorizadorDAO($daofactory);

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
* @return List<UsuarioAutorizadorDTO>[]
* @deprecated
*/ 

    public function listarPagina($daofactory, $pag, $qtde)  
    {   
        $dao = $daofactory->getUsuarioAutorizadorDAO($daofactory);
        return $dao->listPagina($pag, $qtde);
    }

/**
* carregarPorID() - Carrega APENAS um registro usando a id como item de busca
* na tabela USUARIO_AUTORIZADOR usando a Primary Key USAU_ID
*
* @param $daofactory
* @param $id
* @param $qtde
*
* @return UsuarioAutorizadorDTO
*/ 
    public function carregarPorID($daofactory, $id)
    { 
        $dao = $daofactory->getUsuarioAutorizadorDAO($daofactory);
        return $dao->loadPK($id);
    }

/**
* atualizarStatus() - atualizar o campo de STATUS utilizando a id como item de busca
* na tabela USUARIO_AUTORIZADOR usando a Primary Key USAU_ID
*
* @param $daofactory
* @param $id
* @param $status
*
* @return UsuarioAutorizadorDTO
*/ 
    public function atualizarStatus($daofactory, $id, $status)
    {
        $dao = $daofactory->getUsuarioAutorizadorDAO($daofactory);

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
* inserir() - inserir um registro com base no UsuarioAutorizadorDTO. Alguns atributos dentro do DTO
* serão ignorados caso estejam populados.
*
* Atributos da classe UsuarioAutorizadorDTO sumariamente IGNORADOS por este método MESMO que estejam preenchidos:
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
    $ok = $this->validarTamanhoCampo($dto->id, 11, 'ID do usuário autorizado');
    if($ok->msgcode != ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO){
        return $ok;
    }

    // Efetua validações no campo $dto->id_usuario com tamanho 11
    $ok = $this->validarTamanhoCampo($dto->id_usuario, 11, 'ID do usuário');
    if($ok->msgcode != ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO){
        return $ok;
    }

    // Efetua validações no campo $dto->id_autorizador com tamanho 11
    $ok = $this->validarTamanhoCampo($dto->id_autorizador, 11, 'ID do usuário autorizador');
    if($ok->msgcode != ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO){
        return $ok;
    }

    // Efetua validações no campo $dto->id_campanha com tamanho 11
    $ok = $this->validarTamanhoCampo($dto->id_campanha, 11, 'ID da campanha');
    if($ok->msgcode != ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO){
        return $ok;
    }

    // Efetua validações no campo $dto->tipo com tamanho 1
    $ok = $this->validarTamanhoCampo($dto->tipo, 1, 'Tipo de autorização');
    if($ok->msgcode != ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO){
        return $ok;
    }

    // Efetua validações no campo $dto->permissao com tamanho 2
    $ok = $this->validarTamanhoCampo($dto->permissao, 2, 'Qual autorização');
    if($ok->msgcode != ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO){
        return $ok;
    }

    // Efetua validações no campo $dto->dataInicio com tamanho 19
    $ok = $this->validarTamanhoCampo($dto->dataInicio, 19, 'Data Início');
    if($ok->msgcode != ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO){
        return $ok;
    }

    // Efetua validações no campo $dto->dataTermino com tamanho 19
    $ok = $this->validarTamanhoCampo($dto->dataTermino, 19, 'Data Término');
    if($ok->msgcode != ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO){
        return $ok;
    }
    
//var_dump($dto);
    // Verifica se o usuário que está criando uma autorização é o dono campanha, 
    // ou seja, o ÚNICO que pode criar autorizadores é o DONO. Além de ser o DONO
    // ele precisa ter conta PARCEIRO pra fazer essa função
    $campbo = new CampanhaBusinessImpl();
    $campdto = $campbo->carregarPorID($daofactory, $dto->id_campanha);
//var_dump($campdto);    
    if($campdto == NULL || $campdto->id == NULL){
        $campdto->msgcode = ConstantesMensagem::CAMPANHA_INEXISTENTE;
        $campdto->msgcodeString = MensagemCache::getInstance()->getMensagem($campdto->msgcode);
        return $campdto;
    } else {
        if($campdto->id_usuario != $dto->id_autorizador){
            $usuadto = UsuarioHelper::getUsuarioBusinessNoKeys($daofactory, $dto->id_usuario);
            $campdto->msgcode = ConstantesMensagem::AUTORIZACAO_NEGADA;
            $campdto->msgcodeString = MensagemCache::getInstance()->getMensagemParametrizada($campdto->msgcode,[
                "*=nome=*" => $usuadto->apelido,
                "*=funcionalidade=*" => "Criar Autorização",
            ]);
            return $campdto;
        } else {
            $usuadto = UsuarioHelper::getUsuarioBusinessNoKeys($daofactory, $dto->id_autorizador);
            if($usuadto->tipoConta == ConstantesVariavel::CONTA_USUARIO_COMUM){
                $usuadto->msgcode = ConstantesMensagem::PERMITIDO_SO_USUARIO_PARCEIRO ;
                $usuadto->msgcodeString = MensagemCache::getInstance()->getMensagem($usuadto->msgcode);
                return $usuadto;
            }

        }
    }


    $dto->status = ConstantesVariavel::STATUS_ATIVO;
    $dao = $daofactory->getUsuarioAutorizadorDAO($daofactory);

    // ------------------------------------------------------------------------
    // Antes de incluir um novo registro com usuário que será o carimbador 
    // em modo desabilitado (Status = C)
    // devo antes localizar o registro MaxId nessa campanha com Status = A
    // e trocar para Status = I
    // ------------------------------------------------------------------------

    $tmp = $this->PesquisarMaxPKAtivoId_UsuarioCarimbadorPorStatus($daofactory
    , $dto->id_usuario, $dto->id_campanha, ConstantesVariavel::STATUS_ATIVO);

    if($tmp != NULL && $tmp->id != NULL){
        $daotmp = $daofactory->getUsuarioAutorizadorDAO($daofactory);
        if(!$daotmp->updateStatus($tmp->id, ConstantesVariavel::STATUS_INATIVO)){
            $retorno = new DTOPadrao();
            $retorno->msgcode = ConstantesMensagem::ERRO_CRUD_ATUALIZAR_REGISTRO;
            $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);
            return $retorno;
        }
    }

    if (!$dao->insert($dto)) {
        $retorno = new DTOPadrao();
        $retorno->msgcode = ConstantesMensagem::ERRO_CRUD_INSERIR_REGISTRO;
        $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);
    } else {
        // Busca o mais recente por causa do ID

        $retorno = $this->PesquisarMaxPKAtivoId_UsuarioAutorizadorPorStatus($daofactory
        ,$dto->id_autorizador
        ,$dto->id_campanha
        , ConstantesVariavel::STATUS_DESABILITADO);

        $retorno->usuario = UsuarioHelper::getUsuarioBusinessNoKeys($daofactory, $retorno->id_usuario);
        $retorno->autorizador = UsuarioHelper::getUsuarioBusinessNoKeys($daofactory, $retorno->id_autorizador);
        $retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
        $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);
        }

    return $retorno;
}

/**
*
* listarCarimbador() - Usado para invocar a interface de acesso aos dados (DAO) UsuarioAutorizadorDAO de forma geral
* realizar lista paginada de registros com uma instância de PaginacaoDTO
*
* @param $daofactory
* @param $id_usuario
* @param $status
* @param $pag
* @param $qtde
* @param $coluna
* @param $ordem
* @return $PaginacaoDTO
*/

public function listarUsuarioCarimbador($daofactory, $usuaid, $status="A", $pag=1, $qtde=50, $coluna=1, $ordem=0)
{   
    $retorno = new DTOPaginacao();
    $retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
    $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);

    $dao = $daofactory->getUsuarioAutorizadorDAO($daofactory);
    $retorno->pagina = $pag;
    $retorno->itensPorPagina = ($qtde == 0 
    ? (int) VariavelCache::getInstance()->getVariavel(ConstantesVariavel::MAXIMO_LINHAS_POR_PAGINA_DEFAULT)
    : $qtde);
    $retorno->totalPaginas = ceil($dao->countUsuarioCarimbador($usuaid, $status) / $retorno->itensPorPagina);

    if($pag > $retorno->totalPaginas) {
        $retorno->msgcode = ConstantesMensagem::NAO_EXISTEM_MAIS_PAGINAS_APRESENTAR;
        $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);
        return $retorno;
    }
    $retorno->lst = $dao->listUsuarioCarimbador($usuaid, $status, $pag, $qtde, $coluna, $ordem);

    return $retorno;
}





/**
*
* listarUsuarioAutorizadorPorStatus() - Usado para invocar a interface de acesso aos dados (DAO) UsuarioAutorizadorDAO de forma geral
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

    public function listarUsuarioAutorizadorPorStatus($daofactory, $status, $pag, $qtde, $coluna, $ordem)
    {   
        $retorno = new DTOPaginacao();
        $retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
        $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);

        $dao = $daofactory->getUsuarioAutorizadorDAO($daofactory);
        $retorno->pagina = $pag;
        $retorno->itensPorPagina = ($qtde == 0 
        ? (int) VariavelCache::getInstance()->getVariavel(ConstantesVariavel::MAXIMO_LINHAS_POR_PAGINA_DEFAULT)
        : $qtde);
        $retorno->totalPaginas = ceil($dao->countUsuarioAutorizadorPorStatus($status) / $retorno->itensPorPagina);

        if($pag > $retorno->totalPaginas) {
            $retorno->msgcode = ConstantesMensagem::NAO_EXISTEM_MAIS_PAGINAS_APRESENTAR;
            $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);
            return $retorno;
        }
        $retorno->lst = $dao->listUsuarioAutorizadorPorStatus($status, $pag, $qtde, $coluna, $ordem);

        return $retorno;
    }






/**
*
* atualizarId_UsuarioPorPK() - Usado para invocar a classe de negócio UsuarioAutorizadorBusinessImpl de forma geral
* realizar uma atualização de ID do usuário diretamente na tabela USUARIO_AUTORIZADOR campo USUA_ID
* @param $daofactory
* @param $id
* @param $id_usuario
* @return UsuarioAutorizadorDTO
*
* 
*/
    public function atualizarId_UsuarioPorPK($daofactory,$id_usuario,$id)
    {
        $dao = $daofactory->getUsuarioAutorizadorDAO($daofactory);

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
* atualizarId_AutorizadorPorPK() - Usado para invocar a classe de negócio UsuarioAutorizadorBusinessImpl de forma geral
* realizar uma atualização de ID do usuário autorizador diretamente na tabela USUARIO_AUTORIZADOR campo USUA_ID_AUTORIZADOR
* @param $daofactory
* @param $id
* @param $id_autorizador
* @return UsuarioAutorizadorDTO
*
* 
*/
    public function atualizarId_AutorizadorPorPK($daofactory,$id_autorizador,$id)
    {
        $dao = $daofactory->getUsuarioAutorizadorDAO($daofactory);

        // resposta padrão
        $retorno = new DTOPadrao();

        if($dao->updateId_Autorizador($id, $id_autorizador)){   
            $retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
        }       

        // Obtem o texto da mensagem em razão do código de retorno
        $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);

        return $retorno;
    }

/**
*
* atualizarId_CampanhaPorPK() - Usado para invocar a classe de negócio UsuarioAutorizadorBusinessImpl de forma geral
* realizar uma atualização de ID da campanha diretamente na tabela USUARIO_AUTORIZADOR campo CAMP_ID
* @param $daofactory
* @param $id
* @param $id_campanha
* @return UsuarioAutorizadorDTO
*
* 
*/
    public function atualizarId_CampanhaPorPK($daofactory,$id_campanha,$id)
    {
        $dao = $daofactory->getUsuarioAutorizadorDAO($daofactory);

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
* atualizarTipoPorPK() - Usado para invocar a classe de negócio UsuarioAutorizadorBusinessImpl de forma geral
* realizar uma atualização de Tipo de autorização diretamente na tabela USUARIO_AUTORIZADOR campo USAU_IN_TIPO
* @param $daofactory
* @param $id
* @param $tipo
* @return UsuarioAutorizadorDTO
*
* 
*/
    public function atualizarTipoPorPK($daofactory,$tipo,$id)
    {
        $dao = $daofactory->getUsuarioAutorizadorDAO($daofactory);

        // resposta padrão
        $retorno = new DTOPadrao();

        if($dao->updateTipo($id, $tipo)){   
            $retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
        }       

        // Obtem o texto da mensagem em razão do código de retorno
        $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);

        return $retorno;
    }

/**
*
* atualizarPermissaoPorPK() - Usado para invocar a classe de negócio UsuarioAutorizadorBusinessImpl de forma geral
* realizar uma atualização de Qual autorização diretamente na tabela USUARIO_AUTORIZADOR campo USAU_IN_AUTORIZACAO
* @param $daofactory
* @param $id
* @param $permissao
* @return UsuarioAutorizadorDTO
*
* 
*/
    public function atualizarPermissaoPorPK($daofactory,$permissao,$id)
    {
        $dao = $daofactory->getUsuarioAutorizadorDAO($daofactory);

        // resposta padrão
        $retorno = new DTOPadrao();

        if($dao->updatePermissao($id, $permissao)){   
            $retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
        }       

        // Obtem o texto da mensagem em razão do código de retorno
        $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);

        return $retorno;
    }

/**
*
* atualizarDatainicioPorPK() - Usado para invocar a classe de negócio UsuarioAutorizadorBusinessImpl de forma geral
* realizar uma atualização de Data Início diretamente na tabela USUARIO_AUTORIZADOR campo USAU_DT_INICIO
* @param $daofactory
* @param $id
* @param $dataInicio
* @return UsuarioAutorizadorDTO
*
* 
*/
    public function atualizarDatainicioPorPK($daofactory,$dataInicio,$id)
    {
        $dao = $daofactory->getUsuarioAutorizadorDAO($daofactory);

        // resposta padrão
        $retorno = new DTOPadrao();

        if($dao->updateDatainicio($id, $dataInicio)){   
            $retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
        }       

        // Obtem o texto da mensagem em razão do código de retorno
        $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);

        return $retorno;
    }

/**
*
* atualizarDataterminoPorPK() - Usado para invocar a classe de negócio UsuarioAutorizadorBusinessImpl de forma geral
* realizar uma atualização de Data Término diretamente na tabela USUARIO_AUTORIZADOR campo USAU_DT_TERMINO
* @param $daofactory
* @param $id
* @param $dataTermino
* @return UsuarioAutorizadorDTO
*
* 
*/
    public function atualizarDataterminoPorPK($daofactory,$dataTermino,$id)
    {
        $dao = $daofactory->getUsuarioAutorizadorDAO($daofactory);

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
* pesquisarPorId_Usuario() - Usado para invocar a classe de negócio UsuarioAutorizadorBusinessImpl de forma geral
* realizar uma busca de ID do usuário diretamente na tabela USUARIO_AUTORIZADOR campo USUA_ID
*
* @param $id_usuario
* @return UsuarioAutorizadorDTO
*
* 
*/
    public function pesquisarPorId_Usuario($daofactory,$id_usuario)
    { 
        $dao = $daofactory->getUsuarioAutorizadorDAO($daofactory);
        return $dao->loadId_Usuario($id_usuario);
    }

/**
*
* pesquisarPorId_Autorizador() - Usado para invocar a classe de negócio UsuarioAutorizadorBusinessImpl de forma geral
* realizar uma busca de ID do usuário autorizador diretamente na tabela USUARIO_AUTORIZADOR campo USUA_ID_AUTORIZADOR
*
* @param $id_autorizador
* @return UsuarioAutorizadorDTO
*
* 
*/
    public function pesquisarPorId_Autorizador($daofactory,$id_autorizador)

    { 
        $dao = $daofactory->getUsuarioAutorizadorDAO($daofactory);
        return $dao->loadId_Autorizador($id_autorizador);
    }

/**
*
* pesquisarPorId_Campanha() - Usado para invocar a classe de negócio UsuarioAutorizadorBusinessImpl de forma geral
* realizar uma busca de ID da campanha diretamente na tabela USUARIO_AUTORIZADOR campo CAMP_ID
*
* @param $id_campanha
* @return UsuarioAutorizadorDTO
*
* 
*/
    public function pesquisarPorId_Campanha($daofactory,$id_campanha)

    { 
        $dao = $daofactory->getUsuarioAutorizadorDAO($daofactory);
        return $dao->loadId_Campanha($id_campanha);
    }

/**
*
* pesquisarPorTipo() - Usado para invocar a classe de negócio UsuarioAutorizadorBusinessImpl de forma geral
* realizar uma busca de Tipo de autorização diretamente na tabela USUARIO_AUTORIZADOR campo USAU_IN_TIPO
*
* @param $tipo
* @return UsuarioAutorizadorDTO
*
* 
*/
    public function pesquisarPorTipo($daofactory,$tipo)

    { 
        $dao = $daofactory->getUsuarioAutorizadorDAO($daofactory);
        return $dao->loadTipo($tipo);
    }

/**
*
* pesquisarPorPermissao() - Usado para invocar a classe de negócio UsuarioAutorizadorBusinessImpl de forma geral
* realizar uma busca de Qual autorização diretamente na tabela USUARIO_AUTORIZADOR campo USAU_IN_AUTORIZACAO
*
* @param $permissao
* @return UsuarioAutorizadorDTO
*
* 
*/
    public function pesquisarPorPermissao($daofactory,$permissao)

    { 
        $dao = $daofactory->getUsuarioAutorizadorDAO($daofactory);
        return $dao->loadPermissao($permissao);
    }

/**
*
* pesquisarPorDatainicio() - Usado para invocar a classe de negócio UsuarioAutorizadorBusinessImpl de forma geral
* realizar uma busca de Data Início diretamente na tabela USUARIO_AUTORIZADOR campo USAU_DT_INICIO
*
* @param $dataInicio
* @return UsuarioAutorizadorDTO
*
* 
*/
    public function pesquisarPorDatainicio($daofactory,$dataInicio)

    { 
        $dao = $daofactory->getUsuarioAutorizadorDAO($daofactory);
        return $dao->loadDatainicio($dataInicio);
    }

/**
*
* pesquisarPorDatatermino() - Usado para invocar a classe de negócio UsuarioAutorizadorBusinessImpl de forma geral
* realizar uma busca de Data Término diretamente na tabela USUARIO_AUTORIZADOR campo USAU_DT_TERMINO
*
* @param $dataTermino
* @return UsuarioAutorizadorDTO
*
* 
*/
    public function pesquisarPorDatatermino($daofactory,$dataTermino)

    { 
        $dao = $daofactory->getUsuarioAutorizadorDAO($daofactory);
        return $dao->loadDatatermino($dataTermino);
    }


/**
*
* listarUsuarioAutorizadorUsuaIdPorStatus() - Usado para invocar a interface de acesso aos dados (DAO) UsuarioAutorizadorDAO de forma geral
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

    public function listarUsuarioAutorizadorPorUsuaIdStatus($daofactory, $usuaid, $status, $pag, $qtde, $coluna, $ordem)
    {   
        $retorno = new DTOPaginacao();
        $retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
        $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);

        $dao = $daofactory->getUsuarioAutorizadorDAO($daofactory);
        $retorno->pagina = $pag;
        $retorno->itensPorPagina = ($qtde == 0 
        ? (int) VariavelCache::getInstance()->getVariavel(ConstantesVariavel::MAXIMO_LINHAS_POR_PAGINA_DEFAULT)
        : $qtde);
        $retorno->totalPaginas = ceil($dao->countUsuarioAutorizadorPorUsuaIdStatus($usuaid, $status) / $retorno->itensPorPagina);

        if($pag > $retorno->totalPaginas) {
            $retorno->msgcode = ConstantesMensagem::NAO_EXISTEM_MAIS_PAGINAS_APRESENTAR;
            $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);
            return $retorno;
        }
        $retorno->lst = $dao->listUsuarioAutorizadorPorUsuaIdStatus($usuaid, $status, $pag, $qtde, $coluna, $ordem);

        return $retorno;
    }

/**
*
* listarUsuarioAutorizadorPorUsuaIdAutorizadorCampId() - Usado para invocar a interface de acesso aos dados (DAO) UsuarioAutorizadorDAO de forma geral
* realizar lista paginada de registros dos registros do usuário logado com uma instância de PaginacaoDTO
*
* @param $daofactory
* @param $usuaid
* @param $campid
* @param $status
* @param $pag
* @param $qtde
* @param $coluna
* @param $ordem
* @return $PaginacaoDTO
*/

public function listarUsuarioAutorizadorPorUsuaIdAutorizadorCampId($daofactory, $usuaid, $campid, $status, $pag=1, $qtde=50, $coluna=1, $ordem=0)
{   

    $retorno = new DTOPaginacao();
    $retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
    $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);

    $dao = $daofactory->getUsuarioAutorizadorDAO($daofactory);
    $retorno->pagina = $pag;
    $retorno->itensPorPagina = ($qtde == 0 
    ? (int) VariavelCache::getInstance()->getVariavel(ConstantesVariavel::MAXIMO_LINHAS_POR_PAGINA_DEFAULT)
    : $qtde);
    $retorno->totalPaginas = ceil($dao->countUsuarioAutorizadorPorUsuaIdAutorizadorCampId($usuaid, $campid, $status) / $retorno->itensPorPagina);

    if($pag > $retorno->totalPaginas) {
        $retorno->msgcode = ConstantesMensagem::NAO_EXISTEM_MAIS_PAGINAS_APRESENTAR;
        $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);
        return $retorno;
    }
    $retorno->lst = $dao->listUsuarioAutorizadorPorUsuaIdAutorizadorCampId($usuaid, $campid, $status, $pag, $qtde, $coluna, $ordem);

    if($retorno->lst != NULL && count($retorno->lst) > 0){
        $idx = 0;
        foreach ($retorno->lst as $key => $dto) {
            $dto->usuario = UsuarioHelper::getUsuarioBusinessNoKeys($daofactory, $dto->id_usuario);
        }
    }

    return $retorno;
}



/**
*
* listarUsuarioAutorizadorPorUsuaIdAutorizadorStatus() - Usado para invocar a interface de acesso aos dados (DAO) UsuarioAutorizadorDAO de forma geral
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

    public function listarUsuarioAutorizadorPorUsuaIdAutorizadorStatus($daofactory, $usuaid, $status, $pag=1, $qtde=50, $coluna=1, $ordem=0)
    {   

        $retorno = new DTOPaginacao();
        $retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
        $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);

        $dao = $daofactory->getUsuarioAutorizadorDAO($daofactory);
        $retorno->pagina = $pag;
        $retorno->itensPorPagina = ($qtde == 0 
        ? (int) VariavelCache::getInstance()->getVariavel(ConstantesVariavel::MAXIMO_LINHAS_POR_PAGINA_DEFAULT)
        : $qtde);
        $retorno->totalPaginas = ceil($dao->countUsuarioAutorizadorPorUsuaIdAutorizadorStatus($usuaid, $status) / $retorno->itensPorPagina);

        if($pag > $retorno->totalPaginas) {
            $retorno->msgcode = ConstantesMensagem::NAO_EXISTEM_MAIS_PAGINAS_APRESENTAR;
            $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);
            return $retorno;
        }
        $retorno->lst = $dao->listUsuarioAutorizadorPorUsuaIdAutorizadorStatus($usuaid, $status, $pag, $qtde, $coluna, $ordem);

        if($retorno->lst != NULL && count($retorno->lst) > 0){
            $idx = 0;
            foreach ($retorno->lst as $key => $dto) {
                $dto->usuario = UsuarioHelper::getUsuarioBusinessNoKeys($daofactory, $dto->id_usuario);
            }
        }

        return $retorno;
    }


/**
* validarTamanhoCampo()
*
* Validador de tamanho de campos UsuarioAutorizadorDTO
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
