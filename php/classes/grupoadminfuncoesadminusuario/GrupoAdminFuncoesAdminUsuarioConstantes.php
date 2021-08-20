<?php 


/**
*
* GrupoAdminFuncoesAdminUsuarioConstantes - Classe de constantes estáticas com definições para uso na classe de negócio GrupoAdminFuncoesAdminUsuario
*
* Não é uma camada visível para outros dispositivos, como as camadas de apresentação e aplicação. 
*
* Todos os métodos DEVEM ser declarados como estáticos
*
* Changelog:
* 
* @author Julio Cesar Vitorino 
* @since 20/08/2021 19:25:25
* @copyright(c), Julio Vitorino <julio.vitorino@gmail.com>
*/

class GrupoAdminFuncoesAdminUsuarioConstantes
{
   /* definição para colunas do banco de dados */
   const COL_GAFAU_ID = 'GAFAU_ID';
   const COL_GAFA_ID = 'GAFA_ID';
   const COL_USUA_ID = 'USUA_ID';
   const COL_GAFAU_IN_STATUS = 'GAFAU_IN_STATUS';
   const COL_GAFAU_DT_CADASTRO = 'GAFAU_DT_CADASTRO';
   const COL_GAFAU_DT_UPDATE = 'GAFAU_DT_UPDATE';

   /* definição para campos do GrupoAdminFuncoesAdminUsuarioDTO */
   const DTO_ID = 'id';
   const DTO_IDGRUPOADMFUNCOESADM = 'idGrupoAdmFuncoesAdm';
   const DTO_ID_USUARIO = 'id_usuario';
   const DTO_STATUS = 'status';
   const DTO_DATACADASTRO = 'dataCadastro';
   const DTO_DATAATUALIZACAO = 'dataAtualizacao';

   /* definição de tamanhos para os campos */
   const LEN_ID = 11;
   const LEN_IDGRUPOADMFUNCOESADM = 11;
   const LEN_ID_USUARIO = 11;
   const LEN_STATUS = 1;
   const LEN_DATACADASTRO = 19;
   const LEN_DATAATUALIZACAO = 19;

   /* definição de tamanhos para os campos */
   const DESC_ID = 'ID grupo admin x função admin x usuário';
   const DESC_IDGRUPOADMFUNCOESADM = 'ID grupo admin x função admin';
   const DESC_ID_USUARIO = 'ID doo usuário';
   const DESC_STATUS = 'Status';
   const DESC_DATACADASTRO = 'Data de Cadastro';
   const DESC_DATAATUALIZACAO = 'Data de Atualização';

}


?>

