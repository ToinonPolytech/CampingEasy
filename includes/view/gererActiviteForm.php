<?php
	if (!isset($_SESSION)) // Pour gérer les appels dynamiques
		session_start();
	
	require_once($_SERVER['DOCUMENT_ROOT']."/includes/fonctions/general.php");
	require_once(i("database.class.php"));
	
	$db = new Database();
	$db->select("activities", array('id' => $_POST['id']),NULL) ; 
	$act= $db->fetch();
	
?>
<div class="col-lg-6" style="width:100%;" name="form-act" id="form-act">
	<h3> Gérer votre activité </h3><br/>
	<form role="form"  method="post" id="form_act" name="form_act">
		<div class="form-group">
			<label for="timeStart">Date et heure du début de l'activité</label><br/>
			<input class="form-control" type="datetime" name="timeStart" value="<?php echo date("d/m/y H:i",$act['time_start']); ?> "  id="timeStart"/> <br />
			<label for="nom">Nom de l'activité</label><br/>
			<input class="form-control" type="text" name="nom" value="<?php echo $act['nom']; ?> " id="nom"/> <br />
			<label for="descriptif">Donnez une description de votre activité</label><br/>
			<textarea class="form-control" name="descriptif" value="<?php echo $act['description']; ?>" id="descriptif" rows="6" cols="30"><?php echo $act['description']; //suppose que la zone de texte n'affiche pas la value par défaut  ?></textarea> <br />
			<label for="duree">Durée en minutes</label><br/>
			<input class="form-control" type="number" name="duree" value="<?php echo $act['duree']; ?>" id="duree"/> <br/>
			<label for="ageMin">Âge Minimum</label><br/>
			<input class="form-control" type="number" name="ageMin" value="<?php echo $act['ageMin']; ?>" id="ageMin"/> <br/>
			<label for="ageMax">Âge Maximum</label><br/>
			<input class="form-control" type="number" name="ageMax" value="<?php echo $act['ageMax']; ?>" id="ageMax"/> <br/>
			<label for="lieu">Lieu</label><br/>
			<input type="radio" checked name="lieu_type" id="lieu_type" value="1" onclick="$('#lieu').hide().attr('id', 'lieu0').attr('name', 'lieu0'); $('select[id=lieu1]').attr('id', 'lieu').attr('name', 'lieu').show();"/> Lieu Commun
			<input type="radio" name="lieu_type" id="lieu_type" value="0" onclick="$('#lieu').hide().attr('id', 'lieu1').attr('name', 'lieu1'); $('input[id=lieu0]').attr('id', 'lieu').attr('name', 'lieu').show();"/> Lieu autre
			<input type="text" class="form-control" name="lieu0" id="lieu0" style="display:none;"/>
			<select class="form-control" name="lieu" id="lieu">
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
			<select name="type" value="<?php echo $act['type']; ?> id="type">
				<option value="SPORTIF">SPORTIF</option>
				<option value="INTELLECTUEL">INTELLECTUEL</option>
			</select><br/>
		
			<label for="mustBeReserved">Doit être réservé ?</label><br/>
			<input type="checkbox" name="mustBeReserved" value="<?php echo $act['mustBeReserved']; ?>" id="mustBeReserved" onclick="if ($(this).is(':checked')) { $('.mustBeReserved_hide').show(); } else { $('.mustBeReserved_hide').hide(); }"/><br/>
			<label for="placesLim" class="mustBeReserved_hide" style="display:none;">Nombre de places</label><br/>
			<input class="form-control mustBeReserved_hide" type="number" name="placesLim" value="<?php echo $act['capaciteMax']; ?>" id="placesLim"  style="display:none;"/><br/>
			<label for="prix">Prix</label><br/>
			<input class="form-control" type="number" name="prix" value="<?php echo $act['prix']; ?>" id="prix"/><br/>
			<label for="points">Points disponibles</label><br/>
			<input class="form-control" type="number" name="points" value="<?php echo $act['points']; ?>" id="points"/><br/>
			<button class="btn btn-success" onclick="loadTo('includes/controller/controllerFormulaire/activite.controllerForm.php', $('#form_act').serialize(), '#form-act', 'prepend'); return false;">Enregistrer les modifications</button>
		</div>
	</form>
</div>
<script type="text/javascript">
	$("#timeStart").datetimepicker({
		format:'d-m-Y H:00'
	});
</script>