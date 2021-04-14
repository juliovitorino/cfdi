<?php 

require_once 'fakeDTO.php';

/**
 * Fake - Gerador de fakes
 */
class Fake
{
	private static $instance;

	private $lstseparador = ['_','.'];

	private $lstdomains = ['uol','gmail','trix','ig','ice','nuela','lena','iogsa'];

	private $lstnomes = ['Alice','Miguel','Sophia','Arthur','Helena','Bernardo','Valentina','Heitor','Laura','Davi',
'Isabella','Lorenzo','Manuela','Theo','Julia','Pedro','Heloisa','Gabriel','Luiza','Enzo','Maria','Luiza',
'Matheus','Lorena','Lucas','Livia','Benjamin','Giovanna','Nicolas','Maria','Eduarda','Guilherme','Beatriz',
'Rafael','Maria','Clara','Joaquim','Cecilia','Samuel','Eloa','Enzo','Gabriel','Lara','Miguel','Maria','Julia',
'Henrique','Isadora','Gustavo','Mariana','Murilo','Emanuelly','Pedro Henrique','Ana Julia','Pietro','Ana Luiza',
'Lucca','Ana Clara','Felipe','Melissa','Joao,Pedro','Yasmin','Isaac','Maria','Alice','Benicio','Isabelly','Daniel',
'Lavinia','Anthony','Esther','Leonardo','Sarah','Davi Lucca','Elisa','Bryan','Antonella','Eduardo','Rafaela',
'Joao','Lucas','Maria','Cecilia','Victor','Liz','Joao','Marina','Caua','Nicole','Antônio','Maite','Vicente','Isis',
'Caleb','Alicia','Gael','Luna','Bento','ebeca','Caio','Agatha','Emanuel','Leticia','Vinicius','Maria',
'Joao','Guilherme','Gabriela','Davi Lucas','Ana Laura','oah','Catarina','Joao','Gabriel','Clara','Joao','Victor',
'Ana','Beatriz','Luiz Miguel','Vitoria','Francisco','Olivia','Kaique','Maria','Fernanda','Otavio','Emilly',
'Augusto','Maria','Valentina','Levi','Milena','Julio','Yuri','Maria','Helena','Enrico','Bianca','Thiago','Larissa','Ian',
'Mirella','Victor','Hugo','Maria','Flor','Thomas','Allana','Henry','Ana Sophia','Luiz Felipe','Clarice','Ryan','Pietra',
'Arthur','Miguel','Maria','Vitoria','Davi Luiz','Maya','Nathan','Lais','Pedro Lucas','Ayla','Davi','Miguel',
'Livia','Raul','Eduarda','Pedro Miguel','Mariah','Luiz Henrique','Stella','Luan','Ana','Erick','Gabrielly',
'Martin','Sophie','Bruno','Carolina','Rodrigo','Maria','Laura','Luiz','Gustavo','Maria','Heloisa',
'Maria','Sophia','Breno','Fernanda','Kaue','Malu','Enzo','Miguel','Analu','Fernando','Amanda','Henrique','Aurora',
'Luiz','Otavio','Maria','Isis','Carlos','Eduardo','Louise','Tomas','Heloise','Lucas','Gabriel','Ana','Vitoria','Andre',
'Ana','Cecilia','Jose','Ana Liz','Yago','Joana','Danilo','Luana','Anthony','Gabriel','Antônia','Ruan','Isabel',
'Miguel','Henrique1','Bruna','Olivera'];

	private $lstsobrenomes = [
'Agostinho','Aguiar','Albuquerque','Alegria','Alencastro','Almada','Alves','Alvim','Amorim','Andrade','Antunes',
'Aparicio','Apolinario','Araujo','Arruda','Assis','Assunçao','avila','Azambuja','Baptista','Barreto','Barros',
'Beira-Mar','Belchior','Belem','Bernardes','Bittencourt','Boaventura','Bonfim','Botelho','Brites','Brito','Caetano',
'Calixto','Camacho','Camilo','Capelo','Castro','Cavalcante','Chaves','Conceiçao','Corte Real','Cortês','Coutinho',
'Crespo','Cunha','Curado','Custodio','Cordoba','Damasio','Dantas','Dias','Dinis','Domingues','Dorneles','dos Reis',
'Drumond','D’avila','Escobar','Espinosa','Esteves','Evangelista','Farias','Ferrari','Figueiredo','Figueiroa','Flores',
'Fogaça','Freitas','Frutuoso','Furtado','Felix','Galvao','Garcia','Gaspar','Gentil','Geraldes','Gil','Godinho','Gomes',
'Gonzaga','Goulart','Gouveia','Guedes','Guimaraes','Guterres','Gois','Goes','Hernandes','Hilario','Hipolito','Ibrahim',
'Ilha','Infante','Jaques','Jordao','Lacerda','Lancastre','Leiria','Lessa','Machado','Maciel','Magalhaes','Maia','Maldonado
','Marinho','Marques','Martins','Medeiros','Meireles','Mello','Mendes','Menezes','Mesquita','Modesto','Monteiro','Morais',
'Moreira','Morgado','Moura','Muniz','Neves','Nogueira','Novais','Nobrega','Ornelas','Oliveira','Ourique','Pacheco','Padilha',
'Paiva','Paraiso','Paris','Peixoto','Peralta','Peres','Pilar','Pimenta','Pinheiro','Portela','Quaresma','Quarteira','Queiroz',
'Ramires','Ramos','Rebelo','Resende','Ribeiro','Salazar','Sales','Salgado','Salgueiro','Sampaio','Sanches','Santana',
'Siqueira','Soares','Subtil','Tavares','Taveira','Teixeira','Teles','Torres','Trindade','Varela','Vargas','Vasconcelos',
'Vasques','Veiga','Veloso','Vidal','Vitorino','Vieira','Vilela','Xavier','Ximenes','Xisco','Zagalo','Zanette','Zaganelli'
	];

	public function __construct()
	{

	}
	
	/**
	* getInstance() - Instancia estatica
	*/
    public static function getInstance() {
        if (!isset(self::$instance)) {
            self::$instance = new Fake();
        }
 
        return self::$instance;
    }

	public function getNomeFake()
	{
		$idx = rand(0, sizeof($this->lstnomes)-1);
		return $this->lstnomes[$idx];
	}

	public function getSobrenomeFake()
	{
		$idx = rand(0, sizeof($this->lstsobrenomes)-1);
		return $this->lstsobrenomes[$idx];
	}

	public function getDomainFake()
	{
		$idx = rand(0, sizeof($this->lstdomains)-1);
		return $this->lstdomains[$idx];
	}

	public function getSeparadorFake()
	{
		$idx = rand(0, sizeof($this->lstseparador)-1);
		return $this->lstseparador[$idx];
	}

	public function getEmailFake() {
		$emailfake = $this->getNomeFake() 
					. $this->getSeparadorFake()
					. $this->getSobrenomeFake()
					. '@'
					. $this->getDomainFake()
					. '.com.br';
		$emailfake = strtolower($emailfake);
		$emailfake = str_replace(['çÇ'], ['cC'], $emailfake);

		return $emailfake;
	}

	public function getFakeDTO() {
		$dto = new FakeDTO();
		$dto->nome = $this->getNomeFake();
		$dto->sobrenome = $this->getSobrenomeFake();
		$dto->email = $dto->nome . $this->getSeparadorFake() . $dto->sobrenome . '@' . $this->getDomainFake() . '.com.br';		
		$dto->email = strtolower($dto->email);
		return $dto;

	}



}

?>

