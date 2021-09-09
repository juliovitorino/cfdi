<?php 

// importar dependencias
require_once 'UsuarioNotificacaoBusiness.php';

require_once '../dto/DTOPadrao.php';
require_once '../dto/DTOPaginacao.php';

require_once '../variavel/ConstantesVariavel.php';
require_once '../variavel/VariavelCache.php';

/**
*
* UsuarioNotificacaoBusinessImpl - Classe de implementação dos métodos de negócio para a interface UsuarioNotificacaoBusiness
* Camada de negócio UsuarioNotificacao - camada responsável pela lógica de negócios de UsuarioNotificacao do sistema. 
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
* @since 25/08/2019 16:16:12
*
*/


class UsuarioNotificacaoBusinessImpl implements UsuarioNotificacaoBusiness
{
    
    function __construct()  {   }

/**
* carregar() - Carrega apenas um registro com base no campo id = (USUARIO_NOTIFICACAO::USNO_ID)
* @param $daofactory
* @param $dto
* @return $dto
*/ 
    public function carregar($daofactory, $dto) {   }

/**
* listarTudo() - Lista todos os registros provenientes de USUARIO_NOTIFICACAO sem critério de paginação
* @param $daofactory
* @return List<UsuarioNotificacaoDTO>[]
*/ 
    public function listarTudo($daofactory) {   }

/**
* atualizar() - atualiza apenas um registro com base no dto UsuarioNotificacaoDTO->id
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


        $dao = $daofactory->getUsuarioNotificacaoDAO($daofactory);
        if(!$dao->update($dto)){
           $retorno->msgcode = ConstantesMensagem::ERRO_CRUD_ATUALIZAR_REGISTRO;
           $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);
    
        }
        // retorna situação
        return $retorno;

    }

/**
* deletar() - excluir fisicamente um registro com base no dto UsuarioNotificacaoDTO->id
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
        $dao = $daofactory->getUsuarioNotificacaoDAO($daofactory);

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
* @return List<UsuarioNotificacaoDTO>[]
* @deprecated
*/ 

    public function listarPagina($daofactory, $pag, $qtde)  
    {   
        $dao = $daofactory->getUsuarioNotificacaoDAO($daofactory);
        return $dao->listPagina($pag, $qtde);
    }

/**
* carregarPorID() - Carrega APENAS um registro usando a id como item de busca
* na tabela USUARIO_NOTIFICACAO usando a Primary Key USNO_ID
*
* @param $daofactory
* @param $id
* @param $qtde
*
* @return UsuarioNotificacaoDTO
*/ 
    public function carregarPorID($daofactory, $id)
    { 
        $dao = $daofactory->getUsuarioNotificacaoDAO($daofactory);
        return $dao->loadPK($id);
    }

/**
* atualizarStatus() - atualizar o campo de STATUS utilizando a id como item de busca
* na tabela USUARIO_NOTIFICACAO usando a Primary Key USNO_ID
*
* @param $daofactory
* @param $id
* @param $status
*
* @return UsuarioNotificacaoDTO
*/ 
    public function atualizarStatus($daofactory, $id, $status)
    {
        $dao = $daofactory->getUsuarioNotificacaoDAO($daofactory);

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
* inserir() - inserir um registro com base no UsuarioNotificacaoDTO. Alguns atributos dentro do DTO
* serão ignorados caso estejam populados.
*
* Atributos da classe UsuarioNotificacaoDTO sumariamente IGNORADOS por este método MESMO que estejam preenchidos:
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
    $ok = $this->validarTamanhoCampo($dto->id, 11, 'ID da notificação');
    if($ok->msgcode != ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO){
        return $ok;
    }

    // Efetua validações no campo $dto->id_usuario com tamanho 11
    $ok = $this->validarTamanhoCampo($dto->id_usuario, 11, 'ID do usuário');
    if($ok->msgcode != ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO){
        return $ok;
    }

    // Efetua validações no campo $dto->notificacao com tamanho 500
    $ok = $this->validarTamanhoCampo($dto->notificacao, 500, 'Notificação');
    if($ok->msgcode != ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO){
        return $ok;
    }

    // Efetua validações no campo $dto->icone com tamanho 20
    $ok = $this->validarTamanhoCampo($dto->icone, 20, 'URL Icone');
    if($ok->msgcode != ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO){
        return $ok;
    }

    // Efetua validações no campo $dto->imagem com tamanho 1000
    $ok = $this->validarTamanhoCampo($dto->imagem, 1000, 'URL Imagem');
    if($ok->msgcode != ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO){
        return $ok;
    }

    // Efetua validações no campo $dto->bkgcor com tamanho 7
    $ok = $this->validarTamanhoCampo($dto->bkgcor, 7, 'Cor de fundo');
    if($ok->msgcode != ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO){
        return $ok;
    }

    // Efetua validações no campo $dto->tipo com tamanho 2
    $ok = $this->validarTamanhoCampo($dto->tipo, 2, 'Classificador da notificação');
    if($ok->msgcode != ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO){
        return $ok;
    }

    // Efetua validações no campo $dto->dataPrevApagar com tamanho 19
    $ok = $this->validarTamanhoCampo($dto->dataPrevApagar, 19, 'Data Prevista Remoção');
    if($ok->msgcode != ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO){
        return $ok;
    }
/*
    // Efetua validações no campo $dto->status com tamanho 1
    $ok = $this->validarTamanhoCampo($dto->status, 1, 'Status');
    if($ok->msgcode != ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO){
        return $ok;
    }

    // Efetua validações no campo $dto->dataCadastro com tamanho 19
    $ok = $this->validarTamanhoCampo($dto->dataCadastro, 19, 'Data de Cadastro');
    if($ok->msgcode != ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO){
        return $ok;
    }

    // Efetua validações no campo $dto->dataAtualizacao com tamanho 19
    $ok = $this->validarTamanhoCampo($dto->dataAtualizacao, 19, 'Data de Atualização');
    if($ok->msgcode != ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO){
        return $ok;
    }
*/

    $dto->status = ConstantesVariavel::STATUS_ATIVO;
    $dao = $daofactory->getUsuarioNotificacaoDAO($daofactory);

    if (!$dao->insert($dto)) {
        $retorno = new DTOPadrao();
        $retorno->msgcode = ConstantesMensagem::ERRO_CRUD_INSERIR_REGISTRO;
        $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);
    }

    return $retorno;
}

/**
*
* listarUsuarioNotificacaoPorStatus() - Usado para invocar a interface de acesso aos dados (DAO) UsuarioNotificacaoDAO de forma geral
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

    public function listarUsuarioNotificacaoPorStatus($daofactory, $status, $pag, $qtde, $coluna, $ordem)
    {   
        $retorno = new DTOPaginacao();
        $retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
        $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);

        $dao = $daofactory->getUsuarioNotificacaoDAO($daofactory);
        $retorno->pagina = $pag;
        $retorno->itensPorPagina = ($qtde == 0 
        ? (int) VariavelCache::getInstance()->getVariavel(ConstantesVariavel::MAXIMO_LINHAS_POR_PAGINA_DEFAULT)
        : $qtde);
        $retorno->totalPaginas = ceil($dao->countUsuarioNotificacaoPorStatus($status) / $retorno->itensPorPagina);

        if($pag > $retorno->totalPaginas) {
            $retorno->msgcode = ConstantesMensagem::NAO_EXISTEM_MAIS_PAGINAS_APRESENTAR;
            $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);
            return $retorno;
        }
        $retorno->lst = $dao->listUsuarioNotificacaoPorStatus($status, $pag, $retorno->itensPorPagina, $coluna, $ordem);

        return $retorno;
    }

/**
*
* listarUsuarioNotificacaoUsuaIdPorStatus() - Usado para invocar a interface de acesso aos dados (DAO) UsuarioNotificacaoDAO de forma geral
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

    public function listarUsuarioNotificacaoPorUsuaIdStatus($daofactory, $usuaid, $status, $pag, $qtde, $coluna, $ordem)
    {   
        $retorno = new DTOPaginacao();
        $retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
        $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);

        $dao = $daofactory->getUsuarioNotificacaoDAO($daofactory);
        $retorno->pagina = $pag;
        $retorno->itensPorPagina = ($qtde == 0 
        ? (int) VariavelCache::getInstance()->getVariavel(ConstantesVariavel::MAXIMO_LINHAS_POR_PAGINA_DEFAULT)
        : $qtde);
        $retorno->totalPaginas = ceil($dao->countUsuarioNotificacaoPorUsuaIdStatus($usuaid, $status) / $retorno->itensPorPagina);

        if($pag > $retorno->totalPaginas) {
            $retorno->msgcode = ConstantesMensagem::NAO_EXISTEM_MAIS_PAGINAS_APRESENTAR;
            $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);
            return $retorno;
        }
        $retorno->lst = $dao->listUsuarioNotificacaoPorUsuaIdStatus($usuaid, $status, $pag, $retorno->itensPorPagina, $coluna, $ordem);

        return $retorno;
    }

/**
* validarTamanhoCampo()
*
* Validador de tamanho de campos UsuarioNotificacaoDTO
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
