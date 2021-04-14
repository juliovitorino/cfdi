<?php

//importar dependencias
require_once 'UsuarioAvaliacaoService.php';
require_once 'UsuarioAvaliacaoBusinessImpl.php';
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
* UsuarioAvaliacaoServiceImpl - Implementação dos servicos para Classe de negócio com métodos para apoiar a integridade de informações sobre as avaliações gerais do usuário gerenciado pela plataforma
* Camada de Serviços UsuarioAvaliacao - camada responsável pela lógica de negócios de UsuarioAvaliacao do sistema. 
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
* @since 17/09/2019 09:22:19
*
*/
class UsuarioAvaliacaoServiceImpl implements UsuarioAvaliacaoService
{
    
    function __construct() {    }
/**
*
* realizarAvaliacaoCartao() - Acumula indicadores de avaliação geral do usuário
*
*/
	public function realizarUsuarioAvaliacao($id_usuario, $rating)
	{
		$daofactory = NULL;
		$retorno = NULL;
		try {
			$daofactory = DAOFactory::getDAOFactory();
			$daofactory->open();
			$daofactory->beginTransaction();
            
            $bo = new UsuarioAvaliacaoBusinessImpl();
            $retorno = $bo->realizarUsuarioAvaliacao($daofactory, $id_usuario, $rating);
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
* listarTudo() - Usado para invocar a classe de negócio UsuarioAvaliacaoBusinessImpl de forma geral
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
* PesquisarMaxPKAtivoIdPorStatus() - Usado para invocar a classe de negócio UsuarioAvaliacaoBusinessImpl de forma geral
* a buscar a MAIOR PK pra um dado status.
*
* @param status
* @return UsuarioAvaliacaoDTO
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
        
       $bo = new UsuarioAvaliacaoBusinessImpl();
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
* atualizar() - Usado para invocar a classe de negócio UsuarioAvaliacaoBusinessImpl de forma geral
* para gerenciar as regras de negócio do sistema.
*
* @param UsuarioAvaliacaoDTO contendo dados para enviar para atualização
* @return uma instância de UsuarioAvaliacaoDTO com resultdo da operação
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
            
           $bo = new UsuarioAvaliacaoBusinessImpl();
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
* atualizarStatusUsuarioAvaliacao() - Usado para invocar a classe de negócio UsuarioAvaliacaoBusinessImpl de forma geral
* para gerenciar as atualizações do campo STATUS de acordo as regras de negócio do sistema.
*
* @param $id
* @param $status
* @return uma instância de UsuarioAvaliacaoDTO com resultdo da operação
*
*/


    public function autalizarStatusUsuarioAvaliacao($id, $status)
    {
        $daofactory = NULL;
        $retorno = NULL;
        try {
            $daofactory = DAOFactory::getDAOFactory();
            $daofactory->open();
            $daofactory->beginTransaction();
            

           $bo = new UsuarioAvaliacaoBusinessImpl();
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
* cadastrar() - Usado para invocar a classe de negócio UsuarioAvaliacaoBusinessImpl de forma geral
* para gerenciar a criação de registro de acordo as regras de negócio do sistema.
*
* @param $dto - Instância de UsuarioAvaliacaoDTO
*
* @return uma instância de UsuarioAvaliacaoDTO com resultdo da operação
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
            

           $bo = new UsuarioAvaliacaoBusinessImpl();
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
* @return List<UsuarioAvaliacaoDTO>[]
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
            
            // listar paginado UsuarioAvaliacao
           $bo = new UsuarioAvaliacaoBusinessImpl();
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
* realizar uma busca diretamente pela PK (Primary Key) da tabela USUARIO_AVALIACAO campo USAV_ID
*
* @param $id
* @return UsuarioAvaliacaoDTO
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
            
            // pesquisar pela PK da tabela UsuarioAvaliacao
           $bo = new UsuarioAvaliacaoBusinessImpl();
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
* listarUsuarioAvaliacaoPorStatus() - Usado para invocar a classe de negócio TipoEmpreendimentoBusinessImpl de forma geral
* realizar lista paginada de registros com uma instância de PaginacaoDTO
*
* @param $status
* @param $pag
* @param $qtde
* @param $coluna
* @param $ordem
* @return $PaginacaoDTO
*/

   public function listarUsuarioAvaliacaoPorStatus($status='A', $pag=1, $qtde=0, $coluna=1, $ordem=0) 
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
           // listar paginado UsuarioAvaliacao
           $bo = new UsuarioAvaliacaoBusinessImpl();
           $retorno = $bo->listarUsuarioAvaliacaoPorStatus($daofactory, $status, $pag, $qtde, $coluna, $ordem);
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
* pesquisarPorId_Usuario() - Usado para invocar a classe de negócio UsuarioAvaliacaoBusinessImpl de forma geral
* realizar uma busca de ID do usuário diretamente na tabela USUARIO_AVALIACAO campo USUA_ID
*
* @param $id_usuario
* @return UsuarioAvaliacaoDTO
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
            
            // pesquisar pelo atributo UsuarioAvaliacao.id_usuario no campo USUA_ID da tabela USUARIO_AVALIACAO
           $bo = new UsuarioAvaliacaoBusinessImpl();
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
* pesquisarPorContadorstar_1() - Usado para invocar a classe de negócio UsuarioAvaliacaoBusinessImpl de forma geral
* realizar uma busca de Contador Avaliação Péssima diretamente na tabela USUARIO_AVALIACAO campo USAV_NU_CONT_STAR_1
*
* @param $contadorStar_1
* @return UsuarioAvaliacaoDTO
*
* 
*/

    public function pesquisarPorContadorstar_1($contadorStar_1)
    {
        $daofactory = NULL;
        $retorno = NULL;
        try {
            $daofactory = DAOFactory::getDAOFactory();
            $daofactory->open();
            $daofactory->beginTransaction();
            
            // pesquisar pelo atributo UsuarioAvaliacao.contadorStar_1 no campo USAV_NU_CONT_STAR_1 da tabela USUARIO_AVALIACAO
           $bo = new UsuarioAvaliacaoBusinessImpl();
           $retorno = $bo->carregarPorContadorstar_1($daofactory, $contadorStar_1);
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
* pesquisarPorContadorstar_2() - Usado para invocar a classe de negócio UsuarioAvaliacaoBusinessImpl de forma geral
* realizar uma busca de Contador Avaliação Ruim diretamente na tabela USUARIO_AVALIACAO campo USAV_NU_CONT_STAR_2
*
* @param $contadorStar_2
* @return UsuarioAvaliacaoDTO
*
* 
*/

    public function pesquisarPorContadorstar_2($contadorStar_2)
    {
        $daofactory = NULL;
        $retorno = NULL;
        try {
            $daofactory = DAOFactory::getDAOFactory();
            $daofactory->open();
            $daofactory->beginTransaction();
            
            // pesquisar pelo atributo UsuarioAvaliacao.contadorStar_2 no campo USAV_NU_CONT_STAR_2 da tabela USUARIO_AVALIACAO
           $bo = new UsuarioAvaliacaoBusinessImpl();
           $retorno = $bo->carregarPorContadorstar_2($daofactory, $contadorStar_2);
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
* pesquisarPorContadorstar_3() - Usado para invocar a classe de negócio UsuarioAvaliacaoBusinessImpl de forma geral
* realizar uma busca de Contador Avaliação Boa diretamente na tabela USUARIO_AVALIACAO campo USAV_NU_CONT_STAR_3
*
* @param $contadorStar_3
* @return UsuarioAvaliacaoDTO
*
* 
*/

    public function pesquisarPorContadorstar_3($contadorStar_3)
    {
        $daofactory = NULL;
        $retorno = NULL;
        try {
            $daofactory = DAOFactory::getDAOFactory();
            $daofactory->open();
            $daofactory->beginTransaction();
            
            // pesquisar pelo atributo UsuarioAvaliacao.contadorStar_3 no campo USAV_NU_CONT_STAR_3 da tabela USUARIO_AVALIACAO
           $bo = new UsuarioAvaliacaoBusinessImpl();
           $retorno = $bo->carregarPorContadorstar_3($daofactory, $contadorStar_3);
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
* pesquisarPorContadorstar_4() - Usado para invocar a classe de negócio UsuarioAvaliacaoBusinessImpl de forma geral
* realizar uma busca de Contador Avaliação Ótima diretamente na tabela USUARIO_AVALIACAO campo USAV_NU_CONT_STAR_4
*
* @param $contadorStar_4
* @return UsuarioAvaliacaoDTO
*
* 
*/

    public function pesquisarPorContadorstar_4($contadorStar_4)
    {
        $daofactory = NULL;
        $retorno = NULL;
        try {
            $daofactory = DAOFactory::getDAOFactory();
            $daofactory->open();
            $daofactory->beginTransaction();
            
            // pesquisar pelo atributo UsuarioAvaliacao.contadorStar_4 no campo USAV_NU_CONT_STAR_4 da tabela USUARIO_AVALIACAO
           $bo = new UsuarioAvaliacaoBusinessImpl();
           $retorno = $bo->carregarPorContadorstar_4($daofactory, $contadorStar_4);
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
* pesquisarPorContadorstar_5() - Usado para invocar a classe de negócio UsuarioAvaliacaoBusinessImpl de forma geral
* realizar uma busca de Contador Avaliação Excelente diretamente na tabela USUARIO_AVALIACAO campo USAV_NU_CONT_STAR_5
*
* @param $contadorStar_5
* @return UsuarioAvaliacaoDTO
*
* 
*/

    public function pesquisarPorContadorstar_5($contadorStar_5)
    {
        $daofactory = NULL;
        $retorno = NULL;
        try {
            $daofactory = DAOFactory::getDAOFactory();
            $daofactory->open();
            $daofactory->beginTransaction();
            
            // pesquisar pelo atributo UsuarioAvaliacao.contadorStar_5 no campo USAV_NU_CONT_STAR_5 da tabela USUARIO_AVALIACAO
           $bo = new UsuarioAvaliacaoBusinessImpl();
           $retorno = $bo->carregarPorContadorstar_5($daofactory, $contadorStar_5);
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
* pesquisarPorRatingcalculado() - Usado para invocar a classe de negócio UsuarioAvaliacaoBusinessImpl de forma geral
* realizar uma busca de Média da Avaliação diretamente na tabela USUARIO_AVALIACAO campo USAV_NU_RATING
*
* @param $ratingCalculado
* @return UsuarioAvaliacaoDTO
*
* 
*/

    public function pesquisarPorRatingcalculado($ratingCalculado)
    {
        $daofactory = NULL;
        $retorno = NULL;
        try {
            $daofactory = DAOFactory::getDAOFactory();
            $daofactory->open();
            $daofactory->beginTransaction();
            
            // pesquisar pelo atributo UsuarioAvaliacao.ratingCalculado no campo USAV_NU_RATING da tabela USUARIO_AVALIACAO
           $bo = new UsuarioAvaliacaoBusinessImpl();
           $retorno = $bo->carregarPorRatingcalculado($daofactory, $ratingCalculado);
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

#VALUE!
#VALUE!
#VALUE!
#VALUE!
#VALUE!
#VALUE!
#VALUE!
#VALUE!
#VALUE!
#VALUE!
#VALUE!
#VALUE!
#VALUE!
#VALUE!
#VALUE!
#VALUE!
#VALUE!
#VALUE!
#VALUE!
#VALUE!
#VALUE!
#VALUE!
#VALUE!
#VALUE!
#VALUE!
#VALUE!
#VALUE!
#VALUE!
#VALUE!
#VALUE!
#VALUE!
#VALUE!
#VALUE!
#VALUE!
#VALUE!
#VALUE!
#VALUE!
#VALUE!
#VALUE!
#VALUE!
#VALUE!
#VALUE!

#VALUE!
#VALUE!
#VALUE!
#VALUE!
#VALUE!
#VALUE!
#VALUE!
#VALUE!
#VALUE!
#VALUE!
#VALUE!
#VALUE!
#VALUE!
#VALUE!
#VALUE!
#VALUE!
#VALUE!
#VALUE!
#VALUE!
#VALUE!
#VALUE!
#VALUE!
#VALUE!
#VALUE!
#VALUE!
#VALUE!
#VALUE!
#VALUE!
#VALUE!
#VALUE!
#VALUE!
#VALUE!
#VALUE!
#VALUE!
#VALUE!
#VALUE!
#VALUE!
#VALUE!
#VALUE!
#VALUE!
#VALUE!
#VALUE!


#VALUE!
#VALUE!
#VALUE!
#VALUE!
#VALUE!
#VALUE!
#VALUE!
#VALUE!
#VALUE!
#VALUE!
#VALUE!
#VALUE!
#VALUE!
#VALUE!
#VALUE!
#VALUE!
#VALUE!
#VALUE!
#VALUE!
#VALUE!
#VALUE!
#VALUE!
#VALUE!
#VALUE!
#VALUE!
#VALUE!
#VALUE!
#VALUE!
#VALUE!
#VALUE!
#VALUE!
#VALUE!
#VALUE!
#VALUE!
#VALUE!
#VALUE!
#VALUE!
#VALUE!
#VALUE!
#VALUE!
#VALUE!
#VALUE!


#VALUE!
#VALUE!
#VALUE!
#VALUE!
#VALUE!
#VALUE!
#VALUE!
#VALUE!
#VALUE!
#VALUE!
#VALUE!
#VALUE!
#VALUE!
#VALUE!
#VALUE!
#VALUE!
#VALUE!
#VALUE!
#VALUE!
#VALUE!
#VALUE!
#VALUE!
#VALUE!
#VALUE!
#VALUE!
#VALUE!
#VALUE!
#VALUE!
#VALUE!
#VALUE!
#VALUE!
#VALUE!
#VALUE!
#VALUE!
#VALUE!
#VALUE!
#VALUE!
#VALUE!
#VALUE!
#VALUE!
#VALUE!
#VALUE!


#VALUE!
#VALUE!
#VALUE!
#VALUE!
#VALUE!
#VALUE!
#VALUE!
#VALUE!
#VALUE!
#VALUE!
#VALUE!
#VALUE!
#VALUE!
#VALUE!
#VALUE!
#VALUE!
#VALUE!
#VALUE!
#VALUE!
#VALUE!
#VALUE!
#VALUE!
#VALUE!
#VALUE!
#VALUE!
#VALUE!
#VALUE!
#VALUE!
#VALUE!
#VALUE!
#VALUE!
#VALUE!
#VALUE!
#VALUE!
#VALUE!
#VALUE!
#VALUE!
#VALUE!
#VALUE!
#VALUE!
#VALUE!
#VALUE!



/**
*
* atualizarId_UsuarioPorPK() - Usado para invocar a classe de negócio UsuarioAvaliacaoBusinessImpl de forma geral
* realizar uma atualização de ID do usuário diretamente na tabela USUARIO_AVALIACAO campo USUA_ID
* @param $id
* @param $id_usuario
* @return UsuarioAvaliacaoDTO
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
            
            // atualizar registro por meio do método UsuarioAvaliacaoBusinessImpl::atualizarId_UsuarioPorPK($id_usuario,$id)
           $bo = new UsuarioAvaliacaoBusinessImpl();
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
* atualizarContadorstar_1PorPK() - Usado para invocar a classe de negócio UsuarioAvaliacaoBusinessImpl de forma geral
* realizar uma atualização de Contador Avaliação Péssima diretamente na tabela USUARIO_AVALIACAO campo USAV_NU_CONT_STAR_1
* @param $id
* @param $contadorStar_1
* @return UsuarioAvaliacaoDTO
*
* 
*/

    public function atualizarContadorstar_1PorPK($contadorStar_1,$id)
    {
        $daofactory = NULL;
        $retorno = NULL;
        try {
            $daofactory = DAOFactory::getDAOFactory();
            $daofactory->open();
            $daofactory->beginTransaction();
            
            // atualizar registro por meio do método UsuarioAvaliacaoBusinessImpl::atualizarContadorstar_1PorPK($contadorStar_1,$id)
           $bo = new UsuarioAvaliacaoBusinessImpl();
           $retorno = $bo->atualizarContadorstar_1PorPK($daofactory,$contadorStar_1,$id);

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
* atualizarContadorstar_2PorPK() - Usado para invocar a classe de negócio UsuarioAvaliacaoBusinessImpl de forma geral
* realizar uma atualização de Contador Avaliação Ruim diretamente na tabela USUARIO_AVALIACAO campo USAV_NU_CONT_STAR_2
* @param $id
* @param $contadorStar_2
* @return UsuarioAvaliacaoDTO
*
* 
*/

    public function atualizarContadorstar_2PorPK($contadorStar_2,$id)
    {
        $daofactory = NULL;
        $retorno = NULL;
        try {
            $daofactory = DAOFactory::getDAOFactory();
            $daofactory->open();
            $daofactory->beginTransaction();
            
            // atualizar registro por meio do método UsuarioAvaliacaoBusinessImpl::atualizarContadorstar_2PorPK($contadorStar_2,$id)
           $bo = new UsuarioAvaliacaoBusinessImpl();
           $retorno = $bo->atualizarContadorstar_2PorPK($daofactory,$contadorStar_2,$id);

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
* atualizarContadorstar_3PorPK() - Usado para invocar a classe de negócio UsuarioAvaliacaoBusinessImpl de forma geral
* realizar uma atualização de Contador Avaliação Boa diretamente na tabela USUARIO_AVALIACAO campo USAV_NU_CONT_STAR_3
* @param $id
* @param $contadorStar_3
* @return UsuarioAvaliacaoDTO
*
* 
*/

    public function atualizarContadorstar_3PorPK($contadorStar_3,$id)
    {
        $daofactory = NULL;
        $retorno = NULL;
        try {
            $daofactory = DAOFactory::getDAOFactory();
            $daofactory->open();
            $daofactory->beginTransaction();
            
            // atualizar registro por meio do método UsuarioAvaliacaoBusinessImpl::atualizarContadorstar_3PorPK($contadorStar_3,$id)
           $bo = new UsuarioAvaliacaoBusinessImpl();
           $retorno = $bo->atualizarContadorstar_3PorPK($daofactory,$contadorStar_3,$id);

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
* atualizarContadorstar_4PorPK() - Usado para invocar a classe de negócio UsuarioAvaliacaoBusinessImpl de forma geral
* realizar uma atualização de Contador Avaliação Ótima diretamente na tabela USUARIO_AVALIACAO campo USAV_NU_CONT_STAR_4
* @param $id
* @param $contadorStar_4
* @return UsuarioAvaliacaoDTO
*
* 
*/

    public function atualizarContadorstar_4PorPK($contadorStar_4,$id)
    {
        $daofactory = NULL;
        $retorno = NULL;
        try {
            $daofactory = DAOFactory::getDAOFactory();
            $daofactory->open();
            $daofactory->beginTransaction();
            
            // atualizar registro por meio do método UsuarioAvaliacaoBusinessImpl::atualizarContadorstar_4PorPK($contadorStar_4,$id)
           $bo = new UsuarioAvaliacaoBusinessImpl();
           $retorno = $bo->atualizarContadorstar_4PorPK($daofactory,$contadorStar_4,$id);

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
* atualizarContadorstar_5PorPK() - Usado para invocar a classe de negócio UsuarioAvaliacaoBusinessImpl de forma geral
* realizar uma atualização de Contador Avaliação Excelente diretamente na tabela USUARIO_AVALIACAO campo USAV_NU_CONT_STAR_5
* @param $id
* @param $contadorStar_5
* @return UsuarioAvaliacaoDTO
*
* 
*/

    public function atualizarContadorstar_5PorPK($contadorStar_5,$id)
    {
        $daofactory = NULL;
        $retorno = NULL;
        try {
            $daofactory = DAOFactory::getDAOFactory();
            $daofactory->open();
            $daofactory->beginTransaction();
            
            // atualizar registro por meio do método UsuarioAvaliacaoBusinessImpl::atualizarContadorstar_5PorPK($contadorStar_5,$id)
           $bo = new UsuarioAvaliacaoBusinessImpl();
           $retorno = $bo->atualizarContadorstar_5PorPK($daofactory,$contadorStar_5,$id);

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
* atualizarRatingcalculadoPorPK() - Usado para invocar a classe de negócio UsuarioAvaliacaoBusinessImpl de forma geral
* realizar uma atualização de Média da Avaliação diretamente na tabela USUARIO_AVALIACAO campo USAV_NU_RATING
* @param $id
* @param $ratingCalculado
* @return UsuarioAvaliacaoDTO
*
* 
*/

    public function atualizarRatingcalculadoPorPK($ratingCalculado,$id)
    {
        $daofactory = NULL;
        $retorno = NULL;
        try {
            $daofactory = DAOFactory::getDAOFactory();
            $daofactory->open();
            $daofactory->beginTransaction();
            
            // atualizar registro por meio do método UsuarioAvaliacaoBusinessImpl::atualizarRatingcalculadoPorPK($ratingCalculado,$id)
           $bo = new UsuarioAvaliacaoBusinessImpl();
           $retorno = $bo->atualizarRatingcalculadoPorPK($daofactory,$ratingCalculado,$id);

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

#VALUE!
#VALUE!
#VALUE!
#VALUE!
#VALUE!
#VALUE!
#VALUE!
#VALUE!
#VALUE!
#VALUE!
#VALUE!
#VALUE!
#VALUE!
#VALUE!
#VALUE!
#VALUE!
#VALUE!
#VALUE!
#VALUE!
#VALUE!
#VALUE!
#VALUE!
#VALUE!
#VALUE!
#VALUE!
#VALUE!
#VALUE!
#VALUE!
#VALUE!
#VALUE!
#VALUE!
#VALUE!
#VALUE!
#VALUE!
#VALUE!
#VALUE!
#VALUE!
#VALUE!
#VALUE!
#VALUE!
#VALUE!
#VALUE!
#VALUE!
#VALUE!

#VALUE!
#VALUE!
#VALUE!
#VALUE!
#VALUE!
#VALUE!
#VALUE!
#VALUE!
#VALUE!
#VALUE!
#VALUE!
#VALUE!
#VALUE!
#VALUE!
#VALUE!
#VALUE!
#VALUE!
#VALUE!
#VALUE!
#VALUE!
#VALUE!
#VALUE!
#VALUE!
#VALUE!
#VALUE!
#VALUE!
#VALUE!
#VALUE!
#VALUE!
#VALUE!
#VALUE!
#VALUE!
#VALUE!
#VALUE!
#VALUE!
#VALUE!
#VALUE!
#VALUE!
#VALUE!
#VALUE!
#VALUE!
#VALUE!
#VALUE!
#VALUE!

#VALUE!
#VALUE!
#VALUE!
#VALUE!
#VALUE!
#VALUE!
#VALUE!
#VALUE!
#VALUE!
#VALUE!
#VALUE!
#VALUE!
#VALUE!
#VALUE!
#VALUE!
#VALUE!
#VALUE!
#VALUE!
#VALUE!
#VALUE!
#VALUE!
#VALUE!
#VALUE!
#VALUE!
#VALUE!
#VALUE!
#VALUE!
#VALUE!
#VALUE!
#VALUE!
#VALUE!
#VALUE!
#VALUE!
#VALUE!
#VALUE!
#VALUE!
#VALUE!
#VALUE!
#VALUE!
#VALUE!
#VALUE!
#VALUE!
#VALUE!
#VALUE!
















/**
*
* listarUsuarioAvaliacaoPorUsuaIdStatus() - Usado para invocar a classe de negócio TipoEmpreendimentoBusinessImpl de forma geral
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

   public function listarUsuarioAvaliacaoPorUsuaIdStatus($usuaid, $status='A', $pag=1, $qtde=0, $coluna=1, $ordem=0) 
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
           // listar paginado UsuarioAvaliacao
           $bo = new UsuarioAvaliacaoBusinessImpl();
           $retorno = $bo->listarUsuarioAvaliacaoPorUsuaIdStatus($daofactory, $usuaid, $status, $pag, $qtde, $coluna, $ordem);
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
