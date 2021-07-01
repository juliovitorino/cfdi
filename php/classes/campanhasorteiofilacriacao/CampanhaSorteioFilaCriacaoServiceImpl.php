<?php

//importar dependencias
require_once 'CampanhaSorteioFilaCriacaoService.php';
require_once 'CampanhaSorteioFilaCriacaoBusinessImpl.php';
require_once '../variavel/ConstantesVariavel.php';
require_once '../variavel/VariavelCache.php';
require_once '../mensagem/ConstantesMensagem.php';
require_once '../mensagem/MensagemCache.php';

require_once '../daofactory/DAOFactory.php';


/**
*
* CampanhaSorteioFilaCriacaoServiceImpl - Implementação dos servicos para Classe de negócio com métodos para apoiar a integridade de informações sobre Leads gerenciado pela plataforma
* Camada de Serviços CampanhaSorteioFilaCriacao - camada responsável pela lógica de negócios de CampanhaSorteioFilaCriacao do sistema. 
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
* @since 17/06/2021 08:10:22
*
*/
class CampanhaSorteioFilaCriacaoServiceImpl implements CampanhaSorteioFilaCriacaoService
{
    
    function __construct() {    }

/**
*
* listarTudo() - Usado para invocar a classe de negócio CampanhaSorteioFilaCriacaoBusinessImpl de forma geral
* para listar todos os registros sem critérios de paginação dos dados.
*
* Use este método com MUITA moderação.
*/

    public function listarTudo() {}
    public function pesquisar($dto){}
    public function apagar($dto){}
    public function cancelar($dto) {}

/**
*
* PesquisarMaxPKAtivoIdPorStatus() - Usado para invocar a classe de negócio CampanhaSorteioFilaCriacaoBusinessImpl de forma geral
* a buscar a MAIOR PK pra um dado status.
*
* @param status
* @return CampanhaSorteioFilaCriacaoDTO
*
*/

public function pesquisarMaxPKAtivoId_CasoPorStatus($id_caso,$status)
{
    $daofactory = NULL;
    $retorno = NULL;
    try {
        $daofactory = DAOFactory::getDAOFactory();
        $daofactory->open();
        $daofactory->beginTransaction();
        
       $bo = new CampanhaSorteioFilaCriacaoBusinessImpl();
       $retorno = $bo->pesquisarMaxPKAtivoId_CasoPorStatus($daofactory, $id_caso,$status);
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
* atualizar() - Usado para invocar a classe de negócio CampanhaSorteioFilaCriacaoBusinessImpl de forma geral
* para gerenciar as regras de negócio do sistema.
*
* @param CampanhaSorteioFilaCriacaoDTO contendo dados para enviar para atualização
* @return uma instância de CampanhaSorteioFilaCriacaoDTO com resultdo da operação
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
            
           $bo = new CampanhaSorteioFilaCriacaoBusinessImpl();
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
* atualizarStatusCampanhaSorteioFilaCriacao() - Usado para invocar a classe de negócio CampanhaSorteioFilaCriacaoBusinessImpl de forma geral
* para gerenciar as atualizações do campo STATUS de acordo as regras de negócio do sistema.
*
* @param $id
* @param $status
* @return uma instância de CampanhaSorteioFilaCriacaoDTO com resultdo da operação
*
*/


    public function autalizarStatusCampanhaSorteioFilaCriacao($id, $status)
    {
        $daofactory = NULL;
        $retorno = NULL;
        try {
            $daofactory = DAOFactory::getDAOFactory();
            $daofactory->open();
            $daofactory->beginTransaction();
            

           $bo = new CampanhaSorteioFilaCriacaoBusinessImpl();
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
* cadastrar() - Usado para invocar a classe de negócio CampanhaSorteioFilaCriacaoBusinessImpl de forma geral
* para gerenciar a criação de registro de acordo as regras de negócio do sistema.
*
* @param $dto - Instância de CampanhaSorteioFilaCriacaoDTO
*
* @return uma instância de CampanhaSorteioFilaCriacaoDTO com resultdo da operação
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
            

           $bo = new CampanhaSorteioFilaCriacaoBusinessImpl();
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
* @return List<CampanhaSorteioFilaCriacaoDTO>[]
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
            
            // listar paginado CampanhaSorteioFilaCriacao
           $bo = new CampanhaSorteioFilaCriacaoBusinessImpl();
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
* realizar uma busca diretamente pela PK (Primary Key) da tabela CAMPANHA_SORTEIO_FILA_CRIACAO campo CSFC_ID
*
* @param $id
* @return CampanhaSorteioFilaCriacaoDTO
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
            
            // pesquisar pela PK da tabela CampanhaSorteioFilaCriacao
           $bo = new CampanhaSorteioFilaCriacaoBusinessImpl();
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
* listarCampanhaSorteioFilaCriacaoPorStatus() - Usado para invocar a classe de negócio TipoEmpreendimentoBusinessImpl de forma geral
* realizar lista paginada de registros com uma instância de PaginacaoDTO
*
* @param $status
* @param $pag
* @param $qtde
* @param $coluna
* @param $ordem
* @return $PaginacaoDTO
*/

   public function listarCampanhaSorteioFilaCriacaoPorStatus($status='A', $pag=1, $qtde=0, $coluna=1, $ordem=0) 
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
           // listar paginado CampanhaSorteioFilaCriacao
           $bo = new CampanhaSorteioFilaCriacaoBusinessImpl();
           $retorno = $bo->listarCampanhaSorteioFilaCriacaoPorStatus($daofactory, $status, $pag, $qtde, $coluna, $ordem);
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
* pesquisarPorId_Caso() - Usado para invocar a classe de negócio CampanhaSorteioFilaCriacaoBusinessImpl de forma geral
* realizar uma busca de ID da campanha sorteio diretamente na tabela CAMPANHA_SORTEIO_FILA_CRIACAO campo CASO_ID
*
* @param $id_caso
* @return CampanhaSorteioFilaCriacaoDTO
*
* 
*/

    public function pesquisarPorId_Caso($id_caso)
    {
        $daofactory = NULL;
        $retorno = NULL;
        try {
            $daofactory = DAOFactory::getDAOFactory();
            $daofactory->open();
            $daofactory->beginTransaction();
            
            // pesquisar pelo atributo CampanhaSorteioFilaCriacao.id_caso no campo CASO_ID da tabela CAMPANHA_SORTEIO_FILA_CRIACAO
           $bo = new CampanhaSorteioFilaCriacaoBusinessImpl();
           $retorno = $bo->carregarPorId_Caso($daofactory, $id_caso);
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
* pesquisarPorQtloteticketcriar() - Usado para invocar a classe de negócio CampanhaSorteioFilaCriacaoBusinessImpl de forma geral
* realizar uma busca de Qtde lotes de tickets diretamente na tabela CAMPANHA_SORTEIO_FILA_CRIACAO campo CSFC_QT_LOTE
*
* @param $qtLoteTicketCriar
* @return CampanhaSorteioFilaCriacaoDTO
*
* 
*/

    public function pesquisarPorQtloteticketcriar($qtLoteTicketCriar)
    {
        $daofactory = NULL;
        $retorno = NULL;
        try {
            $daofactory = DAOFactory::getDAOFactory();
            $daofactory->open();
            $daofactory->beginTransaction();
            
            // pesquisar pelo atributo CampanhaSorteioFilaCriacao.qtLoteTicketCriar no campo CSFC_QT_LOTE da tabela CAMPANHA_SORTEIO_FILA_CRIACAO
           $bo = new CampanhaSorteioFilaCriacaoBusinessImpl();
           $retorno = $bo->carregarPorQtloteticketcriar($daofactory, $qtLoteTicketCriar);
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
* atualizarId_CasoPorPK() - Usado para invocar a classe de negócio CampanhaSorteioFilaCriacaoBusinessImpl de forma geral
* realizar uma atualização de ID da campanha sorteio diretamente na tabela CAMPANHA_SORTEIO_FILA_CRIACAO campo CASO_ID
* @param $id
* @param $id_caso
* @return CampanhaSorteioFilaCriacaoDTO
*
* 
*/

    public function atualizarId_CasoPorPK($id_caso,$id)
    {
        $daofactory = NULL;
        $retorno = NULL;
        try {
            $daofactory = DAOFactory::getDAOFactory();
            $daofactory->open();
            $daofactory->beginTransaction();
            
            // atualizar registro por meio do método CampanhaSorteioFilaCriacaoBusinessImpl::atualizarId_CasoPorPK($id_caso,$id)
           $bo = new CampanhaSorteioFilaCriacaoBusinessImpl();
           $retorno = $bo->atualizarId_CasoPorPK($daofactory,$id_caso,$id);

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
* atualizarQtloteticketcriarPorPK() - Usado para invocar a classe de negócio CampanhaSorteioFilaCriacaoBusinessImpl de forma geral
* realizar uma atualização de Qtde lotes de tickets diretamente na tabela CAMPANHA_SORTEIO_FILA_CRIACAO campo CSFC_QT_LOTE
* @param $id
* @param $qtLoteTicketCriar
* @return CampanhaSorteioFilaCriacaoDTO
*
* 
*/

    public function atualizarQtloteticketcriarPorPK($qtLoteTicketCriar,$id)
    {
        $daofactory = NULL;
        $retorno = NULL;
        try {
            $daofactory = DAOFactory::getDAOFactory();
            $daofactory->open();
            $daofactory->beginTransaction();
            
            // atualizar registro por meio do método CampanhaSorteioFilaCriacaoBusinessImpl::atualizarQtloteticketcriarPorPK($qtLoteTicketCriar,$id)
           $bo = new CampanhaSorteioFilaCriacaoBusinessImpl();
           $retorno = $bo->atualizarQtloteticketcriarPorPK($daofactory,$qtLoteTicketCriar,$id);

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
* listarCampanhaSorteioFilaCriacaoPorUsuaIdStatus() - Usado para invocar a classe de negócio TipoEmpreendimentoBusinessImpl de forma geral
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

   public function listarCampanhaSorteioFilaCriacaoPorUsuaIdStatus($usuaid, $status='A', $pag=1, $qtde=0, $coluna=1, $ordem=0) 
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
           // listar paginado CampanhaSorteioFilaCriacao
           $bo = new CampanhaSorteioFilaCriacaoBusinessImpl();
           $retorno = $bo->listarCampanhaSorteioFilaCriacaoPorUsuaIdStatus($daofactory, $usuaid, $status, $pag, $qtde, $coluna, $ordem);
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
