<?php

//importar dependencias
require_once 'UsuarioAutorizadorService.php';
require_once 'UsuarioAutorizadorBusinessImpl.php';
require_once '../variavel/ConstantesVariavel.php';
require_once '../variavel/VariavelCache.php';
require_once '../mensagem/ConstantesMensagem.php';
require_once '../mensagem/MensagemCache.php';

require_once '../daofactory/DAOFactory.php';


/**
*
* UsuarioAutorizadorServiceImpl - Implementação dos servicos para Classe de negócio com métodos para apoiar a integridade de informações sobre o usuário autorizador  gerenciado pela plataforma
* Camada de Serviços UsuarioAutorizador - camada responsável pela lógica de negócios de UsuarioAutorizador do sistema. 
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
* @since 09/09/2019 12:52:36
*
*/
class UsuarioAutorizadorServiceImpl implements UsuarioAutorizadorService
{
    
    function __construct() {    }

/**
*
* listarTudo() - Usado para invocar a classe de negócio UsuarioAutorizadorBusinessImpl de forma geral
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
* habilitarUsuarioAutorizador() - Habilitar um usuário já previamente criado para executar algumas
* atividades determinadas pelo dono da campanha
*
* @param UsuarioAutorizadorDTO
* @return UsuarioAutorizadorDTO
*
*/

public function habilitarUsuarioAutorizador($dto, $ishabilitar=true)
{
    $daofactory = NULL;
    $retorno = NULL;
    try {
        $daofactory = DAOFactory::getDAOFactory();
        $daofactory->open();
        $daofactory->beginTransaction();
        
       $bo = new UsuarioAutorizadorBusinessImpl();
       $retorno = $bo->habilitarUsuarioAutorizador($daofactory, $dto, $ishabilitar);
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
* PesquisarMaxPKAtivoIdPorStatus() - Usado para invocar a classe de negócio UsuarioAutorizadorBusinessImpl de forma geral
* a buscar a MAIOR PK pra um dado status.
*
* @param status
* @return UsuarioAutorizadorDTO
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
        
       $bo = new UsuarioAutorizadorBusinessImpl();
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
* atualizar() - Usado para invocar a classe de negócio UsuarioAutorizadorBusinessImpl de forma geral
* para gerenciar as regras de negócio do sistema.
*
* @param UsuarioAutorizadorDTO contendo dados para enviar para atualização
* @return uma instância de UsuarioAutorizadorDTO com resultdo da operação
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
            
           $bo = new UsuarioAutorizadorBusinessImpl();
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
* atualizarStatusUsuarioAutorizador() - Usado para invocar a classe de negócio UsuarioAutorizadorBusinessImpl de forma geral
* para gerenciar as atualizações do campo STATUS de acordo as regras de negócio do sistema.
*
* @param $id
* @param $status
* @return uma instância de UsuarioAutorizadorDTO com resultdo da operação
*
*/


    public function autalizarStatusUsuarioAutorizador($id, $status)
    {
        $daofactory = NULL;
        $retorno = NULL;
        try {
            $daofactory = DAOFactory::getDAOFactory();
            $daofactory->open();
            $daofactory->beginTransaction();
            

           $bo = new UsuarioAutorizadorBusinessImpl();
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
* cadastrar() - Usado para invocar a classe de negócio UsuarioAutorizadorBusinessImpl de forma geral
* para gerenciar a criação de registro de acordo as regras de negócio do sistema.
*
* @param $dto - Instância de UsuarioAutorizadorDTO
*
* @return uma instância de UsuarioAutorizadorDTO com resultdo da operação
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
            

           $bo = new UsuarioAutorizadorBusinessImpl();
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
* @return List<UsuarioAutorizadorDTO>[]
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
            
            // listar paginado UsuarioAutorizador
           $bo = new UsuarioAutorizadorBusinessImpl();
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
* realizar uma busca diretamente pela PK (Primary Key) da tabela USUARIO_AUTORIZADOR campo USAU_ID
*
* @param $id
* @return UsuarioAutorizadorDTO
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
            
            // pesquisar pela PK da tabela UsuarioAutorizador
           $bo = new UsuarioAutorizadorBusinessImpl();
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
* listarUsuarioAutorizadorPorStatus() - Usado para invocar a classe de negócio TipoEmpreendimentoBusinessImpl de forma geral
* realizar lista paginada de registros com uma instância de PaginacaoDTO
*
* @param $status
* @param $pag
* @param $qtde
* @param $coluna
* @param $ordem
* @return $PaginacaoDTO
*/

   public function listarUsuarioAutorizadorPorStatus($status='A', $pag=1, $qtde=0, $coluna=1, $ordem=0) 
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
           // listar paginado UsuarioAutorizador
           $bo = new UsuarioAutorizadorBusinessImpl();
           $retorno = $bo->listarUsuarioAutorizadorPorStatus($daofactory, $status, $pag, $qtde, $coluna, $ordem);
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
* pesquisarPorId_Usuario() - Usado para invocar a classe de negócio UsuarioAutorizadorBusinessImpl de forma geral
* realizar uma busca de ID do usuário diretamente na tabela USUARIO_AUTORIZADOR campo USUA_ID
*
* @param $id_usuario
* @return UsuarioAutorizadorDTO
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
            
            // pesquisar pelo atributo UsuarioAutorizador.id_usuario no campo USUA_ID da tabela USUARIO_AUTORIZADOR
           $bo = new UsuarioAutorizadorBusinessImpl();
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
* pesquisarPorId_Autorizador() - Usado para invocar a classe de negócio UsuarioAutorizadorBusinessImpl de forma geral
* realizar uma busca de ID do usuário autorizador diretamente na tabela USUARIO_AUTORIZADOR campo USUA_ID_AUTORIZADOR
*
* @param $id_autorizador
* @return UsuarioAutorizadorDTO
*
* 
*/

    public function pesquisarPorId_Autorizador($id_autorizador)
    {
        $daofactory = NULL;
        $retorno = NULL;
        try {
            $daofactory = DAOFactory::getDAOFactory();
            $daofactory->open();
            $daofactory->beginTransaction();
            
            // pesquisar pelo atributo UsuarioAutorizador.id_autorizador no campo USUA_ID_AUTORIZADOR da tabela USUARIO_AUTORIZADOR
           $bo = new UsuarioAutorizadorBusinessImpl();
           $retorno = $bo->carregarPorId_Autorizador($daofactory, $id_autorizador);
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
* pesquisarPorId_Campanha() - Usado para invocar a classe de negócio UsuarioAutorizadorBusinessImpl de forma geral
* realizar uma busca de ID da campanha diretamente na tabela USUARIO_AUTORIZADOR campo CAMP_ID
*
* @param $id_campanha
* @return UsuarioAutorizadorDTO
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
            
            // pesquisar pelo atributo UsuarioAutorizador.id_campanha no campo CAMP_ID da tabela USUARIO_AUTORIZADOR
           $bo = new UsuarioAutorizadorBusinessImpl();
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
* pesquisarPorTipo() - Usado para invocar a classe de negócio UsuarioAutorizadorBusinessImpl de forma geral
* realizar uma busca de Tipo de autorização diretamente na tabela USUARIO_AUTORIZADOR campo USAU_IN_TIPO
*
* @param $tipo
* @return UsuarioAutorizadorDTO
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
            
            // pesquisar pelo atributo UsuarioAutorizador.tipo no campo USAU_IN_TIPO da tabela USUARIO_AUTORIZADOR
           $bo = new UsuarioAutorizadorBusinessImpl();
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
* pesquisarPorPermissao() - Usado para invocar a classe de negócio UsuarioAutorizadorBusinessImpl de forma geral
* realizar uma busca de Qual autorização diretamente na tabela USUARIO_AUTORIZADOR campo USAU_IN_AUTORIZACAO
*
* @param $permissao
* @return UsuarioAutorizadorDTO
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
            
            // pesquisar pelo atributo UsuarioAutorizador.permissao no campo USAU_IN_AUTORIZACAO da tabela USUARIO_AUTORIZADOR
           $bo = new UsuarioAutorizadorBusinessImpl();
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
* pesquisarPorDatainicio() - Usado para invocar a classe de negócio UsuarioAutorizadorBusinessImpl de forma geral
* realizar uma busca de Data Início diretamente na tabela USUARIO_AUTORIZADOR campo USAU_DT_INICIO
*
* @param $dataInicio
* @return UsuarioAutorizadorDTO
*
* 
*/

    public function pesquisarPorDatainicio($dataInicio)
    {
        $daofactory = NULL;
        $retorno = NULL;
        try {
            $daofactory = DAOFactory::getDAOFactory();
            $daofactory->open();
            $daofactory->beginTransaction();
            
            // pesquisar pelo atributo UsuarioAutorizador.dataInicio no campo USAU_DT_INICIO da tabela USUARIO_AUTORIZADOR
           $bo = new UsuarioAutorizadorBusinessImpl();
           $retorno = $bo->carregarPorDatainicio($daofactory, $dataInicio);
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
* pesquisarPorDatatermino() - Usado para invocar a classe de negócio UsuarioAutorizadorBusinessImpl de forma geral
* realizar uma busca de Data Término diretamente na tabela USUARIO_AUTORIZADOR campo USAU_DT_TERMINO
*
* @param $dataTermino
* @return UsuarioAutorizadorDTO
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
            
            // pesquisar pelo atributo UsuarioAutorizador.dataTermino no campo USAU_DT_TERMINO da tabela USUARIO_AUTORIZADOR
           $bo = new UsuarioAutorizadorBusinessImpl();
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
* atualizarId_UsuarioPorPK() - Usado para invocar a classe de negócio UsuarioAutorizadorBusinessImpl de forma geral
* realizar uma atualização de ID do usuário diretamente na tabela USUARIO_AUTORIZADOR campo USUA_ID
* @param $id
* @param $id_usuario
* @return UsuarioAutorizadorDTO
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
            
            // atualizar registro por meio do método UsuarioAutorizadorBusinessImpl::atualizarId_UsuarioPorPK($id_usuario,$id)
           $bo = new UsuarioAutorizadorBusinessImpl();
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
* atualizarId_AutorizadorPorPK() - Usado para invocar a classe de negócio UsuarioAutorizadorBusinessImpl de forma geral
* realizar uma atualização de ID do usuário autorizador diretamente na tabela USUARIO_AUTORIZADOR campo USUA_ID_AUTORIZADOR
* @param $id
* @param $id_autorizador
* @return UsuarioAutorizadorDTO
*
* 
*/

    public function atualizarId_AutorizadorPorPK($id_autorizador,$id)
    {
        $daofactory = NULL;
        $retorno = NULL;
        try {
            $daofactory = DAOFactory::getDAOFactory();
            $daofactory->open();
            $daofactory->beginTransaction();
            
            // atualizar registro por meio do método UsuarioAutorizadorBusinessImpl::atualizarId_AutorizadorPorPK($id_autorizador,$id)
           $bo = new UsuarioAutorizadorBusinessImpl();
           $retorno = $bo->atualizarId_AutorizadorPorPK($daofactory,$id_autorizador,$id);

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
* atualizarId_CampanhaPorPK() - Usado para invocar a classe de negócio UsuarioAutorizadorBusinessImpl de forma geral
* realizar uma atualização de ID da campanha diretamente na tabela USUARIO_AUTORIZADOR campo CAMP_ID
* @param $id
* @param $id_campanha
* @return UsuarioAutorizadorDTO
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
            
            // atualizar registro por meio do método UsuarioAutorizadorBusinessImpl::atualizarId_CampanhaPorPK($id_campanha,$id)
           $bo = new UsuarioAutorizadorBusinessImpl();
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
* atualizarTipoPorPK() - Usado para invocar a classe de negócio UsuarioAutorizadorBusinessImpl de forma geral
* realizar uma atualização de Tipo de autorização diretamente na tabela USUARIO_AUTORIZADOR campo USAU_IN_TIPO
* @param $id
* @param $tipo
* @return UsuarioAutorizadorDTO
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
            
            // atualizar registro por meio do método UsuarioAutorizadorBusinessImpl::atualizarTipoPorPK($tipo,$id)
           $bo = new UsuarioAutorizadorBusinessImpl();
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
* atualizarPermissaoPorPK() - Usado para invocar a classe de negócio UsuarioAutorizadorBusinessImpl de forma geral
* realizar uma atualização de Qual autorização diretamente na tabela USUARIO_AUTORIZADOR campo USAU_IN_AUTORIZACAO
* @param $id
* @param $permissao
* @return UsuarioAutorizadorDTO
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
            
            // atualizar registro por meio do método UsuarioAutorizadorBusinessImpl::atualizarPermissaoPorPK($permissao,$id)
           $bo = new UsuarioAutorizadorBusinessImpl();
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
* atualizarDatainicioPorPK() - Usado para invocar a classe de negócio UsuarioAutorizadorBusinessImpl de forma geral
* realizar uma atualização de Data Início diretamente na tabela USUARIO_AUTORIZADOR campo USAU_DT_INICIO
* @param $id
* @param $dataInicio
* @return UsuarioAutorizadorDTO
*
* 
*/

    public function atualizarDatainicioPorPK($dataInicio,$id)
    {
        $daofactory = NULL;
        $retorno = NULL;
        try {
            $daofactory = DAOFactory::getDAOFactory();
            $daofactory->open();
            $daofactory->beginTransaction();
            
            // atualizar registro por meio do método UsuarioAutorizadorBusinessImpl::atualizarDatainicioPorPK($dataInicio,$id)
           $bo = new UsuarioAutorizadorBusinessImpl();
           $retorno = $bo->atualizarDatainicioPorPK($daofactory,$dataInicio,$id);

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
* atualizarDataterminoPorPK() - Usado para invocar a classe de negócio UsuarioAutorizadorBusinessImpl de forma geral
* realizar uma atualização de Data Término diretamente na tabela USUARIO_AUTORIZADOR campo USAU_DT_TERMINO
* @param $id
* @param $dataTermino
* @return UsuarioAutorizadorDTO
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
            
            // atualizar registro por meio do método UsuarioAutorizadorBusinessImpl::atualizarDataterminoPorPK($dataTermino,$id)
           $bo = new UsuarioAutorizadorBusinessImpl();
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
* listarUsuarioAutorizadorPorUsuaIdStatus() - Usado para invocar a classe de negócio TipoEmpreendimentoBusinessImpl de forma geral
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

   public function listarUsuarioAutorizadorPorUsuaIdStatus($usuaid, $status='A', $pag=1, $qtde=0, $coluna=1, $ordem=0) 
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
           // listar paginado UsuarioAutorizador
           $bo = new UsuarioAutorizadorBusinessImpl();
           $retorno = $bo->listarUsuarioAutorizadorPorUsuaIdStatus($daofactory, $usuaid, $status, $pag, $qtde, $coluna, $ordem);
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
* listarUsuarioAutorizadorPorUsuaIdAutorizadorCampId() - Usado para invocar a classe de negócio TipoEmpreendimentoBusinessImpl de forma geral
* realizar lista paginada de registros tendo como referência os registros do usuário logado com uma instância de PaginacaoDTO
*
* @param $usuaid
* @param $campid
* @param $status
* @param $pag
* @param $qtde
* @param $coluna
* @param $ordem
* @return $PaginacaoDTO
*/

public function listarUsuarioAutorizadorPorUsuaIdAutorizadorCampId($usuaid, $campid, $status='A', $pag=1, $qtde=0, $coluna=1, $ordem=0) 
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
        // listar paginado UsuarioAutorizador
        $bo = new UsuarioAutorizadorBusinessImpl(); 
        $retorno = $bo->listarUsuarioAutorizadorPorUsuaIdAutorizadorCampId($daofactory, $usuaid, $campid, $status, $pag, $qtde, $coluna, $ordem);
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
* listarUsuarioAutorizadorPorUsuaIdAutorizadorStatus() - Usado para invocar a classe de negócio TipoEmpreendimentoBusinessImpl de forma geral
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

public function listarUsuarioAutorizadorPorUsuaIdAutorizadorStatus($usuaid, $status='A', $pag=1, $qtde=0, $coluna=1, $ordem=0) 
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
        // listar paginado UsuarioAutorizador
        $bo = new UsuarioAutorizadorBusinessImpl(); 
        $retorno = $bo->listarUsuarioAutorizadorPorUsuaIdAutorizadorStatus($daofactory, $usuaid, $status, $pag, $qtde, $coluna, $ordem);
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
