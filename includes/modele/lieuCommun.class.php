<?php
require("database.class.php");


class LieuCommun {
/* 
données : 
 * -id : Int => clef primaire 
 * -libelle : String => descriptif du lieu commun 
 */
private $_id;
private $_libelle; 

    
function getId() {
    return $this->_id;
}

function getLibelle() {
    return $this->_libelle;
}

function setId($id) {
    $this->_id = $id;
}

function setLibelle($libelle) {
    $this->_libelle = $libelle;
}


    
    
    
    
}