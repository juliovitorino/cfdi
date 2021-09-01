<?php 


/**
*
* ContatoConstantes - Classe de constantes estáticas com definições para uso na classe de negócio Contato
*
* Não é uma camada visível para outros dispositivos, como as camadas de apresentação e aplicação. 
*
* Todos os métodos DEVEM ser declarados como estáticos
*
* Changelog:
* 
* @author Julio Cesar Vitorino 
* @since 31/08/2021 08:17:22
* @copyright(c), Julio Vitorino <julio.vitorino@gmail.com>
*/

class ContatoConstantes
{
   /* definição para colunas do banco de dados */
   const COL_CONT_ID = 'CONT_ID';
   const COL_CONT_NM_NOME = 'CONT_NM_NOME';
   const COL_CONT_TX_EMAIL = 'CONT_TX_EMAIL';
   const COL_CONT_TX_MENSAGEM = 'CONT_TX_MENSAGEM';
   const COL_CONT_IN_STATUS = 'CONT_IN_STATUS';
   const COL_CONT_DT_CADASTRO = 'CONT_DT_CADASTRO';
   const COL_CONT_DT_UPDATE = 'CONT_DT_UPDATE';

   /* definição para campos do ContatoDTO */
   const DTO_ID = 'id';
   const DTO_NOME = 'nome';
   const DTO_EMAIL = 'email';
   const DTO_MENSAGEM = 'mensagem';
   const DTO_STATUS = 'status';
   const DTO_DATACADASTRO = 'dataCadastro';
   const DTO_DATAATUALIZACAO = 'dataAtualizacao';

   /* definição de tamanhos para os campos */
   const LEN_ID = 11;
   const LEN_NOME = 100;
   const LEN_EMAIL = 200;
   const LEN_MENSAGEM = 2000;
   const LEN_STATUS = 1;
   const LEN_DATACADASTRO = 19;
   const LEN_DATAATUALIZACAO = 19;

   /* definição de tamanhos para os campos */
   const DESC_ID = 'ID contato';
   const DESC_NOME = 'Nome do usuário';
   const DESC_EMAIL = 'Email do usuário';
   const DESC_MENSAGEM = 'Mensagem postada pelo usuário';
   const DESC_STATUS = 'Status';
   const DESC_DATACADASTRO = 'Data de Cadastro';
   const DESC_DATAATUALIZACAO = 'Data de Atualização';

   /* definição para origem dos contatos */
   const ORIGEM_FALE_CONOSCO = 'FC';
   const ORIGEM_LANDING_PAGE = 'LP';

}


?>
