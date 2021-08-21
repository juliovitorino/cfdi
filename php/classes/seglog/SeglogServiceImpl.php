<?php

//importar dependencias
require_once 'SeglogService.php';
require_once 'SeglogBusinessImpl.php';
require_once '../variavel/ConstantesVariavel.php';
require_once '../variavel/VariavelCache.php';
require_once '../mensagem/ConstantesMensagem.php';
require_once '../mensagem/MensagemCache.php';

require_once '../daofactory/DAOFactory.php';


/**
*
* SeglogServiceImpl - Implementação dos servicos para Classe de negócio com métodos para apoiar a integridade de informações sobre dados da seglog gerenciado pela plataforma
* Camada de Serviços Seglog - camada responsável pela lógica de negócios de Seglog do sistema. 
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
* @since 21/08/2021 12:30:09
*
*/
class SeglogServiceImpl implements SeglogService
{
    
    function __construct() {    }

/**
*
* listarTudo() - Usado para invocar a classe de negócio SeglogBusinessImpl de forma geral
* para listar todos os registros sem critérios de paginação dos dados.
*
* Use este método com MUITA moderação.
*/

    public function listarTudo() {  }
    public function pesquisar($dto){ }
    public function cancelar($dto) { }

/**
*
* PesquisarMaxPKAtivoIdPorStatus() - Usado para invocar a classe de negócio SeglogBusinessImpl de forma geral
* a buscar a MAIOR PK pra um dado status.
*
* @param status
* @return SeglogDTO
*
*/

public function pesquisarMaxPKAtivoIdgafaPorStatus($idgafa,$status)
{
    $daofactory = NULL;
    $retorno = NULL;
    try {
        $daofactory = DAOFactory::getDAOFactory();
        $daofactory->open();
        $daofactory->beginTransaction();
        
       $bo = new SeglogBusinessImpl();
       $retorno = $bo->pesquisarMaxPKAtivoIdgafaPorStatus($daofactory, $idgafa,$status);
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
* atualizar() - Usado para invocar a classe de negócio SeglogBusinessImpl de forma geral
* para gerenciar as regras de negócio do sistema.
*
* @param SeglogDTO contendo dados para enviar para atualização
* @return uma instância de SeglogDTO com resultdo da operação
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
            
           $bo = new SeglogBusinessImpl();
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
* atualizarStatusSeglog() - Usado para invocar a classe de negócio SeglogBusinessImpl de forma geral
* para gerenciar as atualizações do campo STATUS de acordo as regras de negócio do sistema.
*
* @param $id
* @param $status
* @return uma instância de SeglogDTO com resultdo da operação
*
*/


    public function autalizarStatusSeglog($id, $status)
    {
        $daofactory = NULL;
        $retorno = NULL;
        try {
            $daofactory = DAOFactory::getDAOFactory();
            $daofactory->open();
            $daofactory->beginTransaction();
            

           $bo = new SeglogBusinessImpl();
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
* apagar() - Usado para invocar a classe de negócio SeglogBusinessImpl de forma geral
* para gerenciar a exclusão de registro de acordo as regras de negócio do sistema.
*
* @param $dto - Instância de SeglogDTO
*
* @return uma instância de SeglogDTO com resultdo da operação
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
        

       $bo = new SeglogBusinessImpl();
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
* cadastrar() - Usado para invocar a classe de negócio SeglogBusinessImpl de forma geral
* para gerenciar a criação de registro de acordo as regras de negócio do sistema.
*
* @param $dto - Instância de SeglogDTO
*
* @return uma instância de SeglogDTO com resultdo da operação
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
            

           $bo = new SeglogBusinessImpl();
           $retorno = $bo->inserirSeglog($daofactory, $dto);

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
* @return List<SeglogDTO>[]
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
            
            // listar paginado Seglog
           $bo = new SeglogBusinessImpl();
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
* realizar uma busca diretamente pela PK (Primary Key) da tabela VW_SEGLOG campo SELOG_ID
*
* @param $id
* @return SeglogDTO
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
            
            // pesquisar pela PK da tabela Seglog
           $bo = new SeglogBusinessImpl();
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
* listarSeglogPorStatus() - Usado para invocar a classe de negócio TipoEmpreendimentoBusinessImpl de forma geral
* realizar lista paginada de registros com uma instância de PaginacaoDTO
*
* @param $status
* @param $pag
* @param $qtde
* @param $coluna
* @param $ordem
* @return $PaginacaoDTO
*/

   public function listarSeglogPorStatus($status='A', $pag=1, $qtde=0, $coluna=1, $ordem=0) 
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
           // listar paginado Seglog
           $bo = new SeglogBusinessImpl();
           $retorno = $bo->listarSeglogPorStatus($daofactory, $status, $pag, $qtde, $coluna, $ordem);
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
* pesquisarPorIdgafa() - Usado para invocar a classe de negócio SeglogBusinessImpl de forma geral
* realizar uma busca de ID grupo admin x função admin diretamente na tabela VW_SEGLOG campo GAFA_ID
*
* @param $idgafa
* @return SeglogDTO
*
* 
*/

    public function pesquisarPorIdgafa($idgafa)
    {
        $daofactory = NULL;
        $retorno = NULL;
        try {
            $daofactory = DAOFactory::getDAOFactory();
            $daofactory->open();
            $daofactory->beginTransaction();
            
            // pesquisar pelo atributo Seglog.idgafa no campo GAFA_ID da tabela VW_SEGLOG
           $bo = new SeglogBusinessImpl();
           $retorno = $bo->carregarPorIdgafa($daofactory, $idgafa);
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
* pesquisarPorId_Usuario() - Usado para invocar a classe de negócio SeglogBusinessImpl de forma geral
* realizar uma busca de ID do usuario diretamente na tabela VW_SEGLOG campo USUA_ID
*
* @param $id_usuario
* @return SeglogDTO
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
            
            // pesquisar pelo atributo Seglog.id_usuario no campo USUA_ID da tabela VW_SEGLOG
           $bo = new SeglogBusinessImpl();
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
* pesquisarPorFuncao() - Usado para invocar a classe de negócio SeglogBusinessImpl de forma geral
* realizar uma busca de Função diretamente na tabela VW_SEGLOG campo SEGLOG_DESCRICAO
*
* @param $funcao
* @return SeglogDTO
*
* 
*/

    public function pesquisarPorFuncao($funcao)
    {
        $daofactory = NULL;
        $retorno = NULL;
        try {
            $daofactory = DAOFactory::getDAOFactory();
            $daofactory->open();
            $daofactory->beginTransaction();
            
            // pesquisar pelo atributo Seglog.funcao no campo SEGLOG_DESCRICAO da tabela VW_SEGLOG
           $bo = new SeglogBusinessImpl();
           $retorno = $bo->carregarPorFuncao($daofactory, $funcao);
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
* pesquisarPorid_UsuarioFuncao() - Usado para invocar a classe de negócio SeglogBusinessImpl de forma geral
* realizar uma busca de Função diretamente na tabela VW_SEGLOG campo SEGLOG_DESCRICAO
*
* @param $funcao
* @return SeglogDTO
*
* 
*/

    public function pesquisarPorid_UsuarioFuncao($id_usuario, $funcao)
    {
        $daofactory = NULL;
        $retorno = NULL;
        try {
            $daofactory = DAOFactory::getDAOFactory();
            $daofactory->open();
            $daofactory->beginTransaction();
            
            // pesquisar pelo atributo Seglog.funcao no campo SEGLOG_DESCRICAO da tabela VW_SEGLOG
           $bo = new SeglogBusinessImpl();
           $retorno = $bo->pesquisarPorid_UsuarioFuncao($daofactory, $id_usuario, $funcao);
           if (! is_null($retorno) &&
             ($retorno->msgcode == ConstantesMensagem::COMANDO_REALIZADO_COM_SUCESSO)
           ){
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
* pesquisarPorIncrudcriar() - Usado para invocar a classe de negócio SeglogBusinessImpl de forma geral
* realizar uma busca de Permissão CRUD Criar diretamente na tabela VW_SEGLOG campo SEGLOG_IN_CRUD_CRIAR
*
* @param $incrudCriar
* @return SeglogDTO
*
* 
*/

    public function pesquisarPorIncrudcriar($incrudCriar)
    {
        $daofactory = NULL;
        $retorno = NULL;
        try {
            $daofactory = DAOFactory::getDAOFactory();
            $daofactory->open();
            $daofactory->beginTransaction();
            
            // pesquisar pelo atributo Seglog.incrudCriar no campo SEGLOG_IN_CRUD_CRIAR da tabela VW_SEGLOG
           $bo = new SeglogBusinessImpl();
           $retorno = $bo->carregarPorIncrudcriar($daofactory, $incrudCriar);
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
* pesquisarPorIncrudrecuperar() - Usado para invocar a classe de negócio SeglogBusinessImpl de forma geral
* realizar uma busca de Permissão CRUD Recuperar diretamente na tabela VW_SEGLOG campo SEGLOG_IN_CRUD_RECUPERAR
*
* @param $incrudRecuperar
* @return SeglogDTO
*
* 
*/

    public function pesquisarPorIncrudrecuperar($incrudRecuperar)
    {
        $daofactory = NULL;
        $retorno = NULL;
        try {
            $daofactory = DAOFactory::getDAOFactory();
            $daofactory->open();
            $daofactory->beginTransaction();
            
            // pesquisar pelo atributo Seglog.incrudRecuperar no campo SEGLOG_IN_CRUD_RECUPERAR da tabela VW_SEGLOG
           $bo = new SeglogBusinessImpl();
           $retorno = $bo->carregarPorIncrudrecuperar($daofactory, $incrudRecuperar);
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
* pesquisarPorIncrudatualizar() - Usado para invocar a classe de negócio SeglogBusinessImpl de forma geral
* realizar uma busca de Permissão CRUD Atualizar diretamente na tabela VW_SEGLOG campo SEGLOG_IN_CRUD_ATUALIZAR
*
* @param $incrudAtualizar
* @return SeglogDTO
*
* 
*/

    public function pesquisarPorIncrudatualizar($incrudAtualizar)
    {
        $daofactory = NULL;
        $retorno = NULL;
        try {
            $daofactory = DAOFactory::getDAOFactory();
            $daofactory->open();
            $daofactory->beginTransaction();
            
            // pesquisar pelo atributo Seglog.incrudAtualizar no campo SEGLOG_IN_CRUD_ATUALIZAR da tabela VW_SEGLOG
           $bo = new SeglogBusinessImpl();
           $retorno = $bo->carregarPorIncrudatualizar($daofactory, $incrudAtualizar);
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
* pesquisarPorIncrudexcluir() - Usado para invocar a classe de negócio SeglogBusinessImpl de forma geral
* realizar uma busca de Permissão CRUD Excluir diretamente na tabela VW_SEGLOG campo SEGLOG_IN_CRUD_EXCLUIR
*
* @param $incrudExcluir
* @return SeglogDTO
*
* 
*/

    public function pesquisarPorIncrudexcluir($incrudExcluir)
    {
        $daofactory = NULL;
        $retorno = NULL;
        try {
            $daofactory = DAOFactory::getDAOFactory();
            $daofactory->open();
            $daofactory->beginTransaction();
            
            // pesquisar pelo atributo Seglog.incrudExcluir no campo SEGLOG_IN_CRUD_EXCLUIR da tabela VW_SEGLOG
           $bo = new SeglogBusinessImpl();
           $retorno = $bo->carregarPorIncrudexcluir($daofactory, $incrudExcluir);
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
* atualizarIdgafaPorPK() - Usado para invocar a classe de negócio SeglogBusinessImpl de forma geral
* realizar uma atualização de ID grupo admin x função admin diretamente na tabela VW_SEGLOG campo GAFA_ID
* @param $id
* @param $idgafa
* @return SeglogDTO
*
* 
*/

    public function atualizarIdgafaPorPK($idgafa,$id)
    {
        $daofactory = NULL;
        $retorno = NULL;
        try {
            $daofactory = DAOFactory::getDAOFactory();
            $daofactory->open();
            $daofactory->beginTransaction();
            
            // atualizar registro por meio do método SeglogBusinessImpl::atualizarIdgafaPorPK($idgafa,$id)
           $bo = new SeglogBusinessImpl();
           $retorno = $bo->atualizarIdgafaPorPK($daofactory,$idgafa,$id);

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
* atualizarId_UsuarioPorPK() - Usado para invocar a classe de negócio SeglogBusinessImpl de forma geral
* realizar uma atualização de ID do usuario diretamente na tabela VW_SEGLOG campo USUA_ID
* @param $id
* @param $id_usuario
* @return SeglogDTO
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
            
            // atualizar registro por meio do método SeglogBusinessImpl::atualizarId_UsuarioPorPK($id_usuario,$id)
           $bo = new SeglogBusinessImpl();
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
* atualizarFuncaoPorPK() - Usado para invocar a classe de negócio SeglogBusinessImpl de forma geral
* realizar uma atualização de Função diretamente na tabela VW_SEGLOG campo SEGLOG_DESCRICAO
* @param $id
* @param $funcao
* @return SeglogDTO
*
* 
*/

    public function atualizarFuncaoPorPK($funcao,$id)
    {
        $daofactory = NULL;
        $retorno = NULL;
        try {
            $daofactory = DAOFactory::getDAOFactory();
            $daofactory->open();
            $daofactory->beginTransaction();
            
            // atualizar registro por meio do método SeglogBusinessImpl::atualizarFuncaoPorPK($funcao,$id)
           $bo = new SeglogBusinessImpl();
           $retorno = $bo->atualizarFuncaoPorPK($daofactory,$funcao,$id);

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
* atualizarIncrudcriarPorPK() - Usado para invocar a classe de negócio SeglogBusinessImpl de forma geral
* realizar uma atualização de Permissão CRUD Criar diretamente na tabela VW_SEGLOG campo SEGLOG_IN_CRUD_CRIAR
* @param $id
* @param $incrudCriar
* @return SeglogDTO
*
* 
*/

    public function atualizarIncrudcriarPorPK($incrudCriar,$id)
    {
        $daofactory = NULL;
        $retorno = NULL;
        try {
            $daofactory = DAOFactory::getDAOFactory();
            $daofactory->open();
            $daofactory->beginTransaction();
            
            // atualizar registro por meio do método SeglogBusinessImpl::atualizarIncrudcriarPorPK($incrudCriar,$id)
           $bo = new SeglogBusinessImpl();
           $retorno = $bo->atualizarIncrudcriarPorPK($daofactory,$incrudCriar,$id);

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
* atualizarIncrudrecuperarPorPK() - Usado para invocar a classe de negócio SeglogBusinessImpl de forma geral
* realizar uma atualização de Permissão CRUD Recuperar diretamente na tabela VW_SEGLOG campo SEGLOG_IN_CRUD_RECUPERAR
* @param $id
* @param $incrudRecuperar
* @return SeglogDTO
*
* 
*/

    public function atualizarIncrudrecuperarPorPK($incrudRecuperar,$id)
    {
        $daofactory = NULL;
        $retorno = NULL;
        try {
            $daofactory = DAOFactory::getDAOFactory();
            $daofactory->open();
            $daofactory->beginTransaction();
            
            // atualizar registro por meio do método SeglogBusinessImpl::atualizarIncrudrecuperarPorPK($incrudRecuperar,$id)
           $bo = new SeglogBusinessImpl();
           $retorno = $bo->atualizarIncrudrecuperarPorPK($daofactory,$incrudRecuperar,$id);

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
* atualizarIncrudatualizarPorPK() - Usado para invocar a classe de negócio SeglogBusinessImpl de forma geral
* realizar uma atualização de Permissão CRUD Atualizar diretamente na tabela VW_SEGLOG campo SEGLOG_IN_CRUD_ATUALIZAR
* @param $id
* @param $incrudAtualizar
* @return SeglogDTO
*
* 
*/

    public function atualizarIncrudatualizarPorPK($incrudAtualizar,$id)
    {
        $daofactory = NULL;
        $retorno = NULL;
        try {
            $daofactory = DAOFactory::getDAOFactory();
            $daofactory->open();
            $daofactory->beginTransaction();
            
            // atualizar registro por meio do método SeglogBusinessImpl::atualizarIncrudatualizarPorPK($incrudAtualizar,$id)
           $bo = new SeglogBusinessImpl();
           $retorno = $bo->atualizarIncrudatualizarPorPK($daofactory,$incrudAtualizar,$id);

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
* atualizarIncrudexcluirPorPK() - Usado para invocar a classe de negócio SeglogBusinessImpl de forma geral
* realizar uma atualização de Permissão CRUD Excluir diretamente na tabela VW_SEGLOG campo SEGLOG_IN_CRUD_EXCLUIR
* @param $id
* @param $incrudExcluir
* @return SeglogDTO
*
* 
*/

    public function atualizarIncrudexcluirPorPK($incrudExcluir,$id)
    {
        $daofactory = NULL;
        $retorno = NULL;
        try {
            $daofactory = DAOFactory::getDAOFactory();
            $daofactory->open();
            $daofactory->beginTransaction();
            
            // atualizar registro por meio do método SeglogBusinessImpl::atualizarIncrudexcluirPorPK($incrudExcluir,$id)
           $bo = new SeglogBusinessImpl();
           $retorno = $bo->atualizarIncrudexcluirPorPK($daofactory,$incrudExcluir,$id);

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
* listarSeglogPorUsuaIdStatus() - Usado para invocar a classe de negócio TipoEmpreendimentoBusinessImpl de forma geral
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

   public function listarSeglogPorUsuaIdStatus($usuaid, $status='A', $pag=1, $qtde=0, $coluna=1, $ordem=0) 
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
           // listar paginado Seglog
           $bo = new SeglogBusinessImpl();
           $retorno = $bo->listarSeglogPorUsuaIdStatus($daofactory, $usuaid, $status, $pag, $qtde, $coluna, $ordem);
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


