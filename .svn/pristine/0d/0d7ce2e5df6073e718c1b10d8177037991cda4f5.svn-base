<?php  

// Codigo padrão para registro de estatisticas
$date = new DateTime();
$anoef = $date->format('Y');
$mesef = $date->format('m');
$diaef = $date->format('d');
$usuarioef = $sessaodto->usuario;

$efsi = new EstatisticaFuncaoServiceImpl();
$dtoef = $efsi->pesquisarPorUIX($tipoef, $diaef, $mesef, $anoef, $usuarioef, $projetoidif);

// Se o registro de esw
if(is_null($dtoef->id))
{
	$dtoef = new EstatisticaFuncaoDTO();
	$dtoef->ano = $anoef;
	$dtoef->mes = $mesef;
	$dtoef->dia = $diaef;
	$dtoef->tipo = $tipoef;
	$dtoef->usuarioid = $usuarioef;
	$dtoef->projetoid = $projetoidif;
	$efsi->cadastrar($dtoef);
}

// FIM  :: Codigo padrão para registro de estatisticas

?>

