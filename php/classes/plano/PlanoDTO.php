<?php
// importar dependencias
require_once '../dto/DTOPadraoEntidade.php';
/**
* PlanosDTO - Data Transfer Object
*
* @author Julio Cesar Vitorino 
* @since 08/09/2021 14:02:30
* @copyright(c), Julio Vitorino <julio.vitorino@gmail.com>
*/
class PlanoDTO extends DTOPadraoEntidade implements JsonSerializable
{
    public $nome;
    public $permissao;
	public $lstpermissao = [];
    public $valor;
    public $valorMoeda;
    public $tipo;
    public $lstrecursos = [];

    public function jsonSerialize()
    {
        return 
        [
            'id' => $this->id,
            'nome' => $this->nome,
            'permissao' => $this->permissao,
            'lstpermissao' => $this->lstpermissao,
            'valor' => $this->valor,
            'valorMoeda' => $this->valorMoeda,
            'tipo' => $this->tipo,
            'lstrecursos' => $this->lstrecursos,
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
