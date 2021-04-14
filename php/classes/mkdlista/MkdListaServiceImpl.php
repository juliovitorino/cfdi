<?php

//importar dependencias
require_once 'MkdListaService.php';
require_once 'MkdListaBusinessImpl.php';
require_once '../variavel/ConstantesVariavel.php';
require_once '../variavel/VariavelCache.php';
require_once '../mensagem/ConstantesMensagem.php';
require_once '../mensagem/MensagemCache.php';

require_once '../daofactory/DAOFactory.php';


/**
*
* MkdListaServiceImpl - Implementação dos servicos para Classe de negócio com métodos para apoiar a integridade de informações sobre Leads gerenciado pela plataforma
* Camada de Serviços MkdLista - camada responsável pela lógica de negócios de MkdLista do sistema. 
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
* @since 04/11/2019 09:31:13
*
*/
class MkdListaServiceImpl implements MkdListaService
{
    
    function __construct() {    }

/**
*
* listarTudo() - Usado para invocar a classe de negócio MkdListaBusinessImpl de forma geral
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
* ativarNovoLead() - Ativar a conta de email marketing do lead proveniente de um mecanismo de captura
* ex. landing page
*
* @param $token
* @return MkdListaDTO
*
*/
public function ativarNovoLead($token)
{
    $daofactory = NULL;
    $retorno = NULL;
    try {
        $daofactory = DAOFactory::getDAOFactory();
        $daofactory->open();
        $daofactory->beginTransaction();
        
       $bo = new MkdListaBusinessImpl();
       $retorno = $bo->ativarNovoLead($daofactory, $token);
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
* PesquisarMaxPKAtivoIdPorStatus() - Usado para invocar a classe de negócio MkdListaBusinessImpl de forma geral
* a buscar a MAIOR PK pra um dado status.
*
* @param status
* @return MkdListaDTO
*
*/

public function pesquisarMaxPKAtivoId_Mkd_CampanhaPorStatus($id_mkd_campanha,$status)
{
    $daofactory = NULL;
    $retorno = NULL;
    try {
        $daofactory = DAOFactory::getDAOFactory();
        $daofactory->open();
        $daofactory->beginTransaction();
        
       $bo = new MkdListaBusinessImpl();
       $retorno = $bo->pesquisarMaxPKAtivoId_Mkd_CampanhaPorStatus($daofactory, $id_mkd_campanha,$status);
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
* atualizar() - Usado para invocar a classe de negócio MkdListaBusinessImpl de forma geral
* para gerenciar as regras de negócio do sistema.
*
* @param MkdListaDTO contendo dados para enviar para atualização
* @return uma instância de MkdListaDTO com resultdo da operação
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
            
           $bo = new MkdListaBusinessImpl();
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
* atualizarStatusMkdLista() - Usado para invocar a classe de negócio MkdListaBusinessImpl de forma geral
* para gerenciar as atualizações do campo STATUS de acordo as regras de negócio do sistema.
*
* @param $id
* @param $status
* @return uma instância de MkdListaDTO com resultdo da operação
*
*/


    public function autalizarStatusMkdLista($id, $status)
    {
        $daofactory = NULL;
        $retorno = NULL;
        try {
            $daofactory = DAOFactory::getDAOFactory();
            $daofactory->open();
            $daofactory->beginTransaction();
            

           $bo = new MkdListaBusinessImpl();
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
* cadastrar() - Usado para invocar a classe de negócio MkdListaBusinessImpl de forma geral
* para gerenciar a criação de registro de acordo as regras de negócio do sistema.
*
* @param $dto - Instância de MkdListaDTO
*
* @return uma instância de MkdListaDTO com resultdo da operação
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
            

           $bo = new MkdListaBusinessImpl();
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
* @return List<MkdListaDTO>[]
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
            
            // listar paginado MkdLista
           $bo = new MkdListaBusinessImpl();
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
* realizar uma busca diretamente pela PK (Primary Key) da tabela MKD_EMAIL_LISTA campo MKEL_ID
*
* @param $id
* @return MkdListaDTO
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
            
            // pesquisar pela PK da tabela MkdLista
           $bo = new MkdListaBusinessImpl();
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
* listarMkdListaPorStatus() - Usado para invocar a classe de negócio TipoEmpreendimentoBusinessImpl de forma geral
* realizar lista paginada de registros com uma instância de PaginacaoDTO
*
* @param $status
* @param $pag
* @param $qtde
* @param $coluna
* @param $ordem
* @return $PaginacaoDTO
*/

   public function listarMkdListaPorStatus($status='A', $pag=1, $qtde=0, $coluna=1, $ordem=0) 
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
           // listar paginado MkdLista
           $bo = new MkdListaBusinessImpl();
           $retorno = $bo->listarMkdListaPorStatus($daofactory, $status, $pag, $qtde, $coluna, $ordem);
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
* pesquisarPorId_Mkd_Campanha() - Usado para invocar a classe de negócio MkdListaBusinessImpl de forma geral
* realizar uma busca de ID da Campanha MKD diretamente na tabela MKD_EMAIL_LISTA campo MKCE_ID
*
* @param $id_mkd_campanha
* @return MkdListaDTO
*
* 
*/

    public function pesquisarPorId_Mkd_Campanha($id_mkd_campanha)
    {
        $daofactory = NULL;
        $retorno = NULL;
        try {
            $daofactory = DAOFactory::getDAOFactory();
            $daofactory->open();
            $daofactory->beginTransaction();
            
            // pesquisar pelo atributo MkdLista.id_mkd_campanha no campo MKCE_ID da tabela MKD_EMAIL_LISTA
           $bo = new MkdListaBusinessImpl();
           $retorno = $bo->carregarPorId_Mkd_Campanha($daofactory, $id_mkd_campanha);
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
* pesquisarPorNome() - Usado para invocar a classe de negócio MkdListaBusinessImpl de forma geral
* realizar uma busca de Nome diretamente na tabela MKD_EMAIL_LISTA campo MKEL_TX_NOME
*
* @param $nome
* @return MkdListaDTO
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
            
            // pesquisar pelo atributo MkdLista.nome no campo MKEL_TX_NOME da tabela MKD_EMAIL_LISTA
           $bo = new MkdListaBusinessImpl();
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
* pesquisarPorEmail() - Usado para invocar a classe de negócio MkdListaBusinessImpl de forma geral
* realizar uma busca de Email diretamente na tabela MKD_EMAIL_LISTA campo MKEL_TX_EMAIL
*
* @param $email
* @return MkdListaDTO
*
* 
*/

    public function pesquisarPorEmail($email)
    {
        $daofactory = NULL;
        $retorno = NULL;
        try {
            $daofactory = DAOFactory::getDAOFactory();
            $daofactory->open();
            $daofactory->beginTransaction();
            
            // pesquisar pelo atributo MkdLista.email no campo MKEL_TX_EMAIL da tabela MKD_EMAIL_LISTA
           $bo = new MkdListaBusinessImpl();
           $retorno = $bo->carregarPorEmail($daofactory, $email);
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
* pesquisarPorPrimeironome() - Usado para invocar a classe de negócio MkdListaBusinessImpl de forma geral
* realizar uma busca de Primeiro Nome diretamente na tabela MKD_EMAIL_LISTA campo MKEL_TX_PRIM_NOME
*
* @param $primeiroNome
* @return MkdListaDTO
*
* 
*/

    public function pesquisarPorPrimeironome($primeiroNome)
    {
        $daofactory = NULL;
        $retorno = NULL;
        try {
            $daofactory = DAOFactory::getDAOFactory();
            $daofactory->open();
            $daofactory->beginTransaction();
            
            // pesquisar pelo atributo MkdLista.primeiroNome no campo MKEL_TX_PRIM_NOME da tabela MKD_EMAIL_LISTA
           $bo = new MkdListaBusinessImpl();
           $retorno = $bo->carregarPorPrimeironome($daofactory, $primeiroNome);
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
* pesquisarPorSobrenome() - Usado para invocar a classe de negócio MkdListaBusinessImpl de forma geral
* realizar uma busca de Sobrenome diretamente na tabela MKD_EMAIL_LISTA campo MKEL_TX_SOBRENOME
*
* @param $sobrenome
* @return MkdListaDTO
*
* 
*/

    public function pesquisarPorSobrenome($sobrenome)
    {
        $daofactory = NULL;
        $retorno = NULL;
        try {
            $daofactory = DAOFactory::getDAOFactory();
            $daofactory->open();
            $daofactory->beginTransaction();
            
            // pesquisar pelo atributo MkdLista.sobrenome no campo MKEL_TX_SOBRENOME da tabela MKD_EMAIL_LISTA
           $bo = new MkdListaBusinessImpl();
           $retorno = $bo->carregarPorSobrenome($daofactory, $sobrenome);
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
* pesquisarPorWhatsapp() - Usado para invocar a classe de negócio MkdListaBusinessImpl de forma geral
* realizar uma busca de Contato Whatsapp diretamente na tabela MKD_EMAIL_LISTA campo MKEL_TX_WHATSAPP
*
* @param $whatsapp
* @return MkdListaDTO
*
* 
*/

    public function pesquisarPorWhatsapp($whatsapp)
    {
        $daofactory = NULL;
        $retorno = NULL;
        try {
            $daofactory = DAOFactory::getDAOFactory();
            $daofactory->open();
            $daofactory->beginTransaction();
            
            // pesquisar pelo atributo MkdLista.whatsapp no campo MKEL_TX_WHATSAPP da tabela MKD_EMAIL_LISTA
           $bo = new MkdListaBusinessImpl();
           $retorno = $bo->carregarPorWhatsapp($daofactory, $whatsapp);
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
* pesquisarPorHashlead() - Usado para invocar a classe de negócio MkdListaBusinessImpl de forma geral
* realizar uma busca de Hashcode lead diretamente na tabela MKD_EMAIL_LISTA campo MKEL_TX_HASH
*
* @param $hashlead
* @return MkdListaDTO
*
* 
*/

    public function pesquisarPorHashlead($hashlead)
    {
        $daofactory = NULL;
        $retorno = NULL;
        try {
            $daofactory = DAOFactory::getDAOFactory();
            $daofactory->open();
            $daofactory->beginTransaction();
            
            // pesquisar pelo atributo MkdLista.hashlead no campo MKEL_TX_HASH da tabela MKD_EMAIL_LISTA
           $bo = new MkdListaBusinessImpl();
           $retorno = $bo->carregarPorHashlead($daofactory, $hashlead);
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
* atualizarId_Mkd_CampanhaPorPK() - Usado para invocar a classe de negócio MkdListaBusinessImpl de forma geral
* realizar uma atualização de ID da Campanha MKD diretamente na tabela MKD_EMAIL_LISTA campo MKCE_ID
* @param $id
* @param $id_mkd_campanha
* @return MkdListaDTO
*
* 
*/

    public function atualizarId_Mkd_CampanhaPorPK($id_mkd_campanha,$id)
    {
        $daofactory = NULL;
        $retorno = NULL;
        try {
            $daofactory = DAOFactory::getDAOFactory();
            $daofactory->open();
            $daofactory->beginTransaction();
            
            // atualizar registro por meio do método MkdListaBusinessImpl::atualizarId_Mkd_CampanhaPorPK($id_mkd_campanha,$id)
           $bo = new MkdListaBusinessImpl();
           $retorno = $bo->atualizarId_Mkd_CampanhaPorPK($daofactory,$id_mkd_campanha,$id);

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
* atualizarNomePorPK() - Usado para invocar a classe de negócio MkdListaBusinessImpl de forma geral
* realizar uma atualização de Nome diretamente na tabela MKD_EMAIL_LISTA campo MKEL_TX_NOME
* @param $id
* @param $nome
* @return MkdListaDTO
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
            
            // atualizar registro por meio do método MkdListaBusinessImpl::atualizarNomePorPK($nome,$id)
           $bo = new MkdListaBusinessImpl();
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
* atualizarEmailPorPK() - Usado para invocar a classe de negócio MkdListaBusinessImpl de forma geral
* realizar uma atualização de Email diretamente na tabela MKD_EMAIL_LISTA campo MKEL_TX_EMAIL
* @param $id
* @param $email
* @return MkdListaDTO
*
* 
*/

    public function atualizarEmailPorPK($email,$id)
    {
        $daofactory = NULL;
        $retorno = NULL;
        try {
            $daofactory = DAOFactory::getDAOFactory();
            $daofactory->open();
            $daofactory->beginTransaction();
            
            // atualizar registro por meio do método MkdListaBusinessImpl::atualizarEmailPorPK($email,$id)
           $bo = new MkdListaBusinessImpl();
           $retorno = $bo->atualizarEmailPorPK($daofactory,$email,$id);

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
* atualizarPrimeironomePorPK() - Usado para invocar a classe de negócio MkdListaBusinessImpl de forma geral
* realizar uma atualização de Primeiro Nome diretamente na tabela MKD_EMAIL_LISTA campo MKEL_TX_PRIM_NOME
* @param $id
* @param $primeiroNome
* @return MkdListaDTO
*
* 
*/

    public function atualizarPrimeironomePorPK($primeiroNome,$id)
    {
        $daofactory = NULL;
        $retorno = NULL;
        try {
            $daofactory = DAOFactory::getDAOFactory();
            $daofactory->open();
            $daofactory->beginTransaction();
            
            // atualizar registro por meio do método MkdListaBusinessImpl::atualizarPrimeironomePorPK($primeiroNome,$id)
           $bo = new MkdListaBusinessImpl();
           $retorno = $bo->atualizarPrimeironomePorPK($daofactory,$primeiroNome,$id);

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
* atualizarSobrenomePorPK() - Usado para invocar a classe de negócio MkdListaBusinessImpl de forma geral
* realizar uma atualização de Sobrenome diretamente na tabela MKD_EMAIL_LISTA campo MKEL_TX_SOBRENOME
* @param $id
* @param $sobrenome
* @return MkdListaDTO
*
* 
*/

    public function atualizarSobrenomePorPK($sobrenome,$id)
    {
        $daofactory = NULL;
        $retorno = NULL;
        try {
            $daofactory = DAOFactory::getDAOFactory();
            $daofactory->open();
            $daofactory->beginTransaction();
            
            // atualizar registro por meio do método MkdListaBusinessImpl::atualizarSobrenomePorPK($sobrenome,$id)
           $bo = new MkdListaBusinessImpl();
           $retorno = $bo->atualizarSobrenomePorPK($daofactory,$sobrenome,$id);

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
* atualizarWhatsappPorPK() - Usado para invocar a classe de negócio MkdListaBusinessImpl de forma geral
* realizar uma atualização de Contato Whatsapp diretamente na tabela MKD_EMAIL_LISTA campo MKEL_TX_WHATSAPP
* @param $id
* @param $whatsapp
* @return MkdListaDTO
*
* 
*/

    public function atualizarWhatsappPorPK($whatsapp,$id)
    {
        $daofactory = NULL;
        $retorno = NULL;
        try {
            $daofactory = DAOFactory::getDAOFactory();
            $daofactory->open();
            $daofactory->beginTransaction();
            
            // atualizar registro por meio do método MkdListaBusinessImpl::atualizarWhatsappPorPK($whatsapp,$id)
           $bo = new MkdListaBusinessImpl();
           $retorno = $bo->atualizarWhatsappPorPK($daofactory,$whatsapp,$id);

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
* atualizarHashleadPorPK() - Usado para invocar a classe de negócio MkdListaBusinessImpl de forma geral
* realizar uma atualização de Hashcode lead diretamente na tabela MKD_EMAIL_LISTA campo MKEL_TX_HASH
* @param $id
* @param $hashlead
* @return MkdListaDTO
*
* 
*/

    public function atualizarHashleadPorPK($hashlead,$id)
    {
        $daofactory = NULL;
        $retorno = NULL;
        try {
            $daofactory = DAOFactory::getDAOFactory();
            $daofactory->open();
            $daofactory->beginTransaction();
            
            // atualizar registro por meio do método MkdListaBusinessImpl::atualizarHashleadPorPK($hashlead,$id)
           $bo = new MkdListaBusinessImpl();
           $retorno = $bo->atualizarHashleadPorPK($daofactory,$hashlead,$id);

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
* listarMkdListaPorUsuaIdStatus() - Usado para invocar a classe de negócio TipoEmpreendimentoBusinessImpl de forma geral
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

   public function listarMkdListaPorUsuaIdStatus($usuaid, $status='A', $pag=1, $qtde=0, $coluna=1, $ordem=0) 
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
           // listar paginado MkdLista
           $bo = new MkdListaBusinessImpl();
           $retorno = $bo->listarMkdListaPorUsuaIdStatus($daofactory, $usuaid, $status, $pag, $qtde, $coluna, $ordem);
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
