 <?php
	if (!isset($_SESSION))
		session_start();
	
	require_once($_SERVER['DOCUMENT_ROOT']."/includes/fonctions/general.php");
?>
<div class="col-lg-6" style="width:100%;" name="form-edl" id="form-edl">
	<span class="pull-left">Ouverture de plage d'état des lieux </span><br/>
	<form role="form" method="post"  id="form_edl">
		<div class="form-group">
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