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
class CfdiDTO extends DTOPadraoEntidade implements JsonSerializable
{
    public $id_fiel;
    public $id_campanha;
	public $qrcode;
    public $modo;
    public $valorTicketMedioCarimbo;
    public $idUsuarioAutorizador;
    public $usuarioAutorizador;

    public function jsonSerialize()
    {
        return 
        [
            'id'   => $this->id,
            'id_fiel' => $this->id_fiel,
            'id_campanha' => $this->id_campanha,
            'qrcode' => $this->qrcode,
            'modo' => $this->modo,
            'valorTicketMedioCarimbo' => $this->valorTicketMedioCarimbo,
            'idUsuarioAutorizador' => $this->idUsuarioAutorizador,
            'usuarioAutorizador' => $this->usuarioAutorizador == NULL ? NULL : $this->usuarioAutorizador->jsonSerialize(),
			'status' => $this->status,
			'dataCadastro' => $this->dataCadastro,
			'dataAtualizacao' => $this->dataAtualizacao,
            'msgcode' => $this->msgcode,
            'msgcodeString' => $this->msgcodeString
        ];
    }	


}
?>
