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
* FilaPublicidadeDTO - Data Transfer Object
*
* @author Julio Cesar Vitorino 
* @since 19/09/2019 15:04:11
* @copyright(c), Julio Vitorino <julio.vitorino@gmail.com>
*/
class FilaPublicidadeDTO extends DTOPadraoEntidade implements JsonSerializable
{
    public $id;
    public $id_usua_public;
    public $usua_public;
    public $id_usuario;
    public $usuario;
    public $id_job;
    public $status;
    public $dataCadastro;
    public $dataAtualizacao;

    public function jsonSerialize()
    {
        return 
        [
            'id' => $this->id,
            'id_usua_public' => $this->id_usua_public,
            'usua_public' => $this->usua_public == NULL ? NULL : $this->usua_public,
            'id_usuario' => $this->id_usuario,
            'usuario' => $this->usuario == NULL ? NULL : $this->usuario,
            'id_job' => $this->id_job,
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
