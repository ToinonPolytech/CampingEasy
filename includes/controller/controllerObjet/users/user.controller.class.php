<?php 
require_once($_SERVER['DOCUMENT_ROOT']."/includes/fonctions/general.php");
require_once(i("database.class.php"));
require_once(i("equipe.class.php"));

class Controller_User
{
	protected $_user;
	protected $_withInfoId;
	public function __construct ($user, $withInfoId=true){
		$this->_user=$user;
		$this->_withInfoId=$withInfoId;
	}
	public function generateKey(){
		$database = new Database();
		do{
			$clef=generateRandomCharacters(6);
		}while($database->count('users', array("clef" => $clef)));
		return $clef;
	}
	public function isGood(){
		return ($this->nomIsGood() && $this->prenomIsGood() && $this->codeIsGood() && $this->droitsIsGood() && (!$this->_withInfoId || $this->infoIdIsGood()));
	}
	public function nomIsGood(){
		if(!empty($this->_user->getNom()))
		{
			if(preg_match("#[a-zA-Z0-9]{3,40}#",$this->_user->getNom()))
			{
					return true;
			}
			else
			{
				echo "ERREUR : le nom de l'utilisateur n'est pas de la bonne forme (doit être compris entre 3 et 40 caractères)";
				return false;
			}
		}
		else
		{
			echo "ERREUR : le nom de l'utilisateur est vide ";
			return false; 
		}
		
	}
	
	public function prenomIsGood(){
		if(!empty($this->_user->getPrenom()))
		{
			if(preg_match("#^[a-zA-Z0-9]{3,40}$#",$this->_user->getPrenom()))
			{
					return true;
			}
			else
			{
				echo "ERREUR : le prénom de l'utilisateur n'est pas de la bonne forme (doit être compris entre 3 et 40 caractères)";
				return false;
			}
		}
		else
		{
			echo "ERREUR : le prénom de l'utilisateur est vide ";
			return false; 
		}
		
	}
	
	public function codeIsGood(){
		if(preg_match("#^[0-9]{4}$#", $this->_user->getCode()) || $this->_user->getCode()==NULL)
		{
				return true;
		}
		else
		{
			echo "ERREUR : le code entré n'est pas de la bonne forme (il doit contenir 4 chiffres )";
			return false;
		}
	}
		
	
	public function droitsIsGood(){
		if(!empty($this->_user->getDroits()))
		{
			if(preg_match("#^[0-9]{1,255}$#", $this->_user->getDroits()))
			{
					return true;
			}
			else
			{
				echo "ERREUR : les droits n'ont pas le bon format ";
				return false;
			}
		}
		else
		{
			echo "ERREUR : aucun droit entré ";
			return false; 
		}
		
	}
		
	
	public function infoIdIsGood(){
		$database = new Database();
		if(!empty($this->_user->getUserInfos()->getId()))
		{
			if($database->count('userinfos', array("id" => $this->_user->getUserInfos()->getId())))
			{
				return true;
			}
			else
			{
				echo "ERREUR : les infos de l'utilisateur n'existent pas  ";
				return false;
			}
		}
		else
		{
			echo "ERREUR : aucun id correspondant aux infos de l'utilisateur n'ont été entrées  ";
			return false; 
		}
	}
	/**
		Exemple : can(CAN_CREATE_SUBACCOUNT); grâce au fichier config.php cela donne la puissance adéquate et tout est géré automatiquement.
	**/
	public function can($which){
		global $puissance;
		$etat=false;
		$droits = $this->_user->getDroits();
		$array=array();
		for ($i=0;$i<$puissance;$i++)
		{
			$array[$i]=pow(2,$i);
		}
		for ($i=$puissance-1;$i>=0 && !$etat && $droits>0;$i--)
		{
			if ($droits>=$array[$i])
			{
				if ($i==$which)
					$etat=true;
				
				$droits-=$array[$i];
			}
		}
		return $etat;
	}
}
?>