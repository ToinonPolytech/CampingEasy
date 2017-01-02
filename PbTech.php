<?php

class PbTech{
    
private $_id;    
private $_date; 
private $_nom; 
private $_descriptif; 
private $_photo;
private $_idClient; 

function __construct($id) {
    
    
   $table=db.select(pbtech,$id);
    $this->_id = $id;
    $this->_date =$table['date'];
    $this->_nom = $table['nom'];
    $this->_descriptif = $table['descriptif'];
    $this->_photo = $table['photo'];
    $this->_idClient = $table['idClient'];
    
    
}


function getId() {
    return $this->_id;
}

function getDate() {
    return $this->_date;
}

function getNom() {
    return $this->_nom;
}

function getDescriptif() {
    return $this->_descriptif;
}

function getPhoto() {
    return $this->_photo;
}

function getIdClient() {
    return $this->_idClient;
}

function setId($id) {
    $this->_id = $id;
}

function setDate($date) {
    $this->_date = $date;
}

function setNom($nom) {
    $this->_nom = $nom;
}

function setDescriptif($descriptif) {
    $this->_descriptif = $descriptif;
}

function setPhoto($photo) {
    $this->_photo = $photo;
}

function setIdClient($idClient) {
    $this->_idClient = $idClient;
}


    
    
    /* données : 
-IdPbT : Int => id du pb technique 
-Date : date => date de déclaration du Pb technique 
-Nom : String => nom du pb (ex : "fuite d'eau robinet")
-Descriptif : String => Descriptif du pb technique 
-Photo : JPG ? => photo éventuelle du Pb 
-idClient : Int => id cu client concerné par le pb 
 
 
 */

    
    
    
    
}

?>