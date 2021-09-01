<?php
// importar dependencias
require_once '../dto/DTOPadraoEntidade.php';
/**
* FilaEmailDTO - Data Transfer Object
*
* @author Julio Cesar Vitorino 
* @since 01/09/2021 15:29:49
* @copyright(c), Julio Vitorino <julio.vitorino@gmail.com>
*/
class FilaEmailDTO extends DTOPadraoEntidade implements JsonSerializable
{
    public $nomeFila;
    public $emailDe;
    public $email;
    public $prioridade;
    public $nrMaxTentativas;
    public $nrRealTentativas;
    public $dataPrevisaoEnvio;
    public $dataRealEnvio;

    public function jsonSerialize()
    {
        return 
            [
                'id' => $this->id,
                'nomeFila' => $this->nomeFila,
                'emailDe' => $this->emailDe,
                'email' => $this->email == NULL ? NULL : $this->email->jsonSerialize(),
                'prioridade' => $this->prioridade,
                'nrMaxTentativas' => $this->nrMaxTentativas,
                'nrRealTentativas' => $this->nrRealTentativas,
                'dataPrevisaoEnvio' => $this->dataPrevisaoEnvio,
                'dataRealEnvio' => $this->dataRealEnvio,
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











