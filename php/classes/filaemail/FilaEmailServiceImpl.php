<?php

//importar dependencias
require_once 'FilaEmailService.php';
require_once 'FilaEmailBusinessImpl.php';
require_once '../variavel/ConstantesVariavel.php';
require_once '../variavel/VariavelCache.php';
require_once '../mensagem/ConstantesMensagem.php';
require_once '../mensagem/MensagemCache.php';

require_once '../daofactory/DAOFactory.php';


/**
*
* FilaEmailServiceImpl - Implementação dos servicos para Classe de negócio com métodos para apoiar a integridade de informações sobre fila de email gerenciado pela plataforma
* Camada de Serviços FilaEmail - camada responsável pela lógica de negócios de FilaEmail do sistema. 
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
* @since 01/09/2021 15:29:49
*
*/
class FilaEmailServiceImpl implements FilaEmailService
{
    
    function __construct() {    }

/**
*
* listarTudo() - Usado para invocar a classe de negócio FilaEmailBusinessImpl de forma geral
* para listar todos os registros sem critérios de paginação dos dados.
*
* Use este método com MUITA moderação.
*/

    public function listarTudo() {  }
    public function pesquisar($dto){ }
    public function cancelar($dto) { }

/**
*
* PesquisarMaxPKAtivoIdPorStatus() - Usado para invocar a classe de negócio FilaEmailBusinessImpl de forma geral
* a buscar a MAIOR PK pra um dado status.
*
* @param status
* @return FilaEmailDTO
*
*/

public function pesquisarMaxPKAtivoNomefilaPorStatus($nomeFila,$status)
{
    $daofactory = NULL;
    $retorno = NULL;
    try {
        $daofactory = DAOFactory::getDAOFactory();
        $daofactory->open();
        $daofactory->beginTransaction();
        
       $bo = new FilaEmailBusinessImpl();
       $retorno = $bo->pesquisarMaxPKAtivoNomefilaPorStatus($daofactory, $nomeFila,$status);
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
* atualizar() - Usado para invocar a classe de negócio FilaEmailBusinessImpl de forma geral
* para gerenciar as regras de negócio do sistema.
*
* @param FilaEmailDTO contendo dados para enviar para atualização
* @return uma instância de FilaEmailDTO com resultdo da operação
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
            
           $bo = new FilaEmailBusinessImpl();
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
* atualizarStatusFilaEmail() - Usado para invocar a classe de negócio FilaEmailBusinessImpl de forma geral
* para gerenciar as atualizações do campo STATUS de acordo as regras de negócio do sistema.
*
* @param $id
* @param $status
* @return uma instância de FilaEmailDTO com resultdo da operação
*
*/


    public function autalizarStatusFilaEmail($id, $status)
    {
        $daofactory = NULL;
        $retorno = NULL;
        try {
            $daofactory = DAOFactory::getDAOFactory();
            $daofactory->open();
            $daofactory->beginTransaction();
            

           $bo = new FilaEmailBusinessImpl();
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
* apagar() - Usado para invocar a classe de negócio FilaEmailBusinessImpl de forma geral
* para gerenciar a exclusão de registro de acordo as regras de negócio do sistema.
*
* @param $dto - Instância de FilaEmailDTO
*
* @return uma instância de FilaEmailDTO com resultdo da operação
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
        

       $bo = new FilaEmailBusinessImpl();
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
* cadastrar() - Usado para invocar a classe de negócio FilaEmailBusinessImpl de forma geral
* para gerenciar a criação de registro de acordo as regras de negócio do sistema.
*
* @param $dto - Instância de FilaEmailDTO
*
* @return uma instância de FilaEmailDTO com resultdo da operação
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
            

           $bo = new FilaEmailBusinessImpl();
           $retorno = $bo->inserirFilaEmail($daofactory, $dto);

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
* @return List<FilaEmailDTO>[]
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
            
            // listar paginado FilaEmail
           $bo = new FilaEmailBusinessImpl();
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
* realizar uma busca diretamente pela PK (Primary Key) da tabela FILA_EMAIL campo FIEM_ID
*
* @param $id
* @return FilaEmailDTO
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
            
            // pesquisar pela PK da tabela FilaEmail
           $bo = new FilaEmailBusinessImpl();
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
* listarFilaEmailPorStatus() - Usado para invocar a classe de negócio TipoEmpreendimentoBusinessImpl de forma geral
* realizar lista paginada de registros com uma instância de PaginacaoDTO
*
* @param $status
* @param $pag
* @param $qtde
* @param $coluna
* @param $ordem
* @return $PaginacaoDTO
*/

   public function listarFilaEmailPorStatus($status='A', $pag=1, $qtde=0, $coluna=1, $ordem=0) 
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
           // listar paginado FilaEmail
           $bo = new FilaEmailBusinessImpl();
           $retorno = $bo->listarFilaEmailPorStatus($daofactory, $status, $pag, $qtde, $coluna, $ordem);
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
* pesquisarPorNomefila() - Usado para invocar a classe de negócio FilaEmailBusinessImpl de forma geral
* realizar uma busca de Nome da fila diretamente na tabela FILA_EMAIL campo FIEM_NM_FILA
*
* @param $nomeFila
* @return FilaEmailDTO
*
* 
*/

    public function pesquisarPorNomefila($nomeFila)
    {
        $daofactory = NULL;
        $retorno = NULL;
        try {
            $daofactory = DAOFactory::getDAOFactory();
            $daofactory->open();
            $daofactory->beginTransaction();
            
            // pesquisar pelo atributo FilaEmail.nomeFila no campo FIEM_NM_FILA da tabela FILA_EMAIL
           $bo = new FilaEmailBusinessImpl();
           $retorno = $bo->carregarPorNomefila($daofactory, $nomeFila);
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
* pesquisarPorEmailde() - Usado para invocar a classe de negócio FilaEmailBusinessImpl de forma geral
* realizar uma busca de Email do usuário de diretamente na tabela FILA_EMAIL campo FIEM_TX_EMAIL_DE
*
* @param $emailDe
* @return FilaEmailDTO
*
* 
*/

    public function pesquisarPorEmailde($emailDe)
    {
        $daofactory = NULL;
        $retorno = NULL;
        try {
            $daofactory = DAOFactory::getDAOFactory();
            $daofactory->open();
            $daofactory->beginTransaction();
            
            // pesquisar pelo atributo FilaEmail.emailDe no campo FIEM_TX_EMAIL_DE da tabela FILA_EMAIL
           $bo = new FilaEmailBusinessImpl();
           $retorno = $bo->carregarPorEmailde($daofactory, $emailDe);
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
* pesquisarPorEmailpara() - Usado para invocar a classe de negócio FilaEmailBusinessImpl de forma geral
* realizar uma busca de Email do usuário destino diretamente na tabela FILA_EMAIL campo FIEM_TX_EMAIL_PARA
*
* @param $emailPara
* @return FilaEmailDTO
*
* 
*/

    public function pesquisarPorEmailpara($emailPara)
    {
        $daofactory = NULL;
        $retorno = NULL;
        try {
            $daofactory = DAOFactory::getDAOFactory();
            $daofactory->open();
            $daofactory->beginTransaction();
            
            // pesquisar pelo atributo FilaEmail.emailPara no campo FIEM_TX_EMAIL_PARA da tabela FILA_EMAIL
           $bo = new FilaEmailBusinessImpl();
           $retorno = $bo->carregarPorEmailpara($daofactory, $emailPara);
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
* pesquisarPorAssunto() - Usado para invocar a classe de negócio FilaEmailBusinessImpl de forma geral
* realizar uma busca de Asssunto da mensagem diretamente na tabela FILA_EMAIL campo FIEM_TX_ASSUNTO
*
* @param $assunto
* @return FilaEmailDTO
*
* 
*/

    public function pesquisarPorAssunto($assunto)
    {
        $daofactory = NULL;
        $retorno = NULL;
        try {
            $daofactory = DAOFactory::getDAOFactory();
            $daofactory->open();
            $daofactory->beginTransaction();
            
            // pesquisar pelo atributo FilaEmail.assunto no campo FIEM_TX_ASSUNTO da tabela FILA_EMAIL
           $bo = new FilaEmailBusinessImpl();
           $retorno = $bo->carregarPorAssunto($daofactory, $assunto);
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
* pesquisarPorPrioridade() - Usado para invocar a classe de negócio FilaEmailBusinessImpl de forma geral
* realizar uma busca de Nível de prioridade da mensagem diretamente na tabela FILA_EMAIL campo FIEM_IN_PRIOR
*
* @param $prioridade
* @return FilaEmailDTO
*
* 
*/

    public function pesquisarPorPrioridade($prioridade)
    {
        $daofactory = NULL;
        $retorno = NULL;
        try {
            $daofactory = DAOFactory::getDAOFactory();
            $daofactory->open();
            $daofactory->beginTransaction();
            
            // pesquisar pelo atributo FilaEmail.prioridade no campo FIEM_IN_PRIOR da tabela FILA_EMAIL
           $bo = new FilaEmailBusinessImpl();
           $retorno = $bo->carregarPorPrioridade($daofactory, $prioridade);
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
* pesquisarPorTemplate() - Usado para invocar a classe de negócio FilaEmailBusinessImpl de forma geral
* realizar uma busca de Template associado a essa mensagem diretamente na tabela FILA_EMAIL campo FIEM_TX_TEMPLATE
*
* @param $template
* @return FilaEmailDTO
*
* 
*/

    public function pesquisarPorTemplate($template)
    {
        $daofactory = NULL;
        $retorno = NULL;
        try {
            $daofactory = DAOFactory::getDAOFactory();
            $daofactory->open();
            $daofactory->beginTransaction();
            
            // pesquisar pelo atributo FilaEmail.template no campo FIEM_TX_TEMPLATE da tabela FILA_EMAIL
           $bo = new FilaEmailBusinessImpl();
           $retorno = $bo->carregarPorTemplate($daofactory, $template);
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
* pesquisarPorNrmaxtentativas() - Usado para invocar a classe de negócio FilaEmailBusinessImpl de forma geral
* realizar uma busca de Numero Max Tentativas diretamente na tabela FILA_EMAIL campo FIEM_NU_MAX_TENTATIVA
*
* @param $nrMaxTentativas
* @return FilaEmailDTO
*
* 
*/

    public function pesquisarPorNrmaxtentativas($nrMaxTentativas)
    {
        $daofactory = NULL;
        $retorno = NULL;
        try {
            $daofactory = DAOFactory::getDAOFactory();
            $daofactory->open();
            $daofactory->beginTransaction();
            
            // pesquisar pelo atributo FilaEmail.nrMaxTentativas no campo FIEM_NU_MAX_TENTATIVA da tabela FILA_EMAIL
           $bo = new FilaEmailBusinessImpl();
           $retorno = $bo->carregarPorNrmaxtentativas($daofactory, $nrMaxTentativas);
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
* pesquisarPorNrrealtentativas() - Usado para invocar a classe de negócio FilaEmailBusinessImpl de forma geral
* realizar uma busca de Numero Tentativas Realizadas diretamente na tabela FILA_EMAIL campo FIEM_NU_TENTATIVA_REAL
*
* @param $nrRealTentativas
* @return FilaEmailDTO
*
* 
*/

    public function pesquisarPorNrrealtentativas($nrRealTentativas)
    {
        $daofactory = NULL;
        $retorno = NULL;
        try {
            $daofactory = DAOFactory::getDAOFactory();
            $daofactory->open();
            $daofactory->beginTransaction();
            
            // pesquisar pelo atributo FilaEmail.nrRealTentativas no campo FIEM_NU_TENTATIVA_REAL da tabela FILA_EMAIL
           $bo = new FilaEmailBusinessImpl();
           $retorno = $bo->carregarPorNrrealtentativas($daofactory, $nrRealTentativas);
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
* pesquisarPorDataprevisaoenvio() - Usado para invocar a classe de negócio FilaEmailBusinessImpl de forma geral
* realizar uma busca de Data prevista envio diretamente na tabela FILA_EMAIL campo FIEM_DT_PREV_ENVIO
*
* @param $dataPrevisaoEnvio
* @return FilaEmailDTO
*
* 
*/

    public function pesquisarPorDataprevisaoenvio($dataPrevisaoEnvio)
    {
        $daofactory = NULL;
        $retorno = NULL;
        try {
            $daofactory = DAOFactory::getDAOFactory();
            $daofactory->open();
            $daofactory->beginTransaction();
            
            // pesquisar pelo atributo FilaEmail.dataPrevisaoEnvio no campo FIEM_DT_PREV_ENVIO da tabela FILA_EMAIL
           $bo = new FilaEmailBusinessImpl();
           $retorno = $bo->carregarPorDataprevisaoenvio($daofactory, $dataPrevisaoEnvio);
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
* pesquisarPorDatarealenvio() - Usado para invocar a classe de negócio FilaEmailBusinessImpl de forma geral
* realizar uma busca de Data envio real diretamente na tabela FILA_EMAIL campo FIEM_DT_REAL_ENVIO
*
* @param $dataRealEnvio
* @return FilaEmailDTO
*
* 
*/

    public function pesquisarPorDatarealenvio($dataRealEnvio)
    {
        $daofactory = NULL;
        $retorno = NULL;
        try {
            $daofactory = DAOFactory::getDAOFactory();
            $daofactory->open();
            $daofactory->beginTransaction();
            
            // pesquisar pelo atributo FilaEmail.dataRealEnvio no campo FIEM_DT_REAL_ENVIO da tabela FILA_EMAIL
           $bo = new FilaEmailBusinessImpl();
           $retorno = $bo->carregarPorDatarealenvio($daofactory, $dataRealEnvio);
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
* atualizarNomefilaPorPK() - Usado para invocar a classe de negócio FilaEmailBusinessImpl de forma geral
* realizar uma atualização de Nome da fila diretamente na tabela FILA_EMAIL campo FIEM_NM_FILA
* @param $id
* @param $nomeFila
* @return FilaEmailDTO
*
* 
*/

    public function atualizarNomefilaPorPK($nomeFila,$id)
    {
        $daofactory = NULL;
        $retorno = NULL;
        try {
            $daofactory = DAOFactory::getDAOFactory();
            $daofactory->open();
            $daofactory->beginTransaction();
            
            // atualizar registro por meio do método FilaEmailBusinessImpl::atualizarNomefilaPorPK($nomeFila,$id)
           $bo = new FilaEmailBusinessImpl();
           $retorno = $bo->atualizarNomefilaPorPK($daofactory,$nomeFila,$id);

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
* atualizarEmaildePorPK() - Usado para invocar a classe de negócio FilaEmailBusinessImpl de forma geral
* realizar uma atualização de Email do usuário de diretamente na tabela FILA_EMAIL campo FIEM_TX_EMAIL_DE
* @param $id
* @param $emailDe
* @return FilaEmailDTO
*
* 
*/

    public function atualizarEmaildePorPK($emailDe,$id)
    {
        $daofactory = NULL;
        $retorno = NULL;
        try {
            $daofactory = DAOFactory::getDAOFactory();
            $daofactory->open();
            $daofactory->beginTransaction();
            
            // atualizar registro por meio do método FilaEmailBusinessImpl::atualizarEmaildePorPK($emailDe,$id)
           $bo = new FilaEmailBusinessImpl();
           $retorno = $bo->atualizarEmaildePorPK($daofactory,$emailDe,$id);

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
* atualizarEmailparaPorPK() - Usado para invocar a classe de negócio FilaEmailBusinessImpl de forma geral
* realizar uma atualização de Email do usuário destino diretamente na tabela FILA_EMAIL campo FIEM_TX_EMAIL_PARA
* @param $id
* @param $emailPara
* @return FilaEmailDTO
*
* 
*/

    public function atualizarEmailparaPorPK($emailPara,$id)
    {
        $daofactory = NULL;
        $retorno = NULL;
        try {
            $daofactory = DAOFactory::getDAOFactory();
            $daofactory->open();
            $daofactory->beginTransaction();
            
            // atualizar registro por meio do método FilaEmailBusinessImpl::atualizarEmailparaPorPK($emailPara,$id)
           $bo = new FilaEmailBusinessImpl();
           $retorno = $bo->atualizarEmailparaPorPK($daofactory,$emailPara,$id);

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
* atualizarAssuntoPorPK() - Usado para invocar a classe de negócio FilaEmailBusinessImpl de forma geral
* realizar uma atualização de Asssunto da mensagem diretamente na tabela FILA_EMAIL campo FIEM_TX_ASSUNTO
* @param $id
* @param $assunto
* @return FilaEmailDTO
*
* 
*/

    public function atualizarAssuntoPorPK($assunto,$id)
    {
        $daofactory = NULL;
        $retorno = NULL;
        try {
            $daofactory = DAOFactory::getDAOFactory();
            $daofactory->open();
            $daofactory->beginTransaction();
            
            // atualizar registro por meio do método FilaEmailBusinessImpl::atualizarAssuntoPorPK($assunto,$id)
           $bo = new FilaEmailBusinessImpl();
           $retorno = $bo->atualizarAssuntoPorPK($daofactory,$assunto,$id);

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
* atualizarPrioridadePorPK() - Usado para invocar a classe de negócio FilaEmailBusinessImpl de forma geral
* realizar uma atualização de Nível de prioridade da mensagem diretamente na tabela FILA_EMAIL campo FIEM_IN_PRIOR
* @param $id
* @param $prioridade
* @return FilaEmailDTO
*
* 
*/

    public function atualizarPrioridadePorPK($prioridade,$id)
    {
        $daofactory = NULL;
        $retorno = NULL;
        try {
            $daofactory = DAOFactory::getDAOFactory();
            $daofactory->open();
            $daofactory->beginTransaction();
            
            // atualizar registro por meio do método FilaEmailBusinessImpl::atualizarPrioridadePorPK($prioridade,$id)
           $bo = new FilaEmailBusinessImpl();
           $retorno = $bo->atualizarPrioridadePorPK($daofactory,$prioridade,$id);

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
* atualizarTemplatePorPK() - Usado para invocar a classe de negócio FilaEmailBusinessImpl de forma geral
* realizar uma atualização de Template associado a essa mensagem diretamente na tabela FILA_EMAIL campo FIEM_TX_TEMPLATE
* @param $id
* @param $template
* @return FilaEmailDTO
*
* 
*/

    public function atualizarTemplatePorPK($template,$id)
    {
        $daofactory = NULL;
        $retorno = NULL;
        try {
            $daofactory = DAOFactory::getDAOFactory();
            $daofactory->open();
            $daofactory->beginTransaction();
            
            // atualizar registro por meio do método FilaEmailBusinessImpl::atualizarTemplatePorPK($template,$id)
           $bo = new FilaEmailBusinessImpl();
           $retorno = $bo->atualizarTemplatePorPK($daofactory,$template,$id);

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
* atualizarNrmaxtentativasPorPK() - Usado para invocar a classe de negócio FilaEmailBusinessImpl de forma geral
* realizar uma atualização de Numero Max Tentativas diretamente na tabela FILA_EMAIL campo FIEM_NU_MAX_TENTATIVA
* @param $id
* @param $nrMaxTentativas
* @return FilaEmailDTO
*
* 
*/

    public function atualizarNrmaxtentativasPorPK($nrMaxTentativas,$id)
    {
        $daofactory = NULL;
        $retorno = NULL;
        try {
            $daofactory = DAOFactory::getDAOFactory();
            $daofactory->open();
            $daofactory->beginTransaction();
            
            // atualizar registro por meio do método FilaEmailBusinessImpl::atualizarNrmaxtentativasPorPK($nrMaxTentativas,$id)
           $bo = new FilaEmailBusinessImpl();
           $retorno = $bo->atualizarNrmaxtentativasPorPK($daofactory,$nrMaxTentativas,$id);

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
* atualizarNrrealtentativasPorPK() - Usado para invocar a classe de negócio FilaEmailBusinessImpl de forma geral
* realizar uma atualização de Numero Tentativas Realizadas diretamente na tabela FILA_EMAIL campo FIEM_NU_TENTATIVA_REAL
* @param $id
* @param $nrRealTentativas
* @return FilaEmailDTO
*
* 
*/

    public function atualizarNrrealtentativasPorPK($nrRealTentativas,$id)
    {
        $daofactory = NULL;
        $retorno = NULL;
        try {
            $daofactory = DAOFactory::getDAOFactory();
            $daofactory->open();
            $daofactory->beginTransaction();
            
            // atualizar registro por meio do método FilaEmailBusinessImpl::atualizarNrrealtentativasPorPK($nrRealTentativas,$id)
           $bo = new FilaEmailBusinessImpl();
           $retorno = $bo->atualizarNrrealtentativasPorPK($daofactory,$nrRealTentativas,$id);

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
* atualizarDataprevisaoenvioPorPK() - Usado para invocar a classe de negócio FilaEmailBusinessImpl de forma geral
* realizar uma atualização de Data prevista envio diretamente na tabela FILA_EMAIL campo FIEM_DT_PREV_ENVIO
* @param $id
* @param $dataPrevisaoEnvio
* @return FilaEmailDTO
*
* 
*/

    public function atualizarDataprevisaoenvioPorPK($dataPrevisaoEnvio,$id)
    {
        $daofactory = NULL;
        $retorno = NULL;
        try {
            $daofactory = DAOFactory::getDAOFactory();
            $daofactory->open();
            $daofactory->beginTransaction();
            
            // atualizar registro por meio do método FilaEmailBusinessImpl::atualizarDataprevisaoenvioPorPK($dataPrevisaoEnvio,$id)
           $bo = new FilaEmailBusinessImpl();
           $retorno = $bo->atualizarDataprevisaoenvioPorPK($daofactory,$dataPrevisaoEnvio,$id);

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
* atualizarDatarealenvioPorPK() - Usado para invocar a classe de negócio FilaEmailBusinessImpl de forma geral
* realizar uma atualização de Data envio real diretamente na tabela FILA_EMAIL campo FIEM_DT_REAL_ENVIO
* @param $id
* @param $dataRealEnvio
* @return FilaEmailDTO
*
* 
*/

    public function atualizarDatarealenvioPorPK($dataRealEnvio,$id)
    {
        $daofactory = NULL;
        $retorno = NULL;
        try {
            $daofactory = DAOFactory::getDAOFactory();
            $daofactory->open();
            $daofactory->beginTransaction();
            
            // atualizar registro por meio do método FilaEmailBusinessImpl::atualizarDatarealenvioPorPK($dataRealEnvio,$id)
           $bo = new FilaEmailBusinessImpl();
           $retorno = $bo->atualizarDatarealenvioPorPK($daofactory,$dataRealEnvio,$id);

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
* listarFilaEmailPorUsuaIdStatus() - Usado para invocar a classe de negócio TipoEmpreendimentoBusinessImpl de forma geral
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

   public function listarFilaEmailPorUsuaIdStatus($usuaid, $status='A', $pag=1, $qtde=0, $coluna=1, $ordem=0) 
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
           // listar paginado FilaEmail
           $bo = new FilaEmailBusinessImpl();
           $retorno = $bo->listarFilaEmailPorUsuaIdStatus($daofactory, $usuaid, $status, $pag, $qtde, $coluna, $ordem);
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

