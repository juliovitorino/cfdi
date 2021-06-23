<?php

//importar dependencias
require_once 'UsuarioCampanhaSorteioTicketService.php';
require_once 'UsuarioCampanhaSorteioTicketBusinessImpl.php';
require_once '../variavel/ConstantesVariavel.php';
require_once '../variavel/VariavelCache.php';
require_once '../mensagem/ConstantesMensagem.php';
require_once '../mensagem/MensagemCache.php';

require_once '../daofactory/DAOFactory.php';


/**
*
* UsuarioCampanhaSorteioTicketServiceImpl - Implementação dos servicos para Classe de negócio com métodos para apoiar a integridade de informações sobre tickets de usuários em campanhas sorteio gerenciado pela plataforma
* Camada de Serviços UsuarioCampanhaSorteioTicket - camada responsável pela lógica de negócios de UsuarioCampanhaSorteioTicket do sistema. 
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
* @since 22/06/2021 10:37:39
*
*/
class UsuarioCampanhaSorteioTicketServiceImpl implements UsuarioCampanhaSorteioTicketService
{
    
    function __construct() {    }

/**
*
* listarTudo() - Usado para invocar a classe de negócio UsuarioCampanhaSorteioTicketBusinessImpl de forma geral
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
* PesquisarMaxPKAtivoIdPorStatus() - Usado para invocar a classe de negócio UsuarioCampanhaSorteioTicketBusinessImpl de forma geral
* a buscar a MAIOR PK pra um dado status.
*
* @param status
* @return UsuarioCampanhaSorteioTicketDTO
*
*/

public function pesquisarMaxPKAtivoIduscsPorStatus($iduscs,$status)
{
    $daofactory = NULL;
    $retorno = NULL;
    try {
        $daofactory = DAOFactory::getDAOFactory();
        $daofactory->open();
        $daofactory->beginTransaction();
        
       $bo = new UsuarioCampanhaSorteioTicketBusinessImpl();
       $retorno = $bo->pesquisarMaxPKAtivoIduscsPorStatus($daofactory, $iduscs,$status);
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
* atualizar() - Usado para invocar a classe de negócio UsuarioCampanhaSorteioTicketBusinessImpl de forma geral
* para gerenciar as regras de negócio do sistema.
*
* @param UsuarioCampanhaSorteioTicketDTO contendo dados para enviar para atualização
* @return uma instância de UsuarioCampanhaSorteioTicketDTO com resultdo da operação
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
            
           $bo = new UsuarioCampanhaSorteioTicketBusinessImpl();
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
* atualizarStatusUsuarioCampanhaSorteioTicket() - Usado para invocar a classe de negócio UsuarioCampanhaSorteioTicketBusinessImpl de forma geral
* para gerenciar as atualizações do campo STATUS de acordo as regras de negócio do sistema.
*
* @param $id
* @param $status
* @return uma instância de UsuarioCampanhaSorteioTicketDTO com resultdo da operação
*
*/


    public function autalizarStatusUsuarioCampanhaSorteioTicket($id, $status)
    {
        $daofactory = NULL;
        $retorno = NULL;
        try {
            $daofactory = DAOFactory::getDAOFactory();
            $daofactory->open();
            $daofactory->beginTransaction();
            

           $bo = new UsuarioCampanhaSorteioTicketBusinessImpl();
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
* cadastrar() - Usado para invocar a classe de negócio UsuarioCampanhaSorteioTicketBusinessImpl de forma geral
* para gerenciar a criação de registro de acordo as regras de negócio do sistema.
*
* @param $dto - Instância de UsuarioCampanhaSorteioTicketDTO
*
* @return uma instância de UsuarioCampanhaSorteioTicketDTO com resultdo da operação
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
            

           $bo = new UsuarioCampanhaSorteioTicketBusinessImpl();
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
* @return List<UsuarioCampanhaSorteioTicketDTO>[]
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
            
            // listar paginado UsuarioCampanhaSorteioTicket
           $bo = new UsuarioCampanhaSorteioTicketBusinessImpl();
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
* realizar uma busca diretamente pela PK (Primary Key) da tabela USUARIO_CAMPANHA_SORTEIO_TICKET campo UCST_ID
*
* @param $id
* @return UsuarioCampanhaSorteioTicketDTO
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
            
            // pesquisar pela PK da tabela UsuarioCampanhaSorteioTicket
           $bo = new UsuarioCampanhaSorteioTicketBusinessImpl();
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
* listarUsuarioCampanhaSorteioTicketPorStatus() - Usado para invocar a classe de negócio TipoEmpreendimentoBusinessImpl de forma geral
* realizar lista paginada de registros com uma instância de PaginacaoDTO
*
* @param $status
* @param $pag
* @param $qtde
* @param $coluna
* @param $ordem
* @return $PaginacaoDTO
*/

   public function listarUsuarioCampanhaSorteioTicketPorStatus($status='A', $pag=1, $qtde=0, $coluna=1, $ordem=0) 
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
           // listar paginado UsuarioCampanhaSorteioTicket
           $bo = new UsuarioCampanhaSorteioTicketBusinessImpl();
           $retorno = $bo->listarUsuarioCampanhaSorteioTicketPorStatus($daofactory, $status, $pag, $qtde, $coluna, $ordem);
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
* pesquisarPorIduscs() - Usado para invocar a classe de negócio UsuarioCampanhaSorteioTicketBusinessImpl de forma geral
* realizar uma busca de ID Usuario Campanha Sorteio diretamente na tabela USUARIO_CAMPANHA_SORTEIO_TICKET campo USCS_ID
*
* @param $iduscs
* @return UsuarioCampanhaSorteioTicketDTO
*
* 
*/

    public function pesquisarPorIduscs($iduscs)
    {
        $daofactory = NULL;
        $retorno = NULL;
        try {
            $daofactory = DAOFactory::getDAOFactory();
            $daofactory->open();
            $daofactory->beginTransaction();
            
            // pesquisar pelo atributo UsuarioCampanhaSorteioTicket.iduscs no campo USCS_ID da tabela USUARIO_CAMPANHA_SORTEIO_TICKET
           $bo = new UsuarioCampanhaSorteioTicketBusinessImpl();
           $retorno = $bo->carregarPorIduscs($daofactory, $iduscs);
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
* pesquisarPorTicket() - Usado para invocar a classe de negócio UsuarioCampanhaSorteioTicketBusinessImpl de forma geral
* realizar uma busca de Número do Ticket diretamente na tabela USUARIO_CAMPANHA_SORTEIO_TICKET campo UCST_NU_TICKET
*
* @param $ticket
* @return UsuarioCampanhaSorteioTicketDTO
*
* 
*/

    public function pesquisarPorTicket($ticket)
    {
        $daofactory = NULL;
        $retorno = NULL;
        try {
            $daofactory = DAOFactory::getDAOFactory();
            $daofactory->open();
            $daofactory->beginTransaction();
            
            // pesquisar pelo atributo UsuarioCampanhaSorteioTicket.ticket no campo UCST_NU_TICKET da tabela USUARIO_CAMPANHA_SORTEIO_TICKET
           $bo = new UsuarioCampanhaSorteioTicketBusinessImpl();
           $retorno = $bo->carregarPorTicket($daofactory, $ticket);
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
* atualizarIduscsPorPK() - Usado para invocar a classe de negócio UsuarioCampanhaSorteioTicketBusinessImpl de forma geral
* realizar uma atualização de ID Usuario Campanha Sorteio diretamente na tabela USUARIO_CAMPANHA_SORTEIO_TICKET campo USCS_ID
* @param $id
* @param $iduscs
* @return UsuarioCampanhaSorteioTicketDTO
*
* 
*/

    public function atualizarIduscsPorPK($iduscs,$id)
    {
        $daofactory = NULL;
        $retorno = NULL;
        try {
            $daofactory = DAOFactory::getDAOFactory();
            $daofactory->open();
            $daofactory->beginTransaction();
            
            // atualizar registro por meio do método UsuarioCampanhaSorteioTicketBusinessImpl::atualizarIduscsPorPK($iduscs,$id)
           $bo = new UsuarioCampanhaSorteioTicketBusinessImpl();
           $retorno = $bo->atualizarIduscsPorPK($daofactory,$iduscs,$id);

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
* atualizarTicketPorPK() - Usado para invocar a classe de negócio UsuarioCampanhaSorteioTicketBusinessImpl de forma geral
* realizar uma atualização de Número do Ticket diretamente na tabela USUARIO_CAMPANHA_SORTEIO_TICKET campo UCST_NU_TICKET
* @param $id
* @param $ticket
* @return UsuarioCampanhaSorteioTicketDTO
*
* 
*/

    public function atualizarTicketPorPK($ticket,$id)
    {
        $daofactory = NULL;
        $retorno = NULL;
        try {
            $daofactory = DAOFactory::getDAOFactory();
            $daofactory->open();
            $daofactory->beginTransaction();
            
            // atualizar registro por meio do método UsuarioCampanhaSorteioTicketBusinessImpl::atualizarTicketPorPK($ticket,$id)
           $bo = new UsuarioCampanhaSorteioTicketBusinessImpl();
           $retorno = $bo->atualizarTicketPorPK($daofactory,$ticket,$id);

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
* listarUsuarioCampanhaSorteioTicketPorUsuaIdStatus() - Usado para invocar a classe de negócio TipoEmpreendimentoBusinessImpl de forma geral
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

   public function listarUsuarioCampanhaSorteioTicketPorUsuaIdStatus($usuaid, $status='A', $pag=1, $qtde=0, $coluna=1, $ordem=0) 
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
           // listar paginado UsuarioCampanhaSorteioTicket
           $bo = new UsuarioCampanhaSorteioTicketBusinessImpl();
           $retorno = $bo->listarUsuarioCampanhaSorteioTicketPorUsuaIdStatus($daofactory, $usuaid, $status, $pag, $qtde, $coluna, $ordem);
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
* listarUsuarioCampanhaSorteioTicketPorUscsIdStatus() - Usado para invocar a classe de negócio TipoEmpreendimentoBusinessImpl de forma geral
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

public function listarUsuarioCampanhaSorteioTicketPorUscsIdStatus($uscsid, $status='A', $pag=1, $qtde=0, $coluna=1, $ordem=0) 
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
        // listar paginado UsuarioCampanhaSorteioTicket
        $bo = new UsuarioCampanhaSorteioTicketBusinessImpl();
        $retorno = $bo->listarUsuarioCampanhaSorteioTicketPorUscsIdStatus($daofactory, $uscsid, $status, $pag, $qtde, $coluna, $ordem);
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
