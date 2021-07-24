<?php
// importar dependencias
require_once 'CartaoMoverHistoricoDTO.php';

/**
* CartaoMoverHistoricoDTO - Data Transfer Object
*
* @author Julio Cesar Vitorino 
* @since 24/07/2021 10:20:31
* @copyright(c), Julio Vitorino <julio.vitorino@gmail.com>
*/
class CartaoMoverHistoricoFullDTO extends CartaoMoverHistoricoDTO implements JsonSerializable
{
    public $cartao;
    public $usuarioDoador;
    public $usuarioReceptor;

    public function jsonSerialize()
    {
        return 
        [
            'id' => $this->id,
            'idCartao' => $this->idCartao,
            'idUsuarioDoador' => $this->idUsuarioDoador,
            'idUsuarioReceptor' => $this->idUsuarioReceptor,
            'cartao'   => $this->cartao == NULL ? NULL : $this->cartao->jsonSerialize(),
            'usuarioDoador' => $this->usuarioDoador == NULL ? NULL : $this->usuarioDoador->jsonSerialize(),
            'usuarioReceptor' => $this->usuarioReceptor == NULL ? NULL : $this->usuarioReceptor->jsonSerialize(),
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
