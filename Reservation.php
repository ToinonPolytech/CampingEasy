<?php

class Reservation {
    private $_id;
    private $_type;
    private $_idClient;
    private $_dateCreationRes;
    private $_nbpers;
    private $_idType;
    private $_dateRes;   
    
    /* données : 
-id : Int => clef primaire 
-type : String (enum) => type de réservation (lieu commun, activité, repas)
-idClient : Int => id du client qui fait la réservation 
-dateCreationRes : date => date et heure d'inscription à la réservation 	
-nbPers : Int => nombre de personnes associées à la réservation (>0)
-idType : Int => Id de l'activité ou du lieu commun réservé (en fonction du type de réservation )
-dateRes : (type=Lieu Commun) date => date et heure à laquelle a lieu la réservation (>dateCreationRes)
 */
    
     function __construct($_id) {
           
        $table = db.select(reservation,$id);  
        
        $this->_id = $_id;
        $this->_type = $table['type'];
        $this->_idClient = $table['idClient'];
        $this->_dateCreationRes = $table['dateCreationRes'];
        $this->_nbpers = $table['nbpers'];
        $this->_idType = $table['idType'];
        $this->_dateRes= $table['dateRes'];
    
     }
    function getId() {
        return $this->_id;
    }

    function getType() {
        return $this->_type;
    }

    function getIdClient() {
        return $this->_idClient;
    }

    function getDateCreationRes() {
        return $this->_dateCreationRes;
    }

    function getNbpers() {
        return $this->_nbpers;
    }

    function getIdType() {
        return $this->_idType;
    }

    function getDateRes() {
        return $this->_dateRes;
    }

    function setId($id) {
        $this->_id = $id;
    }

    function setType($type) {
        $this->_type = $type;
    }

    function setIdClient($idClient) {
        $this->_idClient = $idClient;
    }

    function setDateCreationRes($dateCreationRes) {
        $this->_dateCreationRes = $dateCreationRes;
    }

    function setNbpers($nbpers) {
        $this->_nbpers = $nbpers;
    }

    function setIdType($idType) {
        $this->_idType = $idType;
    }

    function setDateRes($dateRes) {
        $this->_dateRes = $dateRes;
    }

    






}


?>