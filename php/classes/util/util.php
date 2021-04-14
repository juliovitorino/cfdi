<?php  

/**
 * Classe de metodos utilitarios
 * Julio Cesar Vitorino, 2015
 */
class Util
{
	const str = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ01234567890';

	static function getCodigo($tamanho) 
	{
		$retorno = "";
		for ($i=0; $i < $tamanho; $i++) { 
			$pos = rand(0, strlen(self::str));
			$retorno = $retorno . substr(self::str, $pos, 1);
		}


		return $retorno;
	}

	static function DMYHMiS_to_MySQLDate($str)
	{
		//           1
		// 0123456789012345678
		// 31-12-2019 13:52:36
		$dia=substr($str,0,2);
		$mes=substr($str,3,2);
		$ano=substr($str,6,4);
		$hrmiss=substr($str,11,8);
		return $ano . '-' . $mes . '-' . $dia . ' ' . $hrmiss;
	}


	static function MySQLDate_to_DMYHMiS($str)
	{
		//           1
		// 0123456789012345678
		// 2019-02-03 13:52:36
		$dia=substr($str,8,2);
		$mes=substr($str,5,2);
		$ano=substr($str,0,4);
		$hrmiss=substr($str,11,8);
		return $dia . '-' . $mes . '-' . $ano . ' ' . $hrmiss;
	}

	static function ConverterDMYHM_to_YMDHMS($str)
	{
		//           1
		// 0123456789012345
		// 31/05/2019 13:52
		$dia=substr($str,0,2);
		$mes=substr($str,3,2);
		$ano=substr($str,6,4);
		$hrmi=substr($str,11,5);
		return $ano . '-' . $mes . '-' . $dia . ' ' . $hrmi . ':00';
	}
	/**
	 * getLoremIpsum() - retorna string Lorem Ipsum
	 * @param string
	 * @param array
	 * @return string
	 */
	static function getLoremIpsum()
	{
		$lorem = [
			'Lorem ipsum dolor sit amet', 
			'consectetur adipiscing elit.',
			'Fusce vehicula finibus magna,', 
			'vel consectetur lorem pulvinar sit amet.',
			'Mauris sit amet felis pretium leo convallis pharetra quis in orci.', 
			'Sed quis bibendum nibh. Nulla facilisis faucibus diam in rutrum.',
			'Aliquam orci ligula, porta et tempor id, vestibulum vitae orci.',
			'Nulla faucibus non dolor eu maximus.',  
			'Pellentesque nec lectus facilisis, efficitur felis id, scelerisque sapien. ',
			'Mauris in pretium lectus, id imperdiet lorem. Etiam sit amet consequat nisl. Suspendisse ac suscipit nisi.'
		];
		$retorno = $lorem[rand(0,count($lorem)-1)];
		return $retorno;
	}


	/**
	 * getTrocaConteudoParametrizada() - retorna string com substituição de tags
	 * @param string
	 * @param array
	 * @return string
	 */
	static function getTrocaConteudoParametrizada($str, $lsttags)
	{
		$retorno = $str;
		foreach ($lsttags as $key => $value) {
			$retorno = str_replace($key, $value, $retorno);
		}

		return $retorno;
	}

	/**
	 * getMoeda() - retorna string formatada em milhares com moeda
	 * @param $valor
	 * @param $moeda
	 * @param $sepmilhar
	 * @param $sepdec
	 * @param $prefsuf
	 * @return string
	 */
	static function getMoeda($valor, $moeda='BRL', $sepmilhar='.', $sepdec=",", $prefsuf=true)
	{
		$numf =  number_format($valor, 2, $sepdec, $sepmilhar);
		$retorno = $prefsuf ? "$moeda $$numf" : "$numf $$moeda";

		return $retorno;
	}

	/**
	 * getFmtNum() - retorna string formatada em milhares
	 * @param $valor
	 * @param $casasdec
	 * @param $sepmilhar
	 * @param $sepdec
 	 * @return string
	 */
	static function getFmtNum($valor, $casasdec=2, $sepmilhar='.', $sepdec=",")
	{
		$retorno =  number_format($valor, $casasdec, $sepdec, $sepmilhar);

		return $retorno;
	}

	static function getNow() {
		return date("Y") . "-" . date("m") . "-" . date("d") . " " . date("H") . ":" . date("i") . ":" . date("s");
	}	
	
}

?>