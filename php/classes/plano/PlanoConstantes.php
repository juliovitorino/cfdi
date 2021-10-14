<?php 


/**
*
* PlanoConstantes - Classe de constantes estáticas com definições para uso na classe de negócio Plano
*
* Não é uma camada visível para outros dispositivos, como as camadas de apresentação e aplicação. 
*
* Todos os métodos DEVEM ser declarados como estáticos
*
* Changelog:
* 
* @author Julio Cesar Vitorino 
* @since 08/09/2021 14:05:31
* @copyright(c), Julio Vitorino <julio.vitorino@gmail.com>
*/

class PlanoConstantes
{
   /* definição para colunas do banco de dados */
   const COL_PLAN_ID = 'PLAN_ID';
   const COL_PLAN_NM_PLANO = 'PLAN_NM_PLANO';
   const COL_PLAN_TX_PERMISSAO = 'PLAN_TX_PERMISSAO';
   const COL_PLAN_VL_PLANO = 'PLAN_VL_PLANO';
   const COL_PLAN_IN_TIPO = 'PLAN_IN_TIPO';
   const COL_PLAN_IN_STATUS = 'PLAN_IN_STATUS';
   const COL_PLAN_DT_CADASTRO = 'PLAN_DT_CADASTRO';
   const COL_PLAN_DT_UPDATE = 'PLAN_DT_UPDATE';

   /* definição para campos do PlanoDTO */
   const DTO_ID = 'id';
   const DTO_NOME = 'nome';
   const DTO_PERMISSAO = 'permissao';
   const DTO_VALOR = 'valor';
   const DTO_TIPO = 'tipo';
   const DTO_STATUS = 'status';
   const DTO_DATACADASTRO = 'dataCadastro';
   const DTO_DATAATUALIZACAO = 'dataAtualizacao';

   /* definição de tamanhos para os campos */
   const LEN_ID = 11;
   const LEN_NOME = 100;
   const LEN_PERMISSAO = 2000;
   const LEN_VALOR = 9;
   const LEN_TIPO = 3;
   const LEN_STATUS = 1;
   const LEN_DATACADASTRO = 19;
   const LEN_DATAATUALIZACAO = 19;

   /* definição de tamanhos para os campos */
   const DESC_ID = 'ID do Plano';
   const DESC_NOME = 'Nome do Plano';
   const DESC_PERMISSAO = 'Estruturas de Permissão do Plano';
   const DESC_VALOR = 'Valor do Plano';
   const DESC_TIPO = 'Tipo do Plano';
   const DESC_STATUS = 'Status';
   const DESC_DATACADASTRO = 'Data de Cadastro';
   const DESC_DATAATUALIZACAO = 'Data de Atualização';

}


?>
