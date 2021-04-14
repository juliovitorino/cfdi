<?php 

// importar dependencias
require_once '../campanhacashback/CampanhaCashbackBusinessImpl.php';
require_once '../campanhacashback/CampanhaCashbackServiceImpl.php';
require_once '../util/util.php';

/**
*
* CampanhaCashbackHelper - Classe de implementação dos métodos de adaptação para a classe de negócio CampanhaCashbackCC
* Camada de negócio CampanhaCashbackCC - camada responsável pela lógica de negócios de CampanhaCashbackCC do sistema. 
* Não é uma camada visível para outros dispositivos, como as camadas de apresentação e aplicação. 
*
* É uma classe para apoiar, criar ou evitar que na classe de negócio se crie muitos códigos repetidos para obter apenas
* uma informação ou objeto.
*
* Todos os métodos DEVEM ser declarados como estáticos
*
* Changelog:
* 
* @autor Julio Cesar Vitorino
* @since 26/08/2019 16:09:29
*
*/

class CampanhaCashbackHelper
{

    static function getDTOFlash($id_campanha, $id_usuario){
        $dto = new CampanhaCashbackDTO();

        $dto->id_campanha = $id_campanha;
        $dto->id_usuario = $id_usuario;
        $dto->percentual = 0;
        $dto->dataTermino = Util::getNow();
        $dto->obs = ".";

        return $dto;
    }

    static function insertCampanhaCashbackFlashService($id_campanha, $id_usuario){
        $dto = self::getDTOFlash($id_campanha, $id_usuario);

        $dto->id_campanha = $id_campanha;
        $dto->id_usuario = $id_usuario;
        $dto->percentual = 0;
        $dto->dataTermino = Util::getNow();
        $dto->obs = ".";

        $csi = new CampanhaCashbackServiceImpl();

        // Cadastra o registro populado no DTO
        return $csi->cadastrar($dto);

    }

    static function insertCampanhaCashbackFlashBusiness($daofactory, $id_campanha, $id_usuario){
        $dto = self::getDTOFlash($id_campanha, $id_usuario);

        $dto->id_campanha = $id_campanha;
        $dto->id_usuario = $id_usuario;
        $dto->percentual = 0;
        $dto->dataTermino = Util::getNow();
        $dto->obs = ".";

        $bo = new CampanhaCashbackBusinessImpl();

        // Cadastra o registro populado no DTO
        return $bo->inserir($daofactory, $dto);

    }

    
}


?>
