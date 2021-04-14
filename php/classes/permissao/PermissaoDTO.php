<?php

require_once '../dto/DTOPadrao.php';

/**
 * PermissaoDTO - Data Transfer Object
 */
class PermissaoDTO extends DTOPadrao implements JsonSerializable
{
    public $status;
    public $funcionalidade;
    public $periodicidade;
    public $periodicidadestr;
	public $qtdepermitida;

    public function jsonSerialize()
    {
        return 
        [
            'periodicidade' => $this->periodicidade,
            'funcionalidade' => $this->funcionalidade,
            'periodicidadestr' => $this->periodicidadestr,
            'qtdepermitida' => $this->qtdepermitida,
            'status' => $this->status,
            'msgcode' => $this->msgcode,
            'msgcodeString' => $this->msgcodeString
        ];
    }	

}

?>