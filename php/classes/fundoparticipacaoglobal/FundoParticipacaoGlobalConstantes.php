<?php 
/**
*
* FundoParticipacaoGlobalConstantes - Classe de constantes estáticas com definições para uso na classe de negócio FundoParticipacaoGlobal
*
* Não é uma camada visível para outros dispositivos, como as camadas de apresentação e aplicação. 
*
* Todos os métodos DEVEM ser declarados como estáticos
*
* Changelog:
* 
* @author Julio Cesar Vitorino 
* @since 18/08/2021 12:15:16
* @copyright(c), Julio Vitorino <julio.vitorino@gmail.com>
*/

class FundoParticipacaoGlobalConstantes
{
   /* definição para colunas do banco de dados */
   const COL_FPGL_ID = 'FPGL_ID';
   const COL_USUA_ID = 'USUA_ID';
   const COL_USUA_ID_BONIFICADO = 'USUA_ID_BONIFICADO';
   const COL_PLUF_ID = 'PLUF_ID';
   const COL_FPGL_IN_TIPO = 'FPGL_IN_TIPO';
   const COL_FPGL_VL_TRANSACAO = 'FPGL_VL_TRANSACAO';
   const COL_FPGL_TX_DESCRICAO = 'FPGL_TX_DESCRICAO';
   const COL_FPGL_IN_STATUS = 'FPGL_IN_STATUS';
   const COL_FPGL_DT_CADASTRO = 'FPGL_DT_CADASTRO';
   const COL_FPGL_DT_UPDATE = 'FPGL_DT_UPDATE';

   /* definição para campos do FundoParticipacaoGlobalDTO */
   const DTO_ID = 'id';
   const DTO_IDUSUARIOPARTICIPANTE = 'idUsuarioParticipante';
   const DTO_IDUSUARIOBONIFICADO = 'idUsuarioBonificado';
   const DTO_IDPLANOFATURA = 'idPlanoFatura';
   const DTO_TIPOMOVIMENTO = 'tipoMovimento';
   const DTO_VALORTRANSACAO = 'valorTransacao';
   const DTO_DESCRICAO = 'descricao';
   const DTO_STATUS = 'status';
   const DTO_DATACADASTRO = 'dataCadastro';
   const DTO_DATAATUALIZACAO = 'dataAtualizacao';

   /* definição de tamanhos para os campos */
   const LEN_ID = 11;
   const LEN_IDUSUARIOPARTICIPANTE = 11;
   const LEN_IDUSUARIOBONIFICADO = 11;
   const LEN_IDPLANOFATURA = 11;
   const LEN_TIPOMOVIMENTO = 1;
   const LEN_VALORTRANSACAO = 10;
   const LEN_DESCRICAO = 500;
   const LEN_STATUS = 1;
   const LEN_DATACADASTRO = 19;
   const LEN_DATAATUALIZACAO = 19;

   /* definição de tamanhos para os campos */
   const DESC_ID = 'ID da Conta Corrente Cashback';
   const DESC_IDUSUARIOPARTICIPANTE = 'ID do usuário participante';
   const DESC_IDUSUARIOBONIFICADO = 'ID do usuário bonificado';
   const DESC_IDPLANOFATURA = 'ID do plano fatura do usuário';
   const DESC_TIPOMOVIMENTO = 'Tipo do movimento';
   const DESC_VALORTRANSACAO = 'Valor do crédito ou débito';
   const DESC_DESCRICAO = 'descrição';
   const DESC_STATUS = 'Status';
   const DESC_DATACADASTRO = 'Data de Cadastro';
   const DESC_DATAATUALIZACAO = 'Data de Atualização';

}


?>
