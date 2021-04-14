<?php

// URL http://localhost/cfdi/php/classes/uploadManager/clientUploadManager.php

require_once 'uploadManager.php';
require_once '../campanha/campanhaServiceImpl.php';

$token = 'b84cb7bd08d7aa8c9c2439c0de4151d5f59f1585';
$token = '689d58a1054565173665d81f164e3d7730855d47';


// >>>Backend
$um = new UploadManager($token);
$um->moverArquivoTransicaoParaRepositorio('plingo50.png');

$csi = new CampanhaServiceImpl();
$retorno = $csi->autalizarImagemCampanha(3, 'plingo50.png');

echo json_encode($retorno);



?>