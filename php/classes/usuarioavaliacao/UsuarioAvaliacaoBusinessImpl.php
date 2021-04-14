<?php 

// importar dependencias
require_once 'UsuarioAvaliacaoBusiness.php';
require_once 'UsuarioAvaliacaoHelper.php';

require_once '../dto/DTOPadrao.php';
require_once '../dto/DTOPaginacao.php';

require_once '../variavel/ConstantesVariavel.php';
require_once '../variavel/VariavelCache.php';
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
CÓDIGO SOFREU ALTERAÇÕES PROFUNDAS, NÃO USE O GERADOR
AUTOMÁTICO PARA SUBSTITUIR O CÓDIGO AQUI EXISTENTE.
TODO O SISTEMA PODE ENTRAR EM COLAPSO.
===========================================================
***********************************************************/ 

/**
*
* UsuarioAvaliacaoBusinessImpl - Classe de implementação dos métodos de negócio para a interface UsuarioAvaliacaoBusiness
* Camada de negócio UsuarioAvaliacao - camada responsável pela lógica de negócios de UsuarioAvaliacao do sistema. 
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
* @since 17/09/2019 09:22:19
*
*/


class UsuarioAvaliacaoBusinessImpl implements UsuarioAvaliacaoBusiness
{
    
    function __construct()  {   }

/**
*
* realizarAvaliacaoCartao() - Acumula indicadores de avaliação geral do usuário
*
*/
    public function realizarUsuarioAvaliacao($daofactory, $id_usuario, $rating)
    {
        $retorno = new UsuarioAvaliacaoDTO();
        $retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
        $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);

        // Verifica se o usuário é valido
        $usuadto = UsuarioHelper::getUsuarioBusinessNoKeys($daofactory, $id_usuario);
        if(UsuarioHelper::isUsuarioValido($daofactory, $id_usuario)) {
            $retorno->msgcode = ConstantesMensagem::USUARIO_NAO_ENCONTRADO;
            $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);
            return $retorno;
        }

        $dao = $daofactory->getUsuarioAvaliacaoDAO($daofactory);
        $usavdto = $this->PesquisarMaxPKAtivoId_UsuarioPorStatus($daofactory, $id_usuario, ConstantesVariavel::STATUS_ATIVO);
        
        // Se nunca foi feita uma avaliação gera o registro base
        if($usavdto == NULL || $usavdto->id == NULL){
            $usavdto->id_usuario = $id_usuario;

            if(! $dao->insert($usavdto)){
                $usavdto->msgcode = ConstantesMensagem::ERRO_CRUD_INSERIR_REGISTRO;
                $usavdto->msgcodeString = MensagemCache::getInstance()->getMensagem($usavdto->msgcode);
                return $usavdto;
            }
        }

        // Obtem o registro atualizado e calcula o novo indice de rating
        $usavdto = $this->PesquisarMaxPKAtivoId_UsuarioPorStatus($daofactory, $id_usuario, ConstantesVariavel::STATUS_ATIVO);

        // Incrementa a avaliação correspondente
        if(!$dao->incUsuarioAvaliacao($usavdto->id, $rating)){
            $usavdto->msgcode = ConstantesMensagem::ERRO_CRUD_INSERIR_REGISTRO;
            $usavdto->msgcodeString = MensagemCache::getInstance()->getMensagem($usavdto->msgcode);
            return $usavdto;
        }

        // Obtem o registro atualizado e calcula o novo indice de rating
        $usavdto = $this->PesquisarMaxPKAtivoId_UsuarioPorStatus($daofactory, $id_usuario, ConstantesVariavel::STATUS_ATIVO);

        $this->calcularRating($dao, $usavdto);
        $usavdto->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
        $usavdto->msgcodeString = MensagemCache::getInstance()->getMensagem($usavdto->msgcode);

        return $usavdto;
    }

    private function calcularRating($dao, $retorno)
	{
        $retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
		$rating = (
		($retorno->contadorStar_1 * 1) + 
		($retorno->contadorStar_2 * 2) +
		($retorno->contadorStar_3 * 3) +
		($retorno->contadorStar_4 * 4) +
		($retorno->contadorStar_5 * 5) ) / (
			$retorno->contadorStar_1 + $retorno->contadorStar_2 + $retorno->contadorStar_3 + $retorno->contadorStar_4 + $retorno->contadorStar_5 
		);

		if(!$dao->updateRatingcalculado($retorno->id, $rating)){	
			$retorno->msgcode = ConstantesMensagem::ERRO_CRUD_ATUALIZAR_REGISTRO;
		}		
		// Obtem o texto da mensagem em razão do código de retorno
		$retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);

		return $retorno;
	}


/**
* carregar() - Carrega apenas um registro com base no campo id = (USUARIO_AVALIACAO::USAV_ID)
* @param $daofactory
* @param $dto
* @return $dto
*/ 
    public function carregar($daofactory, $dto) {   }

/**
* listarTudo() - Lista todos os registros provenientes de USUARIO_AVALIACAO sem critério de paginação
* @param $daofactory
* @return List<UsuarioAvaliacaoDTO>[]
*/ 
    public function listarTudo($daofactory) {   }

/**
* PesquisarMaxPKAtivoId_UsuarioPorStatus() - Carrega apenas um registro com base no id_usuario  e status para buscar a MAIOR PK
* @param $daofactory
* @param $status
* @return UsuarioAvaliacaoDTO
*/ 
    public function PesquisarMaxPKAtivoId_UsuarioPorStatus($daofactory, $id_usuario,$status)
    { 
        $dao = $daofactory->getUsuarioAvaliacaoDAO($daofactory);
        $maxid = $dao->loadMaxId_UsuarioPK($id_usuario,$status);
        return $this->carregarPorID($daofactory, $maxid);
    }

/**
* atualizar() - atualiza apenas um registro com base no dto UsuarioAvaliacaoDTO->id
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


        $dao = $daofactory->getUsuarioAvaliacaoDAO($daofactory);
        if(!$dao->update($dto)){
           $retorno->msgcode = ConstantesMensagem::ERRO_CRUD_ATUALIZAR_REGISTRO;
           $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);
    
        }
        // retorna situação
        return $retorno;

    }

/**
* deletar() - excluir fisicamente um registro com base no dto UsuarioAvaliacaoDTO->id
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
        $dao = $daofactory->getUsuarioAvaliacaoDAO($daofactory);

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
* @return List<UsuarioAvaliacaoDTO>[]
* @deprecated
*/ 

    public function listarPagina($daofactory, $pag, $qtde)  
    {   
        $dao = $daofactory->getUsuarioAvaliacaoDAO($daofactory);
        return $dao->listPagina($pag, $qtde);
    }

/**
* carregarPorID() - Carrega APENAS um registro usando a id como item de busca
* na tabela USUARIO_AVALIACAO usando a Primary Key USAV_ID
*
* @param $daofactory
* @param $id
* @param $qtde
*
* @return UsuarioAvaliacaoDTO
*/ 
    public function carregarPorID($daofactory, $id)
    { 
        $dao = $daofactory->getUsuarioAvaliacaoDAO($daofactory);
        return $dao->loadPK($id);
    }

/**
* atualizarStatus() - atualizar o campo de STATUS utilizando a id como item de busca
* na tabela USUARIO_AVALIACAO usando a Primary Key USAV_ID
*
* @param $daofactory
* @param $id
* @param $status
*
* @return UsuarioAvaliacaoDTO
*/ 
    public function atualizarStatus($daofactory, $id, $status)
    {
        $dao = $daofactory->getUsuarioAvaliacaoDAO($daofactory);

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
* inserir() - inserir um registro com base no UsuarioAvaliacaoDTO. Alguns atributos dentro do DTO
* serão ignorados caso estejam populados.
*
* Atributos da classe UsuarioAvaliacaoDTO sumariamente IGNORADOS por este método MESMO que estejam preenchidos:
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
    $ok = $this->validarTamanhoCampo($dto->id, 11, 'ID Usuário x Avaliação');
    if($ok->msgcode != ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO){
        return $ok;
    }

    // Efetua validações no campo $dto->id_usuario com tamanho 11
    $ok = $this->validarTamanhoCampo($dto->id_usuario, 11, 'ID do usuário');
    if($ok->msgcode != ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO){
        return $ok;
    }

    // Efetua validações no campo $dto->contadorStar_1 com tamanho 11
    $ok = $this->validarTamanhoCampo($dto->contadorStar_1, 11, 'Contador Avaliação Péssima');
    if($ok->msgcode != ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO){
        return $ok;
    }

    // Efetua validações no campo $dto->contadorStar_2 com tamanho 11
    $ok = $this->validarTamanhoCampo($dto->contadorStar_2, 11, 'Contador Avaliação Ruim');
    if($ok->msgcode != ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO){
        return $ok;
    }

    // Efetua validações no campo $dto->contadorStar_3 com tamanho 11
    $ok = $this->validarTamanhoCampo($dto->contadorStar_3, 11, 'Contador Avaliação Boa');
    if($ok->msgcode != ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO){
        return $ok;
    }

    // Efetua validações no campo $dto->contadorStar_4 com tamanho 11
    $ok = $this->validarTamanhoCampo($dto->contadorStar_4, 11, 'Contador Avaliação Ótima');
    if($ok->msgcode != ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO){
        return $ok;
    }

    // Efetua validações no campo $dto->contadorStar_5 com tamanho 11
    $ok = $this->validarTamanhoCampo($dto->contadorStar_5, 11, 'Contador Avaliação Excelente');
    if($ok->msgcode != ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO){
        return $ok;
    }

    // Efetua validações no campo $dto->ratingCalculado com tamanho 5
    $ok = $this->validarTamanhoCampo($dto->ratingCalculado, 5, 'Média da Avaliação');
    if($ok->msgcode != ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO){
        return $ok;
    }

    $dto->status = ConstantesVariavel::STATUS_ATIVO;
    $dao = $daofactory->getUsuarioAvaliacaoDAO($daofactory);

    if (!$dao->insert($dto)) {
        $retorno = new DTOPadrao();
        $retorno->msgcode = ConstantesMensagem::ERRO_CRUD_INSERIR_REGISTRO;
        $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);
    }

    return $retorno;
}

/**
*
* listarUsuarioAvaliacaoPorStatus() - Usado para invocar a interface de acesso aos dados (DAO) UsuarioAvaliacaoDAO de forma geral
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

    public function listarUsuarioAvaliacaoPorStatus($daofactory, $status, $pag, $qtde, $coluna, $ordem)
    {   
        $retorno = new DTOPaginacao();
        $retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
        $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);

        $dao = $daofactory->getUsuarioAvaliacaoDAO($daofactory);
        $retorno->pagina = $pag;
        $retorno->itensPorPagina = ($qtde == 0 
        ? (int) VariavelCache::getInstance()->getVariavel(ConstantesVariavel::MAXIMO_LINHAS_POR_PAGINA_DEFAULT)
        : $qtde);
        $retorno->totalPaginas = ceil($dao->countUsuarioAvaliacaoPorStatus($status) / $retorno->itensPorPagina);

        if($pag > $retorno->totalPaginas) {
            $retorno->msgcode = ConstantesMensagem::NAO_EXISTEM_MAIS_PAGINAS_APRESENTAR;
            $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);
            return $retorno;
        }
        $retorno->lst = $dao->listUsuarioAvaliacaoPorStatus($status, $pag, $qtde, $coluna, $ordem);

        return $retorno;
    }

/**
*
* atualizarId_UsuarioPorPK() - Usado para invocar a classe de negócio UsuarioAvaliacaoBusinessImpl de forma geral
* realizar uma atualização de ID do usuário diretamente na tabela USUARIO_AVALIACAO campo USUA_ID
* @param $daofactory
* @param $id
* @param $id_usuario
* @return UsuarioAvaliacaoDTO
*
* 
*/
    public function atualizarId_UsuarioPorPK($daofactory,$id_usuario,$id)
    {
        $dao = $daofactory->getUsuarioAvaliacaoDAO($daofactory);

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
* atualizarContadorstar_1PorPK() - Usado para invocar a classe de negócio UsuarioAvaliacaoBusinessImpl de forma geral
* realizar uma atualização de Contador Avaliação Péssima diretamente na tabela USUARIO_AVALIACAO campo USAV_NU_CONT_STAR_1
* @param $daofactory
* @param $id
* @param $contadorStar_1
* @return UsuarioAvaliacaoDTO
*
* 
*/
    public function atualizarContadorstar_1PorPK($daofactory,$contadorStar_1,$id)
    {
        $dao = $daofactory->getUsuarioAvaliacaoDAO($daofactory);

        // resposta padrão
        $retorno = new DTOPadrao();

        if($dao->updateContadorstar_1($id, $contadorStar_1)){   
            $retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
        }       

        // Obtem o texto da mensagem em razão do código de retorno
        $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);

        return $retorno;
    }

/**
*
* atualizarContadorstar_2PorPK() - Usado para invocar a classe de negócio UsuarioAvaliacaoBusinessImpl de forma geral
* realizar uma atualização de Contador Avaliação Ruim diretamente na tabela USUARIO_AVALIACAO campo USAV_NU_CONT_STAR_2
* @param $daofactory
* @param $id
* @param $contadorStar_2
* @return UsuarioAvaliacaoDTO
*
* 
*/
    public function atualizarContadorstar_2PorPK($daofactory,$contadorStar_2,$id)
    {
        $dao = $daofactory->getUsuarioAvaliacaoDAO($daofactory);

        // resposta padrão
        $retorno = new DTOPadrao();

        if($dao->updateContadorstar_2($id, $contadorStar_2)){   
            $retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
        }       

        // Obtem o texto da mensagem em razão do código de retorno
        $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);

        return $retorno;
    }

/**
*
* atualizarContadorstar_3PorPK() - Usado para invocar a classe de negócio UsuarioAvaliacaoBusinessImpl de forma geral
* realizar uma atualização de Contador Avaliação Boa diretamente na tabela USUARIO_AVALIACAO campo USAV_NU_CONT_STAR_3
* @param $daofactory
* @param $id
* @param $contadorStar_3
* @return UsuarioAvaliacaoDTO
*
* 
*/
    public function atualizarContadorstar_3PorPK($daofactory,$contadorStar_3,$id)
    {
        $dao = $daofactory->getUsuarioAvaliacaoDAO($daofactory);

        // resposta padrão
        $retorno = new DTOPadrao();

        if($dao->updateContadorstar_3($id, $contadorStar_3)){   
            $retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
        }       

        // Obtem o texto da mensagem em razão do código de retorno
        $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);

        return $retorno;
    }

/**
*
* atualizarContadorstar_4PorPK() - Usado para invocar a classe de negócio UsuarioAvaliacaoBusinessImpl de forma geral
* realizar uma atualização de Contador Avaliação Ótima diretamente na tabela USUARIO_AVALIACAO campo USAV_NU_CONT_STAR_4
* @param $daofactory
* @param $id
* @param $contadorStar_4
* @return UsuarioAvaliacaoDTO
*
* 
*/
    public function atualizarContadorstar_4PorPK($daofactory,$contadorStar_4,$id)
    {
        $dao = $daofactory->getUsuarioAvaliacaoDAO($daofactory);

        // resposta padrão
        $retorno = new DTOPadrao();

        if($dao->updateContadorstar_4($id, $contadorStar_4)){   
            $retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
        }       

        // Obtem o texto da mensagem em razão do código de retorno
        $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);

        return $retorno;
    }

/**
*
* atualizarContadorstar_5PorPK() - Usado para invocar a classe de negócio UsuarioAvaliacaoBusinessImpl de forma geral
* realizar uma atualização de Contador Avaliação Excelente diretamente na tabela USUARIO_AVALIACAO campo USAV_NU_CONT_STAR_5
* @param $daofactory
* @param $id
* @param $contadorStar_5
* @return UsuarioAvaliacaoDTO
*
* 
*/
    public function atualizarContadorstar_5PorPK($daofactory,$contadorStar_5,$id)
    {
        $dao = $daofactory->getUsuarioAvaliacaoDAO($daofactory);

        // resposta padrão
        $retorno = new DTOPadrao();

        if($dao->updateContadorstar_5($id, $contadorStar_5)){   
            $retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
        }       

        // Obtem o texto da mensagem em razão do código de retorno
        $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);

        return $retorno;
    }

/**
*
* atualizarRatingcalculadoPorPK() - Usado para invocar a classe de negócio UsuarioAvaliacaoBusinessImpl de forma geral
* realizar uma atualização de Média da Avaliação diretamente na tabela USUARIO_AVALIACAO campo USAV_NU_RATING
* @param $daofactory
* @param $id
* @param $ratingCalculado
* @return UsuarioAvaliacaoDTO
*
* 
*/
    public function atualizarRatingcalculadoPorPK($daofactory,$ratingCalculado,$id)
    {
        $dao = $daofactory->getUsuarioAvaliacaoDAO($daofactory);

        // resposta padrão
        $retorno = new DTOPadrao();

        if($dao->updateRatingcalculado($id, $ratingCalculado)){   
            $retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
        }       

        // Obtem o texto da mensagem em razão do código de retorno
        $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);

        return $retorno;
    }


/**
*
* pesquisarPorId_Usuario() - Usado para invocar a classe de negócio UsuarioAvaliacaoBusinessImpl de forma geral
* realizar uma busca de ID do usuário diretamente na tabela USUARIO_AVALIACAO campo USUA_ID
*
* @param $id_usuario
* @return UsuarioAvaliacaoDTO
*
* 
*/
    public function pesquisarPorId_Usuario($daofactory,$id_usuario)
    { 
        $dao = $daofactory->getUsuarioAvaliacaoDAO($daofactory);
        return $dao->loadId_Usuario($id_usuario);
    }

/**
*
* pesquisarPorContadorstar_1() - Usado para invocar a classe de negócio UsuarioAvaliacaoBusinessImpl de forma geral
* realizar uma busca de Contador Avaliação Péssima diretamente na tabela USUARIO_AVALIACAO campo USAV_NU_CONT_STAR_1
*
* @param $contadorStar_1
* @return UsuarioAvaliacaoDTO
*
* 
*/
    public function pesquisarPorContadorstar_1($daofactory,$contadorStar_1)

    { 
        $dao = $daofactory->getUsuarioAvaliacaoDAO($daofactory);
        return $dao->loadContadorstar_1($contadorStar_1);
    }

/**
*
* pesquisarPorContadorstar_2() - Usado para invocar a classe de negócio UsuarioAvaliacaoBusinessImpl de forma geral
* realizar uma busca de Contador Avaliação Ruim diretamente na tabela USUARIO_AVALIACAO campo USAV_NU_CONT_STAR_2
*
* @param $contadorStar_2
* @return UsuarioAvaliacaoDTO
*
* 
*/
    public function pesquisarPorContadorstar_2($daofactory,$contadorStar_2)

    { 
        $dao = $daofactory->getUsuarioAvaliacaoDAO($daofactory);
        return $dao->loadContadorstar_2($contadorStar_2);
    }

/**
*
* pesquisarPorContadorstar_3() - Usado para invocar a classe de negócio UsuarioAvaliacaoBusinessImpl de forma geral
* realizar uma busca de Contador Avaliação Boa diretamente na tabela USUARIO_AVALIACAO campo USAV_NU_CONT_STAR_3
*
* @param $contadorStar_3
* @return UsuarioAvaliacaoDTO
*
* 
*/
    public function pesquisarPorContadorstar_3($daofactory,$contadorStar_3)

    { 
        $dao = $daofactory->getUsuarioAvaliacaoDAO($daofactory);
        return $dao->loadContadorstar_3($contadorStar_3);
    }

/**
*
* pesquisarPorContadorstar_4() - Usado para invocar a classe de negócio UsuarioAvaliacaoBusinessImpl de forma geral
* realizar uma busca de Contador Avaliação Ótima diretamente na tabela USUARIO_AVALIACAO campo USAV_NU_CONT_STAR_4
*
* @param $contadorStar_4
* @return UsuarioAvaliacaoDTO
*
* 
*/
    public function pesquisarPorContadorstar_4($daofactory,$contadorStar_4)

    { 
        $dao = $daofactory->getUsuarioAvaliacaoDAO($daofactory);
        return $dao->loadContadorstar_4($contadorStar_4);
    }

/**
*
* pesquisarPorContadorstar_5() - Usado para invocar a classe de negócio UsuarioAvaliacaoBusinessImpl de forma geral
* realizar uma busca de Contador Avaliação Excelente diretamente na tabela USUARIO_AVALIACAO campo USAV_NU_CONT_STAR_5
*
* @param $contadorStar_5
* @return UsuarioAvaliacaoDTO
*
* 
*/
    public function pesquisarPorContadorstar_5($daofactory,$contadorStar_5)

    { 
        $dao = $daofactory->getUsuarioAvaliacaoDAO($daofactory);
        return $dao->loadContadorstar_5($contadorStar_5);
    }

/**
*
* pesquisarPorRatingcalculado() - Usado para invocar a classe de negócio UsuarioAvaliacaoBusinessImpl de forma geral
* realizar uma busca de Média da Avaliação diretamente na tabela USUARIO_AVALIACAO campo USAV_NU_RATING
*
* @param $ratingCalculado
* @return UsuarioAvaliacaoDTO
*
* 
*/
    public function pesquisarPorRatingcalculado($daofactory,$ratingCalculado)

    { 
        $dao = $daofactory->getUsuarioAvaliacaoDAO($daofactory);
        return $dao->loadRatingcalculado($ratingCalculado);
    }


/**
*
* listarUsuarioAvaliacaoUsuaIdPorStatus() - Usado para invocar a interface de acesso aos dados (DAO) UsuarioAvaliacaoDAO de forma geral
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

    public function listarUsuarioAvaliacaoPorUsuaIdStatus($daofactory, $usuaid, $status, $pag, $qtde, $coluna, $ordem)
    {   
        $retorno = new DTOPaginacao();
        $retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
        $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);

        $dao = $daofactory->getUsuarioAvaliacaoDAO($daofactory);
        $retorno->pagina = $pag;
        $retorno->itensPorPagina = ($qtde == 0 
        ? (int) VariavelCache::getInstance()->getVariavel(ConstantesVariavel::MAXIMO_LINHAS_POR_PAGINA_DEFAULT)
        : $qtde);
        $retorno->totalPaginas = ceil($dao->countUsuarioAvaliacaoPorUsuaIdStatus($usuaid, $status) / $retorno->itensPorPagina);

        if($pag > $retorno->totalPaginas) {
            $retorno->msgcode = ConstantesMensagem::NAO_EXISTEM_MAIS_PAGINAS_APRESENTAR;
            $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);
            return $retorno;
        }
        $retorno->lst = $dao->listUsuarioAvaliacaoPorUsuaIdStatus($usuaid, $status, $pag, $qtde, $coluna, $ordem);

        return $retorno;
    }

/**
* validarTamanhoCampo()
*
* Validador de tamanho de campos UsuarioAvaliacaoDTO
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
