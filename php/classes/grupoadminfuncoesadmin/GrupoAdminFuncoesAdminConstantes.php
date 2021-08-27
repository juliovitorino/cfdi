<?php 

/**
*
* GrupoAdminFuncoesAdminConstantes - Classe de constantes estáticas com definições para uso na classe de negócio GrupoAdminFuncoesAdmin
*
* Não é uma camada visível para outros dispositivos, como as camadas de apresentação e aplicação. 
*
* Todos os métodos DEVEM ser declarados como estáticos
*
* Changelog:
* 
* @author Julio Cesar Vitorino 
* @since 20/08/2021 18:47:48
* @copyright(c), Julio Vitorino <julio.vitorino@gmail.com>
*/

class GrupoAdminFuncoesAdminConstantes
{
   /* definição para colunas do banco de dados */
   const COL_GAFA_ID = 'GAFA_ID';
   const COL_GRAD_ID = 'GRAD_ID';
   const COL_FUAD_ID = 'FUAD_ID';
   const COL_GAFA_IN_CRUD_CRIAR = 'GAFA_IN_CRUD_CRIAR';
   const COL_GAFA_IN_CRUD_RECUPERAR = 'GAFA_IN_CRUD_RECUPERAR';
   const COL_GAFA_IN_CRUD_ATUALIZAR = 'GAFA_IN_CRUD_ATUALIZAR';
   const COL_GAFA_IN_CRUD_EXCLUIR = 'GAFA_IN_CRUD_EXCLUIR';
   const COL_GAFA_IN_STATUS = 'GAFA_IN_STATUS';
   const COL_GAFA_DT_CADASTRO = 'GAFA_DT_CADASTRO';
   const COL_GAFA_DT_UPDATE = 'GAFA_DT_UPDATE';

   /* definição para campos do GrupoAdminFuncoesAdminDTO */
   const DTO_ID = 'id';
   const DTO_IDGRUPOADMINISTRACAO = 'idGrupoAdministracao';
   const DTO_IDFUNCOESADMINISTRATIVAS = 'idFuncoesAdministrativas';
   const DTO_DESCRICAO = 'descricao';
   const DTO_INCRUDCRIAR = 'incrudCriar';
   const DTO_INCRUDRECUPERAR = 'incrudRecuperar';
   const DTO_INCRUDATUALIZAR = 'incrudAtualizar';
   const DTO_INCRUDEXCLUIR = 'incrudExcluir';
   const DTO_STATUS = 'status';
   const DTO_DATACADASTRO = 'dataCadastro';
   const DTO_DATAATUALIZACAO = 'dataAtualizacao';

   /* definição de tamanhos para os campos */
   const LEN_ID = 11;
   const LEN_IDGRUPOADMINISTRACAO = 11;
   const LEN_IDFUNCOESADMINISTRATIVAS = 11;
   const LEN_DESCRICAO = 100;
   const LEN_INCRUDCRIAR = 1;
   const LEN_INCRUDRECUPERAR = 1;
   const LEN_INCRUDATUALIZAR = 1;
   const LEN_INCRUDEXCLUIR = 1;
   const LEN_STATUS = 1;
   const LEN_DATACADASTRO = 19;
   const LEN_DATAATUALIZACAO = 19;

   /* definição de tamanhos para os campos */
   const DESC_ID = 'ID grupo admin x função admin';
   const DESC_IDGRUPOADMINISTRACAO = 'ID grupo administração';
   const DESC_IDFUNCOESADMINISTRATIVAS = 'ID funções administrativas';
   const DESC_DESCRICAO = 'Descricao do grupo admin x função admin';
   const DESC_INCRUDCRIAR = 'Permissão CRUD Criar';
   const DESC_INCRUDRECUPERAR = 'Permissão CRUD Recuperar';
   const DESC_INCRUDATUALIZAR = 'Permissão CRUD Atualizar';
   const DESC_INCRUDEXCLUIR = 'Permissão CRUD Excluir';
   const DESC_STATUS = 'Status';
   const DESC_DATACADASTRO = 'Data de Cadastro';
   const DESC_DATAATUALIZACAO = 'Data de Atualização';

}


?>
