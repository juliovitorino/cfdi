<?php  

/**
 * ConstantesVariavel
 */
class ConstantesVariavel
{
	const TIPO_NOTIFICACAO_GERAL = "00";
	const TIPO_NOTIFICACAO_CONTA_CASHBACK_CC = "01";
	const TIPO_NOTIFICACAO_JSON_PATROCINADOR = "02";

	const TAMANHO_CHAVE = 4096;
	const PAGINA_INICIAL = 1;
	const ATIVADO = 'ON';
	const ARQUIVO_SEM_IMAGEM = 'sem-imagem.jpeg';

	const TRACE_FATAL = 'FATAL';
	const TRACE_DEBUG = 'DEBUG';
	const TRACE_ERRO = 'ERRO';
	const TRACE_INFO = 'INFO';

	const P1 = '*=p1=*';
	const P2 = '*=p2=*';
	const P3 = '*=p3=*';
	const P4 = '*=p4=*';
	const P5 = '*=p5=*';
	const P6 = '*=p6=*';
	const P7 = '*=p7=*';
	const P8 = '*=p8=*';
	const P9 = '*=p9=*';
	const P10 = '*=p10=*';

	const SIM = 'S';
	const NAO = 'N';

	const CREDITO = 'C';
	const DEBITO = 'D';
	const SALDO = 'S';

	const PLANO_GRATIS_SIM = '1';
	const PLANO_GRATIS_NAO = '0';

	const AUTORIZADOR_TEMPORARIO = 'T';
	const AUTORIZADOR_PERMANENTE = 'P';

	const CONTA_USUARIO_ADMIN = 'A';
	const CONTA_USUARIO_PARCEIRO = 'P';
	const CONTA_USUARIO_COMUM = 'C';

	// maquinas de estado sequenciais
	const STATUS_VALIDAR_COMPLETOU = '0';
	const STATUS_VALIDAR_RESGATOU = "1";
	const STATUS_VALIDAR_ENTREGOU = "2";
	const STATUS_VALIDAR_RECEBEU = "3";
	const STATUS_AGUARDANDO_ARQUIVAMENTO = "4";
	const STATUS_VALIDAR_COMPLETOU_DESC = "completo";
	const STATUS_VALIDAR_RESGATOU_DESC = "resgate valido";
	const STATUS_VALIDAR_ENTREGOU_DESC = 'entregue';
	const STATUS_VALIDAR_RECEBEU_DESC = 'recebido';
	const STATUS_AGUARDANDO_ARQUIVAMENTO_DESC = "aguardando arquivamento";

	// maquinas de estado
	const STATUS_ATIVO = "A";
	const STATUS_BLOQUEADO = "B";
	const STATUS_DESABILITADO = "C";
	const STATUS_PRONTO_USAR = "D";
	const STATUS_ENVIADO = "E";
	const STATUS_FILA = 'F';
	const STATUS_PURGE = 'G';
	const STATUS_INATIVO = "I";
	const STATUS_LIQUIDADO = "L";
	const STATUS_MANUTENCAO = "M";
	const STATUS_NEGADO = "N";
	const STATUS_PENDENTE = "P";
	const STATUS_REALIZADO = 'R';
	const STATUS_PERMITIDO = "S";
	const STATUS_FINALIZADO = "T";
	const STATUS_APROVADO = "V";
	const STATUS_TRABALHANDO = "W";
	const STATUS_PAUSADO = "U";
	const STATUS_REPORTAR_BUG = 'Z';

	const STATUS_MANUTENCAO_DESC = "manuten????o";
	const STATUS_PRONTO_USAR_DESC = "pronto pra usar";
	const STATUS_ATIVO_DESC = "ativo";
	const STATUS_APROVADO_DESC = "aprovado";
	const STATUS_INATIVO_DESC = "inativo";
	const STATUS_TRABALHANDO_DESC = "executando";
	const STATUS_FINALIZADO_DESC = "finalizado";
	const STATUS_PURGE_DESC = 'aguardando eliminador';
	const STATUS_ENVIADO_DESC = "enviado";
	const STATUS_PENDENTE_DESC = "pendente";
	const STATUS_BLOQUEADO_DESC = "bloqueado";
	const STATUS_LIQUIDADO_DESC = "liquidado";
	const STATUS_NEGADO_DESC = "negado";
	const STATUS_PERMITIDO_DESC = "permitido";
	const STATUS_REALIZADO_DESC = 'realizado';
	const STATUS_FILA_DESC = 'fila';
	const STATUS_REPORTAR_BUG_DESC = 'bug';
	const STATUS_COMPLETO_DESC = 'completo';
	const STATUS_DESABILITADO_DESC = 'desabilitado';
	const STATUS_PAUSADO_DESC = "Pausado";

	const CANIVETE_VERSAO = 'CANIVETE_VERSAO';
	const CANIVETE_COPY = 'CANIVETE_COPY';
	const EMAIL_ADMIN_SMTP = 'EMAIL_ADMIN_SMTP';
	const EMAIL_SMTP_PASSWD = 'EMAIL_SMTP_PASSWD';
	const EMAIL_SMTP_HOST = 'EMAIL_SMTP_HOST';
	const EMAIL_SMTP_PORT = 'EMAIL_SMTP_PORT';
	const EMAIL_CHAVE_ATIVACAO_DEBUG = 'EMAIL_CHAVE_ATIVACAO_DEBUG';
	const EMAIL_CHAVE_ATIVACAO_AUTENTICACAO = 'EMAIL_CHAVE_ATIVACAO_AUTENTICACAO';
	const EMAIL_CONTATO_PADRAO_SMTP = 'EMAIL_CONTATO_PADRAO_SMTP';
	const EMAIL_NOME_CONTATO_PADRAO_SMTP = 'EMAIL_NOME_CONTATO_PADRAO_SMTP';
	const PATH_RELATIVO_TEMPLATES_EMAIL = 'PATH_RELATIVO_TEMPLATES_EMAIL';
	const LINK_ATIVACAO_NOVO_CLIENTE = 'LINK_ATIVACAO_NOVO_CLIENTE';
	const EMAIL_CHAVE_ATIVACAO_LIGADO = 'EMAIL_CHAVE_ATIVACAO_LIGADO';
	const EMAIL_TITULO_PADRAO_NOVA_CONTA = 'EMAIL_TITULO_PADRAO_NOVA_CONTA';
	const EMAIL_CHAVE_USUARIO_FAKE = 'EMAIL_CHAVE_USUARIO_FAKE';
	const EMAIL_VALIDO_FAKE_TESTE = 'EMAIL_VALIDO_FAKE_TESTE';
	const EMAIL_NOME_VALIDO_FAKE_TESTE = 'EMAIL_NOME_VALIDO_FAKE_TESTE';
	const PLANO_GRATUITO_CODIGO = 'PLANO_GRATUITO_CODIGO';
	const DEBUGGER_CHAVE_ATIVACAO = 'DEBUGGER_CHAVE_ATIVACAO';
	const DEBUGGER_NIVEL_DEBUG = 'DEBUGGER_NIVEL_DEBUG';
	const LINK_TROCA_SENHA = 'LINK_TROCA_SENHA';
	const HOME_URL_HTML_CANIVETE = 'HOME_URL_HTML_CANIVETE';
	const HOME_URL_CANIVETE_PRODUCAO = 'HOME_URL_CANIVETE_PRODUCAO';
	const HOME_URL_CANIVETE_DESENV = 'HOME_URL_CANIVETE_DESENV';
	const HOME_URL_CANIVETE_HOMOLOGACAO = 'HOME_URL_CANIVETE_HOMOLOGACAO';
	const MAX_BACKLINK_PERMITIDO_BUSCA = 'MAX_BACKLINK_PERMITIDO_BUSCA';
	const PATH_RELATIVO_LOADER_KWD_RELATED = 'PATH_RELATIVO_LOADER_KWD_RELATED';
	const MAXIMO_QRCODE_CARIMBO_POR_CARTAO = 'MAXIMO_QRCODE_CARIMBO_POR_CARTAO';
	const TRACE_ON = 'TRACE_ON';
	const TRACE_LEVEL = 'TRACE_LEVEL';
	const SYSINFO_APP = 'SYSINFO_APP';
	const SYSINFO_APP_DESC = 'SYSINFO_APP_DESC';
	const SYSINFO_APP_VERSAO = 'SYSINFO_APP_VERSAO';
	const SYSINFO_APP_VERSAO_BACKEND = 'SYSINFO_APP_VERSAO_BACKEND';
	const SYSINFO_APP_VERSAO_FRONTEND = 'SYSINFO_APP_VERSAO_FRONTEND';
	const SYSINFO_APP_COPY = 'SYSINFO_APP_COPY';
	const SYSINFO_APP_DEV = 'SYSINFO_APP_DEV';
	const SYSINFO_APP_EMAILDEV = 'SYSINFO_APP_EMAILDEV';
	const MAXIMO_CARTOES_DEFAULT_LINKER = 'MAXIMO_CARTOES_DEFAULT_LINKER';
	const MAXIMO_DELAY_DEFAULT_LINKER = 'MAXIMO_DELAY_DEFAULT_LINKER';
	const CHAVE_INTERROMPER_CRIAR_CAMPANHA_PLANO_GRATUITO = 'CHAVE_INTERROMPER_CRIAR_CAMPANHA_PLANO_GRATUITO';
	const URL_IMG_CAMPANHA = 'URL_IMG_CAMPANHA';
	const URL_IMG_RECOMPENSA = 'URL_IMG_RECOMPENSA';
	const URL_IMG_SEM_CAMPANHA= 'URL_IMG_SEM_CAMPANHA';
	const HOME_REPOSITORIO_USUARIO = 'HOME_REPOSITORIO_USUARIO';
	const HOME_UPLOAD_TRANSICAO = 'HOME_UPLOAD_TRANSICAO';
	const AMBIENTE_ATIVO = 'AMBIENTE_ATIVO';
	const AMBIENTE_PRD = 'PRD';
	const AMBIENTE_DSV = 'DSV';
	const AMBIENTE_HMG = 'HMG';
	const URL_PRD_CONTROLADOR = 'URL_PRD_CONTROLADOR';
	const URL_DSV_CONTROLADOR = 'URL_DSV_CONTROLADOR';
	const URL_HMG_CONTROLADOR = 'URL_HMG_CONTROLADOR';
	const MAXIMO_COMENTARIOS_LISTAR = 'MAXIMO_COMENTARIOS_LISTAR';
	const MAXIMO_LINHAS_POR_PAGINA_DEFAULT = 'MAXIMO_LINHAS_POR_PAGINA_DEFAULT';
	const CHAVE_PROGRAMA_DE_PONTOS = 'CHAVE_PROGRAMA_DE_PONTOS';
	const CHAVE_PROGRAMA_CASHBACK = 'CHAVE_PROGRAMA_CASHBACK';
	const CHAVE_GERAL_SORTEIO = 'CHAVE_GERAL_SORTEIO';
	const CHAVE_GERAL_PUBLICIDADE = 'CHAVE_GERAL_PUBLICIDADE';
	const FATOR_RESGATE_PADRAO = 'FATOR_RESGATE_PADRAO';
	const USUARIO_CASHBASCK_PADRAO_RESGATE = 'USUARIO_CASHBASCK_PADRAO_RESGATE';
	const USUARIO_CASHBASCK_PADRAO_PERCENTUAL = 'USUARIO_CASHBASCK_PADRAO_PERCENTUAL';
	const USUARIO_CASHBASCK_PADRAO_OBS = 'USUARIO_CASHBASCK_PADRAO_OBS';
	const URL_REPOSITORIO_USUARIO = 'URL_REPOSITORIO_USUARIO';
	const NOTIFICACAO_ADMIN_USUA_ID = 'NOTIFICACAO_ADMIN_USUA_ID';
	const CHAVE_NOTIFICACAO_ADMIN_NOVO_USUARIO = 'CHAVE_NOTIFICACAO_ADMIN_NOVO_USUARIO';
	const CRIAR_CARTAO_CARIMBO_LOTE_MAXIMO = 'CRIAR_CARTAO_CARIMBO_LOTE_MAXIMO';
	const LINK_ATIVACAO_MKD_LISTA = 'LINK_ATIVACAO_MKD_LISTA';
	const EMAIL_TITULO_CONFIRMAR_NOVO_LEAD = 'EMAIL_TITULO_CONFIRMAR_NOVO_LEAD';
	const FATOR_DIVISAO_TICKETS_EM_LOTES = 'FATOR_DIVISAO_TICKETS_EM_LOTES';
	const CHAVE_PERMITIR_CAMPANHA_SORTEIO_J10_PARALELA = 'CHAVE_PERMITIR_CAMPANHA_SORTEIO_J10_PARALELA';
	const CODIGO_CAMPANHA_SORTEIO_J10_PARALELA = 'CODIGO_CAMPANHA_SORTEIO_J10_PARALELA';
	const CHAVE_GERAL_INDICACAO_PERMITE_CAMPANHA_SORTEIO = 'CHAVE_GERAL_INDICACAO_PERMITE_CAMPANHA_SORTEIO';
	const CODIGO_CAMPANHA_SORTEIO_ATIVO_INDICACAO = 'CODIGO_CAMPANHA_SORTEIO_ATIVO_INDICACAO';
	const CHAVE_GERAL_CAMPANHA_CASHBACK_ATIVO_INDICACAO = 'CHAVE_GERAL_CAMPANHA_CASHBACK_ATIVO_INDICACAO';
	const CODIGO_CAMPANHA_CASHBACK_ATIVO_INDICACAO = 'CODIGO_CAMPANHA_CASHBACK_ATIVO_INDICACAO';
	const VALOR_CAMPANHA_CASHBACK_ATIVO_INDICACAO = 'VALOR_CAMPANHA_CASHBACK_ATIVO_INDICACAO';
	const CHAVE_PERMITIR_BONIFICACAO_J10 = 'CHAVE_PERMITIR_BONIFICACAO_J10';
	const VALOR_CASHBACK_CC_BONIFICACAO_J10 = 'VALOR_CASHBACK_CC_BONIFICACAO_J10';
	const CODIGO_CASHBACK_BONIFICACAO_J10 = 'CODIGO_CASHBACK_BONIFICACAO_J10';
	const CHAVE_GERAL_PERMITE_REMUNERAR_PROMOTOR = 'CHAVE_GERAL_PERMITE_REMUNERAR_PROMOTOR';
	const VALOR_REMUNERAR_PROMOTOR = 'VALOR_REMUNERAR_PROMOTOR';
	const USUA_ID_DEBITAR_REMUNERAR_PROMOTOR = 'USUA_ID_DEBITAR_REMUNERAR_PROMOTOR';
	const CHAVE_GERAL_PERMITE_NOVO_USUARIO = 'CHAVE_GERAL_PERMITE_REMUNERAR_NOVO_USUARIO';
	const VALOR_REMUNERAR_NOVO_USUARIO = 'VALOR_REMUNERAR_NOVO_USUARIO';
	const USUA_ID_DEBITAR_REMUNERAR_NOVO_USUARIO = 'USUA_ID_DEBITAR_REMUNERAR_NOVO_USUARIO';
	const CHAVE_GERAL_PERMITE_REMUNERAR_NOVO_USUARIO = 'CHAVE_GERAL_PERMITE_REMUNERAR_NOVO_USUARIO';
	const USUA_ID_DOMINADOR_SALDO_FPGL = 'USUA_ID_DOMINADOR_SALDO_FPGL';
	const CHAVE_GERAL_FUNDO_PARTICIPACAO_GLOBAL_FPGL = 'CHAVE_GERAL_FUNDO_PARTICIPACAO_GLOBAL_FPGL';
	const VALOR_FUNDO_PARTICIPACAO_GLOBAL_FPGL = 'VALOR_FUNDO_PARTICIPACAO_GLOBAL_FPGL';
	const CHAVE_GERAL_INCENTIVAR_DONO_CAMPANHA_CARIMBAR = 'CHAVE_GERAL_INCENTIVAR_DONO_CAMPANHA_CARIMBAR';
	const VALOR_INCENTIVAR_DONO_CAMPANHA_CARIMBAR = 'VALOR_INCENTIVAR_DONO_CAMPANHA_CARIMBAR';
	const VALOR_LIMITE_TETO_INCENTIVAR_DONO_CAMPANHA_CARIMBAR = 'VALOR_LIMITE_TETO_INCENTIVAR_DONO_CAMPANHA_CARIMBAR';
	const USUA_ID_DEBITO_INCENTIVAR_DONO_CAMPANHA_CARIMBAR = 'USUA_ID_DEBITO_INCENTIVAR_DONO_CAMPANHA_CARIMBAR';
	const EMAIL_SUPORTE_JUNTA10 = 'EMAIL_SUPORTE_JUNTA10';
	const EMAIL_SUPORTE_JUNTA10_SENHA = 'EMAIL_SUPORTE_JUNTA10_SENHA';

}

?>