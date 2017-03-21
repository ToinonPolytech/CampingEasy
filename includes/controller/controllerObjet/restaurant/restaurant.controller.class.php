 <?php 
require_once($_SERVER['DOCUMENT_ROOT']."/includes/fonctions/general.php");
require_once(i("database.class.php"));
require_once(i("restaurant.class.php"));

class Controller_Restaurant{
	private $resto; 
	
	public function __construct ($resto){
		$this->resto=$resto;
	}
	
	public function isGood(){
		
		
		return ($this->nomIsGood() && $this->descriptionIsGood() && $this->capaciteIsgood() && $this->heureIsGood()); 
	}
	
	public function nomIsGood(){
	
	
	if(!empty($this->resto->getNom()))
		{
			if((strlen($this->resto->getNom())<40) &&
		strlen($this->resto->getNom())>3)
			{
			return true;
			}
			else 
			{
				echo 'ERREUR : Le nom doit du resto contenir entre 3 et 40 caractères';
				
			}
		}
		else
		{
			echo 'ERREUR : Le nom du resto est vide';
			
		}
		
		return false; 		
		
	
		
	}
	public function descriptionIsGood(){
		
		if(!empty($this->resto->getDescription()))
		{
			if((strlen($this->resto->getDescription())>=20) && strlen($this->resto->getDescription())<=300)
			{
				return true;
			}
			else
			{
				echo 'ERREUR : Le descriptif du restaurant doit contenir entre 20 et 300 caractères';
				
			}
		}
		else
		{
			echo 'ERREUR : Le description  du restaurant est vide';
			
		}
		return false;
		
		
	}
	
	public function capaciteIsGood(){
		
		if(!empty($this->resto->getCapacite()))
		{
			if(is_numeric($this->resto->getCapacite()))
			{
				if($this->resto->getCapacite()>0 && $this->resto->getCapacite()<1000)
				{
					return true; 
					
				}
				else 
				{
					echo "ERREUR : ".$this->resto->getCapacite()." semble un nombre peu probable pour un restaurant";
				}
			}
			else
			{
				echo "ERREUR : la capacite entrée n'est pas un nombre ";
			}
			
		}
		else
		{
			echo "ERREUR : pas de capacite maximale entrée pour votre restaurant "; 
		}
		return false; 
		
	}
	public function heureIsGood(){
		
		if(!empty($this->resto->getHeureOuverture()))
		{
			return true; 
		}
		else 
		{
			echo "ERREUR : les horaires d'ouverture et/ou fermeture sont vides ";
		}
	}
	
}