<?php 
	require_once($_SERVER['DOCUMENT_ROOT']."/includes/fonctions/general.php");
	require_once(i("activities.class.php"));
	if (!isset($_SESSION)) // Pour gérer les appels dynamiques
		session_start();
	if (!isset($_POST["id"]) || !is_numeric($_POST["id"]))
		exit();
	$id=$_POST["id"];
?> 
<div class="col-lg-6" style="width:40%;" name="form-equipe" id="form-equipe">
	<?php 
		$act= new Activite($id);
	?>
	<ul class="list-group">
		<li class="list-group-item">Nom : <?php echo $act->getNom(); ?></li>
		<li class="list-group-item">Date : <?php echo date("d/m/y H:i", $act->getDate()); ?></li>
		<li class="list-group-item">Description : <?php echo $act->getDescriptif(); ?></li>
		<li class="list-group-item">Age minimum : <?php echo $act->getAgeMin(); ?></li>
		<li class="list-group-item">Age maximum : <?php echo $act->getAgeMAx(); ?></li>
		<li class="list-group-item">Lieu : <?php echo $act->getLieu(); ?></li>
		<li class="list-group-item">Points à remporter au cours de cette activité : <?php echo $act->getPoints(); ?></li>
		<li class="list-group-item">Prix de l activité : <?php echo $act->getPrix(); ?></li>
	</ul>
</div>
<?php if($_SESSION['id']==$act->getIdOwner())
						{ ?>
							<button class="btn btn-success" onclick="loadToMain('<?php echo str_replace($_SERVER['DOCUMENT_ROOT'], '', i('gererActiviteForm.php')); ?>', {id: <?php echo $_POST['id']; ?> }); return false;">Modifier</button>
							<?php 
							if($act->getPoints()>=0)
							{ ?>
							
							<button class="btn btn-success" onclick="loadToMain('<?php echo str_replace($_SERVER['DOCUMENT_ROOT'], '', i('gererActiviteForm.php')); ?>', {id: <?php echo $_POST['id']; ?> }); return false;">Désigner un vainqueur (à faire)</button>
							
						<?php 
							}
						}
	if($act->getMustBeReserved()==1 && $act->getDebutReservation()<=time() && $act->getFinReservation()>=time())
	{
		?>
		<div class="col-lg-6 pull-right" style="width:40%;">
			<form method="post" id="form_reservation" name="form_reservation">

				<label for="nom">Nombre de personnes à inscrire</label><br/>
				<input type="number" name="nbrPersonnes" id="nbrPersonnes" class="form-control" value="1"/><br/>
				<button class="btn btn-success" onclick="loadTo('<?php echo str_replace($_SERVER['DOCUMENT_ROOT'], '', i('reservation.controllerForm.php')); ?>', $j.extend({}, $('#form_reservation').serialize(), {type : 'ACTIVITE', id : <?php echo $id;?>}), '#form-equipe', 'prepend'); return false;">Réserver</button>
			</form>
		</div>
		<?php	
	}
?>