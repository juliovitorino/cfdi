<?php
// importar dependencias
require_once '../dto/DTOPadraoEntidade.php';
/**
* UsuarioAutorizadorDTO - Data Transfer Object
*
* @author Julio Cesar Vitorino 
* @since 09/09/2019 12:52:36
* @copyright(c), Julio Vitorino <julio.vitorino@gmail.com>
*/
class UsuarioAutorizadorDTO extends DTOPadraoEntidade implements JsonSerializable
{
    public $id;
    public $id_usuario;
    public $usuario;
    public $id_autorizador;
    public $autorizador;
    public $id_campanha;
    public $tipo;
    public $tipostr;
    public $permissao;
    public $permissaostr;
    public $dataInicio;
    public $dataTermino;
    public $status;
    public $dataCadastro;
    public $dataAtualizacao;

    public function jsonSerialize()
    {
        return 
        [
            'id' => $this->id,
            'id_usuario' => $this->id_usuario,
            'usuario' => $this->usuario == NULL ? NULL : $this->usuario->jsonSerialize(),
            'id_autorizador' => $this->id_autorizador,
            'autorizador' => $this->autorizador == NULL ? NULL : $this->autorizador->jsonSerialize(),
            'id_campanha' => $this->id_campanha,
            'tipo' => $this->tipo,
            'tipostr' => $this->tipostr,
            'permissao' => $this->permissao,
            'permissaostr' => $this->permissaostr,
            'dataInicio' => $this->dataInicio,
            'dataTermino' => $this->dataTermino,
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











