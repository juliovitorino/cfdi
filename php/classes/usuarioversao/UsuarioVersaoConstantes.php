<?php 

/**
*
* UsuarioVersaoConstantes - Classe de constantes estáticas com definições para uso na classe de negócio UsuarioVersao
*
* Não é uma camada visível para outros dispositivos, como as camadas de apresentação e aplicação. 
*
* Todos os métodos DEVEM ser declarados como estáticos
*
* Changelog:
* 
* @author Julio Cesar Vitorino 
* @since 06/10/2019 16:44:47
* @copyright(c), Julio Vitorino <julio.vitorino@gmail.com>
*/

class UsuarioVersaoConstantes
{
   /* definição para colunas do banco de dados */
   const COL_USVE_ID = 'USVE_ID';
   const COL_VERS_ID = 'VERS_ID';
   const COL_USUA_ID = 'USUA_ID';
   const COL_USVE_IN_STATUS = 'USVE_IN_STATUS';
   const COL_USVE_DT_CADASTRO = 'USVE_DT_CADASTRO';
   const COL_USVE_DT_UPDATE = 'USVE_DT_UPDATE';

   /* definição para campos do UsuarioVersaoDTO */
   const DTO_ID = 'id';
   const DTO_ID_VERSAO = 'id_versao';
   const DTO_ID_USUARIO = 'id_usuario';
   const DTO_STATUS = 'status';
   const DTO_DATACADASTRO = 'dataCadastro';
   const DTO_DATAATUALIZACAO = 'dataAtualizacao';

   /* definição de tamanhos para os campos */
   const LEN_ID = 11;
   const LEN_ID_VERSAO = 11;
   const LEN_ID_USUARIO = 11;
   const LEN_STATUS = 1;
   const LEN_DATACADASTRO = 19;
   const LEN_DATAATUALIZACAO = 19;

   /* definição de tamanhos para os campos */
   const DESC_ID = 'ID Versão Usuário';
   const DESC_ID_VERSAO = 'ID da versão';
   const DESC_ID_USUARIO = 'ID do usuário';
   const DESC_STATUS = 'Status';
   const DESC_DATACADASTRO = 'Data de Cadastro';
   const DESC_DATAATUALIZACAO = 'Data de Atualização';

}


?>
