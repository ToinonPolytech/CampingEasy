 <?php 
	require_once($_SERVER['DOCUMENT_ROOT']."/includes/fonctions/general.php");
	require_once(i("database.class.php"));
	if (!isset($_POST["id"]) || !is_numeric($_POST["id"]))
		exit();
	$id=$_POST["id"];
?> 
<div class="col-lg-6" style="width:40%;" name="form-equipe" id="form-equipe">
	<?php 
		$database = new Database();
		$database->select("equipe", array('id' => $id));  
		$equipe = $database->fetch(); 
		$database->selectJoin("equipe_membres", array("users ON idUser=id"), array('idEquipe'=> $_POST['id']), array("prenom", "nom", "idUser"));
	?>
	<ul class="list-group">
		<li class="list-group-item">Nom : <?php echo $equipe['nom']; ?></li>
		<li class="list-group-item">Score : <?php echo $equipe['score']; ?></li>
		<li class="list-group-item">
			Membres : 
			<?php 
				while($data=$database->fetch())
				{
					echo $data['prenom'];
					echo '  '.$data['nom'];
					?>
					<button type="button" class="btn btn-danger btn-sm" name="suppMembre" onclick="loadToMain('<?php echo str_replace($_SERVER['DOCUMENT_ROOT'], '', i('supprimerMembreEquipe.php')); ?>', {idUser : <?php echo $data["idUser"]; ?>, idEquipe : <?php echo $id; ?>}); return false;">Supprimer</button>
					<?php
				}
			?>
		</li>
		<input class="form-control" type="text" name="ajoutPers"  id="ajoutPers"/> 
		<div id="search_pers" name="search_pers" style="display:hidden;"></div>
		<button type="button" class="btn btn-info btn-sm" name="ajouterPers" onclick="loadToMain('<?php echo str_replace($_SERVER['DOCUMENT_ROOT'], '', i('equipeMembres.controllerForm.php')); ?>', {id : <?php echo $id ?>, ajoutPers : $('#ajoutPers').val() }); return false;">Ajouter à l'équipe </button>
	</ul>
</div>
<script type="text/javascript">
	$old="";
	$time=$.now();
	$time_config=500;
	$("#ajoutPers").keyup(function (event){
		if ($old!=$(this).val())
		{
			$old=$(this).val();
			$time=$.now();
			setTimeout(function(){ searchPers(); }, $time_config);
		}
	});
	function searchPers(){
		if ($time+$time_config<=$.now())
		{
			if ($old!="")
			{
				$("#search_pers").show();
				loadTo('<?php echo str_replace($_SERVER['DOCUMENT_ROOT'], '', i('equipeMembres_search.php')); ?>', {name : $old}, '#search_pers', 'replace');
			}
			else
			{
				$("#search_pers").hide();
			}
		}
	}
</script>
