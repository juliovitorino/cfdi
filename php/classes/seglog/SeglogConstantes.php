<?php 


/**
*
* SeglogConstantes - Classe de constantes estáticas com definições para uso na classe de negócio Seglog
*
* Não é uma camada visível para outros dispositivos, como as camadas de apresentação e aplicação. 
*
* Todos os métodos DEVEM ser declarados como estáticos
*
* Changelog:
* 
* @author Julio Cesar Vitorino 
* @since 21/08/2021 12:30:09
* @copyright(c), Julio Vitorino <julio.vitorino@gmail.com>
*/

class SeglogConstantes
{
   /* definição para colunas do banco de dados */
   const COL_SELOG_ID = 'SELOG_ID';
   const COL_GAFA_ID = 'GAFA_ID';
   const COL_USUA_ID = 'USUA_ID';
   const COL_SEGLOG_DESCRICAO = 'SEGLOG_DESCRICAO';
   const COL_SEGLOG_IN_CRUD_CRIAR = 'SEGLOG_IN_CRUD_CRIAR';
   const COL_SEGLOG_IN_CRUD_RECUPERAR = 'SEGLOG_IN_CRUD_RECUPERAR';
   const COL_SEGLOG_IN_CRUD_ATUALIZAR = 'SEGLOG_IN_CRUD_ATUALIZAR';
   const COL_SEGLOG_IN_CRUD_EXCLUIR = 'SEGLOG_IN_CRUD_EXCLUIR';
   const COL_SEGLOG_IN_STATUS = 'SEGLOG_IN_STATUS';
   const COL_SEGLOG_DT_CADASTRO = 'SEGLOG_DT_CADASTRO';
   const COL_SEGLOG_DT_UPDATE = 'SEGLOG_DT_UPDATE';

   /* definição para campos do SeglogDTO */
   const DTO_ID = 'id';
   const DTO_IDGAFA = 'idgafa';
   const DTO_ID_USUARIO = 'id_usuario';
   const DTO_FUNCAO = 'funcao';
   const DTO_INCRUDCRIAR = 'incrudCriar';
   const DTO_INCRUDRECUPERAR = 'incrudRecuperar';
   const DTO_INCRUDATUALIZAR = 'incrudAtualizar';
   const DTO_INCRUDEXCLUIR = 'incrudExcluir';
   const DTO_STATUS = 'status';
   const DTO_DATACADASTRO = 'dataCadastro';
   const DTO_DATAATUALIZACAO = 'dataAtualizacao';

   /* definição de tamanhos para os campos */
   const LEN_ID = 11;
   const LEN_IDGAFA = 11;
   const LEN_ID_USUARIO = 11;
   const LEN_FUNCAO = 100;
   const LEN_INCRUDCRIAR = 1;
   const LEN_INCRUDRECUPERAR = 1;
   const LEN_INCRUDATUALIZAR = 1;
   const LEN_INCRUDEXCLUIR = 1;
   const LEN_STATUS = 1;
   const LEN_DATACADASTRO = 19;
   const LEN_DATAATUALIZACAO = 19;

   /* definição de tamanhos para os campos */
   const DESC_ID = 'ID grupo admin x função admin';
   const DESC_IDGAFA = 'ID grupo admin x função admin';
   const DESC_ID_USUARIO = 'ID do usuario';
   const DESC_FUNCAO = 'Função';
   const DESC_INCRUDCRIAR = 'Permissão CRUD Criar';
   const DESC_INCRUDRECUPERAR = 'Permissão CRUD Recuperar';
   const DESC_INCRUDATUALIZAR = 'Permissão CRUD Atualizar';
   const DESC_INCRUDEXCLUIR = 'Permissão CRUD Excluir';
   const DESC_STATUS = 'Status';
   const DESC_DATACADASTRO = 'Data de Cadastro';
   const DESC_DATAATUALIZACAO = 'Data de Atualização';

}


?>
