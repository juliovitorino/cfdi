<?php

//importar dependencias
require_once 'FilaPublicidadeService.php';
require_once 'FilaPublicidadeBusinessImpl.php';
require_once '../variavel/ConstantesVariavel.php';
require_once '../variavel/VariavelCache.php';
require_once '../mensagem/ConstantesMensagem.php';
require_once '../mensagem/MensagemCache.php';

require_once '../daofactory/DAOFactory.php';


/**
*
* FilaPublicidadeServiceImpl - Implementação dos servicos para Classe de negócio com métodos para apoiar a integridade de informações sobre fila de publicidades gerenciado pela plataforma
* Camada de Serviços FilaPublicidade - camada responsável pela lógica de negócios de FilaPublicidade do sistema. 
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
* @since 19/09/2019 15:17:09
*
*/
class FilaPublicidadeServiceImpl implements FilaPublicidadeService
{
    
    function __construct() {    }

/**
*
* listarTudo() - Usado para invocar a classe de negócio FilaPublicidadeBusinessImpl de forma geral
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
* PesquisarMaxPKAtivoIdPorStatus() - Usado para invocar a classe de negócio FilaPublicidadeBusinessImpl de forma geral
* a buscar a MAIOR PK pra um dado status.
*
* @param status
* @return FilaPublicidadeDTO
*
*/

public function PesquisarMaxPKAtivoId_Usua_PublicPorStatus($id_usua_public,$status)
{
    $daofactory = NULL;
    $retorno = NULL;
    try {
        $daofactory = DAOFactory::getDAOFactory();
        $daofactory->open();
        $daofactory->beginTransaction();
        
       $bo = new FilaPublicidadeBusinessImpl();
       $retorno = $bo->PesquisarMaxPKAtivoId_Usua_PublicPorStatus($daofactory, $id_usua_public,$status);
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
* atualizar() - Usado para invocar a classe de negócio FilaPublicidadeBusinessImpl de forma geral
* para gerenciar as regras de negócio do sistema.
*
* @param FilaPublicidadeDTO contendo dados para enviar para atualização
* @return uma instância de FilaPublicidadeDTO com resultdo da operação
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
            
           $bo = new FilaPublicidadeBusinessImpl();
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
* atualizarStatusFilaPublicidade() - Usado para invocar a classe de negócio FilaPublicidadeBusinessImpl de forma geral
* para gerenciar as atualizações do campo STATUS de acordo as regras de negócio do sistema.
*
* @param $id
* @param $status
* @return uma instância de FilaPublicidadeDTO com resultdo da operação
*
*/


    public function autalizarStatusFilaPublicidade($id, $status)
    {
        $daofactory = NULL;
        $retorno = NULL;
        try {
            $daofactory = DAOFactory::getDAOFactory();
            $daofactory->open();
            $daofactory->beginTransaction();
            

           $bo = new FilaPublicidadeBusinessImpl();
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
* cadastrar() - Usado para invocar a classe de negócio FilaPublicidadeBusinessImpl de forma geral
* para gerenciar a criação de registro de acordo as regras de negócio do sistema.
*
* @param $dto - Instância de FilaPublicidadeDTO
*
* @return uma instância de FilaPublicidadeDTO com resultdo da operação
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
            

           $bo = new FilaPublicidadeBusinessImpl();
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
* @return List<FilaPublicidadeDTO>[]
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
            
            // listar paginado FilaPublicidade
           $bo = new FilaPublicidadeBusinessImpl();
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
* realizar uma busca diretamente pela PK (Primary Key) da tabela FILA_PUBLICIDADE campo FIPU_ID
*
* @param $id
* @return FilaPublicidadeDTO
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
            
            // pesquisar pela PK da tabela FilaPublicidade
           $bo = new FilaPublicidadeBusinessImpl();
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
* listarFilaPublicidadePorStatus() - Usado para invocar a classe de negócio TipoEmpreendimentoBusinessImpl de forma geral
* realizar lista paginada de registros com uma instância de PaginacaoDTO
*
* @param $status
* @param $pag
* @param $qtde
* @param $coluna
* @param $ordem
* @return $PaginacaoDTO
*/

   public function listarFilaPublicidadePorStatus($status='A', $pag=1, $qtde=0, $coluna=1, $ordem=0) 
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
           // listar paginado FilaPublicidade
           $bo = new FilaPublicidadeBusinessImpl();
           $retorno = $bo->listarFilaPublicidadePorStatus($daofactory, $status, $pag, $qtde, $coluna, $ordem);
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
* pesquisarPorId_Usua_Public() - Usado para invocar a classe de negócio FilaPublicidadeBusinessImpl de forma geral
* realizar uma busca de ID Usuário x Publicidade diretamente na tabela FILA_PUBLICIDADE campo USPU_ID
*
* @param $id_usua_public
* @return FilaPublicidadeDTO
*
* 
*/

    public function pesquisarPorId_Usua_Public($id_usua_public)
    {
        $daofactory = NULL;
        $retorno = NULL;
        try {
            $daofactory = DAOFactory::getDAOFactory();
            $daofactory->open();
            $daofactory->beginTransaction();
            
            // pesquisar pelo atributo FilaPublicidade.id_usua_public no campo USPU_ID da tabela FILA_PUBLICIDADE
           $bo = new FilaPublicidadeBusinessImpl();
           $retorno = $bo->carregarPorId_Usua_Public($daofactory, $id_usua_public);
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
* pesquisarPorId_Usuario() - Usado para invocar a classe de negócio FilaPublicidadeBusinessImpl de forma geral
* realizar uma busca de ID do Usuário diretamente na tabela FILA_PUBLICIDADE campo USUA_ID
*
* @param $id_usuario
* @return FilaPublicidadeDTO
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
            
            // pesquisar pelo atributo FilaPublicidade.id_usuario no campo USUA_ID da tabela FILA_PUBLICIDADE
           $bo = new FilaPublicidadeBusinessImpl();
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
* pesquisarPorId_Job() - Usado para invocar a classe de negócio FilaPublicidadeBusinessImpl de forma geral
* realizar uma busca de ID do Job diretamente na tabela FILA_PUBLICIDADE campo JOBS_ID
*
* @param $id_job
* @return FilaPublicidadeDTO
*
* 
*/

    public function pesquisarPorId_Job($id_job)
    {
        $daofactory = NULL;
        $retorno = NULL;
        try {
            $daofactory = DAOFactory::getDAOFactory();
            $daofactory->open();
            $daofactory->beginTransaction();
            
            // pesquisar pelo atributo FilaPublicidade.id_job no campo JOBS_ID da tabela FILA_PUBLICIDADE
           $bo = new FilaPublicidadeBusinessImpl();
           $retorno = $bo->carregarPorId_Job($daofactory, $id_job);
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
* atualizarId_Usua_PublicPorPK() - Usado para invocar a classe de negócio FilaPublicidadeBusinessImpl de forma geral
* realizar uma atualização de ID Usuário x Publicidade diretamente na tabela FILA_PUBLICIDADE campo USPU_ID
* @param $id
* @param $id_usua_public
* @return FilaPublicidadeDTO
*
* 
*/

    public function atualizarId_Usua_PublicPorPK($id_usua_public,$id)
    {
        $daofactory = NULL;
        $retorno = NULL;
        try {
            $daofactory = DAOFactory::getDAOFactory();
            $daofactory->open();
            $daofactory->beginTransaction();
            
            // atualizar registro por meio do método FilaPublicidadeBusinessImpl::atualizarId_Usua_PublicPorPK($id_usua_public,$id)
           $bo = new FilaPublicidadeBusinessImpl();
           $retorno = $bo->atualizarId_Usua_PublicPorPK($daofactory,$id_usua_public,$id);

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
* atualizarId_UsuarioPorPK() - Usado para invocar a classe de negócio FilaPublicidadeBusinessImpl de forma geral
* realizar uma atualização de ID do Usuário diretamente na tabela FILA_PUBLICIDADE campo USUA_ID
* @param $id
* @param $id_usuario
* @return FilaPublicidadeDTO
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
            
            // atualizar registro por meio do método FilaPublicidadeBusinessImpl::atualizarId_UsuarioPorPK($id_usuario,$id)
           $bo = new FilaPublicidadeBusinessImpl();
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
* atualizarId_JobPorPK() - Usado para invocar a classe de negócio FilaPublicidadeBusinessImpl de forma geral
* realizar uma atualização de ID do Job diretamente na tabela FILA_PUBLICIDADE campo JOBS_ID
* @param $id
* @param $id_job
* @return FilaPublicidadeDTO
*
* 
*/

    public function atualizarId_JobPorPK($id_job,$id)
    {
        $daofactory = NULL;
        $retorno = NULL;
        try {
            $daofactory = DAOFactory::getDAOFactory();
            $daofactory->open();
            $daofactory->beginTransaction();
            
            // atualizar registro por meio do método FilaPublicidadeBusinessImpl::atualizarId_JobPorPK($id_job,$id)
           $bo = new FilaPublicidadeBusinessImpl();
           $retorno = $bo->atualizarId_JobPorPK($daofactory,$id_job,$id);

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
* listarFilaPublicidadePorUsuaIdStatus() - Usado para invocar a classe de negócio TipoEmpreendimentoBusinessImpl de forma geral
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

   public function listarFilaPublicidadePorUsuaIdStatus($usuaid, $status='A', $pag=1, $qtde=0, $coluna=1, $ordem=0) 
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
           // listar paginado FilaPublicidade
           $bo = new FilaPublicidadeBusinessImpl();
           $retorno = $bo->listarFilaPublicidadePorUsuaIdStatus($daofactory, $usuaid, $status, $pag, $qtde, $coluna, $ordem);
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
