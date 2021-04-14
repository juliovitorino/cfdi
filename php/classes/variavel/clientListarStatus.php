<?php

require_once 'VariavelServiceImpl.php';

$status = "A";

$msi = new VariavelServiceImpl();
var_dump($msi->listarTodasVariaveis($status));


?>