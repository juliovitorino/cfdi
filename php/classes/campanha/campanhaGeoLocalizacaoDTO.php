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
class CampanhaGeoLocalizacaoDTO extends DTOPadraoEntidade implements JsonSerializable
{
	public $nome;
	public $dataInicio;
	public $dataTermino;
    public $latitude;
    public $longitude;
    public $img;
    public $id_usuario;
    public $usuario;

    public function jsonSerialize()
    {
        return 
        [
            'id'   => $this->id,
            'nome' => $this->nome,
            'dataInicio' => $this->dataInicio,
            'dataTermino' => $this->dataTermino,
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
            'img' => $this->img,
            'id_usuario' => $this->id_usuario,
            'usuario' => $this->usuario == NULL ? NULL : $this->usuario->jsonSerialize(),
            'status' => $this->status,
			'dataCadastro' => $this->dataCadastro,
			'dataAtualizacao' => $this->dataAtualizacao,
            'msgcode' => $this->msgcode,
            'msgcodeString' => $this->msgcodeString
        ];
    }	


}
?>
