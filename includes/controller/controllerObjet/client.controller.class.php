<?php 
require_once("../../modele/database.class.php");
require_once("../../modele/equipe.class.php");

class Controller_Client
{
	private $client;
	public function __construct ($client){
		$this->client=$client;
	}

public function isGood(){
		return (parent::isGood());
	}	
	
	
	
	
	
	

?>