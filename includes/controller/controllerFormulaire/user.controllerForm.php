<?php 
//controller du formulaire de création ou de modification d'un utilisateur 
require_once("../../modele/user.class.php");
require_once("../../modele/user.controller.class.php");

/***
	Il faudra revoir toute cette page. Et qu'on en discute 
**/


$nom = htmlspecialchars($_POST['nom']);
	$prenom = htmlspecialchars($_POST['prenom']); 
	$droits = htmlspecialchars($_POST['droits']); 
	$infosId = htmlspecialchars($_POST['infosId']);
	$accessLevel = htmlspecialchars($_POST['accessLevel']);

if(isset($nom) && isset($prenom) && isset($droits) && isset($infosId) && isset($accesLevel){
	//partie prototype : je ne sais pas comment on gère tout ça 
	if($access_level == "client" ){
		$client = new Client($infoId, $accessLevel, $droits, $nom, $prenom, $code);
		$client->saveToDb();
	}
	else 
	{
		if($access_level == "staff"){
			$staff = new Staff($infoId, $accessLevel, $droits, $nom, $prenom, $code);
			$staff->saveToDb(); 
			
		}
	}
	
	
}

?> 