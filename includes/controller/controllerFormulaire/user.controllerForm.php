<?php 
//controller du formulaire de création ou de modification d'un utilisateur 
require_once("../../modele/user.class.php");
require_once("../../modele/user.controller.class.php");


	$accessLevel = htmlspecialchars($_POST['accessLevel']);

if(isset($_POST['nom']) && isset($_POST['prenom']) && isset($_POST['droits']) && isset($_POST['infoID']) && isset($_POST['accessLevel']){
	
	if($access_level == "client" ){
		$client = new Client(NULL, htmlspecialchars($_POST['infoID']),htmlspecialchars($_POST['accessLevel']) , htmlspecialchars($_POST['droits'])
		, htmlspecialchars($_POST['nom']), htmlspecialchars($_POST['prenom']));
		$controllerClient = new Controller_Client($client);
		if($controllerClient->isGood()){
				$client->saveToDb(); 
			}
	}
	else 
	{
		if($access_level == "ANIMATEUR" || $access_level == "PATRON" || $access_level == "TECHNICIEN"){
			$staff = new Staff(NULL, htmlspecialchars($_POST['infoID']),htmlspecialchars($_POST['accessLevel']) , htmlspecialchars($_POST['droits'])
		, htmlspecialchars($_POST['nom']), htmlspecialchars($_POST['prenom']));;
		$controllerStaff = new Controller_Staff($staff);
			if($controllerStaff->isGood()){
				$staff->saveToDb(); 
			}
			
		}
	}
	
	
}

?> 