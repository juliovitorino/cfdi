<?php 

// importar dependencias
require_once 'UsuarioPublicidadeBusiness.php';
require_once 'UsuarioPublicidadeConstantes.php';

require_once '../usuarios/UsuarioHelper.php';
require_once '../dto/DTOPadrao.php';
require_once '../dto/DTOPaginacao.php';
require_once '../variavel/ConstantesVariavel.php';
require_once '../variavel/VariavelCache.php';
require_once '../estatisticafuncao/EstatisticaFuncaoHelper.php';
require_once '../estatisticafuncao/ConstantesEstatisticaFuncao.php';

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
CÓDIGO SOFREU ALTERAÇÕES PROFUNDAS, NÃO USE O GERADOR
AUTOMÁTICO PARA SUBSTITUIR O CÓDIGO AQUI EXISTENTE.
TODO O SISTEMA PODE ENTRAR EM COLAPSO.
===========================================================
***********************************************************/ 

/**
*
* UsuarioPublicidadeBusinessImpl - Classe de implementação dos métodos de negócio para a interface UsuarioPublicidadeBusiness
* Camada de negócio UsuarioPublicidade - camada responsável pela lógica de negócios de UsuarioPublicidade do sistema. 
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
* @since 20/09/2019 13:57:12
*
*/


class UsuarioPublicidadeBusinessImpl implements UsuarioPublicidadeBusiness
{
    
    function __construct()  {   }

/**
* carregar() - Carrega apenas um registro com base no campo id = (USUARIO_PUBLICIDADE::USPU_ID)
* @param $daofactory
* @param $dto
* @return $dto
*/ 
    public function carregar($daofactory, $dto) {   }

/**
* listarTudo() - Lista todos os registros provenientes de USUARIO_PUBLICIDADE sem critério de paginação
* @param $daofactory
* @return List<UsuarioPublicidadeDTO>[]
*/ 
    public function listarTudo($daofactory) {   }

/**
*
* atualizarImagem() - Atualizar as informações da URL da imagem da campanha de publicidade
* após o upload realizado.
*
* @param daofactory
* @param uspu_id
* @param nomearquivo
* @return UsuarioPublicidadeDTO
*
*/
    public function atualizarImagem($daofactory, $uspu_id, $nomearquivo)
	{
		$dao = $daofactory->getUsuarioPublicidadeDAO($daofactory);

		// resposta padrão
		$retorno = new DTOPadrao();
		$retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;


		if(!$dao->updateImagem($uspu_id, $nomearquivo)){	
			$retorno->msgcode = ConstantesMensagem::ERRO_CRUD_ATUALIZAR_REGISTRO;
		}		
		// Obtem o texto da mensagem em razão do código de retorno
		$retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);

		return $retorno;
	}


/**
* PesquisarMaxPKAtivoId_UsuarioPorStatus() - Carrega apenas um registro com base no id_usuario  e status para buscar a MAIOR PK
* @param $daofactory
* @param $status
* @return UsuarioPublicidadeDTO
*/ 
    public function PesquisarMaxPKAtivoId_UsuarioPorStatus($daofactory, $id_usuario,$status)
    { 
        $dao = $daofactory->getUsuarioPublicidadeDAO($daofactory);
        $maxid = $dao->loadMaxId_UsuarioPK($id_usuario,$status);
        return $this->carregarPorID($daofactory, $maxid);
    }

/**
* atualizar() - atualiza apenas um registro com base no dto UsuarioPublicidadeDTO->id
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


        $dao = $daofactory->getUsuarioPublicidadeDAO($daofactory);
        if(!$dao->update($dto)){
           $retorno->msgcode = ConstantesMensagem::ERRO_CRUD_ATUALIZAR_REGISTRO;
           $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);
    
        }
        // retorna situação
        return $retorno;

    }

/**
* deletar() - excluir fisicamente um registro com base no dto UsuarioPublicidadeDTO->id
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
        $dao = $daofactory->getUsuarioPublicidadeDAO($daofactory);

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
* @return List<UsuarioPublicidadeDTO>[]
* @deprecated
*/ 

    public function listarPagina($daofactory, $pag, $qtde)  
    {   
        $dao = $daofactory->getUsuarioPublicidadeDAO($daofactory);
        return $dao->listPagina($pag, $qtde);
    }

/**
* carregarPorID() - Carrega APENAS um registro usando a id como item de busca
* na tabela USUARIO_PUBLICIDADE usando a Primary Key USPU_ID
*
* @param $daofactory
* @param $id
* @param $qtde
*
* @return UsuarioPublicidadeDTO
*/ 
    public function carregarPorID($daofactory, $id)
    { 
        $dao = $daofactory->getUsuarioPublicidadeDAO($daofactory);
        return $dao->loadPK($id);
    }

/**
* atualizarStatus() - atualizar o campo de STATUS utilizando a id como item de busca
* na tabela USUARIO_PUBLICIDADE usando a Primary Key USPU_ID
*
* @param $daofactory
* @param $id
* @param $status
*
* @return UsuarioPublicidadeDTO
*/ 
    public function atualizarStatus($daofactory, $id, $status)
    {
        $dao = $daofactory->getUsuarioPublicidadeDAO($daofactory);

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
* inserir() - inserir um registro com base no UsuarioPublicidadeDTO. Alguns atributos dentro do DTO
* serão ignorados caso estejam populados.
*
* Atributos da classe UsuarioPublicidadeDTO sumariamente IGNORADOS por este método MESMO que estejam preenchidos:
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

    // Verifica o sucesso de verificarPermissao
    $permdto = PermissaoHelper::verificarPermissao($daofactory, $dto->id_usuario, ConstantesPlano::PERM_CRIAR_PROMOCAO_PLANO);
    if ($permdto->msgcode != ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO) {
        return $permdto;
    }

    // Efetua validações no campo $dto->id com tamanho UsuarioPublicidadeConstantes::LEN_ID
    $ok = $this->validarTamanhoCampo($dto->id, UsuarioPublicidadeConstantes::LEN_ID, UsuarioPublicidadeConstantes::DESC_ID);
    if($ok->msgcode != ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO){
        return $ok;
    }

    // Efetua validações no campo $dto->id_usuario com tamanho UsuarioPublicidadeConstantes::LEN_ID_USUARIO
    $ok = $this->validarTamanhoCampo($dto->id_usuario, UsuarioPublicidadeConstantes::LEN_ID_USUARIO, UsuarioPublicidadeConstantes::DESC_ID_USUARIO);
    if($ok->msgcode != ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO){
        return $ok;
    }

    // Efetua validações no campo $dto->titulo com tamanho UsuarioPublicidadeConstantes::LEN_TITULO
    $ok = $this->validarTamanhoCampo($dto->titulo, UsuarioPublicidadeConstantes::LEN_TITULO, UsuarioPublicidadeConstantes::DESC_TITULO);
    if($ok->msgcode != ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO){
        return $ok;
    }

    // Efetua validações no campo $dto->descricao com tamanho UsuarioPublicidadeConstantes::LEN_DESCRICAO
    $ok = $this->validarTamanhoCampo($dto->descricao, UsuarioPublicidadeConstantes::LEN_DESCRICAO, UsuarioPublicidadeConstantes::DESC_DESCRICAO);
    if($ok->msgcode != ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO){
        return $ok;
    }

    // Efetua validações no campo $dto->dataInicio com tamanho UsuarioPublicidadeConstantes::LEN_DATAINICIO
    $ok = $this->validarTamanhoCampo($dto->dataInicio, UsuarioPublicidadeConstantes::LEN_DATAINICIO, UsuarioPublicidadeConstantes::DESC_DATAINICIO);
    if($ok->msgcode != ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO){
        return $ok;
    }

    // Efetua validações no campo $dto->dataTermino com tamanho UsuarioPublicidadeConstantes::LEN_DATATERMINO
    $ok = $this->validarTamanhoCampo($dto->dataTermino, UsuarioPublicidadeConstantes::LEN_DATATERMINO, UsuarioPublicidadeConstantes::DESC_DATATERMINO);
    if($ok->msgcode != ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO){
        return $ok;
    }

    // Efetua validações no campo $dto->vlNormal com tamanho UsuarioPublicidadeConstantes::LEN_VLNORMAL
    $ok = $this->validarTamanhoCampo($dto->vlNormal, UsuarioPublicidadeConstantes::LEN_VLNORMAL, UsuarioPublicidadeConstantes::DESC_VLNORMAL);
    if($ok->msgcode != ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO){
        return $ok;
    }

    // Efetua validações no campo $dto->vlPromo com tamanho UsuarioPublicidadeConstantes::LEN_VLPROMO
    $ok = $this->validarTamanhoCampo($dto->vlPromo, UsuarioPublicidadeConstantes::LEN_VLPROMO, UsuarioPublicidadeConstantes::DESC_VLPROMO);
    if($ok->msgcode != ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO){
        return $ok;
    }

    // Efetua validações no campo $dto->observacao com tamanho UsuarioPublicidadeConstantes::LEN_OBSERVACAO
    $ok = $this->validarTamanhoCampo($dto->observacao, UsuarioPublicidadeConstantes::LEN_OBSERVACAO, UsuarioPublicidadeConstantes::DESC_OBSERVACAO);
    if($ok->msgcode != ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO){
        return $ok;
    }

    // Efetua validações no campo $dto->dataRemover com tamanho UsuarioPublicidadeConstantes::LEN_DATAREMOVER
    $ok = $this->validarTamanhoCampo($dto->dataRemover, UsuarioPublicidadeConstantes::LEN_DATAREMOVER, UsuarioPublicidadeConstantes::DESC_DATAREMOVER);
    if($ok->msgcode != ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO){
        return $ok;
    }


    $dto->status = ConstantesVariavel::STATUS_ATIVO;
    $dao = $daofactory->getUsuarioPublicidadeDAO($daofactory);

    if (!$dao->insert($dto)) {
        $retorno = new DTOPadrao();
        $retorno->msgcode = ConstantesMensagem::ERRO_CRUD_INSERIR_REGISTRO;
        $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);
    } else {
        EstatisticaFuncaoHelper::registrarEstatisticaService($dto->id_usuario, 
            $maxid,
            ConstantesEstatisticaFuncao::FUNCAO_CRIAR_PROMOCAO_PLANO
        );
    }

    return $retorno;
}

/**
*
* listarUsuarioPublicidadePorStatus() - Usado para invocar a interface de acesso aos dados (DAO) UsuarioPublicidadeDAO de forma geral
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

    public function listarUsuarioPublicidadePorStatus($daofactory, $status, $pag, $qtde, $coluna, $ordem)
    {   
        $retorno = new DTOPaginacao();
        $retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
        $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);

        $dao = $daofactory->getUsuarioPublicidadeDAO($daofactory);
        $retorno->pagina = $pag;
        $retorno->itensPorPagina = ($qtde == 0 
        ? (int) VariavelCache::getInstance()->getVariavel(ConstantesVariavel::MAXIMO_LINHAS_POR_PAGINA_DEFAULT)
        : $qtde);
        $retorno->totalPaginas = ceil($dao->countUsuarioPublicidadePorStatus($status) / $retorno->itensPorPagina);

        if($pag > $retorno->totalPaginas) {
            $retorno->msgcode = ConstantesMensagem::NAO_EXISTEM_MAIS_PAGINAS_APRESENTAR;
            $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);
            return $retorno;
        }
        $retorno->lst = $dao->listUsuarioPublicidadePorStatus($status, $pag, $qtde, $coluna, $ordem);

        return $retorno;
    }






/**
*
* atualizarId_UsuarioPorPK() - Usado para invocar a classe de negócio UsuarioPublicidadeBusinessImpl de forma geral
* realizar uma atualização de ID do usuário diretamente na tabela USUARIO_PUBLICIDADE campo USUA_ID
* @param $daofactory
* @param $id
* @param $id_usuario
* @return UsuarioPublicidadeDTO
*
* 
*/
    public function atualizarId_UsuarioPorPK($daofactory,$id_usuario,$id)
    {
        $dao = $daofactory->getUsuarioPublicidadeDAO($daofactory);

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
* atualizarTituloPorPK() - Usado para invocar a classe de negócio UsuarioPublicidadeBusinessImpl de forma geral
* realizar uma atualização de Título da publicidade diretamente na tabela USUARIO_PUBLICIDADE campo USPU_TX_TITULO
* @param $daofactory
* @param $id
* @param $titulo
* @return UsuarioPublicidadeDTO
*
* 
*/
    public function atualizarTituloPorPK($daofactory,$titulo,$id)
    {
        $dao = $daofactory->getUsuarioPublicidadeDAO($daofactory);

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
* atualizarDescricaoPorPK() - Usado para invocar a classe de negócio UsuarioPublicidadeBusinessImpl de forma geral
* realizar uma atualização de Descrição geral diretamente na tabela USUARIO_PUBLICIDADE campo USPU_TX_DESCRICAO
* @param $daofactory
* @param $id
* @param $descricao
* @return UsuarioPublicidadeDTO
*
* 
*/
    public function atualizarDescricaoPorPK($daofactory,$descricao,$id)
    {
        $dao = $daofactory->getUsuarioPublicidadeDAO($daofactory);

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
* atualizarDatainicioPorPK() - Usado para invocar a classe de negócio UsuarioPublicidadeBusinessImpl de forma geral
* realizar uma atualização de Data de início diretamente na tabela USUARIO_PUBLICIDADE campo USPU_DT_INICIO
* @param $daofactory
* @param $id
* @param $dataInicio
* @return UsuarioPublicidadeDTO
*
* 
*/
    public function atualizarDatainicioPorPK($daofactory,$dataInicio,$id)
    {
        $dao = $daofactory->getUsuarioPublicidadeDAO($daofactory);

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
* atualizarDataterminoPorPK() - Usado para invocar a classe de negócio UsuarioPublicidadeBusinessImpl de forma geral
* realizar uma atualização de Data de término diretamente na tabela USUARIO_PUBLICIDADE campo USPU_DT_TERMINO
* @param $daofactory
* @param $id
* @param $dataTermino
* @return UsuarioPublicidadeDTO
*
* 
*/
    public function atualizarDataterminoPorPK($daofactory,$dataTermino,$id)
    {
        $dao = $daofactory->getUsuarioPublicidadeDAO($daofactory);

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
* atualizarVlnormalPorPK() - Usado para invocar a classe de negócio UsuarioPublicidadeBusinessImpl de forma geral
* realizar uma atualização de Valor do produto/serviço diretamente na tabela USUARIO_PUBLICIDADE campo USPU_VL_NORMAL
* @param $daofactory
* @param $id
* @param $vlNormal
* @return UsuarioPublicidadeDTO
*
* 
*/
    public function atualizarVlnormalPorPK($daofactory,$vlNormal,$id)
    {
        $dao = $daofactory->getUsuarioPublicidadeDAO($daofactory);

        // resposta padrão
        $retorno = new DTOPadrao();

        if($dao->updateVlnormal($id, $vlNormal)){   
            $retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
        }       

        // Obtem o texto da mensagem em razão do código de retorno
        $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);

        return $retorno;
    }

/**
*
* atualizarVlpromoPorPK() - Usado para invocar a classe de negócio UsuarioPublicidadeBusinessImpl de forma geral
* realizar uma atualização de Valor promocional produto/serviço diretamente na tabela USUARIO_PUBLICIDADE campo USPU_VL_PROMO
* @param $daofactory
* @param $id
* @param $vlPromo
* @return UsuarioPublicidadeDTO
*
* 
*/
    public function atualizarVlpromoPorPK($daofactory,$vlPromo,$id)
    {
        $dao = $daofactory->getUsuarioPublicidadeDAO($daofactory);

        // resposta padrão
        $retorno = new DTOPadrao();

        if($dao->updateVlpromo($id, $vlPromo)){   
            $retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
        }       

        // Obtem o texto da mensagem em razão do código de retorno
        $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);

        return $retorno;
    }

/**
*
* atualizarObservacaoPorPK() - Usado para invocar a classe de negócio UsuarioPublicidadeBusinessImpl de forma geral
* realizar uma atualização de Observação diretamente na tabela USUARIO_PUBLICIDADE campo USPU_TX_OBS
* @param $daofactory
* @param $id
* @param $observacao
* @return UsuarioPublicidadeDTO
*
* 
*/
    public function atualizarObservacaoPorPK($daofactory,$observacao,$id)
    {
        $dao = $daofactory->getUsuarioPublicidadeDAO($daofactory);

        // resposta padrão
        $retorno = new DTOPadrao();

        if($dao->updateObservacao($id, $observacao)){   
            $retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
        }       

        // Obtem o texto da mensagem em razão do código de retorno
        $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);

        return $retorno;
    }

/**
*
* atualizarDataremoverPorPK() - Usado para invocar a classe de negócio UsuarioPublicidadeBusinessImpl de forma geral
* realizar uma atualização de Data para apagar diretamente na tabela USUARIO_PUBLICIDADE campo USPU_DT_APAGAR
* @param $daofactory
* @param $id
* @param $dataRemover
* @return UsuarioPublicidadeDTO
*
* 
*/
    public function atualizarDataremoverPorPK($daofactory,$dataRemover,$id)
    {
        $dao = $daofactory->getUsuarioPublicidadeDAO($daofactory);

        // resposta padrão
        $retorno = new DTOPadrao();

        if($dao->updateDataremover($id, $dataRemover)){   
            $retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
        }       

        // Obtem o texto da mensagem em razão do código de retorno
        $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);

        return $retorno;
    }


/**
*
* pesquisarPorId_Usuario() - Usado para invocar a classe de negócio UsuarioPublicidadeBusinessImpl de forma geral
* realizar uma busca de ID do usuário diretamente na tabela USUARIO_PUBLICIDADE campo USUA_ID
*
* @param $id_usuario
* @return UsuarioPublicidadeDTO
*
* 
*/
    public function pesquisarPorId_Usuario($daofactory,$id_usuario)
    { 
        $dao = $daofactory->getUsuarioPublicidadeDAO($daofactory);
        return $dao->loadId_Usuario($id_usuario);
    }

/**
*
* pesquisarPorTitulo() - Usado para invocar a classe de negócio UsuarioPublicidadeBusinessImpl de forma geral
* realizar uma busca de Título da publicidade diretamente na tabela USUARIO_PUBLICIDADE campo USPU_TX_TITULO
*
* @param $titulo
* @return UsuarioPublicidadeDTO
*
* 
*/
    public function pesquisarPorTitulo($daofactory,$titulo)

    { 
        $dao = $daofactory->getUsuarioPublicidadeDAO($daofactory);
        return $dao->loadTitulo($titulo);
    }

/**
*
* pesquisarPorDescricao() - Usado para invocar a classe de negócio UsuarioPublicidadeBusinessImpl de forma geral
* realizar uma busca de Descrição geral diretamente na tabela USUARIO_PUBLICIDADE campo USPU_TX_DESCRICAO
*
* @param $descricao
* @return UsuarioPublicidadeDTO
*
* 
*/
    public function pesquisarPorDescricao($daofactory,$descricao)

    { 
        $dao = $daofactory->getUsuarioPublicidadeDAO($daofactory);
        return $dao->loadDescricao($descricao);
    }

/**
*
* pesquisarPorDatainicio() - Usado para invocar a classe de negócio UsuarioPublicidadeBusinessImpl de forma geral
* realizar uma busca de Data de início diretamente na tabela USUARIO_PUBLICIDADE campo USPU_DT_INICIO
*
* @param $dataInicio
* @return UsuarioPublicidadeDTO
*
* 
*/
    public function pesquisarPorDatainicio($daofactory,$dataInicio)

    { 
        $dao = $daofactory->getUsuarioPublicidadeDAO($daofactory);
        return $dao->loadDatainicio($dataInicio);
    }

/**
*
* pesquisarPorDatatermino() - Usado para invocar a classe de negócio UsuarioPublicidadeBusinessImpl de forma geral
* realizar uma busca de Data de término diretamente na tabela USUARIO_PUBLICIDADE campo USPU_DT_TERMINO
*
* @param $dataTermino
* @return UsuarioPublicidadeDTO
*
* 
*/
    public function pesquisarPorDatatermino($daofactory,$dataTermino)

    { 
        $dao = $daofactory->getUsuarioPublicidadeDAO($daofactory);
        return $dao->loadDatatermino($dataTermino);
    }

/**
*
* pesquisarPorVlnormal() - Usado para invocar a classe de negócio UsuarioPublicidadeBusinessImpl de forma geral
* realizar uma busca de Valor do produto/serviço diretamente na tabela USUARIO_PUBLICIDADE campo USPU_VL_NORMAL
*
* @param $vlNormal
* @return UsuarioPublicidadeDTO
*
* 
*/
    public function pesquisarPorVlnormal($daofactory,$vlNormal)

    { 
        $dao = $daofactory->getUsuarioPublicidadeDAO($daofactory);
        return $dao->loadVlnormal($vlNormal);
    }

/**
*
* pesquisarPorVlpromo() - Usado para invocar a classe de negócio UsuarioPublicidadeBusinessImpl de forma geral
* realizar uma busca de Valor promocional produto/serviço diretamente na tabela USUARIO_PUBLICIDADE campo USPU_VL_PROMO
*
* @param $vlPromo
* @return UsuarioPublicidadeDTO
*
* 
*/
    public function pesquisarPorVlpromo($daofactory,$vlPromo)

    { 
        $dao = $daofactory->getUsuarioPublicidadeDAO($daofactory);
        return $dao->loadVlpromo($vlPromo);
    }

/**
*
* pesquisarPorObservacao() - Usado para invocar a classe de negócio UsuarioPublicidadeBusinessImpl de forma geral
* realizar uma busca de Observação diretamente na tabela USUARIO_PUBLICIDADE campo USPU_TX_OBS
*
* @param $observacao
* @return UsuarioPublicidadeDTO
*
* 
*/
    public function pesquisarPorObservacao($daofactory,$observacao)

    { 
        $dao = $daofactory->getUsuarioPublicidadeDAO($daofactory);
        return $dao->loadObservacao($observacao);
    }

/**
*
* pesquisarPorDataremover() - Usado para invocar a classe de negócio UsuarioPublicidadeBusinessImpl de forma geral
* realizar uma busca de Data para apagar diretamente na tabela USUARIO_PUBLICIDADE campo USPU_DT_APAGAR
*
* @param $dataRemover
* @return UsuarioPublicidadeDTO
*
* 
*/
    public function pesquisarPorDataremover($daofactory,$dataRemover)

    { 
        $dao = $daofactory->getUsuarioPublicidadeDAO($daofactory);
        return $dao->loadDataremover($dataRemover);
    }

/**
*
* listarUsuarioPublicidadeProx24h() - Listar as publicidades ativas do dia.
* 
* Em breve, iremos colocar a busca pela região de usuaid (solicitante da pesquisa)
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
    
    public function listarUsuarioPublicidadeProx24h($daofactory, $usuaid, $status, $pag, $qtde, $coluna, $ordem)
    {   
        $retorno = new DTOPaginacao();
        $retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
        $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);

        $dao = $daofactory->getUsuarioPublicidadeDAO($daofactory);
        $retorno->pagina = $pag;
        $retorno->itensPorPagina = ($qtde == 0 
        ? (int) VariavelCache::getInstance()->getVariavel(ConstantesVariavel::MAXIMO_LINHAS_POR_PAGINA_DEFAULT)
        : $qtde);
        $retorno->totalPaginas = ceil($dao->countUsuarioPublicidadeProx24h($usuaid, $status) / $retorno->itensPorPagina);

        if($pag > $retorno->totalPaginas) {
            $retorno->msgcode = ConstantesMensagem::NAO_EXISTEM_MAIS_PAGINAS_APRESENTAR;
            $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);
            return $retorno;
        }
        $retorno->lst = $dao->listUsuarioPublicidadeProx24h($usuaid, $status, $pag, $qtde, $coluna, $ordem);

        // Obtem as informações do dono da publicidade
        foreach ($retorno->lst as $key => $uspudto) {
            $retorno->lst[$key]->usuario = UsuarioHelper::getUsuarioBusinessNoKeys($daofactory, $uspudto->id_usuario);
        }

        return $retorno;
    }

/**
*
* listarUsuarioPublicidadeUsuaIdPorStatus() - Usado para invocar a interface de acesso aos dados (DAO) UsuarioPublicidadeDAO de forma geral
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

    public function listarUsuarioPublicidadePorUsuaIdStatus($daofactory, $usuaid, $status, $pag, $qtde, $coluna, $ordem)
    {   
        $retorno = new DTOPaginacao();
        $retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
        $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);

        $dao = $daofactory->getUsuarioPublicidadeDAO($daofactory);
        $retorno->pagina = $pag;
        $retorno->itensPorPagina = ($qtde == 0 
        ? (int) VariavelCache::getInstance()->getVariavel(ConstantesVariavel::MAXIMO_LINHAS_POR_PAGINA_DEFAULT)
        : $qtde);
        $retorno->totalPaginas = ceil($dao->countUsuarioPublicidadePorUsuaIdStatus($usuaid, $status) / $retorno->itensPorPagina);

        if($pag > $retorno->totalPaginas) {
            $retorno->msgcode = ConstantesMensagem::NAO_EXISTEM_MAIS_PAGINAS_APRESENTAR;
            $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);
            return $retorno;
        }
        $retorno->lst = $dao->listUsuarioPublicidadePorUsuaIdStatus($usuaid, $status, $pag, $qtde, $coluna, $ordem);

        return $retorno;
    }

/**
* validarTamanhoCampo()
*
* Validador de tamanho de campos UsuarioPublicidadeDTO
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
