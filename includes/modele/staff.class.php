<?php 
require_once("database.class.php");
require_once("user.class.php");

class Staff extends User
{
	/**
		Ici les fonctions que seul les membres de l'équipe pourront utiliser
		On définira des enfants à cette classe
		Voici des exemples :
			- function createUser();
			- function addPoints($idUser, $points);
	**/
}
?>