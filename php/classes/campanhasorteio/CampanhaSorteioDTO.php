<?php
// importar dependencias
require_once '../dto/DTOPadraoEntidade.php';

/**
* CampanhaSorteioDTO - Data Transfer Object
*
* @author Julio Cesar Vitorino 
* @since 16/06/2021 12:57:19
* @copyright(c), Julio Vitorino <julio.vitorino@gmail.com>
*/
class CampanhaSorteioDTO extends DTOPadraoEntidade implements JsonSerializable
{
    public $id;
    public $id_campanha;
    public $nome;
    public $urlRegulamento;
    public $premio;
    public $dataComecoSorteio;
    public $dataFimSorteio;
    public $maxTickets;
    public $status;
    public $dataCadastro;
    public $dataAtualizacao;

    public function jsonSerialize()
    {
        return 
        [
            'id' => $this->id,
            'id_campanha' => $this->id_campanha,
            'nome' => $this->nome,
            'urlRegulamento' => $this->urlRegulamento,
            'premio' => $this->premio,
            'dataComecoSorteio' => $this->dataComecoSorteio,
            'dataFimSorteio' => $this->dataFimSorteio,
            'maxTickets' => $this->maxTickets,
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











