<?php

require_once '../interfaces/AppService.php';

/**
 * MensagemService - Interface de serviços
 */
interface MensagemService extends AppService
{
	public function listarTodasMensagens($status);

}


?>