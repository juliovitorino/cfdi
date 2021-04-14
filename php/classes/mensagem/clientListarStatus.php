<?php

require_once 'MensagemServiceImpl.php';

$status = "A";

$msi = new MensagemServiceImpl();
var_dump($msi->listarTodasMensagens($status));


?>