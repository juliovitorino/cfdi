<?php

/**
 * VariavelCache - Cache Acelerador de Mensagens
 *
 * @author Julio Vitorino
 * @since 09/08/2018
 */

require_once 'VariavelServiceImpl.php';

class VariavelCache
{
	private static $instance;

	public $lstmsg = [];


	/**
	* Construtor privado para o singleton
	*/
	public function __construct()
	{
		$msi = new VariavelServiceImpl();
		$lstmsgbd = $msi->listarTodasVariaveis("A");
		if (sizeof($lstmsgbd) > 0) {

			foreach ($lstmsgbd as $key => $value) {
				$itemarray = [ $value->variavel => $value->conteudo ];
				array_push($this->lstmsg, $value->variavel, $value->conteudo);
			}
		}
	}

	/**
	 * getVariavel() - retorna mensagem baseada em um codigo
	 * @param string
	 * @return string
	 */
	public function getVariavel($codigovar)
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
	 * getVariavelHeader() - retorna mensagem baseada em um codigo
	 * @param string
	 * @return string
	 */
	public function getVariavelHeader($codigovar)
	{
		$retorno = "";
		for ($i=0; $i < sizeof($this->lstmsg) ; $i = $i + 2) { 
			if($this->lstmsg[$i] == $codigovar)
			{
				$retorno = $this->lstmsg[$i];
				break;
			}
		}

		return $retorno;
	}

	/**
	 * getSysinfo() - Retorna informações do sistema
	 * @param string
	 * @return string
	 */
	public function getSysinfo()
	{
		$sysinfo = [];

		array_push($sysinfo, [ $this->getVariavelHeader(ConstantesVariavel::SYSINFO_APP) => $this->getVariavel(ConstantesVariavel::SYSINFO_APP)]);
		array_push($sysinfo, [ $this->getVariavelHeader(ConstantesVariavel::SYSINFO_APP_DESC) => $this->getVariavel(ConstantesVariavel::SYSINFO_APP_DESC)]);
		array_push($sysinfo, [ $this->getVariavelHeader(ConstantesVariavel::SYSINFO_APP_VERSAO) => $this->getVariavel(ConstantesVariavel::SYSINFO_APP_VERSAO)]);
		array_push($sysinfo, [ $this->getVariavelHeader(ConstantesVariavel::SYSINFO_APP_VERSAO_BACKEND) => $this->getVariavel(ConstantesVariavel::SYSINFO_APP_VERSAO_BACKEND)]);
		array_push($sysinfo, [ $this->getVariavelHeader(ConstantesVariavel::SYSINFO_APP_VERSAO_FRONTEND) => $this->getVariavel(ConstantesVariavel::SYSINFO_APP_VERSAO_FRONTEND)]);
		array_push($sysinfo, [ $this->getVariavelHeader(ConstantesVariavel::SYSINFO_APP_COPY) => $this->getVariavel(ConstantesVariavel::SYSINFO_APP_COPY)]);
		array_push($sysinfo, [ $this->getVariavelHeader(ConstantesVariavel::SYSINFO_APP_DEV) => $this->getVariavel(ConstantesVariavel::SYSINFO_APP_DEV)]);
		array_push($sysinfo, [ $this->getVariavelHeader(ConstantesVariavel::SYSINFO_APP_EMAILDEV) => $this->getVariavel(ConstantesVariavel::SYSINFO_APP_EMAILDEV)]);

		return $sysinfo;
	}

	/**
	 * getStatus() - retorna a descricao do status baseado no codigo
	 * @param string
	 * @return string
	 */
	public function getStatusDesc($status)
	{
		$retorno = ConstantesVariavel::STATUS_ATIVO_DESC;
		switch ($status) {
			case ConstantesVariavel::STATUS_ATIVO:
				$retorno = ConstantesVariavel::STATUS_ATIVO_DESC;
				break;
			case ConstantesVariavel::STATUS_APROVADO:
				$retorno = ConstantesVariavel::STATUS_APROVADO_DESC;
				break;
			case ConstantesVariavel::STATUS_INATIVO:
				$retorno = ConstantesVariavel::STATUS_INATIVO_DESC;
				break;
			case ConstantesVariavel::STATUS_TRABALHANDO:
				$retorno = ConstantesVariavel::STATUS_TRABALHANDO_DESC;
				break;
			case ConstantesVariavel::STATUS_FINALIZADO:
				$retorno = ConstantesVariavel::STATUS_FINALIZADO_DESC;
				break;
			case ConstantesVariavel::STATUS_ENVIADO:
				$retorno = ConstantesVariavel::STATUS_ENVIADO_DESC;
				break;
			case ConstantesVariavel::STATUS_PENDENTE:
				$retorno = ConstantesVariavel::STATUS_PENDENTE_DESC;
				break;
			case ConstantesVariavel::STATUS_BLOQUEADO:
				$retorno = ConstantesVariavel::STATUS_BLOQUEADO_DESC;
				break;
			case ConstantesVariavel::STATUS_LIQUIDADO:
				$retorno = ConstantesVariavel::STATUS_LIQUIDADO_DESC;
				break;
			case ConstantesVariavel::STATUS_NEGADO:
				$retorno = ConstantesVariavel::STATUS_NEGADO_DESC;
				break;
			case ConstantesVariavel::STATUS_PERMITIDO:
				$retorno = ConstantesVariavel::STATUS_PERMITIDO_DESC;
				# code...
				break;
			case ConstantesVariavel::STATUS_REALIZADO:
				$retorno = ConstantesVariavel::STATUS_REALIZADO_DESC;
				break;
			case ConstantesVariavel::STATUS_FILA:
				$retorno = ConstantesVariavel::STATUS_FILA_DESC;
				break;
			case ConstantesVariavel::STATUS_REPORTAR_BUG:
				$retorno = ConstantesVariavel::STATUS_REPORTAR_BUG_DESC;
				break;
			case ConstantesVariavel::STATUS_VALIDAR_COMPLETOU:
				$retorno = ConstantesVariavel::STATUS_VALIDAR_COMPLETOU_DESC;
				break;
			case ConstantesVariavel::STATUS_VALIDAR_RESGATOU:
				$retorno = ConstantesVariavel::STATUS_VALIDAR_RESGATOU_DESC;
				break;
			case ConstantesVariavel::STATUS_VALIDAR_ENTREGOU:
				$retorno = ConstantesVariavel::STATUS_VALIDAR_ENTREGOU_DESC;
				break;
			case ConstantesVariavel::STATUS_VALIDAR_RECEBEU:
				$retorno = ConstantesVariavel::STATUS_VALIDAR_RECEBEU_DESC;
				break;
			case ConstantesVariavel::STATUS_AGUARDANDO_ARQUIVAMENTO:
				$retorno = ConstantesVariavel::STATUS_AGUARDANDO_ARQUIVAMENTO_DESC;
				break;
			case ConstantesVariavel::STATUS_PURGE:
				$retorno = ConstantesVariavel::STATUS_PURGE_DESC;
				break;
			case ConstantesVariavel::STATUS_DESABILITADO:
				$retorno = ConstantesVariavel::STATUS_DESABILITADO_DESC;
				break;
			case ConstantesVariavel::STATUS_MANUTENCAO:
				$retorno = ConstantesVariavel::STATUS_MANUTENCAO_DESC;
				break;
			default:
				$retorno = "sem tradução de status";
				break;
		}
		
		return $retorno;
	}





	/**
	* getInstance() - Instância estática do configurador
	*/
    public static function getInstance() {
        if (!isset(self::$instance)) {
            self::$instance = new VariavelCache();
        }
 
        return self::$instance;
    }



 

}

?>