<?php 

class Controller_UserInfo
{
	private $_user;
	public function __construct ($userInfo){
		$this->userInfo=$userInfo;
	}
	
	public function isGood(){
		return ($this->numPlaceIsGood() && $this->emailIsGood() && $this->soldeIsGood() && $this->time_departIsGood() && $this->clefIsGood());
	}
	
	public function numPlaceIsGood(){
		if(!empty($this->userInfo->getEmplacement())){
			return true; 
			
			
		}
		else
		{
			echo "ERREUR : l'emplacement est vide  ";
			
		}
		
		return false; 
		
		
		
	}
	
	public function emailIsGood(){
		if(!empty($this->userInfo->getEmail()))
		{
			if(true /*preg_match("#^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$#", $this->userInfo->getEmail())*/) //format du mail 
			{
				return true;
			}
			else 
			{
				echo "ERREUR : le format du mail n'est pas correct";
			}
		}
		else
		{
			echo "ERREUR : le mail n'est n'est pas passé en paramètre ";
		}
		return false;
	}
		
	
	public function soldeIsGood(){
		if(!empty($this->userInfo->getSolde()) || $this->userInfo->getSolde()==0)
		{
			if(is_numeric($this->userInfo->getSolde()))
			{
				if($this->userInfo->getSolde()>=0)
				{
					return true;
				}
				else
				{
					echo "ERREUR : le solde doit être positif ";
				}
			}
			else
			{
				echo "ERREUR : le solde n'est pas un nombre ";
			}
			
			
		}
		else
		{
			echo "ERREUR : le solde est vide  ";
		}
		return false; 
		
	}
	
	public function time_departIsGood(){
		if(!empty($this->userInfo->getTimeDepart()))
		{
			if ($this->userInfo->getTimeDepart()>time())
			{
				return true;
			}
			else 
			{
				echo "ERREUR : la date de départ ne peut précéder la date actuelle ";
			}
		}
		else
		{
			echo "ERREUR : la date de départ est vide  ";
		}
		return false; 
	}
	
	public function clefIsGood(){
		if ($this->userInfo->getClef()!=NULL)
			return true;

		echo "ERREUR : la clef ne peut être vide  ";
		return false;
	}
}
?> 