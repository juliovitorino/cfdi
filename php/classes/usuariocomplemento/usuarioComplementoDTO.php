<?php

// importar dependencias
require_once '../dto/DTOPadraoEntidade.php';

/**
* UsuarioComplementoDTO - Data Transfer Object
*
* @author Julio Vitorino <julio.vitorino@gmail.com>
* @copyright 2019-2019 The JCV Group
*/
class UsuarioComplementoDTO extends DTOPadraoEntidade implements JsonSerializable
{
    public $id;
    public $id_usuario;
    public $nomeReceitaFederal;
    public $website;
    public $facebook;
    public $instagram;
    public $pinterest;
    public $skype;
    public $twitter;
    public $facetime;
    public $img1;
    public $img2;
    public $img3;
    public $descricaoLivre;
    public $status;
    public $dataCadastro;
    public $dataAtualizacao;

    public function jsonSerialize()
    {
        return 
        [
            'id' => $this->id,
            'id_usuario' => $this->id_usuario,
            'nomeReceitaFederal' => $this->nomeReceitaFederal,
            'website' => $this->website,
            'facebook' => $this->facebook,
            'instagram' => $this->instagram,
            'pinterest' => $this->pinterest,
            'skype' => $this->skype,
            'twitter' => $this->twitter,
            'facetime' => $this->facetime,
            'img1' => $this->img1,
            'img2' => $this->img2,
            'img3' => $this->img3,
            'descricaoLivre' => $this->descricaoLivre,
            'status' => $this->status,
            'statusdesc' => $this->statusdesc,
            'dataCadastro' => $this->dataCadastro,
            'dataAtualizacao' => $this->dataAtualizacao,
            'msgcode' => $this->msgcode,
            'msgcodeString' => $this->msgcodeString
        ];
    }   
}
?>











