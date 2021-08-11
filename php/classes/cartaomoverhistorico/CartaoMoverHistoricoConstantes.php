<?php 


/**
*
* CartaoMoverHistoricoConstantes - Classe de constantes estáticas com definições para uso na classe de negócio CartaoMoverHistorico
*
* Não é uma camada visível para outros dispositivos, como as camadas de apresentação e aplicação. 
*
* Todos os métodos DEVEM ser declarados como estáticos
*
* Changelog:
* 
* @author Julio Cesar Vitorino 
* @since 24/07/2021 10:20:31
* @copyright(c), Julio Vitorino <julio.vitorino@gmail.com>
*/

class CartaoMoverHistoricoConstantes
{
   /* definição para colunas do banco de dados */
   const COL_CAMH_ID = 'CAMH_ID';
   const COL_CART_ID = 'CART_ID';
   const COL_USUA_ID_DE = 'USUA_ID_DE';
   const COL_USUA_ID_PARA = 'USUA_ID_PARA';
   const COL_CAMH_IN_STATUS = 'CAMH_IN_STATUS';
   const COL_CAMH_DT_CADASTRO = 'CAMH_DT_CADASTRO';
   const COL_CAMH_DT_UPDATE = 'CAMH_DT_UPDATE';

   /* definição para campos do CartaoMoverHistoricoDTO */
   const DTO_ID = 'id';
   const DTO_IDCARTAO = 'idCartao';
   const DTO_IDUSUARIODOADOR = 'idUsuarioDoador';
   const DTO_IDUSUARIORECEPTOR = 'idUsuarioReceptor';
   const DTO_STATUS = 'status';
   const DTO_DATACADASTRO = 'dataCadastro';
   const DTO_DATAATUALIZACAO = 'dataAtualizacao';

   /* definição de tamanhos para os campos */
   const LEN_ID = 11;
   const LEN_IDCARTAO = 11;
   const LEN_IDUSUARIODOADOR = 11;
   const LEN_IDUSUARIORECEPTOR = 11;
   const LEN_STATUS = 1;
   const LEN_DATACADASTRO = 19;
   const LEN_DATAATUALIZACAO = 19;

   /* definição de tamanhos para os campos */
   const DESC_ID = 'ID do hsitorico cartão transferido';
   const DESC_IDCARTAO = 'ID do cartão';
   const DESC_IDUSUARIODOADOR = 'ID do usuário doador';
   const DESC_IDUSUARIORECEPTOR = 'ID do usuário receptor';
   const DESC_STATUS = 'Status';
   const DESC_DATACADASTRO = 'Data de Cadastro';
   const DESC_DATAATUALIZACAO = 'Data de Atualização';

}


?>
