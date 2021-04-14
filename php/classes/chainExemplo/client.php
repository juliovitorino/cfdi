<?php  

require_once 'MainCOR.php';
require_once 'aChain.php';
require_once 'bChan.php';

$mcor = new MainCOR();
$mcor->setContext('julio Vitorino');
$mcor->addChain(new aChain($mcor));
$mcor->addChain(new bChain($mcor));
$mcor->execute();

?>