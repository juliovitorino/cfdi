<?php

require_once '../dto/DTOPadrao.php';

/**
 * DashboardDTO - Data Transfer Object
 */
class DashboardDTO extends DTOPadrao implements JsonSerializable
{
	public $usuario;
    public $urlfoto;

    public function jsonSerialize()
    {
        return 
        [
            'usuario'   => $this->usuario,
            'urlfoto'   => $this->urlfoto,
            'msgcode' => $this->msgcode,
            'msgcodeString' => $this->msgcodeString
        ];
    }	
}

?>