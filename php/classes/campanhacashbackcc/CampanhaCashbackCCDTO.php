<?php

/**********************************************************
===========================================================

 #####  #     #   ###   ######     #    ######   ##### 
#     # #     #    #    #     #   # #   #     # #     #
#       #     #    #    #     #  #   #  #     # #     #
#       #     #    #    #     # #     # #     # #     #
#       #     #    #    #     # ####### #     # #     #
#     # #     #    #    #     # #     # #     # #     #
 #####   #####    ###   ######  #     # ######   #####
 
===========================================================
CÓDIGO SOFREU ALTERAÇÕES DE PROFUNDAS, NÃO USE O GERADOR
AUTOMÁTICO PARA SUBSTITUIR O CÓDIGO AQUI EXISTENTE.
TODO O SISTEMA PODE ENTRAR EM COLAPSO.
===========================================================
***********************************************************/ 

// importar dependencias
require_once '../dto/DTOPadraoEntidade.php';
/**
* CampanhaCashbackCCDTO - Data Transfer Object
*
* @author Julio Cesar Vitorino 
* @since 26/08/2019 16:09:29
* @copyright(c), Julio Vitorino <julio.vitorino@gmail.com>
*
* Changelog:
* 31/08/2019 - Inserção do campo $id_dono
*
*/
class CampanhaCashbackCCDTO extends DTOPadraoEntidade implements JsonSerializable
{
    public $id;
    public $id_cashback;
    public $id_campanha;
    public $id_usuario;
    public $id_dono;
    public $id_cfdi;
    public $descricao;
    public $vlMinimo;
    public $percentual;
    public $vlConsumo;
    public $vlCalcRecompensa;
    public $vlMinimoMoeda;
    public $percentualFmt;
    public $vlConsumoMoeda;
    public $vlCalcRecompensaMoeda;
    public $tipoMovimento;
    public $nfe;
    public $nfehash;
    public $status;
    public $dataCadastro;
    public $dataAtualizacao;

    public function jsonSerialize()
    {
        return 
        [
            'id' => $this->id,
            'id_cashback' => $this->id_cashback,
            'id_campanha' => $this->id_campanha,
            'id_usuario' => $this->id_usuario,
            'id_dono' => $this->id_dono,
            'id_cfdi' => $this->id_cfdi,
            'descricao' => $this->descricao,
            'vlMinimo' => $this->vlMinimo,
            'percentual' => $this->percentual,
            'vlConsumo' => $this->vlConsumo,
            'vlCalcRecompensa' => $this->vlCalcRecompensa,
            'vlMinimoMoeda' => $this->vlMinimoMoeda,
            'percentualFmt' => $this->percentualFmt,
            'vlConsumoMoeda' => $this->vlConsumoMoeda,
            'vlCalcRecompensaMoeda' => $this->vlCalcRecompensaMoeda,
            'tipoMovimento' => $this->tipoMovimento,
            'nfe' => $this->nfe,
            'nfehash' => $this->nfehash,
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
