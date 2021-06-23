<?php
// importar dependencias
require_once '../dto/DTOPadraoEntidade.php';
require_once '../usuarios/UsuarioDTO.php';

/**
* RegistroIndicacaoDTO - Data Transfer Object
*
* @author Julio Cesar Vitorino 
* @since 23/06/2021 14:44:26
* @copyright(c), Julio Vitorino <julio.vitorino@gmail.com>
*/
class RegistroIndicacaoDTO extends DTOPadraoEntidade implements JsonSerializable
{
    public $id;
    public $idUsuarioPromotor;
    public $idUsuarioIndicado;
    public $usuarioPromotor;
    public $usuarioIndicado;
    public $status;
    public $dataCadastro;
    public $dataAtualizacao;

    public function jsonSerialize()
    {
        return 
        [
            'id' => $this->id,
            'idUsuarioPromotor' => $this->idUsuarioPromotor,
            'idUsuarioIndicado' => $this->idUsuarioIndicado,
            'usuarioPromotor' => $this->usuarioPromotor == NULL ? NULL : $this->usuarioPromotor->jsonSerialize(),
            'usuarioIndicado' => $this->usuarioIndicado == NULL ? NULL : $this->usuarioIndicado->jsonSerialize(),
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

