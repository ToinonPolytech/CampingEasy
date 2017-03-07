<?php 
	require_once($_SERVER['DOCUMENT_ROOT']."/includes/fonctions/general.php");
	require_once(i("database.class.php"));
	if (!isset($_POST["id"]) || !is_numeric($_POST["id"]))
		exit();
	$id=$_POST["id"];
?> 
<div class="col-lg-6" style="width:40%;" name="form-equipe" id="form-equipe">
	<?php 
		$database = new Database();
		$database->select("activities", array('id' => $id));  
		$act = $database->fetch(); 
	?>
	<ul class="list-group">
		<li class="list-group-item">Nom : <?php echo $act['nom']; ?></li>
		<li class="list-group-item">Date : <?php echo date("d/m/y H:i", $act['time_start']); ?></li>
		<li class="list-group-item">Description : <?php echo $act['description']; ?></li>
		<li class="list-group-item">Age minimum : <?php echo $act['ageMin']; ?></li>
		<li class="list-group-item">Age maximum : <?php echo $act['ageMax']; ?></li>
		<li class="list-group-item">Lieu : <?php echo $act['lieu']; ?></li>
		<li class="list-group-item">Points à remporter au cours de cette activité : <?php echo $act['points']; ?></li>
		<li class="list-group-item">Prix de l activité : <?php echo $act['prix']; ?></li>
	</ul>
</div>
<?php
	if($act['mustBeReserved']==1 && $act['debutReservation']<=time() && $act["finReservation"]>=time())
	{
		?>
		<div class="col-lg-6 pull-right" style="width:40%;">
			<form action="/includes/view/ajoutReservationForm.php" method="post" id="form_reservation" name="form_reservation">
				<input type="hidden" name="idAct" id="idAct" value="<?php echo $act['id']; ?>" />
				<label for="nom">Nombre de personnes à inscrire</label><br/>
				<input type="number" name="nbrPersonnes" id="nbrPersonnes" class="form-control" value="1"/><br/>
				<?php if($_SESSION['id']==$act['idOwner'])
						{ ?>
							<button class="btn btn-success" onclick="loadTo('<?php echo str_replace($_SERVER['DOCUMENT_ROOT'], '', i('gererActivite.php')); ?>', {id: <?php echo $_POST['id']; ?> }); return false;">Modifier</button>
						<?php } ?> 
				<button class="btn btn-success" onclick="loadTo('<?php echo str_replace($_SERVER['DOCUMENT_ROOT'], '', i('reservation.controllerForm.php')); ?>', $j.extend({}, $('#form_reservation').serialize(), {type : 'ACTIVITE'}), '#form-equipe', 'prepend'); return false;">Réserver</button>
			</form>
		</div>
		<?php	
	}
?>