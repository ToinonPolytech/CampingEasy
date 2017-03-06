<?php 
require_once($_SERVER['DOCUMENT_ROOT']."/includes/fonctions/general.php");
require_once(i("database.class.php"));
require_once(i("partenaire.class.php"));



class Controller_Partenaire
{
	private $partenaire;
	public function __construct ($partenaire){
		$this->partenaire=$partenaire;
	}
	
	public function isGood(){
		return ($this->nomIsGood() && $this->libelleIsGood() && $this->mailIsGood() && $this->siteWebIsGood() && $this->telephoneIsGood());
	}
	
	
	public function nomIsGood(){
	
	
	if(!empty($this->partenaire->getNom()))
		{
			if((strlen($this->partenaire->getNom())<40) &&
		strlen($this->partenaire->getNom())>3)
			{
			return true;
			}
			else 
			{
				echo 'ERREUR : Le nom doit du partenaire contenir entre 3 et 40 caractères';
				
			}
		}
		else
		{
			echo 'ERREUR : Le nom du partenaire est vide';
			
		}
		
		return false; 		
		
	
		
	}
	public function libelleIsGood(){
		
		if(!empty($this->partenaire->getLibelle()))
		{
			if((strlen($this->partenaire->getLibelle())>=20) && strlen($this->partenaire->getLibelle())<=300)
			{
				return true;
			}
			else
			{
				echo 'ERREUR : Le descriptif du partenaire doit contenir entre 20 et 300 caractères';
				
			}
		}
		else
		{
			echo 'ERREUR : Le libelle de du partenaire est vide';
			
		}
		return false;
		
		
	}
	public function mailIsGood(){
		if(!empty($this->partenaire->getMail()))
		{
			if(preg_match("#^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$#", $this->partenaire->getMail())) //format voulu du mail en regexp
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
	public function siteWebIsGood(){
		
		if(empty($this->partenaire->getSiteWeb()))
		{
			$siteWeb= NULL; 
			return true;
		}
		else
		{
			
			if(preg_match("#^http://[a-z0-9._/-]+$#", $this->partenaire->getSiteWeb()))
			{
				return true;
			}
			else
			{
				echo "ERREUR : le site web n'a pas le bon format ";
				
			}
			return false;
		}
	}
		
	
	
	
	
	
	public function telephoneIsGood(){
		if(empty($this->partenaire->getTelephone()))
		{
			$this->partenaire->setTelephone(NULL); 
			return true;
		}
		else
		{
			if(preg_match("#^0[1-68]([-. ]?[0-9]{2}){4}$#", $this->partenaire->getTelephone()))
			{
				return true;
			}
			else
			{
				echo "ERREUR : le numéro de téléphone n'a pas le bon format ";
				
			}
		}	
	}
	
}
?>
