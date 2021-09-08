<?php

//importar dependencias
require_once 'PlanoService.php';
require_once 'PlanoBusinessImpl.php';
require_once '../variavel/ConstantesVariavel.php';
require_once '../variavel/VariavelCache.php';
require_once '../mensagem/ConstantesMensagem.php';
require_once '../mensagem/MensagemCache.php';

require_once '../daofactory/DAOFactory.php';


/**
*
* PlanoServiceImpl - Implementação dos servicos para Classe de negócio com métodos para apoiar a integridade de informações sobre planos gerenciado pela plataforma
* Camada de Serviços Plano - camada responsável pela lógica de negócios de Plano do sistema. 
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
* @since 08/09/2021 14:05:31
*
*/
class PlanoServiceImpl implements PlanoService
{
    
    function __construct() {    }

/**
*
* listarTudo() - Usado para invocar a classe de negócio PlanoBusinessImpl de forma geral
* para listar todos os registros sem critérios de paginação dos dados.
*
* Use este método com MUITA moderação.
*/

    public function listarTudo() {  }
    public function pesquisar($dto){ }
    public function cancelar($dto) { }

/**
*
* PesquisarMaxPKAtivoIdPorStatus() - Usado para invocar a classe de negócio PlanoBusinessImpl de forma geral
* a buscar a MAIOR PK pra um dado status.
*
* @param status
* @return PlanoDTO
*
*/

public function pesquisarMaxPKAtivoNomePorStatus($nome,$status)
{
    $daofactory = NULL;
    $retorno = NULL;
    try {
        $daofactory = DAOFactory::getDAOFactory();
        $daofactory->open();
        $daofactory->beginTransaction();
        
       $bo = new PlanoBusinessImpl();
       $retorno = $bo->pesquisarMaxPKAtivoNomePorStatus($daofactory, $nome,$status);
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
* atualizar() - Usado para invocar a classe de negócio PlanoBusinessImpl de forma geral
* para gerenciar as regras de negócio do sistema.
*
* @param PlanoDTO contendo dados para enviar para atualização
* @return uma instância de PlanoDTO com resultdo da operação
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
            
           $bo = new PlanoBusinessImpl();
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
* atualizarStatusPlano() - Usado para invocar a classe de negócio PlanoBusinessImpl de forma geral
* para gerenciar as atualizações do campo STATUS de acordo as regras de negócio do sistema.
*
* @param $id
* @param $status
* @return uma instância de PlanoDTO com resultdo da operação
*
*/


    public function autalizarStatusPlano($id, $status)
    {
        $daofactory = NULL;
        $retorno = NULL;
        try {
            $daofactory = DAOFactory::getDAOFactory();
            $daofactory->open();
            $daofactory->beginTransaction();
            

           $bo = new PlanoBusinessImpl();
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
* apagar() - Usado para invocar a classe de negócio PlanoBusinessImpl de forma geral
* para gerenciar a exclusão de registro de acordo as regras de negócio do sistema.
*
* @param $dto - Instância de PlanoDTO
*
* @return uma instância de PlanoDTO com resultdo da operação
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
        

       $bo = new PlanoBusinessImpl();
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
* cadastrar() - Usado para invocar a classe de negócio PlanoBusinessImpl de forma geral
* para gerenciar a criação de registro de acordo as regras de negócio do sistema.
*
* @param $dto - Instância de PlanoDTO
*
* @return uma instância de PlanoDTO com resultdo da operação
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
            

           $bo = new PlanoBusinessImpl();
           $retorno = $bo->inserirPlano($daofactory, $dto);

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
* @return List<PlanoDTO>[]
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
            
            // listar paginado Plano
           $bo = new PlanoBusinessImpl();
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
* realizar uma busca diretamente pela PK (Primary Key) da tabela PLANOS campo PLAN_ID
*
* @param $id
* @return PlanoDTO
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
            
            // pesquisar pela PK da tabela Plano
           $bo = new PlanoBusinessImpl();
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
* listarPlanoPorStatus() - Usado para invocar a classe de negócio TipoEmpreendimentoBusinessImpl de forma geral
* realizar lista paginada de registros com uma instância de PaginacaoDTO
*
* @param $status
* @param $pag
* @param $qtde
* @param $coluna
* @param $ordem
* @return $PaginacaoDTO
*/

   public function listarPlanoPorStatus($status='A', $pag=1, $qtde=0, $coluna=1, $ordem=0) 
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
           // listar paginado Plano
           $bo = new PlanoBusinessImpl();
           $retorno = $bo->listarPlanoPorStatus($daofactory, $status, $pag, $qtde, $coluna, $ordem);
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
* listarPlanoPorStatusTipo() - Usado para invocar a classe de negócio TipoEmpreendimentoBusinessImpl de forma geral
* realizar lista paginada de registros com uma instância de PaginacaoDTO
*
* @param $status
* @param $pag
* @param $qtde
* @param $coluna
* @param $ordem
* @return $PaginacaoDTO
*/

   public function listarPlanoPorStatusTipo($status='A', $tipo='PLA', $pag=1, $qtde=0, $coluna=1, $ordem=0) 
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
           // listar paginado Plano
           $bo = new PlanoBusinessImpl();
           $retorno = $bo->listarPlanoPorStatusTipo($daofactory, $status, $tipo, $pag, $qtde, $coluna, $ordem);
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
* pesquisarPorNome() - Usado para invocar a classe de negócio PlanoBusinessImpl de forma geral
* realizar uma busca de Nome do Plano diretamente na tabela PLANOS campo PLAN_NM_PLANO
*
* @param $nome
* @return PlanoDTO
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
            
            // pesquisar pelo atributo Plano.nome no campo PLAN_NM_PLANO da tabela PLANOS
           $bo = new PlanoBusinessImpl();
           $retorno = $bo->carregarPorNome($daofactory, $nome);
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
* pesquisarPorPermissao() - Usado para invocar a classe de negócio PlanoBusinessImpl de forma geral
* realizar uma busca de Estruturas de Permissão do Plano diretamente na tabela PLANOS campo PLAN_TX_PERMISSAO
*
* @param $permissao
* @return PlanoDTO
*
* 
*/

    public function pesquisarPorPermissao($permissao)
    {
        $daofactory = NULL;
        $retorno = NULL;
        try {
            $daofactory = DAOFactory::getDAOFactory();
            $daofactory->open();
            $daofactory->beginTransaction();
            
            // pesquisar pelo atributo Plano.permissao no campo PLAN_TX_PERMISSAO da tabela PLANOS
           $bo = new PlanoBusinessImpl();
           $retorno = $bo->carregarPorPermissao($daofactory, $permissao);
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
* pesquisarPorValor() - Usado para invocar a classe de negócio PlanoBusinessImpl de forma geral
* realizar uma busca de Valor do Plano diretamente na tabela PLANOS campo PLAN_VL_PLANO
*
* @param $valor
* @return PlanoDTO
*
* 
*/

    public function pesquisarPorValor($valor)
    {
        $daofactory = NULL;
        $retorno = NULL;
        try {
            $daofactory = DAOFactory::getDAOFactory();
            $daofactory->open();
            $daofactory->beginTransaction();
            
            // pesquisar pelo atributo Plano.valor no campo PLAN_VL_PLANO da tabela PLANOS
           $bo = new PlanoBusinessImpl();
           $retorno = $bo->carregarPorValor($daofactory, $valor);
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
* pesquisarPorTipo() - Usado para invocar a classe de negócio PlanoBusinessImpl de forma geral
* realizar uma busca de Tipo do Plano diretamente na tabela PLANOS campo PLAN_IN_TIPO
*
* @param $tipo
* @return PlanoDTO
*
* 
*/

    public function pesquisarPorTipo($tipo)
    {
        $daofactory = NULL;
        $retorno = NULL;
        try {
            $daofactory = DAOFactory::getDAOFactory();
            $daofactory->open();
            $daofactory->beginTransaction();
            
            // pesquisar pelo atributo Plano.tipo no campo PLAN_IN_TIPO da tabela PLANOS
           $bo = new PlanoBusinessImpl();
           $retorno = $bo->carregarPorTipo($daofactory, $tipo);
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
* atualizarNomePorPK() - Usado para invocar a classe de negócio PlanoBusinessImpl de forma geral
* realizar uma atualização de Nome do Plano diretamente na tabela PLANOS campo PLAN_NM_PLANO
* @param $id
* @param $nome
* @return PlanoDTO
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
            
            // atualizar registro por meio do método PlanoBusinessImpl::atualizarNomePorPK($nome,$id)
           $bo = new PlanoBusinessImpl();
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
* atualizarPermissaoPorPK() - Usado para invocar a classe de negócio PlanoBusinessImpl de forma geral
* realizar uma atualização de Estruturas de Permissão do Plano diretamente na tabela PLANOS campo PLAN_TX_PERMISSAO
* @param $id
* @param $permissao
* @return PlanoDTO
*
* 
*/

    public function atualizarPermissaoPorPK($permissao,$id)
    {
        $daofactory = NULL;
        $retorno = NULL;
        try {
            $daofactory = DAOFactory::getDAOFactory();
            $daofactory->open();
            $daofactory->beginTransaction();
            
            // atualizar registro por meio do método PlanoBusinessImpl::atualizarPermissaoPorPK($permissao,$id)
           $bo = new PlanoBusinessImpl();
           $retorno = $bo->atualizarPermissaoPorPK($daofactory,$permissao,$id);

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
* atualizarValorPorPK() - Usado para invocar a classe de negócio PlanoBusinessImpl de forma geral
* realizar uma atualização de Valor do Plano diretamente na tabela PLANOS campo PLAN_VL_PLANO
* @param $id
* @param $valor
* @return PlanoDTO
*
* 
*/

    public function atualizarValorPorPK($valor,$id)
    {
        $daofactory = NULL;
        $retorno = NULL;
        try {
            $daofactory = DAOFactory::getDAOFactory();
            $daofactory->open();
            $daofactory->beginTransaction();
            
            // atualizar registro por meio do método PlanoBusinessImpl::atualizarValorPorPK($valor,$id)
           $bo = new PlanoBusinessImpl();
           $retorno = $bo->atualizarValorPorPK($daofactory,$valor,$id);

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
* atualizarTipoPorPK() - Usado para invocar a classe de negócio PlanoBusinessImpl de forma geral
* realizar uma atualização de Tipo do Plano diretamente na tabela PLANOS campo PLAN_IN_TIPO
* @param $id
* @param $tipo
* @return PlanoDTO
*
* 
*/

    public function atualizarTipoPorPK($tipo,$id)
    {
        $daofactory = NULL;
        $retorno = NULL;
        try {
            $daofactory = DAOFactory::getDAOFactory();
            $daofactory->open();
            $daofactory->beginTransaction();
            
            // atualizar registro por meio do método PlanoBusinessImpl::atualizarTipoPorPK($tipo,$id)
           $bo = new PlanoBusinessImpl();
           $retorno = $bo->atualizarTipoPorPK($daofactory,$tipo,$id);

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
* listarPlanoPorUsuaIdStatus() - Usado para invocar a classe de negócio TipoEmpreendimentoBusinessImpl de forma geral
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

   public function listarPlanoPorUsuaIdStatus($usuaid, $status='A', $pag=1, $qtde=0, $coluna=1, $ordem=0) 
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
           // listar paginado Plano
           $bo = new PlanoBusinessImpl();
           $retorno = $bo->listarPlanoPorUsuaIdStatus($daofactory, $usuaid, $status, $pag, $qtde, $coluna, $ordem);
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
