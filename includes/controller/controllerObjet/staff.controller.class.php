<?php 
require_once("../../modele/database.class.php");
require_once("../../modele/equipe.class.php");

class Controller_Staff
{
	private $staff;
	public function __construct ($staff){
		$this->staff=$staff;
	}

public function isGood(){
		return (parent::isGood());
	}	


?> 