<?php 

//controller de vérification des données lors de la création ou modification d'un problème technique via un formulaire


require("../../modele/database.class.php");

	$idUser = htmlspecialchars ($_POST['idUser']);
  $timeCreated = htmlspecialchars ($_POST['timeCreated']); //temps reçu en string 
  $timeEstimated = htmlspecialchars ($_POST['timeEstimated']); //temps reçu en string 
  $description = htmlspecialchars ($_POST['description']);
  $isBungalow = htmlspecialchars ($_POST['isBungalow']);
  $solved = htmlspecialchars ($_POST['solved']);
  
  
  
  


if(isset($idUser) && isset($timeCreated) && isset($timeEstimated) && isset($description) && isset($isBungalow) && isset($solved)){
	//conversion des dates en secondes écoulées depuis le 1er janvier 1970 
 $timeSecCreated = strtotime($timeCreated) ; 
 $timeSecEstimated = strtotime($timeEstimated);
 
 $pbTech = new PbTech($idUsers, $timeSecCreated, $timeSecEstimated, $description, $isBungalow, $solved);
 
 if($pbTech->isGood()){	 
	
	$pbTech->saveToDb();
 }
	
}
	
	


?> 