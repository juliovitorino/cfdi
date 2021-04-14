<?php

require_once 'GlobalStartup.php';

$gs = GlobalStartup::getInstance();
echo $gs->bd;
echo "<br>";
echo $gs->pathjson;
echo "<br>";
echo $gs->ambiente;
echo "<br>";
echo $gs->host;
echo "<br>";
echo $gs->userbd;
echo "<br>";
echo $gs->pwdbd;
echo "<br>";
echo $gs->nomebd;


?>