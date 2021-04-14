<?php

//importar dependencias
require_once 'UsuarioCashbackService.php';
require_once 'UsuarioCashbackBusinessImpl.php';
require_once '../variavel/ConstantesVariavel.php';
require_once '../variavel/VariavelCache.php';
require_once '../mensagem/ConstantesMensagem.php';
require_once '../mensagem/MensagemCache.php';

require_once '../daofactory/DAOFactory.php';


/**
*
* UsuarioCashbackServiceImpl - Implementação dos servicos para Classe de negócio com métodos para apoiar a integridade de informações sobre o  cashback do usuário  gerenciado pela plataforma
* Camada de Serviços UsuarioCashback - camada responsável pela lógica de negócios de UsuarioCashback do sistema. 
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
* @since 06/09/2019 08:43:34
*
*/
class UsuarioCashbackServiceImpl implements UsuarioCashbackService
{
    
    function __construct() {    }
/**
*
* listarTudo() - Usado para invocar a classe de negócio ${classebase}BusinessImpl de forma geral
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
* PesquisarMaxPKAtivoIdPorStatus() - Usado para invocar a classe de negócio UsuarioCashbackBusinessImpl de forma geral
* a buscar a MAIOR PK pra um dado status.
*
* @param status
* @return UsuarioCashbackDTO
*
*/

public function PesquisarMaxPKAtivoId_UsuarioPorStatus($id_usuario,$status)
{
    $daofactory = NULL;
    $retorno = NULL;
    try {
        $daofactory = DAOFactory::getDAOFactory();
        $daofactory->open();
        $daofactory->beginTransaction();
        
       $bo = new UsuarioCashbackBusinessImpl();
       $retorno = $bo->PesquisarMaxPKAtivoId_UsuarioPorStatus($daofactory, $id_usuario,$status);
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
* atualizar() - Usado para invocar a classe de negócio UsuarioCashbackBusinessImpl de forma geral
* para gerenciar as regras de negócio do sistema.
*
* @param UsuarioCashbackDTO contendo dados para enviar para atualização
* @return uma instância de UsuarioCashbackDTO com resultdo da operação
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
            
           $bo = new UsuarioCashbackBusinessImpl();
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
* atualizarStatusUsuarioCashback() - Usado para invocar a classe de negócio UsuarioCashbackBusinessImpl de forma geral
* para gerenciar as atualizações do campo STATUS de acordo as regras de negócio do sistema.
*
* @param $id
* @param $status
* @return uma instância de UsuarioCashbackDTO com resultdo da operação
*
*/


    public function autalizarStatusUsuarioCashback($id, $status)
    {
        $daofactory = NULL;
        $retorno = NULL;
        try {
            $daofactory = DAOFactory::getDAOFactory();
            $daofactory->open();
            $daofactory->beginTransaction();
            

           $bo = new UsuarioCashbackBusinessImpl();
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
* cadastrar() - Usado para invocar a classe de negócio UsuarioCashbackBusinessImpl de forma geral
* para gerenciar a criação de registro de acordo as regras de negócio do sistema.
*
* @param $dto - Instância de UsuarioCashbackDTO
*
* @return uma instância de UsuarioCashbackDTO com resultdo da operação
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
            

           $bo = new UsuarioCashbackBusinessImpl();
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
* @return List<UsuarioCashbackDTO>[]
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
            
            // listar paginado UsuarioCashback
           $bo = new UsuarioCashbackBusinessImpl();
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
* realizar uma busca diretamente pela PK (Primary Key) da tabela USUARIO_CASHBACK campo USCA_ID
*
* @param $id
* @return UsuarioCashbackDTO
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
            
            // pesquisar pela PK da tabela UsuarioCashback
           $bo = new UsuarioCashbackBusinessImpl();
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
* listarUsuarioCashbackPorStatus() - Usado para invocar a classe de negócio TipoEmpreendimentoBusinessImpl de forma geral
* realizar lista paginada de registros com uma instância de PaginacaoDTO
*
* @param $status
* @param $pag
* @param $qtde
* @param $coluna
* @param $ordem
* @return $PaginacaoDTO
*/

   public function listarUsuarioCashbackPorStatus($status='A', $pag=1, $qtde=0, $coluna=1, $ordem=0) 
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
           // listar paginado UsuarioCashback
           $bo = new UsuarioCashbackBusinessImpl();
           $retorno = $bo->listarUsuarioCashbackPorStatus($daofactory, $status, $pag, $qtde, $coluna, $ordem);
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
* pesquisarPorId_Usuario() - Usado para invocar a classe de negócio UsuarioCashbackBusinessImpl de forma geral
* realizar uma busca de ID do usuário diretamente na tabela USUARIO_CASHBACK campo USUA_ID
*
* @param $id_usuario
* @return UsuarioCashbackDTO
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
            
            // pesquisar pelo atributo UsuarioCashback.id_usuario no campo USUA_ID da tabela USUARIO_CASHBACK
           $bo = new UsuarioCashbackBusinessImpl();
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
* pesquisarPorVlminimoresgate() - Usado para invocar a classe de negócio UsuarioCashbackBusinessImpl de forma geral
* realizar uma busca de Resgatar a partir de diretamente na tabela USUARIO_CASHBACK campo USCA_VL_RESGATE
*
* @param $vlMinimoResgate
* @return UsuarioCashbackDTO
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
            
            // pesquisar pelo atributo UsuarioCashback.vlMinimoResgate no campo USCA_VL_RESGATE da tabela USUARIO_CASHBACK
           $bo = new UsuarioCashbackBusinessImpl();
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
* pesquisarPorPercentual() - Usado para invocar a classe de negócio UsuarioCashbackBusinessImpl de forma geral
* realizar uma busca de Percentual diretamente na tabela USUARIO_CASHBACK campo USCA_VL_PERC_CASHBACK
*
* @param $percentual
* @return UsuarioCashbackDTO
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
            
            // pesquisar pelo atributo UsuarioCashback.percentual no campo USCA_VL_PERC_CASHBACK da tabela USUARIO_CASHBACK
           $bo = new UsuarioCashbackBusinessImpl();
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
* pesquisarPorObs() - Usado para invocar a classe de negócio UsuarioCashbackBusinessImpl de forma geral
* realizar uma busca de Observação diretamente na tabela USUARIO_CASHBACK campo USCA_TX_OBS
*
* @param $obs
* @return UsuarioCashbackDTO
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
            
            // pesquisar pelo atributo UsuarioCashback.obs no campo USCA_TX_OBS da tabela USUARIO_CASHBACK
           $bo = new UsuarioCashbackBusinessImpl();
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
* pesquisarPorContadorstar_1() - Usado para invocar a classe de negócio UsuarioCashbackBusinessImpl de forma geral
* realizar uma busca de Contador Avaliação Péssima diretamente na tabela USUARIO_CASHBACK campo USCA_NU_CONT_STAR_1
*
* @param $contadorStar_1
* @return UsuarioCashbackDTO
*
* 
*/

    public function pesquisarPorContadorstar_1($contadorStar_1)
    {
        $daofactory = NULL;
        $retorno = NULL;
        try {
            $daofactory = DAOFactory::getDAOFactory();
            $daofactory->open();
            $daofactory->beginTransaction();
            
            // pesquisar pelo atributo UsuarioCashback.contadorStar_1 no campo USCA_NU_CONT_STAR_1 da tabela USUARIO_CASHBACK
           $bo = new UsuarioCashbackBusinessImpl();
           $retorno = $bo->carregarPorContadorstar_1($daofactory, $contadorStar_1);
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
* pesquisarPorContadorstar_2() - Usado para invocar a classe de negócio UsuarioCashbackBusinessImpl de forma geral
* realizar uma busca de Contador Avaliação Ruim diretamente na tabela USUARIO_CASHBACK campo USCA_NU_CONT_STAR_2
*
* @param $contadorStar_2
* @return UsuarioCashbackDTO
*
* 
*/

    public function pesquisarPorContadorstar_2($contadorStar_2)
    {
        $daofactory = NULL;
        $retorno = NULL;
        try {
            $daofactory = DAOFactory::getDAOFactory();
            $daofactory->open();
            $daofactory->beginTransaction();
            
            // pesquisar pelo atributo UsuarioCashback.contadorStar_2 no campo USCA_NU_CONT_STAR_2 da tabela USUARIO_CASHBACK
           $bo = new UsuarioCashbackBusinessImpl();
           $retorno = $bo->carregarPorContadorstar_2($daofactory, $contadorStar_2);
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
* pesquisarPorContadorstar_3() - Usado para invocar a classe de negócio UsuarioCashbackBusinessImpl de forma geral
* realizar uma busca de Contador Avaliação Boa diretamente na tabela USUARIO_CASHBACK campo USCA_NU_CONT_STAR_3
*
* @param $contadorStar_3
* @return UsuarioCashbackDTO
*
* 
*/

    public function pesquisarPorContadorstar_3($contadorStar_3)
    {
        $daofactory = NULL;
        $retorno = NULL;
        try {
            $daofactory = DAOFactory::getDAOFactory();
            $daofactory->open();
            $daofactory->beginTransaction();
            
            // pesquisar pelo atributo UsuarioCashback.contadorStar_3 no campo USCA_NU_CONT_STAR_3 da tabela USUARIO_CASHBACK
           $bo = new UsuarioCashbackBusinessImpl();
           $retorno = $bo->carregarPorContadorstar_3($daofactory, $contadorStar_3);
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
* pesquisarPorContadorstar_4() - Usado para invocar a classe de negócio UsuarioCashbackBusinessImpl de forma geral
* realizar uma busca de Contador Avaliação Ótima diretamente na tabela USUARIO_CASHBACK campo USCA_NU_CONT_STAR_4
*
* @param $contadorStar_4
* @return UsuarioCashbackDTO
*
* 
*/

    public function pesquisarPorContadorstar_4($contadorStar_4)
    {
        $daofactory = NULL;
        $retorno = NULL;
        try {
            $daofactory = DAOFactory::getDAOFactory();
            $daofactory->open();
            $daofactory->beginTransaction();
            
            // pesquisar pelo atributo UsuarioCashback.contadorStar_4 no campo USCA_NU_CONT_STAR_4 da tabela USUARIO_CASHBACK
           $bo = new UsuarioCashbackBusinessImpl();
           $retorno = $bo->carregarPorContadorstar_4($daofactory, $contadorStar_4);
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
* pesquisarPorContadorstar_5() - Usado para invocar a classe de negócio UsuarioCashbackBusinessImpl de forma geral
* realizar uma busca de Contador Avaliação Excelente diretamente na tabela USUARIO_CASHBACK campo USCA_NU_CONT_STAR_5
*
* @param $contadorStar_5
* @return UsuarioCashbackDTO
*
* 
*/

    public function pesquisarPorContadorstar_5($contadorStar_5)
    {
        $daofactory = NULL;
        $retorno = NULL;
        try {
            $daofactory = DAOFactory::getDAOFactory();
            $daofactory->open();
            $daofactory->beginTransaction();
            
            // pesquisar pelo atributo UsuarioCashback.contadorStar_5 no campo USCA_NU_CONT_STAR_5 da tabela USUARIO_CASHBACK
           $bo = new UsuarioCashbackBusinessImpl();
           $retorno = $bo->carregarPorContadorstar_5($daofactory, $contadorStar_5);
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
* pesquisarPorRatingcalculado() - Usado para invocar a classe de negócio UsuarioCashbackBusinessImpl de forma geral
* realizar uma busca de Média da Avaliação diretamente na tabela USUARIO_CASHBACK campo USCA_NU_RATING
*
* @param $ratingCalculado
* @return UsuarioCashbackDTO
*
* 
*/

    public function pesquisarPorRatingcalculado($ratingCalculado)
    {
        $daofactory = NULL;
        $retorno = NULL;
        try {
            $daofactory = DAOFactory::getDAOFactory();
            $daofactory->open();
            $daofactory->beginTransaction();
            
            // pesquisar pelo atributo UsuarioCashback.ratingCalculado no campo USCA_NU_RATING da tabela USUARIO_CASHBACK
           $bo = new UsuarioCashbackBusinessImpl();
           $retorno = $bo->carregarPorRatingcalculado($daofactory, $ratingCalculado);
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
* atualizarId_UsuarioPorPK() - Usado para invocar a classe de negócio UsuarioCashbackBusinessImpl de forma geral
* realizar uma atualização de ID do usuário diretamente na tabela USUARIO_CASHBACK campo USUA_ID
* @param $id
* @param $id_usuario
* @return UsuarioCashbackDTO
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
            
            // atualizar registro por meio do método UsuarioCashbackBusinessImpl::atualizarId_UsuarioPorPK($id_usuario,$id)
           $bo = new UsuarioCashbackBusinessImpl();
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
* atualizarVlminimoresgatePorPK() - Usado para invocar a classe de negócio UsuarioCashbackBusinessImpl de forma geral
* realizar uma atualização de Resgatar a partir de diretamente na tabela USUARIO_CASHBACK campo USCA_VL_RESGATE
* @param $id
* @param $vlMinimoResgate
* @return UsuarioCashbackDTO
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
            
            // atualizar registro por meio do método UsuarioCashbackBusinessImpl::atualizarVlminimoresgatePorPK($vlMinimoResgate,$id)
           $bo = new UsuarioCashbackBusinessImpl();
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
* atualizarPercentualPorPK() - Usado para invocar a classe de negócio UsuarioCashbackBusinessImpl de forma geral
* realizar uma atualização de Percentual diretamente na tabela USUARIO_CASHBACK campo USCA_VL_PERC_CASHBACK
* @param $id
* @param $percentual
* @return UsuarioCashbackDTO
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
            
            // atualizar registro por meio do método UsuarioCashbackBusinessImpl::atualizarPercentualPorPK($percentual,$id)
           $bo = new UsuarioCashbackBusinessImpl();
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
* atualizarObsPorPK() - Usado para invocar a classe de negócio UsuarioCashbackBusinessImpl de forma geral
* realizar uma atualização de Observação diretamente na tabela USUARIO_CASHBACK campo USCA_TX_OBS
* @param $id
* @param $obs
* @return UsuarioCashbackDTO
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
            
            // atualizar registro por meio do método UsuarioCashbackBusinessImpl::atualizarObsPorPK($obs,$id)
           $bo = new UsuarioCashbackBusinessImpl();
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
* atualizarContadorstar_1PorPK() - Usado para invocar a classe de negócio UsuarioCashbackBusinessImpl de forma geral
* realizar uma atualização de Contador Avaliação Péssima diretamente na tabela USUARIO_CASHBACK campo USCA_NU_CONT_STAR_1
* @param $id
* @param $contadorStar_1
* @return UsuarioCashbackDTO
*
* 
*/

    public function atualizarContadorstar_1PorPK($contadorStar_1,$id)
    {
        $daofactory = NULL;
        $retorno = NULL;
        try {
            $daofactory = DAOFactory::getDAOFactory();
            $daofactory->open();
            $daofactory->beginTransaction();
            
            // atualizar registro por meio do método UsuarioCashbackBusinessImpl::atualizarContadorstar_1PorPK($contadorStar_1,$id)
           $bo = new UsuarioCashbackBusinessImpl();
           $retorno = $bo->atualizarContadorstar_1PorPK($daofactory,$contadorStar_1,$id);

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
* atualizarContadorstar_2PorPK() - Usado para invocar a classe de negócio UsuarioCashbackBusinessImpl de forma geral
* realizar uma atualização de Contador Avaliação Ruim diretamente na tabela USUARIO_CASHBACK campo USCA_NU_CONT_STAR_2
* @param $id
* @param $contadorStar_2
* @return UsuarioCashbackDTO
*
* 
*/

    public function atualizarContadorstar_2PorPK($contadorStar_2,$id)
    {
        $daofactory = NULL;
        $retorno = NULL;
        try {
            $daofactory = DAOFactory::getDAOFactory();
            $daofactory->open();
            $daofactory->beginTransaction();
            
            // atualizar registro por meio do método UsuarioCashbackBusinessImpl::atualizarContadorstar_2PorPK($contadorStar_2,$id)
           $bo = new UsuarioCashbackBusinessImpl();
           $retorno = $bo->atualizarContadorstar_2PorPK($daofactory,$contadorStar_2,$id);

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
* atualizarContadorstar_3PorPK() - Usado para invocar a classe de negócio UsuarioCashbackBusinessImpl de forma geral
* realizar uma atualização de Contador Avaliação Boa diretamente na tabela USUARIO_CASHBACK campo USCA_NU_CONT_STAR_3
* @param $id
* @param $contadorStar_3
* @return UsuarioCashbackDTO
*
* 
*/

    public function atualizarContadorstar_3PorPK($contadorStar_3,$id)
    {
        $daofactory = NULL;
        $retorno = NULL;
        try {
            $daofactory = DAOFactory::getDAOFactory();
            $daofactory->open();
            $daofactory->beginTransaction();
            
            // atualizar registro por meio do método UsuarioCashbackBusinessImpl::atualizarContadorstar_3PorPK($contadorStar_3,$id)
           $bo = new UsuarioCashbackBusinessImpl();
           $retorno = $bo->atualizarContadorstar_3PorPK($daofactory,$contadorStar_3,$id);

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
* atualizarContadorstar_4PorPK() - Usado para invocar a classe de negócio UsuarioCashbackBusinessImpl de forma geral
* realizar uma atualização de Contador Avaliação Ótima diretamente na tabela USUARIO_CASHBACK campo USCA_NU_CONT_STAR_4
* @param $id
* @param $contadorStar_4
* @return UsuarioCashbackDTO
*
* 
*/

    public function atualizarContadorstar_4PorPK($contadorStar_4,$id)
    {
        $daofactory = NULL;
        $retorno = NULL;
        try {
            $daofactory = DAOFactory::getDAOFactory();
            $daofactory->open();
            $daofactory->beginTransaction();
            
            // atualizar registro por meio do método UsuarioCashbackBusinessImpl::atualizarContadorstar_4PorPK($contadorStar_4,$id)
           $bo = new UsuarioCashbackBusinessImpl();
           $retorno = $bo->atualizarContadorstar_4PorPK($daofactory,$contadorStar_4,$id);

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
* atualizarContadorstar_5PorPK() - Usado para invocar a classe de negócio UsuarioCashbackBusinessImpl de forma geral
* realizar uma atualização de Contador Avaliação Excelente diretamente na tabela USUARIO_CASHBACK campo USCA_NU_CONT_STAR_5
* @param $id
* @param $contadorStar_5
* @return UsuarioCashbackDTO
*
* 
*/

    public function atualizarContadorstar_5PorPK($contadorStar_5,$id)
    {
        $daofactory = NULL;
        $retorno = NULL;
        try {
            $daofactory = DAOFactory::getDAOFactory();
            $daofactory->open();
            $daofactory->beginTransaction();
            
            // atualizar registro por meio do método UsuarioCashbackBusinessImpl::atualizarContadorstar_5PorPK($contadorStar_5,$id)
           $bo = new UsuarioCashbackBusinessImpl();
           $retorno = $bo->atualizarContadorstar_5PorPK($daofactory,$contadorStar_5,$id);

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
* atualizarRatingcalculadoPorPK() - Usado para invocar a classe de negócio UsuarioCashbackBusinessImpl de forma geral
* realizar uma atualização de Média da Avaliação diretamente na tabela USUARIO_CASHBACK campo USCA_NU_RATING
* @param $id
* @param $ratingCalculado
* @return UsuarioCashbackDTO
*
* 
*/

    public function atualizarRatingcalculadoPorPK($ratingCalculado,$id)
    {
        $daofactory = NULL;
        $retorno = NULL;
        try {
            $daofactory = DAOFactory::getDAOFactory();
            $daofactory->open();
            $daofactory->beginTransaction();
            
            // atualizar registro por meio do método UsuarioCashbackBusinessImpl::atualizarRatingcalculadoPorPK($ratingCalculado,$id)
           $bo = new UsuarioCashbackBusinessImpl();
           $retorno = $bo->atualizarRatingcalculadoPorPK($daofactory,$ratingCalculado,$id);

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
* listarUsuarioCashbackPorUsuaIdStatus() - Usado para invocar a classe de negócio TipoEmpreendimentoBusinessImpl de forma geral
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

   public function listarUsuarioCashbackPorUsuaIdStatus($usuaid, $status='A', $pag=1, $qtde=0, $coluna=1, $ordem=0) 
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
           // listar paginado UsuarioCashback
           $bo = new UsuarioCashbackBusinessImpl();
           $retorno = $bo->listarUsuarioCashbackPorUsuaIdStatus($daofactory, $usuaid, $status, $pag, $qtde, $coluna, $ordem);
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
