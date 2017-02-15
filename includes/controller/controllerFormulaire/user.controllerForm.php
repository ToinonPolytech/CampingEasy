<?php 
//controller du formulaire de création ou de modification d'un utilisateur 
if(isset($_POST['nom']) && isset($_POST['prenom']) && isset($_POST['numPlace']) && isset($_POST['email']) && isset($_POST['date']) && isset($_POST['type']))
{
	require_once("../controllerObjet/userInfos.controller.class.php");
	if ($_POST['type']=="CLIENT")
	{
		require_once("../../modele/client.class.php");
		require_once("../controllerObjet/client.controller.class.php");
		$user = new Client(NULL, NULL, $_POST['type'], $droits, $_POST['nom'], $_POST['prenom'], NULL);
		$controllerUser = new Controller_Client($user);
		$clef = $controllerUser->generateKey();
		$userInfos = new UserInfo(NULL, $_POST['numPlace'], $_POST['email'], $_POST['date'], $clef);
		$user->setUserInfos($userInfos);
		$user->setClef($clef);
		$controllerUser = new Controller_Client($user); // On met à jour notre controller
		$controllerUserInfo = new Controller_UserInfo($userInfos);
		if ($controllerUserInfo->isGood() && $controllerUser->isGood())
		{
			$userInfos->saveToDb();
			$user->saveToDb();
		}
		else
		{
			
		}
	}
	else
	{
		require_once("../../modele/staff.class.php");
		require_once("../controllerObjet/staff.controller.class.php");
		$user = new Staff(NULL, NULL, $_POST['type'], $droits, $_POST['nom'], $_POST['prenom'], NULL);
		$controllerUser = new Controller_Staff($user);
		$clef = $controllerUser->generateKey();
		$userInfos = new UserInfo(NULL, $_POST['numPlace'], $_POST['email'], $_POST['date'], $clef);
		$user->setUserInfos($userInfos);
		$user->setClef($clef);
		$controllerUser = new Controller_Staff($user); // On met à jour notre controller
		$controllerUserInfo = new Controller_UserInfo($userInfos);
		if ($controllerUserInfo->isGood() && $controllerUser->isGood())
		{
			$userInfos->saveToDb();
			$user->saveToDb();
		}
		else
		{
			
		}
	}
}
else
{
	
}
?>