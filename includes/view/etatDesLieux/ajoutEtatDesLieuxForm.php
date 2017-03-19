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
		</div>
	</form>
</div>
<script type="text/javascript">
	
	$("#dateOuv").datetimepicker({
		startDate:new Date(),
		format:'d-m-Y H:00',
		onChangeDateTime:function(dp,$input){
			$("#dateFerm").val($input.val());
		}
	});
	
	$("#debutFerm").datetimepicker({
		startDate:new Date(),
		format:'d-m-Y H:00'
	});
	
</script>