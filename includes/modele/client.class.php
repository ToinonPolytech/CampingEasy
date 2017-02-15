<?php 
require_once("database.class.php");
require_once("user.class.php");

class Client extends User
{
	
	
	public function saveToDb(){
		parent::saveToDb();
	}
	
	/**
		On pourra définir des fonctions réservées uniquement au client si il y a
	**/
}
?>