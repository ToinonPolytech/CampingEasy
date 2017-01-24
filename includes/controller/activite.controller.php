<?php

require("database.class.php");
require("../fonctions/general.php");


class Controller_Activite {
	
	private $_act;
	function __construct Controller_Activite($act){
		this->_act=$act; 
		
		
	}
	
	function isGood(){
		
		return(timeStartIsGood() && dureeIsGood() && nomIsGood() 
		&& descriptifIsGood() && ageIsGood() && lieuIsGood() &&
		typeIsGood() && placesLimIsGood() && prixIsGood() &&
		idOwnerIsGood() && pointsIsGood()); 
		
	}
	
	function timeStartIsGood(){
		return(!empty(_act->getTimeStart) && (_act->getTimeStart>time()));
		
	}
	
	function dureeIdGood(){
		return(!empty(_act->getDuree) && (_act->getDuree>0));
		
	}
	function nomIsGood(){
		
		return(!empty(_act->getnom) && (strlen(_act->getNom)<40) &&
		strlen(_act->getNom)>3);
	}
	function descriptifIsGood(){
		return(!empty(_act->getDescriptif) && (strlen(_act->getDescriptif)>20) && strlen(_act->getDescriptif)<300);
		
	}
	
	function ageIsGood(){
		return(!empty(_act->getAgeMin) && !empty(_act->getaAgeMax) &&
		is_numeric(_act->getAgeMin) && is_numeric(_act->getAgeMax) &&
		(_act->getAgeMin<_act->getAgeMax) && (_act->getAgeMin>0) && (_act->getAgeMax<100)); 
			
		
	}
	function lieuIsGood(){
		
		if(empty(_act->getIdLieu)){ return(!empty(_act->getLieu)
			&& (strlen(_act->getLieu)<50 && (strlen(_act->getLieu)>5);
		
		}
		else{ if($database->count('lieuCommun', array("id" =>_act->getIdLieu))){
			return true;
		} 
			else{
				return false;}
		
		}
		
	}
	function typeIsGood(){
		$database = new Database();
		return(!empty(_act->getType) && ($database->count('typeActivite', array("nom" => $act->_nom))==0)); 
		
	}
	
	function placesLimIsGood(){
		return(!empty(_act->getPlacesLim) && is_numeric(_act->getPlacesLim) && _act->getPlacesLim<1000);	
		
		
	}
	function prixIsGood(){
		return(!empty(_act->getPrix) && is_numeric(_act->getPrix) && (_act->getPrix<1000));
		
	}
	
	function idOwnerIsGood(){
		
		return(!empty(_act->getIdOwner) && ($database->count('users', array("id" => $act->idOwner))==1));
		
		
	}
	function pointsIsGood(){
		
		return(!empty(_act->getPoints) && is_numeric(_act->getPoints) &&(_act->getPoints<999999999));
		
	}
}
 






?> 