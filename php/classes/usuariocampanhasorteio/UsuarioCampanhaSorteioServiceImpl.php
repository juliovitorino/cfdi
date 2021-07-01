<?php

//importar dependencias
require_once 'UsuarioCampanhaSorteioService.php';
require_once 'UsuarioCampanhaSorteioBusinessImpl.php';
require_once '../variavel/ConstantesVariavel.php';
require_once '../variavel/VariavelCache.php';
require_once '../mensagem/ConstantesMensagem.php';
require_once '../mensagem/MensagemCache.php';

require_once '../daofactory/DAOFactory.php';


/**
*
* UsuarioCampanhaSorteioServiceImpl - Implementação dos servicos para Classe de negócio com métodos para apoiar a integridade de informações sobre usuários participantes de sorteios em campanhas gerenciado pela plataforma
* Camada de Serviços UsuarioCampanhaSorteio - camada responsável pela lógica de negócios de UsuarioCampanhaSorteio do sistema. 
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
* @since 22/06/2021 08:05:45
*
*/
class UsuarioCampanhaSorteioServiceImpl implements UsuarioCampanhaSorteioService
{
    
    function __construct() {    }

/**
*
* listarTudo() - Usado para invocar a classe de negócio UsuarioCampanhaSorteioBusinessImpl de forma geral
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
* PesquisarMaxPKAtivoIdPorStatus() - Usado para invocar a classe de negócio UsuarioCampanhaSorteioBusinessImpl de forma geral
* a buscar a MAIOR PK pra um dado status.
*
* @param status
* @return UsuarioCampanhaSorteioDTO
*
*/

public function pesquisarMaxPKAtivoIdusuarioPorStatus($idUsuario,$status)
{
    $daofactory = NULL;
    $retorno = NULL;
    try {
        $daofactory = DAOFactory::getDAOFactory();
        $daofactory->open();
        $daofactory->beginTransaction();
        
       $bo = new UsuarioCampanhaSorteioBusinessImpl();
       $retorno = $bo->pesquisarMaxPKAtivoIdusuarioPorStatus($daofactory, $idUsuario,$status);
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
* atualizar() - Usado para invocar a classe de negócio UsuarioCampanhaSorteioBusinessImpl de forma geral
* para gerenciar as regras de negócio do sistema.
*
* @param UsuarioCampanhaSorteioDTO contendo dados para enviar para atualização
* @return uma instância de UsuarioCampanhaSorteioDTO com resultdo da operação
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
            
           $bo = new UsuarioCampanhaSorteioBusinessImpl();
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
* atualizarStatusUsuarioCampanhaSorteio() - Usado para invocar a classe de negócio UsuarioCampanhaSorteioBusinessImpl de forma geral
* para gerenciar as atualizações do campo STATUS de acordo as regras de negócio do sistema.
*
* @param $id
* @param $status
* @return uma instância de UsuarioCampanhaSorteioDTO com resultdo da operação
*
*/


    public function autalizarStatusUsuarioCampanhaSorteio($id, $status)
    {
        $daofactory = NULL;
        $retorno = NULL;
        try {
            $daofactory = DAOFactory::getDAOFactory();
            $daofactory->open();
            $daofactory->beginTransaction();
            

           $bo = new UsuarioCampanhaSorteioBusinessImpl();
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
* cadastrar() - Usado para invocar a classe de negócio UsuarioCampanhaSorteioBusinessImpl de forma geral
* para gerenciar a criação de registro de acordo as regras de negócio do sistema.
*
* @param $dto - Instância de UsuarioCampanhaSorteioDTO
*
* @return uma instância de UsuarioCampanhaSorteioDTO com resultdo da operação
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
            

           $bo = new UsuarioCampanhaSorteioBusinessImpl();
           $retorno = $bo->inserirUsuarioParticipanteCampanhaSorteio($daofactory, $dto);

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
* @return List<UsuarioCampanhaSorteioDTO>[]
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
            
            // listar paginado UsuarioCampanhaSorteio
           $bo = new UsuarioCampanhaSorteioBusinessImpl();
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
* realizar uma busca diretamente pela PK (Primary Key) da tabela USUARIO_CAMPANHA_SORTEIO campo USCS_ID
*
* @param $id
* @return UsuarioCampanhaSorteioDTO
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
            
            // pesquisar pela PK da tabela UsuarioCampanhaSorteio
           $bo = new UsuarioCampanhaSorteioBusinessImpl();
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
* listarUsuarioCampanhaSorteioPorStatus() - Usado para invocar a classe de negócio TipoEmpreendimentoBusinessImpl de forma geral
* realizar lista paginada de registros com uma instância de PaginacaoDTO
*
* @param $status
* @param $pag
* @param $qtde
* @param $coluna
* @param $ordem
* @return $PaginacaoDTO
*/

   public function listarUsuarioCampanhaSorteioPorStatus($status='A', $pag=1, $qtde=0, $coluna=1, $ordem=0) 
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
           // listar paginado UsuarioCampanhaSorteio
           $bo = new UsuarioCampanhaSorteioBusinessImpl();
           $retorno = $bo->listarUsuarioCampanhaSorteioPorStatus($daofactory, $status, $pag, $qtde, $coluna, $ordem);
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
* pesquisarPorIdusuario() - Usado para invocar a classe de negócio UsuarioCampanhaSorteioBusinessImpl de forma geral
* realizar uma busca de ID do usuário diretamente na tabela USUARIO_CAMPANHA_SORTEIO campo USUA_ID
*
* @param $idUsuario
* @return UsuarioCampanhaSorteioDTO
*
* 
*/

    public function pesquisarPorIdusuario($idUsuario)
    {
        $daofactory = NULL;
        $retorno = NULL;
        try {
            $daofactory = DAOFactory::getDAOFactory();
            $daofactory->open();
            $daofactory->beginTransaction();
            
            // pesquisar pelo atributo UsuarioCampanhaSorteio.idUsuario no campo USUA_ID da tabela USUARIO_CAMPANHA_SORTEIO
           $bo = new UsuarioCampanhaSorteioBusinessImpl();
           $retorno = $bo->carregarPorIdusuario($daofactory, $idUsuario);
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
* pesquisarPorIdcampanhasorteio() - Usado para invocar a classe de negócio UsuarioCampanhaSorteioBusinessImpl de forma geral
* realizar uma busca de ID Campanha Sorteio diretamente na tabela USUARIO_CAMPANHA_SORTEIO campo CASO_ID
*
* @param $idCampanhaSorteio
* @return UsuarioCampanhaSorteioDTO
*
* 
*/

    public function pesquisarPorIdcampanhasorteio($idCampanhaSorteio)
    {
        $daofactory = NULL;
        $retorno = NULL;
        try {
            $daofactory = DAOFactory::getDAOFactory();
            $daofactory->open();
            $daofactory->beginTransaction();
            
            // pesquisar pelo atributo UsuarioCampanhaSorteio.idCampanhaSorteio no campo CASO_ID da tabela USUARIO_CAMPANHA_SORTEIO
           $bo = new UsuarioCampanhaSorteioBusinessImpl();
           $retorno = $bo->carregarPorIdcampanhasorteio($daofactory, $idCampanhaSorteio);
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
* atualizarIdusuarioPorPK() - Usado para invocar a classe de negócio UsuarioCampanhaSorteioBusinessImpl de forma geral
* realizar uma atualização de ID do usuário diretamente na tabela USUARIO_CAMPANHA_SORTEIO campo USUA_ID
* @param $id
* @param $idUsuario
* @return UsuarioCampanhaSorteioDTO
*
* 
*/

    public function atualizarIdusuarioPorPK($idUsuario,$id)
    {
        $daofactory = NULL;
        $retorno = NULL;
        try {
            $daofactory = DAOFactory::getDAOFactory();
            $daofactory->open();
            $daofactory->beginTransaction();
            
            // atualizar registro por meio do método UsuarioCampanhaSorteioBusinessImpl::atualizarIdusuarioPorPK($idUsuario,$id)
           $bo = new UsuarioCampanhaSorteioBusinessImpl();
           $retorno = $bo->atualizarIdusuarioPorPK($daofactory,$idUsuario,$id);

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
* atualizarIdcampanhasorteioPorPK() - Usado para invocar a classe de negócio UsuarioCampanhaSorteioBusinessImpl de forma geral
* realizar uma atualização de ID Campanha Sorteio diretamente na tabela USUARIO_CAMPANHA_SORTEIO campo CASO_ID
* @param $id
* @param $idCampanhaSorteio
* @return UsuarioCampanhaSorteioDTO
*
* 
*/

    public function atualizarIdcampanhasorteioPorPK($idCampanhaSorteio,$id)
    {
        $daofactory = NULL;
        $retorno = NULL;
        try {
            $daofactory = DAOFactory::getDAOFactory();
            $daofactory->open();
            $daofactory->beginTransaction();
            
            // atualizar registro por meio do método UsuarioCampanhaSorteioBusinessImpl::atualizarIdcampanhasorteioPorPK($idCampanhaSorteio,$id)
           $bo = new UsuarioCampanhaSorteioBusinessImpl();
           $retorno = $bo->atualizarIdcampanhasorteioPorPK($daofactory,$idCampanhaSorteio,$id);

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
* listarUsuarioCampanhaSorteioPorUsuaIdStatus() - Usado para invocar a classe de negócio TipoEmpreendimentoBusinessImpl de forma geral
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

   public function listarUsuarioCampanhaSorteioPorUsuaIdStatus($usuaid, $status='A', $pag=1, $qtde=0, $coluna=1, $ordem=0) 
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
           // listar paginado UsuarioCampanhaSorteio
           $bo = new UsuarioCampanhaSorteioBusinessImpl();
           $retorno = $bo->listarUsuarioCampanhaSorteioPorUsuaIdStatus($daofactory, $usuaid, $status, $pag, $qtde, $coluna, $ordem);
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

