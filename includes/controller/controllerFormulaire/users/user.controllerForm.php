<?php
	if (!isset($_SESSION))
		session_start();
	
	require_once($_SERVER['DOCUMENT_ROOT']."/includes/fonctions/general.php");
	require_once(i("userInfos.controller.class.php"));	
	require_once(i("user.class.php"));
	require_once(i("user.controller.class.php"));
	
	if (!auth())
		exit();
	
	$userLog = new User($_SESSION["id"]);
	$controllerLog = new Controller_User($userLog);
	if ($userLog->getAccessLevel()=="CLIENT" || $userLog->getAccessLevel()=="PARTENAIRE")
		exit();
?>
<div class="alert alert-danger" role="alert" name="infoErreur" id="infoErreur">
	<?php 
		if(isset($_POST['nom']) && isset($_POST['prenom']) && isset($_POST['numPlace']) && isset($_POST['mail']) && isset($_POST['date']) && isset($_POST['type']) && $date=strtotime($_POST["date"])!==false)
		{
			// TODO : Faire une fonction qui attribue les access level en nombre pour pouvoir les comparer
			// Utilité : Si un sous_patron a le droit de créer/modifier un compte, il ne peut pas en créer/modifier un avec un access_level plus grand que sous_patron
			// Le client maître, a tout les droits disponibles pour un client
			
			$droits=0;
			if ($_POST["type"]=="CLIENT")
			{
				for ($i=$puissance;$i>0;$i--)
				{
					$droits+=$i;
				}
			}
			else
			{
				/**
					TODO 
					Modifier le form pour le staff
				**/
			}
			$user = new User(NULL, NULL, htmlspecialchars($_POST['type']), $droits, htmlspecialchars($_POST['nom']), htmlspecialchars($_POST['prenom']), NULL);
			if (isset($_POST["id"]))
			{
				if (!$controllerLog->can(CAN_EDIT_ACCOUNT_STAFF))
					exit();

				$user->setId($_POST["id"]);
				$db = new Database();
				$userInfos= new UserInfo($db->getValue("users", array("id" => $_POST["id"]), "infoId"));
				$user->setClef($db->getValue("users", array("id" => $_POST["id"]), "clef"));
			}
			else
			{
				if (!$controllerLog->can(CAN_CREATE_ACCOUNT_STAFF))
					exit();
				
				$controllerUser = new Controller_User($user);
				$clef = $controllerUser->generateKey();
				$userInfos = new UserInfo(NULL, htmlspecialchars($_POST['numPlace']), htmlspecialchars($_POST['mail']), strtotime(htmlspecialchars($_POST["date"])), $clef);
				$user->setClef($clef);
			}
			$user->setUserInfos($userInfos);
			$controllerUser = new Controller_User($user, false); // On met à jour notre controller
			$controllerUserInfo = new Controller_UserInfo($userInfos);
			if ($controllerUserInfo->isGood() && $controllerUser->isGood())
			{
				$userInfos->saveToDb();
				$user->saveToDb();
				$success=true;
			}
		}
		if (isset($success))
		{
			echo 'La clef de connexion du client est : '.$user->getClef();
		}
	?>
</div>