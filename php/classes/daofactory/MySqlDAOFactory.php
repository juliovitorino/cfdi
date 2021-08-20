<?php

/**
 * MySqlDAOFactory - Fabrica de Objetos DAO para MySql
 *
 * @author Julio Vitorino
 * @since 25/07/2018
 */

require_once '../funcoesadministrativas/MySqlKinghostFuncoesAdministrativasDAO.php';
require_once '../grupoadministracao/MySqlKinghostGrupoAdministracaoDAO.php';
require_once '../grupoadminfuncoesadmin/MySqlKinghostGrupoAdminFuncoesAdminDAO.php';
require_once '../grupoadminfuncoesadminusuario/MySqlKinghostGrupoAdminFuncoesAdminUsuarioDAO.php';

require_once '../mkdlista/MySqlKinghostMkdListaDAO.php';
require_once '../filaqrcodependenteproduzir/MySqlKinghostFilaQRCodePendenteProduzirDAO.php';
require_once '../usuarioversao/MySqlKinghostUsuarioVersaoDAO.php';
require_once '../filapublicidade/MySqlKinghostFilaPublicidadeDAO.php';
require_once '../campanhatopdez/MySqlKinghostCampanhaTopDezDAO.php';
require_once '../cartaopedido/MySqlKinghostCartaoPedidoDAO.php';
require_once '../usuarios/MySqlKinghostUsuarioDAO.php';
require_once '../variavel/MySqlKinghostVariavelDAO.php';
require_once '../mensagem/MySqlKinghostMensagemDAO.php';
require_once '../estatisticafuncao/MySqlKinghostEstatisticaFuncaoDAO.php';
require_once '../sessao/MySqlKinghostSessaoDAO.php';
require_once '../plano/MySqlKinghostPlanoDAO.php';
require_once '../usuariosplanos/MySqlKinghostPlanoUsuarioDAO.php';
require_once '../usuariosplanosfatura/MySqlKinghostPlanoUsuarioFaturaDAO.php';
require_once '../usuariostrocasenha/MySqlKinghostUsuarioTrocaSenhaHistoricoDAO.php';
require_once '../campanha/MySqlKinghostCampanhaDAO.php';
require_once '../campanhaqrcode/MySqlKinghostCampanhaQrCodeDAO.php';
require_once '../cfdi/MySqlKinghostCfdiDAO.php';
require_once '../cartao/MySqlKinghostCartaoDAO.php';
require_once '../trace/MySqlKinghostTraceDAO.php';
require_once '../tipoempreendimento/MySqlKinghostTipoEmpreendimentoDAO.php';
require_once '../endereco/MySqlKinghostUfDAO.php';
require_once '../endereco/MySqlKinghostCidadeDAO.php';
require_once '../campanhacashback/MySqlKinghostCampanhaCashbackDAO.php';
require_once '../campanhacashbackcc/MySqlKinghostCampanhaCashbackCCDAO.php';
require_once '../usuariocomplemento/MySqlKinghostUsuarioComplementoDAO.php';
require_once '../usuariopublicidade/MySqlKinghostUsuarioPublicidadeDAO.php';
require_once '../usuarionotificacao/MySqlKinghostUsuarioNotificacaoDAO.php';
require_once '../selocuringa/MySqlKinghostSeloCuringaDAO.php';
require_once '../usuariocashback/MySqlKinghostUsuarioCashbackDAO.php';
require_once '../usuarioautorizador/MySqlKinghostUsuarioAutorizadorDAO.php';
require_once '../usuarioavaliacao/MySqlKinghostUsuarioAvaliacaoDAO.php';
require_once '../versao/MySqlKinghostVersaoDAO.php';
require_once '../campanhasorteio/MySqlKinghostCampanhaSorteioDAO.php';
require_once '../campanhasorteiofilacriacao/MySqlKinghostCampanhaSorteioFilaCriacaoDAO.php';
require_once '../campanhasorteionumerospermitidos/MySqlKinghostCampanhaSorteioNumerosPermitidosDAO.php';
require_once '../usuariocampanhasorteio/MySqlKinghostUsuarioCampanhaSorteioDAO.php';
require_once '../usuariocampanhasorteioticket/MySqlKinghostUsuarioCampanhaSorteioTicketDAO.php';
require_once '../registroindicacao/MySqlKinghostRegistroIndicacaoDAO.php';
require_once '../cartaomoverhistorico/MySqlKinghostCartaoMoverHistoricoDAO.php';
require_once '../campanhacashbackresgatepix/MySqlKinghostCampanhaCashbackResgatePixDAO.php';
require_once '../fundoparticipacaoglobal/MySqlKinghostFundoParticipacaoGlobalDAO.php';


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
	 * Retorna uma instância de acesso a dados
	* @return MySqlKinghostFuncoesAdministrativasDAO
	*/
	public function getFuncoesAdministrativasDAO($daofactory)
	{
		return new MySqlKinghostFuncoesAdministrativasDAO($daofactory);
	}
  
	/**
	* Retorna uma instância de acesso a dados
	* @return MySqlKinghostGrupoAdministracaoDAO
	*/
	public function getGrupoAdministracaoDAO($daofactory)
	{
	return new MySqlKinghostGrupoAdministracaoDAO($daofactory);
	}

	/**
     * Retorna uma instância de acesso a dados
     * @return MySqlKinghostGrupoAdminFuncoesAdminDAO
     */
    public function getGrupoAdminFuncoesAdminDAO($daofactory)
    {
        return new MySqlKinghostGrupoAdminFuncoesAdminDAO($daofactory);
    }

    /**
     * Retorna uma instância de acesso a dados
     * @return MySqlKinghostGrupoAdminFuncoesAdminUsuarioDAO
     */
    public function getGrupoAdminFuncoesAdminUsuarioDAO($daofactory)
    {
        return new MySqlKinghostGrupoAdminFuncoesAdminUsuarioDAO($daofactory);
    }

	/**
	 * Retorna uma instância de acesso a dados
	* @return MySqlUsuarioDAO
	*/
	public function getUsuarioDAO($daofactory) 
	{
	return new MySqlKinghostUsuarioDAO($daofactory);
	}

	/**
	 * Retorna uma instância de acesso a dados
	* @return MySqlSessaoDAO
	*/
	public function getSessaoDAO($daofactory) 
	{
	return new MySqlKinghostSessaoDAO($daofactory);
	}

	/**
	 * Retorna uma instância de acesso a dados
	* @return MySqlEstatisticaFuncaoDAO
	*/
	public function getEstatisticaFuncaoDAO($daofactory) 
	{
	return new MySqlKinghostEstatisticaFuncaoDAO($daofactory);
	}

	/**
	 * Retorna uma instância de acesso a dados
	* @return MySqlMensagemDAO
	*/
	public function getMensagemDAO($daofactory)
	{
	return new MySqlKinghostMensagemDAO($daofactory);
	}

	/**
	 * Retorna uma instância de acesso a dados
	* @return MySqlVariavelDAO
	*/
	public function getVariavelDAO($daofactory)
	{
	return new MySqlKinghostVariavelDAO($daofactory);

	}

	/**
	 * Retorna uma instância de acesso a dados
	* @return MySqlKinghostPlanoDAO
	*/
	public function getPlanoDAO($daofactory)
	{
	return new MySqlKinghostPlanoDAO($daofactory);

	}

	/**
	 * Retorna uma instância de acesso a dados
	* @return MySqlKinghostPlanoUsuarioDAO
	*/
	public function getPlanoUsuarioDAO($daofactory)
	{
	return new MySqlKinghostPlanoUsuarioDAO($daofactory);

	}

	/**
	 * Retorna uma instância de acesso a dados
	* @return MySqlKinghostPlanoUsuarioFaturaDAO
	*/
	public function getPlanoUsuarioFaturaDAO($daofactory)
	{
	return new MySqlKinghostPlanoUsuarioFaturaDAO($daofactory);
	}

	/**
	 * Retorna uma instância de acesso a dados
	* @return MySqlKinghostUsuarioTrocaSenhaHistoricoDAO
	*/
	public function getUsuarioTrocaSenhaHistoricoDAO($daofactory)
	{
	return new MySqlKinghostUsuarioTrocaSenhaHistoricoDAO($daofactory);
	}

	/**
	 * Retorna uma instância de acesso a dados
	* @return MySqlKinghostCampanhaDAO
	*/
	public function getCampanhaDAO($daofactory)
	{
	return new MySqlKinghostCampanhaDAO($daofactory);
	}

	/**
	 * Retorna uma instância de acesso a dados
	* @return MySqlKinghostCampanhaQrCodeDAO
	*/
	public function getCampanhaQrCodeDAO($daofactory)
	{
	return new MySqlKinghostCampanhaQrCodeDAO($daofactory);
	}

	/**
	 * Retorna uma instância de acesso a dados
	* @return MySqlKinghostCfdiDAO
	*/
	public function getCfdiDAO($daofactory)
	{
	return new MySqlKinghostCfdiDAO($daofactory);
	}

	/**
	 * Retorna uma instância de acesso a dados
	* @return MySqlKinghostCartaoDAO
	*/
	public function getCartaoDAO($daofactory)
	{
	return new MySqlKinghostCartaoDAO($daofactory);
	}

	/**
	 * Retorna uma instância de acesso a dados
	* @return MySqlKinghostTraceDAO
	*/
	public function getTraceDAO($daofactory)
	{
	return new MySqlKinghostTraceDAO($daofactory);
	}

	/**
	 * Retorna uma instância de acesso a dados
	* @return MySqlKinghostTipoEmpreendimentoDAO
	*/
	public function getTipoEmpreendimentoDAO($daofactory)
	{
	return new MySqlKinghostTipoEmpreendimentoDAO($daofactory);
	}
	
	/**
	 * Retorna uma instância de acesso a dados
	* @return MySqlKinghostUsuarioTipoEmpreendimentoDAO
	*/
	public function getUsuarioTipoEmpreendimentoDAO($daofactory)
	{
	return new MySqlKinghostUsuarioTipoEmpreendimentoDAO($daofactory);
	}
	/**
	 * Retorna uma instância de acesso a dados
	 * @return MySqlKinghostUfDAO
	 */
	public function getUfDAO($daofactory)
	{
	return new MySqlKinghostUfDAO($daofactory);
	}

	/**
	 * Retorna uma instância de acesso a dados
	 * @return MySqlKinghostCidadeDAO
	 */
	public function getCidadeDAO($daofactory)
	{
	return new MySqlKinghostCidadeDAO($daofactory);
	}

	/**
	 * Retorna uma instância de acesso a dados
	 * @return MySqlKinghostCampanhaCashbackDAO
	 */
	public function getCampanhaCashbackDAO($daofactory)
	{
	return new MySqlKinghostCampanhaCashbackDAO($daofactory);
	}

	/**
	 * Retorna uma instância de acesso a dados
	 * @return MySqlKinghostCampanhaCashbackCCDAO
	 */
	public function getCampanhaCashbackCCDAO($daofactory)
	{
	return new MySqlKinghostCampanhaCashbackCCDAO($daofactory);
	}
		
	/**
	 * Retorna uma instância de acesso a dados
	 * @return MySqlKinghostUsuarioComplementoDAO
	 */
	public function getUsuarioComplementoDAO($daofactory)
	{
	return new MySqlKinghostUsuarioComplementoDAO($daofactory);
	}

	/**
	 * Retorna uma instância de acesso a dados
	 * @return MySqlKinghostUsuarioPublicidadeDAO
	 */
	public function getUsuarioPublicidadeDAO($daofactory)
	{
		return new MySqlKinghostUsuarioPublicidadeDAO($daofactory);
	}

	/**
	 * Retorna uma instância de acesso a dados
	* @return MySqlKinghostUsuarioNotificacaoDAO
	*/
	public function getUsuarioNotificacaoDAO($daofactory)
	{
		return new MySqlKinghostUsuarioNotificacaoDAO($daofactory);
	}
   
	/**
	 * Retorna uma instância de acesso a dados
	* @return MySqlKinghostSeloCuringaDAO
	*/
	public function getSeloCuringaDAO($daofactory)
	{
		return new MySqlKinghostSeloCuringaDAO($daofactory);
	}
	/**
	* Retorna uma instância de acesso a dados
	* @return MySqlKinghostUsuarioCashbackDAO
	*/
	public function getUsuarioCashbackDAO($daofactory)
	{
		return new MySqlKinghostUsuarioCashbackDAO($daofactory);
	}
	
	/**
	* Retorna uma instância de acesso a dados
	* @return MySqlKinghostUsuarioAutorizadorDAO
	*/
	public function getUsuarioAutorizadorDAO($daofactory)
	{
		return new MySqlKinghostUsuarioAutorizadorDAO($daofactory);
	}

	/**
	 * Retorna uma instância de acesso a dados
	 * @return MySqlKinghostUsuarioAvaliacaoDAO
	 */
	public function getUsuarioAvaliacaoDAO($daofactory)
	{
		return new MySqlKinghostUsuarioAvaliacaoDAO($daofactory);
	}

	/**
	 * Retorna uma instância de acesso a dados
	 * @return MySqlKinghostCartaoPedidoDAO
	 */
	public function getCartaoPedidoDAO($daofactory)
	{
		return new MySqlKinghostCartaoPedidoDAO($daofactory);
	}

	/**
	 * Retorna uma instância de acesso a dados
	 * @return MySqlKinghostFilaPublicidadeDAO
	 */
	public function getFilaPublicidadeDAO($daofactory)
	{
		return new MySqlKinghostFilaPublicidadeDAO($daofactory);
	}

	/**
	 * Retorna uma instância de acesso a dados
	 * @return MySqlKinghostCampanhaTopDezDAO
	 */
	public function getCampanhaTopDezDAO($daofactory)
	{
		return new MySqlKinghostCampanhaTopDezDAO($daofactory);
	}

    /**
     * Retorna uma instância de acesso a dados
     * @return MySqlKinghostVersaoDAO
     */
    public function getVersaoDAO($daofactory)
    {
        return new MySqlKinghostVersaoDAO($daofactory);
	}
	
    /**
	* Retorna uma instância de acesso a dados
	* @return MySqlKinghostUsuarioVersaoDAO
	*/
	public function getUsuarioVersaoDAO($daofactory)
	{
		return new MySqlKinghostUsuarioVersaoDAO($daofactory);
	}
	
	/**
	* Retorna uma instância de acesso a dados
	* @return MySqlKinghostFilaQRCodePendenteProduzirDAO
	*/
	public function getFilaQRCodePendenteProduzirDAO($daofactory)
	{
		return new MySqlKinghostFilaQRCodePendenteProduzirDAO($daofactory);
	}

	/**
	* Retorna uma instância de acesso a dados
	* @return MySqlKinghostMkdListaDAO
	*/
	public function getMkdListaDAO($daofactory)
	{
		return new MySqlKinghostMkdListaDAO($daofactory);
	}
	
	/**
	* Retorna uma instância de acesso a dados
	* @return MySqlKinghostCampanhaSorteioDAO
	*/
	public function getCampanhaSorteioDAO($daofactory)
	{
		return new MySqlKinghostCampanhaSorteioDAO($daofactory);
	}
	 
    /**
     * Retorna uma instância de acesso a dados
     * @return MySqlKinghostCampanhaSorteioFilaCriacaoDAO
     */
    public function getCampanhaSorteioFilaCriacaoDAO($daofactory)
    {
        return new MySqlKinghostCampanhaSorteioFilaCriacaoDAO($daofactory);
    }
	
    /**
     * Retorna uma instância de acesso a dados
     * @return MySqlKinghostCampanhaSorteioNumerosPermitidosDAO
     */
    public function getCampanhaSorteioNumerosPermitidosDAO($daofactory)
    {
        return new MySqlKinghostCampanhaSorteioNumerosPermitidosDAO($daofactory);
    }

    /**
     * Retorna uma instância de acesso a dados
     * @return MySqlKinghostUsuarioCampanhaSorteioDAO
     */
    public function getUsuarioCampanhaSorteioDAO($daofactory)
    {
        return new MySqlKinghostUsuarioCampanhaSorteioDAO($daofactory);
    }

    /**
     * Retorna uma instância de acesso a dados
     * @return MySqlKinghostUsuarioCampanhaSorteioTicketDAO
     */
    public function getUsuarioCampanhaSorteioTicketDAO($daofactory)
    {
        return new MySqlKinghostUsuarioCampanhaSorteioTicketDAO($daofactory);
    }

    /**
     * Retorna uma instância de acesso a dados
     * @return MySqlKinghostRegistroIndicacaoDAO
     */
    public function getRegistroIndicacaoDAO($daofactory)
    {
        return new MySqlKinghostRegistroIndicacaoDAO($daofactory);
    }

    /**
     * Retorna uma instância de acesso a dados
     * @return MySqlKinghostCartaoMoverHistoricoDAO
     */
    public function getCartaoMoverHistoricoDAO($daofactory)
    {
        return new MySqlKinghostCartaoMoverHistoricoDAO($daofactory);
    }

    /**
     * Retorna uma instância de acesso a dados
     * @return MySqlKinghostCampanhaCashbackResgatePixDAO
     */
    public function getCampanhaCashbackResgatePixDAO($daofactory)
    {
        return new MySqlKinghostCampanhaCashbackResgatePixDAO($daofactory);
    }

	/**
 	 * Retorna uma instância de acesso a dados
 	 * @return MySqlKinghostFundoParticipacaoGlobalDAO
 	 */
    public function getFundoParticipacaoGlobalDAO($daofactory)
    {
        return new MySqlKinghostFundoParticipacaoGlobalDAO($daofactory);
    }
	 
	 
	 
}
?>
