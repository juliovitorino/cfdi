<?php

// importar dependencias
require_once '../dto/DTOPadraoEntidade.php';

/**
 * Data Transfer Object
 *
 * @category   php.classes
 * @package    campanhaqrcode
 * @author     Julio Vitorino <julio.vitorino@gmail.com>
 * @copyright  2019-2019 The JCV Group
 * @license    http://www.php.net/license/3_01.txt  PHP License 3.01
 * @version    Release: @package_version@
 * @link       http://pear.php.net/package/PackageName
 * @see        NetOther, Net_Sample::Net_Sample()
 * @since      27/05/2019
 * @deprecated Class deprecated in Release 2.0.0
 */
class CampanhaQrCodeDTO extends DTOPadraoEntidade implements JsonSerializable
{
	public $id_campanha;
	public $qrcodecarimbo;
	public $qrcodecarimboImpressao;
    public $ticket;
    public $parent;
    public $order;
    public $idusuarioGerador;

    public function jsonSerialize()
    {
        return 
        [
            'id'   => $this->id,
            'id_campanha' => $this->id_campanha,
            'qrcodecarimbo' => $this->qrcodecarimbo,
            'qrcodecarimboImpressao' => $this->qrcodecarimboImpressao,
            'ticket' => $this->ticket,
            'parent' => $this->parent,
            'order' => $this->order,
            'idusuarioGerador' => $this->idusuarioGerador,
			'status' => $this->status,
			'dataCadastro' => $this->dataCadastro,
			'dataAtualizacao' => $this->dataAtualizacao,
            'msgcode' => $this->msgcode,
            'msgcodeString' => $this->msgcodeString
        ];
    }	


}
?>
