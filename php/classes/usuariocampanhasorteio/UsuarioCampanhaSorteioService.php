<?php
/**
*
* UsuarioCampanhaSorteioService - Interfaces dos servicos para Classe de negócio com métodos para apoiar a integridade de informações sobre usuários participantes de sorteios em campanhas gerenciado pela plataforma
* Interface de Serviços UsuarioCampanhaSorteio - camada responsável pela lógica de negócios de UsuarioCampanhaSorteio do sistema. 
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
* @since 22/06/2021 08:05:45
*
*/

// importar dependências

require_once '../interfaces/AppService.php';

interface UsuarioCampanhaSorteioService extends AppService
{

    public function autalizarStatusUsuarioCampanhaSorteio($id, $status);
    public function listarUsuarioCampanhaSorteioPorStatus($status='A', $pag=1, $qtde=0, $coluna=1, $ordem=0);
    public function listarUsuarioCampanhaSorteioPorUsuaIdStatus($usuaid, $status='A', $pag=1, $qtde=0, $coluna=1, $ordem=0);
    public function cancelar($dto);
    public function pesquisarMaxPKAtivoIdusuarioPorStatus($idUsuario,$status);

    public function pesquisarPorIdusuario($idUsuario);
    public function pesquisarPorIdcampanhasorteio($idCampanhaSorteio);
    //public function pesquisarPorStatus($status);

    public function atualizarIdusuarioPorPK($idUsuario,$id);
    public function atualizarIdcampanhasorteioPorPK($idCampanhaSorteio,$id);
    //public function atualizarStatusPorPK($status,$id);

}


?>
