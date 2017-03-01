<?php 
if (!isset($_SESSION)) // Pour gérer les appels dynamiques
		session_start();

		require_once($_SERVER['DOCUMENT_ROOT']."/includes/fonctions/general.php");
 require_once(i("database.class.php"));
$db1 = new Database();
$db2 = new Database();
$db1->select("activities", array('idDirigeant' => $_SESSION['id']));

?>
<a href="/includes/view/ajoutActiviteForm.php" class="pull-left">Créer une activité </a>
<?php
echo "<table class='table'>
  <thead>
    <tr>
      <th>#</th>
      <th>Nom </th>
      <th>Date </th>
      <th> Nombre de personnes inscrites</th>
	  <th> Modifier </th>
	  <th> Supprimer </th> 
    </tr>
  </thead>
  <tbody>";

$i=0;

while($act=$db1->fetch()){
	$i++;
	$nbRes=0 ; 
	//on sélectionne le nombre de personnes inscrites dans la réservation pour l'activité concernée
	$db2->select("reservation", array('idActivite' => $act['id']),array("nbrPersonne"));  
	while ($nbPersRes = $db2->fetch()){ //tant qu'il existe des réservations pour cette activité 
		$nbRes=$nbRes+ $nbPersRes[0]; //on somme le nombre de personnes inscrites 
		
	}
	
	echo '<tr><th scope="row">'.$i.'</th>
			<td>'.$act['nom'].'</td> 
			<td>'.date("d/m/y H:i",$act['time_start']).'</td>
			<td>'.$nbRes.'</td>';
			?><td> <button type="button" class="btn btn-info btn-sm" name="modifActivite"  onclick="loadToMain('includes/view/gererActiviteForm.php',{id : <?php echo $act["id"]; ?>}); return false;">Modifier</button></td>
	
			<td><button type="button" class="btn btn-danger btn-sm" name="suppReservation"  onclick="loadTo('includes/controller/controllerFormulaire/supprimerActivite.php')">Supprimer</button>
	
	<?php
	echo'<td>';
	echo '</tr>';
	
	
}
if($i==0) echo "Vous n'avez pas d'activité";


?>
</tbody>
</table> 







</div>