<?php
	if (!isset($_SESSION)) // Pour gérer les appels dynamiques
		session_start();
	
	require_once($_SERVER['DOCUMENT_ROOT']."/includes/fonctions/general.php");
	require_once(i("database.class.php"));
?>
<div class="col-lg-6" style="width:100%;" name="form-act" id="form-act">
	<h3>Créer votre activité ! </h3><br/>
	<form role="form"  method="post" id="form_act" name="form_act">
		<div class="form-group">
			<label for="timeStart">Date et heure du début de l'activité</label><br/>
			<input class="form-control" type="text" name="timeStart" id="timeStart"/> <br />
			<label for="nom">Nom de l'activité</label><br/>
			<input class="form-control" type="text" name="nom" id="nom"/> <br />
			<label for="descriptif">Donnez une description de votre activité</label><br/>
			<textarea class="form-control" name="descriptif" id="descriptif" rows="6" cols="30"></textarea> <br />
			<label for="duree">Durée en minutes</label><br/>
			<input class="form-control" type="number" name="duree" id="duree"/> <br/>
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
			<input type="checkbox" name="TYPE_1" id="TYPE_1" value="SPORITVE"> Sportive
			<input type="checkbox" name="TYPE_2" id="TYPE_2" value="INTELLECTUELLE"> Intelectuelle 
			<input type="checkbox" name="TYPE_3" id="TYPE_3" value="CULTURELLE"> Culturelle
			<input type="checkbox" name="TYPE_3" id="TYPE_3" value="FETE"> Fête
			<br/>
			<label for="mustBeReserved">Doit être réservé ?</label><br/>
			<input type="checkbox" name="mustBeReserved" id="mustBeReserved" onclick="if ($(this).is(':checked')) { $('.mustBeReserved_hide').show(); } else { $('.mustBeReserved_hide').hide(); }"/><br/>
			<div class="mustBeReserved_hide" style="display:none;">
				<label for="placesLim">Nombre de places</label><br/>
				<input class="form-control" type="number" name="placesLim"  id="placesLim"/><br/>
				<label for="debutReservation">Date début de la réservation</label><br/>
				<input class="form-control" type="text" name="debutReservation" id="debutReservation" value="<?php echo date("d-m-Y H:00"); ?>"/><br />
				<label for="finReservation">Date limite pour la réservation</label><br/>
				<input class="form-control" type="text" name="finReservation" id="finReservation"/><br />
			</div>
			<label for="prix">Prix</label><br/>
			<input class="form-control" type="number" name="prix" id="prix" value="0"/><br/>
			<label for="points">Points disponibles</label><br/>
			<input class="form-control" type="number" name="points" id="points" value="0"/><br/>
			<button class="btn btn-success" onclick="loadTo('<?php echo str_replace($_SERVER['DOCUMENT_ROOT'], '', i('activite.controllerForm.php')); ?>',$('#form_act').serialize(), '#form-act', 'prepend'); return false;">Créer</button>
		</div>
	</form>
</div>
<script type="text/javascript">
	$("#timeStart").datetimepicker({
		startDate:new Date(),
		format:'d-m-Y H:00',
		onChangeDateTime:function(dp,$input){
			$("#finReservation").val($input.val());
		}
	});
	$("#debutReservation,#finReservation").datetimepicker({
		startDate:new Date(),
		format:'d-m-Y H:00'
	});
</script>