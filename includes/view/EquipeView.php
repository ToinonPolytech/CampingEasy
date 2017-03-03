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
		// a mettre en jointure 
		$database->select("equipe_membres",array('idEquipe'=> $_POST['id']),array('idUser'));
		$db2 = new Database(); 

	?>
	<ul class="list-group">
		<li class="list-group-item">Nom : <?php echo $equipe['nom']; ?></li>
		<li class="list-group-item">Score : <?php echo $equipe['score']; ?></li>
		<li class="list-group-item">Membres : </li>
		<?php while($idUser=$database->fetch())
				{
					$db2->select("users",array('id' => $idUser)); 
					$user= $db2->fetch();
					echo $user['prenom'];
					echo '  '.$user['nom']; 

				}




			?> 
		
	</ul>
</div>
