 <?php 
require_once($_SERVER['DOCUMENT_ROOT']."/includes/fonctions/general.php");
require_once(i("database.class.php"));

class EtatDesLieux
{	private $_id; 
	private $_idUser;
	private $_debutTime;
	private $_finTime;
	private $_duree_moyenne;	
	private $_deleted;
	
	public function __construct($id, $idUser=NULL, $debutTime=NULL, $duree_moyenne=NULL){
		$this->_id=$id;
		if ($id==NULL)
		{
			$this->_idUser=$idUser;
			$this->_debutTime=$debutTime;
			$this->_finTime=0;
			$this->_duree_moyenne=$duree_moyenne;
					
		}
		else
		{
			$database = new Database();
			$database->select('etat_lieux', array("id" => $id));
			$data=$database->fetch();
			$this->_idUser=$data["idUser"];
			$this->_debutTime=$data["debutTime"];
			$this->_finTime=$data["finTime"];
			$this->_duree_moyenne=$data["duree_moyenne"];
			
			
		}
		$this->_deleted=false;
	}

	public function saveToDb(){
		$database = new Database();
		if ($this->_deleted)
		{
			$database->delete('etat_lieux', array("id" => $this->_id));
		}	
		else if ($this->_id!=NULL && $database->count('etat_lieux', array("id" => $this->_id))) // Existe en db, on update
		{
			$database->update('etat_lieux', array("id" => $this->_id), array("idUser" => $this->_idUser, "debutTime" => $this->_debutTime, "finTime" => $this->_finTime, "duree_moyenne" => $this->_duree_moyenne);
		}
		else
		{
			$database->create('etat_lieux', array("clef" => $this->_clef, "id" => $this->_id, "idUser" => $this->_idUser, "debutTime" => $this->_debutTime, "finTime" => $this->_finTime, "duree_moyenne" => $this->_duree_moyenne));
			$this->_id=$database->lastInsertId(); // Ca marche ca ?
		}
	}
	
	
	public function getId(){
		return $this->_id;
	}
	public function getIdUser(){
		return $this->_idUser;
	}
	public function getDebutTime(){
		return $this->_debutTime;
	}
	public function getFinTime(){
		return $this->_finTime;
	}
	public function getDureeMoyenne(){
		return $this->_duree_moyenne;
	}
		
	public function getDeleted(){
		return $this->_deleted;
	}
	public function setId($id){
		$this->_id=$id;
	}
	public function setIdUser($idUser){
		$this->_idUser=$idUser;
	}
	public function setDebutTime($debutTime){
		$this->_debutTime=$debutTime;
	}
	public function setFinTime($finTime){
		$this->_finTime=$finTime;
	}
	public function setDureeMoyenne($duree_moyenne){
		$this->_duree_moyenne=$duree_moyenne;
	}
		
	public function setDeleted($deleted){
		$this->_deleted=$deleted;
	}
}

?> 