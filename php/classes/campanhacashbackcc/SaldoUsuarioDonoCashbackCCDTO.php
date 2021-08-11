<?php
// importar dependencias
require_once '../dto/DTOPadraoEntidade.php';
/**
* SaldoUsuarioDonoCashbackCCDTO - Data Transfer Object
*
* @author Julio Cesar Vitorino 
* @since 01/09/2019 15:12:00
* @copyright(c), Julio Vitorino <julio.vitorino@gmail.com>
*
* Changelog:
*
*/
class SaldoUsuarioDonoCashbackCCDTO extends DTOPadraoEntidade implements JsonSerializable
{
    public $id;
    public $id_usuario;
    public $usuario;
    public $id_dono;
    public $dono;
    public $usca;
    public $vlconsumo;
    public $vlsld;
    public $vlconsumoMoeda;
    public $vlsldMoeda;
    public $cashbackccItem = [];

    public function jsonSerialize()
    {
        return 
        [
            'id' => $this->id,
            'id_usuario' => $this->id_usuario,
            'usuario' => $this->usuario == NULL ? NULL : $this->usuario->jsonSerialize(),
            'id_dono' => $this->id_dono,
            'dono' => $this->dono == NULL ? NULL : $this->dono->jsonSerialize(),
            'usca' => $this->usca == NULL ? NULL : $this->usca->jsonSerialize(),
            'vlconsumo' => $this->vlconsumo,
            'vlsld' => $this->vlsld,
            'vlconsumoMoeda' => $this->vlconsumoMoeda,
            'vlsldMoeda' => $this->vlsldMoeda,
            'cashbackccItem' => $this->cashbackccItem,
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
