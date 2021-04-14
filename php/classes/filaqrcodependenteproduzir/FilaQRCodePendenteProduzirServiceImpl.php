<?php

//importar dependencias
require_once 'FilaQRCodePendenteProduzirService.php';
require_once 'FilaQRCodePendenteProduzirBusinessImpl.php';
require_once '../variavel/ConstantesVariavel.php';
require_once '../variavel/VariavelCache.php';
require_once '../mensagem/ConstantesMensagem.php';
require_once '../mensagem/MensagemCache.php';

require_once '../daofactory/DAOFactory.php';


/**
*
* FilaQRCodePendenteProduzirServiceImpl - Implementação dos servicos para Classe de negócio com métodos para apoiar a integridade de informações sobre QRCodes Pendentes de Produzir gerenciado pela plataforma
* Camada de Serviços FilaQRCodePendenteProduzir - camada responsável pela lógica de negócios de FilaQRCodePendenteProduzir do sistema. 
* Não é uma camada visível para outros dispositivos, como as camadas de apresentação e aplicação. 
*
* Por exemplo: quando estamos prestes a sacar dinheiro em um caixa eletrônico, 
* a condição primordial para isto acontecer é que exista saldo na sua conta. 
* Ou seja, é a camada que contém a lógica de como o sistema trabalha 
* como o negócio transcorre.
*
* Responsabilidades dessa classe
*
* 1) Abrir um contexto transacional com a fábrica de banco de dados
* 2) Abrir uma comunicação com as classes de negócio (Business classes)
* 3) Receber o retorno e decidir sobre o commit() ou rollback()
*
* Changelog:
*
*
* 
* @author Julio Cesar Vitorino
* @since 26/10/2019 10:27:47
*
*/
class FilaQRCodePendenteProduzirServiceImpl implements FilaQRCodePendenteProduzirService
{
    
    function __construct() {    }

/**
*
* listarTudo() - Usado para invocar a classe de negócio FilaQRCodePendenteProduzirBusinessImpl de forma geral
* para listar todos os registros sem critérios de paginação dos dados.
*
* Use este método com MUITA moderação.
*/

    public function listarTudo() {  }
    public function pesquisar($dto){ }
    public function apagar($dto) { }
    public function cancelar($dto) { }

/**
*
* PesquisarMaxPKAtivoIdPorStatus() - Usado para invocar a classe de negócio FilaQRCodePendenteProduzirBusinessImpl de forma geral
* a buscar a MAIOR PK pra um dado status.
*
* @param status
* @return FilaQRCodePendenteProduzirDTO
*
*/

public function pesquisarMaxPKAtivoId_CampanhaPorStatus($id_campanha,$status)
{
    $daofactory = NULL;
    $retorno = NULL;
    try {
        $daofactory = DAOFactory::getDAOFactory();
        $daofactory->open();
        $daofactory->beginTransaction();
        
       $bo = new FilaQRCodePendenteProduzirBusinessImpl();
       $retorno = $bo->pesquisarMaxPKAtivoId_CampanhaPorStatus($daofactory, $id_campanha,$status);
       if ($retorno->msgcode == ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO) {
            $daofactory->commit();
        } else {
            $daofactory->rollback();
        }
        
    } catch (Exception $e) {
        // rollback na transação
        $daofactory->rollback();
    } finally {
        try {
            $daofactory->close();
        } catch (Exception $e) {
            // faz algo
        }
    }

    return $retorno;
}

/**
*
* atualizar() - Usado para invocar a classe de negócio FilaQRCodePendenteProduzirBusinessImpl de forma geral
* para gerenciar as regras de negócio do sistema.
*
* @param FilaQRCodePendenteProduzirDTO contendo dados para enviar para atualização
* @return uma instância de FilaQRCodePendenteProduzirDTO com resultdo da operação
*
*/

    public function atualizar($dto)
    {
        $daofactory = NULL;
        $retorno = NULL;
        try {
            $daofactory = DAOFactory::getDAOFactory();
            $daofactory->open();
            $daofactory->beginTransaction();
            
           $bo = new FilaQRCodePendenteProduzirBusinessImpl();
           $retorno = $bo->atualizar($daofactory, $dto);
           if ($retorno->msgcode == ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO) {
                $daofactory->commit();
            } else {
                $daofactory->rollback();
            }
            
        } catch (Exception $e) {
            // rollback na transação
            $daofactory->rollback();
        } finally {
            try {
                $daofactory->close();
            } catch (Exception $e) {
                // faz algo
            }
        }

        return $retorno;
    }


/**
*
* atualizarStatusFilaQRCodePendenteProduzir() - Usado para invocar a classe de negócio FilaQRCodePendenteProduzirBusinessImpl de forma geral
* para gerenciar as atualizações do campo STATUS de acordo as regras de negócio do sistema.
*
* @param $id
* @param $status
* @return uma instância de FilaQRCodePendenteProduzirDTO com resultdo da operação
*
*/


    public function autalizarStatusFilaQRCodePendenteProduzir($id, $status)
    {
        $daofactory = NULL;
        $retorno = NULL;
        try {
            $daofactory = DAOFactory::getDAOFactory();
            $daofactory->open();
            $daofactory->beginTransaction();
            

           $bo = new FilaQRCodePendenteProduzirBusinessImpl();
           $retorno = $bo->atualizarStatus($daofactory, $id, $status);

           if ($retorno->msgcode == ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO){
                $daofactory->commit();
            } else {
                $daofactory->rollback();
            }
            
        } catch (Exception $e) {
            // rollback na transação
            $daofactory->rollback();

        } finally {
            try {
                $daofactory->close();
            } catch (Exception $e) {
                // faz algo
            }
        }

        return $retorno;
    }


/**
*
* cadastrar() - Usado para invocar a classe de negócio FilaQRCodePendenteProduzirBusinessImpl de forma geral
* para gerenciar a criação de registro de acordo as regras de negócio do sistema.
*
* @param $dto - Instância de FilaQRCodePendenteProduzirDTO
*
* @return uma instância de FilaQRCodePendenteProduzirDTO com resultdo da operação
*
*/


    public function cadastrar($dto)
    {
        $daofactory = NULL;
        $retorno = NULL;
        try {
            $daofactory = DAOFactory::getDAOFactory();
            $daofactory->open();
            $daofactory->beginTransaction();
            

           $bo = new FilaQRCodePendenteProduzirBusinessImpl();
           $retorno = $bo->inserir($daofactory, $dto);

           if ($retorno->msgcode == ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO) {
                $daofactory->commit();
            } else {
                $daofactory->rollback();
            }
            
        } catch (Exception $e) {
            // rollback na transação
            $daofactory->rollback();

        } finally {
            try {
                $daofactory->close();
            } catch (Exception $e) {
                // faz algo
            }
        }

        return $retorno;
    }

/**
*
* listarPagina() - Usado para invocar a classe de negócio TipoEmpreendimentoBusinessImpl de forma geral
* para listar todos os registros COM critérios de paginação dos dados.
*
* @param $pag
* @param $qtde
* @return List<FilaQRCodePendenteProduzirDTO>[]
*
*
* Procure dar preferência no uso deste método para listagem de dados
*/


    public function listarPagina($pag, $qtde)
    {
        $daofactory = NULL;
        $retorno = NULL;
        try {
            $daofactory = DAOFactory::getDAOFactory();
            $daofactory->open();
            $daofactory->beginTransaction();
            
            // listar paginado FilaQRCodePendenteProduzir
           $bo = new FilaQRCodePendenteProduzirBusinessImpl();
           $retorno = $bo->listarPagina($daofactory, $pag, $qtde);
            $daofactory->commit();
            
        } catch (Exception $e) {
            // rollback na transação

        } finally {
            try {
                $daofactory->close();
            } catch (Exception $e) {
                // faz algo
            }
        }

        return $retorno;
    }

/**
*
* pesquisarPorID() - Usado para invocar a classe de negócio TipoEmpreendimentoBusinessImpl de forma geral
* realizar uma busca diretamente pela PK (Primary Key) da tabela FILA_QRCODES_PNDNT_PRD campo FQPP_ID
*
* @param $id
* @return FilaQRCodePendenteProduzirDTO
*
* 
*/

    public function pesquisarPorID($id)
    {
        $daofactory = NULL;
        $retorno = NULL;
        try {
            $daofactory = DAOFactory::getDAOFactory();
            $daofactory->open();
            $daofactory->beginTransaction();
            
            // pesquisar pela PK da tabela FilaQRCodePendenteProduzir
           $bo = new FilaQRCodePendenteProduzirBusinessImpl();
           $retorno = $bo->carregarPorID($daofactory, $id);
           if ($retorno->msgcode == ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO){
                $daofactory->commit();
           } else {
                $daofactory->rollback();
           }
            
        } catch (Exception $e) {
            // rollback na transação

        } finally {
            try {
                $daofactory->close();
            } catch (Exception $e) {
                // faz algo
            }
        }

        return $retorno;
    }

/**
*
* listarFilaQRCodePendenteProduzirPorStatus() - Usado para invocar a classe de negócio TipoEmpreendimentoBusinessImpl de forma geral
* realizar lista paginada de registros com uma instância de PaginacaoDTO
*
* @param $status
* @param $pag
* @param $qtde
* @param $coluna
* @param $ordem
* @return $PaginacaoDTO
*/

   public function listarFilaQRCodePendenteProduzirPorStatus($status='A', $pag=1, $qtde=0, $coluna=1, $ordem=0) 
   {
       $daofactory = NULL;
       $retorno = NULL;
       try {
           $daofactory = DAOFactory::getDAOFactory();
           $daofactory->open();
           $daofactory->beginTransaction();

           //Se qtde por página é indefinido (=0) busca valor default do variavel
           if($qtde == 0){
               $qtde = (int) VariavelCache::getInstance()->getVariavel(ConstantesVariavel::MAXIMO_LINHAS_POR_PAGINA_DEFAULT);
           }
           // listar paginado FilaQRCodePendenteProduzir
           $bo = new FilaQRCodePendenteProduzirBusinessImpl();
           $retorno = $bo->listarFilaQRCodePendenteProduzirPorStatus($daofactory, $status, $pag, $qtde, $coluna, $ordem);
           $daofactory->commit();
       } catch (Exception $e) {
           // rollback na transação
        
       } finally {
           try {
               $daofactory->close();
           } catch (Exception $e) {
               // faz algo
           }
       }

       return $retorno;
   }

/**
*
* pesquisarPorId_Campanha() - Usado para invocar a classe de negócio FilaQRCodePendenteProduzirBusinessImpl de forma geral
* realizar uma busca de ID da campanha diretamente na tabela FILA_QRCODES_PNDNT_PRD campo CAMP_ID
*
* @param $id_campanha
* @return FilaQRCodePendenteProduzirDTO
*
* 
*/

    public function pesquisarPorId_Campanha($id_campanha)
    {
        $daofactory = NULL;
        $retorno = NULL;
        try {
            $daofactory = DAOFactory::getDAOFactory();
            $daofactory->open();
            $daofactory->beginTransaction();
            
            // pesquisar pelo atributo FilaQRCodePendenteProduzir.id_campanha no campo CAMP_ID da tabela FILA_QRCODES_PNDNT_PRD
           $bo = new FilaQRCodePendenteProduzirBusinessImpl();
           $retorno = $bo->carregarPorId_Campanha($daofactory, $id_campanha);
           if ($retorno->msgcode == ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO){
                $daofactory->commit();
           } else {
                $daofactory->rollback();
           }
            
        } catch (Exception $e) {
            // rollback na transação

        } finally {
            try {
                $daofactory->close();
            } catch (Exception $e) {
                // faz algo
            }
        }

        return $retorno;
    }

/**
*
* pesquisarPorId_Usuario() - Usado para invocar a classe de negócio FilaQRCodePendenteProduzirBusinessImpl de forma geral
* realizar uma busca de ID do usuário diretamente na tabela FILA_QRCODES_PNDNT_PRD campo USUA_ID
*
* @param $id_usuario
* @return FilaQRCodePendenteProduzirDTO
*
* 
*/

    public function pesquisarPorId_Usuario($id_usuario)
    {
        $daofactory = NULL;
        $retorno = NULL;
        try {
            $daofactory = DAOFactory::getDAOFactory();
            $daofactory->open();
            $daofactory->beginTransaction();
            
            // pesquisar pelo atributo FilaQRCodePendenteProduzir.id_usuario no campo USUA_ID da tabela FILA_QRCODES_PNDNT_PRD
           $bo = new FilaQRCodePendenteProduzirBusinessImpl();
           $retorno = $bo->carregarPorId_Usuario($daofactory, $id_usuario);
           if ($retorno->msgcode == ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO){
                $daofactory->commit();
           } else {
                $daofactory->rollback();
           }
            
        } catch (Exception $e) {
            // rollback na transação

        } finally {
            try {
                $daofactory->close();
            } catch (Exception $e) {
                // faz algo
            }
        }

        return $retorno;
    }

/**
*
* pesquisarPorQtde() - Usado para invocar a classe de negócio FilaQRCodePendenteProduzirBusinessImpl de forma geral
* realizar uma busca de Qtde QR Code Produzir diretamente na tabela FILA_QRCODES_PNDNT_PRD campo FQPP_NU_QTDE_QRC
*
* @param $qtde
* @return FilaQRCodePendenteProduzirDTO
*
* 
*/

    public function pesquisarPorQtde($qtde)
    {
        $daofactory = NULL;
        $retorno = NULL;
        try {
            $daofactory = DAOFactory::getDAOFactory();
            $daofactory->open();
            $daofactory->beginTransaction();
            
            // pesquisar pelo atributo FilaQRCodePendenteProduzir.qtde no campo FQPP_NU_QTDE_QRC da tabela FILA_QRCODES_PNDNT_PRD
           $bo = new FilaQRCodePendenteProduzirBusinessImpl();
           $retorno = $bo->carregarPorQtde($daofactory, $qtde);
           if ($retorno->msgcode == ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO){
                $daofactory->commit();
           } else {
                $daofactory->rollback();
           }
            
        } catch (Exception $e) {
            // rollback na transação

        } finally {
            try {
                $daofactory->close();
            } catch (Exception $e) {
                // faz algo
            }
        }

        return $retorno;
    }


/**
*
* atualizarId_CampanhaPorPK() - Usado para invocar a classe de negócio FilaQRCodePendenteProduzirBusinessImpl de forma geral
* realizar uma atualização de ID da campanha diretamente na tabela FILA_QRCODES_PNDNT_PRD campo CAMP_ID
* @param $id
* @param $id_campanha
* @return FilaQRCodePendenteProduzirDTO
*
* 
*/

    public function atualizarId_CampanhaPorPK($id_campanha,$id)
    {
        $daofactory = NULL;
        $retorno = NULL;
        try {
            $daofactory = DAOFactory::getDAOFactory();
            $daofactory->open();
            $daofactory->beginTransaction();
            
            // atualizar registro por meio do método FilaQRCodePendenteProduzirBusinessImpl::atualizarId_CampanhaPorPK($id_campanha,$id)
           $bo = new FilaQRCodePendenteProduzirBusinessImpl();
           $retorno = $bo->atualizarId_CampanhaPorPK($daofactory,$id_campanha,$id);

           if ($retorno->msgcode == ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO){
                $daofactory->commit();
            } else {
                $daofactory->rollback();
            }
            
        } catch (Exception $e) {
            // rollback na transação
            $daofactory->rollback();

        } finally {
            try {
                $daofactory->close();
            } catch (Exception $e) {
                // faz algo
            }
        }

        return $retorno;
    }

/**
*
* atualizarId_UsuarioPorPK() - Usado para invocar a classe de negócio FilaQRCodePendenteProduzirBusinessImpl de forma geral
* realizar uma atualização de ID do usuário diretamente na tabela FILA_QRCODES_PNDNT_PRD campo USUA_ID
* @param $id
* @param $id_usuario
* @return FilaQRCodePendenteProduzirDTO
*
* 
*/

    public function atualizarId_UsuarioPorPK($id_usuario,$id)
    {
        $daofactory = NULL;
        $retorno = NULL;
        try {
            $daofactory = DAOFactory::getDAOFactory();
            $daofactory->open();
            $daofactory->beginTransaction();
            
            // atualizar registro por meio do método FilaQRCodePendenteProduzirBusinessImpl::atualizarId_UsuarioPorPK($id_usuario,$id)
           $bo = new FilaQRCodePendenteProduzirBusinessImpl();
           $retorno = $bo->atualizarId_UsuarioPorPK($daofactory,$id_usuario,$id);

           if ($retorno->msgcode == ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO){
                $daofactory->commit();
            } else {
                $daofactory->rollback();
            }
            
        } catch (Exception $e) {
            // rollback na transação
            $daofactory->rollback();

        } finally {
            try {
                $daofactory->close();
            } catch (Exception $e) {
                // faz algo
            }
        }

        return $retorno;
    }

/**
*
* atualizarQtdePorPK() - Usado para invocar a classe de negócio FilaQRCodePendenteProduzirBusinessImpl de forma geral
* realizar uma atualização de Qtde QR Code Produzir diretamente na tabela FILA_QRCODES_PNDNT_PRD campo FQPP_NU_QTDE_QRC
* @param $id
* @param $qtde
* @return FilaQRCodePendenteProduzirDTO
*
* 
*/

    public function atualizarQtdePorPK($qtde,$id)
    {
        $daofactory = NULL;
        $retorno = NULL;
        try {
            $daofactory = DAOFactory::getDAOFactory();
            $daofactory->open();
            $daofactory->beginTransaction();
            
            // atualizar registro por meio do método FilaQRCodePendenteProduzirBusinessImpl::atualizarQtdePorPK($qtde,$id)
           $bo = new FilaQRCodePendenteProduzirBusinessImpl();
           $retorno = $bo->atualizarQtdePorPK($daofactory,$qtde,$id);

           if ($retorno->msgcode == ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO){
                $daofactory->commit();
            } else {
                $daofactory->rollback();
            }
            
        } catch (Exception $e) {
            // rollback na transação
            $daofactory->rollback();

        } finally {
            try {
                $daofactory->close();
            } catch (Exception $e) {
                // faz algo
            }
        }

        return $retorno;
    }


/**
*
* listarFilaQRCodePendenteProduzirPorUsuaIdStatus() - Usado para invocar a classe de negócio TipoEmpreendimentoBusinessImpl de forma geral
* realizar lista paginada de registros tendo como referência os registros do usuário logado com uma instância de PaginacaoDTO
*
* @param $usuaid
* @param $status
* @param $pag
* @param $qtde
* @param $coluna
* @param $ordem
* @return $PaginacaoDTO
*/

   public function listarFilaQRCodePendenteProduzirPorUsuaIdStatus($usuaid, $status='A', $pag=1, $qtde=0, $coluna=1, $ordem=0) 
   {
       $daofactory = NULL;
       $retorno = NULL;
       try {
           $daofactory = DAOFactory::getDAOFactory();
           $daofactory->open();
           $daofactory->beginTransaction();

           //Se qtde por página é indefinido (=0) busca valor default do variavel
           if($qtde == 0){
               $qtde = (int) VariavelCache::getInstance()->getVariavel(ConstantesVariavel::MAXIMO_LINHAS_POR_PAGINA_DEFAULT);
           }
           // listar paginado FilaQRCodePendenteProduzir
           $bo = new FilaQRCodePendenteProduzirBusinessImpl();
           $retorno = $bo->listarFilaQRCodePendenteProduzirPorUsuaIdStatus($daofactory, $usuaid, $status, $pag, $qtde, $coluna, $ordem);
           $daofactory->commit();
       } catch (Exception $e) {
           // rollback na transação
        
       } finally {
           try {
               $daofactory->close();
           } catch (Exception $e) {
               // faz algo
           }
       }

       return $retorno;
   }


}

?>
