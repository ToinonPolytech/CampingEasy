 <?php
 
 
 
 
 if(isset($_POST['nom']) && isset($_POST['prenom']))
 {
	  require_once("../controllerObjet/user.controller.class.php");
	  require_once("../../modele/database.class.php");
	  $db = new Database();
	  $infoID= $db->getValue('users',array('id' => $_SESSION['id']), 'infoId');
	  
	  $sousClient = new Client(NULL,$infoID, "CLIENT", NULL, htmlspecialchars($_POST['nom']), htmlspecialchars($_POST['nom'])); 
	  $controllerSousClient = new Controller_Client($sousClient); 
	  
	  $sousClient->setClef($controllerSousClient->generateKey());
	  
	  if(isset($POST['creerSousCompte']))
	  {
		  $sousClient->addDroit("CAN_CREATE_SUBACCOUNT");
	  }
	  if(isset($POST['reserverActivite']))
	  {
		  $sousClient->addDroit("CAN_JOIN_ACTIVITIES");
	  }
	  if(isset($POST['creerActivite']))
	  {
		  $sousClient->addDroit("CAN_CREATE_ACTIVITIE");
	  }
	  if(isset($POST['payer']))
	  {
		  $sousClient->addDroit("CAN_PAY");
	  }
	  
	  if($controllerClient->isGood())
	  {
		  $client->saveToDb(); 
		  echo "Le sous compte a bien été ajouté "; 
	  }
 }
else
{
	echo "Une erreur s'est produite lors de l'envoi du formulaire";
}
 
 
 
 
 
 
 
 
 
 ?> 
 