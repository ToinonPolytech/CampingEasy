 <?php 
require_once($_SERVER['DOCUMENT_ROOT']."/includes/fonctions/general.php");
require_once(i("database.class.php"));
require_once(i("etatDesLieux.class.php"));

class Controller_EtatDesLieux{
	private $edl; 
	
	public function __construct ($edl){
		$this->edl=$edl;
	}
	
	public function isGood(){
		return ($this->userIsGood() && $this->timeIsGood() && $this->dureeIsGood());
		
		
	}
	
	public function userIsGood(){
		$db = new Database();
		
		if($db->count("users", array( 'id' => $this->edl->getIdUser()))==1)
		{
			if($db->select("users",array( 'id' => $this->edl->getIdUser()),array('access_level'))!='CLIENT')
			{
				return true;
			}
			else
			{
				echo "ERREUR : vous ne pouvez pas assigner un client aux états des lieux ";
			}
		}
		else
		{
			echo "L'employé selectionné n'existe pas";
		}
		return false; 
	}
	
	public function timeIsGood(){
		
		if(!empty($this->edl->getDebutTime()) && !empty($this->edl->getFinTime()))
			
		{	if(is_numeric($this->edl->getDebutTime()) && is_numeric($this->edl->getFinTime()))
			{
				
				if($this->edl->getDebutTime()<$this->edl->getFinTime())
				{	
					if(($this->edl->getFinTime()-$this->edl->getDebutTime())<84600)
					{
						return true; 
					}
					else
					{
						echo "ERREUR : votre état des lieux dure plus de 24h, vous exploitez vos employés !"; 
					}
				}
				else 
				{
					echo "ERREUR : la date de début d'état des lieux se situe avant celle de fin";
				}
			}
			else
			{
				echo "ERREUR : la date de début ou de fin n'est pas du bon format";
			}
		}
		else
		{
			echo "ERREUR : les dates de début et/ou de fin sont manquantes";
		}
		return false;
	}
	
	public function dureeIsGood(){
		
		if(!empty($this->edl->getDureeMoyenne()))
		{
			if(is_numeric($this->edl->getDureeMoyenne()))
			{	
				if($this->edl->getDureeMoyenne()>0 && $this->edl->getDureeMoyenne()<120)
				{
					return true; 
				}
				else
				{
					echo "ERREUR : ".$this->edl->getDureeMoyenne()." min semble peut probable pour une durée d'état des lieux"; 
				}
			}
			else
			{
				echo "ERREUR : le temps donnée pour un état des lieux n'est pas un nombre ";
			}
			
		}
		else
		{
			echo "ERREUR : aucune durée d'état des lieux entrée"; 
		}
		return false; 
		
		
	}
	
}
		