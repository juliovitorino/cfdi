<?php 


/**
*
* UsuarioCampanhaSorteioConstantes - Classe de constantes estáticas com definições para uso na classe de negócio UsuarioCampanhaSorteio
*
* Não é uma camada visível para outros dispositivos, como as camadas de apresentação e aplicação. 
*
* Todos os métodos DEVEM ser declarados como estáticos
*
* Changelog:
* 
* @author Julio Cesar Vitorino 
* @since 22/06/2021 08:05:45
* @copyright(c), Julio Vitorino <julio.vitorino@gmail.com>
*/

class UsuarioCampanhaSorteioConstantes
{
   /* definição para colunas do banco de dados */
   const COL_USCS_ID = 'USCS_ID';
   const COL_USUA_ID = 'USUA_ID';
   const COL_CASO_ID = 'CASO_ID';
   const COL_USCS_IN_STATUS = 'USCS_IN_STATUS';
   const COL_USCS_DT_CADASTRO = 'USCS_DT_CADASTRO';
   const COL_USCS_DT_UPDATE = 'USCS_DT_UPDATE';

   /* definição para campos do UsuarioCampanhaSorteioDTO */
   const DTO_ID = 'id';
   const DTO_IDUSUARIO = 'idUsuario';
   const DTO_IDCAMPANHASORTEIO = 'idCampanhaSorteio';
   const DTO_STATUS = 'status';
   const DTO_DATACADASTRO = 'dataCadastro';
   const DTO_DATAATUALIZACAO = 'dataAtualizacao';

   /* definição de tamanhos para os campos */
   const LEN_ID = 11;
   const LEN_IDUSUARIO = 11;
   const LEN_IDCAMPANHASORTEIO = 11;
   const LEN_STATUS = 1;
   const LEN_DATACADASTRO = 19;
   const LEN_DATAATUALIZACAO = 19;

   /* definição de tamanhos para os campos */
   const DESC_ID = 'ID Usuario Campanha Sorteio';
   const DESC_IDUSUARIO = 'ID do usuário';
   const DESC_IDCAMPANHASORTEIO = 'ID Campanha Sorteio';
   const DESC_STATUS = 'Status';
   const DESC_DATACADASTRO = 'Data de Cadastro';
   const DESC_DATAATUALIZACAO = 'Data de Atualização';

}


?>
