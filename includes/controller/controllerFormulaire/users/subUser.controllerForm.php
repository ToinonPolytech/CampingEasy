<?php
	if (!isset($_SESSION)) // Pour gérer les appels dynamiques
		session_start();
 
 
	require_once($_SERVER['DOCUMENT_ROOT']."/includes/fonctions/general.php");
	require_once(i("user.controller.class.php"));
	require_once(i("client.class.php"));
	require_once(i("client.controller.class.php"));
	require_once(i("database.class.php"));
	
	$clientParent=new Client($_SESSION["id"]);
	$controller=new Controller_Client($clientParent);
	if (!$controller->can(CAN_CREATE_SUBACCOUNT)) // on ne peut pas créer de sous comptes, donc on dégage
	{
		echo "Vous n'avez pas les droits suffisants.";
		exit();
	}
	
	if(isset($_POST['nom']) && isset($_POST['prenom']))
	{
		$db = new Database();
		$infoID= $db->getValue('users',array('id' => $_SESSION['id']), 'infoId');

		$sousClient = new Client(NULL,$infoID, "CLIENT", NULL, htmlspecialchars($_POST['nom']), htmlspecialchars($_POST['prenom'])); 
		$controllerSousClient = new Controller_Client($sousClient); 

		
		$sousClient->addDroits(CAN_LOG);
		if(isset($_POST['creerSousCompte']) && $_POST['creerSousCompte']=="true")
		{		
		  $sousClient->addDroits(CAN_CREATE_SUBACCOUNT);
		}
		if(isset($_POST['reserverActivite']) && $_POST['reserverActivite']=="true")
		{ 
		  $sousClient->addDroits(CAN_JOIN_ACTIVITIES);
		}
		if(isset($_POST['creerActivite']) && $_POST['creerActivite']=="true")
		{
		  $sousClient->addDroits(CAN_CREATE_ACTIVITIES);
		}
		if(isset($_POST['payer']) && $_POST['payer']=="true")
		{
		  $sousClient->addDroits(CAN_PAY);
		}
		if($controllerSousClient->isGood())
		{
			if (isset($_POST["id"]))
			{
				$clientChild=new Client($_POST["id"]);
				$sousClient->setId($_POST["id"]); // saveToDb va comprendre qu'il faut UPDATE
				$sousClient->setClef($db->getValue("users", array("id" => $_POST["id"]), "clef"));
				if (!$controller->canEdit($clientChild))
				{
					echo "Une erreur s'est produite lors de l'envoi du formulaire";
					exit();
				}
				 echo "Le sous compte a bien été modifié "; 
			}
			else
			{
				$sousClient->setClef($controllerSousClient->generateKey());
				echo "Le sous compte a bien été enregistré "; 
			}
			$sousClient->saveToDb(); 
		}
	}
	else
	{
		echo "Une erreur s'est produite lors de l'envoi du formulaire";
	}
 
 
 
 
 
 
 
 
 
 ?> 
 