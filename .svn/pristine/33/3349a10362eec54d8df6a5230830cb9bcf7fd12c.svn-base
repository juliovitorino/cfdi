<?php

// importar dependências
require_once '../dto/DTOPadrao.php';

/**
 * PlanoUsuarioFaturaDTO - Data Transfer Object
 */

class FakeDTO extends DTOPadrao implements JsonSerializable
{
	public $nome;
	public $sobrenome;
	public $email;

	function __construct()	{	}


    public function jsonSerialize()
    {
        return 
        [
            'nome'   => $this->nome,
            'sobrenome'   => $this->sobrenome,
            'email'   => $this->email,
            'msgcode' => $this->msgcode,
            'msgcodeString' => $this->msgcodeString
        ];
    }	

}

?>
