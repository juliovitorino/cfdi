<?php

//importar dependencias
require_once 'CampanhaCashbackService.php';
require_once 'CampanhaCashbackBusinessImpl.php';
require_once '../variavel/ConstantesVariavel.php';
require_once '../variavel/VariavelCache.php';
require_once '../mensagem/ConstantesMensagem.php';
require_once '../mensagem/MensagemCache.php';

require_once '../daofactory/DAOFactory.php';


/**
*
* CampanhaCashbackServiceImpl - Implementação dos servicos para Classe de negócio com métodos para apoiar a integridade de informações sobre o programa de cashback gerenciado pela plataforma
* Camada de Serviços CampanhaCashback - camada responsável pela lógica de negócios de CampanhaCashback do sistema. 
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
* @since 26/08/2019 15:34:53
*
*/
class CampanhaCashbackServiceImpl implements CampanhaCashbackService
{
    
    function __construct() {    }

/**
*
* listarTudo() - Usado para invocar a classe de negócio CampanhaCashbackBusinessImpl de forma geral
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
* atualizar() - Usado para invocar a classe de negócio CampanhaCashbackBusinessImpl de forma geral
* para gerenciar as regras de negócio do sistema.
*
* @param CampanhaCashbackDTO contendo dados para enviar para atualização
* @return uma instância de CampanhaCashbackDTO com resultdo da operação
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
            
           $bo = new idBusinessImpl();
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
* atualizarStatusCampanhaCashback() - Usado para invocar a classe de negócio CampanhaCashbackBusinessImpl de forma geral
* para gerenciar as atualizações do campo STATUS de acordo as regras de negócio do sistema.
*
* @param $id
* @param $status
* @return uma instância de CampanhaCashbackDTO com resultdo da operação
*
*/


    public function autalizarStatusCampanhaCashback($id, $status)
    {
        $daofactory = NULL;
        $retorno = NULL;
        try {
            $daofactory = DAOFactory::getDAOFactory();
            $daofactory->open();
            $daofactory->beginTransaction();
            

           $bo = new CampanhaCashbackBusinessImpl();
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
* cadastrar() - Usado para invocar a classe de negócio CampanhaCashbackBusinessImpl de forma geral
* para gerenciar a criação de registro de acordo as regras de negócio do sistema.
*
* @param $dto - Instância de CampanhaCashbackDTO
*
* @return uma instância de CampanhaCashbackDTO com resultdo da operação
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
            

           $bo = new CampanhaCashbackBusinessImpl();
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
* @return List<CampanhaCashbackDTO>[]
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
            
            // listar paginado CampanhaCashback
           $bo = new CampanhaCashbackBusinessImpl();
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
* realizar uma busca diretamente pela PK (Primary Key) da tabela CAMPANHA_CASHBACK campo CACA_ID
*
* @param $id
* @return CampanhaCashbackDTO
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
            
            // pesquisar pela PK da tabela CampanhaCashback
           $bo = new CampanhaCashbackBusinessImpl();
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
* listarCampanhaCashbackPorStatus() - Usado para invocar a classe de negócio TipoEmpreendimentoBusinessImpl de forma geral
* realizar lista paginada de registros com uma instância de PaginacaoDTO
*
* @param $status
* @param $pag
* @param $qtde
* @param $coluna
* @param $ordem
* @return $PaginacaoDTO
*/

   public function listarCampanhaCashbackPorStatus($status='A', $pag=1, $qtde=0, $coluna=1, $ordem=0) 
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
           // listar paginado CampanhaCashback
           $bo = new CampanhaCashbackBusinessImpl();
           $retorno = $bo->listarCampanhaCashbackPorStatus($daofactory, $status, $pag, $qtde, $coluna, $ordem);
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
* pesquisarPorId_Campanha() - Usado para invocar a classe de negócio CampanhaCashbackBusinessImpl de forma geral
* realizar uma busca de ID da campanha diretamente na tabela CAMPANHA_CASHBACK campo CAMP_ID
*
* @param $id_campanha
* @return CampanhaCashbackDTO
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
            
            // pesquisar pelo atributo CampanhaCashback.id_campanha no campo CAMP_ID da tabela CAMPANHA_CASHBACK
           $bo = new CampanhaCashbackBusinessImpl();
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
* pesquisarPorTitulo() - Usado para invocar a classe de negócio CampanhaCashbackBusinessImpl de forma geral
* realizar uma busca de Titulo diretamente na tabela CAMPANHA_CASHBACK campo CACA_TX_TITULO
*
* @param $titulo
* @return CampanhaCashbackDTO
*
* 
*/

    public function pesquisarPorTitulo($titulo)
    {
        $daofactory = NULL;
        $retorno = NULL;
        try {
            $daofactory = DAOFactory::getDAOFactory();
            $daofactory->open();
            $daofactory->beginTransaction();
            
            // pesquisar pelo atributo CampanhaCashback.titulo no campo CACA_TX_TITULO da tabela CAMPANHA_CASHBACK
           $bo = new CampanhaCashbackBusinessImpl();
           $retorno = $bo->carregarPorTitulo($daofactory, $titulo);
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
* pesquisarPorDescricao() - Usado para invocar a classe de negócio CampanhaCashbackBusinessImpl de forma geral
* realizar uma busca de Descrição diretamente na tabela CAMPANHA_CASHBACK campo CACA_TX_DESCRICAO
*
* @param $descricao
* @return CampanhaCashbackDTO
*
* 
*/

    public function pesquisarPorDescricao($descricao)
    {
        $daofactory = NULL;
        $retorno = NULL;
        try {
            $daofactory = DAOFactory::getDAOFactory();
            $daofactory->open();
            $daofactory->beginTransaction();
            
            // pesquisar pelo atributo CampanhaCashback.descricao no campo CACA_TX_DESCRICAO da tabela CAMPANHA_CASHBACK
           $bo = new CampanhaCashbackBusinessImpl();
           $retorno = $bo->carregarPorDescricao($daofactory, $descricao);
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
* pesquisarPorVlminimoresgate() - Usado para invocar a classe de negócio CampanhaCashbackBusinessImpl de forma geral
* realizar uma busca de Resgatar a partir de diretamente na tabela CAMPANHA_CASHBACK campo CACA_VL_RESGATE
*
* @param $vlMinimoResgate
* @return CampanhaCashbackDTO
*
* 
*/

    public function pesquisarPorVlminimoresgate($vlMinimoResgate)
    {
        $daofactory = NULL;
        $retorno = NULL;
        try {
            $daofactory = DAOFactory::getDAOFactory();
            $daofactory->open();
            $daofactory->beginTransaction();
            
            // pesquisar pelo atributo CampanhaCashback.vlMinimoResgate no campo CACA_VL_RESGATE da tabela CAMPANHA_CASHBACK
           $bo = new CampanhaCashbackBusinessImpl();
           $retorno = $bo->carregarPorVlminimoresgate($daofactory, $vlMinimoResgate);
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
* pesquisarPorPercentual() - Usado para invocar a classe de negócio CampanhaCashbackBusinessImpl de forma geral
* realizar uma busca de Percentual diretamente na tabela CAMPANHA_CASHBACK campo CACA_VL_PERC_CASHBACK
*
* @param $percentual
* @return CampanhaCashbackDTO
*
* 
*/

    public function pesquisarPorPercentual($percentual)
    {
        $daofactory = NULL;
        $retorno = NULL;
        try {
            $daofactory = DAOFactory::getDAOFactory();
            $daofactory->open();
            $daofactory->beginTransaction();
            
            // pesquisar pelo atributo CampanhaCashback.percentual no campo CACA_VL_PERC_CASHBACK da tabela CAMPANHA_CASHBACK
           $bo = new CampanhaCashbackBusinessImpl();
           $retorno = $bo->carregarPorPercentual($daofactory, $percentual);
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
* pesquisarPorDatatermino() - Usado para invocar a classe de negócio CampanhaCashbackBusinessImpl de forma geral
* realizar uma busca de Data de término diretamente na tabela CAMPANHA_CASHBACK campo CACA_DT_TERMINO
*
* @param $dataTermino
* @return CampanhaCashbackDTO
*
* 
*/

    public function pesquisarPorDatatermino($dataTermino)
    {
        $daofactory = NULL;
        $retorno = NULL;
        try {
            $daofactory = DAOFactory::getDAOFactory();
            $daofactory->open();
            $daofactory->beginTransaction();
            
            // pesquisar pelo atributo CampanhaCashback.dataTermino no campo CACA_DT_TERMINO da tabela CAMPANHA_CASHBACK
           $bo = new CampanhaCashbackBusinessImpl();
           $retorno = $bo->carregarPorDatatermino($daofactory, $dataTermino);
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
* pesquisarPorObs() - Usado para invocar a classe de negócio CampanhaCashbackBusinessImpl de forma geral
* realizar uma busca de Observação diretamente na tabela CAMPANHA_CASHBACK campo CACA_TX_OBS
*
* @param $obs
* @return CampanhaCashbackDTO
*
* 
*/

    public function pesquisarPorObs($obs)
    {
        $daofactory = NULL;
        $retorno = NULL;
        try {
            $daofactory = DAOFactory::getDAOFactory();
            $daofactory->open();
            $daofactory->beginTransaction();
            
            // pesquisar pelo atributo CampanhaCashback.obs no campo CACA_TX_OBS da tabela CAMPANHA_CASHBACK
           $bo = new CampanhaCashbackBusinessImpl();
           $retorno = $bo->carregarPorObs($daofactory, $obs);
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
* atualizarId_CampanhaPorPK() - Usado para invocar a classe de negócio CampanhaCashbackBusinessImpl de forma geral
* realizar uma atualização de ID da campanha diretamente na tabela CAMPANHA_CASHBACK campo CAMP_ID
* @param $id
* @param $id_campanha
* @return CampanhaCashbackDTO
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
            
            // atualizar registro por meio do método CampanhaCashbackBusinessImpl::atualizarId_CampanhaPorPK($id_campanha,$id)
           $bo = new CampanhaCashbackBusinessImpl();
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
* atualizarTituloPorPK() - Usado para invocar a classe de negócio CampanhaCashbackBusinessImpl de forma geral
* realizar uma atualização de Titulo diretamente na tabela CAMPANHA_CASHBACK campo CACA_TX_TITULO
* @param $id
* @param $titulo
* @return CampanhaCashbackDTO
*
* 
*/

    public function atualizarTituloPorPK($titulo,$id)
    {
        $daofactory = NULL;
        $retorno = NULL;
        try {
            $daofactory = DAOFactory::getDAOFactory();
            $daofactory->open();
            $daofactory->beginTransaction();
            
            // atualizar registro por meio do método CampanhaCashbackBusinessImpl::atualizarTituloPorPK($titulo,$id)
           $bo = new CampanhaCashbackBusinessImpl();
           $retorno = $bo->atualizarTituloPorPK($daofactory,$titulo,$id);

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
* atualizarDescricaoPorPK() - Usado para invocar a classe de negócio CampanhaCashbackBusinessImpl de forma geral
* realizar uma atualização de Descrição diretamente na tabela CAMPANHA_CASHBACK campo CACA_TX_DESCRICAO
* @param $id
* @param $descricao
* @return CampanhaCashbackDTO
*
* 
*/

    public function atualizarDescricaoPorPK($descricao,$id)
    {
        $daofactory = NULL;
        $retorno = NULL;
        try {
            $daofactory = DAOFactory::getDAOFactory();
            $daofactory->open();
            $daofactory->beginTransaction();
            
            // atualizar registro por meio do método CampanhaCashbackBusinessImpl::atualizarDescricaoPorPK($descricao,$id)
           $bo = new CampanhaCashbackBusinessImpl();
           $retorno = $bo->atualizarDescricaoPorPK($daofactory,$descricao,$id);

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
* atualizarVlminimoresgatePorPK() - Usado para invocar a classe de negócio CampanhaCashbackBusinessImpl de forma geral
* realizar uma atualização de Resgatar a partir de diretamente na tabela CAMPANHA_CASHBACK campo CACA_VL_RESGATE
* @param $id
* @param $vlMinimoResgate
* @return CampanhaCashbackDTO
*
* 
*/

    public function atualizarVlminimoresgatePorPK($vlMinimoResgate,$id)
    {
        $daofactory = NULL;
        $retorno = NULL;
        try {
            $daofactory = DAOFactory::getDAOFactory();
            $daofactory->open();
            $daofactory->beginTransaction();
            
            // atualizar registro por meio do método CampanhaCashbackBusinessImpl::atualizarVlminimoresgatePorPK($vlMinimoResgate,$id)
           $bo = new CampanhaCashbackBusinessImpl();
           $retorno = $bo->atualizarVlminimoresgatePorPK($daofactory,$vlMinimoResgate,$id);

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
* atualizarPercentualPorPK() - Usado para invocar a classe de negócio CampanhaCashbackBusinessImpl de forma geral
* realizar uma atualização de Percentual diretamente na tabela CAMPANHA_CASHBACK campo CACA_VL_PERC_CASHBACK
* @param $id
* @param $percentual
* @return CampanhaCashbackDTO
*
* 
*/

    public function atualizarPercentualPorPK($percentual,$id)
    {
        $daofactory = NULL;
        $retorno = NULL;
        try {
            $daofactory = DAOFactory::getDAOFactory();
            $daofactory->open();
            $daofactory->beginTransaction();
            
            // atualizar registro por meio do método CampanhaCashbackBusinessImpl::atualizarPercentualPorPK($percentual,$id)
           $bo = new CampanhaCashbackBusinessImpl();
           $retorno = $bo->atualizarPercentualPorPK($daofactory,$percentual,$id);

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
* atualizarDataterminoPorPK() - Usado para invocar a classe de negócio CampanhaCashbackBusinessImpl de forma geral
* realizar uma atualização de Data de término diretamente na tabela CAMPANHA_CASHBACK campo CACA_DT_TERMINO
* @param $id
* @param $dataTermino
* @return CampanhaCashbackDTO
*
* 
*/

    public function atualizarDataterminoPorPK($dataTermino,$id)
    {
        $daofactory = NULL;
        $retorno = NULL;
        try {
            $daofactory = DAOFactory::getDAOFactory();
            $daofactory->open();
            $daofactory->beginTransaction();
            
            // atualizar registro por meio do método CampanhaCashbackBusinessImpl::atualizarDataterminoPorPK($dataTermino,$id)
           $bo = new CampanhaCashbackBusinessImpl();
           $retorno = $bo->atualizarDataterminoPorPK($daofactory,$dataTermino,$id);

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
* atualizarObsPorPK() - Usado para invocar a classe de negócio CampanhaCashbackBusinessImpl de forma geral
* realizar uma atualização de Observação diretamente na tabela CAMPANHA_CASHBACK campo CACA_TX_OBS
* @param $id
* @param $obs
* @return CampanhaCashbackDTO
*
* 
*/

    public function atualizarObsPorPK($obs,$id)
    {
        $daofactory = NULL;
        $retorno = NULL;
        try {
            $daofactory = DAOFactory::getDAOFactory();
            $daofactory->open();
            $daofactory->beginTransaction();
            
            // atualizar registro por meio do método CampanhaCashbackBusinessImpl::atualizarObsPorPK($obs,$id)
           $bo = new CampanhaCashbackBusinessImpl();
           $retorno = $bo->atualizarObsPorPK($daofactory,$obs,$id);

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
* listarCampanhaCashbackPorUsuaIdStatus() - Usado para invocar a classe de negócio TipoEmpreendimentoBusinessImpl de forma geral
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

   public function listarCampanhaCashbackPorUsuaIdStatus($usuaid, $status='A', $pag=1, $qtde=0, $coluna=1, $ordem=0) 
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
           // listar paginado CampanhaCashback
           $bo = new CampanhaCashbackBusinessImpl();
           $retorno = $bo->listarCampanhaCashbackPorUsuaIdStatus($daofactory, $usuaid, $status, $pag, $qtde, $coluna, $ordem);
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
