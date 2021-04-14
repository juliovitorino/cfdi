<?php
require_once 'UsuarioServiceImpl.php';
require_once 'BonusDTO.php';

$usi = new UsuarioServiceImpl();
$usuariodto = $usi->pesquisarPorID(1); // pesquisa usuario 1
$usuariodto->lst_projetos = $usi->buscarProjetoEspecifico(1,1); // busca projeto especifico 1 do usuario 1
$usuariodto->lst_projetos->lst_bonus = $usi->buscarTodosBonus(1); // coloca os bonus ref ao projeto 1 dentro da lista bonus
$usuariodto->lst_projetos->lst_itens = $usi->buscarTodosItens(1); // coloca os itens ref ao projeto 1 dentro da lista bonus
$usuariodto->lst_projetos->lst_dores = $usi->buscarTodasDores(1); // coloca as dores ref ao projeto 1 dentro da lista bonus
$usuariodto->lst_projetos->lst_beneficios = $usi->buscarTodosBeneficios(1); // coloca as dores ref ao projeto 1 dentro da lista bonus
$usuariodto->lst_projetos->lst_tecnicas = $usi->buscarTodasTecnicas(1); // coloca as tecnicas ref ao projeto 1 dentro da lista bonus
var_dump($usuariodto);

?>