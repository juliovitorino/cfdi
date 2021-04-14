<?php  

/**
* Questionario DTO = Transito de dados do formulário
*
* @author Julio Vitorino
* @since 10/07/2018
*/
class QuestionarioDTO
{

	/* Constantes*/

	// $plataformaDigital
	const PD_EDUZZ = '0';
	const PD_HOTMART = '1';
	const PD_MONETIZZE = '2';

	// $tipo
	const TIPO_POST_REDE_SOCIAL = '0';
	const TIPO_ARTIGO_CONVERSAO = '1';
	const TIPO_ARTIGO_MURALHA = '2';
	const TIPO_POST_WEB20 = '3';
	const TIPO_POST_PBN = '4';
	const TIPO_RESPOSTAS_BACKLINK = '5';

	/* Atributos publicos*/
	
	public $palavraSEO;
	public $nicho;
	public $infoprodutoNome;
	public $infoprodutoPreco;
	public $plataformaDigital;
	public $tipo;
	public $linkcta;

}
?>