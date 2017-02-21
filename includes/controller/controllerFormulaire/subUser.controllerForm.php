 <?php
 if (!isset($_SESSION)) // Pour gérer les appels dynamiques
		session_start();
 
 
 
 if(isset($_POST['nom']) && isset($_POST['prenom']))
 {
	  require_once("../controllerObjet/user.controller.class.php");
	  require_once("../../modele/client.class.php");
	require_once("../controllerObjet/client.controller.class.php");
	  require_once("../../modele/database.class.php");
	  $db = new Database();
	  $infoID= $db->getValue('users',array('id' => $_SESSION['id']), 'infoId');
	  
	  $sousClient = new Client(NULL,$infoID, "CLIENT", NULL, htmlspecialchars($_POST['nom']), htmlspecialchars($_POST['nom'])); 
	  $controllerSousClient = new Controller_Client($sousClient); 
	  
	  $sousClient->setClef($controllerSousClient->generateKey());
	  
	  if(isset($_POST['creerSousCompte']))
	  {		
		  $sousClient->addDroits("CAN_CREATE_SUBACCOUNT");
	  }
	  if(isset($_POST['reserverActivite']))
	  { 
		  $sousClient->addDroits("CAN_JOIN_ACTIVITIES");
	  }
	  if(isset($_POST['creerActivite']))
	  {
		  $sousClient->addDroits("CAN_CREATE_ACTIVITIES");
	  }
	  if(isset($_POST['payer']))
	  {
		  $sousClient->addDroits("CAN_PAY");
	  }
	  
	  if($controllerSousClient->isGood())
	  {
		  $sousClient->saveToDb(); 
		  echo "Le sous compte a bien été ajouté "; 
	  }
 }
else
{
	echo "Une erreur s'est produite lors de l'envoi du formulaire";
}
 
 
 
 
 
 
 
 
 
 ?> 
 