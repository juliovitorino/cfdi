<?php  

// importar dependências
require_once 'PermissaoAnualConcrete.php';
require_once 'PermissaoDiariaConcrete.php';
require_once 'PermissaoMaximoConcrete.php';
require_once 'PermissaoMensalConcrete.php';
require_once 'PermissaoQuinzenalConcrete.php';
require_once 'PermissaoSemanalConcrete.php';
require_once 'PermissaoLivreConcrete.php';

/**
 * PermissaoFactory - Fabrica de resolução de permissoes com base na funcionalidade e o historico de uso
 *
 * @author Julio Vitorino
 * @copyright Julio Vitorino
 * @since 20/08/2018
 */
abstract class PermissaoFactory
{
	protected $daofactory;

	// Implementação obrigatória nas fábricas concretas
	public abstract function resolverPermissao($plusdto, $permissao);
	
	private function __construct()	{	}

	public static function getInstance($periodicidade, $daofactory)
	{
		switch ($periodicidade) {
			case ConstantesPlano::PERIODICIDADE_MAXIMA:
				return new PermissaoMaximoConcrete($daofactory);
			
			case ConstantesPlano::PERIODICIDADE_DIARIA:
				return new PermissaoDiariaConcrete($daofactory);
			
			case ConstantesPlano::PERIODICIDADE_SEMANAL:
				return new PermissaoSemanalConcrete($daofactory);
			
			case ConstantesPlano::PERIODICIDADE_QUINZENAL:
				return new PermissaoQuinzenalConcrete($daofactory);
			
			case ConstantesPlano::PERIODICIDADE_MENSAL:
				return new PermissaoMensalConcrete($daofactory);
			
			case ConstantesPlano::PERIODICIDADE_ANUAL:
				return new PermissaoAnualConcrete($daofactory);
			
			case ConstantesPlano::PERIODICIDADE_LIVRE:
				return new PermissaoLivreConcrete($daofactory);
			
			default:
				# code...
				break;
		}

	}
}

?>