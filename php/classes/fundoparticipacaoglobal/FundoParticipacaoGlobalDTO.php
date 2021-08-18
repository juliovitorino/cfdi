<?php
// importar dependencias
require_once '../dto/DTOPadraoEntidade.php';
/**
* FundoParticipacaoGlobalDTO - Data Transfer Object
*
* @author Julio Cesar Vitorino 
* @since 18/08/2021 11:48:22
* @copyright(c), Julio Vitorino <julio.vitorino@gmail.com>
*/
class FundoParticipacaoGlobalDTO extends DTOPadraoEntidade implements JsonSerializable
{
    public $idUsuarioParticipante;
    public $idUsuarioBonificado;
    public $idPlanoFatura;
    public $tipoMovimento;
    public $valorTransacao;
    public $descricao;

    public function jsonSerialize()
    {
        return 
        [
            'id' => $this->id,
            'idUsuarioParticipante' => $this->idUsuarioParticipante,
            'idUsuarioBonificado' => $this->idUsuarioBonificado,
            'idPlanoFatura' => $this->idPlanoFatura,
            'tipoMovimento' => $this->tipoMovimento,
            'valorTransacao' => $this->valorTransacao,
            'descricao' => $this->descricao,
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











