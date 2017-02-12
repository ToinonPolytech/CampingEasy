<?php 
require_once("../../modele/database.class.php");
require_once("../../modele/equipe.class.php");
require_once("../../fonctions/general.php");
/**
	Cette classe permet juste de définir celle de Client et Staff, on ne l'utilisera jamais
**/
class Controller_User
{
	private $_user;
	public function __construct ($user){
		$this->_user=$user;
	}
	public function generateKey(){
		$database = new Database();
		do{
			$clef=generateRandomCharacters(6);
		}while($database->count('users', array("clef" => $clef)));
		return $clef;
	}
	public function isGood(){
		return (nomIsGood() && prenomIsGood() && codeIsGood() && droitsIsGood() && infoIdIsGood());
	}
	public function nomIsGood(){
		if(!empty($_user->getNom()))
		{
			if(preg_match("#^[a-zA-Z0-9]+{3,40}$#",$_user->getNom()))
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
		if(!empty($_user->getPrenom()))
		{
			if(preg_match("#^[a-zA-Z0-9]+{3,40}$#",$_user->getPrenom()))
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
		if(!empty($_user->getCode()))
		{
			if(preg_match("#^[0-9]+{4}$#", $_user->getCode()))
			{
					return true;
			}
			else
			{
				echo "ERREUR : le code entré n'est pas de la bonne forme (il doit contenir 4 chiffres )";
				return false;
			}
		}
		else
		{
			echo "ERREUR : le code entré est vide ";
			return false; 
		}
		
	}
		
	
	public function droitsIsGood(){
		if(!empty($_user->getDroits()))
		{
			if(preg_match("#^[0-9]+{1,255}$#", $_user->getDroits()))
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
		if(!empty($_user->getInfoId()))
		{
			if($database->count('userinfos', array("id" => $_user->getInfoId())))
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
		$etat=false;
		$droits = $_user->getDroits();
		$p=0;$n=1;
		while ($n<$droits) { $n*=2; $p++; }
		if ($n>$droits) { $p--; $n/=2; }
		for ($i=$droits;$i>0 && !$etat && $which<=$p;$n/=2){
			if ($i>$n){
				$i-=$n;
				if ($p==$which)
					$etat=true;
			}
			$p--;
		}
		return $etat;
	}
}
?>