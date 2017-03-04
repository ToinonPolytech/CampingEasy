<?php 
	require_once($_SERVER['DOCUMENT_ROOT']."/includes/fonctions/general.php");
	require_once(i("problemeTechnique.class.php"));
	require_once(i("problemeTechnique.controller.class.php"));
	require_once(i("images.class.php"));
	
	if (!isset($_SESSION)) // Pour gérer les appels dynamiques
		session_start();
		
	if(isset($_SESSION['id']) && isset($_POST['description']))
	{	
		$photos="";
		if (isset($_FILES))
		{
			$dir="pbTechniques";
			$maxsize=2048000;
			$extensions_valides = array( 'jpg' , 'jpeg' , 'gif' , 'png' , 'bmp' );
			$imagesUpload=new Image_upload($_FILES, $maxsize, $extensions_valides, $dir);
			$photos=$imagesUpload->getUrl();
		}
		
		if (!isset($imagesUpload) || !$imagesUpload->getError())
		{
			if(!isset($_POST['isBungalow']))
				$isBungalow=false; 
			else
				$isBungalow=true;
			
			$pbTech = new PbTech(NULL, htmlspecialchars($_SESSION['id']), time(), NULL, htmlspecialchars ($_POST['description']), $isBungalow, $photos);
			$pbTechController = new Controller_PbTech($pbTech);
			if($pbTechController->isGood())
			{	 
				$pbTech->saveToDb();
				echo "Le problème a bien été signalé, vous serez informés de l'heure de venue du technicien";
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