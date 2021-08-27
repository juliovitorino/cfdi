<?php 


/**
*
* GrupoUsuarioConstantes - Classe de constantes estáticas com definições para uso na classe de negócio GrupoUsuario
*
* Não é uma camada visível para outros dispositivos, como as camadas de apresentação e aplicação. 
*
* Todos os métodos DEVEM ser declarados como estáticos
*
* Changelog:
* 
* @author Julio Cesar Vitorino 
* @since 22/08/2021 17:02:50
* @copyright(c), Julio Vitorino <julio.vitorino@gmail.com>
*/

class GrupoUsuarioConstantes
{
   /* definição para colunas do banco de dados */
   const COL_GRUS_ID = 'GRUS_ID';
   const COL_GRAD_ID = 'GRAD_ID';
   const COL_USUA_ID = 'USUA_ID';
   const COL_GRUS_IN_STATUS = 'GRUS_IN_STATUS';
   const COL_GRUS_DT_CADASTRO = 'GRUS_DT_CADASTRO';
   const COL_GRUS_DT_UPDATE = 'GRUS_DT_UPDATE';

   /* definição para campos do GrupoUsuarioDTO */
   const DTO_ID = 'id';
   const DTO_IDGRAD = 'idgrad';
   const DTO_ID_USUARIO = 'id_usuario';
   const DTO_STATUS = 'status';
   const DTO_DATACADASTRO = 'dataCadastro';
   const DTO_DATAATUALIZACAO = 'dataAtualizacao';

   /* definição de tamanhos para os campos */
   const LEN_ID = 11;
   const LEN_IDGRAD = 11;
   const LEN_ID_USUARIO = 11;
   const LEN_STATUS = 1;
   const LEN_DATACADASTRO = 19;
   const LEN_DATAATUALIZACAO = 19;

   /* definição de tamanhos para os campos */
   const DESC_ID = 'ID grupo admin x usuário';
   const DESC_IDGRAD = 'ID grupo administração';
   const DESC_ID_USUARIO = 'ID do usuário';
   const DESC_STATUS = 'Status';
   const DESC_DATACADASTRO = 'Data de Cadastro';
   const DESC_DATAATUALIZACAO = 'Data de Atualização';

}


?>

