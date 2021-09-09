<?php 

// importar dependencias
require_once 'ufBusiness.php';

require_once '../dto/DTOPadrao.php';
require_once '../dto/DTOPaginacao.php';

require_once '../variavel/ConstantesVariavel.php';
require_once '../variavel/VariavelCache.php';

/**
* UfBusinessImpl - Implementação da classe de negocio
*/
class UfBusinessImpl implements UfBusiness
{
    
    function __construct()  {   }

    public function carregar($daofactory, $dto) {   }
    public function listarTudo($daofactory) {   }

    public function atualizar($daofactory, $dto)    
    {   
        // retorno default
        $retorno = new DTOPadrao();
        $retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
        $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);


            $dao = $daofactory->getUfDAO($daofactory);
            if(!$dao->update($dto)){
                $retorno->msgcode = ConstantesMensagem::ERRO_CRUD_ATUALIZAR_REGISTRO;
                $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);
    
            }
        // retorna situação
        return $retorno;

    }
    
    public function deletar($daofactory, $dto)  
    {   
        $dao = $daofactory->getUfDAO($daofactory);
        return $dao->delete($dto);
    }

    public function listarUfsPorStatus($daofactory, $status)
    {   
        $dao = $daofactory->getUfDAO($daofactory);
        return $dao->listUfsStatus($status);
    }
    public function listarPagina($daofactory, $pag, $qtde)  
    {   
        $dao = $daofactory->getUfDAO($daofactory);
        return $dao->listPagina($pag, $qtde);
    }

    public function carregarPorID($daofactory, $id)
    { 
        $dao = $daofactory->getUfDAO($daofactory);
        return $dao->loadPK($id);
    }
    public function atualizarStatus($daofactory, $id, $status)
    {
        $dao = $daofactory->getUfDAO($daofactory);


        // resposta padrão
        $retorno = new DTOPadrao();

        // obtem o status atual da campanha
        $dto = $this->carregarPorID($daofactory, $id);

            if($dao->updateStatus($id, $status)){   
                $retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
            }       

        // Obtem o texto da mensagem em razão do código de retorno
        $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);

        return $retorno;
    }
    public function inserir($daofactory, $dto)
    { 
        $ok = false;

        // Monta a regra do QRCode da Uf

        $dto->status = ConstantesVariavel::STATUS_ATIVO;
        $dao = $daofactory->getUfDAO($daofactory);

        $retorno = new DTOPadrao();
        if ($dao->insert($dto)) {
            $ok = true;
        }

        if ($ok) {
            $retorno = new DTOPadrao();
            $retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
            $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);
        } else {
            $retorno = new DTOPadrao();
            $retorno->msgcode = ConstantesMensagem::ERRO_INESPERADO;
            $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);
        }

        return $retorno;
    }

public function listarUfPorStatus($daofactory, $status, $pag, $qtde, $coluna, $ordem)
    {   
        $retorno = new DTOPaginacao();
        $retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
        $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);

        $dao = $daofactory->getUfDAO($daofactory);
        $retorno->pagina = $pag;
        $retorno->itensPorPagina = ($qtde == 0 
        ? (int) VariavelCache::getInstance()->getVariavel(ConstantesVariavel::MAXIMO_LINHAS_POR_PAGINA_DEFAULT)
        : $qtde);
        $retorno->totalPaginas = ceil($dao->countUfPorStatus($status) / $retorno->itensPorPagina);

        if($pag > $retorno->totalPaginas) {
            $retorno->msgcode = ConstantesMensagem::NAO_EXISTEM_MAIS_PAGINAS_APRESENTAR;
            $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);
            return $retorno;
        }
        $retorno->lst = $dao->listUfPorStatus($status, $pag, $retorno->itensPorPagina, $coluna, $ordem);

        return $retorno;
    }

}
?>
