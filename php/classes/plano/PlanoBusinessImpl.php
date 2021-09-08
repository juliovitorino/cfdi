<?php 

// importar dependencias
require_once 'PlanoBusiness.php';
require_once 'PlanoConstantes.php';
require_once 'PlanoHelper.php';
require_once '../dto/DTOPadrao.php';
require_once '../dto/DTOPaginacao.php';

require_once '../variavel/ConstantesVariavel.php';
require_once '../variavel/VariavelCache.php';

/**
*
* PlanoBusinessImpl - Classe de implementação dos métodos de negócio para a interface PlanoBusiness
* Camada de negócio Plano - camada responsável pela lógica de negócios de Plano do sistema. 
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
* @since 08/09/2021 14:15:34
*
*/


class PlanoBusinessImpl implements PlanoBusiness
{
    
    function __construct()  {   }

	/**
	* getListaPermissao() - Desmenbra uma permissao string e adiciona em uma array de PermissaoDTO
	* @param string
	* @return PermissaoDTO[]
	*/
	public function getListaPermissao($permstr)
	{
		$lstpermissao = [];
		for ($i=0; $i < strlen($permstr); $i += ConstantesPlano::MULTIPLO) { 
			$permissaostr = substr($permstr, $i, ConstantesPlano::MULTIPLO);
			if (substr($permissaostr, 0, 1) !== ConstantesPlano::STATUS_SEM_USO)
			{
				$permissao = new PermissaoDTO();
				$permissao->status = substr($permissaostr, 0, 1);
				$permissao->periodicidade = substr($permissaostr, 1, 2);
				$permissao->qtdepermitida = substr($permissaostr, 3, 5);
				if ($i/ConstantesPlano::MULTIPLO < sizeof(ConstantesPlano::lstfuncionalidade)) {
					$permissao->funcionalidade = ConstantesPlano::lstfuncionalidade[$i/ConstantesPlano::MULTIPLO];
				}

				switch ($permissao->periodicidade) {
					case 'LI':
						$permissao->periodicidadestr = 'LIVRE';
						break;
					case 'MX':
						$permissao->periodicidadestr = 'MAXIMO';
						break;
					case 'DD':
						$permissao->periodicidadestr = 'DIARIA';
						break;
					case 'SM':
						$permissao->periodicidadestr = 'SEMANAL';
						break;
					case 'QZ':
						$permissao->periodicidadestr = 'QUINZENAL';
						break;
					case 'MM':
						$permissao->periodicidadestr = 'MENSAL';
						break;
					case 'AA':
						$permissao->periodicidadestr = 'ANUAL';
						break;
					
					default:
						# code...
						break;
				}

				$lstpermissao[] = $permissao;			
			}

		}

		return $lstpermissao;
	}


/**
* carregar() - Carrega apenas um registro com base no campo id = (PLANOS::PLAN_ID)
* @param $daofactory
* @param $dto
* @return $dto
*/ 

public function carregar($daofactory, $dto)
{
    $dao = $daofactory->getPlanoDAO($daofactory);
    $retorno = $dao->load($dto);
    if (! is_null($retorno->id)){
        $retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
        $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);
        $retorno->lstpermissao = $this->getListaPermissao($retorno->permissao);
    } else {
        $retorno->msgcode = ConstantesMensagem::INFORMACAO_NAO_LOCALIZADA;
        $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);
    }
    return $retorno;

}


/**
* listarTudo() - Lista todos os registros provenientes de PLANOS sem critério de paginação
* @param $daofactory
* @return List<PlanoDTO>[]
*/ 
    public function listarTudo($daofactory) {   }

/**
* pesquisarMaxPKAtivoNomePorStatus() - Carrega apenas um registro com base no nome  e status para buscar a MAIOR PK
* @param $daofactory
* @param $status
* @return PlanoDTO
*/ 
    public function pesquisarMaxPKAtivoNomePorStatus($daofactory, $nome,$status)
    { 
        $dao = $daofactory->getPlanoDAO($daofactory);
        $maxid = $dao->loadMaxNomePK($nome,$status);
        return $this->carregarPorID($daofactory, $maxid);
    }

/**
* atualizar() - atualiza apenas um registro com base no dto PlanoDTO->id
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


        $dao = $daofactory->getPlanoDAO($daofactory);
        if(!$dao->update($dto)){
           $retorno->msgcode = ConstantesMensagem::ERRO_CRUD_ATUALIZAR_REGISTRO;
           $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);
    
        }
        // retorna situação
        return $retorno;

    }

/**
* deletar() - excluir fisicamente um registro com base no dto PlanoDTO->id
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
        $dao = $daofactory->getPlanoDAO($daofactory);

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
* @return List<PlanoDTO>[]
* @deprecated
*/ 

    public function listarPagina($daofactory, $pag, $qtde)  
    {   
        $dao = $daofactory->getPlanoDAO($daofactory);
        return $dao->listPagina($pag, $qtde);
    }

/**
* carregarPorID() - Carrega APENAS um registro usando a id como item de busca
* na tabela PLANOS usando a Primary Key PLAN_ID
*
* @param $daofactory
* @param $id
* @param $qtde
*
* @return PlanoDTO
*/ 
    public function carregarPorID($daofactory, $id)
    { 
        $dao = $daofactory->getPlanoDAO($daofactory);
        return $dao->loadPK($id);
    }

/**
* atualizarStatus() - atualizar o campo de STATUS utilizando a id como item de busca
* na tabela PLANOS usando a Primary Key PLAN_ID
*
* @param $daofactory
* @param $id
* @param $status
*
* @return PlanoDTO
*/ 
    public function atualizarStatus($daofactory, $id, $status)
    {
        $dao = $daofactory->getPlanoDAO($daofactory);

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
* inserirPlano() - inserir um registro com base no PlanoDTO. Alguns atributos dentro do DTO
* serão ignorados caso estejam populados.
*
* Atributos da classe FundoParticipacaoGlobalDTO sumariamente IGNORADOS por este método MESMO que estejam preenchidos:
* id
* status
* dataCadastro
* dataAtualizacao
*
* @param $daofactory
*
* @return DTOPadrao
*/ 
public function inserirPlano($daofactory, $dto)
{ 
    $retorno = new DTOPadrao();
    $retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
    $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);

    // Regras de Negócio
    // ...
    

    //--- Tudo ok com regras de negócio. Pode inserir o registro 
    // Prepara registro  de bonificação


    return $this->inserir($daofactory, $dto);
}


/**
* inserir() - inserir um registro com base no PlanoDTO. Alguns atributos dentro do DTO
* serão ignorados caso estejam populados.
*
* Atributos da classe PlanoDTO sumariamente IGNORADOS por este método MESMO que estejam preenchidos:
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

    // Efetua validações no campo $dto->id com tamanho PlanoConstantes::LEN_ID
    $ok = $this->validarTamanhoCampo($dto->id, PlanoConstantes::LEN_ID, PlanoConstantes::DESC_ID);
    if($ok->msgcode != ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO){
        return $ok;
    }

    // Efetua validações no campo $dto->nome com tamanho PlanoConstantes::LEN_NOME
    $ok = $this->validarTamanhoCampo($dto->nome, PlanoConstantes::LEN_NOME, PlanoConstantes::DESC_NOME);
    if($ok->msgcode != ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO){
        return $ok;
    }

    // Efetua validações no campo $dto->permissao com tamanho PlanoConstantes::LEN_PERMISSAO
    $ok = $this->validarTamanhoCampo($dto->permissao, PlanoConstantes::LEN_PERMISSAO, PlanoConstantes::DESC_PERMISSAO);
    if($ok->msgcode != ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO){
        return $ok;
    }

    // Efetua validações no campo $dto->valor com tamanho PlanoConstantes::LEN_VALOR
    $ok = $this->validarTamanhoCampo($dto->valor, PlanoConstantes::LEN_VALOR, PlanoConstantes::DESC_VALOR);
    if($ok->msgcode != ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO){
        return $ok;
    }

    // Efetua validações no campo $dto->tipo com tamanho PlanoConstantes::LEN_TIPO
    $ok = $this->validarTamanhoCampo($dto->tipo, PlanoConstantes::LEN_TIPO, PlanoConstantes::DESC_TIPO);
    if($ok->msgcode != ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO){
        return $ok;
    }

    // Efetua validações no campo $dto->status com tamanho PlanoConstantes::LEN_STATUS
    $ok = $this->validarTamanhoCampo($dto->status, PlanoConstantes::LEN_STATUS, PlanoConstantes::DESC_STATUS);
    if($ok->msgcode != ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO){
        return $ok;
    }

    // Efetua validações no campo $dto->dataCadastro com tamanho PlanoConstantes::LEN_DATACADASTRO
    $ok = $this->validarTamanhoCampo($dto->dataCadastro, PlanoConstantes::LEN_DATACADASTRO, PlanoConstantes::DESC_DATACADASTRO);
    if($ok->msgcode != ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO){
        return $ok;
    }

    // Efetua validações no campo $dto->dataAtualizacao com tamanho PlanoConstantes::LEN_DATAATUALIZACAO
    $ok = $this->validarTamanhoCampo($dto->dataAtualizacao, PlanoConstantes::LEN_DATAATUALIZACAO, PlanoConstantes::DESC_DATAATUALIZACAO);
    if($ok->msgcode != ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO){
        return $ok;
    }


    $dto->status = ConstantesVariavel::STATUS_ATIVO;
    $dao = $daofactory->getPlanoDAO($daofactory);

    if (!$dao->insert($dto)) {
        $retorno = new DTOPadrao();
        $retorno->msgcode = ConstantesMensagem::ERRO_CRUD_INSERIR_REGISTRO;
        $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);
        return $retorno;
    }

    return $retorno;
}

/**
*
* listarPlanoPorStatus() - Usado para invocar a interface de acesso aos dados (DAO) PlanoDAO de forma geral
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

    public function listarPlanoPorStatus($daofactory, $status,  $pag=1, $qtde=0, $coluna=1, $ordem=0)
    {   
        $retorno = new DTOPaginacao();
        $retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
        $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);

        $dao = $daofactory->getPlanoDAO($daofactory);
        $retorno->pagina = $pag;
        $retorno->itensPorPagina = ($qtde == 0 
        ? (int) VariavelCache::getInstance()->getVariavel(ConstantesVariavel::MAXIMO_LINHAS_POR_PAGINA_DEFAULT)
        : $qtde);
        $retorno->totalPaginas = ceil($dao->countPlanoPorStatus($status) / $retorno->itensPorPagina);

        if($pag > $retorno->totalPaginas) {
            $retorno->msgcode = ConstantesMensagem::NAO_EXISTEM_MAIS_PAGINAS_APRESENTAR;
            $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);
            return $retorno;
        }
        $retorno->lst = $dao->listPlanoPorStatus($status, $pag, $qtde, $coluna, $ordem);

        return $retorno;
    }


/**
*
* listarPlanoPorStatusTipo() - Usado para invocar a interface de acesso aos dados (DAO) PlanoDAO de forma geral
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

    public function listarPlanoPorStatusTipo($daofactory, $status, $tipo, $pag=1, $qtde=0, $coluna=1, $ordem=0)
    {   
        $retorno = new DTOPaginacao();
        $retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
        $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);

        $dao = $daofactory->getPlanoDAO($daofactory);
        $retorno->pagina = $pag;
        $retorno->itensPorPagina = ($qtde == 0 
        ? (int) VariavelCache::getInstance()->getVariavel(ConstantesVariavel::MAXIMO_LINHAS_POR_PAGINA_DEFAULT)
        : $qtde);
        $retorno->totalPaginas = ceil($dao->countPlanoPorStatusTipo($status,$tipo) / $retorno->itensPorPagina);

        if($pag > $retorno->totalPaginas) {
            $retorno->msgcode = ConstantesMensagem::NAO_EXISTEM_MAIS_PAGINAS_APRESENTAR;
            $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);
            return $retorno;
        }
        $retorno->lst = $dao->listPlanoPorStatusTipo($status,$tipo, $pag, $qtde, $coluna, $ordem);

        return $retorno;
    }

/**
*
* atualizarNomePorPK() - Usado para invocar a classe de negócio PlanoBusinessImpl de forma geral
* realizar uma atualização de Nome do Plano diretamente na tabela PLANOS campo PLAN_NM_PLANO
* @param $daofactory
* @param $id
* @param $nome
* @return PlanoDTO
*
* 
*/
    public function atualizarNomePorPK($daofactory,$nome,$id)
    {
        $dao = $daofactory->getPlanoDAO($daofactory);

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
* atualizarPermissaoPorPK() - Usado para invocar a classe de negócio PlanoBusinessImpl de forma geral
* realizar uma atualização de Estruturas de Permissão do Plano diretamente na tabela PLANOS campo PLAN_TX_PERMISSAO
* @param $daofactory
* @param $id
* @param $permissao
* @return PlanoDTO
*
* 
*/
    public function atualizarPermissaoPorPK($daofactory,$permissao,$id)
    {
        $dao = $daofactory->getPlanoDAO($daofactory);

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
* atualizarValorPorPK() - Usado para invocar a classe de negócio PlanoBusinessImpl de forma geral
* realizar uma atualização de Valor do Plano diretamente na tabela PLANOS campo PLAN_VL_PLANO
* @param $daofactory
* @param $id
* @param $valor
* @return PlanoDTO
*
* 
*/
    public function atualizarValorPorPK($daofactory,$valor,$id)
    {
        $dao = $daofactory->getPlanoDAO($daofactory);

        // resposta padrão
        $retorno = new DTOPadrao();

        if($dao->updateValor($id, $valor)){   
            $retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
        }       

        // Obtem o texto da mensagem em razão do código de retorno
        $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);

        return $retorno;
    }

/**
*
* atualizarTipoPorPK() - Usado para invocar a classe de negócio PlanoBusinessImpl de forma geral
* realizar uma atualização de Tipo do Plano diretamente na tabela PLANOS campo PLAN_IN_TIPO
* @param $daofactory
* @param $id
* @param $tipo
* @return PlanoDTO
*
* 
*/
    public function atualizarTipoPorPK($daofactory,$tipo,$id)
    {
        $dao = $daofactory->getPlanoDAO($daofactory);

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
* pesquisarPorNome() - Usado para invocar a classe de negócio PlanoBusinessImpl de forma geral
* realizar uma busca de Nome do Plano diretamente na tabela PLANOS campo PLAN_NM_PLANO
*
* @param $nome
* @return PlanoDTO
*
* 
*/
    public function pesquisarPorNome($daofactory,$nome)
    { 
        $dao = $daofactory->getPlanoDAO($daofactory);
        return $dao->loadNome($nome);
    }

/**
*
* pesquisarPorPermissao() - Usado para invocar a classe de negócio PlanoBusinessImpl de forma geral
* realizar uma busca de Estruturas de Permissão do Plano diretamente na tabela PLANOS campo PLAN_TX_PERMISSAO
*
* @param $permissao
* @return PlanoDTO
*
* 
*/
    public function pesquisarPorPermissao($daofactory,$permissao)

    { 
        $dao = $daofactory->getPlanoDAO($daofactory);
        return $dao->loadPermissao($permissao);
    }

/**
*
* pesquisarPorValor() - Usado para invocar a classe de negócio PlanoBusinessImpl de forma geral
* realizar uma busca de Valor do Plano diretamente na tabela PLANOS campo PLAN_VL_PLANO
*
* @param $valor
* @return PlanoDTO
*
* 
*/
    public function pesquisarPorValor($daofactory,$valor)

    { 
        $dao = $daofactory->getPlanoDAO($daofactory);
        return $dao->loadValor($valor);
    }

/**
*
* pesquisarPorTipo() - Usado para invocar a classe de negócio PlanoBusinessImpl de forma geral
* realizar uma busca de Tipo do Plano diretamente na tabela PLANOS campo PLAN_IN_TIPO
*
* @param $tipo
* @return PlanoDTO
*
* 
*/
    public function pesquisarPorTipo($daofactory,$tipo)

    { 
        $dao = $daofactory->getPlanoDAO($daofactory);
        return $dao->loadTipo($tipo);
    }

/**
*
* listarPlanoUsuaIdPorStatus() - Usado para invocar a interface de acesso aos dados (DAO) PlanoDAO de forma geral
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

    public function listarPlanoPorUsuaIdStatus($daofactory, $usuaid, $status,  $pag=1, $qtde=0, $coluna=1, $ordem=0)
    {   
        $retorno = new DTOPaginacao();
        $retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
        $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);

        $dao = $daofactory->getPlanoDAO($daofactory);
        $retorno->pagina = $pag;
        $retorno->itensPorPagina = ($qtde == 0 
        ? (int) VariavelCache::getInstance()->getVariavel(ConstantesVariavel::MAXIMO_LINHAS_POR_PAGINA_DEFAULT)
        : $qtde);
        $retorno->totalPaginas = ceil($dao->countPlanoPorUsuaIdStatus($usuaid, $status) / $retorno->itensPorPagina);

        if($pag > $retorno->totalPaginas) {
            $retorno->msgcode = ConstantesMensagem::NAO_EXISTEM_MAIS_PAGINAS_APRESENTAR;
            $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);
            return $retorno;
        }
        $retorno->lst = $dao->listPlanoPorUsuaIdStatus($usuaid, $status, $pag, $qtde, $coluna, $ordem);

        return $retorno;
    }

/**
* validarTamanhoCampo()
*
* Validador de tamanho de campos PlanoDTO
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
