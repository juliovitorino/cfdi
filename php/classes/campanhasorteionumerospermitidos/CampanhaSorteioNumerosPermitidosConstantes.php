<?php 


/**
*
* CampanhaSorteioNumerosPermitidosConstantes - Classe de constantes estáticas com definições para uso na classe de negócio CampanhaSorteioNumerosPermitidos
*
* Não é uma camada visível para outros dispositivos, como as camadas de apresentação e aplicação. 
*
* Todos os métodos DEVEM ser declarados como estáticos
*
* Changelog:
* 
* @author Julio Cesar Vitorino 
* @since 17/06/2021 17:44:16
* @copyright(c), Julio Vitorino <julio.vitorino@gmail.com>
*/

class CampanhaSorteioNumerosPermitidosConstantes
{
   /* definição para colunas do banco de dados */
   const COL_CSNP_ID = 'CSNP_ID';
   const COL_CASO_ID = 'CASO_ID';
   const COL_CSNP_NU_SORTEIO = 'CSNP_NU_SORTEIO';
   const COL_CSNP_IN_STATUS = 'CSNP_IN_STATUS';
   const COL_CSNP_DT_CADASTRO = 'CSNP_DT_CADASTRO';
   const COL_CSNP_DT_UPDATE = 'CSNP_DT_UPDATE';

   /* definição para campos do CampanhaSorteioNumerosPermitidosDTO */
   const DTO_ID = 'id';
   const DTO_ID_CASO = 'id_caso';
   const DTO_NRTICKETSORTEIO = 'nrTicketSorteio';
   const DTO_STATUS = 'status';
   const DTO_DATACADASTRO = 'dataCadastro';
   const DTO_DATAATUALIZACAO = 'dataAtualizacao';

   /* definição de tamanhos para os campos */
   const LEN_ID = 11;
   const LEN_ID_CASO = 11;
   const LEN_NRTICKETSORTEIO = 5;
   const LEN_STATUS = 1;
   const LEN_DATACADASTRO = 19;
   const LEN_DATAATUALIZACAO = 19;

   /* definição de tamanhos para os campos */
   const DESC_ID = 'ID da CSNP';
   const DESC_ID_CASO = 'ID da campanha sorteio';
   const DESC_NRTICKETSORTEIO = 'Número ticket de sorteio';
   const DESC_STATUS = 'Status';
   const DESC_DATACADASTRO = 'Data de Cadastro';
   const DESC_DATAATUALIZACAO = 'Data de Atualização';

}


?>
