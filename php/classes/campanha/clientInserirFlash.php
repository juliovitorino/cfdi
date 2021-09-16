<?php  
// URL http://junta10.dsv:8080/cfdi/php/classes/campanha/clientInserirFlash.php

require_once 'campanhaServiceImpl.php';
require_once 'campanhaDTO.php';
require_once '../util/util.php';

$campanhas = [
'Desconto imperdível! Só hoje!',
'Faltam ' . rand(1,24) . ' horas para acabar a promoção',
'Queima de estoque: últimas unidades!',
'Leve 2 e pague 1',
'Desconto de ' . rand(10,50) . '% para os primeiros ' . rand(10,100) . ' clientes',
'Desconto progressivo: a cada produto, pague ' . rand(10,70) . '% a menos na compra',
'Ganhe ' . rand(10,50) . '% de desconto na compra do segundo produto',
'Liquidação: ' . rand(10,50) . '% OFF',
'Super saldão: produtos a partir de ' . rand(10,50) . ' reais',
'Todos os produtos selecionados por ' . rand(10,50) . ' reais!',
'Kits de produtos com ' . rand(10,50) . '% de desconto!',
'Promoção imperdível: o produto mais vendido da nossa loja com ' . rand(10,50) . '% de desconto!',
'Últimas unidades!',
'Confira os lançamentos!',
'Ganhe um brinde exclusivo em compras acima de X reais',
'A cada ' . rand(10,50) . ' reais, ganhe um cupom para participar do nosso sorteio e concorra a um prêmio exclusivo!',
'Acumule 10 pontos em compras e ganhe um brinde exclusivo',
'Operação Black Friday: aproveite os super descontos!',
'Não sabe o que comprar para o Dia das Mães? Encontre aqui os melhores presentes!',
'Parcele sua compra sem juros!',
'Frete grátis em compras acima de ' . rand(10,200) . ' reais',
'Indique a nossa marca e ganhe ' . rand(1,15) . '% de desconto na próxima compra!',
'Curta a nossa página e ganhe ' . rand(1,15) . '% de desconto na primeira compra',
'Compartilhe este post e concorra a um vale de ' . rand(10,50) . ' reais para gastar em nossa loja!'
];
$date = new DateTime();
$ts = $date->getTimestamp();

$dto = new campanhaDTO();

$dto->id_usuario = 1002; //rand(1,21);
$dto->nome = $campanhas[rand(0,count($campanhas)-1)];
$dto->recompensa = 'Ganhe ' . rand(10,50) . '% de desconto na compra com após completar a cartela';
$dto->msgAgradecimento = 'Obrigado pela Preferência';

$csi = new CampanhaServiceImpl();
$retorno = $csi->cadastrarFlash($dto);
var_dump($retorno);



?>