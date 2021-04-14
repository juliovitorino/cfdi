<?php 
/**
*
* VersaoConstantes - Classe de constantes estáticas com definições para uso na classe de negócio Versao
*
* Não é uma camada visível para outros dispositivos, como as camadas de apresentação e aplicação. 
*
* Todos os métodos DEVEM ser declarados como estáticos
*
* Changelog:
* 
* @author Julio Cesar Vitorino 
* @since 06/10/2019 15:59:51
* @copyright(c), Julio Vitorino <julio.vitorino@gmail.com>
*/

class VersaoConstantes
{
   /* definição para colunas do banco de dados */
   const COL_VERS_ID = 'VERS_ID';
   const COL_VERS_TX_VERSAO = 'VERS_TX_VERSAO';
   const COL_VERS_IN_STATUS = 'VERS_IN_STATUS';
   const COL_VERS_DT_CADASTRO = 'VERS_DT_CADASTRO';
   const COL_VERS_DT_UPDATE = 'VERS_DT_UPDATE';

   /* definição para campos do VersaoDTO */
   const DTO_ID = 'id';
   const DTO_VERSAO = 'versao';
   const DTO_STATUS = 'status';
   const DTO_DATACADASTRO = 'dataCadastro';
   const DTO_DATAATUALIZACAO = 'dataAtualizacao';

   /* definição de tamanhos para os campos */
   const LEN_ID = 11;
   const LEN_VERSAO = 50;
   const LEN_STATUS = 1;
   const LEN_DATACADASTRO = 19;
   const LEN_DATAATUALIZACAO = 19;

   /* definição de tamanhos para os campos */
   const DESC_ID = 'ID da versão';
   const DESC_VERSAO = 'Versão';
   const DESC_STATUS = 'Status';
   const DESC_DATACADASTRO = 'Data de Cadastro';
   const DESC_DATAATUALIZACAO = 'Data de Atualização';

}


?>
