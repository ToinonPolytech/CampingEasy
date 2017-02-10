<?php 

//controller des données passées en formulaire pour le type activité 
require("../controllerObjet/activite.controller.class.php");
require("../../modele/database.class.php");

  $timeStart = htmlspecialchars ($_POST['timeStart']);// TODO : reçoit l'heure en JJ/MM/AAAA HH:MN : doit être transformée en secondes ou gérées autrement 
  $duree = htmlspecialchars ($_POST['duree']);
  $nom = htmlspecialchars ($_POST['nom']);
  $descriptif = htmlspecialchars ($_POST['descriptif']);
  $ageMin = htmlspecialchars ($_POST['ageMin']);
  $ageMax = htmlspecialchars ($_POST['ageMax']);
  $idLieu = htmlspecialchars ($_POST['idLieu']);
  $lieu = htmlspecialchars ($_POST['lieu']);
  //reçoit le nom d'un type de la base de données : l'ajout d'un type à celle-ci se fait dans un formulaire sur la même page mais à part entière 
  $type = htmlspecialchars ($_POST['type']);
  $placesLim = htmlspecialchars ($_POST['placesLim']);
  $prix = htmlspecialchars ($_POST['prix']);
  $idOwner = htmlspecialchars ($_POST['idOwner']); //reçu en variable session 
  $points = htmlspecialchars ($_POST['points']);
 
  
if(isset($timeStart) && isset($duree) && isset($nom) && isset($descriptif) 
	&& isset($ageMin) && isset($ageMax) && isset($idLieu) && isset($lieu) 
&& isset($type) && isset($placesLim) && isset($prix) && isset($udOwner) &&
isset($points)){

	$act = new Activite($timeStart, $nom, $descriptif, $duree, $ageMin, $ageMax, $lieu,$idLieu, $type, $placesLim, $prix, $idOwner, $points);
	
	if($act->isGood()){
			
	$act->saveToDb();
	}
	
}







?>
