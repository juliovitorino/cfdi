<?php 
/**
*
* CampanhaSorteioConstantes - Classe de constantes estáticas com definições para uso na classe de negócio CampanhaSorteio
*
* Não é uma camada visível para outros dispositivos, como as camadas de apresentação e aplicação. 
*
* Todos os métodos DEVEM ser declarados como estáticos
*
* Changelog:
* 
* @author Julio Cesar Vitorino 
* @since 16/06/2021 12:57:19
* @copyright(c), Julio Vitorino <julio.vitorino@gmail.com>
*/

class CampanhaSorteioConstantes
{
   /* definição para colunas do banco de dados */
   const COL_CASO_ID = 'CASO_ID';
   const COL_CAMP_ID = 'CAMP_ID';
   const COL_CASO_TX_NOME = 'CASO_TX_NOME';
   const COL_CASO_TX_URL_REGULAMENTO = 'CASO_TX_URL_REGULAMENTO';
   const COL_CASO_TX_PREMIO = 'CASO_TX_PREMIO';
   const COL_CASO_DT_INICIO = 'CASO_DT_INICIO';
   const COL_CASO_DT_TERMINO = 'CASO_DT_TERMINO';
   const COL_CASO_NU_MAX_TICKET = 'CASO_NU_MAX_TICKET';
   const COL_CASO_IN_STATUS = 'CASO_IN_STATUS';
   const COL_CASO_DT_CADASTRO = 'CASO_DT_CADASTRO';
   const COL_CASO_DT_UPDATE = 'CASO_DT_UPDATE';

   /* definição para campos do CampanhaSorteioDTO */
   const DTO_ID = 'id';
   const DTO_ID_CAMPANHA = 'id_campanha';
   const DTO_NOME = 'nome';
   const DTO_URLREGULAMENTO = 'urlRegulamento';
   const DTO_PREMIO = 'premio';
   const DTO_DATACOMECOSORTEIO = 'dataComecoSorteio';
   const DTO_DATAFIMSORTEIO = 'dataFimSorteio';
   const DTO_MAXTICKETS = 'maxTickets';
   const DTO_STATUS = 'status';
   const DTO_DATACADASTRO = 'dataCadastro';
   const DTO_DATAATUALIZACAO = 'dataAtualizacao';

   /* definição de tamanhos para os campos */
   const LEN_ID = 11;
   const LEN_ID_CAMPANHA = 11;
   const LEN_NOME = 100;
   const LEN_URLREGULAMENTO = 2000;
   const LEN_PREMIO = 2000;
   const LEN_DATACOMECOSORTEIO = 19;
   const LEN_DATAFIMSORTEIO = 19;
   const LEN_MAXTICKETS = 11;
   const LEN_STATUS = 1;
   const LEN_DATACADASTRO = 19;
   const LEN_DATAATUALIZACAO = 19;

   /* definição de tamanhos para os campos */
   const DESC_ID = 'ID da campanha sorteio';
   const DESC_ID_CAMPANHA = 'ID da campanha';
   const DESC_NOME = 'Nome do sorteio';
   const DESC_URLREGULAMENTO = 'URL regulamento do sorteio';
   const DESC_PREMIO = 'Prêmio do sorteio';
   const DESC_DATACOMECOSORTEIO = 'Data de início';
   const DESC_DATAFIMSORTEIO = 'Data de término';
   const DESC_MAXTICKETS = 'Máximo de tickets';
   const DESC_STATUS = 'Status';
   const DESC_DATACADASTRO = 'Data de Cadastro';
   const DESC_DATAATUALIZACAO = 'Data de Atualização';

}


?>

