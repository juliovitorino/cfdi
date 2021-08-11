<?php

//importar dependencias
require_once 'CartaoMoverHistoricoService.php';
require_once 'CartaoMoverHistoricoBusinessImpl.php';
require_once '../variavel/ConstantesVariavel.php';
require_once '../variavel/VariavelCache.php';
require_once '../mensagem/ConstantesMensagem.php';
require_once '../mensagem/MensagemCache.php';

require_once '../daofactory/DAOFactory.php';


/**
*
* CartaoMoverHistoricoServiceImpl - Implementação dos servicos para Classe de negócio com métodos para apoiar a integridade de informações sobre a movimentação de cartão entre dois usuarios gerenciado pela plataforma
* Camada de Serviços CartaoMoverHistorico - camada responsável pela lógica de negócios de CartaoMoverHistorico do sistema. 
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
* @since 24/07/2021 10:20:31
*
*/
class CartaoMoverHistoricoServiceImpl implements CartaoMoverHistoricoService
{
    
    function __construct() {    }

/**
*
* listarTudo() - Usado para invocar a classe de negócio CartaoMoverHistoricoBusinessImpl de forma geral
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
* PesquisarMaxPKAtivoIdPorStatus() - Usado para invocar a classe de negócio CartaoMoverHistoricoBusinessImpl de forma geral
* a buscar a MAIOR PK pra um dado status.
*
* @param status
* @return CartaoMoverHistoricoDTO
*
*/

public function pesquisarMaxPKAtivoIdcartaoPorStatus($idCartao,$status)
{
    $daofactory = NULL;
    $retorno = NULL;
    try {
        $daofactory = DAOFactory::getDAOFactory();
        $daofactory->open();
        $daofactory->beginTransaction();
        
       $bo = new CartaoMoverHistoricoBusinessImpl();
       $retorno = $bo->pesquisarMaxPKAtivoIdcartaoPorStatus($daofactory, $idCartao,$status);
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
* atualizar() - Usado para invocar a classe de negócio CartaoMoverHistoricoBusinessImpl de forma geral
* para gerenciar as regras de negócio do sistema.
*
* @param CartaoMoverHistoricoDTO contendo dados para enviar para atualização
* @return uma instância de CartaoMoverHistoricoDTO com resultdo da operação
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
            
           $bo = new CartaoMoverHistoricoBusinessImpl();
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
* atualizarStatusCartaoMoverHistorico() - Usado para invocar a classe de negócio CartaoMoverHistoricoBusinessImpl de forma geral
* para gerenciar as atualizações do campo STATUS de acordo as regras de negócio do sistema.
*
* @param $id
* @param $status
* @return uma instância de CartaoMoverHistoricoDTO com resultdo da operação
*
*/


    public function autalizarStatusCartaoMoverHistorico($id, $status)
    {
        $daofactory = NULL;
        $retorno = NULL;
        try {
            $daofactory = DAOFactory::getDAOFactory();
            $daofactory->open();
            $daofactory->beginTransaction();
            

           $bo = new CartaoMoverHistoricoBusinessImpl();
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
* cadastrar() - Usado para invocar a classe de negócio CartaoMoverHistoricoBusinessImpl de forma geral
* para gerenciar a criação de registro de acordo as regras de negócio do sistema.
*
* @param $dto - Instância de CartaoMoverHistoricoDTO
*
* @return uma instância de CartaoMoverHistoricoDTO com resultdo da operação
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
            

           $bo = new CartaoMoverHistoricoBusinessImpl();
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
* @return List<CartaoMoverHistoricoDTO>[]
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
            
            // listar paginado CartaoMoverHistorico
           $bo = new CartaoMoverHistoricoBusinessImpl();
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
* realizar uma busca diretamente pela PK (Primary Key) da tabela CARTAO_MOVER_HISTORICO campo CAMH_ID
*
* @param $id
* @return CartaoMoverHistoricoDTO
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
            
            // pesquisar pela PK da tabela CartaoMoverHistorico
           $bo = new CartaoMoverHistoricoBusinessImpl();
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
* listarCartaoMoverHistoricoPorStatus() - Usado para invocar a classe de negócio TipoEmpreendimentoBusinessImpl de forma geral
* realizar lista paginada de registros com uma instância de PaginacaoDTO
*
* @param $status
* @param $pag
* @param $qtde
* @param $coluna
* @param $ordem
* @return $PaginacaoDTO
*/

   public function listarCartaoMoverHistoricoPorStatus($status='A', $pag=1, $qtde=0, $coluna=1, $ordem=0) 
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
           // listar paginado CartaoMoverHistorico
           $bo = new CartaoMoverHistoricoBusinessImpl();
           $retorno = $bo->listarCartaoMoverHistoricoPorStatus($daofactory, $status, $pag, $qtde, $coluna, $ordem);
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
* pesquisarPorIdcartao() - Usado para invocar a classe de negócio CartaoMoverHistoricoBusinessImpl de forma geral
* realizar uma busca de ID do cartão diretamente na tabela CARTAO_MOVER_HISTORICO campo CART_ID
*
* @param $idCartao
* @return CartaoMoverHistoricoDTO
*
* 
*/

    public function pesquisarPorIdcartao($idCartao)
    {
        $daofactory = NULL;
        $retorno = NULL;
        try {
            $daofactory = DAOFactory::getDAOFactory();
            $daofactory->open();
            $daofactory->beginTransaction();
            
            // pesquisar pelo atributo CartaoMoverHistorico.idCartao no campo CART_ID da tabela CARTAO_MOVER_HISTORICO
           $bo = new CartaoMoverHistoricoBusinessImpl();
           $retorno = $bo->carregarPorIdcartao($daofactory, $idCartao);
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
* pesquisarPorIdusuariodoador() - Usado para invocar a classe de negócio CartaoMoverHistoricoBusinessImpl de forma geral
* realizar uma busca de ID do usuário doador diretamente na tabela CARTAO_MOVER_HISTORICO campo USUA_ID_DE
*
* @param $idUsuarioDoador
* @return CartaoMoverHistoricoDTO
*
* 
*/

    public function pesquisarPorIdusuariodoador($idUsuarioDoador)
    {
        $daofactory = NULL;
        $retorno = NULL;
        try {
            $daofactory = DAOFactory::getDAOFactory();
            $daofactory->open();
            $daofactory->beginTransaction();
            
            // pesquisar pelo atributo CartaoMoverHistorico.idUsuarioDoador no campo USUA_ID_DE da tabela CARTAO_MOVER_HISTORICO
           $bo = new CartaoMoverHistoricoBusinessImpl();
           $retorno = $bo->carregarPorIdusuariodoador($daofactory, $idUsuarioDoador);
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
* pesquisarPorIdusuarioreceptor() - Usado para invocar a classe de negócio CartaoMoverHistoricoBusinessImpl de forma geral
* realizar uma busca de ID do usuário receptor diretamente na tabela CARTAO_MOVER_HISTORICO campo USUA_ID_PARA
*
* @param $idUsuarioReceptor
* @return CartaoMoverHistoricoDTO
*
* 
*/

    public function pesquisarPorIdusuarioreceptor($idUsuarioReceptor)
    {
        $daofactory = NULL;
        $retorno = NULL;
        try {
            $daofactory = DAOFactory::getDAOFactory();
            $daofactory->open();
            $daofactory->beginTransaction();
            
            // pesquisar pelo atributo CartaoMoverHistorico.idUsuarioReceptor no campo USUA_ID_PARA da tabela CARTAO_MOVER_HISTORICO
           $bo = new CartaoMoverHistoricoBusinessImpl();
           $retorno = $bo->carregarPorIdusuarioreceptor($daofactory, $idUsuarioReceptor);
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
* atualizarIdcartaoPorPK() - Usado para invocar a classe de negócio CartaoMoverHistoricoBusinessImpl de forma geral
* realizar uma atualização de ID do cartão diretamente na tabela CARTAO_MOVER_HISTORICO campo CART_ID
* @param $id
* @param $idCartao
* @return CartaoMoverHistoricoDTO
*
* 
*/

    public function atualizarIdcartaoPorPK($idCartao,$id)
    {
        $daofactory = NULL;
        $retorno = NULL;
        try {
            $daofactory = DAOFactory::getDAOFactory();
            $daofactory->open();
            $daofactory->beginTransaction();
            
            // atualizar registro por meio do método CartaoMoverHistoricoBusinessImpl::atualizarIdcartaoPorPK($idCartao,$id)
           $bo = new CartaoMoverHistoricoBusinessImpl();
           $retorno = $bo->atualizarIdcartaoPorPK($daofactory,$idCartao,$id);

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
* atualizarIdusuariodoadorPorPK() - Usado para invocar a classe de negócio CartaoMoverHistoricoBusinessImpl de forma geral
* realizar uma atualização de ID do usuário doador diretamente na tabela CARTAO_MOVER_HISTORICO campo USUA_ID_DE
* @param $id
* @param $idUsuarioDoador
* @return CartaoMoverHistoricoDTO
*
* 
*/

    public function atualizarIdusuariodoadorPorPK($idUsuarioDoador,$id)
    {
        $daofactory = NULL;
        $retorno = NULL;
        try {
            $daofactory = DAOFactory::getDAOFactory();
            $daofactory->open();
            $daofactory->beginTransaction();
            
            // atualizar registro por meio do método CartaoMoverHistoricoBusinessImpl::atualizarIdusuariodoadorPorPK($idUsuarioDoador,$id)
           $bo = new CartaoMoverHistoricoBusinessImpl();
           $retorno = $bo->atualizarIdusuariodoadorPorPK($daofactory,$idUsuarioDoador,$id);

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
* atualizarIdusuarioreceptorPorPK() - Usado para invocar a classe de negócio CartaoMoverHistoricoBusinessImpl de forma geral
* realizar uma atualização de ID do usuário receptor diretamente na tabela CARTAO_MOVER_HISTORICO campo USUA_ID_PARA
* @param $id
* @param $idUsuarioReceptor
* @return CartaoMoverHistoricoDTO
*
* 
*/

    public function atualizarIdusuarioreceptorPorPK($idUsuarioReceptor,$id)
    {
        $daofactory = NULL;
        $retorno = NULL;
        try {
            $daofactory = DAOFactory::getDAOFactory();
            $daofactory->open();
            $daofactory->beginTransaction();
            
            // atualizar registro por meio do método CartaoMoverHistoricoBusinessImpl::atualizarIdusuarioreceptorPorPK($idUsuarioReceptor,$id)
           $bo = new CartaoMoverHistoricoBusinessImpl();
           $retorno = $bo->atualizarIdusuarioreceptorPorPK($daofactory,$idUsuarioReceptor,$id);

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
* listarCartaoMoverHistoricoPorUsuaIdStatus() - Usado para invocar a classe de negócio TipoEmpreendimentoBusinessImpl de forma geral
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

   public function listarCartaoMoverHistoricoPorUsuaIdStatus($usuaid, $status='A', $pag=1, $qtde=0, $coluna=1, $ordem=0) 
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
           // listar paginado CartaoMoverHistorico
           $bo = new CartaoMoverHistoricoBusinessImpl();
           $retorno = $bo->listarCartaoMoverHistoricoPorUsuaIdStatus($daofactory, $usuaid, $status, $pag, $qtde, $coluna, $ordem);
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
* listarCartaoMoverHistoricoPorCartIdStatus() - Usado para invocar a classe de negócio TipoEmpreendimentoBusinessImpl de forma geral
* realizar lista paginada de registros tendo como referência os registros do usuário logado com uma instância de PaginacaoDTO
*
* @param $cartid
* @param $status
* @param $pag
* @param $qtde
* @param $coluna
* @param $ordem
* @return $PaginacaoDTO
*/

public function listarCartaoMoverHistoricoPorCartIdStatus($cartid, $status='A', $pag=1, $qtde=0, $coluna=1, $ordem=0) 
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
        // listar paginado CartaoMoverHistorico
        $bo = new CartaoMoverHistoricoBusinessImpl();
        $retorno = $bo->listarCartaoMoverHistoricoPorCartIdStatus($daofactory, $cartid, $status, $pag, $qtde, $coluna, $ordem);
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
