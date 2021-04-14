<?php 
/**
*
* CampanhaTopDezConstantes - Classe de constantes estáticas com definições para uso na classe de negócio CampanhaTopDez
*
* Não é uma camada visível para outros dispositivos, como as camadas de apresentação e aplicação. 
*
* Todos os métodos DEVEM ser declarados como estáticos
*
* Changelog:
* 
* @author Julio Cesar Vitorino 
* @since 19/09/2019 08:36:54
* @copyright(c), Julio Vitorino <julio.vitorino@gmail.com>
*/

class CampanhaTopDezConstantes
{
   /* definição para colunas do banco de dados */
   const COL_CATO_ID = 'CATO_ID';
   const COL_CAMP_ID = 'CAMP_ID';
   const COL_USUA_ID = 'USUA_ID';
   const COL_CATO_QT_PARTICIPACAO = 'CATO_QT_PARTICIPACAO';
   const COL_CATO_IN_STATUS = 'CATO_IN_STATUS';
   const COL_CATO_DT_CADASTRO = 'CATO_DT_CADASTRO';
   const COL_CATO_DT_UPDATE = 'CATO_DT_UPDATE';

   /* definição para campos do CampanhaTopDezDTO */
   const DTO_ID = 'id';
   const DTO_ID_CAMPANHA = 'id_campanha';
   const DTO_ID_USUARIO = 'id_usuario';
   const DTO_QTDE = 'qtde';
   const DTO_STATUS = 'status';
   const DTO_DATACADASTRO = 'dataCadastro';
   const DTO_DATAATUALIZACAO = 'dataAtualizacao';
    
}


?>
