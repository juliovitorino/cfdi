<?php

// URL http://elitefinanceira.com/cfdi/php/classes/gateway/appInserirPlanoRecurso.php
// URL http://localhost/cfdi/php/classes/gateway/appInserirPlanoRecurso.php


 /*
Faça um Find/Replace em $_POST por $_GET e use os parametros na URL para simular um GET na HttpRequest
?tokenid=tk
&id=tr
&idplano=tr
&idrecurso=tr
&status=tr
&dataCadastro=tr
&dataAtualizacao=tr

 */
// URL http://localhost/cfdi/php/classes/gateway/appInserirPlanoRecurso.php

/**
*
* appInserirPlanoRecurso - Controlador para permitir acesso ao backend no método cadastrar
* da classe PlanoRecursoServiceImpl.php
* É uma camada visível para outros dispositivos e requisições
*
*======================================================================================
* É OBRIGATÓRIO o fornecimento do tokenid no corpo da HttpRequest
*======================================================================================
* Changelog:
*
* 
* @autor Julio Cesar Vitorino
* @since 09/09/2021 14:02:30
*
*/

require_once '../planorecurso/PlanoRecursoServiceImpl.php';
require_once '../planorecurso/PlanoRecursoDTO.php';
require_once '../util/util.php';

// Obtem o token de sessao (pode ser dispositivo ou outro hardware qualquer)
$token = $_POST['tokenid'];

include_once '../../inc/validarTokenApp.php';

$dto = new PlanoRecursoDTO();

$dto->id = $_POST['id'];
$dto->idplano = $_POST['idplano'];
$dto->idrecurso = $_POST['idrecurso'];
$dto->status = $_POST['status'];
$dto->dataCadastro = $_POST['dataCadastro'];
$dto->dataAtualizacao = $_POST['dataAtualizacao'];


$csi = new PlanoRecursoServiceImpl();

// Cadastra o registro populado no DTO
$retorno = $csi->cadastrar($dto);
echo json_encode($retorno, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE );

?>

<?php

// URL http://elitefinanceira.com/cfdi/php/classes/gateway/appListarPlanoRecurso.php?tokenid=cb1&pag=1
// URL http://localhost/cfdi/php/classes/gateway/appListarPlanoRecurso.php?tokenid=cb1&pag=1

// Importar dependencias
require_once '../planorecurso/PlanoRecursoServiceImpl.php';

// Obtem o token de sessao (pode ser dispositivo ou outro hardware qualquer)
$token = $_GET['tokenid'];
$pag = $_GET['pag'];

include_once '../../inc/validarTokenApp.php';

// >>>Backend
$csi = new PlanoRecursoServiceImpl();
$retorno = $csi->listarPlanoRecurso($pag);

echo json_encode($retorno);


?>

