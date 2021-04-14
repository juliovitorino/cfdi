<?php

// importar dependencias
require_once '../dto/DTOPadraoEntidade.php';

/**
 * Data Transfer Object
 *
 * @category   php.classes
 * @package    campanha
 * @author     Julio Vitorino <julio.vitorino@gmail.com>
 * @copyright  2019-2019 The JCV Group
 * @license    http://www.php.net/license/3_01.txt  PHP License 3.01
 * @version    Release: @package_version@
 * @link       http://pear.php.net/package/PackageName
 * @see        NetOther, Net_Sample::Net_Sample()
 * @since      27/05/2019
 * @deprecated Class deprecated in Release 2.0.0
 */
class CartaoDTO extends DTOPadraoEntidade implements JsonSerializable
{
    public $id_usuario;
    public $id_campanha;
    public $contador;
    public $carimbos;
    public $favorito;
    public $hashresgate;
    public $dataCompletouCartao;
    public $dataValidouCartao;
    public $dataEntregouRecompensa;
    public $dataConfirmouRecebeuRecompensa;
    public $dataRating;
    public $lstcarimbos = [];
    public $like;
    public $rating;
    public $comentario;
    public $idselocuringa;
    public $selocuringa;
   
    public function jsonSerialize()
    {
        return 
        [
            'id'   => $this->id,
            'id_usuario' => $this->id_usuario,
            'id_campanha' => $this->id_campanha,
            'contador' => $this->contador,
            'carimbos' => $this->carimbos,
            'favorito' => $this->favorito,
            'hashresgate' => $this->hashresgate,
            'dataCompletouCartao' => $this->dataCompletouCartao,
            'dataValidouCartao' => $this->dataValidouCartao,
            'dataEntregouRecompensa' => $this->dataEntregouRecompensa,
            'dataConfirmouRecebeuRecompensa' => $this->dataConfirmouRecebeuRecompensa,
            'dataRating' => $this->dataRating,
            'lstcarimbos' => $this->lstcarimbos,
            'like' => $this->like,
            'rating' => $this->rating,
            'comentario' => $this->comentario,
            'idselocuringa' => $this->idselocuringa,
            'selocuringa' => $this->idselocuringa == 0 ? NULL : $this->selocuringa->jsonSerialize(),
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
