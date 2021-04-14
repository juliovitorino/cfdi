<?php

/**
 * ProjetoDTO - Data Transfer Object
 */
class ProjetoDTO
{

	public $id;
	public $usuarioid;
	public $projeto;
	public $email_contato;
	public $palavra_chave_exata;
	public $headline;
	public $nicho;
	public $plataforma;
	public $nome_produto;
	public $desc_produto;
	public $tipo_produto;
	public $preco_produto;
	public $hotlink_pv;
	public $hotlink_chkout;
	public $autoridade;
	public $breve_desc_autoridade;
	public $url_minisite;
	public $status;
	public $lst_bonus = array();
	public $lst_itens = array();
	public $lst_dores = array();
	public $lst_beneficios = array();
	public $lst_tecnicas = array();
	public $dataCadastro;
	public $dataAtualizacao;
}
?>
