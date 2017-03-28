<?php

require_once($_SERVER['DOCUMENT_ROOT']."/includes/fonctions/general.php");
require_once(i("database.class.php"));
require_once(i("lieuCommun.class.php"));



class Controller_LieuCommun {

	private $LC; 
	
	public function __construct ($LC){
		$this->LC=$LC;
	}
	public function isGood(){
		return ($this->nomIsGood() && $this->descriptionIsGood() && $this->estReservableIsGood() && $this->heureReservableIsGood());
	}
	public function nomIsGood(){
		if(!empty($this->LC->getNom()))
		{
			if((strlen($this->LC->getNom())<40) && strlen($this->LC->getNom())>3)
			{
				return true;
			}
			else 
			{
				echo 'ERREUR : Le nom doit contenir entre 3 et 40 caractères';
				return false;
			}
		}
		else
		{
			echo 'ERREUR : Le nom du lieu crée est vide';
			return false; 
		}	
	}
	public function descriptionIsGood(){
	if(!empty($this->LC->getDescription()))
		{
			if(strlen($this->LC->getDescription())<=500)
			{
				return true;
			}
			else
			{
				echo 'ERREUR : La description du lieu peut contenir au maximum 500 caractères';
				return false;
			}
		}
		else
		{
			echo 'ERREUR : La description du lieu est vide';
			return false;
		}
	} 	
	public function estReservableIsGood(){
		if (is_bool($this->LC->getEstReservable()))
			return true;
		
		echo 'ERREUR : Le type de réservation est erroné.';
		return false;
	}
	public function heureReservableIsGood{
		$temp=@unserialize($this->LC->getHeureReservable()); // @ pour masquer le warning en cas d'erreur
		$returnValue=false;
		if (is_array($temp))
		{
			$returnValue=true;
			for ($i=0;$i<7;$i++)
			{
				for ($j=0;$j<48;$j++)
				{
					if (!isset($temp[$i][$j]) || !is_bool($temp[$i][$j]))
					{
						$returnValue=false;
					}
				}
			}
		}
		if (!$returnValue)
			echo 'ERREUR : Les heures de réservation sont erronées.';
		
		return $returnValue;
	}
}
?>
