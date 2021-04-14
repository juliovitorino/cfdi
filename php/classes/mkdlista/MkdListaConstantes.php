<?php 

/**
*
* MkdListaConstantes - Classe de constantes estáticas com definições para uso na classe de negócio MkdLista
*
* Não é uma camada visível para outros dispositivos, como as camadas de apresentação e aplicação. 
*
* Todos os métodos DEVEM ser declarados como estáticos
*
* Changelog:
* 
* @author Julio Cesar Vitorino 
* @since 04/11/2019 09:31:13
* @copyright(c), Julio Vitorino <julio.vitorino@gmail.com>
*/

class MkdListaConstantes
{
   /* definição para colunas do banco de dados */
   const COL_MKEL_ID = 'MKEL_ID';
   const COL_MKCE_ID = 'MKCE_ID';
   const COL_MKEL_TX_NOME = 'MKEL_TX_NOME';
   const COL_MKEL_TX_EMAIL = 'MKEL_TX_EMAIL';
   const COL_MKEL_TX_PRIM_NOME = 'MKEL_TX_PRIM_NOME';
   const COL_MKEL_TX_SOBRENOME = 'MKEL_TX_SOBRENOME';
   const COL_MKEL_TX_WHATSAPP = 'MKEL_TX_WHATSAPP';
   const COL_MKEL_TX_HASH = 'MKEL_TX_HASH';
   const COL_MKEL_IN_STATUS = 'MKEL_IN_STATUS';
   const COL_MKEL_DT_CADASTRO = 'MKEL_DT_CADASTRO';
   const COL_MKEL_DT_UPDATE = 'MKEL_DT_UPDATE';

   /* definição para campos do MkdListaDTO */
   const DTO_ID = 'id';
   const DTO_ID_MKD_CAMPANHA = 'id_mkd_campanha';
   const DTO_NOME = 'nome';
   const DTO_EMAIL = 'email';
   const DTO_PRIMEIRONOME = 'primeiroNome';
   const DTO_SOBRENOME = 'sobrenome';
   const DTO_WHATSAPP = 'whatsapp';
   const DTO_HASHLEAD = 'hashlead';
   const DTO_STATUS = 'status';
   const DTO_DATACADASTRO = 'dataCadastro';
   const DTO_DATAATUALIZACAO = 'dataAtualizacao';

   /* definição de tamanhos para os campos */
   const LEN_ID = 11;
   const LEN_ID_MKD_CAMPANHA = 11;
   const LEN_NOME = 200;
   const LEN_EMAIL = 100;
   const LEN_PRIMEIRONOME = 100;
   const LEN_SOBRENOME = 100;
   const LEN_WHATSAPP = 15;
   const LEN_HASHLEAD = 100;
   const LEN_STATUS = 1;
   const LEN_DATACADASTRO = 19;
   const LEN_DATAATUALIZACAO = 19;

   /* definição de tamanhos para os campos */
   const DESC_ID = 'ID da MKD Lista';
   const DESC_ID_MKD_CAMPANHA = 'ID da Campanha MKD';
   const DESC_NOME = 'Nome';
   const DESC_EMAIL = 'Email';
   const DESC_PRIMEIRONOME = 'Primeiro Nome';
   const DESC_SOBRENOME = 'Sobrenome';
   const DESC_WHATSAPP = 'Contato Whatsapp';
   const DESC_HASHLEAD = 'Hashcode lead';
   const DESC_STATUS = 'Status';
   const DESC_DATACADASTRO = 'Data de Cadastro';
   const DESC_DATAATUALIZACAO = 'Data de Atualização';

}


?>
