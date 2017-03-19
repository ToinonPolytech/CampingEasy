 <?php
	if (!isset($_SESSION))
		session_start();
	
	require_once($_SERVER['DOCUMENT_ROOT']."/includes/fonctions/general.php");
?>
<div class="col-lg-6" style="width:40%;" name="form-edl" id="form-edl">
	<span class="pull-left">Ouverture de plage d'état des lieux </span><br/>
	<form role="form" method="post"  id="form_edl">
		<div class="form-group">

			<label for="dateOuv">Date et heure de l'ouverture </label><br/>
			<input class="form-control" type="text" name="dateOuv" id="dateOuv" required/><br/>
			<label for="dateFerm">Date et heure de la fermeture </label><br/>
			<input class="form-control" type="text" name="dateFerm" id="dateFerm" required/><br/>
			<label for="frequence">Fréquence de l'état des lieux en minutes </label><br/>
			<select name="frequence" id="frequence">
				<?php 
				$i=0;
				while($i<=60)
					{ $i=$i+5; 
					?>
						<option value="<?php echo $i;?>"><?php echo $i;?></option>
					<?php } 
					?>
			</select><br/>
			<label for="nbSimult">Nombre d'état des lieux simultanés possibles</label><br/>
			<input class="form-control" type="number" name="nbSimult" id="nbSimult" required/><br/>
			<label for="mustBeReserved">Cette plage horaire d'état des lieux est récurrente </label><br/>
			<input type="checkbox" name="recurrence" id="recurrence" onclick="if ($(this).is(':checked')) { $('.recurrence_hide').show(); } else { $('.recurrence_hide').hide(); }"/><br/>
			<div class="recurrence_hide" style="display:none;">
				
				<label for="debutReservation">Recurrence : </label><br/>
				<select name="recurrence_time" id="recurrence_time">
						<option value="1">Tous les jours</option>
						<option value="7">Toutes les semaines</option>	
				Vous pourrez modifier chaque récurrence indépendamment des autres si besoin 
				</select><br/>
				
			</div>
			
			<button class="btn btn-success" onclick="loadTo('<?php echo str_replace($_SERVER['DOCUMENT_ROOT'], '', i('etatDesLieux.controllerForm.php')); ?>',$('#form_edl').serialize(), '#form-edl', 'prepend'); return false;">Ajouter</button>

			<label for="dateDeb">Sélectionner l'horaire pour le début des États des lieux</label>
			<input type="text" name="dateDeb" id="dateDeb" class="form-control" />
			<label for="dateDeb">Sélectionner l'horaire pour la fin des États des lieux</label>
			<input type="text" name="dateFin" id="dateFin" class="form-control" />
			<label for="duree">Quelle est la durée moyenne (minute) d'un état des lieux ?</label>
			<input type="number" name="duree" id="duree" value="5" class="form-control" />

		</div>
	</form>
</div>
<script type="text/javascript">
	$("#dateDeb").datetimepicker({
		startDate:new Date(),
		format:'d-m-Y H:00',
		onChangeDateTime:function(dp,$input){
			$("#dateFin").val($input.val());
			$("label[for='users']").remove();
			$("#users").remove();
			$("button").remove();
			loadTo("<?php echo str_replace($_SERVER['DOCUMENT_ROOT'], "", i("ajoutEtatDesLieux_seekStaff.php")); ?>", {deb : $("#dateDeb").val(), fin : $input.val()}, ".form-group", "append");
		}
	});
	
	$("#dateFin").datetimepicker({
		startDate:new Date(),
		format:'d-m-Y H:00',
		onChangeDateTime:function(dp,$input){
			$("label[for='users']").remove();
			$("#users").remove();
			$("button").remove();
			if ($("#dateDeb").val()!="")
				loadTo("<?php echo str_replace($_SERVER['DOCUMENT_ROOT'], "", i("ajoutEtatDesLieux_seekStaff.php")); ?>", {deb : $("#dateDeb").val(), fin : $input.val()}, ".form-group", "append");
		}
	});
	
	$("#dateDeb,#dateFin").onchange
</script>