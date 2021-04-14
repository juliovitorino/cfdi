<?php 

/**
* TagsCommand - Execução de comando de substuição de tags
* @author Julio Vitorino
* @since 27/07/2018
*/

// importar dependências
require_once 'ConstantesTag.php';
require_once 'ListaFactory.php';

class TagsCommand
{

	//atributos da classe
	private $conteudo;
	private $original;
	private $usuariodto;
	private $projetodto;

	private $lsttags = array( 	
								ConstantesTag::COMMAND_NOME_PROJETO => '',
								ConstantesTag::COMMAND_EMAIL_CONTATO => '',
								ConstantesTag::COMMAND_PALAVRA_CHAVE_EXATA => '',
								ConstantesTag::COMMAND_HEADLINE => '',
								ConstantesTag::COMMAND_NICHO => '',
								ConstantesTag::COMMAND_PLATAFORMA => '',
								ConstantesTag::COMMAND_NOME_PRODUTO => '',
								ConstantesTag::COMMAND_DESC_PRODUTO => '',
								ConstantesTag::COMMAND_TIPO_PRODUTO => '',
								ConstantesTag::COMMAND_PRECO_PRODUTO => '',
								ConstantesTag::COMMAND_PRECO_PRODUTO_12X => '',
								ConstantesTag::COMMAND_HOTLINK_PAG_VENDA => '',
								ConstantesTag::COMAMND_HOTLINK_CHECKOUT => '',
								ConstantesTag::COMMAND_AUTORIDADE => '',
								ConstantesTag::COMMAND_DESC_AUTORIDADE => '',
								ConstantesTag::COMMAND_STATUS_PROJETO => '',
								ConstantesTag::COMMAND_URL_MINISITE => '',
								ConstantesTag::COMMAND_LISTA_BONUS => NULL,
								ConstantesTag::COMMAND_LISTA_ITENS => NULL,
								ConstantesTag::COMMAND_LISTA_DORES => NULL,
								ConstantesTag::COMMAND_LISTA_BENEFICIOS => NULL,
								ConstantesTag::COMMAND_LISTA_TECNICAS => NULL
							);
	
	function __construct($usuariodto, $projetodto, $conteudo)
	{
		$this->usuariodto = $usuariodto;
		$this->projetodto = $projetodto;
		$this->conteudo = $conteudo;
		$this->init();
		$this->execute();
	}

	/**
	 * init() - Popula objeto no array
	 */
	private function init()
	{
		foreach ($this->lsttags as $key => $value) {
			
			switch ($key) {
				case ConstantesTag::COMMAND_PALAVRA_CHAVE_EXATA:
					$this->lsttags[ConstantesTag::COMMAND_PALAVRA_CHAVE_EXATA] = $this->projetodto->palavra_chave_exata;
					break;
				case ConstantesTag::COMMAND_HEADLINE:
					$this->lsttags[ConstantesTag::COMMAND_HEADLINE] = $this->projetodto->headline;
					break;
				case ConstantesTag::COMMAND_NOME_PROJETO:
					$this->lsttags[ConstantesTag::COMMAND_NOME_PROJETO] = $this->projetodto->projeto;
					break;
				case ConstantesTag::COMMAND_EMAIL_CONTATO:
					$this->lsttags[ConstantesTag::COMMAND_EMAIL_CONTATO] = $this->projetodto->email_contato;
					break;
				case ConstantesTag::COMMAND_NICHO:
					$this->lsttags[ConstantesTag::COMMAND_NICHO] = $this->projetodto->nicho;
					break;
				case ConstantesTag::COMMAND_PLATAFORMA:
					$this->lsttags[ConstantesTag::COMMAND_PLATAFORMA] = $this->projetodto->plataforma;
					break;
				case ConstantesTag::COMMAND_NOME_PRODUTO:
					$this->lsttags[ConstantesTag::COMMAND_NOME_PRODUTO] = $this->projetodto->nome_produto;
					break;
				case ConstantesTag::COMMAND_DESC_PRODUTO:
					$this->lsttags[ConstantesTag::COMMAND_DESC_PRODUTO] = $this->projetodto->desc_produto;
					break;
				case ConstantesTag::COMMAND_TIPO_PRODUTO:
					$this->lsttags[ConstantesTag::COMMAND_TIPO_PRODUTO] = $this->projetodto->tipo_produto;
					break;
				case ConstantesTag::COMMAND_PRECO_PRODUTO:
					$this->lsttags[ConstantesTag::COMMAND_PRECO_PRODUTO] = $this->projetodto->preco_produto;
					break;
				case ConstantesTag::COMMAND_PRECO_PRODUTO_12X:
				setlocale(LC_MONETARY, 'pt_BR');
					$parcela = (string) (floatval($this->projetodto->preco_produto) / 12);
					$this->lsttags[ConstantesTag::COMMAND_PRECO_PRODUTO_12X] = $this->inteiro_decimal_br($parcela);
					break;
				case ConstantesTag::COMMAND_HOTLINK_PAG_VENDA:
					$this->lsttags[ConstantesTag::COMMAND_HOTLINK_PAG_VENDA] = $this->projetodto->hotlink_pv;
					break;
				case ConstantesTag::COMAMND_HOTLINK_CHECKOUT:
					$this->lsttags[ConstantesTag::COMAMND_HOTLINK_CHECKOUT] = $this->projetodto->hotlink_chkout;
					break;
				case ConstantesTag::COMMAND_AUTORIDADE:
					$this->lsttags[ConstantesTag::COMMAND_AUTORIDADE] = $this->projetodto->autoridade;
					break;
				case ConstantesTag::COMMAND_DESC_AUTORIDADE:
					$this->lsttags[ConstantesTag::COMMAND_DESC_AUTORIDADE] = $this->projetodto->breve_desc_autoridade;
					break;
				case ConstantesTag::COMMAND_STATUS_PROJETO:
					$this->lsttags[ConstantesTag::COMMAND_STATUS_PROJETO] = $this->projetodto->status;
					break;				
				case ConstantesTag::COMMAND_LISTA_BONUS:
					$this->lsttags[ConstantesTag::COMMAND_LISTA_BONUS] = $this->projetodto->lst_bonus;
					break;
				case ConstantesTag::COMMAND_LISTA_ITENS:
					$this->lsttags[ConstantesTag::COMMAND_LISTA_ITENS] = $this->projetodto->lst_itens;
					break;
				case ConstantesTag::COMMAND_LISTA_DORES:
					$this->lsttags[ConstantesTag::COMMAND_LISTA_DORES] = $this->projetodto->lst_dores;
					break;
				case ConstantesTag::COMMAND_LISTA_BENEFICIOS:
					$this->lsttags[ConstantesTag::COMMAND_LISTA_BENEFICIOS] = $this->projetodto->lst_beneficios;
					break;
				case ConstantesTag::COMMAND_LISTA_TECNICAS:
					$this->lsttags[ConstantesTag::COMMAND_LISTA_TECNICAS] = $this->projetodto->lst_tecnicas;
					break;
				case ConstantesTag::COMMAND_URL_MINISITE:
					$this->lsttags[ConstantesTag::COMMAND_URL_MINISITE] = $this->projetodto->url_minisite;
					break;
				
				default:
					# code...
					break;
			}
		}
	}

	/**
	 * execute() - Executa o processamento de tags de marcação
	 */
	private function execute() {
		foreach ($this->lsttags as $key =>$value) {
			while ( strpos($this->conteudo, $key) > -1 ) {

				// Pré-Processamento de tags por exceção ->arrays
				if(is_array($value)){
					switch ($key) {
						case ConstantesTag::COMMAND_LISTA_BONUS:
							$lstfactory = ListaFactory::getInstance(ConstantesTag::COMMAND_LISTA_BONUS, $value);
							$value = $lstfactory->getListaHtml();
							break;
						case ConstantesTag::COMMAND_LISTA_ITENS:
							$lstfactory = ListaFactory::getInstance(ConstantesTag::COMMAND_LISTA_ITENS, $value);
							$value = $lstfactory->getListaHtml();
							break;
						case ConstantesTag::COMMAND_LISTA_DORES:
							$lstfactory = ListaFactory::getInstance(ConstantesTag::COMMAND_LISTA_DORES, $value);
							$value = $lstfactory->getListaHtml();
							break;
						case ConstantesTag::COMMAND_LISTA_BENEFICIOS:
							$lstfactory = ListaFactory::getInstance(ConstantesTag::COMMAND_LISTA_BENEFICIOS, $value);
							$value = $lstfactory->getListaHtml();
							break;
						case ConstantesTag::COMMAND_LISTA_TECNICAS:
							$lstfactory = ListaFactory::getInstance(ConstantesTag::COMMAND_LISTA_TECNICAS, $value);
							$value = $lstfactory->getListaHtml();
							break;
						
						default:
							# code...
							break;
					} 
				}

				// Processamento do comportamento das tags
				$this->processarTag($key, $value);
				
			}
		}
	}

	/**
	 * getConteudo() - Devolve o conteúdo processado
	 */
	public function getConteudo() {
		return $this->conteudo;
	}

	/**
	 * Formata número inteiro para decimal com duas casas e com separador de milhar
	 *
	 * @param integer $numero inteiro a ser formatado
	 *
	 * @return string
	 */
	 
	private function inteiro_decimal_br($numero)
	{
		$retorno = $numero;
		$posponto =  strpos($numero, '.');
		if ($posponto > -1)
		{
			$str1 = substr($numero, 0, $posponto);
			$str2 = substr($numero, $posponto, $posponto + 1);
			$retorno = $str1 . $str2;

		}
	    return $retorno;
	}

	private function processarTag($key, $value){
		/* Verifica a existência do prefixo na string */
		$posinicial = strpos($this->conteudo, $key);
		$posfinal = -1;

		/* se encontrar, procura pela tag */
		if( $posinicial > -1 ){
			$posfinal = $posinicial + strlen($key);
			$str1 = substr($this->conteudo, 0, $posinicial);
			$str2 = substr($this->conteudo, $posfinal);
			$this->conteudo = $str1.' ' . $value . ' '.$str2;
		}
	}
}



?>