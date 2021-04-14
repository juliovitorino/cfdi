<?php 
ob_start();

require_once '../sessao/SessaoServiceImpl.php';
require_once '../headline/HeadlineHistoricoDTO.php';
require_once '../headline/HeadlineHistoricoServiceImpl.php';
require_once '../headlinebuilder/HeadlineBuilder.php';
require_once '../estatisticafuncao/EstatisticaFuncaoServiceImpl.php';
require_once '../estatisticafuncao/ConstantesEstatisticaFuncao.php';
require_once '../debugger/Debugger.php';
require_once '../usuariosplanos/PlanoUsuarioServiceImpl.php';

include_once '../../inc/validarToken.php';

//TESTE EM HARDCODE
/*
$token = 'c6f3b9466e5c21598248ebea744ec754deec9ed3';
$palavrachave = 'como vender mais';
$objetivo = 'para criar uma aposentadoria inesquecível';
$gatilho = '1';
$qtde = 50;
*/
//FIM TESTE

// Obtem o usuário do token validado
$ssi = new SessaoServiceImpl();

// obtem a sessao em ativa do usuario
$sessaodto = $ssi->obterRegistroDonoTokenSessao($token);
//var_dump($sessaodto);

// obtem dados enviados via post

$palavrachave = $_POST['palavrachave'];
$objetivo = $_POST['objetivo'];
$gatilho = $_POST['gatilho'];
$qtde = 1;

// Fim captacao de dados do post

$gatilhodisparado = false;

if ($gatilho == '1')
{
	$gatilhodisparado = true;
}

// Verifica a permissão 
$pusi = new PlanoUsuarioServiceImpl();
$res = $pusi->verificarPermissaoPlano($sessaodto->usuario, ConstantesPlano::PERM_HEADLINES);
Debugger::debug($res, Debugger::DEBUG);

// Retorno padrão da 
$seguefluxo = false;

if (
	($res->msgcode == ConstantesMensagem::PERMISSAO_CONCEDIDA_FACTORY) ||
	($res->msgcode == ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO)
) {
	$seguefluxo = true;
}

//************* Codigo padrão para registro de estatisticas **********
// Preenche campos mutaveis da estatistica. Verifica se tem registro de estatistica
$tipoef = ConstantesEstatisticaFuncao::FUNCAO_HEADLINE;
$projetoidif = 0;

include_once '../../inc/registrarEstatisticaFuncao.php';

//*******FIM  :: Codigo padrão para registro de estatisticas **********

// Inicializa HeadlineBuilder e servicos
$hhdto = new HeadlineHistoricoDTO();
$hb = new HeadlineBuilder($palavrachave, $objetivo, $gatilhodisparado);
$hhsi = new HeadlineHistoricoServiceImpl();

for ($i=0; $i < $qtde; $i++) { 
	$hhdto->usuarioid = $sessaodto->usuario;
	$hhdto->sessaoid = $sessaodto->id;
	$hhdto->palavra_chave_seo = $palavrachave;
	$hhdto->objetivo = $objetivo;
	$hhdto->headline = $hb->getHeadline();

	$hhsi->cadastrar($hhdto);

	// Incrementa estatistica
	$efsi->incrementarQtdePorID($dtoef->id);


}

//echo json_encode($hhsi->listarTudoPorSessao($sessaodto->id),JSON_UNESCAPED_UNICODE);
$lstheadline = $hhsi->listarTudoPorSessao($sessaodto->id);
//var_dump($lstheadline);

$htmlmomento = "";
$flipflop = true;

foreach ($lstheadline as $key => $value) {
	if($flipflop){
		if ($seguefluxo) {
			$htmlmomento = $htmlmomento . '<li class="in"><img src="img/doc/headline-01.png" class="avatar" alt="">
	                                        <div class="message">
	                                            <span class="arrow"></span> <a class="name" href="#">Mago Shark</a> <span class="datetime">' . $value->dataCadastro . '</span> <span class="body">' . $value->headline . '</span>
	                                        </div>
	                                    </li>';			
		}
	} else {
		if ($seguefluxo){
			$htmlmomento = $htmlmomento . '<li class="out"><img src="img/doc/headline-02.png" class="avatar" alt="">
	                                        <div class="message">
	                                            <span class="arrow"></span> <a class="name" href="#">Smart Lobo</a> <span class="datetime">' . $value->dataCadastro . '</span> <span class="body">' . $value->headline . '</span>
	                                        </div>
	                                    </li>';		
		}
	}
	$flipflop = !$flipflop;
}

if (!$seguefluxo){
	$htmlmomento = $htmlmomento . '<li class="in"><img src="img/doc/headline-01.png" class="avatar" alt="">
                                    <div class="message">
                                        <span class="arrow"></span> <a class="name" href="#">Mago Shark</a> <span class="datetime">' . date('Y/m/d') . '</span> <span class="body">' . $res->msgcodeString . '</span>
                                    </div>
                                </li>';			

}

$htmlretorno = '<ul class="chat nice-chat">' . $htmlmomento . '</ul>';

echo $htmlretorno;

ob_flush();
?>