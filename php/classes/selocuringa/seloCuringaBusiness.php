<?php

/**
*
* SeloCuringaBusiness - Interface dos métodos de negócio para classe SeloCuringa
* Camada de negócio SeloCuringa - camada responsável pela lógica de negócios de SeloCuringa do sistema. 
* Não é uma camada visível para outros dispositivos, como as camadas de apresentação e aplicação. 
*
*
* Responsabilidades dessa classe
*
* 1) Receber o pedido de uma classe de negócio do sistema
* 2) Produzir a regra de negócio de acordo com cada método
* 3) Acessar o banco de dados através das interfaces DAOs
* 4) Verificar o resultado e retornar um objeto e uma mensagem de alto nível para a camada de serviço
*
* Changelog:
*
* 
* @autor Julio Cesar Vitorino
* @since 23/08/2019 11:13:11
*
*/


// importar dependências
require_once '../interfaces/BusinessObject.php';

interface SeloCuringaBusiness extends BusinessObject
{
    public function atualizarStatus($daofactory, $id, $status);
    public function listarSeloCuringaPorStatus($daofactory, $status, $pag, $qtde, $coluna, $ordem);
    public function validarTamanhoCampo($campo, $tamanho, $coment);
}

?>
