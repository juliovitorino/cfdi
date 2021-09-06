<?php
/**
*
* UsuarioTipoEmpreendimentoService - Interfaces dos servicos para Classe de negócio com métodos para apoiar a integridade de informações sobre relação usuario x tipo de empreendimento gerenciado pela plataforma
* Interface de Serviços UsuarioTipoEmpreendimento - camada responsável pela lógica de negócios de UsuarioTipoEmpreendimento do sistema. 
* Não é uma camada visível para outros dispositivos, como as camadas de apresentação e aplicação. 
*
* Por exemplo: quando estamos prestes a sacar dinheiro em um caixa eletrônico, 
* a condição primordial para isto acontecer é que exista saldo na sua conta. 
* Ou seja, é a camada que contém a lógica de como o sistema trabalha 
* como o negócio transcorre.
*
* Responsabilidades dessa classe
*
* 1) Abrir um contexto transacional com a fábrica de banco de dados
* 2) Abrir uma comunicação com as classes de negócio (Business classes)
* 3) Receber o retorno e decidir sobre o commit() ou rollback()
*
* Changelog:
*
*
* 
* @autor Julio Cesar Vitorino
* @since 06/09/2021 09:56:34
*
*/

// importar dependências

require_once '../interfaces/AppService.php';

interface UsuarioTipoEmpreendimentoService extends AppService
{

    public function autalizarStatusUsuarioTipoEmpreendimento($id, $status);
    public function listarUsuarioTipoEmpreendimentoPorStatus($status='A', $pag=1, $qtde=0, $coluna=1, $ordem=0);
    public function listarUsuarioTipoEmpreendimentoPorUsuaIdStatus($usuaid, $status='A', $pag=1, $qtde=0, $coluna=1, $ordem=0);
    public function cancelar($dto);
    public function pesquisarMaxPKAtivoIdusuarioPorStatus($idUsuario,$status);

    public function pesquisarPorIdusuario($idUsuario);
    public function pesquisarPorIdtipoempreendimento($idTipoEmpreendimento);

    public function atualizarIdusuarioPorPK($idUsuario,$id);
    public function atualizarIdtipoempreendimentoPorPK($idTipoEmpreendimento,$id);

}


?>
