
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
	  <th>Modifier</th>
	  <th>Consulter l'activité</th>
	  <th> Supprimer </th> 
    </tr>
  </thead>
  <tbody>";

$i=0;

while($res=$db1->fetch()){
	$i++;
	$db2->select("activities", array('id' => $res['idActivite']),NULL); 
	$act=$db2->fetch(); 
	echo '<tr><th scope="row">'.$i.'</th>
			<td>'.$act['nom'].'</td> 
			<td>'.date("d/m/y H:i",$act['time_start']).'</td>';
			?>
			<?php //manque à gérer l'envoi en formulaire de la donnée modifiée (dans l'idéal en dynamique)     ?>
			<td><input class="form-control" type="number" name="nbrPersonne" value="<?php echo $res['nbrPersonne'];?>" id="nbrPersonne"/> <br/></td>
			
			<td> <button type="button" class="btn btn-info btn-sm" name="suppReservation" value='<?php.$res["idActivite"]?>.' onclick="loadTo("includes/controller/controllerFormulaire/activiteView.php")">Consulter</button></td>
			
			<td> <button type="button" class="btn btn-info btn-sm" name="suppReservation" value='<?php.$res["idActivite"]?>.' onclick="loadTo("includes/controller/controllerFormulaire/activiteView.php")">Consulter</button></td>
	
			<td><button type="button" class="btn btn-danger btn-sm" name="suppReservation" value='<?php.$res["idActivite"]?>.' onclick="loadTo("includes/controller/controllerFormulaire/supprimerReservation.php")">Supprimer</button>
	
	<?php
	echo'<td>';
	echo '</tr>';
	
	
}
if($i==0) echo "Vous n'avez pas de réservation ";


?>
</tbody>
</table> 







</div>