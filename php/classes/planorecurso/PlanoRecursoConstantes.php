<?php 


/**
*
* PlanoRecursoConstantes - Classe de constantes estáticas com definições para uso na classe de negócio PlanoRecurso
*
* Não é uma camada visível para outros dispositivos, como as camadas de apresentação e aplicação. 
*
* Todos os métodos DEVEM ser declarados como estáticos
*
* Changelog:
* 
* @author Julio Cesar Vitorino 
* @since 09/09/2021 12:12:30
* @copyright(c), Julio Vitorino <julio.vitorino@gmail.com>
*/

class PlanoRecursoConstantes
{
   /* definição para colunas do banco de dados */
   const COL_PLRE_ID = 'PLRE_ID';
   const COL_PLAN_ID = 'PLAN_ID';
   const COL_RECU_ID = 'RECU_ID';
   const COL_PLRE_IN_STATUS = 'PLRE_IN_STATUS';
   const COL_PLRE_DT_CADASTRO = 'PLRE_DT_CADASTRO';
   const COL_PLRE_DT_UPDATE = 'PLRE_DT_UPDATE';

   /* definição para campos do PlanoRecursoDTO */
   const DTO_ID = 'id';
   const DTO_IDPLANO = 'idplano';
   const DTO_IDRECURSO = 'idrecurso';
   const DTO_STATUS = 'status';
   const DTO_DATACADASTRO = 'dataCadastro';
   const DTO_DATAATUALIZACAO = 'dataAtualizacao';

   /* definição de tamanhos para os campos */
   const LEN_ID = 11;
   const LEN_IDPLANO = 11;
   const LEN_IDRECURSO = 11;
   const LEN_STATUS = 1;
   const LEN_DATACADASTRO = 19;
   const LEN_DATAATUALIZACAO = 19;

   /* definição de tamanhos para os campos */
   const DESC_ID = 'ID plano x recurso';
   const DESC_IDPLANO = 'ID do plano';
   const DESC_IDRECURSO = 'ID recurso';
   const DESC_STATUS = 'Status';
   const DESC_DATACADASTRO = 'Data de Cadastro';
   const DESC_DATAATUALIZACAO = 'Data de Atualização';

}


?>
