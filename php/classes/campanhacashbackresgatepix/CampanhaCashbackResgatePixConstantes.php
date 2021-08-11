<?php 


/**
*
* CampanhaCashbackResgatePixConstantes - Classe de constantes estáticas com definições para uso na classe de negócio CampanhaCashbackResgatePix
*
* Não é uma camada visível para outros dispositivos, como as camadas de apresentação e aplicação. 
*
* Todos os métodos DEVEM ser declarados como estáticos
*
* Changelog:
* 
* @author Julio Cesar Vitorino 
* @since 26/07/2021 15:11:48
* @copyright(c), Julio Vitorino <julio.vitorino@gmail.com>
*/

class CampanhaCashbackResgatePixConstantes
{

   /* definição de constantes do tipo da chave pix */
   const TIPO_CHAVEPIX_CPF = '0';
   const TIPO_CHAVEPIX_CNPJ = '1';
   const TIPO_CHAVEPIX_CELULAR = '2';
   const TIPO_CHAVEPIX_EMAIL = '3';
   const TIPO_CHAVEPIX_ALEATORIA = '4';

   const TIPO_CHAVEPIX_CPF_DESC = 'CPF';
   const TIPO_CHAVEPIX_CNPJ_DESC = 'CNPJ';
   const TIPO_CHAVEPIX_CELULAR_DESC = 'CELULAR';
   const TIPO_CHAVEPIX_EMAIL_DESC = 'EMAIL';
   const TIPO_CHAVEPIX_ALEATORIA_DESC = 'ALEATORIA';
   const TIPO_CHAVEPIX_INVALIDA_DESC = 'INVALIDA';

   /* definição de contantes para estagio real time */
   const ESTAGIO_RT_PENDENTE = 0;
   const ESTAGIO_RT_ANALISE = 1;
   const ESTAGIO_RT_FINANCEIRO = 2;
   const ESTAGIO_RT_ERRO = 3;
   const ESTAGIO_RT_TRANSFERIDO = 4;

   const ESTAGIO_RT_PENDENTE_DESC = 'PENDENTE';
   const ESTAGIO_RT_ANALISE_DESC = 'EM ANÁLISE';
   const ESTAGIO_RT_FINANCEIRO_DESC = 'FINANCEIRO';
   const ESTAGIO_RT_ERRO_DESC = 'ERRO';
   const ESTAGIO_RT_TRANSFERIDO_DESC = 'TRANSFERIDO';
   const ESTAGIO_RT_INVALIDO_DESC = 'INVÁLIDO';
   
   /* definição para colunas do banco de dados */
   const COL_CCRP_ID = 'CCRP_ID';
   const COL_USUA_ID_DEVEDOR = 'USUA_ID_DEVEDOR';
   const COL_USUA_ID = 'USUA_ID';
   const COL_CCRP_IN_TIPO_CHAVE_PIX = 'CCRP_IN_TIPO_CHAVE_PIX';
   const COL_CCRP_TX_CHAVE_PIX = 'CCRP_TX_CHAVE_PIX';
   const COL_CCRP_VL_RESGATE = 'CCRP_VL_RESGATE';
   const COL_CCRP_TX_AUTENT_BCO = 'CCRP_TX_AUTENT_BCO';
   const COL_CCRP_IN_ESTAGIO_RT = 'CCRP_IN_ESTAGIO_RT';
   const COL_CCRP_DT_ESTAGIO_ANALISE = 'CCRP_DT_ESTAGIO_ANALISE';
   const COL_CCRP_DT_ESTAGIO_FINANCEIRO = 'CCRP_DT_ESTAGIO_FINANCEIRO';
   const COL_CCRP_DT_ESTAGIO_ERRO = 'CCRP_DT_ESTAGIO_ERRO';
   const COL_CCRP_DT_ESTAGIO_TRANSF_BCO = 'CCRP_DT_ESTAGIO_TRANSF_BCO';
   const COL_CCRP_TX_LIVRE_ESTAGIO_RT = 'CCRP_TX_LIVRE_ESTAGIO_RT';
   const COL_CCRP_IN_STATUS = 'CCRP_IN_STATUS';
   const COL_CCRP_DT_CADASTRO = 'CCRP_DT_CADASTRO';
   const COL_CCRP_DT_UPDATE = 'CCRP_DT_UPDATE';

   /* definição para campos do CampanhaCashbackResgatePixDTO */
   const DTO_ID = 'id';
   const DTO_IDUSUARIODEVEDOR = 'idUsuarioDevedor';
   const DTO_IDUSUARIOSOLICITANTE = 'idUsuarioSolicitante';
   const DTO_TIPOCHAVEPIX = 'tipoChavePix';
   const DTO_CHAVEPIX = 'chavePix';
   const DTO_VALORRESGATE = 'valorResgate';
   const DTO_AUTENTICACAOBCO = 'autenticacaoBco';
   const DTO_ESTAGIOREALTIME = 'estagioRealTime';
   const DTO_DTESTAGIOANALISE = 'dtEstagioAnalise';
   const DTO_DTESTAGIOFINANCEIRO = 'dtEstagioFinanceiro';
   const DTO_DTESTAGIOERRO = 'dtEstagioErro';
   const DTO_DTESTAGIOTRANFBCO = 'dtEstagioTranfBco';
   const DTO_TXTLIVREESTAGIORT = 'txtLivreEstagioRT';
   const DTO_STATUS = 'status';
   const DTO_DATACADASTRO = 'dataCadastro';
   const DTO_DATAATUALIZACAO = 'dataAtualizacao';

   /* definição de tamanhos para os campos */
   const LEN_ID = 11;
   const LEN_IDUSUARIODEVEDOR = 11;
   const LEN_IDUSUARIOSOLICITANTE = 11;
   const LEN_TIPOCHAVEPIX = 1;
   const LEN_CHAVEPIX = 100;
   const LEN_VALORRESGATE = 11;
   const LEN_AUTENTICACAOBCO = 200;
   const LEN_ESTAGIOREALTIME = 1;
   const LEN_DTESTAGIOANALISE = 19;
   const LEN_DTESTAGIOFINANCEIRO = 19;
   const LEN_DTESTAGIOERRO = 19;
   const LEN_DTESTAGIOTRANFBCO = 19;
   const LEN_TXTLIVREESTAGIORT = 2000;
   const LEN_STATUS = 1;
   const LEN_DATACADASTRO = 19;
   const LEN_DATAATUALIZACAO = 19;

   /* definição de tamanhos para os campos */
   const DESC_ID = 'ID Resgate Cashback';
   const DESC_IDUSUARIODEVEDOR = 'ID do usuário devedor';
   const DESC_IDUSUARIOSOLICITANTE = 'ID do usuário solicitante';
   const DESC_TIPOCHAVEPIX = 'Tipo da Chave PIX';
   const DESC_CHAVEPIX = 'Chave PIX';
   const DESC_VALORRESGATE = 'Valor Pretendido a Resgatar';
   const DESC_AUTENTICACAOBCO = 'Autenticação do Banco';
   const DESC_ESTAGIOREALTIME = 'Estágio Real Time';
   const DESC_DTESTAGIOANALISE = 'Data Registro Estágio Análise';
   const DESC_DTESTAGIOFINANCEIRO = 'Data Registro Estágio Financeiro';
   const DESC_DTESTAGIOERRO = 'Data Registro Estágio Erro';
   const DESC_DTESTAGIOTRANFBCO = 'Data Registro Estágio Transferido Bco';
   const DESC_TXTLIVREESTAGIORT = 'Texto Livre do Estagio RT';
   const DESC_STATUS = 'Status';
   const DESC_DATACADASTRO = 'Data de Cadastro';
   const DESC_DATAATUALIZACAO = 'Data de Atualização';

}


?>

