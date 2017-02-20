<div class="col-lg-6" style="width:100%;" name="form-pbt" id="form-pbt">
	<span class="pull-left">Signaler un problème technique</span><br/>
	<form role="form" method="post">
		<div class="form-group">
			<label for="nom">Expliquez le problème que vous rencontrez</label><br/>
			<textarea class="form-control" rows="6" cols="30" type="text" name="description" id="description"></textarea>
			<label for="isBungalow">Le problème se passe dans mon bungalow ?</label><br/>
			<input type="radio" name="isBungalow" value="true" id="oui" checked="checked" />Oui
			<input type="radio"  name="isBungalow" value="false" id="non" />Non<br/>
			
			<button class="btn btn-success" onclick="loadTo('includes/controller/controllerFormulaire/problemeTechnique.controllerForm.php', {$('#form-pbt').serialize()}, '#form-pbt', 'prepend'); return false;">Signaler</button>
		</div>
	</form>
</div>