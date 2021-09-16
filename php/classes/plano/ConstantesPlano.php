<?php  

// importar dependencias
require_once '../estatisticafuncao/ConstantesEstatisticaFuncao.php';

/**
 * ConstantesPlano
 */
class ConstantesPlano
{

	const MULTIPLO = 8;

	const STATUS_PERMITIDO = 'S';
	const STATUS_NAO_PERMITIDO = 'N';
	const STATUS_SEM_USO = 'I';

	const PERIODICIDADE_LIVRE = 'LI';
	const PERIODICIDADE_MAXIMA = 'MX'; // Deprecated
	const PERIODICIDADE_DIARIA = 'DD';
	const PERIODICIDADE_SEMANAL = 'SM';
	const PERIODICIDADE_QUINZENAL = 'QZ';
	const PERIODICIDADE_MENSAL = 'MM';
	const PERIODICIDADE_ANUAL = 'AA';

	// Posicao dentro do array lstpermissao
	// este posicionamento é diretamente relacionado com o campo do banco de dados TX_PERMISSAO
	// nas tabelas PLANO e PLANO_USUARIO
	const PERM_CRIAR_CAMPANHA = 0;
	const PERM_MAXIMO_CARTOES = 1;
	const PERM_CRIAR_PROMOCAO_PLANO = 2;
	const PERM_ADICIONAR_CARTOES_CAMPANHA = 3;
	const PERM_ADICIONAR_SORTEIO_CAMPANHA = 4;
	const PERM_ACESSO_FUNDO_PARTICIPACAO_GLOBAL = 5;
	const PERM_CAMPANHA_5_SELOS = 6;
	const PERM_CAMPANHA_10_SELOS = 7;
	const PERM_CAMPANHA_12_SELOS = 8;
	const PERM_CAMPANHA_15_SELOS = 9;
	const PERM_CAMPANHA_20_SELOS = 10;
	const PERM_AUTORIZACAO_TERCEIROS = 11;

	const lstfuncionalidade = 	[
		self::PERM_CRIAR_CAMPANHA => ConstantesEstatisticaFuncao::FUNCAO_CRIAR_CAMPANHA,
		self::PERM_MAXIMO_CARTOES => ConstantesEstatisticaFuncao::FUNCAO_MAXIMO_CARTOES,
		self::PERM_CRIAR_PROMOCAO_PLANO => ConstantesEstatisticaFuncao::FUNCAO_CRIAR_PROMOCAO_PLANO,
		self::PERM_ADICIONAR_CARTOES_CAMPANHA => ConstantesEstatisticaFuncao::FUNCAO_ADICIONAR_CARTOES_CAMPANHA,
		self::PERM_ADICIONAR_SORTEIO_CAMPANHA => ConstantesEstatisticaFuncao::PERM_ADICIONAR_SORTEIO_CAMPANHA,
		self::PERM_ACESSO_FUNDO_PARTICIPACAO_GLOBAL => ConstantesEstatisticaFuncao::PERM_ACESSO_FUNDO_PARTICIPACAO_GLOBAL,
		self::PERM_CAMPANHA_5_SELOS => ConstantesEstatisticaFuncao::PERM_CAMPANHA_5_SELOS,
		self::PERM_CAMPANHA_10_SELOS => ConstantesEstatisticaFuncao::PERM_CAMPANHA_10_SELOS,
		self::PERM_CAMPANHA_12_SELOS => ConstantesEstatisticaFuncao::PERM_CAMPANHA_12_SELOS,
		self::PERM_CAMPANHA_15_SELOS => ConstantesEstatisticaFuncao::PERM_CAMPANHA_15_SELOS,
		self::PERM_CAMPANHA_20_SELOS => ConstantesEstatisticaFuncao::PERM_CAMPANHA_20_SELOS,
		self::PERM_AUTORIZACAO_TERCEIROS => ConstantesEstatisticaFuncao::PERM_AUTORIZACAO_TERCEIROS,
	];

}
