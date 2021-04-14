<?php 
/**
*
* FilaQRCodePendenteProduzirConstantes - Classe de constantes estáticas com definições para uso na classe de negócio FilaQRCodePendenteProduzir
*
* Não é uma camada visível para outros dispositivos, como as camadas de apresentação e aplicação. 
*
* Todos os métodos DEVEM ser declarados como estáticos
*
* Changelog:
* 
* @author Julio Cesar Vitorino 
* @since 26/10/2019 10:27:47
* @copyright(c), Julio Vitorino <julio.vitorino@gmail.com>
*/

class FilaQRCodePendenteProduzirConstantes
{
   /* definição para colunas do banco de dados */
   const COL_FQPP_ID = 'FQPP_ID';
   const COL_CAMP_ID = 'CAMP_ID';
   const COL_USUA_ID = 'USUA_ID';
   const COL_FQPP_NU_QTDE_QRC = 'FQPP_NU_QTDE_QRC';
   const COL_FQPP_IN_STATUS = 'FQPP_IN_STATUS';
   const COL_FQPP_DT_CADASTRO = 'FQPP_DT_CADASTRO';
   const COL_FQPP_DT_UPDATE = 'FQPP_DT_UPDATE';

   /* definição para campos do FilaQRCodePendenteProduzirDTO */
   const DTO_ID = 'id';
   const DTO_ID_CAMPANHA = 'id_campanha';
   const DTO_ID_USUARIO = 'id_usuario';
   const DTO_QTDE = 'qtde';
   const DTO_STATUS = 'status';
   const DTO_DATACADASTRO = 'dataCadastro';
   const DTO_DATAATUALIZACAO = 'dataAtualizacao';

   /* definição de tamanhos para os campos */
   const LEN_ID = 11;
   const LEN_ID_CAMPANHA = 11;
   const LEN_ID_USUARIO = 11;
   const LEN_QTDE = 5;
   const LEN_STATUS = 1;
   const LEN_DATACADASTRO = 19;
   const LEN_DATAATUALIZACAO = 19;

   /* definição de tamanhos para os campos */
   const DESC_ID = 'ID Fila QR Pendente';
   const DESC_ID_CAMPANHA = 'ID da campanha';
   const DESC_ID_USUARIO = 'ID do usuário';
   const DESC_QTDE = 'Qtde QR Code Produzir';
   const DESC_STATUS = 'Status';
   const DESC_DATACADASTRO = 'Data de Cadastro';
   const DESC_DATAATUALIZACAO = 'Data de Atualização';

}


?>
