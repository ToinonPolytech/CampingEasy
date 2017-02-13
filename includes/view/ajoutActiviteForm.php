<?php
	if (!isset($_SESSION)) // Pour gérer les appels dynamiques
		session_start();
	
	require_once("/../fonctions/general.php");
	require_once("/../modele/database.class.php");
?>
<div class="col-lg-6" style="width:100%;" name="form-equipe" id="form-equipe">
	<h3>Créer votre activité ! </h3><br/>
	<form role="form"  method="post">
		<div class="form-group">
			<label for="timeStart">Date et heure du début de l'activité</label><br/>
			<input class="form-control" type="datetime" name="timeStart" id="timeStart"/> <br />
			<label for="nom">Nom de l'activité</label><br/>
			<input class="form-control" type="text" name="nom" id="nom"/> <br />
			<label for="descriptif">Donnez une description de votre activité</label><br/>
			<textarea class="form-control" name="descriptif" id="descriptif" rows="6" cols="30"></textarea> <br />
			<label for="duree">Durée en minutes</label><br/>
			<input class="form-control" type="number" name="duree" id="duree"/> <br/>
			<label for="ageMin">Âge Minimum</label><br/>
			<input class="form-control" type="number" name="ageMin" id="ageMin"/> <br/>
			<label for="ageMax">Âge Maximum</label><br/>
			<input class="form-control" type="number" name="ageMax" id="ageMax"/> <br/>
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
			<select name="type" id="type">
				<option value="SPORTIF">SPORTIF</option>
				<option value="INTELLECTUEL">INTELLECTUEL</option>
			</select><br/>
			<label for="mustBeReserved">Doit être réservé ?</label><br/>
			<input type="checkbox" name="mustBeReserved" id="mustBeReserved" onclick="if ($(this).is(':checked')) { $('.mustBeReserved_hide').show(); } else { $('.mustBeReserved_hide').hide(); }"/><br/>
			<label for="placesLim" class="mustBeReserved_hide" style="display:none;">Nombre de places</label><br/>
			<input class="form-control mustBeReserved_hide" type="number" name="placesLim" id="placesLim" style="display:none;"/><br/>
			<label for="prix">Prix</label><br/>
			<input class="form-control" type="number" name="prix" id="prix"/><br/>
			<label for="points">Points disponible</label><br/>
			<input class="form-control" type="number" name="points" id="points"/><br/>
			<button class="btn btn-success" onclick="loadTo('includes/controller/controllerFormulaire/activite.controllerForm.php', {nom : $('#nom').val()}, '#form-equipe', 'prepend'); return false;">Créer</button>
		</div>
	</form>
</div>