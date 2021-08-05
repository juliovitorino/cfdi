<?php  

/**
 * ConstantesMensagem
 */
class ConstantesMensagem
{

	const COMANDO_REALIZADO_COM_SUCESSO = "MSG-0001";
	const ERRO_INESPERADO = "MSG-0002";
	const ERRO_AO_ENVIAR_EMAIL = "MSG-0003";
	const EMAIL_CHAVE_ATIVACAO_DESLIGADA = "MSG-0004";
	const ERRO_CADASTRAR_NOVA_CONTA = "MSG-0005";
	const CONTA_JA_ATIVADA = "MSG-0006";
	const ERRO_HABILITAR_CONTA_POR_EMAIL = 'MSG-0007';
	const INFORMACAO_NAO_LOCALIZADA = 'MSG-0008';
	const FATURA_JA_FOI_PROCESSADA = 'MSG-0009';
	const USUARIO_SENHA_INVALIDO = 'MSG-0010';
	const CONFIRMACAO_EMAIL_NOVA_CONTA_PENDENTE = 'MSG-0011';
	const EMAIL_EM_USO_POR_OUTRO_USUARIO = 'MSG-0012';
	const ERRO_AO_INSERIR_NOVA_CONTA = 'MSG-0013';
	const AUTORIZACAO_NEGADA = 'MSG-0014';
	const PERMISSAO_CONCEDIDA_FACTORY = 'MSG-0015';
	const PERMISSAO_NEGADA_MAX_PERMITIDO_EXCEDIDO = "MSG-0016";
	const PERMISSAO_NEGADA_POR_DIA_PERMITIDO_EXCEDIDO = "MSG-0017";
	const PERMISSAO_NEGADA_POR_MES_PERMITIDO_EXCEDIDO = "MSG-0018";
	const PERMISSAO_NEGADA_POR_ANO_PERMITIDO_EXCEDIDO = "MSG-0019";
	const EMAIL_INSTRUCAO_TROCA_SENHA_COM_SUCESSO = "MSG-0020";
	const ASSUNTO_TROCA_DE_SENNHA = "MSG-0021";
	const SENHAS_DIFERENTES = "MSG-0022";
	const TOKEN_INVALIDO = "MSG-0023";
	const STATUS_CONTA_USUARIO_COM_PROBLEMAS = "MSG-0024";
	const NAO_HA_MAIS_BACKLINKS_NO_FOLLOW_DISPONIVEIS = "MSG-0025";
	const ERRO_AO_ATUALIZAR_STATUS_USUARIO_BACKLINK = 'MSG-0026';
	const BACKLINK_FOI_MARCADO_COMO_REALIADO = 'MSG-0027';
	const BACKLINK_FOI_MARCADO_COMO_BUG = 'MSG-0028';
	const AUTENTICACAO_AUTORIZADA_FACEBOOK = 'MSG-0029';
	const USUARIO_FACEBOOK_DIFERENTE_CANIVETE = 'MSG-0030';
	const EMAIL_FACEBOOK_DIFERENTE_CANIVETE = 'MSG-0031';
	const NOVO_USUARIO_FACEBOOK_AUTENTICADO = 'MSG-0032';
	const CARIMBOS_CRIADOS_COM_SUCESSO = 'MSG-0033';
	const CAMPANHA_INEXISTENTE = 'MSG-0034';
	const CAMPANHA_JA_ESTA_ATIVA = 'MSG-0035';
	const TROCA_STATUS_INVALIDO_PENDENTE = 'MSG-0036';
	const TROCA_STATUS_INVALIDO_TRABALHANDO = 'MSG-0037';
	const TROCA_STATUS_INVALIDO_ATIVO = 'MSG-0038';
	const TROCA_STATUS_INVALIDO_NEGADA = 'MSG-0039';
	const REQUISICAO_SENDO_PROCESSADA = 'MSG-0040';
	const REQUISICAO_NAO_PODE_SER_PROCESSADA = 'MSG-0041';
	const TICKET_INVALIDO = 'MSG-0042';
	const ATUALIZAR_STATUS_CAMPANHA_QRCODES_FALHA ='MSG-0043';
	const TROCA_STATUS_INVALIDO_FILA = 'MSG-0044';
	const NAO_EXISTEM_CAMPANHAS_NA_FILA_PARA_PROCESSAR = 'MSG-0045';
	const SESSAO_INVALIDA_DO_USUARIO = 'MSG-0046';
	const CONTA_USUARIO_STATUS_INATIVO = 'MSG-0047';
	const CONTA_USUARIO_STATUS_BLOQUEADO = 'MSG-0048';
	const CARTAO_TOTALMENTE_COMPLETO = 'MSG-0049';
	const ERRO_AO_REGISTRAR_MANTER_NOVA_SESSAO = 'MSG-0050';
	const ERRO_AO_REGISTRAR_NOVA_SESSAO = 'MSG-0051';
	const ERRO_ATUALIZACAO_PROXIMO_QRCODE = 'MSG-0052';
	const CODIGO_DE_CAMPANHA_INVALIDO = 'MSG-0053';
	const ERRO_ACABOU_CARIMBO_CAMPANHA = 'MSG-0054';
	const ERRO_SEQUENCIAL_DE_CARIMBO_INVALIDO = 'MSG-0055';
	const ERRO_USUARIO_DIFERENTE_PATROCINADOR = 'MSG-0056';
	const CARTAO_JA_FOI_RESGATADO = 'MSG-0057';
	const CARTAO_AINDA_NAO_PODE_SER_RESGATADO = 'MSG-0058';
	const CARTAO_PARA_RESGATE_INVALIDO = 'MSG-0059';
	const ERRO_AO_ATUALIZAR_REGISTRO_DE_RESGATE = 'MSG-0060';
	const CARTAO_RESGATADO_COM_SUCESSO = 'MSG-0061';
	const USUARIO_INVALIDO_PARA_CARTAO = 'MSG-0062';
	const CAMPANHA_PERTENCE_OUTRO_PATROCINADOR = 'MSG-0063';
	const CARTAO_JA_FOI_VALIDADO = 'MSG-0064';
	const RECOMPENSA_FOI_ENTREGUE = 'MSG-0065';
	const RECOMPENSA_ENTREGUE_COM_SUCESSO = 'MSG-0066';
	const VOCE_CONFIRMOU_O_RECEBIMENTO_RECOMPENSA = 'MSG-0067';
	const RECOMPENSA_RECEBIDA_COM_SUCESSO = 'MSG-0068';
	const CARTAO_PERTENCE_OUTRO_USUARIO = 'MSG-0069';
	const CARTAO_ACABOU_DE_COMPLETAR = 'MSG-0070';
	const CARTAO_CARIMBADO_COM_SUCESSO = 'MSG-0071';
	const CARTAO_FALTA_APENAS_UM_CARIMBO = 'MSG-0072';
	const CAMPANHA_EXCLUIDA_COM_SUCESSO = 'MSG-0073';
	const CAMPANHA_ATIVA_NAO_PODE_SER_EXCLUIDA = 'MSG-0074';
	const CAMPANHA_AGUARDANDO_PURGE = 'MSG-0075';
	const CAMPANHA_INATIVADA = 'MSG-0076';
	const USUARIO_INVALIDO_PARA_CAMPANHA = 'MSG-0077';
	const USUARIO_NAO_ENCONTRADO = 'MSG-0078';
	const CAMPANHA_CANCELADA_COM_SUCESSO = 'MSG-0079';
	const CAMPANHA_NA_FILA_PARA_CRIACAO_CARIMBOS = 'MSG-0080';
	const CARTAO_INVALIDO = 'MSG-0081';
	const CARIMBO_NAO_REGISTRADO_NO_CARTAO = 'MSG-0082';
	const SISTEMA_ATUALIZACAO_CRITICA_NOVO_LOGIN = 'MSG-0083';
	const CAMPANHA_NAO_PERMITE_TROCA_DE_SELOS = 'MSG-0084';
	const ERRO_CRUD_ATUALIZAR_REGISTRO = 'MSG-0085';
	const ERRO_CRUD_INSERIR_REGISTRO = 'MSG-0086';
	const ERRO_CRUD_EXCLUIR_REGISTRO = 'MSG-0087';
	const ERRO_CRUD_RECUPERAR_REGISTRO = 'MSG-0088';
	const CAMPANHA_NAO_PERMITE_TROCA_NUMERO_CARTAO = 'MSG-0089';
	const CARTAO_CAMPANHA_JA_FOI_AVALIADO = 'MSG-0090';
	const STATUS_INVALIDO_AVALIAR_CARTAO = 'MSG-0091';
	const CARTAO_AVALIADO_COM_SUCESSO = 'MSG-0092';
	const LIMITE_DE_CARTOES_EXCEDIDO = 'MSG-0093';
	const CAMPANHA_EM_ANDAMENTO_DATA_INICIO_TERMINO_NEGADA = 'MSG-0094';
	const NAO_EXISTEM_MAIS_PAGINAS_APRESENTAR = 'MSG-0095';
	const TAMANHO_DO_CAMPO_EXCEDE_LIMITE_PERMITIDO = 'MSG-0096';
	const PARABENS_CASHBACK = 'MSG-0097';
	const PARABENS_CARIMBO = 'MSG-0098';
	const CONTA_GRATUITA_NAO_PERMITE_TROCA_DE_SELOS = 'MSG-0099';
	const CARTAO_ACABOU_DE_COMPLETAR_NOTIFY = 'MSG-0100';
	const VALOR_TICKET_MEDIO_CAMPANHA_ZERADO = 'MSG-0101';
	const CAMPANHA_CASHBACK_ATIVA_NA_CAMPANHA = 'MSG-0102';
	const USUARIO_SEM_CASHBACK_CONFIGURADO = 'MSG-0103';
	const USUARIO_BLOQUEADO_ENVIAR_ZAP = 'MSG-0104';
	const ERRO_INSERIR_REGISTRO_DE_SALDO = 'MSG-0105';
	const NOTIFICACAO_CREDITO_DONO = 'MSG-0106';
	const NOTIFICACAO_CREDITO_CLIENTE = 'MSG-0107';
	const SALDO_INSUFICIENTE_RESGATE = 'MSG-0108';
	const NOTIFICACAO_LIQUIDACAO_DONO = 'MSG-0109';
	const AUTOCONSUMO_NEGADO = 'MSG-0110';
	const CONSUMO_NEGADO_TIPO_CONTA = 'MSG-0111';
	const PERMISSAO_NEGADA_GERAR_CARIMBO = 'MSG-0112';
	const PERMISSAO_NEGADA_GERAR_CARIMBO_ANTES_PRAZO = 'MSG-0113';
	const PERMISSAO_NEGADA_GERAR_CARIMBO_FIM_PRAZO = 'MSG-0114';
	const NAO_FOI_POSSIVEL_HABILITAR_USUARIO_AUTORIZADOR = 'MSG-0115';
	const AUTORIZACAO_ESTA_ATIVA = 'MSG-0116';
	const PERMITIDO_SO_USUARIO_COMUM = 'MSG-0117';
	const TIPO_AUTORIZACAO_INVALIDO = 'MSG-0118';
	const TIPO_PERMISSAO_INVALIDO = 'MSG-0119';
	const PERMITIDO_SO_USUARIO_PARCEIRO = 'MSG-0120';
	const PLANO_USUARIO_INVALIDO = 'MSG-0121';
	const PLANO_USUARIO_FATURA_BLOQUEADO = 'MSG-0122';
	const PLANO_USUARIO_FATURA_PENDENTE = 'MSG-0123';
	const PLANO_USUARIO_STATUS_DESCONHECIDO = 'MSG-0124';
	const PLANO_USUARIO_FATURA_SEM_PAGAMENTO = 'MSG-0125';
	const CRIAR_CAMPANHA_PLANO_GRATUITO_INTERROMPIDA = 'MSG-0126';
	const VOCE_NAO_PATROCINA_ESTA_CAMPANHA = 'MSG-0127';
	const DESEJA_REALIZAR_A_COMPRA_DE_CARTOES = 'MSG-0128';
	const CAMPANHA_COM_GERENCIADOR_CARIMBOS_INCONSISTENTE = 'MSG-0129';
	const AINDA_TEM_CARTOES_LIVRES = 'MSG-0130';
	const CAMPANHA_COM_CARIMBOS_ADICIONAIS_NA_FILA = 'MSG-0131';
	const CAMPANHA_COM_CARIMBOS_PRODUZINDO = 'MSG-0132';
	const CAMPANHA_ERRO_CRIAR_CARIMBOS_ADICIONAIS = 'MSG-0133';
	const VERSAO_APP_INEXISTENTE = 'MSG-0134';
	const VERSAO_DESCONTINUADA = 'MSG-0135';
	const ATUALIZAR_VERSAO_DE_PARA_RECENTE = 'MSG-0136';
	const VERSAO_DESATUALIZADA = 'MSG-0137';
	const VERSAO_EM_MANUTENCAO_TENTE_MAIS_TARDE = 'MSG-0138';
	const NOTIFICACAO_NOVO_USUARIO = 'MSG-0139';
	const NOTIFICACAO_ADMIN_NOVO_CARIMBO = 'MSG-0140';
	const STATUS_NAO_COMPATIVEL_COM_ESTE_PROCESSO = 'MSG-0141';
	const TENTATIVA_CRIAR_CARIMBOS_ACIMA_LIMITE = 'MSG-0142';
	const NAO_EXISTEM_CARIMBOS_NA_FILA_PROCESSAR = 'MSG-0143'; 
	const PLANO_GRATUITO_NAO_PERMITE_SORTEIO = 'MSG-0144';
	const NAO_PERMITE_SORTEIO_TROCAR_PLANO = 'MSG-0145';
	const NAO_EXISTEM_MAIS_TICKETS_PARA_GERAR = 'MSG-0146';
	const CAMPANHA_SORTEIO_INEXISTENTE = 'MSG-0147';
	const CAMPANHA_SORTEIO_PRECISA_SER_ATIVADA = 'MSG-0148';
	const CAMPANHA_SORTEIO_ESTA_FINALIZADA = 'MSG-0149';
	const NOTIFICACAO_NOVO_CAMPANHA_SORTEIO = 'MSG-0150';
	const CAMPANHA_PRECISA_ESTAR_COM_STATUS_TRABALHANDO = 'MSG-0151';
	const GERACAO_NUMEROS_TICKETS_SORTEIO = 'MSG-0152';	
	const GERACAO_NUMEROS_TICKETS_SORTEIO_FINALIZADA = 'MSG-0153';
	const CAMPANHA_SORTEIO_ESTA_PRONTA_PRA_USAR = 'MSG-0154';
	const CAMPANHA_SORTEIO_AGUARDANDO_VERIFICACAO = 'MSG-0155';
	const CAMPANHA_SORTEIO_STATUS_PRECISA_SER_VERIFICADO = 'MSG-0156';
	const CAMPANHA_SORTEIO_PRECISA_VERFICACAO_ADMIN = 'MSG-0157';
	const CAMPANHA_SORTEIO_JA_ESTA_ATIVADA = 'MSG-0158';
	const CAMPANHA_SORTEIO_NAO_PERMITIDO_ATIVAR_PARALELO = 'MSG-0159';
	const CAMPANHA_SORTEIO_NAO_EXISTE_PARA_PAUSAR = 'MSG-0160';
	const CAMPANHA_SORTEIO_JA_ESTA_INATIVADA = 'MSG-0161';
	const CAMPANHA_SORTEIO_QTDE_EXCEDIDA = 'MSG-0162';
	const CAMPANHA_QTDE_EXCEDIDA = 'MSG-0163';
	const CAMPANHA_CARTAO_ACABOU_DEVIDO_PLANO_INFERIOR = 'MSG-0164';
	const REGISTRO_INDICACAO_TENTATIVA_AUTO_INDICACAO = 'MSG-0165';
	const REGISTRO_INDICACAO_USUARIO_JA_FOI_INDICADO_POR_OUTRA_PESSOA = 'MSG-0166';
	const REGISTRO_INDICACAO_USUARIO_JA_FOI_INDICADO_POR_VOCE = 'MSG-0167';
	const AVISO_INDICACAO_NOVA_INSTALACAO = 'MSG-0168';
	const PARABENS_PELA_RECOMPENSA_DE_INDICACAO = 'MSG-0169';
	const MSG_CASHBACK_BONIFICACAO_J10 = 'MSG-0170';
	const USUARIO_DONO_DESTINO_IGUAIS = 'MSG-0171';
	const USUARIO_DONO_CARTAO_INCONSISTENTE = 'MSG-0172';
	const USUARIO_DESTINO_CARTAO_ABERTO_NA_MESMA_CAMPANHA = 'MSG-0173';
	const USUARIO_DESTINO_IGUAL_DONO_CAMPANHA = 'MSG-0174';
	const CAMPANHA_NAO_PERMITE_MOVER_CARTAO_ENTRE_USUARIOS = 'MSG-0175';
	const INICIAR_PROCESSO_RESGATE_PIX = 'MSG-0176';
	const SOLICITACAO_PIX_REALIZADA_COM_SUCESSO = 'MSG-0177';
	const PIX_TIPO_DA_INVALIDA = 'MSG-0178';
	const PIX_VALOR_PARA_RESGATE_INVALIDO = 'MSG-0179';
	const PIX_MAX_ID_REGISTRO_INVALIDO = 'MSG-0180';
	const PIX_SOLICITACAO_RESGATE_PIX_EM_ANDAMENTO = 'MSG-0181';
	const PIX_USUARIO_DEVEDOR_SEM_CONFIGURACAO_CASHBACK = 'MSG-0182';
	const PIX_VALOR_INFERIOR_AO_CONFIGURADO = 'MSG-0183';
	const PIX_SALDO_INSUFICIENTE_PARA_RESGATE = 'MSG-0184';
	const PIX_TENTATIVA_RESGATE_ACIMA_VALOR_PERMITIDO = 'MSG-0185';
	const REGISTRO_FOI_REMOVIDO_COM_SUCESSO = 'MSG-0186';
	const PIX_SOLICITACAO_INVALIDA = 'MSG-0187';
	const PIX_SOLICITACAO_RESGATE_PIX_CONCLUIDA = 'MSG-0188';

	// tags dentro das mensagens
	const MSGTAG_DATA_ATIVACAO = '*=data-ativacao=*';
	const MSGTAG_NOME = '*=nome=*';
	const MSGTAG_EMAIL = '*=email=*';
	const MSGTAG_FUNCIONALIDADE = '*=funcionalidade=*';
	const MSGTAG_PERMISSAO_FACTORY = '*=permissaofactory=*';
	const MSGTAG_QTDE_PERMITIDA = '*=qtdepermitida=*';
	const MSTAG_LINK_TROCA_SENHA = '*=link-troca-senha=*';
	const MSGTAG_USUARIO_ID= '*=usuarioid=*';
	const MSGTAG_TOKEN_TROCA_SENHA = '*=token=*';
	const MSGTAG_HOME_URL_HTML_CANIVETE = '*=home-html-canivete=*';
	const MSGTAG_LINK_ATIVACAO = '*=contato-email-canivete=*';
	const MSGTAG_URL_AMBIENTE_ATIVO = '*=url-ambiente-ativo=*';

}

?>