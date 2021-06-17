<?php 


/**
*
* CampanhaSorteioFilaCriacaoConstantes - Classe de constantes estáticas com definições para uso na classe de negócio CampanhaSorteioFilaCriacao
*
* Não é uma camada visível para outros dispositivos, como as camadas de apresentação e aplicação. 
*
* Todos os métodos DEVEM ser declarados como estáticos
*
* Changelog:
* 
* @author Julio Cesar Vitorino 
* @since 17/06/2021 08:10:22
* @copyright(c), Julio Vitorino <julio.vitorino@gmail.com>
*/

class CampanhaSorteioFilaCriacaoConstantes
{
   /* definição para colunas do banco de dados */
   const COL_CSFC_ID = 'CSFC_ID';
   const COL_CASO_ID = 'CASO_ID';
   const COL_CSFC_QT_LOTE = 'CSFC_QT_LOTE';
   const COL_CSFC_IN_STATUS = 'CSFC_IN_STATUS';
   const COL_CSFC_DT_CADASTRO = 'CSFC_DT_CADASTRO';
   const COL_CSFC_DT_UPDATE = 'CSFC_DT_UPDATE';

   /* definição para campos do CampanhaSorteioFilaCriacaoDTO */
   const DTO_ID = 'id';
   const DTO_ID_CASO = 'id_caso';
   const DTO_QTLOTETICKETCRIAR = 'qtLoteTicketCriar';
   const DTO_STATUS = 'status';
   const DTO_DATACADASTRO = 'dataCadastro';
   const DTO_DATAATUALIZACAO = 'dataAtualizacao';

   /* definição de tamanhos para os campos */
   const LEN_ID = 11;
   const LEN_ID_CASO = 11;
   const LEN_QTLOTETICKETCRIAR = 5;
   const LEN_STATUS = 1;
   const LEN_DATACADASTRO = 19;
   const LEN_DATAATUALIZACAO = 19;

   /* definição de tamanhos para os campos */
   const DESC_ID = 'ID da campanha sorteio fila criação';
   const DESC_ID_CASO = 'ID da campanha sorteio';
   const DESC_QTLOTETICKETCRIAR = 'Qtde lotes de tickets';
   const DESC_STATUS = 'Status';
   const DESC_DATACADASTRO = 'Data de Cadastro';
   const DESC_DATAATUALIZACAO = 'Data de Atualização';

}


?>
