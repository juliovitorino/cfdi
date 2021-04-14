<?php 

// importar dependencias
require_once 'FilaQRCodePendenteProduzirBusiness.php';
require_once 'FilaQRCodePendenteProduzirConstantes.php';
require_once '../dto/DTOPadrao.php';
require_once '../dto/DTOPaginacao.php';

require_once '../variavel/ConstantesVariavel.php';
require_once '../variavel/VariavelCache.php';

/**
*
* FilaQRCodePendenteProduzirBusinessImpl - Classe de implementação dos métodos de negócio para a interface FilaQRCodePendenteProduzirBusiness
* Camada de negócio FilaQRCodePendenteProduzir - camada responsável pela lógica de negócios de FilaQRCodePendenteProduzir do sistema. 
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
* @since 26/10/2019 10:27:47
*
*/


class FilaQRCodePendenteProduzirBusinessImpl implements FilaQRCodePendenteProduzirBusiness
{
    
    function __construct()  {   }

/**
* carregar() - Carrega apenas um registro com base no campo id = (FILA_QRCODES_PNDNT_PRD::FQPP_ID)
* @param $daofactory
* @param $dto
* @return $dto
*/ 
    public function carregar($daofactory, $dto) {   }

/**
* listarTudo() - Lista todos os registros provenientes de FILA_QRCODES_PNDNT_PRD sem critério de paginação
* @param $daofactory
* @return List<FilaQRCodePendenteProduzirDTO>[]
*/ 
    public function listarTudo($daofactory) {   }

/**
* pesquisarMaxPKAtivoId_CampanhaPorStatus() - Carrega apenas um registro com base no id_campanha  e status para buscar a MAIOR PK
* @param $daofactory
* @param $status
* @return FilaQRCodePendenteProduzirDTO
*/ 
    public function pesquisarMaxPKAtivoId_CampanhaPorStatus($daofactory, $id_campanha,$status)
    { 
        $dao = $daofactory->getFilaQRCodePendenteProduzirDAO($daofactory);
        $maxid = $dao->loadMaxId_CampanhaPK($id_campanha,$status);
        return $this->carregarPorID($daofactory, $maxid);
    }

/**
* atualizar() - atualiza apenas um registro com base no dto FilaQRCodePendenteProduzirDTO->id
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


        $dao = $daofactory->getFilaQRCodePendenteProduzirDAO($daofactory);
        if(!$dao->update($dto)){
           $retorno->msgcode = ConstantesMensagem::ERRO_CRUD_ATUALIZAR_REGISTRO;
           $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);
    
        }
        // retorna situação
        return $retorno;

    }

/**
* deletar() - excluir fisicamente um registro com base no dto FilaQRCodePendenteProduzirDTO->id
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
        $dao = $daofactory->getFilaQRCodePendenteProduzirDAO($daofactory);

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
* @return List<FilaQRCodePendenteProduzirDTO>[]
* @deprecated
*/ 

    public function listarPagina($daofactory, $pag, $qtde)  
    {   
        $dao = $daofactory->getFilaQRCodePendenteProduzirDAO($daofactory);
        return $dao->listPagina($pag, $qtde);
    }

/**
* carregarPorID() - Carrega APENAS um registro usando a id como item de busca
* na tabela FILA_QRCODES_PNDNT_PRD usando a Primary Key FQPP_ID
*
* @param $daofactory
* @param $id
* @param $qtde
*
* @return FilaQRCodePendenteProduzirDTO
*/ 
    public function carregarPorID($daofactory, $id)
    { 
        $dao = $daofactory->getFilaQRCodePendenteProduzirDAO($daofactory);
        return $dao->loadPK($id);
    }

/**
* atualizarStatus() - atualizar o campo de STATUS utilizando a id como item de busca
* na tabela FILA_QRCODES_PNDNT_PRD usando a Primary Key FQPP_ID
*
* @param $daofactory
* @param $id
* @param $status
*
* @return FilaQRCodePendenteProduzirDTO
*/ 
    public function atualizarStatus($daofactory, $id, $status)
    {
        $dao = $daofactory->getFilaQRCodePendenteProduzirDAO($daofactory);

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
* inserir() - inserir um registro com base no FilaQRCodePendenteProduzirDTO. Alguns atributos dentro do DTO
* serão ignorados caso estejam populados.
*
* Atributos da classe FilaQRCodePendenteProduzirDTO sumariamente IGNORADOS por este método MESMO que estejam preenchidos:
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

    // Efetua validações no campo $dto->id com tamanho FilaQRCodePendenteProduzirConstantes::LEN_ID
    $ok = $this->validarTamanhoCampo($dto->id, FilaQRCodePendenteProduzirConstantes::LEN_ID, FilaQRCodePendenteProduzirConstantes::DESC_ID);
    if($ok->msgcode != ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO){
        return $ok;
    }

    // Efetua validações no campo $dto->id_campanha com tamanho FilaQRCodePendenteProduzirConstantes::LEN_ID_CAMPANHA
    $ok = $this->validarTamanhoCampo($dto->id_campanha, FilaQRCodePendenteProduzirConstantes::LEN_ID_CAMPANHA, FilaQRCodePendenteProduzirConstantes::DESC_ID_CAMPANHA);
    if($ok->msgcode != ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO){
        return $ok;
    }

    // Efetua validações no campo $dto->id_usuario com tamanho FilaQRCodePendenteProduzirConstantes::LEN_ID_USUARIO
    $ok = $this->validarTamanhoCampo($dto->id_usuario, FilaQRCodePendenteProduzirConstantes::LEN_ID_USUARIO, FilaQRCodePendenteProduzirConstantes::DESC_ID_USUARIO);
    if($ok->msgcode != ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO){
        return $ok;
    }

    // Efetua validações no campo $dto->qtde com tamanho FilaQRCodePendenteProduzirConstantes::LEN_QTDE
    $ok = $this->validarTamanhoCampo($dto->qtde, FilaQRCodePendenteProduzirConstantes::LEN_QTDE, FilaQRCodePendenteProduzirConstantes::DESC_QTDE);
    if($ok->msgcode != ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO){
        return $ok;
    }

    $dto->status = ConstantesVariavel::STATUS_ATIVO;
    $dao = $daofactory->getFilaQRCodePendenteProduzirDAO($daofactory);

    if (!$dao->insert($dto)) {
        $retorno = new DTOPadrao();
        $retorno->msgcode = ConstantesMensagem::ERRO_CRUD_INSERIR_REGISTRO;
        $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);
    }

    return $retorno;
}

/**
*
* listarFilaQRCodePendenteProduzirPorStatus() - Usado para invocar a interface de acesso aos dados (DAO) FilaQRCodePendenteProduzirDAO de forma geral
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

    public function listarFilaQRCodePendenteProduzirPorStatus($daofactory, $status, $pag, $qtde, $coluna, $ordem)
    {   
        $retorno = new DTOPaginacao();
        $retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
        $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);

        $dao = $daofactory->getFilaQRCodePendenteProduzirDAO($daofactory);
        $retorno->pagina = $pag;
        $retorno->itensPorPagina = ($qtde == 0 
        ? (int) VariavelCache::getInstance()->getVariavel(ConstantesVariavel::MAXIMO_LINHAS_POR_PAGINA_DEFAULT)
        : $qtde);
        $retorno->totalPaginas = ceil($dao->countFilaQRCodePendenteProduzirPorStatus($status) / $retorno->itensPorPagina);

        if($pag > $retorno->totalPaginas) {
            $retorno->msgcode = ConstantesMensagem::NAO_EXISTEM_MAIS_PAGINAS_APRESENTAR;
            $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);
            return $retorno;
        }
        $retorno->lst = $dao->listFilaQRCodePendenteProduzirPorStatus($status, $pag, $qtde, $coluna, $ordem);

        return $retorno;
    }






/**
*
* atualizarId_CampanhaPorPK() - Usado para invocar a classe de negócio FilaQRCodePendenteProduzirBusinessImpl de forma geral
* realizar uma atualização de ID da campanha diretamente na tabela FILA_QRCODES_PNDNT_PRD campo CAMP_ID
* @param $daofactory
* @param $id
* @param $id_campanha
* @return FilaQRCodePendenteProduzirDTO
*
* 
*/
    public function atualizarId_CampanhaPorPK($daofactory,$id_campanha,$id)
    {
        $dao = $daofactory->getFilaQRCodePendenteProduzirDAO($daofactory);

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
* atualizarId_UsuarioPorPK() - Usado para invocar a classe de negócio FilaQRCodePendenteProduzirBusinessImpl de forma geral
* realizar uma atualização de ID do usuário diretamente na tabela FILA_QRCODES_PNDNT_PRD campo USUA_ID
* @param $daofactory
* @param $id
* @param $id_usuario
* @return FilaQRCodePendenteProduzirDTO
*
* 
*/
    public function atualizarId_UsuarioPorPK($daofactory,$id_usuario,$id)
    {
        $dao = $daofactory->getFilaQRCodePendenteProduzirDAO($daofactory);

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
* atualizarQtdePorPK() - Usado para invocar a classe de negócio FilaQRCodePendenteProduzirBusinessImpl de forma geral
* realizar uma atualização de Qtde QR Code Produzir diretamente na tabela FILA_QRCODES_PNDNT_PRD campo FQPP_NU_QTDE_QRC
* @param $daofactory
* @param $id
* @param $qtde
* @return FilaQRCodePendenteProduzirDTO
*
* 
*/
    public function atualizarQtdePorPK($daofactory,$qtde,$id)
    {
        $dao = $daofactory->getFilaQRCodePendenteProduzirDAO($daofactory);

        // resposta padrão
        $retorno = new DTOPadrao();

        if($dao->updateQtde($id, $qtde)){   
            $retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
        }       

        // Obtem o texto da mensagem em razão do código de retorno
        $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);

        return $retorno;
    }


/**
*
* pesquisarPorId_Campanha() - Usado para invocar a classe de negócio FilaQRCodePendenteProduzirBusinessImpl de forma geral
* realizar uma busca de ID da campanha diretamente na tabela FILA_QRCODES_PNDNT_PRD campo CAMP_ID
*
* @param $id_campanha
* @return FilaQRCodePendenteProduzirDTO
*
* 
*/
    public function pesquisarPorId_Campanha($daofactory,$id_campanha)
    { 
        $dao = $daofactory->getFilaQRCodePendenteProduzirDAO($daofactory);
        return $dao->loadId_Campanha($id_campanha);
    }

/**
*
* pesquisarPorId_Usuario() - Usado para invocar a classe de negócio FilaQRCodePendenteProduzirBusinessImpl de forma geral
* realizar uma busca de ID do usuário diretamente na tabela FILA_QRCODES_PNDNT_PRD campo USUA_ID
*
* @param $id_usuario
* @return FilaQRCodePendenteProduzirDTO
*
* 
*/
    public function pesquisarPorId_Usuario($daofactory,$id_usuario)

    { 
        $dao = $daofactory->getFilaQRCodePendenteProduzirDAO($daofactory);
        return $dao->loadId_Usuario($id_usuario);
    }

/**
*
* pesquisarPorQtde() - Usado para invocar a classe de negócio FilaQRCodePendenteProduzirBusinessImpl de forma geral
* realizar uma busca de Qtde QR Code Produzir diretamente na tabela FILA_QRCODES_PNDNT_PRD campo FQPP_NU_QTDE_QRC
*
* @param $qtde
* @return FilaQRCodePendenteProduzirDTO
*
* 
*/
    public function pesquisarPorQtde($daofactory,$qtde)

    { 
        $dao = $daofactory->getFilaQRCodePendenteProduzirDAO($daofactory);
        return $dao->loadQtde($qtde);
    }


/**
*
* listarFilaQRCodePendenteProduzirUsuaIdPorStatus() - Usado para invocar a interface de acesso aos dados (DAO) FilaQRCodePendenteProduzirDAO de forma geral
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

    public function listarFilaQRCodePendenteProduzirPorUsuaIdStatus($daofactory, $usuaid, $status, $pag, $qtde, $coluna, $ordem)
    {   
        $retorno = new DTOPaginacao();
        $retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
        $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);

        $dao = $daofactory->getFilaQRCodePendenteProduzirDAO($daofactory);
        $retorno->pagina = $pag;
        $retorno->itensPorPagina = ($qtde == 0 
        ? (int) VariavelCache::getInstance()->getVariavel(ConstantesVariavel::MAXIMO_LINHAS_POR_PAGINA_DEFAULT)
        : $qtde);
        $retorno->totalPaginas = ceil($dao->countFilaQRCodePendenteProduzirPorUsuaIdStatus($usuaid, $status) / $retorno->itensPorPagina);

        if($pag > $retorno->totalPaginas) {
            $retorno->msgcode = ConstantesMensagem::NAO_EXISTEM_MAIS_PAGINAS_APRESENTAR;
            $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);
            return $retorno;
        }
        $retorno->lst = $dao->listFilaQRCodePendenteProduzirPorUsuaIdStatus($usuaid, $status, $pag, $qtde, $coluna, $ordem);

        return $retorno;
    }


/**
* validarTamanhoCampo()
*
* Validador de tamanho de campos FilaQRCodePendenteProduzirDTO
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
