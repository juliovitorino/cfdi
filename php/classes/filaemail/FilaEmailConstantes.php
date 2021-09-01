<?php 


/**
*
* FilaEmailConstantes - Classe de constantes estáticas com definições para uso na classe de negócio FilaEmail
*
* Não é uma camada visível para outros dispositivos, como as camadas de apresentação e aplicação. 
*
* Todos os métodos DEVEM ser declarados como estáticos
*
* Changelog:
* 
* @author Julio Cesar Vitorino 
* @since 01/09/2021 15:29:49
* @copyright(c), Julio Vitorino <julio.vitorino@gmail.com>
*/

class FilaEmailConstantes
{
   /* definição para colunas do banco de dados */
   const COL_FIEM_ID = 'FIEM_ID';
   const COL_FIEM_NM_FILA = 'FIEM_NM_FILA';
   const COL_FIEM_TX_EMAIL_DE = 'FIEM_TX_EMAIL_DE';
   const COL_FIEM_TX_EMAIL_PARA = 'FIEM_TX_EMAIL_PARA';
   const COL_FIEM_TX_ASSUNTO = 'FIEM_TX_ASSUNTO';
   const COL_FIEM_IN_PRIOR = 'FIEM_IN_PRIOR';
   const COL_FIEM_TX_TEMPLATE = 'FIEM_TX_TEMPLATE';
   const COL_FIEM_NU_MAX_TENTATIVA = 'FIEM_NU_MAX_TENTATIVA';
   const COL_FIEM_NU_TENTATIVA_REAL = 'FIEM_NU_TENTATIVA_REAL';
   const COL_FIEM_DT_PREV_ENVIO = 'FIEM_DT_PREV_ENVIO';
   const COL_FIEM_DT_REAL_ENVIO = 'FIEM_DT_REAL_ENVIO';
   const COL_FIEM_IN_STATUS = 'FIEM_IN_STATUS';
   const COL_FIEM_DT_CADASTRO = 'FIEM_DT_CADASTRO';
   const COL_FIEM_DT_UPDATE = 'FIEM_DT_UPDATE';

   /* definição para campos do FilaEmailDTO */
   const DTO_ID = 'id';
   const DTO_NOMEFILA = 'nomeFila';
   const DTO_EMAILDE = 'emailDe';
   const DTO_EMAILPARA = 'emailPara';
   const DTO_ASSUNTO = 'assunto';
   const DTO_PRIORIDADE = 'prioridade';
   const DTO_TEMPLATE = 'template';
   const DTO_NRMAXTENTATIVAS = 'nrMaxTentativas';
   const DTO_NRREALTENTATIVAS = 'nrRealTentativas';
   const DTO_DATAPREVISAOENVIO = 'dataPrevisaoEnvio';
   const DTO_DATAREALENVIO = 'dataRealEnvio';
   const DTO_STATUS = 'status';
   const DTO_DATACADASTRO = 'dataCadastro';
   const DTO_DATAATUALIZACAO = 'dataAtualizacao';

   /* definição de tamanhos para os campos */
   const LEN_ID = 11;
   const LEN_NOMEFILA = 100;
   const LEN_EMAILDE = 200;
   const LEN_EMAILPARA = 200;
   const LEN_ASSUNTO = 1000;
   const LEN_PRIORIDADE = 2;
   const LEN_TEMPLATE = 1000;
   const LEN_NRMAXTENTATIVAS = 2;
   const LEN_NRREALTENTATIVAS = 2;
   const LEN_DATAPREVISAOENVIO = 19;
   const LEN_DATAREALENVIO = 19;
   const LEN_STATUS = 1;
   const LEN_DATACADASTRO = 19;
   const LEN_DATAATUALIZACAO = 19;

   /* definição de tamanhos para os campos */
   const DESC_ID = 'ID fila email';
   const DESC_NOMEFILA = 'Nome da fila';
   const DESC_EMAILDE = 'Email do usuário de';
   const DESC_EMAILPARA = 'Email do usuário destino';
   const DESC_ASSUNTO = 'Asssunto da mensagem';
   const DESC_PRIORIDADE = 'Nível de prioridade da mensagem';
   const DESC_TEMPLATE = 'Template associado a essa mensagem';
   const DESC_NRMAXTENTATIVAS = 'Numero Max Tentativas';
   const DESC_NRREALTENTATIVAS = 'Numero Tentativas Realizadas';
   const DESC_DATAPREVISAOENVIO = 'Data prevista envio';
   const DESC_DATAREALENVIO = 'Data envio real';
   const DESC_STATUS = 'Status';
   const DESC_DATACADASTRO = 'Data de Cadastro';
   const DESC_DATAATUALIZACAO = 'Data de Atualização';

   /* Definição para prioridades do email */
   const PRIOR_NORMAL = "NO";
   const PRIOR_BAIXA = "LO";
   const PRIOR_ALTA = "HI";

   /* Definição padrão para criação das filas de email nos processos de busca */
   const FIEM_EMAIL_BOAS_VINDAS = 'FIEM_EMAIL_BOAS_VINDAS';
   const FIEM_CONTATO_PELO_FALE_CONOSCO_SITE = 'FIEM_CONTATO_PELO_FALE_CONOSCO_SITE';
}


?>
