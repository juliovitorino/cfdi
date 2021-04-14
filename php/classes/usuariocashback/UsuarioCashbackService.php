<?php
/**
*
* UsuarioCashbackService - Interfaces dos servicos para Classe de negócio com métodos para apoiar a integridade de informações sobre o  cashback do usuário  gerenciado pela plataforma
* Interface de Serviços UsuarioCashback - camada responsável pela lógica de negócios de UsuarioCashback do sistema. 
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
* @since 06/09/2019 08:43:34
*
*/

// importar dependências

require_once '../interfaces/AppService.php';

interface UsuarioCashbackService extends AppService
{

    public function autalizarStatusUsuarioCashback($id, $status);
    public function listarUsuarioCashbackPorStatus($status='A', $pag=1, $qtde=0, $coluna=1, $ordem=0);
    public function listarUsuarioCashbackPorUsuaIdStatus($usuaid, $status='A', $pag=1, $qtde=0, $coluna=1, $ordem=0);
    public function cancelar($dto);
    public function PesquisarMaxPKAtivoId_UsuarioPorStatus($id_usuario,$status);

    public function pesquisarPorId_Usuario($id_usuario);
    public function pesquisarPorVlminimoresgate($vlMinimoResgate);
    public function pesquisarPorPercentual($percentual);
    public function pesquisarPorObs($obs);
    public function pesquisarPorContadorstar_1($contadorStar_1);
    public function pesquisarPorContadorstar_2($contadorStar_2);
    public function pesquisarPorContadorstar_3($contadorStar_3);
    public function pesquisarPorContadorstar_4($contadorStar_4);
    public function pesquisarPorContadorstar_5($contadorStar_5);
    public function pesquisarPorRatingcalculado($ratingCalculado);

    public function atualizarId_UsuarioPorPK($id_usuario,$id);
    public function atualizarVlminimoresgatePorPK($vlMinimoResgate,$id);
    public function atualizarPercentualPorPK($percentual,$id);
    public function atualizarObsPorPK($obs,$id);
    public function atualizarContadorstar_1PorPK($contadorStar_1,$id);
    public function atualizarContadorstar_2PorPK($contadorStar_2,$id);
    public function atualizarContadorstar_3PorPK($contadorStar_3,$id);
    public function atualizarContadorstar_4PorPK($contadorStar_4,$id);
    public function atualizarContadorstar_5PorPK($contadorStar_5,$id);
    public function atualizarRatingcalculadoPorPK($ratingCalculado,$id);

}


?>
