<?php 


if(isset($_POST['numPlace']) && isset($_POST['email']) && isset($_POST['solde']) && isset($_POST['time_depart']) && isset($_POST['clef']){
	
		$timeDep = strtotime($POST['time_depart');
		$user = new UserInfo(NULL, htmlspecialchars($_POST['numPlace']),htmlspecialchars($_POST['email']) , htmlspecialchars($_POST['solde'])
		, $timeDep, NULL); //htmlspecialchars($_POST['clef']) la clef est générée automatiquement ? 
		
		UserInfoController = new Controller_UserInfo($user);
		if($UserInfoController->isGood()){
				$user->saveToDb(); 
		}
}
	




?>