<?php 
require_once("../../modele/database.class.php");
require_once("../../modele/partenaire.class.php");



class Controller_Partenaire
{
	private $partenaire;
	public function __construct ($partenaire){
		$this->partenaire=$partenaire;
	}
	
	public function isGood(){
		return (nomIsGood() && libelleIsGood() && mailIsGood() && siteWebIsGood() && telephoneIsGood());
	}
	
	
	public function nomIsGood(){
	
	
	if(!empty($partenaire->getNom()))
		{
			if((strlen($partenaire->getNom())<40) &&
		strlen($partenaire->getNom())>3)
			{
			return true;
			}
			else 
			{
				echo 'ERREUR : Le nom doit du partenaire contenir entre 3 et 40 caractères';
				return false;
			}
		else
		{
			echo 'ERREUR : Le nom du partenaire est vide';
			return false; 
		}
		
				
		}
	
		
	}
	public function libelleIsGood(){
		
		if(!empty($partenaire->getLibelle()))
		{
			if((strlen($partenaire->getLibelle())>=20) && strlen($partenaire->getLibelle())=<300))
			{
				return true;
			}
			else
			{
				echo 'ERREUR : Le descriptif du partenaire doit contenir entre 20 et 300 caractères';
				return false;
			}
		}
		else
		{
			echo 'ERREUR : Le libelle de du partenaire est vide';
			return false;
		}
		
		
	}
	public function mailIsGood(){
		if(!empty($partenaire->getMail()))
		{
			if(preg_match("#^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$#", $partenaire->getMail())) //format voulu du mail en regexp
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
			echo "ERREUR : le mail n'est n'est pas passé en paramètre "
		}
		return false;
	}
	public function siteWebIsGood(){
		if(isset($partenaire->getSiteWeb()))
		{
			if(empty($partenaire->getSiteWeb()))
			{
				$siteWeb= NULL; 
			}
			if(preg_match("#^http://[a-z0-9._/-]+$#", $partenaire->getSiteWeb()))
			{
				return true;
			}
			else
			{
				echo "ERREUR : le site web n'a pas le bon format ";
				return false;
			}
		}
		else 
		{
			echo "ERREUR : le site web n'est pas passé en paramètre  ";
			return false; 
		}
		
	}
	
	
	
	
	public function telephoneIsGood(){
		if(isset($partenaire->getTelephone()))
		{
			if(empty($partenaire->getTelephone()))
			{
				$partenaire->getTelephone()= NULL; 
			}
			if(preg_match("#^0[1-68]([-. ]?[0-9]{2}){4}$#", $partenaire->getTelephone()))
			{
				return true;
			}
			else
			{
				echo "ERREUR : le numéro de téléphone n'a pas le bon format ";
				return false;
			}
		}
		else 
		{
			echo "ERREUR : le numero de téléphone  n'est pas passé en paramètre  ";
			return false; 
		}
		
	}
}
?>
