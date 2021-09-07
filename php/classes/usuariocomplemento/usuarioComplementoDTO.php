<?php
// importar dependencias
require_once '../dto/DTOPadraoEntidade.php';
/**
* UsuarioComplementoDTO - Data Transfer Object
*
* @author Julio Cesar Vitorino 
* @since 07/09/2021 10:21:34
* @copyright(c), Julio Vitorino <julio.vitorino@gmail.com>
*/
class UsuarioComplementoDTO extends DTOPadraoEntidade implements JsonSerializable
{
    public $idUsuario;
    public $ddd;
    public $telefone;
    public $nomeReceitaFederal;
    public $nomeResponsavel;
    public $urlsite;
    public $urlFacebook;
    public $urlInstagram;
    public $urlPinterest;
    public $urlSkype;
    public $urlTwitter;
    public $urlFacetime;
    public $urlResponsavel;
    public $urlFoto2;
    public $urlFoto3;
    public $descLivre;

    public function jsonSerialize()
    {
        return 
        [
            'id' => $this->id,
            'idUsuario' => $this->idUsuario,
            'ddd' => $this->ddd,
            'telefone' => $this->telefone,
            'nomeReceitaFederal' => $this->nomeReceitaFederal,
            'nomeResponsavel' => $this->nomeResponsavel,
            'urlsite' => $this->urlsite,
            'urlFacebook' => $this->urlFacebook,
            'urlInstagram' => $this->urlInstagram,
            'urlPinterest' => $this->urlPinterest,
            'urlSkype' => $this->urlSkype,
            'urlTwitter' => $this->urlTwitter,
            'urlFacetime' => $this->urlFacetime,
            'urlResponsavel' => $this->urlResponsavel,
            'urlFoto2' => $this->urlFoto2,
            'urlFoto3' => $this->urlFoto3,
            'descLivre' => $this->descLivre,
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

