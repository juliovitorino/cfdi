<?php 


/**
*
* RecursoConstantes - Classe de constantes estáticas com definições para uso na classe de negócio Recurso
*
* Não é uma camada visível para outros dispositivos, como as camadas de apresentação e aplicação. 
*
* Todos os métodos DEVEM ser declarados como estáticos
*
* Changelog:
* 
* @author Julio Cesar Vitorino 
* @since 09/09/2021 08:00:49
* @copyright(c), Julio Vitorino <julio.vitorino@gmail.com>
*/

class RecursoConstantes
{
   /* definição para colunas do banco de dados */
   const COL_RECU_ID = 'RECU_ID';
   const COL_RECU_TX_DESCRICAO = 'RECU_TX_DESCRICAO';
   const COL_RECU_IN_STATUS = 'RECU_IN_STATUS';
   const COL_RECU_DT_CADASTRO = 'RECU_DT_CADASTRO';
   const COL_RECU_DT_UPDATE = 'RECU_DT_UPDATE';

   /* definição para campos do RecursoDTO */
   const DTO_ID = 'id';
   const DTO_DESCRICAO = 'descricao';
   const DTO_STATUS = 'status';
   const DTO_DATACADASTRO = 'dataCadastro';
   const DTO_DATAATUALIZACAO = 'dataAtualizacao';

   /* definição de tamanhos para os campos */
   const LEN_ID = 11;
   const LEN_DESCRICAO = 100;
   const LEN_STATUS = 1;
   const LEN_DATACADASTRO = 19;
   const LEN_DATAATUALIZACAO = 19;

   /* definição de tamanhos para os campos */
   const DESC_ID = 'ID recurso';
   const DESC_DESCRICAO = 'Descrição';
   const DESC_STATUS = 'Status';
   const DESC_DATACADASTRO = 'Data de Cadastro';
   const DESC_DATAATUALIZACAO = 'Data de Atualização';

}


?>
