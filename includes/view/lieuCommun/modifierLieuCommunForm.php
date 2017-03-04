 <?php
	if (!isset($_SESSION))
		session_start();
	
	require_once($_SERVER['DOCUMENT_ROOT']."/includes/fonctions/general.php");
	require_once(i("database.class.php"));
	
	if(isset($_POST['id']))
	{
		$db = new Database(); 
		$db->select("lieu_commun", array('id' => $_POST['id']));
		$lieu= $db->fetch(); 
			
?>
		<div class="col-lg-6" style="width:100%;" name="form-camping" id="form-camping">
			<span class="pull-left">Modification du lieu  </span><br/>
			<form role="form" method="post">
				<div class="form-group">
					<label for="nom">Nom du lieu </label><br/>
					<input class="form-control" type="text" name="nom" id="nom" value='<?php echo $lieu['nom'];?>' /> <br />
					<label for="nom">Description du lieu</label><br/>
					<textarea class="form-control" rows="6" cols="30" type="text" name="description" id="description" value='<?php echo $lieu['nom'];?>'><?php echo $lieu['nom'];?></textarea> <br />
					<button class="btn btn-success" onclick="loadTo('<?php echo str_replace($_SERVER['DOCUMENT_ROOT'], '', i('lieuCommun.controllerForm.php')); ?>', {id: <?php echo $_POST['id']; ?> ,nom : $('#nom').val(), description :  $('#description').val()}, '#form-camping', 'prepend'); return false;">Modifier</button>
				</div>
			</form>
		</div>
		
		
<?php 
	}
	else
	{
		echo 'Aucun lieu reçu pour la modification'; 
	}