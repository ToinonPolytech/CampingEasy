<?php

class Controller_LieuCommun(){

	private $LC; 
	
	function __construct Controller_LieuCommun($LC){
		this->_LC=$LC;

		
	}
	function isGood(){
		
		return(nomIsGood() && descriptionIsGood());
	}
	
	function nomIsGood(){
		
		return(!empty(_LC->getNom()) && (strlen(_LC->getNom())<40) &&
		strlen(_LC->getNom())>3);
	}
	function descriptionIsGood(){
		
		return(!empty(_LC->getDescrition())) && strlen(_LC->getDescription())<500); 
		
	}



}





}


?>