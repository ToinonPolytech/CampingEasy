<?php 
require("database.class.php");
class Controller_Equipe
{
	private $_equipe;
	function __construct Controller_Equipe($equipe){
		$this->_equipe=$equipe;
	}
	function isGood(){
		return (nomIsGood() && scoreIsGood());
	}
	function nomIsGood(){
		return !(empty($_equipe->getNom()) ||  !preg_match("#^[a-zA-Z0-9]+{3,40}$#",$_equipe->getNom()));
	}
	function scoreIsGood(){
		return !(empty($_equipe->getScore()) ||  !preg_match("#^[0-9]+{1,255}$#",$_equipe->getScore()));
	}
}
?>