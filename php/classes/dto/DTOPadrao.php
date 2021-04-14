<?php

/**
 * DTOPadrao - Retorno de mensagens padrão ao invocador
 */
class DTOPadrao implements JsonSerializable
{
	public $msgcode;
	public $msgcodeString;


    public function jsonSerialize()
    {
        return 
        [
            'msgcode'   => $this->msgcode,
            'msgcodeString' => $this->msgcodeString
        ];
    }	
}

?>