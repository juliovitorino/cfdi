<?php

//importar dependencias
require_once 'UsuarioPublicidadeService.php';
require_once 'UsuarioPublicidadeBusinessImpl.php';
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
* UsuarioPublicidadeServiceImpl - Implementação dos servicos para Classe de negócio com métodos para apoiar a integridade de informações sobre publicidades de usuarios gerenciado pela plataforma
* Camada de Serviços UsuarioPublicidade - camada responsável pela lógica de negócios de UsuarioPublicidade do sistema. 
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
* @since 20/09/2019 13:57:12
*
*/
class UsuarioPublicidadeServiceImpl implements UsuarioPublicidadeService
{
    
    function __construct() {    }

/**
*
* listarTudo() - Usado para invocar a classe de negócio UsuarioPublicidadeBusinessImpl de forma geral
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
* atualizarImagem() - Atualizar as informações da URL da imagem da campanha de publicidade
* após o upload realizado.
*
* @param uspu_id
* @param nomearquivo
* @return UsuarioPublicidadeDTO
*
*/
    public function atualizarImagem($uspu_id, $nomearquivo)
	{
		$daofactory = NULL;
		$retorno = NULL;
		try {
			$daofactory = DAOFactory::getDAOFactory();
			$daofactory->open();
			$daofactory->beginTransaction();
			
			// excluir assinante da campanha
 			$bo = new UsuarioPublicidadeBusinessImpl();
 			$retorno = $bo->atualizarImagem($daofactory, $uspu_id, $nomearquivo);

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
* PesquisarMaxPKAtivoIdPorStatus() - Usado para invocar a classe de negócio UsuarioPublicidadeBusinessImpl de forma geral
* a buscar a MAIOR PK pra um dado status.
*
* @param status
* @return UsuarioPublicidadeDTO
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
        
       $bo = new UsuarioPublicidadeBusinessImpl();
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
* atualizar() - Usado para invocar a classe de negócio UsuarioPublicidadeBusinessImpl de forma geral
* para gerenciar as regras de negócio do sistema.
*
* @param UsuarioPublicidadeDTO contendo dados para enviar para atualização
* @return uma instância de UsuarioPublicidadeDTO com resultdo da operação
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
            
           $bo = new UsuarioPublicidadeBusinessImpl();
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
* atualizarStatusUsuarioPublicidade() - Usado para invocar a classe de negócio UsuarioPublicidadeBusinessImpl de forma geral
* para gerenciar as atualizações do campo STATUS de acordo as regras de negócio do sistema.
*
* @param $id
* @param $status
* @return uma instância de UsuarioPublicidadeDTO com resultdo da operação
*
*/


    public function autalizarStatusUsuarioPublicidade($id, $status)
    {
        $daofactory = NULL;
        $retorno = NULL;
        try {
            $daofactory = DAOFactory::getDAOFactory();
            $daofactory->open();
            $daofactory->beginTransaction();
            

           $bo = new UsuarioPublicidadeBusinessImpl();
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
* cadastrar() - Usado para invocar a classe de negócio UsuarioPublicidadeBusinessImpl de forma geral
* para gerenciar a criação de registro de acordo as regras de negócio do sistema.
*
* @param $dto - Instância de UsuarioPublicidadeDTO
*
* @return uma instância de UsuarioPublicidadeDTO com resultdo da operação
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
            

           $bo = new UsuarioPublicidadeBusinessImpl();
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
* @return List<UsuarioPublicidadeDTO>[]
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
            
            // listar paginado UsuarioPublicidade
           $bo = new UsuarioPublicidadeBusinessImpl();
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
* realizar uma busca diretamente pela PK (Primary Key) da tabela USUARIO_PUBLICIDADE campo USPU_ID
*
* @param $id
* @return UsuarioPublicidadeDTO
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
            
            // pesquisar pela PK da tabela UsuarioPublicidade
           $bo = new UsuarioPublicidadeBusinessImpl();
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
* listarUsuarioPublicidadePorStatus() - Usado para invocar a classe de negócio TipoEmpreendimentoBusinessImpl de forma geral
* realizar lista paginada de registros com uma instância de PaginacaoDTO
*
* @param $status
* @param $pag
* @param $qtde
* @param $coluna
* @param $ordem
* @return $PaginacaoDTO
*/

   public function listarUsuarioPublicidadePorStatus($status='A', $pag=1, $qtde=0, $coluna=1, $ordem=0) 
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
           // listar paginado UsuarioPublicidade
           $bo = new UsuarioPublicidadeBusinessImpl();
           $retorno = $bo->listarUsuarioPublicidadePorStatus($daofactory, $status, $pag, $qtde, $coluna, $ordem);
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
* pesquisarPorId_Usuario() - Usado para invocar a classe de negócio UsuarioPublicidadeBusinessImpl de forma geral
* realizar uma busca de ID do usuário diretamente na tabela USUARIO_PUBLICIDADE campo USUA_ID
*
* @param $id_usuario
* @return UsuarioPublicidadeDTO
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
            
            // pesquisar pelo atributo UsuarioPublicidade.id_usuario no campo USUA_ID da tabela USUARIO_PUBLICIDADE
           $bo = new UsuarioPublicidadeBusinessImpl();
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
* pesquisarPorTitulo() - Usado para invocar a classe de negócio UsuarioPublicidadeBusinessImpl de forma geral
* realizar uma busca de Título da publicidade diretamente na tabela USUARIO_PUBLICIDADE campo USPU_TX_TITULO
*
* @param $titulo
* @return UsuarioPublicidadeDTO
*
* 
*/

    public function pesquisarPorTitulo($titulo)
    {
        $daofactory = NULL;
        $retorno = NULL;
        try {
            $daofactory = DAOFactory::getDAOFactory();
            $daofactory->open();
            $daofactory->beginTransaction();
            
            // pesquisar pelo atributo UsuarioPublicidade.titulo no campo USPU_TX_TITULO da tabela USUARIO_PUBLICIDADE
           $bo = new UsuarioPublicidadeBusinessImpl();
           $retorno = $bo->carregarPorTitulo($daofactory, $titulo);
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
* pesquisarPorDescricao() - Usado para invocar a classe de negócio UsuarioPublicidadeBusinessImpl de forma geral
* realizar uma busca de Descrição geral diretamente na tabela USUARIO_PUBLICIDADE campo USPU_TX_DESCRICAO
*
* @param $descricao
* @return UsuarioPublicidadeDTO
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
            
            // pesquisar pelo atributo UsuarioPublicidade.descricao no campo USPU_TX_DESCRICAO da tabela USUARIO_PUBLICIDADE
           $bo = new UsuarioPublicidadeBusinessImpl();
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
* pesquisarPorDatainicio() - Usado para invocar a classe de negócio UsuarioPublicidadeBusinessImpl de forma geral
* realizar uma busca de Data de início diretamente na tabela USUARIO_PUBLICIDADE campo USPU_DT_INICIO
*
* @param $dataInicio
* @return UsuarioPublicidadeDTO
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
            
            // pesquisar pelo atributo UsuarioPublicidade.dataInicio no campo USPU_DT_INICIO da tabela USUARIO_PUBLICIDADE
           $bo = new UsuarioPublicidadeBusinessImpl();
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
* pesquisarPorDatatermino() - Usado para invocar a classe de negócio UsuarioPublicidadeBusinessImpl de forma geral
* realizar uma busca de Data de término diretamente na tabela USUARIO_PUBLICIDADE campo USPU_DT_TERMINO
*
* @param $dataTermino
* @return UsuarioPublicidadeDTO
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
            
            // pesquisar pelo atributo UsuarioPublicidade.dataTermino no campo USPU_DT_TERMINO da tabela USUARIO_PUBLICIDADE
           $bo = new UsuarioPublicidadeBusinessImpl();
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
* pesquisarPorVlnormal() - Usado para invocar a classe de negócio UsuarioPublicidadeBusinessImpl de forma geral
* realizar uma busca de Valor do produto/serviço diretamente na tabela USUARIO_PUBLICIDADE campo USPU_VL_NORMAL
*
* @param $vlNormal
* @return UsuarioPublicidadeDTO
*
* 
*/

    public function pesquisarPorVlnormal($vlNormal)
    {
        $daofactory = NULL;
        $retorno = NULL;
        try {
            $daofactory = DAOFactory::getDAOFactory();
            $daofactory->open();
            $daofactory->beginTransaction();
            
            // pesquisar pelo atributo UsuarioPublicidade.vlNormal no campo USPU_VL_NORMAL da tabela USUARIO_PUBLICIDADE
           $bo = new UsuarioPublicidadeBusinessImpl();
           $retorno = $bo->carregarPorVlnormal($daofactory, $vlNormal);
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
* pesquisarPorVlpromo() - Usado para invocar a classe de negócio UsuarioPublicidadeBusinessImpl de forma geral
* realizar uma busca de Valor promocional produto/serviço diretamente na tabela USUARIO_PUBLICIDADE campo USPU_VL_PROMO
*
* @param $vlPromo
* @return UsuarioPublicidadeDTO
*
* 
*/

    public function pesquisarPorVlpromo($vlPromo)
    {
        $daofactory = NULL;
        $retorno = NULL;
        try {
            $daofactory = DAOFactory::getDAOFactory();
            $daofactory->open();
            $daofactory->beginTransaction();
            
            // pesquisar pelo atributo UsuarioPublicidade.vlPromo no campo USPU_VL_PROMO da tabela USUARIO_PUBLICIDADE
           $bo = new UsuarioPublicidadeBusinessImpl();
           $retorno = $bo->carregarPorVlpromo($daofactory, $vlPromo);
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
* pesquisarPorObservacao() - Usado para invocar a classe de negócio UsuarioPublicidadeBusinessImpl de forma geral
* realizar uma busca de Observação diretamente na tabela USUARIO_PUBLICIDADE campo USPU_TX_OBS
*
* @param $observacao
* @return UsuarioPublicidadeDTO
*
* 
*/

    public function pesquisarPorObservacao($observacao)
    {
        $daofactory = NULL;
        $retorno = NULL;
        try {
            $daofactory = DAOFactory::getDAOFactory();
            $daofactory->open();
            $daofactory->beginTransaction();
            
            // pesquisar pelo atributo UsuarioPublicidade.observacao no campo USPU_TX_OBS da tabela USUARIO_PUBLICIDADE
           $bo = new UsuarioPublicidadeBusinessImpl();
           $retorno = $bo->carregarPorObservacao($daofactory, $observacao);
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
* pesquisarPorDataremover() - Usado para invocar a classe de negócio UsuarioPublicidadeBusinessImpl de forma geral
* realizar uma busca de Data para apagar diretamente na tabela USUARIO_PUBLICIDADE campo USPU_DT_APAGAR
*
* @param $dataRemover
* @return UsuarioPublicidadeDTO
*
* 
*/

    public function pesquisarPorDataremover($dataRemover)
    {
        $daofactory = NULL;
        $retorno = NULL;
        try {
            $daofactory = DAOFactory::getDAOFactory();
            $daofactory->open();
            $daofactory->beginTransaction();
            
            // pesquisar pelo atributo UsuarioPublicidade.dataRemover no campo USPU_DT_APAGAR da tabela USUARIO_PUBLICIDADE
           $bo = new UsuarioPublicidadeBusinessImpl();
           $retorno = $bo->carregarPorDataremover($daofactory, $dataRemover);
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
* atualizarId_UsuarioPorPK() - Usado para invocar a classe de negócio UsuarioPublicidadeBusinessImpl de forma geral
* realizar uma atualização de ID do usuário diretamente na tabela USUARIO_PUBLICIDADE campo USUA_ID
* @param $id
* @param $id_usuario
* @return UsuarioPublicidadeDTO
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
            
            // atualizar registro por meio do método UsuarioPublicidadeBusinessImpl::atualizarId_UsuarioPorPK($id_usuario,$id)
           $bo = new UsuarioPublicidadeBusinessImpl();
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
* atualizarTituloPorPK() - Usado para invocar a classe de negócio UsuarioPublicidadeBusinessImpl de forma geral
* realizar uma atualização de Título da publicidade diretamente na tabela USUARIO_PUBLICIDADE campo USPU_TX_TITULO
* @param $id
* @param $titulo
* @return UsuarioPublicidadeDTO
*
* 
*/

    public function atualizarTituloPorPK($titulo,$id)
    {
        $daofactory = NULL;
        $retorno = NULL;
        try {
            $daofactory = DAOFactory::getDAOFactory();
            $daofactory->open();
            $daofactory->beginTransaction();
            
            // atualizar registro por meio do método UsuarioPublicidadeBusinessImpl::atualizarTituloPorPK($titulo,$id)
           $bo = new UsuarioPublicidadeBusinessImpl();
           $retorno = $bo->atualizarTituloPorPK($daofactory,$titulo,$id);

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
* atualizarDescricaoPorPK() - Usado para invocar a classe de negócio UsuarioPublicidadeBusinessImpl de forma geral
* realizar uma atualização de Descrição geral diretamente na tabela USUARIO_PUBLICIDADE campo USPU_TX_DESCRICAO
* @param $id
* @param $descricao
* @return UsuarioPublicidadeDTO
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
            
            // atualizar registro por meio do método UsuarioPublicidadeBusinessImpl::atualizarDescricaoPorPK($descricao,$id)
           $bo = new UsuarioPublicidadeBusinessImpl();
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
* atualizarDatainicioPorPK() - Usado para invocar a classe de negócio UsuarioPublicidadeBusinessImpl de forma geral
* realizar uma atualização de Data de início diretamente na tabela USUARIO_PUBLICIDADE campo USPU_DT_INICIO
* @param $id
* @param $dataInicio
* @return UsuarioPublicidadeDTO
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
            
            // atualizar registro por meio do método UsuarioPublicidadeBusinessImpl::atualizarDatainicioPorPK($dataInicio,$id)
           $bo = new UsuarioPublicidadeBusinessImpl();
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
* atualizarDataterminoPorPK() - Usado para invocar a classe de negócio UsuarioPublicidadeBusinessImpl de forma geral
* realizar uma atualização de Data de término diretamente na tabela USUARIO_PUBLICIDADE campo USPU_DT_TERMINO
* @param $id
* @param $dataTermino
* @return UsuarioPublicidadeDTO
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
            
            // atualizar registro por meio do método UsuarioPublicidadeBusinessImpl::atualizarDataterminoPorPK($dataTermino,$id)
           $bo = new UsuarioPublicidadeBusinessImpl();
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
* atualizarVlnormalPorPK() - Usado para invocar a classe de negócio UsuarioPublicidadeBusinessImpl de forma geral
* realizar uma atualização de Valor do produto/serviço diretamente na tabela USUARIO_PUBLICIDADE campo USPU_VL_NORMAL
* @param $id
* @param $vlNormal
* @return UsuarioPublicidadeDTO
*
* 
*/

    public function atualizarVlnormalPorPK($vlNormal,$id)
    {
        $daofactory = NULL;
        $retorno = NULL;
        try {
            $daofactory = DAOFactory::getDAOFactory();
            $daofactory->open();
            $daofactory->beginTransaction();
            
            // atualizar registro por meio do método UsuarioPublicidadeBusinessImpl::atualizarVlnormalPorPK($vlNormal,$id)
           $bo = new UsuarioPublicidadeBusinessImpl();
           $retorno = $bo->atualizarVlnormalPorPK($daofactory,$vlNormal,$id);

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
* atualizarVlpromoPorPK() - Usado para invocar a classe de negócio UsuarioPublicidadeBusinessImpl de forma geral
* realizar uma atualização de Valor promocional produto/serviço diretamente na tabela USUARIO_PUBLICIDADE campo USPU_VL_PROMO
* @param $id
* @param $vlPromo
* @return UsuarioPublicidadeDTO
*
* 
*/

    public function atualizarVlpromoPorPK($vlPromo,$id)
    {
        $daofactory = NULL;
        $retorno = NULL;
        try {
            $daofactory = DAOFactory::getDAOFactory();
            $daofactory->open();
            $daofactory->beginTransaction();
            
            // atualizar registro por meio do método UsuarioPublicidadeBusinessImpl::atualizarVlpromoPorPK($vlPromo,$id)
           $bo = new UsuarioPublicidadeBusinessImpl();
           $retorno = $bo->atualizarVlpromoPorPK($daofactory,$vlPromo,$id);

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
* atualizarObservacaoPorPK() - Usado para invocar a classe de negócio UsuarioPublicidadeBusinessImpl de forma geral
* realizar uma atualização de Observação diretamente na tabela USUARIO_PUBLICIDADE campo USPU_TX_OBS
* @param $id
* @param $observacao
* @return UsuarioPublicidadeDTO
*
* 
*/

    public function atualizarObservacaoPorPK($observacao,$id)
    {
        $daofactory = NULL;
        $retorno = NULL;
        try {
            $daofactory = DAOFactory::getDAOFactory();
            $daofactory->open();
            $daofactory->beginTransaction();
            
            // atualizar registro por meio do método UsuarioPublicidadeBusinessImpl::atualizarObservacaoPorPK($observacao,$id)
           $bo = new UsuarioPublicidadeBusinessImpl();
           $retorno = $bo->atualizarObservacaoPorPK($daofactory,$observacao,$id);

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
* atualizarDataremoverPorPK() - Usado para invocar a classe de negócio UsuarioPublicidadeBusinessImpl de forma geral
* realizar uma atualização de Data para apagar diretamente na tabela USUARIO_PUBLICIDADE campo USPU_DT_APAGAR
* @param $id
* @param $dataRemover
* @return UsuarioPublicidadeDTO
*
* 
*/

    public function atualizarDataremoverPorPK($dataRemover,$id)
    {
        $daofactory = NULL;
        $retorno = NULL;
        try {
            $daofactory = DAOFactory::getDAOFactory();
            $daofactory->open();
            $daofactory->beginTransaction();
            
            // atualizar registro por meio do método UsuarioPublicidadeBusinessImpl::atualizarDataremoverPorPK($dataRemover,$id)
           $bo = new UsuarioPublicidadeBusinessImpl();
           $retorno = $bo->atualizarDataremoverPorPK($daofactory,$dataRemover,$id);

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
* listarUsuarioPublicidadeProx24h() - Listar as publicidades ativas do dia.
* 
* Em breve, iremos colocar a busca pela região de usuaid (solicitante da pesquisa)
*
* @param $usuaid
* @param $status
* @param $pag
* @param $qtde
* @param $coluna
* @param $ordem
* @return $PaginacaoDTO
*/
    public function listarUsuarioPublicidadeProx24h($usuaid, $status='A', $pag=1, $qtde=0, $coluna=1, $ordem=0)
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
            // listar paginado UsuarioPublicidade
            $bo = new UsuarioPublicidadeBusinessImpl();
            $retorno = $bo->listarUsuarioPublicidadeProx24h($daofactory, $usuaid, $status, $pag, $qtde, $coluna, $ordem);
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
* listarUsuarioPublicidadePorUsuaIdStatus() - Usado para invocar a classe de negócio TipoEmpreendimentoBusinessImpl de forma geral
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

   public function listarUsuarioPublicidadePorUsuaIdStatus($usuaid, $status='A', $pag=1, $qtde=0, $coluna=1, $ordem=0) 
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
           // listar paginado UsuarioPublicidade
           $bo = new UsuarioPublicidadeBusinessImpl();
           $retorno = $bo->listarUsuarioPublicidadePorUsuaIdStatus($daofactory, $usuaid, $status, $pag, $qtde, $coluna, $ordem);
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
