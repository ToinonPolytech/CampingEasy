<?php 
require_once($_SERVER['DOCUMENT_ROOT']."/includes/fonctions/general.php");
require_once(i("activities.class.php"));
require_once(i("activite.controller.class.php"));
if (!isset($_SESSION)) // Pour gérer les appels dynamiques
		session_start();

if (isset($_POST["timeStart"]) && isset($_POST["duree"]) && isset($_POST["nom"]) && isset($_POST["descriptif"]) 
&& isset($_POST["lieu"])
&& isset($_POST["placesLim"]) && isset($_POST["lieu_type"]) && isset($_POST["debutReservation"]) && isset($_POST["finReservation"]))
{	 
	if(isset($_POST["prix"]) && isset($_POST["points"]) && $_SESSION['access_level']=='CLIENT')
	{	// si le client a réussi à ajouter des points ou un prix alors erreur 
		echo "ERREUR : vous n'avez pas les droits pour ajouter une activité payante ou a points";		
	}
	else if(isset($_POST["prix"]) && isset($_POST["points"]) ||  $_SESSION['access_level']=='CLIENT') 
	{	//sinon si le prix et les points existent  ou que c'est un client on fait le taff 
		 if($_SESSION['access_level']=='CLIENT')
		 {//si client alors pas de points et de prix 
			 $points=0;
			 $prix=0; 
		 }
		 else 
		 {//sinon prix et points sont ceux passés en paramètre 
			 $points = htmlspecialchars($_POST["points"]);
			 $prix = htmlspecialchars($_POST["prix"]);
		 }		 
		$photos_path=""; // TODO
		
		$mustBeReserved = (isset($_POST["mustBeReserved"])) ? 1 : 0;
		$lieu=$_POST["lieu"];
		if (!is_numeric($_POST["lieu"]) && $_POST["lieu_type"]==1)
		{
			echo "ERREUR : Un problème est survenu lors de l'envoi du formulaire.  ";
		}
		else
		{
			if ($_POST["lieu_type"]==1)
			{
				$db = new Database();
				$lieu=$db->getValue("lieu_commun", array("id" => $_POST["lieu"]), "nom");
			}
			$type="";
			foreach ($_POST as $key => $val)
			{
				if (strstr($key, "TYPE_"))
				{
					$type.=$val." ";
				}
			}
			$act = new Activite(NULL, htmlspecialchars(strtotime($_POST["timeStart"])), htmlspecialchars($_POST["nom"]), htmlspecialchars($_POST["descriptif"]), htmlspecialchars($_POST["duree"]),
			htmlspecialchars($lieu), $type,
			htmlspecialchars($_POST["placesLim"]),$prix,$_SESSION['id'], $points,$mustBeReserved,htmlspecialchars(strtotime($_POST["debutReservation"])),htmlspecialchars(strtotime($_POST["finReservation"])),$photos_path);
			
			
			$actController = new Controller_Activite($act);	
			
			
			if($actController->isGood())
			{	if(isset($_POST['id']))
				{
					$act->setId($_POST['id']);
				}
						
				$act->saveToDb();
				echo "Activité enregistrée ";
			}
			$db = new Database();
			$idact= $db->lastInsertId(); //ne fonctionne pas
			//une fois l'activité enregistrée on s'occupe des récurrences
			if(isset($_POST['finRecurrence']) && isset($_POST['recurrence']))
				{	
					$rec=$act->getDate(); //on prend la date de l'originale 
					
						while($rec<=strtotime($_POST['finRecurrence']))//tant que la date ne dépasse pas la fin de récurrence
						{	echo date("d/m/y",$rec)."   ";
							
							if($_POST['recurrence']==1)
							{
								$rec=$rec+86400; // +1 jours 
							}
							else if($_POST['recurrence']==2)
							{
								$rec=$rec+172800; //+ 2 jours 
							}
							else if($_POST['reccurence']==7)
							{
								$rec=$rec+604800; //+7jours 
							}
							//manque + un mois à gérer
							$actR= new Activite(NULL,$rec, htmlspecialchars($_POST["nom"]), htmlspecialchars($_POST["descriptif"]), htmlspecialchars($_POST["duree"]),
							htmlspecialchars($lieu), $type,
							htmlspecialchars($_POST["placesLim"]), $prix_SESSION['id'],$points,$mustBeReserved,htmlspecialchars(strtotime($_POST["debutReservation"])),htmlspecialchars(strtotime($_POST["finReservation"])),$photos_path,$idact);
							//nouvelle récurrence créée, manque le bon idRécurrente
							$actRC = new Controller_Activite($actR);
							if($actRC->isGood())
							{
								$actR->saveToDb();
							}
							else
							{
								echo "ERREUR : impossible d'enregistrer la récurrence";
							}
							 
						}
						echo 'Recurrences enregistrées';
				}
			
		}
	}
	else 
	{
		echo "ERREUR : Un problème est survenu lors de l'envoi du formulaire.";
	}
	
}
else
{
	echo "ERREUR : Un problème est survenu lors de l'envoi du formulaire.";
}
?>
