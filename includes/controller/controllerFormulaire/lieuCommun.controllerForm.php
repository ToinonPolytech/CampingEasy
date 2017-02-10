<?php 

//controller de vérification des données entrées lors de la création d'un lieu commun via un formulaire 
require("../../modele/database.class.php");
require("../controllerObjet/lieuCommun.controller.class.php");


 $nom = htmlspecialchars ($_POST['nom']);
 $description = htmlspecialchars ($POST['description']);
 
 
if(isset($nom) && isset($description)){
	
	$LC = new lieuCommun($nom, $description);
	$LC->saveToDb();
	
	
}	 
	 
	 
	 
 
 








?>