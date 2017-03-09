<?php
	if (!isset($_SESSION)) // Pour gérer les appels dynamiques
		session_start();
	
	require_once($_SERVER['DOCUMENT_ROOT']."/includes/fonctions/general.php");
	require_once(i("activities.class.php"));
	
	$act= new Activite($_POST['id']);
	
	
?>
<div class="col-lg-6" style="width:100%;" name="form-act" id="form-act">
	<h3> Gérer votre activité </h3><br/>
	<form role="form"  method="post" id="form_act" name="form_act">
		<div class="form-group">
			<label for="timeStart">Date et heure du début de l'activité</label><br/>
			<input class="form-control" type="datetime" name="timeStart" value="<?php echo date("d/m/y H:i",$act->getDate()); ?> "  id="timeStart"/> <br />
			<label for="nom">Nom de l'activité</label><br/>
			<input class="form-control" type="text" name="nom" value="<?php echo $act->getNom(); ?> " id="nom"/> <br />
			<label for="descriptif">Donnez une description de votre activité</label><br/>
			<textarea class="form-control" name="descriptif" value="<?php echo $act->getDescriptif(); ?>" id="descriptif" rows="6" cols="30"><?php echo $act->getDescriptif();  ?></textarea> <br />
			<label for="duree">Durée en minutes</label><br/>
			<input class="form-control" type="number" name="duree" value="<?php echo $act->getDuree(); ?>" id="duree"/> <br/>
			<label for="ageMin">Âge Minimum</label><br/>
			<input class="form-control" type="number" name="ageMin" value="<?php echo $act->getAgeMin(); ?>" id="ageMin"/> <br/>
			<label for="ageMax">Âge Maximum</label><br/>
			<input class="form-control" type="number" name="ageMax" value="<?php echo $act->getAgeMax(); ?>" id="ageMax"/> <br/>
			<label for="lieu">Lieu</label><br/>
			<input type="radio" checked name="lieu_type" id="lieu_type" value="1" onclick="$('#lieu').hide().attr('id', 'lieu0').attr('name', 'lieu0'); $('select[id=lieu1]').attr('id', 'lieu').attr('name', 'lieu').show();"/> Lieu Commun
			<input type="radio" name="lieu_type" id="lieu_type" value="0" onclick="$('#lieu').hide().attr('id', 'lieu1').attr('name', 'lieu1'); $('input[id=lieu0]').attr('id', 'lieu').attr('name', 'lieu').show();"/> Lieu autre
			<input type="text" class="form-control" name="lieu0" id="lieu0" style="display:none;"/>
			<select class="form-control" name="lieu" id="lieu" value="<?php echo $act->getLieu();?>">
				<?php
					$database = new Database();
					$database->select("lieu_commun");
					while ($data=$database->fetch())
					{
						?>
						<option value="<?php echo htmlspecialchars($data["id"]); ?>"><?php echo htmlspecialchars($data["nom"]); ?></option>
						<?php
					}
				?>
			</select><br/>
			<label for="type">Type d'activité</label><br/>
			<select name="type" value="<?php echo $act->getType(); ?> id="type">
				<option value="SPORTIF">SPORTIF</option>
				<option value="INTELLECTUEL">INTELLECTUEL</option>
			</select><br/>
		
			<label for="mustBeReserved">Doit être réservé ?</label><br/>
			<input type="checkbox" name="mustBeReserved" checked="<?php if($act->getMustBeReserved()){ echo 'checked';} ?>" id="mustBeReserved" onclick="if ($(this).is(':checked')) { $('.mustBeReserved_hide').show(); } else { $('.mustBeReserved_hide').hide(); }"/><br/>
			<div class="mustBeReserved_hide" style="display:none;">
				<label for="placesLim">Nombre de places</label><br/>
				<input class="form-control" type="number" name="placesLim"  id="placesLim"/><br/>
				<label for="debutReservation">Date début de la réservation</label><br/>
				<input class="form-control" type="text" name="debutReservation" id="debutReservation" value="<?php echo date("d/m/y H:i",$act->getDebutReservation()); ?>"/><br />
				<label for="finReservation">Date limite pour la réservation</label><br/>
				<input class="form-control" type="text" name="finReservation" id="finReservation" value="<?php echo date("d/m/y H:i",$act->getFinReservation()); ?>"/><br />
			</div>
			<input class="form-control mustBeReserved_hide" type="number" name="placesLim" value="<?php echo $act->getPlacesLim(); ?>" id="placesLim"  style="display:none;"/><br/>
			<label for="prix">Prix</label><br/>
			<input class="form-control" type="number" name="prix" value="<?php echo $act->getPrix(); ?>" id="prix"/><br/>
			<label for="points">Points disponibles</label><br/>
			<input class="form-control" type="number" name="points" value="<?php echo $act->getPoints(); ?>" id="points"/><br/>
			<button class="btn btn-success" onclick="loadTo('<?php echo str_replace($_SERVER['DOCUMENT_ROOT'], '', i('activite.controllerForm.php')); ?>', $j.extend({}, $('#form_act').serialize(), {id : <?php echo $act->getId(); ?>});, '#form-act', 'prepend'); return false;">Enregistrer les modifications</button>
		</div>
	</form>
</div>
<script type="text/javascript">
	$("#timeStart").datetimepicker({
		format:'d-m-Y H:00'
	});
	$("#debutReservation").datetimepicker({
		format:'d-m-Y H:00'
	});
	$("#finReservation").datetimepicker({
		format:'d-m-Y H:00'
	});
</script>