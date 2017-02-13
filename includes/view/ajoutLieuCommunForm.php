<div class="col-lg-6" style="width:100%;" name="form-camping" id="form-camping">
	<span class="pull-left">Ajouter un lieu au camping</span><br/>
	<form role="form" method="post">
		<div class="form-group">
			<label for="nom">Entrez le nom du lieu</label><br/>
			<input class="form-control" type="text" name="nom" id="nom"/> <br />
			<label for="nom">Description du lieu</label><br/>
			<textarea class="form-control" rows="6" cols="30" type="text" name="description" id="description"></textarea> <br />
			<button class="btn btn-success" onclick="loadTo('includes/controller/controllerFormulaire/lieuCommun.controllerForm.php', {nom : $('#nom').val(), description :  $('#description').val()}, '#form-camping', 'prepend'); return false;">Ajouter</button>
		</div>
	</form>
</div>