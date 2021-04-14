<?php
// importar dependencias
require_once '../dto/DTOPadraoEntidade.php';
require_once '../util/util.php';

/**
* SaldoGeralCashbackCCDTO - Data Transfer Object
*
* @author Julio Cesar Vitorino 
* @since 01/09/2019 15:12:00
* @copyright(c), Julio Vitorino <julio.vitorino@gmail.com>
*
* Changelog:
*
*/
class SaldoGeralCashbackCCDTO extends DTOPadraoEntidade implements JsonSerializable
{
    public $id;
    public $id_usuario;
    public $usuario;
    public $vlGeralConsumo;
    public $vlsldGeral;
    public $vlGeralConsumoMoeda;
    public $vlsldGeralMoeda;
    public $sldUsuarioDono = [];

    public function jsonSerialize()
    {
        return 
        [
            'id' => $this->id,
            'id_usuario' => $this->id_usuario,
            'usuario' => $this->usuario == NULL ? NULL : $this->usuario->jsonSerialize(),
            'vlGeralConsumo' => $this->vlGeralConsumo,
            'vlsldGeral' => $this->vlsldGeral,
            'vlGeralConsumoMoeda' => $this->vlGeralConsumoMoeda,
            'vlsldGeralMoeda' => $this->vlsldGeralMoeda,
            'sldUsuarioDono' => $this->sldUsuarioDono,
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
