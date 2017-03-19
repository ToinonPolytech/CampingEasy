 <?php
	if (!isset($_SESSION))
		session_start();
	
	if (isset($_POST["deb"]) && isset($_POST["fin"]))
	{
		require_once($_SERVER['DOCUMENT_ROOT']."/includes/fonctions/general.php");
		require_once(i("database.class.php"));
		$deb=strtotime($_POST["deb"]);
		$fin=strtotime($_POST["fin"]);
		$db = new Database();
		$db->prepare("SELECT * FROM users WHERE id NOT IN (SELECT idUser FROM etat_lieux WHERE debutTime>=:debutTime AND finTime<=:finTime) AND access_level!='CLIENT' AND access_level!='PARTENAIRE'");
		$db->execute(array("debutTime" => $deb, "finTime" => $fin));
		?>
		<label for="users">Attribuer un membre de l'équipe aux états des lieux</label>
		<select name="users" id="users" class="form-control">
			<option selected value="0">Sélectionner</option>
			<?php
				while ($data=$db->fetch())
				{
					?>
					<option value="<?php echo $data["id"]; ?>"><?php echo $data["nom"]." ".$data["prenom"]; ?></option>
					<?php
				}
			?>
		</select>
		<button class="btn btn-success" onclick="loadTo('<?php echo str_replace($_SERVER['DOCUMENT_ROOT'], '', i('etatDesLieux.controllerForm.php')); ?>', $('#form_edl').serialize(), '#formulaire-edl', 'prepend', true); return false;">Assigner</button>
		<?php
	}
?>