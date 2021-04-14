<?php
/**
*
* SeloCuringaService - Interfaces dos servicos para Classe de negócio com métodos para apoiar a integridade de informações sobre os selos curingas usados pela plataforma
* Interface de Serviços SeloCuringa - camada responsável pela lógica de negócios de SeloCuringa do sistema. 
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
* @since 23/08/2019 11:13:11
*
*/

// importar dependências

require_once '../interfaces/AppService.php';

interface SeloCuringaService extends AppService
{
    public function autalizarStatusSeloCuringa($id, $status);
    public function listarSeloCuringaPorStatus($status, $pag=1, $qtde=0, $coluna=1, $ordem=0);
    public function cancelar($dto);
}


?>
