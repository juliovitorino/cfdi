<?php
require_once 'UsuarioServiceImpl.php';
require_once 'ProjetoDTO.php';

$date = new DateTime();
$ts = $date->getTimestamp();

$dto = new ProjetoDTO();
$dto->usuarioid = 1;
$dto->projeto = 'Projeto ' . $ts;
$dto->email_contato = 'contato@elitefinanceira.com';
$dto->palavra_chave_exata = 'Podemos sempre vender';
$dto->headline = $ts . ' formas de vender todos os dias';
$dto->nicho = 'marketing-digital';
$dto->plataforma = 'HOTMART';
$dto->nome_produto = 'produto ' . $ts;
$dto->desc_produto = 'descritivo ' . $ts ;
$dto->tipo_produto = 'Treinamento';
$dto->preco_produto = 497;
$dto->hotlink_pv = 'http://go.hotmart.com?id=' . 	$ts;
$dto->hotlink_chkout = 'http://go.hotmart.com?idchk=' . 	$ts;;
$dto->autoridade = 'Paulo ' . $ts . 'Costa';
$dto->breve_desc_autoridade = 'Lorem Ipsum';
$dto->status = 'A';
$us = new UsuarioServiceImpl();
$ok = $us->cadastrarProjeto($dto);

if (!is_null($ok))
{
	echo $ok->msgcode;
	echo $ok->msgcodeString;
} else {
	echo "Nao  foi";

}
?>