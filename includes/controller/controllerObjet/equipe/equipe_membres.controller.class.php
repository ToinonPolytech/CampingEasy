  <?php 
require_once($_SERVER['DOCUMENT_ROOT']."/includes/fonctions/general.php");
require_once(i("database.class.php"));
require_once(i("equipe.class.php"));

class Controller_Equipe_Membres
{
	private $_equipe_membres;
	public function __construct ($equipe_membres){
		$this->_em=$equipe_membres;
	}
	public function isGood(){
		return ($this->userIsGood() && $this->equipeIsGood());
	}
	public function userIsGood(){
		$db = new Database();
		
		if($db->count("users", array( 'id' => $this->_em->getUser()))==1)
		{
			return true; 
		}
		else
		{
			echo "L'utilisateur n'existe pas";
		}
		return false; 
	}
	
	public function equipeIsGood(){
		$db = new Database();
		echo "equipe".$this->_em->getEquipe();
		if($db->count("equipe", array( 'id' => $this->_em->getEquipe()))==1)
		{
			return true; 
		}
		else
		{
			echo "L'equipe n'existe pas";
		}
		return false;
		
		
	}
}
?>