<?php

// importar dependencias
require_once '../dto/DTOPadrao.php';

/**
 * ProjetoBeneficioDTO - Data Transfer Object
 */
class EmailDTO
{
	
	public $destinatario;
	public $emaildestinatario;
	public $assunto;
	public $template;
	public $lsttags;

	public function jsonSerialize()
    {
        return 
            [
                'destinatario' => $this->destinatario,
                'emaildestinatario' => $this->emaildestinatario,
                'assunto' => $this->assunto,
                'template' => $this->template,
                'lsttags' => $this->lsttags,
            ];
    }   



}
?>
