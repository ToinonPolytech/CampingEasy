<?php 
//controller des données reçues en formulaire pour la création et modification d'une équipe


require("../../modele/equipe.controller.class.php");
require("../../modele/equipe.class.php");

	$nom = htmlspecialchars($_POST['nom']);
	$score = htmlspecialchars($_POST['score']); 

	
	
	if(isset($nom) && isset($score)){
		
		$equipe = new Equipe($nom,$score);
		$equipe->saveToDb();
		
	}

?> 
