<?php

// importar dependencias
require_once '../dto/DTOPadrao.php';

/**
 * ProjetoBeneficioDTO - Data Transfer Object
 */
class EstatisticaFuncaoDTO extends DTOPadrao implements JsonSerializable
{
	public $id;
	public $usuarioid;
	public $projetoid;
	public $ano;
	public $mes;
	public $dia;
	public $tipo;
	public $qtde;
	public $dataCadastro;
	public $dataAtualizacao;


    public function jsonSerialize()
    {
        return 
        [
            'id'   => $this->id,
			'usuarioid' => $this->usuarioid,
			'projetoid' => $this->projetoid,
			'ano' => $this->ano,
			'mes' => $this->mes,
			'dia' => $this->dia,
			'tipo' => $this->tipo,
			'dataCadastro' => $this->dataCadastro,
			'dataAtualizacao' => $this->dataAtualizacao,
            'msgcode' => $this->msgcode,
            'msgcodeString' => $this->msgcodeString
        ];
    }	


}
?>
