<?php

//importar dependencias
require_once 'FundoParticipacaoGlobalService.php';
require_once 'FundoParticipacaoGlobalBusinessImpl.php';
require_once '../variavel/ConstantesVariavel.php';
require_once '../variavel/VariavelCache.php';
require_once '../mensagem/ConstantesMensagem.php';
require_once '../mensagem/MensagemCache.php';

require_once '../daofactory/DAOFactory.php';


/**
*
* FundoParticipacaoGlobalServiceImpl - Implementação dos servicos para Classe de negócio com métodos para apoiar a integridade de 
* informações sobre movimentação do Fundo de Participação Global gerenciado pela plataforma
* Camada de Serviços FundoParticipacaoGlobal - camada responsável pela lógica de negócios de FundoParticipacaoGlobal do sistema. 
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
* @since 18/08/2021 12:15:16
*
*/
class FundoParticipacaoGlobalServiceImpl implements FundoParticipacaoGlobalService
{
    
    function __construct() {    }

/**
*
* listarTudo() - Usado para invocar a classe de negócio FundoParticipacaoGlobalBusinessImpl de forma geral
* para listar todos os registros sem critérios de paginação dos dados.
*
* Use este método com MUITA moderação.
*/

    public function listarTudo() {  }
    public function pesquisar($dto){ }
    public function cancelar($dto) { }

/**
*
* PesquisarMaxPKAtivoIdPorStatus() - Usado para invocar a classe de negócio FundoParticipacaoGlobalBusinessImpl de forma geral
* a buscar a MAIOR PK pra um dado status.
*
* @param status
* @return FundoParticipacaoGlobalDTO
*
*/

public function pesquisarMaxPKAtivoIdusuarioparticipantePorStatus($idUsuarioParticipante,$status)
{
    $daofactory = NULL;
    $retorno = NULL;
    try {
        $daofactory = DAOFactory::getDAOFactory();
        $daofactory->open();
        $daofactory->beginTransaction();
        
       $bo = new FundoParticipacaoGlobalBusinessImpl();
       $retorno = $bo->pesquisarMaxPKAtivoIdusuarioparticipantePorStatus($daofactory, $idUsuarioParticipante,$status);
       if ($retorno->msgcode == ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO) {
            // Trocar a constante abaixo COMANDO_REALIZADO_COM_SUCESSO que é a mensagem padrão 
            // por algo que faça mais sentido para o usuário no frontend
            $retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
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
* atualizar() - Usado para invocar a classe de negócio FundoParticipacaoGlobalBusinessImpl de forma geral
* para gerenciar as regras de negócio do sistema.
*
* @param FundoParticipacaoGlobalDTO contendo dados para enviar para atualização
* @return uma instância de FundoParticipacaoGlobalDTO com resultdo da operação
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
            
           $bo = new FundoParticipacaoGlobalBusinessImpl();
           $retorno = $bo->atualizar($daofactory, $dto);
           if ($retorno->msgcode == ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO) {
               // Trocar a constante abaixo COMANDO_REALIZADO_COM_SUCESSO que é a mensagem padrão 
               // por algo que faça mais sentido para o usuário no frontend
               $retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
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
* atualizarStatusFundoParticipacaoGlobal() - Usado para invocar a classe de negócio FundoParticipacaoGlobalBusinessImpl de forma geral
* para gerenciar as atualizações do campo STATUS de acordo as regras de negócio do sistema.
*
* @param $id
* @param $status
* @return uma instância de FundoParticipacaoGlobalDTO com resultdo da operação
*
*/


    public function autalizarStatusFundoParticipacaoGlobal($id, $status)
    {
        $daofactory = NULL;
        $retorno = NULL;
        try {
            $daofactory = DAOFactory::getDAOFactory();
            $daofactory->open();
            $daofactory->beginTransaction();
            

           $bo = new FundoParticipacaoGlobalBusinessImpl();
           $retorno = $bo->atualizarStatus($daofactory, $id, $status);

           if ($retorno->msgcode == ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO){
               // Trocar a constante abaixo COMANDO_REALIZADO_COM_SUCESSO que é a mensagem padrão 
               // por algo que faça mais sentido para o usuário no frontend
               $retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
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
* apagar() - Usado para invocar a classe de negócio FundoParticipacaoGlobalBusinessImpl de forma geral
* para gerenciar a exclusão de registro de acordo as regras de negócio do sistema.
*
* @param $dto - Instância de FundoParticipacaoGlobalDTO
*
* @return uma instância de FundoParticipacaoGlobalDTO com resultdo da operação
*
*/


public function apagar($dto)
{
    $daofactory = NULL;
    $retorno = NULL;
    try {
        $daofactory = DAOFactory::getDAOFactory();
        $daofactory->open();
        $daofactory->beginTransaction();
        

       $bo = new FundoParticipacaoGlobalBusinessImpl();
       $retorno = $bo->deletar($daofactory, $dto);

       if ($retorno->msgcode == ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO) {
            $retorno->msgcode = ConstantesMensagem::REGISTRO_FOI_REMOVIDO_COM_SUCESSO;
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
* cadastrar() - Usado para invocar a classe de negócio FundoParticipacaoGlobalBusinessImpl de forma geral
* para gerenciar a criação de registro de acordo as regras de negócio do sistema.
*
* @param $dto - Instância de FundoParticipacaoGlobalDTO
*
* @return uma instância de FundoParticipacaoGlobalDTO com resultdo da operação
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
            

           $bo = new FundoParticipacaoGlobalBusinessImpl();
           $retorno = $bo->inserir($daofactory, $dto);

           if ($retorno->msgcode == ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO) {
               // Trocar a constante abaixo COMANDO_REALIZADO_COM_SUCESSO que é a mensagem padrão 
               // por algo que faça mais sentido para o usuário no frontend
               $retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
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
* cadastrarCreditoBonificacao() - Usado para invocar a classe de negócio FundoParticipacaoGlobalBusinessImpl de forma geral
* para gerenciar a criação de registro de acordo as regras de negócio do sistema.
*
* @param $dto - Instância de FundoParticipacaoGlobalDTO
*
* @return uma instância de FundoParticipacaoGlobalDTO com resultdo da operação
*
*/


public function cadastrarCreditoBonificacao($dto)
{
    $daofactory = NULL;
    $retorno = NULL;
    try {
        $daofactory = DAOFactory::getDAOFactory();
        $daofactory->open();
        $daofactory->beginTransaction();
        

       $bo = new FundoParticipacaoGlobalBusinessImpl();
       $retorno = $bo->inserirCreditoBonificacao($daofactory, $dto);

       if ($retorno->msgcode == ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO) {
           // Trocar a constante abaixo COMANDO_REALIZADO_COM_SUCESSO que é a mensagem padrão 
           // por algo que faça mais sentido para o usuário no frontend

           $retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
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
* cadastrarCreditoPartipante() - Usado para invocar a classe de negócio FundoParticipacaoGlobalBusinessImpl de forma geral
* para gerenciar a criação de registro de acordo as regras de negócio do sistema.
*
* @param $dto - Instância de FundoParticipacaoGlobalDTO
*
* @return uma instância de FundoParticipacaoGlobalDTO com resultdo da operação
*
*/


    public function cadastrarCreditoPartipante($dto)
    {
        $daofactory = NULL;
        $retorno = NULL;
        try {
            $daofactory = DAOFactory::getDAOFactory();
            $daofactory->open();
            $daofactory->beginTransaction();
            

           $bo = new FundoParticipacaoGlobalBusinessImpl();
           $retorno = $bo->inserirCreditoParticipante($daofactory, $dto);

           if ($retorno->msgcode == ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO) {
               // Trocar a constante abaixo COMANDO_REALIZADO_COM_SUCESSO que é a mensagem padrão 
               // por algo que faça mais sentido para o usuário no frontend

               $retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
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
* @return List<FundoParticipacaoGlobalDTO>[]
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
            
            // listar paginado FundoParticipacaoGlobal
           $bo = new FundoParticipacaoGlobalBusinessImpl();
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
* realizar uma busca diretamente pela PK (Primary Key) da tabela FUNDO_PARTICIPACAO_GLOBAL campo FPGL_ID
*
* @param $id
* @return FundoParticipacaoGlobalDTO
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
            
            // pesquisar pela PK da tabela FundoParticipacaoGlobal
           $bo = new FundoParticipacaoGlobalBusinessImpl();
           $retorno = $bo->carregarPorID($daofactory, $id);
           if ($retorno->msgcode == ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO){
                // Trocar a constante abaixo COMANDO_REALIZADO_COM_SUCESSO que é a mensagem padrão 
                // por algo que faça mais sentido para o usuário no frontend
                $retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
                $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);
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
* listarFundoParticipacaoGlobalPorStatus() - Usado para invocar a classe de negócio TipoEmpreendimentoBusinessImpl de forma geral
* realizar lista paginada de registros com uma instância de PaginacaoDTO
*
* @param $status
* @param $pag
* @param $qtde
* @param $coluna
* @param $ordem
* @return $PaginacaoDTO
*/

   public function listarFundoParticipacaoGlobalPorStatus($status='A', $pag=1, $qtde=0, $coluna=1, $ordem=0) 
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
           // listar paginado FundoParticipacaoGlobal
           $bo = new FundoParticipacaoGlobalBusinessImpl();
           $retorno = $bo->listarFundoParticipacaoGlobalPorStatus($daofactory, $status, $pag, $qtde, $coluna, $ordem);
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
* pesquisarPorIdusuarioparticipante() - Usado para invocar a classe de negócio FundoParticipacaoGlobalBusinessImpl de forma geral
* realizar uma busca de ID do usuário participante diretamente na tabela FUNDO_PARTICIPACAO_GLOBAL campo USUA_ID
*
* @param $idUsuarioParticipante
* @return FundoParticipacaoGlobalDTO
*
* 
*/

    public function pesquisarPorIdusuarioparticipante($idUsuarioParticipante)
    {
        $daofactory = NULL;
        $retorno = NULL;
        try {
            $daofactory = DAOFactory::getDAOFactory();
            $daofactory->open();
            $daofactory->beginTransaction();
            
            // pesquisar pelo atributo FundoParticipacaoGlobal.idUsuarioParticipante no campo USUA_ID da tabela FUNDO_PARTICIPACAO_GLOBAL
           $bo = new FundoParticipacaoGlobalBusinessImpl();
           $retorno = $bo->carregarPorIdusuarioparticipante($daofactory, $idUsuarioParticipante);
           if ($retorno->msgcode == ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO){
                // Trocar a constante abaixo COMANDO_REALIZADO_COM_SUCESSO que é a mensagem padrão 
                // por algo que faça mais sentido para o usuário no frontend  
                $retorno->msgcode = ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO;
                $retorno->msgcodeString = MensagemCache::getInstance()->getMensagem($retorno->msgcode);
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
* pesquisarPorIdusuariobonificado() - Usado para invocar a classe de negócio FundoParticipacaoGlobalBusinessImpl de forma geral
* realizar uma busca de ID do usuário bonificado diretamente na tabela FUNDO_PARTICIPACAO_GLOBAL campo USUA_ID_BONIFICADO
*
* @param $idUsuarioBonificado
* @return FundoParticipacaoGlobalDTO
*
* 
*/

    public function pesquisarPorIdusuariobonificado($idUsuarioBonificado)
    {
        $daofactory = NULL;
        $retorno = NULL;
        try {
            $daofactory = DAOFactory::getDAOFactory();
            $daofactory->open();
            $daofactory->beginTransaction();
            
            // pesquisar pelo atributo FundoParticipacaoGlobal.idUsuarioBonificado no campo USUA_ID_BONIFICADO da tabela FUNDO_PARTICIPACAO_GLOBAL
           $bo = new FundoParticipacaoGlobalBusinessImpl();
           $retorno = $bo->carregarPorIdusuariobonificado($daofactory, $idUsuarioBonificado);
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
* pesquisarPorIdplanofatura() - Usado para invocar a classe de negócio FundoParticipacaoGlobalBusinessImpl de forma geral
* realizar uma busca de ID do plano fatura do usuário diretamente na tabela FUNDO_PARTICIPACAO_GLOBAL campo PLUF_ID
*
* @param $idPlanoFatura
* @return FundoParticipacaoGlobalDTO
*
* 
*/

    public function pesquisarPorIdplanofatura($idPlanoFatura)
    {
        $daofactory = NULL;
        $retorno = NULL;
        try {
            $daofactory = DAOFactory::getDAOFactory();
            $daofactory->open();
            $daofactory->beginTransaction();
            
            // pesquisar pelo atributo FundoParticipacaoGlobal.idPlanoFatura no campo PLUF_ID da tabela FUNDO_PARTICIPACAO_GLOBAL
           $bo = new FundoParticipacaoGlobalBusinessImpl();
           $retorno = $bo->carregarPorIdplanofatura($daofactory, $idPlanoFatura);
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
* pesquisarPorTipomovimento() - Usado para invocar a classe de negócio FundoParticipacaoGlobalBusinessImpl de forma geral
* realizar uma busca de Tipo do movimento diretamente na tabela FUNDO_PARTICIPACAO_GLOBAL campo FPGL_IN_TIPO
*
* @param $tipoMovimento
* @return FundoParticipacaoGlobalDTO
*
* 
*/

    public function pesquisarPorTipomovimento($tipoMovimento)
    {
        $daofactory = NULL;
        $retorno = NULL;
        try {
            $daofactory = DAOFactory::getDAOFactory();
            $daofactory->open();
            $daofactory->beginTransaction();
            
            // pesquisar pelo atributo FundoParticipacaoGlobal.tipoMovimento no campo FPGL_IN_TIPO da tabela FUNDO_PARTICIPACAO_GLOBAL
           $bo = new FundoParticipacaoGlobalBusinessImpl();
           $retorno = $bo->carregarPorTipomovimento($daofactory, $tipoMovimento);
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
* pesquisarPorValortransacao() - Usado para invocar a classe de negócio FundoParticipacaoGlobalBusinessImpl de forma geral
* realizar uma busca de Valor do crédito ou débito diretamente na tabela FUNDO_PARTICIPACAO_GLOBAL campo FPGL_VL_TRANSACAO
*
* @param $valorTransacao
* @return FundoParticipacaoGlobalDTO
*
* 
*/

    public function pesquisarPorValortransacao($valorTransacao)
    {
        $daofactory = NULL;
        $retorno = NULL;
        try {
            $daofactory = DAOFactory::getDAOFactory();
            $daofactory->open();
            $daofactory->beginTransaction();
            
            // pesquisar pelo atributo FundoParticipacaoGlobal.valorTransacao no campo FPGL_VL_TRANSACAO da tabela FUNDO_PARTICIPACAO_GLOBAL
           $bo = new FundoParticipacaoGlobalBusinessImpl();
           $retorno = $bo->carregarPorValortransacao($daofactory, $valorTransacao);
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
* pesquisarPorDescricao() - Usado para invocar a classe de negócio FundoParticipacaoGlobalBusinessImpl de forma geral
* realizar uma busca de descrição diretamente na tabela FUNDO_PARTICIPACAO_GLOBAL campo FPGL_TX_DESCRICAO
*
* @param $descricao
* @return FundoParticipacaoGlobalDTO
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
            
            // pesquisar pelo atributo FundoParticipacaoGlobal.descricao no campo FPGL_TX_DESCRICAO da tabela FUNDO_PARTICIPACAO_GLOBAL
           $bo = new FundoParticipacaoGlobalBusinessImpl();
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
* atualizarIdusuarioparticipantePorPK() - Usado para invocar a classe de negócio FundoParticipacaoGlobalBusinessImpl de forma geral
* realizar uma atualização de ID do usuário participante diretamente na tabela FUNDO_PARTICIPACAO_GLOBAL campo USUA_ID
* @param $id
* @param $idUsuarioParticipante
* @return FundoParticipacaoGlobalDTO
*
* 
*/

    public function atualizarIdusuarioparticipantePorPK($idUsuarioParticipante,$id)
    {
        $daofactory = NULL;
        $retorno = NULL;
        try {
            $daofactory = DAOFactory::getDAOFactory();
            $daofactory->open();
            $daofactory->beginTransaction();
            
            // atualizar registro por meio do método FundoParticipacaoGlobalBusinessImpl::atualizarIdusuarioparticipantePorPK($idUsuarioParticipante,$id)
           $bo = new FundoParticipacaoGlobalBusinessImpl();
           $retorno = $bo->atualizarIdusuarioparticipantePorPK($daofactory,$idUsuarioParticipante,$id);

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
* atualizarIdusuariobonificadoPorPK() - Usado para invocar a classe de negócio FundoParticipacaoGlobalBusinessImpl de forma geral
* realizar uma atualização de ID do usuário bonificado diretamente na tabela FUNDO_PARTICIPACAO_GLOBAL campo USUA_ID_BONIFICADO
* @param $id
* @param $idUsuarioBonificado
* @return FundoParticipacaoGlobalDTO
*
* 
*/

    public function atualizarIdusuariobonificadoPorPK($idUsuarioBonificado,$id)
    {
        $daofactory = NULL;
        $retorno = NULL;
        try {
            $daofactory = DAOFactory::getDAOFactory();
            $daofactory->open();
            $daofactory->beginTransaction();
            
            // atualizar registro por meio do método FundoParticipacaoGlobalBusinessImpl::atualizarIdusuariobonificadoPorPK($idUsuarioBonificado,$id)
           $bo = new FundoParticipacaoGlobalBusinessImpl();
           $retorno = $bo->atualizarIdusuariobonificadoPorPK($daofactory,$idUsuarioBonificado,$id);

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
* atualizarIdplanofaturaPorPK() - Usado para invocar a classe de negócio FundoParticipacaoGlobalBusinessImpl de forma geral
* realizar uma atualização de ID do plano fatura do usuário diretamente na tabela FUNDO_PARTICIPACAO_GLOBAL campo PLUF_ID
* @param $id
* @param $idPlanoFatura
* @return FundoParticipacaoGlobalDTO
*
* 
*/

    public function atualizarIdplanofaturaPorPK($idPlanoFatura,$id)
    {
        $daofactory = NULL;
        $retorno = NULL;
        try {
            $daofactory = DAOFactory::getDAOFactory();
            $daofactory->open();
            $daofactory->beginTransaction();
            
            // atualizar registro por meio do método FundoParticipacaoGlobalBusinessImpl::atualizarIdplanofaturaPorPK($idPlanoFatura,$id)
           $bo = new FundoParticipacaoGlobalBusinessImpl();
           $retorno = $bo->atualizarIdplanofaturaPorPK($daofactory,$idPlanoFatura,$id);

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
* atualizarTipomovimentoPorPK() - Usado para invocar a classe de negócio FundoParticipacaoGlobalBusinessImpl de forma geral
* realizar uma atualização de Tipo do movimento diretamente na tabela FUNDO_PARTICIPACAO_GLOBAL campo FPGL_IN_TIPO
* @param $id
* @param $tipoMovimento
* @return FundoParticipacaoGlobalDTO
*
* 
*/

    public function atualizarTipomovimentoPorPK($tipoMovimento,$id)
    {
        $daofactory = NULL;
        $retorno = NULL;
        try {
            $daofactory = DAOFactory::getDAOFactory();
            $daofactory->open();
            $daofactory->beginTransaction();
            
            // atualizar registro por meio do método FundoParticipacaoGlobalBusinessImpl::atualizarTipomovimentoPorPK($tipoMovimento,$id)
           $bo = new FundoParticipacaoGlobalBusinessImpl();
           $retorno = $bo->atualizarTipomovimentoPorPK($daofactory,$tipoMovimento,$id);

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
* atualizarValortransacaoPorPK() - Usado para invocar a classe de negócio FundoParticipacaoGlobalBusinessImpl de forma geral
* realizar uma atualização de Valor do crédito ou débito diretamente na tabela FUNDO_PARTICIPACAO_GLOBAL campo FPGL_VL_TRANSACAO
* @param $id
* @param $valorTransacao
* @return FundoParticipacaoGlobalDTO
*
* 
*/

    public function atualizarValortransacaoPorPK($valorTransacao,$id)
    {
        $daofactory = NULL;
        $retorno = NULL;
        try {
            $daofactory = DAOFactory::getDAOFactory();
            $daofactory->open();
            $daofactory->beginTransaction();
            
            // atualizar registro por meio do método FundoParticipacaoGlobalBusinessImpl::atualizarValortransacaoPorPK($valorTransacao,$id)
           $bo = new FundoParticipacaoGlobalBusinessImpl();
           $retorno = $bo->atualizarValortransacaoPorPK($daofactory,$valorTransacao,$id);

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
* atualizarDescricaoPorPK() - Usado para invocar a classe de negócio FundoParticipacaoGlobalBusinessImpl de forma geral
* realizar uma atualização de descrição diretamente na tabela FUNDO_PARTICIPACAO_GLOBAL campo FPGL_TX_DESCRICAO
* @param $id
* @param $descricao
* @return FundoParticipacaoGlobalDTO
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
            
            // atualizar registro por meio do método FundoParticipacaoGlobalBusinessImpl::atualizarDescricaoPorPK($descricao,$id)
           $bo = new FundoParticipacaoGlobalBusinessImpl();
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
* listarFundoParticipacaoGlobalPorUsuaIdStatus() - Usado para invocar a classe de negócio TipoEmpreendimentoBusinessImpl de forma geral
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

   public function listarFundoParticipacaoGlobalPorUsuaIdStatus($usuaid, $status='A', $pag=1, $qtde=0, $coluna=1, $ordem=0) 
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
           // listar paginado FundoParticipacaoGlobal
           $bo = new FundoParticipacaoGlobalBusinessImpl();
           $retorno = $bo->listarFundoParticipacaoGlobalPorUsuaIdStatus($daofactory, $usuaid, $status, $pag, $qtde, $coluna, $ordem);
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

