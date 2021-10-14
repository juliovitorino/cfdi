<?php

require_once 'AbstractTarefa.php';

require_once '../filaemail/FilaEmailServiceImpl.php';
require_once '../filaemail/FilaEmailConstantes.php';
require_once '../variavel/ConstantesVariavel.php';

require_once '../email/EmailDTO.php';
require_once '../email/Email.php';
require_once '../email/EmailTemplateHub.php';
require_once '../email/EmailSolucionador.php';

/**
 * TarefaProcessarFilaEmail - Implementa métodos para interface ITarefa
 * 
 * A função dessa classe é executar processos envolvendo a Fila de Email que tem pendencia com
 * Fale Conosco
 * 
 * As classes concretas deverão implementar os métodos definidos na interface ITarefa.
 *
 * @author Julio Vitorino
 * @since 01/09/2021
 */

class TarefaProcessarFilaEmail extends AbstractTarefa {

	function __construct()	{}

    public function executar($contexto)
    {
        // Obter a fila
        $fiemsvc = new FilaEmailServiceImpl();
        $paginacao = $fiemsvc->listarFilaEmailPorFilaStatus($contexto['fila'], ConstantesVariavel::STATUS_ATIVO);
        if(count($paginacao->lst) > 0)
        {
            foreach($paginacao->lst as $key => $value) {
                // -- troca o estado para WORKING se estiver ATIVO
                $fiemsvc->autalizarStatusFilaEmail($value->id, ConstantesVariavel::STATUS_TRABALHANDO);
                
                //-------------------------------------------------------------------
                // envia email
                //-------------------------------------------------------------------

                // prepara parametrizacao
                $email = new EmailDTO();
                $email->destinatario = $value->email->destinatario;
                $email->emaildestinatario = $value->email->emaildestinatario;
                $email->assunto = $value->email->assunto;
                $email->template = getcwd() . VariavelCache::getInstance()->getVariavel(ConstantesVariavel::PATH_RELATIVO_TEMPLATES_EMAIL) 
                                    . $value->email->template;
                $email->lsttags = [	
                                        TagHub::TAG_NOME => $value->email->destinatario,
                                    ];
                //var_dump($email);

                $es = new EmailSolucionador($email);
                $es->execute();
//                echo $es->getConteudo();

                // Envia o email com o email já solucionado em suas tags
                $e = new Email($es);
                $e->enviar();

                //-------------------------------------------------------------------
                // fim envia email
                //-------------------------------------------------------------------
                
                // - troca estado para ENVIADO
                $fiemsvc->autalizarStatusFilaEmail($value->id, ConstantesVariavel::STATUS_ENVIADO);

                // alterar o estado da fila e atualiza informações de 'realizado'
                $fiemsvc->atualizarDatarealenvioPorPK(Util::getNow(), $value->id);
            }
        }

        // retorno da tarefa
        return $paginacao;
    }
    
}

?>