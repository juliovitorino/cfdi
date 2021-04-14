<?php
 
 // Importar dependencias
 require_once '../usuariopublicidade/UsuarioPublicidadeServiceImpl.php';
 require_once '../usuariopublicidade/UsuarioPublicidadeDTO.php';
 require_once '../uploadManager/uploadManager.php';

// Obtem o token de sessao (pode ser dispositivo ou outro hardware qualquer)
$token = $_POST['tokenid'];
$image = $_POST['image'];
$name = $_POST['name'];
$uspuid = $_POST['id'];

include_once '../../inc/validarTokenApp.php';

// >>>Backend
//echo "Image Uploaded Successfully.";

$csi = new UsuarioPublicidadeServiceImpl();
$dto = new UsuarioPublicidadeDTO();
$dto->id = $uspuid;
$dto->id_usuario = $sessaodto->usuariodto->id;

$dirTransicao = VariavelCache::getInstance()->getVariavel(ConstantesVariavel::HOME_UPLOAD_TRANSICAO);
$realImage = base64_decode($image);
file_put_contents($dirTransicao . '/' . $name, $realImage);

$um = new uploadManager($token);
$um->moverArquivoTransicaoParaRepositorio($name);

$fullname = Util::getTrocaConteudoParametrizada(VariavelHelper::getVariavel(ConstantesVariavel::URL_REPOSITORIO_USUARIO),[
    ConstantesVariavel::P1 => $sessaodto->usuariodto->id,
]) . "/$name";

$retorno = $csi->atualizarImagem($uspuid, $fullname);

echo json_encode($retorno);

 
?>