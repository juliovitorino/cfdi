<?php

/**
 * GlobalStartup - Configuração inicial do sistema
 *
 * @author Julio Vitorino
 * @since 25/07/2018
 */

require_once '../composite/TemplateLoader.php'; // :O no clue!!!

class GlobalStartup
{
	private static $instance;

	public $bd;
	public $pathjson;
	public $ambiente;
	public $host;
	public $userbd;
	public $pwdbd;
	public $nomebd;


	/**
	* Construtor privado para o singleton
	*/
	public function __construct()
	{
		$loader = new TemplateLoader(getcwd().'/../../../config/config.json');
		$jsondecode = json_decode($loader->getConteudo(),true);
		$this->bd = $jsondecode['bd'];
		$this->pathjson = $jsondecode['pathjson'];
		$this->ambiente = $jsondecode['ambiente'];

		foreach ($jsondecode['configs'] as $key => $value) {
			if($value['tipo'] == $this->ambiente)
			{
				$this->host = $value['host'];
				$this->userbd = $value['userbd'];
				$this->pwdbd = $value['pwdbd'];
				$this->nomebd = $value['nomebd'];
			}
		}

	}


	/**
	* getInstance() - Instância estática do configurador
	*/
    public static function getInstance() {
        if (!isset(self::$instance)) {
            self::$instance = new GlobalStartup();
        }
 
        return self::$instance;
    }
 

}

?>