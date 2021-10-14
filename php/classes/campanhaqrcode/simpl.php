<?php

//importar dependencias
require_once 'CampanhaQrCodeService.php';
require_once 'CampanhaQrCodeBusinessImpl.php';
require_once '../variavel/ConstantesVariavel.php';
require_once '../variavel/VariavelCache.php';
require_once '../mensagem/ConstantesMensagem.php';
require_once '../mensagem/MensagemCache.php';

require_once '../daofactory/DAOFactory.php';


/**
*
* CampanhaQrCodeServiceImpl - Implementação dos servicos para Classe de negócio com métodos para apoiar a integridade de informações sobre codigos QRCode gerenciado pela plataforma
* Camada de Serviços CampanhaQrCode - camada responsável pela lógica de negócios de CampanhaQrCode do sistema. 
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
* @since 17/09/2021 11:11:34
*
*/
class CampanhaQrCodeServiceImpl implements CampanhaQrCodeService
{
    
    function __construct() {    }

/**
*
* listarTudo() - Usado para invocar a classe de negócio CampanhaQrCodeBusinessImpl de forma geral
* para listar todos os registros sem critérios de paginação dos dados.
*
* Use este método com MUITA moderação.
*/

    public function listarTudo() {  }
    public function pesquisar($dto){ }
    public function cancelar($dto) { }

/**
*
* PesquisarMaxPKAtivoIdPorStatus() - Usado para invocar a classe de negócio CampanhaQrCodeBusinessImpl de forma geral
* a buscar a MAIOR PK pra um dado status.
*
* @param status
* @return CampanhaQrCodeDTO
*
*/

public function pesquisarMaxPKAtivoParentPorStatus($parent,$status)
{
    $daofactory = NULL;
    $retorno = NULL;
    try {
        $daofactory = DAOFactory::getDAOFactory();
        $daofactory->open();
        $daofactory->beginTransaction();
        
       $bo = new CampanhaQrCodeBusinessImpl();
       $retorno = $bo->pesquisarMaxPKAtivoParentPorStatus($daofactory, $parent,$status);
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
* atualizar() - Usado para invocar a classe de negócio CampanhaQrCodeBusinessImpl de forma geral
* para gerenciar as regras de negócio do sistema.
*
* @param CampanhaQrCodeDTO contendo dados para enviar para atualização
* @return uma instância de CampanhaQrCodeDTO com resultdo da operação
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
            
           $bo = new CampanhaQrCodeBusinessImpl();
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
* atualizarStatusCampanhaQrCode() - Usado para invocar a classe de negócio CampanhaQrCodeBusinessImpl de forma geral
* para gerenciar as atualizações do campo STATUS de acordo as regras de negócio do sistema.
*
* @param $id
* @param $status
* @return uma instância de CampanhaQrCodeDTO com resultdo da operação
*
*/


    public function autalizarStatusCampanhaQrCode($id, $status)
    {
        $daofactory = NULL;
        $retorno = NULL;
        try {
            $daofactory = DAOFactory::getDAOFactory();
            $daofactory->open();
            $daofactory->beginTransaction();
            

           $bo = new CampanhaQrCodeBusinessImpl();
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
* apagar() - Usado para invocar a classe de negócio CampanhaQrCodeBusinessImpl de forma geral
* para gerenciar a exclusão de registro de acordo as regras de negócio do sistema.
*
* @param $dto - Instância de CampanhaQrCodeDTO
*
* @return uma instância de CampanhaQrCodeDTO com resultdo da operação
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
        

       $bo = new CampanhaQrCodeBusinessImpl();
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
* cadastrar() - Usado para invocar a classe de negócio CampanhaQrCodeBusinessImpl de forma geral
* para gerenciar a criação de registro de acordo as regras de negócio do sistema.
*
* @param $dto - Instância de CampanhaQrCodeDTO
*
* @return uma instância de CampanhaQrCodeDTO com resultdo da operação
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
            

           $bo = new CampanhaQrCodeBusinessImpl();
           $retorno = $bo->inserirCampanhaQrCode($daofactory, $dto);

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
* @return List<CampanhaQrCodeDTO>[]
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
            
            // listar paginado CampanhaQrCode
           $bo = new CampanhaQrCodeBusinessImpl();
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
* realizar uma busca diretamente pela PK (Primary Key) da tabela CAMPANHA_QRCODES campo CAQR_ID
*
* @param $id
* @return CampanhaQrCodeDTO
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
            
            // pesquisar pela PK da tabela CampanhaQrCode
           $bo = new CampanhaQrCodeBusinessImpl();
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
* listarCampanhaQrCodePorStatus() - Usado para invocar a classe de negócio TipoEmpreendimentoBusinessImpl de forma geral
* realizar lista paginada de registros com uma instância de PaginacaoDTO
*
* @param $status
* @param $pag
* @param $qtde
* @param $coluna
* @param $ordem
* @return $PaginacaoDTO
*/

   public function listarCampanhaQrCodePorStatus($status='A', $pag=1, $qtde=0, $coluna=1, $ordem=0) 
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
           // listar paginado CampanhaQrCode
           $bo = new CampanhaQrCodeBusinessImpl();
           $retorno = $bo->listarCampanhaQrCodePorStatus($daofactory, $status, $pag, $qtde, $coluna, $ordem);
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
* pesquisarPorParent() - Usado para invocar a classe de negócio CampanhaQrCodeBusinessImpl de forma geral
* realizar uma busca de ID da qrcode parent diretamente na tabela CAMPANHA_QRCODES campo CAQR_ID_PARENT
*
* @param $parent
* @return CampanhaQrCodeDTO
*
* 
*/

    public function pesquisarPorParent($parent)
    {
        $daofactory = NULL;
        $retorno = NULL;
        try {
            $daofactory = DAOFactory::getDAOFactory();
            $daofactory->open();
            $daofactory->beginTransaction();
            
            // pesquisar pelo atributo CampanhaQrCode.parent no campo CAQR_ID_PARENT da tabela CAMPANHA_QRCODES
           $bo = new CampanhaQrCodeBusinessImpl();
           $retorno = $bo->carregarPorParent($daofactory, $parent);
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
* pesquisarPorId_Campanha() - Usado para invocar a classe de negócio CampanhaQrCodeBusinessImpl de forma geral
* realizar uma busca de ID da campanha diretamente na tabela CAMPANHA_QRCODES campo CAMP_ID
*
* @param $id_campanha
* @return CampanhaQrCodeDTO
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
            
            // pesquisar pelo atributo CampanhaQrCode.id_campanha no campo CAMP_ID da tabela CAMPANHA_QRCODES
           $bo = new CampanhaQrCodeBusinessImpl();
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
* pesquisarPorQrcodecarimbo() - Usado para invocar a classe de negócio CampanhaQrCodeBusinessImpl de forma geral
* realizar uma busca de qrcode diretamente na tabela CAMPANHA_QRCODES campo CAQR_TX_QRCODE
*
* @param $qrcodecarimbo
* @return CampanhaQrCodeDTO
*
* 
*/

    public function pesquisarPorQrcodecarimbo($qrcodecarimbo)
    {
        $daofactory = NULL;
        $retorno = NULL;
        try {
            $daofactory = DAOFactory::getDAOFactory();
            $daofactory->open();
            $daofactory->beginTransaction();
            
            // pesquisar pelo atributo CampanhaQrCode.qrcodecarimbo no campo CAQR_TX_QRCODE da tabela CAMPANHA_QRCODES
           $bo = new CampanhaQrCodeBusinessImpl();
           $retorno = $bo->carregarPorQrcodecarimbo($daofactory, $qrcodecarimbo);
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
* pesquisarPorOrder() - Usado para invocar a classe de negócio CampanhaQrCodeBusinessImpl de forma geral
* realizar uma busca de Ordenamento diretamente na tabela CAMPANHA_QRCODES campo CAQR_NU_ORDER
*
* @param $order
* @return CampanhaQrCodeDTO
*
* 
*/

    public function pesquisarPorOrder($order)
    {
        $daofactory = NULL;
        $retorno = NULL;
        try {
            $daofactory = DAOFactory::getDAOFactory();
            $daofactory->open();
            $daofactory->beginTransaction();
            
            // pesquisar pelo atributo CampanhaQrCode.order no campo CAQR_NU_ORDER da tabela CAMPANHA_QRCODES
           $bo = new CampanhaQrCodeBusinessImpl();
           $retorno = $bo->carregarPorOrder($daofactory, $order);
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
* pesquisarPorTicket() - Usado para invocar a classe de negócio CampanhaQrCodeBusinessImpl de forma geral
* realizar uma busca de Ticket Reduzido diretamente na tabela CAMPANHA_QRCODES campo CAQR_TX_TICKET
*
* @param $ticket
* @return CampanhaQrCodeDTO
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
            
            // pesquisar pelo atributo CampanhaQrCode.ticket no campo CAQR_TX_TICKET da tabela CAMPANHA_QRCODES
           $bo = new CampanhaQrCodeBusinessImpl();
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
* pesquisarPorIdusuariogerador() - Usado para invocar a classe de negócio CampanhaQrCodeBusinessImpl de forma geral
* realizar uma busca de ID do usuário gerador diretamente na tabela CAMPANHA_QRCODES campo USUA_ID_GERADOR
*
* @param $idusuarioGerador
* @return CampanhaQrCodeDTO
*
* 
*/

    public function pesquisarPorIdusuariogerador($idusuarioGerador)
    {
        $daofactory = NULL;
        $retorno = NULL;
        try {
            $daofactory = DAOFactory::getDAOFactory();
            $daofactory->open();
            $daofactory->beginTransaction();
            
            // pesquisar pelo atributo CampanhaQrCode.idusuarioGerador no campo USUA_ID_GERADOR da tabela CAMPANHA_QRCODES
           $bo = new CampanhaQrCodeBusinessImpl();
           $retorno = $bo->carregarPorIdusuariogerador($daofactory, $idusuarioGerador);
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
* atualizarParentPorPK() - Usado para invocar a classe de negócio CampanhaQrCodeBusinessImpl de forma geral
* realizar uma atualização de ID da qrcode parent diretamente na tabela CAMPANHA_QRCODES campo CAQR_ID_PARENT
* @param $id
* @param $parent
* @return CampanhaQrCodeDTO
*
* 
*/

    public function atualizarParentPorPK($parent,$id)
    {
        $daofactory = NULL;
        $retorno = NULL;
        try {
            $daofactory = DAOFactory::getDAOFactory();
            $daofactory->open();
            $daofactory->beginTransaction();
            
            // atualizar registro por meio do método CampanhaQrCodeBusinessImpl::atualizarParentPorPK($parent,$id)
           $bo = new CampanhaQrCodeBusinessImpl();
           $retorno = $bo->atualizarParentPorPK($daofactory,$parent,$id);

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
* atualizarId_CampanhaPorPK() - Usado para invocar a classe de negócio CampanhaQrCodeBusinessImpl de forma geral
* realizar uma atualização de ID da campanha diretamente na tabela CAMPANHA_QRCODES campo CAMP_ID
* @param $id
* @param $id_campanha
* @return CampanhaQrCodeDTO
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
            
            // atualizar registro por meio do método CampanhaQrCodeBusinessImpl::atualizarId_CampanhaPorPK($id_campanha,$id)
           $bo = new CampanhaQrCodeBusinessImpl();
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
* atualizarQrcodecarimboPorPK() - Usado para invocar a classe de negócio CampanhaQrCodeBusinessImpl de forma geral
* realizar uma atualização de qrcode diretamente na tabela CAMPANHA_QRCODES campo CAQR_TX_QRCODE
* @param $id
* @param $qrcodecarimbo
* @return CampanhaQrCodeDTO
*
* 
*/

    public function atualizarQrcodecarimboPorPK($qrcodecarimbo,$id)
    {
        $daofactory = NULL;
        $retorno = NULL;
        try {
            $daofactory = DAOFactory::getDAOFactory();
            $daofactory->open();
            $daofactory->beginTransaction();
            
            // atualizar registro por meio do método CampanhaQrCodeBusinessImpl::atualizarQrcodecarimboPorPK($qrcodecarimbo,$id)
           $bo = new CampanhaQrCodeBusinessImpl();
           $retorno = $bo->atualizarQrcodecarimboPorPK($daofactory,$qrcodecarimbo,$id);

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
* atualizarOrderPorPK() - Usado para invocar a classe de negócio CampanhaQrCodeBusinessImpl de forma geral
* realizar uma atualização de Ordenamento diretamente na tabela CAMPANHA_QRCODES campo CAQR_NU_ORDER
* @param $id
* @param $order
* @return CampanhaQrCodeDTO
*
* 
*/

    public function atualizarOrderPorPK($order,$id)
    {
        $daofactory = NULL;
        $retorno = NULL;
        try {
            $daofactory = DAOFactory::getDAOFactory();
            $daofactory->open();
            $daofactory->beginTransaction();
            
            // atualizar registro por meio do método CampanhaQrCodeBusinessImpl::atualizarOrderPorPK($order,$id)
           $bo = new CampanhaQrCodeBusinessImpl();
           $retorno = $bo->atualizarOrderPorPK($daofactory,$order,$id);

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
* atualizarTicketPorPK() - Usado para invocar a classe de negócio CampanhaQrCodeBusinessImpl de forma geral
* realizar uma atualização de Ticket Reduzido diretamente na tabela CAMPANHA_QRCODES campo CAQR_TX_TICKET
* @param $id
* @param $ticket
* @return CampanhaQrCodeDTO
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
            
            // atualizar registro por meio do método CampanhaQrCodeBusinessImpl::atualizarTicketPorPK($ticket,$id)
           $bo = new CampanhaQrCodeBusinessImpl();
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
* atualizarIdusuariogeradorPorPK() - Usado para invocar a classe de negócio CampanhaQrCodeBusinessImpl de forma geral
* realizar uma atualização de ID do usuário gerador diretamente na tabela CAMPANHA_QRCODES campo USUA_ID_GERADOR
* @param $id
* @param $idusuarioGerador
* @return CampanhaQrCodeDTO
*
* 
*/

    public function atualizarIdusuariogeradorPorPK($idusuarioGerador,$id)
    {
        $daofactory = NULL;
        $retorno = NULL;
        try {
            $daofactory = DAOFactory::getDAOFactory();
            $daofactory->open();
            $daofactory->beginTransaction();
            
            // atualizar registro por meio do método CampanhaQrCodeBusinessImpl::atualizarIdusuariogeradorPorPK($idusuarioGerador,$id)
           $bo = new CampanhaQrCodeBusinessImpl();
           $retorno = $bo->atualizarIdusuariogeradorPorPK($daofactory,$idusuarioGerador,$id);

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
* listarCampanhaQrCodePorUsuaIdStatus() - Usado para invocar a classe de negócio TipoEmpreendimentoBusinessImpl de forma geral
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

   public function listarCampanhaQrCodePorUsuaIdStatus($usuaid, $status='A', $pag=1, $qtde=0, $coluna=1, $ordem=0) 
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
           // listar paginado CampanhaQrCode
           $bo = new CampanhaQrCodeBusinessImpl();
           $retorno = $bo->listarCampanhaQrCodePorUsuaIdStatus($daofactory, $usuaid, $status, $pag, $qtde, $coluna, $ordem);
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
