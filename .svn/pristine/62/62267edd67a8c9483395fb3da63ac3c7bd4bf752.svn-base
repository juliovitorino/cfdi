<?php  

// importar dependencias
require_once 'traceDTO.php';
require_once 'traceServiceImpl.php';

require_once '../variavel/ConstantesVariavel.php';
require_once '../variavel/VariavelCache.php';

/**
 * 
 */
class TraceHelper
{
	
	function __construct()	{	}

	public static function traceLog($nivel, $tipo, $descricao)
	{
        if(VariavelCache::getInstance()->getVariavel(ConstantesVariavel::TRACE_ON) == ConstantesVariavel::ATIVADO &&
        VariavelCache::getInstance()->getVariavel(ConstantesVariavel::TRACE_LEVEL) == $nivel
        ){
            // Trace
            $dto = new TraceDTO();
            
            $dto->tipo = $tipo;
            $dto->descricao = VariavelCache::getInstance()->getVariavel(ConstantesVariavel::TRACE_LEVEL) 
                            . $descricao;
            
            $csi = new TraceServiceImpl();
            $retorno = $csi->cadastrar($dto);
        }
    }
}

?>