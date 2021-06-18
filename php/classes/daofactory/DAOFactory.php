<?php

/**
 * DAOFactory - Fabrica de Objetos DAO
 *
 * @author Julio Vitorino
 * @since 25/07/2018
 */

require_once 'ConstantesDAO.php';
require_once 'MySqlDAOFactory.php';
require_once '../global/GlobalStartup.php';


abstract class DAOFactory 
{
	private $conn;

	/* anula construtor */
	private function __construct()
	{
		# code...
	}

	/**
	 * Retorna a instancia das fabricas DAO de acordo com a configuracao em
	 * properties.
	 * @return fabrica DAO.
	 */
	public static function getDAOFactory() 
	{
		// Obtem a configuracao base do sistema
		$gs = GlobalStartup::getInstance();

		// Verifica qual instancia de factory de dados retornar
		switch ($gs->bd) {
			case ConstantesDAO::DAO_MYSQL:
				return new MySqlDAOFactory();
			
			default:
				# code...
				break;
		}
	}
	
	// Abstrações para serem implementadas nas fabricas
	public abstract function getNextSequence($daofactory,$sequence);
	public abstract function getUsuarioDAO($daofactory);
	public abstract function getSessaoDAO($daofactory);
	public abstract function getEstatisticaFuncaoDAO($daofactory);
	public abstract function getMensagemDAO($daofactory);
	public abstract function getVariavelDAO($daofactory);
	public abstract function getPlanoDAO($daofactory);
	public abstract function getPlanoUsuarioDAO($daofactory);
	public abstract function getPlanoUsuarioFaturaDAO($daofactory);
	public abstract function getUsuarioTrocaSenhaHistoricoDAO($daofactory);
	public abstract function getCampanhaDAO($daofactory);
	public abstract function getCampanhaQrCodeDAO($daofactory);
	public abstract function getCfdiDAO($daofactory);
	public abstract function getCartaoDAO($daofactory);
	public abstract function getTraceDAO($daofactory);
	public abstract function getTipoEmpreendimentoDAO($daofactory);
	public abstract function getUsuarioTipoEmpreendimentoDAO($daofactory);
	public abstract function getUfDAO($daofactory);
	public abstract function getCidadeDAO($daofactory);
	public abstract function getCampanhaCashbackDAO($daofactory);
	public abstract function getCampanhaCashbackCCDAO($daofactory);
	public abstract function getUsuarioComplementoDAO($daofactory);
	public abstract function getUsuarioPublicidadeDAO($daofactory);
	public abstract function getUsuarioNotificacaoDAO($daofactory);
	public abstract function getSeloCuringaDAO($daofactory);
	public abstract function getUsuarioCashbackDAO($daofactory);
	public abstract function getUsuarioAutorizadorDAO($daofactory);
	public abstract function getUsuarioAvaliacaoDAO($daofactory);
	public abstract function getCartaoPedidoDAO($daofactory);
	public abstract function getCampanhaTopDezDAO($daofactory);
	public abstract function getFilaPublicidadeDAO($daofactory);
	public abstract function getVersaoDAO($daofactory);
	public abstract function getUsuarioVersaoDAO($daofactory);
	public abstract function getFilaQRCodePendenteProduzirDAO($daofactory);
	public abstract function getMkdListaDAO($daofactory);
	public abstract function getCampanhaSorteioDAO($daofactory);
	public abstract function getCampanhaSorteioFilaCriacaoDAO($daofactory);
	public abstract function getCampanhaSorteioNumerosPermitidosDAO($daofactory);


	public function getSession() {
		return $this->conn;
	}

	/**
	 * open() - abre uma conexão com o banco MySql
	 */
	public function open() {
		//mysqli('host:porta','usuario','senha','dbname')

		// Busca configuração de ambiente
		$gs = GlobalStartup::getInstance();
		$this->conn = new mysqli($gs->host, $gs->userbd, $gs->pwdbd, $gs->nomebd);

		//local no meu note - OK
		//$this->conn = new mysqli('127.0.0.1:3306', 'plimbo50', 'Fork3t56nta205cwv', 'plimbo');

		//remoto pelo meu note - OK
		//$this->conn = new mysqli('br428.hostgator.com.br:3306', 'elite759_canvt50', 'Fork3t56nta205cwv', 'elite759_plimbo');

		//dentro do dominio elitefinanceira - OK
		//$this->conn = new mysqli('localhost', 'elite759_canvt50', 'Fork3t56nta205cwv', 'elite759_plimbo');

		if ($this->conn->connect_error){
			die('Não foi possível conectar: ' . mysql_error());
		}

		/* Troca o conjunto de caracteres para utf8 */
		if (!$this->conn->set_charset("utf8")) {
		    printf("Error carregando utf8: %s\n", $this->conn->error);
		    exit();
		}/* else {
		    printf("Current character set: %s\n", $mysqli->character_set_name());
		}*/
	}

	/**
	 * beginTransaction() - inicializa um contexto transacional
	 */
	public function beginTransaction() {
		$this->conn->autocommit(FALSE);
	}
	
	/**
	 * commit() - realiza o commit fisico no bd
	 */
	public function commit() {
		$this->conn->commit();
	}
	
	/**
	 * rollback() - desfaz todos os comandos DML realizados no contexto transacional
	 */
	public function rollback() {
		$this->conn->rollback();
	}

	/**
	 * close() - Encerra a conexão com MySql
	 */
	public function close() {
		//if (this.session != null && this.isOpen && this.session.isOpen()) {
		$this->conn->close();
		//}
	}

}
?>
