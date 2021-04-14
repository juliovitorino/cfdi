<?php
/**
*
* FilaPublicidadeService - Interfaces dos servicos para Classe de negócio com métodos para apoiar a integridade de informações sobre fila de publicidades gerenciado pela plataforma
* Interface de Serviços FilaPublicidade - camada responsável pela lógica de negócios de FilaPublicidade do sistema. 
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
* @since 19/09/2019 15:17:09
*
*/

// importar dependências

require_once '../interfaces/AppService.php';

interface FilaPublicidadeService extends AppService
{

    public function autalizarStatusFilaPublicidade($id, $status);
    public function listarFilaPublicidadePorStatus($status='A', $pag=1, $qtde=0, $coluna=1, $ordem=0);
    public function listarFilaPublicidadePorUsuaIdStatus($usuaid, $status='A', $pag=1, $qtde=0, $coluna=1, $ordem=0);
    public function cancelar($dto);
    public function PesquisarMaxPKAtivoId_Usua_PublicPorStatus($id_usua_public,$status);

    public function pesquisarPorId_Usua_Public($id_usua_public);
    public function pesquisarPorId_Usuario($id_usuario);
    public function pesquisarPorId_Job($id_job);
    public function pesquisarPorStatus($status);

    public function atualizarId_Usua_PublicPorPK($id_usua_public,$id);
    public function atualizarId_UsuarioPorPK($id_usuario,$id);
    public function atualizarId_JobPorPK($id_job,$id);
    public function atualizarStatusPorPK($status,$id);

}


?>
