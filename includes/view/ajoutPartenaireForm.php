<div class="col-lg-6" style="width:100%;" name="form-partenaire" id="form-partenaire">
	<span class="pull-left">Ajouter un partenaire</span><br/>
	<form role="form" method="post">
		<div class="form-group">
			<label for="nom">Entrez le nom du partenaire</label><br/>
			<input class="form-control" type="text" name="nom" id="nom" required/><br/>
			<label for="nom">Description du partenaire</label><br/>
			<textarea class="form-control" rows="6" cols="30" type="text" name="libelle" id="libelle" required></textarea><br/>
			<label for="nom">Email</label><br/>
			<input class="form-control" type="email" name="mail" id="mail" required/><br/>
			<label for="nom">Site Web</label><br/>
			<input class="form-control" type="url" name="siteWeb" id="siteWeb"/><br/>
			<label for="nom">Téléphone</label><br/>
			<input class="form-control" type="tel" name="telephone" id="telephone"/><br/>
			<button class="btn btn-success" onclick="loadTo('includes/controller/controllerFormulaire/partenaire.controllerForm.php', {nom : $('#nom').val(), libelle :  $('#libelle').val(), mail : $('#mail').val(), siteWeb : $('#siteWeb').val(), telephone : $('#telephone').val()}, '#form-partenaire', 'prepend'); return false;">Ajouter</button>
		</div>
	</form>
</div>