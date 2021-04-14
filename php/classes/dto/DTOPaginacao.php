<?php

/**
 * DTOPadraoPaginacao - Retorno de mensagens padrão ao invocador
 */
class DTOPaginacao extends DTOPadrao implements JsonSerializable
{
    public $pagina;
    public $itensPorPagina;
    public $totalPaginas;
    public $lst = [];

    public function jsonSerialize()
    {
        return 
        [
            'pagina'   => $this->pagina,
            'itensPorPagina'   => $this->itensPorPagina,
            'totalPaginas'   => $this->totalPaginas,
            'lst'   => $this->lst,
            'msgcode'   => $this->msgcode,
            'msgcodeString' => $this->msgcodeString
        ];
    }	
}

?>