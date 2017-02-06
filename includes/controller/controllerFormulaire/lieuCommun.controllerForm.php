<?php 

//controller de vérification des données entrées lors de la création d'un lieu commun via un formulaire 
require("../../modele/database.class.php");



 $nom = htmlspecialchars ($_POST['nom']);
 $description = htmlspecialchars ($POST['description']);
 
 function envoiForm($nom,$description ){
 
	if(nomIsGood($nom) && descriptionIsGood($description){
	 
	 //appel création objet lieu commun 
	}
 }

 function nomIsGood($nom){
	 
	 if(!empty($nom))
		{
			if((strlen($nom)<40) && strlen($nom)>3)
			{
			return true;
			}
			else 
			{
				echo 'ERREUR : Le nom doit contenir entre 3 et 40 caractères';
				return false;
			}
		else
		{
			echo 'ERREUR : Le nom du lieu crée est vide';
			return false; 
		}
		
				
		}
	 
 }
 
 
 function descriptionIsGood($description){
	if(!empty($description))
		{
			if(strlen($description)=<500))
			{
				return true;
			}
			else
			{
				echo 'ERREUR : La description de l activité peut contenir au maximum 500 caractères';
				return false;
			}
		}
		else
		{
			echo 'ERREUR : La description de l activite est vide';
			return false;
		}
		
		
	} 
	 
	 
	 
	 
 
 








?>