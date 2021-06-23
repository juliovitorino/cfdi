<?php 


/**
*
* RegistroIndicacaoConstantes - Classe de constantes estáticas com definições para uso na classe de negócio RegistroIndicacao
*
* Não é uma camada visível para outros dispositivos, como as camadas de apresentação e aplicação. 
*
* Todos os métodos DEVEM ser declarados como estáticos
*
* Changelog:
* 
* @author Julio Cesar Vitorino 
* @since 23/06/2021 14:44:26
* @copyright(c), Julio Vitorino <julio.vitorino@gmail.com>
*/

class RegistroIndicacaoConstantes
{
   /* definição para colunas do banco de dados */
   const COL_REIN_ID = 'REIN_ID';
   const COL_USUA_ID_PROMOTOR = 'USUA_ID_PROMOTOR';
   const COL_USUA_ID_INDICADO = 'USUA_ID_INDICADO';
   const COL_REIN_IN_STATUS = 'REIN_IN_STATUS';
   const COL_REIN_DT_CADASTRO = 'REIN_DT_CADASTRO';
   const COL_REIN_DT_UPDATE = 'REIN_DT_UPDATE';

   /* definição para campos do RegistroIndicacaoDTO */
   const DTO_ID = 'id';
   const DTO_IDUSUARIOPROMOTOR = 'idUsuarioPromotor';
   const DTO_IDUSUARIOINDICADO = 'idUsuarioIndicado';
   const DTO_STATUS = 'status';
   const DTO_DATACADASTRO = 'dataCadastro';
   const DTO_DATAATUALIZACAO = 'dataAtualizacao';

   /* definição de tamanhos para os campos */
   const LEN_ID = 11;
   const LEN_IDUSUARIOPROMOTOR = 11;
   const LEN_IDUSUARIOINDICADO = 11;
   const LEN_STATUS = 1;
   const LEN_DATACADASTRO = 19;
   const LEN_DATAATUALIZACAO = 19;

   /* definição de tamanhos para os campos */
   const DESC_ID = 'ID Registro Indicação';
   const DESC_IDUSUARIOPROMOTOR = 'ID do usuário Promotor';
   const DESC_IDUSUARIOINDICADO = 'ID do usuário Indicado';
   const DESC_STATUS = 'Status';
   const DESC_DATACADASTRO = 'Data de Cadastro';
   const DESC_DATAATUALIZACAO = 'Data de Atualização';

}


?>

