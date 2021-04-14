<?php

/**
 * MySqlDAOFactory - Fabrica de Objetos DAO para MySql
 *
 * @author Julio Vitorino
 * @since 25/07/2018
 */

require_once '../usuarios/MySqlUsuarioDAO.php';
require_once '../usuarios/MySqlProjetoDAO.php';
require_once '../usuarios/MySqlProjetoBonusDAO.php';
require_once '../usuarios/MySqlProjetoItensDAO.php';
require_once '../usuarios/MySqlProjetoDorDAO.php';
require_once '../usuarios/MySqlProjetoBeneficioDAO.php';
require_once '../usuarios/MySqlProjetoTecnicaDAO.php';

require_once '../usuarios/MySqlKinghostUsuarioDAO.php';
require_once '../usuarios/MySqlKinghostProjetoDAO.php';
require_once '../usuarios/MySqlKinghostProjetoItensDAO.php';
require_once '../usuarios/MySqlKinghostProjetoDorDAO.php';
require_once '../usuarios/MySqlKinghostProjetoBonusDAO.php';
require_once '../usuarios/MySqlKinghostProjetoTecnicaDAO.php';
require_once '../usuarios/MySqlKinghostProjetoBeneficioDAO.php';

require_once '../variavel/MySqlVariavelDAO.php';
require_once '../variavel/MySqlKinghostVariavelDAO.php';

require_once '../mensagem/MySqlMensagemDAO.php';
require_once '../mensagem/MySqlKinghostMensagemDAO.php';

require_once '../estatisticafuncao/MySqlEstatisticaFuncaoDAO.php';
require_once '../estatisticafuncao/MySqlKinghostEstatisticaFuncaoDAO.php';

require_once '../headline/MySqlHeadlineHistoricoDAO.php';
require_once '../headline/MySqlKinghostHeadlineHistoricoDAO.php';

require_once '../sessao/MySqlSessaoDAO.php';
require_once '../sessao/MySqlKinghostSessaoDAO.php';

class MySqlDAOFactory extends DAOFactory
{

	/* anula construtor */
	public function __construct()
	{
		# code...
	}
	
	/**
	 * Retorna um sequencia
	 * @return long
	 */
	public function getNextSequence($daofactory, $sequence) 
	{
		return 1;
	}

	/**
	 * Retorna uma instância de acesso a dados de usuários
	 * @return MySqlUsuarioDAO
	 */
	public function getUsuarioDAO($daofactory) 
	{
		$gs = GlobalStartup::getInstance();
		if($gs->ambiente == 'producao') {
			return new MySqlKinghostUsuarioDAO($daofactory);
		} else {
			return new MySqlUsuarioDAO($daofactory);
		}
	}

	/**
	 * Retorna uma instância de acesso a dados de usuários
	 * @return MySqlSessaoDAO
	 */
	public function getSessaoDAO($daofactory) 
	{
		$gs = GlobalStartup::getInstance();
		if($gs->ambiente == 'producao') {
			return new MySqlKinghostSessaoDAO($daofactory);
		} else {
			return new MySqlSessaoDAO($daofactory);
		}
	}

	/**
	 * Retorna uma instância de acesso a dados de usuários
	 * @return MySqlProjetoDAO
	 */
	public function getProjetoDAO($daofactory) 
	{
		$gs = GlobalStartup::getInstance();
		if($gs->ambiente == 'producao') {
			return new MySqlKinghostProjetoDAO($daofactory);
		} else {
			return new MySqlProjetoDAO($daofactory);
		}
	}

	/**
	 * Retorna uma instância de acesso a dados de usuários
	 * @return MySqlProjetoBonusDAO
	 */
	public function getProjetoBonusDAO($daofactory) 
	{
		$gs = GlobalStartup::getInstance();
		if($gs->ambiente == 'producao') {
			return new MySqlKinghostProjetoBonusDAO($daofactory);
		} else {
			return new MySqlProjetoBonusDAO($daofactory);
		}
	}

	/**
	 * Retorna uma instância de acesso a dados de usuários
	 * @return MySqlProjetoItensDAO
	 */
	public function getProjetoItensDAO($daofactory) 
	{
		$gs = GlobalStartup::getInstance();
		if($gs->ambiente == 'producao') {
			return new MySqlKinghostProjetoItensDAO($daofactory);
		} else {
			return new MySqlProjetoItensDAO($daofactory);
		}
	}

	/**
	 * Retorna uma instância de acesso a dados de usuários
	 * @return MySqlProjetoDorDAO
	 */
	public function getProjetoDoresDAO($daofactory) 
	{
		$gs = GlobalStartup::getInstance();
		if($gs->ambiente == 'producao') {
			return new MySqlKinghostProjetoDorDAO($daofactory);
		} else {
			return new MySqlProjetoDorDAO($daofactory);
		}
	}

	/**
	 * Retorna uma instância de acesso a dados de usuários
	 * @return MySqlProjetoBeneficioDAO
	 */
	public function getProjetoBeneficiosDAO($daofactory) 
	{
		$gs = GlobalStartup::getInstance();
		if($gs->ambiente == 'producao') {
			return new MySqlKinghostProjetoBeneficioDAO($daofactory);
		} else {
			return new MySqlProjetoBeneficioDAO($daofactory);
		}
	}

	/**
	 * Retorna uma instância de acesso a dados de usuários
	 * @return MySqlProjetoTecnicaDAO
	 */
	public function getProjetoTecnicasDAO($daofactory) 
	{
		$gs = GlobalStartup::getInstance();
		if($gs->ambiente == 'producao') {
			return new MySqlKinghostProjetoTecnicaDAO($daofactory);
		} else {
			return new MySqlProjetoTecnicaDAO($daofactory);
		}
	}

	/**
	 * Retorna uma instância de acesso a dados de usuários
	 * @return MySqlHeadlineHistoricoDAO
	 */
	public function getHeadlineHistoricoDAO($daofactory) 
	{
		$gs = GlobalStartup::getInstance();
		if($gs->ambiente == 'producao') {
			return new MySqlKinghostHeadlineHistoricoDAO($daofactory);
		} else {
			return new MySqlHeadlineHistoricoDAO($daofactory);
		}
	}

	/**
	 * Retorna uma instância de acesso a dados de usuários
	 * @return MySqlEstatisticaFuncaoDAO
	 */
	public function getEstatisticaFuncaoDAO($daofactory) 
	{
		$gs = GlobalStartup::getInstance();
		if($gs->ambiente == 'producao') {
			return new MySqlKinghostEstatisticaFuncaoDAO($daofactory);
		} else {
			return new MySqlEstatisticaFuncaoDAO($daofactory);
		}
	}

	/**
	 * Retorna uma instância de acesso a dados de usuários
	 * @return MySqlMensagemDAO
	 */
	public function getMensagemDAO($daofactory)
	{
		$gs = GlobalStartup::getInstance();
		if($gs->ambiente == 'producao') {
			return new MySqlKinghostMensagemDAO($daofactory);
		} else {
			return new MySqlMensagemDAO($daofactory);
		}
	}

	/**
	 * Retorna uma instância de acesso a dados de usuários
	 * @return MySqlVariavelDAO
	 */
	public function getVariavelDAO($daofactory)
	{
		$gs = GlobalStartup::getInstance();
		if($gs->ambiente == 'producao') {
			return new MySqlKinghostVariavelDAO($daofactory);
		} else {
			return new MySqlVariavelDAO($daofactory);
		}

	}

}
?>
