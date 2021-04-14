<?php  

require_once 'fake.php';

var_dump(Fake::getInstance()->getNomeFake());
var_dump(Fake::getInstance()->getSobrenomeFake());
var_dump(Fake::getInstance()->getDomainFake());
var_dump(Fake::getInstance()->getSeparadorFake());
var_dump(Fake::getInstance()->getEmailFake());
var_dump(Fake::getInstance()->getFakeDTO());



?>