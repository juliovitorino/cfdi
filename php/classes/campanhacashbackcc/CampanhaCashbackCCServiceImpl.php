<?php

//importar dependencias
require_once 'CampanhaCashbackCCService.php';
require_once 'CampanhaCashbackCCBusinessImpl.php';
require_once '../variavel/ConstantesVariavel.php';
require_once '../variavel/VariavelCache.php';
require_once '../mensagem/ConstantesMensagem.php';
require_once '../mensagem/MensagemCache.php';

require_once '../daofactory/DAOFactory.php';
/**********************************************************
===========================================================

 #####  #     #   ###   ######     #    ######   ##### 
#     # #     #    #    #     #   # #   #     # #     #
#       #     #    #    #     #  #   #  #     # #     #
#       #     #    #    #     # #     # #     # #     #
#       #     #    #    #     # ####### #     # #     #
#     # #     #    #    #     # #     # #     # #     #
 #####   #####    ###   ######  #     # ######   #####
 
===========================================================
CÓDIGO SOFREU ALTERAÇÕES PROFUNDAS, NÃO USE O GERADOR
AUTOMÁTICO PARA SUBSTITUIR O CÓDIGO AQUI EXISTENTE.
TODO O SISTEMA PODE ENTRAR EM COLAPSO.
===========================================================
***********************************************************/ 


/**
*
* CampanhaCashbackCCServiceImpl - Implementação dos servicos para Classe de negócio com métodos para apoiar a integridade de informações sobre o conta corrente de cashback do usuário  gerenciado pela plataforma
* Camada de Serviços CampanhaCashbackCC - camada responsável pela lógica de negócios de CampanhaCashbackCC do sistema. 
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
* 07/09/2019 - Inserção do saldo de movimento de cashback analítico
* 
* @author Julio Cesar Vitorino
* @since 26/08/2019 16:09:29
*
*/
class CampanhaCashbackCCServiceImpl implements CampanhaCashbackCCService
{
    
    function __construct() {    }

    
/**
*
* transferirEntreMembroCashbackCC() - Transfere valor da conta corrente de cashback origem (cliente) e lanca na destino (dono)
*
* @param $id_usuario
* @param $id_destino
* @param $id_dono
* @param $vllancar
* @param $descricao
* @return SaldoGeralCashbackCCDTO
*/
public function transferirEntreMembroCashbackCC($id_usuario, $id_destino, $id_dono, $vllancar, $descricao)
{
    $daofactory = NULL;
    $retorno = NULL;
    try {
        $daofactory = DAOFactory::getDAOFactory();
        $daofactory->open();
        $daofactory->beginTransaction();
        
       $bo = new CampanhaCashbackCCBusinessImpl();
       $retorno = $bo->transferirEntreMembroCashbackCC($daofactory, $id_usuario, $id_destino, $id_dono, $vllancar, $descricao);
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
* TransferirCashbackCC() - Transfere valor da conta corrente de cashback origem (cliente) e lanca na destino (dono)
*
* @param $id_usuario
* @param $id_dono
* @param $vllancar
* @param $descricao
* @return SaldoGeralCashbackCCDTO
*/
public function TransferirCashbackCC($id_usuario, $id_dono, $vllancar, $descricao)
{
    $daofactory = NULL;
    $retorno = NULL;
    try {
        $daofactory = DAOFactory::getDAOFactory();
        $daofactory->open();
        $daofactory->beginTransaction();
        
       $bo = new CampanhaCashbackCCBusinessImpl();
       $retorno = $bo->TransferirCashbackCC($daofactory, $id_usuario, $id_dono, $vllancar, $descricao);
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
* liquidarCashbackCC() - Liquidar valor no conta corrente Lança um registro na movimentação do CashbackCC
*
* @param $id_usuario
* @param $id_dono
* @param $vllancar
* @param $descricao
* @return SaldoGeralCashbackCCDTO
*/
public function liquidarCashbackCC($id_usuario, $id_dono, $vllancar, $descricao)
{
    $daofactory = NULL;
    $retorno = NULL;
    try {
        $daofactory = DAOFactory::getDAOFactory();
        $daofactory->open();
        $daofactory->beginTransaction();
        
       $bo = new CampanhaCashbackCCBusinessImpl();
       $retorno = $bo->liquidarCashbackCC($daofactory, $id_usuario, $id_dono, $vllancar, $descricao);
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
* CreditarCashbackCC() - Creditar valor no conta corrente Lança um registro na movimentação do CashbackCC
*
* @param $id_usuario
* @param $id_dono
* @param $vllancar
* @param $descricao
* @return SaldoGeralCashbackCCDTO
*/
public function CreditarCashbackCC($id_usuario, $id_dono, $vllancar, $descricao)
{
    $daofactory = NULL;
    $retorno = NULL;
    try {
        $daofactory = DAOFactory::getDAOFactory();
        $daofactory->open();
        $daofactory->beginTransaction();
        
       $bo = new CampanhaCashbackCCBusinessImpl();
       $retorno = $bo->CreditarCashbackCC($daofactory, $id_usuario, $id_dono, $vllancar, $descricao);
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
* ResgatarTotalCashbackCC() - Resgate TOTAL Lança um registro na movimentação do CashbackCC
*
* @param $id_usuario
* @param $id_dono
* @param $vllancar
* @param $tipolancar
* @param $istotal
* @return SaldoGeralCashbackCCDTO
*/
    public function ResgatarTotalCashbackCC($id_usuario, $id_dono, $vllancar, $descricao, $tipolancar='D')
    {
        $daofactory = NULL;
        $retorno = NULL;
        try {
            $daofactory = DAOFactory::getDAOFactory();
            $daofactory->open();
            $daofactory->beginTransaction();
            
           $bo = new CampanhaCashbackCCBusinessImpl();
           $retorno = $bo->ResgatarTotalCashbackCC($daofactory, $id_usuario, $id_dono, $vllancar, $descricao, $tipolancar);
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
* lancarMovimentoCashbackCC() - Lança um registro na movimentação do CashbackCC
*
* @param $id_usuario
* @param $id_dono
* @param $vllancar
* @param $tipolancar
* @param $numdias
* @return SaldoGeralCashbackCCDTO
*/
    public function lancarMovimentoCashbackCC($id_usuario, $id_dono, $vllancar, $descricao, $tipolancar='C')
    {
        $daofactory = NULL;
        $retorno = NULL;
        try {
            $daofactory = DAOFactory::getDAOFactory();
            $daofactory->open();
            $daofactory->beginTransaction();
            
           $bo = new CampanhaCashbackCCBusinessImpl();
           $retorno = $bo->lancarMovimentoCashbackCC($daofactory, $id_usuario, $id_dono, $vllancar, $descricao, $tipolancar);
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
* listarMovimentoCashbackCC() - Listar a movimentação do CC de cashback do usuário
* no nível de detalhe
*
* @param $id_usuario
* @param $numdias
* @return SaldoGeralCashbackCCDTO
*/
    public function listarMovimentoCashbackCC($id_usuario, $id_dono, $numdias=7)
    {
        $daofactory = NULL;
        $retorno = NULL;
        try {
            $daofactory = DAOFactory::getDAOFactory();
            $daofactory->open();
            $daofactory->beginTransaction();
            
           $bo = new CampanhaCashbackCCBusinessImpl();
           $retorno = $bo->listarMovimentoCashbackCC($daofactory, $id_usuario, $id_dono, $numdias);
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
* registrarSaldoCashbackCC() - Registra o saldo calculado por @see getSaldoCashbackCC()
* e grava no registro na tabela de conta corrente de cashback do usuario
*
* @param $id_usuario
* @return SaldoGeralCashbackCCDTO
*/
    public function registrarSaldoCashbackCC($id_usuario)
    {
        $daofactory = NULL;
        $retorno = NULL;
        try {
            $daofactory = DAOFactory::getDAOFactory();
            $daofactory->open();
            $daofactory->beginTransaction();
            
           $bo = new CampanhaCashbackCCBusinessImpl();
           $retorno = $bo->registrarSaldoCashbackCC($daofactory, $id_usuario);
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
* getSaldoCashbackCCPeloDono() - Usado para invocar a classe de negócio CampanhaCashbackCCBusinessImpl de forma geral
* buscar o saldo geral + detalhamento no nível por dono da campanha
*
* @param $id_usuario
* @return SaldoGeralCashbackCCDTO
*/
public function getSaldoCashbackCCPeloDono($id_usuario, $id_dono)
{
    $daofactory = NULL;
    $retorno = NULL;
    try {
        $daofactory = DAOFactory::getDAOFactory();
        $daofactory->open();
        $daofactory->beginTransaction();
        
       $bo = new CampanhaCashbackCCBusinessImpl();
       $retorno = $bo->getSaldoCashbackCCPeloDono($daofactory, $id_usuario, $id_dono);
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
* getSaldoCashbackCC() - Usado para invocar a classe de negócio CampanhaCashbackCCBusinessImpl de forma geral
* buscar o saldo geral + detalhamento no nível por usuário dono da campanha
*
* @param $id_usuario
* @return SaldoGeralCashbackCCDTO
*/
    public function getSaldoCashbackCC($id_usuario)
    {
        $daofactory = NULL;
        $retorno = NULL;
        try {
            $daofactory = DAOFactory::getDAOFactory();
            $daofactory->open();
            $daofactory->beginTransaction();
            
           $bo = new CampanhaCashbackCCBusinessImpl();
           $retorno = $bo->getSaldoCashbackCC($daofactory, $id_usuario);
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
* listarTudo() - Usado para invocar a classe de negócio CampanhaCashbackCCBusinessImpl de forma geral
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
* atualizar() - Usado para invocar a classe de negócio CampanhaCashbackCCBusinessImpl de forma geral
* para gerenciar as regras de negócio do sistema.
*
* @param CampanhaCashbackCCDTO contendo dados para enviar para atualização
* @return uma instância de CampanhaCashbackCCDTO com resultdo da operação
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
            
           $bo = new CampanhaCashbackCCBusinessImpl();
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
* atualizarStatusCampanhaCashbackCC() - Usado para invocar a classe de negócio CampanhaCashbackCCBusinessImpl de forma geral
* para gerenciar as atualizações do campo STATUS de acordo as regras de negócio do sistema.
*
* @param $id
* @param $status
* @return uma instância de CampanhaCashbackCCDTO com resultdo da operação
*
*/


    public function autalizarStatusCampanhaCashbackCC($id, $status)
    {
        $daofactory = NULL;
        $retorno = NULL;
        try {
            $daofactory = DAOFactory::getDAOFactory();
            $daofactory->open();
            $daofactory->beginTransaction();
            

           $bo = new CampanhaCashbackCCBusinessImpl();
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
* cadastrar() - Usado para invocar a classe de negócio CampanhaCashbackCCBusinessImpl de forma geral
* para gerenciar a criação de registro de acordo as regras de negócio do sistema.
*
* @param $dto - Instância de CampanhaCashbackCCDTO
*
* @return uma instância de CampanhaCashbackCCDTO com resultdo da operação
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
            

           $bo = new CampanhaCashbackCCBusinessImpl();
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
* @return List<CampanhaCashbackCCDTO>[]
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
            
            // listar paginado CampanhaCashbackCC
           $bo = new CampanhaCashbackCCBusinessImpl();
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
* realizar uma busca diretamente pela PK (Primary Key) da tabela CAMPANHA_CASHBACK_CC campo CACC_ID
*
* @param $id
* @return CampanhaCashbackCCDTO
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
            
            // pesquisar pela PK da tabela CampanhaCashbackCC
           $bo = new CampanhaCashbackCCBusinessImpl();
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
* listarCampanhaCashbackCCPorStatus() - Usado para invocar a classe de negócio TipoEmpreendimentoBusinessImpl de forma geral
* realizar lista paginada de registros com uma instância de PaginacaoDTO
*
* @param $status
* @param $pag
* @param $qtde
* @param $coluna
* @param $ordem
* @return $PaginacaoDTO
*/

   public function listarCampanhaCashbackCCPorStatus($status='A', $pag=1, $qtde=0, $coluna=1, $ordem=0) 
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
           // listar paginado CampanhaCashbackCC
           $bo = new CampanhaCashbackCCBusinessImpl();
           $retorno = $bo->listarCampanhaCashbackCCPorStatus($daofactory, $status, $pag, $qtde, $coluna, $ordem);
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
* pesquisarPorId_Cashback() - Usado para invocar a classe de negócio CampanhaCashbackCCBusinessImpl de forma geral
* realizar uma busca de ID da campanha x cashback diretamente na tabela CAMPANHA_CASHBACK_CC campo CACA_ID
*
* @param $id_cashback
* @return CampanhaCashbackCCDTO
*
* 
*/

    public function pesquisarPorId_Cashback($id_cashback)
    {
        $daofactory = NULL;
        $retorno = NULL;
        try {
            $daofactory = DAOFactory::getDAOFactory();
            $daofactory->open();
            $daofactory->beginTransaction();
            
            // pesquisar pelo atributo CampanhaCashbackCC.id_cashback no campo CACA_ID da tabela CAMPANHA_CASHBACK_CC
           $bo = new CampanhaCashbackCCBusinessImpl();
           $retorno = $bo->carregarPorId_Cashback($daofactory, $id_cashback);
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
* pesquisarPorId_Campanha() - Usado para invocar a classe de negócio CampanhaCashbackCCBusinessImpl de forma geral
* realizar uma busca de ID da campanha diretamente na tabela CAMPANHA_CASHBACK_CC campo CAMP_ID
*
* @param $id_campanha
* @return CampanhaCashbackCCDTO
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
            
            // pesquisar pelo atributo CampanhaCashbackCC.id_campanha no campo CAMP_ID da tabela CAMPANHA_CASHBACK_CC
           $bo = new CampanhaCashbackCCBusinessImpl();
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
* pesquisarPorId_Usuario() - Usado para invocar a classe de negócio CampanhaCashbackCCBusinessImpl de forma geral
* realizar uma busca de ID do usuário diretamente na tabela CAMPANHA_CASHBACK_CC campo USUA_ID
*
* @param $id_usuario
* @return CampanhaCashbackCCDTO
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
            
            // pesquisar pelo atributo CampanhaCashbackCC.id_usuario no campo USUA_ID da tabela CAMPANHA_CASHBACK_CC
           $bo = new CampanhaCashbackCCBusinessImpl();
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
* pesquisarPorId_Cfdi() - Usado para invocar a classe de negócio CampanhaCashbackCCBusinessImpl de forma geral
* realizar uma busca de ID do carimbo efetuado no cartão diretamente na tabela CAMPANHA_CASHBACK_CC campo CFDI_ID
*
* @param $id_cfdi
* @return CampanhaCashbackCCDTO
*
* 
*/

    public function pesquisarPorId_Cfdi($id_cfdi)
    {
        $daofactory = NULL;
        $retorno = NULL;
        try {
            $daofactory = DAOFactory::getDAOFactory();
            $daofactory->open();
            $daofactory->beginTransaction();
            
            // pesquisar pelo atributo CampanhaCashbackCC.id_cfdi no campo CFDI_ID da tabela CAMPANHA_CASHBACK_CC
           $bo = new CampanhaCashbackCCBusinessImpl();
           $retorno = $bo->carregarPorId_Cfdi($daofactory, $id_cfdi);
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
* pesquisarPorDescricao() - Usado para invocar a classe de negócio CampanhaCashbackCCBusinessImpl de forma geral
* realizar uma busca de Cópia da descrição diretamente na tabela CAMPANHA_CASHBACK_CC campo CACC_TX_DESCRICAO
*
* @param $descricao
* @return CampanhaCashbackCCDTO
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
            
            // pesquisar pelo atributo CampanhaCashbackCC.descricao no campo CACC_TX_DESCRICAO da tabela CAMPANHA_CASHBACK_CC
           $bo = new CampanhaCashbackCCBusinessImpl();
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
* pesquisarPorVlminimo() - Usado para invocar a classe de negócio CampanhaCashbackCCBusinessImpl de forma geral
* realizar uma busca de Valor para permitir cashback diretamente na tabela CAMPANHA_CASHBACK_CC campo CACC_VL_MIN
*
* @param $vlMinimo
* @return CampanhaCashbackCCDTO
*
* 
*/

    public function pesquisarPorVlminimo($vlMinimo)
    {
        $daofactory = NULL;
        $retorno = NULL;
        try {
            $daofactory = DAOFactory::getDAOFactory();
            $daofactory->open();
            $daofactory->beginTransaction();
            
            // pesquisar pelo atributo CampanhaCashbackCC.vlMinimo no campo CACC_VL_MIN da tabela CAMPANHA_CASHBACK_CC
           $bo = new CampanhaCashbackCCBusinessImpl();
           $retorno = $bo->carregarPorVlminimo($daofactory, $vlMinimo);
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
* pesquisarPorPercentual() - Usado para invocar a classe de negócio CampanhaCashbackCCBusinessImpl de forma geral
* realizar uma busca de Cópia do perc. cashback diretamente na tabela CAMPANHA_CASHBACK_CC campo CACC_VL_PERC_CASHBACK
*
* @param $percentual
* @return CampanhaCashbackCCDTO
*
* 
*/

    public function pesquisarPorPercentual($percentual)
    {
        $daofactory = NULL;
        $retorno = NULL;
        try {
            $daofactory = DAOFactory::getDAOFactory();
            $daofactory->open();
            $daofactory->beginTransaction();
            
            // pesquisar pelo atributo CampanhaCashbackCC.percentual no campo CACC_VL_PERC_CASHBACK da tabela CAMPANHA_CASHBACK_CC
           $bo = new CampanhaCashbackCCBusinessImpl();
           $retorno = $bo->carregarPorPercentual($daofactory, $percentual);
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
* pesquisarPorVlconsumo() - Usado para invocar a classe de negócio CampanhaCashbackCCBusinessImpl de forma geral
* realizar uma busca de Valor do consumo diretamente na tabela CAMPANHA_CASHBACK_CC campo CACC_VL_CONSUMO
*
* @param $vlConsumo
* @return CampanhaCashbackCCDTO
*
* 
*/

    public function pesquisarPorVlconsumo($vlConsumo)
    {
        $daofactory = NULL;
        $retorno = NULL;
        try {
            $daofactory = DAOFactory::getDAOFactory();
            $daofactory->open();
            $daofactory->beginTransaction();
            
            // pesquisar pelo atributo CampanhaCashbackCC.vlConsumo no campo CACC_VL_CONSUMO da tabela CAMPANHA_CASHBACK_CC
           $bo = new CampanhaCashbackCCBusinessImpl();
           $retorno = $bo->carregarPorVlconsumo($daofactory, $vlConsumo);
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
* pesquisarPorVlcalcrecompensa() - Usado para invocar a classe de negócio CampanhaCashbackCCBusinessImpl de forma geral
* realizar uma busca de Valor da recompensa diretamente na tabela CAMPANHA_CASHBACK_CC campo CACC_VL_RECOMPENSA
*
* @param $vlCalcRecompensa
* @return CampanhaCashbackCCDTO
*
* 
*/

    public function pesquisarPorVlcalcrecompensa($vlCalcRecompensa)
    {
        $daofactory = NULL;
        $retorno = NULL;
        try {
            $daofactory = DAOFactory::getDAOFactory();
            $daofactory->open();
            $daofactory->beginTransaction();
            
            // pesquisar pelo atributo CampanhaCashbackCC.vlCalcRecompensa no campo CACC_VL_RECOMPENSA da tabela CAMPANHA_CASHBACK_CC
           $bo = new CampanhaCashbackCCBusinessImpl();
           $retorno = $bo->carregarPorVlcalcrecompensa($daofactory, $vlCalcRecompensa);
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
* pesquisarPorTipomovimento() - Usado para invocar a classe de negócio CampanhaCashbackCCBusinessImpl de forma geral
* realizar uma busca de Tipo do movimento diretamente na tabela CAMPANHA_CASHBACK_CC campo CACC_IN_TIPO
*
* @param $tipoMovimento
* @return CampanhaCashbackCCDTO
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
            
            // pesquisar pelo atributo CampanhaCashbackCC.tipoMovimento no campo CACC_IN_TIPO da tabela CAMPANHA_CASHBACK_CC
           $bo = new CampanhaCashbackCCBusinessImpl();
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
* pesquisarPorNfe() - Usado para invocar a classe de negócio CampanhaCashbackCCBusinessImpl de forma geral
* realizar uma busca de NF Eletrônica diretamente na tabela CAMPANHA_CASHBACK_CC campo CACC_TX_NFE
*
* @param $nfe
* @return CampanhaCashbackCCDTO
*
* 
*/

    public function pesquisarPorNfe($nfe)
    {
        $daofactory = NULL;
        $retorno = NULL;
        try {
            $daofactory = DAOFactory::getDAOFactory();
            $daofactory->open();
            $daofactory->beginTransaction();
            
            // pesquisar pelo atributo CampanhaCashbackCC.nfe no campo CACC_TX_NFE da tabela CAMPANHA_CASHBACK_CC
           $bo = new CampanhaCashbackCCBusinessImpl();
           $retorno = $bo->carregarPorNfe($daofactory, $nfe);
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
* pesquisarPorNfehash() - Usado para invocar a classe de negócio CampanhaCashbackCCBusinessImpl de forma geral
* realizar uma busca de Hash NFE diretamente na tabela CAMPANHA_CASHBACK_CC campo CACC_TX_NFE_HASH
*
* @param $nfehash
* @return CampanhaCashbackCCDTO
*
* 
*/

    public function pesquisarPorNfehash($nfehash)
    {
        $daofactory = NULL;
        $retorno = NULL;
        try {
            $daofactory = DAOFactory::getDAOFactory();
            $daofactory->open();
            $daofactory->beginTransaction();
            
            // pesquisar pelo atributo CampanhaCashbackCC.nfehash no campo CACC_TX_NFE_HASH da tabela CAMPANHA_CASHBACK_CC
           $bo = new CampanhaCashbackCCBusinessImpl();
           $retorno = $bo->carregarPorNfehash($daofactory, $nfehash);
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
* atualizarId_CashbackPorPK() - Usado para invocar a classe de negócio CampanhaCashbackCCBusinessImpl de forma geral
* realizar uma atualização de ID da campanha x cashback diretamente na tabela CAMPANHA_CASHBACK_CC campo CACA_ID
* @param $id
* @param $id_cashback
* @return CampanhaCashbackCCDTO
*
* 
*/

    public function atualizarId_CashbackPorPK($id_cashback,$id)
    {
        $daofactory = NULL;
        $retorno = NULL;
        try {
            $daofactory = DAOFactory::getDAOFactory();
            $daofactory->open();
            $daofactory->beginTransaction();
            
            // atualizar registro por meio do método CampanhaCashbackCCBusinessImpl::atualizarId_CashbackPorPK($id_cashback,$id)
           $bo = new CampanhaCashbackCCBusinessImpl();
           $retorno = $bo->atualizarId_CashbackPorPK($daofactory,$id_cashback,$id);

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
* atualizarId_CampanhaPorPK() - Usado para invocar a classe de negócio CampanhaCashbackCCBusinessImpl de forma geral
* realizar uma atualização de ID da campanha diretamente na tabela CAMPANHA_CASHBACK_CC campo CAMP_ID
* @param $id
* @param $id_campanha
* @return CampanhaCashbackCCDTO
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
            
            // atualizar registro por meio do método CampanhaCashbackCCBusinessImpl::atualizarId_CampanhaPorPK($id_campanha,$id)
           $bo = new CampanhaCashbackCCBusinessImpl();
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
* atualizarId_UsuarioPorPK() - Usado para invocar a classe de negócio CampanhaCashbackCCBusinessImpl de forma geral
* realizar uma atualização de ID do usuário diretamente na tabela CAMPANHA_CASHBACK_CC campo USUA_ID
* @param $id
* @param $id_usuario
* @return CampanhaCashbackCCDTO
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
            
            // atualizar registro por meio do método CampanhaCashbackCCBusinessImpl::atualizarId_UsuarioPorPK($id_usuario,$id)
           $bo = new CampanhaCashbackCCBusinessImpl();
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
* atualizarId_CfdiPorPK() - Usado para invocar a classe de negócio CampanhaCashbackCCBusinessImpl de forma geral
* realizar uma atualização de ID do carimbo efetuado no cartão diretamente na tabela CAMPANHA_CASHBACK_CC campo CFDI_ID
* @param $id
* @param $id_cfdi
* @return CampanhaCashbackCCDTO
*
* 
*/

    public function atualizarId_CfdiPorPK($id_cfdi,$id)
    {
        $daofactory = NULL;
        $retorno = NULL;
        try {
            $daofactory = DAOFactory::getDAOFactory();
            $daofactory->open();
            $daofactory->beginTransaction();
            
            // atualizar registro por meio do método CampanhaCashbackCCBusinessImpl::atualizarId_CfdiPorPK($id_cfdi,$id)
           $bo = new CampanhaCashbackCCBusinessImpl();
           $retorno = $bo->atualizarId_CfdiPorPK($daofactory,$id_cfdi,$id);

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
* atualizarDescricaoPorPK() - Usado para invocar a classe de negócio CampanhaCashbackCCBusinessImpl de forma geral
* realizar uma atualização de Cópia da descrição diretamente na tabela CAMPANHA_CASHBACK_CC campo CACC_TX_DESCRICAO
* @param $id
* @param $descricao
* @return CampanhaCashbackCCDTO
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
            
            // atualizar registro por meio do método CampanhaCashbackCCBusinessImpl::atualizarDescricaoPorPK($descricao,$id)
           $bo = new CampanhaCashbackCCBusinessImpl();
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
* atualizarVlminimoPorPK() - Usado para invocar a classe de negócio CampanhaCashbackCCBusinessImpl de forma geral
* realizar uma atualização de Valor para permitir cashback diretamente na tabela CAMPANHA_CASHBACK_CC campo CACC_VL_MIN
* @param $id
* @param $vlMinimo
* @return CampanhaCashbackCCDTO
*
* 
*/

    public function atualizarVlminimoPorPK($vlMinimo,$id)
    {
        $daofactory = NULL;
        $retorno = NULL;
        try {
            $daofactory = DAOFactory::getDAOFactory();
            $daofactory->open();
            $daofactory->beginTransaction();
            
            // atualizar registro por meio do método CampanhaCashbackCCBusinessImpl::atualizarVlminimoPorPK($vlMinimo,$id)
           $bo = new CampanhaCashbackCCBusinessImpl();
           $retorno = $bo->atualizarVlminimoPorPK($daofactory,$vlMinimo,$id);

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
* atualizarPercentualPorPK() - Usado para invocar a classe de negócio CampanhaCashbackCCBusinessImpl de forma geral
* realizar uma atualização de Cópia do perc. cashback diretamente na tabela CAMPANHA_CASHBACK_CC campo CACC_VL_PERC_CASHBACK
* @param $id
* @param $percentual
* @return CampanhaCashbackCCDTO
*
* 
*/

    public function atualizarPercentualPorPK($percentual,$id)
    {
        $daofactory = NULL;
        $retorno = NULL;
        try {
            $daofactory = DAOFactory::getDAOFactory();
            $daofactory->open();
            $daofactory->beginTransaction();
            
            // atualizar registro por meio do método CampanhaCashbackCCBusinessImpl::atualizarPercentualPorPK($percentual,$id)
           $bo = new CampanhaCashbackCCBusinessImpl();
           $retorno = $bo->atualizarPercentualPorPK($daofactory,$percentual,$id);

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
* atualizarVlconsumoPorPK() - Usado para invocar a classe de negócio CampanhaCashbackCCBusinessImpl de forma geral
* realizar uma atualização de Valor do consumo diretamente na tabela CAMPANHA_CASHBACK_CC campo CACC_VL_CONSUMO
* @param $id
* @param $vlConsumo
* @return CampanhaCashbackCCDTO
*
* 
*/

    public function atualizarVlconsumoPorPK($vlConsumo,$id)
    {
        $daofactory = NULL;
        $retorno = NULL;
        try {
            $daofactory = DAOFactory::getDAOFactory();
            $daofactory->open();
            $daofactory->beginTransaction();
            
            // atualizar registro por meio do método CampanhaCashbackCCBusinessImpl::atualizarVlconsumoPorPK($vlConsumo,$id)
           $bo = new CampanhaCashbackCCBusinessImpl();
           $retorno = $bo->atualizarVlconsumoPorPK($daofactory,$vlConsumo,$id);

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
* atualizarVlcalcrecompensaPorPK() - Usado para invocar a classe de negócio CampanhaCashbackCCBusinessImpl de forma geral
* realizar uma atualização de Valor da recompensa diretamente na tabela CAMPANHA_CASHBACK_CC campo CACC_VL_RECOMPENSA
* @param $id
* @param $vlCalcRecompensa
* @return CampanhaCashbackCCDTO
*
* 
*/

    public function atualizarVlcalcrecompensaPorPK($vlCalcRecompensa,$id)
    {
        $daofactory = NULL;
        $retorno = NULL;
        try {
            $daofactory = DAOFactory::getDAOFactory();
            $daofactory->open();
            $daofactory->beginTransaction();
            
            // atualizar registro por meio do método CampanhaCashbackCCBusinessImpl::atualizarVlcalcrecompensaPorPK($vlCalcRecompensa,$id)
           $bo = new CampanhaCashbackCCBusinessImpl();
           $retorno = $bo->atualizarVlcalcrecompensaPorPK($daofactory,$vlCalcRecompensa,$id);

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
* atualizarTipomovimentoPorPK() - Usado para invocar a classe de negócio CampanhaCashbackCCBusinessImpl de forma geral
* realizar uma atualização de Tipo do movimento diretamente na tabela CAMPANHA_CASHBACK_CC campo CACC_IN_TIPO
* @param $id
* @param $tipoMovimento
* @return CampanhaCashbackCCDTO
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
            
            // atualizar registro por meio do método CampanhaCashbackCCBusinessImpl::atualizarTipomovimentoPorPK($tipoMovimento,$id)
           $bo = new CampanhaCashbackCCBusinessImpl();
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
* listarCampanhaCashbackCCPorUsuaIdStatus() - Usado para invocar a classe de negócio TipoEmpreendimentoBusinessImpl de forma geral
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

   public function listarCampanhaCashbackCCPorUsuaIdStatus($usuaid, $status='A', $pag=1, $qtde=0, $coluna=1, $ordem=0) 
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
           // listar paginado CampanhaCashbackCC
           $bo = new CampanhaCashbackCCBusinessImpl();
           $retorno = $bo->listarCampanhaCashbackCCPorUsuaIdStatus($daofactory, $usuaid, $status, $pag, $qtde, $coluna, $ordem);
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
