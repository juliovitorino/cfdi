<?php 
/**
*
* FilaPublicidadeConstantes - Classe de constantes estáticas com definições para uso na classe de negócio FilaPublicidade
*
* Não é uma camada visível para outros dispositivos, como as camadas de apresentação e aplicação. 
*
* Todos os métodos DEVEM ser declarados como estáticos
*
* Changelog:
* 
* @author Julio Cesar Vitorino 
* @since 19/09/2019 15:14:57
* @copyright(c), Julio Vitorino <julio.vitorino@gmail.com>
*/

class FilaPublicidadeConstantes
{
   /* definição para colunas do banco de dados */
   const COL_FIPU_ID = 'FIPU_ID';
   const COL_USPU_ID = 'USPU_ID';
   const COL_USUA_ID = 'USUA_ID';
   const COL_JOBS_ID = 'JOBS_ID';
   const COL_FIPU_IN_STATUS = 'FIPU_IN_STATUS';
   const COL_FIPU_DT_CADASTRO = 'FIPU_DT_CADASTRO';
   const COL_FIPU_DT_UPDATE = 'FIPU_DT_UPDATE';

   /* definição para campos do FilaPublicidadeDTO */
   const DTO_ID = 'id';
   const DTO_ID_USUA_PUBLIC = 'id_usua_public';
   const DTO_ID_USUARIO = 'id_usuario';
   const DTO_ID_JOB = 'id_job';
   const DTO_STATUS = 'status';
   const DTO_DATACADASTRO = 'dataCadastro';
   const DTO_DATAATUALIZACAO = 'dataAtualizacao';

   /* definição de tamanhos para os campos */
   const LEN_ID = 11;
   const LEN_ID_USUA_PUBLIC = 11;
   const LEN_ID_USUARIO = 11;
   const LEN_ID_JOB = 11;
   const LEN_STATUS = 1;
   const LEN_DATACADASTRO = 19;
   const LEN_DATAATUALIZACAO = 19;

   /* descritivo dos campos */
   const DESC_ID = 'ID Fila Publicidade';
   const DESC_ID_USUA_PUBLIC = 'ID Usuário x Publicidade';
   const DESC_ID_USUARIO = 'ID do Usuário';
   const DESC_ID_JOB = 'ID do Job';
   const DESC_STATUS = 'Status';
   const DESC_DATACADASTRO = 'Data de Cadastro';
   const DESC_DATAATUALIZACAO = 'Data de Atualização';

}


?>
