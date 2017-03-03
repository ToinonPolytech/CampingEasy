<?php
	if (!isset($_SESSION))
		session_start();
	
	require_once($_SERVER['DOCUMENT_ROOT']."/includes/fonctions/general.php");
?>
<div class="col-lg-6" style="width:100%;" name="form-equipe" id="form-equipe">
	<span class="pull-left">Créer une équipe</span><br/>
	<form role="form"  method="post">
		<div class="form-group">
			<label for="nom">Entrez le nom de l'équipe que vous souhaitez créer</label><br/>
			<input class="form-control" type="text" name="nom" id="nom"/> <br />
			<button class="btn btn-success" onclick="loadTo('<?php echo str_replace($_SERVER['DOCUMENT_ROOT'], '', i('equipe.controllerForm.php')); ?>', {nom : $('#nom').val()}, '#form-equipe', 'prepend'); return false;">Créer</button>
		</div>
	</form>
</div>