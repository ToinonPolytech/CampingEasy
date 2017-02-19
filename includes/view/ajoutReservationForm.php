


<div class="col-lg-6" style="width:50%;" name="form-reservation" id="form-reservation">
	<span class="pull-left"></span><br/>
	<form role="form" method="post">
		<div class="form-group">
			<label for="nom">Nombre de personnes à inscrire</label><br/>
			<input type="number" name="nbrPersonnes" id="nbrPersonnes" class="form-control"/><br/>
			<button class="btn btn-success" onclick="loadTo('includes/controller/controllerFormulaire/reservation.controllerForm.php', {nbrPersonnes : $('#nbrPersonnes').val()}, '#form-reservation', 'prepend'); return false;">Réserver </button>
		</div>
	</form>
</div>