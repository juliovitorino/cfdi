Selecionar as colunas copiar e colar no notepad e depois colocar no vscode e remover os tabs

<?php 

// importar dependencias
require_once 'usuarioTipoEmpreendimentoBusiness.php';

require_once '../dto/DTOPadrao.php';
require_once '../dto/DTOPaginacao.php';

require_once '../variavel/ConstantesVariavel.php';
require_once '../variavel/VariavelCache.php';

/**
* UsuarioTipoEmpreendimentoBusinessImpl - Implementação da classe de negocio
*/
class UsuarioTipoEmpreendimentoBusinessImpl implements UsuarioTipoEmpreendimentoBusiness
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


            $dao = $daofactory->getUsuarioTipoEmpreendimentoDAO($daofactory);
            if(!$dao->update($dto)){
                $retorno->msgcode = ConstantesMensagem::ERRO_CRUD_ATUALIZAR_REGISTRO;
                $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);
    
            }
        // retorna situação
        return $retorno;

    }
    
    public function deletar($daofactory, $dto)  
    {   
        $dao = $daofactory->getUsuarioTipoEmpreendimentoDAO($daofactory);
        return $dao->delete($dto);
    }

    public function listarUsuarioTipoEmpreendimentosPorStatus($daofactory, $status)
    {   
        $dao = $daofactory->getUsuarioTipoEmpreendimentoDAO($daofactory);
        return $dao->listUsuarioTipoEmpreendimentosStatus($status);
    }
    public function listarPagina($daofactory, $pag, $qtde)  
    {   
        $dao = $daofactory->getUsuarioTipoEmpreendimentoDAO($daofactory);
        return $dao->listPagina($pag, $qtde);
    }

    public function carregarPorID($daofactory, $id)
    { 
        $dao = $daofactory->getUsuarioTipoEmpreendimentoDAO($daofactory);
        return $dao->loadPK($id);
    }
    public function atualizarStatus($daofactory, $id, $status)
    {
        $dao = $daofactory->getUsuarioTipoEmpreendimentoDAO($daofactory);


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

        // Monta a regra do QRCode da UsuarioTipoEmpreendimento

        $dto->status = ConstantesVariavel::STATUS_ATIVO;
        $dao = $daofactory->getUsuarioTipoEmpreendimentoDAO($daofactory);

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

    public function listarUsuarioTipoEmpreendimentoPorStatus($daofactory, $status)
    {
    }
    
}
?>
