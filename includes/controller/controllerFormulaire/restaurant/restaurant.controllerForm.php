<?php 
require_once($_SERVER['DOCUMENT_ROOT']."/includes/fonctions/general.php");
require_once(i("activities.class.php"));
require_once(i("activite.controller.class.php"));
require_once(i("images.class.php"));
require_once(i("restaurant.class.php"));
require_once(i("restaurant.controller.class.php"));
if (!isset($_SESSION)) // Pour gérer les appels dynamiques
		session_start();
		

if (isset($_POST["nom"]) && isset($_POST["description"]) && isset($_POST["capacite"]))
{
	$photos="";
	if (isset($_FILES))
	{
		$dir="restaurant";
		$maxsize=2048000;
		$extensions_valides = array( 'jpg' , 'jpeg' , 'gif' , 'png' , 'bmp' );
		$imagesUpload=new Image_upload($_FILES, $maxsize, $extensions_valides, $dir);
		$photos=$imagesUpload->getUrl();
	}
	if (!isset($imagesUpload) || !$imagesUpload->getError())
	{
		$horaires=array();
		for ($i=0;$i<7;$i++)
		{
			$horaires[$i]=array();
			for ($j=0;$j<48;$j++)
			{
				$horaires[$i][$j]=false;
			}
		}
		$error=0;
		foreach ($_POST as $key => $value)
		{
			if (strstr($key, "horaire_open"))
			{
				$key_close=str_replace("horaire_open", "horaire_close", $key);
				if (isset($_POST[$key_close]) && !empty($_POST[$key_close]) && !empty($value))
				{
					$temp=explode("_", str_replace("horaire_open_", "", $key));
					$day=$temp[0];
					$day_number=0;
					if ($day=="lundi") $day_number=1;
					else if ($day=="mardi") $day_number=2;
					else if ($day=="mercredi") $day_number=3;
					else if ($day=="jeudi") $day_number=4;
					else if ($day=="vendredi") $day_number=5;
					else if ($day=="samedi") $day_number=6;
					// On doit gérer les horaires de $horaires[$day_number]
					$temp=explode(":", $value);
					$debut_heure=$temp[0]*2;
					if ($temp[1]==30) $debut_heure+=1;
					$temp=explode(":", $_POST[$key_close]);
					$fin_heure=$temp[0]*2;
					if ($temp[1]==30) $fin_heure+=1;
					if ($fin_heure>=$debut_heure)
					{
						for ($i=$debut_heure;$i<=$fin_heure;$i++)
						{
							$horaires[$day_number][$i]=true;
						}
					}
					else
					{
						for ($i=$debut_heure;$i<=47;$i++)
						{
							$horaires[$day_number][$i]=true;
						}
						for ($i=0;$i<=$fin_heure;$i++)
						{
							$horaires[$day_number][$i]=true;
						}
					}
				}
			}
		}
		$horaires=serialize($horaires);
		$restaurant=new Restaurant(NULL, htmlspecialchars($_POST["nom"]), htmlspecialchars($_POST["description"]), htmlspecialchars($_POST["capacite"]), $horaires, $photos);
		$controllerRestaurant=new Controller_Restaurant($restaurant);
		if ($controllerRestaurant->isGood())
		{
			$restaurant->saveToDb();
			echo 'Le restaurant a bien été rajouté.';
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
}
else
{
	echo "ERREUR : Un problème est survenu lors de l'envoi du formulaire.";
}	
?>