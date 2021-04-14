<?php  

require_once 'EstatisticaFuncaoDTO.php';
require_once 'EstatisticaFuncaoServiceImpl.php';

$efsi = new EstatisticaFuncaoServiceImpl();
$efsi->incrementarQtdePorID(1);


?>