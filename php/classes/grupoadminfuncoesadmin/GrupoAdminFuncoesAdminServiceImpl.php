<?php

//importar dependencias
require_once 'GrupoAdminFuncoesAdminService.php';
require_once 'GrupoAdminFuncoesAdminBusinessImpl.php';
require_once '../variavel/ConstantesVariavel.php';
require_once '../variavel/VariavelCache.php';
require_once '../mensagem/ConstantesMensagem.php';
require_once '../mensagem/MensagemCache.php';

require_once '../daofactory/DAOFactory.php';


/**
*
* GrupoAdminFuncoesAdminServiceImpl - Implementação dos servicos para Classe de negócio com métodos para apoiar a integridade de informações sobre controle de grupos de administradores e funções administrativas gerenciado pela plataforma
* Camada de Serviços GrupoAdminFuncoesAdmin - camada responsável pela lógica de negócios de GrupoAdminFuncoesAdmin do sistema. 
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
* @since 20/08/2021 18:54:21
*
*/
class GrupoAdminFuncoesAdminServiceImpl implements GrupoAdminFuncoesAdminService
{
    
    function __construct() {    }

/**
*
* listarTudo() - Usado para invocar a classe de negócio GrupoAdminFuncoesAdminBusinessImpl de forma geral
* para listar todos os registros sem critérios de paginação dos dados.
*
* Use este método com MUITA moderação.
*/

    public function listarTudo() {  }
    public function pesquisar($dto){ }
    public function cancelar($dto) { }

/**
*
* PesquisarMaxPKAtivoIdPorStatus() - Usado para invocar a classe de negócio GrupoAdminFuncoesAdminBusinessImpl de forma geral
* a buscar a MAIOR PK pra um dado status.
*
* @param status
* @return GrupoAdminFuncoesAdminDTO
*
*/

public function pesquisarMaxPKAtivoIdgrupoadministracaoPorStatus($idGrupoAdministracao,$status)
{
    $daofactory = NULL;
    $retorno = NULL;
    try {
        $daofactory = DAOFactory::getDAOFactory();
        $daofactory->open();
        $daofactory->beginTransaction();
        
       $bo = new GrupoAdminFuncoesAdminBusinessImpl();
       $retorno = $bo->pesquisarMaxPKAtivoIdgrupoadministracaoPorStatus($daofactory, $idGrupoAdministracao,$status);
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
* atualizar() - Usado para invocar a classe de negócio GrupoAdminFuncoesAdminBusinessImpl de forma geral
* para gerenciar as regras de negócio do sistema.
*
* @param GrupoAdminFuncoesAdminDTO contendo dados para enviar para atualização
* @return uma instância de GrupoAdminFuncoesAdminDTO com resultdo da operação
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
            
           $bo = new GrupoAdminFuncoesAdminBusinessImpl();
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
* atualizarStatusGrupoAdminFuncoesAdmin() - Usado para invocar a classe de negócio GrupoAdminFuncoesAdminBusinessImpl de forma geral
* para gerenciar as atualizações do campo STATUS de acordo as regras de negócio do sistema.
*
* @param $id
* @param $status
* @return uma instância de GrupoAdminFuncoesAdminDTO com resultdo da operação
*
*/


    public function autalizarStatusGrupoAdminFuncoesAdmin($id, $status)
    {
        $daofactory = NULL;
        $retorno = NULL;
        try {
            $daofactory = DAOFactory::getDAOFactory();
            $daofactory->open();
            $daofactory->beginTransaction();
            

           $bo = new GrupoAdminFuncoesAdminBusinessImpl();
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
* apagar() - Usado para invocar a classe de negócio GrupoAdminFuncoesAdminBusinessImpl de forma geral
* para gerenciar a exclusão de registro de acordo as regras de negócio do sistema.
*
* @param $dto - Instância de GrupoAdminFuncoesAdminDTO
*
* @return uma instância de GrupoAdminFuncoesAdminDTO com resultdo da operação
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
        

       $bo = new GrupoAdminFuncoesAdminBusinessImpl();
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
* cadastrar() - Usado para invocar a classe de negócio GrupoAdminFuncoesAdminBusinessImpl de forma geral
* para gerenciar a criação de registro de acordo as regras de negócio do sistema.
*
* @param $dto - Instância de GrupoAdminFuncoesAdminDTO
*
* @return uma instância de GrupoAdminFuncoesAdminDTO com resultdo da operação
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
            

           $bo = new GrupoAdminFuncoesAdminBusinessImpl();
           $retorno = $bo->inserirGrupoAdminFuncoesAdmin($daofactory, $dto);

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
* @return List<GrupoAdminFuncoesAdminDTO>[]
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
            
            // listar paginado GrupoAdminFuncoesAdmin
           $bo = new GrupoAdminFuncoesAdminBusinessImpl();
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
* realizar uma busca diretamente pela PK (Primary Key) da tabela SEGLOG_GRUPO_ADM_FUNCAO_ADM campo GAFA_ID
*
* @param $id
* @return GrupoAdminFuncoesAdminDTO
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
            
            // pesquisar pela PK da tabela GrupoAdminFuncoesAdmin
           $bo = new GrupoAdminFuncoesAdminBusinessImpl();
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
* listarGrupoAdminFuncoesAdminPorStatus() - Usado para invocar a classe de negócio TipoEmpreendimentoBusinessImpl de forma geral
* realizar lista paginada de registros com uma instância de PaginacaoDTO
*
* @param $status
* @param $pag
* @param $qtde
* @param $coluna
* @param $ordem
* @return $PaginacaoDTO
*/

   public function listarGrupoAdminFuncoesAdminPorStatus($status='A', $pag=1, $qtde=0, $coluna=1, $ordem=0) 
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
           // listar paginado GrupoAdminFuncoesAdmin
           $bo = new GrupoAdminFuncoesAdminBusinessImpl();
           $retorno = $bo->listarGrupoAdminFuncoesAdminPorStatus($daofactory, $status, $pag, $qtde, $coluna, $ordem);
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
* pesquisarPorIdgrupoadministracao() - Usado para invocar a classe de negócio GrupoAdminFuncoesAdminBusinessImpl de forma geral
* realizar uma busca de ID grupo administração diretamente na tabela SEGLOG_GRUPO_ADM_FUNCAO_ADM campo GRAD_ID
*
* @param $idGrupoAdministracao
* @return GrupoAdminFuncoesAdminDTO
*
* 
*/

    public function pesquisarPorIdgrupoadministracao($idGrupoAdministracao)
    {
        $daofactory = NULL;
        $retorno = NULL;
        try {
            $daofactory = DAOFactory::getDAOFactory();
            $daofactory->open();
            $daofactory->beginTransaction();
            
            // pesquisar pelo atributo GrupoAdminFuncoesAdmin.idGrupoAdministracao no campo GRAD_ID da tabela SEGLOG_GRUPO_ADM_FUNCAO_ADM
           $bo = new GrupoAdminFuncoesAdminBusinessImpl();
           $retorno = $bo->carregarPorIdgrupoadministracao($daofactory, $idGrupoAdministracao);
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
* pesquisarPorIdfuncoesadministrativas() - Usado para invocar a classe de negócio GrupoAdminFuncoesAdminBusinessImpl de forma geral
* realizar uma busca de ID funções administrativas diretamente na tabela SEGLOG_GRUPO_ADM_FUNCAO_ADM campo FUAD_ID
*
* @param $idFuncoesAdministrativas
* @return GrupoAdminFuncoesAdminDTO
*
* 
*/

    public function pesquisarPorIdfuncoesadministrativas($idFuncoesAdministrativas)
    {
        $daofactory = NULL;
        $retorno = NULL;
        try {
            $daofactory = DAOFactory::getDAOFactory();
            $daofactory->open();
            $daofactory->beginTransaction();
            
            // pesquisar pelo atributo GrupoAdminFuncoesAdmin.idFuncoesAdministrativas no campo FUAD_ID da tabela SEGLOG_GRUPO_ADM_FUNCAO_ADM
           $bo = new GrupoAdminFuncoesAdminBusinessImpl();
           $retorno = $bo->carregarPorIdfuncoesadministrativas($daofactory, $idFuncoesAdministrativas);
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
* pesquisarPorIncrudcriar() - Usado para invocar a classe de negócio GrupoAdminFuncoesAdminBusinessImpl de forma geral
* realizar uma busca de Permissão CRUD Criar diretamente na tabela SEGLOG_GRUPO_ADM_FUNCAO_ADM campo GAFA_IN_CRUD_CRIAR
*
* @param $incrudCriar
* @return GrupoAdminFuncoesAdminDTO
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
            
            // pesquisar pelo atributo GrupoAdminFuncoesAdmin.incrudCriar no campo GAFA_IN_CRUD_CRIAR da tabela SEGLOG_GRUPO_ADM_FUNCAO_ADM
           $bo = new GrupoAdminFuncoesAdminBusinessImpl();
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
* pesquisarPorIncrudrecuperar() - Usado para invocar a classe de negócio GrupoAdminFuncoesAdminBusinessImpl de forma geral
* realizar uma busca de Permissão CRUD Recuperar diretamente na tabela SEGLOG_GRUPO_ADM_FUNCAO_ADM campo GAFA_IN_CRUD_RECUPERAR
*
* @param $incrudRecuperar
* @return GrupoAdminFuncoesAdminDTO
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
            
            // pesquisar pelo atributo GrupoAdminFuncoesAdmin.incrudRecuperar no campo GAFA_IN_CRUD_RECUPERAR da tabela SEGLOG_GRUPO_ADM_FUNCAO_ADM
           $bo = new GrupoAdminFuncoesAdminBusinessImpl();
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
* pesquisarPorIncrudatualizar() - Usado para invocar a classe de negócio GrupoAdminFuncoesAdminBusinessImpl de forma geral
* realizar uma busca de Permissão CRUD Atualizar diretamente na tabela SEGLOG_GRUPO_ADM_FUNCAO_ADM campo GAFA_IN_CRUD_ATUALIZAR
*
* @param $incrudAtualizar
* @return GrupoAdminFuncoesAdminDTO
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
            
            // pesquisar pelo atributo GrupoAdminFuncoesAdmin.incrudAtualizar no campo GAFA_IN_CRUD_ATUALIZAR da tabela SEGLOG_GRUPO_ADM_FUNCAO_ADM
           $bo = new GrupoAdminFuncoesAdminBusinessImpl();
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
* pesquisarPorIncrudexcluir() - Usado para invocar a classe de negócio GrupoAdminFuncoesAdminBusinessImpl de forma geral
* realizar uma busca de Permissão CRUD Excluir diretamente na tabela SEGLOG_GRUPO_ADM_FUNCAO_ADM campo GAFA_IN_CRUD_EXCLUIR
*
* @param $incrudExcluir
* @return GrupoAdminFuncoesAdminDTO
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
            
            // pesquisar pelo atributo GrupoAdminFuncoesAdmin.incrudExcluir no campo GAFA_IN_CRUD_EXCLUIR da tabela SEGLOG_GRUPO_ADM_FUNCAO_ADM
           $bo = new GrupoAdminFuncoesAdminBusinessImpl();
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
* atualizarIdgrupoadministracaoPorPK() - Usado para invocar a classe de negócio GrupoAdminFuncoesAdminBusinessImpl de forma geral
* realizar uma atualização de ID grupo administração diretamente na tabela SEGLOG_GRUPO_ADM_FUNCAO_ADM campo GRAD_ID
* @param $id
* @param $idGrupoAdministracao
* @return GrupoAdminFuncoesAdminDTO
*
* 
*/

    public function atualizarIdgrupoadministracaoPorPK($idGrupoAdministracao,$id)
    {
        $daofactory = NULL;
        $retorno = NULL;
        try {
            $daofactory = DAOFactory::getDAOFactory();
            $daofactory->open();
            $daofactory->beginTransaction();
            
            // atualizar registro por meio do método GrupoAdminFuncoesAdminBusinessImpl::atualizarIdgrupoadministracaoPorPK($idGrupoAdministracao,$id)
           $bo = new GrupoAdminFuncoesAdminBusinessImpl();
           $retorno = $bo->atualizarIdgrupoadministracaoPorPK($daofactory,$idGrupoAdministracao,$id);

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
* atualizarIdfuncoesadministrativasPorPK() - Usado para invocar a classe de negócio GrupoAdminFuncoesAdminBusinessImpl de forma geral
* realizar uma atualização de ID funções administrativas diretamente na tabela SEGLOG_GRUPO_ADM_FUNCAO_ADM campo FUAD_ID
* @param $id
* @param $idFuncoesAdministrativas
* @return GrupoAdminFuncoesAdminDTO
*
* 
*/

    public function atualizarIdfuncoesadministrativasPorPK($idFuncoesAdministrativas,$id)
    {
        $daofactory = NULL;
        $retorno = NULL;
        try {
            $daofactory = DAOFactory::getDAOFactory();
            $daofactory->open();
            $daofactory->beginTransaction();
            
            // atualizar registro por meio do método GrupoAdminFuncoesAdminBusinessImpl::atualizarIdfuncoesadministrativasPorPK($idFuncoesAdministrativas,$id)
           $bo = new GrupoAdminFuncoesAdminBusinessImpl();
           $retorno = $bo->atualizarIdfuncoesadministrativasPorPK($daofactory,$idFuncoesAdministrativas,$id);

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
* atualizarIncrudcriarPorPK() - Usado para invocar a classe de negócio GrupoAdminFuncoesAdminBusinessImpl de forma geral
* realizar uma atualização de Permissão CRUD Criar diretamente na tabela SEGLOG_GRUPO_ADM_FUNCAO_ADM campo GAFA_IN_CRUD_CRIAR
* @param $id
* @param $incrudCriar
* @return GrupoAdminFuncoesAdminDTO
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
            
            // atualizar registro por meio do método GrupoAdminFuncoesAdminBusinessImpl::atualizarIncrudcriarPorPK($incrudCriar,$id)
           $bo = new GrupoAdminFuncoesAdminBusinessImpl();
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
* atualizarIncrudrecuperarPorPK() - Usado para invocar a classe de negócio GrupoAdminFuncoesAdminBusinessImpl de forma geral
* realizar uma atualização de Permissão CRUD Recuperar diretamente na tabela SEGLOG_GRUPO_ADM_FUNCAO_ADM campo GAFA_IN_CRUD_RECUPERAR
* @param $id
* @param $incrudRecuperar
* @return GrupoAdminFuncoesAdminDTO
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
            
            // atualizar registro por meio do método GrupoAdminFuncoesAdminBusinessImpl::atualizarIncrudrecuperarPorPK($incrudRecuperar,$id)
           $bo = new GrupoAdminFuncoesAdminBusinessImpl();
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
* atualizarIncrudatualizarPorPK() - Usado para invocar a classe de negócio GrupoAdminFuncoesAdminBusinessImpl de forma geral
* realizar uma atualização de Permissão CRUD Atualizar diretamente na tabela SEGLOG_GRUPO_ADM_FUNCAO_ADM campo GAFA_IN_CRUD_ATUALIZAR
* @param $id
* @param $incrudAtualizar
* @return GrupoAdminFuncoesAdminDTO
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
            
            // atualizar registro por meio do método GrupoAdminFuncoesAdminBusinessImpl::atualizarIncrudatualizarPorPK($incrudAtualizar,$id)
           $bo = new GrupoAdminFuncoesAdminBusinessImpl();
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
* atualizarIncrudexcluirPorPK() - Usado para invocar a classe de negócio GrupoAdminFuncoesAdminBusinessImpl de forma geral
* realizar uma atualização de Permissão CRUD Excluir diretamente na tabela SEGLOG_GRUPO_ADM_FUNCAO_ADM campo GAFA_IN_CRUD_EXCLUIR
* @param $id
* @param $incrudExcluir
* @return GrupoAdminFuncoesAdminDTO
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
            
            // atualizar registro por meio do método GrupoAdminFuncoesAdminBusinessImpl::atualizarIncrudexcluirPorPK($incrudExcluir,$id)
           $bo = new GrupoAdminFuncoesAdminBusinessImpl();
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
* listarGrupoAdminFuncoesAdminPorUsuaIdStatus() - Usado para invocar a classe de negócio TipoEmpreendimentoBusinessImpl de forma geral
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

   public function listarGrupoAdminFuncoesAdminPorUsuaIdStatus($usuaid, $status='A', $pag=1, $qtde=0, $coluna=1, $ordem=0) 
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
           // listar paginado GrupoAdminFuncoesAdmin
           $bo = new GrupoAdminFuncoesAdminBusinessImpl();
           $retorno = $bo->listarGrupoAdminFuncoesAdminPorUsuaIdStatus($daofactory, $usuaid, $status, $pag, $qtde, $coluna, $ordem);
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

