<?php
// importar dependencias
require_once '../dto/DTOPadraoEntidade.php';

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
CÓDIGO SOFREU ALTERAÇÕES PROFUNDAS, NÃO USE O GERADOR
AUTOMÁTICO PARA SUBSTITUIR O CÓDIGO AQUI EXISTENTE.
TODO O SISTEMA PODE ENTRAR EM COLAPSO.
===========================================================
***********************************************************/ 

/**
* CartaoPedidoDTO - Data Transfer Object
*
* @author Julio Cesar Vitorino 
* @since 17/09/2019 13:56:32
* @copyright(c), Julio Vitorino <julio.vitorino@gmail.com>
*/

class CartaoPedidoDTO extends DTOPadraoEntidade implements JsonSerializable
{
    public $id;
    public $id_campanha;
    public $descpedido;
    public $hashTransacao;
    public $qtde;
    public $selos;
    public $vlrPedido;
    public $vlrPedidoMoeda;
    public $dataAutorizacao;
    public $dataPgto;
    public $vlrPgto;
    public $vlrPgtoMoeda;
    public $hashGtway;
    public $tipo;
    public $status;
    public $dataCadastro;
    public $dataAtualizacao;

    public function jsonSerialize()
    {
        return 
        [
            'id' => $this->id,
            'id_campanha' => $this->id_campanha,
            'descpedido' => $this->descpedido,
            'hashTransacao' => $this->hashTransacao,
            'qtde' => $this->qtde,
            'selos' => $this->selos,
            'vlrPedido' => $this->vlrPedido,
            'dataAutorizacao' => $this->dataAutorizacao,
            'dataPgto' => $this->dataPgto,
            'vlrPgto' => $this->vlrPgto,
            'hashGtway' => $this->hashGtway,
            'tipo' => $this->tipo,
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
