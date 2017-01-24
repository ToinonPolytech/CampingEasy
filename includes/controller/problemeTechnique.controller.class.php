<?php 





class Controller_PbTech {
	
	
	private $pbTech; 
	
	function __construct Controller_PbTech($pbTech){
		this->_PbTech=$pbTech; 
			
	}
	
	function isGood(){
		
		return(idUserIsGood() && timeCreatedIsGood() && timeEstimatedIsGood() 
		&& descriptionIsGood() && isBungalowIsGood() && solvedIsGood()); 
		
	}
	function idUserIsGood(){
		return(!empty(_PbTech->getIdUser()) && is_numeric(_PbTech->getIdUser()) && 
		($database->count('problemes_technique', array("id" => $this->_id)>0));
		
				
	}
	
	function timeCreatedIsGood(){
		return(!empty(_PbTech->getTimeCreated()) &&  is_numeric(_PbTech->getTimeCreated()));
		
	}
	
	function timeEstimatedIsGood(){
		if(!empty(_PbTech->getTimeEstimated()) && is_numeric(_PbTech->getTimeEstimated()))
		{	 if(!_PbTech->getTimeEstimated()==0)
			{
				return( _PbTech->getTimeEstimated()>_PbTech->getTimeCreated() );
			
			}
		}
			
	}	
	function descriptionIsGood(){
		return(!empty(_PbTech->getDescription()) && (strlen(_PbTech->getDescriptionIsGood())>20) 
		&& (strlen(_PbTech->getDescriptionIsGood())<1000));
		
	}
	
	function isBungalowIsGood(){
		return(!empty(_PbTech->getIsBungalow()) && is_bool(_PbTech->getIsBungalow());
	}
	
	function solvedIsGood(){
		return(!empty(_PbTech->getSolved()) && is_bool(_PbTech->getSolved());
		
	}
	
	
}


?> 


