<?php
 
 // Importar dependencias
 require_once '../campanha/campanhaServiceImpl.php';
 require_once '../uploadManager/uploadManager.php';

// Obtem o token de sessao (pode ser dispositivo ou outro hardware qualquer)
$token = $_POST['tokenid'];
$image = $_POST['image'];
$name = $_POST['name'];
$idcamp = $_POST['id'];

include_once '../../inc/validarTokenApp.php';

// >>>Backend
//echo "Image Uploaded Successfully.";

$csi = new CampanhaServiceImpl();
$dto = new CampanhaDTO();
$dto->id = $idcamp;
$dto->id_usuario = $sessaodto->usuariodto->id;

$dirTransicao = VariavelCache::getInstance()->getVariavel(ConstantesVariavel::HOME_UPLOAD_TRANSICAO);
$realImage = base64_decode($image);
file_put_contents($dirTransicao . '/' . $name, $realImage);

$um = new uploadManager($token);
$um->moverArquivoTransicaoParaRepositorio($name);

$retorno = $csi->autalizarImagemCampanha($idcamp, $name);

echo json_encode($retorno);

 
?>