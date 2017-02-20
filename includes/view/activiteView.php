<?php 
require_once("/../modele/database.class.php");

if (!isset($_POST["id"]) || !is_numeric($_POST["id"]))
	exit();

$id=$_POST["id"];
?> 
<div class="col-lg-6" style="width:40%;" name="form-equipe" id="form-equipe">

<?php 
$database = new Database();
$database->select("activities", array( 'id' => $id)); //id à remplacer par l'id passé en post  

$act = $database->fetch(); 
echo '<ul class="list-group">
  <li class="list-group-item">Nom : '.$act['nom'].'</li>
  <li class="list-group-item">Date : '.date("d/m/y H:i", $act['time_start']).'</li>
  <li class="list-group-item">Description : '. $act['description'].'</li>
  <li class="list-group-item">Age minimum : '.$act['ageMin'].'</li>
  <li class="list-group-item">Age maximum : '.$act['ageMax'].'</li>
  <li class="list-group-item">Lieu : ' .$act['lieu'].'</li>
   <li class="list-group-item">Points à remporter au cours de cette activité : '.$act['points'].'</li>
   <li class="list-group-item>Prix de l activité : '.$act['prix'].'</li>
</ul>';

if($act['mustBeReserved']==1){ //si activité réservable 
	//bouton de réservation 
	echo '<div align ="right">';
	require_once("/ajoutReservationForm.php");
	echo '</div>';
	?>
	<form action="/includes/view/ajoutReservationForm.php" method="post">
	<input type="hidden" name="idAct" value="<?php echo $act['id']; ?>" />
	<input type="hidden" name="nom" value="<?php echo $act['nom']; ?>" />
    <input type="submit" value="Réserver" />
	</form>
	
<?php
	
	}







?>

</div>