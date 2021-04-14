<?php

/**
 * MensagemCache - Cache Acelerador de Mensagens
 *
 * @author Julio Vitorino
 * @since 09/08/2018
 */

require_once 'MensagemServiceImpl.php';

class MensagemCache
{
	private static $instance;

	public $lstmsg = [];

	/**
	* Construtor privado para o singleton
	*/
	public function __construct()
	{
		$msi = new MensagemServiceImpl();
		$lstmsgbd = $msi->listarTodasMensagens("A");
		if (sizeof($lstmsgbd) > 0) {

			foreach ($lstmsgbd as $key => $value) {
				array_push($this->lstmsg , $value->msgcodigo, $value->msg);
			}
		}
	}

	/**
	 * getMensagem() - retorna mensagem baseada em um codigo
	 * @param string
	 * @return string
	 */
	public function getMensagem($codigovar)
	{
		$retorno = "";
		for ($i=0; $i < sizeof($this->lstmsg) ; $i = $i + 2) { 
			if($this->lstmsg[$i] == $codigovar)
			{
				$retorno = $this->lstmsg[$i+1];
				break;
			}
		}

		return $retorno;
	}

	/**
	 * getMensagem() - retorna mensagem baseada em um codigo e substitui as tags
	 * @param string
	 * @param array
	 * @return string
	 */
	public function getMensagemParametrizada($codigovar, $lsttags)
	{
		$retorno = "";
		for ($i=0; $i < sizeof($this->lstmsg) ; $i = $i + 2) { 
			if($this->lstmsg[$i] == $codigovar)
			{
				$retorno = $this->lstmsg[$i+1];
				break;
			}
		}

		foreach ($lsttags as $key => $value) {
			$retorno = str_replace($key, $value, $retorno);
		}

		return $retorno;
	}

	/**
	* getInstance() - Instância estática do configurador
	*/
    public static function getInstance() {
        if (!isset(self::$instance)) {
            self::$instance = new MensagemCache();
        }
 
        return self::$instance;
    }

}

?>