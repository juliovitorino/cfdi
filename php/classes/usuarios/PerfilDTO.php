<?php

require_once '../dto/DTOPadrao.php';

/**
 * UsuarioDTO - Data Transfer Object
 */
class PerfilDTO extends DTOPadrao implements JsonSerializable
{
    public $usuario;
    public $usuarioPlanoAtivo;
    public $usuarioComplemento;

    public function jsonSerialize()
    {
        return 
        [
            'usuario' => $this->usuario == NULL ? NULL : $this->usuario->jsonSerialize(),
            'usuarioPlanoAtivo' => $this->usuarioPlanoAtivo == NULL ? NULL : $this->usuarioPlanoAtivo->jsonSerialize(),
            'usuarioComplemento' => $this->usuarioComplemento == NULL ? NULL : $this->usuarioComplemento->jsonSerialize(),
            'msgcode' => $this->msgcode,
            'msgcodeString' => $this->msgcodeString
        ];
    }	
}

?>