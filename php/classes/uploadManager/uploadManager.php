<?php

require_once '../usuarios/UsuarioServiceImpl.php';
require_once '../sessao/SessaoServiceImpl.php';
require_once '../sessao/ConstantesSessao.php';
require_once '../util/util.php';
require_once '../variavel/VariavelCache.php';
require_once '../variavel/ConstantesVariavel.php';

/**
 * UploadManager - Gerenciar o tratamento de upload
 *
 * @author Julio Vitorino
 * @since 25/07/2019
 */

class UploadManager
{
    public $usuariodto;
    public $dirUsuario;

    /* anula construtor */
	public function __construct($token)
	{
        // Obtem o usuário do token validado
        $ssi = new SessaoServiceImpl();
        $sessaodto = $ssi->obterRegistroDonoTokenSessao($token);
        //var_dump($sessaodto);

        switch ($sessaodto->msgcode) {
            case ConstantesMensagem::SESSAO_INVALIDA_DO_USUARIO:
            case ConstantesMensagem::SISTEMA_ATUALIZACAO_CRITICA_NOVO_LOGIN:
                echo json_encode($sessaodto);
                exit(0);
                break;
            
            default:
                # code...
                break;
        }

        $this->usuariodto = $sessaodto->usuariodto;

        // Verifica se diretorio HOME do usuário existe
        $dir = Util::getTrocaConteudoParametrizada(VariavelCache::getInstance()->getVariavel(ConstantesVariavel::HOME_REPOSITORIO_USUARIO), [
            ConstantesVariavel::P1 => $this->usuariodto->id
        ]);

        $this->dirUsuario = $dir;

//        var_dump($dir);
        //var_dump(getcwd());
        if(! is_dir($dir)){
            // Cria o diretorio e seta permissionamento. Tudo para o proprietario, leitura e execucao para os outros
            mkdir($dir, 0777, true);
            //chmod ($dir, 0755);
        }

    }

    public function moverArquivoTransicaoParaRepositorio($arquivo){
        $dirTransicao = VariavelCache::getInstance()->getVariavel(ConstantesVariavel::HOME_UPLOAD_TRANSICAO);

        $source = $dirTransicao . '/' . $arquivo;
        $dest = $this->dirUsuario .  '/' .$arquivo;
        if(copy($source, $dest)) {
            unlink($source);
        }


    }




    
}
?>
