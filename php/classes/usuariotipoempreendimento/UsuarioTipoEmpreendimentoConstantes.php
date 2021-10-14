<?php 


/**
*
* UsuarioTipoEmpreendimentoConstantes - Classe de constantes estáticas com definições para uso na classe de negócio UsuarioTipoEmpreendimento
*
* Não é uma camada visível para outros dispositivos, como as camadas de apresentação e aplicação. 
*
* Todos os métodos DEVEM ser declarados como estáticos
*
* Changelog:
* 
* @author Julio Cesar Vitorino 
* @since 06/09/2021 09:56:34
* @copyright(c), Julio Vitorino <julio.vitorino@gmail.com>
*/

class UsuarioTipoEmpreendimentoConstantes
{
   /* definição para colunas do banco de dados */
   const COL_USTE_ID = 'USTE_ID';
   const COL_USUA_ID = 'USUA_ID';
   const COL_TIEM_ID = 'TIEM_ID';
   const COL_USTE_IN_STATUS = 'USTE_IN_STATUS';
   const COL_USTE_DT_CADASTRO = 'USTE_DT_CADASTRO';
   const COL_USTE_DT_UPDATE = 'USTE_DT_UPDATE';

   /* definição para campos do UsuarioTipoEmpreendimentoDTO */
   const DTO_ID = 'id';
   const DTO_IDUSUARIO = 'idUsuario';
   const DTO_IDTIPOEMPREENDIMENTO = 'idTipoEmpreendimento';
   const DTO_STATUS = 'status';
   const DTO_DATACADASTRO = 'dataCadastro';
   const DTO_DATAATUALIZACAO = 'dataAtualizacao';

   /* definição de tamanhos para os campos */
   const LEN_ID = 11;
   const LEN_IDUSUARIO = 11;
   const LEN_IDTIPOEMPREENDIMENTO = 11;
   const LEN_STATUS = 1;
   const LEN_DATACADASTRO = 19;
   const LEN_DATAATUALIZACAO = 19;

   /* definição de tamanhos para os campos */
   const DESC_ID = 'ID do usuário tipo empreendimento';
   const DESC_IDUSUARIO = 'ID do usuário';
   const DESC_IDTIPOEMPREENDIMENTO = 'ID do tipo do empreendimento';
   const DESC_STATUS = 'Status';
   const DESC_DATACADASTRO = 'Data de Cadastro';
   const DESC_DATAATUALIZACAO = 'Data de Atualização';

}


?>
