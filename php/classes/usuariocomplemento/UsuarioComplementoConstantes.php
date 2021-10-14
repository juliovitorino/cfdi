<?php 


/**
*
* UsuarioComplementoConstantes - Classe de constantes estáticas com definições para uso na classe de negócio UsuarioComplemento
*
* Não é uma camada visível para outros dispositivos, como as camadas de apresentação e aplicação. 
*
* Todos os métodos DEVEM ser declarados como estáticos
*
* Changelog:
* 
* @author Julio Cesar Vitorino 
* @since 07/09/2021 10:21:34
* @copyright(c), Julio Vitorino <julio.vitorino@gmail.com>
*/

class UsuarioComplementoConstantes
{
   /* definição para colunas do banco de dados */
   const COL_USCO_ID = 'USCO_ID';
   const COL_USUA_ID = 'USUA_ID';
   const COL_USCO_TX_DDD = 'USCO_TX_DDD';
   const COL_USCO_TX_CEL = 'USCO_TX_CEL';
   const COL_USCO_NM_RECEITA_FEDERAL = 'USCO_NM_RECEITA_FEDERAL';
   const COL_USCO_NM_RESPONSAVEL = 'USCO_NM_RESPONSAVEL';
   const COL_USCO_TX_URL_WEBSITE = 'USCO_TX_URL_WEBSITE';
   const COL_USCO_TX_URL_FACEBOOK = 'USCO_TX_URL_FACEBOOK';
   const COL_USCO_TX_URL_INSTAGRAM = 'USCO_TX_URL_INSTAGRAM';
   const COL_USCO_TX_URL_PINTEREST = 'USCO_TX_URL_PINTEREST';
   const COL_USCO_TX_URL_SKYPE = 'USCO_TX_URL_SKYPE';
   const COL_USCO_TX_URL_TWITTER = 'USCO_TX_URL_TWITTER';
   const COL_USCO_TX_URL_FACETIME = 'USCO_TX_URL_FACETIME';
   const COL_USCO_TX_URL_IMG1 = 'USCO_TX_URL_IMG1';
   const COL_USCO_TX_URL_IMG2 = 'USCO_TX_URL_IMG2';
   const COL_USCO_TX_URL_IMG3 = 'USCO_TX_URL_IMG3';
   const COL_USCO_TX_DESC_LIVRE = 'USCO_TX_DESC_LIVRE';
   const COL_USCO_IN_STATUS = 'USCO_IN_STATUS';
   const COL_USCO_DT_CADASTRO = 'USCO_DT_CADASTRO';
   const COL_USCO_DT_UPDATE = 'USCO_DT_UPDATE';

   /* definição para campos do UsuarioComplementoDTO */
   const DTO_ID = 'id';
   const DTO_IDUSUARIO = 'idUsuario';
   const DTO_DDD = 'ddd';
   const DTO_TELEFONE = 'telefone';
   const DTO_NOMERECEITAFEDERAL = 'nomeReceitaFederal';
   const DTO_NOMERESPONSAVEL = 'nomeResponsavel';
   const DTO_URLSITE = 'urlsite';
   const DTO_URLFACEBOOK = 'urlFacebook';
   const DTO_URLINSTAGRAM = 'urlInstagram';
   const DTO_URLPINTEREST = 'urlPinterest';
   const DTO_URLSKYPE = 'urlSkype';
   const DTO_URLTWITTER = 'urlTwitter';
   const DTO_URLFACETIME = 'urlFacetime';
   const DTO_URLRESPONSAVEL = 'urlResponsavel';
   const DTO_URLFOTO2 = 'urlFoto2';
   const DTO_URLFOTO3 = 'urlFoto3';
   const DTO_DESCLIVRE = 'descLivre';
   const DTO_STATUS = 'status';
   const DTO_DATACADASTRO = 'dataCadastro';
   const DTO_DATAATUALIZACAO = 'dataAtualizacao';

   /* definição de tamanhos para os campos */
   const LEN_ID = 11;
   const LEN_IDUSUARIO = 11;
   const LEN_DDD = 2;
   const LEN_TELEFONE = 9;
   const LEN_NOMERECEITAFEDERAL = 1000;
   const LEN_NOMERESPONSAVEL = 1000;
   const LEN_URLSITE = 1000;
   const LEN_URLFACEBOOK = 1000;
   const LEN_URLINSTAGRAM = 1000;
   const LEN_URLPINTEREST = 1000;
   const LEN_URLSKYPE = 1000;
   const LEN_URLTWITTER = 1000;
   const LEN_URLFACETIME = 1000;
   const LEN_URLRESPONSAVEL = 1000;
   const LEN_URLFOTO2 = 1000;
   const LEN_URLFOTO3 = 1000;
   const LEN_DESCLIVRE = 2000;
   const LEN_STATUS = 1;
   const LEN_DATACADASTRO = 19;
   const LEN_DATAATUALIZACAO = 19;

   /* definição de tamanhos para os campos */
   const DESC_ID = 'ID do complemento';
   const DESC_IDUSUARIO = 'ID do usuário';
   const DESC_DDD = 'DDD';
   const DESC_TELEFONE = 'Número Celular';
   const DESC_NOMERECEITAFEDERAL = 'Nome registrado na Receita Federal';
   const DESC_NOMERESPONSAVEL = 'Nome do Responsável Principal';
   const DESC_URLSITE = 'URL do Website';
   const DESC_URLFACEBOOK = 'URL do facebook';
   const DESC_URLINSTAGRAM = 'Conta Instagram';
   const DESC_URLPINTEREST = 'URL do Pinterest';
   const DESC_URLSKYPE = 'Apelido Skype';
   const DESC_URLTWITTER = 'Conta Twitter';
   const DESC_URLFACETIME = 'Conta Facetime';
   const DESC_URLRESPONSAVEL = 'URL Foto Responsável';
   const DESC_URLFOTO2 = 'URL Foto 2';
   const DESC_URLFOTO3 = 'URL Foto 3';
   const DESC_DESCLIVRE = 'Descrição Livre';
   const DESC_STATUS = 'Status';
   const DESC_DATACADASTRO = 'Data de Cadastro';
   const DESC_DATAATUALIZACAO = 'Data de Atualização';

}


?>

