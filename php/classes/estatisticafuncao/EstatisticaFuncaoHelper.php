<?php  

// importar dependencias
require_once 'EstatisticaFuncaoDTO.php';
require_once 'EstatisticaFuncaoServiceImpl.php';

/**
 * 
 */
class EstatisticaFuncaoHelper
{
	
	function __construct()	{	}

	public static function getDTO($usuarioid, $projetoid, $tipo)
	{
		$dto = new EstatisticaFuncaoDTO();
		$dto->usuarioid = $usuarioid;		
		$dto->projetoid = $projetoid;		
		$dto->tipo = $tipo;		
		$dto->ano = date('Y');		
		$dto->mes = date('m');		
		$dto->dia = date('d');	
		$dto->qtde = 0;	
		return $dto;
	}

	public static function registrarEstatisticaService($idusuario, $idcampanha,$tipo) {
		$esfusi = new EstatisticaFuncaoServiceImpl();
		$esfudto = self::getDTO($idusuario, $idcampanha, $tipo);

		$rec = $esfusi->pesquisarPorUIX($tipo, $esfudto->dia, $esfudto->mes, $esfudto->ano, $idusuario, $idcampanha);

		if($rec->usuarioid == null){
			$esfusi->cadastrar($esfudto);
		} else {
			$esfusi->incrementarQtde($tipo, $esfudto->dia, $esfudto->mes, $esfudto->ano, $idusuario, $idcampanha);
		}

	}
}

?>