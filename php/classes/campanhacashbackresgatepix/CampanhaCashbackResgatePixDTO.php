<?php
// importar dependencias
require_once '../dto/DTOPadraoEntidade.php';
/**
* CampanhaCashbackResgatePixDTO - Data Transfer Object
*
* @author Julio Cesar Vitorino 
* @since 26/07/2021 15:11:48
* @copyright(c), Julio Vitorino <julio.vitorino@gmail.com>
*/
class CampanhaCashbackResgatePixDTO extends DTOPadraoEntidade implements JsonSerializable
{
    public $idUsuarioDevedor;
    public $idUsuarioSolicitante;
    public $tipoChavePix;
    public $tipoChavePixDesc;
    public $chavePix;
    public $valorResgate;
    public $valorResgateCurrency;
    public $autenticacaoBco;
    public $estagioRealTime;
    public $estagioRealTimeDesc;
    public $dtEstagioAnalise;
    public $dtEstagioFinanceiro;
    public $dtEstagioErro;
    public $dtEstagioTranfBco;
    public $txtLivreEstagioRT;

    public function jsonSerialize()
    {
        return 
            [
                'id' => $this->id,
                'idUsuarioDevedor' => $this->idUsuarioDevedor,
                'idUsuarioSolicitante' => $this->idUsuarioSolicitante,
                'tipoChavePix' => $this->tipoChavePix,
                'tipoChavePixDesc' => $this->tipoChavePixDesc,
                'chavePix' => $this->chavePix,
                'valorResgate' => $this->valorResgate,
                'valorResgateCurrency' => $this->valorResgateCurrency,
                'autenticacaoBco' => $this->autenticacaoBco,
                'estagioRealTime' => $this->estagioRealTime,
                'estagioRealTimeDesc' => $this->estagioRealTimeDesc,
                'dtEstagioAnalise' => $this->dtEstagioAnalise,
                'dtEstagioFinanceiro' => $this->dtEstagioFinanceiro,
                'dtEstagioErro' => $this->dtEstagioErro,
                'dtEstagioTranfBco' => $this->dtEstagioTranfBco,
                'txtLivreEstagioRT' => $this->txtLivreEstagioRT,
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
