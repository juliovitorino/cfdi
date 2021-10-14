<?php 


/**
*
* TipoEmpreendimentoConstantes - Classe de constantes estáticas com definições para uso na classe de negócio TipoEmpreendimento
*
* Não é uma camada visível para outros dispositivos, como as camadas de apresentação e aplicação. 
*
* Todos os métodos DEVEM ser declarados como estáticos
*
* Changelog:
* 
* @author Julio Cesar Vitorino 
* @since 06/09/2021 08:28:01
* @copyright(c), Julio Vitorino <julio.vitorino@gmail.com>
*/

class TipoEmpreendimentoConstantes
{
   /* definição para colunas do banco de dados */
   const COL_TIEM_ID = 'TIEM_ID';
   const COL_TIEM_TX_DESCRICAO = 'TIEM_TX_DESCRICAO';
   const COL_TIEM_TX_IMG = 'TIEM_TX_IMG';
   const COL_TIEM_IN_STATUS = 'TIEM_IN_STATUS';
   const COL_TIEM_DT_CADASTRO = 'TIEM_DT_CADASTRO';
   const COL_TIEM_DT_UPDATE = 'TIEM_DT_UPDATE';

   /* definição para campos do TipoEmpreendimentoDTO */
   const DTO_ID = 'id';
   const DTO_DESCRICAO = 'descricao';
   const DTO_URLIMG = 'urlimg';
   const DTO_STATUS = 'status';
   const DTO_DATACADASTRO = 'dataCadastro';
   const DTO_DATAATUALIZACAO = 'dataAtualizacao';

   /* definição de tamanhos para os campos */
   const LEN_ID = 11;
   const LEN_DESCRICAO = 200;
   const LEN_URLIMG = 2000;
   const LEN_STATUS = 1;
   const LEN_DATACADASTRO = 19;
   const LEN_DATAATUALIZACAO = 19;

   /* definição de tamanhos para os campos */
   const DESC_ID = 'ID do tipo de empreendimento';
   const DESC_DESCRICAO = 'Descrição tipo de empreendimento';
   const DESC_URLIMG = 'URL da imagem tipo de empreendimento';
   const DESC_STATUS = 'Status';
   const DESC_DATACADASTRO = 'Data de Cadastro';
   const DESC_DATAATUALIZACAO = 'Data de Atualização';

}


?>
