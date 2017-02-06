<?php 
//controller des données passées par le formulaire pour la création ou modification d'une réservation 
require("../../modele/database.class.php");


$idAct = htmlspecialchars ($_POST['idActivite']);// TODO : reçoit l'heure en JJ/MM/AAAA HH:MN : doit être transformée en secondes ou gérées autrement 
  $idUser = htmlspecialchars ($_POST['idUser']);
  $idEquipe = htmlspecialchars ($_POST['idEquipe']);
  $nbPers = htmlspecialchars ($_POST['nbrPersonne']);
 
  
  
function envoiForm($idAct,$idUser,$idEquipe,$nbPers,$deleted)
{
	if(idActIsGood($idAct) && idUserIsGood($idUser) && idEquipeIsGood($idEquipeIsGood) && nbrPersIsGood($nbPers){
		//création de l'objet 
	}
	
}
  
function idActivitesIsGood($idAct){
	$database=new Database();
	if (!empty($idAct))
	{	if($database->count('activities', array("id" => $idAct))==1)
		{
			return true;
		}
		else 
		{
			echo "ERREUR : l'activité que vous cherchez à réserver n'existe pas ";
			return false; 
		}
		
		
	}
	else
	{
		echo "ERREUR : il n'y a pas d'activité sélectionnée ";
		return false; 
	}
	
	
	
	
}
	function idUserIsGood($idUser){
		$database=new Database();
	if (!empty($idUser))
	{	if($database->count('user', array("id" => $idUser))==1)
		{
			return true;
		}
		else 
		{
			echo "ERREUR : l'utilisateur cherchant à réserver n'est pas dans la base de données ";
			return false; 
		}
		
		
	}
	else
	{
		echo "ERREUR : l'utilisateur n'est pas connecté ou n'est pas été entré dans le formulaire  ";
		return false; 
	}
		
	}
	
	function idEquipeIsGood($idEquipe){
		$database=new Database();
	if (isset($idEquipe))
	{	if(empty($idEquipe)
		{
			$idEquipe=NULL; 
			return true;
		}
		else
		{
				if($database->count('equipe', array("id" => $idEquipe))==1)
				{
					return true;
				}
				else 
				{
					echo "ERREUR : l'équipe sélectionnée n'existe pas  ";
					return false; 
				}	
		
		}
	}
	else
	{
		echo "ERREUR : aucune équipe n'a été passée en paramètre ";
		return false; 
	}
	function nbrPersonneIsGood($nbPers){
		if(isset($nbPers))
		{	
			if(is_int($nbPers))
			{
				
				if($nbPers<15 && $nbPers>0)
				{
				return true; 	
				}
				else
				{
					echo "ERREUR : le nombre de personnes pour la réservation doit être compris entre 1 et 14";
					return false;
				}
			}
			
			else 
			{
				echo "ERREUR : le nombre de personnes entré pour la réservation n'est un entier";
				return false; 
			}
		}
		else 
		{
			echo "ERREUR : le nombre de personnes n'est pas passé en paramètre ";
			return false; 
		}
		
	}
?> 