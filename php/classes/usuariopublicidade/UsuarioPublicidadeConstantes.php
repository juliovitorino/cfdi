<?php 
/**
*
* UsuarioPublicidadeConstantes - Classe de constantes estáticas com definições para uso na classe de negócio UsuarioPublicidade
*
* Não é uma camada visível para outros dispositivos, como as camadas de apresentação e aplicação. 
*
* Todos os métodos DEVEM ser declarados como estáticos
*
* Changelog:
* 
* @author Julio Cesar Vitorino 
* @since 20/09/2019 13:57:12
* @copyright(c), Julio Vitorino <julio.vitorino@gmail.com>
*/

class UsuarioPublicidadeConstantes
{
   /* definição para colunas do banco de dados */
   const COL_USPU_ID = 'USPU_ID';
   const COL_USUA_ID = 'USUA_ID';
   const COL_USPU_TX_TITULO = 'USPU_TX_TITULO';
   const COL_USPU_TX_DESCRICAO = 'USPU_TX_DESCRICAO';
   const COL_USPU_DT_INICIO = 'USPU_DT_INICIO';
   const COL_USPU_DT_TERMINO = 'USPU_DT_TERMINO';
   const COL_USPU_VL_NORMAL = 'USPU_VL_NORMAL';
   const COL_USPU_VL_PROMO = 'USPU_VL_PROMO';
   const COL_USPU_TX_OBS = 'USPU_TX_OBS';
   const COL_USPU_DT_APAGAR = 'USPU_DT_APAGAR';
   const COL_USPU_IN_STATUS = 'USPU_IN_STATUS';
   const COL_USPU_DT_CADASTRO = 'USPU_DT_CADASTRO';
   const COL_USPU_DT_UPDATE = 'USPU_DT_UPDATE';

   /* definição para campos do UsuarioPublicidadeDTO */
   const DTO_ID = 'id';
   const DTO_ID_USUARIO = 'id_usuario';
   const DTO_TITULO = 'titulo';
   const DTO_DESCRICAO = 'descricao';
   const DTO_DATAINICIO = 'dataInicio';
   const DTO_DATATERMINO = 'dataTermino';
   const DTO_VLNORMAL = 'vlNormal';
   const DTO_VLPROMO = 'vlPromo';
   const DTO_OBSERVACAO = 'observacao';
   const DTO_DATAREMOVER = 'dataRemover';
   const DTO_STATUS = 'status';
   const DTO_DATACADASTRO = 'dataCadastro';
   const DTO_DATAATUALIZACAO = 'dataAtualizacao';

   /* definição de tamanhos para os campos */
   const LEN_ID = 11;
   const LEN_ID_USUARIO = 11;
   const LEN_TITULO = 500;
   const LEN_DESCRICAO = 2000;
   const LEN_DATAINICIO = 19;
   const LEN_DATATERMINO = 19;
   const LEN_VLNORMAL = 10;
   const LEN_VLPROMO = 10;
   const LEN_OBSERVACAO = 2000;
   const LEN_DATAREMOVER = 19;
   const LEN_STATUS = 1;
   const LEN_DATACADASTRO = 19;
   const LEN_DATAATUALIZACAO = 19;

   /* definição de tamanhos para os campos */
   const DESC_ID = 'ID Usuário x Publicidade';
   const DESC_ID_USUARIO = 'ID do usuário';
   const DESC_TITULO = 'Título da publicidade';
   const DESC_DESCRICAO = 'Descrição geral';
   const DESC_DATAINICIO = 'Data de início';
   const DESC_DATATERMINO = 'Data de término';
   const DESC_VLNORMAL = 'Valor do produto/serviço';
   const DESC_VLPROMO = 'Valor promocional produto/serviço';
   const DESC_OBSERVACAO = 'Observação';
   const DESC_DATAREMOVER = 'Data para apagar';
   const DESC_STATUS = 'Status';
   const DESC_DATACADASTRO = 'Data de Cadastro';
   const DESC_DATAATUALIZACAO = 'Data de Atualização';

}


?>
