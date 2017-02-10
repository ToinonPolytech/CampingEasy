<?php 
//controller des données passées par formulaire pour la création d'un partenaire 


$nom = htmlspecialchars ($_POST['nom']);
  $libelle = htmlspecialchars ($_POST['libelle']);
  $mail = htmlspecialchars ($_POST['mail']);
  $siteWeb = htmlspecialchars ($_POST['siteWeb']);
  $telephone = htmlspecialchars ($_POST['telephone']);
  
 
if(isset($nom) && isset($libelle) && isset($mail) && isset($siteWeb) && isset($telephone)){
	
	$partenaire = new Partenaire($nom, $description, $mail, $url, $telephone);
	if($partenaire->isGood()){
	$partenaire->saveToDb();
	
	}
	
}




?>