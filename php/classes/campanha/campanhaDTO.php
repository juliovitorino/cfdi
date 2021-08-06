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
class CampanhaDTO extends DTOPadraoEntidade implements JsonSerializable
{
	public $id_usuario;
	public $nome;
	public $textoExplicativo;
	public $dataInicio;
	public $dataTermino;
    public $maximoCartoes;
    public $contadorCartoes;
    public $maximoSelos;
	public $minimoDelay;
    public $QrCodeAtivo;
    public $fraseEfeito;
    public $recompensa;
    public $proximoQrCode;
    public $totalCarimbos;
    public $totalCarimbados;
    public $valorTicketMedioCarimbo;
    public $valorAcmTicketMedio;
    public $valorTicketMedioCarimboMoeda;
    public $valorAcmTicketMedioMoeda;
    public $valorMeta;
    public $valorMetaMoeda;
    public $permiteAlterarMaximoSelos;
    public $permiteCampanhaSorteioJ10;
    public $permiteMoverCartaoEntreUsuario;
    public $permiteBonificarCarimboJ10;
    public $msgAgradecimento;
    public $img;
    public $imgRecompensa;
    public $contadorLike;
    public $contadorStar_1;
    public $contadorStar_2;
    public $contadorStar_3;
    public $contadorStar_4;
    public $contadorStar_5;
    public $ratingCalculado;
    public $permissaoCuringa;
    public $permissaoCashback;

    public function jsonSerialize()
    {
        return 
        [
            'id'   => $this->id,
            'id_usuario' => $this->id_usuario,
            'nome' => $this->nome,
            'textoExplicativo' => $this->textoExplicativo,
            'dataInicio' => $this->dataInicio,
            'dataTermino' => $this->dataTermino,
            'maximoCartoes' => $this->maximoCartoes,
            'contadorCartoes' => $this->contadorCartoes,
            'maximoSelos' => $this->maximoSelos,
            'minimoDelay' => $this->minimoDelay,
            'QrCodeAtivo' => $this->QrCodeAtivo,
            'fraseEfeito' => $this->fraseEfeito,
            'recompensa' => $this->recompensa,
            'proximoQrCode' => $this->proximoQrCode,
            'totalCarimbos' => $this->totalCarimbos,
            'totalCarimbados' => $this->totalCarimbados,
            'valorTicketMedioCarimbo' => $this->valorTicketMedioCarimbo,
            'valorAcmTicketMedio' => $this->valorAcmTicketMedio,
            'valorTicketMedioCarimboMoeda' => $this->valorTicketMedioCarimboMoeda,
            'valorMeta' => $this->valorMeta,
            'valorMetaMoeda' => $this->valorMetaMoeda,
            'valorAcmTicketMedioMoeda' => $this->valorAcmTicketMedioMoeda,
            'msgAgradecimento' => $this->msgAgradecimento,
            'img' => $this->img,
            'imgRecompensa' => $this->imgRecompensa,
            'contadorLike' => $this->contadorLike,
            'contadorStar_1' => $this->contadorStar_1,
            'contadorStar_2' => $this->contadorStar_2,
            'contadorStar_3' => $this->contadorStar_3,
            'contadorStar_4' => $this->contadorStar_4,
            'contadorStar_5' => $this->contadorStar_5,
            'ratingCalculado' => $this->ratingCalculado,
            'permissaoCuringa' => $this->permissaoCuringa,
            'permissaoCashback' => $this->permissaoCashback,
            'status' => $this->status,
			'dataCadastro' => $this->dataCadastro,
			'dataAtualizacao' => $this->dataAtualizacao,
            'msgcode' => $this->msgcode,
            'msgcodeString' => $this->msgcodeString
        ];
    }	


}
?>
