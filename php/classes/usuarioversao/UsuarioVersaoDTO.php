<?php

// importar dependencias
require_once '../dto/DTOPadraoEntidade.php';

/**
* UsuarioVersaoDTO - Data Transfer Object
*
* @author Julio Cesar Vitorino 
* @since 06/10/2019 16:44:47
* @copyright(c), Julio Vitorino <julio.vitorino@gmail.com>
*/
class UsuarioVersaoDTO extends DTOPadraoEntidade implements JsonSerializable
{
    public $id;
    public $id_versao;
    public $versao;
    public $id_usuario;
    public $status;
    public $dataCadastro;
    public $dataAtualizacao;

    public function jsonSerialize()
    {
        return 
        [
            'id' => $this->id,
            'id_versao' => $this->id_versao,
            'id_usuario' => $this->id_usuario,
            'versao' => $this->versao == NULL ? NULL : $this->versao->jsonSerialize(),
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
