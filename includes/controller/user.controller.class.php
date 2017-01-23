<?php 
require("database.class.php");
require("../fonctions/general.php");
/**
	Cette classe permet juste de définir celle de Client et Staff, on ne l'utilisera jamais
**/
class Controller_User
{
	private $_user;
	function __construct Controller_User($user){
		$this->_user=$user;
	}
	function generateKey(){
		$database = new Database();
		do{
			$clef=generateRandomCharacters(6);
		}while($database->count('users', array("clef" => $clef)));
		return $clef;
	}
	function isGood(){
		return (nomIsGood() && prenomIsGood() && codeIsGood() && droitsIsGood() && infoIdIsGood()) ? true : false;
	}
	function nomIsGood(){
		return (empty($_user->getNom()) ||  !preg_match("#^[a-zA-Z0-9]+{3,40}$#",$_user->getNom())) ? false : true;
	}
	function prenomIsGood(){
		return (empty($_user->getPrenom()) ||  !preg_match("#^[a-zA-Z0-9]+{3,40}$#",$_user->getPrenom())) ? false : true;
	}
	function codeIsGood(){
		return (empty($_user->getCode()) || !preg_match("#^[0-9]+{4}$#", $_user->getCode())) ? false : true;
	}
	function droitsIsGood(){
		return (empty($_user->getDroits()) || !preg_match("#^[0-9]+{1,255}$#", $_user->getDroits())) ? false : true;
	}
	function infoIdIsGood(){
		$database = new Database();
		return (empty($_user->getInfoId()) || !$database->count('userinfos', array("id" => $_user->getInfoId()))) ? false : true;	
	}
	/**
		Exemple : can(CAN_CREATE_SUBACCOUNT); grâce au fichier config.php cela donne la puissance adéquate et tout est géré automatiquement.
	**/
	function can($which){
		$etat=false;
		$droits = $_user->getDroits();
		$p=0;$n=1;
		while ($n<$droits) { $n*=2; $p++; }
		if ($n>$droits) { $p--; $n/=2; }
		for ($i=$droits;$i>0 && !$etat && $which<=$p;$n/=2){
			if ($i>$n){
				$i-=$n;
				if ($p==$which)
					$etat=true;
			}
			$p--;
		}
		return $etat;
	}
}
?>