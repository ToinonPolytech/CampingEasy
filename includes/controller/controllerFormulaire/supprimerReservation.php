<?php
if (!isset($_SESSION)) // Pour gérer les appels dynamiques
		session_start();
		
require_once('../../modele/database.class.php');


if(isset($_POST['suppReservation'] && isset($_SESSION['id'){
	
	$db = new Database();
$db->delete("reservation",array('idActivite' => $_POST['suppReservation'], 'idUser' => $_SESSION['id']),NULL); 
$db->fetch();

}





?>
