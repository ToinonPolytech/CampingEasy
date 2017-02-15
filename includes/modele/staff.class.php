<?php 
require_once("database.class.php");
require_once("user.class.php");

class Staff extends User
{
	
	
	public function saveToDb(){
		parent::saveToDb();
	}
	
	/**
		Ici les fonctions que seul les membres de l'équipe pourront utiliser
		On définira des enfants à cette classe
		Voici des exemples :
			- public function createUser();
			- public function addPoints($idUser, $points);
	**/
}
?>