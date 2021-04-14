<?php

// importar dependências
require_once 'TagsCommand.php';

// Importar dependências
require_once '../maquinaminisite/ConstantesMaquinaMinisiteFactory.php';
require_once '../maquinaminisite/MaquinaMinisiteFactory.php';
require_once '../usuarios/UsuarioServiceImpl.php';

//-- Obtem nicho em função do projeto fornecido --

$usi = new UsuarioServiceImpl();
$usuariodto = $usi->pesquisarPorID(1);
$projetodto = $usi->buscarProjetoEspecifico(1, 1);
$projetodto->lst_bonus = $usi->buscarTodosBonus(1);
$projetodto->lst_itens = $usi->buscarTodosItens(1);
$projetodto->lst_dores = $usi->buscarTodasDores(1);
$projetodto->lst_beneficios = $usi->buscarTodosBeneficios(1);
$projetodto->lst_tecnicas = $usi->buscarTodasTecnicas(1);

//var_dump($usuariodto);
//var_dump($projetodto);
//var_dump($projetodto->lst_bonus);
var_dump($projetodto->lst_itens);



$conteudo = <<<EOD
	const COMMAND_PALAVRA_CHAVE_EXATA = "*=palavra_chave_exata=*";
	const COMMAND_HEADLINE = "*=headline=*";
	const COMMAND_NOME_PROJETO = '*=projeto=*';
	const COMMAND_EMAIL_CONTATO = '*=email_contato=*';
	const COMMAND_NICHO = '*=nicho=*';
	const COMMAND_PLATAFORMA = '*=plataforma=*';
	const COMMAND_NOME_PRODUTO = '*=nome_produto=*';
	const COMMAND_TIPO_PRODUTO = '*=tipo_produto=*';
	const COMMAND_PRECO_PRODUTO = '*=preco_produto=*';
	const COMMAND_HOTLINK_PAG_VENDA = '*=hotlink_pv=*';
	const COMAMND_HOTLINK_CHECKOUT = '*=hotlink_chkout=*';
	const COMMAND_AUTORIDADE = '*=autoridade=*';
	const COMMAND_DESC_AUTORIDADE = '*=breve_desc_autoridade=*';
	const COMMAND_STATUS_PROJETO = '*=status=*';
	const COMMAND_LISTA_BONUS = '*=lista_bonus=*';
	const COMMAND_LISTA_ITENS = '*=lista_itens=*';
	const COMMAND_LISTA_DORES = '*=lista_dores=*';
	const COMMAND_LISTA_BENEFICIOS = '*=lista_beneficios=*';
	const COMMAND_LISTA_TECNICAS = '*=lista_tecnicas=*';
EOD;

echo $conteudo."<br><br>";

$o = New TagsCommand($usuariodto, $projetodto, $conteudo);
echo $o->getConteudo();


?>
