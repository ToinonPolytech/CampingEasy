<?php
require_once($_SERVER['DOCUMENT_ROOT']."/includes/fonctions/general.php");
class Image_upload{
	private $_error;
	private $_url;
	public function __construct($data, $maxsize, $extensions_valides, $dir)
	{
		$this->_error=0;
		$this->_url=array();
		foreach ($data as $image)
		{
			if (!empty($image['name']))
			{
				if ($image['error'] > 0)
				{
					$this->_error++;
					echo "Une erreur est survenue lors du transfert des images : ";
					switch ($image['error'])
					{
						default: echo "?"; break;
						case UPLOAD_ERR_NO_FILE : echo "fichier manquant."; break;
						case UPLOAD_ERR_INI_SIZE : echo "fichier dépassant la taille maximale autorisée par PHP."; break;
						case UPLOAD_ERR_FORM_SIZE : echo "fichier dépassant la taille maximale autorisée par le formulaire."; break;
						case UPLOAD_ERR_PARTIAL : echo "fichier transféré partiellement."; break;
					}
					echo "<br/>";
				}
				else
				{
					if ($image['size'] > $maxsize)
					{
						echo "Au moins une des images est trop volumineuse.<br/>";
					}
					else
					{
						$extension_upload = strtolower(substr(strrchr($image['name'], '.'),1));
						if (!in_array($extension_upload,$extensions_valides))
						{
							$this->_error++;
							echo "Merci de vérifier les formats de vos images.<br/>";
						}
						else
						{
							$location=$_SERVER['DOCUMENT_ROOT']."/images/uploaded/".$_SESSION["id"]."/".$dir."/";
							if (!file_exists($location))
							{
								if (!mkdir($location, 0777, true))
								{
									$this->_error++;
									echo "Une erreur est survenue.<br/>";
								}
							}
							if ($this->_error==0)
							{
								$nom = md5(uniqid(rand(), true)).".".$extension_upload;
								$resultat = move_uploaded_file($image['tmp_name'],$location.$nom);
								if (!$resultat)
								{
									$this->_error++;
									echo "Une erreur est survenue.<br/>";
								}
								else
								{
									$this->_url[]=$location.$nom;
								}
							}
						}
					}
				}
			}
		}
		if ($this->_error>0)
		{
			$this->cancel();
		}
	}
	public function cancel()
	{
		foreach ($this->_url as $val)
		{
			unlink($val); // Erreur, on supprime tout
		}
	}
	public function getError()
	{
		return $this->_error;
	}
	public function getUrl()
	{
		$t="";
		foreach ($this->_url as $val)
		{
			$t.=str_replace($_SERVER['DOCUMENT_ROOT'], '', $val).",";
		}
		return $t;
	}
}
?>