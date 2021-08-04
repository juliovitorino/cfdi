<?php

//importar dependencias
require_once 'CampanhaCashbackResgatePixService.php';
require_once 'CampanhaCashbackResgatePixBusinessImpl.php';
require_once '../variavel/ConstantesVariavel.php';
require_once '../variavel/VariavelCache.php';
require_once '../mensagem/ConstantesMensagem.php';
require_once '../mensagem/MensagemCache.php';

require_once '../daofactory/DAOFactory.php';


/**
*
* CampanhaCashbackResgatePixServiceImpl - Implementação dos servicos para Classe de negócio com métodos para apoiar a integridade de informações sobre a movimentação de resgate via PIX gerenciado pela plataforma
* Camada de Serviços CampanhaCashbackResgatePix - camada responsável pela lógica de negócios de CampanhaCashbackResgatePix do sistema. 
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
* @since 26/07/2021 15:11:48
*
*/
class CampanhaCashbackResgatePixServiceImpl implements CampanhaCashbackResgatePixService
{
    
    function __construct() {    }

/**
*
* listarTudo() - Usado para invocar a classe de negócio CampanhaCashbackResgatePixBusinessImpl de forma geral
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
* PesquisarMaxPKAtivoIdPorStatus() - Usado para invocar a classe de negócio CampanhaCashbackResgatePixBusinessImpl de forma geral
* a buscar a MAIOR PK pra um dado status.
*
* @param status
* @return CampanhaCashbackResgatePixDTO
*
*/

public function pesquisarMaxPKPorStatus($idUsuarioSolicitante, $idUsuarioDevedor,$status)
{
    $daofactory = NULL;
    $retorno = NULL;
    try {
        $daofactory = DAOFactory::getDAOFactory();
        $daofactory->open();
        $daofactory->beginTransaction();
        
       $bo = new CampanhaCashbackResgatePixBusinessImpl();
       $retorno = $bo->pesquisarMaxPKPorStatus($daofactory, $idUsuarioSolicitante, $idUsuarioDevedor,$status);
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
* atualizar() - Usado para invocar a classe de negócio CampanhaCashbackResgatePixBusinessImpl de forma geral
* para gerenciar as regras de negócio do sistema.
*
* @param CampanhaCashbackResgatePixDTO contendo dados para enviar para atualização
* @return uma instância de CampanhaCashbackResgatePixDTO com resultdo da operação
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
            
           $bo = new CampanhaCashbackResgatePixBusinessImpl();
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
* atualizarStatusCampanhaCashbackResgatePix() - Usado para invocar a classe de negócio CampanhaCashbackResgatePixBusinessImpl de forma geral
* para gerenciar as atualizações do campo STATUS de acordo as regras de negócio do sistema.
*
* @param $id
* @param $status
* @return uma instância de CampanhaCashbackResgatePixDTO com resultdo da operação
*
*/


    public function autalizarStatusCampanhaCashbackResgatePix($id, $status)
    {
        $daofactory = NULL;
        $retorno = NULL;
        try {
            $daofactory = DAOFactory::getDAOFactory();
            $daofactory->open();
            $daofactory->beginTransaction();
            

           $bo = new CampanhaCashbackResgatePixBusinessImpl();
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
* cadastrar() - Usado para invocar a classe de negócio CampanhaCashbackResgatePixBusinessImpl de forma geral
* para gerenciar a criação de registro de acordo as regras de negócio do sistema.
*
* @param $dto - Instância de CampanhaCashbackResgatePixDTO
*
* @return uma instância de CampanhaCashbackResgatePixDTO com resultdo da operação
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
            

           $bo = new CampanhaCashbackResgatePixBusinessImpl();
           $retorno = $bo->solicitarResgatePIX($daofactory, $dto);

           if ($retorno->msgcode == ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO) {
                $retorno->msgcode = ConstantesMensagem::SOLICITACAO_PIX_REALIZADA_COM_SUCESSO;
                $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);
    
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
* @return List<CampanhaCashbackResgatePixDTO>[]
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
            
            // listar paginado CampanhaCashbackResgatePix
           $bo = new CampanhaCashbackResgatePixBusinessImpl();
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
* realizar uma busca diretamente pela PK (Primary Key) da tabela CAMPANHA_CASHBACK_RESGATE_PIX campo CCRP_ID
*
* @param $id
* @return CampanhaCashbackResgatePixDTO
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
            
            // pesquisar pela PK da tabela CampanhaCashbackResgatePix
           $bo = new CampanhaCashbackResgatePixBusinessImpl();
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
* listarCampanhaCashbackResgatePixPorStatus() - Usado para invocar a classe de negócio TipoEmpreendimentoBusinessImpl de forma geral
* realizar lista paginada de registros com uma instância de PaginacaoDTO
*
* @param $status
* @param $pag
* @param $qtde
* @param $coluna
* @param $ordem
* @return $PaginacaoDTO
*/

   public function listarCampanhaCashbackResgatePixPorStatus($status='A', $pag=1, $qtde=0, $coluna=1, $ordem=0) 
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
           // listar paginado CampanhaCashbackResgatePix
           $bo = new CampanhaCashbackResgatePixBusinessImpl();
           $retorno = $bo->listarCampanhaCashbackResgatePixPorStatus($daofactory, $status, $pag, $qtde, $coluna, $ordem);
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
* pesquisarPorIdcampanhacashback() - Usado para invocar a classe de negócio CampanhaCashbackResgatePixBusinessImpl de forma geral
* realizar uma busca de ID Campanha x Cashback diretamente na tabela CAMPANHA_CASHBACK_RESGATE_PIX campo CACA_ID
*
* @param $idUsuarioDevedor
* @return CampanhaCashbackResgatePixDTO
*
* 
*/

    public function pesquisarPorIdUsuarioDevedor($idUsuarioDevedor)
    {
        $daofactory = NULL;
        $retorno = NULL;
        try {
            $daofactory = DAOFactory::getDAOFactory();
            $daofactory->open();
            $daofactory->beginTransaction();
            
            // pesquisar pelo atributo CampanhaCashbackResgatePix.idUsuarioDevedor no campo CACA_ID da tabela CAMPANHA_CASHBACK_RESGATE_PIX
           $bo = new CampanhaCashbackResgatePixBusinessImpl();
           $retorno = $bo->carregarPorIdUsuarioDevedor($daofactory, $idUsuarioDevedor);
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
* pesquisarPorIdusuariosolicitante() - Usado para invocar a classe de negócio CampanhaCashbackResgatePixBusinessImpl de forma geral
* realizar uma busca de ID do usuário solicitante diretamente na tabela CAMPANHA_CASHBACK_RESGATE_PIX campo USUA_ID
*
* @param $idUsuarioSolicitante
* @return CampanhaCashbackResgatePixDTO
*
* 
*/

    public function pesquisarPorIdusuariosolicitante($idUsuarioSolicitante)
    {
        $daofactory = NULL;
        $retorno = NULL;
        try {
            $daofactory = DAOFactory::getDAOFactory();
            $daofactory->open();
            $daofactory->beginTransaction();
            
            // pesquisar pelo atributo CampanhaCashbackResgatePix.idUsuarioSolicitante no campo USUA_ID da tabela CAMPANHA_CASHBACK_RESGATE_PIX
           $bo = new CampanhaCashbackResgatePixBusinessImpl();
           $retorno = $bo->carregarPorIdusuariosolicitante($daofactory, $idUsuarioSolicitante);
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
* pesquisarPorTipochavepix() - Usado para invocar a classe de negócio CampanhaCashbackResgatePixBusinessImpl de forma geral
* realizar uma busca de Tipo da Chave PIX diretamente na tabela CAMPANHA_CASHBACK_RESGATE_PIX campo CCRP_IN_TIPO_CHAVE_PIX
*
* @param $tipoChavePix
* @return CampanhaCashbackResgatePixDTO
*
* 
*/

    public function pesquisarPorTipochavepix($tipoChavePix)
    {
        $daofactory = NULL;
        $retorno = NULL;
        try {
            $daofactory = DAOFactory::getDAOFactory();
            $daofactory->open();
            $daofactory->beginTransaction();
            
            // pesquisar pelo atributo CampanhaCashbackResgatePix.tipoChavePix no campo CCRP_IN_TIPO_CHAVE_PIX da tabela CAMPANHA_CASHBACK_RESGATE_PIX
           $bo = new CampanhaCashbackResgatePixBusinessImpl();
           $retorno = $bo->carregarPorTipochavepix($daofactory, $tipoChavePix);
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
* pesquisarPorChavepix() - Usado para invocar a classe de negócio CampanhaCashbackResgatePixBusinessImpl de forma geral
* realizar uma busca de Chave PIX diretamente na tabela CAMPANHA_CASHBACK_RESGATE_PIX campo CCRP_TX_CHAVE_PIX
*
* @param $chavePix
* @return CampanhaCashbackResgatePixDTO
*
* 
*/

    public function pesquisarPorChavepix($chavePix)
    {
        $daofactory = NULL;
        $retorno = NULL;
        try {
            $daofactory = DAOFactory::getDAOFactory();
            $daofactory->open();
            $daofactory->beginTransaction();
            
            // pesquisar pelo atributo CampanhaCashbackResgatePix.chavePix no campo CCRP_TX_CHAVE_PIX da tabela CAMPANHA_CASHBACK_RESGATE_PIX
           $bo = new CampanhaCashbackResgatePixBusinessImpl();
           $retorno = $bo->carregarPorChavepix($daofactory, $chavePix);
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
* pesquisarPorValorresgate() - Usado para invocar a classe de negócio CampanhaCashbackResgatePixBusinessImpl de forma geral
* realizar uma busca de Valor Pretendido a Resgatar diretamente na tabela CAMPANHA_CASHBACK_RESGATE_PIX campo CCRP_VL_RESGATE
*
* @param $valorResgate
* @return CampanhaCashbackResgatePixDTO
*
* 
*/

    public function pesquisarPorValorresgate($valorResgate)
    {
        $daofactory = NULL;
        $retorno = NULL;
        try {
            $daofactory = DAOFactory::getDAOFactory();
            $daofactory->open();
            $daofactory->beginTransaction();
            
            // pesquisar pelo atributo CampanhaCashbackResgatePix.valorResgate no campo CCRP_VL_RESGATE da tabela CAMPANHA_CASHBACK_RESGATE_PIX
           $bo = new CampanhaCashbackResgatePixBusinessImpl();
           $retorno = $bo->carregarPorValorresgate($daofactory, $valorResgate);
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
* pesquisarPorAutenticacaobco() - Usado para invocar a classe de negócio CampanhaCashbackResgatePixBusinessImpl de forma geral
* realizar uma busca de Autenticação do Banco diretamente na tabela CAMPANHA_CASHBACK_RESGATE_PIX campo CCRP_TX_AUTENT_BCO
*
* @param $autenticacaoBco
* @return CampanhaCashbackResgatePixDTO
*
* 
*/

    public function pesquisarPorAutenticacaobco($autenticacaoBco)
    {
        $daofactory = NULL;
        $retorno = NULL;
        try {
            $daofactory = DAOFactory::getDAOFactory();
            $daofactory->open();
            $daofactory->beginTransaction();
            
            // pesquisar pelo atributo CampanhaCashbackResgatePix.autenticacaoBco no campo CCRP_TX_AUTENT_BCO da tabela CAMPANHA_CASHBACK_RESGATE_PIX
           $bo = new CampanhaCashbackResgatePixBusinessImpl();
           $retorno = $bo->carregarPorAutenticacaobco($daofactory, $autenticacaoBco);
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
* pesquisarPorEstagiorealtime() - Usado para invocar a classe de negócio CampanhaCashbackResgatePixBusinessImpl de forma geral
* realizar uma busca de Estágio Real Time diretamente na tabela CAMPANHA_CASHBACK_RESGATE_PIX campo CCRP_IN_ESTAGIO_RT
*
* @param $estagioRealTime
* @return CampanhaCashbackResgatePixDTO
*
* 
*/

    public function pesquisarPorEstagiorealtime($estagioRealTime)
    {
        $daofactory = NULL;
        $retorno = NULL;
        try {
            $daofactory = DAOFactory::getDAOFactory();
            $daofactory->open();
            $daofactory->beginTransaction();
            
            // pesquisar pelo atributo CampanhaCashbackResgatePix.estagioRealTime no campo CCRP_IN_ESTAGIO_RT da tabela CAMPANHA_CASHBACK_RESGATE_PIX
           $bo = new CampanhaCashbackResgatePixBusinessImpl();
           $retorno = $bo->carregarPorEstagiorealtime($daofactory, $estagioRealTime);
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
* pesquisarPorDtestagioanalise() - Usado para invocar a classe de negócio CampanhaCashbackResgatePixBusinessImpl de forma geral
* realizar uma busca de Data Registro Estágio Análise diretamente na tabela CAMPANHA_CASHBACK_RESGATE_PIX campo CCRP_DT_ESTAGIO_ANALISE
*
* @param $dtEstagioAnalise
* @return CampanhaCashbackResgatePixDTO
*
* 
*/

    public function pesquisarPorDtestagioanalise($dtEstagioAnalise)
    {
        $daofactory = NULL;
        $retorno = NULL;
        try {
            $daofactory = DAOFactory::getDAOFactory();
            $daofactory->open();
            $daofactory->beginTransaction();
            
            // pesquisar pelo atributo CampanhaCashbackResgatePix.dtEstagioAnalise no campo CCRP_DT_ESTAGIO_ANALISE da tabela CAMPANHA_CASHBACK_RESGATE_PIX
           $bo = new CampanhaCashbackResgatePixBusinessImpl();
           $retorno = $bo->carregarPorDtestagioanalise($daofactory, $dtEstagioAnalise);
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
* pesquisarPorDtestagiofinanceiro() - Usado para invocar a classe de negócio CampanhaCashbackResgatePixBusinessImpl de forma geral
* realizar uma busca de Data Registro Estágio Financeiro diretamente na tabela CAMPANHA_CASHBACK_RESGATE_PIX campo CCRP_DT_ESTAGIO_FINANCEIRO
*
* @param $dtEstagioFinanceiro
* @return CampanhaCashbackResgatePixDTO
*
* 
*/

    public function pesquisarPorDtestagiofinanceiro($dtEstagioFinanceiro)
    {
        $daofactory = NULL;
        $retorno = NULL;
        try {
            $daofactory = DAOFactory::getDAOFactory();
            $daofactory->open();
            $daofactory->beginTransaction();
            
            // pesquisar pelo atributo CampanhaCashbackResgatePix.dtEstagioFinanceiro no campo CCRP_DT_ESTAGIO_FINANCEIRO da tabela CAMPANHA_CASHBACK_RESGATE_PIX
           $bo = new CampanhaCashbackResgatePixBusinessImpl();
           $retorno = $bo->carregarPorDtestagiofinanceiro($daofactory, $dtEstagioFinanceiro);
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
* pesquisarPorDtestagioerro() - Usado para invocar a classe de negócio CampanhaCashbackResgatePixBusinessImpl de forma geral
* realizar uma busca de Data Registro Estágio Erro diretamente na tabela CAMPANHA_CASHBACK_RESGATE_PIX campo CCRP_DT_ESTAGIO_ERRO
*
* @param $dtEstagioErro
* @return CampanhaCashbackResgatePixDTO
*
* 
*/

    public function pesquisarPorDtestagioerro($dtEstagioErro)
    {
        $daofactory = NULL;
        $retorno = NULL;
        try {
            $daofactory = DAOFactory::getDAOFactory();
            $daofactory->open();
            $daofactory->beginTransaction();
            
            // pesquisar pelo atributo CampanhaCashbackResgatePix.dtEstagioErro no campo CCRP_DT_ESTAGIO_ERRO da tabela CAMPANHA_CASHBACK_RESGATE_PIX
           $bo = new CampanhaCashbackResgatePixBusinessImpl();
           $retorno = $bo->carregarPorDtestagioerro($daofactory, $dtEstagioErro);
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
* pesquisarPorDtestagiotranfbco() - Usado para invocar a classe de negócio CampanhaCashbackResgatePixBusinessImpl de forma geral
* realizar uma busca de Data Registro Estágio Transferido Bco diretamente na tabela CAMPANHA_CASHBACK_RESGATE_PIX campo CCRP_DT_ESTAGIO_TRANSF_BCO
*
* @param $dtEstagioTranfBco
* @return CampanhaCashbackResgatePixDTO
*
* 
*/

    public function pesquisarPorDtestagiotranfbco($dtEstagioTranfBco)
    {
        $daofactory = NULL;
        $retorno = NULL;
        try {
            $daofactory = DAOFactory::getDAOFactory();
            $daofactory->open();
            $daofactory->beginTransaction();
            
            // pesquisar pelo atributo CampanhaCashbackResgatePix.dtEstagioTranfBco no campo CCRP_DT_ESTAGIO_TRANSF_BCO da tabela CAMPANHA_CASHBACK_RESGATE_PIX
           $bo = new CampanhaCashbackResgatePixBusinessImpl();
           $retorno = $bo->carregarPorDtestagiotranfbco($daofactory, $dtEstagioTranfBco);
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
* pesquisarPorTxtlivreestagiort() - Usado para invocar a classe de negócio CampanhaCashbackResgatePixBusinessImpl de forma geral
* realizar uma busca de Texto Livre do Estagio RT diretamente na tabela CAMPANHA_CASHBACK_RESGATE_PIX campo CCRP_TX_LIVRE_ESTAGIO_RT
*
* @param $txtLivreEstagioRT
* @return CampanhaCashbackResgatePixDTO
*
* 
*/

    public function pesquisarPorTxtlivreestagiort($txtLivreEstagioRT)
    {
        $daofactory = NULL;
        $retorno = NULL;
        try {
            $daofactory = DAOFactory::getDAOFactory();
            $daofactory->open();
            $daofactory->beginTransaction();
            
            // pesquisar pelo atributo CampanhaCashbackResgatePix.txtLivreEstagioRT no campo CCRP_TX_LIVRE_ESTAGIO_RT da tabela CAMPANHA_CASHBACK_RESGATE_PIX
           $bo = new CampanhaCashbackResgatePixBusinessImpl();
           $retorno = $bo->carregarPorTxtlivreestagiort($daofactory, $txtLivreEstagioRT);
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
* atualizarIdcampanhacashbackPorPK() - Usado para invocar a classe de negócio CampanhaCashbackResgatePixBusinessImpl de forma geral
* realizar uma atualização de ID Campanha x Cashback diretamente na tabela CAMPANHA_CASHBACK_RESGATE_PIX campo CACA_ID
* @param $id
* @param $idUsuarioDevedor
* @return CampanhaCashbackResgatePixDTO
*
* 
*/

    public function atualizarIdUsuarioDevedorPorPK($idUsuarioDevedor,$id)
    {
        $daofactory = NULL;
        $retorno = NULL;
        try {
            $daofactory = DAOFactory::getDAOFactory();
            $daofactory->open();
            $daofactory->beginTransaction();
            
            // atualizar registro por meio do método CampanhaCashbackResgatePixBusinessImpl::atualizarIdcampanhacashbackPorPK($idUsuarioDevedor,$id)
           $bo = new CampanhaCashbackResgatePixBusinessImpl();
           $retorno = $bo->atualizarIdUsuarioDevedorPorPK($daofactory,$idUsuarioDevedor,$id);

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
* atualizarIdusuariosolicitantePorPK() - Usado para invocar a classe de negócio CampanhaCashbackResgatePixBusinessImpl de forma geral
* realizar uma atualização de ID do usuário solicitante diretamente na tabela CAMPANHA_CASHBACK_RESGATE_PIX campo USUA_ID
* @param $id
* @param $idUsuarioSolicitante
* @return CampanhaCashbackResgatePixDTO
*
* 
*/

    public function atualizarIdusuariosolicitantePorPK($idUsuarioSolicitante,$id)
    {
        $daofactory = NULL;
        $retorno = NULL;
        try {
            $daofactory = DAOFactory::getDAOFactory();
            $daofactory->open();
            $daofactory->beginTransaction();
            
            // atualizar registro por meio do método CampanhaCashbackResgatePixBusinessImpl::atualizarIdusuariosolicitantePorPK($idUsuarioSolicitante,$id)
           $bo = new CampanhaCashbackResgatePixBusinessImpl();
           $retorno = $bo->atualizarIdusuariosolicitantePorPK($daofactory,$idUsuarioSolicitante,$id);

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
* atualizarTipochavepixPorPK() - Usado para invocar a classe de negócio CampanhaCashbackResgatePixBusinessImpl de forma geral
* realizar uma atualização de Tipo da Chave PIX diretamente na tabela CAMPANHA_CASHBACK_RESGATE_PIX campo CCRP_IN_TIPO_CHAVE_PIX
* @param $id
* @param $tipoChavePix
* @return CampanhaCashbackResgatePixDTO
*
* 
*/

    public function atualizarTipochavepixPorPK($tipoChavePix,$id)
    {
        $daofactory = NULL;
        $retorno = NULL;
        try {
            $daofactory = DAOFactory::getDAOFactory();
            $daofactory->open();
            $daofactory->beginTransaction();
            
            // atualizar registro por meio do método CampanhaCashbackResgatePixBusinessImpl::atualizarTipochavepixPorPK($tipoChavePix,$id)
           $bo = new CampanhaCashbackResgatePixBusinessImpl();
           $retorno = $bo->atualizarTipochavepixPorPK($daofactory,$tipoChavePix,$id);

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
* atualizarChavepixPorPK() - Usado para invocar a classe de negócio CampanhaCashbackResgatePixBusinessImpl de forma geral
* realizar uma atualização de Chave PIX diretamente na tabela CAMPANHA_CASHBACK_RESGATE_PIX campo CCRP_TX_CHAVE_PIX
* @param $id
* @param $chavePix
* @return CampanhaCashbackResgatePixDTO
*
* 
*/

    public function atualizarChavepixPorPK($chavePix,$id)
    {
        $daofactory = NULL;
        $retorno = NULL;
        try {
            $daofactory = DAOFactory::getDAOFactory();
            $daofactory->open();
            $daofactory->beginTransaction();
            
            // atualizar registro por meio do método CampanhaCashbackResgatePixBusinessImpl::atualizarChavepixPorPK($chavePix,$id)
           $bo = new CampanhaCashbackResgatePixBusinessImpl();
           $retorno = $bo->atualizarChavepixPorPK($daofactory,$chavePix,$id);

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
* atualizarValorresgatePorPK() - Usado para invocar a classe de negócio CampanhaCashbackResgatePixBusinessImpl de forma geral
* realizar uma atualização de Valor Pretendido a Resgatar diretamente na tabela CAMPANHA_CASHBACK_RESGATE_PIX campo CCRP_VL_RESGATE
* @param $id
* @param $valorResgate
* @return CampanhaCashbackResgatePixDTO
*
* 
*/

    public function atualizarValorresgatePorPK($valorResgate,$id)
    {
        $daofactory = NULL;
        $retorno = NULL;
        try {
            $daofactory = DAOFactory::getDAOFactory();
            $daofactory->open();
            $daofactory->beginTransaction();
            
            // atualizar registro por meio do método CampanhaCashbackResgatePixBusinessImpl::atualizarValorresgatePorPK($valorResgate,$id)
           $bo = new CampanhaCashbackResgatePixBusinessImpl();
           $retorno = $bo->atualizarValorresgatePorPK($daofactory,$valorResgate,$id);

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
* atualizarAutenticacaobcoPorPK() - Usado para invocar a classe de negócio CampanhaCashbackResgatePixBusinessImpl de forma geral
* realizar uma atualização de Autenticação do Banco diretamente na tabela CAMPANHA_CASHBACK_RESGATE_PIX campo CCRP_TX_AUTENT_BCO
* @param $id
* @param $autenticacaoBco
* @return CampanhaCashbackResgatePixDTO
*
* 
*/

    public function atualizarAutenticacaobcoPorPK($autenticacaoBco,$id)
    {
        $daofactory = NULL;
        $retorno = NULL;
        try {
            $daofactory = DAOFactory::getDAOFactory();
            $daofactory->open();
            $daofactory->beginTransaction();
            
            // atualizar registro por meio do método CampanhaCashbackResgatePixBusinessImpl::atualizarAutenticacaobcoPorPK($autenticacaoBco,$id)
           $bo = new CampanhaCashbackResgatePixBusinessImpl();
           $retorno = $bo->atualizarAutenticacaobcoPorPK($daofactory,$autenticacaoBco,$id);

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
* atualizarEstagiorealtimePorPK() - Usado para invocar a classe de negócio CampanhaCashbackResgatePixBusinessImpl de forma geral
* realizar uma atualização de Estágio Real Time diretamente na tabela CAMPANHA_CASHBACK_RESGATE_PIX campo CCRP_IN_ESTAGIO_RT
* @param $id
* @param $estagioRealTime
* @return CampanhaCashbackResgatePixDTO
*
* 
*/

    public function atualizarEstagiorealtimePorPK($estagioRealTime,$id)
    {
        $daofactory = NULL;
        $retorno = NULL;
        try {
            $daofactory = DAOFactory::getDAOFactory();
            $daofactory->open();
            $daofactory->beginTransaction();
            
            // atualizar registro por meio do método CampanhaCashbackResgatePixBusinessImpl::atualizarEstagiorealtimePorPK($estagioRealTime,$id)
           $bo = new CampanhaCashbackResgatePixBusinessImpl();
           $retorno = $bo->atualizarEstagiorealtimePorPK($daofactory,$estagioRealTime,$id);

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
* atualizarDtestagioanalisePorPK() - Usado para invocar a classe de negócio CampanhaCashbackResgatePixBusinessImpl de forma geral
* realizar uma atualização de Data Registro Estágio Análise diretamente na tabela CAMPANHA_CASHBACK_RESGATE_PIX campo CCRP_DT_ESTAGIO_ANALISE
* @param $id
* @param $dtEstagioAnalise
* @return CampanhaCashbackResgatePixDTO
*
* 
*/

    public function atualizarDtestagioanalisePorPK($dtEstagioAnalise,$id)
    {
        $daofactory = NULL;
        $retorno = NULL;
        try {
            $daofactory = DAOFactory::getDAOFactory();
            $daofactory->open();
            $daofactory->beginTransaction();
            
            // atualizar registro por meio do método CampanhaCashbackResgatePixBusinessImpl::atualizarDtestagioanalisePorPK($dtEstagioAnalise,$id)
           $bo = new CampanhaCashbackResgatePixBusinessImpl();
           $retorno = $bo->atualizarDtestagioanalisePorPK($daofactory,$dtEstagioAnalise,$id);

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
* atualizarDtestagiofinanceiroPorPK() - Usado para invocar a classe de negócio CampanhaCashbackResgatePixBusinessImpl de forma geral
* realizar uma atualização de Data Registro Estágio Financeiro diretamente na tabela CAMPANHA_CASHBACK_RESGATE_PIX campo CCRP_DT_ESTAGIO_FINANCEIRO
* @param $id
* @param $dtEstagioFinanceiro
* @return CampanhaCashbackResgatePixDTO
*
* 
*/

    public function atualizarDtestagiofinanceiroPorPK($dtEstagioFinanceiro,$id)
    {
        $daofactory = NULL;
        $retorno = NULL;
        try {
            $daofactory = DAOFactory::getDAOFactory();
            $daofactory->open();
            $daofactory->beginTransaction();
            
            // atualizar registro por meio do método CampanhaCashbackResgatePixBusinessImpl::atualizarDtestagiofinanceiroPorPK($dtEstagioFinanceiro,$id)
           $bo = new CampanhaCashbackResgatePixBusinessImpl();
           $retorno = $bo->atualizarDtestagiofinanceiroPorPK($daofactory,$dtEstagioFinanceiro,$id);

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
* atualizarDtestagioerroPorPK() - Usado para invocar a classe de negócio CampanhaCashbackResgatePixBusinessImpl de forma geral
* realizar uma atualização de Data Registro Estágio Erro diretamente na tabela CAMPANHA_CASHBACK_RESGATE_PIX campo CCRP_DT_ESTAGIO_ERRO
* @param $id
* @param $dtEstagioErro
* @return CampanhaCashbackResgatePixDTO
*
* 
*/

    public function atualizarDtestagioerroPorPK($dtEstagioErro,$id)
    {
        $daofactory = NULL;
        $retorno = NULL;
        try {
            $daofactory = DAOFactory::getDAOFactory();
            $daofactory->open();
            $daofactory->beginTransaction();
            
            // atualizar registro por meio do método CampanhaCashbackResgatePixBusinessImpl::atualizarDtestagioerroPorPK($dtEstagioErro,$id)
           $bo = new CampanhaCashbackResgatePixBusinessImpl();
           $retorno = $bo->atualizarDtestagioerroPorPK($daofactory,$dtEstagioErro,$id);

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
* atualizarTxtlivreestagiortPorPK() - Usado para invocar a classe de negócio CampanhaCashbackResgatePixBusinessImpl de forma geral
* realizar uma atualização de Data Registro Estágio Erro diretamente na tabela CAMPANHA_CASHBACK_RESGATE_PIX campo CCRP_DT_ESTAGIO_ERRO
* @param $id
* @param $dtEstagioErro
* @return CampanhaCashbackResgatePixDTO
*
* 
*/

    public function atualizarTxtlivreestagiortPorPK($txtLivreEstagioRT,$id)
    {
        $daofactory = NULL;
        $retorno = NULL;
        try {
            $daofactory = DAOFactory::getDAOFactory();
            $daofactory->open();
            $daofactory->beginTransaction();
            
        $bo = new CampanhaCashbackResgatePixBusinessImpl();
        $retorno = $bo->atualizarTxtlivreestagiortPorPK($daofactory,$txtLivreEstagioRT,$id);

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
* atualizarDtestagiotranfbcoPorPK() - Usado para invocar a classe de negócio CampanhaCashbackResgatePixBusinessImpl de forma geral
* realizar uma atualização de Data Registro Estágio Erro diretamente na tabela CAMPANHA_CASHBACK_RESGATE_PIX campo CCRP_DT_ESTAGIO_ERRO
* @param $id
* @param $dtEstagioErro
* @return CampanhaCashbackResgatePixDTO
*
* 
*/

    public function atualizarDtestagiotranfbcoPorPK($dtEstagioTranfBco,$id)
    {
        $daofactory = NULL;
        $retorno = NULL;
        try {
            $daofactory = DAOFactory::getDAOFactory();
            $daofactory->open();
            $daofactory->beginTransaction();
            
        $bo = new CampanhaCashbackResgatePixBusinessImpl();
        $retorno = $bo->atualizarDtestagiotranfbcoPorPK($daofactory,$dtEstagioTranfBco,$id);

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
* listarCampanhaCashbackResgatePixPorUsuaIdStatus() - Usado para invocar a classe de negócio TipoEmpreendimentoBusinessImpl de forma geral
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

   public function listarCampanhaCashbackResgatePixPorUsuaIdStatus($usuaid, $status='A', $pag=1, $qtde=0, $coluna=1, $ordem=0) 
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
           // listar paginado CampanhaCashbackResgatePix
           $bo = new CampanhaCashbackResgatePixBusinessImpl();
           $retorno = $bo->listarCampanhaCashbackResgatePixPorUsuaIdStatus($daofactory, $usuaid, $status, $pag, $qtde, $coluna, $ordem);
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
* listarCampanhaCashbackResgatePixPorUsuaIdUsuaIdDevedorStatus() - Usado para invocar a classe de negócio TipoEmpreendimentoBusinessImpl de forma geral
* realizar lista paginada de registros tendo como referência os registros do usuário logado com uma instância de PaginacaoDTO
*
* @param $usuaid
* @param $usuaidDevedor
* @param $status
* @param $pag
* @param $qtde
* @param $coluna
* @param $ordem
* @return $PaginacaoDTO
*/

    public function listarCampanhaCashbackResgatePixPorUsuaIdUsuaIdDevedorStatus($usuaid, $usuaidDevedor, $status='A', $pag=1, $qtde=0, $coluna=1, $ordem=0)
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
            // listar paginado CampanhaCashbackResgatePix
            $bo = new CampanhaCashbackResgatePixBusinessImpl();
            $retorno = $bo->listarCampanhaCashbackResgatePixPorUsuaIdUsuaIdDevedorStatus($daofactory, $usuaid, $usuaidDevedor, $status, $pag, $qtde, $coluna, $ordem);
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
