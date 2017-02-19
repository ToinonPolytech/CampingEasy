
<div class="col-lg-6" style="width:100%;" name="form-equipe" id="form-equipe">


<?php
	if (!isset($_SESSION)) // Pour gérer les appels dynamiques
		session_start();
		
		
		
require_once("/../modele/database.class.php");
$db1 = new Database();
$db2 = new Database();
$db1->select("reservation", array('idUser' => $_SESSION['id']));


echo "<table class='table'>
  <thead>
    <tr>
      <th>#</th>
      <th>Activité </th>
      <th>Date </th>
      <th>Nombre de personnes </th>
	  <th>Consulter l'activité</th>
	  <th> Supprimer </th> 
    </tr>
  </thead>
  <tbody>";

$i=1;

while($res=$db1->fetch()){
	$db2->select("activities", array('id' => $res['idActivite']),NULL); 
	$act=$db2->fetch(); 
	echo '<tr><th scope="row">'.$i.'</th>
			<td>'.$act['nom'].'</td> 
			<td>'.date("d/m/y H:i",$act['time_start']).'</td>
			<td>'.$res['nbrPersonne'].'</td>
			<td> <button type="button" class="btn btn-info btn-sm" name="suppReservation" value='.$res["idActivite"].' onclick="loadTo("includes/controller/controllerFormulaire/supprimerReservation.php">Consulter</button></td>
	
			<td><button type="button" class="btn btn-danger btn-sm" name="suppReservation" value='.$res["idActivite"].' onclick="loadTo("includes/controller/controllerFormulaire/supprimerReservation.php">Supprimer</button>';
	
	
	echo'<td>';
	echo '</tr>';
	
	$i++;
}


?>
</tbody>
</table> 







</div>