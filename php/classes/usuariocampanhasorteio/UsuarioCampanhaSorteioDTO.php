<?php
// importar dependencias
require_once '../dto/DTOPadraoEntidade.php';
/**
* UsuarioCampanhaSorteioDTO - Data Transfer Object
*
* @author Julio Cesar Vitorino 
* @since 22/06/2021 08:05:45
* @copyright(c), Julio Vitorino <julio.vitorino@gmail.com>
*/
class UsuarioCampanhaSorteioDTO extends DTOPadraoEntidade implements JsonSerializable
{
    public $idUsuario;
    public $idCampanhaSorteio;
    public $ticket;

public function jsonSerialize()
{
return 
[
   'id' => $this->id,
   'idUsuario' => $this->idUsuario,
   'idCampanhaSorteio' => $this->idCampanhaSorteio,
   'ticket' => $ticket,
   'status' => $this->status,
   'dataCadastro' => $this->dataCadastro,
   'dataAtualizacao' => $this->dataAtualizacao,
   'statusdesc' => $this->statusdesc,
   'msgcode' => $this->msgcode,
   'msgcodeString' => $this->msgcodeString

];
}   


}
?>











