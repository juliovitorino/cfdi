<?php

//importar dependencias
require_once 'CampanhaSorteioService.php';
require_once 'CampanhaSorteioBusinessImpl.php';
require_once '../variavel/ConstantesVariavel.php';
require_once '../variavel/VariavelCache.php';
require_once '../mensagem/ConstantesMensagem.php';
require_once '../mensagem/MensagemCache.php';

require_once '../daofactory/DAOFactory.php';


/**
*
* CampanhaSorteioServiceImpl - Implementação dos servicos para Classe de negócio com métodos para apoiar a integridade de informações sobre sorteios em campanhas gerenciado pela plataforma
* Camada de Serviços CampanhaSorteio - camada responsável pela lógica de negócios de CampanhaSorteio do sistema. 
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
* @since 16/06/2021 12:57:19
*
*/
class CampanhaSorteioServiceImpl implements CampanhaSorteioService
{
    
     function __construct() {}

/**
*
* listarTudo() - Usado para invocar a classe de negócio CampanhaSorteioBusinessImpl de forma geral
* para listar todos os registros sem critérios de paginação dos dados.
*
* Use este método com MUITA moderação.
*/

     public function listarTudo() {}
     public function pesquisar($dto){}
     public function apagar($dto) {}
     public function cancelar($dto) {}

/**
*
* PesquisarMaxPKAtivoIdPorStatus() - Usado para invocar a classe de negócio CampanhaSorteioBusinessImpl de forma geral
* a buscar a MAIOR PK pra um dado status.
*
* @param status
* @return CampanhaSorteioDTO
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
        
       $bo = new CampanhaSorteioBusinessImpl();
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
* atualizar() - Usado para invocar a classe de negócio CampanhaSorteioBusinessImpl de forma geral
* para gerenciar as regras de negócio do sistema.
*
* @param CampanhaSorteioDTO contendo dados para enviar para atualização
* @return uma instância de CampanhaSorteioDTO com resultdo da operação
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
                
              $bo = new CampanhaSorteioBusinessImpl();
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
* atualizarStatusCampanhaSorteio() - Usado para invocar a classe de negócio CampanhaSorteioBusinessImpl de forma geral
* para gerenciar as atualizações do campo STATUS de acordo as regras de negócio do sistema.
*
* @param $id
* @param $status
* @return uma instância de CampanhaSorteioDTO com resultdo da operação
*
*/


     public function autalizarStatusCampanhaSorteio($id, $status)
     {
          $daofactory = NULL;
          $retorno = NULL;
          try {
                $daofactory = DAOFactory::getDAOFactory();
                $daofactory->open();
                $daofactory->beginTransaction();
                

              $bo = new CampanhaSorteioBusinessImpl();
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
* ativarCampanhaSorteio() - Ativar uma campanha sorteio com status PENDENTE.
*
* @param $id 
*
*/

     public function ativarCampanhaSorteio($id)
     {

        //var_dump("service::ativarCampanhaSorteio($id)");

        $daofactory = NULL;
        $retorno = NULL;
        try {
              $daofactory = DAOFactory::getDAOFactory();
              $daofactory->open();
              $daofactory->beginTransaction();
              

            $bo = new CampanhaSorteioBusinessImpl();
            $retorno = $bo->ativarCampanhaSorteio($daofactory, $id);

            if ($retorno->msgcode == ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO
                || $retorno->msgcode == ConstantesMensagem::CAMPANHA_SORTEIO_STATUS_PRECISA_SER_VERIFICADO
            ) {
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
* cadastrar() - Usado para invocar a classe de negócio CampanhaSorteioBusinessImpl de forma geral
* para gerenciar a criação de registro de acordo as regras de negócio do sistema.
*
* @param $dto - Instância de CampanhaSorteioDTO
*
* @return uma instância de CampanhaSorteioDTO com resultdo da operação
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
                

              $bo = new CampanhaSorteioBusinessImpl();
              $retorno = $bo->criarSorteio($daofactory, $dto);

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
* @return List<CampanhaSorteioDTO>[]
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
                
                // listar paginado CampanhaSorteio
              $bo = new CampanhaSorteioBusinessImpl();
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
* realizar uma busca diretamente pela PK (Primary Key) da tabela CAMPANHA_SORTEIO campo CASO_ID
*
* @param $id
* @return CampanhaSorteioDTO
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
                
                // pesquisar pela PK da tabela CampanhaSorteio
              $bo = new CampanhaSorteioBusinessImpl();
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
* listarCampanhaSorteioPorStatus() - Usado para invocar a classe de negócio TipoEmpreendimentoBusinessImpl de forma geral
* realizar lista paginada de registros com uma instância de PaginacaoDTO
*
* @param $status
* @param $pag
* @param $qtde
* @param $coluna
* @param $ordem
* @return $PaginacaoDTO
*/

   public function listarCampanhaSorteioPorStatus($status='A', $pag=1, $qtde=0, $coluna=1, $ordem=0) 
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
           // listar paginado CampanhaSorteio
           $bo = new CampanhaSorteioBusinessImpl();
           $retorno = $bo->listarCampanhaSorteioPorStatus($daofactory, $status, $pag, $qtde, $coluna, $ordem);
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
* pesquisarPorId_Campanha() - Usado para invocar a classe de negócio CampanhaSorteioBusinessImpl de forma geral
* realizar uma busca de ID da campanha diretamente na tabela CAMPANHA_SORTEIO campo CAMP_ID
*
* @param $id_campanha
* @return CampanhaSorteioDTO
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
                
                // pesquisar pelo atributo CampanhaSorteio.id_campanha no campo CAMP_ID da tabela CAMPANHA_SORTEIO
              $bo = new CampanhaSorteioBusinessImpl();
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
* pesquisarPorNome() - Usado para invocar a classe de negócio CampanhaSorteioBusinessImpl de forma geral
* realizar uma busca de Nome do sorteio diretamente na tabela CAMPANHA_SORTEIO campo CASO_TX_NOME
*
* @param $nome
* @return CampanhaSorteioDTO
*
* 
*/

     public function pesquisarPorNome($nome)
     {
          $daofactory = NULL;
          $retorno = NULL;
          try {
                $daofactory = DAOFactory::getDAOFactory();
                $daofactory->open();
                $daofactory->beginTransaction();
                
                // pesquisar pelo atributo CampanhaSorteio.nome no campo CASO_TX_NOME da tabela CAMPANHA_SORTEIO
              $bo = new CampanhaSorteioBusinessImpl();
              $retorno = $bo->carregarPorNome($daofactory, $nome);
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
* pesquisarPorUrlregulamento() - Usado para invocar a classe de negócio CampanhaSorteioBusinessImpl de forma geral
* realizar uma busca de URL regulamento do sorteio diretamente na tabela CAMPANHA_SORTEIO campo CASO_TX_URL_REGULAMENTO
*
* @param $urlRegulamento
* @return CampanhaSorteioDTO
*
* 
*/

     public function pesquisarPorUrlregulamento($urlRegulamento)
     {
          $daofactory = NULL;
          $retorno = NULL;
          try {
                $daofactory = DAOFactory::getDAOFactory();
                $daofactory->open();
                $daofactory->beginTransaction();
                
                // pesquisar pelo atributo CampanhaSorteio.urlRegulamento no campo CASO_TX_URL_REGULAMENTO da tabela CAMPANHA_SORTEIO
              $bo = new CampanhaSorteioBusinessImpl();
              $retorno = $bo->carregarPorUrlregulamento($daofactory, $urlRegulamento);
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
* pesquisarPorPremio() - Usado para invocar a classe de negócio CampanhaSorteioBusinessImpl de forma geral
* realizar uma busca de Prêmio do sorteio diretamente na tabela CAMPANHA_SORTEIO campo CASO_TX_PREMIO
*
* @param $premio
* @return CampanhaSorteioDTO
*
* 
*/

     public function pesquisarPorPremio($premio)
     {
          $daofactory = NULL;
          $retorno = NULL;
          try {
                $daofactory = DAOFactory::getDAOFactory();
                $daofactory->open();
                $daofactory->beginTransaction();
                
                // pesquisar pelo atributo CampanhaSorteio.premio no campo CASO_TX_PREMIO da tabela CAMPANHA_SORTEIO
              $bo = new CampanhaSorteioBusinessImpl();
              $retorno = $bo->carregarPorPremio($daofactory, $premio);
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
* pesquisarPorDatacomecosorteio() - Usado para invocar a classe de negócio CampanhaSorteioBusinessImpl de forma geral
* realizar uma busca de Data de início diretamente na tabela CAMPANHA_SORTEIO campo CASO_DT_INICIO
*
* @param $dataComecoSorteio
* @return CampanhaSorteioDTO
*
* 
*/

     public function pesquisarPorDatacomecosorteio($dataComecoSorteio)
     {
          $daofactory = NULL;
          $retorno = NULL;
          try {
                $daofactory = DAOFactory::getDAOFactory();
                $daofactory->open();
                $daofactory->beginTransaction();
                
                // pesquisar pelo atributo CampanhaSorteio.dataComecoSorteio no campo CASO_DT_INICIO da tabela CAMPANHA_SORTEIO
              $bo = new CampanhaSorteioBusinessImpl();
              $retorno = $bo->carregarPorDatacomecosorteio($daofactory, $dataComecoSorteio);
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
* pesquisarPorDatafimsorteio() - Usado para invocar a classe de negócio CampanhaSorteioBusinessImpl de forma geral
* realizar uma busca de Data de término diretamente na tabela CAMPANHA_SORTEIO campo CASO_DT_TERMINO
*
* @param $dataFimSorteio
* @return CampanhaSorteioDTO
*
* 
*/

     public function pesquisarPorDatafimsorteio($dataFimSorteio)
     {
          $daofactory = NULL;
          $retorno = NULL;
          try {
                $daofactory = DAOFactory::getDAOFactory();
                $daofactory->open();
                $daofactory->beginTransaction();
                
                // pesquisar pelo atributo CampanhaSorteio.dataFimSorteio no campo CASO_DT_TERMINO da tabela CAMPANHA_SORTEIO
              $bo = new CampanhaSorteioBusinessImpl();
              $retorno = $bo->carregarPorDatafimsorteio($daofactory, $dataFimSorteio);
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
* pesquisarPorMaxtickets() - Usado para invocar a classe de negócio CampanhaSorteioBusinessImpl de forma geral
* realizar uma busca de Máximo de tickets diretamente na tabela CAMPANHA_SORTEIO campo CASO_NU_MAX_TICKET
*
* @param $maxTickets
* @return CampanhaSorteioDTO
*
* 
*/

     public function pesquisarPorMaxtickets($maxTickets)
     {
          $daofactory = NULL;
          $retorno = NULL;
          try {
                $daofactory = DAOFactory::getDAOFactory();
                $daofactory->open();
                $daofactory->beginTransaction();
                
                // pesquisar pelo atributo CampanhaSorteio.maxTickets no campo CASO_NU_MAX_TICKET da tabela CAMPANHA_SORTEIO
              $bo = new CampanhaSorteioBusinessImpl();
              $retorno = $bo->carregarPorMaxtickets($daofactory, $maxTickets);
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
* atualizarId_CampanhaPorPK() - Usado para invocar a classe de negócio CampanhaSorteioBusinessImpl de forma geral
* realizar uma atualização de ID da campanha diretamente na tabela CAMPANHA_SORTEIO campo CAMP_ID
* @param $id
* @param $id_campanha
* @return CampanhaSorteioDTO
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
            
            // atualizar registro por meio do método CampanhaSorteioBusinessImpl::atualizarId_CampanhaPorPK($id_campanha,$id)
           $bo = new CampanhaSorteioBusinessImpl();
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
* atualizarNomePorPK() - Usado para invocar a classe de negócio CampanhaSorteioBusinessImpl de forma geral
* realizar uma atualização de Nome do sorteio diretamente na tabela CAMPANHA_SORTEIO campo CASO_TX_NOME
* @param $id
* @param $nome
* @return CampanhaSorteioDTO
*
* 
*/

    public function atualizarNomePorPK($nome,$id)
    {
        $daofactory = NULL;
        $retorno = NULL;
        try {
            $daofactory = DAOFactory::getDAOFactory();
            $daofactory->open();
            $daofactory->beginTransaction();
            
            // atualizar registro por meio do método CampanhaSorteioBusinessImpl::atualizarNomePorPK($nome,$id)
           $bo = new CampanhaSorteioBusinessImpl();
           $retorno = $bo->atualizarNomePorPK($daofactory,$nome,$id);

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
* atualizarUrlregulamentoPorPK() - Usado para invocar a classe de negócio CampanhaSorteioBusinessImpl de forma geral
* realizar uma atualização de URL regulamento do sorteio diretamente na tabela CAMPANHA_SORTEIO campo CASO_TX_URL_REGULAMENTO
* @param $id
* @param $urlRegulamento
* @return CampanhaSorteioDTO
*
* 
*/

    public function atualizarUrlregulamentoPorPK($urlRegulamento,$id)
    {
        $daofactory = NULL;
        $retorno = NULL;
        try {
            $daofactory = DAOFactory::getDAOFactory();
            $daofactory->open();
            $daofactory->beginTransaction();
            
            // atualizar registro por meio do método CampanhaSorteioBusinessImpl::atualizarUrlregulamentoPorPK($urlRegulamento,$id)
           $bo = new CampanhaSorteioBusinessImpl();
           $retorno = $bo->atualizarUrlregulamentoPorPK($daofactory,$urlRegulamento,$id);

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
* atualizarPremioPorPK() - Usado para invocar a classe de negócio CampanhaSorteioBusinessImpl de forma geral
* realizar uma atualização de Prêmio do sorteio diretamente na tabela CAMPANHA_SORTEIO campo CASO_TX_PREMIO
* @param $id
* @param $premio
* @return CampanhaSorteioDTO
*
* 
*/

    public function atualizarPremioPorPK($premio,$id)
    {
        $daofactory = NULL;
        $retorno = NULL;
        try {
            $daofactory = DAOFactory::getDAOFactory();
            $daofactory->open();
            $daofactory->beginTransaction();
            
            // atualizar registro por meio do método CampanhaSorteioBusinessImpl::atualizarPremioPorPK($premio,$id)
           $bo = new CampanhaSorteioBusinessImpl();
           $retorno = $bo->atualizarPremioPorPK($daofactory,$premio,$id);

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
* atualizarDatacomecosorteioPorPK() - Usado para invocar a classe de negócio CampanhaSorteioBusinessImpl de forma geral
* realizar uma atualização de Data de início diretamente na tabela CAMPANHA_SORTEIO campo CASO_DT_INICIO
* @param $id
* @param $dataComecoSorteio
* @return CampanhaSorteioDTO
*
* 
*/

    public function atualizarDatacomecosorteioPorPK($dataComecoSorteio,$id)
    {
        $daofactory = NULL;
        $retorno = NULL;
        try {
            $daofactory = DAOFactory::getDAOFactory();
            $daofactory->open();
            $daofactory->beginTransaction();
            
            // atualizar registro por meio do método CampanhaSorteioBusinessImpl::atualizarDatacomecosorteioPorPK($dataComecoSorteio,$id)
           $bo = new CampanhaSorteioBusinessImpl();
           $retorno = $bo->atualizarDatacomecosorteioPorPK($daofactory,$dataComecoSorteio,$id);

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
* atualizarDatafimsorteioPorPK() - Usado para invocar a classe de negócio CampanhaSorteioBusinessImpl de forma geral
* realizar uma atualização de Data de término diretamente na tabela CAMPANHA_SORTEIO campo CASO_DT_TERMINO
* @param $id
* @param $dataFimSorteio
* @return CampanhaSorteioDTO
*
* 
*/

    public function atualizarDatafimsorteioPorPK($dataFimSorteio,$id)
    {
        $daofactory = NULL;
        $retorno = NULL;
        try {
            $daofactory = DAOFactory::getDAOFactory();
            $daofactory->open();
            $daofactory->beginTransaction();
            
            // atualizar registro por meio do método CampanhaSorteioBusinessImpl::atualizarDatafimsorteioPorPK($dataFimSorteio,$id)
           $bo = new CampanhaSorteioBusinessImpl();
           $retorno = $bo->atualizarDatafimsorteioPorPK($daofactory,$dataFimSorteio,$id);

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
* atualizarMaxticketsPorPK() - Usado para invocar a classe de negócio CampanhaSorteioBusinessImpl de forma geral
* realizar uma atualização de Máximo de tickets diretamente na tabela CAMPANHA_SORTEIO campo CASO_NU_MAX_TICKET
* @param $id
* @param $maxTickets
* @return CampanhaSorteioDTO
*
* 
*/

    public function atualizarMaxticketsPorPK($maxTickets,$id)
    {
        $daofactory = NULL;
        $retorno = NULL;
        try {
            $daofactory = DAOFactory::getDAOFactory();
            $daofactory->open();
            $daofactory->beginTransaction();
            
            // atualizar registro por meio do método CampanhaSorteioBusinessImpl::atualizarMaxticketsPorPK($maxTickets,$id)
           $bo = new CampanhaSorteioBusinessImpl();
           $retorno = $bo->atualizarMaxticketsPorPK($daofactory,$maxTickets,$id);

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
* listarCampanhaSorteioPorCampIdStatus() - Usado para invocar a classe de negócio TipoEmpreendimentoBusinessImpl de forma geral
* realizar lista paginada de registros tendo como referência os registros do usuário logado com uma instância de PaginacaoDTO
*
* @param $campid
* @param $status
* @param $pag
* @param $qtde
* @param $coluna
* @param $ordem
* @return $PaginacaoDTO
*/

public function listarCampanhaSorteioPorCampIdStatus($campid, $status='A', $pag=1, $qtde=0, $coluna=1, $ordem=0)
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
        // listar paginado CampanhaSorteio
        $bo = new CampanhaSorteioBusinessImpl();
        $retorno = $bo->listarCampanhaSorteioPorCampIdStatus($daofactory, $campid, $status, $pag, $qtde, $coluna, $ordem);
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
* listarCampanhaSorteioPorCampId() - Usado para invocar a classe de negócio TipoEmpreendimentoBusinessImpl de forma geral
* realizar lista paginada de registros tendo como referência os registros do usuário logado com uma instância de PaginacaoDTO
*
* @param $campid
* @param $pag
* @param $qtde
* @param $coluna
* @param $ordem
* @return $PaginacaoDTO
*/

public function listarCampanhaSorteioPorCampId($campid, $pag=1, $qtde=0, $coluna=1, $ordem=0)
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
        // listar paginado CampanhaSorteio
        $bo = new CampanhaSorteioBusinessImpl();
        $retorno = $bo->listarCampanhaSorteioPorCampId($daofactory, $campid, $pag, $qtde, $coluna, $ordem);
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
* listarCampanhaSorteioPorUsuaIdStatus() - Usado para invocar a classe de negócio TipoEmpreendimentoBusinessImpl de forma geral
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

   public function listarCampanhaSorteioPorUsuaIdStatus($usuaid, $status='A', $pag=1, $qtde=0, $coluna=1, $ordem=0) 
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
           // listar paginado CampanhaSorteio
           $bo = new CampanhaSorteioBusinessImpl();
           $retorno = $bo->listarCampanhaSorteioPorUsuaIdStatus($daofactory, $usuaid, $status, $pag, $qtde, $coluna, $ordem);
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
