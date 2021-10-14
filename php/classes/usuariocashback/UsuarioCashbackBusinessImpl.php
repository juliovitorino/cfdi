<?php 

// importar dependencias
require_once 'UsuarioCashbackBusiness.php';

require_once '../dto/DTOPadrao.php';
require_once '../dto/DTOPaginacao.php';
require_once '../variavel/ConstantesVariavel.php';
require_once '../variavel/VariavelCache.php';
require_once '../campanha/campanhaBusinessImpl.php';
require_once '../campanhacashback/CampanhaCashbackBusinessImpl.php';
require_once '../campanhacashback/CampanhaCashbackDTO.php';

/**
*
* UsuarioCashbackBusinessImpl - Classe de implementação dos métodos de negócio para a interface UsuarioCashbackBusiness
* Camada de negócio UsuarioCashback - camada responsável pela lógica de negócios de UsuarioCashback do sistema. 
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
* @since 06/09/2019 08:43:34
*
*/


class UsuarioCashbackBusinessImpl implements UsuarioCashbackBusiness
{
    
    function __construct()  {   }

/**
* carregar() - Carrega apenas um registro com base no campo id = (USUARIO_CASHBACK::USCA_ID)
* @param $daofactory
* @param $dto
* @return $dto
*/ 
    public function carregar($daofactory, $dto) {   }

/**
* listarTudo() - Lista todos os registros provenientes de USUARIO_CASHBACK sem critério de paginação
* @param $daofactory
* @return List<UsuarioCashbackDTO>[]
*/ 
    public function listarTudo($daofactory) {   }

/**
* PesquisarMaxPKAtivoId_UsuarioPorStatus() - Carrega apenas um registro com base no id_usuario  e status para buscar a MAIOR PK
* @param $daofactory
* @param $status
* @return UsuarioCashbackDTO
*/ 
    public function PesquisarMaxPKAtivoId_UsuarioPorStatus($daofactory, $id_usuario,$status)
    { 
        $dao = $daofactory->getUsuarioCashbackDAO($daofactory);
        $maxid = $dao->loadMaxId_UsuarioPK($id_usuario,$status);
        return $this->carregarPorID($daofactory, $maxid);
    }

/**
* atualizar() - atualiza apenas um registro com base no dto UsuarioCashbackDTO->id
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


        $dao = $daofactory->getUsuarioCashbackDAO($daofactory);
        if(!$dao->update($dto)){
           $retorno->msgcode = ConstantesMensagem::ERRO_CRUD_ATUALIZAR_REGISTRO;
           $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);
    
        }
        // retorna situação
        return $retorno;

    }

/**
* deletar() - excluir fisicamente um registro com base no dto UsuarioCashbackDTO->id
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
        $dao = $daofactory->getUsuarioCashbackDAO($daofactory);

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
* @return List<UsuarioCashbackDTO>[]
* @deprecated
*/ 

    public function listarPagina($daofactory, $pag, $qtde)  
    {   
        $dao = $daofactory->getUsuarioCashbackDAO($daofactory);
        return $dao->listPagina($pag, $qtde);
    }

/**
* carregarPorID() - Carrega APENAS um registro usando a id como item de busca
* na tabela USUARIO_CASHBACK usando a Primary Key USCA_ID
*
* @param $daofactory
* @param $id
* @param $qtde
*
* @return UsuarioCashbackDTO
*/ 
    public function carregarPorID($daofactory, $id)
    { 
        $dao = $daofactory->getUsuarioCashbackDAO($daofactory);
        return $dao->loadPK($id);
    }

/**
* atualizarStatus() - atualizar o campo de STATUS utilizando a id como item de busca
* na tabela USUARIO_CASHBACK usando a Primary Key USCA_ID
*
* @param $daofactory
* @param $id
* @param $status
*
* @return UsuarioCashbackDTO
*/ 
    public function atualizarStatus($daofactory, $id, $status)
    {
        $dao = $daofactory->getUsuarioCashbackDAO($daofactory);

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
* inserir() - inserir um registro com base no UsuarioCashbackDTO. Alguns atributos dentro do DTO
* serão ignorados caso estejam populados.
*
* Atributos da classe UsuarioCashbackDTO sumariamente IGNORADOS por este método MESMO que estejam preenchidos:
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
    $ok = $this->validarTamanhoCampo($dto->id, 11, 'ID Usuario x Cashback');
    if($ok->msgcode != ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO){
        return $ok;
    }

    // Efetua validações no campo $dto->id_usuario com tamanho 11
    $ok = $this->validarTamanhoCampo($dto->id_usuario, 11, 'ID do usuário');
    if($ok->msgcode != ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO){
        return $ok;
    }

    // Efetua validações no campo $dto->vlMinimoResgate com tamanho 10
    $ok = $this->validarTamanhoCampo($dto->vlMinimoResgate, 10, 'Resgatar a partir de');
    if($ok->msgcode != ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO){
        return $ok;
    }

    // Efetua validações no campo $dto->percentual com tamanho 6
    $ok = $this->validarTamanhoCampo($dto->percentual, 6, 'Percentual');
    if($ok->msgcode != ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO){
        return $ok;
    }

    // Efetua validações no campo $dto->obs com tamanho 2000
    $ok = $this->validarTamanhoCampo($dto->obs, 2000, 'Observação');
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
    $dao = $daofactory->getUsuarioCashbackDAO($daofactory);

    if (!$dao->insert($dto)) {
        $retorno = new DTOPadrao();
        $retorno->msgcode = ConstantesMensagem::ERRO_CRUD_INSERIR_REGISTRO;
        $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);


    }
    // Insere um registro em cada campanha x cashback que NÃO tenha configuração
    $campbo = new CampanhaBusinessImpl();
    $lst = $campbo->listarCampanhasUsuarioStatus($daofactory, $dto->id_usuario, ConstantesVariavel::STATUS_ATIVO);

    if($lst != NULL && count($lst) > 0){
        $cacabo = new CampanhaCashbackBusinessImpl(); 
        foreach ($lst as $key => $campdto) {

            // Verifica se tem campanha x cashback ativa
            $cacadto = $cacabo->PesquisarMaxPKAtivoId_UsuarioIdCampanhaPorStatus($daofactory, $dto->id_usuario, $campdto->id, ConstantesVariavel::STATUS_ATIVO);

            if($cacadto->id == NULL){
                $cacadto->id_campanha = $campdto->id;
                $cacadto->id_usuario = $dto->id_usuario;
                $cacadto->percentual = 0;
                $cacadto->dataTermino = Util::getNow();
                $cacadto->obs = '.';
                $retorno = $cacabo->inserir($daofactory, $cacadto);

            }
        }
    }

    return $retorno;
}

/**
*
* listarUsuarioCashbackPorStatus() - Usado para invocar a interface de acesso aos dados (DAO) UsuarioCashbackDAO de forma geral
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

    public function listarUsuarioCashbackPorStatus($daofactory, $status, $pag, $qtde, $coluna, $ordem)
    {   
        $retorno = new DTOPaginacao();
        $retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
        $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);

        $dao = $daofactory->getUsuarioCashbackDAO($daofactory);
        $retorno->pagina = $pag;
        $retorno->itensPorPagina = ($qtde == 0 
        ? (int) VariavelCache::getInstance()->getVariavel(ConstantesVariavel::MAXIMO_LINHAS_POR_PAGINA_DEFAULT)
        : $qtde);
        $retorno->totalPaginas = ceil($dao->countUsuarioCashbackPorStatus($status) / $retorno->itensPorPagina);

        if($pag > $retorno->totalPaginas) {
            $retorno->msgcode = ConstantesMensagem::NAO_EXISTEM_MAIS_PAGINAS_APRESENTAR;
            $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);
            return $retorno;
        }
        $retorno->lst = $dao->listUsuarioCashbackPorStatus($status, $pag, $retorno->itensPorPagina, $coluna, $ordem);

        return $retorno;
    }






/**
*
* atualizarId_UsuarioPorPK() - Usado para invocar a classe de negócio UsuarioCashbackBusinessImpl de forma geral
* realizar uma atualização de ID do usuário diretamente na tabela USUARIO_CASHBACK campo USUA_ID
* @param $daofactory
* @param $id
* @param $id_usuario
* @return UsuarioCashbackDTO
*
* 
*/
    public function atualizarId_UsuarioPorPK($daofactory,$id_usuario,$id)
    {
        $dao = $daofactory->getUsuarioCashbackDAO($daofactory);

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
* atualizarVlminimoresgatePorPK() - Usado para invocar a classe de negócio UsuarioCashbackBusinessImpl de forma geral
* realizar uma atualização de Resgatar a partir de diretamente na tabela USUARIO_CASHBACK campo USCA_VL_RESGATE
* @param $daofactory
* @param $id
* @param $vlMinimoResgate
* @return UsuarioCashbackDTO
*
* 
*/
    public function atualizarVlminimoresgatePorPK($daofactory,$vlMinimoResgate,$id)
    {
        $dao = $daofactory->getUsuarioCashbackDAO($daofactory);

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
* atualizarPercentualPorPK() - Usado para invocar a classe de negócio UsuarioCashbackBusinessImpl de forma geral
* realizar uma atualização de Percentual diretamente na tabela USUARIO_CASHBACK campo USCA_VL_PERC_CASHBACK
* @param $daofactory
* @param $id
* @param $percentual
* @return UsuarioCashbackDTO
*
* 
*/
    public function atualizarPercentualPorPK($daofactory,$percentual,$id)
    {
        $dao = $daofactory->getUsuarioCashbackDAO($daofactory);

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
* atualizarObsPorPK() - Usado para invocar a classe de negócio UsuarioCashbackBusinessImpl de forma geral
* realizar uma atualização de Observação diretamente na tabela USUARIO_CASHBACK campo USCA_TX_OBS
* @param $daofactory
* @param $id
* @param $obs
* @return UsuarioCashbackDTO
*
* 
*/
    public function atualizarObsPorPK($daofactory,$obs,$id)
    {
        $dao = $daofactory->getUsuarioCashbackDAO($daofactory);

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
* atualizarContadorstar_1PorPK() - Usado para invocar a classe de negócio UsuarioCashbackBusinessImpl de forma geral
* realizar uma atualização de Contador Avaliação Péssima diretamente na tabela USUARIO_CASHBACK campo USCA_NU_CONT_STAR_1
* @param $daofactory
* @param $id
* @param $contadorStar_1
* @return UsuarioCashbackDTO
*
* 
*/
    public function atualizarContadorstar_1PorPK($daofactory,$contadorStar_1,$id)
    {
        $dao = $daofactory->getUsuarioCashbackDAO($daofactory);

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
* atualizarContadorstar_2PorPK() - Usado para invocar a classe de negócio UsuarioCashbackBusinessImpl de forma geral
* realizar uma atualização de Contador Avaliação Ruim diretamente na tabela USUARIO_CASHBACK campo USCA_NU_CONT_STAR_2
* @param $daofactory
* @param $id
* @param $contadorStar_2
* @return UsuarioCashbackDTO
*
* 
*/
    public function atualizarContadorstar_2PorPK($daofactory,$contadorStar_2,$id)
    {
        $dao = $daofactory->getUsuarioCashbackDAO($daofactory);

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
* atualizarContadorstar_3PorPK() - Usado para invocar a classe de negócio UsuarioCashbackBusinessImpl de forma geral
* realizar uma atualização de Contador Avaliação Boa diretamente na tabela USUARIO_CASHBACK campo USCA_NU_CONT_STAR_3
* @param $daofactory
* @param $id
* @param $contadorStar_3
* @return UsuarioCashbackDTO
*
* 
*/
    public function atualizarContadorstar_3PorPK($daofactory,$contadorStar_3,$id)
    {
        $dao = $daofactory->getUsuarioCashbackDAO($daofactory);

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
* atualizarContadorstar_4PorPK() - Usado para invocar a classe de negócio UsuarioCashbackBusinessImpl de forma geral
* realizar uma atualização de Contador Avaliação Ótima diretamente na tabela USUARIO_CASHBACK campo USCA_NU_CONT_STAR_4
* @param $daofactory
* @param $id
* @param $contadorStar_4
* @return UsuarioCashbackDTO
*
* 
*/
    public function atualizarContadorstar_4PorPK($daofactory,$contadorStar_4,$id)
    {
        $dao = $daofactory->getUsuarioCashbackDAO($daofactory);

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
* atualizarContadorstar_5PorPK() - Usado para invocar a classe de negócio UsuarioCashbackBusinessImpl de forma geral
* realizar uma atualização de Contador Avaliação Excelente diretamente na tabela USUARIO_CASHBACK campo USCA_NU_CONT_STAR_5
* @param $daofactory
* @param $id
* @param $contadorStar_5
* @return UsuarioCashbackDTO
*
* 
*/
    public function atualizarContadorstar_5PorPK($daofactory,$contadorStar_5,$id)
    {
        $dao = $daofactory->getUsuarioCashbackDAO($daofactory);

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
* atualizarRatingcalculadoPorPK() - Usado para invocar a classe de negócio UsuarioCashbackBusinessImpl de forma geral
* realizar uma atualização de Média da Avaliação diretamente na tabela USUARIO_CASHBACK campo USCA_NU_RATING
* @param $daofactory
* @param $id
* @param $ratingCalculado
* @return UsuarioCashbackDTO
*
* 
*/
    public function atualizarRatingcalculadoPorPK($daofactory,$ratingCalculado,$id)
    {
        $dao = $daofactory->getUsuarioCashbackDAO($daofactory);

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
* pesquisarPorId_Usuario() - Usado para invocar a classe de negócio UsuarioCashbackBusinessImpl de forma geral
* realizar uma busca de ID do usuário diretamente na tabela USUARIO_CASHBACK campo USUA_ID
*
* @param $id_usuario
* @return UsuarioCashbackDTO
*
* 
*/
    public function pesquisarPorId_Usuario($daofactory,$id_usuario)
    { 
        $dao = $daofactory->getUsuarioCashbackDAO($daofactory);
        return $dao->loadId_Usuario($id_usuario);
    }

/**
*
* pesquisarPorVlminimoresgate() - Usado para invocar a classe de negócio UsuarioCashbackBusinessImpl de forma geral
* realizar uma busca de Resgatar a partir de diretamente na tabela USUARIO_CASHBACK campo USCA_VL_RESGATE
*
* @param $vlMinimoResgate
* @return UsuarioCashbackDTO
*
* 
*/
    public function pesquisarPorVlminimoresgate($daofactory,$vlMinimoResgate)

    { 
        $dao = $daofactory->getUsuarioCashbackDAO($daofactory);
        return $dao->loadVlminimoresgate($vlMinimoResgate);
    }

/**
*
* pesquisarPorPercentual() - Usado para invocar a classe de negócio UsuarioCashbackBusinessImpl de forma geral
* realizar uma busca de Percentual diretamente na tabela USUARIO_CASHBACK campo USCA_VL_PERC_CASHBACK
*
* @param $percentual
* @return UsuarioCashbackDTO
*
* 
*/
    public function pesquisarPorPercentual($daofactory,$percentual)

    { 
        $dao = $daofactory->getUsuarioCashbackDAO($daofactory);
        return $dao->loadPercentual($percentual);
    }

/**
*
* pesquisarPorObs() - Usado para invocar a classe de negócio UsuarioCashbackBusinessImpl de forma geral
* realizar uma busca de Observação diretamente na tabela USUARIO_CASHBACK campo USCA_TX_OBS
*
* @param $obs
* @return UsuarioCashbackDTO
*
* 
*/
    public function pesquisarPorObs($daofactory,$obs)

    { 
        $dao = $daofactory->getUsuarioCashbackDAO($daofactory);
        return $dao->loadObs($obs);
    }

/**
*
* pesquisarPorContadorstar_1() - Usado para invocar a classe de negócio UsuarioCashbackBusinessImpl de forma geral
* realizar uma busca de Contador Avaliação Péssima diretamente na tabela USUARIO_CASHBACK campo USCA_NU_CONT_STAR_1
*
* @param $contadorStar_1
* @return UsuarioCashbackDTO
*
* 
*/
    public function pesquisarPorContadorstar_1($daofactory,$contadorStar_1)

    { 
        $dao = $daofactory->getUsuarioCashbackDAO($daofactory);
        return $dao->loadContadorstar_1($contadorStar_1);
    }

/**
*
* pesquisarPorContadorstar_2() - Usado para invocar a classe de negócio UsuarioCashbackBusinessImpl de forma geral
* realizar uma busca de Contador Avaliação Ruim diretamente na tabela USUARIO_CASHBACK campo USCA_NU_CONT_STAR_2
*
* @param $contadorStar_2
* @return UsuarioCashbackDTO
*
* 
*/
    public function pesquisarPorContadorstar_2($daofactory,$contadorStar_2)

    { 
        $dao = $daofactory->getUsuarioCashbackDAO($daofactory);
        return $dao->loadContadorstar_2($contadorStar_2);
    }

/**
*
* pesquisarPorContadorstar_3() - Usado para invocar a classe de negócio UsuarioCashbackBusinessImpl de forma geral
* realizar uma busca de Contador Avaliação Boa diretamente na tabela USUARIO_CASHBACK campo USCA_NU_CONT_STAR_3
*
* @param $contadorStar_3
* @return UsuarioCashbackDTO
*
* 
*/
    public function pesquisarPorContadorstar_3($daofactory,$contadorStar_3)

    { 
        $dao = $daofactory->getUsuarioCashbackDAO($daofactory);
        return $dao->loadContadorstar_3($contadorStar_3);
    }

/**
*
* pesquisarPorContadorstar_4() - Usado para invocar a classe de negócio UsuarioCashbackBusinessImpl de forma geral
* realizar uma busca de Contador Avaliação Ótima diretamente na tabela USUARIO_CASHBACK campo USCA_NU_CONT_STAR_4
*
* @param $contadorStar_4
* @return UsuarioCashbackDTO
*
* 
*/
    public function pesquisarPorContadorstar_4($daofactory,$contadorStar_4)

    { 
        $dao = $daofactory->getUsuarioCashbackDAO($daofactory);
        return $dao->loadContadorstar_4($contadorStar_4);
    }

/**
*
* pesquisarPorContadorstar_5() - Usado para invocar a classe de negócio UsuarioCashbackBusinessImpl de forma geral
* realizar uma busca de Contador Avaliação Excelente diretamente na tabela USUARIO_CASHBACK campo USCA_NU_CONT_STAR_5
*
* @param $contadorStar_5
* @return UsuarioCashbackDTO
*
* 
*/
    public function pesquisarPorContadorstar_5($daofactory,$contadorStar_5)

    { 
        $dao = $daofactory->getUsuarioCashbackDAO($daofactory);
        return $dao->loadContadorstar_5($contadorStar_5);
    }

/**
*
* pesquisarPorRatingcalculado() - Usado para invocar a classe de negócio UsuarioCashbackBusinessImpl de forma geral
* realizar uma busca de Média da Avaliação diretamente na tabela USUARIO_CASHBACK campo USCA_NU_RATING
*
* @param $ratingCalculado
* @return UsuarioCashbackDTO
*
* 
*/
    public function pesquisarPorRatingcalculado($daofactory,$ratingCalculado)

    { 
        $dao = $daofactory->getUsuarioCashbackDAO($daofactory);
        return $dao->loadRatingcalculado($ratingCalculado);
    }

/**
*
* listarUsuarioCashbackUsuaIdPorStatus() - Usado para invocar a interface de acesso aos dados (DAO) UsuarioCashbackDAO de forma geral
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

    public function listarUsuarioCashbackPorUsuaIdStatus($daofactory, $usuaid, $status, $pag, $qtde, $coluna, $ordem)
    {   
        $retorno = new DTOPaginacao();
        $retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
        $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);

        $dao = $daofactory->getUsuarioCashbackDAO($daofactory);
        $retorno->pagina = $pag;
        $retorno->itensPorPagina = ($qtde == 0 
        ? (int) VariavelCache::getInstance()->getVariavel(ConstantesVariavel::MAXIMO_LINHAS_POR_PAGINA_DEFAULT)
        : $qtde);
        $retorno->totalPaginas = ceil($dao->countUsuarioCashbackPorUsuaIdStatus($usuaid, $status) / $retorno->itensPorPagina);

        if($pag > $retorno->totalPaginas) {
            $retorno->msgcode = ConstantesMensagem::NAO_EXISTEM_MAIS_PAGINAS_APRESENTAR;
            $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);
            return $retorno;
        }
        $retorno->lst = $dao->listUsuarioCashbackPorUsuaIdStatus($usuaid, $status, $pag, $retorno->itensPorPagina, $coluna, $ordem);

        return $retorno;
    }

/**
* validarTamanhoCampo()
*
* Validador de tamanho de campos UsuarioCashbackDTO
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
