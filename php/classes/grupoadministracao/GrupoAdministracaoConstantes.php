<?php 


/**
*
* GrupoAdministracaoConstantes - Classe de constantes estáticas com definições para uso na classe de negócio GrupoAdministracao
*
* Não é uma camada visível para outros dispositivos, como as camadas de apresentação e aplicação. 
*
* Todos os métodos DEVEM ser declarados como estáticos
*
* Changelog:
* 
* @author Julio Cesar Vitorino 
* @since 20/08/2021 15:41:08
* @copyright(c), Julio Vitorino <julio.vitorino@gmail.com>
*/

class GrupoAdministracaoConstantes
{
   /* definição para colunas do banco de dados */
   const COL_GRAD_ID = 'GRAD_ID';
   const COL_GRAD_NM_DESCRICAO = 'GRAD_NM_DESCRICAO';
   const COL_GRAD_IN_STATUS = 'GRAD_IN_STATUS';
   const COL_GRAD_DT_CADASTRO = 'GRAD_DT_CADASTRO';
   const COL_GRAD_DT_UPDATE = 'GRAD_DT_UPDATE';

   /* definição para campos do GrupoAdministracaoDTO */
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
   const DESC_ID = 'ID grupo administração';
   const DESC_DESCRICAO = 'Descricao do grupo administração';
   const DESC_STATUS = 'Status';
   const DESC_DATACADASTRO = 'Data de Cadastro';
   const DESC_DATAATUALIZACAO = 'Data de Atualização';

}


?>
