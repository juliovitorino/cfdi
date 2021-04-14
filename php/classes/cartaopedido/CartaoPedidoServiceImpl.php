<?php

//importar dependencias
require_once 'CartaoPedidoService.php';
require_once 'CartaoPedidoBusinessImpl.php';
require_once '../variavel/ConstantesVariavel.php';
require_once '../variavel/VariavelCache.php';
require_once '../mensagem/ConstantesMensagem.php';
require_once '../mensagem/MensagemCache.php';

require_once '../daofactory/DAOFactory.php';


/**
*
* CartaoPedidoServiceImpl - Implementação dos servicos para Classe de negócio com métodos para apoiar a integridade de informações sobre os pedido de acréscimo de cartões gerenciado pela plataforma
* Camada de Serviços CartaoPedido - camada responsável pela lógica de negócios de CartaoPedido do sistema. 
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
* @since 17/09/2019 14:08:07
*
*/
class CartaoPedidoServiceImpl implements CartaoPedidoService
{
    
    function __construct() {    }

/**
*
* listarTudo() - Usado para invocar a classe de negócio CartaoPedidoBusinessImpl de forma geral
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
* cadastrarPedido() - Cadastrar uma solicitação de pedido de aumento de cartões em campanha
*
* @param $idplano
* @param $dto
*
*/

public function cadastrarPedido($idplano, $dto)
{
    $daofactory = NULL;
    $retorno = NULL;
    try {
        $daofactory = DAOFactory::getDAOFactory();
        $daofactory->open();
        $daofactory->beginTransaction();
        
        $bo = new CartaoPedidoBusinessImpl();
        $retorno = $bo->cadastrarPedido($daofactory, $idplano, $dto);
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
* PesquisarMaxPKAtivoIdPorStatus() - Usado para invocar a classe de negócio CartaoPedidoBusinessImpl de forma geral
* a buscar a MAIOR PK pra um dado status.
*
* @param status
* @return CartaoPedidoDTO
*
*/

public function PesquisarMaxPKAtivoId_CampanhaPorStatus($id_campanha,$status)
{
    $daofactory = NULL;
    $retorno = NULL;
    try {
        $daofactory = DAOFactory::getDAOFactory();
        $daofactory->open();
        $daofactory->beginTransaction();
        
       $bo = new CartaoPedidoBusinessImpl();
       $retorno = $bo->PesquisarMaxPKAtivoId_CampanhaPorStatus($daofactory, $id_campanha,$status);
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
* atualizar() - Usado para invocar a classe de negócio CartaoPedidoBusinessImpl de forma geral
* para gerenciar as regras de negócio do sistema.
*
* @param CartaoPedidoDTO contendo dados para enviar para atualização
* @return uma instância de CartaoPedidoDTO com resultdo da operação
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
            
           $bo = new CartaoPedidoBusinessImpl();
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
* atualizarStatusCartaoPedido() - Usado para invocar a classe de negócio CartaoPedidoBusinessImpl de forma geral
* para gerenciar as atualizações do campo STATUS de acordo as regras de negócio do sistema.
*
* @param $id
* @param $status
* @return uma instância de CartaoPedidoDTO com resultdo da operação
*
*/


    public function autalizarStatusCartaoPedido($id, $status)
    {
        $daofactory = NULL;
        $retorno = NULL;
        try {
            $daofactory = DAOFactory::getDAOFactory();
            $daofactory->open();
            $daofactory->beginTransaction();
            

           $bo = new CartaoPedidoBusinessImpl();
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
* cadastrar() - Usado para invocar a classe de negócio CartaoPedidoBusinessImpl de forma geral
* para gerenciar a criação de registro de acordo as regras de negócio do sistema.
*
* @param $dto - Instância de CartaoPedidoDTO
*
* @return uma instância de CartaoPedidoDTO com resultdo da operação
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
            

           $bo = new CartaoPedidoBusinessImpl();
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
* @return List<CartaoPedidoDTO>[]
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
            
            // listar paginado CartaoPedido
           $bo = new CartaoPedidoBusinessImpl();
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
* realizar uma busca diretamente pela PK (Primary Key) da tabela CARTAO_PEDIDO campo CAPE_ID
*
* @param $id
* @return CartaoPedidoDTO
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
            
            // pesquisar pela PK da tabela CartaoPedido
           $bo = new CartaoPedidoBusinessImpl();
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
* listarCartaoPedidoPorStatus() - Usado para invocar a classe de negócio TipoEmpreendimentoBusinessImpl de forma geral
* realizar lista paginada de registros com uma instância de PaginacaoDTO
*
* @param $status
* @param $pag
* @param $qtde
* @param $coluna
* @param $ordem
* @return $PaginacaoDTO
*/

   public function listarCartaoPedidoPorStatus($status='A', $pag=1, $qtde=0, $coluna=1, $ordem=0) 
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
           // listar paginado CartaoPedido
           $bo = new CartaoPedidoBusinessImpl();
           $retorno = $bo->listarCartaoPedidoPorStatus($daofactory, $status, $pag, $qtde, $coluna, $ordem);
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
* pesquisarPorId_Campanha() - Usado para invocar a classe de negócio CartaoPedidoBusinessImpl de forma geral
* realizar uma busca de ID da campanha diretamente na tabela CARTAO_PEDIDO campo CAMP_ID
*
* @param $id_campanha
* @return CartaoPedidoDTO
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
            
            // pesquisar pelo atributo CartaoPedido.id_campanha no campo CAMP_ID da tabela CARTAO_PEDIDO
           $bo = new CartaoPedidoBusinessImpl();
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
* pesquisarPorHashtransacao() - Usado para invocar a classe de negócio CartaoPedidoBusinessImpl de forma geral
* realizar uma busca de Hash de transação diretamente na tabela CARTAO_PEDIDO campo CAPE_TX_HASH
*
* @param $hashTransacao
* @return CartaoPedidoDTO
*
* 
*/

    public function pesquisarPorHashtransacao($hashTransacao)
    {
        $daofactory = NULL;
        $retorno = NULL;
        try {
            $daofactory = DAOFactory::getDAOFactory();
            $daofactory->open();
            $daofactory->beginTransaction();
            
            // pesquisar pelo atributo CartaoPedido.hashTransacao no campo CAPE_TX_HASH da tabela CARTAO_PEDIDO
           $bo = new CartaoPedidoBusinessImpl();
           $retorno = $bo->carregarPorHashtransacao($daofactory, $hashTransacao);
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
* pesquisarPorQtde() - Usado para invocar a classe de negócio CartaoPedidoBusinessImpl de forma geral
* realizar uma busca de Quantidade diretamente na tabela CARTAO_PEDIDO campo CAPE_NU_QTDE
*
* @param $qtde
* @return CartaoPedidoDTO
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
            
            // pesquisar pelo atributo CartaoPedido.qtde no campo CAPE_NU_QTDE da tabela CARTAO_PEDIDO
           $bo = new CartaoPedidoBusinessImpl();
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
* pesquisarPorSelos() - Usado para invocar a classe de negócio CartaoPedidoBusinessImpl de forma geral
* realizar uma busca de Número de Selos diretamente na tabela CARTAO_PEDIDO campo CAPE_NU_SELOS
*
* @param $selos
* @return CartaoPedidoDTO
*
* 
*/

    public function pesquisarPorSelos($selos)
    {
        $daofactory = NULL;
        $retorno = NULL;
        try {
            $daofactory = DAOFactory::getDAOFactory();
            $daofactory->open();
            $daofactory->beginTransaction();
            
            // pesquisar pelo atributo CartaoPedido.selos no campo CAPE_NU_SELOS da tabela CARTAO_PEDIDO
           $bo = new CartaoPedidoBusinessImpl();
           $retorno = $bo->carregarPorSelos($daofactory, $selos);
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
* pesquisarPorVlrpedido() - Usado para invocar a classe de negócio CartaoPedidoBusinessImpl de forma geral
* realizar uma busca de Valor do Pedido diretamente na tabela CARTAO_PEDIDO campo CAPE_VL_PEDIDO
*
* @param $vlrPedido
* @return CartaoPedidoDTO
*
* 
*/

    public function pesquisarPorVlrpedido($vlrPedido)
    {
        $daofactory = NULL;
        $retorno = NULL;
        try {
            $daofactory = DAOFactory::getDAOFactory();
            $daofactory->open();
            $daofactory->beginTransaction();
            
            // pesquisar pelo atributo CartaoPedido.vlrPedido no campo CAPE_VL_PEDIDO da tabela CARTAO_PEDIDO
           $bo = new CartaoPedidoBusinessImpl();
           $retorno = $bo->carregarPorVlrpedido($daofactory, $vlrPedido);
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
* pesquisarPorDataautorizacao() - Usado para invocar a classe de negócio CartaoPedidoBusinessImpl de forma geral
* realizar uma busca de Data de Autorização Gateway diretamente na tabela CARTAO_PEDIDO campo CAPE_DT_AUTORIZACAO
*
* @param $dataAutorizacao
* @return CartaoPedidoDTO
*
* 
*/

    public function pesquisarPorDataautorizacao($dataAutorizacao)
    {
        $daofactory = NULL;
        $retorno = NULL;
        try {
            $daofactory = DAOFactory::getDAOFactory();
            $daofactory->open();
            $daofactory->beginTransaction();
            
            // pesquisar pelo atributo CartaoPedido.dataAutorizacao no campo CAPE_DT_AUTORIZACAO da tabela CARTAO_PEDIDO
           $bo = new CartaoPedidoBusinessImpl();
           $retorno = $bo->carregarPorDataautorizacao($daofactory, $dataAutorizacao);
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
* pesquisarPorDatapgto() - Usado para invocar a classe de negócio CartaoPedidoBusinessImpl de forma geral
* realizar uma busca de Data do pagamento diretamente na tabela CARTAO_PEDIDO campo CAPE_DT_PGTO
*
* @param $dataPgto
* @return CartaoPedidoDTO
*
* 
*/

    public function pesquisarPorDatapgto($dataPgto)
    {
        $daofactory = NULL;
        $retorno = NULL;
        try {
            $daofactory = DAOFactory::getDAOFactory();
            $daofactory->open();
            $daofactory->beginTransaction();
            
            // pesquisar pelo atributo CartaoPedido.dataPgto no campo CAPE_DT_PGTO da tabela CARTAO_PEDIDO
           $bo = new CartaoPedidoBusinessImpl();
           $retorno = $bo->carregarPorDatapgto($daofactory, $dataPgto);
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
* pesquisarPorVlrpgto() - Usado para invocar a classe de negócio CartaoPedidoBusinessImpl de forma geral
* realizar uma busca de Valor Efetivo Pago diretamente na tabela CARTAO_PEDIDO campo CAPE_VL_PGTO
*
* @param $vlrPgto
* @return CartaoPedidoDTO
*
* 
*/

    public function pesquisarPorVlrpgto($vlrPgto)
    {
        $daofactory = NULL;
        $retorno = NULL;
        try {
            $daofactory = DAOFactory::getDAOFactory();
            $daofactory->open();
            $daofactory->beginTransaction();
            
            // pesquisar pelo atributo CartaoPedido.vlrPgto no campo CAPE_VL_PGTO da tabela CARTAO_PEDIDO
           $bo = new CartaoPedidoBusinessImpl();
           $retorno = $bo->carregarPorVlrpgto($daofactory, $vlrPgto);
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
* pesquisarPorHashgtway() - Usado para invocar a classe de negócio CartaoPedidoBusinessImpl de forma geral
* realizar uma busca de Hash de transação do Gateway diretamente na tabela CARTAO_PEDIDO campo CAPE_TX_HASH_GATEWAY
*
* @param $hashGtway
* @return CartaoPedidoDTO
*
* 
*/

    public function pesquisarPorHashgtway($hashGtway)
    {
        $daofactory = NULL;
        $retorno = NULL;
        try {
            $daofactory = DAOFactory::getDAOFactory();
            $daofactory->open();
            $daofactory->beginTransaction();
            
            // pesquisar pelo atributo CartaoPedido.hashGtway no campo CAPE_TX_HASH_GATEWAY da tabela CARTAO_PEDIDO
           $bo = new CartaoPedidoBusinessImpl();
           $retorno = $bo->carregarPorHashgtway($daofactory, $hashGtway);
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
* atualizarId_CampanhaPorPK() - Usado para invocar a classe de negócio CartaoPedidoBusinessImpl de forma geral
* realizar uma atualização de ID da campanha diretamente na tabela CARTAO_PEDIDO campo CAMP_ID
* @param $id
* @param $id_campanha
* @return CartaoPedidoDTO
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
            
            // atualizar registro por meio do método CartaoPedidoBusinessImpl::atualizarId_CampanhaPorPK($id_campanha,$id)
           $bo = new CartaoPedidoBusinessImpl();
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
* atualizarHashtransacaoPorPK() - Usado para invocar a classe de negócio CartaoPedidoBusinessImpl de forma geral
* realizar uma atualização de Hash de transação diretamente na tabela CARTAO_PEDIDO campo CAPE_TX_HASH
* @param $id
* @param $hashTransacao
* @return CartaoPedidoDTO
*
* 
*/

    public function atualizarHashtransacaoPorPK($hashTransacao,$id)
    {
        $daofactory = NULL;
        $retorno = NULL;
        try {
            $daofactory = DAOFactory::getDAOFactory();
            $daofactory->open();
            $daofactory->beginTransaction();
            
            // atualizar registro por meio do método CartaoPedidoBusinessImpl::atualizarHashtransacaoPorPK($hashTransacao,$id)
           $bo = new CartaoPedidoBusinessImpl();
           $retorno = $bo->atualizarHashtransacaoPorPK($daofactory,$hashTransacao,$id);

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
* atualizarQtdePorPK() - Usado para invocar a classe de negócio CartaoPedidoBusinessImpl de forma geral
* realizar uma atualização de Quantidade diretamente na tabela CARTAO_PEDIDO campo CAPE_NU_QTDE
* @param $id
* @param $qtde
* @return CartaoPedidoDTO
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
            
            // atualizar registro por meio do método CartaoPedidoBusinessImpl::atualizarQtdePorPK($qtde,$id)
           $bo = new CartaoPedidoBusinessImpl();
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
* atualizarSelosPorPK() - Usado para invocar a classe de negócio CartaoPedidoBusinessImpl de forma geral
* realizar uma atualização de Número de Selos diretamente na tabela CARTAO_PEDIDO campo CAPE_NU_SELOS
* @param $id
* @param $selos
* @return CartaoPedidoDTO
*
* 
*/

    public function atualizarSelosPorPK($selos,$id)
    {
        $daofactory = NULL;
        $retorno = NULL;
        try {
            $daofactory = DAOFactory::getDAOFactory();
            $daofactory->open();
            $daofactory->beginTransaction();
            
            // atualizar registro por meio do método CartaoPedidoBusinessImpl::atualizarSelosPorPK($selos,$id)
           $bo = new CartaoPedidoBusinessImpl();
           $retorno = $bo->atualizarSelosPorPK($daofactory,$selos,$id);

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
* atualizarVlrpedidoPorPK() - Usado para invocar a classe de negócio CartaoPedidoBusinessImpl de forma geral
* realizar uma atualização de Valor do Pedido diretamente na tabela CARTAO_PEDIDO campo CAPE_VL_PEDIDO
* @param $id
* @param $vlrPedido
* @return CartaoPedidoDTO
*
* 
*/

    public function atualizarVlrpedidoPorPK($vlrPedido,$id)
    {
        $daofactory = NULL;
        $retorno = NULL;
        try {
            $daofactory = DAOFactory::getDAOFactory();
            $daofactory->open();
            $daofactory->beginTransaction();
            
            // atualizar registro por meio do método CartaoPedidoBusinessImpl::atualizarVlrpedidoPorPK($vlrPedido,$id)
           $bo = new CartaoPedidoBusinessImpl();
           $retorno = $bo->atualizarVlrpedidoPorPK($daofactory,$vlrPedido,$id);

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
* atualizarDataautorizacaoPorPK() - Usado para invocar a classe de negócio CartaoPedidoBusinessImpl de forma geral
* realizar uma atualização de Data de Autorização Gateway diretamente na tabela CARTAO_PEDIDO campo CAPE_DT_AUTORIZACAO
* @param $id
* @param $dataAutorizacao
* @return CartaoPedidoDTO
*
* 
*/

    public function atualizarDataautorizacaoPorPK($dataAutorizacao,$id)
    {
        $daofactory = NULL;
        $retorno = NULL;
        try {
            $daofactory = DAOFactory::getDAOFactory();
            $daofactory->open();
            $daofactory->beginTransaction();
            
            // atualizar registro por meio do método CartaoPedidoBusinessImpl::atualizarDataautorizacaoPorPK($dataAutorizacao,$id)
           $bo = new CartaoPedidoBusinessImpl();
           $retorno = $bo->atualizarDataautorizacaoPorPK($daofactory,$dataAutorizacao,$id);

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
* atualizarDatapgtoPorPK() - Usado para invocar a classe de negócio CartaoPedidoBusinessImpl de forma geral
* realizar uma atualização de Data do pagamento diretamente na tabela CARTAO_PEDIDO campo CAPE_DT_PGTO
* @param $id
* @param $dataPgto
* @return CartaoPedidoDTO
*
* 
*/

    public function atualizarDatapgtoPorPK($dataPgto,$id)
    {
        $daofactory = NULL;
        $retorno = NULL;
        try {
            $daofactory = DAOFactory::getDAOFactory();
            $daofactory->open();
            $daofactory->beginTransaction();
            
            // atualizar registro por meio do método CartaoPedidoBusinessImpl::atualizarDatapgtoPorPK($dataPgto,$id)
           $bo = new CartaoPedidoBusinessImpl();
           $retorno = $bo->atualizarDatapgtoPorPK($daofactory,$dataPgto,$id);

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
* atualizarVlrpgtoPorPK() - Usado para invocar a classe de negócio CartaoPedidoBusinessImpl de forma geral
* realizar uma atualização de Valor Efetivo Pago diretamente na tabela CARTAO_PEDIDO campo CAPE_VL_PGTO
* @param $id
* @param $vlrPgto
* @return CartaoPedidoDTO
*
* 
*/

    public function atualizarVlrpgtoPorPK($vlrPgto,$id)
    {
        $daofactory = NULL;
        $retorno = NULL;
        try {
            $daofactory = DAOFactory::getDAOFactory();
            $daofactory->open();
            $daofactory->beginTransaction();
            
            // atualizar registro por meio do método CartaoPedidoBusinessImpl::atualizarVlrpgtoPorPK($vlrPgto,$id)
           $bo = new CartaoPedidoBusinessImpl();
           $retorno = $bo->atualizarVlrpgtoPorPK($daofactory,$vlrPgto,$id);

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
* atualizarHashgtwayPorPK() - Usado para invocar a classe de negócio CartaoPedidoBusinessImpl de forma geral
* realizar uma atualização de Hash de transação do Gateway diretamente na tabela CARTAO_PEDIDO campo CAPE_TX_HASH_GATEWAY
* @param $id
* @param $hashGtway
* @return CartaoPedidoDTO
*
* 
*/

    public function atualizarHashgtwayPorPK($hashGtway,$id)
    {
        $daofactory = NULL;
        $retorno = NULL;
        try {
            $daofactory = DAOFactory::getDAOFactory();
            $daofactory->open();
            $daofactory->beginTransaction();
            
            // atualizar registro por meio do método CartaoPedidoBusinessImpl::atualizarHashgtwayPorPK($hashGtway,$id)
           $bo = new CartaoPedidoBusinessImpl();
           $retorno = $bo->atualizarHashgtwayPorPK($daofactory,$hashGtway,$id);

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
* listarCartaoPedidoPorUsuaIdStatus() - Usado para invocar a classe de negócio TipoEmpreendimentoBusinessImpl de forma geral
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

   public function listarCartaoPedidoPorUsuaIdStatus($usuaid, $status='A', $pag=1, $qtde=0, $coluna=1, $ordem=0) 
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
           // listar paginado CartaoPedido
           $bo = new CartaoPedidoBusinessImpl();
           $retorno = $bo->listarCartaoPedidoPorUsuaIdStatus($daofactory, $usuaid, $status, $pag, $qtde, $coluna, $ordem);
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

