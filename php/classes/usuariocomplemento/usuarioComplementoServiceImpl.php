<?php

//importar dependencias
require_once 'UsuarioComplementoService.php';
require_once 'UsuarioComplementoBusinessImpl.php';
require_once '../variavel/ConstantesVariavel.php';
require_once '../variavel/VariavelCache.php';
require_once '../mensagem/ConstantesMensagem.php';
require_once '../mensagem/MensagemCache.php';

require_once '../daofactory/DAOFactory.php';


/**
*
* UsuarioComplementoServiceImpl - Implementação dos servicos para Classe de negócio com métodos para apoiar a integridade de informações sobre relação usuario complemento gerenciado pela plataforma
* Camada de Serviços UsuarioComplemento - camada responsável pela lógica de negócios de UsuarioComplemento do sistema. 
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
* @since 07/09/2021 10:47:36
*
*/
class UsuarioComplementoServiceImpl implements UsuarioComplementoService
{
    
    function __construct() {    }

/**
*
* listarTudo() - Usado para invocar a classe de negócio UsuarioComplementoBusinessImpl de forma geral
* para listar todos os registros sem critérios de paginação dos dados.
*
* Use este método com MUITA moderação.
*/

    public function listarTudo() {  }
    public function pesquisar($dto){ }
    public function cancelar($dto) { }

/**
*
* PesquisarMaxPKAtivoIdPorStatus() - Usado para invocar a classe de negócio UsuarioComplementoBusinessImpl de forma geral
* a buscar a MAIOR PK pra um dado status.
*
* @param status
* @return UsuarioComplementoDTO
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
        
       $bo = new UsuarioComplementoBusinessImpl();
       $retorno = $bo->pesquisarMaxPKAtivoIdusuarioPorStatus($daofactory, $idUsuario,$status);
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
* atualizar() - Usado para invocar a classe de negócio UsuarioComplementoBusinessImpl de forma geral
* para gerenciar as regras de negócio do sistema.
*
* @param UsuarioComplementoDTO contendo dados para enviar para atualização
* @return uma instância de UsuarioComplementoDTO com resultdo da operação
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
            
           $bo = new UsuarioComplementoBusinessImpl();
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
* atualizarStatusUsuarioComplemento() - Usado para invocar a classe de negócio UsuarioComplementoBusinessImpl de forma geral
* para gerenciar as atualizações do campo STATUS de acordo as regras de negócio do sistema.
*
* @param $id
* @param $status
* @return uma instância de UsuarioComplementoDTO com resultdo da operação
*
*/


    public function autalizarStatusUsuarioComplemento($id, $status)
    {
        $daofactory = NULL;
        $retorno = NULL;
        try {
            $daofactory = DAOFactory::getDAOFactory();
            $daofactory->open();
            $daofactory->beginTransaction();
            

           $bo = new UsuarioComplementoBusinessImpl();
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
* apagar() - Usado para invocar a classe de negócio UsuarioComplementoBusinessImpl de forma geral
* para gerenciar a exclusão de registro de acordo as regras de negócio do sistema.
*
* @param $dto - Instância de UsuarioComplementoDTO
*
* @return uma instância de UsuarioComplementoDTO com resultdo da operação
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
        

       $bo = new UsuarioComplementoBusinessImpl();
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
* cadastrar() - Usado para invocar a classe de negócio UsuarioComplementoBusinessImpl de forma geral
* para gerenciar a criação de registro de acordo as regras de negócio do sistema.
*
* @param $dto - Instância de UsuarioComplementoDTO
*
* @return uma instância de UsuarioComplementoDTO com resultdo da operação
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
            

           $bo = new UsuarioComplementoBusinessImpl();
           $retorno = $bo->inserirUsuarioComplemento($daofactory, $dto);

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
* @return List<UsuarioComplementoDTO>[]
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
            
            // listar paginado UsuarioComplemento
           $bo = new UsuarioComplementoBusinessImpl();
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
* realizar uma busca diretamente pela PK (Primary Key) da tabela USUARIO_COMPLEMENTO campo USCO_ID
*
* @param $id
* @return UsuarioComplementoDTO
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
            
            // pesquisar pela PK da tabela UsuarioComplemento
           $bo = new UsuarioComplementoBusinessImpl();
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
* listarUsuarioComplementoPorStatus() - Usado para invocar a classe de negócio TipoEmpreendimentoBusinessImpl de forma geral
* realizar lista paginada de registros com uma instância de PaginacaoDTO
*
* @param $status
* @param $pag
* @param $qtde
* @param $coluna
* @param $ordem
* @return $PaginacaoDTO
*/

   public function listarUsuarioComplementoPorStatus($status='A', $pag=1, $qtde=0, $coluna=1, $ordem=0) 
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
           // listar paginado UsuarioComplemento
           $bo = new UsuarioComplementoBusinessImpl();
           $retorno = $bo->listarUsuarioComplementoPorStatus($daofactory, $status, $pag, $qtde, $coluna, $ordem);
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
* pesquisarPorIdusuario() - Usado para invocar a classe de negócio UsuarioComplementoBusinessImpl de forma geral
* realizar uma busca de ID do usuário diretamente na tabela USUARIO_COMPLEMENTO campo USUA_ID
*
* @param $idUsuario
* @return UsuarioComplementoDTO
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
            
            // pesquisar pelo atributo UsuarioComplemento.idUsuario no campo USUA_ID da tabela USUARIO_COMPLEMENTO
           $bo = new UsuarioComplementoBusinessImpl();
           $retorno = $bo->carregarPorIdusuario($daofactory, $idUsuario);
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
* pesquisarPorDdd() - Usado para invocar a classe de negócio UsuarioComplementoBusinessImpl de forma geral
* realizar uma busca de DDD diretamente na tabela USUARIO_COMPLEMENTO campo USCO_TX_DDD
*
* @param $ddd
* @return UsuarioComplementoDTO
*
* 
*/

    public function pesquisarPorDdd($ddd)
    {
        $daofactory = NULL;
        $retorno = NULL;
        try {
            $daofactory = DAOFactory::getDAOFactory();
            $daofactory->open();
            $daofactory->beginTransaction();
            
            // pesquisar pelo atributo UsuarioComplemento.ddd no campo USCO_TX_DDD da tabela USUARIO_COMPLEMENTO
           $bo = new UsuarioComplementoBusinessImpl();
           $retorno = $bo->carregarPorDdd($daofactory, $ddd);
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
* pesquisarPorTelefone() - Usado para invocar a classe de negócio UsuarioComplementoBusinessImpl de forma geral
* realizar uma busca de Número Celular diretamente na tabela USUARIO_COMPLEMENTO campo USCO_TX_CEL
*
* @param $telefone
* @return UsuarioComplementoDTO
*
* 
*/

    public function pesquisarPorTelefone($telefone)
    {
        $daofactory = NULL;
        $retorno = NULL;
        try {
            $daofactory = DAOFactory::getDAOFactory();
            $daofactory->open();
            $daofactory->beginTransaction();
            
            // pesquisar pelo atributo UsuarioComplemento.telefone no campo USCO_TX_CEL da tabela USUARIO_COMPLEMENTO
           $bo = new UsuarioComplementoBusinessImpl();
           $retorno = $bo->carregarPorTelefone($daofactory, $telefone);
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
* pesquisarPorNomereceitafederal() - Usado para invocar a classe de negócio UsuarioComplementoBusinessImpl de forma geral
* realizar uma busca de Nome registrado na Receita Federal diretamente na tabela USUARIO_COMPLEMENTO campo USCO_NM_RECEITA_FEDERAL
*
* @param $nomeReceitaFederal
* @return UsuarioComplementoDTO
*
* 
*/

    public function pesquisarPorNomereceitafederal($nomeReceitaFederal)
    {
        $daofactory = NULL;
        $retorno = NULL;
        try {
            $daofactory = DAOFactory::getDAOFactory();
            $daofactory->open();
            $daofactory->beginTransaction();
            
            // pesquisar pelo atributo UsuarioComplemento.nomeReceitaFederal no campo USCO_NM_RECEITA_FEDERAL da tabela USUARIO_COMPLEMENTO
           $bo = new UsuarioComplementoBusinessImpl();
           $retorno = $bo->carregarPorNomereceitafederal($daofactory, $nomeReceitaFederal);
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
* pesquisarPorNomeresponsavel() - Usado para invocar a classe de negócio UsuarioComplementoBusinessImpl de forma geral
* realizar uma busca de Nome do Responsável Principal diretamente na tabela USUARIO_COMPLEMENTO campo USCO_NM_RESPONSAVEL
*
* @param $nomeResponsavel
* @return UsuarioComplementoDTO
*
* 
*/

    public function pesquisarPorNomeresponsavel($nomeResponsavel)
    {
        $daofactory = NULL;
        $retorno = NULL;
        try {
            $daofactory = DAOFactory::getDAOFactory();
            $daofactory->open();
            $daofactory->beginTransaction();
            
            // pesquisar pelo atributo UsuarioComplemento.nomeResponsavel no campo USCO_NM_RESPONSAVEL da tabela USUARIO_COMPLEMENTO
           $bo = new UsuarioComplementoBusinessImpl();
           $retorno = $bo->carregarPorNomeresponsavel($daofactory, $nomeResponsavel);
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
* pesquisarPorUrlsite() - Usado para invocar a classe de negócio UsuarioComplementoBusinessImpl de forma geral
* realizar uma busca de URL do Website diretamente na tabela USUARIO_COMPLEMENTO campo USCO_TX_URL_WEBSITE
*
* @param $urlsite
* @return UsuarioComplementoDTO
*
* 
*/

    public function pesquisarPorUrlsite($urlsite)
    {
        $daofactory = NULL;
        $retorno = NULL;
        try {
            $daofactory = DAOFactory::getDAOFactory();
            $daofactory->open();
            $daofactory->beginTransaction();
            
            // pesquisar pelo atributo UsuarioComplemento.urlsite no campo USCO_TX_URL_WEBSITE da tabela USUARIO_COMPLEMENTO
           $bo = new UsuarioComplementoBusinessImpl();
           $retorno = $bo->carregarPorUrlsite($daofactory, $urlsite);
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
* pesquisarPorUrlfacebook() - Usado para invocar a classe de negócio UsuarioComplementoBusinessImpl de forma geral
* realizar uma busca de URL do facebook diretamente na tabela USUARIO_COMPLEMENTO campo USCO_TX_URL_FACEBOOK
*
* @param $urlFacebook
* @return UsuarioComplementoDTO
*
* 
*/

    public function pesquisarPorUrlfacebook($urlFacebook)
    {
        $daofactory = NULL;
        $retorno = NULL;
        try {
            $daofactory = DAOFactory::getDAOFactory();
            $daofactory->open();
            $daofactory->beginTransaction();
            
            // pesquisar pelo atributo UsuarioComplemento.urlFacebook no campo USCO_TX_URL_FACEBOOK da tabela USUARIO_COMPLEMENTO
           $bo = new UsuarioComplementoBusinessImpl();
           $retorno = $bo->carregarPorUrlfacebook($daofactory, $urlFacebook);
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
* pesquisarPorUrlinstagram() - Usado para invocar a classe de negócio UsuarioComplementoBusinessImpl de forma geral
* realizar uma busca de Conta Instagram diretamente na tabela USUARIO_COMPLEMENTO campo USCO_TX_URL_INSTAGRAM
*
* @param $urlInstagram
* @return UsuarioComplementoDTO
*
* 
*/

    public function pesquisarPorUrlinstagram($urlInstagram)
    {
        $daofactory = NULL;
        $retorno = NULL;
        try {
            $daofactory = DAOFactory::getDAOFactory();
            $daofactory->open();
            $daofactory->beginTransaction();
            
            // pesquisar pelo atributo UsuarioComplemento.urlInstagram no campo USCO_TX_URL_INSTAGRAM da tabela USUARIO_COMPLEMENTO
           $bo = new UsuarioComplementoBusinessImpl();
           $retorno = $bo->carregarPorUrlinstagram($daofactory, $urlInstagram);
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
* pesquisarPorUrlpinterest() - Usado para invocar a classe de negócio UsuarioComplementoBusinessImpl de forma geral
* realizar uma busca de URL do Pinterest diretamente na tabela USUARIO_COMPLEMENTO campo USCO_TX_URL_PINTEREST
*
* @param $urlPinterest
* @return UsuarioComplementoDTO
*
* 
*/

    public function pesquisarPorUrlpinterest($urlPinterest)
    {
        $daofactory = NULL;
        $retorno = NULL;
        try {
            $daofactory = DAOFactory::getDAOFactory();
            $daofactory->open();
            $daofactory->beginTransaction();
            
            // pesquisar pelo atributo UsuarioComplemento.urlPinterest no campo USCO_TX_URL_PINTEREST da tabela USUARIO_COMPLEMENTO
           $bo = new UsuarioComplementoBusinessImpl();
           $retorno = $bo->carregarPorUrlpinterest($daofactory, $urlPinterest);
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
* pesquisarPorUrlskype() - Usado para invocar a classe de negócio UsuarioComplementoBusinessImpl de forma geral
* realizar uma busca de Apelido Skype diretamente na tabela USUARIO_COMPLEMENTO campo USCO_TX_URL_SKYPE
*
* @param $urlSkype
* @return UsuarioComplementoDTO
*
* 
*/

    public function pesquisarPorUrlskype($urlSkype)
    {
        $daofactory = NULL;
        $retorno = NULL;
        try {
            $daofactory = DAOFactory::getDAOFactory();
            $daofactory->open();
            $daofactory->beginTransaction();
            
            // pesquisar pelo atributo UsuarioComplemento.urlSkype no campo USCO_TX_URL_SKYPE da tabela USUARIO_COMPLEMENTO
           $bo = new UsuarioComplementoBusinessImpl();
           $retorno = $bo->carregarPorUrlskype($daofactory, $urlSkype);
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
* pesquisarPorUrltwitter() - Usado para invocar a classe de negócio UsuarioComplementoBusinessImpl de forma geral
* realizar uma busca de Conta Twitter diretamente na tabela USUARIO_COMPLEMENTO campo USCO_TX_URL_TWITTER
*
* @param $urlTwitter
* @return UsuarioComplementoDTO
*
* 
*/

    public function pesquisarPorUrltwitter($urlTwitter)
    {
        $daofactory = NULL;
        $retorno = NULL;
        try {
            $daofactory = DAOFactory::getDAOFactory();
            $daofactory->open();
            $daofactory->beginTransaction();
            
            // pesquisar pelo atributo UsuarioComplemento.urlTwitter no campo USCO_TX_URL_TWITTER da tabela USUARIO_COMPLEMENTO
           $bo = new UsuarioComplementoBusinessImpl();
           $retorno = $bo->carregarPorUrltwitter($daofactory, $urlTwitter);
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
* pesquisarPorUrlfacetime() - Usado para invocar a classe de negócio UsuarioComplementoBusinessImpl de forma geral
* realizar uma busca de Conta Facetime diretamente na tabela USUARIO_COMPLEMENTO campo USCO_TX_URL_FACETIME
*
* @param $urlFacetime
* @return UsuarioComplementoDTO
*
* 
*/

    public function pesquisarPorUrlfacetime($urlFacetime)
    {
        $daofactory = NULL;
        $retorno = NULL;
        try {
            $daofactory = DAOFactory::getDAOFactory();
            $daofactory->open();
            $daofactory->beginTransaction();
            
            // pesquisar pelo atributo UsuarioComplemento.urlFacetime no campo USCO_TX_URL_FACETIME da tabela USUARIO_COMPLEMENTO
           $bo = new UsuarioComplementoBusinessImpl();
           $retorno = $bo->carregarPorUrlfacetime($daofactory, $urlFacetime);
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
* pesquisarPorUrlresponsavel() - Usado para invocar a classe de negócio UsuarioComplementoBusinessImpl de forma geral
* realizar uma busca de URL Foto Responsável diretamente na tabela USUARIO_COMPLEMENTO campo USCO_TX_URL_IMG1
*
* @param $urlResponsavel
* @return UsuarioComplementoDTO
*
* 
*/

    public function pesquisarPorUrlresponsavel($urlResponsavel)
    {
        $daofactory = NULL;
        $retorno = NULL;
        try {
            $daofactory = DAOFactory::getDAOFactory();
            $daofactory->open();
            $daofactory->beginTransaction();
            
            // pesquisar pelo atributo UsuarioComplemento.urlResponsavel no campo USCO_TX_URL_IMG1 da tabela USUARIO_COMPLEMENTO
           $bo = new UsuarioComplementoBusinessImpl();
           $retorno = $bo->carregarPorUrlresponsavel($daofactory, $urlResponsavel);
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
* pesquisarPorUrlfoto2() - Usado para invocar a classe de negócio UsuarioComplementoBusinessImpl de forma geral
* realizar uma busca de URL Foto 2 diretamente na tabela USUARIO_COMPLEMENTO campo USCO_TX_URL_IMG2
*
* @param $urlFoto2
* @return UsuarioComplementoDTO
*
* 
*/

    public function pesquisarPorUrlfoto2($urlFoto2)
    {
        $daofactory = NULL;
        $retorno = NULL;
        try {
            $daofactory = DAOFactory::getDAOFactory();
            $daofactory->open();
            $daofactory->beginTransaction();
            
            // pesquisar pelo atributo UsuarioComplemento.urlFoto2 no campo USCO_TX_URL_IMG2 da tabela USUARIO_COMPLEMENTO
           $bo = new UsuarioComplementoBusinessImpl();
           $retorno = $bo->carregarPorUrlfoto2($daofactory, $urlFoto2);
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
* pesquisarPorUrlfoto3() - Usado para invocar a classe de negócio UsuarioComplementoBusinessImpl de forma geral
* realizar uma busca de URL Foto 3 diretamente na tabela USUARIO_COMPLEMENTO campo USCO_TX_URL_IMG3
*
* @param $urlFoto3
* @return UsuarioComplementoDTO
*
* 
*/

    public function pesquisarPorUrlfoto3($urlFoto3)
    {
        $daofactory = NULL;
        $retorno = NULL;
        try {
            $daofactory = DAOFactory::getDAOFactory();
            $daofactory->open();
            $daofactory->beginTransaction();
            
            // pesquisar pelo atributo UsuarioComplemento.urlFoto3 no campo USCO_TX_URL_IMG3 da tabela USUARIO_COMPLEMENTO
           $bo = new UsuarioComplementoBusinessImpl();
           $retorno = $bo->carregarPorUrlfoto3($daofactory, $urlFoto3);
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
* pesquisarPorDesclivre() - Usado para invocar a classe de negócio UsuarioComplementoBusinessImpl de forma geral
* realizar uma busca de Descrição Livre diretamente na tabela USUARIO_COMPLEMENTO campo USCO_TX_DESC_LIVRE
*
* @param $descLivre
* @return UsuarioComplementoDTO
*
* 
*/

    public function pesquisarPorDesclivre($descLivre)
    {
        $daofactory = NULL;
        $retorno = NULL;
        try {
            $daofactory = DAOFactory::getDAOFactory();
            $daofactory->open();
            $daofactory->beginTransaction();
            
            // pesquisar pelo atributo UsuarioComplemento.descLivre no campo USCO_TX_DESC_LIVRE da tabela USUARIO_COMPLEMENTO
           $bo = new UsuarioComplementoBusinessImpl();
           $retorno = $bo->carregarPorDesclivre($daofactory, $descLivre);
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
* atualizarIdusuarioPorPK() - Usado para invocar a classe de negócio UsuarioComplementoBusinessImpl de forma geral
* realizar uma atualização de ID do usuário diretamente na tabela USUARIO_COMPLEMENTO campo USUA_ID
* @param $id
* @param $idUsuario
* @return UsuarioComplementoDTO
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
            
            // atualizar registro por meio do método UsuarioComplementoBusinessImpl::atualizarIdusuarioPorPK($idUsuario,$id)
           $bo = new UsuarioComplementoBusinessImpl();
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
* atualizarDddPorPK() - Usado para invocar a classe de negócio UsuarioComplementoBusinessImpl de forma geral
* realizar uma atualização de DDD diretamente na tabela USUARIO_COMPLEMENTO campo USCO_TX_DDD
* @param $id
* @param $ddd
* @return UsuarioComplementoDTO
*
* 
*/

    public function atualizarDddPorPK($ddd,$id)
    {
        $daofactory = NULL;
        $retorno = NULL;
        try {
            $daofactory = DAOFactory::getDAOFactory();
            $daofactory->open();
            $daofactory->beginTransaction();
            
            // atualizar registro por meio do método UsuarioComplementoBusinessImpl::atualizarDddPorPK($ddd,$id)
           $bo = new UsuarioComplementoBusinessImpl();
           $retorno = $bo->atualizarDddPorPK($daofactory,$ddd,$id);

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
* atualizarTelefonePorPK() - Usado para invocar a classe de negócio UsuarioComplementoBusinessImpl de forma geral
* realizar uma atualização de Número Celular diretamente na tabela USUARIO_COMPLEMENTO campo USCO_TX_CEL
* @param $id
* @param $telefone
* @return UsuarioComplementoDTO
*
* 
*/

    public function atualizarTelefonePorPK($telefone,$id)
    {
        $daofactory = NULL;
        $retorno = NULL;
        try {
            $daofactory = DAOFactory::getDAOFactory();
            $daofactory->open();
            $daofactory->beginTransaction();
            
            // atualizar registro por meio do método UsuarioComplementoBusinessImpl::atualizarTelefonePorPK($telefone,$id)
           $bo = new UsuarioComplementoBusinessImpl();
           $retorno = $bo->atualizarTelefonePorPK($daofactory,$telefone,$id);

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
* atualizarNomereceitafederalPorPK() - Usado para invocar a classe de negócio UsuarioComplementoBusinessImpl de forma geral
* realizar uma atualização de Nome registrado na Receita Federal diretamente na tabela USUARIO_COMPLEMENTO campo USCO_NM_RECEITA_FEDERAL
* @param $id
* @param $nomeReceitaFederal
* @return UsuarioComplementoDTO
*
* 
*/

    public function atualizarNomereceitafederalPorPK($nomeReceitaFederal,$id)
    {
        $daofactory = NULL;
        $retorno = NULL;
        try {
            $daofactory = DAOFactory::getDAOFactory();
            $daofactory->open();
            $daofactory->beginTransaction();
            
            // atualizar registro por meio do método UsuarioComplementoBusinessImpl::atualizarNomereceitafederalPorPK($nomeReceitaFederal,$id)
           $bo = new UsuarioComplementoBusinessImpl();
           $retorno = $bo->atualizarNomereceitafederalPorPK($daofactory,$nomeReceitaFederal,$id);

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
* atualizarNomeresponsavelPorPK() - Usado para invocar a classe de negócio UsuarioComplementoBusinessImpl de forma geral
* realizar uma atualização de Nome do Responsável Principal diretamente na tabela USUARIO_COMPLEMENTO campo USCO_NM_RESPONSAVEL
* @param $id
* @param $nomeResponsavel
* @return UsuarioComplementoDTO
*
* 
*/

    public function atualizarNomeresponsavelPorPK($nomeResponsavel,$id)
    {
        $daofactory = NULL;
        $retorno = NULL;
        try {
            $daofactory = DAOFactory::getDAOFactory();
            $daofactory->open();
            $daofactory->beginTransaction();
            
            // atualizar registro por meio do método UsuarioComplementoBusinessImpl::atualizarNomeresponsavelPorPK($nomeResponsavel,$id)
           $bo = new UsuarioComplementoBusinessImpl();
           $retorno = $bo->atualizarNomeresponsavelPorPK($daofactory,$nomeResponsavel,$id);

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
* atualizarUrlsitePorPK() - Usado para invocar a classe de negócio UsuarioComplementoBusinessImpl de forma geral
* realizar uma atualização de URL do Website diretamente na tabela USUARIO_COMPLEMENTO campo USCO_TX_URL_WEBSITE
* @param $id
* @param $urlsite
* @return UsuarioComplementoDTO
*
* 
*/

    public function atualizarUrlsitePorPK($urlsite,$id)
    {
        $daofactory = NULL;
        $retorno = NULL;
        try {
            $daofactory = DAOFactory::getDAOFactory();
            $daofactory->open();
            $daofactory->beginTransaction();
            
            // atualizar registro por meio do método UsuarioComplementoBusinessImpl::atualizarUrlsitePorPK($urlsite,$id)
           $bo = new UsuarioComplementoBusinessImpl();
           $retorno = $bo->atualizarUrlsitePorPK($daofactory,$urlsite,$id);

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
* atualizarUrlfacebookPorPK() - Usado para invocar a classe de negócio UsuarioComplementoBusinessImpl de forma geral
* realizar uma atualização de URL do facebook diretamente na tabela USUARIO_COMPLEMENTO campo USCO_TX_URL_FACEBOOK
* @param $id
* @param $urlFacebook
* @return UsuarioComplementoDTO
*
* 
*/

    public function atualizarUrlfacebookPorPK($urlFacebook,$id)
    {
        $daofactory = NULL;
        $retorno = NULL;
        try {
            $daofactory = DAOFactory::getDAOFactory();
            $daofactory->open();
            $daofactory->beginTransaction();
            
            // atualizar registro por meio do método UsuarioComplementoBusinessImpl::atualizarUrlfacebookPorPK($urlFacebook,$id)
           $bo = new UsuarioComplementoBusinessImpl();
           $retorno = $bo->atualizarUrlfacebookPorPK($daofactory,$urlFacebook,$id);

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
* atualizarUrlinstagramPorPK() - Usado para invocar a classe de negócio UsuarioComplementoBusinessImpl de forma geral
* realizar uma atualização de Conta Instagram diretamente na tabela USUARIO_COMPLEMENTO campo USCO_TX_URL_INSTAGRAM
* @param $id
* @param $urlInstagram
* @return UsuarioComplementoDTO
*
* 
*/

    public function atualizarUrlinstagramPorPK($urlInstagram,$id)
    {
        $daofactory = NULL;
        $retorno = NULL;
        try {
            $daofactory = DAOFactory::getDAOFactory();
            $daofactory->open();
            $daofactory->beginTransaction();
            
            // atualizar registro por meio do método UsuarioComplementoBusinessImpl::atualizarUrlinstagramPorPK($urlInstagram,$id)
           $bo = new UsuarioComplementoBusinessImpl();
           $retorno = $bo->atualizarUrlinstagramPorPK($daofactory,$urlInstagram,$id);

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
* atualizarUrlpinterestPorPK() - Usado para invocar a classe de negócio UsuarioComplementoBusinessImpl de forma geral
* realizar uma atualização de URL do Pinterest diretamente na tabela USUARIO_COMPLEMENTO campo USCO_TX_URL_PINTEREST
* @param $id
* @param $urlPinterest
* @return UsuarioComplementoDTO
*
* 
*/

    public function atualizarUrlpinterestPorPK($urlPinterest,$id)
    {
        $daofactory = NULL;
        $retorno = NULL;
        try {
            $daofactory = DAOFactory::getDAOFactory();
            $daofactory->open();
            $daofactory->beginTransaction();
            
            // atualizar registro por meio do método UsuarioComplementoBusinessImpl::atualizarUrlpinterestPorPK($urlPinterest,$id)
           $bo = new UsuarioComplementoBusinessImpl();
           $retorno = $bo->atualizarUrlpinterestPorPK($daofactory,$urlPinterest,$id);

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
* atualizarUrlskypePorPK() - Usado para invocar a classe de negócio UsuarioComplementoBusinessImpl de forma geral
* realizar uma atualização de Apelido Skype diretamente na tabela USUARIO_COMPLEMENTO campo USCO_TX_URL_SKYPE
* @param $id
* @param $urlSkype
* @return UsuarioComplementoDTO
*
* 
*/

    public function atualizarUrlskypePorPK($urlSkype,$id)
    {
        $daofactory = NULL;
        $retorno = NULL;
        try {
            $daofactory = DAOFactory::getDAOFactory();
            $daofactory->open();
            $daofactory->beginTransaction();
            
            // atualizar registro por meio do método UsuarioComplementoBusinessImpl::atualizarUrlskypePorPK($urlSkype,$id)
           $bo = new UsuarioComplementoBusinessImpl();
           $retorno = $bo->atualizarUrlskypePorPK($daofactory,$urlSkype,$id);

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
* atualizarUrltwitterPorPK() - Usado para invocar a classe de negócio UsuarioComplementoBusinessImpl de forma geral
* realizar uma atualização de Conta Twitter diretamente na tabela USUARIO_COMPLEMENTO campo USCO_TX_URL_TWITTER
* @param $id
* @param $urlTwitter
* @return UsuarioComplementoDTO
*
* 
*/

    public function atualizarUrltwitterPorPK($urlTwitter,$id)
    {
        $daofactory = NULL;
        $retorno = NULL;
        try {
            $daofactory = DAOFactory::getDAOFactory();
            $daofactory->open();
            $daofactory->beginTransaction();
            
            // atualizar registro por meio do método UsuarioComplementoBusinessImpl::atualizarUrltwitterPorPK($urlTwitter,$id)
           $bo = new UsuarioComplementoBusinessImpl();
           $retorno = $bo->atualizarUrltwitterPorPK($daofactory,$urlTwitter,$id);

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
* atualizarUrlfacetimePorPK() - Usado para invocar a classe de negócio UsuarioComplementoBusinessImpl de forma geral
* realizar uma atualização de Conta Facetime diretamente na tabela USUARIO_COMPLEMENTO campo USCO_TX_URL_FACETIME
* @param $id
* @param $urlFacetime
* @return UsuarioComplementoDTO
*
* 
*/

    public function atualizarUrlfacetimePorPK($urlFacetime,$id)
    {
        $daofactory = NULL;
        $retorno = NULL;
        try {
            $daofactory = DAOFactory::getDAOFactory();
            $daofactory->open();
            $daofactory->beginTransaction();
            
            // atualizar registro por meio do método UsuarioComplementoBusinessImpl::atualizarUrlfacetimePorPK($urlFacetime,$id)
           $bo = new UsuarioComplementoBusinessImpl();
           $retorno = $bo->atualizarUrlfacetimePorPK($daofactory,$urlFacetime,$id);

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
* atualizarUrlresponsavelPorPK() - Usado para invocar a classe de negócio UsuarioComplementoBusinessImpl de forma geral
* realizar uma atualização de URL Foto Responsável diretamente na tabela USUARIO_COMPLEMENTO campo USCO_TX_URL_IMG1
* @param $id
* @param $urlResponsavel
* @return UsuarioComplementoDTO
*
* 
*/

    public function atualizarUrlresponsavelPorPK($urlResponsavel,$id)
    {
        $daofactory = NULL;
        $retorno = NULL;
        try {
            $daofactory = DAOFactory::getDAOFactory();
            $daofactory->open();
            $daofactory->beginTransaction();
            
            // atualizar registro por meio do método UsuarioComplementoBusinessImpl::atualizarUrlresponsavelPorPK($urlResponsavel,$id)
           $bo = new UsuarioComplementoBusinessImpl();
           $retorno = $bo->atualizarUrlresponsavelPorPK($daofactory,$urlResponsavel,$id);

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
* atualizarUrlfoto2PorPK() - Usado para invocar a classe de negócio UsuarioComplementoBusinessImpl de forma geral
* realizar uma atualização de URL Foto 2 diretamente na tabela USUARIO_COMPLEMENTO campo USCO_TX_URL_IMG2
* @param $id
* @param $urlFoto2
* @return UsuarioComplementoDTO
*
* 
*/

    public function atualizarUrlfoto2PorPK($urlFoto2,$id)
    {
        $daofactory = NULL;
        $retorno = NULL;
        try {
            $daofactory = DAOFactory::getDAOFactory();
            $daofactory->open();
            $daofactory->beginTransaction();
            
            // atualizar registro por meio do método UsuarioComplementoBusinessImpl::atualizarUrlfoto2PorPK($urlFoto2,$id)
           $bo = new UsuarioComplementoBusinessImpl();
           $retorno = $bo->atualizarUrlfoto2PorPK($daofactory,$urlFoto2,$id);

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
* atualizarUrlfoto3PorPK() - Usado para invocar a classe de negócio UsuarioComplementoBusinessImpl de forma geral
* realizar uma atualização de URL Foto 3 diretamente na tabela USUARIO_COMPLEMENTO campo USCO_TX_URL_IMG3
* @param $id
* @param $urlFoto3
* @return UsuarioComplementoDTO
*
* 
*/

    public function atualizarUrlfoto3PorPK($urlFoto3,$id)
    {
        $daofactory = NULL;
        $retorno = NULL;
        try {
            $daofactory = DAOFactory::getDAOFactory();
            $daofactory->open();
            $daofactory->beginTransaction();
            
            // atualizar registro por meio do método UsuarioComplementoBusinessImpl::atualizarUrlfoto3PorPK($urlFoto3,$id)
           $bo = new UsuarioComplementoBusinessImpl();
           $retorno = $bo->atualizarUrlfoto3PorPK($daofactory,$urlFoto3,$id);

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
* atualizarDesclivrePorPK() - Usado para invocar a classe de negócio UsuarioComplementoBusinessImpl de forma geral
* realizar uma atualização de Descrição Livre diretamente na tabela USUARIO_COMPLEMENTO campo USCO_TX_DESC_LIVRE
* @param $id
* @param $descLivre
* @return UsuarioComplementoDTO
*
* 
*/

    public function atualizarDesclivrePorPK($descLivre,$id)
    {
        $daofactory = NULL;
        $retorno = NULL;
        try {
            $daofactory = DAOFactory::getDAOFactory();
            $daofactory->open();
            $daofactory->beginTransaction();
            
            // atualizar registro por meio do método UsuarioComplementoBusinessImpl::atualizarDesclivrePorPK($descLivre,$id)
           $bo = new UsuarioComplementoBusinessImpl();
           $retorno = $bo->atualizarDesclivrePorPK($daofactory,$descLivre,$id);

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
* listarUsuarioComplementoPorUsuaIdStatus() - Usado para invocar a classe de negócio TipoEmpreendimentoBusinessImpl de forma geral
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

   public function listarUsuarioComplementoPorUsuaIdStatus($usuaid, $status='A', $pag=1, $qtde=0, $coluna=1, $ordem=0) 
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
           // listar paginado UsuarioComplemento
           $bo = new UsuarioComplementoBusinessImpl();
           $retorno = $bo->listarUsuarioComplementoPorUsuaIdStatus($daofactory, $usuaid, $status, $pag, $qtde, $coluna, $ordem);
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
