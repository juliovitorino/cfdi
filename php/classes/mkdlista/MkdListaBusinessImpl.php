<?php 

// importar dependencias
require_once 'MkdListaBusiness.php';
require_once 'MkdListaConstantes.php';
require_once '../dto/DTOPadrao.php';
require_once '../dto/DTOPaginacao.php';

require_once '../variavel/ConstantesVariavel.php';
require_once '../variavel/VariavelCache.php';

require_once '../email/EmailDTO.php';
require_once '../email/Email.php';
require_once '../email/EmailTemplateHub.php';
require_once '../email/EmailSolucionador.php';
require_once '../util/util.php';
require_once '../util/ambiente.php';
require_once '../tags/TagHub.php';

/**
*
* MkdListaBusinessImpl - Classe de implementação dos métodos de negócio para a interface MkdListaBusiness
* Camada de negócio MkdLista - camada responsável pela lógica de negócios de MkdLista do sistema. 
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
* 15/11/2019 - Ativação da conta de lead
*
* 
* @autor Julio Cesar Vitorino
* @since 04/11/2019 09:31:13
*
*/


class MkdListaBusinessImpl implements MkdListaBusiness
{
    
    function __construct()  {   }

/**
* carregar() - Carrega apenas um registro com base no campo id = (MKD_EMAIL_LISTA::MKEL_ID)
* @param $daofactory
* @param $dto
* @return $dto
*/ 
    public function carregar($daofactory, $dto) {   }

/**
* listarTudo() - Lista todos os registros provenientes de MKD_EMAIL_LISTA sem critério de paginação
* @param $daofactory
* @return List<MkdListaDTO>[]
*/ 
    public function listarTudo($daofactory) {   }


/**
* ativarNovoLead() - Ativar a conta de email marketing do lead proveniente de um mecanismo de captura
* ex. landing page
*
* @param $daofactory
* @param $token
* @return MkdListaDTO
*/ 
    public function ativarNovoLead($daofactory, $token)
    { 
        //-----------------------------------------------------------
        // Pesquisa o hash e executa verificações
        // a - É um registro de lead valido, ou seja, foi encontrado?
        // b - Verifica se já foi ativado
        //-----------------------------------------------------------
        $mkdlstdto = $this->pesquisarPorHashlead($daofactory, $token);

        if($mkdlstdto == NULL || $mkdlstdto->id == NULL){
            $mkdlstdto->msgcode = ConstantesMensagem::INFORMACAO_NAO_LOCALIZADA;
            $mkdlstdto->msgcodeString = MensagemCache::getInstance()->getMensagem($mkdlstdto->msgcode);
            return $mkdlstdto;
        }

        if($mkdlstdto->status == ConstantesVariavel::STATUS_ATIVO){
            $mkdlstdto->msgcode = ConstantesMensagem::CONTA_JA_ATIVADA;
            $mkdlstdto->msgcodeString = MensagemCache::getInstance()->getMensagemParametrizada($mkdlstdto->msgcode, [
                '*=data-ativacao=*' => $mkdlstdto->dataCadastro ,
            ]);
            return $mkdlstdto;
        }

        if($mkdlstdto->status != ConstantesVariavel::STATUS_PENDENTE){
            $mkdlstdto->msgcode = ConstantesMensagem::STATUS_NAO_COMPATIVEL_COM_ESTE_PROCESSO;
            $mkdlstdto->msgcodeString = MensagemCache::getInstance()->getMensagem($mkdlstdto->msgcode);
            return $mkdlstdto;
        }

        // Estado é pendente, logo iremos ativar a conta do lead
        $this->atualizarStatus($daofactory, $mkdlstdto->id, ConstantesVariavel::STATUS_ATIVO);
        $dtoretorno = $this->carregarPorID($daofactory, $mkdlstdto->id);
        $dtoretorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
        $dtoretorno->msgcodeString = MensagemCache::getInstance()->getMensagem($dtoretorno->msgcode);

        // Obtem os dados da campanha, seleciona o template de retorno e o link da recompensa
        // ...

        // Monta o email de retorno personalizado da campanha e o envia ao lead
        //...

        return $dtoretorno;
    }

/**
* pesquisarMaxPKAtivoId_Mkd_CampanhaPorStatus() - Carrega apenas um registro com base no id_mkd_campanha  e status para buscar a MAIOR PK
* @param $daofactory
* @param $status
* @return MkdListaDTO
*/ 
    public function pesquisarMaxPKAtivoId_Mkd_CampanhaPorStatus($daofactory, $id_mkd_campanha,$status)
    { 
        $dao = $daofactory->getMkdListaDAO($daofactory);
        $maxid = $dao->loadMaxId_Mkd_CampanhaPK($id_mkd_campanha,$status);
        return $this->carregarPorID($daofactory, $maxid);
    }

/**
* atualizar() - atualiza apenas um registro com base no dto MkdListaDTO->id
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


        $dao = $daofactory->getMkdListaDAO($daofactory);
        if(!$dao->update($dto)){
           $retorno->msgcode = ConstantesMensagem::ERRO_CRUD_ATUALIZAR_REGISTRO;
           $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);
    
        }
        // retorna situação
        return $retorno;

    }

/**
* deletar() - excluir fisicamente um registro com base no dto MkdListaDTO->id
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
        $dao = $daofactory->getMkdListaDAO($daofactory);

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
* @return List<MkdListaDTO>[]
* @deprecated
*/ 

    public function listarPagina($daofactory, $pag, $qtde)  
    {   
        $dao = $daofactory->getMkdListaDAO($daofactory);
        return $dao->listPagina($pag, $qtde);
    }

/**
* carregarPorID() - Carrega APENAS um registro usando a id como item de busca
* na tabela MKD_EMAIL_LISTA usando a Primary Key MKEL_ID
*
* @param $daofactory
* @param $id
* @param $qtde
*
* @return MkdListaDTO
*/ 
    public function carregarPorID($daofactory, $id)
    { 
        $dao = $daofactory->getMkdListaDAO($daofactory);
        return $dao->loadPK($id);
    }

/**
* atualizarStatus() - atualizar o campo de STATUS utilizando a id como item de busca
* na tabela MKD_EMAIL_LISTA usando a Primary Key MKEL_ID
*
* @param $daofactory
* @param $id
* @param $status
*
* @return MkdListaDTO
*/ 
    public function atualizarStatus($daofactory, $id, $status)
    {
        $dao = $daofactory->getMkdListaDAO($daofactory);

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
* inserir() - inserir um registro com base no MkdListaDTO. Alguns atributos dentro do DTO
* serão ignorados caso estejam populados.
*
* Atributos da classe MkdListaDTO sumariamente IGNORADOS por este método MESMO que estejam preenchidos:
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

    // Efetua validações no campo $dto->id com tamanho MkdListaConstantes::LEN_ID
    $ok = $this->validarTamanhoCampo($dto->id, MkdListaConstantes::LEN_ID, MkdListaConstantes::DESC_ID);
    if($ok->msgcode != ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO){
        return $ok;
    }

    // Efetua validações no campo $dto->id_mkd_campanha com tamanho MkdListaConstantes::LEN_ID_MKD_CAMPANHA
    $ok = $this->validarTamanhoCampo($dto->id_mkd_campanha, MkdListaConstantes::LEN_ID_MKD_CAMPANHA, MkdListaConstantes::DESC_ID_MKD_CAMPANHA);
    if($ok->msgcode != ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO){
        return $ok;
    }

    // Efetua validações no campo $dto->nome com tamanho MkdListaConstantes::LEN_NOME
    $ok = $this->validarTamanhoCampo($dto->nome, MkdListaConstantes::LEN_NOME, MkdListaConstantes::DESC_NOME);
    if($ok->msgcode != ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO){
        return $ok;
    }

    // Efetua validações no campo $dto->email com tamanho MkdListaConstantes::LEN_EMAIL
    $ok = $this->validarTamanhoCampo($dto->email, MkdListaConstantes::LEN_EMAIL, MkdListaConstantes::DESC_EMAIL);
    if($ok->msgcode != ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO){
        return $ok;
    }

    // Efetua validações no campo $dto->primeiroNome com tamanho MkdListaConstantes::LEN_PRIMEIRONOME
    $ok = $this->validarTamanhoCampo($dto->primeiroNome, MkdListaConstantes::LEN_PRIMEIRONOME, MkdListaConstantes::DESC_PRIMEIRONOME);
    if($ok->msgcode != ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO){
        return $ok;
    }

    // Efetua validações no campo $dto->sobrenome com tamanho MkdListaConstantes::LEN_SOBRENOME
    $ok = $this->validarTamanhoCampo($dto->sobrenome, MkdListaConstantes::LEN_SOBRENOME, MkdListaConstantes::DESC_SOBRENOME);
    if($ok->msgcode != ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO){
        return $ok;
    }

    // Efetua validações no campo $dto->whatsapp com tamanho MkdListaConstantes::LEN_WHATSAPP
    $ok = $this->validarTamanhoCampo($dto->whatsapp, MkdListaConstantes::LEN_WHATSAPP, MkdListaConstantes::DESC_WHATSAPP);
    if($ok->msgcode != ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO){
        return $ok;
    }

    // Efetua validações no campo $dto->hashlead com tamanho MkdListaConstantes::LEN_HASHLEAD
    $ok = $this->validarTamanhoCampo($dto->hashlead, MkdListaConstantes::LEN_HASHLEAD, MkdListaConstantes::DESC_HASHLEAD);
    if($ok->msgcode != ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO){
        return $ok;
    }

    $dto->status = ConstantesVariavel::STATUS_ATIVO;
    $dto->hashlead = Sha1( Util::getNow() . Util::getCodigo(4096));
    $dao = $daofactory->getMkdListaDAO($daofactory);

    if (!$dao->insert($dto)) {
        $retorno = new DTOPadrao();
        $retorno->msgcode = ConstantesMensagem::ERRO_CRUD_INSERIR_REGISTRO;
        $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);
    } else {

        //====================================================================
        // Envia email solcitando confirmação de cadastro
        //====================================================================
        $ok = $this->enviarEmailNovaConta($daofactory, $dto);
//var_dump($ok)        ;

    }

    return $retorno;
}

private function enviarEmailNovaConta($daofactory, $dto)
{
    // Envia email para conta do usuário para confirmação de identidade
    // Token de teste a ser enviado no email
    $token = $dto->hashlead;

    // LINK_ATIVACAO_MKD_LISTA = *=url-ambiente-ativo=*/php/classes/gateway/ativarNovaContaMkdLista.php?token=*=token=*
    $url = VariavelCache::getInstance()->getVariavel(ConstantesVariavel::LINK_ATIVACAO_MKD_LISTA);
    $url = Ambiente::trocarUrlAmbienteAtivo($url);
    $url = str_replace(TagHub::TAG_TOKEN, $token,$url);

    // timestamp de teste
    $date = new DateTime();
    $ts = $date->getTimestamp();

    // prepara parametrizacao
    $email = new EmailDTO();
    $email->destinario = $dto->nome;
    $email->emaildestinatario = $dto->email;
    $email->assunto = Util::getTrocaConteudoParametrizada(VariavelCache::getInstance()->getVariavel(ConstantesVariavel::EMAIL_TITULO_CONFIRMAR_NOVO_LEAD),[
        ConstantesVariavel::P1 => $dto->nome == NULL ? "" : $dto->nome,
    ]);
    $email->template = getcwd() . VariavelCache::getInstance()->getVariavel(ConstantesVariavel::PATH_RELATIVO_TEMPLATES_EMAIL) 
                        . EmailTemplateHub::CONFIRMAR_INSCRICAO_LISTA;
    $email->lsttags = [	
                            TagHub::NOME_NOVO_CLIENTE => $email->destinario,
                            TagHub::LINK_ATIVACAO_NOVO_CLIENTE => $url,
                            TagHub::TAG_CONTATO_EMAIL_CANIVETE => VariavelCache::getInstance()->getVariavel(ConstantesVariavel::EMAIL_CONTATO_PADRAO_SMTP)
                        ];
    //var_dump($email);

    $es = new EmailSolucionador($email);

    // Envia o email com o email já solucionado em suas tags
    $e = new Email($es);
    return $e->enviar();

}


/**
*
* listarMkdListaPorStatus() - Usado para invocar a interface de acesso aos dados (DAO) MkdListaDAO de forma geral
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

    public function listarMkdListaPorStatus($daofactory, $status, $pag, $qtde, $coluna, $ordem)
    {   
        $retorno = new DTOPaginacao();
        $retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
        $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);

        $dao = $daofactory->getMkdListaDAO($daofactory);
        $retorno->pagina = $pag;
        $retorno->itensPorPagina = ($qtde == 0 
        ? (int) VariavelCache::getInstance()->getVariavel(ConstantesVariavel::MAXIMO_LINHAS_POR_PAGINA_DEFAULT)
        : $qtde);
        $retorno->totalPaginas = ceil($dao->countMkdListaPorStatus($status) / $retorno->itensPorPagina);

        if($pag > $retorno->totalPaginas) {
            $retorno->msgcode = ConstantesMensagem::NAO_EXISTEM_MAIS_PAGINAS_APRESENTAR;
            $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);
            return $retorno;
        }
        $retorno->lst = $dao->listMkdListaPorStatus($status, $pag, $qtde, $coluna, $ordem);

        return $retorno;
    }

/**
*
* atualizarId_Mkd_CampanhaPorPK() - Usado para invocar a classe de negócio MkdListaBusinessImpl de forma geral
* realizar uma atualização de ID da Campanha MKD diretamente na tabela MKD_EMAIL_LISTA campo MKCE_ID
* @param $daofactory
* @param $id
* @param $id_mkd_campanha
* @return MkdListaDTO
*
* 
*/
    public function atualizarId_Mkd_CampanhaPorPK($daofactory,$id_mkd_campanha,$id)
    {
        $dao = $daofactory->getMkdListaDAO($daofactory);

        // resposta padrão
        $retorno = new DTOPadrao();

        if($dao->updateId_Mkd_Campanha($id, $id_mkd_campanha)){   
            $retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
        }       

        // Obtem o texto da mensagem em razão do código de retorno
        $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);

        return $retorno;
    }

/**
*
* atualizarNomePorPK() - Usado para invocar a classe de negócio MkdListaBusinessImpl de forma geral
* realizar uma atualização de Nome diretamente na tabela MKD_EMAIL_LISTA campo MKEL_TX_NOME
* @param $daofactory
* @param $id
* @param $nome
* @return MkdListaDTO
*
* 
*/
    public function atualizarNomePorPK($daofactory,$nome,$id)
    {
        $dao = $daofactory->getMkdListaDAO($daofactory);

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
* atualizarEmailPorPK() - Usado para invocar a classe de negócio MkdListaBusinessImpl de forma geral
* realizar uma atualização de Email diretamente na tabela MKD_EMAIL_LISTA campo MKEL_TX_EMAIL
* @param $daofactory
* @param $id
* @param $email
* @return MkdListaDTO
*
* 
*/
    public function atualizarEmailPorPK($daofactory,$email,$id)
    {
        $dao = $daofactory->getMkdListaDAO($daofactory);

        // resposta padrão
        $retorno = new DTOPadrao();

        if($dao->updateEmail($id, $email)){   
            $retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
        }       

        // Obtem o texto da mensagem em razão do código de retorno
        $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);

        return $retorno;
    }

/**
*
* atualizarPrimeironomePorPK() - Usado para invocar a classe de negócio MkdListaBusinessImpl de forma geral
* realizar uma atualização de Primeiro Nome diretamente na tabela MKD_EMAIL_LISTA campo MKEL_TX_PRIM_NOME
* @param $daofactory
* @param $id
* @param $primeiroNome
* @return MkdListaDTO
*
* 
*/
    public function atualizarPrimeironomePorPK($daofactory,$primeiroNome,$id)
    {
        $dao = $daofactory->getMkdListaDAO($daofactory);

        // resposta padrão
        $retorno = new DTOPadrao();

        if($dao->updatePrimeironome($id, $primeiroNome)){   
            $retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
        }       

        // Obtem o texto da mensagem em razão do código de retorno
        $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);

        return $retorno;
    }

/**
*
* atualizarSobrenomePorPK() - Usado para invocar a classe de negócio MkdListaBusinessImpl de forma geral
* realizar uma atualização de Sobrenome diretamente na tabela MKD_EMAIL_LISTA campo MKEL_TX_SOBRENOME
* @param $daofactory
* @param $id
* @param $sobrenome
* @return MkdListaDTO
*
* 
*/
    public function atualizarSobrenomePorPK($daofactory,$sobrenome,$id)
    {
        $dao = $daofactory->getMkdListaDAO($daofactory);

        // resposta padrão
        $retorno = new DTOPadrao();

        if($dao->updateSobrenome($id, $sobrenome)){   
            $retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
        }       

        // Obtem o texto da mensagem em razão do código de retorno
        $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);

        return $retorno;
    }

/**
*
* atualizarWhatsappPorPK() - Usado para invocar a classe de negócio MkdListaBusinessImpl de forma geral
* realizar uma atualização de Contato Whatsapp diretamente na tabela MKD_EMAIL_LISTA campo MKEL_TX_WHATSAPP
* @param $daofactory
* @param $id
* @param $whatsapp
* @return MkdListaDTO
*
* 
*/
    public function atualizarWhatsappPorPK($daofactory,$whatsapp,$id)
    {
        $dao = $daofactory->getMkdListaDAO($daofactory);

        // resposta padrão
        $retorno = new DTOPadrao();

        if($dao->updateWhatsapp($id, $whatsapp)){   
            $retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
        }       

        // Obtem o texto da mensagem em razão do código de retorno
        $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);

        return $retorno;
    }

/**
*
* atualizarHashleadPorPK() - Usado para invocar a classe de negócio MkdListaBusinessImpl de forma geral
* realizar uma atualização de Hashcode lead diretamente na tabela MKD_EMAIL_LISTA campo MKEL_TX_HASH
* @param $daofactory
* @param $id
* @param $hashlead
* @return MkdListaDTO
*
* 
*/
    public function atualizarHashleadPorPK($daofactory,$hashlead,$id)
    {
        $dao = $daofactory->getMkdListaDAO($daofactory);

        // resposta padrão
        $retorno = new DTOPadrao();

        if($dao->updateHashlead($id, $hashlead)){   
            $retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
        }       

        // Obtem o texto da mensagem em razão do código de retorno
        $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);

        return $retorno;
    }


/**
*
* pesquisarPorId_Mkd_Campanha() - Usado para invocar a classe de negócio MkdListaBusinessImpl de forma geral
* realizar uma busca de ID da Campanha MKD diretamente na tabela MKD_EMAIL_LISTA campo MKCE_ID
*
* @param $id_mkd_campanha
* @return MkdListaDTO
*
* 
*/
    public function pesquisarPorId_Mkd_Campanha($daofactory,$id_mkd_campanha)
    { 
        $dao = $daofactory->getMkdListaDAO($daofactory);
        return $dao->loadId_Mkd_Campanha($id_mkd_campanha);
    }

/**
*
* pesquisarPorNome() - Usado para invocar a classe de negócio MkdListaBusinessImpl de forma geral
* realizar uma busca de Nome diretamente na tabela MKD_EMAIL_LISTA campo MKEL_TX_NOME
*
* @param $nome
* @return MkdListaDTO
*
* 
*/
    public function pesquisarPorNome($daofactory,$nome)

    { 
        $dao = $daofactory->getMkdListaDAO($daofactory);
        return $dao->loadNome($nome);
    }

/**
*
* pesquisarPorEmail() - Usado para invocar a classe de negócio MkdListaBusinessImpl de forma geral
* realizar uma busca de Email diretamente na tabela MKD_EMAIL_LISTA campo MKEL_TX_EMAIL
*
* @param $email
* @return MkdListaDTO
*
* 
*/
    public function pesquisarPorEmail($daofactory,$email)

    { 
        $dao = $daofactory->getMkdListaDAO($daofactory);
        return $dao->loadEmail($email);
    }

/**
*
* pesquisarPorPrimeironome() - Usado para invocar a classe de negócio MkdListaBusinessImpl de forma geral
* realizar uma busca de Primeiro Nome diretamente na tabela MKD_EMAIL_LISTA campo MKEL_TX_PRIM_NOME
*
* @param $primeiroNome
* @return MkdListaDTO
*
* 
*/
    public function pesquisarPorPrimeironome($daofactory,$primeiroNome)

    { 
        $dao = $daofactory->getMkdListaDAO($daofactory);
        return $dao->loadPrimeironome($primeiroNome);
    }

/**
*
* pesquisarPorSobrenome() - Usado para invocar a classe de negócio MkdListaBusinessImpl de forma geral
* realizar uma busca de Sobrenome diretamente na tabela MKD_EMAIL_LISTA campo MKEL_TX_SOBRENOME
*
* @param $sobrenome
* @return MkdListaDTO
*
* 
*/
    public function pesquisarPorSobrenome($daofactory,$sobrenome)

    { 
        $dao = $daofactory->getMkdListaDAO($daofactory);
        return $dao->loadSobrenome($sobrenome);
    }

/**
*
* pesquisarPorWhatsapp() - Usado para invocar a classe de negócio MkdListaBusinessImpl de forma geral
* realizar uma busca de Contato Whatsapp diretamente na tabela MKD_EMAIL_LISTA campo MKEL_TX_WHATSAPP
*
* @param $whatsapp
* @return MkdListaDTO
*
* 
*/
    public function pesquisarPorWhatsapp($daofactory,$whatsapp)

    { 
        $dao = $daofactory->getMkdListaDAO($daofactory);
        return $dao->loadWhatsapp($whatsapp);
    }

/**
*
* pesquisarPorHashlead() - Usado para invocar a classe de negócio MkdListaBusinessImpl de forma geral
* realizar uma busca de Hashcode lead diretamente na tabela MKD_EMAIL_LISTA campo MKEL_TX_HASH
*
* @param $hashlead
* @return MkdListaDTO
*
* 
*/
    public function pesquisarPorHashlead($daofactory,$hashlead)

    { 
        $dao = $daofactory->getMkdListaDAO($daofactory);
        return $dao->loadHashlead($hashlead);
    }


/**
*
* listarMkdListaUsuaIdPorStatus() - Usado para invocar a interface de acesso aos dados (DAO) MkdListaDAO de forma geral
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

    public function listarMkdListaPorUsuaIdStatus($daofactory, $usuaid, $status, $pag, $qtde, $coluna, $ordem)
    {   
        $retorno = new DTOPaginacao();
        $retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
        $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);

        $dao = $daofactory->getMkdListaDAO($daofactory);
        $retorno->pagina = $pag;
        $retorno->itensPorPagina = ($qtde == 0 
        ? (int) VariavelCache::getInstance()->getVariavel(ConstantesVariavel::MAXIMO_LINHAS_POR_PAGINA_DEFAULT)
        : $qtde);
        $retorno->totalPaginas = ceil($dao->countMkdListaPorUsuaIdStatus($usuaid, $status) / $retorno->itensPorPagina);

        if($pag > $retorno->totalPaginas) {
            $retorno->msgcode = ConstantesMensagem::NAO_EXISTEM_MAIS_PAGINAS_APRESENTAR;
            $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);
            return $retorno;
        }
        $retorno->lst = $dao->listMkdListaPorUsuaIdStatus($usuaid, $status, $pag, $qtde, $coluna, $ordem);

        return $retorno;
    }

/**
* validarTamanhoCampo()
*
* Validador de tamanho de campos MkdListaDTO
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
