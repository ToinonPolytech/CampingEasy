<?php
	function check_includes_name($dir, $name) // Optimise vitesse recherche fichier (c.f i($name_file))
	{
		if ($name==".git" || $name == "css" || $name == "fonts" || $name == "font-awesome" || $name == "js" || $name == "sql")
		{
			return 0;
		}
		else if ($name == '.' || $name == '..')
		{
			return 0;
		}
		else if (!is_dir($dir))
		{	
			return 0;
		}
		return 1;
	}

	function i($name_file, $path = NULL) // Donne le chemin du fichier $name_file
	{		
		if ($path==NULL)
			$path=$_SERVER['DOCUMENT_ROOT'];

		if (file_exists($path."/".$name_file))
		{
			return $path."/".$name_file;
		}
		else
		{
			$first_dossier = opendir($path);
			while (false !== ($path_add = readdir($first_dossier)))
			{
				if(check_includes_name($path."/".$path_add, $path_add))
				{
					$t=i($name_file, $path."/".$path_add);
					if (!is_numeric($t))
						return $t;
				}
			}
			closedir($first_dossier);
		}
		return 0;
	}
	
	function generateRandomCharacters($length)
	{
		$chaine = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
		$key = str_shuffle($chaine);
		$key = substr($key, 0, $length);
		return $key;
	}
	function auth()
	{
		return (isset($_SESSION["id"]) && is_numeric($_SESSION["id"]) && $_SESSION["id"]>0);
	}
?>