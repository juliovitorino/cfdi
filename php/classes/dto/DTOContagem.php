<?php

/**
 * DTOContagem - Retorno de mensagens padrão ao invocador
 */
class DTOContagem extends DTOPadrao implements JsonSerializable
{
    public $contador;

    public function jsonSerialize()
    {
        return 
        [
            'contador'   => $this->contador,
            'msgcode'   => $this->msgcode,
            'msgcodeString' => $this->msgcodeString
        ];
    }	
}

?>