<?php 

/**
*
* UsuarioCampanhaSorteioTicketConstantes - Classe de constantes estáticas com definições para uso na classe de negócio UsuarioCampanhaSorteioTicket
*
* Não é uma camada visível para outros dispositivos, como as camadas de apresentação e aplicação. 
*
* Todos os métodos DEVEM ser declarados como estáticos
*
* Changelog:
* 
* @author Julio Cesar Vitorino 
* @since 22/06/2021 10:37:39
* @copyright(c), Julio Vitorino <julio.vitorino@gmail.com>
*/

class UsuarioCampanhaSorteioTicketConstantes
{
   /* definição para colunas do banco de dados */
   const COL_UCST_ID = 'UCST_ID';
   const COL_USCS_ID = 'USCS_ID';
   const COL_UCST_NU_TICKET = 'UCST_NU_TICKET';
   const COL_UCST_IN_STATUS = 'UCST_IN_STATUS';
   const COL_UCST_DT_CADASTRO = 'UCST_DT_CADASTRO';
   const COL_UCST_DT_UPDATE = 'UCST_DT_UPDATE';

   /* definição para campos do UsuarioCampanhaSorteioTicketDTO */
   const DTO_ID = 'id';
   const DTO_IDUSCS = 'iduscs';
   const DTO_TICKET = 'ticket';
   const DTO_STATUS = 'status';
   const DTO_DATACADASTRO = 'dataCadastro';
   const DTO_DATAATUALIZACAO = 'dataAtualizacao';

   /* definição de tamanhos para os campos */
   const LEN_ID = 11;
   const LEN_IDUSCS = 11;
   const LEN_TICKET = 11;
   const LEN_STATUS = 1;
   const LEN_DATACADASTRO = 19;
   const LEN_DATAATUALIZACAO = 19;

   /* definição de tamanhos para os campos */
   const DESC_ID = 'ID Usuario Campanha Sorteio Ticket';
   const DESC_IDUSCS = 'ID Usuario Campanha Sorteio';
   const DESC_TICKET = 'Número do Ticket';
   const DESC_STATUS = 'Status';
   const DESC_DATACADASTRO = 'Data de Cadastro';
   const DESC_DATAATUALIZACAO = 'Data de Atualização';

}


?>
